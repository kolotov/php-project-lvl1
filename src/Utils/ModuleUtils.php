<?php

namespace BrainGames\Utils\ModuleUtils;

const DATA_USER_NAME = 3010;
const HANDLER_QUESTION = 100;
const LOCATION_DATA = 'data';
const LOCATION_HANDLERS = 'handlers';
const LOCATION_SETTINGS = 'settings';
const LOCATION_TEXTS = 'texts';
const SETTING_RULES = 103;

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
function getQuestionAnswerPairHandler($module): array
{
    return $module[LOCATION_HANDLERS][HANDLER_QUESTION]();
}

function getRulesDescription($module): string
{
    return $module[LOCATION_SETTINGS][SETTING_RULES];
}

function getText($module, $key, $replace_pairs = []): string
{
    $texts = getTexts($module);
    $keys = explode('.', $key);
    $text = array_reduce($keys, fn($tail, $key) => is_array($tail) ? ($tail[$key] ?? '') : $tail, $texts);
    return strtr($text, $replace_pairs);
}

function setUserName($module, $userName): array
{
    $module[LOCATION_DATA][DATA_USER_NAME] = $userName;
    return $module;
}

function getUserName($module): string
{
    return $module[LOCATION_DATA][DATA_USER_NAME];
}

function setTexts($module, $texts): array
{
    $module[LOCATION_TEXTS] = $texts;
    return $module;
}

function getTexts($module): array
{
    return $module[LOCATION_TEXTS];
}
