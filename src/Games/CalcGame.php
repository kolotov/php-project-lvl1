<?php

namespace BrainGames\Games\CalcGame;

use RuntimeException;

use const BrainGames\Utils\ModuleUtils\HANDLER_QUESTION;
use const BrainGames\Utils\ModuleUtils\SETTING_RULES;

function loader(array $module): array
{
    $module[SETTING_RULES] = 'What is the result of the expression?';
    $module[HANDLER_QUESTION] = static fn() => handler();
    return $module;
}

function handler(): array
{
    $operators = ['*', '+', '-'];
    $firstNum = random_int(1, 10);
    $secondNum = random_int(1, 10);
    $operator = $operators[random_int(0, count($operators) - 1)];
    switch ($operator) {
        case '*':
            $expectedAnswer = $firstNum * $secondNum;
            break;
        case '+':
            $expectedAnswer = $firstNum + $secondNum;
            break;
        case '-':
            $expectedAnswer = $firstNum - $secondNum;
            break;
        default:
            throw new RuntimeException('Incorrect operator');
    }

    $question = "$firstNum $operator $secondNum";
    return [$question, $expectedAnswer];
}
