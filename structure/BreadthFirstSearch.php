<?php
require_once __DIR__ . '/Graph.php';

/**
 * 广度优先算法
 * Class BreadthFirstSearch
 */
class BreadthFirstSearch
{
    /**
     * 记录顶点是否已经被搜索
     * @var $marked
     */
    private $marked;

    /**
     * 与顶点相邻的数目
     * @var $count
     */
    private $count;

    /**
     * 待搜索邻接表的顶点
     * @var$waitSearch
     */
    private $waitSearch;

    public function __construct(Graph $graph, $v)
    {
        $this->marked = [];
        $this->count = 0;
        $this->waitSearch = [];
        $this->dfs($graph, $v);
    }

    public function dfs(Graph $graph, $v)
    {
        //把当前顶点v标记为已搜索
        $this->marked[$v] = true;
        //把当前顶点v放入到队列中，等待搜索它的邻接表
        $this->waitSearch[] = $v;

        while (count($this->waitSearch)) {
            //使用while循环从队列中拿出待搜索的顶点wait，进行搜索邻接表
            $wait = array_shift($this->waitSearch);
            //遍历wait顶点的邻接表，得到每一个顶点w
            foreach ($graph->adj($wait) as $item) {
                //如果当前顶点w没有被搜索过，则递归搜索与w顶点相通的其他顶点
                if (!key_exists($item, $this->marked)) {
                    $this->dfs($graph, $item);
                }
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

function testBreadFirstSearch()
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

    $search = new BreadthFirstSearch($graph, 0);
    //与起点0相通的数量
    echo $search->count() . PHP_EOL;

    //5是否和0相通
    echo $search->marked(5) . PHP_EOL;
    //7是否和0相通
    echo $search->marked(7) . PHP_EOL;
}

testBreadFirstSearch();