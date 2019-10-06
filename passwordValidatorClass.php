<?php
/**
 * Реализуйте класс PasswordValidator ориентируясь на тесты.

 * Этот валидатор поддерживает следующие опции:

 * minLength (по-умолчанию 8) - минимальная длина пароля
 * containNumbers (по-умолчанию false) - требование содержать хотя бы одну цифру
 * Массив ошибок в ключах содержит название опции, а в значении текст указывающий на ошибку (тексты можно подсмотреть
 * в тестах)
 */
namespace App;

class PasswordValidator
{
    // BEGIN (write your solution here)
    private const OPTIONS = ['minLength' => 8, 'containNumbers' => false];
    
    private $options = [];

    public function __construct($options = [])
    {
        $this->options = array_merge(self::OPTIONS, $options);
    }

    public function validate($text)
    {
        $errors = [];
        if (strlen($text) < $this->options['minLength']) {
            $errors['minLength'] = 'too small';
        }
        if ($this->options['containNumbers']) {
            if (!$this->hasNumber($text)) {
                $errors['containNumbers'] = 'should contain at least one number';
            }
        }
        return $errors;
    }
    // END

    private function hasNumber($subject)
    {
        return strpbrk($subject, '1234567890') !== false;
    }
}
