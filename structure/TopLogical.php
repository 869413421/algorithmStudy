<?php
require_once __DIR__ . '/DiGraph.php';
require_once __DIR__ . '/DirectedCycle.php';
require_once __DIR__ . '/DepthFirstOrder.php';

/***
 * 拓扑排序
 * Class TopLogical
 */
class TopLogical
{
    private $order;

    public function __construct(DiGraph $graph)
    {
        $this->order = null;
        $directedCycle = new DirectedCycle($graph);
        if ($directedCycle->hasCycle()) {
            return;
        }

        $depthFirstOrder = new DepthFirstOrder($graph);
        $this->order = $depthFirstOrder->reversePost();
    }

    public function isCycle()
    {
        return $this->order == null;
    }

    public function order()
    {
        return $this->order;
    }
}


function testTopLogical()
{
    $g = new DiGraph(6);
    $g->addEdge(0, 2);
    $g->addEdge(0, 3);
    $g->addEdge(2, 4);
    $g->addEdge(3, 4);
    $g->addEdge(4, 5);
    $g->addEdge(1, 3);

    $top = new TopLogical($g);
    $order = $top->order();
    while (count($order)) {
        echo array_pop($order) . PHP_EOL;
    }
}

testTopLogical();

