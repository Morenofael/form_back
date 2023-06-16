<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require_once("Connection.php");
    $conn = Connection::getConnection();
    // print_r($conn);

    if(isset($_POST["submetido"])){
    $titulo = isset($_POST["titulo"])? $_POST["titulo"]:null;
    $genero = isset($_POST["genero"])? $_POST["genero"]:null;
    $qtd_paginas = isset($_POST["qtd_paginas"])? $_POST["qtd_paginas"]:null;

    $sql = "INSERT INTO livros (titulo, genero, qtd_paginas)" . "VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$titulo,$genero,$qtd_paginas]);
    header("location: livros.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cadastro livros</title>
    <style>
        table,tr,td{
            border:1px solid black;
        }
        body {
            font-family: system-ui, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
        }
    </style>
</head>
<body>
    <h1>Cadastro de livros</h1>
    <h2>Formulário livros</h2>
        <form action="" method="post">
            <input type="text" name="titulo" placeholder="informe o título">
            <br><br>
            <select name="genero" id="">
                <option value="O">Selecione o gênero</option>
                <option value="D">Drama</option>
                <option value="F">Ficção</option>
                <option value="R">Romance</option>
                <option value="O">Outro</option>
            </select>
            <br><br>
            <input type="number" name="qtd_paginas" placeholder="informe o numero de páginas">
            <br><br>
            <button type="submit">Cadastrar</button>
            <input type="hidden" name="submetido" value="1">
        </form>
    <h2>Listagem de livros</h2>
    <?php
        $sql = "SELECT * FROM livros";
        //Prepara e executa o comando SQL
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        //Armazena os resultados ($result é uma matriz)
        $result = $stmt->fetchAll();
    ?>
    <table>
        <tr>
            <td>ID</td>
            <td>Título</td>
            <td>Gênero</td>
            <td>Páginas</td>
            <td></td>
        </tr>
        <?php foreach($result as $reg):?>
            <tr>
                <td>
                    <?php echo $reg["id"]?>
                </td>
                <td>
                    <?php echo $reg["titulo"]?>
                </td>
                <td>
                    <?php
                    switch($reg['genero']){
                        case "D":
                            echo "Drama";
                        break;
                        case "F":
                            echo "Ficção";
                        break;
                        case "R":
                            echo "Romance";
                        break;
                        case "O":
                            echo "N/A";
                        break;
                    }
                    ?>
        
                </td>
                <td>
                    <?php echo $reg["qtd_paginas"]?>
                </td>
                <td><a href="livros_del.php?id=<?php echo $reg["id"]?>"onclick="return confirm('Confirma a exclusão?')">excluir</a></td>
            </tr>
        <?php endforeach?>
    </table>
</body>
</html>