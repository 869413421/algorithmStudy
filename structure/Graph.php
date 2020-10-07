<?php

/**
 * 图
 * Class Graph
 */
class Graph
{
    //顶点数量
    public $e;
    //边的数量
    public $v;
    //邻接图
    public $adj;

    public function __construct($e)
    {
        $this->e = $e;
        $this->v = 0;
        $this->adj = [];
        for ($i = 0; $i < $e; $i++) {
            $this->adj[$i] = [];
        }
    }

    public function E()
    {
        return $this->e;
    }

    public function V()
    {
        return $this->v;
    }

    /**
     * 为两个顶点增加一条表
     * @param $i
     * @param $j
     */
    public function addEdge($i, $j)
    {
        $this->adj[$i][] = $j;
        $this->adj[$j][] = $i;
        $this->adj[$i] = array_unique($this->adj[$i]);
        $this->adj[$j] = array_unique($this->adj[$j]);
        $this->e++;
    }

    /**
     * 获取图所有相邻的顶点
     * @param array
     */
    public function adj($i)
    {
        return $this->adj[$i];
    }
}


$adj = new Graph(10);
$adj->addEdge(1, 2);