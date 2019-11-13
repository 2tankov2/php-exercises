<?php


// QueryBuilder.php
namespace App;

class QueryBuilder
{
    private $selectPart = '*';
    private $tablePart;
    private $whereParts = [];

    public static function from($table)
    {
        $builder = new QueryBuilder($table);
        return $builder;
    }

    public function __construct($table)
    {
        $this->tablePart = $table;
    }

    public function select()
    {
        $this->selectPart = implode(", ", func_get_args());
        return $this;
    }

    public function where($key, $value)
    {
        $this->whereParts[$key] = $value;
        return $this;
    }

    public function toSql()
    {
        $sqlParts = [];
        $sqlParts[] = "SELECT {$this->selectPart} FROM {$this->tablePart}";

        if ($this->whereParts) {
            $whereParts = array_map(function ($key, $value) {
                if (is_null($value)) {
                    return "$key IS NULL";
                } else {
                    return "$key = $value";
                }
            }, array_keys($this->whereParts), $this->whereParts);

            $wheres = implode(' AND ', $whereParts);
            $sqlParts[] = "WHERE $wheres";
        }

        return implode(' ', $sqlParts);
    }
}

//QueryBuilderTest.php

namespace App\Tests;

use PHPUnit\Framework\TestCase;

class QueryBuilderTest extends TestCase
{
    public function testSelect()
    {
        // BEGIN
        $builder = \App\QueryBuilder::from('users');
        $expected = 'SELECT * FROM users';
        $this->assertEquals($expected, $builder->toSql());

        $builder = \App\QueryBuilder::from('photos')->select('age', 'name');
        $expected = 'SELECT age, name FROM photos';
        $this->assertEquals($expected, $builder->toSql());
        // END
    }
    // BEGIN
    public function testWhere()
    {
        $builder = \App\QueryBuilder::from('users')
            ->where('age', '18')
            ->where('source', 'facebook');
        $expected = "SELECT * FROM users WHERE age = '18' AND source = 'facebook'";
        $this->assertEquals($expected, $builder->toSql());
    }

    public function testWhereWithNull()
    {
        $builder = \App\QueryBuilder::from('users')
            ->where('email', null);
        $expected = 'SELECT * FROM users WHERE email IS NULL';
        $this->assertEquals($expected, $builder->toSql());
    }
    // END
}
