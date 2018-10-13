





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




