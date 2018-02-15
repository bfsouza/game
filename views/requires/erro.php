<html>
    <head>
        <link href="../../plugins/materialize-v.0.100.2/css/materialize.min.css" rel="stylesheet">
        <script src="../../plugins/materialize-v.0.100.2/js/materialize.min.js"></script>
    </head>
    <body>
        <div class="container">
            <br><br><br>
            <div class="col s12 m12 l8 offset-l2">
                <h4 class="light">Erro :(</h4>
                <hr>
                Ocorreu um erro ao executar esta ação<br>
                Erro: <?=$erro?><br><br>
                <button class="btn green darken-2" onclick="window.history.back()">Voltar</button>
            </div>
        </div>
    </body>
</html>