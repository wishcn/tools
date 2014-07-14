<?php
class Builder {
    public function main() {
        $d = new Director();
        $d->getABaoM()->run();
        /*$b = new BenZBuilding();
        $b->setSeq(array(
            'start','stop','alarm',
        ));
        $m = $b->getModel();
        $m->run();

        $b = new BaoMBuilding();
        $b->setSeq(array(
            'stop','start','alarm'
        ));
        $m = $b->getModel();
        $m->setAlarm(true);
        $m->run();*/
    }
}
$t = new Builder();
$t->main();
abstract class Building {
    protected $model = null;
    public abstract function setSeq($seq) ;
    public abstract function getModel();
}

class BenZBuilding extends Building {

    public function __construct() {
        $this->model = new BenZModel();
    }

    public function setSeq($seq) {
        $this->model->setSeq($seq);
    }

    public function getModel() {
        return $this->model;
    }
}

class BaoMBuilding extends Building {
    public function __construct() {
        $this->model = new BaoMModel();
    }

    public function setSeq($seq) {
        $this->model->setSeq($seq);
    }

    public function getModel() {
        return $this->model;
    }
}

abstract class CarModel {
    protected $seq = array();
    protected $isAlarm = false;
    protected abstract function start();
    protected abstract function stop();
    protected abstract function alarm();
    protected abstract function engineBoom();

    public function setSeq($seq) {
        $this->seq = $seq;
    }

    public function run() {
        foreach ($this->seq as $k => $v) {
            if ($v == 'alarm' && !$this->isAlarm) {
                break;
            }
            method_exists($this, $v) && $this->$v();
        }
    }

    public function isAlarm() {
        return $this->isAlarm;
    }

    public function setAlarm($isAlarm) {
        $this->isAlarm = $isAlarm;
    }
}

class BaoMModel extends CarModel {
    protected function start() {
        echo "baom start\n";
    }
    protected function stop() {
        echo "baom stop\n";
    }
    protected function alarm() {
        echo "baom alarm\n";
    }
    protected function engineBoom() {
        echo "baom engineBoom\n";
    }
}

class BenZModel extends CarModel {
    protected function start() {
        echo "benz start\n";
    }
    protected function stop() {
        echo "benz stop\n";
    }
    protected function alarm() {
        echo "benz alarm\n";
    }
    protected function engineBoom() {
        echo "benz engineBoom\n";
    }
}

class Director {
    protected $seq = array();
    protected $baoMBuilding = null;
    protected $benZBuilding = null;
    public function __construct() {
        $this->baoMBuilding = new BaoMBuilding();
        $this->benZBuilding = new BenZBuilding();
    }
    public function getABaoM() {
        $this->seq = array(
            'start','stop',
        );
        $this->baoMBuilding->setSeq($this->seq);
        return  $this->baoMBuilding->getModel();
    }

    public function getBBaoM() {
        $this->seq = array(
            'start',
        );
        $this->baoMBuilding->seSeq($this->seq);
        return  $this->baoMBuilding->getModel();
    }
}