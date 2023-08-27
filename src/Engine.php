<?php

namespace BrainGames\Engine;

use RuntimeException;

use function BrainGames\ConfigUtils\loadConfigurations;
use function BrainGames\ConfigUtils\loadModule;
use function BrainGames\ModuleUtils\getQuestionAnswerPairHandler;
use function BrainGames\ModuleUtils\getRulesDescription;
use function BrainGames\ModuleUtils\getText;
use function BrainGames\ModuleUtils\getUserName;
use function BrainGames\ModuleUtils\setUserName;
use function cli\line;
use function cli\prompt;

const ATTEMPT_NUMBER = 3;

function runBrainGame(string $moduleName): void
{
    $module = loadGame($moduleName);
    $module = greetUser($module);
    runGame($module);
}

function loadGame($moduleName): array
{
    $moduleFile = __DIR__ . '/Games/' . $moduleName . '/config.php';
    if (!file_exists($moduleFile)) {
        throw new RuntimeException("Module $moduleFile not found");
    }
    $module = loadModule($moduleFile);

    $configFile = __DIR__ . '/config.json';
    if (!file_exists($configFile)) {
        throw new RuntimeException("Config $configFile not found");
    }

    $config = loadConfigurations($configFile);
    return array_replace_recursive($config, $module);
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
    $isValidAnswer = $correctAnswer === $userAnswer;

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
