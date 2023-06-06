<?php

namespace App\Controller;

use App\Service\AjaxService;

if (! defined('ABSPATH')) {
    exit;
}

final class AjaxController
{
    public function __invoke()
    {
        if (is_admin()) {
            add_action('wp_ajax_get_request_adress', [new AjaxService(), 'getAdress']);
        }
    }
}