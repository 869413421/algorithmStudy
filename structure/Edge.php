<?php

/**
 * 加权边
 * Class Edge
 */
class Edge
{
    /**
     * 顶点1
     * @var $v
     */
    private $v;

    /**
     * 顶点2
     * @var $w
     */
    private $w;

    /**
     * 边的权重
     * @var
     */
    private $weight;


    public function __construct($v, $w, $weight)
    {
        $this->v = $v;
        $this->w = $w;
        $this->weight = $weight;
    }

    public function weight()
    {
        return $this->weight;
    }

    public function either()
    {
        return $this->v;
    }

    public function other($vertex)
    {
        if ($vertex == $this->v) {
            return $this->w;
        }

        return $this->v;
    }

    public function compareTo(Edge $that)
    {
        if ($that->weight() > $this->weight()) {
            return 1;
        } elseif ($that->weight() == $this->weight()) {
            return 0;
        }

        return -1;

        return false;
    }
}