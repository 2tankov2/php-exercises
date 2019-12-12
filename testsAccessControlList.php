<?php

/**
 * ACL (access control list) это механизм проверки доступа определенных ролей к действиям над определенными ресурсами.

 * Включает понятия:

 * Роль - кто выполняет действие.
 * Ресурс - над чем выполняется действие.
 * Привилегия - какое выполняется действие.
 * Например, администратор может редактировать карточку пользователя. Здесь роль - это администратор, ресурс - карточка
 * пользователя, привилегия - редактировать.

 * Принцип работы системы ACL из этого упражнения:

$data = [
    'articles' => [
        'show' => ['editor', 'manager'],
        'edit' => ['editor']
    ],
    'money' => [
        'create' => ['editor'],
        'show' => ['editor', 'manager'],
        'edit' => ['manager'],
        'remove' => ['manager']
    ]
];

$acl = new Acl($data);

$acl->check('articles', 'show', 'manager')
file: TestSolution.php
 * Напишите тесты на функцию check объекта $acl. Функция принимает на вход ресурс, привилегию и роль. Принцип работы
 * этой функции:

 * Если не найден ресурс - бросаем исключение Acl\ResourceUndefined.
 * Если не найдена привилегия - бросаем исключение Acl\PrivilegeUndefined.
 * Если доступ запрещен - Acl\AccessDenied.
 */

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Acl\Acl;

require_once 'src/App/Acl/AccessDenied.php';
require_once 'src/App/Acl/ResourceUndefined.php';
require_once 'src/App/Acl/PrivilegeUndefined.php';

class SolutionTest extends TestCase
{
    private static $data = [
        'articles' => [
            'show' => ['editor', 'manager'],
            'edit' => ['editor']
        ],
        'money' => [
            'create' => ['editor'],
            'show' => ['editor', 'manager'],
            'edit' => ['manager'],
            'remove' => ['manager']
        ]
    ];

    public function testAccessDenied()
    {
        $acl = new Acl(static::$data);

        // BEGIN (write your solution here)
        try {
            $acl->check('money', 'create', 'manager');
            $this->fail('expected exception');
        } catch (\App\Acl\AccessDenied $e) {
            
        }
        // END
    }

    // BEGIN (write your solution here)
    public function testResourceUndefined()
    {
        $acl = new Acl(static::$data);

        try {
            $acl->check('undefined resources', 'edit', 'manager');
            $this->fail('expected exception');
        } catch (\App\Acl\ResourceUndefined $e) {
        }
    }

    public function testPrivilegeUndefined()
    {
        $acl = new Acl(static::$data);

        try {
            $acl->check('articles', 'move', 'manager');
            $this->fail('expected exception');
        } catch (\App\Acl\PrivilegeUndefined $e) {
        }
    }
    // END
}
