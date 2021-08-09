<?php
namespace php\services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

 include('PHPMailer/src/Exception.php');
 include('PHPMailer/src/PHPMailer.php');
 include('PHPMailer/src/SMTP.php');

class ModeloEnvMail
{

    static public function mdlEnviaMail()
    {

        $para = "jatpia12@gmail.com";
        $asunto = utf8_decode('Consultores Tyren de México S.C. | Reporte Incidencia Signos Vitales');
        

        $mail = new PHPMailer;

        
            //Server settings
            $mail->SMTPDebug = 0;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'mail.google.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'jorge.tapia@tyren.org';                     // SMTP username
            $mail->Password   = '12qwasZX.';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('contingencia@tyren.org', 'Reporte de Signos Vitales');
            $mail->addAddress($para, $nomM);     // Add a recipient

            // Content
            $mail->isHTML(true);                                  
            $mail->Subject = $asunto;
            $mail->Body    = "<b>Reporte de Incidencia Signos Vitales<b>
                                    <br>
                                    <table>
                                        <thead>
                                            <tr>
                                                <td>Fecha/Hora</td>
                                                <td>Usuario</td>
                                                <td>Temperatura</td>
                                                <td>Ritmo Cardiaco</td>
                                                <td>Oxigenación</td>
                                                <td>Nivel</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>2021/08/09 - 08:47:89</td>
                                                <td>Jorge Augusto Tapia</td>
                                                <td>37.7</td>
                                                <td>66</td>
                                                <td>96</td>
                                                <td>Normal</td>
                                            </tr>
                                        </tbody>
                                    </table>";
           

            $mail->send();

            


    }
}
