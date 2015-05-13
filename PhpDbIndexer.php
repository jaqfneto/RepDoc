<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


include 'dbFunc.php';


 $filepath = 'C:\\xampp\\htdocs\\RepDoc\\repos\\2014\\IAHS2014\\relatorios\\INF28-Rel_congressos_IAHS_LM_V3.pdf';
  $filename = 'INF28-Rel_congressos_IAHS_LM_V3.pdf';
 /* header('Content-type: application/pdf');
  header('Content-Disposition: inline; filename="' . $filename . '"');
  header('Content-Transfer-Encoding: binary');
  header('Accept-Ranges: bytes');
  @readfile($file);*/
  
 // $filename=$_REQUEST['PDF_FileName'];
//$filepath=$_REQUEST['PDF_FilePath'];

$filesize=filesize($filepath);

header("Pragma: public");
header("Expires: 0"); // set expiration time
header("Cache-Control: must-revalidate, post-check=0,
pre-check=0");

header("Content-Type: application/pdf");
header("Content-Length: ".$filesize);
header("Content-Disposition: inline; filename=$filename");
header("Content-Transfer-Encoding: binary");

//Can't use readfile() due to poor controlling of the file
//download.
//(IE have this problems)...
//readfile($filepath);

//use fopen() instead of readfile...
$fp = fopen($filepath, 'rb');
$pdf_buffer = fread($fp, $filesize);
fclose ($fp);

//sleep(1);

print $pdf_buffer;
