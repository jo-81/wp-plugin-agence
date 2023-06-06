<?php

use App\Service\Utils\FormBuilder;
use App\Service\Utils\ArgumentBuilder;

$args = ArgumentBuilder::query([
    'post_type' => 'ag_characteristic',
]);

$categories = get_terms(['taxonomy' => 'ag_category']); 

?>

<input type="hidden" name="ag_property_characteristic">

<section class="flex mt-4" data-tabs>
    <ul class="shrink-0 mr-20">
        <?php foreach($categories as $key => $category) : ?>
            <button 
                type="button" 
                data-tab-url="<?php echo esc_attr($category->slug) ?>" 
                class="nav-item-tab <?php if ($key == 0) : echo 'active-tab'; endif; ?>">
                <?php echo esc_html($category->name) ?>
            </button>
        <?php endforeach; ?>
    </ul>

    <div class="grow">
        <?php foreach($categories as $key => $category) : ?>
            <section 
                data-tab-section="<?php echo esc_attr($category->slug) ?>" 
                class="<?php if ($key != 0) : echo 'hidden'; endif; ?>"
            >
            <?php 
                $characteristics = get_posts([
                    'post_type' => 'ag_characteristic',
                    'tax_query' => [
                        [
                            'taxonomy' => 'ag_category',
                            'terms' => $category->slug,
                            'field' => 'slug',
                        ]
                    ]
                ]);
            ?>

            <?php foreach($characteristics as $characteristic) : 
                $formType = get_post_meta($characteristic->ID, 'ag_characteristic_type', true);
                if ($formType == 'checkbox') {
                    echo FormBuilder::checkbox([
                        'label'     => $characteristic->post_title,
                        'name'      => 'ag_property_characteristic['. $characteristic->post_name .']',
                        'checked'   => plugin_get_post_array_meta($post->ID, 'ag_property_characteristic', $characteristic->post_name, true),
                    ]);
                }
                    
                if ($formType != 'checkbox') {
                    echo FormBuilder::input([
                        'label' => $characteristic->post_title,
                        'type'  => $formType,
                        'name'  => 'ag_property_characteristic['. $characteristic->post_name .']',
                        'value' => plugin_get_post_array_meta($post->ID, 'ag_property_characteristic', $characteristic->post_name, true),
                        'help'  => get_post_meta($characteristic->ID, 'ag_characteristic_unity', true)
                    ]);
                }
            endforeach; ?>
        </section>
        <?php endforeach; ?>
    </div>
</section>
