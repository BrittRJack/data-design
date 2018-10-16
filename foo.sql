
DROP TABLE IF EXISTS product;
DROP TABLE IF EXISTS category;
DROP TABLE IF EXISTS customer;




CREATE TABLE customer(
	customerId	BINARY(16) NOT NULL,
	customerActivationToken VARCHAR(32),
	customerAtHandle VARCHAR(32) NOT NULL,
	customerEmail VARCHAR(128) NOT NULL,

	customerHash CHAR(97) NOT NULL,
	customerPhone VARCHAR(32),

	UNIQUE (customerAtHandle),
	UNIQUE (customerEmail),

	PRIMARY KEY (customerId)
);


CREATE TABLE category(

	categoryId BINARY (16)NOT NULL,
	categoryName VARCHAR (32) NOT NULL,
	categoryDesign VARCHAR(30),


	PRIMARY KEY (categoryId)
);



CREATE TABLE product(
	productId BINARY(16) NOT NULL,
	productCategoryId BINARY (16)NOT NULL ,
	productType VARCHAR(16) NOT NULL,
	productPrice SMALLINT (255),

	PRIMARY KEY (productId),

	INDEX (productCategoryId),

	FOREIGN KEY (productCategoryId) REFERENCES category (categoryId)
);


