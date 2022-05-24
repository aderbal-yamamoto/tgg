<?php  

require __DIR__.'/vendor/autoload.php';
require_once 'app/Entity/Produto.php';
require_once 'app/Db/Connection.php';
require_once 'app/Transaction.php';
require_once 'app/Logger.php';
require_once 'app/LoggerTXT.php';

define('TITLE', 'Editar Produto');

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

	//CONSULTA PRODUTO
	$obProduto = Produto::find($_GET['id']);//echo "<pre>" ; print_r($data); echo "</pre>"; exit;
	//VALIDAÇÃO DA VAGA
	if (!$obProduto instanceof produto) {
		header('location: index.php?status=error');
	exit;
	}

	//VALIDAÇÃO DO POST
 	if (isset($_POST['nome'],$_POST['preco_custo'],$_POST['preco_venda'], $_POST['quantidade'],$_POST['validade'])) {
 	
 	$obProduto->nome        = strtoupper($_POST['nome']);
 	$obProduto->preco_custo = $_POST['preco_custo'];
 	$obProduto->preco_venda = $_POST['preco_venda'];
 	$obProduto->quantidade  = $_POST['quantidade'];
 	$obProduto->validade    = $_POST['validade'];
 	$obProduto->save();
    //echo "<pre>" ; print_r($sql); echo "</pre>"; exit;
    //define o arquivo de logo
	Transaction::setLogger(new LoggerTXT('tmp/log_editar_produto.txt'));
	
	Transaction::log($obProduto->nome);

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
include __DIR__.'/includes/formulario.php';
include __DIR__.'/includes/footer.php';

//echo "<pre>" ; print_r($_POST); echo "</pre>"; exit;