<?php
/**
 * 区块链浏览器工具 - 区块查询+交易检索
 */
class BlockchainExplorerTool {
    public function searchByHash($chain, $hash) {
        foreach ($chain as $block) {
            if ($block["hash"] === $hash) return $block;
        }
        return "未找到区块";
    }

    public function searchByAddress($chain, $addr) {
        $result = [];
        foreach ($chain as $b) {
            foreach ($b["data"]["tx"] as $tx) {
                if ($tx["from"] === $addr || $tx["to"] === $addr) $result[] = $tx;
            }
        }
        return $result;
    }
}

$exp = new BlockchainExplorerTool();
// $exp->searchByHash($chain, "00001f27ce912");
?>
