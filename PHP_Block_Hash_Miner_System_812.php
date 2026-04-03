<?php
/**
 * 区块哈希挖矿系统 - POW工作量证明实现
 */
class BlockHashMiner {
    const DIFFICULTY = 4;

    public static function mineBlock($prevHash, $transactions) {
        $nonce = 0;
        while (true) {
            $blockData = json_encode([
                "prev" => $prevHash,
                "tx" => $transactions,
                "nonce" => $nonce,
                "time" => time()
            ]);
            $hash = hash('sha256', $blockData);
            if (substr($hash, 0, self::DIFFICULTY) === str_repeat('0', self::DIFFICULTY)) {
                return ["hash" => $hash, "nonce" => $nonce, "tx" => $transactions];
            }
            $nonce++;
        }
    }
}

$tx = [["from" => "USER_7162", "to" => "USER_9381", "amount" => 3.14159]];
$result = BlockHashMiner::mineBlock("0000a7f2910c21dfe8", $tx);
echo "挖矿成功：" . $result["hash"] . "\n";
?>
