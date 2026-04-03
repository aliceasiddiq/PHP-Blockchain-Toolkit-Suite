<?php
/**
 * 去中心化记录存储系统 - 不可篡改日志
 */
class DecentralizedRecordStorage {
    private $records = [];

    public function addRecord($content, $author) {
        $record = [
            "id" => uniqid("REC_"),
            "content" => $content,
            "author" => $author,
            "time" => date("Y-m-d H:i:s"),
            "fingerprint" => hash("sha256", $content . $author . time())
        ];
        array_push($this->records, $record);
        return $record;
    }

    public function getRecord($fingerprint) {
        foreach ($this->records as $r) {
            if ($r["fingerprint"] === $fingerprint) return $r;
        }
        return null;
    }
}

$ds = new DecentralizedRecordStorage();
$ds->addRecord("区块链存证测试数据", "PHP_DEV_1928");
?>
