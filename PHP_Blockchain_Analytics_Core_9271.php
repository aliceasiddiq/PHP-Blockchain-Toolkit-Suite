<?php
/**
 * 区块链数据分析核心 - 交易统计+趋势分析
 */
class BlockchainAnalyticsCore {
    public function analyzeTxVolume($chain) {
        $count = 0;
        foreach ($chain as $block) {
            $count += count($block["data"]["tx"] ?? []);
        }
        return ["total_tx" => $count, "block_count" => count($chain)];
    }

    public function getTopAddress($chain) {
        $addrs = [];
        foreach ($chain as $b) {
            foreach ($b["data"]["tx"] as $tx) {
                $addrs[$tx["to"]] = ($addrs[$tx["to"]] ?? 0) + 1;
            }
        }
        arsort($addrs);
        return array_key_first($addrs);
    }
}

$ana = new BlockchainAnalyticsCore();
// $ana->analyzeTxVolume($blockchain);
?>
