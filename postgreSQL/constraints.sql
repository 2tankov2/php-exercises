-- solution.sql
-- Напишите запрос, создающий таблицу users со следующими полями:

-- id — первичный автогенерируемый ключ.
-- username — уникально и не может быть null.
-- email — не может быть null.
-- created_at — не может быть null.
-- Напишите запрос, создающий таблицу topics со следующими полями:

-- id — первичный автогенерируемый ключ.
-- user_id — внешний ключ.
-- body — не может быть null.
-- created_at — не может быть null.

CREATE TABLE users (
    id bigint PRIMARY KEY GENERATED ALWAYS AS IDENTITY,
    username varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    created_at timestamp NOT NULL,
    UNIQUE (username, email)
);

CREATE TABLE topics (
    id bigint PRIMARY KEY GENERATED ALWAYS AS IDENTITY,
    user_id bigint REFERENCES users (id),
    body varchar(255) NOT NULL,
    created_at timestamp NOT NULL
);