<?php  
require __DIR__.'/vendor/autoload.php';
use App\Entity\Transaction;
use App\Entity\Produto;
use App\Entity\LoggerTXT;

define('TITLE', 'Cadastrar produto');

try{

	if(isset($_GET['barcode'])){
		$codigobarras = $_GET['barcode'];
		var_dump($codigobarras);
		
	}
	//percentual errado
	/*
	if (isset($_POST['preco_venda'])) {
		$porcentagem = ($_POST['preco_venda'] * 0.35);
		$custo = number_format($porcentagem,2);
	
	}
	*/
	
	Transaction::open('config');
	//ABRIR CONEXÃO COMO BANCO
	$conn = Transaction::get();

	Produto::setConnection($conn);

	$obProduto = new Produto;

	//validação do post
 	if (isset($_POST['nome'],$_POST['preco_custo'],$_POST['preco_venda'], $_POST['quantidade'],$_POST['validade'],$codigobarras)) {
		$obProduto->id          = $id = "" ; 
 		$obProduto->nome        = strtoupper($_POST['nome']);
 		$obProduto->preco_custo = $_POST['preco_custo'];
 		$obProduto->preco_venda = $_POST['preco_venda'];
 		$obProduto->quantidade  = $_POST['quantidade'];
 		$obProduto->validade    = $_POST['validade'];
		$obProduto->codigobarras     = $codigobarras;
 		$obProduto->saveGeneric('estoque');
	
	Transaction::setLogger(new LoggerTXT('tmp/log_produto.txt'));
	
	
	Transaction::log($obProduto->nome);

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
include __DIR__.'/includes/formulario_default.php';
include __DIR__.'/includes/footer.php';

//echo "<pre>" ; print_r($_POST); echo "</pre>"; exit;