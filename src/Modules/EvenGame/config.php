<?php

namespace BrainGames\Modules\EvenGame\config;

use function BrainGames\Modules\EvenGame\Module\questionHandler;
use function BrainGames\Modules\EvenGame\Module\winConditionHandler;
use function BrainGames\ModuleUtils\setQuestionAnswerPairHandler;
use function BrainGames\ModuleUtils\setRulesDescription;
use function BrainGames\ModuleUtils\setWinConditionHandler;

return static function ($module) {
    $module = setRulesDescription($module, 'Answer "yes" if the number is even, otherwise answer "no".');
    $module = setQuestionAnswerPairHandler($module, static fn() => questionHandler());
    $module = setWinConditionHandler(
        $module,
        static fn($correctAnswers, $totalQuestions) => winConditionHandler($correctAnswers, $totalQuestions)
    );
    return $module;
};
