<?php


class twoWayLinkList
{
    private $head;
    /**
     * @var node|null
     */
    private $last;
    private $n;

    public function __construct()
    {
        $this->head = new node(null, null, null);
        $this->last = null;
        $this->n = 0;
    }

    public function clear()
    {
        $this->head->setValue(null);
        $this->head->setPre(null);
        $this->head->setNext(null);
        $this->last = null;
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

    public function getFirst()
    {
        if ($this->isEmpty())
        {
            return null;
        }

        return $this->head->getNext();
    }

    public function getLast()
    {
        if ($this->isEmpty())
        {
            return null;
        }

        return $this->last->getValue();
    }

    public function insert($value)
    {
        if ($this->isEmpty())
        {
            //将新节点设置为第一个元素
            $newNode = new node($value, $this->head, null);
            $this->head->setNext($newNode);
            //将最后一个节点设置为新节点
            $this->last = $newNode;
        }
        else
        {
            //最后一个节点设置为前一个节点
            $oldLst = $this->last;
            //将最后一个节点设置为当前节点
            $newNode = new node($value, $oldLst, null);
            $this->last = $newNode;

            $oldLst->setNext($newNode);
        }
        $this->n++;
    }

    public function insertToIndex(int $i, $value)
    {
        $pre = $this->head->getNext();
        //找到i的前一个节点
        for ($index = 0; $index < $i - 1; $index++)
        {
            $pre = $pre->getNext();
        }
        //获取到i的节点
        $current = $pre->getNext();
        $newNode = new node($value, $pre, $current);

        $pre->setNext($newNode);
        $current->setPre($newNode);
        $this->n++;
    }

    public function get(int $i)
    {
        $n = $this->head->getNext();
        for ($index = 0; $index < $i; $index++)
        {
            $n = $n->getNext();
        }

        return $n->getValue();
    }

    public function remove(int $i)
    {
        $pre = $this->head->getNext();
        for ($index = 0; $index < $i - 1; $index++)
        {
            $pre = $pre->getNext();
        }
        $current = $pre->getNext();
        $next = $current->getNext();
        $pre->setNext($next);
        $next->setPre($pre);
        $this->n--;
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
}

class node
{
    private $pre;
    private $next;
    private $value;

    public function __construct($value, $pre, $next)
    {
        $this->value = $value;
        $this->pre = $pre;
        $this->next = $next;
    }

    /**
     * @return mixed
     */
    public function getPre()
    {
        return $this->pre;
    }

    /**
     * @param mixed $pre
     */
    public function setPre($pre): void
    {
        $this->pre = $pre;
    }

    /**
     * @return node|null
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

}

$linkList = new twoWayLinkList();
$linkList->insert('姚明');
$linkList->insert('买滴');
$linkList->insert('科比');
$linkList->insert('詹姆士');

echo $linkList->selectValue() . PHP_EOL;
echo $linkList->length() . PHP_EOL;

$linkList->insertToIndex(3, '詹姆1');
echo $linkList->selectValue() . PHP_EOL;

echo $linkList->get(3) . PHP_EOL;
echo $linkList->indexOf('詹姆1') . PHP_EOL;

$linkList->remove(3) . PHP_EOL;
echo $linkList->selectValue() . PHP_EOL;