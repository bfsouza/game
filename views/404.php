<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">        
        <meta charset="UTF-8">
        <title>Game | 404</title>        
        <?php require("requires/links.php"); ?>
        <?php require("requires/imports.php"); ?>        
        <link href="../css/inicio.css" rel="stylesheet">
        
    </head>

    <body class="light bottom-footer">
        <header>
            <?php require("./requires/navbar-404.php") ?>
        </header>
        <main class="bottom-footer-main">
            <center>
                <br><br><br>
                <span class="font-raleway font-size-82">404</span><br>
                <span class="font-size-18"><b>Página não encontrada :(</b></span><br>
                A página que você está tentando acessar está indisponível<br><br>
                <a href="#" class="underline" onclick="window.history.back()">Voltar</a>
                <br><br><br>
            </center>
        </main>
        <footer>
            <?php require("./requires/footer.php") ?>
        </footer>
    </body>	
</html>