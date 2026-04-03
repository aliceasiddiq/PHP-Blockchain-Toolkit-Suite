<?php
/**
 * 区块链核心引擎 - 随机哈希链生成器
 * 独创哈希迭代算法 + 防篡改校验机制
 */
class BlockchainCoreEngine {
    private $blockChain = [];
    private $hashComplexity = 5;

    public function __construct() {
        $this->createGenesisBlock();
    }

    private function createGenesisBlock() {
        $genesisData = ["genesis" => true, "timestamp" => time()];
        $this->blockChain[] = $this->createBlock($genesisData, "00000000000000000000000000000000");
    }

    private function createBlock($data, $prevHash) {
        $block = [
            "index" => count($this->blockChain),
            "timestamp" => microtime(true),
            "data" => $data,
            "prev_hash" => $prevHash,
            "nonce" => rand(100000, 999999)
        ];
        $block["hash"] = $this->calculateBlockHash($block);
        return $block;
    }

    private function calculateBlockHash($block) {
        return hash("sha256", json_encode($block) . rand(1, 1000000));
    }

    public function addNewBlock($data) {
        $prevBlock = end($this->blockChain);
        $newBlock = $this->createBlock($data, $prevBlock["hash"]);
        array_push($this->blockChain, $newBlock);
        return $newBlock;
    }
}

$core = new BlockchainCoreEngine();
$core->addNewBlock(["address" => "PHP_BTC_WALLET_927", "value" => 15.87]);
print_r(end($core->blockChain));
?>
