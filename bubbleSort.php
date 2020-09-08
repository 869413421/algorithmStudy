<?php
/**
 * @param $arr
 * @return mixed
 *
 * 冒泡排序算法的原理如下：
 * 1.比较相邻的元素。如果第一个比第二个大，就交换他们两个。
 * 2.对每一对相邻元素做同样的工作，从开始第一对到结尾的最后一对。在这一点，最后的元素应该会是最大的数。
 * 3.针对所有的元素重复以上的步骤，除了最后一个。
 * 4.持续每次对越来越少的元素重复上面的步骤，直到没有任何一对数字需要比较。
 */
//function bubbleSort($arr)
//{
//    //获取 长度
//    $len = count($arr);
//    //循环比较（相邻的两个元素，比较，交换）
//    for ($k = 0; $k <= $len; $k++)
//    {
//        for ($j = $len - 1; $j > $k; $j--)
//        {
//            //比较
//            if ($arr[$j] < $arr[$j - 1])
//            {
//                //交换
//                $temp = $arr[$j];
//                $arr[$j] = $arr[$j - 1];
//                $arr[$j - 1] = $temp;
//            }
//        }
//    }
//    return $arr;
//}


//function bubbleSort($arr)
//{
//    $len = count($arr);
//    for ($i = 0; $i < $len; $i++)
//    {
//        for ($j = $len - 1; $j > $i; $j--)
//        {
//            if ($arr[$j] < $arr[$j - 1])
//            {
//                $temp = $arr[$j - 1];
//                $arr[$j - 1] = $arr[$j];
//                $arr[$j] = $temp;
//            }
//        }
//    }
//    return $arr;
//}


function bubbleSort(array $arr)
{
    $length = count($arr);
    for ($i = 0; $i < $length; $i++)
    {
        for ($j = $i + 1; $j < $length; $j++)
        {
            if ($arr[$i] > $arr[$j])
            {
                $temp = $arr[$i];
                $arr[$i] = $arr[$j];
                $arr[$j] = $temp;
            }
        }
    }
    return $arr;
}

$arr = [9, 6, 8, 7, 5, 2, 3, 1,0,22321312,7777, 2];
$new_arr = bubbleSort($arr);
var_dump($new_arr);
