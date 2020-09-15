<?php

//符号表
class SymbolTable
{
    private $head;
    private $n;

    public function __construct()
    {
        $this->head = new Node(null, null, null);
        $this->n = 0;
    }

    public function size()
    {
        return $this->n;
    }

    public function get($key)
    {
        $node = $this->head;
        while ($node->getNext() != null)
        {
            $node = $node->getNext();
            if ($node->getKey() == $key)
            {
                return $node->getValue();
            }
        }

        return null;
    }

    public function put($key, $value)
    {
        $node = $this->head;
        while ($node->getNext() != null)
        {
            $node = $node->getNext();
            if ($node->getKey() == $key)
            {
                $node->setValue($value);
                return;
            }
        }

        $oldFirst = $this->head->getNext();;
        $newFirst = new Node($key, $value, $oldFirst);
        $this->head->setNext($newFirst);
        $this->n++;
    }

    public function remove($key)
    {
        $node = $this->head;
        while ($node->getNext() != null)
        {
            if ($node->getNext()->getKey() == $key)
            {
                $node->setNext($node->getNext()->getNext());
                $this->n--;
                return;
            }
            $node = $node->getNext();
        }
    }
}

class Node
{
    private $key;

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

    /**
     * @return Node
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

    private $value;
    private $next;

    public function __construct($key, $value, $next)
    {
        $this->key = $key;
        $this->value = $value;
        $this->next = $next;
    }
}

$symbolTable = new SymbolTable();
$symbolTable->put(1, [
    'name' => '小明'
]);


$symbolTable->put(2, [
    'name' => '消息'
]);

$symbolTable->put(3, [
    'name' => '晓东'
]);

$symbolTable->remove(2);
var_dump($symbolTable->get(1));
var_dump($symbolTable->get(2));
var_dump($symbolTable->get(3));
