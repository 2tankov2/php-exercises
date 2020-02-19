<?php

/**
 * src\Helpers.php
 * Реализуйте функцию getGreeting($user), которая возвращает приветствие для пользователя. Это приветствие
 * показывается пользователю на сайте. Если пользователь гость, то выводится "Nice to meet you Guest!", если
 * не гость, то "Hello <Имя>!", где "<Имя>" это имя реального пользователя.

 * В этой задаче, способ решения остается на ваше усмотрение. Используйте знания полученные в этом курсе.

<?php

$guest = new \App\Guest();
getGreeting($guest); // 'Nice to meet you Guest!'

$user = new \App\User('Petr');
getGreeting($user); // 'Hello Petr!'

 */

 //Guest.php
<?php

namespace App;

class Guest
{
    public function getName()
    {
        return 'Guest';
    }

    // BEGIN (write your solution here)
    public function isGuest()
    {
        return true;
    }
    // END
}
/**
 *     // BEGIN
 *   public function getTypeName()
 *   {
 *      return 'guest';
 *  }
 *   // END
 */

//User.php
<?php

namespace App;

class User
{
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    // BEGIN (write your solution here)
    public function isGuest()
    {
        return false;
    }
    // END
}
/**
 *     // BEGIN
 *   public function getTypeName()
 *   {
 *       return 'user';
 *   }
 *   // END
 */

//Helpers.php

<?php

namespace App\Helpers;

// BEGIN (write your solution here)
function getGreeting($user)
{
    if ($user->isGuest()) {
        return "Nice to meet you Guest!";
    } return "Hello {$user->getName()}!";
}
// END
/**
 * // BEGIN
 * // This logic is not about user itself
 * function getGreeting($user)
 * {
 *    $mapping = [
 *      'guest' => function ($guest) {
 *            return "Nice to meet you {$guest->getName()}!";
 *       },
 *       'user' => function ($user) {
 *           return "Hello {$user->getName()}!";
 *       }
 *   ];
 *   return $mapping[$user->getTypeName()]($user);
 *}
 * // END
 */