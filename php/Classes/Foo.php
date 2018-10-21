<?php

namespace bjack2\datadesign;
require_once(dirname(__DIR__, 2) . "/vendor/autoload.php");

use Ramsey\Uuid\Uuid;



/* constructor for this products
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
 */

class Product {
	private $ProductId;
	private $CategoryProductId;
	private $ProductType;
	private $ProductPrice;

  public function __construct($newProductId,$newCategoryProductId, string $newProductType, $newProductPrice = null){
		try {
			$this->setProductId($newProductId);
			$this->setProductCategoryId($newCategoryProductId);
			$this->setProductType($newProductType);
			$this->setProductPrice($newProductPrice);
		}

		catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new$exceptionType($exception->getMessage(), 0, $exception));

		}
}


/**
 * accessor method for product id
 *
 * @return Uuid value of product id
 **/


public function getProductId(): Uuid {
		return($this->productId);

		//this outside of class
//$tweet->getProductId();
}

/**
 * mutator method for tweet id
 *
 * @param Uuid|string $newProductId new value of tweet id
 * @throws \RangeException if $newProductId is not positive
 * @throws \TypeError if $newProductId is not a uuid or string
 **/

public function setCategoryProductId() : Uuid{
	return($this -> $CategoryProductId);
}


/**
 * mutator method for tweet profile id
 *
 * @param string | Uuid $newCategoryProductId new value of categoryProduct id
 * @throws \RangeException if $newProfileId is not positive
 * @throws \TypeError if $newTweetProfileId is not an integer
 **/

public function setProductType($newProductType): void {
	try {
		$uuid = self::validateUuid($newProductType);
	} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError
$exception) {
		$exceptionType = get_class($exception);
		throw(new $exceptionType($exception->getMessage(), 0, $exception));
	}
	// convert and store the profile id
	$this -> $ProductCategoryId = $uuid;
}
	/**
	 * accessor method for tweet content
	 *
	 * @return string value of product CategoryId
	 **/
	public function getTweetContent() : string {
	return $this -> $productType;
}


/**
 * mutator method for tweet content
 *
 * @param string $newProductType new value of tweet content
 * @throws \InvalidArgumentException if $newProductType is not a string or insecure
 * @throws \RangeException if $newProductType is > 140 characters
 * @throws \TypeError if $newProductType is not a string
 **/

public function setProductType (string $newProductType) : void {
	// verify the product type is secure
	$newProductType = trim($newProductType);
	$newProductType = filter_var($newProductType, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	if(empty($newProductType) === true) {
		throw(new \InvalidArgumentException("Product Type is empty or insecure"));
	}

	// verify the product type will fit in the database
	if(strlen($newProductType) >= 140) {
		throw(new \RangeException("Product Type too large"));
	}


		// store the product type
		$this -> $productType = $newProductType;
}
	/**
	 * accessor method for product date
	 *
	 * @return \DateTime value of product date
	 **/

	public function getDate(): \DateTime {
		return ($this->productDate);
		}


	/**
	 * mutator method for tweet date
	 *
	 * @param \DateTime|string|null $newProductDate product date as a DateTime object or string (or null to load the current time)
	 * @throws \InvalidArgumentException if $newProductDate is not a valid object or string
	 * @throws \RangeException if $newProductDate is a date that does not exist
	 **/
public function setProductDate($newProductDate = null) : void {
// base case: if the date is null, use the current date and time
			if($newProductDate ===null){
				$this -> $productDate = new \DateTime();
				return;

			}
			// store the like date using the ValidateDate trait
			try{
				$newProductDate = Self ::validDateTime($newProductDate);
			}	catch(\InvalidArugumentException|\RangeException $exception){
				$exceptionType = get_class($exception);
				throw(new $exceptionType($exception->getMessage(), 0, $exception));
			}
			$this->ProductDate = $newProductDate;
		}
}








