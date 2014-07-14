<?php
abstract class Group {
    public abstract function find();
    public abstract function add();
    public abstract function change();
    public abstract function delete();
    public abstract function plan();
}

class CodeGroup extends Group {
    public function find() {
        printf("找到代码组....\n");
    }

    public function add() {
        printf("客户要求增加一项功能...\n");
    }
    public function change() {
        printf("客户要求修改一项功能...\n");
    }
    public function delete() {
        printf("客户要求删除一项功能...\n");
    }
    public function plan() {
        printf("客户要求变更功能计划...\n");
    }
}

class ClipGroup extends Group {
    public function find() {
        printf("找到美工组....\n");
    }

    public function add() {
        printf("客户要求增加一个页面...\n");
    }
    public function change() {
        printf("客户要求修改一个页面...\n");
    }
    public function delete() {
        printf("客户要求删除一个页面...\n");
    }
    public function plan() {
        printf("客户要求变更页面计划...\n");
    }
}

class RequirementGroup extends Group {
    public function find() {
        printf("找到需求组...\n");
    }
    public function add() {
        printf("客户要求增加一项需求...\n");
    }
    public function change() {
        printf("客户要求修改一项需求...\n");;
    }
    public function delete() {
        printf("客户要求删除一项需要...\n");
    }

    public function plan() {
        printf("客户要求需求变更计划...\n");
    }
}


abstract class Command {
    protected $code = null;
    protected $clip = null;
    protected $requirement = null;
    public function __construct() {
        $this->code = new CodeGroup();
        $this->clip = new ClipGroup();
        $this->requirement = new RequirementGroup();
    }
    public abstract function execute();
}

class AddRequirementCommand extends Command {
    public function execute() {
        $this->requirement->find();
        $this->requirement->add();
        $this->requirement->plan();
    }
}

class DeletePageCommand extends Command {
    public function execute() {
        $this->clip->find();
        $this->clip->delete();
        $this->clip->plan();
    }
}

class Invoker {
    private $command;
    public function setCommand($command) {
        $this->command = $command;
    }
    public function action() {
        $this->command->execute();
    }
}

class Client {
    public function main() {
        $i = new Invoker();
        $com = new AddRequirementCommand();
        $i->setCommand($com);
        $i->action();
        $com = new DeletePageCommand();
        $i->setcommand($com);
        $i->action();
    }
}
$t = new Client();
$t->main();