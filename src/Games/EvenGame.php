<?php

namespace BrainGames\Games\EvenGame;

use const BrainGames\Utils\ModuleUtils\HANDLER_QUESTION;
use const BrainGames\Utils\ModuleUtils\LOCATION_HANDLERS;
use const BrainGames\Utils\ModuleUtils\LOCATION_SETTINGS;
use const BrainGames\Utils\ModuleUtils\SETTING_RULES;

return function ($module) {
    $module[LOCATION_SETTINGS][SETTING_RULES] = 'Answer "yes" if the number is even, otherwise answer "no".';

    $module[LOCATION_HANDLERS][HANDLER_QUESTION] = function () {
        $question = random_int(1, 100);
        $isEven = $question % 2 === 0;
        return [$question, $isEven ? 'yes' : 'no'];
    };

    return $module;
};
