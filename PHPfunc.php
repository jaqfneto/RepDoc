        <?php
        
        
   function getHostNameAndIP(){
   // Get IP
            if(!empty($_SERVER['HTTP_CLIENT_IP'])){
               $ip=$_SERVER['HTTP_CLIENT_IP'];
              }
            elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
            }
            else{
             $ip=$_SERVER['REMOTE_ADDR'];
            }
            $hostname = gethostbyaddr($ip);
            $host= array("name" =>$hostname,
                         "ip" =>$ip);
            
            return $host;
      
  }
  
  
              
    // Coloca num Array todos os ficheiros de $dir   
    function dirToArray($dir) {
    $result = array();
    $cdir = scandir($dir);
    foreach ($cdir as $key => $value)
    {
      if (!in_array($value,array(".","..")))
      {
         if (is_dir($dir . DIRECTORY_SEPARATOR . $value))
         {
              //echo "$dir . DIRECTORY_SEPARATOR . $value";
            $result[$value] = dirToArray($dir . DIRECTORY_SEPARATOR . $value);
         }
         else
         {
            $result[] = $dir . DIRECTORY_SEPARATOR . $value;
         }
      }
   }
  
   return $result;
 }
    

// Lista todos os ficheiros  do folder $dir
// com link para download
function displayFiles ($dir,$tabs){
$files_1=  dirToArray($dir);
foreach ($files_1 as $key => $x) {
    
    if (is_array($x)) {
        $dira=$dir."/".$key;
        $tabsa=$tabs."-";
        displayFiles ($dira,$tabsa);
        
    } else {
        createLinkToFile($x);
    } 
}
}

// Lista todos os ficheiros  do folder $dir de determinado $tipo (relatório ou apresentação)
// com link para obter nome do ficheiro
function displayFilesToChose ($dir,$tabs, $tipo){
$files_1=  dirToArray($dir);

foreach ($files_1 as $key => $x) {
    
    if (is_array($x)) {
        //echo "$x[0]  dir";
        //echo "$tabs $key"."<br>";
        
        $dira=$dir."\\".$key;
        $tabsa=$tabs."-";
        displayFilesToChose ($dira,$tabsa,$tipo);
        
    } else {
        createLinkToFileToChose($x,$tipo);

    }
   
    
}
 //echo "<br>"; 
}

// Lista ficheiro com link para obter o nome e
// atribuí-lo a um ID de uma FORM (setValueByID(id,value))
function createLinkToFileToChose($file,$tipo){
   $repStr=str_replace("\\","/",$file);
   $repStrSpaces=str_replace(" ","%20",$repStr);
   $path_parts = pathinfo($repStr);
/*
echo $path_parts['dirname'], "<br>";
echo $path_parts['basename'], "<br>";
echo $path_parts['extension'], "<br>";
echo $path_parts['filename'], "<br>"; // since PHP 5.2.0
 */
   $filename=$path_parts['basename'];
   $butt="<span>$filename</span>";
   switch ($tipo) {
    case "docs":
        if (($path_parts['extension']==="htm")||($path_parts['extension']==="html") ){
           $src_img_file="images/html.png";
           $id="link";
           echo "<span class=\"tab\"><img src=\"".$src_img_file."\"><a href=\"#\"  onclick=\"setValueByID('$id','$repStrSpaces');\" > ".$butt."</a></span><br \>";
        }
        break;
    case "rel1": case "rel2": case "rel3":
        if ($path_parts['extension']==="pdf"){
           $src_img_file="images/".$path_parts['extension'].".png";
           $id=$tipo;
           echo "<span class=\"tab\"><img src=\"".$src_img_file."\"><a href=\"#\"  onclick=\"setValueByID('$id','$repStrSpaces');\" > ".$butt."</a></span><br \>";
         }
        break;
   }
}


//Cria array com um determinado tipo de ficheiros de $dir
function createArrayWithFiles ($dir,$tabs, $tipo,&$idx, &$files){
$files_1=  dirToArray($dir);
//print_r ($files_1);
foreach ($files_1 as $key => $x) {
    
    if (is_array($x)) {
        //echo "$x[0]  dir";
        //echo "$tabs $key"."<br>";
        
        $dira=$dir."\\".$key;
        $tabsa=$tabs."-";
        createArrayWithFiles ($dira,$tabsa,$tipo,$idx,$files);
        
    } else {
        //echo $idx;
        $val=GetFile($x,$tipo);
        if ($val != false) {
        $files[$idx]=$val;
        $idx++;
        }
    }
   
    
}
 //echo "<br>"; 
}



function getFile($file,$tipo){
  
   $repStr=str_replace("\\","/",$file);
   $repStrSpaces=str_replace(" ","%20",$repStr);
   $path_parts = pathinfo($repStr);
/*
echo $path_parts['dirname'], "<br>";
echo $path_parts['basename'], "<br>";
echo $path_parts['extension'], "<br>";
echo $path_parts['filename'], "<br>"; // since PHP 5.2.0
 * 
 */
   $filename=$path_parts['basename'];
   $butt="<span>$filename</span>";
   switch ($tipo) {
    case "docs":
        if (($path_parts['extension'] === "htm") || ($path_parts['extension'] === "html")) {
                //print $path_parts['extension'];
                $src_img_file = "images/html.png";
                //echo "<span class=\"tab\"><img src=\"images/pdf.png\"><a href=\"$repStrSpaces\"  class=\"Button\">".$butt."</a></span><br \>"; 
                //echo "<span class=\"tab\"><img src=\"".$src_img_file."\"><a href=\"$repStrSpaces\"  ".$butt."</a></span><br \>";
                $id = "link";
                //  echo "<span class=\"tab\"><img src=\"".$src_img_file."\"><a href=\"#\"  onclick=\"setValueByID('$id','$repStrSpaces');\" > ".$butt."</a></span><br \>";
                //echo $repStrSpaces;
                return $repStrSpaces;
            } else {
                return false;
            }
            break;
    case "rel1":
    case "rel2":
    case "rel3":
        if ($path_parts['extension']==="pdf"){
           print $path_parts['extension'];
           $src_img_file="images/".$path_parts['extension'].".png";
       //echo "<span class=\"tab\"><img src=\"images/pdf.png\"><a href=\"$repStrSpaces\"  class=\"Button\">".$butt."</a></span><br \>"; 
       //echo "<span class=\"tab\"><img src=\"".$src_img_file."\"><a href=\"$repStrSpaces\"  ".$butt."</a></span><br \>";
           $id=$tipo;
          // echo "<span class=\"tab\"><img src=\"".$src_img_file."\"><a href=\"#\"  onclick=\"setValueByID('$id','$repStrSpaces');\" > ".$butt."</a></span><br \>";
         return  $repStrSpaces;
           
        }
        break;
   }
  
}


// Lista  folders incluidos em $DIR
// entre dois níveis $lev_i e $lev_f
function displayFolders ($dir,$tabs,$lev_i, $lev_f, $prev_key,$tipo){
$files_1=  dirToArray($dir);
//echo "tipo #".$tipo. "DIR".$dir;
foreach ($files_1 as $key => $x) {
    
    if (is_array($x)) {
        //echo "$x[0]  dir";
        //echo "$tabs $key"."<br>";
        $fullDirPath=$prev_key."\\/".$key;
        
        if ($tabs !== 0) {
            if (($tabs >= $lev_i) && ($tabs <= $lev_f)){
               // echo"<span class=\"tab\">";
                    if ($tipo=="f") {$fullDirPath=$dir."/".$key;
                    //echo "subs  ".substr($fullDirPath,6);
                    $fullDirPath=substr($dir."/".$key,6);
                    }
            createLinkToFolder($key,$fullDirPath,$tipo);}
            //echo "</span>";
            } else {
                echo "<b>$key" . "<br></b>";
            }
           // $dira=$dir."\\".$key;
            $dira=$dir."/".$key;
        $tabsa=$tabs+1;
        
        displayFolders ($dira,$tabsa,$lev_i,$lev_f, $key,$tipo);
        
    } else {
        //createLinkToFile($x);
//echo "full $x";
       
    }
   
    
}
// echo "levels: $tabs"; 
}



// cria tag "<a Href" com link para o ficheiro $file
function createLinkToFile($file){
   $repStr=str_replace("\\","/",$file);
   $repStrSpaces=str_replace(" ","%20",$repStr);
   $path_parts = pathinfo($repStr);
/*
echo $path_parts['dirname'], "<br>";
echo $path_parts['basename'], "<br>";
echo $path_parts['extension'], "<br>";
echo $path_parts['filename'], "<br>"; // since PHP 5.2.0
 * 
 */
   $filename=$path_parts['basename'];
   $butt="<span>$filename</span>";
   $src_img_file="images/".$path_parts['extension'].".png"; 
   $path="PdfViewer.php?url=".$repStrSpaces;
   //echo "<span class=\"tab\"><img src=\"images/pdf.png\"><a href=\"$repStrSpaces\"  class=\"Button\">".$butt."</a></span><br \>"; 
   echo "<span class=\"tab\"><img src=\"".$src_img_file."\"><a href=\"$path\" target=\"_blank\" ".$butt."</a></span><br \>"; 
  
  // print("<td>" . $repStrSpaces. " <a  href=\"$path\" target=\"_blank\" class=\"Button\" ><span> ver relatório  </span></a>"."</td>");

}


// cria button com link para listar ficheiros de $folder (se $tipo="f"
// caso contrário lista folders de $folder
function createLinkToFolder($folder,$fullPath,$tipo){
   //$repStr=str_replace("\\","/",$folder);
   //$repStrSpaces=str_replace(" ","%20",$repStr);
   //echo "<li><a href="."files.php".">.$file.</a></li>"; 
  // echo "<a href="."'#'"."onclick='jsFunction();alert('it works!');'>".$file."</a>"; 
   
  $butt="<span>".$folder."</span>";
  //echo "tipo  #".$tipo;
  //echo "path  #".$folder." ---".$fullPath;
 // if ($tipo == "f") echo "<span class=\"tab\"><li style='text-align:left'.><a href='#' class=\"Button\" onclick=\"alterContent_files('$fullPath');\">".$butt."</a></li></span>";
  //else {echo "<span class=\"tab\"><li style='text-align:left'.><a href='#' class=\"Button\" onclick=\"alterContent('$fullPath');\">".$butt."</a></li></span>";
  
  if ($tipo == "f") {
       // echo "<span class=\"tab\"><li style='text-align:left'.><a href='#' class=\"Button\" onclick=\"alterContent_files('$fullPath');\">".$butt."</a></li></span>";
        echo "<span class=\"tab\">"."<input type=\"button\" value=\">\" id=\"".$butt."\" onclick=\"alterContent_files('$fullPath');\" ><label  for=\"".$butt."\">".$butt." </label></span><br/>";   
  } else {
      echo "<span class=\"tab\"> <input type=\"button\" value=\">\" id=\"".$butt."\" onclick=\"alterContent('$fullPath');\" ><label class=\"folder\"  for=\"".$butt."\">".$butt." </label></span><br/>";
      //. "<li style='text-align:left'.><a href='#' class=\"Button\" onclick=\"alterContent('$fullPath');\">".$butt."</a></li></span>";
  }
}


function build_tree_ori($path_list) {
    $path_tree = array();
    foreach ($path_list as $path => $title) {
        $list = explode('/', trim($path, '/'));
       
        $last_dir = &$path_tree;
    
        foreach ($list as $dir) {
            
            $last_dir =& $last_dir[$dir];
        }
        $last_dir['__title'] = $title;
        //print_r ($last_dir);
    }
    return $path_tree;
}

function build_tree($path_list) {
    // Aceita um Array de path files e transforma-o numa TREE para
    // separar por folders
    $path_tree = array();
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
      //echo 'This is a server using Windows!';
    $separador='\\';
        } else {
      //echo 'This is a server not using Windows!';
    $separador='/';
      }
    foreach ($path_list as $path => $title) {
        $list = explode($separador, trim($title, $separador));
        //print_r ($list);
        $last_dir = &$path_tree;
    
        foreach ($list as $dir) {
           // print ($dir);
            $last_dir =& $last_dir[$dir];
        }
        $last_dir['__title'] = $title;
        //print_r ($last_dir);
    }
    return $path_tree;
}

function build_list($tree, $prefix = '') {
    // Com base num TREE gerada por build_tree, cria HTML na forma:
    /*
     * repos
     *  repos/2014
     *   repos/2014/IAHS2014
     *    repos\2014\IAHS2014\docs
     *      repos\2014\IAHS2014\docs\pdfs
     *       ID99.pdf
     *       ID96.pdf
     * repos
     *  repos/2015
     *   repos/2015/XPTO
     *    repos\2014\XPTO\docs
     *      repos\2014\XPTO\docs
     *       FILE1.pdf
     *       FILE2.DOC
     * 
     */
    
    $ul = '';
    $item=1;
    foreach ($tree as $key => $value) {
        $li = '';
        if (is_array($value)) {
            if (array_key_exists('__title', $value)) {
                 $path_parts = pathinfo($value['__title']);
                 $filename=$path_parts['basename'];
                 $butt="<span>$filename</span>";
                 $src_img_file="images/".$path_parts['extension'].".png"; 
                 $li .= "<img src=\" $src_img_file\"> <a href=\"/${value['__title']}/\">$filename</a>";
            } else {
                $li .= "<input type=\"checkbox\" checked=\"checked\" id=\"item-1\" ><label for=\"item-$item\" >$prefix$key</label>";
                $item++;
            }
            $li .= build_list($value, "$prefix$key/");
            $ul .= strlen($li) ? "<li>$li</li>" : '';
        }
    }
    return strlen($ul) ? "<ul>$ul</ul>" : '';
}

function displayTree ($path_list){
    print "<div class=\"css-treeview\">";
     print build_list(build_tree($path_list),' ');
     print "</div>";
}


function createSelectFromArr($optionsArr,$name){
    echo "<select name=\"$name\">";
    foreach ($optionsArr as $value) {
     echo "<option value=\"".$value."\">".$value."</option>";    
  //<option value="volvo">Volvo</option>
    }
    echo "</select>";
}
/*teste


$path_list =Array ("repos\\2014\\IAHS2014\\docs\\pdfs\\ID9.pdf",
    "repos\\2014\\IAHS2014\\docs\\pdfs\\ID90.pdf","repos\\2014\\IAHS2014\\relatorios\\INF28-Rel_congressos_IAHS_LM_V3.pdf",
    "repos\\2014\\IAHS2014\\relatorios\\INF29_rel_congressos_20141218_IAHS_NL_V2.pdf");


 print build_list(build_tree($path_list),' ');

*/

/*
function addNewMission(){
    echo "entrei";
include_once 'login/db_connect.php';
include_once 'login/functions.php';
 
sec_session_start();

     include 'dbFunc.php';     
     if (isset($_POST["update"]) && ($_POST["update"]=="true")) {
     $update=filter_input(INPUT_POST,'update',FILTER_SANITIZE_STRING);
     $data["nome"]=filter_input(INPUT_POST,'nome',FILTER_SANITIZE_STRING);
     $data["descricao"]=filter_input(INPUT_POST,'descricao',FILTER_SANITIZE_STRING);
     $data["assunto"]=filter_input(INPUT_POST,'assunto',FILTER_SANITIZE_STRING);
     $data["palavras"]=filter_input(INPUT_POST,'palavras',FILTER_SANITIZE_STRING);
     $data["dep"]=filter_input(INPUT_POST,'departamento',FILTER_SANITIZE_STRING);
     $data["ano"]=filter_input(INPUT_POST,'ano',FILTER_SANITIZE_STRING);
     if (isset($_POST["link_to_apresentacao"])) $data["link_to_apresentacao"]=filter_input(INPUT_POST,'link_to_apresentacao',FILTER_SANITIZE_STRING);
     else $data["link_to_apresentacao"]="";
     $data["p1"]=filter_input(INPUT_POST,'p1',FILTER_SANITIZE_STRING);
     $data["r1"]=filter_input(INPUT_POST,'r1',FILTER_SANITIZE_STRING);
     if (isset($_POST["p2"])) $data["p2"]=filter_input(INPUT_POST,'p2',FILTER_SANITIZE_STRING);
     else $data["p2"]="";
     if (isset($_POST["r2"])) $data["r2"]=filter_input(INPUT_POST,'r2',FILTER_SANITIZE_STRING);
     else $data["r2"]="";
     if (isset($_POST["p3"])) $data["p3"]=filter_input(INPUT_POST,'p3',FILTER_SANITIZE_STRING);
     else $data["p3"]="";
     if (isset($_POST["r3"])) $data["r3"]=filter_input(INPUT_POST,'r3',FILTER_SANITIZE_STRING);
     else $data["r3"]="";
     if (isset($_POST["docfile"])) $data["docfile"]=filter_input(INPUT_POST,'docfile',FILTER_SANITIZE_STRING);
     else $data["docfile"]="";
     $resposta=createMission($data);
     //print "resposta: ". $resposta;
     if ($resposta=="ok") {
         index_text(getAllText_from_Mission($data["nome"]));
         print "<script type = \"text/javascript\"> createMission('".$data["nome"]."')</script>";
         print "<li><a href=\"#\" class=\"MenuButton\" onclick=\"novaMissao()\"><span>Nova Missão</span></a></li>";
         //addMissionForm();
         //header('Location: ./login.php');
           
     }
     else print "<script type = \"text/javascript\"> errorMessage('".$resposta."')</script>";
     }
     else {
         $update="false";
          print "teste";
          addMissionForm();
         
     }

}                     
*/    
function addMissionForm(){
     
//if (login_check($mysqli) == true) :   onsubmit=\"return ValidateRequiredFields();\"
    

  print "<form name = \"addMission\" id=\"addMission\" action = \"\"  method=\"\">";
  print "<table border=\"0\">";
Print "<thead>";
Print "<tr>";
    Print "<th></th>";
    Print "<th></th>";
Print "</tr>";
Print "</thead>";
Print "<tbody>
<tr>
    <td ><label>Sigla da conferência/simposium:</label></td>
    <td> <input type=\"text\" id=\"nome\" name=\"nome\" value=\"\" size=\"15\"  required/></td>
</tr>
<tr>
    <td><label>Nome/Descrição:</label></td>";
Print"    <td><textarea name=\"descricao\" id=\"descricao\" rows=\"2\" cols=\"53\" value=\"\" style=\"overflow-y: scroll\"   required> </textarea></td>
    <td id=\"descricao_obg\"></td>
</tr>
<tr>
    <td>Assunto</td>
    <td> <textarea name=\"assunto\" rows=\"2\" cols=\"53\" id=\"assunto\" style=\"overflow-y: scroll\" required> </textarea></td>
    <td id=\"assunto_obg\"></td>
</tr>
<tr>
    <td>Palavras chave</td>

    <td> <textarea name=\"palavras\" id=\"palavras\" rows=\"2\" cols=\"53\" value=\"\" style=\"overflow-y: scroll\" required> </textarea></td>
    <td id=\"palavras_obg\"></td>
</tr>

<tr>
    <td>Ano:</td>
    <td><input type=\"number\"  id=\"ano\" name=\"ano\" min=\"2000\" max=\"2020\" value=\"\" size=\"4\" required/></td>
</tr>


<tr>
    <td>Ficheiro de apresentação(i.e index.htm(l)</td>
    <td>  

        <input type=\"button\" name=\"link\" value=\"browse\" onclick=\"browse(ano.value+'/'+nome.value+'/docs','docs','apre')\" required/>
        <input type=\"text\" id=\"link\" name=\"link_to_apresentacao\" placeholder=\"Escolha ficheiro ...\" size=\"60\"/>




</td>
</tr>

<tr>
    <td></td>
    <td id=\"apre\"></td>
</tr>


<tr>
    <td><b>Participantes na missão</b></td>
    <td> </td>
</tr>

<tr >
    <td><b>Nome Participante 1</b></td>
    <td> <input type=\"text\"  id=\"p1\" name=\"p1\" value=\"\" size=\"20\" placeholder=\"Introduza nome ...\" required/></td>
</tr>
<tr>
    <td>Relatório de Missão</td>
    <td>  <input type=\"button\" name=\"link\" value=\"browse\" onclick=\"browse(ano.value+'/'+nome.value+'/relatorios','rel1','rm1')\" required/>
          <input type=\"text\" id=\"rel1\" name=\"r1\" placeholder=\"Escolha ficheiro ...\" size=\"60\"/></td>
</tr>

<tr>
    <td></td>
    <td id=\"rm1\"></td>
</tr>
<tr>
    <td><b>Nome Participante 2</b></td>
    <td> <input type=\"text\" id=\"p2\" name=\"p2\" value=\"\" size=\"20\" placeholder=\"Introduza nome ...\"/></td>
</tr>
<tr>
    <td>Relatório de Missão</td>
    <td>  <input type=\"button\" name=\"link\" value=\"browse\" onclick=\"browse(ano.value+'/'+nome.value+'/relatorios','rel2','rm2')\" required/>
          <input type=\"text\" id=\"rel2\" name=\"r2\" placeholder=\"Escolha ficheiro ...\" size=\"60\"/></td>
</tr>

<tr>
    <td></td>
    <td id=\"rm2\"></td>
</tr>
<tr>
    <td><b>Nome Participante 3</b></td>
    <td> <input type=\"text\" id=\"p3\" name=\"p3\" value=\"\" size=\"20\" placeholder=\"Introduza nome ...\" /></td>
</tr>
<tr>
    <td>Relatório de Missão</td>
    <td>  <input type=\"button\" name=\"link\" value=\"browse\" onclick=\"browse(ano.value+'/'+nome.value+'/relatorios','rel3','rm3')\" required/>
          <input type=\"text\" id=\"rel3\" name=\"r3\" placeholder=\"Escolha ficheiro ...\" size=\"60\"</td>
</tr>

<tr>
    <td></td>
    <td id=\"rm3\"></td>
</tr>
<tr>
    <td>Ficheiro c/ documentação</td>
    <td>  <input type=\"file\" id=\"docfile\" name=\"docfile\" value=\"\" /></td>
</tr>
<tr>
<td></td>
    <td id=\"alert\"></td>
    
</tr>
</tbody>
</table>
<input type=\"hidden\" id=\"update\" name=\"update\" value=\"true\"/>
<input type=\"button\" value=\"submeter\" name=\"submit\" onclick=\"javascript:process_addMission()\"/>
<input type=\"reset\" value=\"limpar\" name=\"reset\" />
</form>";

//else : 
//Print "<p>    <span class=\"error\">Você não tem autorização para acessar esta página.Faça login.</span>  </p>";
//endif;

} 






        ?>

