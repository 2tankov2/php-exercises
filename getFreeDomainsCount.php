<?php
/**
 * Реализуйте функцию getFreeDomainsCount, которая принимает на вход список емейлов, а возвращает количество
 * емейлов, расположенных на каждом бесплатном домене. Список бесплатных доменов хранится в константе
 * FREE_EMAIL_DOMAINS.

<?php

$emails = [
    'info@gmail.com',
    'info@yandex.ru',
    'info@hotmail.com',
    'mk@host.com',
    'support@hexlet.io',
    'key@yandex.ru',
    'sergey@gmail.com',
    'vovan@gmail.com',
    'vovan@hotmail.com'
];

getFreeDomainsCount($emails);
# => Array (
#     'gmail.com' => 3
#     'yandex.ru' => 2
#     'hotmail.com' => 2
#  )
 */
namespace App\Emails;

const FREE_EMAIL_DOMAINS = [
    'gmail.com', 'yandex.ru', 'hotmail.com'
];

// BEGIN (write your solution here)
function getFreeDomainsCount($data)
{
    $pathMail = array_map(function ($element) {
        $path = explode('@', $element);
        return $path[1];
    }, $data);
    $copyMail = array_values(array_intersect($pathMail, FREE_EMAIL_DOMAINS));
    $result = array_reduce($copyMail, function ($acc, $mail) {
        $acc[$mail] = (!array_key_exists($mail, $acc)) ? 1 : $acc[$mail] + 1;
        return $acc;
    }, []);
    return $result;
}
// END

// BEGIN
function getFreeDomainsCount(array $emails)
{
    $domains = array_map(function ($email) {
        return explode('@', $email)[1];
    }, $emails);

    $freeDomains = array_filter($domains, function ($domain) {
        return in_array($domain, FREE_EMAIL_DOMAINS);
    });


    return array_reduce($freeDomains, function ($acc, $domain) {
        if (!array_key_exists($domain, $acc)) {
            $acc[$domain] = 1;
        } else {
            $acc[$domain] += 1;
        }

        return $acc;
    }, []);
}
// END