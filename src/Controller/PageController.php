<?php

namespace App\Controller;

use App\Service\PageService;

if (! defined('ABSPATH')) {
    exit;
}

final class PageController
{
    public function __invoke()
    {
        if (is_admin()) {
            $pageService = new PageService;
            add_action('admin_menu', [$pageService, 'registerPage']);
            add_action('admin_menu', [$pageService, 'registerSubPage']);
            add_action('admin_menu', [$pageService, 'registerSubpageAdminMenuTaxonomy']);
            add_filter('parent_file', [$pageService, 'getParentFile']);
            add_filter('parent_file', [$pageService, 'getParentForCustomPostType']);
        }
    }
}