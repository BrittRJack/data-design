<?php


namespace bjack2\DataDesign;
require_once(dirname(__DIR__, 2) . "/vender/autoload.php");
require_once ("Autoload.php");

use Ramsey\Uuid\Uuid;

class Product {
	use ValidateDate;
	use ValidateUuid;

	private $productId;
	/**
	 * id for this Tweet; this is the primary key
	 * @var Uuid $tweetId
	 **/
	private $productCategoryId;
	/**
	 * id of the Profile that sent this Tweet; this is a foreign key
	 * @var Uuid $tweetProfileId
	 **/
	private $productType;
	/**
	 * date and time this Tweet was sent, in a PHP DateTime object
	 * @var \DateTime $tweetDate
	 **/
	private $productDate;

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

	public function __construct($newProductId, $newProductCategoryId, $newProductDate, string $newProductType ) {
		try {
			$this->setProductId($newProductId);
			$this->setProductCategoryId($newProductCategoryId);
			$this->setProductType($newProductType);
			$this->setProductDate($newProductDate);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage("Error"), 0, $exception));

		}
	}


	/**
	 * accessor method for tweet id
	 *
	 * @return Uuid value of tweet id
	 **/
	public function getProductId() : Uuid {
		return($this->productId);

		//this outside of class
		//$tweet->getTweetId();
	}

	/**
	 * mutator method for tweet id
	 *
	 * @param Uuid|string $newTweetId new value of tweet id
	 * @throws \RangeException if $newTweetId is not positive
	 * @throws \TypeError if $newTweetId is not a uuid or string
	 **/
	public function setProductId( $newProductId) : void {
		try {
			$uuid = self::validateUuid($newProductId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {

		}

		// convert and store the tweet id
		$this->productId = $uuid;
	}

	/**
	 * accessor method for tweet profile id
	 *
	 * @return Uuid value of tweet profile id
	 **/
	public function getProductCategoryId() : Uuid{
		return($this->productCategoryId);
	}


	/**
	 * mutator method for tweet profile id
	 *
	 * @param string | Uuid $newTweetProfileId new value of tweet profile id
	 * @throws \RangeException if $newProfileId is not positive
	 * @throws \TypeError if $newTweetProfileId is not an integer
	 **/
	public function setProductCategoryId( $newProductCategoryId) : void {
		try {
			$uuid = self::validateUuid($newProductCategoryId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

		// convert and store the profile id
		$this->productCategoryId = $uuid;
	}

	/**
	 * accessor method for tweet content
	 *
	 * @return string value of tweet content
	 **/
	public function getProductType() : string {
		return($this->productType);
	}

	/**
	 * mutator method for tweet content
	 *
	 * @param string $newTweetContent new value of tweet content
	 * @throws \InvalidArgumentException if $newTweetContent is not a string or insecure
	 * @throws \RangeException if $newTweetContent is > 140 characters
	 * @throws \TypeError if $newTweetContent is not a string
	 **/
	public function setProductType(string $newProductType) : void {
		// verify the tweet content is secure
		$newProductType = trim($newProductType);
		$newProductType = filter_var($newProductType, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newProductType) === true) {
			throw(new \InvalidArgumentException("product type is empty or insecure"));
		}

		// verify the tweet content will fit in the database
		if(strlen($newProductType) >= 140) {
			throw(new \RangeException("product type content too large"));
		}

		// store the tweet content
		$this->productType = $newProductType;
	}

	/**
	 * accessor method for tweet date
	 *
	 * @return \DateTime value of tweet date
	 **/
	public function getProductDate() : \DateTime {
		return($this->productDate);
	}

	/**
	 * mutator method for tweet date
	 *
	 * @param \DateTime|string|null $newTweetDate tweet date as a DateTime object or string (or null to load the current time)
	 * @throws \InvalidArgumentException if $newTweetDate is not a valid object or string
	 * @throws \RangeException if $newTweetDate is a date that does not exist
	 **/
	public function setProductDate($newProductDate = null) : void {
		// base case: if the date is null, use the current date and time
		if($newProductDate === null) {
			$this->productDate = new \DateTime();
			return;
		}

		// store the like date using the ValidateDate trait
		try {
			$newProductDate = self:: ValidateDateTime ($newProductDate);
		} catch(\InvalidArgumentException | \RangeException $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		$this->productDate = $newProductDate;
	}
}












