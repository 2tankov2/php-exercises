-- solution.sql
-- В этом задании нужно создать три таблицы. Все запросы нужно записывать в файл указанный в заголовке.
-- Система проверки сама их выполнит внутри базы данных.

-- Напишите запрос создающий таблицу courses со следующими полями

-- name типа varchar длиной 255.
-- body типа text.
-- created_at типа timestamp.
-- Напишите запрос создающий таблицу users со следующими полями

-- first_name типа varchar длиной 255.
-- email типа varchar длиной 255.
-- manager типа boolean.
-- Напишите запрос создающий таблицу course_members со следующими полями

-- user_id типа integer
-- course_id типа integer
-- created_at типа timestamp

CREATE TABLE courses (
    name varchar(255),
    body text,
    created_at timestamp
);

CREATE TABLE users (
    first_name varchar(255),
    email varchar(255),
    manager boolean
);

CREATE TABLE course_members (
    user_id integer,
    course_id integer,
    created_at timestamp
);