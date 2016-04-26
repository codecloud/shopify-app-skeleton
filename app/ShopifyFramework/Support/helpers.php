<?php
/**
 * @param array $arr
 * @return array
 */
function camel_case_array_keys(array $arr)
{
    $new = [];

    foreach ($arr as $key => $value) {
        $new[camel_case($key)] = $value;
    }

    return $new;
}