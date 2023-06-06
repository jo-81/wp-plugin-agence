<?php

namespace App\Traits\Module;

if (! defined('ABSPATH')) {
    exit;
}

trait PageTrait
{
    /**
     * addMenuPage
     * Ajoute une page dans l'administration
     *
     * @param  array $datas
     * @return void
     */
    public function addMenuPage(array $datas): void
    {
        extract($datas);
        add_menu_page($pageMenu, $pageTitle, $capability, $menuSlug, $callback, $iconUrl, $position);
    }

    /**
     * addSubmenuPage
     *
     * @param  array $datas
     * @return void
     */
    public function addSubmenuPage(array ...$datas): void
    {
        foreach ($datas as $data) {
            extract($data);
            add_submenu_page($parentSlug, $pageTitle, $menuTitle, $capability, $menuSlug, $callback, $position);
        }
    }

    /**
     * getParentFileTaxonomy
     *
     * @param  string $parentFile
     * @param  string $page
     * @param  array $taxonomies
     * @return string
     */
    public function getParentFileTaxonomy(string $parentFile, string $page, array $taxonomies): string
    {
        global $current_screen;
        $taxonomy = $current_screen->taxonomy;

        if (in_array($taxonomy, $taxonomies)) {
            $parentFile = $page;
        }
        return $parentFile;
    }

    /**
     * getParentFileForPage
     *
     * @param  string $parentFile
     * @param  string $page
     * @param  array $actions
     * @param  array $postType
     * @return string
     */
    public function getParentFileForPage(string $parentFile, string $page, array $actions = [], array $postType = []): string
    {
        global $current_screen;
        $action = $current_screen->action;

        if (! in_array($current_screen->post_type, $postType)) {
            return $parentFile;
        }

        if (in_array($action, $actions)) {
            $parentFile = $page;
        }
        return $parentFile;
    }

    /**
     * callbackTemplate
     *
     * @param  string $template
     * @return void
     */
    public function callbackTemplate(string $template)
    {
        if (! file_exists($template)) {
            throw new \Exception("Le template $template n'existe pas");
        }

        include $template;
    }
}
