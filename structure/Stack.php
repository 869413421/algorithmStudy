<?php

class Stack
{
    private $head;
    private $n;

    public function __construct()
    {
        $this->head = new Node(null, null);
        $this->n = 0;
    }

    public function isEmpty(): bool
    {
        return $this->n == 0;
    }

    public function push($value)
    {
        $node = new Node($value, null);
        $oldNode = $this->head->getNext();
        $node->setNext($oldNode);
        $this->head->setNext($node);
        $this->n++;
    }

    public function pop()
    {
        if (!$this->head->getNext())
        {
            return null;
        }

        $popNode = $this->head->getNext();
        $this->head->setNext($popNode->getNext());
        $this->n--;
        return $popNode->getValue();
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


$stack = new Stack();
$stack->push('a');
$stack->push('b');
$stack->push('c');
$stack->push('d');

echo $stack->pop() . PHP_EOL;
echo $stack->pop() . PHP_EOL;
echo $stack->pop() . PHP_EOL;
echo $stack->pop() . PHP_EOL;
echo $stack->pop() . PHP_EOL;

function isMatch(string $str): bool
{
    $chars = new Stack();

    for ($i = 0; $i < strlen($str); $i++)
    {
        $current = $str[$i];
        if ($current == '(')
        {
            $chars->push($current);
        }

        if ($current == ')')
        {
            $item = $chars->pop();
            if ($item == null)
            {
                return false;
            }
        }
    }

    if ($chars->isEmpty())
    {
        return true;
    }

    return false;
}

function isMatchByPHP(string $str): bool
{
    $chars = [];
    for ($i = 0; $i < strlen($str); $i++)
    {
        $current = $str[$i];
        if ($current == '(')
        {
            $chars[] = $current;
        }
        if ($current == ')')
        {
            $item = array_pop($chars);
            if (!$item)
            {
                return false;
            }
        }
    }

    if (count($chars) == 0)
    {
        return true;
    }

    return false;
}

var_dump(isMatch('(fdafds(fafds)())'));
var_dump(isMatchByPHP('(fdafds(fafds)())'));