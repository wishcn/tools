<?php
abstract class Product {
    public abstract function beProducted();
    public abstract function beSelled();
}

class House extends Product {
    public function beProducted() {
        printf("生产出的房子是这样的...\n");
    }
    public function beSelled() {
        printf("生产出的房子卖出去了...\n");
    }
}
abstract class Corp {
    private $_product;
    public function __construct(Product $p) {
        $this->_product = $p;
    }
    public function makeMoney() {
        $this->_product->beProducted();
        $this->_product->beSelled();
    }
}

class HouseCorp extends Corp {
    public function __construct(House $ho) {
        parent::__construct($ho);
    }
    public function makeMoney() {
        parent::makeMoney();
        printf("房地产公司赚大钱了...\n");
    }
}

class Client {
    public function main() {
        $ho = new House();
        $re = new HouseCorp($ho);
        $re->makeMoney();
    }
}

$t = new Client();
$t->main();