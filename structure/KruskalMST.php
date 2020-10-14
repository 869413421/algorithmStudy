<?php
require_once __DIR__ . '/EdgeWeightedGraph.php';
require_once __DIR__ . '/Edge.php';
require_once __DIR__ . '/MinPriorityQueue.php';
require_once __DIR__ . '/UF.php';

/**
 * krusal算法
 * Class KrusalMST
 */
class KrusalMST
{
    //最小生成树的所有边
    private $mst;

    private $uf;

    private $pq;

    public function __construct(EdgeWeightedGraph $graph)
    {
        $this->mst = [];

        $this->uf = new UF($graph->V());

        $this->pq = new MinPriorityQueue();

        foreach ($graph->edges() as $edge) {
            $this->pq->insert($edge);
        }
        //遍历队列，拿到最小权重的边进行处理
        while (!$this->pq->isEmpty() && count($this->mst) < $graph->V() - 1) {
            //找到权重最小的边
            $e = $this->pq->deleteMin();

            $v = $e->either();
            $w = $e->other($v);

            //判断两个顶点在同一个树中，不进行处理。如果不在，合并到同一颗树中
            if ($this->uf->connected($v, $w)) {
                continue;
            }

            $this->uf->union($v, $w);

            $this->mst[] = $e;
        }
    }

    /**
     * 返回最小生成树的边
     * @return array
     */
    public function edges()
    {
        return $this->mst;
    }
}

function testKrusalMST()
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

    $mst = new KrusalMST($g);

    foreach ($mst->edges() as $item) {
        $v = $item->either();
        $w = $item->other($v);
        $weight = $item->weight();

        echo PHP_EOL . $v . '--' . $w . '::' . $weight . PHP_EOL;
    }
}

testKrusalMST();