<?php
require("requires/validarSessao.php");

$status = -1;
if (isset($_GET['status'])) {
    $status = addslashes($_GET['status']);
}

if ($_SESSION['admin'] == 1) {
// SELECT QUANTIDADE DE VISUALIZAÇÕES DA QUADRA
    $diaAtual = date('d', time());
    $mesAtual = date('m', time());
    $semanaAtual = ($diaAtual - 7);

    $sql_visualizacoes_dia = "SELECT COUNT(*) as qtd_visualizacoes_dia FROM visualizacao WHERE id_quadra = $_SESSION[id_quadra] AND day(data_visualizacao) = $diaAtual";
    $sql_visualizacoes_semana = "SELECT COUNT(*) as qtd_visualizacoes_semana FROM visualizacao WHERE id_quadra = $_SESSION[id_quadra] AND day(data_visualizacao) between $semanaAtual AND $diaAtual";
    $sql_visualizacoes_mes = "SELECT COUNT(*) as qtd_visualizacoes_mes FROM visualizacao WHERE id_quadra = $_SESSION[id_quadra] AND month(data_visualizacao) = $mesAtual";
    $rs_visualizacoes_dia = mysqli_query($link, $sql_visualizacoes_dia);
    $rs_visualizacoes_semana = mysqli_query($link, $sql_visualizacoes_semana);
    $rs_visualizacoes_mes = mysqli_query($link, $sql_visualizacoes_mes);
    $row_visualizacoes_dia = mysqli_fetch_assoc($rs_visualizacoes_dia);
    $row_visualizacoes_semana = mysqli_fetch_assoc($rs_visualizacoes_semana);
    $row_visualizacoes_mes = mysqli_fetch_assoc($rs_visualizacoes_mes);
    $qtd_visualizacoes_dia = $row_visualizacoes_dia['qtd_visualizacoes_dia'];
    $qtd_visualizacoes_semana = $row_visualizacoes_semana['qtd_visualizacoes_semana'];
    $qtd_visualizacoes_mes = $row_visualizacoes_mes['qtd_visualizacoes_mes'];

    $id_usuario = $_SESSION['id'];
    $sql_pagamentos = "
    SELECT p.*, 
           p.id_status as status_pagamento,
           sp.nome AS status_nome,
           u.link_pagamento
    FROM   pagamentos p, 
           status_pagamento sp,
           usuario u
    WHERE  u.id = $id_usuario
           AND p.id_usuario = u.id
           AND p.ativo = 1
           AND sp.id = p.id_status
           AND sp.id = 0
    ORDER  BY p.data_criacao DESC ";
    $rs_pagamentos = mysqli_query($link, $sql_pagamentos);
}

// SELECT SITUAÇÕES DAS RESERVAS
if ($_SESSION['admin'] == 0) {
    $sql_situacoes_reservas = "SELECT COUNT(r.situacao)as qtd_situacao, r.situacao FROM reserva r WHERE id_usuario = $_SESSION[id] group by situacao;";
} else {
    $sql_situacoes_reservas = "SELECT COUNT(r.situacao)as qtd_situacao, r.situacao FROM reserva r, campo c, quadra q where r.id_campo = c.id AND q.id = c.id_quadra AND q.id = $_SESSION[id_quadra] group by situacao";
}

$rs_situacoes_reservas = mysqli_query($link, $sql_situacoes_reservas);

$qtd_pendentes = 0;
$qtd_aprovadas = 0;
$qtd_rejeitadas = 0;
$qtd_canceladas = 0;

while ($row_situacoes_reservas = mysqli_fetch_assoc($rs_situacoes_reservas)) {

    switch ($row_situacoes_reservas['situacao']) {
        case 1:
            $qtd_pendentes = $row_situacoes_reservas['qtd_situacao'];
            break;
        case 2:
            $qtd_aprovadas = $row_situacoes_reservas['qtd_situacao'];
            break;
        case 3:
            $qtd_rejeitadas = $row_situacoes_reservas['qtd_situacao'];
            break;
        case 4:
            $qtd_canceladas = $row_situacoes_reservas['qtd_situacao'];
            break;

        default:
            break;
    }
}

// Próxima Reserva
$sql_reservas_prox = "
    select
        r.id, r.id_campo, r.data_reserva, r.horario, r.data_cancelamento, r.data_confirmacao, r.situacao, c.id as id_campo, c.nome as nome_campo, q.id as id_quadra, q.nome_local as nome_quadra
    from
        reserva r, campo c, usuario u, quadra q
    where
        r.id_campo = c.id
        and r.id_usuario = u.id
        and r.id_usuario = u.id
        and c.id_quadra = q.id
        and r.ativo = 1 
        and r.horario >= NOW() 
        and r.id_usuario = $_SESSION[id]
    order by r.horario asc limit 1";

$rs_reservas_prox = mysqli_query($link, $sql_reservas_prox);
?>

<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Game | Home</title>
        <?php require("requires/links.php"); ?>
        <?php require("requires/imports.php"); ?>
        <link href="../css/custom.css" rel="stylesheet">
        <link href="../css/site-geral.css" rel="stylesheet">
        <link href="../css/sidenav-adapter.css" rel="stylesheet">
    </head>

    <body>
        <header>
            <?php $_SESSION['admin'] == 0 ? require("requires/navbar.php") : require("requires/navbar-adm.php"); ?>
        </header>
        <main>
            <div class="container">
                <div class="row">
                    <div class="col s12 m12 l12">
                        <br>
                        <?php
                        if ($_SESSION['admin'] == 0) {
                            ?>                            
                            <h5 class="light">Próxima Reserva</h5>
                            <hr>
                            <?php if (mysqli_num_rows($rs_reservas_prox) == 0) { ?>
                                <div class="card grey lighten-2 z-depth-0">
                                    <div class="card-content">
                                        <p class="center">
                                            Não perca tempo. <a href="addReserva.php" class="underline orange-text text-darken-2"><b>Clique aqui</b></a> para fazer sua próxima reserva.
                                        </p>
                                    </div>                                    
                                </div>
                                <br>
                                <?php
                            } else {
                                $row = mysqli_fetch_assoc($rs_reservas_prox);
                                $icon = "";
                                $color = "";
                                if ($row["situacao"] == 1) {
                                    $icon = "schedule";
                                    $color = "blue";
                                } else if ($row["situacao"] == 2) {
                                    $icon = "check_circle";
                                    $color = "green";
                                } else if ($row["situacao"] == 3) {
                                    $icon = "block";
                                    $color = "red darken-2";
                                } else if ($row["situacao"] == 4) {
                                    $icon = "cancel";
                                    $color = "amber darken-2";
                                }
                                ?>
                                <div class="margin-bottom-8">
                                    <div class="z-depth-1 <?= $color ?> style-situacoes">
                                        <i class="material-icons right white-text medium icon-vertical-align-middle"><?= $icon ?></i>
                                        <span class="white-text"><b>Código: </b>&nbsp;&nbsp;&nbsp;<a class="underline white-text" href="detalheReserva.php?id=<?= $row["id"] ?>">#<?= $row["id"] ?></a></span>
                                        <br><span class="white-text"><b>Data: </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= date('d/m/Y', strtotime($row["data_reserva"])) ?> </span>
                                        <br><span class="white-text"><b>Horário: </b>&nbsp;&nbsp;<?= date('H:i', strtotime($row["horario"])) ?> </span>
                                        <br><span class="white-text"><b>Quadra: </b>&nbsp;&nbsp;<a class="underline white-text" href="detalheQuadra.php?id=<?= $row["id_quadra"] ?>"><?= $row["nome_quadra"] ?></a> </span>
                                        <br><span class="white-text"><b>Campo: </b>&nbsp;&nbsp;<a class="underline white-text" href="detalheCampo.php?id=<?= $row["id_campo"] ?>"><?= $row["nome_campo"] ?></a></span>
                                    </div>
                                    <br>
                                </div>                                
                                <?php
                            }
                        }
                        ?>         
                        <h5 class="light">                            
                            Reservas
                            <a href="<?= $_SESSION['admin'] == 0 ? 'minhasReservas.php' : 'reservas.php' ?>">
                                <i class="material-icons icon-vertical-align-middle right">open_in_new</i>
                            </a>
                        </h5>
                        <hr>
                    </div>                    
                    <div class="col s12 m6 l6 shadow margin-bottom-8">
                        <?php
                        if ($_SESSION['admin'] == 0) {
                            ?>
                            <a href="minhasReservas.php?data=&situacao=1">
                                <div class="z-depth-1 style-situacoes">
                                    <span class="blue-text font-size-18"><i class="material-icons blue-text medium icon-vertical-align-middle">schedule</i> <?= $qtd_pendentes ?> Pendentes</span>
                                </div>
                            </a>
                            <?php
                        } else {
                            ?>
                            <a href="reservas.php">
                                <div class="z-depth-1 style-situacoes">
                                    <span class="blue-text font-size-18"><i class="material-icons blue-text medium icon-vertical-align-middle">schedule</i> <?= $qtd_pendentes ?> Pendentes</span>
                                </div>
                            </a>
                            <?php
                        }
                        ?>

                    </div>
                    <div class="col s12 m6 l6 shadow margin-bottom-8">
                        <?php
                        if ($_SESSION['admin'] == 0) {
                            ?>
                            <a href="minhasReservas.php?data=&situacao=2">
                                <div class="z-depth-1 style-situacoes">
                                    <span class="green-text font-size-18"><i class="material-icons green-text medium icon-vertical-align-middle">check_circle</i> <?= $qtd_aprovadas ?> Aprovadas</span>
                                </div>
                            </a>
                            <?php
                        } else {
                            ?>
                            <a href="reservas.php">
                                <div class="z-depth-1 style-situacoes">
                                    <span class="green-text font-size-18"><i class="material-icons green-text medium icon-vertical-align-middle">check_circle</i> <?= $qtd_aprovadas ?> Aprovadas</span>
                                </div>
                            </a>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="col s12 m6 l6 shadow margin-bottom-8">
                        <?php
                        if ($_SESSION['admin'] == 0) {
                            ?>
                            <a href="minhasReservas.php?data=&situacao=3">
                                <div class="z-depth-1 style-situacoes">
                                    <span class="red-text text-darken-2 font-size-18"><i class="material-icons red-text text-darken-2  medium icon-vertical-align-middle">block</i> <?= $qtd_rejeitadas ?> Rejeitadas</span>
                                </div>
                            </a>
                            <?php
                        } else {
                            ?>
                            <a href="reservas.php">
                                <div class="z-depth-1 style-situacoes">
                                    <span class="red-text text-darken-2 font-size-18"><i class="material-icons red-text text-darken-2 medium icon-vertical-align-middle">block</i> <?= $qtd_rejeitadas ?> Rejeitadas</span>
                                </div>
                            </a>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="col s12 m6 l6 shadow margin-bottom-8">

                        <?php
                        if ($_SESSION['admin'] == 0) {
                            ?>
                            <a href="minhasReservas.php?data=&situacao=4">
                                <div class="z-depth-1 style-situacoes">
                                    <span class="amber-text font-size-18"><i class="material-icons amber-text medium icon-vertical-align-middle">cancel</i> <?= $qtd_canceladas ?> Canceladas</span>
                                </div>
                            </a>
                            <?php
                        } else {
                            ?>
                            <a href="reservas.php">
                                <div class="z-depth-1 style-situacoes">
                                    <span class="amber-text font-size-18"><i class="material-icons amber-text medium icon-vertical-align-middle">cancel</i> <?= $qtd_canceladas ?> Canceladas</span>
                                </div>
                            </a>
                            <?php
                        }
                        ?>
                    </div>

                    <?php
                    if ($_SESSION['admin'] == 1) {
                        ?>
                        <div class="col s12 m12 l12">
                            <br>
                            <h5 class="light">
                                Gerencial
                                <a href="gerencial.php" class="right">
                                    <i class="material-icons icon-vertical-align-middle right">open_in_new</i>
                                </a>
                            </h5>
                            <hr>

                            <div class="card">
                                <div class="card-content center">
                                    <i class="material-icons left icon-vertical-align-middle">visibility</i>
                                    <h6>Sua quadra teve <?= $qtd_visualizacoes_dia ?><?= $qtd_visualizacoes_dia > 1 ? ' visualizações ' : ' visualização ' ?>hoje</h6>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-content center">
                                    <i class="material-icons left icon-vertical-align-middle">visibility</i>
                                    <h6>Sua quadra teve <?= $qtd_visualizacoes_semana ?><?= $qtd_visualizacoes_semana > 1 ? ' visualizações ' : ' visualização ' ?>na última semana</h6>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-content center">
                                    <i class="material-icons left icon-vertical-align-middle">visibility</i>
                                    <h6>Sua quadra teve <?= $qtd_visualizacoes_mes ?><?= $qtd_visualizacoes_mes > 1 ? ' visualizações ' : ' visualização ' ?>esse mês</h6>
                                </div>
                            </div>
                            <br>
                            <h5 class="light">
                                Pagamentos pendentes
                                <a href="pagamentosAdm.php" class="right">
                                    <i class="material-icons icon-vertical-align-middle right">open_in_new</i>
                                </a>
                            </h5>
                            <hr>
                            <?php
                            if (mysqli_num_rows($rs_pagamentos) == 0) {
                                ?>
                                <div class="card grey lighten-2 z-depth-0">
                                    <div class="card-content ">
                                        <p class="center">
                                            Você não possui nenhum pagamento pendente.
                                        </p>
                                    </div>                                    
                                </div> 
                            <?php } else { ?>
                                <table class = "striped small-table">
                                    <thead>
                                        <tr class = "grey lighten-2">
                                            <th>Data</th>
                                            <th>Data do pagamento</th>
                                            <th>Valor R$</th>
                                            <th>Status</th>
                                            <th>Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($row_pagamentos = mysqli_fetch_assoc($rs_pagamentos)) {
                                            $dataPagamento = $row_pagamentos["data_pagamento"];
                                            if ($dataPagamento != null) {
                                                $dataPagamento = date("d/m/Y H:i", strtotime($row_pagamentos["data_pagamento"]));
                                            } else {
                                                $dataPagamento = "-";
                                            }
                                            // Obter icone e cor
                                            $color = "";
                                            $icon = "";
                                            switch ($row_pagamentos["id_status"]) {
                                                case 0:
                                                    $icon = "schedule";
                                                    $color = "blue-text";
                                                    break;
                                                case 1:
                                                    $icon = "check_circle";
                                                    $color = "green-text";
                                                    break;
                                                case 2:
                                                    $icon = "cancel";
                                                    $color = "red-text";
                                                    break;
                                            }
                                            ?>
                                            <tr>
                                                <td><?= date("d/m/Y H:i", strtotime($row_pagamentos["data_criacao"])) ?></td>
                                                <td><?= $dataPagamento ?></td>
                                                <td>R$ <?= number_format($row_pagamentos["valor"], 2) ?></td>
                                                <td><i class="material-icons cursor-default <?= $color ?> tooltipped" data-position="right" data-tooltip="<?= $row_pagamentos["status_nome"] ?>"><?= $icon ?></i></td>
                                                <?php
                                                if ($row_pagamentos["status_pagamento"] == 0) {
                                                    ?><td class="center"><a href="<?= $row_pagamentos["link_pagamento"] ?>" class="green-text cursor-pointer">Pagar</a></td><?php
                                                    } else {
                                                        ?><td class="center"><span class="grey-text cursor-default">Pago</span></td><?php
                                                }
                                                ?>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <br>
                            <br>
                            <br>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <?php require("./requires/footer.php"); ?>
    </footer>
</body>
<script>
    $(document).ready(() => {
        setIntervalNotifications();
    });

</script>
</html>