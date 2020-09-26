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
    public function isRed(Node $node)
    {
        if ($node == null)
        {
            return false;
        }
        return $node->color == 'RED';
    }
}

class Node
{
    public $key;
    public $value;
    public $left;
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