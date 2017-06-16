<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HostApiTest extends TestCase
{
    use MakeHostTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateHost()
    {
        $host = $this->fakeHostData();
        $this->json('POST', '/api/v1/hosts', $host);

        $this->assertApiResponse($host);
    }

    /**
     * @test
     */
    public function testReadHost()
    {
        $host = $this->makeHost();
        $this->json('GET', '/api/v1/hosts/'.$host->id);

        $this->assertApiResponse($host->toArray());
    }

    /**
     * @test
     */
    public function testUpdateHost()
    {
        $host = $this->makeHost();
        $editedHost = $this->fakeHostData();

        $this->json('PUT', '/api/v1/hosts/'.$host->id, $editedHost);

        $this->assertApiResponse($editedHost);
    }

    /**
     * @test
     */
    public function testDeleteHost()
    {
        $host = $this->makeHost();
        $this->json('DELETE', '/api/v1/hosts/'.$host->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/hosts/'.$host->id);

        $this->assertResponseStatus(404);
    }
}
