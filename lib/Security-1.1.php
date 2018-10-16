<?
/* version 1.0
  clase para encryptar y desencriptar
  la clave tiene que tener 16 caracteres
  
  */
class Security {
	
	public static function claveDefecto(){
		return "_aZ[7Jn53ASD%93B";
	}
	public static function encrypt($plaintext, $key) {
		
		$ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
		$iv = openssl_random_pseudo_bytes($ivlen);
		$ciphertext_raw = openssl_encrypt($plaintext, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
		$hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
		$ciphertext = base64_encode( $iv.$hmac.$ciphertext_raw );    
		return $ciphertext;
	} 
	private static function pkcs5_pad ($text, $blocksize) { 
		$pad = $blocksize - (strlen($text) % $blocksize); 
		return $text . str_repeat(chr($pad), $pad); 
	} 
	public static function decrypt($sStr, $sKey) {
		$c = base64_decode($sStr);
		$ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
		$iv = substr($c, 0, $ivlen);
		$hmac = substr($c, $ivlen, $sha2len=32);
		$ciphertext_raw = substr($c, $ivlen+$sha2len);
		$original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $sKey, $options=OPENSSL_RAW_DATA, $iv);
		return $original_plaintext;
	}	
}
?>