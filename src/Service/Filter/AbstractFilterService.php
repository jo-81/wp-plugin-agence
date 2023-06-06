<?php

namespace App\Service\Filter;

if (! defined('ABSPATH')) {
    exit;
}

abstract class AbstractFilterService
{
    protected string $postType;

    abstract public function setPostType(): self;
    abstract public function getTaxonomies(): array;

    public function __construct()
    {
        $this->setPostType();
    }
    
    /**
     * deleteFilterDate
     *
     * @param  array $query
     * @return aray
     */
    public function deleteFilterDate(array $query): array
    {
        return $this->isPostType() ? [] : $query;
    }
    
    /**
     * addFilterTaxonomies
     *
     * @return void
     */
    public function addFilterTaxonomies(): void
    {
        if (! $this->isPostType()) {
            return;
        }

        foreach($this->getTaxonomies() as $taxonomy) {
            $tax = get_taxonomy($taxonomy);
            if ($tax) {
                $selected = filter_input(INPUT_GET, $taxonomy, FILTER_SANITIZE_SPECIAL_CHARS);
                wp_dropdown_categories([
                    'taxonomy'          => $taxonomy,
                    'selected'          => $selected,
                    'hide_if_empty'     => true,
                    'show_option_all'   => $tax->labels->all_items,
                    'hide_empty'        => false,
                    'name'              => $taxonomy,
                    'value_field'       => 'slug',
                    'orderby'           => 'slug',
                    'order'             => 'DESC',
                ]);
            }
        }
    }
    
    /**
     * isPostType
     *
     * @return bool
     */
    protected function isPostType(): bool
    {
        return filter_input(INPUT_GET, 'post_type') == $this->postType;
    }
}