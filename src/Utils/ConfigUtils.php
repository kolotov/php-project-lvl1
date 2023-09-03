<?php

namespace BrainGames\Utils\ConfigUtils;

function loadConfigurations($configFile): array
{
    return json_decode(
        file_get_contents($configFile),
        true,
        512,
        JSON_THROW_ON_ERROR
    );
}

function loadModule($moduleFile): array
{
    $module = [];
    return (require $moduleFile)($module);
}
