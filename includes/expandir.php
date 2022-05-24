<main>
	
	<section>
		<a href="expandir.php">
		<button class="btn btn-success"> Voltar </button>
		</a>	
	</section>
	<h2 class="mt-3"> <?=TITLE?> </h2>

	

		<div class="mt-3">
			<label>Nome do produto: <?=$obProduto->nome?></label><br>
			<label>Custo: <?=$obProduto->preco_custo?></label><br>
			<label>Valor de venda: <?=$obProduto->preco_venda?></label><br>
			<label>Quantidade: <?=$obProduto->quantidade?></label> <label>Lucro: <?=$Lucro?></label><br>
			<label>Validade: <?=$obProduto->validade?></label><br>
		    <label>Lucro Total: <?=$lucro_total?></label><br>
		</div>

  


</main>