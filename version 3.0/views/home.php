<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title>CRM</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="../css/estilos.css">
	<!-- Buttons DataTables -->
	<link rel="stylesheet" href="../css/buttons.bootstrap.min.css">
	<link rel="stylesheet" href="../css/font-awesome.min.css">

</head>
<body>
	<?php
			session_start();
			if (!$_SESSION['usuario']) {
				header('Location: ../index.php');
			}
	?>
	<div class="row fondo">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<h1 class="text-center text-uppercase">CRM</h1>
		</div>
	</div>
	<div ass="col-sm-12 col-md-12 col-lg-12">
		<a class="btn pull-right btn-sm" href="../access/logout.php" role="button">Sair</a>
	</div>

	<div class="row">
		<div id="cuadro2" class="col-sm-12 col-md-12 col-lg-12">
			<form class="form-horizontal" action="" method="POST">
				<div class="form-group">
					<h3 class="col-sm-offset-2 col-sm-8 text-center">
					Editar Usuario</h3>
				</div>
				<input type="hidden" id="idusuario" name="idusuario" value="0">
				<input type="hidden" id="option" name="option" value="salvar">
				<div class="form-group">
					<label for="nome" class="col-sm-2 control-label">Nome</label>
					<div class="col-sm-8"><input id="nome" name="nome" type="text" class="form-control"  autofocus></div>
				</div>
				<div class="form-group">
					<label for="login" class="col-sm-2 control-label">Login</label>
					<div class="col-sm-8"><input id="login" name="login" type="text" class="form-control" ></div>
				</div>
				<div class="form-group">
					<label for="email" class="col-sm-2 control-label">Email</label>
					<div class="col-sm-8"><input id="email" name="email" type="text" class="form-control" maxlength="50" ></div>
				</div>
				<div class="form-group">
						<label for="tipo" class="col-sm-2 control-label">Tipo</label>
						<div class="col-sm-8">
							<select class="form-control" id="tipo" name="tipo">
								<option value="Admin">Administrador</option>
								<option value="Client">Cliente</option>
							</select>
						</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-8">
						<input id="btn_salvar" type="submit" class="btn btn-primary" value="Salvar">
						<input id="btn_listar" type="button" class="btn btn-primary" value="Listar">
					</div>
				</div>
			</form>
			<!--<div class="col-sm-offset-2 col-sm-8">
				<p class="message"></p>
			</div>-->

		</div>
	</div>
	<div class="row">
		<div id="cuadro1" class="col-sm-12 col-md-12 col-lg-12">
			<div class="col-sm-offset-2 col-sm-8">
				<h3 class="text-center"> <small class="message"></small></h3>
			</div>
			<div class="table-responsive col-sm-12">
				<table id="dt_user" class="table table-bordered table-hover" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>Nome</th>
							<th>Login</th>
							<th>Email</th>
							<th>Tipo</th>
							<th></th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
	<div>
		<form id="frmExcluirUsuario" action="" method="POST">
			<input type="hidden" id="idusuario" name="idusuario" value="">
			<input type="hidden" id="option" name="option" value="excluir">
			<!-- Modal -->
			<div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="modalExcluirLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="modalExcluirLabel">Excluir Usuario</h4>
						</div>
						<div class="modal-body">
							Deseja realmente excluir esse usuario?<strong data-name=""></strong>
						</div>
						<div class="modal-footer">
							<button type="button" id="excluir-usuario" class="btn btn-primary" data-dismiss="modal">Sim</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
						</div>
					</div>
				</div>
			</div>
			<!-- Modal -->
		</form>
	</div>

	<script src="../js/jquery-1.12.3.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/jquery.dataTables.min.js"></script>
	<script src="../js/dataTables.bootstrap.js"></script>
	<!--botones DataTables-->
	<script src="../js/dataTables.buttons.min.js"></script>
	<script src="../js/buttons.bootstrap.min.js"></script>
	<!--Libreria para exportar Excel-->
	<script src="../js/jszip.min.js"></script>
	<!--Librerias para exportar PDF-->
	<script src="../js/pdfmake.min.js"></script>
	<script src="../js/vfs_fonts.js"></script>
	<!--Librerias para botones de exportación-->
	<script src="../js/buttons.html5.min.js"></script>

	<script type="text/javascript" language="javascript">
		$(document).ready(function() {
			listar();
			salvar();
			excluir();
			unBlockButton();
			blockButton();
		} );

		$("btn_listar").on("Click", function(){
			listar();
		});

		var salvar = function(){
			$("form").on("submit", function(e){
				e.preventDefault();
				var frm = $(this).serialize();
				$.ajax({
					method: "POST",
					url: "../crud.php",
					data: frm
				}).done(function(info){
					var json_info = JSON.parse( info );
					show_messagem(json_info);
					clean_fields();
					listar();
					blockButton();
				});
			});
		}

		var excluir = function(){
			$("#excluir-usuario").on("click", function(){
				var idusuario = $("#frmExcluirUsuario #idusuario").val(),
					option = $("#frmExcluirUsuario #option").val();
				$.ajax({
					method: "POST",
					url: "../crud.php",
					data: {"idusuario" : idusuario, "option" : option}
				}).done(function(info){
					var json_info = JSON.parse( info );
					show_messagem(json_info);
					clean_fields();
					listar();
				});
			});
		}

		var show_messagem = function (json_info){
			var text = "", color = "";
			if (json_info.result == "SUCCESS"){
				text = "<strong>SUCESSO!</strong> Os dados foram salvos cooretamente.";
				color = "#379911";
			}
			else if (json_info.result == "ERROR"){
				text = "<strong>ERROR!</strong> ".concat(json_info.extra);
				color = "#C9302C";
			}

			$(".message").html(text).css({"color" : color});
			$(".message").fadeOut(5000, function(){
				$(this).html("");
				$(this).fadeIn(3000);
			});
		}

		var clean_fields = function(){
			$("#option").val("salvar");
			$("#idusuario").val("0");
			$("#nome").val("").focus();
			$("#login").val("");
			$("#email").val("");
			$("#tipo").val("Client");
		}

		var listar = function() {
			var table = $('#dt_user').DataTable({
					"destroy" : true,
					"ajax": {
						"url": "../listar.php",
						"method": "POST",
						"dataSrc" : function(data){
							if (data.length == 0){
								return [];
							}
							else{
								return data.data;
							}
						}
					},
					"columns" : [
						{"data" : "nome"},
						{"data" : "login"},
						{"data" : "email"},
						{"data" : "tipo"},
						{"defaultContent" : btnEditar.concat(btnExcluir)}
					],
					"language" : idioma_pt_br
			});

			data_edit("#dt_user tbody", table);
			data_delete("#dt_user tbody", table);
		}

		var btnEditar = "<button type='button' class='editar btn btn-primary'><i class='fa fa-pencil-square-o'></i></button>"
		var btnExcluir = "<button type='button' class='excluir btn btn-danger' data-toggle='modal' data-target='#modalExcluir' ><i class='fa fa-trash-o'></i></button>"

		var data_edit = function(tbody, table) {
			$(tbody).on("click", "button.editar", function(){
				var data = table.row( $(this).parents("tr") ).data();
				var idusuario = $("#idusuario").val(data.id),
					nome = $("#nome").val(data.nome).
					login = $("#login").val(data.login),
					email = $("#email").val(data.email),
					tipo = $("#tipo").val(data.tipo)
					unBlockButton();
			});
		}

		var data_delete = function(tbody, table) {
			$(tbody).on("click", "button.excluir", function(){
				var data = table.row( $(this).parents("tr") ).data();
				var idusuario = $("#frmExcluirUsuario #idusuario").val(data.id);
			});
		}

		var blockButton = function () {
		  document.getElementById("btn_salvar").disabled = true;
		}

		var unBlockButton = function() {
		  document.getElementById("btn_salvar").disabled = false;
		}

		var idioma_pt_br = {
				"sEmptyTable": "Nenhum registro encontrado",
				"sInfo": "Mostrando de _START_ at\u00e9 _END_ de _TOTAL_ registros",
				"sInfoEmpty": "Mostrando 0 at\u00e9 0 de 0 registros",
				"sInfoFiltered": "(Filtrados de _MAX_ registros)",
				"sInfoPostFix": "",
				"sInfoThousands": ".",
				"sLengthMenu": "_MENU_ resultados por p\u00e1gina",
				"sLoadingRecords": "Carregando...",
				"sProcessing": "Processando...",
				"sZeroRecords": "Nenhum registro encontrado",
				"sSearch": "Pesquisar",
				"oPaginate": {
					"sNext": "Pr\u00f3ximo",
					"sPrevious": "Anterior",
					"sFirst": "Primeiro",
					"sLast": "\u00daltimo"
				},
				"oAria": {
					"sSortAscending": ": Ordenar colunas de forma ascendente",
					"sSortDescending": ": Ordenar colunas de forma descendente"
				},
				"select": {
					"rows": {
						"_": "Selecionado %d linhas",
						"0": "Nenhuma linha selecionada",
						"1": "Selecionado 1 linha"
					}
				}
		}
	</script>
</body>
</html>
