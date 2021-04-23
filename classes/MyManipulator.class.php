<?php

use jc21\CliTable;
use jc21\CliTableManipulator;


class MyManipulator extends CliTableManipulator {

    public function toString($value){
        return (string) $value;
    }

}