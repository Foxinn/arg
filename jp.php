<?php
session_start();

if($_SERVER['REQUEST_METHOD'] === 'POST'){ 
    //verifica se os campos foram preenchidos 
        if(!empty($_POST['usuario'])&& !empty($_POST['senha'])){ 
    //credenciais fixas para teste(o ideal é verificar em um banco de dados)   
            $usuario_correto ="321"; 
            $senha_correta = "123"; 
    // confere as credenciais estão corretas 
        if ($_POST['usuario'] === $usuario_correto && $_POST['senha'] === $senha_correta){ 
    //armazena os dados na sessão 
            $_SESSION['usuario'] = $_POST['usuario']; 
            $_SESSION['senha'] = $_POST['senha']; 
    // redireciona para a página principal 
            header('Location: telaini.php'); 
            exit(); 
        }else{ 
    //se o login for inválido, exibe mensagem de erro e redireciona para login.php 
            $_SESSION['erro_msg'] = "Preencha todos os campos!"; 
            header('Location: jp.php'); 
            exit(); 
            } 
        } else{
    // se algum campo estiver vazio 
            $_SESSION['erro_msg']="Preencha todos os campos!";
            header('Location: jp.php'); 
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agência de Turismo Japonesa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background-color: #2e2e2e;
            padding: 10px 20px;
            text-align: left;
            color: white;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            padding: 10px;
            margin-right: 20px;
            font-weight: bold;
        }
        .navbar a:hover {
            background-color: #575757;
        }
        .login-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .login-btn:hover {
            background-color: #45a049;
        }
        .content {
            padding: 40px;
            text-align: center;
        }
        h1 {
            color: #333;
        }
        .tour-info {
            display: flex;
            justify-content: space-around;
            margin-top: 30px;
        }
        .tour-info div {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 30%;
        }
        .tour-info img {
            max-width: 100%;
            border-radius: 5px;
        }
        .tour-info h3 {
            margin-top: 10px;
            color: #555;
        }

        /* Estilo do Modal */
        .modal {
            display: none; /* Oculta o modal */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border-radius: 5px;
            width: 300px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .modal input[type="text"],
        .modal input[type="password"] {
            padding: 10px;
            margin-bottom: 10px;
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .modal input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 4px;
            width: 100%;
        }

        .modal input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <div class="navbar">
    <button class="login-btn" id="loginBtn">Login</button>
    <center>
        <a href="#">Início</a>
        <a href="#">Pacotes</a>
        <a href="#">Contato</a>
    </center>
        
    </div>

    <div class="content">
        <h1>Bem-vindo à Agência de Turismo Japonesa</h1>
        <p>Explore os melhores destinos do Japão com a nossa agência!</p>

        <div class="tour-info">
            <div>
                <img src="https://via.placeholder.com/350x200" alt="Tour no Japão">
                <h3>Tokyo: A Capital Vibrante</h3>
                <p>Explore a cidade futurística de Tóquio, com seus arranha-céus, cultura pop e gastronomia única.</p>
            </div>
            <div>
                <img src="https://via.placeholder.com/350x200" alt="Tour no Japão">
                <h3>Kyoto: A Tradição Viva</h3>
                <p>Visite os templos históricos e as tradicionais casas de chá em Kyoto.</p>
            </div>
            <div>
                <img src="https://via.placeholder.com/350x200" alt="Tour no Japão">
                <h3>Osaka: Diversão e Aventura</h3>
                <p>Uma cidade cheia de entretenimento, lojas incríveis e deliciosos pratos de comida japonesa.</p>
            </div>
        </div>
    </div>

    <!-- O Modal de Login -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeBtn">&times;</span>
            <h2>Login</h2>
            <form action="jp.php" method="POST">
                <input type="text" name="usuario" placeholder="Usuário" required>
                <input type="password" name="senha" placeholder="Senha" required>
                <input type="submit" name="submit" value="Entrar">
            </form>
        </div>
    </div>

    <script>
        // Pegando os elementos do modal
        var modal = document.getElementById("myModal");
        var btn = document.getElementById("loginBtn");
        var span = document.getElementById("closeBtn");

        // Quando o usuário clicar no botão "Login", abre o modal
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // Quando o usuário clicar no "X" (fechar), fecha o modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // Quando o usuário clicar fora do modal, fecha o modal
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

</body>
</html>
