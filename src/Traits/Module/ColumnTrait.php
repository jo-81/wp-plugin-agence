<?php

namespace App\Traits\Module;

if (! defined('ABSPATH')) {
    exit;
}

trait ColumnTrait
{
    /**
     * addColumns
     * Ajoute des colonnes dans la liste d'un post / custom post type
     *
     * @param  array $datas
     * @return array
     */
    public function addColumns(array $datas): array
    {
        return $datas;
    }
    
    /**
     * removeColumns
     *
     * @param  array $columns
     * @param  array $excludes
     * @return array
     */
    public function removeColumns(array $columns, array $excludes = []): array
    {
        return array_diff($columns, $excludes);
    }
}