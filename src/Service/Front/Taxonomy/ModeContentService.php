<?php

namespace App\Service\Front\Taxonomy;

if (! defined('ABSPATH')) {
    exit;
}

final class ModeContentService extends AbstractContentService
{
    protected string $taxonomy = 'ag_mode';
    
    public function getArchiveTemplate(): string
    {
        return WP_PLUGIN_DIR . "/agence/template/front/taxonomy/mode/archive.php";
    }
}