<?php
interface IDriver {
    public function driver(ICar $car);
}

class Driver implements IDriver {
    public function driver(ICar $car) {
        $car->run();
    }
}

interface ICar {
    public function run();
}

class BMW implements ICar {
    public function run() {
        echo "BMW run\n";
    }
}

class BenZ implements ICar {
    public function run() {
        echo "BenZ run\n";
    }
}

class ReplyInvert {
    public function main() {
        new Driver(new BMW());
        new Driver(new BenZ());
    }
}
$t = new ReplyInvert();
$t->main();
