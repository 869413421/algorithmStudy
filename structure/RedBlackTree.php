<?php


class RedBlackTree
{
    public $root;
    public $n;
    public $red;
    public $black;

    public function size()
    {
        return $this->n;
    }

    /**
     * 判断当前节点是否为红色节点
     * @param Node $node
     * @return mixed
     */
    public function isRed(Node $node = null)
    {
        if ($node == null) {
            return false;
        }

        return $node->color == 'RED';
    }

    /**
     * 左旋节点
     * @param Node $h
     * @return Node
     */
    public function rotateLeft(Node $h)
    {
        //1.找到当前节点的右子节点
        $x = $h->right;
        //2.让x的左子节点成为h的右子节点
        $h->right = $x->left;
        //3.让h成为x的左子节点
        $x->left = $h;
        //4.让x的color成为h的color;
        $x->color = $h->color;
        //5.让h的color变成RED
        $h->color = 'RED';

        return $x;
    }

    /**
     * 右旋节点
     * @param Node $h
     * @return Node
     */
    public function rotateRight(Node $h)
    {
        //1.找到当前节点的左子节点
        $x = $h->left;
        //2.让x节点的右子节点成为h的左子节点
        $h->left = $x->right;
        //3.让h成为x节点的右子节点
        $x->right = $h;
        //4.让x节点的color变成h的color
        $x->color = $h->color;
        //5.让h的color变成RED
        $h->color = 'RED';

        return $x;
    }

    /**
     * 颜色反转
     * @param Node $x
     * @return Node
     */
    public function flipColor(Node $x)
    {
        //1.让当前节点变成红色
        $x->color = 'RED';
        //2.让左子节点变成黑色
        $x->left->color = 'BLACK';
        //3.让右子节点变成黑色
        $x->right->color = 'BLACK';

        return $x;
    }

    /**
     * 插入操作
     * @param $key
     * @param $value
     */
    public function put($key, $value)
    {
        $this->root = $this->putItem($this->root, $key, $value);
        $this->root->color = 'BLACK';
    }

    public function putItem(Node $node = null, $key, $value)
    {
        //如果为空直接返回一个新的节点，颜色为红色
        if ($node == null) {
            $this->n++;
            return new Node($key, $value, null, null, 'RED');
        }


        if ($key > $node->key) {
            $node->left = $this->putItem($node->right, $key, $value);
        }
        if ($key < $node->key) {
            $node->right = $this->putItem($node->left, $key, $value);
        }

        if ($key == $node->key) {
            $node->value = $value;
        }

        //如果当前节点的右子节点为红色，并且右子节点为黑色
        if ($this->isRed($node->right) && !$this->isRed($node->left)) {
            $node = $this->rotateLeft($node);
        }

        //如果当前节点的左子节和左子节点的左子节点都为红色，需要右旋
        if ($this->isRed($node->left) && $this->isRed($node->left->left)) {
            $node = $this->rotateRight($node);
        }

        //如果当前节点的左子节点和右子节点都为红色，需要进行颜色反转
        if ($this->isRed($node->left) && $this->isRed($node->right)) {
            $node = $this->flipColor($node);
        }

        return $node;
    }

    /**
     * 查找
     * @param $key
     * @return |null
     */
    public function get($key)
    {
        $value = $this->getItem($this->root, $key);
        var_dump($value);
        return $value;
    }

    public function getItem(Node $node = null, $key)
    {
        if ($node == null) {
            return null;
        }

        if ($key < $node->key) {
            return $this->getItem($node->left, $key);
        }
        if ($key > $node->key) {
            return $this->getItem($node->right, $key);
        }

        if ($key == $node->key) {
            return $node->value;
        }
    }
}

class Node
{
    public $key;
    public $value;
    /**
     * @var $left Node
     */
    public $left;
    /**
     * @var $right Node
     */
    public $right;
    public $color;

    public function __construct($key, $value, $left, $right, $color)
    {
        $this->key = $key;
        $this->value = $value;
        $this->left = $left;
        $this->right = $right;
        $this->color = $color;
    }
}

$tree = new RedBlackTree();
$tree->put(1, '张三');
$tree->put(2, '李四');
$tree->put(3, '王五');
$tree->put(4, '傻六');

//for ($i = 1; $i <= 4; $i++)
//{
//    echo $tree->get($i) . PHP_EOL;
//}
echo $tree->get(1) . PHP_EOL;
echo $tree->get(2) . PHP_EOL;
echo $tree->get(3) . PHP_EOL;
echo $tree->get(4) . PHP_EOL;