<?php
class UserInfo {
    private $_name = '';
    private $_sex = 0;
    private $_subject = '';
    public function setName($name) {
        $this->_name = $name;
    }
    public function setSex($sex) {
        $this->_sex = $sex;
    }
    public function setSubject($subject) {
        $this->_subject = $subject;
    }
    public function getName() {
        return $this->_name;
    }
    public function getSex() {
        return $this->_sex;
    }
    public function getSubject() {
        return $this->_subject;
    }
}

class UserInfo4Pool extends UserInfo {
    private $_key;
    public function __construct($key) {
        $this->_key = $key;
    }
    public function getKey() {
        return $this->_key;
    }
    public function setKey($key) {
        $this->_key = $key;
    }
}

class UserFactory {
    private static $_pool = array();
    /*public static function getUserInfo() {
        return new UserInfo();
        }*/
    public static function getUserInfo($key) {
        $res = null;
        if (!isset(self::$_pool[$key])) {
            $res = new UserInfo4Pool($key);
            self::$_pool[$key] = $res;
        } else {
            $res = self::$_pool[$key];
        }
        return $res;
    }
}

class Client {
    public function main() {
        for ($i=0; $i<4; $i++) {
            $subject = "科目" + $i;
            for ($j=0;$j<30;$j++) {
                $key = $subject + "考试地点" + $j;
                userFactory::getUserInfo($key);
            }
        }

    }
}
$t = new Client();
$t->main();