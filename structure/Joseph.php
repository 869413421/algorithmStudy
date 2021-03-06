<?php

class  Node
{
    private $value;
    private $next;

    public function __construct($value, $next)
    {
        $this->value = $value;
        $this->next = $next;
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
    public function setValue($value): void
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getNext(): Node
    {
        return $this->next;
    }

    /**
     * @param mixed $next
     */
    public function setNext($next): void
    {
        $this->next = $next;
    }
}

function joseph()
{
    //创建一个41人的环
    $pre = null;
    $first = null;
    for ($i = 1; $i <= 41; $i++)
    {
        if ($i == 1)
        {
            $first = new Node($i, null);
            $pre = $first;
            continue;
        }

        $node = new Node($i, null);
        $pre->setNext($node);
        $pre = $node;

        if ($i == 41)
        {
            $pre->setNext($first);
        }
    }

    $count = 0;
    $n = $first;
    $before = null;

    while ($n != $n->getNext())
    {
        $count++;
        if ($count == 3)
        {
            //删除元素
            echo $n->getValue() . PHP_EOL;
            $n = $n->getNext();
            $before->setNext($n);
            $count = 0;

        }
        else
        {
            $before = $n;
            $n = $n->getNext();
        }
    }
}

joseph();