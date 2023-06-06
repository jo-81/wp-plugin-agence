<?php

namespace App\Service\Shortcode;

if (! defined('ABSPATH')) {
    exit;
}

final class PropertyShortcodeService
{
    public function registerList()
    {
        add_shortcode("agence-properties", [$this, 'templateShortcode']);
    }

    public function templateShortcode($atts)
    {
        extract(shortcode_atts([
            'mode' => null,
            'title' => null,
            'order' => null,
            'number' => null,
        ], $atts));
        ob_start();
        load_template(WP_PLUGIN_DIR . "/agence/template/front/property/properties-shortcode.php", true, [
            'mode' => $mode,
            'title' => $title,
            'order' => $order,
            'number' => $number,
        ]);
        return ob_get_clean();
    }
}