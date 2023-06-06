<?php 
use App\Entity\DPEClass;
use App\Entity\GESClass;
use App\Service\Utils\FormBuilder; 

?>
<section class="form-section">
    <?php $dpe = get_post_meta($post->ID, 'ag_property_dpeclass', true); ?>

    <div>
        <?php 
            echo FormBuilder::input([
                'label' => 'Consommation énergétique',
                'type'  => 'number',
                'name'  => 'ag_property_dpeclass',
                'value' => $dpe,
                'help'  => '( kWh/m².an )'
            ]); 


            if (! empty($dpe)) {
                echo "<div class='mt-2'>
                    <p>DPE classe : <span class='font-bold'>". DPEClass::getLetter($dpe) ."</span></p>
                </div>";
            }
        ?>
    </div>
</section>

<section class="form-section">
    <div>
        <?php
            $ges = get_post_meta($post->ID, 'ag_property_gesclass', true);
            echo FormBuilder::input([
                'label' => 'Emission de gaz',
                'type'  => 'number',
                'name'  => 'ag_property_gesclass',
                'value' => $ges,
                'help'  => 'kgeqCO2/m².an'
            ]); 


            if (! empty($ges)) {
                echo "<div class='mt-2'>
                    <p>GES classe : <span class='font-bold'>". GESClass::getLetter($ges) ."</span></p>
                </div>";
            }
        ?>
    </div>
</section>