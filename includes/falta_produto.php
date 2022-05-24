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

		}
		 else
	{
	$resultados .= '<tr>
							<td>'.$produto->nome.'</td>
							<td>'.$produto->preco_custo.'</td>
							<td>'.$produto->preco_venda.'</td>
							<td>'.$produto->quantidade.'</td>
							<td>'.$produto->validade.'</td>
							<td>
								<a href="editar.php?id='.$produto->id.'">
		   						<button type"button" class="btn btn-primary">Editar</button>
								</a>

							</td>
					</tr>';
           }
}
	
	


 $resultados = strlen($resultados) ? $resultados : '<tr>
                                                       <td colspan="6" class="text-center">
                                                              Nada para mostrar!!
                                                       </td>
                                                    </tr>';
 ?>

<main>
 <?=$mensagem?>
 <h2 class="mt-3">Produtos</h2>
	<section>
		<a href="index.php">
		<button class="btn btn-success"> Voltar </button>
		</a>	
		
	</section>

	<section>
		
		<table class="table bg-light mt-3">
			<thead>
				<tr>
				  <th>NOME</th>
				  <th>PREÇO DE CUSTO</th>
				  <th>PREÇO DE VENDA</th>
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





