<?php use App\Service\Utils\FormBuilder; ?>

<?php if (taxonomy_exists('ag_type')) : ?>
    <section class="form-section">
        <?php echo FormBuilder::selectTaxonomy([
            'label'             => 'Choisir une catégorie',
            'taxonomy'          => 'ag_category',
            'name'              => 'tax_input[ag_category][]',
            'show_option_all'   => __('Toutes les catégories', 'agence'),
            'selected'          => plugin_get_taxonomy($post, 'ag_category', 'term_id'),
        ]); ?>
    </section>
<?php endif; ?>

<section class="form-section">
    <?php echo FormBuilder::input([
        'label' => 'Unité',
        'name'  => 'ag_characteristic_unity',
        'value' => get_post_meta($post->ID, 'ag_characteristic_unity', true),
    ]); ?>
</section>

<section class="form-section">
    <?php echo FormBuilder::select(
        [
            'label' => 'Type',
            'name'  => 'ag_characteristic_type',
            'selected' => get_post_meta($post->ID, 'ag_characteristic_type', true),
        ], [
            'number'    => 'Nombre',
            'text'      => 'Texte',
            'checkbox'  => 'Choix'
        ]
    ); ?>
</section>
