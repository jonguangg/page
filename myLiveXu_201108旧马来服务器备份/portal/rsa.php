<?php

/*
	一、生成密钥：
	1、生成原始文件：
	openssl  genrsa  -out  rsa_private_key.pem  1024
	2、转换格式
	openssl  pkcs8  -topk8  -inform  PEM  -in rsa_private_key.pem  -outform  PEM -nocrypt  -out  private_key.pem
	3、生成公钥
	openssl  rsa  -in  rsa_private_key.pem  -pubout  -out  rsa_public_key.pem
*/


/**
* @desc：php rsa加密解密类
* @author [Lee] <[<complet@163.com>]>
*/
class rsa{
	private static $private_key = "
-----BEGIN RSA PRIVATE KEY-----
MIICXQIBAAKBgQCy+CsjNWGyiYp78hfbyOZmUCgVLG6MQ1q1MW3npL6RQn1h3EO6
NqHxIRDqU3ykq8bfimNoVXzsoFymtZGJVrmJE2MsgLP2ieRIYsBP+HcZ6S2VRg73
OEoWlpxeDnyqRr0UYAhHl/WGU0JMcmekw2LMDTf6pwBKg9OeOT0hyBRq4wIDAQAB
AoGALumkjR8iE+W/2kuUe3VHB8y9JQe3lqbVMSfa0ly542PVcACH9Fj7zDRJtdLa
mmO4xsIE2sWF8JT8lGqF0sVb7qVRQFLfI1FKjj6Nj2wflhpl1/MEzDpDG4JNDu0Z
X6riWbd9bvrxaWCSpoTrDIGO0RcqoSl3iUpaEOzSiybQT4kCQQDddROSi6+aoYck
az02HtA3LrgYRZtvKSYKQ+gahMTptTzcwzhSqjk4x8v11JpQhDMpoBeykmfV13oC
McbElRgFAkEAzuKGITRUdYs3Av7s+P11EzOYwFX0Ve6PRv+cteW75wWoPwvrMAIk
ldnfbuLN8Bm0FdTzHzeWJSKk1cmYAHrzxwJBAJyb0M2Prw2BMVrV46HERKbhiRrR
DsybouUbhKZMQhysKHBONiRvcKvwzxH32XEbLDtBlcCYvImDKisnHFOkxCkCQBOl
ANWAUZDDwlp/eGMANjC3koaY4tWSDHrSZMAE6325VMt/xzpMycqM4KF32dQ1rJry
GI/bSF+IVZyTQuKwyhsCQQCuqYVhV7ZMO4IUkrxZzBadgcLQiz/1SoQx4iiLjyV8
ONA2PNWBxuZNiv7L4FMelhN7EX0WPgD9ed9pLwQSVhN8
-----END RSA PRIVATE KEY-----
";
		
	private static $public_key = "
-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCy+CsjNWGyiYp78hfbyOZmUCgV
LG6MQ1q1MW3npL6RQn1h3EO6NqHxIRDqU3ykq8bfimNoVXzsoFymtZGJVrmJE2Ms
gLP2ieRIYsBP+HcZ6S2VRg73OEoWlpxeDnyqRr0UYAhHl/WGU0JMcmekw2LMDTf6
pwBKg9OeOT0hyBRq4wIDAQAB
-----END PUBLIC KEY-----";

/*	也可以这样定义公私钥
	$private_key = file_get_contents('private_key.pem'); //读取私钥 
	$public_key = file_get_contents('rsa_public_key.pem'); //读取公钥
*/
	/**
	 * 获取私钥
	 * @return bool|resource
	 */
	private static function getPrivateKey(){
		$privKey = self::$private_key; 
		return openssl_pkey_get_private($privKey);	//这个函数可用来判断私钥是否是可用的
	}
	
	/**
	 * 获取公钥
	 * @return bool|resource
	 */
	private static function getPublicKey(){
		$publicKey = self::$public_key;
		return openssl_pkey_get_public($publicKey);	//这个函数可用来判断公钥是否是可用的
	}

	/**
	 * 私钥加密
	 * @param string $data
	 * @return null|string
	 */
	public static function privEncrypt($data = ''){
		if (!is_string($data)) {
			return null;
		}
		return openssl_private_encrypt($data,$encrypted,self::getPrivateKey()) ? base64_encode($encrypted) : null;
	}

	/**
	 * 公钥加密
	 * @param string $data
	 * @return null|string
	 */
	public static function publicEncrypt($data = ''){
		if (!is_string($data)) {
			return null;
		}
		return openssl_public_encrypt($data,$encrypted,self::getPublicKey()) ? base64_encode($encrypted) : null;
	}

	/**     
	 * 私钥解密
	 * @param string $encrypted
	 * @return null
	 */
	public static function privDecrypt($encrypted = ''){
		if (!is_string($encrypted)) {
			return null;
		}
		return (openssl_private_decrypt(base64_decode($encrypted), $decrypted, self::getPrivateKey())) ? $decrypted : null;
	}

	/**
	 * 公钥解密
	 * @param string $encrypted
	 * @return null
	 */
	public static function publicDecrypt($encrypted = ''){
		if (!is_string($encrypted)) {
			return null;
		}
	return (openssl_public_decrypt(base64_decode($encrypted), $decrypted, self::getPublicKey())) ? $decrypted : null;
	}

}
	//测试
//	$rsa = new rsa();
//	$str = '明文数据';
	
	// 私钥加密
//	$privEncrypt = $rsa->privEncrypt($str);
//	echo $privEncrypt.PHP_EOL.PHP_EOL;
	
	// 公钥解密
//	$publicDecrypt = $rsa->publicDecrypt($privEncrypt);
//	echo $publicDecrypt.PHP_EOL.PHP_EOL;
	
	// 公钥加密
//	$publicEncrypt = $rsa->publicEncrypt($str);
//	echo $publicEncrypt.PHP_EOL.PHP_EOL;
	
	// 私钥解密
//	$privDecrypt = $rsa->privDecrypt($publicEncrypt);
//	echo $privDecrypt.PHP_EOL.PHP_EOL;






?>