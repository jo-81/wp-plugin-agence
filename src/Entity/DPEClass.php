<?php

namespace App\Entity;

if (! defined('ABSPATH')) {
    exit;
}

final class DPEClass
{
    public static function getLetter(int $consomme)
    {
        switch($consomme) {
            case $consomme <= 51:
                return 'A';
                break;

            case $consomme > 51 && $consomme <= 90:
                return 'B';
                break;

            case $consomme > 91 && $consomme <= 150:
                return 'C';
                break;

            case $consomme > 151 && $consomme <= 230:
                return 'D';
                break;

            case $consomme > 231 && $consomme <= 330:
                return 'E';
                break;

            case $consomme > 331 && $consomme <= 450:
                return 'F';
                break;

            default:
                return 'G';
        }
    }
}