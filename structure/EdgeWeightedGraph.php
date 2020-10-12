<?php
require_once __DIR__ . '/Edge.php';

/**
 * 加权无向图
 * Class EdgeWeightedGraph
 */
class EdgeWeightedGraph
{
    private $v;

    private $e;

    private $adj;

    public function __construct($v)
    {
        $this->v = $v;
        $this->e = 0;
        for ($i = 0; $i < $this->v; $i++) {
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

    public function addEdge(Edge $edge)
    {
        $v = $edge->either();
        $w = $edge->other($v);
        $this->adj[$v][] = $edge;
        $this->adj[$w][] = $edge;

        $this->e++;
    }

    public function adj($v)
    {
        return $this->adj[$v];
    }

    /**
     * 获取图中所有的边
     * @return array
     */
    public function edges()
    {
        $allEdges = [];

        for ($i = 0; $i < $this->V(); $i++) {
            foreach ($this->adj($i) as $item) {
                if ($item->other($i) > $i) {
                    $allEdges[] = $item;
                }
            }
        }

        return $allEdges;
    }
}

function testEdgeWeightedGraph()
{
    $graph = new EdgeWeightedGraph(3);

    for ($i = 0; $i < 2; $i++) {
        $edge = new Edge($i, $i + 1, $i);
        $graph->addEdge($edge);
    }

    var_dump($graph->edges());
}


testEdgeWeightedGraph();