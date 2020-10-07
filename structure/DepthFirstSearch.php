<?php
require_once __DIR__ . '/Graph.php';

/**
 * 深度优先算法
 * Class DepthFirstSearch
 */
class DepthFirstSearch
{
    /**
     * 记录顶点是否已经被搜索，索引为值，存储true，false
     * @var
     */
    private $marked;
    /**
     * 记录多少个顶点与S相通
     * @var
     */
    private $count;

    public function __construct(Graph $graph, $s)
    {
        $this->marked = [];
        $this->count = 0;
        $this->dfs($graph, $s);
    }

    /**
     * 使用深度优先算法，找出所有与节点相通的顶点
     * @param Graph $graph
     * @param $v
     */
    public function dfs(Graph $graph, $v)
    {
        //记录顶点v已经被搜索
        $this->marked[$v] = true;

        //找到和v相邻的所有顶点
        foreach ($graph->adj($v) as $item) {
            if (!key_exists($item, $this->marked)) {
                $this->dfs($graph, $item);
            }
        }

        $this->count++;
    }

    public function marked($i)
    {
        return key_exists($i, $this->marked);
    }

    /**
     * 与顶点v相通的所有节点
     * @return int
     */
    public function count()
    {
        return $this->count;
    }
}

function testDepthFirstSearch()
{
    $graph = new Graph(13);
    $graph->addEdge(0, 5);
    $graph->addEdge(0, 1);
    $graph->addEdge(0, 2);
    $graph->addEdge(0, 6);
    $graph->addEdge(5, 3);
    $graph->addEdge(5, 4);
    $graph->addEdge(3, 4);
    $graph->addEdge(4, 6);

    $graph->addEdge(7, 8);

    $graph->addEdge(9, 11);
    $graph->addEdge(9, 10);
    $graph->addEdge(9, 12);
    $graph->addEdge(11, 12);

    $search = new DepthFirstSearch($graph, 0);
    //与起点0相通的数量
    echo $search->count() . PHP_EOL;

    //5是否和0相通
    echo $search->marked(5) . PHP_EOL;
    //7是否和0相通
    echo $search->marked(7) . PHP_EOL;
}

testDepthFirstSearch();

//道路畅通工程
function trafficProject()
{
    $file = fopen(__DIR__ . "/tarfficProject.txt", "r") or die("Unable to open file!");

    $groupCount = (int)fgets($file);
    //城市数目
    $graph = new Graph($groupCount);
    //已经修建设道路
    $line = fgets($file);

    for ($i = 0; $i < $line; $i++) {
        $content = fgets($file);
        $arr = explode(' ', $content);

        $city1 = intval($arr[0]);
        $city2 = intval($arr[1]);
        $graph->addEdge($city1, $city2);
    }

    $search = new DepthFirstSearch($graph, 2);
    echo '9号是否与10号相通' . $search->marked(10) . PHP_EOL;
    echo '9号是否与10号相通' . $search->marked(8) . PHP_EOL;
}

trafficProject();