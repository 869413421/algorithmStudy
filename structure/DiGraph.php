<?php

/**
 * 有向图
 * Class DiGraph
 */
class DiGraph
{
    private $v;
    private $e;
    private $adj;

    public function __construct($v)
    {
        $this->v = $v;
        $this->e = 0;
        $this->adj = [];

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
        return $this->e;
    }

    public function addEdge($v, $w)
    {
        $this->adj[$v][] = $w;
        $this->e++;
    }

    public function adj($v)
    {
        return $this->adj[$v];
    }

    public function reverse()
    {
        $r = new DiGraph($this->v);

        for ($i = 0; $i < $this->v; $i++) {
            foreach ($this->adj($i) as $item) {
                $r->addEdge($item, $i);
            }
        }

        return $r;
    }
}