<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Seguem os detalhes para login para o banco de dados
 */  
define("HOST", "localhost");     // Para o host com o qual você quer se conectar.
define("USER", "teste");    // O nome de usuário para o banco de dados. 
define("PASSWORD", "1234");    // A senha do banco de dados. 
define("DATABASE", "docrep_db");    // O nome do banco de dados. 
 
define("CAN_REGISTER", "any");
define("DEFAULT_ROLE", "member");
 
define("SECURE", FALSE);    // ESTRITAMENTE PARA DESENVOLVIMENTO!!!!

$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);