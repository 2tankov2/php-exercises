<?php

/**
 * src/File.php
 * Создайте класс File, который представляет собой абстракцию над файлом (упрощенная версия SplFileInfo).
 * Реализуйте в этом классе метод read(). Этот метод проверяет можно ли прочитать файл и если да, то читает
 * его, если нет, то бросает исключения двух видов:

 * Если файла не существует – App\Exceptions\NotExistsException
 * Если файл нельзя прочитать (но он существует) – App\Exceptions\NotReadableException
<?php

$file = new File('/etc/fstab');
$file->read();
src/Exceptions/FileException
 * Реализуйте класс FileException, который наследуется от Exception. Это базовое исключение для данной
 * библиотеки.

 * src/Exceptions/NotReadableException, src/Exceptions/NotExistsException
 * Реализуйте классы исключения. Они должны наследоваться от базового класса исключений для данной библиотеки.

Подсказки
is_readable
file_exists
 */

// src/File.php

namespace App;

// BEGIN
class File
{
    protected $filepath;

    public function __construct($filepath)
    {
        $this->filepath = $filepath;
    }

    public function read()
    {
        $filepath = $this->filepath;

        if (!file_exists($filepath)) {
            throw new Exceptions\NotExistsException();
        }
        if (!is_readable($filepath)) {
            throw new Exceptions\NotReadableException();
        }

        return file_get_contents($filepath);
    }
}
// END

// src/Exceptions/FileException.php

namespace App\Exceptions;

class FileException extends \Exception
{

}

// src/Exceptions/NotReadbleException.php

namespace App\Exceptions;

class NotReadableException extends FileException
{

}

// src/Exceptions/NotExistsException.php

namespace App\Exceptions;

class NotExistsException extends FileException
{

}

// tests/FileTest.php


namespace App\Tests;

use App\File;
use PHPUnit\Framework\TestCase;

class FileTest extends TestCase
{
    public function testRead()
    {
        $file = new File('/etc/fstab');
        $this->assertNotNull($file->read());
    }

    /**
     * @expectedException App\Exceptions\NotExistsException
     */
    public function testRead2()
    {
        $file = new File('/etc/wopwop');
        $file->read();
    }

    /**
     * @expectedException App\Exceptions\NotReadableException
     */
    public function testRead3()
    {
        $file = new File('/etc/shadow');
        $file->read();
    }
}
