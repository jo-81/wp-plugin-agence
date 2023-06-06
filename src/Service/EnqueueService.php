<?php

namespace App\Service;

use App\Traits\Module\EnqueueTrait;

if (! defined('ABSPATH')) {
    exit;
}

final class EnqueueService
{
    use EnqueueTrait;

    /**
     * registerAssets
     *
     * @return void
     */
    public function registerAssets(): void
    {
        $this->registerStyle('agence_admin_style', '/agence/src/public/assets/css/style.css', [
            'post_type' => ['ag_property', 'ag_characteristic'],
            'page'  => ['agence']
        ]);

        $this->registerScript('agence_admin_script_uploader', '/agence/assets/js/uploader.js', [
            'post_type' => ['ag_property']
        ]);

        $this->registerScript('agence_admin_script_property', '/agence/assets/js/property.js', [
            'post_type' => ['ag_property']
        ]);
    }

    public function registerAssertsForTheme(): void
    {
        $this->registerStyle('agence_admin_style', '/agence/src/public/assets/css/style.css');
        $this->registerScript('agence_admin_ajax_script_gallery', '/agence/assets/js/gallery.js');
    }

    public function registerAjaxRequest(): void
    {
        $this->registerScript('agence_admin_ajax_script_adress', '/agence/assets/js/adress.js');
        wp_localize_script('agence_admin_ajax_script_adress', 'admin_ajax_adress', [
            'ajax_url'  => admin_url('admin-ajax.php'),
            'nonce'     => wp_create_nonce("agence_ajax_adress")
        ]);
        wp_enqueue_script('agence_admin_ajax_script_adress');
    }
}