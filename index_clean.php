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
                    include 'PHPfunc.php';
                    include 'dbFunc.php';
     ?>
    <div class="BackgroundGradient"> </div>
    <div class="BodyContent">

    <div class="BorderBorder"><div class="BorderBL"><div></div></div><div class="BorderBR"><div></div></div><div class="BorderTL"></div><div class="BorderTR"><div></div></div><div class="BorderT"></div><div class="BorderR"><div></div></div><div class="BorderB"><div></div></div><div class="BorderL"></div><div class="BorderC"></div><div class="Border">

        <div class="Header">
          <div class="HeaderTitle">
            <h1><a href="index.php"><img src="images/logo-lnec.gif" alt="DocRep-LNEC"></a></h1>
            <h2>DocRep - Repositório de Relatorios e Documentos de Missões do LNEC</h2>
          </div>
        </div><div class="Menu">
            <ul><li><a href="index.php" class="ActiveMenuButton"><span>Home</span></a></li> <li><a href="#" class="MenuButton" onclick="showMissions()"><span>Missões</span></a></li> <li><a href="#" class="MenuButton"><span>Archive</span></a></li> <li><a href="#" class="MenuButton"><span>About</span></a></li></ul>
        </div><div class="Columns"><div class="Column1"><div class="Block">

           

            <div class="BlockContentBorderBorder"><div class="BlockContentBorderBL"><div></div></div><div class="BlockContentBorderBR"><div></div></div><div class="BlockContentBorderTL"></div><div class="BlockContentBorderTR"><div></div></div><div class="BlockContentBorderT"></div><div class="BlockContentBorderR"><div></div></div><div class="BlockContentBorderB"><div></div></div><div class="BlockContentBorderL"></div><div class="BlockContentBorderC"></div><div class="BlockContentBorder">
              <!--- <form  action="http://localhost:8080/fileSearcher/searcherServlet">
                <input type="text" style="width:170px" name="query"/>
                <span class="ButtonInput"><span><input type="submit" value=">" /></span></span>
                </form>-->
                
              <span class="BlockHeader"><span> <h3>Pesquisa todo o repositório</h3></span></span>     
             <form  name="" action="" method="">
                <input type="text" style="width:170px" name="query" onkeyup="searcher(query.value)"/>
                <span class="ButtonInput"><span><input type="button" value=">" onclick="searcher(query.value)" value=">"/></span></span>
               
                
             </form>
              
              <br />
            
              
               <?PHP
                
            ?>
              
              
            
            </div></div>
 
        </div>
           
        <div class="Block">

            <span class="BlockHeader"><span><h3>Missões</h3></span></span>

            <div class="BlockContentBorderBorder"><div class="BlockContentBorderBL"><div></div></div><div class="BlockContentBorderBR"><div></div></div><div class="BlockContentBorderTL"></div><div class="BlockContentBorderTR"><div></div></div><div class="BlockContentBorderT"></div><div class="BlockContentBorderR"><div></div></div><div class="BlockContentBorderB"><div></div></div><div class="BlockContentBorderL"></div><div class="BlockContentBorderC"></div><div class="BlockContentBorder" id="menu">

                <ul>
                   
                    <script type="text/javascript">
                      //  listDirs("C:\\xampp\\htdocs\\RepDoc\\repos\\2014")
                    </script>
                    </ul>
                    
            </div></div>

        </div>

        </div><div class="MainColumn">
        <div class="ArticleBorder"><div class="ArticleBL"><div></div></div><div class="ArticleBR"><div></div></div><div class="ArticleTL"></div><div class="ArticleTR"><div></div></div><div class="ArticleT"></div><div class="ArticleR"><div></div></div><div class="ArticleB"><div></div></div><div class="ArticleL"></div><div class="ArticleC"></div><div class="Article" id="artigo">

        <h2><a href="#">HTML Tag Examples</a></h2>

        <p>
            This section will give you a preview of how the various html tags will look.
            <br />
            <br />This is some text with a <a href="#">Test Link</a>, some <small>small text</small> and some <b>bolded text</b>.
            <br />
            <br />
            <a href="#" class="Button"><span>Button Using an Anchor Link  asdhkh     jfpojrfjjgj</span></a>


            


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
        </div>

        <p class="postmetadata"> Posted in <a href="#" title="View all posts in Uncategorized" rel="category tag">Uncategorized</a> |   <a href="#" title="Comment on Test Post">No Comments &#187;</a></p>
        
        </div>

        </div></div>




        <div class="ArticleBorder"><div class="ArticleBL"><div></div></div><div class="ArticleBR"><div></div></div><div class="ArticleTL"></div><div class="ArticleTR"><div></div></div><div class="ArticleT"></div><div class="ArticleR"><div></div></div><div class="ArticleB"><div></div></div><div class="ArticleL"></div><div class="ArticleC"></div><div class="Article">

        <!---<h2><a href="#">Photo Example</a></h2> -->

        <p>
            
      <div style="text-align: center;">
            <img src="http://mob0.com/rt/Tide%20Pool.jpg" width="400" height="300" />
        </div>
        </p>


        </div></div></div></div>
        <div class="Footer">
           DocRep - Repositório de Relatorios e Documentos de Missões do LNEC - <a href="#">Contact Us</a>
        </div>                

    </div>
    </div>
    <span class="BackLink"><a href="http://cooltemplate.com">Web Template</a> created using Cool Template</span
    <span class="BackLink"><a href="#"></a> LNEC/CIC/DIEI &copy;jfn</span>
</body>
</html>