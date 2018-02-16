<?php
$menu = basename($_SERVER['PHP_SELF'], '.php');
?>
<link href="../css/custom.css" rel="stylesheet">

<!-- Nav -->
<nav class="nav-wrapper green darken-2 font-raleway">
    <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>

    <ul class="hide-on-small-only" style="margin-left: 20px">
        <li id="home"><a class="tooltipped" href="home.php" data-position="bottom" data-delay="50" data-tooltip="Home"><i class="material-icons" style="height: 100%">home</i></a></li>
        <li id="jogadores"><a class="tooltipped" href="jogadores.php" data-position="bottom" data-delay="50" data-tooltip="Jogadores"><i class="material-icons" style="height: 100%">people_outline</i></a></li>
        <li id="jogos"><a class="tooltipped" href="jogos.php" data-position="bottom" data-delay="50" data-tooltip="Jogos"><i class="material-icons" style="height: 100%">flag</i></a></li>
        <li id="treino"><a class="tooltipped" href="treino.php" data-position="bottom" data-delay="50" data-tooltip="Treino"><i class="material-icons" style="height: 100%">fitness_center</i></a></li>
        <li id="departamentoMedico"><a class="tooltipped" href="departamentoMedico.php" data-position="bottom" data-delay="50" data-tooltip="Departamento Médico"><i class="material-icons" style="height: 100%">healing</i></a></li>
        <li id="estadio"><a class="tooltipped" href="estadio.php" data-position="bottom" data-delay="50" data-tooltip="Estadio"><i class="material-icons" style="height: 100%">local_play</i></a></li>
        <li id="mercado"><a class="tooltipped" href="mercado.php" data-position="bottom" data-delay="50" data-tooltip="Mercado"><i class="material-icons" style="height: 100%">import_export</i></a></li>
        <li id="historicoTransferencia"><a class="tooltipped" href="historicoTransferencia.php" data-position="bottom" data-delay="50" data-tooltip="Histórico de Transferência"><i class="material-icons" style="height: 100%">history</i></a></li>
        <li id="auxiliares"><a class="tooltipped" href="auxiliares.php" data-position="bottom" data-delay="50" data-tooltip="Auxiliares"><i class="material-icons" style="height: 100%">portrait</i></a></li>
        <li id="torcida"><a class="tooltipped" href="torcida.php" data-position="bottom" data-delay="50" data-tooltip="Torcida"><i class="material-icons" style="height: 100%">recent_actors</i></a></li>
        <li id="marketing"><a class="tooltipped" href="marketing.php" data-position="bottom" data-delay="50" data-tooltip="Marketing"><i class="material-icons" style="height: 100%">stars</i></a></li>
        <li id="caixa"><a class="tooltipped" href="caixa.php" data-position="bottom" data-delay="50" data-tooltip="Caixa"><i class="material-icons" style="height: 100%">timeline</i></a></li>
        <li id="pesquisar"><a class="tooltipped" href="pesquisar.php" data-position="bottom" data-delay="50" data-tooltip="Pesquisar"><i class="material-icons" style="height: 100%">find_replace</i></a></li>
    </ul>


    <!-- SidNav -->
    <ul id="slide-out" class="side-nav fixed">        
        <li>
            <div class="user-view">
                <span class="green-text text-darken-4 name center">
                    <b>Teste</b>
                </span>
            </div>        
        </li>

        <!-- Opções -->
        <li><div class="divider"></div></li>
        <a class="subheader">Meu Time</a>
        <li id="home2" class=''><a class='waves-effect' href='home.php'><i class='material-icons'>home</i>Home</a></li>
        <li id="jogadores2" class=''><a class='waves-effect' href='jogadores.php'><i class='material-icons'>people_outline</i>Jogadores</a></li>
        <li id="jogos2" class=''><a class='waves-effect' href='jogos.php'><i class='material-icons'>flag</i>Jogos</a></li>
        <li id="treino2" class=''><a class='waves-effect' href='treino.php'><i class='material-icons'>fitness_center</i>Treino</a></li>
        <li id="departamentoMedico2" class=''><a class='waves-effect' href='departamentoMedico.php'><i class='material-icons'>healing</i>Departamento Médico</a></li>
        <li id="estadio2" class=''><a class='waves-effect' href='estadio.php'><i class='material-icons'>local_play</i>Estádio</a></li>
        <a class="subheader">Transferência</a>
        <li id="mercado2" class=''><a class='waves-effect' href='mercado.php'><i class='material-icons'>import_export</i>Mercado</a></li>
        <li id="historicoTransferencia2" class=''><a class='waves-effect' href='historicoTransferencia.php'><i class='material-icons'>history</i>Histórico Transferência</a></li>
        <a class="subheader">Administração</a>
        <li id="auxiliares2" class=''><a class='waves-effect' href='auxiliares.php'><i class='material-icons'>portrait</i>Auxiliares</a></li>
        <li id="torcida2" class=''><a class='waves-effect' href='torcida.php'><i class='material-icons'>recent_actors</i>Torcida</a></li>        
        <li id="marketing2" class=''><a class='waves-effect' href='marketing.php'><i class='material-icons'>stars</i>Marketing</a></li>        
        <li id="caixa2" class=''><a class='waves-effect' href='caixa.php'><i class='material-icons'>timeline</i>Caixa</a></li>
        <li id="pesquisar2" class=''><a class='waves-effect' href='pesquisar.php'><i class='material-icons'>find_replace</i>Procurar Times</a></li>
        <li id="informacoesUsuario2" class=''><a href="informacoesUsuario.php"><i class="material-icons">account_circle</i>Informações do Usuário</a></li>
        <li><div class="divider"></div></li>
        <li><a class="waves-effect" href="encerrarSessao.php"><i class="material-icons">power_settings_new</i>Sair</a></li>
    </ul>
</nav>

<script>
    $(document).ready(function () {
        $('.tooltipped').tooltip({delay: 50});
        $('#<?= $menu ?>').addClass("active");
        $('#<?= $menu ?>2').addClass("active");
    });
</script>
