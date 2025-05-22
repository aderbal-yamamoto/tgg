<?php  
require __DIR__.'/vendor/autoload.php';
use App\Entity\Produto;
use App\Entity\Transaction;

define('TITLE', 'Detalhes do Produto');

//use \App\Entity\Produto;
//validaçao do id

if (!isset($_GET['id']) or !is_numeric($_GET['id'])) {
	header('location: index.php?');
	exit;	
}
 
try {

	Transaction::open('config');
    //ABRIR CONEXÃO COMO BANCO    
    $conn = Transaction::get();

	Produto::setConnection($conn);
	
	//consulta Produto 
	//$obProduto = Produto::find($_GET['id']);
	/*
			Criado para os produtos cadastrados sem descrição onde ele faz 
		a pesquisa com join se não houver faz a pesquisa sem ele.
	*/
	$obProduto = Produto::finddesc($_GET['id']);
	if (!$obProduto instanceof produto){
		$obProduto = Produto::find($_GET['id']);
		$obProduto->descricao = "Produto sem descrição";
	}
	//echo "<pre>" ; print_r($obProduto); echo "</pre>"; exit;
	$Lucro = Produto::getMargemLucro($obProduto);	
	
	$lucro_total = Produto::lucroTotal($obProduto);

	Transaction::close();

} catch (Exception $e)
{ 
	Transaction::rollback();
 	print $e->getMessage(); 

}




//print $lucro_total;
//echo "<pre>"; print_r($lucro_total) echo "</pre>"; exit;
include __DIR__.'/includes/header.php';
include __DIR__.'/includes/expandir.php';
include __DIR__.'/includes/footer.php';

//echo "<pre>" ; print_r($_POST); echo "</pre>"; exit;