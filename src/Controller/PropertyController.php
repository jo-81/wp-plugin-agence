<?php

namespace App\Controller;

use App\Service\Filter\PropertyFilterService;
use App\Service\MetaBox\PropertyMetaboxService;
use App\Service\Front\Query\PropertyQueryService;
use App\Service\Shortcode\PropertyShortcodeService;
use App\Service\Front\PostType\PropertyContentService;
use App\Service\PostType\PropertyCustomPostTypeService;

if (! defined('ABSPATH')) {
    exit;
}

final class PropertyController
{
    public function __invoke()
    {
        add_action('init', [new PropertyCustomPostTypeService, 'addCustomPostType']);

        if (is_admin()) {
            // METABOXES
            $metaboxService = new PropertyMetaboxService;
            add_action('add_meta_boxes', [$metaboxService, 'register'], 10, 2);
            add_action('save_post', [$metaboxService, 'saveMetaBox']);

            // FILTERS
            $propertyFilterService = new PropertyFilterService;
            add_action('restrict_manage_posts', [$propertyFilterService, 'addFilterTaxonomies']);
        }

        if (! is_admin()) {
            $propertyContentService = new PropertyContentService;
            add_filter('template_include', [$propertyContentService, 'render']);
            add_action('init', [new PropertyShortcodeService, 'registerList']);

            add_action('pre_get_posts', [new PropertyQueryService, 'editQueryProperty']);
        }
    }
}