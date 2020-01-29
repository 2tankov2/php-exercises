DROP TABLE IF EXISTS users;
CREATE TABLE users (
    first_name varchar(255),
    email varchar(255),
    house varchar(255),
    birthday timestamp,
    created_at timestamp
);

INSERT INTO users (first_name, email, house, birthday, created_at) VALUES
    ('Sansa', 'sansa@winter.com', 'stark', '1999-10-23', '2018-11-03'),
    ('Jon', 'jon@winter.com', 'stark', '1999-10-07', '2018-10-23'),
    ('Daenerys', 'daenerys@drakaris.com', 'targarien',  '1999-10-23', '2018-12-23'),
    ('Arya', 'arya@winter.com', 'stark', '2003-03-29', '2018-11-18'),
    ('Robb', 'robb@winter.com', 'stark', '1999-11-23', '2018-11-10'),
    ('Brienne', 'brienne@tarth.com', 'ne pomnu', '2001-04-04', '2018-11-28'),
    ('Tirion', 'tirion@got.com', 'lannister', '1975-1-11', '2018-11-23');


-- solution.sql
-- Составьте запрос, который извлекает все записи из таблицы users по следующим правилам:

-- Пользователи созданы позже 2018-11-23 (включая эту дату) и раньше 2018-12-12 (включая эту дату)
-- или поле house имеет значение stark
-- Данные отсортированы по дате создания по убыванию

SELECT * FROM users
    WHERE created_at BETWEEN '2018-11-23' AND '2018-12-12' OR house = 'stark'
    ORDER BY created_at DESC;