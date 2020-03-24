<?php

/**
 * filter.php
 * Реализуйте функцию filter, которая принимает на вход предикат и дерево, а возвращает отфильтрованное дерево по предикату.

<?php

use function PhpTrees\Trees\mkdir;
use function PhpTrees\Trees\mkfile;
use function PhpTrees\Trees\isDirectory;
use function App\Trees\filter;

$tree = mkdir('/', [
    mkdir('etc', [
        mkdir('nginx', [
            mkdir('conf.d'),
        ]),
        mkdir('consul', [
            mkfile('config.json'),
        ]),
    ]),
    mkfile('hosts'),
]);

filter(function ($n) {
    return isDirectory($n);
}, $tree);
// [
//   'name' => '/',
//   'type' => 'directory',
//   'meta' => [],
//   'children' => [
//     [
//       'name' => 'etc',
//       'type' => 'directory',
//       'meta' => [],
//       'children' => [
//         [
//           'name' => 'nginx',
//           'type' => 'directory',
//           'meta' => [],
//           'children' => [[
//             'name' => 'conf.d',
//             'type' => 'directory',
//             'meta' => [],
//             'children' => [],
//           ]],
//         ],
//         [
//           'name' => 'consul',
//           'type' => 'directory',
//           'meta' => [],
//           'children' => [],
//         ],
//       ],
//     ],
//   ],
// ]
 */

// src/filter.php


namespace App\Trees;

use function PhpTrees\Trees\isDirectory;

// BEGIN (write your solution here)
function filter($fn, $tree)
{
    $iter = function ($fn, $tree) use (&$iter) {
        if (!$fn($tree)) {
            return null;
        }
        $children = $tree['children'] ?? null;
        if (!$children) {
            return $tree;
        } 
            $filtredChildren = array_map(function ($el) use (&$iter, &$fn) {
                return $iter($fn, $el);
            }, $children);

        return array_merge($tree, ['children' => array_values(
            array_filter($filtredChildren, function ($n) {
                return $n !== null;
            }))
        ]);
    };
    return $iter($fn, $tree);
}
// END

/**
 * // BEGIN
function filter($func, $tree)
{
    $filter = function ($f, $node) use (&$filter) {
        if (!$f($node)) {
            return null;
        }

        if (isDirectory($node)) {
            $updatedChildren = array_map(function ($n) use ($f, $filter) {
                return $filter($f, $n);
            }, $node['children']);
            $filteredChildren = array_filter($updatedChildren, function ($n) {
                return $n !== null;
            });

            return array_merge($node, ['children' => array_values($filteredChildren)]);
        }

        return $node;
    };

    return $filter($func, $tree);
}
 * // END
 */