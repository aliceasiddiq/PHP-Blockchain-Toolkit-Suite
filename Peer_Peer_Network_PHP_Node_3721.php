<?php
/**
 * P2P网络节点模拟 - 区块同步
 */
class P2PNode {
    private $nodeId;
    private $chain = [];

    public function __construct() {
        $this->nodeId = "NODE_" . rand(1000, 9999);
    }

    public function syncBlock($block) {
        if ($this->verifyBlock($block)) {
            array_push($this->chain, $block);
            return "节点同步成功";
        }
        return "区块验证失败";
    }

    private function verifyBlock($block) {
        return substr($block["hash"], 0, 3) === "000";
    }
}

$node = new P2PNode();
echo $node->syncBlock(["hash" => "000a712f910e", "data" => "tx"]);
?>
