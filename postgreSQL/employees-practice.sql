CREATE TABLE employees (
    id integer,
    name varchar(10),
    salary integer,
    manager_id integer
);

INSERT INTO employees (id, name, salary, manager_id) VALUES
(1, 'Joe', 70000, 3),
(2, 'Henry', 80000, 4),
(3, 'Sam', 60000, NULL),
(4, 'Max', 90000, NULL);

-- Таблица employees содержит всех работников включая их менеджеров. Каждый работник имеет id и колонку
-- для id менеджера manager_id.

-- id	name	salary	manager_id
-- 1	Joe	70000	3
-- 2	Henry	80000	4
-- 3	Sam	60000	NULL
-- 4	Max	90000	NULL
-- solution.sql
-- Напишите SQL запрос который найдет имена всех работников, которые получают больше чем их менеджеры.
-- Если у работника нет менеджера, они не должны попадать в выборку.

SELECT  a.name FROM employees AS a, employees AS b
    WHERE a.salary > b.salary AND a.manager_id = b.id;

-- or

SELECT employees.name
FROM employees JOIN employees AS manager ON (employees.manager_id = manager.id)
WHERE employees.salary > manager.salary;

name 
------
Joe
(1 row)