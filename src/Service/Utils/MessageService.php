<?php

namespace App\Service\Utils;

if (! defined('ABSPATH')) {
    exit;
}

/**
 * MessageService
 * Permet la gestion des message flash
 */
final class MessageService
{        
    /**
     * add
     *
     * @param  string $name
     * @param  array $datas
     */
    public static function add(string $name, array $datas)
    {
        if (empty($name) || get_option($name)) {
            return;
        }

        if (! isset($datas['message'])) {
            throw new \Exception("La clé message est manquante");
        }

        if (! isset($datas['type'])) {
            $datas['type'] = 'success';
        }

        add_option($name, $datas);
    }
        
    /**
     * get
     *
     * @param  string $name
     */
    public static function get(string $name)
    {
        $message = get_option($name);
        delete_option($name);
        return $message;
    }
}