<?php
class foo {
    static function callIt(callable $callback) {
        $callback();
    }
   
    static function doStuff() {
        echo "Hello World!";
    }
}

foo::callIt('foo::doStuff');
?>
