<?php

/**
 * The $airports variable contains array of arrays of airports (see airports.php)
 * What can be put instead of placeholder so that function returns the unique first letter of each airport name
 * in alphabetical order
 *
 * Create a PhpUnit test (GetUniqueFirstLettersTest) which will check this behavior
 *
 * @param  array  $airports
 * @return string[]
 */
function getUniqueFirstLetters(array $airports)
{
    $result = [];
    foreach ($airports as $airport) {
        if (!in_array($airport['name'][0], $result)) {
            array_push($result, $airport['name'][0]);
        }
    }
    asort($result);
    // var_dump($result);
    // die();
    return $result;
}

function snakeCaseToCamelCase2(string $input)
{
    return preg_replace_callback('/_(.?)/', function ($matches) {
        return ucfirst($matches[1]);
    }, $input);
}

function getFilterByState($airports, $state)
{
    return array_filter($airports, function ($item) use ($state) {
        return $item['state'] == $state;
    });
}

function getSort($airports, $name)
{
    usort($airports, function ($a, $b) use ($name) {
        return $a[$name] > $b[$name];
    });
    return $airports;
}

function getFilterByFirstLetter($airports, $letter)
{
    return array_filter($airports, function ($item) use ($letter) {
        return $item['name'][0] == $letter;
    });

    // var_dump(array_filter($airports, function ($item) use ($letter) {
    //     return $item['name'][0] == $letter;
    // }));
    // die();
}
