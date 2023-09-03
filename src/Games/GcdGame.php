<?php

namespace BrainGames\Games\EvenGame;

use Exception;

use const BrainGames\Utils\ModuleUtils\HANDLER_QUESTION;
use const BrainGames\Utils\ModuleUtils\LOCATION_HANDLERS;
use const BrainGames\Utils\ModuleUtils\LOCATION_SETTINGS;
use const BrainGames\Utils\ModuleUtils\SETTING_RULES;

return function ($module) {
    $module[LOCATION_SETTINGS][SETTING_RULES] = 'Find the greatest common divisor of given numbers.';

    $module[LOCATION_HANDLERS][HANDLER_QUESTION] = fn() => questionHandler();

    return $module;
};

/**
 * Returns a question and its expected answer.
 *
 * - 0: The question (string)
 * - 1: The expected answer (string)
 *
 * @return array{
 *     0: string,
 *     1: string
 * }
 * @throws Exception
 */
function questionHandler(): array
{
    $firstNum = random_int(1, 100);
    $secondNum = random_int(1, 100);

    $expectedAnswer = gmp_gcd($firstNum, $firstNum);
    $question = "$firstNum $secondNum";
    return [$question, $expectedAnswer];
}
