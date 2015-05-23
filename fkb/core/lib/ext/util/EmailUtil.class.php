<?php
/* 
// 以QQ邮箱为例子，要先开通SMTP/POP3功能
$smtp = "smtp.qq.com"; // SMTP邮件发送服务器
$title = "标题"; // 邮件标题
//$username = "qq邮箱帐户"; // SMTP用户名
$username = "540748069@qq.com"; // SMTP用户名
//$passwd = "邮箱密码"; // SMTP密码
$passwd = "pwd"; // SMTP密码
// $mailfrom = "qq邮箱帐户下的地址，也就是自己的QQqq邮箱地址，不能填别人的"; // 发送人
$mailfrom = "540748069@qq.com"; // 发送人
$mailfrom1 = "540748069@qq.com"; // 回复邮件人
$rcptto = "1003860660@qq.com"; // 收件人
$mail = "邮件内容bbbbbb"; // 邮件正文

EmailUtil::smail ( $smtp, $title, $username, $passwd, $mailfrom, $mailfrom1, $rcptto, $mail );
 */
class EmailUtil {
	static function smail($smtp, $title, $username, $passwd, $mailfrom, $mailfrom1, $rcptto, $mail, &$tips) {
		$message = "";
		$message .= "正在连接服务器...<br>";
		$link = fsockopen ( $smtp, 25 );
		if ($link) {
			set_socket_blocking ( $link, true );
			$lastmessage = fgets ( $link, 512 );
	
			if (! ereg ( "^220", $lastmessage )) {
				$message .= "与服务器连接失败" . $lastmessage . "<br>";
			} else {
				$message .= "与服务器连接成功,服务器就绪：" . $lastmessage . "<br>";
					
				fputs ( $link, "HELO phpsetmail" . "\r\n" );
				$lastmessage = fgets ( $link, 2000 );
				if (ereg ( "^250", $lastmessage )) {
					$message .= "与服务器HELO成功：" . $lastmessage . "<br>";
				} else {
					$message .= "与服务器HELO失败：" . $lastmessage . "<br>";
				}
					
				fputs ( $link, "AUTH LOGIN" . "\r\n" );
				$lastmessage = fgets ( $link, 2000 );
				if (ereg ( "^334", $lastmessage )) {
					$message .= "请求与服务器进行用户验证成功：" . $lastmessage . "<br>";
				} else {
					$message .= "请求与服务器进行用户验证失败：" . $lastmessage . "<br>";
				}
					
				fputs ( $link, base64_encode ( $username ) . "\r\n" );
				$lastmessage = fgets ( $link, 2000 );
				if (ereg ( "^334", $lastmessage )) {
					$message .= "与服务器用户验证成功：" . $lastmessage . "<br>";
				} else {
					$message .= "与服务器用户验证失败：" . $lastmessage . "<br>";
				}
					
				fputs ( $link, base64_encode ( $passwd ) . "\r\n" );
				$lastmessage = fgets ( $link, 2000 );
				if (ereg ( "^235", $lastmessage )) {
					$message .= "与服务器密码验证成功：" . $lastmessage . "<br>";
				} else {
					$message .= "与服务器密码验证失败：" . $lastmessage . "<br>";
				}
					
				fputs ( $link, "MAIL FROM:$mailfrom" . "\r\n" );
				$lastmessage = fgets ( $link, 2000 );
				if (ereg ( "^250", $lastmessage )) {
					$message .= "与服务器MAIL FROM成功：" . $lastmessage . "<br>";
				} else {
					$message .= "与服务器MAIL FROM失败：" . $lastmessage . "<br>";
				}
					
				fputs ( $link, "RCPT TO:$rcptto" . "\r\n" );
				$lastmessage = fgets ( $link, 2000 );
				if (ereg ( "^250", $lastmessage )) {
					$message .= "与服务器RCPT TO成功：" . $lastmessage . "<br>";
				} else {
					$message .= "与服务器RCPT TO失败：" . $lastmessage . "<br>";
				}
					
				fputs ( $link, "DATA" . "\r\n" );
				$lastmessage = fgets ( $link, 2000 );
				if (ereg ( "^354", $lastmessage )) {
					$message .= "请求与服务器发送邮件数据成功：" . $lastmessage . "<br>";
					fputs ( $link, "From:$mailfrom1" . "\r\n" );
					fputs ( $link, "Subject:$title" . "\r\n" );
					fputs ( $link, "To:$rcptto" . "\r\n" );
					fputs ( $link, "\r\n" );
					fputs ( $link, $mail . "\r\n" );
					fputs ( $link, "." . "\r\n" );
					$lastmessage = fgets ( $link, 2000 );
					if (ereg ( "^250", $lastmessage )) {
						$message .= "发送邮件数据成功：" . $lastmessage . "<br>";
					} else {
						$message .= "发送邮件数据失败：" . $lastmessage . "<br>";
					}
				} else {
					$message .= "请求与服务器发送邮件数据成功：" . $lastmessage . "<br>";
				}
					
				fputs ( $link, "QUIT" . "\r\n" );
				$lastmessage = fgets ( $link, 2000 );
				if (ereg ( "^221", $lastmessage )) {
					$message .= "与服务器断开连接成功：" . $lastmessage . "<br>";
				} else {
					$message .= "与服务器断开连接失败：" . $lastmessage . "<br>";
				}
			}
			//echo "s_" . $message;
			$tips = "s_" . $message;
		} else {
			//echo "err_";
			$tips = "err_";
		}
		fclose ( $link );
	}
}
