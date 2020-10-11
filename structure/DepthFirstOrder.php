<?php
require_once __DIR__ . '/DiGraph.php';

/**
 * 顶点排序
 * Class DepthFirstOrder
 */
class DepthFirstOrder
{
    private $marked;
    private $reversePost;

    public function __construct(DiGraph $graph)
    {
        $this->marked = [];
        $this->reversePost = [];

        for ($i = 0; $i < $graph->V(); $i++) {
            if (!key_exists($i, $this->marked)) {
                $this->dfs($graph, $i);
            }
        }

    }

    public function dfs(DiGraph $graph, $v)
    {
        $this->marked[$v] = true;
        foreach ($graph->adj($v) as $item) {
            if (!key_exists($item, $this->marked)) {
                $this->dfs($graph, $item);
            }
        }

        $this->reversePost[] = $v;
    }

    public function reversePost()
    {
        return $this->reversePost;
    }
}