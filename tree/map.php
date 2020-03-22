<?php

/**
 * map.php
 * Реализуйте функцию map, которая принимает на вход функцию-обработчик и дерево, а возвращает
 * отображенное дерево.

<?php

use function PhpTrees\Trees\mkdir;
use function PhpTrees\Trees\mkfile;
use function App\Trees\map;

$tree = mkdir('/', [
    mkdir('eTc', [
        mkdir('NgiNx'),
        mkdir('CONSUL', [
            mkfile('config.json'),
        ]),
    ]),
    mkfile('hOsts'),
]);

map(function ($n) {
    return array_merge($n, ['name' => strtoupper($n['name'])]);
}, $tree);
// [
//   'name' => '/',
//   'type' => 'directory',
//   'meta' => [],
//   'children' => [
//     [
//       'name' => 'ETC',
//       'type' => 'directory',
//       'meta' => [],
//       'children' => [
//         [
//           'name' => 'NGINX',
//           'type' => 'directory',
//           'meta' => [],
//           'children' => [],
//         ],
//         [
//           'name' => 'CONSUL',
//           'type' => 'directory',
//           'meta' => [],
//           'children' => [['name' => 'CONFIG.JSON', 'type' => 'file', 'meta' => []]],
//         ],
//       ],
//     ],
//     ['name' => 'HOSTS', 'type' => 'file', 'meta' => []],
//   ],
// ]
 * 
 */


namespace App\Trees;

use function PhpTrees\Trees\isDirectory;

// BEGIN (write your solution here)
function map($fn, $tree)
{
    $iter = function ($fn, $tree) use (&$iter) {
        $children = $tree['children'] ?? null;
        $newName = $fn($tree);
        if (!$children) {
            return array_merge($tree, $newName);
        } 
            $newChildren = array_map(function ($el) use (&$iter, &$fn) {
                return $iter($fn, $el);
            }, $children);

        return array_merge($newName, ['children' => $newChildren]);
    };
    return $iter($fn, $tree);
}
// END

/**

function map(callable $func, array $tree)
{
    $map = function ($node) use (&$map, $func) {
        $newNode = $func($node);
        if (isDirectory($node)) {
            return array_merge(
                $newNode,
                ['children' => array_map($map, $node['children'])]
            );
        }
        return $newNode;
    };
    return $map($tree);
}

 */