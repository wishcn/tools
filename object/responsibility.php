<?php
interface IWoman {
    public function getType();
    public function getRequest();
}
class Woman implements IWoman {
    /*
     * 1--未出嫁
     * 2--已嫁人
     * 3--夫已死
     */
    private $_type = 0;
    private $_request = '';

    public function __construct($type, $request) {
        $this->_type = $type;
        $this->_request = $request;
    }

    public function getType() {
        return $this->_type;
    }

    public function getRequest() {
        return $this->_request;
    }
}

abstract class Handler {
    public static $FATHER_LEVEL_REQUEST = 1;
    public static $HUSBAND_LEVEL_REQUEST = 2;
    public static $SON_LEVEL_REQUEST = 3;
    private $_level = 0;
    private $_nextHandler = null;

    public function __construct($level) {
        $this->_level = $level;
    }

    public final function HandleMessage(IWoman $woman) {
        if ($woman->getType() == $this->_level) {
            $this->response($woman);
        } else {
            if ($this->_nextHandler != null) {
                $this->_nextHandler->HandleMessage($woman);
            } else {
                printf("--没地方请示了，按不同意处理--\n");
            }
        }
    }

    public function setNext(Handler $handler) {
        $this->_nextHandler = $handler;
    }

    protected abstract function response(IWoman $woman);
}

class Father extends Handler {
    public function __construct() {
        parent::__construct(Handler::$FATHER_LEVEL_REQUEST);
    }
    public function response(IWoman $woman) {
        printf("--请示父亲--\n");
        printf($woman->getRequest()."\n");
        printf("父亲同意是：同意\n");
    }
}

class Husband extends Handler {
    public function __construct() {
        parent::__construct(Handler::$HUSBAND_LEVEL_REQUEST);
    }
    public function response(IWoman $woman) {
        printf("--请示丈夫--\n");
        printf($woman->getRequest()."\n");
        printf("丈夫同意是：同意\n");
    }
}

class Son extends Handler {
    public function __construct() {
        parent::__construct(Handler::$SON_LEVEL_REQUEST);
    }
    public function response(IWoman $woman) {
        printf("--请示儿子--\n");
        printf($woman->getRequest()."\n");
        printf("儿子同意是：同意\n");
    }
}

class Responsibility {
    public function main() {
        $arrList = array();
        for ($i=0; $i<5; $i++) {
            $arrList[] = new Woman(rand(1,3), "我要出去逛街");
        }
        $father = new Father();
        $husband = new Husband();
        $son = new Son();
        $father->setNext($husband);
        $husband->setNext($son);
        foreach ($arrList as $woman) {
            $father->HandleMessage($woman);
        }
    }
}
$t = new Responsibility();
$t->main();