<?php
require_once('view/loginView.php');
require_once('model/userModel.php');
require_once('config/appConfig.php');

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
        session_start();
        $_SESSION['user'] = $user;
        header("Location: /web/tupar/".AppConfig::$ACTION_SHOW_TASKS);
      }
      else {
        $this->viewLogin->show(array("El nombre de usuario o contraseña no es válido"));
      }
    }
  }


    public function logout()
    {
      session_start();
      session_destroy();
      header("Location: /web/tupar");
      die();
    }
  public function check()
  {
    session_start();
    if(!isset($_SESSION['user']))
    {
      header("Location: /web/tupar");
      die();
    }
  }

}


?>
