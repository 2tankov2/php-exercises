<?php
/*
Реализуйте функцию getComposerFileData,
которая возвращет ассоциативный массив, соответствующий json из файла composer.json

{
  "autoload": {
    "files": [
      "src/Arrays.php"
    ]
  },
  "config": {
    "vendor-dir": "/composer/vendor"
  }
}
*/
namespace App\Arrays;

// BEGIN (write your solution here)
function getComposerFileData()
{
    $arr = [];
    $arr['autoload']['files'] = ['src/Arrays.php'];
    $arr['config'] = ['vendor-dir' => '/composer/vendor'];
    return $arr;
}
// END

// BEGIN
function getComposerFileData()
{
    return [
        'autoload' => [
            'files' => [
                'src/Arrays.php'
            ]
        ],
        'config' => [
            'vendor-dir' => '/composer/vendor'
        ]
    ];
}
// END