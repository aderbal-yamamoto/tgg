<?php 
abstract class Logger {

	protected $filename; //local do arquivo de LOG

	public function __construct($filename) {

		$this->filename = $filename;
		file_put_contents($filename, ''); //limpa o conteudo do arquivo

	}
	//define o metodo write como obrigatório

	abstract function write($message);
}

 ?>