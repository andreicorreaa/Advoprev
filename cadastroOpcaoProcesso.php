<?php
    require_once("checkLogin.php");
?>

<!DOCTYPE html>
<html>
        <style>
        	#opcao button{
        		border: solid 2px #333333; /* Remove borders */
			    color: white; /* Add a text color */
			    padding: 14px 28px; /* Add some padding */
			    cursor: pointer; /* Add a pointer cursor on mouse-over */
			    font-family: 'Open Sans';
			    background-color: #333333;
			    font-family: 'Open Sans', Tahoma, Arial, sans-serif;
   				margin-left: 1px;
        	}
    	</style>
    <body>
		<center>
			<div id="opcao">
				<h1>Cadastrar</h1>
				<button type="button" name="btn_OpcaoProcesso1" id="btn_OpcaoProcesso1">Processo</button>
			    <button type="button" name="btn_OpcaoProcesso2" id="btn_OpcaoProcesso2">Partes(Processo)</button>
			    <button type="button" name="btn_OpcaoProcesso3" id="btn_OpcaoProcesso3">Indices(Processo)</button>
			</div>
		</center>
		<script type="text/javascript">
			$("#btn_OpcaoProcesso1").click(function(){
				$("#container1").html('');
				$("#container1").load('cadastroProcessos.php');
			});

			$("#btn_OpcaoProcesso2").click(function(){
				$("#container1").html('');
				$("#container1").load('cadastroPartesProcesso.php');
			});

			$("#btn_OpcaoProcesso3").click(function(){
				$("#container1").html('');
				$("#container1").load('cadastroIndicesProcessos.php');
			});
		</script>
    </body>
</html>