<?php

/**
 * src\HTMLHrElement.php
 * Реализуйте класс HTMLHrElement (наследуется от HTMLElement), который отвечает за представление
 * тега <hr>. Внутри класса определите функцию __toString(), которая возвращает текстовое представление тега.

<?php

$hr = new HTMLHrElement();
echo $hr; // <hr>

$hr = new HTMLHrElement(['class' => 'w-75', 'id' => 'wop']);
echo $hr; // '<hr class="w-75" id="wop">';
// src\HTMLElement.php
 * Реализуйте метод stringifyAttributes(), который формирует строчку для аттрибутов. Используйте этот метод
 * в наследнике для формирования тега.
 */

// src/HTMLElement.php

namespace App;

class HTMLElement
{
    private $attributes = [];

    public function __construct($attributes = [])
    {
        $this->attributes = $attributes;
    }

    protected function stringifyAttributes()
    {
        // BEGIN (write your solution here)
        if (count($this->attributes) == 0) {
            return '';
        }
        $line = collect($this->attributes)
            ->map(function ($item, $key) {
                return "{$key}=\"{$item}\"";
            })
            ->join(' ');
        return " {$line}";
        // END
    }
}

// src/HTMLHrElement.php

namespace App;

// BEGIN (write your solution here)
class HTMLHrElement extends HTMLElement
{
    public function __toString()
    {
        return "<hr" . $this->stringifyAttributes() . ">";
    }
}
// END
