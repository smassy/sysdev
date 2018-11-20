-- SQL script file to create the necessary tables for the project

-- Change to the database
use sd_project;

-- DROP tables if they exist.
DROP TABLE IF EXISTS items;
DROP TABLE IF EXISTS suppliers;
DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS units;
DROP TABLE IF EXISTS users;

-- CREATE tables
CREATE TABLE users (
	id INT UNSIGNED AUTO_INCREMENT,
	name VARCHAR(60) NOT NULL,
	password VARCHAR(255) NOT NULL,
	role VARCHAR(50) NOT NULL,
	PRIMARY KEY USERS_ID_PK (id)
);

CREATE TABLE suppliers (
	id INT UNSIGNED AUTO_INCREMENT,
	name VARCHAR(100) NOT NULL,
	PRIMARY KEY SUPPLIERS_ID_PK (id)
);

CREATE TABLE categories (
	id INT UNSIGNED AUTO_INCREMENT,
	name VARCHAR(50) NOT NULL,
	INDEX CATEGORIES_NAME_IX (name),
	PRIMARY KEY CATEGORIES_ID_PK (id)
);

CREATE TABLE units (
	id INT UNSIGNED AUTO_INCREMENT,
	name VARCHAR(10) NOT NULL,
	is_whole BOOL DEFAULT FALSE,
	PRIMARY KEY UNITS_ID_PK (id)
);

CREATE TABLE items (
	id INT UNSIGNED AUTO_INCREMENT,
	category_id INT UNSIGNED NOT NULL,
	supplier_id INT UNSIGNED NOT NULL,
	unit_id INT UNSIGNED NOT NULL,
	name VARCHAR(60) NOT NULL,
	qty DECIMAL(6,2) DEFAULT 0,
	threshold DECIMAL(6,2) DEFAULT 0,
	last_added DATETIME,
	PRIMARY KEY ITEMS_ID_PK (id),
	FOREIGN KEY ITEMS_CATEGORY_ID_FK (category_id) REFERENCES categories (id),
	FOREIGN KEY ITEMS_SUPPLIER_ID_FK (supplier_id) REFERENCES suppliers (id),
	FOREIGN KEY ITEMS_UNIT_ID_FK (unit_id) REFERENCES units (id),
	INDEX ITEMS_CATEGORY_ID_IX (category_id),
	INDEX ITEMS_supplier_ID_IX (supplier_id),
	INDEX ITEMS_UNIT_ID_IX (unit_id),
	INDEX ITEMS_NAME_IX (name)
);

