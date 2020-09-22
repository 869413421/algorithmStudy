<?php

/**
 * 最大优先队列
 * Class MaxPriorityQueue
 */
class MaxPriorityQueue
{
    private $items;
    private $n;

    public function __construct()
    {
        $this->items = [];
        $this->items[] = null;
        $this->n = 0;
    }

    public function less($i, $k)
    {
        if ($this->items[$i] > $this->items[$k])
        {
            return true;
        }

        return false;
    }

    public function exec($i, $k)
    {
        $temp = $this->items[$i];
        $this->items[$i] = $this->items[$k];
        $this->items[$k] = $temp;
    }

    public function isEmpty()
    {
        return $this->n == 0;
    }

    /**
     * 插入元素
     * @param $value
     */
    public function insert($value)
    {
        $this->items[] = $value;
        $this->n++;
        $this->swim($this->n);
    }

    public function deleteMax()
    {
        if ($this->isEmpty())
        {
            return null;
        }
        $maxItem = $this->items[1];
        //交换最大元素和最后一个元素
        $this->exec(1, $this->n);
        //删除掉最大元素
        unset($this->items[$this->n]);
        $this->n--;
        $this->sink(1);

        return $maxItem;
    }

    /**
     * 下沉元素
     * @param $n
     */
    public function sink($n)
    {
        $length = $this->n;
        while ($n * 2 <= $length)
        {
            //存在右节点
            if ($n * 2 + 1 <= $length)
            {
                $left = $n * 2;
                $right = $n * 2 + 1;
                if ($this->less($left, $right))
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
                $max = $n * 2;
            }
            //如果当前节点比子节点都大，退出
            if ($this->less($n, $max))
            {
                break;
            }

            $this->exec($n, $max);
            $n = $max;
        }
    }

    /**
     * 上浮算法
     * @param $n
     */
    public function swim($n)
    {
        //是否上浮到最上层
        while ($n > 1)
        {
            //如果n比父节点打，上浮
            if ($this->less($n, intval($n / 2)))
            {
                $this->exec($n, intval($n / 2));
                $n = $n / 2;
            }
            else
            {
                break;
            }
        }
    }

}

$maxPriorityQueue = new MaxPriorityQueue();
$arr = ["S", "O", "R", "T", "E", "X", "A", "M", "P", "L", "E"];
foreach ($arr as $item)
{
    $maxPriorityQueue->insert($item);
}

foreach ($arr as $item)
{
    echo $maxPriorityQueue->deleteMax() . PHP_EOL;
}