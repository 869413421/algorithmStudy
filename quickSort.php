<?php
function less($a, $b)
{
    if ($a > $b)
    {
        return true;
    }

    return false;
}

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
        //从右往左扫描找到比中间值小的元素
        while ($arr[--$right] < $key)
        {
            if ($right == $start)
            {
                break;
            }
        }
        //从左往右扫描找到比中间值大的元素
        while ($arr[++$left] > $key)
        {
            if ($left == $end)
            {
                break;
            }
        }
        //如果左右指针重合，元素扫描完毕，推出循环
        if ($left >= $right)
        {
            break;
        }

        $temp = $arr[$left];
        $arr[$left] = $arr[$right];
        $arr[$right] = $temp;
    }

    //交换完元素将中间指针元素和左右指针重合元素交换
    $temp = $arr[$start];
    $arr[$start] = $arr[$right];
    $arr[$right] = $temp;

    //返回right指针
    return $right;
}


$arr = [9, 6, 8, 7, 5, 2, 3, 1, 0, 22321312, 7777, 22];
quickSort($arr);
var_dump($arr);