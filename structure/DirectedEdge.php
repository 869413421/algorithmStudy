<?php

/**
 * 加权有向边
 * Class DirectedEdge
 */
class DirectedEdge
{
    private $weight;

    private $from;

    private $to;

    public function __construct($from, $to, $weight)
    {
        $this->from = $from;
        $this->to = $to;
        $this->weight = $weight;
    }

    public function weight()
    {
        return $this->weight;
    }

    public function from()
    {
        return $this->from;
    }

    public function to()
    {
        return $this->to;
    }
}