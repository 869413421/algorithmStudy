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
    $mid = intval($start + ($end - $start) / 2);
    //数组拆分成两个进行排序
    mSort($arr, $start, $mid);
    mSort($arr, $mid + 1, $end);
    //对排序后的两个数组进行合并
    merge($arr, $start, $mid, $end);

}

function merge(array &$arr, $start, $mid, $end)
{
    //第一个数组开始索引
    $i = $start;
    //第二个数组开始索引
    $j = $mid + 1;
    //创建一个临时数组
    $tempArr = [];
    //临时数组的索引
    $k = $start;

    //两个数组的指针都没结束
    while ($i <= $mid && $j <= $end)
    {
        //比较大小
        if (less($arr[$i], $arr[$j]))
        {
            //移动第一个数组指针和临时数组指针
            $tempArr[$k++] = $arr[$j++];
        }
        else
        {
            //移动第二个数组指针和临时数组指针
            $tempArr[$k++] = $arr[$i++];
        }
    }

    if ($i <=$mid )
    {
        $tempArr[$k++] = $arr[$i++];
    }

    while ($j <=$end)
    {
        $tempArr[$k++] = $arr[$j++];
    }

    for ($i = $start; $i <= $end; $i++)
    {
        $arr[$i] = $tempArr[$i];
    }
}

$arr = array (1, 5, 8, 3, 7, 4, 6, 2,9);
mergeSort($arr);
var_dump($arr);