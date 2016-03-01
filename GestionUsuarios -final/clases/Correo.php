<?php

class Correo {
    private $cliente, $origen, $destino, $alias, $asunto, $mensaje;
    
    function __construct($destino = null,  $asunto = null, $mensaje = null, $origen = null, $alias = null) {
        $this->cliente = new Google_Client();
        
        $this->cliente->setApplicationName('geo-c9');
        $this->cliente->setClientId('1029793014247-njrdbfeiqa2l1bh7pjlm79pafm00s6mh.apps.googleusercontent.com');
        $this->cliente->setClientSecret('cloYUjwEaad-oP2wodX1CDRq');
        $this->cliente->setRedirectUri('https://practica4-gmaguilar91.c9users.io/');
        $this->cliente->setScopes('https://mail.google.com/');
        $this->cliente->setAccessToken(file_get_contents('../oauth/token.conf'));
        $this->origen = $origen;
        $this->destino = $destino;
        $this->alias = $alias;
        $this->asunto = $asunto;
        $this->mensaje = $mensaje;
    }
    
    function getOrigen() {
        return $this->origen;
    }

    function getDestino() {
        return $this->destino;
    }

    function getAsunto() {
        return $this->asunto;
    }

    function getMensaje() {
        return $this->mensaje;
    }

    function setOrigen($origen) {
        $this->origen = $origen;
    }

    function setDestino($destino) {
        $this->destino = $destino;
    }

    function setAsunto($asunto) {
        $this->asunto = $asunto;
    }

    function setMensaje($mensaje) {
        $this->mensaje = $mensaje;
    }

    function send(){
        if ($this->cliente->getAccessToken()) {
            $service = new Google_Service_Gmail($this->cliente);
            try {
                $mail = new PHPMailer();
                $mail->CharSet = "UTF-8";
                $mail->From = Constants::FROM;
                $mail->FromName = Constants::ALIAS;
                $mail->AddAddress($this->destino);
                $mail->AddReplyTo(Constants::FROM, Constants::ALIAS);
                $mail->Subject = $this->asunto;
                $mail->Body = $this->mensaje;
                $mail->preSend();
                $mime = $mail->getSentMIMEMessage();
                $mime = rtrim(strtr(base64_encode($mime), '+/', '-_'), '=');
                $mensaje = new Google_Service_Gmail_Message();
                $mensaje->setRaw($mime);
                $service->users_messages->send('me', $mensaje);
                $r = 1;
            } catch (Exception $e) {
                print($e->getMessage());
                $r = 0;
            }
        }else{
             $r = -1;
        }
        return $r;
    }

}

?>