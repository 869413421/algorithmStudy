<?php

//队列
class Queue
{
    private $head;
    private $last;
    private $n;

    public function __construct()
    {
        $this->head = new Node(null, null);
        $this->last = null;
        $this->n = 0;
    }

    public function isEmpty()
    {
        return $this->n == 0;
    }

    public function push($value)
    {
        if ($this->last == null)
        {
            $this->last = new Node($value, null);
            $this->head->setNext($this->last);
        }
        else
        {
            $oldLast = $this->last;
            $node = new Node($value, null);
            $oldLast->setNext($node);
            $this->last = $node;
        }
        $this->n++;
    }

    public function pop()
    {
        if ($this->isEmpty())
        {
            return null;
        }

        $oldFirst = $this->head->getNext();
        $this->head->setNext($oldFirst->getNext());
        $this->n--;
        if ($this->isEmpty())
        {
            $this->last = null;
        }

        return $oldFirst->getValue();
    }
}

class Node
{
    private $value;
    private $next;

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

    public function __construct($value, $next)
    {
        $this->value = $value;
        $this->next = $next;
    }
}

$queue = new Queue();
$queue->push('a');
$queue->push('b');
$queue->push('c');
$queue->push('b');

echo $queue->pop() . PHP_EOL;
echo $queue->pop() . PHP_EOL;
echo $queue->pop() . PHP_EOL;
echo $queue->pop() . PHP_EOL;


$queue->push('e');
echo $queue->pop() . PHP_EOL;