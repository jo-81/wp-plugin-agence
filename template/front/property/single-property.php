<?php

use App\Service\Utils\MessageService;

    get_header(); 
    
    $price = get_post_meta($post->ID, 'ag_property_price', true);
    $price_month = get_post_meta($post->ID, 'ag_property_mensuel', true);
    $price_week = get_post_meta($post->ID, 'ag_property_week', true);
    $gallery = get_post_meta($post->ID,'ag_property_gallery', true);

    $characteristics = get_posts(['post_type' => 'ag_characteristic']);

    $error_contact = MessageService::get('agence_contact_error');
    $error_contact_fields = MessageService::get('agence_contact_fields_error');

    $values_contact = MessageService::get('agence_contact_fields_values');
?>
    <section class="my-12 grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <div class="col-span-1 lg:col-span-2">
            <header>
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="post-thumbnail w-full">
                        <?php echo get_the_post_thumbnail( get_the_ID(), 'large', ['class' => 'w-full'] ); ?>
                    </div>
                <?php endif; ?>
            </header>

            <div class="mt-4">
                <h2 class="ag-single-property-title"><?php the_title(); ?></h2>
                <?php the_content(); ?>
            </div>

            <div class="mt-4 p-3 ag-single-property-characteristics">
                <h3 class="text-lg"><?php echo __('Caractéristiques', 'agence'); ?></h3>

                <div>
                    <p class="mb-1 flex items-center">
                        <span class="w-1/3 font-bold"><?php echo __('Disponible', 'agence'); ?></span>
                        <span class="w-2/3"><?php echo get_post_meta($post->ID, 'ag_property_disponible', true) == 'on' ? 'Oui' : 'Non'; ?></span>
                    </p>
                    <?php if ($price = get_post_meta($post->ID, 'ag_property_price', true)) : ?>
                        <p class="mb-1 flex items-center">
                            <span class="w-1/3 font-bold"><?php echo __('Prix', 'agence'); ?></span>
                            <span class="w-2/3">
                                <?php echo esc_html($price); ?> €

                                <?php if (get_post_meta($post->ID, 'ag_property_price_mensuel', true)) : echo __('au mois', 'agence'); endif ?>
                                <?php if (get_post_meta($post->ID, 'ag_property_price_week', true)) : echo __('à la semaine', 'agence'); endif ?>
                            </span>
                        </p>
                    <?php endif; ?>
                    <?php 
                        foreach($characteristics as $characteristic) : 
                            $value = plugin_get_post_array_meta($post->ID, 'ag_property_characteristic', $characteristic->post_name, true);
                            $value_unity = get_post_meta($characteristic->ID, 'ag_characteristic_unity', true);
                            if ($value) :
                    ?>
                                <p class="mb-1 flex items-center">
                                    <span class="w-1/3 font-bold"><?php echo $characteristic->post_title ?></span> 
                                    <span class="w-2/3"><?php echo $value; ?>
                                    <?php if ($value_unity) : echo $value_unity; endif; ?></span>
                                </p>
                    <?php 
                            endif;
                        endforeach 
                    ?>
                </div>

            </div>

            <?php if ($gallery) : ?>
                <div class="mt-4">
                    <div class="container-gallery relative">
                        <?php foreach(array_keys($gallery) as $key => $image) : ?>
                            <div class="slide <?php if ($key == 0) : echo 'show'; endif; ?>">
                                <div class="numbertext absolute top-4 left-4 bg-white px-3 rounded-sm"><?php echo ($key + 1) ?> / <?php echo count($gallery); ?></div>
                                <img src="<?php echo wp_get_attachment_url($image) ?>" class="w-full">
                            </div>
                        <?php endforeach; ?>

                        <div class="controllers">
                            <button id="prev">
                                <span class="dashicons dashicons-arrow-left-alt2 text-white"></span>
                            </button>
                            <button id="next">
                                <span class="dashicons dashicons-arrow-right-alt2 text-white"></span>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <aside class="col-span-1 relative">
            <form class="shadow-sm p-4 grid gap-3 sticky top-8" method="POST">

                <?php if ($error_contact) : ?>
                    <div class="ag-alert ag-alert-danger flex justify-between items-center">
                        <p><?php echo esc_html($error_contact['message']); ?></p>
                        <span id="close-alert" class="dashicons dashicons-no-alt cursor-pointer"></span>
                    </div>
                <?php endif; ?>

                <p class="mb-0 font-bold text-lg">Ce bien vous intéresse ?</p>

                <input type="hidden" name="property_id" value="<?php echo esc_attr($post->ID) ?>">

                <div>
                    <label class="block font-bold" for="lastname"><?php _e('Nom', 'agence'); ?></label>
                    <input 
                        text="text" 
                        required
                        value="<?php echo esc_attr($values_contact['message']['lastname'] ?? '') ?>"
                        name="lastname" 
                        class="border w-full p-2">
                    <?php if ($error_contact_fields && isset($error_contact_fields['message']['lastname'])) : ?>
                        <?php foreach($error_contact_fields['message']['lastname'] as $error) : ?>
                            <span class="text-danger"><?php echo esc_html($error) ?></span>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <div>
                    <label class="block font-bold" for="firstname"><?php _e('Prénom', 'agence'); ?></label>
                    <input 
                        text="text"
                        required
                        value="<?php echo esc_attr($values_contact['message']['firstname'] ?? '') ?>"
                        name="firstname" 
                        class="border w-full p-2">
                    <?php if ($error_contact_fields && isset($error_contact_fields['message']['firstname'])) : ?>
                        <?php foreach($error_contact_fields['message']['firstname'] as $error) : ?>
                            <span class="text-danger"><?php echo esc_html($error) ?></span>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <div>
                    <label class="block font-bold" for="email"><?php _e('Adresse email', 'agence'); ?></label>
                    <input 
                        required
                        text="email" 
                        name="email" 
                        value="<?php echo esc_attr($values_contact['message']['email'] ?? '') ?>"
                        class="border w-full p-2">
                    <?php if ($error_contact_fields && isset($error_contact_fields['message']['email'])) : ?>
                        <?php foreach($error_contact_fields['message']['email'] as $error) : ?>
                            <span class="text-danger"><?php echo esc_html($error) ?></span>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <div>
                    <label class="block font-bold" for="message"><?php _e('Message', 'agence'); ?></label>
                    <textarea 
                        rows="4" 
                        required
                        name="message" 
                        class="border w-full p-2"><?php echo esc_html($values_contact['message']['message'] ?? '') ?></textarea>
                    <?php if ($error_contact_fields && isset($error_contact_fields['message']['message'])) : ?>
                        <?php foreach($error_contact_fields['message']['message'] as $error) : ?>
                            <span class="text-danger"><?php echo esc_html($error) ?></span>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <?php wp_nonce_field("agence_property_contact_action",  "agence_property_contact_field"); ?>

                <div>
                    <button type="submit" class="btn btn-primary btn-sm">Envoyer</button>
                </div>
            </form>
        </aside>
    </section>
<?php get_footer(); 