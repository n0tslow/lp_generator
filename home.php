<?php
if (!empty($_REQUEST['Sender'])):
    $sender = $_REQUEST['Sender'];
    $layout = file_get_contents('./layout.html', FILE_USE_INCLUDE_PATH);

    foreach ($sender as $key => $value) {
        $key         = strtoupper($key);
        $start_if    = strpos($layout, '[[IF-' . $key . ']]');
        $end_if      = strpos($layout, '[[ENDIF-' . $key . ']]');
        $length      = strlen('[[ENDIF-' . $key . ']]');

        if (!empty($value)) {
            // Add the value at its proper location.
            $layout = str_replace('[[IF-' . $key . ']]', '', $layout);
            $layout = str_replace('[[ENDIF-' . $key . ']]', '', $layout);
            $layout = str_replace('[[' . $key . ']]', $value, $layout);
        } elseif (is_numeric($start_if)) {
            // Remove the placeholder and brackets if there is an if-statement but no value.
            $layout = str_replace(substr($layout, $start_if, $end_if - $start_if + $length), '', $layout);
        } else {
            // Remove the placeholder if there is no value.
            $layout = str_replace('[[' . $key . ']]', '', $layout);
        }
    }

    // Clean up any leftover placeholders. This is useful for booleans,
    // which are not submitted if left unchecked.
    $layout = preg_replace("/\[\[IF-(.*?)\]\]([\s\S]*?)\[\[ENDIF-(.*?)\]\]/u", "", $layout);

    if (!empty($_REQUEST['download'])) {
        header('Content-Description: File Transfer');
        header('Content-Type: text/html');
        header('Content-Disposition: attachment; filename=index.html');
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
    }

    echo $layout;
else: ?><!DOCTYPE html>
<html lang="en">
<head>
<title>Relatorio</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="styless.css">
<style>
html,body,h1,h2,h3,h4,h5,h6 {font-family: "Roboto", sans-serif;}
.w3-sidebar {
  z-index: 3;
  width: 250px;
  top: 43px;
  bottom: 0;
  height: inherit;
}
            /* Sticky footer styles
            -------------------------------------------------- */

            html,
            body {
                height: 100%;
                /* The html and body elements cannot have any padding or margin. */
            }

            /* Wrapper for page content to push down footer */
            #wrap {
                min-height: 100%;
                height: auto !important;
                height: 100%;
                /* Negative indent footer by its height */
                margin: 0 auto -60px;
                /* Pad bottom by footer height */
                padding: 0 0 60px;
                right: 300px;
            }
            #form > .container{
                right: 300px;
            }

            /* Set the fixed height of the footer here */
            #footer {
                height: 60px;
                background-color: #f5f5f5;
            }


            /* Custom page CSS
            -------------------------------------------------- */
            /* Not required for template or sticky footer method. */

            #wrap > .container {
                padding: 60px 300px 0;
                right: 300px;
            }
            .container .credit {
                margin: 20px 0;
            }

            #footer > .container {
                padding-left: 300px;
                padding-right: 15px;
            }

            code {
                font-size: 80%;
            }

           h4{
            padding-left: 300px
           }
            
      
</style>
</head>
<body>

<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-theme w3-top w3-left-align w3-large">
    <a class="w3-bar-item w3-button w3-right w3-hide-large w3-hover-white w3-large w3-theme-l1" href="javascript:void(0)" onclick="w3_open()"><i class="fa fa-bars"></i></a>
    <a href="#" class="w3-bar-item w3-button w3-theme-l1">FESTVAL</a>
    <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hover-white"></a>
    <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hover-white"></a>
    <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hover-white"></a>
    <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hover-white"></a>
    <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hide-medium w3-hover-white"></a>
    <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hide-medium w3-hover-white"></a>
  </div>
</div>

<!-- Sidebar -->
<nav class="w3-sidebar w3-bar-block w3-collapse w3-large w3-theme-l5 w3-animate-left" id="mySidebar">
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-right w3-xlarge w3-padding-large w3-hover-black w3-hide-large" title="Close Menu">
    <i class="fa fa-remove"></i>
  </a>
  <a class="w3-bar-item" href="home.html"><b>Menu De Landing Page</b></a>
  <a class="w3-bar-item w3-button w3-hover-black" href="relat.php">Landing Page Template 1</a>
  <a class="w3-bar-item w3-button w3-hover-black" href="cesta_cruzada.php">Landing Page Template 2</a>
  <a class="w3-bar-item w3-button w3-hover-black" href="cesta_cruzada_sec.php">Landing Page Template 3</a>
  <a class="w3-bar-item w3-button w3-hover-black" href="#">Landing Page Template 4</a>
</nav>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- Main content: shift it to the right by 250 pixels when the sidebar is visible -->
<div id="wrap">

            <!-- Fixed navbar -->
            <div class="navbar navbar-default navbar-fixed-top">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">HTML Generator</a>
                    </div>
                </div>
            </div>

            <!-- Begin page content -->
            <div class="container">
                <div class="page-header">
                    <h1>Gerador de HTML email Mkt</h1>
                </div>
                <form role="form" method="post" target="preview" id="form">
                    <div class="form-group">
                        <label for="imagem">imagem 1</label>
                        <input type="text" class="form-control" id="imagem" name="Sender[imagem]" placeholder="Digite a url fonte">
                    </div>
                    <div class="form-group">
                        <label for="imagem">imagem 2</label>
                        <input type="text" class="form-control" id="Email" name="Sender[email]" placeholder="Digite a url fonte">
                    </div>
                    <div class="form-group">
                        <label for="imagem">Imagem 3</label>
                        <input type="text" class="form-control" id="Phone" name="Sender[phone]" placeholder="Digite a url fonte">
                    </div>
                    <div class="form-group">
                        <label for="imagem">imagem 4</label>
                        <input type="text" class="form-control" id="Mobile" name="Sender[mobile]" placeholder="Digite a url fonte">
                    </div>
           

                    <button id="preview" type="submit" class="btn btn-default">Preview</button>
                    <button id="download" class="btn btn-default">Download</button>
                    <input type="hidden" name="download" id="will-download" value="">
                </form>
            </div>

            <div class="container">
                <iframe src="about:blank" name="preview" width="100%" height="600"></iframe>
            </div>

        </div>

        <div id="footer">
            <div class="container">
                <p class="text-muted credit">developed by <a href="">Lucas Rodrigues</a>.</p>
            </div>
        </div>
  <!-- Pagination -->
  

  <footer id="myFooter">
    <div class="w3-container w3-theme-l2 w3-padding-32">
      <h4>Festval Mlt Digital</h4>
    </div>

    <div class="w3-container w3-theme-l1">
      <p> <a href="#" target="_blank"></a></p>
    </div>
  </footer>

<!-- END MAIN -->
</div>

<script>
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
    overlayBg.style.display = "none";
  } else {
    mySidebar.style.display = 'block';
    overlayBg.style.display = "block";
  }
}

// Close the sidebar with the close button
function w3_close() {
  mySidebar.style.display = "none";
  overlayBg.style.display = "none";
}
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
            <script>
            $(document).ready(function(){
 
            $("#btn1").click(function(e){
            
                e.preventDefault();

                var DivTabela = document.getElementById('divTabela');
                var Dados = new Blob(['\ufeff'+ DivTabela.outerHTML], {type:'aplication/vnd.ms-excel'});
                var url = window.URL.createObjectURL(Dados);

                var a = document.createElement('a');

                a.href = url;
                
                a.download = 'Dados.xls'

                a.click();
            
            });    
            });
        
        </script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
        <script type="text/javascript">
        $( document ).ready(function() {
            $("#download").bind( "click", function() {
                $('#will-download').val('true');
                $('#form').removeAttr('target').submit();
            });

            $("#preview").bind( "click", function() {
                $('#will-download').val('');
                $('#form').attr('target','preview');
            });

        });
        </script>


</body>
</html>
<?php endif;