<?php

// Require
require_once(__DIR__ . "/phpmailer/PHPMailerAutoload.php");
require_once(__DIR__ . "/../../config.php");

/**
 * Enviar Email
 */
function enviarEmail($de, $deNome, $para, $paraNome, $assunto, $msg) {
    global $email_smtp;
    global $email_type;
    global $email_port;
    global $email_password;
    $mail = new PHPMailer(true);
    $mail->IsSMTP();
    try {
        $mail->Host = $email_smtp;
        $mail->SMTPAuth = true;
        $mail->Password = $email_password;
        $mail->SMTPSecure = $email_type;
        $mail->Port = $email_port;
        $mail->Username = $de;
        $mail->CharSet = "UTF-8";
        $mail->SetFrom($de, $deNome);
        $mail->AddReplyTo($de, $deNome);
        $mail->Subject = $assunto;
        $mail->AddAddress($para, $paraNome);
        $mail->MsgHTML($msg);
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->Send();

        // Outras opções
        //$mail->Password = base64_decode('dmluaWNpdXM1');
        //$mail->AddAddress('vinicius.reif@senior.com.br', 'Testes');
        //$mail->AddAddress('bruno.souza@senior.com.br', 'Testes');
        //$mail->AddCC('destinarario@dominio.com.br', 'Destinatario');
        //$mail->AddBCC('bruno.souza@senior.com.br', 'bruno.souza@senior.com.br');
        //$mail->AddBCC('vinicius.reif@senior.com.br', 'vinicius.reif@senior.com.br');
        //$mail->AddBCC('bruno.souza@senior.com.br', 'Bruno');
        //$mail->AddAttachment('images/phpmailer.gif');
        //$mail->MsgHTML(file_get_contents('passion/template.html'));
        // Retorno
        return "success";
    } catch (phpmailerException $e) {
        echo $e->errorMessage();
        return $e;
    }
}

/**
 * Enviar Email sem remetente
 */
function enviarEmailPadrao($para, $paraNome, $assunto, $msg) {
    global $email_smtp;
    global $email_type;
    global $email_port;
    global $email_de;
    global $email_de_nome;
    global $email_password;
    $mail = new PHPMailer(true);
    $mail->IsSMTP();

    try {
        $mail->Host = $email_smtp;
        $mail->SMTPAuth = true;
        $mail->Password = $email_password;
        $mail->SMTPSecure = $email_type;
        $mail->Port = $email_port;
        $mail->Username = $email_de;
        $mail->CharSet = "UTF-8";
        $mail->SetFrom($email_de, $email_de_nome);
        $mail->AddReplyTo($email_de, $email_de_nome);
        $mail->Subject = $assunto;
        $mail->AddAddress($para, $paraNome);
        $mail->MsgHTML($msg);
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->Send();

        // Retorno
        return "success";
    } catch (phpmailerException $e) {
        echo $e->errorMessage();
        return $e;
    }
}

/**
 * Enviar e-mail de validação de cadastro
 * @global type $site_url
 * @param type $nome
 * @param type $email
 * @param type $token
 */
function enviarEmailValidarCadastro($nome, $email, $token) {
    global $site_url;

    $link_para_validar_email = $site_url."/views/actions/validarUsuarioLogin.php?token=$token";
    $assunto = "Cadastro";

    $msg = file_get_contents(__DIR__.'/../../templates/NovoCadastro.html');
    $msg = str_replace('/nome_site/', "<b>QuadraWeb</b>", $msg);
    $msg = str_replace('/nome_usuario/', $nome, $msg);
    $msg = str_replace("/link_validacao/", $link_para_validar_email, $msg);
    
    enviarEmailPadrao($email, $nome, $assunto, $msg);
}

// Outras opções
//$mail->Password = base64_decode('dmluaWNpdXM1');
//$mail->AddAddress('vinicius.reif@senior.com.br', 'Testes');
//$mail->AddAddress('bruno.souza@senior.com.br', 'Testes');
//$mail->AddCC('destinarario@dominio.com.br', 'Destinatario');
//$mail->AddBCC('bruno.souza@senior.com.br', 'bruno.souza@senior.com.br');
//$mail->AddBCC('vinicius.reif@senior.com.br', 'vinicius.reif@senior.com.br');
//$mail->AddBCC('bruno.souza@senior.com.br', 'Bruno');
//$mail->AddAttachment('images/phpmailer.gif');
//$mail->MsgHTML(file_get_contents('passion/template.html'));