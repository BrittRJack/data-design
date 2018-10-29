<?php


namespace bjack2\DataDesign;
require_once ("Autoload.php");
require_once(dirname(__DIR__, 2) . "/vendor/autoload.php");


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
	 * id of the Profile that sent this Product; this is a foreign key
	 * @var Uuid $productCategoryId
	 **/
	private $productType;
	/**
	 * date and time this Product was sent, in a PHP DateTime object
	 * @var \DateTime $ProductDate
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
			throw(new $exceptionType($exception->getMessage(), 0, $exception));

		}
	}


	/**
	 * accessor method for product id
	 *
	 * @return Uuid value of product id
	 **/
	public function getProductId() : Uuid {
		return($this->productId);

		//this outside of class
		//$tweet->getProductId();
	}

	/**
	 * mutator method for product id
	 *
	 * @param Uuid|string $newProductId new value of tweet id
	 * @throws \RangeException if $newProductId is not positive
	 * @throws \TypeError if $newProductId is not a uuid or string
	 **/
	public function setProductId( $newProductId) : void {
		try {
			$newProductId = self::validateUuid($newProductId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {

		}

		// convert and store the product id
		$this->productId = $newProductId;
	}

	/**
	 * accessor method for product category id
	 *
	 * @return Uuid value of  product category id
	 **/
	public function getProductCategoryId() : Uuid{
		return($this->productCategoryId);
	}


	/**
	 * mutator method for tweet profile id
	 *
	 * @param string | Uuid $newProductCategoryId new value of tweet profile id
	 * @throws \RangeException if $newProfileId is not positive
	 * @throws \TypeError if $newProductCategoryId is not an integer
	 **/
	public function setProductCategoryId( $newProductCategoryId) : void {
		try {
			$newProductCategoryId = self::validateUuid($newProductCategoryId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

		// convert and store the profile id
		$this->productCategoryId = $newProductCategoryId;
	}

	/**
	 * accessor method for product content
	 *
	 * @return string value of product content
	 **/
	public function getProductType() : string {
		return($this->productType);
	}

	/**
	 * mutator method for tweet content
	 *
	 * @param string $newProductType new value of product content
	 * @throws \InvalidArgumentException if $newProductContent is not a string or insecure
	 * @throws \RangeException if $newProductType is > 140 characters
	 * @throws \TypeError if $newProductContent is not a string
	 **/
	public function setProductType(string $newProductType) : void {
		// verify the product content is secure
		$newProductType = trim($newProductType);
		$newProductType = filter_var($newProductType, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newProductType) === true) {
			throw(new \InvalidArgumentException("product type is empty or insecure"));
		}

		// verify the product content will fit in the database
		if(strlen($newProductType) >= 140) {
			throw(new \RangeException("product type content too large"));
		}

		// store the product content
		$this->productType = $newProductType;
	}

	/**
	 * accessor method for product date
	 *
	 * @return \DateTime value of product date
	 **/
	public function getProductDate() : \DateTime {
		return($this->productDate);
	}

	/**
	 * mutator method for tweet date
	 *
	 * @param \DateTime|string|null $newProductDate Product date as a DateTime object or string (or null to load the current time)
	 * @throws \InvalidArgumentException if $newProductDate is not a valid object or string
	 * @throws \RangeException if $newProductDate is a date that does not exist
	 **/
	public function setProductDate($newProductDate = null) : void {
		// base case: if the date is null, use the current date and time
		if($newProductDate === null) {
			$this->productDate = new \DateTime();
			return;
		}

		// store the like date using the ValidateDate trait
		try {
			$newProductDate = self:: ValidateDate($newProductDate);
		} catch(\InvalidArgumentException | \RangeException $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		$this->productDate = $newProductDate;
	}
		/**
		 * inserts this Product into mySQL
		 *
		 * @param \PDO $pdo PDO connection object
		 * @throws \PDOException when mySQL related errors occur
		 * @throws \TypeError if $pdo is not a PDO connection object
		 **/
		public function insert(PDO $pdo): void {
			// create query template
			$query = "INSERT INTO (productId, productCategoryId, productType, productDate)";
				$statement = $pdo->prepare($query);

			// bind the member variables to the place holders in the template
			$formattedDate = $this->productDate->format("Y-m-d H:i:s.u");
			$parameters = ["productId" => $this->productId->getBytes(), "productCategoryId" => $this->productCategoryId->getBytes(), "productType" => $this->productType, "ProductDate" => $formattedDate];
			$statement->execute($parameters);
		}


		/**
		 * updates this Product in mySQL
		 *
		 * @param \PDO $pdo PDO connection object
		 * @throws \PDOException when mySQL related errors occur
		 * @throws \TypeError if $pdo is not a PDO connection object
		 **/
		public function update(\PDO $pdo) : void {

			// create query template
			$query = "UPDATE product SET productCategoryId = :productCategoryId, productType = :productDate WHERE productId = :productId ";
			$statement = $pdo->prepare($query);


			$formattedDate = $this->productDate-> format("Y-m-d-H-i-s.u");
			$parameters = ["productId" => $this->productId->getBytes(), "productCategoryId" => $this->productCategoryId->getBytes(), "productType"
			=> $this->productType, "productDate" => $formattedDate];
			$statement->execute($parameters);
		}

			/**
			 * gets the Product by ProductId
			 *
			 * @param \PDO $pdo PDO connection object
			 * @param Uuid|string $productId product id to search for
			 * @return Product|null Product found or null if not found
			 * @throws \PDOException when mySQL related errors occur
			 * @throws \TypeError when a variable are not the correct data type
			 **/

/**
 * inserts this Tweet into mySQL

​
​

	public function delete(\PDO $pdo) : void {
							​
		// create query template
		$query = "DELETE FROM product WHERE productId = :productId";
		$statement = $pdo->prepare($query);
​
		// bind the member variables to the place holder in the template
		$parameters = ["productId" => $this->productId->getBytes()];
		$statement->execute($parameters);
	}
​
	/**
	 * updates this Tweet in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/

	/**
	 * gets the Tweet by tweetId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $productId product id to search for
	 * @return Product|null Product found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when a variable are not the correct data type
	 **/
	public static function getProductByProductId(\PDO $pdo, $productId) : ?Product {
		// sanitize the productId before searching
		try {
			$productId = self::validateUuid($productId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		// create query template
		$query = "SELECT productId, productCategoryId, productType, ProductDate FROM product WHERE productId = :productId";
		$statement = $pdo->prepare($query);

		// bind the product id to the place holder in the template
		$parameters = ["productId" => $productId->getBytes()];
		$statement->execute($parameters);


		/**
		 * gets the Product by profile id
		 *
		 * @param \PDO $pdo PDO connection object
		 * @param Uuid|string $productCategoryId profile id to search by
		 * @return \SplFixedArray SplFixedArray of Products found
		 * @throws \PDOException when mySQL related errors occur
		 * @throws \TypeError when variables are not the correct data type
		 **/

		public static function getProductByProductCategoryId(\PDO $pdo, $productCategoryId) :\SplFixedArray{

			try {
				$productCategoryId = self::validateUuid($productCategoryId);


			} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
				throw (new \PDOException(($exception->getMessage()), 0, $exception));
			}
			// create query template
			$query = "SELECT productId, productCategoryId, ProductType, productDate FROM product WHERE productCategoryId = :productCategoryId";
			$statment = $pdo->prepare($query);
			// bind the product category id to the place holder in the template
			$parameters = ["productCategoryId" => $productCategoryId->getBytes()];
			$statment->execute($parameters);
			// build an array of products
			$products = new  \SplFixedArray(($statment->rowCount()));
			$statment->setFetchMode(\PDO:: FETCH_ASSOC);
			while(($row = $statment->fetch()) !== false) {
				try {
					$product = new  Product($row ["productId"], $row["productCategoryId"], $row["productType"], $row["productDate"]);
					$product[$product->key()] = $product;
					$product->next();
				} catch(\Exception $exception) {
					// if the row couldn't be converted, rethrow it
					throw (new \PDOException($exception->getMessage(), 0, $exception));
				}
				return ($products);
			}
		}





















