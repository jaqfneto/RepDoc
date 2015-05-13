<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


include_once 'login/db_connect.php';
include_once 'login/functions.php';
 
sec_session_start();
 
if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Secure Login: Log In</title>
        <link rel="stylesheet" href="styles/main.css" />
        <script type="text/JavaScript" src="login/sha512.js"></script> 
        <script type="text/JavaScript" src="login/forms.js"></script> 
    </head>
    <body>
        <?php
        if (isset($_GET['error'])) {
            echo '<p class="error">Erro ao fazer o login!</p>';
        }
        
        ?> 
        <form action="" method="" name="login_form">                      
            Email: <input type="text" name="email" id="uemail"/>
            Password: <input type="password" 
                             name="password" 
                             id="password"/>
            <input type="button" 
                   value="Login" 
                   onclick="formhash(this.form, this.form.password,this.form.uemail);" /> 
        </form>
        <p>If you don't have a login, please <a href="register.php">register</a></p>
        <p>If you are done, please <a href="login/logout.php">log out</a>.</p>
        <p>You are currently logged <?php echo $logged ?>.</p>
    </body>
</html>