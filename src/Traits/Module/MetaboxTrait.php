<?php

namespace App\Traits\Module;

if (! defined('ABSPATH')) {
    exit;
}

trait MetaboxTrait
{
    private array $metaBoxes = [];

    /**
     * addMetaBox
     * Ajoute les données des méta boxes
     *
     * @param  array $datas
     * @return self
     */
    public function addMetaBox(array $datas): self
    {
        $this->metaBoxes[] = $datas;
        return $this;
    }

    /**
     * registerMetaBoxes
     * Ajoute les métaboxes
     *
     * @return void
     */
    public function registerMetaBoxes()
    {
        foreach ($this->metaBoxes as $metaBox) {
            add_meta_box(
                $metaBox['id'],
                $metaBox['title'],
                $metaBox['callback'],
                $metaBox['screen'] ?? null,
                $metaBox['context'] ?? 'advanced',
                $metaBox['priority'] ?? 'default',
                $metaBox['callback_args'] ?? null,
            );
        }
    }
    
    /**
     * saveDatasMetaBox
     *
     * @param  string $post_id
     * @param  string $field
     * @param  mixed $datas
     * @return void
     */
    public function saveDatasMetaBox(string $post_id, string $field, mixed $datas): void
    {
        if (get_post_meta($post_id, $field)) {
            update_post_meta($post_id, $field, $datas);
        } else {
            add_post_meta($post_id, $field, $datas);
        }
    }

    /**
     * verifyNonceMetaBox
     * Vérifie que le formulaire est bien soumis + sécurité
     *
     * @param  string $action
     * @param  string $field
     * @return bool
     */
    public function verifyNonceMetaBox(\WP_POST $post, string $post_type): bool
    {
        if ($post->post_type != $post_type || defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return false;
        }

        return true;
    }

    public function removeBoxes(array ...$datas)
    {
        foreach($datas as $data) {
            extract($data);
            remove_meta_box($id, $screen, $context);
        }
    }
}