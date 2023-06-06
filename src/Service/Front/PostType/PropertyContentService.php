<?php

namespace App\Service\Front\PostType;

if (! defined('ABSPATH')) {
    exit;
}

final class PropertyContentService extends AbstractContentService
{
    protected string $postType = 'ag_property';
    public function orderRenderTemplate(): array
    {
        return [
            '/title.php',
            '/informations.php',
        ];
    }
    
    /**
     * getTemplate
     *
     * @return string
     */
    public function getTemplate(): string
    {
        return WP_PLUGIN_DIR . "/agence/template/front/property/single-property.php";
    }

    public function getArchiveTemplate(): string
    {
        return WP_PLUGIN_DIR . "/agence/template/front/property/archive.php";
    }
}