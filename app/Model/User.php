<?php 
// namespace App\Model;

class User 
{
  /**
     * @var int|null 
     */
    private $id;

    /**
     * @var string 
     */
    private $username;

    /**
     * @var string
     */
    private $password;
    
    /**
     * @var float 
     */
    public $balance;

    function __construct(int $id=null, string $username=null, string $password=null, float $balance=null) 
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->balance = $balance; 
    }
    //logging in the user
    public function loginUser($username, $password):void 
    {
        $user = self::getUserByUsernameANDPassword($username, $password);
        if(!$user){
            throw new Exception('Invalid username or password');
        } 
        $_SESSION['user'] = $user;
        $_SESSION['cart'] = "";
    }

    // Logs the user off
    public function logoffUser():void
    {
        unset($_SESSION['user']);
    }

    // Returns the user who is currently logged in's id or null if no user is currently logged in
    public function getUser():?array
    {
        if (isset($_SESSION['user']))
            return $_SESSION['user'];
        return null;
    }

    public function getUserById($id): ?User{
        $queryUser = ('SELECT  *  FROM user where id = ?');
        $result = Database::findOne($queryUser, array($id));
        if ($result){
        return new User($result['id'], $result['username'], $result['password'], $result['balance']);
        }
        return NULL;
    }

    public static function getUserByUsernameANDPassword($username, $password): ?array{

        $queryUser = ('SELECT id, username, password, balance FROM user where username = ? and password = ?');
        $result = Database::findOne($queryUser, array($username, $password));
        if ($result){
        return $result;
        }
        return NULL;
    }



    public function updateUserBalance($balance, $id): bool{

        $queryUser =  ('UPDATE user SET balance = ? WHERE id =?');
        $result = Database::findOne($queryUser, array($balance, $id));
        return $result;
    }

    function getId(): ?int {
        return $this->id;
    }

    function getUsername(): string {
        return $this->username;
    }
    
    function getPassword(): string {
        return $this->password;
    }

    function getBalance(): float {
        return $this->balance;
    }

    function setId(int $id): void {
        $this->id = $id;
    }

    function setUsername(string $username): void {
        $this->username = $username;
    }

    function setPassword(string $password): void {
        $this->password = $password;
    }
    
    function setBalance(float $balance): void {
        $this->balance = $balance;
    }

}