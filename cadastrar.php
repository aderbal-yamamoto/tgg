<?php  

require __DIR__.'/vendor/autoload.php';
require_once 'app/Entity/Produto.php';
require_once 'app/Db/Connection.php';
require_once 'app/Transaction.php';

define('TITLE', 'Cadastrar produto');

try{

	Transaction::open('config');
	//ABRIR CONEXÃO COMO BANCO
	$conn = Transaction::get();

	Produto::setConnection($conn);

	$obProduto = new Produto;

	//validação do post
 	if (isset($_POST['nome'],$_POST['preco_custo'],$_POST['preco_venda'], $_POST['quantidade'],$_POST['validade'])) {
 	
 		$obProduto->nome        = strtoupper($_POST['nome']);
 		$obProduto->preco_custo = $_POST['preco_custo'];
 		$obProduto->preco_venda = $_POST['preco_venda'];
 		$obProduto->quantidade  = $_POST['quantidade'];
 		$obProduto->validade    = $_POST['validade'];
 		$obProduto->save();
 	Transaction::close();
 	header('location: index.php?status=success');
 	exit;
 	//echo "<pre>" ; print_r($obProduto); echo "</pre>"; exit;
 	}
} catch (Exception $e)
{
	Transaction::rollback();
	print $e->getMessage();
}
include __DIR__.'/includes/header.php';
include __DIR__.'/includes/formulario.php';
include __DIR__.'/includes/footer.php';

//echo "<pre>" ; print_r($_POST); echo "</pre>"; exit;