CREATE DATABASE SWallet;

CREATE TABLE Users(
    id SERIAL PRIMARY KEY ,
    fullname VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    password TEXT NOT NULL
);

CREATE TABLE categories(
    id SERIAL PRIMARY KEY,
    name VARCHAR(50) NOT NULL 
)

CREATE TABLE incomes(
    id SERIAL PRIMARY KEY,
    montant DECIMAL(10,2) NOT NULL,
    descreption VARCHAR(50) NOT NULL,
    la_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    user_id int,
    category_id int ,

    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (category_id) REFERENCES categories(id)
    );
    
CREATE TABLE expenses(
    id SERIAL PRIMARY KEY,
    montant DECIMAL(10,2) NOT NULL,
    descreption VARCHAR(50) NOT NULL,
    la_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    user_id int ,
    category_id int ,

    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (category_id) REFERENCES categories(id)
)
