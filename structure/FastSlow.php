<?php

//快慢指针
class FastSlow
{

}

class Node
{
    private $next;
    private $value;

    public function __construct($value, $next)
    {
        $this->value = $value;
        $this->next = $next;
    }


    /**
     * @return mixed
     */
    public function getNext()
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

    /**
     * @return
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


}

/**
 * 找到链表中间值
 * @param Node $first
 * @return mixed
 */
function getMid(Node $first)
{
    $fast = $first;
    $slow = $first;

    while ($fast && $fast->getNext())
    {
        //快指针走两步，慢指针走一步，快指针走完，慢指针刚好到达链表中间
        $fast = $fast->getNext()->getNext();
        $slow = $slow->getNext();
    }

    return $slow->getValue();
}

/**
 * 检测是否有环
 * @param Node $first
 * @return int
 */
function isCircle(Node $first)
{
    $fast = $first;
    $slow = $first;
    while ($fast && $fast->getNext())
    {
        $fast = $fast->getNext()->getNext();
        $slow = $slow->getNext();

        //如果两个指针重合，意味链表有环
        if ($fast === $slow)
        {
            return 1;
        }
    }

    return 0;
}

/**
 * 找到环的入口
 * @param Node $first
 * @return mixed
 */
function getEntrance(Node $first)
{
    $fast = $first;
    $slow = $first;

    while ($fast && $fast->getNext())
    {
        $fast = $fast->getNext()->getNext();
        $slow = $slow->getNext();

        //指针重合，创建临时指针
        if ($fast === $slow)
        {
            //快指针回到第一位
            $fast = $first;
            while ($fast !== $slow)
            {
                //同时开始走，知道再次重合，即可找到入口
                $fast = $fast->getNext();
                $slow = $slow->getNext();
            }

            break;
        }

    }

    return $fast->getValue();
}

$first = new Node('a', null);
$second = new Node('b', null);
$third = new Node('c', null);
$fourth = new Node('d', null);
$fifth = new Node('e', null);
$sixth = new Node('f', null);

$first->setNext($second);
$second->setNext($third);
$third->setNext($fourth);
$fourth->setNext($fifth);
$fifth->setNext($sixth);

echo getMid($first) . PHP_EOL;
echo '是否有环:' . isCircle($first) . PHP_EOL;
//制造一个环
$sixth->setNext($second);
echo '是否有环:' . isCircle($first) . PHP_EOL;
echo '环的入口为:' . getEntrance($first) . PHP_EOL;