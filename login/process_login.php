
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once 'db_connect.php';
include_once 'functions.php';
 
sec_session_start(); // Nossa segurança personalizada para iniciar uma sessão php.

if (isset($_POST['email'], $_POST['p'])) {
    $email = $_POST['email'];
    $password = $_POST['p']; // The hashed password.
 
    if (login($email, $password, $mysqli) == true) {
        // Login com sucesso
        print "Login com sucesso: $email";
        //header('Location: ../protected_page.php');
        
    } else {
        // Falha de login
        print "Unable to login!";
        //header('Location: ../index.php?error=1');
    }
} else {
    print $_POST['email'];
print $_POST['p'];
    // As variáveis POST corretas não foram enviadas para esta página. 
   print 'Invalid Request'; //Requisição Inválida)
}
