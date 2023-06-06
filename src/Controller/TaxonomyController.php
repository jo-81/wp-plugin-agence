<?php

namespace App\Controller;

use App\Service\Taxonomy\ModeTaxonomyService;
use App\Service\Taxonomy\TypeTaxonomyService;
use App\Service\Taxonomy\CategoryTaxonomyService;

if (! defined('ABSPATH')) {
    exit;
}

final class TaxonomyController
{
    public function __invoke()
    {
        $typeTaxonomy = new TypeTaxonomyService;
        add_action('init', [$typeTaxonomy, 'addTaxonomy']);

        $categoryTaxonomy = new CategoryTaxonomyService;
        add_action('init', [$categoryTaxonomy, 'addTaxonomy']);

        $modeTaxonomy = new ModeTaxonomyService;
        add_action('init', [$modeTaxonomy, 'addTaxonomy']);
    }
}