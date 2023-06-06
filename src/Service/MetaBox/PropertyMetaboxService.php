<?php

namespace App\Service\MetaBox;

use App\MetaBox\PropertyMetabox;
use App\Metabox\MetaboxInterface;

if (! defined('ABSPATH')) {
    exit;
}

final class PropertyMetaboxService extends AbstractMetaboxService
{
    /**
     * getMetaboxInterface
     *
     * @return MetaboxInterface
     */
    public function getMetaboxInterface(): MetaboxInterface
    {
        return new PropertyMetabox;
    }
    
    /**
     * getPostType
     *
     * @return string
     */
    public function getPostType(): string
    {
        return 'ag_property';
    }
}