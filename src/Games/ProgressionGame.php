<?php

namespace BrainGames\Games\ProgressionGame;

use const BrainGames\Utils\ModuleUtils\HANDLER_QUESTION;
use const BrainGames\Utils\ModuleUtils\SETTING_RULES;

function loader($module): array
{
    $module[SETTING_RULES] = 'What number is missing in the progression?';
    $module[HANDLER_QUESTION] = static fn() => handler();
    return $module;
}

function handler(): array
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
