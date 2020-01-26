<?php
/*
 * Product Class OOP
 *
 */
// namespace App\Model;

 class Product
 {
 	    /**
     * @var int|null 
     */
    private $id;

    /**
     * @var string 
     */
    private $name;

    /**
     * @var float
     */
    private $price;
      /**
     * @var string
     */
    private $imageUrl;


    
	
    function __construct(?int $id=null, ?string $imageUrl=null, ?string $name=null, ?float $price=null)
    {
        $this->id = $id;
        $this->image= $imageUrl; 
        $this->name = $name;
        $this->price = $price;
        
    }

    public function getProducts(): ?array
    {
        $queryProd = 'SELECT * FROM products ORDER by id ASC';   
        $result = Database::findAll($queryProd);
        if ($result)
        {
            return $result;
        }return NULL;
    }

    public function getProductById($id): ?array
    {
        $queryProd = 'SELECT * FROM products  where id = ?';
        $result = Database::findOne($queryProd, array($id));
        if ($result)
        {
            return $result;
        }return NULL;
    }
    
    public function getProductIdById($id): int
    {
        $queryProd = "SELECT id from products where id = ?";
        $result = Database::findSingle($queryProd, array($id));
        return $result;
    }
    
    /*
    * Getter functions
    */
    function getId(): ?int
    {
        return $this->id;
    }

    function getName(): string
    {
        return $this->name;
    }
    

    function getPrice(): float
    {
        return $this->price;
    }
    
    function getImage(): string
    {
        return $this->image;
    }
    
    /*
    * Setter functions
    */
    function setId(int $id): void
    {
        $this->id = $id;
    }

    function setName(string $name): void
    {
        $this->name = $name;
    }
    
    function setPrice(float $price): void
    {
        $this->price = $price;
    }

}
 ?>