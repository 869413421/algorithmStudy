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