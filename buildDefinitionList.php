<?php
/* Реализуйте функцию buildDefinitionList, которая генерирует html список определений (теги dl, dt и dd)
 и возвращает получившуюся строку. При отсутствии элементов в массиве фукнция возвращает пустую строку.

 Параметры функции
 Список определений следующего формата:

 $definitions = [
  ['definition1', 'description1'],
  ['definition2', 'description2']
 ];
 То есть каждый элемент входного списка сам является массивом, содержащим два элемента: термин и его определение.
*/
namespace App\Strings;

// BEGIN (write your solution here)
function buildDefinitionList($coll)
{
    if (count($coll) === 0) {
        return '';
    }
    $paths = [];
    foreach ($coll as $row) {
        foreach ($row as $index => $value) {
            $paths[] = $index === 0 ? "<dt>{$row[0]}</dt>" : "<dd>{$row[1]}</dd>";
        }
    } $innerValue = implode('', $paths);
    $result = "<dl>{$innerValue}</dl>";
    return $result;
}
// END

// BEGIN
function buildDefinitionList(array $definitions)
{
    if (empty($definitions)) {
        return '';
    }

    $parts = [];
    foreach ($definitions as $definition) {
        $name = $definition[0];
        $description = $definition[1];
        $parts[] = "<dt>{$name}</dt><dd>{$description}</dd>";
    }
    $innerValue = implode($parts, '');
    $result = "<dl>{$innerValue}</dl>";

    return $result;
}
// END