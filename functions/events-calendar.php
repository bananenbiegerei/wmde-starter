<?php

function deregister_tribe_styles()
{
    wp_deregister_style('tribe-events-pro-views-v2-skeleton');
    wp_deregister_style('tribe-events-pro-views-v2-full');
    wp_deregister_style('tribe-events-views-v2-skeleton');
    wp_deregister_style('tribe-events-views-v2-full');
    wp_deregister_style('tribe-common-skeleton-style');
    wp_deregister_style('tribe-common-full-style');
}
add_action('wp_enqueue_scripts', 'deregister_tribe_styles', 1);

add_filter('tribe_events_editor_default_template', function ($template) {
    $template = [
      [ 'tribe/event-datetime' ],
      [ 'core/paragraph', [
        'placeholder' => __('Beschreibung hinzufügen...', 'the-events-calendar', BB_TEXT_DOMAIN),
      ], ],
      [ 'tribe/event-organizer' ],
      [ 'tribe/event-venue' ],
    ];
    return $template;
}, 11, 1);

add_filter('tribe_events_editor_default_template', function ($template) {
    $template = [
      [ 'tribe/event-datetime' ],
      [ 'acf/paragraph'],
      [ 'acf/spacer'],
      [ 'acf/heading'],
      [ 'acf/paragraph'],
      [ 'acf/spacer'],
      [ 'acf/heading'],
      [ 'acf/paragraph'],
      [ 'acf/spacer'],
      [ 'tribe/event-organizer' ],
      [ 'tribe/event-venue' ],
      [ 'acf/logo-graveyard'],
    ];
    return $template;
}, 11, 1);
