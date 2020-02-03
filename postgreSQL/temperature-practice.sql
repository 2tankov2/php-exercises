CREATE TABLE weathers (
  id integer,
  date date,
  temperature integer
);

INSERT INTO weathers (id, date, temperature) VALUES
(1, '2016-01-01', 10),
(2, '2016-01-02', 25),
(3, '2016-01-03', 20),
(4, '2016-01-04', 30);

-- Таблица weathers содержит записи значений температур в разные дни. Каждая запись имеет id, дату
-- date и значение температуры temperature.

-- id	date	temperature
-- 1	2016-01-01	10
-- 2	2016-01-02	25
-- 3	2016-01-03	20
-- 4	2016-01-04	30
-- solution.sql
-- Напишите SQL запрос для выбора id всех записей, температура в которых была выше, чем в предыдущий день (чем вчера).
-- Запишите запрос в файл solution.sql.

SELECT a.id FROM weathers AS a, weathers AS b
    WHERE a.temperature > b.temperature AND a.date - b.date = 1;

-- or

SELECT current_weathers.id
FROM weathers AS current_weathers
    JOIN weathers AS yesterday_weathers
    ON current_weathers.temperature > yesterday_weathers.temperature
    AND (current_weathers.date - yesterday_weathers.date) = 1;

id |    date    | temperature 
---+------------+-------------
2  | 2016-01-02 |          25
4  | 2016-01-04 |          30
(2 rows)