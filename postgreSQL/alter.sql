-- solution.sql

-- Напишите запрос обновляющий таблицу структуры:

CREATE TABLE users (
    id bigint PRIMARY KEY GENERATED ALWAYS AS IDENTITY,
    email varchar(255) NOT NULL,
    age integer,
    name varchar(255)
);
-- В структуру:

CREATE TABLE users (
    id bigint PRIMARY KEY GENERATED ALWAYS AS IDENTITY,
    email varchar(255) NOT NULL UNIQUE,
    first_name varchar(255) NOT NULL,
    created_at timestamp
);
-- name и first_name - одна и та же колонка.

ALTER TABLE users ADD COLUMN created_at timestamp;
ALTER TABLE users RENAME COLUMN name TO first_name;
ALTER TABLE users DROP COLUMN age;

ALTER TABLE users ALTER COLUMN first_name SET NOT NULL;
ALTER TABLE users ADD UNIQUE (email);
