<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns = "http://www.w3.org/1999/xhtml" >
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>DocRep-LNEC</title>
    <link rel="stylesheet" href="style.css" />

    <script type = "text/javascript"  src = "js-code.js" >  </script>
</head>
<body>
     <?php 
     include_once 'login/db_connect.php';
include_once 'login/functions.php';
 
sec_session_start();




     include 'PHPfunc.php';
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
     }
     else print "<script type = \"text/javascript\"> errorMessage('".$resposta."')</script>";
     }
     else {
         $update="false";
         
         
     }

                             
     ?>
   
         <?php if (login_check($mysqli) == true) : ?>
            <p>Welcome <?php echo htmlentities($_SESSION['username']); ?>!</p>
 <form name = "addMission" id="addMission" action = "novaMissao.php" onsubmit="return ValidateRequiredFields();" method="post">
    <table border="0">
        <thead>
            <tr>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td ><label>Sigla da conferência/simposium:</label></td>
                <td> <input type="text" name="nome" value="" size="15"  required/></td>
            </tr>
            <tr>
                <td><label>Nome/Descrição:</label></td>
                <td><textarea name="descricao" id="descricao" rows="2" cols="53" value="" style="overflow-y: scroll"   required> </textarea></td>
                <td id="descricao_obg"></td>
            </tr>
            <tr>
                <td>Assunto</td>
                <td> <textarea name="assunto" rows="2" cols="53" id="assunto" style="overflow-y: scroll" required> </textarea></td>
                <td id="assunto_obg"></td>
            </tr>
            <tr>
                <td>Palavras chave</td>
                
                <td> <textarea name="palavras" id="palavras" rows="2" cols="53" value="" style="overflow-y: scroll" required> </textarea></td>
                <td id="palavras_obg"></td>
            </tr>
            <!--
            <tr>
                <td>Departamento</td>
                <td><select name="departamento" size="1" required>
                    <option value="">Unidade departamental?</option>
                    <option>DHA</option>
                    <option>DT</option>
                    <option>DG</option>
                    <option>DBB</option>
                    <option>DM</option>
                    <option>DE</option>
                    <option>DED</option>
                    <option>CIC</option>
                </select></td>
            </tr>
            -->
            <tr>
                <td>Ano:</td>
                <td><input type="number" name="ano" min="2000" max="2020" value="" size="4" required/></td>
            </tr>
           
</script>
            
            <tr>
                <td>Ficheiro de apresentação(i.e index.htm(l)</td>
                <td>  
                    
                    <input type="button" name="link" value="browse" onclick="browse(ano.value+'\\'+nome.value+'\\docs','docs','apre')" required/>
                    <input type="text" id="link" name="link_to_apresentacao" placeholder="Escolha ficheiro ..." size="60"/>
                   
                    
            
                             <?php
                             /*
                             $dir="2014\\IAHS2014\\docs";
                             $files= array ();
                             $tipo="docs";
                             $idx=0;
                             $tabs="";
                             $fulldir="repos\\".$dir;
                             createArrayWithFiles ($fulldir,$tabs, $tipo,$idx, $files);
                             createSelectFromArr($files,"link_to_apresentacao");
                              * */
                              
                             ?>
            </td>
            </tr>
            <!-- para apresentar ficheiros a escolher -->
            <tr>
                <td></td>
                <td id="apre"></td>
            </tr>
           

            <tr>
                <td><b>Participantes na missão</b></td>
                <td> </td>
            </tr>
                 
            <tr >
                <td><b>Nome Participante 1</b></td>
                <td> <input type="text" name="p1" value="" size="20" placeholder="Introduza nome ..." required/></td>
            </tr>
            <tr>
                <td>Relatório de Missão</td>
                <td>  <input type="button" name="link" value="browse" onclick="browse(ano.value+'/'+nome.value+'/relatorios','rel1','rm1')" required/>
                      <input type="text" id="rel1" name="r1" placeholder="Escolha ficheiro ..." size="60"</td>
            </tr>
            <!-- para apresentar ficheiros a escolher -->
            <tr>
                <td></td>
                <td id="rm1"></td>
            </tr>
            <tr>
                <td><b>Nome Participante 2</b></td>
                <td> <input type="text" name="p2" value="" size="20" placeholder="Introduza nome ..."/></td>
            </tr>
            <tr>
                <td>Relatório de Missão</td>
                <td>  <input type="button" name="link" value="browse" onclick="browse(ano.value+'\\'+nome.value+'\\relatorios','rel2','rm2')" required/>
                      <input type="text" id="rel2" name="r2" placeholder="Escolha ficheiro ..." size="60"</td>
            </tr>
            <!-- para apresentar ficheiros a escolher -->
            <tr>
                <td></td>
                <td id="rm2"></td>
            </tr>
            <tr>
                <td><b>Nome Participante 3</b></td>
                <td> <input type="text" name="p3" value="" size="20" placeholder="Introduza nome ..." /></td>
            </tr>
            <tr>
                <td>Relatório de Missão</td>
                <td>  <input type="button" name="link" value="browse" onclick="browse(ano.value+'\\'+nome.value+'\\relatorios','rel3','rm3')" required/>
                      <input type="text" id="rel3" name="r3" placeholder="Escolha ficheiro ..." size="60"</td>
            </tr>
            <!-- para apresentar ficheiros a escolher -->
            <tr>
                <td></td>
                <td id="rm3"></td>
            </tr>
            <tr>
                <td>Ficheiro c/ documentação</td>
                <td>  <input type="file" name="docfile" value="" /></td>
            </tr>
        </tbody>
    </table>
    <input type="hidden" name="update" value="true"/>
    <input type="submit" value="submeter" name="submit" />
    <input type="reset" value="limpar" name="reset" />
</form>
            <!--<p>Return to <a href="index.php">login page</a></p>-->
        <?php else : ?>
            <p>
                <span class="error">Você não tem autorização para acessar esta página.Faça login.</span> 
            </p>
        <?php endif; ?>     
                
                

</body>
</html>