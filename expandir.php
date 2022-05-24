<?php  
require_once 'app/Entity/Produto.php';
require_once 'app/Db/Connection.php';
require_once 'app/Transaction.php';

require __DIR__.'/vendor/autoload.php';

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
	
	//consulta vaga 
	$obProduto = Produto::find($_GET['id']);
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