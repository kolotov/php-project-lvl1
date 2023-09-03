<?php

namespace BrainGames\Games\EvenGame;

use const BrainGames\Utils\ModuleUtils\HANDLER_QUESTION;
use const BrainGames\Utils\ModuleUtils\LOCATION_HANDLERS;
use const BrainGames\Utils\ModuleUtils\LOCATION_SETTINGS;
use const BrainGames\Utils\ModuleUtils\SETTING_RULES;

return function ($module) {
    $module[LOCATION_SETTINGS][SETTING_RULES] = 'What is the result of the expression?';

    $module[LOCATION_HANDLERS][HANDLER_QUESTION] = function () {
        $operands = ['*', '+', '-'];
        $firstNum = random_int(1, 100);
        $secondNum = random_int(1, 100);
        $operand = $operands[random_int(0, count($operands) - 1)];
        switch ($operand) {
            case '*':
                $expectedAnswer = $firstNum * $secondNum;
                break;
            case '+':
                $expectedAnswer = $firstNum + $secondNum;
                break;
            case '-':
                $expectedAnswer = $firstNum - $secondNum;
                break;
        }

        $question = "$firstNum $operand $secondNum";
        return [$question, $expectedAnswer];
    };

    return $module;
};
