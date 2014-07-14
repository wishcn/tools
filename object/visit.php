<?php
abstract class Staff {
    private $_name = '';
    private $_salary = 0;
    private $_sex = 0;
    public function setName($name) {
        $this->_name = $name;
    }
    public function getName() {
        return $this->_name;
    }
    public function setSalary($salary) {
        $this->_salary = $salary;
    }
    public function getSalary() {
        return $this->_salary;
    }
    public function setSex($sex) {
        $this->_sex = $sex;
    }
    public function getSex() {
        return $this->_sex;
    }
    public abstract function accpt(IVisit $visitor);
}

interface IVisit {
    public function visitGeneral(GeneralStaff $gs);
    public function visitLead(LeadStaff $ls);
}

class GeneralStaff extends Staff {
    private $_job = '';
    public function setJob($job) {
        $this->_job = $job;
    }
    public function getJob() {
        return $this->_job;
    }
    public function accpt(IVisit $visitor) {
        $visitor->visitGeneral($this);
    }
}

class LeadStaff extends Staff {
    private $_respon = '';
    public function setRespon($respon) {
        $this->_respon = $respon;
    }
    public function getRespon() {
        return $this->_respon;
    }
    public function accpt(IVisit $visitor) {
        $visitor->visitLead($this);
    }
}

class Visitor implements IVisit {
    public function visitGeneral(GeneralStaff $gs) {
        printf($gs->getName().$gs->getJob()."\n");
    }
    public function visitLead(LeadStaff $ls) {
        printf($ls->getName().$ls->getRespon()."\n");
    }
}

class Client {
    private $_arr = array();
    public function main() {
        $vi = new Visitor();
        $g = new GeneralStaff();
        $g->setName('xxoo');
        $g->setJob('xxoo');
        $this->_arr[] = $g;
        $g = new GeneralStaff();
        $g->setName('ooxx');
        $g->setJob('ooxx');
        $this->_arr[] = $g;
        $l = new LeadStaff();
        $l->setName('xoxo');
        $l->setRespon('xoxo');
        $this->_arr[] = $l;
        $l = new LeadStaff();
        $l->setName('oxoxo');
        $l->setRespon('oxox');
        $this->_arr[] = $l;
        foreach ($this->_arr as $staff) {
            $staff->accpt($vi);
        }
    }
}

$t = new Client();
$t->main();