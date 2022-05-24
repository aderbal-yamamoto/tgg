<?php 
 $mensagem = '';
  if(isset($_GET['status'])){
    switch ($_GET['status']) {
      case 'success':
        $mensagem = '<div class="alert alert-success">Ação executada com sucesso!</div>';
        break;

      case 'error':
        $mensagem = '<div class="alert alert-danger">Ação não executada!</div>';
        break;
    }
  }

$resultados = '';
foreach ($produtos as $produto) {
if ($produto->quantidade >0) {
	$lucro = (-$produto->preco_custo + $produto->preco_venda);
	$resultados .= '<tr>
							<td>'.$produto->nome.'</td>
							<td>'.$produto->preco_custo.'</td>
							<td>'.$produto->preco_venda.'</td>
							<td>'.$lucro.'</td>
							<td>'.$produto->quantidade.'</td>
							<td>'.$produto->validade.'</td>
							<td>
								<a href="editar.php?id='.$produto->id.'">
		   						<button type"button" class="btn btn-primary">Editar</button>
								</a><a href="expandir.php?id='.$produto->id.'">
		   						<button type"button" class="btn btn-danger">Espandir</button>
								</a>

							</td>
					</tr>';
					
					//echo "<pre>" ; print_r($lucro); echo "</pre>"; exit;
}
	
	
}

 $resultados = strlen($resultados) ? $resultados : '<tr>
                                                       <td colspan="6" class="text-center">
                                                              Nenhuma vaga encontrada
                                                       </td>
                                                    </tr>';

 

 ?>

<main>
 <?=$mensagem?>
	<section>
		<a href="cadastrar.php">
		<button class="btn btn-success"> Novo produto </button>
		</a>	
		<a href="fora_de_estoque.php">
		<button class="btn btn-success"> Produtos fora de estoque </button>
		</a>
	</section>

	<section>
		
		<table class="table bg-light mt-3">
			<thead>
				<tr>
				  <th>NOME</th>
				  <th>CUSTO</th>
				  <th>VENDA</th>
				  <th>LUCRO UN</th>
				  <th>QUANTIDADE</th>
				  <th>VALIDADE</th>
				  
				</tr>
			</thead>
			<body>
				<?=$resultados?>
			</body>

		</table>

	</section>


</main>





