<?php

namespace App\Controller;

use App\Service\ContactService;

if (! defined('ABSPATH')) {
    exit;
}

final class ContactController
{
    public function __invoke()
    {
        if (! is_admin()) {
            add_action('init', [new ContactService, 'sendPropertyEmail']);
        }
    }
}