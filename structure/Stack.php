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
        //1.获取到当前字符串
        $current = $str[$i];
        //2.如果当前字符串是(把它存储到栈中
        if ($current == '(')
        {
            $chars->push($current);
        }

        //3.如果当前字符串是)，从队列中取出一个(,如果没有表明不是闭合返回false
        if ($current == ')')
        {
            $item = $chars->pop();
            if ($item == null)
            {
                return false;
            }
        }
    }

    //4.如果栈为空，以为（）号完全匹配，返回true
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

//逆波兰表达是
function caculate()
{
    //结果应该为30

    $arr = [3, 17, 15, '-', '*', 18, 6, '/', '+'];
    //中缀表达是式为（（7-2）+5）*6
    $arr = [5, 7, 2, '-', '+', 6, '*'];

    //1.定义一个栈存储要运算的数
    $stack = new Stack();
    for ($i = 0; $i < count($arr); $i++)
    {
        $current = $arr[$i];
        $o1 = null;
        $o2 = null;
        $result = null;
        //2.判断是否是运算符
        switch ($current)
        {
            //3.从栈中pop出两个数进行运算，运算完再压入栈中
            case '+':
                $o1 = $stack->pop();
                $o2 = $stack->pop();
                $result = $o2 + $o1;
                $stack->push($result);
                break;
            case '-':
                $o1 = $stack->pop();
                $o2 = $stack->pop();
                //因为大的数后出栈，所以两个数位置换一下
                $result = $o2 - $o1;
                $stack->push($result);
                break;
            case '*':
                $o1 = $stack->pop();
                $o2 = $stack->pop();
                $result = $o2 * $o1;
                $stack->push($result);
                break;
            case '/':
                $o1 = $stack->pop();
                $o2 = $stack->pop();
                $result = $o2 / $o1;
                $stack->push($result);
                break;
            default:
                $stack->push($current);
        }
    }

    //栈中最后一个元素为表达式结果
    $result = $stack->pop();
    echo '波兰表达式结果为：' . $result;
}

caculate();