<?php
namespace ngyuki\DbUnitHelper;

use PHPUnit_Extensions_Database_DB_IDatabaseConnection;

trait DbUnitTrait
{
    /**
     * @var DbUnitDelegate
     */
    private $dbunit;

    /**
     * @before
     */
    protected function beforeDbUnitTrait()
    {
        $this->dbunit = new DbUnitDelegate($this->getConnection());
        $this->dbunit->setTestCase($this);
        $this->dbunit->onSetUp();
    }

    /**
     * @return PHPUnit_Extensions_Database_DB_IDatabaseConnection
     */
    abstract protected function getConnection();
}
