<?php
class Light {
    public function open() {
        printf("开灯\n") ;
    }
}

class Alarm {
    public function open() {
        printf("按铃\n");
    }
}

class Door {
    public function open() {
        printf("开门\n");
    }
}

class HomeFacade {
    private $_light;
    private $_alarm;
    private $_door;
    public function __construct() {
        $this->_light = new Light();
        $this->_alarm = new Alarm();
        $this->_door = new Door();
    }

    public function open() {
        $this->_alarm->open();
        $this->_door->open();
        $this->_light->open();
    }

    public function close() {
    }

}

class Client {
    public function main(){
        $hf = new HomeFacade();
        $hf->open();
    }
}
$t = new Client();
$t->main();