-- Каждый раз когда мы совершаем покупки в интернете, на стороне продавца формируется "заказ". Это сущность,
-- которая описывает собой конкретную покупку и включает в себя пользователя, а также список позиций.
-- Если взять какой-нибудь интернет-магазин торгующий электроникой, то в заказ могут входить клавиатура,
-- мышка и коврик. Ниже представлена ERD в которой отражены сущности, участвующие в процессе.

DROP TABLE IF EXISTS users CASCADE;
CREATE TABLE users (
    id bigint PRIMARY KEY GENERATED ALWAYS AS IDENTITY,
    email varchar(255),
    first_name varchar(255)
);

CREATE TABLE orders (
    id bigint PRIMARY KEY GENERATED ALWAYS AS IDENTITY,
    user_id bigint REFERENCES users (id),
    created_at timestamp
);

CREATE TABLE goods (
    id bigint PRIMARY KEY GENERATED ALWAYS AS IDENTITY,
    name varchar(255),
    price numeric
);

CREATE TABLE order_items (
    id bigint PRIMARY KEY GENERATED ALWAYS AS IDENTITY,
    order_id bigint REFERENCES orders (id),
    good_id bigint REFERENCES goods (id),
    price numeric
);
