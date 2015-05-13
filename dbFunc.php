<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

// conecta-se a BD MySql
 function dbConnect(){
        $db = mysqli_connect("localhost", "teste", "1234","docrep_db");
        if (!$db) {
            print "Error - Could not connect to MySQL";
        exit;
        }
        mysqli_query($db,"SET NAMES 'utf8'");
        mysqli_query($db,'SET character_set_connection=utf8');
        mysqli_query($db,'SET character_set_client=utf8');
        mysqli_query($db,'SET character_set_results=utf8');
        return $db;     
 }
 
 function dbDisconnect($db){
    mysqli_close($db);
 }
 
 // Obtem dados referentes à $missao
 function getMission($missao) {
  $db=dbConnect();
  $query="select count(*) from missao";
  $result = mysqli_query($db,$query);
    if (!$result) {
        print "Error - the query could not be executed";
        $error = mysqli_error($db);
        print "<p>" . $error . "</p>";
        return;
    } 
    $row = mysqli_fetch_assoc($result);
    $values = array_values($row);
    //numero de linhas
    $numRows =$values[0];
    // atualiza página html
    print"<h2> Missão </h2>";
    if ($numRows > 0) {
        $query = "select * from  missao where nome= '" . $missao . "';";
        $result = mysqli_query($db, $query);
        if (!$result) {
            print "Error - the query could not be executed";
            $error = mysqli_error($db);
            print "<p>" . $error . "</p>";
            return;
        }
        $row = mysqli_fetch_assoc($result);
        $values = array_values($row);
        outputInfo($values);
    } else {
        Print $missao;
    }
    dbDisconnect($db);
}

 function outputInfo($values){
     print("<table style=\"width:100%\"  border=1>");
        print "<tbody>";
        print "<tr>";
        print "<td style=\"width:85%\">";
        print "<table style=\"width:100%\">";
        print "<tbody>";
        print "<tr>";
        print("<td style=\"width:20%\"><b>Nome </b></td>");
        print("<td>" . $values[1] . "</td>");
        print "</tr>";
        print "<tr>";
        print("<td><b>Descrição </b></td>");
        print("<td>" . $values[2] . "</td>");
        print "</tr>";

        print "<tr>";
        print("<td><b>Assunto </b></td>");
        print("<td>" . $values[3] . "</td>");
        print "</tr>";

        print "<tr>";
        print("<td><b>Departamento </b></td>");
        print("<td>" . $values[4] . "</td>");
        print "</tr>";

        print "<tr>";
        print("<td><b>Ano </b></td>");
        print("<td>" . $values[5] . "</td>");
        print "</tr>";

        for ($k=0;$k<$values[7];$k++){
        print "<tr>";
        print("<td><b>Participante </b></td>");
        $path="PdfViewer.php?url=".$values[7+2*$k+2];
        
        print("<td>" . $values[7+2*$k+1]. " <a  href=\"$path\" target=\"_blank\" class=\"Button\" ><span> ver relatório  </span></a>"."</td>");
        }
        
        if(strlen($values[6])!=0){
            print "<tr>";
            print("<td><b>Apresentação </b></td>");
            print("<td>" . " <a  href=\"$values[6]\"  class=\"Button\" target=\"_blank\"><span> ver apresentação  </span></a>"  . "</td>");
            print "</tr>"; 
        }
        
         print "<tr>";
            print("<td><b>Palavras chave </b></td>");
            print("<td>" . $values[15] . "</td>");
            print "</tr>"; 
        Print "</tbody>";
        print "</table>";
         print "</td>";
        print("<td > <img src=\"repos/". $values[5]."/".  $values[1] . "/logo.png\"</td>");
         Print "</tbody>";
        print "</table>";     
 }

 // Lista todas as missões
function getAllMissions() {
  $db=dbConnect();
  $query="select count(*) from missao";
  //print $query;
  $result = mysqli_query($db,$query);
    if (!$result) {
        print "Error - the query could not be executed";
        $error = mysqli_error($db);
        print "<p>" . $error . "</p>";
        return;
    } 
    //print_r ($result); 
    $row = mysqli_fetch_assoc($result);
    //print ("row ".$row);
    $values = array_values($row);
    //numero de linhas
    $numRows =$values[0];  
    print"<h2> Missões </h2>";
    if ($numRows > 0) {
        $query = "select * from  missao ";
        $result = mysqli_query($db, $query);
        
        if (!$result) {
            print "Error - the query could not be executed";
            $error = mysqli_error($db);
            print "<p>" . $error . "</p>";
            return;
        }
        $num_miss= mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        for ($row_num = 0; $row_num < $num_miss; $row_num++) {
          $values = array_values($row);
        
            print("<table style=\"width:100%\"  border=1>");
            print "<tbody>";
            print "<tr>";
            print "<td style=\"width:85%\">";
            print("<table style=\"width:100%\">");
            print "<tbody>";
            print "<tr>";
            print("<td style=\"width:20%\"><b>Nome </b></td>");
            print("<td>" . $values[1] . "</td>");
            print "</tr>";

            print "<tr>";
            print("<td><b>Descrição </b></td>");
            print("<td>" . $values[2] . "</td>");
            print "</tr>";
            
            print "<tr>";
            print("<td><b>Detalhe </b>");
            print("</td>");
            print "<td>";
             $fullPath=$values[5]."/".$values[1];
            $butt="<span>".$values[1]."</span>";
            echo "<input type=\"button\" value=\">\" id=\"".$butt."\" onclick=\"alterContent('$fullPath');\" ><label class=\"folder\"  for=\"".$butt."\">".$butt." </label>";

            print"</td>";
            print "</tr>";
            Print "</tbody>";
            print "</table>";
            print "</td>";
            print("<td > <img src=\"repos/". $values[5]."/".  $values[1] . "/logo.png\"</td>");
            Print "</tbody>";
            print "</table>";
            $row = mysqli_fetch_assoc($result);     
    }
    } else {
        Print "Sem dados!";
    }
    
    dbDisconnect($db);
}

// obtém todo o texto contido nos campos: nome, descrição, assunto, keywords 
// para construção de nuvem de palavras
function getAllText() {
  $db=dbConnect();
  $query="select count(*) from missao";
  //print $query;
  $result = mysqli_query($db,$query);
    if (!$result) {
        print "Error - the query could not be executed";
        $error = mysqli_error($db);
        print "<p>" . $error . "</p>";
        return;
    } 
    //print_r ($result); 
    $row = mysqli_fetch_assoc($result);
    //print ("row ".$row);
    $values = array_values($row);
    //numero de linhas
    $numRows =$values[0];  
    //print"<h3> Palavras chave</h3>";
    if ($numRows > 0) {
        $query = "select * from  missao ";
        $result = mysqli_query($db, $query);
        
        if (!$result) {
            print "Error - the query could not be executed";
            $error = mysqli_error($db);
            print "<p>" . $error . "</p>";
            return;
        }
        $num_miss= mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        $text="";
        for ($row_num = 0; $row_num < $num_miss; $row_num++) {
          $values = array_values($row);
        
            
            $text=$text." ".$values[1]." ". $values[2] ." ". $values[3] . " ". $values[4] ." " . 
                        $values[5] . " ". $values[15];
            $row = mysqli_fetch_assoc($result);
            
    }
    } else {
        Print "Sem dados!";
    }
    dbDisconnect($db);
    
    return str_replace(","," ",$text);
}

// atualiza palavras procuradas
function updateSWords($word) {
  $db=dbConnect();
  //$query="select count(*) from palavras_procuradas";
  $query = "select * from  palavras_procuradas where palavra= '" . $word . "';";
  //print $query;
  $result = mysqli_query($db,$query);
    if (!$result) {
        print "Error - the query could not be executed";
        $error = mysqli_error($db);
        print "<p>" . $error . "</p>";
        return;
    } 
    //print_r ($result); 
    $numRows =mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
    //print ("row ".$row);
    $values = array_values($row);
    //numero de linhas
    
    //print $numRows;
    //print"<h3> Palavras chave</h3>";
    if ($numRows > 0) {
         // Increment Hit
        $query = "update palavras_procuradas SET hits=hits+1 where palavra= '" . $word . "';";
        $result = mysqli_query($db,$query);
        if (!$result) {
            print "Error - the query could not be executed";
            $error = mysqli_error($db);
            print "<p>" . $error . "</p>";
            return;
        } 
        
    } else {
        // insere word
         $query="INSERT INTO palavras_procuradas (palavra,hits) VALUES ('".$word."',1);";
         $result = mysqli_query($db,$query);
         if (!$result) {
            print "Error - the query could not be executed";
            $error = mysqli_error($db);
            print "<p>" . $error . "</p>";
            return;
         } 
  
      
    }
    dbDisconnect($db);
  
}

//obtem palavras pesquisadas para construção da nuvem de palavras.
function getAllSWords() {
  $db=dbConnect();
  $query="select count(*) from palavras_procuradas";
  //print $query;
  $result = mysqli_query($db,$query);
    if (!$result) {
        print "Error - the query could not be executed";
        $error = mysqli_error($db);
        print "<p>" . $error . "</p>";
        return;
    } 
    //print_r ($result); 
    $row = mysqli_fetch_assoc($result);
    //print ("row ".$row);
    $values = array_values($row);
    //numero de linhas
    $numRows =$values[0];  
   
    if ($numRows > 0) {
        $query = "select * from  palavras_procuradas ";
        $result = mysqli_query($db, $query);
        
        if (!$result) {
            print "Error - the query could not be executed";
            $error = mysqli_error($db);
            print "<p>" . $error . "</p>";
            return;
        }
        $num_w= mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        $text="";
        for ($row_num = 0; $row_num < $num_w; $row_num++) {
          $values = array_values($row);
           
            for ($n_hits=0; $n_hits<$values[2];$n_hits++){
               $text=$text.$values[1]." ";
               
            }
            $row = mysqli_fetch_assoc($result);
            
         }
    } else {
        Print "Sem dados!";
    }
    dbDisconnect($db);
    
    return $text;
}


//Cria registo de Missão na base de dados
function createMission($data) {
  $db=dbConnect();
  // echo $data["nome"];
  $num_participantes=1;
  $feedback=""; 
  $r1=$data["r1"];
  $r2="";
  $r3="";
  if ($data["p2"] <>"") {
      $num_participantes=$num_participantes+1;
      $r2=$data["r2"];
  }
  if ($data["p3"] <>"") {
      $num_participantes=$num_participantes+1;
      $data["r3"];
  }
  $query="INSERT INTO missao (nome,descricao,assunto,dep,ano,link_to_apresentacao,num_participantes,
           p1,r1,p2,r2,p3,r3,logo,keywords) VALUES ('".$data["nome"]."','".$data["descricao"]."','".$data["assunto"]."','".$data["dep"]."','".$data["ano"]."',"
          . "'".$data["link_to_apresentacao"]."',".$num_participantes.",'".$data["p1"]."','".$r1."','".$data["p2"]."','".$r2."',"
          . "'".$data["p3"]."','".$r3."','".$data["logo"]."','".$data["palavras"]."');";
       //print $query;
        $result = mysqli_query($db,$query);
        if (!$result) {
            $feedback="Error - the query could not be executed";
            //print "Error - the query could not be executed";
            $error = mysqli_error($dbfoto);
            $feedback=$feedback+"  "+$error;
            //print "<p>" . $error . "</p>";
            exit;
        }else { 
            //print "INSERT command executed with sucess!<br />";
          //printf("Affected rows (INSERT): %d\n", mysqli_affected_rows($db));
          //$feedback=$feedback+"  "+"INSERT command executed with sucess!<br />"+"Affected rows (INSERT): %d\n"+ mysqli_affected_rows($db);
            $feedback="ok";
        }  
 
  dbDisconnect($db);
  return $feedback;
}


function filter_words($text)
    {
       
       //print $text; 
       // utf8_decode($text);
      // print $text;
       // $text = strtolower($text,'UTF-8');
       
        //$text = strip_tags($text);
        
        //  print $text;
        /* 
         * Handle common words first because they have punctuation and we need to remove them
         * before removing punctuation.
         */
        $commonWords = "'tis,'twas,a,able,about,across,after,ain't,all,almost,also,am,among,an,and,any,are,aren't," .
            "as,at,be,because,been,but,by,can,can't,cannot,could,could've,couldn't,dear,did,didn't,do,does,doesn't," .
            "don't,either,else,ever,every,for,from,get,got,had,has,hasn't,have,he,he'd,he'll,he's,her,hers,him,his," .
            "how,how'd,how'll,how's,however,i,i'd,i'll,i'm,i've,if,in,into,is,isn't,it,it's,its,just,least,let,like," .
            "likely,may,me,might,might've,mightn't,most,must,must've,mustn't,my,neither,no,nor,not,o'clock,of,off," .
            "often,on,only,or,other,our,own,rather,said,say,says,shan't,she,she'd,she'll,she's,should,should've," .
            "shouldn't,since,so,some,than,that,that'll,that's,the,their,them,then,there,there's,these,they,they'd," .
            "they'll,they're,they've,this,tis,to,too,twas,us,wants,was,wasn't,we,we'd,we'll,we're,were,weren't,what," .
            "what'd,what's,when,when,when'd,when'll,when's,where,where'd,where'll,where's,which,while,who,who'd," .
            "who'll,who's,whom,why,why'd,why'll,why's,will,with,won't,would,would've,wouldn't,yet,you,you'd,you'll," .
            "you're,you've,your,".
            "dos,das,eles,elas,ele,ela,nós,vós,alguns,algumas,uns,umas,isso,eraum,capaz,cerca de,através de,depois,nãoé,tudo,quase,também,sou,entre,deum,e,alguns,são,nãosão,".
"como,em,ser,porque,sido,mas,por,pode,não pode,poderia,poderia ter,não poderia,querida,fez,".
"não,ou,do contrário,nunca,cada,para,de,obter,tem,teve,tem,não tem,tem,ele,vai,é,ela,dela,sua".
"como, foi,que,eu,sou,tenho,se,em,apenas,menos,vamos,".
"provável,pode,mim,pode,pode,ter,talvez,maioria,deve,deveter,nãodeve,minha,nem,não,horas,de,fora,".
"Muitas,vezes,em,apenas,ou,outro,nossa,própria,disso,disse,por,exemplo,diz,deve,ela,deve,deveria,".
"já,que,porisso,alguns,doque,que,quevai,issoé,,asua,eles,então,há,há,estes,eles,eles,".
"eles vão,eles são,têm,este,tem,para,também,tu,nós,quer,foi,nãofoi,nós,que tínhamos,nós vamos,nós somos,era,".
"Oque,o que é,quando,quando,quando seria,quando quiserdes,onde,de onde,para onde vai,onde está,oque,quando,quem,quem seria,".
"quem vai,quem é,quem,porquê,porque,porque de,vai,com,não,seria,teria,não quis,no,entanto,você,".
"você é,você tem,oseu,depois,antes,do,da ,de,dos,das,um,uma,uns,umas, teve, fazer";
        
       // $commonWords = strtolower($commonWords);
        //print $commonWords;
        $commonWords = explode(",", $commonWords);
      //  print "ANTES ...........". $text;
        foreach($commonWords as $commonWord)
        {
            $text = str_replace_word($commonWord, "", $text);  
        }
       
        /* remove punctuation and newlines */
        /*
         * Changed to handle international characters
         */
        /*
        if ($this->m_bUTF8)
            $text = preg_replace('/[^\p{L}0-9\s]|\n|\r/u',' ',$text);
        else
            $text = preg_replace('/[^a-zA-Z0-9\s]|\n|\r/',' ',$text);
        */
        /* remove extra spaces created */
      //  print "ANTES 2 ...........". $text;
       // $text = preg_replace('/[^\p{L}0-9\s]|\n|\r/u',' ',$text);
        //$text = preg_replace('/ +/',' ',$text);
      
        $text = trim($text); 
      // print "DEPOIS ...........". $text;
        $words = explode(" ", $text);
        foreach ($words as $value) 
        {
            $temp = trim($value);
            if (is_numeric($temp))
                continue;
            if (strlen(trim($temp))>2)
              $keywords[] = trim($temp);
        }
    
        return $keywords;
    }
    
function str_replace_word($needle, $replacement, $haystack)
    {
        $pattern = "/\b$needle\b/i";
        $haystack = preg_replace($pattern, $replacement, $haystack);
        return $haystack;
    }
    
function index_text($text_and_missao_id) {
    
  $words = filter_words(str_replace(","," ",$text_and_missao_id["text"]));
  $mission_id=$text_and_missao_id["id"];
  $db=dbConnect(); 
  //$query="select count(*) from palavras_procuradas";
  foreach ($words  as $word)  {
  $query = "select * from  index_table where palavra= '" . $word . "';";
  //print $query;
  //print $word ."\n";
  $result = mysqli_query($db,$query);
    if (!$result) {
        print "Error - the query could not be executed";
        $error = mysqli_error($db);
        print "<p>" . $error . "</p>";
        return;
    } 
    //print_r ($result); 
    $numRows =mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
    //print ("row ".$row);
    $values = array_values($row);
    //numero de linhas
    
    //print $numRows;
    //print"<h3> Palavras chave</h3>";
    if ($numRows > 0) {

        if (strpos($values[2],$mission_id) === false) { // para não repetir.
        $new_ids=$values[2].",".$mission_id;   
        $query = "update index_table SET ids_missoes='".$new_ids."' where palavra= '" . $word . "';";
        //print $query;
        $result = mysqli_query($db,$query);
        if (!$result) {
            print "Error - the query could not be executed";
            $error = mysqli_error($db);
            print "<p>" . $error . "</p>";
            return;
        } 
         }
    } else {
        // insere word
         $query="INSERT INTO index_table (palavra,ids_missoes) VALUES ('".$word."','".$mission_id."');";
         $result = mysqli_query($db,$query);
         if (!$result) {
            print "Error - the query could not be executed";
            $error = mysqli_error($db);
            print "<p>" . $error . "</p>";
            return;
         } 
  
      
    }
  }
    dbDisconnect($db);
  
}    


function getAllText_from_Mission($missao) {
  $db=dbConnect();
  $query = "select * from  missao where nome= '" . $missao . "';"; 
  $result = mysqli_query($db, $query);
        
        if (!$result) {
            print "Error - the query could not be executed";
            $error = mysqli_error($db);
            print "<p>" . $error . "</p>";
            return;
        }
        $num_miss= mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        $text="";
        $values = array_values($row);
        $text=$text." ".$values[1]." ". $values[2] ." ". $values[3] . " ". $values[4] ." " . 
                        $values[5] . " ". $values[15];
         //   $row = mysqli_fetch_assoc($result);
        //print $text;
         $text_and_idMission= array("text" => $text, "id" => $values[0]);
         //print_r($text_and_idMission);
        // print $text_and_idMission["texto"];
        // print $text_and_idMission["id"];   
    
    dbDisconnect($db);
      return $text_and_idMission;
  // return str_replace(","," ",$text);
}

function index_all(){

    $db=dbConnect();


    $query = "select * from  missao ";
    $result = mysqli_query($db, $query);

    if (!$result) {
        print "Error - the query could not be executed";
        $error = mysqli_error($db);
        print "<p>" . $error . "</p>";
        return;
    }
    $num_miss= mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
    for ($row_num = 0; $row_num < $num_miss; $row_num++) {
      $values = array_values($row);
      print "indexing \"".$values[1]."\"<br />";
      index_text(getAllText_from_Mission($values[1]));
      $row = mysqli_fetch_assoc($result);
    }

    dbDisconnect($db);
    print "Done";
}

function searchInMissoes($word){
  updateSWords($word);
  $db=dbConnect();  
  //SELECT * FROM `index_table` WHERE palavra LIKE "%teste%" 
  //$query = "select * from  index_table where palavra= '" . $word . "';";
  $query = "SELECT * FROM `index_table` WHERE palavra LIKE '%" . $word . "%';"; 
  //print $query;
  //print $word ."\n";
  $result = mysqli_query($db,$query);
    if (!$result) {
        print "Error - the query could not be executed";
        $error = mysqli_error($db);
        print "<p>" . $error . "</p>";
        return;
    } 
    //print_r ($result); 
    $numRows =mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
    //print ("row ".$row);
    $values = array_values($row);
    //numero de linhas
    
    //print $numRows;
    //print"<h3> Palavras chave</h3>";
    if ($numRows > 0) {
        $missoes =$values[2];
        for ($row_num = 0; $row_num < $numRows; $row_num++) {
              $values = array_values($row);
              $missoes =$missoes.",".$values[2];
              //print "indexing \"".$values[1]."\"<br />";
              $row = mysqli_fetch_assoc($result);
         }
         $miss_filter=explode(",",$missoes);
         $miss_filter=array_unique( $miss_filter );
         $missoes=  implode(",",$miss_filter);
        //$missoes contem ids das missoes que têm a palavra $word
        
    } else {
      print "Não foram encontradas missões com a palavra \"$word!\"";  
      $missoes="";
    }
    dbDisconnect($db);
    //print $missoes;
    return $missoes;
}  

function getAllMissionsById($mission_ids) {
    if ($mission_ids=="") {
      return; 
    }
    $missoes=  explode(",", $mission_ids);
    //print_r($missoes);
    $db=dbConnect();
    foreach ($missoes as $id){
    $query = "select * from  missao where id=$id";
    // print $query;
    $result = mysqli_query($db, $query);

    if (!$result) {
        print "Error - the query could not be executed";
        $error = mysqli_error($db);
        print "<p>" . $error . "</p>";
        return;
    }
    $num_miss= mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
    for ($row_num = 0; $row_num < $num_miss; $row_num++) {
      $values = array_values($row);

        print("<table style=\"width:100%\"  border=1>");
        print "<tbody>";
        print "<tr>";
        print "<td style=\"width:85%\">";
        print("<table style=\"width:100%\">");
        print "<tbody>";
        print "<tr>";
        print("<td style=\"width:20%\"><b>Nome </b></td>");
        print("<td>" . $values[1] . "</td>");
        print "</tr>";

        print "<tr>";
        print("<td><b>Descrição </b></td>");
        print("<td>" . $values[2] . "</td>");
        print "</tr>";

        print "<tr>";
        print("<td><b>Detalhe </b>");
        print("</td>");
        print "<td>";
         $fullPath=$values[5]."/".$values[1];
        $butt="<span>".$values[1]."</span>";
        echo "<input type=\"button\" value=\">\" id=\"".$butt."\" onclick=\"alterContent('$fullPath');\" ><label class=\"folder\"  for=\"".$butt."\">".$butt." </label>";

        print"</td>";
        print "</tr>";
        Print "</tbody>";
        print "</table>";
        print "</td>";
        print("<td > <img src=\"repos/". $values[5]."/".  $values[1] . "/logo.png\"</td>");
        Print "</tbody>";
        print "</table>";
        $row = mysqli_fetch_assoc($result);     
    }
    }
    dbDisconnect($db);
}


function searchInDocs($word){
  updateSWords($word);
  $db=dbConnect();  
  //SELECT * FROM `index_table` WHERE palavra LIKE "%teste%" 
  //$query = "select * from  index_table where palavra= '" . $word . "';";
  $query = "SELECT * FROM `files_index_table` WHERE palavra LIKE '%" . $word . "%';"; 
  //print $query;
  //print $word ."\n";
  $result = mysqli_query($db,$query);
    if (!$result) {
        print "Error - the query could not be executed";
        $error = mysqli_error($db);
        print "<p>" . $error . "</p>";
        return;
    } 
    //print_r ($result); 
    $numRows =mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
    //print ("row ".$row);
    $values = array_values($row);
    //numero de linhas
    
    //print $numRows;
    //print"<h3> Palavras chave</h3>";
    if ($numRows > 0) {
        $files =$values[2];
        for ($row_num = 0; $row_num < $numRows; $row_num++) {
              $values = array_values($row);
              $files =$files.",".$values[2];
              //print "indexing \"".$values[1]."\"<br />";
              $row = mysqli_fetch_assoc($result);
         }
         $miss_filter=explode(",",$files);
         $miss_filter=array_unique( $miss_filter );
         $files=  implode(",",$miss_filter);
        //$missoes contem ids das missoes que têm a palavra $word
        
    } else {
      //print "Não foram encontrados documentos com a palavra \"$word!\"";  
      $files="";
    }
    dbDisconnect($db);
    //print $missoes;
    return $files;
}  

function getAllFilesById($files_ids) {
    if ($files_ids=="") {
      return; 
    }
    //print $files_ids;
    $files=  explode(",", $files_ids);
    //print_r($missoes);
    $db=dbConnect();
    $path_list=array();
    $num_file=0;
    foreach ($files as $id){
    $query = "select * from  indexed_files_table where id_file=$id";
    // print $query;
    $result = mysqli_query($db, $query);

    if (!$result) {
        print "Error - the query could not be executed";
        $error = mysqli_error($db);
        print "<p>" . $error . "</p>";
        return;
    }
    $num_miss= mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
    
    for ($row_num = 0; $row_num < $num_miss; $row_num++) {
      $values = array_values($row);

        
      
        //print( $values[2]);
        //createLinkToFile($values[2]);
       $path_list[$num_file]=$values[2];
       
       $row = mysqli_fetch_assoc($result);     
    }
    $num_file+=1;
    }
    dbDisconnect($db);
    
    
    displayTree ($path_list);
}


function registUser(){
        $host=getHostNameAndIP();
        $host_name= $host["name"];
        $host_ip = $host["ip"];
        $db=dbConnect();  
        //$xx= "<script> alert(\"".$hostIP."\");</script>";  
        $query="select * from users where hostName='".$host_name."'";
        //print $query;
        $result = mysqli_query($db,$query);
        if (!$result) {
            print "Error - the query could not be executed (1)";
            $error = mysqli_error($db);
            print "<p>" . $error . "</p>";
            exit;
        }
        //$row = mysqli_fetch_assoc($result);
        $xx = mysqli_num_rows($result);
        $time = time(); $currDate = date('Y-m-d H:i:s',$time);
        if ($xx==0){// se não existe este host_name  registado
            
          $query="INSERT INTO users (hostName,hostIP,lastAccessDateTime,NumAccess,sessions) VALUES ('".$host_name."','".$host_IP."','".$currDate."',1,1);"; 
          $result = mysqli_query($db,$query);
          if (!$result) {
            print "Error - the query could not be executed";
            $error = mysqli_error($db);
            print "<p>" . $error . "</p>";
            exit;
           }
           
           // $data = "04/30/1973";
            //"2009-01-01 12:00:00 0 0"
            //list ($mes, $dia, $ano) = split ('[/.-]', $data);
//echo "Mês: $mes; Dia: $dia; Ano: $ano<br />\n";
        }
        else { // se existe este user (ip) registado)
           
            
            $row = mysqli_fetch_assoc($result);
            $value = array_values($row);
            $userID=$value[0];
            $hName=$value[1];
            $hIP=$value[2];
            $lastAccess=$value[3];
            $numAccess=$value[4];
            $numSessions=$value[5];
            $time = time(); 
            
            $currDate = date('Y-m-d H:i:s',$time);
            //$date="30-07-2010 13:24:10"; //Date example
            list($year, $month, $day, $hour, $minute,$sec) = split('[- :]',  $lastAccess); 

            //The variables should be arranged according to your date format and so the separators
            $timestamp = mktime($hour, $minute, $sec, $month, $day, $year);
            if ($time >  $timestamp+10*60) $numSessions+=1;
            $numAccess+=1;
            /*
            echo $time;
            echo $timestamp;
            echo "<br> diff:";
            echo $time-$timestamp;
            echo "<br>";
            echo date("r", $time);
            echo date("r", $timestamp);
             * 
             */
            $urlID=$value[3];
            $query="UPDATE users SET lastAccessDateTime="."'".$currDate."'".", numAccess=".$numAccess.", sessions=".$numSessions." WHERE hostName='".$host_name."'"; 
          //print $query;
          $result = mysqli_query($db,$query);
          if (!$result) {
            print "Error - the query could not be executed";
            $error = mysqli_error($db);
            print "<p>" . $error . "</p>";
            exit;
           }
        }
         dbDisconnect($db);
       // return $currDate." ".$userID." ".$url;
        
       
 }          