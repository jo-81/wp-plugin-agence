<section class="py-4">

    <input type="hidden" name="ag_property_gallery">

    <button 
        type="button" 
        class="btn btn-primary" 
        data-add-picture><?php _e('Sélectionner des images', 'agence'); ?></button>

    <div data-gallery class="my-4 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 xxl:grid-cols-4 gap-2">
        <?php 
            $gallery_ids = get_post_meta($post->ID,'ag_property_gallery', true);
            if (! empty($gallery_ids)) : 
                foreach (array_keys($gallery_ids) as $key) :
                ?>
                    <div class="card-picture aspect-video">
                        <img class="w-full" src="<?php echo wp_get_attachment_url($key) ?>"/>
                        <input type="hidden" name="ag_property_gallery[<?php echo esc_attr($key) ?>]">
                        <button 
                            type="button" 
                            class="absolute bg-red-700 top-2 right-2 rounded-full p-2 text-white" 
                            data-remove-picture>
                            <span class="dashicons dashicons-no-alt"></span>
                        </button>
                    </div>
                <?php 
                endforeach;
            endif;
        ?>
    </div>

</section>

<template id="gallery">
    <div class="card-picture aspect-video">
        <img  class="w-full" />
        <input type="hidden">
        <button 
            type="button" 
            class="absolute bg-red-700 top-2 right-2 rounded-full p-2 text-white" 
            data-remove-picture>
            <span class="dashicons dashicons-no-alt"></span>
        </button>
    </div>
</template>