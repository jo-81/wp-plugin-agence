<?php

namespace App\Service\Column;

use App\Traits\Module\ColumnTrait;

if (! defined('ABSPATH')) {
    exit;
}

abstract class AbstractAdminColumnService
{
    use ColumnTrait;

    protected ?string $postType = null;
    
    /**
     * setPostType
     * Retourne le type du custom post type
     *
     * @return self
     */
    abstract public function setPostType(): self;

        
    /**
     * listColumns
     * Liste les différents colonnes
     *
     * @return array
     */
    abstract public function listColumns(): array;

    public function listRemoveColumns(): array
    {
        return ['date'];
    }

        
    /**
     * listValuesColumns
     * Liste la valeur des colonnes ajoutées
     * 
     * @param  int $id
     * @return array
     */
    abstract public function listValuesColumns(int $id): array;
    
    /**
     * managementColumns
     *
     * @param  array $columns
     * @return array
     */
    public function managementColumns(array $columns): array
    {
        return $this->listColumns();
    }
    
    /**
     * managementValuesColumns
     *
     * @param  string $column
     * @param  string $post_id
     * @return void
     */
    public function managementValuesColumns(string $column, string $post_id): void
    {
        $values = $this->listValuesColumns($post_id);
        foreach($values as $key => $value) {
            if ($column == $key) {
                echo esc_html($value);
            }
        }
    }
}