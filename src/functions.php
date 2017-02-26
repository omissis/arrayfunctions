<?php

namespace Omissis\ArrayFunctions;

/**
 * An array key getter
 *
 * Use this when you have one-level array,
 * ie: $arr = ['key1' => 'value1', 'key2' => 'value2'];
 *
 * @param array        $array   array from which you want to get data
 * @param string|array $key     array key you want to extract. if it's an array, it behaves like _get_recursive
 * @param mixed        $default fallback value in case of non-existent key
 *
 * @return
 *   if the passed key of the array exists, return the corresponding value,
 *   else return the default value(if passed); as last resort return null.
 */
function get(array $array, $key, $default = null)
{
    if (is_array($key)) {
        return _get_recursive($array, $key, $default);
    }

    return (isset($array[$key])) ? $array[$key] : $default;
}

/**
 * An array key setter
 *
 * Use this when you have one-level array,
 * ie: $arr = ['key1' => 'value1', 'key2' => 'value2'];
 *
 * @param array        $array array in which you want to set data
 * @param string|array $key   array key where you want to store value. if it's an array, it behaves like set_recursive
 * @param mixed        $value value you want to set
 *
 * @return
 *   if the key already exists, the old value of the array,
 *   else null
 */
function set(array &$array, $key, $value = null)
{
    if (is_array($key)) {
        return _set_recursive($array, $key, $value);
    }

    $oldValue = get($array, $key);
    $array[$key] = $value;

    return $oldValue;
}

/**
 * A recursive array key getter
 *
 * Use this when you have multiple-levels array,
 * ie: $arr = ['key1' => ['key3' => ['key4' => 'value4']],
 *             'key2' => 'value2'];
 *
 * @param array $array   array from which you want to get data
 * @param array $key     array containing index path of the key you want
 *                       to extract(ie: ['a', 'b', 'c']
 *                       will point to $array['a']['b']['c'])
 * @param mixed $default fallback value in case of non-existent key
 *
 * @return
 *   if the passed key of the array exists, return the corresponding value,
 *   else return the default value(if passed); as last resort return null.
 */
function _get_recursive(array $array, array $key, $default = null)
{
    $innerKey = array_shift($key);

    if (!isset($array[$innerKey])) {
        return $default;
    }

    if (empty($key)) {
        return $array[$innerKey];
    }

    if (!is_array($array[$innerKey])) {
        return $default;
    }

    return _get_recursive($array[$innerKey], $key, $default);
}

/**
 * A recursive array key setter
 *
 * Use this when you have multiple-levels array,
 * ie: $arr = ['key1' => ['key3' => ['key4' => 'value4']],
 *             'key2' => 'value2];
 *
 * @param array &$array array in which you want to set data
 * @param array $key    array containing index path in which you want
 *                      to store value(ie: ['a', 'b', 'c']
 *                      will point to $array['a']['b']['c'])
 * @param mixed $value  value you want to set
 *
 * @return
 *   if the key already exists, the old value of the array,
 *   else null
 */
function _set_recursive(array &$array, array $key, $value)
{
    $oldValue = _get_recursive($array, $key);

    if (($innerKey = array_shift($key))) {
        if (!isset($array[$innerKey])) {
            $array[$innerKey] = [];
        }

        if (!is_array($array[$innerKey])) {
            $array[$innerKey] = [$array[$innerKey]];
        }

        _set_recursive($array[$innerKey], $key, $value);
    } else {
        $array = $value;
    }

    return $oldValue;
}
