<?php

namespace App\Service\Front\PostType;

if (! defined('ABSPATH')) {
    exit;
}

abstract class AbstractContentService
{
    protected string $postType;

    abstract function getTemplate(): string;
    abstract function getArchiveTemplate(): string;
    abstract function orderRenderTemplate(): array;

    public function render(string $template): string
    {
        if ( is_singular( $this->postType ) ) {
            return $this->getTemplate();
        }

        return $template;
    }

    public function renderTemplateArchive(string $template)
    {
        if ( is_post_type_archive ( $this->postType ) ) {
            return $this->getArchiveTemplate();
        }

        return $template;
    }

    public function includeTemplate(): string
    {
        $html = '';
        ob_start();
        foreach($this->orderRenderTemplate() as $template) {
            include $this->getTemplate() . $template;
            $html .= ob_get_contents();
            ob_clean();
        }
        return $html;
    }
}