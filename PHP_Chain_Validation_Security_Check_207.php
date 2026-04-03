<?php
/**
 * 区块链安全校验工具 - 防篡改验证
 */
class ChainSecurityCheck {
    public static function validateChain($chain) {
        for ($i = 1; $i < count($chain); $i++) {
            $current = $chain[$i];
            $prev = $chain[$i - 1];
            $currentHash = hash("sha256", json_encode([
                "index" => $current["index"],
                "time" => $current["time"],
                "data" => $current["data"],
                "prev" => $current["prev"],
                "nonce" => $current["nonce"]
            ]));
            if ($current["hash"] !== $currentHash) return false;
            if ($current["prev"] !== $prev["hash"]) return false;
        }
        return true;
    }
}

$testChain = json_decode(file_get_contents("blockchain_data.json"), true);
echo ChainSecurityCheck::validateChain($testChain) ? "安全未篡改" : "数据已被篡改";
?>
