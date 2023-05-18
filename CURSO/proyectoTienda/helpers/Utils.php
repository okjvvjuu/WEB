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
    
    public static function isAdmin() {
        return isset($_SESSION['user']) && $_SESSION['user']->getRol() == 'admin';
    }
    
    public static function searchFile($path) {
        $temp = explode('/', $path);
        $file = $temp[count($temp)-1];
        $path = str_replace('/'.$file, '', $path);
        
        $files = scandir($path);
        
        $result = false;
        
        foreach ($files as $value) {
            if (!is_dir($temp = $path.DIRECTORY_SEPARATOR.$value)) {
                if ($file == $value) {
                    $result = true;
                }
            } else if ($value != '.' && $value != '..') {
                self::searchFile($temp, $file);
            }
        }
        return $result;
    }
}