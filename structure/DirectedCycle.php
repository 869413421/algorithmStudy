<?php
require_once __DIR__ . '/DiGraph.php';

/**
 * 检测有向环
 * Class DirectedCycle
 */
class DirectedCycle
{
    private $marked;

    private $hasCycle;

    private $onStack;

    public function __construct(DiGraph $graph)
    {
        $this->marked = [];

        $this->onStack = [];

        $this->hasCycle = false;

        for ($i = 0; $i < $graph->V(); $i++) {
            if (!key_exists($i, $this->marked)) {
                $this->dfs($graph, $i);
            }
        }
    }

    public function dfs(DiGraph $graph, $v)
    {
        $this->marked[$v] = true;
        $this->onStack[$v] = true;

        foreach ($graph->adj($v) as $item) {
            if (!key_exists($item, $this->marked)) {
                $this->dfs($graph, $item);
            }

            //如果值已经再队列中，说明图中存在环
            if (key_exists($item, $this->onStack) && $this->onStack[$item]) {
                $this->hasCycle = true;
                return;
            }
        }

        unset($this->onStack[$v]);
    }

    public function hasCycle()
    {
        return $this->hasCycle;
    }
}

function testDirectCycle()
{
    $g = new DiGraph(3);

    $g->addEdge(0, 1);
    $g->addEdge(1, 2);
//    $g->addEdge(2, 0);

    $directedCycle = new DirectedCycle($g);
    echo '图中是否有环：' . (int)$directedCycle->hasCycle();

}

testDirectCycle();
