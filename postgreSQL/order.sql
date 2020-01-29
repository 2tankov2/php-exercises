DROP TABLE IF EXISTS users;
CREATE TABLE users (
    first_name varchar(255),
    email varchar(255),
    birthday timestamp
);

INSERT INTO users (first_name, email, birthday) VALUES
    ('Sansa', 'sansa@winter.com', '1999-10-23'),
    ('Jon', 'jon@winter.com', '1999-10-07'),
    ('Daenerys', 'daenerys@drakaris.com', NULL),
    ('Arya', 'arya@winter.com', '2003-03-29'),
    ('Robb', 'robb@winter.com', '1999-11-23'),
    ('Brienne', 'brienne@tarth.com', '2001-04-04'),
    ('Tirion', 'tirion@got.com', '1975-1-11');


-- Составьте запрос, который извлекает из базы данных (таблица users) все имена (поле first_name)
-- пользователей, отсортированных по дате рождения (поле birthday) в обратном порядке. Те записи,
-- у которых нет даты рождения, должны быть в конце списка.

SELECT first_name FROM users ORDER BY birthday DESC NULLS LAST;