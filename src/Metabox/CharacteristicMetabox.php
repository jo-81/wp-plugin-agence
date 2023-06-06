<?php

namespace App\MetaBox;

use App\Metabox\MetaboxInterface;

if (! defined('ABSPATH')) {
    exit;
}

final class CharacteristicMetabox implements MetaboxInterface
{
    public const TEMPLATE_DIR = "/agence/template/admin/metabox/characteristic";

    public function getMetaboxes(string ...$datas): array
    {
        return [
            "informations" => [
                'id'                => 'agence_characteristic_property_metabox_informations',
                'title'             => __('Informations', 'agence'),
                'callback'          => function ($post) {
                    include WP_PLUGIN_DIR . self::TEMPLATE_DIR ."/informations.php";
                },
                'screen'            => 'ag_characteristic',
                'context'           => 'side',
                'position'          => 0,
            ],
        ];
    }
}