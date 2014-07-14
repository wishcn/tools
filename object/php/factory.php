<?php
Abstract class AbstractHuman {
    public abstract function getColor();
    public abstract function say();
}

class YelloHuman extends AbstractHuman {
    public function getColor() {
        echo "我是黄色的人!\n";
    }
    public function say() {
        echo "我是中国人!\n";
    }
}

class BlueHuman extends AbstractHuman {
    public function getColor() {
        echo "我是蓝色的人!\n";
    }
    public function say() {
        echo "我是蓝国人!\n";
    }
}

Abstract class AbstractFactory {
    public abstract function create($human) ;
}

class Factory extends AbstractFactory {
    public function create($human) {
        return new $human;
    }
}

$f = new Factory();
$s = $f->create('YelloHuman');
$s->getColor();
$s->say();
$s = $f->create('BlueHuman');
$s->getColor();
$s->say();
