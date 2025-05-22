<main>
	
	<section>
		<a href="index.php">
		<button class="btn btn-success"> Voltar </button>
		</a>
			
	</section>
	<h2 class="mt-3"> <?=TITLE?> </h2>

	<form method="post">

		<div class="form-group">
			<label>Descrição</label>
			
			<input type="textarea" class="form-control" name="descricao" value="">

		</div>

		<div class="form-group">
			<label>imagem</label>
			<input class="form-control" name="imagem" rows="5" value=""></input>
		</div>
		
	

		<div class="mt-3"  >			
			<button type="submit"  class="btn btn-success">Enviar</button>
		</div>

	</form>




</main>