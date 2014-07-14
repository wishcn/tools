<?php
class AdvTemplate {
    private $_subject = 'xx银行国庆银行卡抽奖活动';
    private $_content = '只要刷卡就有钱~';
    public function getSubject() {
        return $this->_subject;
    }
    public function getContent() {
        return $this->_content;
    }
}

interface Cloneable {
    public function copy();
}

class Mail implements Cloneable {
    private $_receiver;
    private $_subject;
    private $_appellation;
    private $_content;
    private $_tail;

    public function Mail(AdvTemplate $advTemplate) {
        $this->_subject = $advTemplate->getSubject();
        $this->_content = $advTemplate->getContent();
    }

    public function copy() {
        return clone $this;
    }

    public function getReceiver() {
        return $this->_receiver;
    }
    public function getSubject() {
        return $this->_subject;
    }
    public function getAppellation() {
        return $this->_appellation;
    }
    public function getContent() {
        return $this->_content;
    }
    public function getTail() {
        return $this->_tail;
    }
    public function setReceiver($receiver) {
        $this->_receiver = $receiver;
    }
    public function setSubject($subject) {
        $this->_subject = $subject;
    }
    public function setAppellation($appellation) {
        $this->_appellation = $appellation;
    }
    public function setContent($content) {
        $this->_content = $content;
    }
    public function setTail($tail) {
        $this->_tail = $tail;
    }
}

class Prototype {
    private static $MAX_COUNT = 6;
    public function main() {
        $i = 0;
        $mail = new Mail(new AdvTemplate());
        $mail->setTail('XX公司版权所有');
        while($i<self::$MAX_COUNT) {
            $mailClone = $mail->copy();
            $mailClone->setAppellation($this->getCode(3,0).'先生');
            $mailClone->setReceiver($this->getCode(3,0).$this->getCode(4,1).$this->getCode(1,2));
            $this->sendMail($mailClone);
            $i ++;
        }
    }

    public function sendMail(Mail $mail) {
        printf("标题：%s\t收件人：%s\t发送成功\n", $mail->getSubject(), $mail->getReceiver());
    }

    public function getCode($length=3,$mode=0) {
        switch ($mode) {
        case '1':
            $str = '1234567890';
            break;
        case '2':
            $str = array("@163.com","@126.com","@sina.com","@yahoo.com.cn","@sohu.com","@tom.com","@gmail.com","@qq.com","@gmail.com");
            break;
        default:
            $str = 'abcdefghijklmnopqrstuvwxyz';
            break;
        }
        $result = '';
        $l = is_array($str) ? count($str)-1 : strlen($str)-1;
        $num=0;
        for($i = 0; $i < $length; $i++){
            $num = rand(0, $l);
            $a= $str[$num];
            $result = $result.$a;
        }
        return $result;
    }
}
$t = new Prototype();
$t->main();