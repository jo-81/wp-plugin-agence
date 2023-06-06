<?php

namespace App\MetaBox;

use App\Metabox\MetaboxInterface;

if (! defined('ABSPATH')) {
    exit;
}

final class PropertyMetabox implements MetaboxInterface
{
    public const TEMPLATE_DIR = "/agence/template/admin/metabox/property";

    public function getMetaboxes(string ...$datas): array
    {
        return [
            "informations_generales" => [
                'id'                => 'agence_property_metabox_informations_generales',
                'title'             => __('Informations générales', 'agence'),
                'callback'          => function ($post) {
                    include WP_PLUGIN_DIR . self::TEMPLATE_DIR ."/informations-generales.php";
                },
                'screen'            => 'ag_property',
                'context'           => 'side',
                'position'          => 0,
            ],
            "bilan_energetique" => [
                'id'                => 'agence_property_metabox_bilan_energetique',
                'title'             => __('Bilan énergétique', 'agence'),
                'callback'          => function ($post) {
                    include WP_PLUGIN_DIR . self::TEMPLATE_DIR ."/bilan-energetique.php";
                },
                'screen'            => 'ag_property',
                'context'           => 'side',
                'position'          => 0,
            ],
            "characteristic" => [
                'id'                => 'agence_property_metabox_characteristic',
                'title'             => __('Caractéristiques', 'agence'),
                'callback'          => function ($post) {
                    include WP_PLUGIN_DIR . self::TEMPLATE_DIR ."/characteristic.php";
                },
                'screen'            => 'ag_property',
                'context'           => 'normal',
                'position'          => 1,
            ],
            "gallery" => [
                'id'                => 'agence_property_metabox_gallery',
                'title'             => __('Images', 'agence'),
                'callback'          => function ($post) {
                    include WP_PLUGIN_DIR . self::TEMPLATE_DIR ."/gallery.php";
                },
                'screen'            => 'ag_property',
                'context'           => 'normal',
                'position'          => 1,
            ],
            "price" => [
                'id'                => 'agence_property_metabox_price',
                'title'             => __('Prix', 'agence'),
                'callback'          => function ($post) {
                    include WP_PLUGIN_DIR . self::TEMPLATE_DIR ."/price.php";
                },
                'screen'            => 'ag_property',
                'context'           => 'side',
                'position'          => 1,
            ],
            "place" => [
                'id'                => 'agence_property_metabox_place',
                'title'             => __('Adresse', 'agence'),
                'callback'          => function ($post) {
                    include WP_PLUGIN_DIR . self::TEMPLATE_DIR ."/place.php";
                },
                'screen'            => 'ag_property',
                'context'           => 'side',
                'position'          => 1,
            ],
        ];
    }
}