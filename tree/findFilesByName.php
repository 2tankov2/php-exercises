<?php

/**
 * findFilesByName.php
 * Реализуйте функцию findFilesByName, которая принимает на вход файловое дерево и подстроку, а возвращает список
 * файлов, имена которых содержат эту подстроку.

<?php

use function PhpTrees\Trees\mkdir;
use function PhpTrees\Trees\mkfile;
use function App\Trees\findFilesByName;

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

findFilesByName($tree, 'co');
// ['/etc/nginx/nginx.conf', '/etc/consul/config.json']
 * Обратите внимание на то, что возвращается не просто имя файла, а полный путь до файла, начиная от корня.
 */

// src/findFilesByName

<?php

namespace App\Trees;

use function PhpTrees\Trees\isFile;

// BEGIN (write your solution here)
function findFilesByName($tree, $str)
{
    $iter = function ($n, $path, $acc, $str) use (&$iter) {
        $children = $n['children'] ?? null;
        if (!$children) {
            if (isFile($n) && (stripos($n['name'], $str) !== false)) {
                $path[] = $n['name'];
                $acc[] = preg_replace('!/+!', '/', implode($path, '/'));
                return $acc;
            }
            return $acc;
        } else {
            $path[] = $n['name'];
        }
        return array_reduce(
            $children,
            function ($iAcc, $nn) use (&$iter, $str, $path) {
                return $iter($nn, $path, $iAcc, $str);
            },
            $acc
        );
    };
    return $iter($tree, [], [], $str);
}
// END

/**
 * // BEGIN
function findFilesByName($root, $subStr)
{
    $iter = function ($node, $ancestry, $acc) use (&$iter, $subStr) {
        $name = $node['name'];
        $newAncestry = ($name === '/') ? '' : "$ancestry/$name";
        if (isFile($node)) {
            if (strpos($name, $subStr) === false) {
                return $acc;
            }
            $acc[] = $newAncestry;
            return $acc;
        }

        return array_reduce(
            $node['children'],
            function ($newAcc, $child) use ($iter, $newAncestry) {
                return $iter($child, $newAncestry, $newAcc);
            },
            $acc
        );
    };

    return $iter($root, '', []);
}
 * // END
 */