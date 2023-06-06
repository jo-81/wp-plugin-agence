<?php

namespace App\Service;

use App\Service\Utils\MessageService;

if (! defined('ABSPATH')) {
    exit;
}

final class ContactService
{
    public function sendPropertyEmail()
    {
        if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') == "POST") {

            $redirect = filter_input(INPUT_POST, '_wp_http_referer');
            if (filter_input(INPUT_POST, 'agence_property_contact_field') == null) {
                return;
            }

            $nonce = wp_verify_nonce(filter_input(INPUT_POST, 'agence_property_contact_field'), 'agence_property_contact_action');
            if (! $nonce) {
                wp_safe_redirect($redirect);
                exit;
            }

            // Si property_id est bien une propriété
            $property_id = filter_input(INPUT_POST, 'property_id');
            if (! get_post($property_id) instanceof \WP_Post) {
                MessageService::add('agence_contact_error', ['type' => 'error', 'message' => 'Un problème est survenue']);
                wp_safe_redirect($redirect);
                exit;
            }

            // Gestion des erreurs
            $errors = [];
            $lastname = filter_input(INPUT_POST, 'lastname');
            $firstname = filter_input(INPUT_POST, 'firstname');
            $email = filter_input(INPUT_POST, 'email');
            $message = filter_input(INPUT_POST, 'message');

            foreach(['lastname', 'firstname', 'email', 'message'] as $field) {
                if (empty($$field)) {
                    $errors[$field] = ["Ce champ ne peut pas être vide"];
                }
            }

            if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = ['Cette adresse email n\'est pas valide'];
            }

            if (! empty($errors)) {
                MessageService::add('agence_contact_fields_error', ['type' => 'error', 'message' => $errors]);
                MessageService::add('agence_contact_fields_values', ['type' => 'success', 'message' => [
                    'lastname' => $lastname,
                    'firstname' => $firstname,
                    'email' => $email,
                    'message' => $message,
                ]]);
                wp_safe_redirect($redirect);
                exit;
            }

            $isSend = wp_mail($email, "Propriété $property_id", $message);
            if (! $isSend) {
                $is_send_message = "Votre message n'a pas pu être envoyé.";
            } else {
                $is_send_message = "Votre message a bien été envoyé.";
            }

            MessageService::add('agence_contact_error', ['type' => 'error', 'message' => $is_send_message]);
            wp_safe_redirect($redirect);
            exit;
        }
    }

    
}