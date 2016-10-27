<?php

class UserModel
{
  private $db;
  function __construct()
  {
    $this->db = new PDO('mysql:host=localhost;dbname=tareas1;charset=utf8', 'root', '');
  }

  function getUser($user){
    $select = $this->db->prepare("select * from usuario where email = ?");
    $select->execute(array($user));
    return  $select->fetch(PDO::FETCH_ASSOC);
  }


}


?>
