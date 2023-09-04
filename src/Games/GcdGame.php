<?php

namespace BrainGames\Games\EvenGame;

use const BrainGames\Utils\ModuleUtils\HANDLER_QUESTION;
use const BrainGames\Utils\ModuleUtils\LOCATION_HANDLERS;
use const BrainGames\Utils\ModuleUtils\LOCATION_SETTINGS;
use const BrainGames\Utils\ModuleUtils\SETTING_RULES;

return function ($module) {
    $module[LOCATION_SETTINGS][SETTING_RULES] = 'Find the greatest common divisor of given numbers.';

    $gcd = function ($a, $b) use (&$gcd) {
        return $b === 0 ? $a : $gcd($b, $a % $b);
    };

    $module[LOCATION_HANDLERS][HANDLER_QUESTION] = function () use ($gcd) {
        $firstNum = random_int(1, 100);
        $secondNum = random_int(1, 100);
        $expectedAnswer = $gcd($firstNum, $firstNum);
        $question = "$firstNum $secondNum";
        return [$question, $expectedAnswer];
    };

    return $module;
};
