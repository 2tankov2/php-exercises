-- solution.sql
-- Создайте таблицу cars со следующими полями:
-- user_first_name - имя пользователя (соответствующее имени в таблице users)
-- brand - марка машины
-- model - конкретная модель
-- Добавьте в таблицу users две произвольные записи. Сама таблица добавляется в базу данных
-- автоматически (смотрите файл init.sql)
-- Добавьте в таблицу cars 5 произвольных записей. Две из них должны указывать на одного
-- пользователя (соответствие по имени пользователя), а три других - на другого.

-- solution.sql
DROP TABLE IF EXISTS users;
CREATE TABLE users (
    first_name varchar(255),
    last_name varchar(255),
    created_at timestamp,
    PRIMARY KEY (first_name) -- не обязательно
);

CREATE TABLE cars ( 
    user_first_name  varchar(255),
    brand varchar(255),
    model varchar(255),
    FOREIGN KEY (user_first_name) REFERENCES users (first_name) -- не обязательно
);

INSERT INTO users VALUES ('Maxim', 'Smirnov', '1832-10-11');
INSERT INTO users VALUES ('Lena', 'Ivanova', '1932-10-11');
INSERT INTO cars VALUES ('Maxim', 'bmw', 'x5');
INSERT INTO cars VALUES ('Lena', 'audi', 'cs4');
INSERT INTO cars VALUES ('Maxim', 'renault', 'logan');
INSERT INTO cars VALUES ('Lena', 'lada', 'losk');
INSERT INTO cars VALUES ('Maxim', 'opel', 'fd4');