<?php

namespace Omissis\ArrayFunctions;

class ArrayFunctions
{
    public static function get(array $array, $key, $default = null)
    {
        return get($array, $key, $default);
    }

    public static function set(array &$array, $key, $value = null)
    {
        return set($array, $key, $value);
    }
}
