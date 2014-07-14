<?php
interface Observer {
    public function update($msg);
}
interface Observable {
    public function addObserver(Observer $ob);
    public function removeObserver(Observer $ob);
    public function notifyObservers($msg);
}
class Post implements Observable {
    private $_observer = array();
    public function addObserver(Observer $ob) {
        $this->_observer[] = $ob;
    }
    public function removeObserver(Observer $ob) {
    }
    public function notifyObservers($msg) {
        foreach ($this->_observer as $k => $v) {
            $v->update($msg);
        }
    }
    public function create() {
        printf("我创建了文章\n");
        $this->notifyObservers('文章已创建');
    }
}

class Me implements Observer {
    public function update($msg) {
        printf($msg."\n");
        printf("我可以去看了\n");
    }
}
class Client {
    public function main() {
        $o = new Me();
        $p = new Post();
        $p->addObserver($o);
        $p->create();
    }
}
$t = new Client();
$t->main();