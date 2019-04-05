<?php
require "connection.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
ob_start();

$code = 404;
$data = null;
if(isset($_POST["send"]) && $_SERVER["REQUEST_METHOD"]  == "POST") :
    $firstLast = trim($_POST["firstLastName"]);
    $city = $_POST["cityName"];
    $username = trim($_POST["usernameName"]);
    $address = trim($_POST["address"]);
    $email = trim($_POST["emailName"]);
    $password = trim($_POST["passwordName"]);
    $passwordConfirm = trim($_POST["passwordConfirmName"]);

    $reFirstLast = "/^([A-ZŠĐČĆŽ][a-zšđčćž]{3,15})(\s[A-ZŠĐČĆŽ][a-zšđčćž]{3,20})+$/";
    $reUsername = "/^[a-zšđčćž]{4,10}[0-9]{1,4}$/";
    $rePassword =  "/^[A-ZŠĐČĆŽ][a-zšđčćž]{4,10}[0-9]{1,4}$/";
    $reAddress = "/^([A-ZŠĐČĆŽ][a-zšđčćž]{3,15})+(\s[A-ZŠĐČĆŽ][a-zšđčćž]{3,20})*(\s([0-9]{1,4}([a-z])?)|(bb))$/";

    $errors = [];

    if(!preg_match($reFirstLast,$firstLast)) :
        array_push($errors, "Ime i prezime moraju početi velikim slovom");
    endif;

    if(!preg_match($reUsername,$username)) :
        array_push($errors,"Korisničko ime mora imati mala slova, ne sme imati razmake");
    endif;

    if(!preg_match($rePassword, $password)) :
        array_push($errors, "Lozinka mora početi velikim slovom");
    endif;

    if(!preg_match($reAddress,$address)) :
        array_push($errors,"Adresa mora početi velikim slovom");
     endif;

    if($password != $passwordConfirm) :
        array_push($errors, "Lozinke se ne podudaraju");
    endif;

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)):
        array_push($errors, "Email nije u dobrom formatu");
    endif;

    if($city=="0") :
        array_push($errors, "Morate izabrati grad");
    endif;

    if($errors) :
        $code = 422;
        $data= $errors;

    else:
        $passwordHash = md5($password);
        $hashToken =  md5($username . $email . time());

        $queryMain = "INSERT INTO korisnik (imePrezime, username, password, email, adresa, token, ID_grad) VALUES(:imePrezime, :username, :pass, :email, :ulica, :token,(SELECT ID_grad FROM grad WHERE ID_grad = :grad))";

        $prepareMain = $connection->prepare($queryMain);

        $prepareMain->bindParam(":imePrezime", $firstLast);
        $prepareMain->bindParam(":username", $username);
        $prepareMain->bindParam(":pass", $passwordHash);
        $prepareMain->bindParam(":email", $email);
        $prepareMain->bindParam(":token",$hashToken);
        $prepareMain->bindParam(":grad",$city);
        $prepareMain->bindParam(":ulica",$address);


        try{

            $code =  $prepareMain->execute() ? 201 : 500;


            if($code== 201) :

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
                    $mail->setFrom('nanosoftdelux@gmail.com', 'Registracija');
                    $mail->addAddress($email);     // Add a recipient

                    //Content
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = 'Aktivirajte nalog';

                    $mail->Body= '<a href="https://nanosoftdelux.000webhostapp.com/php/verification_email.php?param='.$hashToken.'">Kliknite na ovaj link kako bi aktivirali nalog</a>';

                    $mail->send();

                } catch (Exception $e) {
                    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                }

            endif;
        }
        catch (PDOException $e) {
                  $data =  $e->getMessage();
                  $code = 409;
        }
        endif;

     endif;

http_response_code($code);


