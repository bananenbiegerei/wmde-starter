<h3 class="text-base"><?php _e(get_field('social_headline', 'options'), BB_TEXT_DOMAIN); ?></h3>
<ul class="list-none flex gap-2 items-center" id="social-media-menu">


  <?php if ($url = get_field('social_instagram', 'options')): ?>
  <li>
  <a class="btn btn-primary btn-ghost btn-icon-only" href="<?= $url ?>" target="_blank" rel="me">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" preserveAspectRatio="xMidYMid meet" viewBox="0 0 1024 1024" alt="Instagram Logo">
    <path fill="currentColor" d="M512 378.7c-73.4 0-133.3 59.9-133.3 133.3S438.6 645.3 512 645.3S645.3 585.4 645.3 512S585.4 378.7 512 378.7zM911.8 512c0-55.2.5-109.9-2.6-165c-3.1-64-17.7-120.8-64.5-167.6c-46.9-46.9-103.6-61.4-167.6-64.5c-55.2-3.1-109.9-2.6-165-2.6c-55.2 0-109.9-.5-165 2.6c-64 3.1-120.8 17.7-167.6 64.5C132.6 226.3 118.1 283 115 347c-3.1 55.2-2.6 109.9-2.6 165s-.5 109.9 2.6 165c3.1 64 17.7 120.8 64.5 167.6c46.9 46.9 103.6 61.4 167.6 64.5c55.2 3.1 109.9 2.6 165 2.6c55.2 0 109.9.5 165-2.6c64-3.1 120.8-17.7 167.6-64.5c46.9-46.9 61.4-103.6 64.5-167.6c3.2-55.1 2.6-109.8 2.6-165zM512 717.1c-113.5 0-205.1-91.6-205.1-205.1S398.5 306.9 512 306.9S717.1 398.5 717.1 512S625.5 717.1 512 717.1zm213.5-370.7c-26.5 0-47.9-21.4-47.9-47.9s21.4-47.9 47.9-47.9s47.9 21.4 47.9 47.9a47.84 47.84 0 0 1-47.9 47.9z" />
    </svg>
    <span class="sr-only">Instagram</span>
  </a>
  <?php endif; ?>
  </li>

  <?php if ($url = get_field('social_twitter', 'options')): ?>
  <li>
  <a class="btn btn-primary btn-ghost btn-icon-only" href="<?= $url ?>" target="_blank" rel="me">
    <svg class="w-5 h-5" width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg"  alt="X Logo">
    <rect width="40" height="40" rx="8" fill="currentColor" />
    <g clip-path="url(#clip0_3220_2834)">
      <path d="M22.5597 18.2499L30.7143 8.57141H28.7819L21.7013 16.9751L16.0461 8.57141H9.52344L18.0753 21.2792L9.52344 31.4286H11.4559L18.9332 22.554L24.9055 31.4286H31.4282L22.5597 18.2499ZM19.913 21.3912L19.0465 20.1258L12.1522 10.0568H15.1204L20.6841 18.1828L21.5506 19.4482L28.7828 30.0108H25.8147L19.913 21.3912Z" fill="currentColor" />
    </g>
    <defs>
      <clipPath id="clip0_3220_2834">
      <rect width="21.9048" height="22.8571" fill="currentColor" transform="translate(9.52344 8.57141)" />
      </clipPath>
    </defs>
    </svg>
    <span class="sr-only">X</span>
  </a>
  </li>
  <?php endif; ?>
  <?php if ($url = get_field('social_linkedin', 'options')): ?>
  <li>
  <a class="btn btn-primary btn-ghost btn-icon-only" href="<?= $url ?>" target="_blank" rel="me"> <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 16 16"  alt="linkedin Logo">
    <path fill="currentColor" d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248c-.015-.709-.52-1.248-1.342-1.248c-.822 0-1.359.54-1.359 1.248c0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586c.173-.431.568-.878 1.232-.878c.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252c-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z" />
    </svg>
    <span class="sr-only">linkedin</span>
  </a>
  </li>
  <?php endif; ?>
  <?php if ($url = get_field('social_facebook', 'options')): ?>
  <li>
  <a class="btn btn-primary btn-ghost btn-icon-only" href="<?= $url ?>" target="_blank" rel="me"> <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512"  alt="Facebook Logo">
    <path fill="currentColor" d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48c27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z" />
    </svg>
    <span class="sr-only">Facebook</span>
  </a>
  </li>
  <?php endif; ?> <?php if ($url = get_field('social_mastodon', 'options')): ?>
  <li>
  <a class="btn btn-primary btn-ghost btn-icon-only" href="<?= $url ?>" rel="me" target="_blank"> <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24"  alt="Mastodon Logo">
    <path fill="currentColor" d="M12.158 0c-3.068.025-6.02.357-7.74 1.147c0 0-3.41 1.526-3.41 6.733c0 1.192-.024 2.617.014 4.129c.123 5.091.933 10.11 5.64 11.355c2.171.575 4.035.695 5.535.613c2.722-.151 4.25-.972 4.25-.972l-.09-1.974s-1.945.613-4.13.538c-2.163-.074-4.448-.233-4.798-2.89a5.448 5.448 0 0 1-.048-.745s2.124.519 4.816.642c1.647.076 3.19-.096 4.759-.283c3.007-.36 5.625-2.212 5.954-3.905c.519-2.667.476-6.508.476-6.508c0-5.207-3.411-6.733-3.411-6.733C18.255.357 15.302.025 12.233 0h-.075ZM8.686 4.068c1.278 0 2.245.491 2.885 1.474l.622 1.043l.623-1.043c.64-.983 1.607-1.474 2.885-1.474c1.105 0 1.995.388 2.675 1.146c.658.757.986 1.781.986 3.07v6.303h-2.497V8.47c0-1.29-.543-1.945-1.628-1.945c-1.2 0-1.802.777-1.802 2.313v3.349h-2.483v-3.35c0-1.535-.601-2.312-1.802-2.312c-1.085 0-1.628.655-1.628 1.945v6.118H5.024V8.283c0-1.288.328-2.312.987-3.07c.68-.757 1.57-1.145 2.675-1.145Z" />
    </svg>
    <span class="sr-only">Mastodon</span>
  </a>
  </li>
  <?php endif; ?>
</ul>