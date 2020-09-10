<?php
//插入排序
function insertSort(array $arr)
{
    $length = count($arr);
    for ($i = 0; $i < $length; $i++)
    {
        //当前数
        $temp = $arr[$i];
        //找出已经排序数组，倒序比较，如果当前数较小，插入。
        for ($j = $i-1; $j >= 0; $j--)
        {
            if ($temp < $arr[$j])
            {
                $arr[$j + 1] = $arr[$j];
                $arr[$j] = $temp;
            }
        }
    }

    return $arr;
}

$arr = [9, 6, 8, 7, 5, 2, 3, 1, 0, 22321312, 7777, 22, 9];
$new_arr = insertSort($arr);
var_dump($new_arr);