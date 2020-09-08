<?php

function quickSort(array &$arr)
{
    $start = 0;
    $end = count($arr) - 1;
    qSort($arr, $start, $end);
}

function qSort(array &$arr, $start, $end)
{
    if ($start >= $end)
    {
        return;
    }
    $partition = partition($arr, $start, $end);
    qSort($arr, $start, $partition - 1);
    qSort($arr, $partition + 1, $end);
}

function partition(array &$arr, $start, $end)
{
    $key = $arr[$start];
    $left = $start;
    $right = $end + 1;

    while (true)
    {
        while ($arr[--$right] < $key)
        {
            if ($right == $start)
            {
                break;
            }
        }

        while ($arr[++$left] > $key)
        {
            if ($left == $end)
            {
                break;
            }
        }

        if ($left >= $right)
        {
            break;
        }

        $temp = $arr[$left];
        $arr[$left] = $arr[$right];
        $arr[$right] = $temp;
    }

    $temp = $arr[$start];
    $arr[$start] = $arr[$right];
    $arr[$right] = $temp;

    return $right;
}

$arr = [9, 6, 8, 7, 5, 2, 3, 1, 0, 22321312, 7777, 22];
quickSort($arr);
var_dump($arr);