<?php

/**
 * src\HTMLElement.php
 * Реализуйте набор методов для работы с классами:

 * addClass($className) – добавляет класс
 * removeClass($className) – удаляет класс
 * toggleClass($className) – ставит класс если его не было и убирает если он был
 * Эти методы должны обрабатывать свойство 'class' (внутри строка) массива $this->attributes. В процессе
 * реализации вам понадобится постоянно преобразовывать строку классов в массив и обратно. Вынесите эту
 * операцию в отдельные функции и установите им правильный модификатор доступа.

<?php

$div = new HTMLDivElement(['class' => 'one two']);
$div->getAttribute('class'); // 'one two'

$div->addClass('small');
$div->getAttribute('class'); // 'one two small'

$div->addClass('small');
$div->getAttribute('class'); // 'one two small'

$div->removeClass('two');
$div->getAttribute('class'); // 'one small'

$div->toggleClass('small');
$div->getAttribute('class'); // 'one'

$div->toggleClass('small');
$div->getAttribute('class'); // 'one small'
 */

//src\HTMLElement.php

namespace App;

class HTMLElement
{
    private $attributes = [];

    public function __construct($attributes = [])
    {
        $this->attributes = $attributes;
    }

    public function getAttribute($key)
    {
        return $this->attributes[$key];
    }

    // BEGIN (write your solution here)
    public function addClass($className)
    {
        $classKey = array_search($className, explode(' ', $this->getAttribute('class')));
        if (!$classKey) {
            $this->attributes['class'] .= " " . $className;
        }
    }
    
    public function removeClass($className)
    {
        $classes = explode(' ', $this->getAttribute('class'));
        unset($classes[array_search($className, $classes)]);
        $this->attributes['class'] = implode(' ', $classes);
    }

    public function toggleClass($className)
    {
        $classKey = array_search($className, explode(' ', $this->getAttribute('class')));
        if ($classKey) {
            $this->removeClass($className);
        } else {
            $this->addClass($className);
        }
    }
    // END
}

// BEGIN
public function addClass($className)
{
    $classes = $this->getClasses();
    $newClasses = array_unique(array_merge($classes, [$className]));
    $this->attributes['class'] = $this->stringifyClasses($newClasses);
}

public function removeClass($className)
{
    $classes = $this->getClasses();
    $newClasses = array_diff($classes, [$className]);
    $this->attributes['class'] = $this->stringifyClasses($newClasses);
}

public function toggleClass($className)
{
    if (in_array($className, $this->getClasses())) {
        $this->removeClass($className);
        return;
    }

    $this->addClass($className);
}

private function getClasses()
{
    return explode(' ', $this->attributes['class'] ?? []);
}

private function stringifyClasses($classes)
{
    return implode(' ', $classes);
}
// END