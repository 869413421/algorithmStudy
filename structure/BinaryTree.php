<?php

//二叉查找树
class BinaryTree
{
    //根节点
    private $root;
    //成员个数
    private $n;

    /**
     * 往树中添加元素key，value
     * @param $key
     * @param $value
     */
    public function put($key, $value)
    {
        $this->root = $this->putRoot($this->root, $key, $value);
    }

    public function putRoot(Node $x = null, $key, $value)
    {
        //1.如果x子树为空,返回当前元素作为根节点
        if ($x == null)
        {
            $this->n++;
            return new Node($key, $value, null, null);
        }
        //2.如果x子树的key不为空，比较x和key的大小，如果key小于x的key，将节点放在左边，否则放在右边
        if ($key > $x->getKey())
        {
            //放在树的右边
            $node = $this->putRoot($x->getRight(), $key, $value);
            $x->setRight($node);
        }
        else if ($key < $x->getKey())
        {
            //放在树的左边
            $node = $this->putRoot($x->getLeft(), $key, $value);
            $x->setLeft($node);
        }
        else if ($key == $x->getKey())
        {
            //如果key相等，替换掉当前节点的值
            $x->setValue($value);
        }

        return $x;
    }

    public function size()
    {
        return $this->n;
    }

    /**
     * 查找数
     * @param $key
     * @return mixed|null
     */
    public function get($key)
    {
        return $this->getRoot($this->root, $key);
    }

    public function getRoot(Node $x = null, $key)
    {
        //1.如果x子树为空,返回空
        if ($x == null)
        {
            return null;
        }
        //2.如果x子树的key不为空，比较x和key的大小，如果key小于x的key，将节点放在左边，否则放在右边
        if ($key > $x->getKey())
        {
            //在树的右边。进行查找
            return $this->getRoot($x->getRight(), $key);
        }
        else if ($key < $x->getKey())
        {
            //放在树的左边
            return $this->getRoot($x->getLeft(), $key);
        }
        else if ($key == $x->getKey())
        {
            //如果key相等，找到要查找key的值
            return $x->getValue();
        }
    }

    /**
     * 查找数中最小的建
     * @return mixed
     */
    public function min()
    {
        return $this->getMin($this->root)->getKey();
    }

    /**
     * @param Node $x
     * @return Node
     */
    public function getMin(Node $x = null)
    {
        if ($x->getLeft() != null)
        {
            return $this->getMin($x->getLeft());
        }
        else
        {
            return $x;
        }
    }

    /**
     * 找到树中最大的键
     * @return mixed
     */
    public function max()
    {
        return $this->getMax($this->root)->getKey();
    }

    public function getMax(Node $x = null)
    {
        if ($x->getRight() != null)
        {
            return $this->getMax($x->getRight());
        }
        else
        {
            return $x;
        }
    }

    public function delete($key)
    {
        $this->root = $this->deleteRoot($this->root, $key);
    }

    public function deleteRoot(Node $x, $key)
    {
        if ($x == null)
        {
            //找不到key关联的节点
            return null;
        }
        //2.如果x子树的key不为空，比较x和key的大小
        if ($key > $x->getKey())
        {
            //在树的右边。进行查找
            $x->setRight($this->deleteRoot($x->getRight(), $key));
        }
        else if ($key < $x->getKey())
        {
            //在树的左边。进行查找
            $x->setLeft($this->deleteRoot($x->getLeft(), $key));
        }
        else if ($key == $x->getKey())
        {
            //如果key相等，找到要查找key的值
            //1.如果当前结点的右子树不存在，则直接返回当前结点的左子结点
            if ($x->getRight() == null)
            {
                return $x->getLeft();
            }
            //2.如果当前结点的左子树不存在，则直接返回当前结点的右子结点
            if ($x->getLeft() == null)
            {
                return $x->getRight();
            }

            //3.当前结点的左右子树都存在
            //3.1找到右子树中最小的结点
            $minNode = $x->getRight();
            while ($minNode->getLeft() != null)
            {
                $minNode = $minNode->getLeft();
            }

            //3.2删除右子树中最小的结点
            $n = $x->getRight();
            while ($n->getLeft() != null)
            {
                //如果是最后一个元素
                if ($n->getLeft()->getLeft() == null)
                {
                    $n->setLeft(null);
                }
                else
                {
                    $n = $n->getLeft();
                }
            }

            $minNode->setLeft($x->getLeft());
            $minNode->setRight($x->getRight());
            $x = $minNode;
            $this->n--;
        }

        return $x;
    }

    /**
     * 先访问根结点，然后再访问左子树，最后访问右子树
     * @return array
     */
    public function preErgodic()
    {
        $queue = [];
        $this->preErgodicByNode($this->root, $queue);
        return $queue;
    }

    public function preErgodicByNode(Node $x = null, array &$queue)
    {
        //节点已空不处理
        if ($x == null)
        {
            return null;
        }
        //1.把当前节点的键存储到队列中去
        $queue[] = $x->getKey();
        //2.找到当前节点的左子树，如果不为空，递归遍历左子树
        if ($x->getLeft() != null)
        {
            $this->preErgodicByNode($x->getLeft(), $queue);
        }
        //2.找到当前节点的右子树，如果不为空，递归遍历右子树
        if ($x->getRight() != null)
        {
            $this->preErgodicByNode($x->getRight(), $queue);
        }
    }

    /**
     * 先遍历中间节点，再遍历左边节点，最后遍历右边节点
     * @return array
     */
    public function midErgodic()
    {
        $queue = [];
        $this->midErgodicByNode($this->root, $queue);
        return $queue;
    }

    public function midErgodicByNode(Node $x = null, array &$queue)
    {
        if ($x == null)
        {
            return;
        }
        //1.找到当前结点的左子树，如果不为空，递归遍历左子树
        if ($x->getLeft() != null)
        {
            $this->midErgodicByNode($x->getLeft(), $queue);
        }
        //2.把当前结点的key放入到队列中;
        $queue[] = $x->getKey();
        //3.找到当前结点的右子树，如果不为空，递归遍历右子树
        if ($x->getRight() != null)
        {
            $this->midErgodicByNode($x->getRight(), $queue);
        }
    }

    /**
     * 后序遍历，先左再右，最后插入中间
     * @return array
     */
    public function afterErgodic()
    {
        $queue = [];
        $this->afterErgodicByNode($this->root, $queue);
        return $queue;
    }

    public function afterErgodicByNode(Node $x = null, array &$queue)
    {
        if ($x == null)
        {
            return;
        }

        if ($x->getLeft() != null)
        {
            $this->afterErgodicByNode($x->getLeft(), $queue);
        }

        if ($x->getRight() != null)
        {
            $this->afterErgodicByNode($x->getRight(), $queue);
        }

        $queue[] = $x->getKey();
    }

    /**
     * 层级遍历
     * @return array
     */
    public function layerErgodic()
    {
        //1.定义两个队列，分别存储键和节点
        $nodes = [];
        $keys = [];
        $nodes[] = $this->root;
        while (count($nodes) > 0)
        {
            //从队列中弹出一个节点，把key放进队列当中
            $x = array_shift($nodes);
            $keys[] = $x->getKey();

            //判断当前有没有左子节点，如果有，放到nodes中
            if ($x->getLeft() != null)
            {
                $nodes[] = $x->getLeft();
            }

            //判断当前有没有左子节点，如果有，放到nodes中
            if ($x->getRight() != null)
            {
                $nodes[] = $x->getRight();
            }
        }

        return $keys;
    }

    /**
     * 求树的最大深度
     * @return int
     */
    public function maxDepth()
    {
        return $this->getMaxDepth($this->root);
    }

    public function getMaxDepth(Node $x = null)
    {
        if ($x == null)
        {
            return 0;
        }

        $maxL = 0;
        $maxR = 0;
        if ($x->getLeft() != null)
        {
            $maxL = $this->getMaxDepth($x->getLeft());
        }
        if ($x->getRight() != null)
        {
            $maxR = $this->getMaxDepth($x->getRight());
        }

        $max = $maxL > $maxR ? $maxL + 1 : $maxR + 1;
        return $max;
    }
}

class Node
{
    private $left;
    private $right;
    private $key;
    private $value;


    public function __construct($key, $value, $left, $right)
    {
        $this->key = $key;
        $this->value = $value;
        $this->left = $left;
        $this->right = $right;
    }

    /**
     * @return Node
     */
    public function getLeft()
    {
        return $this->left;
    }

    /**
     * @param mixed $left
     */
    public function setLeft($left)
    {
        $this->left = $left;
    }

    /**
     * @return Node
     */
    public function getRight()
    {
        return $this->right;
    }

    /**
     * @param mixed $right
     */
    public function setRight($right)
    {
        $this->right = $right;
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param mixed $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
}

$binaryTree = new BinaryTree();
$binaryTree->put(5, '小明');
$binaryTree->put(4, '小洞');
$binaryTree->put(3, '小西');
$binaryTree->put(7, '小北');
$binaryTree->put(7, '小男');
$binaryTree->put(1, '小🐖');

echo $binaryTree->get(5) . PHP_EOL;
echo $binaryTree->get(4) . PHP_EOL;
echo $binaryTree->get(3) . PHP_EOL;
echo $binaryTree->get(7) . PHP_EOL;
echo '删除元素' . PHP_EOL;
$binaryTree->delete(7);
echo '删除后元素:' . $binaryTree->get(7) . PHP_EOL;
echo '树中最小的键:' . $binaryTree->min() . PHP_EOL;
echo '树中最大的键:' . $binaryTree->max() . PHP_EOL;

function testPreErgodic()
{
    $binaryTree = new BinaryTree();
    $binaryTree->put("E", "5");
    $binaryTree->put("B", "2");
    $binaryTree->put("G", "7");
    $binaryTree->put("A", "1");
    $binaryTree->put("D", "4");
    $binaryTree->put("F", "6");
    $binaryTree->put("H", "8");
    $binaryTree->put("C", "3");

    $queue = $binaryTree->preErgodic();

    for ($i = 0; $i < count($queue); $i++)
    {
        echo $queue[$i] . PHP_EOL;
    }
}

echo '前序遍历' . PHP_EOL;
testPreErgodic();

function testMidErgodic()
{
    $binaryTree = new BinaryTree();
    $binaryTree->put("E", "5");
    $binaryTree->put("B", "2");
    $binaryTree->put("G", "7");
    $binaryTree->put("A", "1");
    $binaryTree->put("D", "4");
    $binaryTree->put("F", "6");
    $binaryTree->put("H", "8");
    $binaryTree->put("C", "3");

    $queue = $binaryTree->midErgodic();

    for ($i = 0; $i < count($queue); $i++)
    {
        echo $queue[$i] . PHP_EOL;
    }
}

echo '中序遍历' . PHP_EOL;
testMidErgodic();

function testAfterErgodic()
{
    $binaryTree = new BinaryTree();
    $binaryTree->put("E", "5");
    $binaryTree->put("B", "2");
    $binaryTree->put("G", "7");
    $binaryTree->put("A", "1");
    $binaryTree->put("D", "4");
    $binaryTree->put("F", "6");
    $binaryTree->put("H", "8");
    $binaryTree->put("C", "3");

    $queue = $binaryTree->afterErgodic();

    for ($i = 0; $i < count($queue); $i++)
    {
        echo $queue[$i] . PHP_EOL;
    }
}

echo '后序遍历' . PHP_EOL;
testAfterErgodic();

function testLayerErgodic()
{
    $binaryTree = new BinaryTree();
    $binaryTree->put("E", "5");
    $binaryTree->put("B", "2");
    $binaryTree->put("G", "7");
    $binaryTree->put("A", "1");
    $binaryTree->put("D", "4");
    $binaryTree->put("F", "6");
    $binaryTree->put("H", "8");
    $binaryTree->put("C", "3");

    $queue = $binaryTree->layerErgodic();

    for ($i = 0; $i < count($queue); $i++)
    {
        echo $queue[$i] . PHP_EOL;
    }
}

echo '层级遍历' . PHP_EOL;
testLayerErgodic();

function testMaxDepth()
{
    $binaryTree = new BinaryTree();
    $binaryTree->put("E", "5");
    $binaryTree->put("B", "2");
    $binaryTree->put("G", "7");
    $binaryTree->put("A", "1");
    $binaryTree->put("D", "4");
    $binaryTree->put("F", "6");
    $binaryTree->put("H", "8");
    $binaryTree->put("C", "3");

    return $binaryTree->maxDepth();
}

echo '树的最大深度' . testMaxDepth() . PHP_EOL;
