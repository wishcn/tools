<?php
class TestPaper {
    public function report() {
        printf("语文：28,数学：23\n");
    }
    public function sign() {
        printf("签名：\n");
    }
}

abstract class Descoration extends TestPaper {
    protected $tp = null;
    public function __construct(TestPaper $tp) {
        $this->tp = $tp;
    }
    public function report() {
        $this->tp->report();
    }
    public function sign() {
        printf("签字：老三\n");
    }
}

class HighScore extends Descoration {
    private function reportHighScore() {
        printf("班上最高分数：语文：29,数学：24\n");
    }
    public function report() {
        $this->reportHighScore();
        parent::report();
    }
}

class LowScore extends Descoration {
    private function reportLowScore() {
        printf("班上最低分数：语文：1,数学：2\n");
    }
    public function report() {
        $this->reportLowScore();
        parent::report();
    }
}

class Client {
    public function main() {
        $tp = new TestPaper();
        $tp = new HighScore($tp);
        $tp = new LowScore($tp);
        $tp->report();
        $tp->sign();
    }
}

$t = new Client();
$t->main();