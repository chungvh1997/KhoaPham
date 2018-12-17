<?php 
	require 'src/PHPMailer.php';
	
	function sendMail($email,$name,$subject,$cotent){
		$mail = new PHPMailer(true);
		try {
	    //Server settings
		$mail->CharSet = "UTF-8";
	    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
	    $mail->isSMTP();                                      // Set mailer to use SMTP
	    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
	    $mail->SMTPAuth = true;                               // Enable SMTP authentication
	    $mail->Username = 'chungvh1992@gmail.com';                 // SMTP username
	    $mail->Password = '2041997z';                           // SMTP password
	    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted port 465
	    $mail->Port = 587;                                    // TCP port to connect to

	    //Recipients
	    $mail->setFrom('chungvh1992@gmail.com', 'Test Mailer');
	    $mail->addAddress('chungvh1993@gmail.com', 'Chung Vu');     // Add a recipient
	    // $mail->addAddress('ellen@example.com');               // Name is optional
	    $mail->addReplyTo('chungvh1992@gmail.com', 'Test Mailer');
	    // $mail->addCC('cc@example.com');
	    // $mail->addBCC('bcc@example.com');

	    //Attachments
	    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

	    //Content
	    $mail->isHTML(true);                                  // Set email format to HTML
	    $mail->Subject = 'Đặt hàng thành công - Xác nhận đơn hàng';
	    $mail->Body    = '
		<p> Don Hang SP03-Ao Thun </p>
		<p>vui lòng nhập vào <a href="http://localhost/SHOP2408/index.php">đây </a></p>
		<p> Thanks you! </p>
	    ';
	    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	    $mail->send();
	    echo 'Message has been sent';
		} catch (Exception $e) {
		    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
		}

	}
	

 ?>