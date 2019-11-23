<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap Login Form</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/estilos.css">
  <style type="text/css">
      body{background-color: #f1f1f1;}
      .bslf{
          width: 350px;
          margin: 120px auto;
          padding: 25px 20px;
          background: #FFFFFF;
          box-shadow: 2px 2px 4px #ab8de0;
          border-radius: 5px;
          color: #fff;
      }
      .bslf h2{
          margin-top: 0px;
          margin-bottom: 15px;
          padding-bottom: 5px;
          border-radius: 10px;
          /*border: 1px solid #25055f;*/
          color: #286090;
      }
      .bslf a{color: #783ce2;}
      .bslf a:hover{
          text-decoration: none;
          color: #03A9F4;
      }
      .bslf .checkbox-inline{padding-top: 7px;}
  </style>
</head>
<body>
  <div class="bslf">
    <form action="" method="post">
      <h2 class="text-center">CRM Login</h2>
      <div class="form-group">
        <input id="login" name="login" type="text" class="form-control" placeholder="Login" required="required">
      </div>
      <div class="form-group">
        <input id="senha" name="senha" type="password" class="form-control" placeholder="Senha" required="required">
      </div>
      <div class="form-group clearfix">
      	<!-- <label class="checkbox-inline pull-left"><input type="checkbox"> Remember me</label>-->
        <button id="btn-logar" type="button" class="btn btn-primary pull-right">Entrar</button>
      </div>
      <!--
      <div class="clearfix">
        <a href="#" class="pull-left">Forgot Password?</a>
        <a href="#" class="pull-right">Create an Account</a>
      </div>
      -->
      <div id="alertas" display="none" class="alert alert-danger" style="display:none;">
        <p class="message"></p>
      </div>
    </form>
  </div>
  <script src="js/jquery-1.12.3.js"></script>
  <script src="js/bootstrap.min.js"></script>

  <script type="text/javascript" language="javascript">
  		$(document).ready(function() {
        // code ..
        $("#alertas").hide();
        logar();
  		} );

      var logar = function(){
        $("#btn-logar").on("click", function(){
          var login = $("#login").val(),
            senha = $("#senha").val();
          $.ajax({
            method: "POST",
            url: "access/login.php",
            data: {"login" : login, "senha" : senha}
          }).done(function(info){
            var json_info = JSON.parse( info );
            show_messagem_or_enter(json_info);
          });
        });
      }

      var show_messagem_or_enter = function (json_info){
        switch (json_info.result) {
          case "ADMIN":
            // code...
            window.location.href = "views/home.php";
            break;

          default:
            // code...
            $(".message").html(json_info.result);
            $("#alertas").show();
            $("#login").val("");
            $("#senha").val("");
            break;
        }
      }
  </script>
</body>
</html>
