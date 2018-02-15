<?php
/**
 * Adaptação de status para as páginas html
 */
$status = isset($_GET["status"])?addslashes($_GET["status"]):-1;
$msgs = array();
$msgs[1] = "Faça seu Login";
$msgs[2] = "Usuário Cadastrado";
$msgs[3] = "Email informado já está cadastrado";
$msgs[4] = "Login/Senha inválidos";
$msgs[5] = "Selecione uma Quadra"; 
$msgs[6] = "Senhas não conferem";
$msgs[7] = "Email informado já existe";
$msgs[8] = "Email enviado com sucesso";
$msgs[9] = "Email informado não existe";
$msgs[10] = "Quantidade máxima de imagens foi atingida. Consulte seu plano.";
$msgs[11] = "Quantidade máxima de campos foi atingida. Consulte seu plano.";
$msgs[12] = "Quantidade máxima de quadras foi atingida. Consulte seu plano.";
$msgs[13] = "Informe Cidade/Estado";
$msgs[14] = "Email validado com sucesso! Faça seu login.";
$msgs[15] = "Ocorreu um erro ao realizar cadastro. Tente novamente mais tarde.";
$msgs[16] = "Foi enviado um e-mail de validação para sua caixa de e-mail";
$msgs[17] = "Pagamento(s) gerado(s)!";
$msgs[18] = "Link modificado com sucesso";
$msgs[19] = "Senha alterada com sucesso";
$msgs[20] = "Link expirado";
$msgs[21] = "Campo Inválido";
$msgs[22] = "";

if($status != -1){
    echo("<script>Materialize.toast('$msgs[$status]',4000);</script>");
}