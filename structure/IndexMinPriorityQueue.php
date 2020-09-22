<?php

/**
 * 索引最小队列
 * Class IndexMinPriorityQueue
 */
class IndexMinPriorityQueue
{
    //原数据，不会改变
    private $items;
    //原数据构建的堆
    private $heap;
    //堆的反转元素
    private $resHeap;

    //元素个数
    private $n;

    public function __construct()
    {
        $this->items = [];
        $this->heap = [];
        //堆的索引从1开始
        $this->heap[] = null;
        $this->resHeap = [];
        $this->n = 0;
    }


    public function less($i, $j)
    {
        $indexI = $this->heap[$i];
        $indexJ = $this->heap[$j];

        //根据堆索引存储的key找到元数据中的value进行比较
        if ($this->items[$indexI] > $this->items[$indexJ])
        {
            return true;
        }

        return false;
    }

    /**
     * 交换堆中的元素和反转堆的元素
     * @param $i
     * @param $j
     */
    public function exec($i, $j)
    {
        $temp = $this->heap[$i];
        $this->heap[$i] = $this->heap[$j];
        $this->heap[$j] = $temp;

        $this->resHeap[$this->heap[$i]] = $i;
        $this->resHeap[$this->heap[$j]] = $j;
    }

    public function size()
    {
        return $this->n;
    }

    public function isEmpty()
    {
        return $this->n == 0;
    }

    public function container($key)
    {
        return array_key_exists($key, $this->items);
    }

    public function insert($key, $value)
    {
        if ($this->container($key))
        {
            throw new RuntimeException('key exists');
        }

        $this->items[$key] = $value;
        $this->n++;
        //将key存到堆中
        $this->heap[$this->n] = $key;
        $this->resHeap[$key] = $this->n;

        $this->swim($this->n);
    }

    public function swim($n)
    {
        while ($n > 1)
        {
            if ($this->less($n, intval($n / 2)))
            {
                break;
            }

            $this->exec($n, intval($n / 2));
            $n = $n / 2;
        }
    }

    public function delMin()
    {
        $minIndex = $this->heap[1];
        $minItem = $this->items[$minIndex];

        //交换最大最小元素
        $this->exec(1, $this->n);
        //删除掉resHeap中的元素
        unset($this->resHeap[$this->heap[$this->n]]);
        //删除掉heap中的元素
        unset($this->heap[$this->n]);
        //删除掉原数据中的元素
        unset($this->items[$minIndex]);
        $this->n--;
        $this->sink(1);


        return $minItem;
    }

    /**
     * 下沉操作
     * @param $n
     */
    public function sink($n)
    {
        $length = $this->n;
        while ($n * 2 <= $length)
        {
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

            if ($this->less($n, $min))
            {
                $this->exec($n, $min);
                $n = $min;
            }
            else
            {
                break;
            }
        }
    }
}

$queue = new IndexMinPriorityQueue();
$queue->insert('xiaoming', 'B');
$queue->insert('xiaodong', 'A');
$queue->insert('xiaozhu', 'C');
$queue->insert('xiaogpu', 'D');
$queue->insert('xiaogpux', 'E');


for ($i = 0; $i < 5; $i++)
{
    echo $queue->delMin() . PHP_EOL;
//echo $queue->delMin() . PHP_EOL;
//echo $queue->delMin() . PHP_EOL;
//echo $queue->delMin() . PHP_EOL;
//echo $queue->delMin() . PHP_EOL;
}






