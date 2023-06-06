<div class="form-section">
    <div class="form-field">
        <label class="form-label" for="ag_property_adress">Adresse</label>
        <input 
            name="ag_property_adress" 
            id="ag_property_adress"
            style="width: 100% !important"
            data-adresse 
            value="<?php echo esc_attr(get_post_meta($post->ID, 'ag_property_adress', true)) ?>" 
            type="text"/>
    </div>
    <div id="js-result-adress"></div>
</div>