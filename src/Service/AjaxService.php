<?php

namespace App\Service;

if (! defined('ABSPATH')) {
    exit;
}

final class AjaxService
{
    /**
     * getAdress
     * Récupère les information depuis l'API Adresse
     *
     * @return void
     */
    public function getAdress()
    {
        check_ajax_referer('agence_ajax_adress', 'nonce');
        if (! isset($_POST['action'], $_POST['search']) && filter_input(INPUT_POST, 'action') != 'get_request_adress') {
            return;
        }

        $request = new \WP_Http;
        $adress = $request->request("https://api-adresse.data.gouv.fr/search/?q=" . sanitize_text_field($_POST['search']));
        if (is_wp_error($adress) || $adress['response']['code'] != \WP_Http::OK) {
            wp_send_json_error("Aucune adresse de trouvé");
        }

        $results = [];
        foreach(json_decode($adress['body'])->features as $key => $query) {
            $results[$key]['coordonnes'] = $query->geometry->coordinates;
            $results[$key]['label'] = $query->properties->label;
        }

        wp_send_json_success($results);
    }
}