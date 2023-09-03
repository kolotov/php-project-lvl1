<?php

namespace BrainGames\Games\EvenGame;

use Exception;

use const BrainGames\Utils\ModuleUtils\HANDLER_QUESTION;
use const BrainGames\Utils\ModuleUtils\LOCATION_HANDLERS;
use const BrainGames\Utils\ModuleUtils\LOCATION_SETTINGS;
use const BrainGames\Utils\ModuleUtils\SETTING_RULES;

return function ($module) {
    $module[LOCATION_SETTINGS][SETTING_RULES] = 'Answer "yes" if the number is even, otherwise answer "no".';

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
    $question = random_int(1, 100);
    $isEven = $question % 2 === 0;
    return [$question, $isEven ? 'yes' : 'no'];
}
