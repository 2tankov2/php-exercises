-- solution.sql
-- Создайте таблицу article_categories с двумя полями:

-- id - автогенерируемый первичный ключ
-- name - текстовое поле
-- Добавьте в эту таблицу две произвольные записи

CREATE TABLE article_categories (
    id bigint PRIMARY KEY GENERATED ALWAYS AS IDENTITY,
    name varchar(255)
);

INSERT INTO article_categories (name) VALUES ('Интересное'), ('Популярное');