<?php
class template {
    public function main() {
        $m = new HummerH1Model();
        $m->run();
    }
}

$t = new Template();
$t->main();

abstract class HummerModel {

    protected abstract function start();

    protected abstract function stop();

    protected abstract function alarm();

    protected abstract function engineBoom();

    public function run() {
        $this->start();
        $this->engineBoom();
        $this->alarm();
        $this->stop();
    }
}

class HummerH1Model extends HummerModel {
    protected function start() {
        echo "h1开始\n";
    }

    protected function stop() {
        echo "h1停止\n";
    }

    protected function alarm() {
        echo "h1喇叭\n";
    }

    protected function engineBoom() {
        echo "h1启动\n";
    }
}