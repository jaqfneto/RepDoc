
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include 'PHPfunc.php';
include 'dbFunc.php';
$dir=$_GET['dir'];
$tipo=$_GET['tipo'];
//echo $dir."</br>";
$fulldir="repos/".$dir;
$tabs="";

//echo"<span class=\"tab\">";

   
if ($tipo == "f"){
 //echo "<h3>".$fulldir."</h3><br />";
 displayFiles($fulldir, $tabs);
}
else{
$missao=subStr($dir,5);
getMission($missao);
$butt="<span> Listar todos os documentos de ". $missao ."</span>";
echo "<br /><a href='#' class=\"Button\" onclick=\"alterContent_files('$dir');\">".$butt."</a>";
//echo $dir."#".$fulldir;
echo "<h3> Listar documentos das pastas: </h3><br />";
displayFolders($fulldir, 1,1,1,"","f");


}
//echo "</span>"


 ?>                   

