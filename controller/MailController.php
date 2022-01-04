<?php
$connect = new PDO("mysql:host=localhost;dbname=gallery", "root", "");
$received_data = json_decode(file_get_contents("php://input"));

require('../includes/PHPMailer.php');
require('../includes/Exception.php');
require('../includes/SMTP.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
//SEND MAIL
$data = "";
if ($received_data->action == 'sendMail') {
    //get data
    $name = $received_data->name;
    $email = $received_data->email;
    $subject = $received_data->subject;
    $content = $received_data->content;

    /// send mail
    mb_language('uni');
    mb_internal_encoding('UTF-8');

    // インスタンスを生成（true指定で例外を有効化）
    $mail = new PHPMailer(true);

    // 文字エンコードを指定
    $mail->CharSet = 'utf-8';

    try {
        // デバッグ設定
        // $mail->SMTPDebug = 2; // デバッグ出力を有効化（レベルを指定）
        // $mail->Debugoutput = function($str, $level) {echo "debug level $level; message: $str<br>";};

        // SMTPサーバの設定
        $mail->isSMTP();                          // SMTPの使用宣言
        $mail->Host       = 'smtp.gmail.com';   // SMTPサーバーを指定
        $mail->SMTPAuth   = true;                 // SMTP authenticationを有効化
        $mail->Username   = 'testmailer0110@gmail.com';   // SMTPサーバーのユーザ名
        $mail->Password   = 'testmail6';           // SMTPサーバーのパスワード
        $mail->SMTPSecure = 'tls';  // 暗号化を有効（tls or ssl）無効の場合はfalse
        $mail->Port       = 587; // TCPポートを指定（tlsの場合は465や587）

        // 送受信先設定（第二引数は省略可）
        $mail->setFrom('testmailer0110@gmail.com', $name); // 送信者
        $mail->addAddress('testmemorymail@gmail.com', 'ギャラリー游お問い合わせシステム');   // 宛先
        $mail->addReplyTo($email, $name); // 返信先
        //   $mail->addCC('testmailer0110@gmail.com', '受信者名'); // CC宛先
        $mail->Sender = $email; // Return-path

        // 送信内容設定
        $mail->Subject = $subject;
        $mail->Body = $name;
        $mail->Body .= "様からギャラリー游Webシステムの問い合わせが来ています！\n\n";
        $mail->Body .= $content;
        // 送信
        if ($mail->send()) {
            $data = "送信しました！";
            echo json_encode($data);
        }
    } catch (Exception $e) {
        // エラーの場合
        echo "送信失敗しました.... Mailer Error: {$mail->ErrorInfo}";
    }
}

if ($received_data->action == 'memoryMail') {
    //get data
    $name = $received_data->name;
    $email = $received_data->email;
    $password = $received_data->password;
    $subject = $received_data->subject;
    $content = $received_data->content;

    /// send mail
    mb_language('uni');
    mb_internal_encoding('UTF-8');

    // インスタンスを生成（true指定で例外を有効化）
    $mail = new PHPMailer(true);

    // 文字エンコードを指定
    $mail->CharSet = 'utf-8';

    try {
        // デバッグ設定
        // $mail->SMTPDebug = 2; // デバッグ出力を有効化（レベルを指定）
        // $mail->Debugoutput = function($str, $level) {echo "debug level $level; message: $str<br>";};

        // SMTPサーバの設定
        $mail->isSMTP();                          // SMTPの使用宣言
        $mail->Host       = 'smtp.gmail.com';   // SMTPサーバーを指定
        $mail->SMTPAuth   = true;                 // SMTP authenticationを有効化
        $mail->Username   = 'testmailer0110@gmail.com';   // SMTPサーバーのユーザ名
        $mail->Password   = 'testmail6';           // SMTPサーバーのパスワード
        $mail->SMTPSecure = 'tls';  // 暗号化を有効（tls or ssl）無効の場合はfalse
        $mail->Port       = 587; // TCPポートを指定（tlsの場合は465や587）

        // 送受信先設定（第二引数は省略可）
        $mail->setFrom('testmailer0110@gmail.com', 'ギャラリー游'); // 送信者
        $mail->addAddress($email, $name);   // 宛先
        // $mail->addReplyTo($email, $name); // 返信先
        // $mail->addCC('testmailer0110@gmail.com', '受信者名'); // CC宛先
        $mail->Sender = $email; // Return-path

        // 送信内容設定
        $mail->Subject = $subject;
        $mail->Body = "お問い合わせありがとうございました！\n以下の内容で問い合わせております。返事はメールにて返事させていただきます\n\n";
        $mail->Body    .= $content;
        // 送信
        if ($mail->send()) {
            // $data = "送信しました！";
            // echo json_encode($data);
        }
    } catch (Exception $e) {
        // エラーの場合
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
