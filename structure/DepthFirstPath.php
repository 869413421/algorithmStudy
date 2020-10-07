<?php
require_once __DIR__ . '/Graph.php';

/**
 * 路径查找
 * Class DepthFirstPath
 */
class DepthFirstPath
{
    /**
     * 被搜索过的元素
     * @var $marked
     */
    private $marked;

    /**
     * 搜索的起点
     * @var $s
     */
    private $s;

    /**
     * 查找的路径
     * @var $edgeTo
     */
    private $edgeTo;

    public function __construct(Graph $graph, $s)
    {
        $this->marked = [];
        $this->s = $s;
        $this->edgeTo = [];
        for ($i = 0; $i < $graph->V(); $i++) {
            $this->edgeTo[$i] = null;
        }
        $this->dfs($graph, $s);

    }

    public function dfs(Graph $graph, $v)
    {
        $this->marked[$v] = true;

        foreach ($graph->adj($v) as $item) {
            if (!key_exists($item, $this->marked)) {
                //到达顶点item的上衣个路径是v
                $this->edgeTo[$item] = $v;
                $this->dfs($graph, $item);
            }
        }
    }

    /**
     * 判断顶点是否与s顶点是否存在路径
     * @param $v
     */
    public function hasPathTo($v)
    {
        return key_exists($v, $this->marked);
    }

    public function pathTo($v)
    {
        if (!$this->hasPathTo($v)) {
            return null;
        }

        $path = [];

        for ($x = $v; $x != $this->s; $x = $this->edgeTo[$x]) {
            $path[] = $x;
        }

        $path[] = $this->s;

        return $path;
    }
}

function testDepthFirstPath()
{
    $graph = new Graph(5);

    $graph->addEdge(0, 2);
    $graph->addEdge(0, 1);
    $graph->addEdge(2, 1);
    $graph->addEdge(2, 3);
    $graph->addEdge(2, 4);
    $graph->addEdge(3, 5);
    $graph->addEdge(3, 4);
    $graph->addEdge(0, 5);

    $path = new DepthFirstPath($graph, 0);
    var_dump($path->pathTo(4));
}

testDepthFirstPath();