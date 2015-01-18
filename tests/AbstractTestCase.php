<?php
namespace Tests;

use PHPUnit_Extensions_Database_DB_DefaultDatabaseConnection;

abstract class AbstractTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \PDO
     */
    public static $pdo;

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();

        if (self::$pdo === null) {
            self::$pdo = new \PDO('sqlite::memory:', "", "", array(
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            ));

            self::$pdo->exec('create table t ( id int not null primary key )');
        }
    }

    protected function getConnection()
    {
        return new PHPUnit_Extensions_Database_DB_DefaultDatabaseConnection(self::$pdo);
    }
}
