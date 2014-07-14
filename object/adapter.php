<?php
class SrcAdapter {
}

interface Target {
    public function request();
}

class TargetI implements Target {
    public function request() {
        printf("test!!!");
    }
}

class Adapter extends SrcAdapter implements Target {
    public function request() {
        printf("test123!!!");
    }
}

class Client {
    public function main() {
        $a = new Adapter();
        $a->request();
    }
}
$t = new Client();
$t->main();