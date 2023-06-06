<?php

namespace App\Service\Utils;

if (! defined('ABSPATH')) {
    exit;
}

final class FormBuilder
{    
    /**
     * select
     *
     * @param  string $name
     * @param  array $options
     * @return string
     */
    public static function select(array $datas = [], array $options = [], bool $wrapper = true): string
    {
        $defaults = [
            'label'     => '',
            'class'     => 'form-input form-select',
            'selected'  => '',
            'name'      => '',
            'id'        => '',
        ];

        $args = wp_parse_args($datas, $defaults);
        $args['id'] = empty($args['id']) ? $args['name'] : $args['id'];

        $select = "";

        if (! (is_null($args['label']) || empty($args['label']))) {
            $select .= "<label class='form-label' form='". esc_attr($args['name']) ."'>". esc_html($args['label']) ."</label>";
        }

        $select .= "<select class='form-input' name='". esc_attr($args['name']) ."' id='". esc_attr($args['name']) ."'>";
            foreach($options as $key => $option) :
                $select .= "<option ". selected($args['selected'], $key, false) ." value='". esc_attr($key) ."'>". esc_html($option) ."</option>";
            endforeach;
        $select .= "</select>";

        if (!$wrapper) {
            return $select;
        }

        return sprintf(self::generate(), $select);
    }

    public static function checkbox(array $datas = [], bool $wrapper = true)
    {
        $defaults = [
            'label'     => '',
            'class'     => 'form-input',
            'checked'   => '',
            'name'      => '',
            'id'        => '',
            'attr'      => [],
        ];

        $args = wp_parse_args($datas, $defaults);
        $attr = http_build_query($args['attr'], "", " ");
        $args['id'] = empty($args['id']) ? $args['name'] : $args['id'];
        $checked = $args['checked'] == 'on' ? 'checked' : '';

        $input = "";
        $input .= "<input type='hidden' name='". esc_attr($args['name']) ."'>";

        $input .= "<input  type='checkbox' 
                $checked
                $attr
                id='". esc_attr($args['id']) ."'
                name='". esc_attr($args['name']) ."'>";

        $input .= "<label   for='". esc_attr($args['name']) ."' 
                            class=''>". esc_html($args['label']) ."</label>";

        if (!$wrapper) {
            return $input;
        }

        return sprintf(self::generate(), $input);
    }
        
    /**
     * selectTaxonomy
     *
     * @param  array $options
     * @return string
     */
    public static function selectTaxonomy(array $options = [], bool $wrapper = true): string
    {
        $defaults = [
            'label'             => '',
            'order'             => 'ASC',
            'orderby'           => 'slug',
            'hide_empty'        => false,
            'class'             => 'form-input form-select',
            'option_none_value' => 0,
            'echo'              => 0,
            'name'              => 'name',
            'id'                => '',
            'taxonomy'          => 'cat',
            'selected'          => '',
            'show_option_all'   => '',
        ];

        $args = wp_parse_args($options, $defaults);
        $args['id'] = empty($args['id']) ? $args['name'] : $args['id'];

        $select = "";
        if (! (is_null($args['label']) || empty($args['label']))) {
            $select .= "<label class='form-label' form='". esc_attr($args['name']) ."'>". esc_html($args['label']) ."</label>";
        }

        $select .= wp_dropdown_categories($args);

        if (!$wrapper) {
            return $select;
        }

        return sprintf(self::generate(), $select);
    }
    
    /**
     * selectPostType
     *
     * @param  array $options
     * @return string
     */
    public static function selectPostType(array $options = []): string
    {
        $defaults = [
            'label'             => '',
            'order'             => 'ASC',
            'orderby'           => 'name',
            'hide_empty'        => false,
            'class'             => 'form-input',
            'option_none_value' => 0,
            'echo'              => 0,
            'name'              => 'name',
            'post_type'         => '',
            'selected'          => '',
            'show_option_none'  => '',
            'numberposts'       => -1,
        ];

        $args = wp_parse_args($options, $defaults);
        
        $select = "";
        if (! (is_null($args['label']) || empty($args['label']))) {
            $select .= "<label class='form-label' form='". esc_attr($args['name']) ."'>". esc_html($args['label']) ."</label>";
        }
        $select .= wp_dropdown_pages($args);

        return sprintf(self::generate(), $select);
    }
    
    /**
     * input
     *
     * @param  array $options
     * @return string
     */
    public static function input(array $options = [], bool $wrapper = true): string
    {
        $input = "";

        $defaults = [
            'type'  => 'text',
            'value' => '',
            'label' => '',
            'name'  => '',
            'id'    => '',
            'attr'  => [],
            'help'  => '',
        ];

        $args = \wp_parse_args($options, $defaults);
        $attr = http_build_query($args['attr'], "", " ");
        $args['id'] = empty($args['id']) ? $args['name'] : $args['id'];

        if (! empty($args['label'])) :
            $input .= "<label   class='form-label' 
                                for='". esc_attr($args['name']) ."'>". esc_html($args['label']) ."</label>";
        endif;
        
        $input .= "<input   class='form-input' 
                            $attr
                            type='". esc_attr($args['type']) ."' 
                            name='". esc_attr($args['name']) ."' 
                            id='". esc_attr($args['id']) ."' 
                            value='". esc_attr($args['value']) ."'>";

        if (! empty($args['help'])) {
            $input .= "<span class='form-help'>". esc_html($args['help']) ."</span>";
        }

        if (!$wrapper) {
            return $input;
        }

        return sprintf(self::generate(), $input);
    }
    
    /**
     * generate
     *
     * @return string
     */
    private static function generate(): string
    {
        return "<div class='form-control'>%s</div>";
    }
    
    /**
     * checkboxPostType
     *
     * @param  array $datas
     * @return string
     */
    public static function checkboxPostType(array $datas = [])
    {
        $defaults = [
            'label'                 => '',
            'order'                 => 'ASC',
            'orderby'               => 'name',
            'hide_empty'            => false,
            'class'                 => 'form-input',
            'option_none_value'     => 0,
            'echo'                  => 0,
            'id'                    => '',
            'n'                     => '',
            'post_type'             => '',
            'selected'              => [],
            'show_option_all'       => '',
        ];

        $args = wp_parse_args($datas, $defaults);
        $args['id'] = empty($args['id']) ? $args['n'] : $args['id'];
        $items = get_posts($args);

        $html = "";
        $html .= "<input type='hidden' name='". $args['id']. "'>";

        $html .= "<div class='list-checkbox' id='". esc_attr($args['id']) ."'>";
        foreach($items as $item) {
            $cheched = array_key_exists($item->ID, $args['selected']) ? 'checked' : '';
            $html .= "<div>
                <input  type='checkbox' 
                        ". esc_attr($cheched) ."
                        value='". esc_attr($item->ID) ."'
                        name='".esc_attr($args['n'])."[". esc_attr($item->ID) ."]' 
                        id='".esc_attr($args['id'])."[". esc_attr($item->ID) ."]'>
                <label for='".esc_attr($args['id'])."[". esc_attr($item->ID) ."]'>". esc_html($item->post_title) ."</label></div>";
        }
        $html .= "</div>";

        return sprintf(self::generate(), $html);
    }
}