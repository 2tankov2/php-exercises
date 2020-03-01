<?php
// Реализуйте функцию apply, которая меняет переданный массив, в соответствии с указанной операцией. Всего нужно реализовать три операции:

// reset - Сброс массива
// remove - Удаление значения по индексу
// change - Обновление значения по индексу
namespace App\Arrays;

function apply(array $arr, $operationName, $index = null, $value = null)
{
    $result = [];
    // BEGIN (write your solution here)
    switch ($operationName) {
        case "reset":
            $result = array_splice($arr, count($arr));
            return $result;
            break;
        case "remove":
            array_splice($arr, $index, 1);
            return $arr;
            break;
        case "change":
            $arr[$index] = $value;
            return $arr;
            break;
    }
    // END
}

// BEGIN
switch ($operationName) {
    case 'reset':
        $arr = [];
        break;
    case 'change':
        $arr[$index] = $value;
        break;
    case 'remove':
        unset($arr[$index]);
        break;
}
return $arr;
// END