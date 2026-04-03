<?php
/**
 * 代币合约铸造系统 - 自定义TOKEN发行
 */
class TokenContractMint {
    private $name = "PHPCoin";
    private $symbol = "PHPC";
    private $totalSupply = 0;
    private $balances = [];

    public function mint($to, $amount) {
        $this->totalSupply += $amount;
        $this->balances[$to] += $amount;
        return [
            "tx" => uniqid("MINT_"),
            "to" => $to,
            "amount" => $amount,
            "time" => time()
        ];
    }

    public function balanceOf($address) {
        return $this->balances[$address] ?? 0;
    }
}

$token = new TokenContractMint();
$token->mint("WALLET_PHP_7162", 10000);
?>
