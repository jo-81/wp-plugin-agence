<?php

namespace App\Service\Column;

use App\Service\Column\AbstractAdminColumnService;

if (! defined('ABSPATH')) {
    exit;
}

final class PropertyAdminColumnService extends AbstractAdminColumnService
{        
    /**
     * setPostType
     *
     * @return self
     */
    public function setPostType(): self
    {
        $this->postType = 'ag_property';

        return $this;
    }


    /**
     * listColumns
     *
     * @return array
     */
    public function listColumns(): array
    {
        return [
            'cb'                    => '<input type="checkbox" />',
            'title'                 => 'Titre',
            'taxonomy-ag_type' => __('Type', 'agence'),
            'taxonomy-ag_mode' => __('Mode', 'agence'),
            'date'                  => 'Date',
        ];
    }
    
    
    /**
     * listValuesColumns
     *
     * @param  int $id
     * @return array
     */
    public function listValuesColumns(int $id): array
    {
        return [];
    }
}
