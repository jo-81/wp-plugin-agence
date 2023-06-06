<?php

namespace App\Controller;

use App\Service\EnqueueService;

if (! defined('ABSPATH')) {
    exit;
}

final class EnqueueController
{
    public function __invoke()
    {
        $enqueueService = new EnqueueService;
        if (is_admin()) {
            add_action('admin_print_styles', [$enqueueService, 'registerAssets']);
            add_action('admin_print_styles', [$enqueueService, 'registerAjaxRequest']);
        }

        if (! is_admin()) {
            add_action('wp_enqueue_scripts', [$enqueueService, 'registerAssertsForTheme']);
        }
    }
}