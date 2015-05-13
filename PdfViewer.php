<!DOCTYPE html>
<!--
Copyright 2012 Mozilla Foundation

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

    http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.

Adobe CMap resources are covered by their own copyright and license:
http://sourceforge.net/adobe/cmap/wiki/License/
-->
<html>
<head>
  <meta charset="UTF-8">
  <title>DocRep - PDF Viewer</title>
   <link rel="stylesheet" href="style.css" 
        
         />
<script src="pdfjs/build/pdf.js"></script>
    </head>
<body>

   <div class="BackgroundGradient"> </div>
    <div class="BodyContent">

    <div class="BorderBorder"><div class="BorderBL"><div></div></div><div class="BorderBR"><div></div></div><div class="BorderTL"></div><div class="BorderTR"><div></div></div><div class="BorderT"></div><div class="BorderR"><div></div></div><div class="BorderB"><div></div></div><div class="BorderL"></div><div class="BorderC"></div><div class="Border">

        <div class="Header">
          <div class="HeaderTitle">
            <h1><a href="index.php"><img src="images/logo-lnec.gif" alt="DocRep-LNEC"></a></h1>
            <h2>DocRep - Repositório de Relatorios e Documentos de Missões do LNEC</h2>
          </div>
        </div>
            
         <div class="Columns"><div class="MainColumn">
        <div class="ArticleBorder"><div class="ArticleBL"><div></div></div><div class="ArticleBR"><div></div></div><div class="ArticleTL"></div><div class="ArticleTR"><div></div></div><div class="ArticleT"></div><div class="ArticleR"><div></div></div><div class="ArticleB"><div></div></div><div class="ArticleL"></div><div class="ArticleC"></div><div class="Article" id="artigo">

       
    
  
    


<div>
  <button id="prev">Previous</button>
  <button id="next">Next</button>
  &nbsp; &nbsp;
  <span>Page: <span id="page_num"></span> / <span id="page_count"></span></span>
</div>

<div>
  <canvas id="the-canvas" style="border:1px solid black"></canvas>
</div>

<!-- for legacy browsers add compatibility.js -->
<!--<script src="../compatibility.js"></script>-->

<script src="pdfjs/build/pdf.js"></script>

<script id="script">
  //
  // If absolute URL from the remote server is provided, configure the CORS
  // header on that server.
  //
  var url_i = 'repos/2014/IAHS2014/relatorios/INF28-Rel_congressos_IAHS_LM_V3.pdf';


  //
  // Disable workers to avoid yet another cross-origin issue (workers need
  // the URL of the script to be loaded, and dynamically loading a cross-origin
  // script does not work).
  //
  // PDFJS.disableWorker = true;

  //
  // In cases when the pdf.worker.js is located at the different folder than the
  // pdf.js's one, or the pdf.js is executed via eval(), the workerSrc property
  // shall be specified.
  //
  // PDFJS.workerSrc = '../../build/pdf.worker.js';

  var pdfDoc = null,
      pageNum = 1,
      pageRendering = false,
      pageNumPending = null,
      scale = 1.4,
      canvas = document.getElementById('the-canvas'),
      ctx = canvas.getContext('2d');

  /**
   * Get page info from document, resize canvas accordingly, and render page.
   * @param num Page number.
   */
  function renderPage(num) {
    pageRendering = true;
    // Using promise to fetch the page
    pdfDoc.getPage(num).then(function(page) {
      var viewport = page.getViewport(scale);
      canvas.height = viewport.height;
      canvas.width = viewport.width;

      // Render PDF page into canvas context
      var renderContext = {
        canvasContext: ctx,
        viewport: viewport
      };
      var renderTask = page.render(renderContext);

      // Wait for rendering to finish
      renderTask.promise.then(function () {
        pageRendering = false;
        if (pageNumPending !== null) {
          // New page rendering is pending
          renderPage(pageNumPending);
          pageNumPending = null;
        }
      });
    });

    // Update page counters
    document.getElementById('page_num').textContent = pageNum;
  }

  /**
   * If another page rendering in progress, waits until the rendering is
   * finised. Otherwise, executes rendering immediately.
   */
  function queueRenderPage(num) {
    if (pageRendering) {
      pageNumPending = num;
    } else {
      renderPage(num);
    }
  }

  /**
   * Displays previous page.
   */
  function onPrevPage() {
    if (pageNum <= 1) {
      return;
    }
    pageNum--;
    queueRenderPage(pageNum);
  }
  document.getElementById('prev').addEventListener('click', onPrevPage);

  /**
   * Displays next page.
   */
  function onNextPage() {
    if (pageNum >= pdfDoc.numPages) {
      return;
    }
    pageNum++;
    queueRenderPage(pageNum);
  }
  document.getElementById('next').addEventListener('click', onNextPage);

  /**
   * Asynchronously downloads PDF.
   */
  function PdfViewer(url){
  PDFJS.getDocument(url).then(function (pdfDoc_) {
    pdfDoc = pdfDoc_;
    document.getElementById('page_count').textContent = pdfDoc.numPages;

    // Initial/first page rendering
    renderPage(pageNum);
  });
  
  }
  //PdfViewer();
</script>
<?php
if (isset($_GET["url"])) $url=$_GET["url"];
//$url = 'repos/2014/IAHS2014/relatorios/INF28-Rel_congressos_IAHS_LM_V3.pdf';
//echo $url;
echo"<script>";
echo "PdfViewer('$url');";
echo "</script>";
print "<span class=\"ButtonInput\"><span><input type=\"button\" onclick=\"window.location.href='$url'\" value=\"Download File!\"/></span></span>"
?>


 </div></div>
        <div class="Footer">
           DocRep - Repositório de Relatorios e Documentos de Missões do LNEC - <a href="#">Contact Us</a>
        </div>                

    </div>
    </div>
        <span class="BackLink"><a href="http://cooltemplate.com">Web Template</a> created using Cool Template</span>
    <span class="BackLink"><a href="#"></a> LNEC/CIC/DIEI &copy;jfn</span>

</body>
</html>