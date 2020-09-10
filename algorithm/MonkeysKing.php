<?php

//一群猴子排成一圈，按1，2，…，n依次编号。然后从第1只开始数，
//数到第m只,把它踢出圈，从它后面再开始数，再数到第m只，在把它踢出去…，
//如此不停的进行下去，直到最后只剩下一只猴子为止，那只猴子就叫做大王。
//要求编程模拟此过程，输入m、n, 输出最后那个大王的编号。


//约瑟夫问题

/**
 * @param $m *猴群数目
 * @param $n *数到第几个猴子踢出去
 * @return mixed
 */
function monkeysKing($m, $n)
{
    //创建一个猴群
    $monkeys = range(1, $m);
    //从第一个开始数
    $i = 0;
    while (count($monkeys) > 1)
    {
        //如果当前猴子等于n，踢出猴群
        if (($i + 1) % $n == 0)
        {
            unset($monkeys[$i]);
        }
        else
        {
            //如果不等于n，丢到最后到时候重新数
            array_push($monkeys, $monkeys[$i]);
            unset($monkeys[$i]);
        }
        $i++;
    }
    return current($monkeys);
}

$i = monkeysKing(10, 4);
echo $i;