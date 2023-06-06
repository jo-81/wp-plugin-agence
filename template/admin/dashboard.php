<?php 
    use App\Service\Utils\PaginatorBuilder;
    $posts_per_page = 10;
?>

<section class="container mt-6">
    <header class="mb-4">
        <h2 class="text-2xl font-bold uppercase">Agence</h2>
    </header>

    <!-- Statistiques des propriétés -->
    <section id="" class="section">
        <header class="mb-4">
            <h3 class="text-xl font-bold">Vos propriétés</h3>
        </header>

        <section class="grid gap-2">
            <div class="border rounded-md bg-white p-4 mb-2 font-bold flex flex-wrap items-center">
                <p class="w-full md:w-1/6"><?php _e('Propriété', 'agence'); ?></p>
                <p class="w-full sm:w-1/2 md:w-1/6"><?php _e('Mode', 'agence'); ?></p>
                <p class="w-full sm:w-1/2 md:w-1/6"><?php _e('Type', 'agence'); ?></p>
                <p class="w-full sm:w-1/2 md:w-1/6"><?php _e('Disponible', 'agence'); ?></p>
                <p class="w-full sm:w-1/2 md:w-1/6"><?php _e('Afficher', 'agence'); ?></p>
                <p class="w-full md:w-1/6"></p>
            </div>
            <?php 
                $properties = get_posts([
                    'post_type'         => 'ag_property',
                    'posts_per_page'    => $posts_per_page,
                    'paged'             => plugin_get_input_var(INPUT_GET, 'paged', 1),
                ]);
                if (! empty($properties)) :
                    foreach($properties as $property) : ?>
                        <div class="border rounded-md bg-white p-4 flex flex-wrap items-center">
                            <p class="w-full md:w-1/6"><?php echo esc_html($property->post_title); ?></p>
                            <p class="w-full sm:w-1/2 md:w-1/6"><?php echo plugin_get_taxonomy($property, 'ag_mode', 'name'); ?></p>
                            <p class="w-full sm:w-1/2 md:w-1/6"><?php echo plugin_get_taxonomy($property, 'ag_type', 'name'); ?></p>
                            <p class="w-full sm:w-1/2 md:w-1/6">
                                <?php 
                                    $disponible = get_post_meta($property->ID, 'ag_property_disponible', true); 
                                    if ($disponible == 'on') {
                                        echo '<span class="dashicons dashicons-yes text-success"></span>';
                                    } else {
                                        echo '<span class="dashicons dashicons-no-alt text-danger"></span>';
                                    }
                                ?>
                            </p>
                            <p class="w-full sm:w-1/2 md:w-1/6">
                                <?php 
                                    $show = get_post_meta($property->ID, 'ag_property_show', true); 
                                    if ($show == 'on') {
                                        echo '<span class="dashicons dashicons-yes text-success"></span>';
                                    } else {
                                        echo '<span class="dashicons dashicons-no-alt text-danger"></span>';
                                    }
                                ?>
                            </p>
                            <p class="w-full mt-2 md:mt-0 md:w-1/6 md:text-right">
                                <a class="btn btn-primary hover:text-white" href="<?php echo get_edit_post_link($property); ?>">Consulter</a>
                            </p>
                        </div>
                    <?php endforeach;
                endif;
            ?>

            <div>
                <?php 
                    $pagination =  PaginatorBuilder::init([
                        'count'             => wp_count_posts('ag_property')->publish,
                        'posts_per_page'    => $posts_per_page,
                        'current_page'      => plugin_get_input_var(INPUT_GET, 'paged', 1),
                    ]); 
                    echo $pagination->render();
                ?>

            </div>

        </section>
    </section>
    <!-- Statistiques des propriétés -->

</section>