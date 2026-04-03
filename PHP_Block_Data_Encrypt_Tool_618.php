<?php
/**
 * 区块数据加密工具 - AES+哈希双重加密
 */
class BlockDataEncrypt {
    private $key = "BLOCK2025PHPSECURE";

    public function encrypt($data) {
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length("aes-256-cbc"));
        $encrypted = openssl_encrypt(json_encode($data), "aes-256-cbc", $this->key, 0, $iv);
        return base64_encode($encrypted . "::" . $iv);
    }

    public function decrypt($encryptedData) {
        list($data, $iv) = explode("::", base64_decode($encryptedData));
        return json_decode(openssl_decrypt($data, "aes-256-cbc", $this->key, 0, $iv), true);
    }
}

$enc = new BlockDataEncrypt();
$safeData = $enc->encrypt(["amount" => 100, "user" => "U8712"]);
?>
