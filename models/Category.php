<?php
class Category{
    private $conn;
    private $table = 'categories';

    public $id;
    public $name;
    public $title;
    public $body;
    public $author;
    public $created_at;
    public $post_id;
    public $category_name;

    public function __construct($db){
        $this->conn = $db;
    }

    //Get post

    public function read(){        
      $query = 'SELECT c.id, c.name as category_name, 
                  c.created_at,  
                  p.title, 
                  p.body, 
                  p.author
                  FROM 
                  '. $this->table .' c 
                  LEFT JOIN 
                  posts p ON p.category_id = c.id 
                  ORDER BY 
                  c.created_at DESC';
              
                  $stmt = $this->conn->prepare($query);
                  $stmt->execute();
                  return $stmt;
}

//get single post

    public function read_single(){
      
        $query = 'SELECT c.name as category_name, 
                  c.created_at,  
                  p.id,
                  p.title, 
                  p.body, 
                  p.author
                  FROM 
                  '. $this->table .' c 
                  LEFT JOIN 
                  posts p ON p.category_id = c.id 
                  WHERE c.id = ?
                  LIMIT 0,1';   

        $stmt = $this->conn->prepare($query);
        //bind param
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        //set properties
        
        $this->title = $row['title'];
        $this->body = $row['body'];
        $this->author = $row['author'];
        $this->post_id = $row['id'];
        $this->category_name = $row['name'];
        

}
  //create a category
  public function create(){

    $query = 'INSERT INTO '.$this->table.' SET name = :name';
    $stmt = $this->conn->prepare($query);

    //clean data
    $this->name = htmlspecialchars(strip_tags($this->name));
    
    //bind param
    $stmt->bindParam(':name', $this->name);
    
    
    //excute

    if($stmt->execute()){
      return true;
    }
    printf("ERROR: %s.\n", $stmt->error);
    return false;

  } 

  //Update a category
  public function update(){

    $query = 'UPDATE '.$this->table.' SET name = :name WHERE id = :id';
    $stmt = $this->conn->prepare($query);

    //clean data
    $this->name = htmlspecialchars(strip_tags($this->name));
    $this->id = htmlspecialchars(strip_tags($this->id));
    
    //bind param
    $stmt->bindParam(':name', $this->name);
    $stmt->bindParam(':id', $this->id);

    //excute

    if($stmt->execute()){
      return true;
    }
    printf("ERROR: %s.\n", $stmt->error);
    return false;

  } 

  //Delete a category
  public function Delete(){

    $query = 'DELETE FROM '.$this->table.' WHERE id = :id';
    $stmt = $this->conn->prepare($query);

    //clean data
    
    $this->id = htmlspecialchars(strip_tags($this->id));
    
    //bind param
    
    $stmt->bindParam(':id', $this->id);

    //excute

    if($stmt->execute()){
      return true;
    }
    printf("ERROR: %s.\n", $stmt->error);
    return false;

  } 
}