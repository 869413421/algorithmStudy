<?php

function xzSort(array $arr)
{
    $length = count($arr);
    for ($i = 0; $i < $length; $i++)
    {
        //找出最小数的索引
        $minIndex = $i;
        //从没排序的数组中查找最小的数，获取下标
        for ($j = $i + 1; $j < $length; $j++)
        {
            if ($arr[$minIndex] > $arr[$j])
            {
                $minIndex = $j;
            }
        }

        //插到前面
        if ($minIndex != $i) {
            $temp = $arr[$i];
            $arr[$i] = $arr[$minIndex];
            $arr[$minIndex] = $temp;
        }
    }

    return $arr;
}

$arr = [9, 6, 8, 7, 5, 2, 3, 1, 0, 22321312, 7777, 22];
$new_arr = xzSort($arr);
var_dump($new_arr);
