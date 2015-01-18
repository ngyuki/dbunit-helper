<?php
namespace Tests;

use ngyuki\DbUnitHelper\DbUnitTrait;

class DbUnitTraitTest extends AbstractTestCase
{
    use DbUnitTrait;

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
        return $this->dbunit->createYamlDataSetByInline("
            t:
              - id: 1
              - id: 2
        ");
    }
}
