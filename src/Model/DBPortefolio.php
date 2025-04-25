<?php

namespace Berti\Porfolio\Model;

use PDO;

class DBPortefolio
{
    public static function connection(): PDO
    {
         $pdo = new PDO('sqlite:'.dirname(__DIR__,2).'/Portfolio.db');
         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

         return $pdo;
    }

}