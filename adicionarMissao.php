<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns = "http://www.w3.org/1999/xhtml" >-->
<!DOCTYPE html>
<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>DocRep-LNEC</title>
    
    
    <script type = "text/javascript"  src = "js-code.js" >  
   
   
    
    </script>
 
</head>
<body>


<form name = "addMission" id="addMission" action = "adicionarMissao.php" onsubmit="return ValidateRequiredFields();">
    <table border="0">
        <thead>
            <tr>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td ><label>nome:</label></td>
                <td> <input type="text" name="nome" value="" size="15"  required/></td>
            </tr>
            <tr>
                <td><label>Descrição:</label></td>
                <td><textarea name="descricao" id="descricao" rows="5" cols="40" value="" required> </textarea></td>
                <td id="descricao_obg"></td>
            </tr>
            <tr>
                <td>Assunto</td>
                <td> <textarea name="assunto" rows="5" cols="40" id="assunto" required> </textarea></td>
                <td id="assunto_obg"></td>
            </tr>
            <tr>
                <td>Palavras chave</td>
                
                <td> <textarea name="palavras" id="palavras" rows="2" cols="40" value="" required> </textarea></td>
                <td id="palavras_obg"></td>
            </tr>
            <tr>
                <td>Departamento</td>
                <td><select name="Departamento" size="1" required>
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
            <tr>
                <td>Ano:</td>
                <td><input type="number" name="ano" min="2000" max="2020" value="" size="4" required/></td>
            </tr>
            <tr>
                <td>Funcionário</td>
                <td> <input type="text" name="responsavel" value="" size="20" required/></td>
            </tr>
            <tr>
                <td>Ficheiro c/ documentação</td>
                <td>  <input type="file" name="file" value="" required/></td>
            </tr>
        </tbody>
    </table>

    <input type="submit" value="submeter" name="submit" />
    <input type="reset" value="limpar" name="reset" />
    
  
  
</form>
    
    
    
    
<script>


function ValidateRequiredFields()
{

var message = new String('\nCampos obrigatórios:\n');
    var flag=true;

    var x="";
    x=document.forms["addMission"]["assunto"].value;
    if (x.length===1){  
        //message += '\nNº do processo\n'; alert (message);
        document.getElementById("assunto").style.borderColor="red";
        document.getElementById("assunto_obg").innerHTML="Campo obrigatório!";
        flag = false;
    }
    var y="";
    y=document.forms["addMission"]["descricao"].value;
    if (y.length===1){  
        //message += '\nNº do processo\n'; alert (message);
        document.getElementById("descricao").style.borderColor="red";
        document.getElementById("descricao_obg").innerHTML="Campo obrigatório!";
        flag = false;
    }
    var z="";
    z=document.forms["addMission"]["palavras"].value;
    if (z.length===1){  
        //message += '\nNº do processo\n'; alert (message);
        document.getElementById("palavras").style.borderColor="red";
        document.getElementById("palavras_obg").innerHTML="Campo obrigatório!";
        flag = false;
    }
  
alert(flag);
    return flag;

}

</script>



<form name="theForm" onsubmit="return ValidateRequiredFields()" method="get" action="adicionarMissao.php">


Nº do Processo: <br><input type="text" name="nr_processoCA" class="input-xlarge"><br>

<div class="row-fluid" style="text-align:center;">
    <input type="submit" class="btn btn-primary btn-large" value="Gravar">
</div>   

</form>




</body>