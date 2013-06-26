<?php 
require_once 'PHPUnit/Autoload.php';
require_once 'secagent.php';

class SecAgentApiPointTest extends PHPUnit_Framework_TestCase {
    protected $api;

    protected function setUp()
    {
        $this->api = new SecAgent('', 'http://stage.secagent.ru');
    }

    protected function tearDown()
    {
        $this->api = NULL;
    }

    // Create
    function testCreatePoint()
    {
        try
        {
            $data = 'point[title]=test_title1&point[description]=test_description1&point[active]=1&point[latitude]=55.77&point[longitude]=37.58&point[franchise]=1';

            $obj = $this->api->createPoint($data);
            $this->assertTrue(is_object($obj));

            $this->api->deletePoint($obj->id);
        }
        catch(SecAgentException $e)
        {
            $this->fail($e->getMessage()."\n");
        }
    }

    function testCreatePointWithNoData()
    {
        try
        {
            $obj = $this->api->createPoint('');

            $this->fail("This point should not be reachable\n");
        }
        catch(SecAgentException $e)
        {
            if (500 == $e->getMessage())
                $this->fail($e->getMessage()."\n");
        }
    }

    function testCreatePointInvalidBrand()
    {
        try
        {
            $data = 'point[title]=test_title1&point[description]=test_description1&point[active]=1&point[latitude]=55.77&point[longitude]=37.58&point[franchise]=-1';

            $obj = $this->api->createPoint($data);

            $this->fail("This point should not be reachable\n");
        }
        catch(SecAgentException $e)
        {
            if (500 == $e->getMessage())
                $this->fail($e->getMessage()."\n");
        }
    }

    // Update
    function testUpdatePoint()
    {
        try
        {
            $data = 'point[title]=test_title1&point[description]=test_description1&point[active]=1&point[latitude]=55.77&point[longitude]=37.58&point[franchise]=1';

            $obj = $this->api->createPoint($data);

            $data = 'point[title]=new_test_title1&point[description]=new_test_description1&point[active]=1&point[latitude]=55.77&point[longitude]=37.58&point[franchise]=1';

            $obj2 = $this->api->updatePoint($obj->id, $data);

            $this->api->deletePoint($obj->id);
        }
        catch(SecAgentException $e)
        {
            $this->fail($e->getMessage()."\n");
        }
    }

    function testUpdatePointWithEmptyData()
    {
        $obj = null;
        try
        {
            $data = 'point[title]=test_title1&point[description]=test_description1&point[active]=1&point[latitude]=55.77&point[longitude]=37.58&point[franchise]=1';

            $obj = $this->api->createPoint($data);

            $obj2 = $this->api->updatePoint($obj->id, '');

            $this->fail("This point should not be reachable\n");
        }
        catch(SecAgentException $e)
        {
            if (500 == $e->getMessage())
                $this->fail($e->getMessage()."\n");
            else
            {
                if (is_object($obj))
                    $this->api->deletePoint($obj->id);
            }
        }
    }

    function testUpdatePointInvalidBrand()
    {
        $obj = null;
        try
        {
            $data = 'point[title]=test_title1&point[description]=test_description1&point[active]=1&point[latitude]=55.77&point[longitude]=37.58&point[franchise]=1';

            $obj = $this->api->createPoint($data);

            $data = 'point[title]=new_test_title1&point[description]=new_test_description1&point[active]=1&point[latitude]=55.77&point[longitude]=37.58&point[franchise]=X';

            $obj2 = $this->api->updatePoint($obj->id, $data);

            $this->fail("This point should not be reachable\n");

        }
        catch(SecAgentException $e)
        {
            if (500 == $e->getMessage())
                $this->fail($e->getMessage()."\n");
            else
            {
                if (is_object($obj))
                    $this->api->deletePoint($obj->id);
            }
        }
    }

    function testDeletePointInvalidId()
    {
        try
        {
            $this->api->deletePoint('X');

            $this->fail("This point should not be reachable\n");

        }
        catch(SecAgentException $e)
        {
            if (500 == $e->getMessage())
                $this->fail($e->getMessage()."\n");
        }
    }
}
