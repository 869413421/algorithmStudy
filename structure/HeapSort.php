<?php

/**
 * 堆排序
 * Class HeapSort
 */
class HeapSort
{
    private $items;
    private $n;

    public function less($i, $k)
    {
        if ($this->items[$i] > $this->items[$k])
        {
            return true;
        }

        return false;
    }

    public function exec($i, $j)
    {
        $temp = $this->items[$i];
        $this->items[$i] = $this->items[$j];
        $this->items[$j] = $temp;
    }


    public function createHeap(array $arr)
    {
        //1.创建一个无序的堆
        $heap = $arr;
        array_unshift($heap, null);

        //2.从堆的一半开始往索引1处做下沉
        $length = count($heap);
        for ($i = (int)$length / 2; $i > 0; $i--)
        {
            $this->sink($heap, $i, $length - 1);
        }

        return $heap;
    }

    //堆排序，从小到大
    public function sort($arr)
    {
        //创建一个有序的堆
        $heap = $this->createHeap($arr);
        $length = count($heap) - 1;
        while ($length > 1)
        {
            //1.将最大索引放到尾部
            $temp = $heap[1];
            $heap[1] = $heap[$length];
            $heap[$length] = $temp;
            $length--;

            //2.将放在第一位的元素下沉，排除掉已经交换的元素
            $this->sink($heap, 1, $length);
        }

        array_shift($heap);
        return $heap;
    }

    /**
     * 堆下沉
     * @param array $head
     * @param $target
     * @param $range
     */
    public function sink(array &$head, $target, $range)
    {
        //判断当前节点是否有子节点
        while ($target * 2 <= $range)
        {
            $max = null;
            //判断是否有右子节点
            if ($target * 2 + 1 <= $range)
            {
                //比较左右节点
                $left = $target * 2;
                $right = $target * 2 + 1;
                if ($head[$left] > $head[$right])
                {
                    $max = $left;
                }
                else
                {
                    $max = $right;
                }
            }
            else
            {
                $max = $target * 2;
            }

            //如果当前节点比子节点大不下沉，退出循环
            if ($head[$target] > $head[$max])
            {
                break;
            }

            //将元素下沉到下一层节点
            $temp = $head[$target];
            $head[$target] = $head[$max];
            $head[$max] = $temp;
            $target = $max;
        }
    }
}

$heapSort = new HeapSort();
$heapArr = $heapSort->sort(["S", "O", "R", "T", "E", "X", "A", "M", "P", "L", "E"]);
var_dump($heapArr);