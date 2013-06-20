<?php 
require_once 'PHPUnit/Autoload.php';
require_once 'secagent.php';

class SecAgentApiPointTest extends PHPUnit_Framework_TestCase {
    protected $api;

    protected function setUp()
    {
        $this->api = new SecAgent('', 'http://stage.secagent.ru/app_dev.php');
    }

    protected function tearDown()
    {
        $this->api = NULL;
    }

    function testGetPointListWithLastSlash()
    {
//        $this->markTestSkipped('Fix url.');

        try
        {
            $res = $this->api->send('/point/');
            $this->assertTrue(true);
        }
        catch(SecAgentException $e)
        {
            $this->assertTrue(false);
        }
    }

    function testGetPointListWithOutLastSlash()
    {
        try
        {
            $res = $this->api->send('/point');
            $this->assertTrue(true);
        }
        catch(SecAgentException $e)
        {
            $this->assertTrue(false);
        }
    }

    function testGetPointListInvalidUrl()
    {
        try
        {
            $res = $this->api->send('/point/x');
            $this->assertTrue(false);
        }
        catch(SecAgentException $e)
        {
            $this->assertEquals($e->getMessage(), 404);
        }
    }

    // Create
    function testCreatePoint()
    {
//        $this->markTestSkipped('Fix data.');

        try
        {
            $data = array(
                    'point[title]' => 'test_title1',
                    'point[description]'  => 'test_description1',
                    'point[active]'  => 'true',
                    'point[latitude]'  => '55.77',
                    'point[longitude]'  => '37.58',
                    'point[franchise]'  => 1
                    );

            $res = $this->api->send('/point/', 'POST', $data);

            $this->assertTrue(true);
        }
        catch(SecAgentException $e)
        {
            echo $e->getMessage()."\n";
            $this->assertEquals(false);
        }
    }

    /*
    function testCreatePointWithNoData()
    {
        $this->markTestIncomplete();
    }

    function testCreatePointInvalidBrand()
    {
        $this->markTestIncomplete();
    }

    function testCreatePointInvalidLogo()
    {
        $this->markTestIncomplete();
    }

    function testCreatePointInvalidIndustry()
    {
        $this->markTestIncomplete();
    }

    // Update
    function testUpdatePoint()
    {
        $this->markTestIncomplete();
    }

    function testUpdatePointWithEmptyData()
    {
        $this->markTestIncomplete();
    }

    function testUpdatePointInvalidBrand()
    {
        $this->markTestIncomplete();
    }

    function testUpdatePointInvalidLogo()
    {
        $this->markTestIncomplete();
    }

    function testUpdatePointInvalidIndustry()
    {
        $this->markTestIncomplete();
    }

    // Delete
    function testDeletePoint()
    {
        $this->markTestIncomplete();
    }

    function testDeletePointInvalidId()
    {
        $this->markTestIncomplete();
    }
    */
}
