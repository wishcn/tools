<?php
interface Calculate {
    public function exec($a,$b);
}
class Add implements Calculate {
    public function exec($a, $b) {
        return $a+$b;
    }
}
class Minus implements Calculate {
    public function exec($a, $b) {
        return $a-$b;
    }
}
class Context {
    private $_calculate = null;
    public function __construct(Calculate $ca) {
        $this->_calculate = $ca;
    }
    public function exec($a,$b) {
        return $this->_calculate->exec($a,$b);
    }
}
class Client {
    public function main() {
        $ca = new Context(new Add());
        echo $ca->exec(5,1,'+');
    }
}

$t = new Client();
$t->main();