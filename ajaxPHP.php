<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include 'dbFunc.php';
include 'PHPfunc.php';
include 'booleanExpr.php';
$func=filter_input(INPUT_GET,'func',FILTER_SANITIZE_STRING);
if (filter_input(INPUT_GET, 'func', FILTER_SANITIZE_STRING)){
    $func=$_GET['func'];  
   
switch ($func) {
    case "getAllMissions":
        //print "getAllMissions";
        getAllMissions();
        break;
    case "updateSWords":
        $word=  filter_input(INPUT_GET,'word',  FILTER_SANITIZE_STRING);
        //updateSWords($word);
        break;
    case "missionDetail":
        break;
    case "createMission":
        $missao=  filter_input(INPUT_GET,'missao',  FILTER_SANITIZE_STRING);
        echo "Registo \"$missao\" criado com sucesso";
        break;
    case "browse":
        $folder=  filter_input(INPUT_GET,'folder',  FILTER_SANITIZE_STRING);
        $tipo=filter_input(INPUT_GET,'tipo',  FILTER_SANITIZE_STRING);
        //print $tipo;
        $fulldir="repos/".$folder;
        displayFilesToChose($fulldir, "",$tipo);
        //echo "Registo \"$missao\" criado com sucesso";
        break;
    case "search_in_docs":
        $word=  filter_input(INPUT_GET,'word',  FILTER_SANITIZE_STRING);
       
        //print $word;
        getAllFilesById(implode(",",solveBooleanExpression(getArrayOfTermsWithFilesId($word,"docs"))));
       // getAllFilesById(searchInDocs($word));
        //getAllMissionsById(searchInMissoes($word));
        //echo "Registo \"$missao\" criado com sucesso";
        break;
    case "search_in_missions":
        $word=  filter_input(INPUT_GET,'word',  FILTER_SANITIZE_STRING);
       
        //print $word;
       
       // getAllMissionsById(searchInMissoes($word));
        getAllMissionsById(implode(",",solveBooleanExpression(getArrayOfTermsWithFilesId($word,"missoes"))));
        //echo "Registo \"$missao\" criado com sucesso";
        break;
    case "IndexDbMissions":
        index_all();
        //echo "Registo \"$missao\" criado com sucesso";
        break;
     case "novaMissao":
        //header('Location: ./novaMissao.php');
         //print "resposta AJAX";
         addMissionForm();
        //addNewMission();
        break;

    
    case "login":
        header('Location: ./login.php');
       // header('Location: ./docrep_config.php');
        //header('Location: '.$_SERVER['PHP_SELF']);
        break;
    
    case "logout":
         print "logged out!";
       // echo "logged out 1";
         header('Location: ./login/logout.php');
        //header('Location: ./docrep_config.php');
        echo "logged out 2";
        //Header('Location: '.$_SERVER['PHP_SELF']);
        break;
   
}
}