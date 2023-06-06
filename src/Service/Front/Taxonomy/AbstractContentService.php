<?php

namespace App\Service\Front\Taxonomy;

if (! defined('ABSPATH')) {
    exit;
}

abstract class AbstractContentService
{
    protected string $taxonomy;

    abstract function getArchiveTemplate(): string;

    public function renderTemplateArchive(string $template): string
    {
        if (is_tax($this->taxonomy)) {
            return $this->getArchiveTemplate();
        }

        return $template;
    }
}