<main>
	
	<section>
		<a href="index.php">
		<button class="btn btn-success"> Voltar </button>
		</a>
		<a href="leitor_barras.html">
		<button class="btn btn-success"> Codigo de Barras </button>
		</a>	
	</section>
	<h2 class="mt-3"> <?=TITLE?> </h2>

	<form method="post">

		<div class="form-group">
			<label>nome</label>
			<input type="text" class="form-control" name="nome" >

		</div>

		<div class="form-group">
			<label>preco_custo</label>
			<input class="form-control" name="preco_custo" rows="5" ></input>
		</div>
		<div class="form-group">
			<label>preco_venda</label>
			<input class="form-control" name="preco_venda" rows="5" ></input>
		</div>
		<div class="form-group">
			<label>quantidade</label>
			<input class="form-control" name="quantidade" rows="5"  type="number" ></input>
		</div>
		<div class="form-group">
			<label>validade</label>
			<input class="form-control" name="validade" rows="5"  type = "date" ></input>
	
		</div>
	

		<div class="mt-3"  >			
			<button type="submit"  class="btn btn-success">Enviar</button>
		</div>

	</form>




</main>