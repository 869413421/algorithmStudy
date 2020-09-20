<?php

/**
 * 堆
 * 父节点是大于或等于子节点的
 * 父节点为k,父的左子节点等于k*2,右子节点等于k*2+1
 * Class Heap
 */
class Heap
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

    public function exec($i, $j)
    {
        $temp = $this->items[$i];
        $this->items[$i] = $this->items[$j];
        $this->items[$j] = $temp;
    }

    public function insert($value)
    {
        ++$this->n;
        $this->items[] = $value;
        $this->swim($this->n);
    }

    //使用上浮算法，使索引k处的元素能在堆中处于一个正确的位置
    public function swim($k)
    {
        //如果已经到了根结点，就不需要循环了
        while ($k > 1)
        {
            //比较当前结点和其父结点
            $i = intval($k / 2);
            if ($this->less($k, $i))
            {
                //父结点小于当前结点，需要交换
                $this->exec($k, $i);
            }
            $k = $i;
        }
    }

    //删除堆中最大的元素,并返回这个最大元素
    public function delMax()
    {
        if ($this->n == 0)
        {
            return null;
        }
        $maxItem = $this->items[1];
        //交换最大值和最小值
        $this->exec(1, $this->n);
        unset($this->items[$this->n]);
        $this->n--;
        //使用下下沉算法；
        $this->sink(1);

        return $maxItem;
    }

    public function sink($k)
    {
        //2乘以k等于下层节点
        while (2 * $k <= $this->n)
        {
            $max = null;
            //如果存在右节点,比较左右节点那个较大
            if (2 * $k + 1 <= $this->n)
            {
                if ($this->less(2 * $k, 2 * $k + 1))
                {
                    $max = 2 * $k;
                }
                else
                {
                    $max = 2 * $k + 1;
                }
            }
            else
            {
                $max = 2 * $k;
            }

            //比较当前结点和子结点中的较大者，如果当前结点不小，则结束循环
            if ($this->less($k, $max))
            {
                break;
            }

            $this->exec($k, $max);
            $k = $max;
        }
    }
}

$heap = new Heap();

//$heap->insert("S");
//$heap->insert("G");
//$heap->insert("I");
//$heap->insert("E");
//$heap->insert("N");
//$heap->insert("H");
//$heap->insert("O");
//$heap->insert("A");
//$heap->insert("T");
//$heap->insert("P");
//$heap->insert("R");

$heap->insert("A");
$heap->insert("B");
$heap->insert("C");
$heap->insert("D");
$heap->insert("E");
$heap->insert("F");
$heap->insert("G");
$heap->insert("H");
$heap->insert("I");
$heap->insert("J");
$heap->insert("K");

while ($item = $heap->delMax())
{
    echo $item . PHP_EOL;
}