  <?php 
     
      
include_once 'login/db_connect.php';
include_once 'login/functions.php';
include_once 'dbFunc.php'; 
 
sec_session_start();
if (login_check($mysqli) == true){
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
          echo "Registo \"".$data["nome"]."\" criado com sucesso";
         //print "<script type = \"text/javascript\"> createMission('".$data["nome"]."')</script>";
        // print "<li><a href=\"#\" class=\"MenuButton\" onclick=\"novaMissao()\"><span>Nova Missão</span></a></li>";
         //addMissionForm();
         //header('Location: ./login.php');

     }
     else {print "<script type = \"text/javascript\"> errorMessage('".$resposta."')</script>";}
  }
     else {
         $update="false";
          print "teste";
         // addMissionForm();
     }

}
else {
    echo "Você não tem autorização para aceder a esta página!";
}
        
?>
    
