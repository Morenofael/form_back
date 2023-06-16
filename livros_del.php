<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require_once("Connection.php");
    $conn = Connection::getConnection();
    // print_r($conn);

    $id = isset($_GET["id"])? $_GET["id"]:null;
    if($id){
        $conn = Connection::getConnection();
        $sql = "DELETE FROM livros WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute[$id];
        header("location: livros.php");
    }else{
        echo "id não informado";
        echo "<br>";
        echo "<a href='livros.php'>Voltar</a>";
    }
?>