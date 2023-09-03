<?php

namespace BrainGames\Games\EvenGame;

use const BrainGames\Utils\ModuleUtils\HANDLER_QUESTION;
use const BrainGames\Utils\ModuleUtils\LOCATION_HANDLERS;
use const BrainGames\Utils\ModuleUtils\LOCATION_SETTINGS;
use const BrainGames\Utils\ModuleUtils\SETTING_RULES;

return function ($module) {
    $module[LOCATION_SETTINGS][SETTING_RULES] = 'What number is missing in the progression?';

    $module[LOCATION_HANDLERS][HANDLER_QUESTION] = function () {
        $lengthProgression = 10;
        $step = random_int(2, 10);
        $shift = random_int(1, 10);
        $progression = range($shift, $shift + (($lengthProgression - 1) * $step), $step);
        $guessIndex = random_int(0, 8);
        $expectedAnswer = $progression[$guessIndex];
        $progression[$guessIndex] = '..';
        $question = implode(' ', $progression);
        return [$question, $expectedAnswer];
    };

    return $module;
};
