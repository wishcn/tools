<?php
class Context {
    public static $openState = null;
    public static $closeState = null;
    public static $runState = null;
    public static $stopState = null;
    private $_liftState = null;
    public function __construct() {
        self::$openState = new OpenState();
        self::$closeState = new CloseState();
        self::$runState = new RunState();
        self::$stopState = new StopState();
    }

    public function getLiftState() {
        return $this->_liftState;
    }
    public function setLiftState($liftState) {
        $this->_liftState = $liftState;
        $this->_liftState->setContext($this);
    }

    public function open() {
        $this->_liftState->open();
    }

    public function close() {
        $this->_liftState->close();
    }
    public function run() {
        $this->_liftState->run();
    }

    public function stop() {
        $this->_liftState->stop();
    }
}

abstract class LiftState {
    protected $_context ;
    public function setContext($context)  {
        $this->_context = $context;
    }
    public abstract function open();
    public abstract function close();
    public abstract function run();
    public abstract function stop();
}

class OpenState extends LiftState {
    public function open() {
        printf("电梯门开启...\n");
    }
    public function close() {
        $this->_context->setLiftState(Context::$closeState);
        $this->_context->getLiftState()->close();
    }
    public function run() {
    }
    public function stop() {
    }
}
class CloseState extends LiftState {
    public function open() {
        $this->_context->setLiftState(Context::$openState);
        $this->_context->getLiftState()->open();
    }
    public function close() {
        printf("电梯门关闭...\n");
    }
    public function run() {
        $this->_context->setLiftState(Context::$runState);
        $this->_context->getLiftState()->run();
    }
    public function stop() {
        $this->_context->setLiftState(Context::$stopState);
        $this->_context->getLiftState()->stop();
    }
}
class RunState extends LiftState {
    public function open() {
    }
    public function close() {
    }
    public function run() {
        printf("电梯上下运行...\n");
    }
    public function stop() {
        $this->_context->setLiftState(Context::$stopState);
        $this->_context->getLiftState()->stop();
    }
}
class StopState extends LiftState {
    public function open() {
        $this->_context->setLiftState(Context::$openState);
        $this->_context->getLiftState()->open();
    }
    public function close() {
    }
    public function run() {
        $this->_context->setLiftState(Context::$runState);
        $this->_context->getLiftState()->run();
    }
    public function stop() {
        printf("电梯停止了...\n");
    }
}

class Client {
    public function main() {
        $context = new Context();
        $context->setLiftState(new CloseState());
        $context->open();
        $context->close();
        $context->run();
        $context->stop();
    }
}

$t = new Client();
$t->main();