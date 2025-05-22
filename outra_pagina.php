<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Código de Barras</title>
</head>
<body>
    <h1>Código de Barras Recebido</h1>
    <div id="barcode">
        <?php
        require __DIR__.'/vendor/autoload.php';
        use App\Entity\Transaction;
        use App\Entity\Produto;
        
        
       
        
        // Recupera o código de barras enviado via POST
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $barcode = $_GET["barcode"];
            echo "Código de barras: " . $barcode;
        } else {
            echo "Nenhum código de barras recebido.";
        }
        //criar função para verrificar no banco se existe produto com esse codigo de barras 
        
        //ABRIR CONEXÃO COM BANCO
	    Transaction::open('config');
	    //PEGAR CONEXÃO ABERTA
	    $conn = Transaction::get();

	    Produto::setConnection($conn);

	    //CONSULTA PRODUTO
	    $obProduto = Produto::findbarcode($_GET['barcode']);//echo "<pre>" ; print_r($data); echo "</pre>"; exit;
        $barcode = $_GET['barcode'];
        if (!$obProduto instanceof produto) {
            //header('location: index.php?status=error');
            echo "sem resultado";
            //chamar a pagina de cadastro enviando os dados
            $url = "cadastrar.php?barcode=" . $barcode ;
            header("location: " . $url );

            //exit;
        } else {
            echo "existe o produto cadastrado";
            $url = "editarbarcode.php?barcode=" . $barcode ;
            header("location: " . $url );
        }
        
        ?>
    </div>
</body>
</html>
