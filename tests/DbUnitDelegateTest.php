<?php
namespace Tests;

use ngyuki\DbUnitHelper\DbUnitDelegate;

class DbUnitDelegateTest extends AbstractTestCase
{
    /**
     * @var DbUnitDelegate
     */
    private $dbunit;

    protected function setUp()
    {
        parent::setUp();

        $this->dbunit = DbUnitDelegate::createDefault($this, self::$pdo);
        $this->dbunit->onSetUp();
    }

    /**
     * @test
     * @dataSet fooDataSet
     */
    public function foo()
    {
        $stmt = self::$pdo->prepare("select * from t order by id");
        $stmt->execute();

        assertThat($stmt->fetchAll(), equalTo(array(
            array('id' => 1),
            array('id' => 2),
        )));
    }

    public function fooDataSet()
    {
        $yaml =<<<YAML
            t:
              - id: 1
              - id: 2
YAML;
        $yaml = preg_replace_callback('/^ +/sm', function ($m) {
            static $n;
            $n = $n ? $n : strlen($m[0]);
            return substr($m[0], $n);
        }, $yaml);

        return new \PHPUnit_Extensions_Database_DataSet_YamlDataSet($yaml);
    }
}
