<?php

namespace BrainGames\Games\PrimeGame;

use const BrainGames\Utils\ModuleUtils\HANDLER_QUESTION;
use const BrainGames\Utils\ModuleUtils\SETTING_RULES;

function loader($module): array
{
    $module[SETTING_RULES] = 'Answer "yes" if given number is prime. Otherwise answer "no".';
    $module[HANDLER_QUESTION] = static fn() => handler();
    return $module;
}

function handler(): array
{
    $question = random_int(1, 15);
    $isPrime = isPrime($question);
    return [$question, $isPrime ? 'yes' : 'no'];
}

function isPrime($number): bool
{
    if ($number <= 1) {
        return false;
    }

    for ($i = 2; $i * $i <= $number; $i++) {
        if ($number % $i === 0) {
            return false;
        }
    }

    return true;
}
