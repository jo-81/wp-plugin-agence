<?php

namespace App\Controller;

use App\Service\Filter\CharacteristicFilterService;
use App\Service\MetaBox\CharacteristicMetaboxService;
use App\Service\PostType\CharacteristicCustomPostTypeService;

if (! defined('ABSPATH')) {
    exit;
}

final class CharacteristicController
{
    public function __invoke()
    {
        add_action('init', [new CharacteristicCustomPostTypeService, 'addCustomPostType']);

        if (is_admin()) {
            $metaboxService = new CharacteristicMetaboxService;
            add_action('add_meta_boxes', [$metaboxService, 'register'], 10, 2);
            add_action('save_post', [$metaboxService, 'saveMetaBox']);

            // FILTERS
            $propertyFilterService = new CharacteristicFilterService;
            add_action('restrict_manage_posts', [$propertyFilterService, 'addFilterTaxonomies']);
        }
    }
}