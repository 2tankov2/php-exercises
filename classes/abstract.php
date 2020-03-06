<?php

/**
 * Реализуйте механизм валидации для каждого элемента DOM, который проверяет переданные атрибуты на
 * допустимость.

<?php

$img = new HTMLImgElement(['class' => 'rounded', 'src' => 'path/to/image']);
$img->isValid(); // true

$img2 = new HTMLImgElement(['class' => 'rounded', 'href' => 'path/to/image']);
$img->isValid(); // false
 * Какой шаблон проектирования нужно применить здесь, для того чтобы избежать дублирования isValid в
 * каждом классе?

src\HTMLElement.php
 * Определите абстрактный метод isValid()

src\HTMLImgElement.php
 * Реализуйте метод isValid, который проверяет соответствие между переданными атрибутами и допустимыми
 * атрибутами. Для тега Img допустимыми являются: name, class, src. Причем name и class допустимы для
 * любого элемента. Поэтому информация о них должна находиться в базовом классе.
 */

// src/HTMLElement.php

namespace App;

abstract class HTMLElement
{
    private const ATTRIBUTE_NAMES = ['name', 'class'];

    public $attributes = [];

    public static function getAttributeNames()
    {
        return self::ATTRIBUTE_NAMES;
    }

    public function __construct($attributes = [])
    {
        $this->attributes = $attributes;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

    // BEGIN (write your solution here)
    abstract public function isValid();
    // END
}

// src\HTMLImgElement.php

namespace App;

class HTMLImgElement extends HTMLElement
{
    private const ATTRIBUTE_NAMES = ['src'];

    public static function getAttributeNames()
    {
        return array_merge(parent::getAttributeNames(), static::ATTRIBUTE_NAMES);
    }

    // BEGIN (write your solution here)
    public function isValid()
    {
        $atr = parent::getAttributes();
        $atrNames = $this->getAttributeNames();
        if (!$atr) {
            return true;
        }
        return empty(array_diff(array_keys($atr), $atrNames));
    }
    // END
}

/**
 *   BEGIN
    public function isValid()
    {
        $names = array_keys($this->getAttributes());
        $intersection = collect($names)->intersect(static::getAttributeNames())->all();
        sort($intersection);
        return $names === $intersection;
    }
 *   END
 */