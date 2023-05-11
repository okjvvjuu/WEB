<?php

class Database{
    public static function connect() {
        return new mysqli('localhost', 'root', 'Panalba_02', 'shop');
    }
}