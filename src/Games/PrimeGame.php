<?php

namespace BrainGames\Games\EvenGame;

use const BrainGames\Utils\ModuleUtils\HANDLER_QUESTION;
use const BrainGames\Utils\ModuleUtils\LOCATION_HANDLERS;
use const BrainGames\Utils\ModuleUtils\LOCATION_SETTINGS;
use const BrainGames\Utils\ModuleUtils\SETTING_RULES;

return static function ($module) {
    $module[LOCATION_SETTINGS][SETTING_RULES] = 'Answer "yes" if given number is prime. Otherwise answer "no".';

    $module[LOCATION_HANDLERS][HANDLER_QUESTION] = function () {
        $isPrime = function ($number) {
            if ($number <= 1) {
                return false;
            }

            for ($i = 2; $i * $i <= $number; $i++) {
                if ($number % $i === 0) {
                    return false;
                }
            }

            return true;
        };


        $question = random_int(1, 100);
        $isPrime = $isPrime($question);
        return [$question, $isPrime ? 'yes' : 'no'];
    };

    return $module;
};
