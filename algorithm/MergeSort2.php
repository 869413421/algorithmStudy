<?php

function less($a, $b)
{
    if ($a > $b)
    {
        return true;
    }

    return false;
}

function mergeSort(array &$arr)
{
    $start = 0;
    $end = count($arr) - 1;
    mSort($arr, $start, $end);
}

function mSort(array &$arr, $start, $end)
{
    if ($start >= $end)
    {
        return;
    }
    //找到数组分隔位置
    $mid = intval($end + ($start - $end) / 2);
    //数组拆分成两个进行排序
    mSort($arr, $start, $mid);
    mSort($arr, $mid + 1, $end);
    //对排序后的两个数组进行合并
    merge($arr, $start, $mid, $end);

}

function merge(array &$arr, $start, $mid, $end)
{
    $i = $start;
    $j = $mid + 1;

    $tempArr = [];
    $k = $start;

    while ($i <= $mid && $j <= $end)
    {
        if (less($arr[$i], $arr[$j]))
        {
            $tempArr[$k] = $arr[$j];
            $j++;
            $k++;
        }
        else
        {
            $tempArr[$k] = $arr[$i];
            $i++;
            $k++;
        }
    }

    while ($i <= $mid)
    {
        $tempArr[$k] = $arr[$i];
        $i++;
        $k++;
    }

    while ($j <= $end)
    {
        $tempArr[$k] = $arr[$j];
        $j++;
        $k++;
    }

    for ($index = $start; $index <= $end; $index++)
    {
        $arr[$index] = $tempArr[$index];
    }
}

$arr = array (9, 1, 5, 8, 3, 7, 4, 6, 2);
mergeSort($arr);
var_dump($arr);