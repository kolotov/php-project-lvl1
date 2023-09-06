<?php

namespace BrainGames\Games\GcdGame;

use const BrainGames\Utils\ModuleUtils\HANDLER_QUESTION;
use const BrainGames\Utils\ModuleUtils\SETTING_RULES;

function loader($module): array
{
    $module[SETTING_RULES] = 'Find the greatest common divisor of given numbers.';
    $module[HANDLER_QUESTION] = static fn() => handler();
    return $module;
}

function handler(): array
{
    $firstNum = random_int(1, 100);
    $secondNum = random_int(1, 100);
    $expectedAnswer = gcd($firstNum, $secondNum);
    $question = "$firstNum $secondNum";
    return [$question, $expectedAnswer];
}

function gcd($a, $b): int
{
    return $b === 0 ? $a : gcd($b, $a % $b);
}
