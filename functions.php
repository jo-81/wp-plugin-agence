<?php

if (! function_exists('plugin_get_post_array_meta')):    
    /**
     * plugin_get_post_array_meta
     * Récupère une valeur contenue dans un tableau de post meta
     *
     * @param  int $id
     * @param  string $key
     * @param  string $value
     * @param  bool $single
     * @return array|string
     */
    function plugin_get_post_array_meta(int $id, string $key, string $value, bool $single = false): array|string
    {
        $datas = get_post_meta($id, $key, $single);
        if (! is_array($datas)) {
            return '';
        }

        if (array_key_exists($value, $datas)) {
            return $datas[$value];
        }

        return '';
    }
endif;

if (! function_exists('plugin_get_taxonomies')):    
    /**
     * plugin_get_taxonomies
     * Retourne la liste des taxonomies
     *
     * @param  \WP_Post $post
     * @param  string $taxonomy
     * @param  string $order
     * @return array
     */
    function plugin_get_taxonomies(\WP_Post $post, string $taxonomy, string $order = 'ASC'): array
    {
        if (! taxonomy_exists($taxonomy) || is_null($post)) {
            return [];
        }
        $terms = get_the_terms($post, $taxonomy);
        return (!$terms || $terms instanceof \WP_Error) ? [] : wp_list_sort($terms, 'slug', $order);
    }
endif;

if (! function_exists('plugin_get_taxonomy')):    
    /**
     * plugin_get_taxonomy
     *
     * @param  \WP_Post $post
     * @param  string $taxonomy
     * @param  string $field
     * @param  string $order
     * @return mixed
     */
    function plugin_get_taxonomy(\WP_Post $post, string $taxonomy, ?string $field = null)
    {
        $taxonomies = plugin_get_taxonomies($post, $taxonomy);
        if (is_null($field)) {
            return isset($taxonomies[0]) ? $taxonomies[0] : null;
        }

        return isset($taxonomies[0]) ? $taxonomies[0]->$field : null;
    }
endif;

if (! function_exists('plugin_get_input_var')): 
    function plugin_get_input_var(string $type, string $key, mixed $default): mixed
    {
        if (is_null(filter_input($type, $key))) {
            return $default;
        }

        return filter_input($type, $key);
    }
endif;

if (! function_exists('plugin_get_post_type_by')): 
    function plugin_get_post_type_by(string $post_type, string $value, string $field = 'slug'): ?\WP_Post
    {
        $args = [
            'post_type' => $post_type,
        ];

        if ($field == 'slug') {
            $args = wp_parse_args($args, ['name' => $value]);
        } elseif ($field == 'title'){
            $args = wp_parse_args($args, ['title' => $value]);
        }

        $posts = get_posts($args);
        if (! empty($posts)) {
            return $posts[0];
        }

        return null;
    }
endif;