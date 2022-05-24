<?php  

require __DIR__.'/vendor/autoload.php';

require_once 'app/Entity/Produto.php';
require_once 'app/Db/Connection.php';
require_once 'app/Transaction.php';
try{
Transaction::open('config');
//ABRIR CONEXÃO COM BANCO DE DADOS 
$conn = Transaction::get();
Produto::setConnection($conn);
//BUSCA TODOS PRODUTOS PARA LISTAGEM 
$produtos = Produto::all();
Transaction::close();
 }
 catch(Exception $e){
 	Transaction::rollback();
 	print $e->getMessage();
 } 



include __DIR__.'/includes/header.php';
include __DIR__.'/includes/listagem.php';
include __DIR__.'/includes/footer.php';