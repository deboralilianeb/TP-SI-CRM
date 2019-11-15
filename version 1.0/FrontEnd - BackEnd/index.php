<!DOCTYPE html>
	<html lang="pt-br">
	<head>
		<title>CRM</title>
		<link rel="stylesheet" type="text/css" href="styleBusca2.css" />
		<link rel="stylesheet" type="text/css" href="datatable.css" />
		<script src="jquery-3.3.1.js"></script>
		<script src="datatable.js"></script>
		<script type="text/javascript" language="javascript">
		$(document).ready(function() {
			$('#listar-usuario').DataTable({			
				"processing": true,
				"serverSide": true,
				"ajax": {
					"url": "proc_pesq_user.php",
					"type": "POST"
				}
			});
		} );
		</script>
		<meta charset="utf-8">
	</head>
	<body>
	<div class="content">      
  <!--FORMULÁRIO DE LOGIN-->
  <div id="login">
	<form method="post" action=""> 
	  <h1>CRM</h1> 	  
	  <p> 
		<label>Resultados:</label>
	  </p>
	  
	  <p>
		<div style="overflow-x:auto;">
		<table id="listar-usuario" class="display" style="width:100%">
			<thead>
				<tr>
					<th>Nome</th>
					<th>Login</th>
					<th>Email</th>
					<th>Tipo</th>
				</tr>
			</thead>
		</table>
		</div>
	  </p>
	   
	  <p class="link">
		Deseja cadastrar novo usuario?
		<a href="#paracadastro">Cadastrar</a>
	  </p>
	</form>
  </div>
</div>
</div>  
</body>		
	</body>
</html>
