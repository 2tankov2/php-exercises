<?php

/**
 * Во многих операционных системах (Linux, MacOS) существует утилита du. Она умеет считать место в указанных файлах и
 * директориях. Например так:

 tmp$ du -sh *
  0B    com.docker.vmnetd.socket
 10M    credo
4.0K    debug.mjs
  0B    filesystemui.socket
4.0K    index.php
 37M    node_modules
 88K    package-lock.json
 22M    taxdome
 * Перед тем как делать упражнение, обязательно попробуйте поиграйте с этой утилитой в терминале, посмотрите ее опции
 * через man du.

du.php
 * Реализуйте функцию du, которая принимает на вход директорию, а возвращает список узлов вложенных (директорий и файлов)
 * в указанную директорию на один уровень и место которое они занимают. Размер файла задается в метаданных. Размер
 * директории складывается из сумм всех размеров файлов находящихся внутри во всех подпапках. Сами папки размера не имеют.

 * Обратите внимание на структуру результирующего массива. Каждый элемент — массив с двумя значениями, именем директории
 * и размером файлов внутри.
 * Результат отсортирован по размеру в обратном порядке. То есть сверху самые тяжёлые, внизу самые легкие.
 * Пример
<?php

use function PhpTrees\Trees\mkdir;
use function PhpTrees\Trees\mkfile;
use function App\Trees\du;

$tree = mkdir('/', [
    mkdir('etc', [
        mkdir('apache'),
        mkdir('nginx', [
            mkfile('nginx.conf', ['size' => 800]),
        ]),
        mkdir('consul', [
            mkfile('config.json', ['size' => 1200]),
            mkfile('data', ['size' => 8200]),
            mkfile('raft', ['size' => 80]),
        ]),
    ]),
    mkfile('hosts', ['size' => 3500]),
    mkfile('resolve', ['size' => 1000]),
]);

du($tree);
// [
//     ['etc', 10280],
//     ['hosts', 3500],
//     ['resolve', 1000],
// ]
 */

// src/du.php

<?php

namespace App\Trees;

use function PhpTrees\Trees\isDirectory;
use function PhpTrees\Trees\reduce;

// BEGIN (write your solution here)
function calculateSizeCount($tree)
{
    return reduce(function ($acc, $node) {
        $size = $node['meta']['size'] ?? 0;
        return $acc + $size;
    }, $tree, 0);
}

function du($tree)
{
    $children = $tree['children'] ?? null;
    $result = array_map(function ($n) {
        return [$n['name'], calculateSizeCount($n)];
    }, $children);

    $cmp = function ($a, $b) {
        if ($a[1] === $b[1]) {
            return 0;
        }
        return $a[1] < $b[1] ? 1 : -1;
    };

    usort($result, $cmp);

    return $result;
}
// END

/**
 * // BEGIN
function calculateFilesSize($node)
{
    return reduce(function ($acc, $n) {
        if (isDirectory($n)) {
            return $acc;
        }
        return $acc + $n['meta']['size'];
    }, $node, 0);
}

function du($node)
{
    $result = array_map(function ($n) {
        return [$n['name'], calculateFilesSize($n)];
    }, $node['children']);

    usort($result, function ($arr1, $arr2) {
        return $arr2[1] <=> $arr1[1];
    });

    return $result;
}
 * // END
 */