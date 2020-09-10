<?php

//单向链表
class linkList
{
    private $head;
    private $n;

    public function __construct()
    {
        $this->head = new node(null, null);
        $this->n = 0;
    }

    public function clear(): void
    {
        $this->head = null;
        $this->n = 0;
    }

    public function isEmpty(): bool
    {
        return $this->n == 0;
    }

    public function length(): int
    {
        return $this->n;
    }

    public function get(int $i)
    {
        $n = $this->head->getNext();
        //从头节点开始往下找，依次找到i;
        for ($index = 0; $index < $i; $i++)
        {
            $n = $n->getNext();
        }

        return $n->getValue();
    }

    public function insert($value)
    {
        $n = $this->head;
        //依次往下找，找到最后一个元素
        while ($n->getNext() != null)
        {
            $n = $n->getNext();
        }

        //创建一个新元素插到末尾
        $newNode = new node($value, null);
        $n->setNext($newNode);
        //链表长度加1
        $this->n++;
    }

    public function insertToIndex(int $i, $value)
    {
        $pre = $this->head->getNext();
        //找到i位置前一个节点
        for ($index = 0; $index < $i - 1; $index++)
        {
            $pre = $pre->getNext();
        }
        //找到i位置节点
        $current = $pre->getNext();
        //创建一个节点,将i节点放到下一位
        $newNode = new node($value, $current);
        $pre->setNext($newNode);
        //链表长度加1
        $this->n++;
    }

    public function remove(int $i)
    {
        $pre = $this->head->getNext();

        //找到i前一个元素位置
        for ($index = 0; $index < $i - 1; $index++)
        {
            $pre = $pre->getNext();
        }
        //找到i位置;
        $current = $pre->getNext();
        //找到i的下一个位置
        $next = $current->getNext();
        //将i的前一个位置和下一个位置链接
        $pre->setNext($next);

        $this->n--;
        return $current->getValue();
    }

    public function indexOf($value)
    {
        $n = $this->head;
        for ($i = 0; $n->getNext() != null; $i++)
        {
            $n = $n->getNext();
            if ($n->getValue() == $value)
            {
                return $i;
            }
        }

        return -1;
    }

    public function selectValue()
    {
        $n = $this->head;
        $str = '';
        while ($n->getNext() != null)
        {
            $n = $n->getNext();
            $str .= $n->getValue() . ',';
        }

        return $str;
    }

    public function reverse()
    {
        //如果链表为空不反转
        if ($this->isEmpty())
        {
            return null;
        }
        //从第一个元素开始递归调用
        $this->reverseItem($this->head->getNext());
    }

    public function reverseItem(node $node)
    {
        if ($node->getNext() == null)
        {
            //最后一个元素为第一个元素
            $this->head->setNext($node);
            return $node;
        }

        //下一个元素返回后变成前一个元素
        $pre = $this->reverseItem($node->getNext());
        $pre->setNext($node);
        $node->setNext(null);

        return $node;
    }
}

class node
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
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return node
     */
    public function getNext()
    {
        return $this->next;
    }

    /**
     * @param mixed $next
     */
    public function setNext($next)
    {
        $this->next = $next;
    }

}

$linkList = new linkList();
$linkList->insert('姚明');
$linkList->insert('买滴');
$linkList->insert('科比');
$linkList->insert('詹姆士');

echo $linkList->indexOf('詹姆士') . PHP_EOL;
echo $linkList->insertToIndex(2, '詹姆猪') . PHP_EOL;
echo $linkList->selectValue() . PHP_EOL;
echo $linkList->remove(4) . PHP_EOL;
echo $linkList->selectValue() . PHP_EOL;
$linkList->reverse();
echo $linkList->selectValue() . PHP_EOL;