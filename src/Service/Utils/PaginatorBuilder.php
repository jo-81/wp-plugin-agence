<?php

namespace App\Service\Utils;

final class PaginatorBuilder
{
    private array $args = [];

    public function render(): string
    {
        $this->generateArguments();

        $numberPageLink = $this->getNumberPageLink();
        if ($numberPageLink < $this->args['count']) {
            return '';
        }

        $pagination = "<nav class='pagination-nav'>";
        $pagination .= $this->renderNavLinkPrev();
        for($number = 1; $number <= $numberPageLink; $number++) {
            $pagination .= $this->renderNavLink($number);
        }
        $pagination .= $this->renderNavLinkNext();

        $pagination .= "</nav>";
        return $pagination;
    }

    public function addArguments(array $args): self
    {
        $this->args = $args;

        return $this;
    }

    public static function init(array $args): self
    {
        return (new self)->addArguments($args);
    }

    private function generateArguments(): void
    {
        $defaults = [
            'count'             => 0,
            'name_paged'        => 'paged',
            'current_page'      => 1,
            'link'              => '#',
            'posts_per_page'    => 1,
        ];

        $this->args = wp_parse_args($this->args, $defaults);
    }
    
    /**
     * renderNavLink
     *
     * @param  int $number
     * @return string
     */
    private function renderNavLink(int $number): string
    {
        $paginationLink = add_query_arg($this->args['name_paged'], $number, $this->getCurrentUrl());
        $classes = "pagination-nav-link";

        if ($number == $this->args['current_page']) {
            $classes .= " active";
        }

        return '<li class="pagination-nav-item">
            <a class="' . esc_attr($classes) . '" href="' . $paginationLink . '">'. esc_html($number) .'</a>
        </li>';
    }

    private function renderNavLinkPrev()
    {
        $prevPageLink = $this->args['current_page'] - 1;
        if ($prevPageLink == 0) {
            return '';
        }

        $paginationLink = add_query_arg($this->args['name_paged'], $prevPageLink, $this->getCurrentUrl());
        return '<li class="pagination-nav-item">
            <a class="pagination-nav-link" href="' . $paginationLink . '">
                <span class="dashicons dashicons-arrow-left-alt2"></span>
            </a>
        </li>';
    }

    private function renderNavLinkNext()
    {
        $nextPageLink = $this->args['current_page'] + 1;
        if ($nextPageLink == $this->getNumberPageLink() + 1) {
            return '';
        }

        $paginationLink = add_query_arg($this->args['name_paged'], $nextPageLink, $this->getCurrentUrl());
        return '<li class="pagination-nav-item">
            <a class="pagination-nav-link" href="' . $paginationLink . '">
                <span class="dashicons dashicons-arrow-right-alt2"></span>
            </a>
        </li>';
    }
    
    /**
     * getCurrentUrl
     *
     * @return string
     */
    private function getCurrentUrl(): string
    {
        return (empty(filter_input(INPUT_SERVER, 'HTTP')) ? 'http' : 'https') . 
            "://".filter_input(INPUT_SERVER, 'HTTP_HOST')."".filter_input(INPUT_SERVER, 'REQUEST_URI');
    }
    
    /**
     * getNumberPageLink
     * Retourne le nombre de link pour la navigation
     *
     * @return int
     */
    public function getNumberPageLink(): int
    {
        return floor($this->args['count'] / $this->args['posts_per_page']);
    }
}