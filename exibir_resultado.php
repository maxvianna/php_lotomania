<?php
	$arquivo = isset($_FILES["file_csv"]) ? $_FILES["file_csv"] : FALSE;
	$tipo_valido = "csv";
	if($tipo_valido == $arquivo["type"])
	{
		echo "Arquivo em formato inválido! O arquivo deve ser em extensão CSV.<br/>";
		echo '<a href="javascript:history.back()">Voltar para página principal</a>';
	}
	else
	{
		echo $arquivo["type"]."<br/>";
		preg_match("/\.(csv){1}$/i", $arquivo["name"], $ext);

        $arquivo_nome = date("d-m-Y_H-i-s") . "." . $ext[1];

		move_uploaded_file($arquivo["tmp_name"], $arquivo_nome);

		$row = 0;
		$handle = fopen($arquivo_nome,"r");

		$jogo1 = "1 5 6 8 9 11 12 16 18 20 21 22 23 28 30 33 34 37 38 40 41 42 46 49 50 51 54 56 59 60 61 62 64 66 69 71 72 76 77 80 81 83 84 86 87 92 97 98 99 00";
		$array_jogo1 = explode(" ", $jogo1);

		$jogo2 = "1 3 5 8 9 12 14 15 16 18 22 24 27 29 30 31 33 35 37 38 42 44 46 49 50 51 53 56 58 60 62 64 65 66 69 71 72 74 77 80 81 83 84 87 89 92 94 96 98 99";
		$array_jogo2 = explode(" ", $jogo2);

		echo '<table style="text-align: center">';

		while ($data = fgetcsv($handle, 1000, ";")) 
		{
		   $num = count($data);
		   $row++;

		   for ($i=0; $i < 20; $i++) { 
		   		$array_bolas[$i] = $data[$i+2];
		   }
					   			
		   $concurso = $data[0];
		   $data_sorteio = $data[1];
		   $premio20 = $data[30];
		   $premio19 = $data[31];
		   $premio18 = $data[32];
		   $premio17 = $data[33];
		   $premio16 = $data[34];
		   $premio0 = $data[35];
 
			echo "<tr><td>".$concurso."</td>";
			echo "<td>".$data_sorteio."</td>";
			
			for ($i=0; $i < 20; $i++) { 
				if ((in_array($array_bolas[$i], $array_jogo1)) && (in_array($array_bolas[$i], $array_jogo2))) 
				{
					echo '<td style="color: red; border: 1px solid yellow;">'.$array_bolas[$i].'</td>';
				} 
					elseif (in_array($array_bolas[$i], $array_jogo1)) 
					{
						echo '<td style="color: red;">'.$array_bolas[$i].'</td>';
					}
						elseif (in_array($array_bolas[$i], $array_jogo2)) 
						{
							echo '<td style="border: 1px solid yellow;">'.$array_bolas[$i].'</td>';
						} else
				echo "<td>".$array_bolas[$i]."</td>";
			}

			if ($row != 1) {
				$array_intersec1 = array_intersect($array_jogo1, $array_bolas);
				echo '<td style="background-color: red;';
				if ((count($array_intersec1) == 0)||(count($array_intersec1) == 16)||(count($array_intersec1) ==17)||(count($array_intersec1) == 18)||(count($array_intersec1) == 19)||(count($array_intersec1) == 20)){
					echo "color: blue; font-size:150%; text-weight: bold; text-decoration: underline;";
				}
				echo '">';
				echo count($array_intersec1);
				echo "</i></strong></td>";
			} else {
				echo "<td><strong><i>Acertos1</i></strong></td>";
			}	

			if ($row != 1) {
				$array_intersec2 = array_intersect($array_jogo2, $array_bolas);
				echo '<td style="background-color: yellow;';
				if ((count($array_intersec2) == 0)||(count($array_intersec2) == 16)||(count($array_intersec2) ==17)||(count($array_intersec2) == 18)||(count($array_intersec2) == 19)||(count($array_intersec2) == 20)){
					echo "color: blue; font-size:150%; text-weight: bold; text-decoration: underline;";
				}
				echo '">';
				echo count($array_intersec2);
				echo "</i></strong></td>";
				echo "</tr>";
			} else {
				echo "<td><strong><i>Acertos2</i></strong></td></tr>";
			}

		}
		echo "</table>";
		echo "<p>Dados da planilha inseridos com sucesso!<br/>Total de linhas inseridas: ".$row."</p>";
		fclose($handle);		

		unlink($arquivo_nome);
	}
?>



