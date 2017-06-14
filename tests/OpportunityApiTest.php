<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OpportunityApiTest extends TestCase
{
    use MakeOpportunityTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateOpportunity()
    {
        $opportunity = $this->fakeOpportunityData();
        $this->json('POST', '/api/v1/opportunities', $opportunity);

        $this->assertApiResponse($opportunity);
    }

    /**
     * @test
     */
    public function testReadOpportunity()
    {
        $opportunity = $this->makeOpportunity();
        $this->json('GET', '/api/v1/opportunities/'.$opportunity->id);

        $this->assertApiResponse($opportunity->toArray());
    }

    /**
     * @test
     */
    public function testUpdateOpportunity()
    {
        $opportunity = $this->makeOpportunity();
        $editedOpportunity = $this->fakeOpportunityData();

        $this->json('PUT', '/api/v1/opportunities/'.$opportunity->id, $editedOpportunity);

        $this->assertApiResponse($editedOpportunity);
    }

    /**
     * @test
     */
    public function testDeleteOpportunity()
    {
        $opportunity = $this->makeOpportunity();
        $this->json('DELETE', '/api/v1/opportunities/'.$opportunity->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/opportunities/'.$opportunity->id);

        $this->assertResponseStatus(404);
    }
}
