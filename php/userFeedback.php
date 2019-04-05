<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$code = 404;
$data = null;
if(isset($_POST["btn"]) && $_SERVER["REQUEST_METHOD"]  == "POST") :

    $first = trim($_POST["ime"]);
    $last = trim($_POST["prezime"]);
    $email = trim($_POST["email"]);
    $content = ($_POST["content"]);

    $reFirstLast = "/^[A-ZŠĐČĆŽa-zšđžčć\s]{2,25}$/";
    $errors = [];

    if(!preg_match($reFirstLast,$first)) :
        array_push($errors, "Ime nije u dobrom formatu");
    endif;

    if(!preg_match($reFirstLast,$last)) :
        array_push($errors,"Prezime nije u dobrom formatu");
    endif;

    if(strlen($content) < 10):
        array_push($errors, "Lozinka mora početi velikim slovom");
    endif;

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)):
        array_push($errors, "Email nije u dobrom formatu");
    endif;

    if($errors):
        $code = 422;
        $data= $errors;

    else:
        $code= 200;

                $mail = new PHPMailer(true);
                try {
                    //Server settings
                    // $mail->SMTPDebug = 2;                                 // Enable verbose debug output
                    $mail->isSMTP();                                      // Set mailer to use SMTP
                    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers

                    $mail->SMTPAuth = true;
                    $mail->SMTPSecure = true;
                    // Enable SMTP authentication
                    $mail->Username = 'nanosoftdelux@gmail.com';                 // SMTP username
                    $mail->Password = '$dusan1995$';                           // SMTP password
                    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                    $mail->Port = 587;                                 // TCP port to connect to

                    $mail->SMTPOptions = array(
                        'ssl' => array(
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                            'allow_self_signed' => true
                        )
                    );
                    //Recipients
                    $mail->setFrom('nanosoftdelux@gmail.com', 'Pitanje');
                    $mail->addAddress("nanosoftdeluxpremium@gmail.com");     // Add a recipient

                    //Content
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = 'Pitanje';

                    $mail->Body= "$first $last <br/> $email<br/>$content";

                    $mail->send();

                } catch (Exception $e) {
                    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                }

            endif;

endif;
http_response_code($code);
