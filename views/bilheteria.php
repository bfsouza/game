<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="../resources/icon_mapa.ico" />
        <meta charset="UTF-8">
        <title>Game | Bilheteria</title>        
        <?php require("requires/links.php"); ?>
        <?php require("requires/imports.php"); ?>        
        <link href="../css/inicio.css" rel="stylesheet">
        <link href="../css/sidenav-adapter.css" rel="stylesheet">
    </head>

    <body class="light">
        <header>
            <?php require("./requires/navbar.php") ?>
        </header>
        <main>
            <div class="container">

                <br>
                <div class="">
                    <a href="estadio.php">Estádio</a> / Bilheteria
                </div>

                <br>
                <div class="row">
                    <div class="col s12 m12 l12">

                        <h5 class="light">Bilheteria</h5>

                        <ul class="collection">
                            <li class="collection-item faded-color-grey">Geral<span class="right">R$ 25</span></li>
                            <li class="collection-item faded-color-grey">Arquibancada<span class="right">R$ 35</span></li>
                            <li class="collection-item faded-color-grey">Cadeira<span class="right">R$ 50</span></li>
                            <li class="collection-item faded-color-grey">Camarote<span class="right">R$ 100</span></li>
                        </ul>

                        <h5 class="light">Novos Valores</h5>

                        <ul class="collapsible" data-collapsible="accordion">
                            <li>
                                <div class="collapsible-header">Geral</div>
                                <div class="collapsible-body">
                                    <input class="right" id="first_name2" type="number">
                                </div>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </main>
        <footer>

        </footer>
    </body>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.collapsible').collapsible();
        });
    </script>
</html>