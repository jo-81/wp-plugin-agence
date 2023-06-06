<?php

namespace App\Service\Filter;

if (! defined('ABSPATH')) {
    exit;
}

final class CharacteristicFilterService extends AbstractFilterService 
{    
    public function setPostType(): self
    {
        $this->postType = 'ag_characteristic';
        
        return $this;
    }
    
    public function getTaxonomies(): array
    {
        return ['ag_category'];
    }
}