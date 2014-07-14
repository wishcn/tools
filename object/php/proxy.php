<?php
date_default_timezone_set('Asia/Shanghai');
interface IGamePlayer {
    Public function killed();
    public function upgrade();
}

class GamePlayer implements IGamePlayer {
    protected $name = '';
    protected $proxy = null;

    /* public function GamePlayer(GamePlayerProxy $gpp, $name) {
        if ($gpp) {
            $this->name = $name;
        } else {
            throw new Exception("必须通过代理类来初始化");
        }
        } */

    public function GamePlayer($name) {
        $this->name = $name;
    }

    public function getProxy() {
        if ($this->isProxy()) {
        } else {
            $this->proxy = new GamePlayerProxy($this);
        }
        return $this->proxy;
    }

    protected function isProxy() {
        if ($this->proxy) {
            return true;
        }
        return false;
    }

    public function login ($username, $password) {
        if ($this->isProxy()) {
            echo "{$username}登录了,登录时间:".date('Y-m-d H:i:s')."\n";
        } else {
            echo "login请使用代理访问!\n";
        }
    }

    public function killed() {
        if ($this->isProxy()) {
            echo "杀怪\n";
        } else {
            echo "killed请使用代理访问!\n";
        }
    }
    public function upgrade() {
        if ($this->isProxy()) {
            echo "升级了\n";
        } else {
            echo "upgrade请使用代理访问!\n";
        }
    }
}

class GamePlayerProxy implements IGamePlayer {
    private $_gameplayer = null;
    public function GamePlayerProxy(IGamePlayer $igp) {
        $this->_gameplayer = $igp;
    }
    public function login($username, $password) {
        $this->_gameplayer->login($username, $password);
    }
    public function killed()  {
        $this->_gameplayer->killed();
    }
    public function upgrade() {
        $this->_gameplayer->upgrade();
    }
}

class Proxy {
    public function main() {
        $gp = new GamePlayer('小明');
        $gpp = $gp->getProxy();
        $gpp->login('xiaomi','pass');
        $gpp->killed();
        $gpp->upgrade();
    }
}
$t = new Proxy();
$t->main();
