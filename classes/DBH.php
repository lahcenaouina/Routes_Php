<?php 


namespace classes ; 
use PDO ; 

class DBH  {
     private PDO $pdo ;
      public function __construct(array $config)  {
        $defaultOptions = [
                PDO::ATTR_EMULATE_PREPARES => false  , 
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];
        try {
                $this->pdo = new PDO(
                        $config['driver'].':host='.$config['host'] .';dbname='.$config['database'],
                        $config['username'],
                        $config['password'],
                        $config['options'] ?? $defaultOptions 
                );
     
            } catch (\PDOException $e) {
                print "Error : " . $e->getMessage();
                die();
                
            }   
      }
      public function __call(string $name, array $arguments ){
               return $this->pdo->$name(...$arguments);
      } 
      

}