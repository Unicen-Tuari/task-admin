<?php
require_once('libs/Smarty.class.php');

class LoginView {
  private $smarty;

  public function __construct(){
    $this->smarty = new Smarty;
  }

  public function show($errors){
    $this->smarty->assign('errors',$errors);
    $this->smarty->display('login.tpl');
  }

}


?>
