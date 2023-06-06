<?php 

    $mode = $args['mode'];
    $number = $args['number'];
    $order = $args['order'];

    $argumenents = [
        'post_type'     => 'ag_property',
        'numberposts'   => $number ?? -1,
        'order'         => 'DESC',
        'orderby'       => $order ?? 'name',
    ];

    if (! is_null($mode)) {
        $argumenents = wp_parse_args($argumenents, [
            'tax_query'     => [
                [
                    'taxonomy'  => 'ag_mode',
                    'terms'     => $mode,
                    'field'     => 'name',
                ]
            ]
        ]);
    }

    $properties = get_posts($argumenents);
?>

<section class="my-5">

    <?php if ($args['title']) : ?>
        <header class="mb-6">
            <h2 class="text-4xl ag-page-title"><?php echo esc_html($args['title']); ?></h2>
        </header>
    <?php endif; ?>

    <!-- Liste des propriétés -->
    <div class="md:masonry-2-col lg:masonry-3-col box-border mx-auto before:box-inherit after:box-inherit">
        <?php foreach($properties as $property) : ?>
            <article id="<?php echo esc_attr($property->ID) ?>" class="break-inside shadow-sm mb-3 hover:shadow transition-shadow duration-200">
                <?php if (has_post_thumbnail($property)) : ?>
                    <header class="relative">
                        <div class="post-thumbnail img-fluid"><?php echo get_the_post_thumbnail($property->ID, 'large'); ?></div>
                        <?php if (! $mode) : ?>
                            <p class="absolute top-4 right-4 ag-card-badge"><?php echo plugin_get_taxonomy($property, 'ag_mode', 'name'); ?></p>
                        <?php endif; ?>
                    </header>
                <?php endif; ?>

                <div class="p-4">
                    <h2 class="ag-card-title text-lg">
                        <?php echo esc_html($property->post_title); ?>
                    </h2>
                    <a class="ag-card-link" href="<?php echo get_the_permalink($property) ?>">Découvrir</a>
                </div>

                <footer class="p-4 flex gap-3 border-t">
                    <?php 
                        $bedrooms = plugin_get_post_array_meta($property->ID, 'ag_property_characteristic', 'chambres', true);
                        $bathrooms = plugin_get_post_array_meta($property->ID, 'ag_property_characteristic', 'salle-de-bain', true);
                        $surface = plugin_get_post_array_meta($property->ID, 'ag_property_characteristic', 'surface', true);
                        $number_people = plugin_get_post_array_meta($property->ID, 'ag_property_characteristic', 'nombre-de-place', true);
                    ?>

                    <?php if (! empty($bedrooms)) : ?>
                        <p class="mb-0" title="Chambres">
                            <i class="fa-solid fa-bed"></i> <?php echo esc_html($bedrooms); ?>
                        </p>
                    <?php endif; ?>

                    <?php if (! empty($bathrooms)) : ?>
                        <p class="mb-0" title="Salle de bain">
                            <i class="fa-solid fa-bath"></i> <?php echo esc_html($bathrooms); ?>
                        </p>
                    <?php endif; ?>

                    <?php 
                        if (! empty($surface)) : 
                            $surface_post_type = plugin_get_post_type_by('ag_characteristic', 'surface');
                            $surface_unity = get_post_meta($surface_post_type->ID, 'ag_characteristic_unity', true);
                    ?>
                            <p class="mb-0" title="Surface">
                                <i class="fa-solid fa-expand"></i> <?php echo esc_html($surface); ?>
                                <?php if ($surface_unity) : echo $surface_unity; endif; ?>
                            </p>
                    <?php endif; ?>

                    <?php if (! empty($number_people)) : ?>
                        <p class="mb-0" title="nombre de place">
                            <i class="fa-solid fa-people-roof"></i> <?php echo esc_html($number_people); ?>
                        </p>
                    <?php endif; ?>

                </footer>
            </article>
        <?php endforeach; ?>
    </div>
    <!-- Liste des propriétés -->

</section>