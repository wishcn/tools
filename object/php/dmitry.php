<?php
class Dmitry {
    public function main() {
        $s = new InstallSoftware();
        $s->installWizard();
    }
}

$t = new Dmitry();
$t->main();


class InstallSoftware {
    public function installWizard() {
        $soft = new Wizard();
        $soft->installWizard();
    }
}

class Wizard {
    protected function first() {
        echo "this first\n";
    }

    protected function second() {
        echo "this second\n";
    }

    protected function third() {
        echo "this third\n";
    }

    public function installWizard() {
        $this->first();
        $this->second();
        $this->third();
    }
}
