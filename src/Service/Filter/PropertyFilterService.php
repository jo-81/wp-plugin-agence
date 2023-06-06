<?php

namespace App\Service\Filter;

if (! defined('ABSPATH')) {
    exit;
}

final class PropertyFilterService extends AbstractFilterService 
{    
    public function setPostType(): self
    {
        $this->postType = 'ag_property';
        
        return $this;
    }
    
    public function getTaxonomies(): array
    {
        return ['ag_type', 'ag_mode'];
    }
}