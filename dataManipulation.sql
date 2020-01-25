DROP TABLE IF EXISTS users;
CREATE TABLE users (
    first_name varchar(255),
    email varchar(255),
    manager boolean
);

INSERT INTO users (first_name, email) VALUES
    ('Sansa', 'sansa@winter.com'),
    ('Tirion', 'tirion@got.com');

-- solution.sql
-- Запишите в файл следующие запросы:

-- Запрос, который удаляет пользователя с именем Sansa
-- Запрос, который вставляет в базу пользователя с именем Arya и почтой arya@winter.com
-- Запрос, который устанавливает флаг manager в true для пользователя с емейлом tirion@got.com

DELETE FROM users WHERE first_name = 'Sansa';
INSERT INTO users (first_name, email) VALUES ('Arya', 'arya@winter.com');
UPDATE users SET manager = true WHERE email = 'tirion@got.com';

-- Составьте запрос, который извлекает все записи из таблицы users по следующим правилам:
-- Пользователи должны быть рождены позже 23 октября 1999 года. Поле `birthday`.
-- Выборка отсортирована в алфавитном порядке по полю `first_name`
-- Нужно извлечь только три записи

SELECT * FROM users WHERE birthday > '1999-10-23' ORDER BY first_name LIMIT 3;