<?php

session_start();
    $_SESSION = array();
session_destroy();

//$echo "test";
echo '<h2 class="btn btn-lg btn-warning btn-block">Вы вышли</h2>';
$this->renderPage('login',$templ_array);

?>