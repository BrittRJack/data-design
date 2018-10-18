<?php


/**
 * constructor for this products
 *
 * @param string|Uuid $productId id of this product or null if a product
 * @param string|Uuid $categoryProductId id of the Profile that sent this product
 * @param string productType string containing actual product data
 * @param string productPrice string containing product numbers
 * @throws \InvalidArgumentException if data types are not valid
 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
 * @throws \TypeError if data types violate type hints
 * @throws \Exception if some other exception occurs
 * @Documentation https://php.net/manual/en/language.oop5.decon.php
 **/

class product {
	private $productId;
	private $categoryProductId;
	private $newProductType;
	private $newProductPrice;
};
    public  function __construct ($newProductId,$newCategoryProductId,$newProductType,$newProductPrice); {
}
	{
	    try {
			 $this->setProductId($newProductId);
			 $this->setCategoryProductId($newCategoryProductId);
			 $this->setProductType($newProductType);
			 $this->setProductPrice($newProductPrice);
		 }
		 catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError
		 $exception) { $exceptionType = get_class($exception);
		 throw (new$exceptionType($exception->getMessage(),0,$exception));

		 }
};


/**
 * accessor method for product id
 *
 * @return Uuid value of product id
 **/
public function getProductId() Uuid:; {
		return($this->productId);
}






