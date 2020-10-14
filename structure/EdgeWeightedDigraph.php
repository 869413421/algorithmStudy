<?php


class EdgeWeightedDigraph
{
    private $v;

    private $e;

    private $adj;

    public function __construct($v)
    {
        $this->v = $v;
        $this->e = 0;

        for ($i = 0; $i < $v; $i++) {
            $this->adj[$i] = [];
        }
    }

    public function V()
    {
        return $this->v;
    }

    public function E()
    {
        return $this->v;
    }

    public function addEdge(DirectedEdge $edge)
    {
        //起点
        $v = $edge->from();
        $this->adj[$v][] = $edge;

        $this->e++;
    }

    public function adj($v)
    {
        return $this->adj[$v];
    }

    public function edges()
    {
        $arr = [];

        for ($i = 0; $i < $this->v; $i++) {
            foreach ($this->adj[$i] as $item) {
                $arr[] = $item;
            }
        }

        return $arr;
    }
}