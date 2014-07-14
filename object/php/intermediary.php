<?php
abstract class AbstractMediary {
    protected $purchase ;
    protected $stock ;
    protected $sale ;
    public function AbstractMediary() {
        $this->purchase = new Purchase($this);
        $this->stock = new Stock($this);
        $this->sale = new Sale($this);
    }
}

abstract class AbstractColleague {
    protected $mediary;
    public function __construct(Mediary $mediary) {
        $this->mediary = $mediary;
    }
}

class Mediary extends AbstractMediary {

    public function exec($operaStr,$param=null) {
        switch ($operaStr) {
        case 'purchase.buy':
            $this->buy((int)$param);
            break;
        case 'stock.clear':
            $this->clear();
            break;
        case 'sale.offsale':
            $this->offSale();
            break;
        case 'sale.sell':
            $this->sell((int)$param);
            break;
        }
    }

    private function clear() {
        printf("清理存货数量为：%s\n",$this->stock->getStockNumber());
        $this->sale->offSale();
        $this->purchase->refuseBuyIBM();
    }

    private function buy($number) {
        $saleStatus = $this->sale->getSaleStatus();
        if ($saleStatus > 80 ) {
            printf("采购IBM电脑:%s台\n",$number);
            $this->stock->increase($number);
        } else {
            $buyNumber = $number/2;
            printf("采购IBM电脑:%s台\n",$buyNumber);
        }
    }

    private function sell($number) {
        if ($this->stock->getStockNumber() < $number) {
            $this->purchase->buyIBMcomputer($number);
        }
        printf("销售IBM电脑%s台\n",$number);
        $this->stock->decrease($number);
    }

    private function offSale() {
        printf("折价销售IBM电脑%s台\n",$this->stock->getStockNumber());
    }
}

class Purchase extends AbstractColleague {

    public function Purchase(Mediary $mediary) {
        parent::__construct($mediary);
    }

    public function buyIBMcomputer($number) {
        $this->mediary->exec('purchase.buy',$number);
    }

    public function refuseBuyIBM() {
        printf("不再采购IBM电脑\n");
    }
}

class Stock extends AbstractColleague {
    private static $COMPUTER_NUMBER = 100;
    public function Stock(Mediary $mediary) {
        parent::__construct($mediary);
    }

    public function increase($number) {
        self::$COMPUTER_NUMBER = self::$COMPUTER_NUMBER+$number;
        printf("库存数量为：%s\n",self::$COMPUTER_NUMBER);
    }

    public function decrease($number) {
        self::$COMPUTER_NUMBER = self::$COMPUTER_NUMBER-$number;
        printf("库存数量为：%s\n",self::$COMPUTER_NUMBER);
    }
    public function getStockNumber() {
        return self::$COMPUTER_NUMBER;
    }

    public function clearStock() {
        $this->mediary->exec('stock.clear');
    }
}

class Sale extends AbstractColleague {

    public function Sale(Mediary $mediary) {
        parent::__construct($mediary);
    }

    public function getSaleStatus() {
        $rand = rand(0, 100);
        printf("IBM电脑的销售情况为%s\n",$rand);
        return $rand;
    }

    public function sellIBMComputer($number) {
        $this->mediary->exec('sale.sell',$number);
    }

    public function offSale() {
        $this->mediary->exec('sale.offsale');
    }
}

class Client {
    public function main() {
        $mediary = new Mediary();
        printf("-----采购人员采购电脑------\n");
        $purchase = new Purchase($mediary);
        $purchase->buyIBMcomputer(100);
        printf("\n-----销售人员销售电脑------\n");
        $sale = new Sale($mediary);
        $sale->sellIBMComputer(1);
        printf("\n-----库房人员清库处理------\n");
        $stock = new Stock($mediary);
        $stock->clearStock();
    }
}
$t = new Client();
$t->main();