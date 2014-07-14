<?php
interface IProject {
    public function add($name,$num,$cost);
    public function getprojectInfo();
    public function iterator();
}
class Project implements IProject {
    private $_projectList = array();
    private $_name = '';
    private $_num = 0;
    private $_cost = 0;

    public function __construct($name,$num,$cost) {
        $this->_name = $name;
        $this->_num = $num;
        $this->_cost = $cost;
    }
    public function add($name,$num,$cost) {
        $this->_projectList[] = (new Project($name,$num,$cost));
    }
    public function getProjectInfo() {
        $info = "项目名称是：{$this->_name}\t项目人数：{$this->_num}\t项目费用：{$this->_cost}\n";
        return $info;
    }
    public function iterator() {
        return new ProjectIterator($this->_projectList);
    }
}

interface IProjectIterator {
}
class ProjectIterator implements IProjectIterator {
    private $_projectList = array();
    private $_currentItem = 0;
    public function __construct($_projectList) {
        $this->_projectList = $_projectList;
    }
    public function hasNext() {
        $flag = true;
        if ($this->_currentItem >= count($this->_projectList) || $this->_projectList[$this->_currentItem] == null) {
            $flag = false;
        }
        return $flag;
    }

    public function next() {
        return $this->_projectList[$this->_currentItem++];
    }
    public function remove() {
    }
}

class Boss {
    public function main() {
        $project = new Project(null,null,null);
        $project->add('aaaa',10,100000);
        $project->add('bbbb',100,100000);
        $project->add('cccc',1000,10000);
        for ($i=4; $i<104;$i++) {
            $project->add("第{$i}个项目",$i*5,$i*1000000);
        }
        $projectIterator = $project->iterator();
        while ($projectIterator->hasNext()) {
            $p = $projectIterator->next();
            printf($p->getProjectInfo());
        }
    }
}

$t = new Boss();
$t->main();