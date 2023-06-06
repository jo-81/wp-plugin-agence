<?php

namespace App\Traits\Module;

if (! defined('ABSPATH')) {
    exit;
}

trait PostTypeTrait
{
    /**
     * registerCustomPostType
     *
     * @param  string $name
     * @param  array $datas
     * @throws Exception Si le cpt retourne une erreur
     *
     * @return void
     */
    public function registerCustomPostType(string $name, array $datas): void
    {
        if (post_type_exists($name)) {
            return;
        }

        $result = register_post_type($name, $datas);
        if (is_wp_error($result)) {
            throw new \Exception(sprintf("Le custom post type %s n'a pas été enregistré.", $name));
        }
    }
    
    /**
     * getIcon
     *
     * @param  string $icon
     * @return string
     */
    public function getIcon(string $icon): string
    {
        return 'data:image/svg+xml;base64,' . base64_encode(file_get_contents($icon));
    }
}