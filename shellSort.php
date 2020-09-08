<?php

function shellSort(array $arr)
{
    $length = count($arr);
    $incr = count($arr);

    do
    {
        //根据增量进行分组交换
        $incr = ceil($incr / 2);
        for ($i = $incr; $i < $length; $i++)
        {
            $temp = $arr[$i];
            for ($j = $i - $incr; $j >= 0; $j -= $incr)
            {
                if ($temp < $arr[$j])
                {
                    $arr[$i] = $arr[$j];
                    $arr[$j] = $temp;
                }
            }
        }
    }
    while ($incr > 1);

    return $arr;
}

$arr = [9, 6, 8, 7, 5, 2, 3, 1, 0, 22321312, 7777, 22];
$new_arr = shellSort($arr);
var_dump($new_arr);
