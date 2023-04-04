<?php
/**
 * Block template file: template-parts/blocks/organigramm.php
 *
 * Organigramm Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'organigramm-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-organigramm';
if ( ! empty( $block['className'] ) ) {
	$classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$classes .= ' align' . $block['align'];
}
?>

<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?> bg-gray mb-20 rounded-xl p-10 pt-0">
	<div class="text-white orga-scheme space-y-20 sm:space-y-5">
		<div class="sm:grid sm:grid-cols-12 sm:gap-5 space-y-5 sm:space-y-0">
			<div class="sm:order-3 sm:col-span-3 lg:col-span-2 mt-10">
				<p class="text-right text-black text-sm">
					<?php _e('Stand ab 01.08.2022','wmde')?>
				</p>
			</div>
			<div class="text-black sm:order-1 sm:col-span-3 lg:col-span-2">
				<ul class="text-sm lg:text-md space-y-2 mt-10">
					<li class="flex items-center gap-2">
						<span class="w-3 h-3 bg-red rounded-full inline-block"></span><?php _e('Organe','wmde')?>
					</li>
					<li class="flex items-center gap-2">
						<span class="w-3 h-3 bg-blue rounded-full inline-block"></span>
						<?php _e('Bereiche','wmde')?>
					</li>
					<li class="flex items-center gap-2">
						<span class="w-3 h-3 bg-cyan rounded-full inline-block"></span><?php _e('Teams','wmde')?>
					</li>
				</ul>
			</div>

			<div class="sm:col-span-6 lg:col-span-8 text-center relative overflow-hidden space-y-5 lg:space-y-10 pt-5 pb-10 px-5 sm:order-2">
				<h2 class="z-20 relative truncate"><?php _e('Mitgliederversammlung','wmde')?></h2>
				<h2 class="z-20 relative"><?php _e('Präsidium','wmde')?></h2>
				<div class="absolute bottom-0 left-0 w-full h-full z-10 aspect-h-1 aspect-w-1">
					<div class="h-full w-full bg-red rounded-full"></div>
				</div>
			</div>
		</div>
		<div class="flex flex-col sm:flex-row gap-5 items-center">
			<div class="w-3/4 sm:w-1/2 lg:w-1/3 sm:order-2">
				<div class="bg-red aspect-h-1 aspect-w-1 rounded-full">
					<div class="w-full-h-full flex justify-center items-center">
						<div class="text-center">
							<h3><?php _e('Vorstand','wmde')?></h3>
							<div class="grid grid-cols-2 divide-x divide-white">
								<h4 class="p-5">
									<?php _e('Franziska Heine','wmde')?>
								</h4>
								<h4 class="p-5">
									<?php _e('Christian Humborg','wmde')?>
								</h4>
							</div>
						</div>
		
					</div>
				</div>
			</div>
			<div class="w-full sm:w-1/3 sm:order-1">
				<ul class="text-sm lg:text-md bg-cyan divide-y divide-white">
					<li class="p-2">
						<?php _e('Personal','wmde')?>
					</li>
					<li class="p-2">
						<?php _e('Movement Strategy & Global Solutions','wmde')?>
					</li>
					<li class="p-2">
						<?php _e('Innovationsmotor *','wmde')?>
					</li>
				</ul>
			</div>
		
			<div class="w-full sm:w-1/3 sm:order-3">
				<ul class="text-sm lg:text-md bg-cyan divide-y divide-white">
					<li class="p-2">
						<?php _e('Strategie & Gremien','wmde')?>
					</li>
					<li class="p-2">
						<?php _e('Kampagnen & Fundraising','wmde')?>
					</li>
					<li class="p-2">
						<?php _e('Recht','wmde')?>
					</li>
				</ul>
			</div>
		</div>
		<div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-5 gap-5 gap-y-20 sm:gap-y-10">
			<div class="space-y-3 w-3/4 sm:w-full mx-auto sm:mx-0">
				<div class="bg-blue  aspect-h-1 aspect-w-1 rounded-full">
					<div class="flex justify-center items-center flex-col h-full w-full p-5">
						<h4 class="text-center text-sm lg:text-base">
							<?php _e('Softwareentwicklung: Produktentwicklung','wmde') ?>
						</h4>
						<ul class="text-sm lg:text-md flex gap-2">
							<li class="w-3 h-3 bg-cyan rounded-full"></li>
							<li class="w-3 h-3 bg-cyan rounded-full"></li>
							<li class="w-3 h-3 bg-cyan rounded-full"></li>
							<li class="w-3 h-3 bg-cyan rounded-full"></li>
						</ul>
					</div>
				</div>
				<ul class="text-sm lg:text-md bg-cyan divide-y divide-white">
					<li class="p-2">
						<?php _e('Produktmanagement','wmde')?>
					</li>
					<li class="p-2">
						<?php _e('Projektmanagement','wmde')?>
					</li>
					<li class="p-2">
						<?php _e('UX & Design','wmde')?>
					</li>
					<li class="p-2">
						<?php _e('Community-Kommunikation','wmde')?>
					</li>
				</ul>
			</div>
			<div class="space-y-3 w-3/4 sm:w-full mx-auto sm:mx-0">
				<div class="bg-blue  aspect-h-1 aspect-w-1 rounded-full">
					<div class="flex justify-center items-center flex-col h-full w-full p-5">
						<h4 class="text-center text-sm lg:text-base">
							<?php _e('Softwareentwicklung: Engeneering','wmde') ?>
						</h4>
						<ul class="text-sm lg:text-md flex gap-2">
							<li class="w-3 h-3 bg-cyan rounded-full"></li>
							<li class="w-3 h-3 bg-cyan rounded-full"></li>
							<li class="w-3 h-3 bg-cyan rounded-full"></li>
							<li class="w-3 h-3 bg-cyan rounded-full"></li>
							<li class="w-3 h-3 bg-cyan rounded-full"></li>
						</ul>
					</div>
				</div>
				<ul class="text-sm lg:text-md bg-cyan divide-y divide-white">
					<li class="p-2">
						<?php _e('Technische Wünsche','wmde')?>
					</li>
					<li class="p-2">
						<?php _e('Product Plattform','wmde')?>
					</li>
					<li class="p-2">
						<?php _e('Wikidata','wmde')?>
					</li>
					<li class="p-2">
						<?php _e('Wikibase.Cloud','wmde')?>
					</li>
					<li class="p-2">
						<?php _e('Fundraising Tech','wmde')?>
					</li>
				</ul>
			</div>
			<div class="space-y-3 w-3/4 sm:w-full mx-auto sm:mx-0">
				<div class="bg-blue  aspect-h-1 aspect-w-1 rounded-full">
					<div class="flex justify-center items-center flex-col h-full w-full p-5">
						<h4 class="text-center text-sm lg:text-base">
							<?php _e('Communitys, Gesellschaft, Politik','wmde') ?>
						</h4>
						<ul class="text-sm lg:text-md flex gap-2">
							<li class="w-3 h-3 bg-cyan rounded-full"></li>
							<li class="w-3 h-3 bg-cyan rounded-full"></li>
							<li class="w-3 h-3 bg-cyan rounded-full"></li>
							<li class="w-3 h-3 bg-cyan rounded-full"></li>
						</ul>
					</div>
				</div>
				<ul class="text-sm lg:text-md bg-cyan divide-y divide-white">
					<li class="p-2">
						<?php _e('Politik & öffentlicher Sektor','wmde')?>
					</li>
					<li class="p-2">
						<?php _e('Bildung, Wissenschaft, Kultur','wmde')?>
					</li>
					<li class="p-2">
						<?php _e('Communitys & Engagement','wmde')?>
					</li>
					<li class="p-2">
						<?php _e('Schutz & Beratung','wmde')?>
					</li>
				</ul>
			</div>
			<div class="space-y-3 w-3/4 sm:w-full mx-auto sm:mx-0">
				<div class="bg-blue  aspect-h-1 aspect-w-1 rounded-full">
					<div class="flex justify-center items-center flex-col h-full w-full p-5">
						<h4 class="text-center text-sm lg:text-base">
							<?php _e('Finanzen & Zentrale Dienste','wmde') ?>
						</h4>
						<ul class="text-sm lg:text-md flex gap-2">
							<li class="w-3 h-3 bg-cyan rounded-full"></li>
							<li class="w-3 h-3 bg-cyan rounded-full"></li>
							<li class="w-3 h-3 bg-cyan rounded-full"></li>
							<li class="w-3 h-3 bg-cyan rounded-full"></li>
						</ul>
					</div>
				</div>
				<ul class="text-sm lg:text-md bg-cyan divide-y divide-white">
					<li class="p-2">
						<?php _e('Finanzen','wmde')?>
					</li>
					<li class="p-2">
						<?php _e('Spenden & Mitlgieder','wmde')?>
					</li>
					<li class="p-2">
						<?php _e('Interne IT','wmde')?>
					</li>
					<li class="p-2">
						<?php _e('Officemanagement','wmde')?>
					</li>
				</ul>
			</div>
			<div class="space-y-3 w-3/4 sm:w-full mx-auto sm:mx-0">
				<div class="bg-blue  aspect-h-1 aspect-w-1 rounded-full">
					<div class="flex justify-center items-center flex-col h-full w-full p-5">
						<h4 class="text-center text-sm lg:text-base">
							<?php _e('Kommunikation & Events','wmde') ?>
						</h4>
						<ul class="text-sm lg:text-md flex gap-2">
							<li class="w-3 h-3 bg-cyan rounded-full"></li>
							<li class="w-3 h-3 bg-cyan rounded-full"></li>
						</ul>
					</div>
				</div>
				<ul class="text-sm lg:text-md bg-cyan divide-y divide-white">
					<li class="p-2">
						<?php _e('Kommunikation','wmde')?>
					</li>
					<li class="p-2">
						<?php _e('Eventmanagement','wmde')?>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>