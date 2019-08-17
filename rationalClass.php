<?php
/**
 * Реализуйте класс для работы с рациональными числами, включающий в себя следующие методы:

 * Конструктор — принимает на вход числитель и знаменатель.
 * Метод getNumer — возвращает числитель
 * Метод getDenom — возвращает знаменатель
 * Сложение add — складывает переданные дроби
 * Вычитание sub — находит разность между двумя дробями
 * Нормализацию делать не надо!

 * Подобные абстракции, как правило, создаются неизменяемыми. Поэтому сделайте так, чтобы методы add и sub возвращали
 * новое рациональное число, а не мутировали объект.

<?php

$rat1 = new Rational(3, 9);
$rat1->getNumer(); // => 3
$rat1->getDenom(); // => 9

$rat2 = new Rational(10, 3);

$rat3 = $rat1->add($rat2); // => Абстракция для рационального числа 99/27
$rat3->getNumer();         // => 99
$rat3->getDenom();         // => 27

$rat4 = $rat1->sub($rat2); // => Абстракция для рационального числа -81/27
$rat4->getNumer();         // => -81
$rat4->getDenom();         // => 27
 */
namespace App;

// BEGIN (write your solution here)
class Rational
{
    public $numer;
    public $denom;

    public function __construct($numer, $denom)
    {
        $this->numer = $numer;
        $this->denom = $denom;
    }
    public function getNumer()
    {
        return $this->numer;
    }
    public function getDenom()
    {
        return $this->denom;
    }
    public function add($rational)
    {
        $numer = $this->getNumer() * $rational->getDenom() + $rational->getNumer() * $this->getDenom();
        $denom = $this->getDenom() * $rational->getDenom();
        return new Rational($numer, $denom);
    }
    public function sub($rational)
    {
        $numer = $this->getNumer() * $rational->getDenom() - $rational->getNumer() * $this->getDenom();
        $denom = $this->getDenom() * $rational->getDenom();
        return new Rational($numer, $denom);
    }
}

// END
