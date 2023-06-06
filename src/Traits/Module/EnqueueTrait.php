<?php

namespace App\Traits\Module;

if (! defined('ABSPATH')) {
    exit;
}

trait EnqueueTrait
{
    public function registerCdn(string $name, string $file, array $access = [])
    {
        if(! $this->access($access)) {
            return;
        }

        wp_enqueue_style($name, $file);
    }


    /**
     * registerStyle
     *
     * @param  string $name
     * @param  string $file
     * @return void
     */
    public function registerStyle(string $name, string $file, array $access = []): void
    {
        if(! $this->access($access)) {
            return;
        }
        $this->existFile($file);

        wp_enqueue_style($name, WP_PLUGIN_URL . $file);
    }
    
    /**
     * registerScript
     *
     * @param  string $name
     * @param  string $file
     * @return void
     */
    public function registerScript(string $name, string $file): void
    {
        $this->existFile($file);

        wp_enqueue_script($name, WP_PLUGIN_URL . $file, ['jquery'], false, true);
    }

    public function registerPluginJQuery(string $name, array $access = [])
    {
        if(! $this->access($access)) {
            return;
        }
        wp_enqueue_script($name);
    }
    
    /**
     * existFile
     *
     * @param  string $file
     * @return void
     */
    private function existFile(string $file): void
    {
        if (! file_exists($path = WP_PLUGIN_DIR . $file)) {
            throw new \Exception("Le fichier $path n'existe pas");
        }
    }
    
    /**
     * access
     * Autorise le chargement des styles/script selon la page
     *
     * @param  array $access
     * @return bool
     */
    private function access(array $access): bool
    {
        if (empty($access)) {
            return true;
        }

        if (isset($access['page']) && empty(get_current_screen()->post_type)) {
            return in_array(filter_input(INPUT_GET, 'page'), $access['page']);
        }

        if (isset($access['post_type']) && ! empty(get_current_screen()->post_type)) {
            return in_array(get_post_type(), $access['post_type']);
        }

        return false;
    }
}