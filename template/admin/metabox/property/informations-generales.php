<?php use App\Service\Utils\FormBuilder; ?>

<section class="form-section">
    <?php echo FormBuilder::input([
        'label' => __('Référence', 'agence'),
        'name'  => 'ag_property_ref',
        'value' => get_post_meta($post->ID, 'ag_property_ref', true)
    ]); ?>
</section>

<?php if (taxonomy_exists('ag_type')) : ?>
    <section class="form-section">
        <?php echo FormBuilder::selectTaxonomy([
            'label'             => 'Choisir un type de propriété',
            'taxonomy'          => 'ag_type',
            'name'              => 'tax_input[ag_type][]',
            'show_option_all'   => __('Toutes les catégories', 'agence'),
            'selected'          => plugin_get_taxonomy($post, 'ag_type', 'term_id'),
        ]); ?>
    </section>
<?php endif; ?>

<?php if (taxonomy_exists('ag_mode')) : ?>
    <section class="form-section">
        <?php echo FormBuilder::selectTaxonomy([
            'label'             => 'Choisir un mode',
            'taxonomy'          => 'ag_mode',
            'name'              => 'tax_input[ag_mode][]',
            'show_option_all'   => __('Toutes les catégories', 'agence'),
            'selected'          => plugin_get_taxonomy($post, 'ag_mode', 'term_id'),
        ]); ?>
    </section>
<?php endif; ?>

<section class="form-section">
    <?php echo FormBuilder::checkbox([
        'label' => __('Disponible ?', 'agence'),
        'name'  => 'ag_property_disponible',
        'checked' => get_post_meta($post->ID, 'ag_property_disponible', true)
    ], false); ?>
</section>

<section class="form-section">
    <?php echo FormBuilder::checkbox([
        'label' => __('Exclusivité', 'agence'),
        'name'  => 'ag_property_exclu',
        'checked' => get_post_meta($post->ID, 'ag_property_exclu', true)
    ]); ?>
</section>

<section class="form-section">
    <?php echo FormBuilder::checkbox([
        'label' => __('Afficher cette propriété', 'agence'),
        'name'  => 'ag_property_show',
        'checked' => get_post_meta($post->ID, 'ag_property_show', true)
    ]); ?>
</section>