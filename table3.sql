-- solution.sql
-- Создайте таблицу users со следующими полями:
--     id - первичный ключ
--     first_name - имя
--     created_at - дата создания пользователя
-- Добавьте в таблицу users одну произвольную запись.
-- Создайте таблицу orders со следующими полями:
--     id - первичный ключ
--     user_first_name - при вставке записи здесь указывается имя пользователя из таблицы users
--     months - количество покупаемых месяцев (обучение на Хекслете)
--     created_at - дата создания заказа
-- Добавьте в таблицу orders два заказа на созданного ранее пользователя

CREATE TABLE users (
    id bigint PRIMARY KEY,
    first_name varchar(255),
    created_at timestamp
);

INSERT INTO users VALUES (1, 'Smirnov', '2020-01-20');

CREATE TABLE orders (
    id bigint PRIMARY KEY,
    user_first_name varchar(255),
    months integer,
    created_at varchar(255)
);

INSERT INTO orders VALUES (1, 'Smirnov', 3, '2020-01-22');
INSERT INTO orders VALUES (2, 'Smirnov', 2, '2020-01-23');
