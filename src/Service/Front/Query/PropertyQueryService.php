<?php

namespace App\Service\Front\Query;

if (! defined('ABSPATH')) {
    exit;
}

final class PropertyQueryService
{
    public function editQueryProperty($query)
    {
        if (! is_admin() && $query->is_main_query() && is_archive('ag_property')) {
            $query->set('meta_query', [
                [
                    'key' => 'ag_property_show',
                    'compare' => '=',
                    'value' => 'on',
                ]
            ]);
        }

        return $query;
    }
}