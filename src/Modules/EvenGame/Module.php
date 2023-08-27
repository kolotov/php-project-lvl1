<?php

namespace BrainGames\Modules\EvenGame\Module;

use Exception;

const NUMBER_CORRECT_ANSWERS_FOR_WIN = 3;

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

function winConditionHandler(int $correctAnswers, int $totalQuestions): bool
{
    return
        NUMBER_CORRECT_ANSWERS_FOR_WIN === $correctAnswers and
        NUMBER_CORRECT_ANSWERS_FOR_WIN === $totalQuestions;
}
