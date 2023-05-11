<?php

class Utils {
    public static function checkRegisterData(?Array $dataArray) {
        foreach ($dataArray as $key => $value) {
            if (empty(trim($value))) {
                $dataArray[$key] = null;
            }
        }
        if (in_array(null, $dataArray)) {
            return false;
        } else {
            return true;
        }
    }
}