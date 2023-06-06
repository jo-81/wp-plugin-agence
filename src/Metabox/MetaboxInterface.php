<?php

namespace App\Metabox;

if (! defined('ABSPATH')) {
    exit;
}

interface MetaboxInterface 
{
    public function getMetaboxes(): array;
}