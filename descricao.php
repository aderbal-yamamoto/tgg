<?php  
require __DIR__.'/vendor/autoload.php';
use App\Entity\Produto;
use App\Entity\Transaction;

define('TITLE', 'Editar Produto');

const entity = "detalhe";//nome da tabela

//validaçao do id
if (!isset($_GET['id']) or !is_numeric($_GET['id'])) {
	header('location: index.php?status=error');
	exit;	
}
 try{
 	//ABRIR CONEXÃO COM BANCO
	Transaction::open('config');
	//PEGAR CONEXÃO ABERTA
	$conn = Transaction::get();

	Produto::setConnection($conn);

	$obProduto = new Produto;
 	//VALIDAÇÃO DO POST
 	if (isset($_POST['descricao'],$_POST['imagem'],$_GET['id'])) {
 	
 	$obProduto->descricao        = strtoupper($_POST['descricao']);
 	$obProduto->imagem = $_POST['imagem'];
 	$obProduto->fk_id = $_GET['id'];
 	$obProduto->id  = $_GET['id'];
 	
 	$obProduto->saveGeneric('detalhe');
    //echo "<pre>" ; print_r($sql); echo "</pre>"; exit;
    //define o arquivo de log
	//Transaction::setLogger(new LoggerTXT('tmp/log_editar_produto.txt'));
	
	//Transaction::log($obProduto->nome);

 	Transaction::close();
 	header('location: index.php?status=success');
 	exit;
 	
 	}
 }

 catch (Exception $e) 
 {
	Transaction::rollback();
 	print $e->getMessage(); 
 }

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/formulariodesc.php';
include __DIR__.'/includes/footer.php';

//echo "<pre>" ; print_r($_POST); echo "</pre>"; exit;