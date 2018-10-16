




INSERT INTO customer (customerId,customerHash,customerAtHandle,customerEmail)
VALUES(unhex("c1d5cc89ee764e4fb42c49ecf2a2fe26"),"8a168b270ff83778abdd86ddeb81223de97dd01f0a32e2e78ee5ce206471e2cfea8d025994c95cfa0d0d797419cab7ad7",
		 "activationToken", "customerEmail");


INSERT INTO category (categoryId, categoryName, categoryDesign)
VALUES (unhex("568340198eee442d8757b3b03bdb5521"),"categoryName","categoryDesign");

INSERT INTO product(productId, productCategoryId, productType, productPrice)
VALUES (unhex("d91381882d444238b2b05393c6b66225"), unhex("568340198eee442d8757b3b03bdb5521"),
			"productType", "200.99");


UPDATE customer SET customerEmail="customerEmail"
WHERE customerEmail= ("johnson2@cnm.edu");



SELECT customer.customerId, customerActivationToken, customerHash, customerAtHandle, customerEmail FROM customer WHERE customerId = unhex("c1d5cc89ee764e4fb42c49ecf2a2fe26")
