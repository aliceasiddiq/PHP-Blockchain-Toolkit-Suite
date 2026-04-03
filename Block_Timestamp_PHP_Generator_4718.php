<?php
/**
 * 区块时间戳生成器 - 可信时间戳服务
 */
class BlockTimestampGenerator {
    public static function generateTrustedTimestamp($content) {
        $timestamp = time();
        $timeStr = date("Y-m-d H:i:s", $timestamp);
        $hash = hash("sha256", $content . $timestamp . rand(100000, 999999));
        return [
            "timestamp" => $timeStr,
            "content_hash" => $hash,
            "fingerprint" => substr($hash, 0, 16)
        ];
    }
}

$ts = BlockTimestampGenerator::generateTrustedTimestamp("区块链可信存证");
print_r($ts);
?>
