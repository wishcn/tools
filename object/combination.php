<?php
abstract class Corp {
    private $_name = '';
    private $_position = '';
    private $_salary = 0;
    public function __construct($name,$position,$salary) {
        $this->_name = $name;
        $this->_position = $position;
        $this->_salary = $salary;
    }

    public function getInfo() {
        print("姓名：{$this->_name}\t职位：{$this->_position}\t薪水：{$this->_salary}");
    }
}

class Branch extends Corp {
    protected $_sub = array();
    public function addSub(Corp $cp) {
        $this->_sub[] = $cp;
    }
    public function getSub(Corp $cp) {
        return $this->_sub;
    }
}

class Leaf extends Corp {
}

class Client {
    public function main() {
        $ceo = new Branch('小明','ceo',10000000);
        $xxoo = new Branch('小红','总经理秘书',1000);
        $ceo->addSub($xxoo);
        $yanfaCeo = new Branch('小x','研发总经理',10000);
        $ceo->addSub($yanfaCeo);
        $yanfa1 = new Leaf('小b','渣程',1000);
        $yanfa2 = new Leaf('小b','渣程',1000);
        $yanfaCeo->addSub($yanfa1);
        $yanfaCeo->addSub($yanfa2);
    }
}
$t = new Client();
$t->main();