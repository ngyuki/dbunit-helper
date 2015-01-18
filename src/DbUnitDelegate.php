<?php
namespace ngyuki\DbUnitHelper;

use PDO;
use PHPUnit_Framework_TestCase;
use PHPUnit_Extensions_Database_DefaultTester;
use PHPUnit_Extensions_Database_DB_DefaultDatabaseConnection;
use PHPUnit_Extensions_Database_DataSet_IDataSet;

class DbUnitDelegate extends PHPUnit_Extensions_Database_DefaultTester
{
    /**
     * @var PHPUnit_Framework_TestCase
     */
    private $test;

    /**
     * @param PHPUnit_Framework_TestCase $test
     * @param PDO $connection
     * @param string $schema
     * @return self
     */
    public static function createDefault(PHPUnit_Framework_TestCase $test, PDO $connection, $schema = '')
    {
        $connection = new PHPUnit_Extensions_Database_DB_DefaultDatabaseConnection($connection, $schema);
        $self = new self($connection);
        $self->setTestCase($test);
        return $self;
    }

    /**
     * @param PHPUnit_Framework_TestCase $test
     * @return $this
     */
    public function setTestCase(PHPUnit_Framework_TestCase $test)
    {
        $this->test = $test;
        return $this;
    }

    /**
     * @return PHPUnit_Extensions_Database_DataSet_IDataSet
     */
    public function getDataSet()
    {
        $annotations = call_user_func_array('array_merge_recursive', $this->test->getAnnotations());

        if (isset($annotations['dataSet'])) {
            $dataSet = end($annotations['dataSet']);
            return call_user_func(array($this->test, $dataSet));
        }

        return new \PHPUnit_Extensions_Database_DataSet_DefaultDataSet();
    }

    /**
     * @param $yaml
     * @return \PHPUnit_Extensions_Database_DataSet_YamlDataSet
     */
    public static function createYamlDataSet($yaml)
    {
        return DbUnitUtil::createYamlDataSet($yaml);
    }

    /**
     * @param $yaml
     * @return \PHPUnit_Extensions_Database_DataSet_YamlDataSet
     */
    public static function createYamlDataSetByInline($yaml)
    {
        return DbUnitUtil::createYamlDataSetByInline($yaml);
    }
}
