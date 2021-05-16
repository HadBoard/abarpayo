<?
session_start();
$category;
$result = $this->connection->query("SELECT * FROM `table` ");
while($row = $result->fetch()){
    if($category === $row->category_id){
        $result = $this->connection->query("SELECT * FROM `table` WHERE id = $row->post_id ");
    }

}