<?php

/**
 * The $input variable contains an array of digits
 * Return an array which will contain the same digits but repetitive by its value
 * without changing the order.
 * Example: [1,3,2] => [1,3,3,3,2,2]
 *
 * @param  array  $input
 * @return array
 */
function repeatArrayValues(array $input)
{
    $count = count($input);
    $tmp = [];
    for ($i = 0; $i < $count; $i++) {
        for ($j = 0; $j < $input[$i]; $j++) {
            array_push($tmp, $input[$i]);
        }
    }
    return $tmp;
}

/**
 * The $input variable contains an array of digits
 * Return the lowest unique value or 0 if there is no unique values or array is empty.
 * Example: [1, 2, 3, 2, 1, 5, 6] => 3
 *
 * @param  array  $input
 * @return int
 */
function getUniqueValue(array $input)
{
    $tmp = 0;
    $tmpArr = [];
    if (count($input) == 0) return $tmp;
    while (count($input) != 0) {
        $num = array_pop($input);
        if (!in_array($num, $input)) {
            array_push($tmpArr, $num);
        } else {
            $input = array_diff($input, [$num]);
        }
    }
    if (count($tmpArr) != 0) $tmp = min($tmpArr);
    return $tmp;
}

/**
 * The $input variable contains an array of arrays
 * Each sub array has keys: name (contains strings), tags (contains array of strings)
 * Return the list of names grouped by tags
 * !!! The 'names' in returned array must be sorted ascending.
 *
 * Example:
 * [
 *  ['name' => 'potato', 'tags' => ['vegetable', 'yellow']],
 *  ['name' => 'apple', 'tags' => ['fruit', 'green']],
 *  ['name' => 'orange', 'tags' => ['fruit', 'yellow']],
 * ]
 *
 * Should be transformed into:
 * [
 *  'fruit' => ['apple', 'orange'],
 *  'green' => ['apple'],
 *  'vegetable' => ['potato'],
 *  'yellow' => ['orange', 'potato'],
 * ]
 *
 * @param  array  $input
 * @return array
 */
function groupByTag(array $input)
{
    $b = [];
    foreach ($input as $key => $value) {
        $a = array_chunk($input[$key], 1, true);
        foreach ($a as $key => $value) {
            $tag = '';
            if (array_key_exists('name', $a[0])) {
                $tag = $a[0]['name'];
            }
            foreach ($a[$key] as $k2 => $v2) {
                if ($k2 == 'tags') {
                    foreach ($a[$key][$k2] as $k3 => $v3) {
                        if (array_key_exists($v3, $b)) {
                            array_push($b[$v3], $tag);
                            sort($b[$v3]);
                        } else {
                            $d = [$v3 => [$tag]];
                            $b =  array_merge($b, $d);
                            ksort($b);
                        }
                    }
                }
            }
        }
    }
    return $b;
}
