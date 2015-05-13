<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns = "http://www.w3.org/1999/xhtml" >
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>DocRep-LNEC</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="css/css3_treeView.css" />
    <script src="pdfjs/build/pdf.js"></script>
    <script type = "text/javascript"  src = "js-code.js" >  </script>
    
    <script>
    PDFJS.workerSrc = 'pdfjs/build/pdf.worker.js';
    </script>
</head>
<body>
     <?php 
                    include 'PHPfunc.php';
                    include 'dbFunc.php';
     ?>
    <div class="BackgroundGradient"> </div>
    <div class="BodyContent">

    <div class="BorderBorder"><div class="BorderBL"><div></div></div><div class="BorderBR"><div></div></div><div class="BorderTL"></div><div class="BorderTR"><div></div></div><div class="BorderT"></div><div class="BorderR"><div></div></div><div class="BorderB"><div></div></div><div class="BorderL"></div><div class="BorderC"></div><div class="Border">

        <div class="Header">
          <div class="HeaderTitle">
            <h1><a href="index.php"><img src="images/logo-lnec.gif" alt="DocRep-LNEC"></a></h1>
            <h2>DocRep - Repositório de Relatórios e Documentos de Missões do LNEC</h2>
          </div>
        </div><div class="Menu">
            <ul><li><a href="index.php" class="ActiveMenuButton"><span>Home</span></a></li> <li><a href="" class="MenuButton" onclick="showMissions()"><span>Missões</span></a></li><li><a href="#" class="MenuButton"  onclick="showHelp()"><span>Ajuda</span></a></li> </ul>
        </div><div class="Columns"><div class="Column1"><div class="Block">

           

            <div class="BlockContentBorderBorder"><div class="BlockContentBorderBL"><div></div></div><div class="BlockContentBorderBR"><div></div></div><div class="BlockContentBorderTL"></div><div class="BlockContentBorderTR"><div></div></div><div class="BlockContentBorderT"></div><div class="BlockContentBorderR"><div></div></div><div class="BlockContentBorderB"><div></div></div><div class="BlockContentBorderL"></div><div class="BlockContentBorderC"></div><div class="BlockContentBorder">
              <!--- <form  action="http://localhost:8080/fileSearcher/searcherServlet">
                <input type="text" style="width:170px" name="query"/>
                <span class="ButtonInput"><span><input type="submit" value=">" /></span></span>
                </form>-->
                
              <span class="BlockHeader"><span> <h3>Pesquisa </h3></span></span>     
             <form  name="" action="" method="" >
                <!-- Lança pesquisa sempre que carrega numa tecla. Substituiria a linha marcada com ***
                 <input type="text" style="width:170px" name="query" onkeyup="searcher(query.value)"/>
                -->
                <input type="text" style="width:170px" name="query"/><!--***-->
                <span class="ButtonInput"><span><input type="button" value=">" onclick="searcher(query.value,s_type.value)" value=">"/></span></span>
                <input type="radio" name="s_type" value="repos"  checked onclick="switchVisibility('cloud_d','cloud_m');">Pesquisa documentos</input><br />
                <input type="radio" name="s_type" value="dbase" onclick="switchVisibility('cloud_m','cloud_d');">Pesquisa missões</input>
                
             </form>
              
              <br />
            
              <div id="cloud_d">
               <?PHP
               // Cria nuvem de palavras
                require('CLOUD.PHP');
                $text_content=  getAllText()." ".getAllSWords();
                //print $text_content;
                $cloud = new PTagCloud(15,"repos");
                $cloud->addTagsFromText($text_content);
                $cloud->setWidth("232px");
                Print "<h4>Termos mais referenciados</h4>";
                echo $cloud->emitCloud();
               
             ?>
              </div>
              <div id="cloud_m" style="display: none">
               <?PHP
               // Cria nuvem de palavras
                //require('CLOUD.PHP');
               // $text_content=  getAllText()." ".getAllSWords();
                //print $text_content;
               $text_content=  getAllText();
                $cloud_m = new PTagCloud(15,"dbase");
                $cloud_m->addTagsFromText($text_content);
                $cloud_m->setWidth("232px");
                Print "<h4>Termos mais referenciados</h4>";
                echo $cloud_m->emitCloud();
                
             ?>
              </div>
   <!---  upload file         
              <form action="uploadFile.php" method="post" enctype="multipart/form-data">
                Select image to upload:
                <input type="file" name="fileToUpload" id="fileToUpload" />
                <input type="submit" value="Upload Image" name="submit"/>
            </form>
   -->
            <!--- Multiple  
              <form action="uploadMFiles.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload[]" id="fileToUpload" multiple="multiple"/>
    <input type="submit" value="Upload Image" name="submit"/>
</form>
           -->   
              
<!--
                <p><b>Start typing a name in the input field below:</b></p>
                <form>
                First name: <input type="text" onkeyup="showHint(this.value)">
                </form>
                <p>Suggestions: <span id="txtHint"></span></p>-->
            </div></div>
 
        </div>
           
        <div class="Block">

            <span class="BlockHeader"><span><h3>Missões</h3></span></span>

            <div class="BlockContentBorderBorder"><div class="BlockContentBorderBL"><div></div></div><div class="BlockContentBorderBR"><div></div></div><div class="BlockContentBorderTL"></div><div class="BlockContentBorderTR"><div></div></div><div class="BlockContentBorderT"></div><div class="BlockContentBorderR"><div></div></div><div class="BlockContentBorderB"><div></div></div><div class="BlockContentBorderL"></div><div class="BlockContentBorderC"></div><div class="BlockContentBorder" id="menu">

                <ul>
                    <!--<li><a href="#">Test Link 1</a></li>
                    <li><a href="#">Test Link 2</a></li>
                    <li><a href="#">Test Link 3</a></li>
                    <li><a href="#">Test Link 4</a></li>
                    <li><a href="#">Test Link 5</a></li>
                    <a href='#' onclick="alterContent('it works');">Link</a> -->
                    <?php 
                    //include 'PHPfunc.php';
                    //include 'dbFunc.php';
                    $dir="repos";  
                    $tabs=0;         
                    displayFolders($dir, $tabs,1,1,"j","h");    
                    $rPath=realpath('./repos');
                    //$tag="bia";
                    // print "<a href='#'  onclick=\"searcher('$tag')\">testejhgjhgjj </a>";
                   //echo $rPath;
                     
                   //print '<script type = "text/javascript" > listDirs(\''..'\')</script>';
                  // print"<script type=\"text/javascript\">showMissions()</script>";   
                     ?>
                    <script type="text/javascript">
                      //  listDirs("C:\\xampp\\htdocs\\RepDoc\\repos\\2014")
                    </script>
                    </ul>
                    
            </div></div>

        </div>

        </div><div class="MainColumn">
        <div class="ArticleBorder"><div class="ArticleBL"><div></div></div><div class="ArticleBR"><div></div></div><div class="ArticleTL"></div><div class="ArticleTR"><div></div></div><div class="ArticleT"></div><div class="ArticleR"><div></div></div><div class="ArticleB"><div></div></div><div class="ArticleL"></div><div class="ArticleC"></div><div class="Article" id="artigo">
<!---
        <h2><a href="#">HTML Tag Examples</a></h2>

        <p>
            This section will give you a preview of how the various html tags will look.
            <br />
            <br />This is some text with a <a href="#">Test Link</a>, some <small>small text</small> and some <b>bolded text</b>.
            <br />
            <br />
            <a href="#" class="Button"><span>Button Using an Anchor Link  asdhkh     jfpojrfjjgj</span></a>
-->

            <?php

           print"<script type=\"text/javascript\">showMissions()</script>";
                //$filename="hforeiion   vorpm    ";
                //$butt="<span>$filename</span>";
                //echo "<a href=\"xpto\"  class=\"Button\">".$butt."</a><br>"; 

           
            
            ?>


<!--
            <br />
            <span class="ButtonInput"><span><input type="button" value="Button Using Form Input" /></span></span>
            <br />

            <h1>Header 1</h1>
            <h2>Header 2</h2>
            <h3>Header 3</h3>
            <h4>Header 4</h4>
            <h5>Header 5</h5>
            
            Bulleted List:
            <ul>
                <li>List Item</li>
                <li>List Item</li>
                <li>List Item</li>
            </ul>
            
            <br />
            <blockquote>This is inside of a blockquote tag.</blockquote>    
        </p>
-->

        </div></div>


        <div class="ArticleBorder"><div class="ArticleBL"><div></div></div><div class="ArticleBR"><div></div></div><div class="ArticleTL"></div><div class="ArticleTR"><div></div></div><div class="ArticleT"></div><div class="ArticleR"><div></div></div><div class="ArticleB"><div></div></div><div class="ArticleL"></div><div class="ArticleC"></div><div class="Article">

        <div class="post-17 post type-post status-publish format-standard hentry category-uncategorized" id="post-17">
        <h2><a href="#" rel="bookmark" title="Permanent Link to Test Post">Documentos</a></h2>
                <small><script language="javascript">
                var today = new Date();
                 document.write(today);
                </script></small>

        <div class="entry" id="files">
        <p>Para aqui vão os ficheiros</p>
       
        <script language="javascript">
        //viewPDF('repos/2014/IAHS2014/relatorios/INF28-Rel_congressos_IAHS_LM_V3.pdf');
        
        </script>
      
        </div>

        <!--<p class="postmetadata"> Posted in <a href="#" title="View all posts in Uncategorized" rel="category tag">Uncategorized</a> |   <a href="#" title="Comment on Test Post">No Comments &#187;</a></p>
        -->
        </div>

        </div></div>




        <div class="ArticleBorder"><div class="ArticleBL"><div></div></div><div class="ArticleBR"><div></div></div><div class="ArticleTL"></div><div class="ArticleTR"><div></div></div><div class="ArticleT"></div><div class="ArticleR"><div></div></div><div class="ArticleB"><div></div></div><div class="ArticleL"></div><div class="ArticleC"></div><div class="Article">

        <!---<h2><a href="#">Photo Example</a></h2> -->

        <p>
            <?PHP
            /*$host=getHostNameAndIP();
            echo $host["name"];
            echo $host["ip"];
             * */
             registUser();
                //require('cloud.php');
                $text_content=  getAllText();
                //print $text_content;
               // $arr =array("neto"=>15,"jaquim"=>10,"bia"=>5,"joana"=>3);
               // $cloud2 = new PTagCloud(4,"repos",$arr);
                $cloud2 = new PTagCloud(15,"repos");
                $cloud2->addTagsFromText($text_content);
                $cloud2->setWidth("590px");
                echo $cloud2->emitCloud();
                
                
               
            ?>
        <!---<div style="text-align: center;">
            <img src="http://mob0.com/rt/Tide%20Pool.jpg" width="400" height="300" />
        </div>-->
        
        </p>

  <!---<canvas id="the-canvas" style="border:1px solid black;">dffgh</canvas>-->
        </div></div></div></div>
        <div class="Footer">
           DocRep - Repositório de Relatorios e Documentos de Missões do LNEC - <a href="#">Contact Us</a>
        </div>                

    </div>
    </div>
    <!--<span class="BackLink"><a href="http://cooltemplate.com">Web Template</a> created using Cool Template</span>-->
    <span class="BackLink"><a href="#"></a> LNEC/CIC/DIEI &copy;jfn</span>
</body>
</html>