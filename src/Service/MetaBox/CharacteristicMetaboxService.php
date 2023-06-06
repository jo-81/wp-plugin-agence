<?php

namespace App\Service\MetaBox;


use App\Metabox\MetaboxInterface;
use App\Metabox\CharacteristicMetabox;

if (! defined('ABSPATH')) {
    exit;
}

final class CharacteristicMetaboxService extends AbstractMetaboxService
{
    /**
     * getMetaboxInterface
     *
     * @return MetaboxInterface
     */
    public function getMetaboxInterface(): MetaboxInterface
    {
        return new CharacteristicMetabox;
    }
    
    /**
     * getPostType
     *
     * @return string
     */
    public function getPostType(): string
    {
        return 'ag_characteristic';
    }
}