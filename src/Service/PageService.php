<?php

namespace App\Service;

use App\Traits\Module\PageTrait;

if (! defined('ABSPATH')) {
    exit;
}

final class PageService
{
    use PageTrait;

    /**
     * registerPage
     *
     * @return void
     */
    public function registerPage(): void
    {
        $this->addMenuPage([
            'pageMenu'      => 'Agence',
            'pageTitle'     => 'Agence',
            'capability'    => 'manage_options',
            'menuSlug'      => 'agence',
            'callback'      => function() {
                $this->callbackTemplate(WP_PLUGIN_DIR . "/agence/template/admin/dashboard.php");
            },
            'iconUrl'       => 'dashicons-admin-multisite',
            'position'      => 26
        ]);
    }

    public function registerSubPage(): void
    {
        foreach(['ag_property', 'ag_characteristic'] as $postType) {
            $post = get_post_type_object($postType);
            if ($post) {
                $this->addSubmenuPage([
                        'parentSlug'    => 'agence',
                        'pageTitle'     => $post->label,
                        'menuTitle'     => $post->label,
                        'capability'    => 'manage_options',
                        'menuSlug'      => 'edit.php?post_type=' . $post->name,
                        'callback'      => '',
                        'position'      => null
                ]);
            }
        }
    }

    public function registerSubpageAdminMenuTaxonomy(): void
    {
        foreach(['ag_category', 'ag_mode', 'ag_type'] as $taxonomy) {
            $tax = get_taxonomy($taxonomy);
            if ($tax) {
                $this->addSubmenuPage(
                    [
                        'parentSlug'    => 'agence',
                        'pageTitle'     => $tax->label,
                        'menuTitle'     => $tax->label,
                        'capability'    => 'manage_options',
                        'menuSlug'      => 'edit-tags.php?taxonomy=' . $tax->name,
                        'callback'      => '',
                        'position'      => null
                    ]
                );
            }
        }
    }

    public function getParentFile($parentFile): string
    {
        return $this->getParentFileTaxonomy($parentFile, 'agence', ['ag_category', 'ag_mode', 'ag_type']);
    }

    public function getParentForCustomPostType($parentFile)
    {
        return $this->getParentFileForPage($parentFile, 'agence', ['', 'edit'], ['ag_property', 'ag_characteristic']);
    }
}