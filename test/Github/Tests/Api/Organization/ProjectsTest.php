<?php

namespace Github\Tests\Api\Organization;

use Github\Tests\Api\TestCase;

class ProjectsTest extends TestCase
{
    /**
     * @test
     */
    public function shouldGetAllRepositoryProjects()
    {
        $expectedValue = array(array('name' => 'Test project 1'));

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('/orgs/KnpLabs/projects')
            ->will($this->returnValue($expectedValue));

        $this->assertEquals($expectedValue, $api->all('KnpLabs'));
    }

    /**
     * @test
     * @expectedException \Github\Exception\MissingArgumentException
     */
    public function shouldNotCreateWithoutName()
    {
        $data = array();

        $api = $this->getApiMock();
        $api->expects($this->never())
            ->method('post');

        $api->create('KnpLabs', $data);
    }

    /**
     * @test
     */
    public function shouldCreateColumn()
    {
        $expectedValue = array('project1data');
        $data = array('name' => 'Project 1');

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with('/orgs/KnpLabs/projects', $data)
            ->will($this->returnValue($expectedValue));

        $this->assertEquals($expectedValue, $api->create('KnpLabs', $data));
    }

    /**
     * @return string
     */
    protected function getApiClass()
    {
        return \Github\Api\Organization\Projects::class;
    }
}
