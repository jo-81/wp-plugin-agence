<?php

namespace App\Entity;

if (! defined('ABSPATH')) {
    exit;
}

final class GESClass
{
    public static function getLetter(int $consomme)
    {
        switch($consomme) {
            case $consomme <= 5:
                return 'A';
                break;

            case $consomme > 6 && $consomme <= 10:
                return 'B';
                break;

            case $consomme > 11 && $consomme <= 20:
                return 'C';
                break;

            case $consomme > 21 && $consomme <= 35:
                return 'D';
                break;

            case $consomme > 36 && $consomme <= 55:
                return 'E';
                break;

            case $consomme > 56 && $consomme <= 80:
                return 'F';
                break;

            default:
                return 'G';
        }
    }
}