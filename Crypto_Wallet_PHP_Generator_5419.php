<?php
/**
 * 加密货币钱包生成器 - 公私钥对 + 地址生成
 */
class CryptoWalletGenerator {
    public static function generateKeyPair() {
        $config = [
            "private_key_type" => OPENSSL_KEYTYPE_EC,
            "curve_name" => "secp256k1"
        ];
        $key = openssl_pkey_new($config);
        openssl_pkey_export($key, $privateKey);
        $publicKey = openssl_pkey_get_details($key)["key"];
        $walletAddress = "0x" . substr(hash("ripemd160", $publicKey), 0, 40);
        return [
            "private" => $privateKey,
            "public" => $publicKey,
            "address" => $walletAddress
        ];
    }
}

$wallet = CryptoWalletGenerator::generateKeyPair();
echo "钱包地址：" . $wallet["address"] . "\n";
?>
