<?php
require_once('view/loginView.php');
require('model/userModel.php');

class LoginController
{
  private $modelUser;
  private $viewLogin;

  public function __construct()
  {
    $this->modelUser = new UserModel();
    $this->viewLogin = new LoginView();
  }

  public function login()
  {
    if(!isset($_REQUEST['txtUser']))
    {
      $this->viewLogin->show(array());
    }
    else
    {
      $user = $_REQUEST['txtUser'];
      $pass = $_REQUEST['txtPass'];
      $userData = $this->modelUser->getUser($user);
      if(password_verify($pass, $userData['password']))
      {
        
        echo "Se logueo correctamente";
      }
      else {
        $this->viewLogin->show(array("El nombre de usuario o contraseña no es válido"));
      }

    }
  }


}


?>
