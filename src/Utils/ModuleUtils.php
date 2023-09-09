<?php

namespace BrainGames\Utils\ModuleUtils;

const DATA_USER_NAME = 'user_name';
const HANDLER_QUESTION = 'handler';
const LOCATION_DATA = 'data';
const LOCATION_TEXTS = 'texts';
const SETTING_RULES = 'rules';

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
 */
function getQuestionAnswerPairHandler(array $module): array
{
    return $module[HANDLER_QUESTION]();
}

function getRulesDescription(array $module): string
{
    return $module[SETTING_RULES];
}

function getText(array $module, string $key, array $replacePairs = []): string
{
    $texts = getTexts($module);
    $keys = explode('.', $key);
    /** @var string $text */
    $text = array_reduce($keys, fn($tail, $key) => is_array($tail) ? ($tail[$key] ?? '') : $tail, $texts);
    return strtr($text, $replacePairs);
}

function setUserName(array $module, string $userName): array
{
    $module[LOCATION_DATA][DATA_USER_NAME] = $userName;
    return $module;
}

function getUserName(array $module): string
{
    return $module[LOCATION_DATA][DATA_USER_NAME];
}

function getTexts(array $module): array
{
    return $module[LOCATION_TEXTS];
}
