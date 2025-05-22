<?php 
namespace App\Entity;
use PDO;
class Produto{

	private static $conn;
	private $data; 

	function __get($prop){

		return $this->data[$prop];
	}

	function __set($prop, $value){

		$this->data[$prop] = $value;

	}

	public static function setConnection (PDO $conn){

		self::$conn = $conn;//echo "<pre>" ; print_r(self::$conn); echo "</pre>"; exit;
	}

	public static function find($id){

		$sql = "SELECT * FROM estoque where id = '$id' ";
		//print "$sql <br>\n";
		$result = self::$conn->query($sql);
		return $result->fetchObject(__CLASS__);


	}

	public static function finddesc($id){
		$sql = "SELECT estoque.*, detalhe.descricao, detalhe.imagem
		FROM estoque
		JOIN detalhe ON estoque.id = detalhe.fk_id where estoque.id = '$id' 
		";
		$result = self::$conn->query($sql);
		return $result->fetchObject(__CLASS__);
	}

	public static function findbarcode($barcode){

		$sql = "SELECT * FROM estoque where codigobarras = '$barcode' ";
		//print "$sql <br>\n";
		$result = self::$conn->query($sql);
		return $result->fetchObject(__CLASS__);


	}

	public static function all($filter = ''){

		$sql = "SELECT * FROM estoque ";
		if ($filter) {
			$sql .= "where $filter";
		}

		//print "$sql <br>\n";
		$result = self::$conn->query($sql); //var_dump($result);
		return $result->fetchAll(PDO::FETCH_CLASS, __CLASS__);
		
	}

	public function delete(){

		$sql = "DELETE FROM estoque where id = '{$this->id}' ";
		print "$sql <br>\n";
		return self::$conn->query($sql);

	}
	//função para salvar no banco qualquer item
	public function saveGeneric($table){
		
		if(array_key_exists("id", $this->data)){
			if($this->data['id'] === ""){
				$this->data['id'] = $this->getLastId() + 1;
			}
		}
		
		$key = array_keys($this->data);
		$key1 = implode(" , ",$key);
		$values = array_values($this->data);
		$valores = implode("' , '", $values);
		$value =    " '" . $valores ."'";
		
		$sql = "INSERT INTO " . $table . "($key1) VALUES ($value);";
		
		return self::$conn->exec($sql);
				
	}
	public function save(){
		
		if (empty($this->data['id'])) {
			$id = $this->getLastId() +1;
			$sql = "INSERT INTO estoque (id, nome, preco_custo, preco_venda, ".
								"  quantidade, validade, codigobarras)" . 
								"VALUES ('{$id}',".
											   "'{$this->nome}'," .
											   "'{$this->preco_custo}'," .
											   "'{$this->preco_venda}'," .
											   "'{$this->quantidade}'," .
											   "'{$this->validade}',".
											   "'{$this->codigobarras}')";
			

		}
		else{
			

			$sql = "UPDATE estoque SET nome              = '{$this->nome}', " .
								"      preco_custo       = '{$this->preco_custo}', " .
								"      preco_venda       = '{$this->preco_venda}', " .
								"      quantidade        = '{$this->quantidade}', " .
								"      validade          = '{$this->validade}'" .
								"WHERE id                = '{$this->id}'";


		}
		print "$sql <br>\n";
		Transaction::log($sql);
	
		return self::$conn->exec($sql);
		

	}

    private function getLastId(){

    	$sql = "SELECT max(id) as max FROM estoque";
    	$result = self::$conn->query($sql);//echo "<pre>" ; print_r($result); echo "</pre>"; exit;
    	$data = $result->fetch(PDO::FETCH_OBJ);
    	return $data->max;

    }

    static function getMargemLucro($obProduto){

    	return ($obProduto->preco_venda-$obProduto->preco_custo);
    }

    public function registraCompra($custo, $quantidade){

    	$this->custo = $custo;
    	$this->estoque += $quantidade;
    }
    static function lucroTotal($obProduto){

    return (self:: getMargemLucro($obProduto)*$obProduto->quantidade); 
    }


}

 ?>