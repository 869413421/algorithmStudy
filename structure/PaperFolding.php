<?php

/**
 * 折纸问题
 * Class PaperFolding
 */
class PaperFolding
{
    public function createTree($n)
    {
        $root = null;
        for ($i = 0; $i < $n; $i++)
        {
            if ($i == 0)
            {
                //1.第一次对折，只有一条折痕，创建根结点；
                $root = new Node('down', null, null);
            }
            else
            {
                //2.如果不是第一次对折，则使用队列保存根结点；
                $arr = [];
                $arr[] = $root;
                //3.循环遍历队列：
                while (count($arr))
                {
                    //3.1从队列中拿出一个结点；
                    $temp = array_shift($arr);
                    //3.2如果这个结点的左子结点不为空，则把这个左子结点添加到队列中；
                    if ($temp->left != null)
                    {
                        $arr[] = $temp->left;
                    }

                    //3.3如果这个结点的右子结点不为空，则把这个右子结点添加到队列中；
                    if ($temp->right != null)
                    {
                        $arr[] = $temp->right;
                    }

                    //3.4判断当前结点的左子结点和右子结点都不为空，如果是，则需要为当前结点创建一个 值为down的左子结点，一个值为up的右子结点。
                    if ($temp->left == null && $temp->right == null)
                    {
                        $temp->left = new Node('down', null, null);
                        $temp->right = new Node('up', null, null);
                    }
                }
            }
        }

        return $root;
    }

    public function echoTree($tree)
    {
        if ($tree == null)
        {
            return;
        }

        $this->echoTree($tree->left);
        echo $tree->value . PHP_EOL;
        $this->echoTree($tree->right);
    }
}

class Node
{
    public $value;
    public $left;
    public $right;

    public function __construct($value, $left, $right)
    {
        $this->value = $value;
        $this->left = $left;
        $this->right = $right;
    }
}

$paperFolding = new PaperFolding();
$tree = $paperFolding->createTree(2);
$paperFolding->echoTree($tree);