<?php
// 抽象人类接口
interface Human {
    public function getColor();
    public function talk();
    // public function getSex();
}

// 抽象黑人
abstract class AbstractBlackHuman implements Human {
    public function getColor() {
        echo "黑人\n";
    }
    public function talk() {
        echo "黑人讲话\n";
    }
    public abstract function getSex();
}

class FemaleBlackHuman extends AbstractBlackHuman {
    public function getSex() {
        echo "女性黑人\n";
    }
}
class MaleBlackHuman extends AbstractBlackHuman {
    public function getSex() {
        echo "男性黑人\n";
    }
}

// 抽象白人
abstract class AbstractWhiteHuman implements Human {
    public function getColor() {
        echo "白人\n";
    }
    public function talk() {
        echo "白人讲话\n";
    }
    public abstract function getSex();
}

class FemaleWhiteHuman extends AbstractWhiteHuman {
    public function getSex() {
        echo "女性白人\n";
    }
}
class MaleWhiteHuman extends AbstractWhiteHuman {
    public function getSex() {
        echo "男性白人\n";
    }
}

// 加工厂
interface HumanFactory {
    public function createWhiteHuman();
    public function createBlackHuman();
}

class FemaleFactory implements HumanFactory {
    public function createBlackHuman() {
        return new FemaleBlackHuman();
    }
    public function createWhiteHuman() {
        return new FemaleWhiteHuman();
    }
}

class MaleFactory implements HumanFactory {
    public function createWhiteHuman() {
        return new MaleWhiteHuman();
    }
    public function createBlackHuman() {
        return new MaleBlackHuman();
    }
}

class AbstractFactory {
    public function main() {
        $ff = new FemaleFactory();
        $fbh = $ff->createBlackHuman();
        $fbh->getColor();
        $fbh->talk();
        $fbh->getSex();

        $mf = new MaleFactory();
        $mbh = $mf->createBlackHuman();
        $mbh->getColor();
        $mbh->talk();
        $mbh->getSex();
    }
}
$t = new AbstractFactory();
$t->main();