<!DOCTYPE html>
<html>
<head>
	<title>Conferência de Lotomania</title>
	<meta charset="utf-8" />
</head>
<body>
	<form method="post" name="frm_loteria" action="exibir_resultado.php" enctype="multipart/form-data">
		<fieldset>
			<legend>Conferir Jogo</legend>
			<label>
				Selecionar arquivos com resultados<br/>
				<input id="file_csv" name="file_csv" type="file">
			</label>
			<br/>
			<button type="submit">Enviar</button>
		</fieldset>
	</form>
	
</body>
</html>