<?php
/*
 * Rating OOP
 *
 */
// namespace App\Model;

 class Rating
 {
 	    /**
     * @var int|null 
     */
    private $id;

    /**
     * @var int 
     */
    private $product_id;

    /**
     * @var int
     */
    private $user_id;

    /**
     * @var int
     */
    private $rate;    
	
    function __construct(?int $id, int $product_id, int $user_id, int $rate)
    {
        $this->id = $id;
        $this->product_id = $product_id;
        $this->user_id = $user_id; 
        $this->rate = $rate; 
    }

    public static function getById($id): ?array
    {
        $queryRate = 'SELECT * FROM rating  where id = ?';
        $result = Database::findOne($queryRate, array($id));
        if($result){
        return $result;
    }
        return null;
	}

    public function add(): bool
    {
        $queryRate = 'INSERT INTO rating(product_id, user_id, rate) VALUES (?, ? , ?)';
        $params = array($this->product_id, $this->user_id, $this->rate);
        return Database::findOne($queryRate,$params) ? true: false;
    }

    public static function getByProductId($product_id): ?array
    {
        $queryRate = 'SELECT * FROM rating  where product_id = ?';
        $result= Database::findOne($queryRate, array($product_id));
        return $result;
    }

    public static function getByProductIdAndUserId($product_id, $user_id): ?Rating
    {
        $queryRate = 'SELECT * FROM rating  where product_id = ? and  user_id = ?';
        $result = Database::findOne($queryRate, array($product_id, $user_id));
        if($result)
        {
            return new Rating($result['id'], $result['product_id'], $result['user_id'], $result['rate']);
        }   return NULL;
    }
    

    public static function getAverageRating($product_id): ?float
    {
        $queryRate = "SELECT AVG(rate) as Avgrate FROM rating WHERE product_id= ?";
        $result= Database::findOne($queryRate, array($product_id));
        return $result["Avgrate"];
    }

    public static function getRatingAndAverageRatingByProductId($product_id): array{
        $queryRate = "SELECT COUNT(rate) as rating_num, AVG(rate) as Avgrate FROM rating WHERE product_id= ?";
        $result= Database::findOne($queryRate, array($product_id));
        return $result;
    }

    function getId(): ?int
    {
        return $this->id;
    }

    function getProduct_id(): int
    {
        return $this->product_id;
    }
    

    function getUser_id(): int
    {
        return $this->user_id;
    }

    function getRate(): int
    {
        return $this->rate;
    }

    function setId(int $id): void
    {
        $this->id = $id;
    }

    function setProduct_id(int $product_id): void
    {
        $this->product_id = $product_id;
    }
    
    function setUser_id(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    function setRate(int $rate): void
    {
        $this->rate = $rate;
    }

}
