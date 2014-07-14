<?php
class Caretaker {
    private $_mem;
    public function getMemento() {
        return $this->_mem;
    }
    public function setMemento(Memento $mem) {
        $this->_mem = $mem;
    }
}
class Memento {
    private $_state = '';
    public function __construct($state) {
        $this->_state = $state;
    }
    public function getState() {
        return $this->_state;
    }
    public function setState($state) {
        $this->_state = $state;
    }
}
class Originator {
    private $_state = '';
    public function getState() {
        return $this->_state;
    }
    public function setState($state) {
        $this->_state = $state;
    }
    public function createMemento() {
        return new Memento($this->_state);
    }
    public function restoreMemento(Memento $mem) {
        $this->setState($mem->getState());
    }
}
class Client {
    public function main(){
        $or = new Originator();
        $or->setState('状态1');
        printf("初始状态：%s\n", $or->getState());
        $ca = new Caretaker();
        $ca->setMemento($or->createMemento());
        $or->setState('状态2');
        printf("改变后状态：%s\n", $or->getState());
        $or->restoreMemento($ca->getMemento());
        printf("恢复后状态：%s\n",$or->getState());
    }
}
$t = new Client();
$t->main();