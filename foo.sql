





CREATE TABLE customer (
	customerId	BINARY(16) NOT NULL,
	customerActivationToken CHAR(32),
	customerAtHandle VARCHAR(32) NOT NULL,
	customerEmail VARCHAR(128) NOT NULL,

	customerHash CHAR(97) NOT NULL,
	customerPhone VARCHAR(32),

	UNIQUE (customerAtHandle),
	UNIQUE (customerEmail),

	PRIMARY KEY (customerId)
);


CREATE TABLE category (

	categoryId BINARY (16)NOT NULL,
	categoryName VARCHAR (32) NOT NULL,
	categoryDesign VARCHAR(30),

	INDEX (categoryId),

	FOREIGN KEY (categoryId) REFERENCES customer (customerId)
);



CREATE TABLE product(
	productId BINARY(30) NOT NULL,
	productCategoryId BINARY (30)NOT NULL ,
	productType VARCHAR(16) NOT NULL,
	productPrice CHAR (16),

	PRIMARY KEY (productId),

	INDEX (productCategoryId),

	FOREIGN KEY (productCategoryId) REFERENCES product (productId)
);