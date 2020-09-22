<?php

/**
 * 索引最小队列
 * Class IndexMinPriorityQueue
 */
class IndexMinPriorityQueue
{
    private $items;
    private $pq;
    private $qp;
    private $n;

    public function __construct()
    {
        $this->items = [];
        //用来存储元素在items中的索引，是一个有序堆
        $this->pq = [];
        //逆转索引
        $this->qp = [];
        $this->n = 0;
    }

    public function size()
    {
        return $this->n;
    }

    public function isEmpty()
    {
        return $this->n == 0;
    }

    public function less($i, $j)
    {
        $indexI = $this->pq[$i];
        $indexJ = $this->pq[$j];

        if ($this->items[$indexI] > $this->items[$indexJ])
        {
            return true;
        }

        return false;
    }

    public function exec($i, $j)
    {
        $temp = $this->pq[$i];
        $this->pq[$i] = $this->pq[$j];
        $this->pq[$j] = $temp;

        $this->qp[$this->pq[$i]] = $i;
        $this->qp[$this->pq[$j]] = $j;
    }

    public function contains($key)
    {
        return array_key_exists($key, $this->qp);
    }

    /**
     * 返回最小元素在items中的索引
     * @return mixed
     */
    public function minIndex()
    {
        return $this->pq[1];
    }

    public function insert($key, $value)
    {
        if ($this->contains($key))
        {
            throw new RuntimeException('key exists');
        }

        $this->items[] = $value;
        $this->n++;

        $this->pq[$this->n] = $key;

        $this->qp[$key] = $this->n;

        $this->swim($this->n);
    }

    /**
     * 上浮元素
     * @param $n
     */
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
        //找到items中最小元素的索引
        $minIndex = $this->pq[1];
        // //交换pq中索引1处的值和N处的值
        $this->exec(1, $this->n);
        // //删除qp中索引pq[N]处的值
        unset($this->qp[$this->pq[$this->n]]);
        //删除pq中索引N处的值 pq[N] = -1;
        unset($this->pq[$this->n]);
        // //删除items中的最小元素 items[minIndex] = null;
        unset($this->items[$minIndex]);
        // //元素数量-1 N--;
        $this->n--;
        // //对pq[1]做下沉，让堆有序
        $this->sink(1);

        return $minIndex;
    }

    public function sink()
    {

    }
}