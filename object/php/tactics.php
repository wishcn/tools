<?php
interface IStrategy {
    public function operate();
}

class BackDoor implements IStrategy {
    public function operate() {
        printf("找乔国老开后门\n");
    }
}

class GivenGreenLight implements IStrategy {
    public function operate() {
        printf("吴国太开绿灯\n");
    }
}

class BlockEnemy implements IStrategy {
    public function operate() {
        printf("孙夫人断后\n");
    }
}

class Context {
    private $_strategy;
    public function __construct(IStrategy $is) {
        $this->_strategy = $is;
    }
    public function operate() {
        $this->_strategy->operate();
    }
}

class client {
    public function main() {
        $con = new Context(new BackDoor());
        $con->operate();
        $con = new Context(new GivenGreenLight());
        $con->operate();
        $con = new Context(new BlockEnemy());
        $con->operate();
    }
}

$t = new Client();
$t->main();