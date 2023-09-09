<?php

namespace BrainGames\Games\EvenGame;

use const BrainGames\Utils\ModuleUtils\HANDLER_QUESTION;
use const BrainGames\Utils\ModuleUtils\SETTING_RULES;

function loader(array $module): array
{
    $module[SETTING_RULES] = 'Answer "yes" if the number is even, otherwise answer "no".';
    $module[HANDLER_QUESTION] = static fn() => handler();
    return $module;
}

function handler(): array
{
    $question = random_int(1, 100);
    $isEven = $question % 2 === 0;
    return [$question, $isEven ? 'yes' : 'no'];
}
