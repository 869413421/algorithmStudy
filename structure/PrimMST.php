<?php
require_once __DIR__ . '/IndexMinPriorityQueue.php';
require_once __DIR__ . '/EdgeWeightedGraph.php';
require_once __DIR__ . '/Edge.php';

/**
 * prim算法
 * Class PrimMST
 */
class PrimMST
{
    //索引代表顶点，值是最小生成树的最短边
    private $edgeTo;
    //索引代表顶点，值是最小生成树的最短边的权重
    private $distTo;
    //索引代表顶点，值为true，代表顶点已经在树中
    private $marked;

    //存放顶点与非树中顶点的有效横切边
    private $pq;

    public function __construct(EdgeWeightedGraph $graph)
    {
        $this->edgeTo = [];

        $this->distTo = [];

        for ($i = 0; $i < $graph->V(); $i++) {
            $this->distTo[$i] = PHP_FLOAT_MAX;
        }

        $this->marked = [];

        $this->pq = new IndexMinPriorityQueue();


        $this->distTo[0] = 0.0;
        $this->pq->insert(0, 0.0);

        while (!$this->pq->isEmpty()) {
            $this->visit($graph, $this->pq->delMin());
        }
    }

    /**
     * 把顶点V添加到最小生成树中
     * @param EdgeWeightedGraph $graph
     * @param $v
     */
    public function visit(EdgeWeightedGraph $graph, $v)
    {
        //把顶点V放到最小生成树中
        $this->marked[$v] = true;
        //更新数据

        foreach ($graph->adj($v) as $item) {
            $w = $item->other($v);
            if (key_exists($w, $this->marked)) {
                continue;
            }

            if ($item->weight() < $this->distTo[$w]) {
                $this->edgeTo[$w] = $item;
                $this->distTo[$w] = $item->weight();

                if ($this->pq->container($w)) {
                    $this->pq->changeItem($w, $item->weight());
                } else {
                    $this->pq->insert($w, $item->weight());
                }
            }
        }
    }

    public function edges()
    {
        $queue = [];

        foreach ($this->edgeTo as $item) {
            if ($item != null) {
                $queue[] = $item;
            }
        }

        return $queue;
    }
}

function testPrimTest()
{
    $file = fopen(__DIR__ . "/min_create_tree_test.txt", "r") or die("Unable to open file!");

    $total = (int)fgets($file);

    $g = new EdgeWeightedGraph($total);

    $line = fgets($file);

    for ($i = 0; $i < $line; $i++) {
        $content = fgets($file);
        $arr = explode(' ', $content);

        $v = intval($arr[0]);
        $w = intval($arr[1]);
        $weight = $arr[2];

        $edge = new Edge($v, $w, $weight);
        $g->addEdge($edge);
    }

    $mst = new PrimMST($g);

    foreach ($mst->edges() as $item) {
        $v = $item->either();
        $w = $item->other($v);
        $weight = $item->weight();

        echo $v . '--' . $w . '::' . $weight . PHP_EOL;
    }
}

testPrimTest();