<?php
namespace ngyuki\DbUnitHelper;

class DbUnitUtil
{
    public static function createYamlDataSet($yaml)
    {
        return new \PHPUnit_Extensions_Database_DataSet_YamlDataSet($yaml);
    }

    public static function createYamlDataSetByInline($yaml)
    {
        $yaml = preg_replace_callback('/^ +/sm', function ($m) {
            static $n;
            $n = $n ? $n : strlen($m[0]);
            return substr($m[0], $n);
        }, $yaml);

        return self::createYamlDataSet($yaml);
    }
}
