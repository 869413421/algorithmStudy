<?php

/**
 * 并集合查
 * Class UF
 */
class UF
{
    private $eleAndGroup;
    private $size = [];
    private $n;

    public function __construct($n)
    {

        $this->eleAndGroup = [];
        $this->n = $n;

        for ($i = 0; $i < $n; $i++) {
            $this->eleAndGroup[$i] = $i;
        }

        for ($i = 0; $i < $n; $i++) {
            $this->size[$i] = 1;
        }
    }

    /**
     * 返回并查值中的所有分组
     * @return mixed
     */
    public function count()
    {
        return $this->n;
    }

    /**
     * 返回元素的分组表示符
     * @param $index
     * @return mixed
     */
    public function find($index)
    {
        $index = (int)$index;
        while (true) {
            if ($index == $this->eleAndGroup[$index]) {
                //找到最终根节点
                return $index;
            }

            $index = (int)$this->eleAndGroup[$index];
        }
    }

    /**
     * 判断元素是否所属同一个分组
     * @param $p
     * @param $q
     * @return bool
     */
    public function connected($p, $q)
    {
        return $this->find($p) == $this->find($q);
    }

    /**
     * 合并两个分组
     * @param $p
     * @param $q
     */
    public function union($p, $q)
    {
        $pRoot = $this->eleAndGroup[(int)$p];
        $qRoot = $this->eleAndGroup[(int)$q];
        if ($qRoot == $pRoot) {
            return;
        }
        //最小路径，让小数合并到大树,减少树的高度
        if ($this->size[$pRoot] < $this->size[$qRoot]) {
            $this->eleAndGroup[$pRoot] = $qRoot;
            $this->size[$qRoot] += $this->size[$pRoot];
        } else {
            $this->eleAndGroup[$qRoot] = $pRoot;
            $this->size[$pRoot] += $this->size[$qRoot];
        }

        $this->n--;
    }
}

//$uf = new UF(5);


//while (true) {
//    fwrite(STDOUT, '请输入第一个参数：');
//    $p = fgets(STDIN);
//    fwrite(STDOUT, '请输入第二个参数：');
//    $q = fgets(STDIN);
//
//    if ($uf->connected($p, $q)) {
//        echo '两个参数已经再同一个组中。' . PHP_EOL;
//        continue;
//    }
//
//    $uf->union($p, $q);
//    echo '剩下分组。' . $uf->count() . PHP_EOL;
//}

//道路畅通工程
function trafficProject()
{
    $file = fopen(__DIR__ . "/tarfficProject.txt", "r") or die("Unable to open file!");

    $groupCount = (int)fgets($file);
    //城市数目
    $uf = new UF($groupCount);
    //已经修建设道路
    $line = fgets($file);

    for ($i = 0; $i < $line; $i++) {
        $content = fgets($file);
        $arr = explode(' ', $content);

        $city1 = intval($arr[0]);
        $city2 = intval($arr[1]);
        $uf->union($city1, $city2);
    }

    echo $uf->count()-1;
}

trafficProject();




