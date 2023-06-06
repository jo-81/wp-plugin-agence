<?php use App\Service\Utils\FormBuilder; ?>

<section class="form-section">
<?php 
    echo FormBuilder::input([
        'label' => 'Prix',
        'type'  => 'number',
        'name'  => 'ag_property_price',
        'value' => get_post_meta($post->ID, 'ag_property_price', true)
    ]);
?>
</section>

<section class="form-section">
    <?php 
        echo FormBuilder::checkbox([
            'label' => __('Prix mensuel', 'agence'),
            'name'  => 'ag_property_price_mensuel',
            'checked' => get_post_meta($post->ID, 'ag_property_price_mensuel', true)
        ]);
    ?>
</section>

<section class="form-section">
    <?php 
        echo FormBuilder::checkbox([
            'label' => __('Prix semaine', 'agence'),
            'name'  => 'ag_property_price_week',
            'checked' => get_post_meta($post->ID, 'ag_property_price_week', true)
        ]);
    ?>
</section>