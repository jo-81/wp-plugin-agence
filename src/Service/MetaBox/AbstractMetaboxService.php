<?php

namespace App\Service\MetaBox;

use App\Metabox\MetaboxInterface;
use App\Traits\Module\MetaboxTrait;

if (! defined('ABSPATH')) {
    exit;
}

abstract class AbstractMetaboxService
{
    use MetaboxTrait;

    /**
     * getPostType
     * Retourne le type de custom post type
     *
     * @return string
     */
    abstract public function getPostType(): string;
    
    /**
     * getMetaboxInterface
     * Retourne la classe qui contenant les différentes metaboxes
     *
     * @return MetaboxInterface
     */
    abstract public function getMetaboxInterface(): MetaboxInterface;

    /**
     * addMetaBoxes
     * Ajoute les différentes metabox
     *
     * @return void
     */
    public function addMetaBoxes(string $post_type, \WP_Post $post): void
    {
        if ($post_type != $this->getPostType()) {
            return;
        }

        foreach ($this->getMetaboxInterface()->getMetaboxes()as $metabox) {
            if (isset($metabox['conditional']) && !$metabox['conditional']($post)) {
                continue;
            }
            $this->addMetaBox($metabox);
        }
    }

    /**
     * register
     * Ajoute les différentes metabox aux custom post type
     *
     * @return void
     */
    public function register(string $post_type, \WP_Post $post): void
    {
        $this->addMetaBoxes($post_type, $post);
        $this->registerMetaBoxes();
    }

    /**
     * saveMetaBox
     * Sauvegarde les différentes valeurs des metaboxes
     *
     * @param  mixed $post_id
     * @return void
     */
    public function saveMetaBox(string $post_id): void
    {
        if (
            (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) ||
            (defined('DOING_AJAX') && DOING_AJAX)
        ) {
            return;
        }

        $post = get_post($post_id);
        if (! $this->verifyNonceMetaBox($post, $this->getPostType())) {
            return;
        }

        foreach ($_POST as $param => $value) {
            if (preg_match("#". str_replace('ag_', '', $this->getPostType()) ."#", $param)) {
                $this->saveDatasMetaBox($post_id, $param, map_deep($value, 'sanitize_text_field'));
            }
        }
    }
}