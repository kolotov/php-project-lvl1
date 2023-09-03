<?php

namespace BrainGames\Games\EvenGame;

use Exception;

use const BrainGames\Utils\ModuleUtils\HANDLER_QUESTION;
use const BrainGames\Utils\ModuleUtils\LOCATION_HANDLERS;
use const BrainGames\Utils\ModuleUtils\LOCATION_SETTINGS;
use const BrainGames\Utils\ModuleUtils\SETTING_RULES;

return function ($module) {
    $module[LOCATION_SETTINGS][SETTING_RULES] = 'What number is missing in the progression?';

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
    $lengthProgression = 10;
    $step = random_int(2, 10);
    $shift = random_int(1, 10);
    $progression = range($shift, $shift + (($lengthProgression - 1) * $step), $step);
    $guessIndex = random_int(0, 8);
    $expectedAnswer = $progression[$guessIndex];
    $progression[$guessIndex] = '..';
    $question = implode(' ', $progression);
    return [$question, $expectedAnswer];
}
