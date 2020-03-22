<?php

/**
 * Реализуйте функцию downcaseFileNames, которая принимает на вход директорию, приводит имена всех
 * файлов в этой и во всех вложенных директориях к нижнему регистру. Результат в виде обработанной
 * директории возвращается наружу.

<?php

use function PhpTrees\Trees\mkdir;
use function PhpTrees\Trees\mkfile;
use function App\Trees\downcaseFileNames;

$tree = mkdir('/', [
    mkdir('eTc', [
        mkdir('NgiNx'),
        mkdir('CONSUL', [
            mkfile('config.json'),
        ]),
    ]),
    mkfile('hOsts'),
]);

downcaseFileNames($tree);
// [
//      'name' => '/',
//      'type' => 'directory',
//      'meta' => [],
//      'children' => [
//           [
//                'name' => 'eTc',
//                'type' => 'directory',
//                'meta' => [],
//                'children' => [
//                     [
//                          'name' => 'NgiNx',
//                          'type' => 'directory',
//                          'meta' => [],
//                          'children' => [],
//                      ],
//                      [
//                          'name' => 'CONSUL',
//                          'type' => 'directory',
//                          'meta' => [],
//                          'children' => [
//                               [
//                                    'name' => 'config.json',
//                                    'type' => 'file',
//                                    'meta' => [],
//                               ]
//                          ],
//                      ],
//                 ],
//           ],
//           [
//                'name' => 'hosts',
//                'type' => 'file',
//                'meta' => [],
//           ],
//      ],
// ]
 */


namespace App\Trees;

// BEGIN (write your solution here)

function downcaseFileNames($tree)
{
    $iter = function ($tree) use (&$iter) {
        if ($tree['type'] === 'file') {
            return array_merge($tree, ['name' => strtolower($tree['name'])]);
        } elseif ($tree['type'] === 'directory') {
            $updatedChildren = array_map($iter, $tree['children']);
            return array_merge($tree, ['children' => $updatedChildren]);
        }
    };
    return $iter($tree);
}

// END
