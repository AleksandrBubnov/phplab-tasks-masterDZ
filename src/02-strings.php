<?php

/**
 * The $input variable contains text in snake case (i.e. hello_world or this_is_home_task)
 * Transform it into a camel-cased string and return (i.e. helloWorld or thisIsHomeTask)
 * @see http://xahlee.info/comp/camelCase_vs_snake_case.html
 *
 * @param  string  $input
 * @return string
 */
function snakeCaseToCamelCase(string $input)
{
    $tmp = ucwords($input, "_");
    $tmp = lcfirst($tmp);
    $tmp = explode("_", $tmp);
    return implode($tmp);
}

/**
 * The $input variable contains multibyte text like 'ФЫВА олдж'
 * Mirror each word individually and return transformed text (i.e. 'АВЫФ ждло')
 * !!! do not change words order
 *
 * @param  string  $input
 * @return string
 */
function mirrorMultibyteString(string $input)
{
    $pattern = '//u';
    $tmp = explode(" ", $input);
    foreach ($tmp as $key => $val) {
        $res = '';
        $new_arr = (preg_split($pattern, $val, -1, PREG_SPLIT_NO_EMPTY));
        $count = count($new_arr);
        for ($i = 0; $i < $count; $i++) {
            $res = $res . $new_arr[$count - $i - 1];
        }
        $tmp[$key] = $res;
    }
    return implode(' ', $tmp);
}

/**
 * My friend wants a new band name for her band.
 * She likes bands that use the formula: 'The' + a noun with the first letter capitalized.
 * However, when a noun STARTS and ENDS with the same letter,
 * she likes to repeat the noun twice and connect them together with the first and last letter,
 * combined into one word like so (WITHOUT a 'The' in front):
 * dolphin -> The Dolphin
 * alaska -> Alaskalaska
 * europe -> Europeurope
 * Implement this logic.
 *
 * @param  string  $noun
 * @return string
 */
function getBrandName(string $noun)
{
    $noun = strtolower($noun);
    $the = 'the ';
    $tmp = '';
    if ($noun[0] == strrev($noun)[0]) {
        $tmp = $noun . substr($noun, 1);
    } else {
        $tmp = $the . $noun;
    }
    return ucwords($tmp);
}
