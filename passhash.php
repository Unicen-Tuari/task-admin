<?php
  //Con este archivo veo que hash debería tener una password para insertar los usuarios a mano.
  //TODO: Esto debería hacerse en el ABM de usuarios de forma transparente
  $hash = password_hash("123456", PASSWORD_DEFAULT);
  echo $hash;
?>
