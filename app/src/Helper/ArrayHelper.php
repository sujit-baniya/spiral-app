<?php


namespace App\Helper;


class ArrayHelper
{
    public function find($array, $key, $value)
    {
        $data = array_filter($array, function ($elem) use($key, $value) {
            return $elem[$key] === $value;
        });
        if(!empty($data))
        {
            return $data[0];
        }
        return [];
    }

    public function exists($array, $key, $value)
    {
        $data = array_filter($array, function ($elem) use($key, $value) {
            return $elem[$key] === $value;
        });
        if(!empty($data))
        {
            return true;
        }
        return false;
    }
}