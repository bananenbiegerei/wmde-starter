<?php

// Extend has_post_thumbnail() to check is there's featured image from the media library or from Wikimedia Commons
add_filter(
	'has_post_thumbnail',
	function ($has_thumbnail, $post, $thumbnail_id) {
		return get_field('wkc_featured_image_url') ? true : false || $has_thumbnail;
	},
	10,
	3,
);

// Extend the_post_thumbnail() to get image from media library or from Wikimedia Commons
add_filter('post_thumbnail_html', function ($html) {
	preg_match('/class="(.*?)"/s', $html, $match);
	$classes = $match[1] ?? '';
	if ($url = get_field('wkc_featured_image_url')) {
		$data = bbWikimediaCommonsMedia::get_media($url);
		$thumbnail = "<img src=\"{$data['media_url']}\" alt=\"{$data['desc']}\" class=\" {$classes}\" decoding=\"async\" srcset=\"{$data['srcset']}\">";
	} else {
		$thumbnail = the_post_thumbnail($size, ['class' => $classes]);
	}
	return $thumbnail;
});

// Extend the_post_thumbnail_caption() to get caption from media library or from Wikimedia Commons
add_filter('the_post_thumbnail_caption', function ($caption) {
	if (get_field('wkc_featured_image_url')) {
		return bbWikimediaCommonsMedia::get_post_thumbnail_caption();
	}
	return $caption;
});

define('BBWKC_CACHE_TIME', 24 * HOUR_IN_SECONDS);
define('BBWKC_TRANSIENT_PREFIX', 'bbwkc');
define('BBWKC_API_ENDPOINT', 'https://commons.wikimedia.org/w/api.php');

class bbWikimediaCommonsMedia
{
	/* Fuctions for post featured image */
	static function has_post_thumbnail()
	{
		return get_field('wkc_featured_image_url') || has_post_thumbnail();
	}

	static function the_post_thumbnail($size, $options)
	{
		$classes = $options['class'] ?? '';
		if ($url = get_field('wkc_featured_image_url')) {
			$data = bbWikimediaCommonsMedia::get_media($url);
			echo "<img src=\"{$data['media_url']}\" alt=\"{$data['desc']}\" class=\"wp-post-image {$classes}\" decoding=\"async\" srcset=\"{$data['srcset']}\">";
		} else {
			echo the_post_thumbnail($size, ['class' => $classes]);
		}
	}

	static function get_post_thumbnail_caption()
	{
		if ($url = get_field('wkc_featured_image_url')) {
			$wmc_image_data = bbWikimediaCommonsMedia::get_media($url);
			return '<a href="' . esc_attr($wmc_image_data['url']) . '">' . $wmc_image_data['creator'] . ' - ' . $wmc_image_data['usageterms'] . '</a>';
		} else {
			return strip_tags(wp_get_attachment_caption(get_post_thumbnail_id()), ['a']);
		}
	}

	static function get_the_post_thumbnail_url($post_id)
	{
		if ($url = get_field('wkc_featured_image_url', $post_id)) {
			$data = bbWikimediaCommonsMedia::get_media($url);
			return explode(' ', explode(',', $data['srcset'])[0])[0];
		} else {
			return get_the_post_thumbnail_url($post_id);
		}
	}

	/* Interface with Wikimedia Commons */
	static function get_media($file, $lang = 'en')
	{
		$file = stripcslashes(bbWikimediaCommonsMedia::sanitize_uri($file));
		$img = get_transient(BBWKC_TRANSIENT_PREFIX . $file);
		if (!$img) {
			$img = bbWikimediaCommonsMedia::get_media_query($file, $lang);
			if ($img) {
				set_transient(BBWKC_TRANSIENT_PREFIX . $file, $img, BBWKC_CACHE_TIME);
			}
		}
		return $img;
	}

	static function get_media_query($file, $lang = 'en')
	{
		$endPoint = BBWKC_API_ENDPOINT;
		$mime_type = bbWikimediaCommonsMedia::get_media_type($file);
		$hash = md5($file);
		$h = $hash[0] . '/' . $hash[0] . $hash[1];
		$type = explode('/', $mime_type ?? '')[0];

		if ($mime_type == 'application/pdf') {
			$type = 'pdf';
		} elseif ($mime_type == 'application/ogg') {
			$type = 'audio';
		}

		$params = [
			'action' => 'query',
			'format' => 'json',
			'prop' => 'imageinfo',
			'iiprop' => 'url|dimensions|mime|extmetadata',
			'iiextmetadatafilter' => 'ImageDescription|UsageTerms|Artist',
			'titles' => 'File:' . $file,
			//'lang' => $lang,
		];

		$url = $endPoint . '?' . http_build_query($params);
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$output = curl_exec($ch);
		curl_close($ch);
		$data = json_decode($output, true);

		if (empty($data) || !empty($data['query']['pages']['-1'])) {
			return null;
		}
		$media = array_pop($data['query']['pages']);

		// default values for all medias
		$out = [
			'id' => $media['pageid'],
			'url' => "https://commons.wikimedia.org/wiki/File:{$file}",
			'creator' => strip_tags($media['imageinfo'][0]['extmetadata']['Artist']['value']),
			'usageterms' => strip_tags($media['imageinfo'][0]['extmetadata']['UsageTerms']['value']),
			'type' => $type,
			'mime_type' => $mime_type,
			'dim' => $media['imageinfo'][0]['width'] . 'x' . $media['imageinfo'][0]['height'],
			'desc' => strip_tags($media['imageinfo'][0]['extmetadata']['ImageDescription']['value'] ?? ''), // FIXME
		];

		switch ($type) {
			case 'image':
				$out['image'] = $media['imageinfo'][0]['url'];
				$out['media_url'] = $media['imageinfo'][0]['url'];
				$out['srcset'] = bbWikimediaCommonsMedia::img_srcset($file, bbWikimediaCommonsMedia::get_wp_image_sizes(), $media['imageinfo'][0]['width'], $h);
				break;
			case 'video':
				$out['image'] = bbWikimediaCommonsMedia::get_video_poster($file, $h);
				$out['media_url'] = $media['imageinfo'][0]['url'];
				if ($mime_type == 'video/ogg') {
					$out['media_url'] = bbWikimediaCommonsMedia::get_video_alt($file, $h);
				}
				break;
			case 'audio':
				$out['media_url'] = $media['imageinfo'][0]['url'];
				if ($mime_type == 'application/ogg') {
					$out['media_url'] = bbWikimediaCommonsMedia::get_audio_alt($file, $h);
				}
				break;
			case 'pdf':
				$out['image'] = $media['imageinfo'][0]['url'];
				$out['media_url'] = $media['imageinfo'][0]['url'];
				break;
		}
		return $out;
	}

	static function get_media_type($file)
	{
		/* prettier-ignore */
		$WKC_MIME_TYPES = [ 'gif' => 'image/gif', 'jpeg' => 'image/jpeg', 'jpg' => 'image/jpeg', 'm4v' => 'video/x-m4v', 'mov' => 'video/quicktime', 'mp4' => 'video/mp4', 'mp4v' => 'video/mp4', 'mpa' => 'video/mpeg', 'mpe' => 'video/mpeg', 'mpeg' => 'video/mpeg', 'mpg' => 'video/mpeg', 'mpg4' => 'video/mp4', 'ogv' => 'video/ogg', 'pdf' => 'application/pdf', 'png' => 'image/png', 'svg' => 'image/svg+xml', 'svgz' => 'image/svg+xml', 'webm' => 'video/webm', 'tif' => 'image/tiff', 'tiff' => 'image/tiff', 'mp3' => 'audio/mpeg', 'mid' => 'audio/midi', 'midi' => 'audio/midi', 'flac' => 'audio/x-flac', 'wav' => 'audio/x-wav', 'ogg' => 'application/ogg', ];
		$ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
		if (!empty($WKC_MIME_TYPES[$ext])) {
			return $WKC_MIME_TYPES[$ext];
		}
	}

	static function sanitize_uri($uri)
	{
		static $commonsRegex = '!^https?://(commons\.wikimedia\.org/wiki/File:|upload\.wikimedia\.org.+/)(.+)!';
		if (preg_match($commonsRegex, $uri, $match)) {
			$file = urldecode($match[2]);
		} elseif (preg_match('!^File:(.+)!', $uri, $match)) {
			$file = urldecode(str_replace(' ', '_', $match[1]));
		} else {
			$file = str_replace(' ', '_', $uri);
		}
		return $file;
	}

	static function get_wp_image_sizes()
	{
		$sizes = [];
		foreach (wp_get_registered_image_subsizes() as $s) {
			if ($s['crop'] == false) {
				$sizes[] = $s['width'];
			}
		}
		return $sizes;
	}

	static function get_thumbnail_url($file, $size, $h)
	{
		return 'https://upload.wikimedia.org/wikipedia/commons/thumb/' . $h . '/' . urlencode($file) . '/' . $size . 'px-' . urlencode($file);
	}

	static function get_image_url($file, $h)
	{
		return 'https://upload.wikimedia.org/wikipedia/commons/' . $h . '/' . urlencode($file);
	}

	static function get_audio_alt($file, $h)
	{
		return 'https://upload.wikimedia.org/wikipedia/commons/transcoded/' . $h . '/' . urlencode($file) . '/' . urlencode($file) . '.mp3';
	}

	static function get_video_alt($file, $h)
	{
		return 'https://upload.wikimedia.org/wikipedia/commons/transcoded/' . $h . '/' . urlencode($file) . '/' . urlencode($file) . '.360p.vp9.webm';
	}

	static function get_video_poster($file, $h)
	{
		return 'https://upload.wikimedia.org/wikipedia/commons/thumb/' . $h . '/' . urlencode($file) . '/1024px--' . urlencode($file) . '.jpg';
	}

	static function img_srcset($file, $sizes, $img_size, $h)
	{
		$srcset = [];
		if ($img_size > max($sizes)) {
			foreach ($sizes as $size) {
				$srcset[] = bbWikimediaCommonsMedia::get_thumbnail_url($file, $size, $h) . ' ' . $size . 'w';
			}
		}
		$srcset[] = bbWikimediaCommonsMedia::get_image_url($file, $h) . ' ' . $img_size . 'w';
		return join(', ', $srcset);
	}
}
