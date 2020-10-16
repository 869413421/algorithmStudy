<?php
require_once __DIR__ . '/IndexMinPriorityQueue.php';
require_once __DIR__ . '/EdgeWeightedDigraph.php';
require_once __DIR__ . '/DirectedEdge.php';

/**
 * 最短路径Dijkstra算法
 * Class DijkstraSP
 */
class DijkstraSP
{
    //索引代表顶点，值表示从顶点s到当前顶点的最短路径上的最后一条边;
    private $edgeTo;
    //索引代表顶点，值从顶点s到当前顶点的最短路径的总权重;
    private $distTo;
    //存放树中顶点与非树中顶点之间的有效横切边;
    private $pq;

    /**
     * DijkstraSP constructor.
     * @param EdgeWeightedDigraph $graph *加权有向图
     * @param $s *起始的定点
     */
    public function __construct(EdgeWeightedDigraph $graph, $s)
    {
        $this->edgeTo = [];
        $this->distTo = [];
        for ($i = 0; $i < $graph->V(); $i++)
        {
            $this->distTo[$i] = PHP_FLOAT_MAX;
        }

        $this->pq = new IndexMinPriorityQueue();
        //默认让顶点s进入树中，但s顶点目前没有与树中其他的顶点相连接，因此初始化distTo[s]=0.0
        $this->distTo[$s] = 0;
        //使用顶点s和权重0.0初始化pq
        $this->pq->insert($s, 0.00);
        //遍历有效队列
        if (!$this->pq->isEmpty())
        {
            //松弛图G中的顶点 relax(G, pq.delMin());
        }
    }

    /***
     * 松弛图中的定点
     * @param EdgeWeightedDigraph $graph
     * @param $v
     */
    public function relax(EdgeWeightedDigraph $graph, $v)
    {
        //松弛顶点v就是松弛顶点v邻接表中的每一条边，遍历邻接表
        foreach ($graph->adj($v) as $e)
        {
            /**@var $e DirectedEdge * */
            //获取边e的终点
            $w = $e->from();
            //起点s到顶点w的权重是否大于起点s到顶点v的权重+边e的权重,如果大于，则修改s->w的路径： edgeTo[w]=e,并修改distTo[v] = distTo[v]+e.weitht(),如果不大于，则忽略
            if ($this->distTo[$w] > $this->distTo[$v] + $e->weight())
            {
                $this->distTo[$w] = $this->distTo[$v] + $e->weight();
                $this->edgeTo[$w] = $e;
                //如果顶点w已经存在于优先队列pq中，则重置顶点w的权重
                if ($this->pq->container($w))
                {
                    $this->pq->changeItem($w, distTo[$w]);
                }
                else
                {
                    //如果顶点w没有出现在优先队列pq中，则把顶点w及其权重加入到pq中
                    $this->pq->insert($w, $this->distTo[$w]);
                }
            }
        }
    }

    /**
     * 获取顶点s到V最短路径的总权重
     * @param $v
     * @return mixed
     */
    public function distTo($v)
    {
        return $this->distTo[$v];
    }

    /**
     * 判断顶点s是否可以到达v
     * @param $v
     * @return bool
     */
    public function hasPathTo($v)
    {
        return $this->distTo[$v] < PHP_FLOAT_MAX;
    }

    /**
     * 返回s顶点到v的所有边
     * @param $v
     * @return array|null
     */
    public function pathTo($v)
    {
        if (!$this->hasPathTo($v))
        {
            return null;
        }

        $edges = [];
        $e = null;
        while (true)
        {
            $e = $this->edgeTo[$v];
            if ($e == null)
            {
                break;
            }
            $edges[] = $e;
            $v = $e->from();
        }

        return $edges;
    }
}

function testDijkstraSP()
{
    $file = fopen(__DIR__ . "/min_route_test.txt", "r") or die("Unable to open file!");

    $total = (int)fgets($file);

    $g = new EdgeWeightedDigraph($total);

    $line = fgets($file);

    for ($i = 0; $i < $line; $i++)
    {
        $content = fgets($file);
        $arr = explode(' ', $content);

        $v = intval($arr[0]);
        $w = intval($arr[1]);
        $weight = $arr[2];

        $edge = new DirectedEdge($v, $w, $weight);
        $g->addEdge($edge);
    }

    $mst = new DijkstraSP($g, 0);
    foreach ($mst->pathTo(7) as $item)
    {
        $v = $item->from();
        $w = $item->to();
        $weight = $item->weight();

        echo $v . '--' . $w . '::' . $weight . PHP_EOL;
    }
}

testDijkstraSP();