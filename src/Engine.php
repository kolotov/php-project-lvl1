<?php

namespace BrainGames\Engine;

use JsonException;
use RuntimeException;

use function BrainGames\Utils\ModuleUtils\getQuestionAnswerPairHandler;
use function BrainGames\Utils\ModuleUtils\getRulesDescription;
use function BrainGames\Utils\ModuleUtils\getText;
use function BrainGames\Utils\ModuleUtils\getUserName;
use function BrainGames\Utils\ModuleUtils\setUserName;
use function cli\line;
use function cli\prompt;

use const BrainGames\Utils\ModuleUtils\LOCATION_TEXTS;

const ATTEMPT_NUMBER = 3;

function runBrainGame(string $moduleName): void
{
    $module = buildGame($moduleName);
    $module = loadTexts($module);
    $module = greetUser($module);
    runGame($module);
}

function loadTexts($module): array
{
    $textsFile = __DIR__ . '/texts.json';
    if (!file_exists($textsFile)) {
        throw new RuntimeException("Config $textsFile not found");
    }

    try {
        $texts = json_decode(file_get_contents($textsFile), true, 512, JSON_THROW_ON_ERROR);
    } catch (JsonException $e) {
    }

    if (empty($texts)) {
        throw new RuntimeException("Config $textsFile wasn't loaded");
    }

    $module[LOCATION_TEXTS] = $texts;
    return $module;
}

function buildGame($moduleName): array
{
    $module = [];
    $moduleFile = __DIR__ . '/Games/' . $moduleName . '.php';
    if (!file_exists($moduleFile)) {
        throw new RuntimeException("Module $moduleFile not found");
    }

    require_once $moduleFile;
    return "BrainGames\Games\\$moduleName\loader"($module);
}

function greetUser(array $module): array
{
    line(getText($module, 'dialogs.welcome'));
    $userName = prompt(getText($module, 'prompts.ask_name') . ' ', false, '');
    $module = setUserName($module, $userName);

    line(getText($module, 'dialogs.greeting', ['[user_name]' => $userName]));
    line(getRulesDescription($module));
    return $module;
}

function runGame(array $module, int $correctAnswerCounter = 0): void
{
    $userName = getUserName($module);

    [$question, $correctAnswer] = getQuestionAnswerPairHandler($module);
    line(getText($module, 'prompts.question', ['[question]' => $question]));

    $userAnswer = prompt(getText($module, 'prompts.answer'));
    $isValidAnswer = (string)$correctAnswer === $userAnswer;

    /** Game over */
    if (!$isValidAnswer) {
        line(
            getText($module, 'dialogs.incorrect_answer', [
                '[user_answer]'    => $userAnswer,
                '[correct_answer]' => $correctAnswer,
                '[user_name]'      => $userName,
            ])
        );
        return;
    }

    $correctAnswerCounter++;
    line(getText($module, 'dialogs.correct_answer', ['[user_name]' => $userName]));

    /** User Won! End game */
    $isWin = ATTEMPT_NUMBER <= $correctAnswerCounter;
    if ($isWin) {
        line(getText($module, 'dialogs.congratulations', ['[user_name]' => $userName]));
        return;
    }

    runGame($module, $correctAnswerCounter);
}
