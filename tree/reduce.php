<?php

/**
 * reduce.php
 * Реализуйте функцию reduce обрабатывающую файловые деревья.

Примеры
<?php

use function PhpTrees\Trees\mkdir;
use function PhpTrees\Trees\mkfile;
use function PhpTrees\Trees\isFile;
use function App\Trees\reduce;

$tree = mkdir('/', [
    mkdir('etc', [
        mkdir('nginx'),
        mkdir('consul', [
            mkfile('config.json'),
        ]),
    ]),
    mkfile('hosts'),
]);

reduce(function ($acc) {
    return $acc + 1;
}, $tree, 0);
// 6

reduce(function ($acc, $node) {
    return isFile($node) ? $acc + 1 : $acc;
}, $tree, 0);
// 2
 */

// src/reduce.php

namespace App\Trees;

use function PhpTrees\Trees\isDirectory;

// BEGIN (write your solution here)
function reduce($fn, $tree, $acc)
{
    $iter = function ($fn, $tree, $acc) use (&$iter) {
        $children = $tree['children'] ?? null;
        $newAcc = $fn($acc, $tree);

        if (!$children) {
            return $newAcc;
        }

        return array_reduce(
            $children,
            function ($iAcc, $n) use (&$iter, &$fn) {
                return $iter($fn, $n, $iAcc);
            },
            $newAcc);
    };
    return $iter($fn, $tree, $acc);
}
// END

/**
 * // BEGIN
function reduce($func, $tree, $accumulator)
{
    $reduce = function ($f, $node, $acc) use (&$reduce) {
        $newAcc = $f($acc, $node);

        if (isDirectory($node)) {
            ['children' => $children] = $node;
            return array_reduce(
                $children,
                function ($iAcc, $n) use ($reduce, $f) {
                    return $reduce($f, $n, $iAcc);
                },
                $newAcc
            );
        }

        return $newAcc;
    };

    return $reduce($func, $tree, $accumulator);
}
 * // END
 */