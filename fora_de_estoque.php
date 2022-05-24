<?php  
require __DIR__.'/vendor/autoload.php';

require_once 'app/Entity/Produto.php';
require_once 'app/Db/Connection.php';
require_once 'app/Transaction.php';

//use \App\Entity\Produto;
try {
	Transaction::open('config');
    
    $conn = Transaction::get();

	Produto::setConnection($conn);
	
	$produtos = Produto::all();

} catch (Exception $e)
{ 
	Transaction::rollback();
 	print $e->getMessage(); 

}
//echo "<pre>" ; print_r($conn); echo "</pre>"; exit;  

//$produtos= Produto::getProdutos();


include __DIR__.'/includes/header.php';
include __DIR__.'/includes/falta_produto.php';
include __DIR__.'/includes/footer.php';