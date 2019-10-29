<?php
session_start();
include("conexao.php");

$base=new PDO("mysql:host=localhost;dbname=login","root","");

{
         
	$base=new PDO("mysql:host=localhost;dbname=login","root","");
	 $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	 $sql="SELECT * FROM login WHERE nome= :nome AND password= :password";

	 $resultado=$base->prepare($sql);

	 $nome=($_POST["nome"]);
	 $password=($_POST["password"]);

	 $resultado->bindValue(":nome", $nome);
	 $resultado->bindValue(":password", $password);

	 $resultado->execute();

	 $numero_registro=$resultado->rowCount();

	 if($numero_registro!=0)
	 {
	   echo "<h1>GOOOOOOOOOOOOOOOO conectado com sucesso</h1>";

	   session_start();

	   $_SESSION["usuario"] = $_POST["nome"];

	   header("Location:dados.php");


	 }else
	 {
		   header("Location:index.php");
	 }

  } catch(Exception $e)
  {
	 die("Error:" . $e->getMessage());
  }

$cpf = mysqli_real_escape_string($conexao, trim($_POST['cpf']));
$nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
$password = mysqli_real_escape_string($conexao, trim($_POST['password']));
$data_nasc = mysqli_real_escape_string($conexao, trim($_POST['data nasc']));
$telefone = mysqli_real_escape_string($conexao, trim($_POST['telefone']));
$celular = mysqli_real_escape_string($conexao, trim($_POST['celular']));
$cargo = mysqli_real_escape_string($conexao, trim($_POST['cargo']));
$enderco = mysqli_real_escape_string($conexao, trim($_POST['endereco']));

$sql = "select count(*) as total from usuario where usuario = '$usuario'";
$result = mysqli_query($conexao, $sql);
$row = mysqli_fetch_assoc($result);

if($row['total'] == 1) {
	$_SESSION['usuario_existe'] = true;
	header('Location: cadastro.php');
	exit;
}

$sql = "INSERT INTO `login` (`cpf`, `nome`, `password`, `data nasc`, `telefone`, `celular`, `cargo`, `endereco`) VALUES (NULL, '$cpf', '$nome', '$password', '$data_nasc', '$telefone', '$cargo', '$enderco'))";

if($conexao->query($sql) === TRUE) {
	$_SESSION['status_cadastro'] = true;
}

$conexao->close();

header('Location: cadastro.php');
exit;
?>