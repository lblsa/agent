<?php 
require_once 'PHPUnit/Autoload.php';
require_once 'secagent.php';

class SecAgentApiFranchiseTest extends PHPUnit_Framework_TestCase {
    protected $api;

    protected function setUp()
    {
        $this->api = new SecAgent('', 'http://stage.secagent.ru/app_dev.php');
    }

    protected function tearDown()
    {
        $this->api = NULL;
    }

    function testGetFranchiseListWithLastSlash()
    {
        $this->markTestSkipped('Fix url.');

        try
        {
            $res = $this->api->send('/franchise');
            $this->assertTrue(true);
        }
        catch(SecAgentException $e)
        {
            $this->assertTrue(false);
        }
    }

    function testGetFranchiseListWithOutLastSlash()
    {
        try
        {
            $res = $this->api->send('/franchise/');
            $this->assertTrue(true);
        }
        catch(SecAgentException $e)
        {
            $this->assertTrue(false);
        }
    }

    function testGetFranchiseListInvalidUrl()
    {
        try
        {
            $res = $this->api->send('/franchise/x');
            $this->assertTrue(true);
        }
        catch(SecAgentException $e)
        {
            $this->assertEquals($e->getMessage(), 404);
        }
    }

    // Create
    function testCreateFranchise()
    {
        $this->markTestSkipped('Fix data.');

        try
        {
            $data = array(
                    'franchise[brand]' => 'test_brand1',
                    'franchise[logo]'  => 'test_logo1',
                    'franchise[industry]' => 'horeca'
                    );

            $res = $this->api->send('/franchise/', 'POST', $data);

            $this->assertTrue(true);
        }
        catch(SecAgentException $e)
        {
            $this->assertEquals($e->getMessage(), 404);
        }
    }

    function testCreateFranchiseWithNoData()
    {
        $this->markTestIncomplete();
    }

    function testCreateFranchiseInvalidBrand()
    {
        $this->markTestIncomplete();
    }

    function testCreateFranchiseInvalidLogo()
    {
        $this->markTestIncomplete();
    }

    function testCreateFranchiseInvalidIndustry()
    {
        $this->markTestIncomplete();
    }

    // Update
    function testUpdateFranchise()
    {
        $this->markTestIncomplete();
    }

    function testUpdateFranchiseWithEmptyData()
    {
        $this->markTestIncomplete();
    }

    function testUpdateFranchiseInvalidBrand()
    {
        $this->markTestIncomplete();
    }

    function testUpdateFranchiseInvalidLogo()
    {
        $this->markTestIncomplete();
    }

    function testUpdateFranchiseInvalidIndustry()
    {
        $this->markTestIncomplete();
    }

    // Delete
    function testDeleteFranchise()
    {
        $this->markTestIncomplete();
    }

    function testDeleteFranchiseInvalidId()
    {
        $this->markTestIncomplete();
    }
}
