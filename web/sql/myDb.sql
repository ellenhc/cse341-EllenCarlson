CREATE TABLE households (
    "householdId" SERIAL PRIMARY KEY NOT NULL,
    "householdName" VARCHAR(255) NOT NULL
);

CREATE TABLE users (
    "userId" SERIAL PRIMARY KEY NOT NULL,
    "userFirstName" varchar(255) NOT NULL,
    "userLastName" varchar(255) NOT NULL,
    "userEmail" varchar(255) NOT NULL,
    "householdId" int REFERENCES "households" NOT NULL,
    "userPassword" varchar(255) NOT NULL
);

CREATE TABLE categories (
    "categoryId" SERIAL PRIMARY KEY NOT NULL,
    "categoryName" varchar(255) NOT NULL
);

INSERT INTO categories ("categoryId", "categoryName") VALUES
(1, 'Donations'),
(2, 'Education'),
(3, 'Entertainment'),
(4, 'Food'),
(5, 'Health'),
(6, 'Housing'),
(7, 'Personal'),
(8, 'Pets'),
(9, 'Savings'),
(10, 'Transportation');

CREATE TABLE expenses (
    "expenseId" SERIAL PRIMARY KEY NOT NULL,
    "expenseName" varchar(255) NOT NULL,
    "expensePrice" money NOT NULL,
    "expenseDate" date NOT NULL,
    "categoryId" int REFERENCES "categories" NOT NULL,
    "userId" int REFERENCES "users" NOT NULL,
    "householdId" int REFERENCES "households" NOT NULL
);

CREATE TABLE budgets (
    "budgetId" SERIAL PRIMARY KEY NOT NULL,
    "budgetName" varchar(255) NOT NULL,
    "budgetAmount" money NOT NULL,
    "categoryId" int REFERENCES "categories" NOT NULL,
    "householdId" int REFERENCES "households" NOT NULL
);

INSERT INTO households ("householdName") VALUES ('Default');
INSERT INTO households ("householdName") VALUES ('Carlson');

INSERT INTO users ("userFirstName", "userLastName", "userEmail", "userPassword", "householdId") VALUES ('Ellen', 'Carlson', 'ellen@finanny.com', '$2y$10$CZv3KMtAMDdEdk84qZR94uP6PnkNxCMObWJ36kJI7e6bQ1Zr935Zm', 2);
INSERT INTO users ("userFirstName", "userLastName", "userEmail", "userPassword", "householdId") VALUES ('Matt', 'Carlson', 'matt@finanny.com', '$2y$10$CZv3KMtAMDdEdk84qZR94uP6PnkNxCMObWJ36kJI7e6bQ1Zr935Zm', 2);

INSERT INTO expenses("expenseName", "expensePrice", "expenseDate", "categoryId", "userId", "householdId") VALUES ('Gas', 34, '2021-02-02', 10, 1, 2);
INSERT INTO expenses("expenseName", "expensePrice", "expenseDate", "categoryId", "userId", "householdId") VALUES ('Drywall', 71.88, '2021-01-01', 6, 2, 2);
INSERT INTO expenses("expenseName", "expensePrice", "expenseDate", "categoryId", "userId", "householdId") VALUES ('Sprouts', 45.58, '2021-02-09', 4, 2, 1);

INSERT INTO expenses("expenseName", "expensePrice", "expenseDate", "categoryId", "userId", "householdId") VALUES ('Palmolive', 18.83, '2021-02-08', 1, 1, 2);
INSERT INTO expenses("expenseName", "expensePrice", "expenseDate", "categoryId", "userId", "householdId") VALUES ('Tithing', 100.33, '2021-02-03', 1, 1, 2);
INSERT INTO expenses("expenseName", "expensePrice", "expenseDate", "categoryId", "userId", "householdId") VALUES ('Tithing', 27.00, '2020-11-15', 1, 1, 2);
INSERT INTO expenses("expenseName", "expensePrice", "expenseDate", "categoryId", "userId", "householdId") VALUES ('Fall tuition', 768.00, '2020-11-22', 2, 1, 2);
INSERT INTO expenses("expenseName", "expensePrice", "expenseDate", "categoryId", "userId", "householdId") VALUES ('Winter tuition', 768.00, '2021-01-06', 2, 1, 2);
INSERT INTO expenses("expenseName", "expensePrice", "expenseDate", "categoryId", "userId", "householdId") VALUES ('Roku', 30.51, '2021-01-22', 3, 2, 2);
INSERT INTO expenses("expenseName", "expensePrice", "expenseDate", "categoryId", "userId", "householdId") VALUES ('Legos', 70.64, '2020-11-23', 3, 2, 2);
INSERT INTO expenses("expenseName", "expensePrice", "expenseDate", "categoryId", "userId", "householdId") VALUES ('Amazon Fresh', 47.07, '2020-11-21', 4, 1, 2);
INSERT INTO expenses("expenseName", "expensePrice", "expenseDate", "categoryId", "userId", "householdId") VALUES ('Amazon Fresh', 39.54, '2020-12-21', 4, 1, 2);
INSERT INTO expenses("expenseName", "expensePrice", "expenseDate", "categoryId", "userId", "householdId") VALUES ('CeraVe', 16.87, '2020-12-27', 5, 1, 2);
INSERT INTO expenses("expenseName", "expensePrice", "expenseDate", "categoryId", "userId", "householdId") VALUES ('Cotton gloves', 20.96, '2020-12-13', 5, 2, 2);
INSERT INTO expenses("expenseName", "expensePrice", "expenseDate", "categoryId", "userId", "householdId") VALUES ('Gatco', 16.55, '2021-02-07', 6, 1, 2);
INSERT INTO expenses("expenseName", "expensePrice", "expenseDate", "categoryId", "userId", "householdId") VALUES ('Lands End', 109.97, '2021-01-06', 7, 1, 2);
INSERT INTO expenses("expenseName", "expensePrice", "expenseDate", "categoryId", "userId", "householdId") VALUES ('Jiffy Lube', 105.67, '2021-02-03', 10, 1, 2);
INSERT INTO expenses("expenseName", "expensePrice", "expenseDate", "categoryId", "userId", "householdId") VALUES ('Jiffy Lube', 100.50, '2021-02-03', 10, 2, 2);
