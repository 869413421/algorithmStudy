<?php

/**
 * 最小优先队列
 * Class MinPriorityQueue
 */
class MinPriorityQueue
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

    public function insert($value)
    {
        $this->items[] = $value;
        $this->n++;
        $this->swim($this->n);
    }

    public function deleteMin()
    {
        if ($this->isEmpty())
        {
            return null;
        }

        $minItem = $this->items[1];

        $this->exec(1, $this->n);
        unset($this->items[$this->n]);
        $this->n--;
        $this->sink(1);

        return $minItem;
    }

    public function sink($n)
    {
        $length = $this->n;
        while ($n * 2 <= $length)
        {
            //有右节点
            if ($n * 2 + 1 <= $length)
            {
                $left = $n * 2;
                $right = $n * 2 + 1;
                if ($this->less($left, $right))
                {
                    $min = $right;
                }
                else
                {
                    $min = $left;
                }
            }
            else
            {
                $min = $n * 2;
            }

            if ($this->less($min, $n))
            {
                break;
            }

            $this->exec($min, $n);
            $n = $min;
        }
    }

    /**
     * 上浮
     * @param $n
     */
    public function swim($n)
    {
        while ($n > 1)
        {
            //如果当前节点比上级节点大,结束上浮
            if ($this->less($n, intval($n / 2)))
            {
                break;
            }

            $this->exec($n, intval($n / 2));
            $n = intval($n / 2);
        }
    }
}

$minPriorityQueue = new MinPriorityQueue();
$arr = ["S", "O", "R", "T", "E", "X", "A", "M", "P", "L", "E"];
foreach ($arr as $item)
{
    $minPriorityQueue->insert($item);
}

foreach ($arr as $item)
{
    echo $minPriorityQueue->deleteMin() . PHP_EOL;
}