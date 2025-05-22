<?php  
require __DIR__.'/vendor/autoload.php';
use App\Entity\Transaction;
use App\Entity\Produto;

define('TITLE', 'Cadastrar produto');

try{

	if(isset($_GET['barcode'])){
		$codigobarras = $_GET['barcode'];
		var_dump($codigobarras);
		
	}
	if (isset($_POST['preco_venda'])) {
		$porcentagem = ($_POST['preco_venda'] * 0.35);
		$custo = number_format($porcentagem,2);
	
	}
	
	Transaction::open('config');
	//ABRIR CONEXÃO COMO BANCO
	$conn = Transaction::get();

	Produto::setConnection($conn);

	$obProduto = new Produto;

	//validação do post
 	if (isset($_POST['nome'],$custo,$_POST['preco_venda'], $_POST['quantidade'],$_POST['validade'],$codigobarras)) {
		$obProduto->id          = $id = "" ; 
 		$obProduto->nome        = strtoupper($_POST['nome']);
 		$obProduto->preco_custo = $custo;
 		$obProduto->preco_venda = $_POST['preco_venda'];
 		$obProduto->quantidade  = $_POST['quantidade'];
 		$obProduto->validade    = $_POST['validade'];
		$obProduto->codigobarras     = $codigobarras;
 		$obProduto->saveGeneric('estoque');
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