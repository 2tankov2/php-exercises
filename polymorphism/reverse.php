<?php

// В этой практике вам предстоит поработать с односвязным списком. Для лучшего понимания задачи,
// прочитайте литературу данную в подсказках и изучите исходники файла src/Node.php, внутри которого
// находится реализация односвязного списка. И посмотрите тесты, там видно как список создается и используется.

// src\LinkedList.php
// Реализуйте функцию reverse($list), которая принимает на вход односвязный список и переворачивает его.

// use App\Node;
// use function App\LinkedList\reverse;

// (1, 2, 3)
// $numbers = new Node(1, new Node(2, new Node(3)));
// $reversedNumbers = reverse($numbers); // (3, 2, 1)

// LinkedList.php

namespace App\LinkedList;

use App\Node;

// BEGIN (write your solution here)
function iter($current, $acc)
{
    if ($current === null) {
        return $acc;
    } else {
        $newAcc = new Node($current->getValue(), $acc);
        return iter($current->getNext(), $newAcc);
    }
}

function reverse($list)
{
    $head = $list->getValue();
    $tail = $list->getNext();
    
    return iter($tail, new Node($head));
}
// END

// BEGIN
function reverse(\App\Node $list)
{
    $newHead = null;
    $current = $list;
    while ($current) {
        $newHead = new Node($current->getValue(), $newHead);
        $current = $current->getNext();
    }

    return $newHead;
}
// END

//Node.php

namespace App;

class Node
{
    public function __construct($value, Node $node = null)
    {
        $this->next = $node;
        $this->value = $value;
    }

    public function getNext()
    {
        return $this->next;
    }

    public function getValue()
    {
        return $this->value;
    }
}
