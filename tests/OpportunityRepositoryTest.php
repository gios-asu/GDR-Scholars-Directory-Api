<?php

use App\Models\Opportunity;
use App\Repositories\OpportunityRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OpportunityRepositoryTest extends TestCase
{
    use MakeOpportunityTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var OpportunityRepository
     */
    protected $opportunityRepo;

    public function setUp()
    {
        parent::setUp();
        $this->opportunityRepo = App::make(OpportunityRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateOpportunity()
    {
        $opportunity = $this->fakeOpportunityData();
        $createdOpportunity = $this->opportunityRepo->create($opportunity);
        $createdOpportunity = $createdOpportunity->toArray();
        $this->assertArrayHasKey('id', $createdOpportunity);
        $this->assertNotNull($createdOpportunity['id'], 'Created Opportunity must have id specified');
        $this->assertNotNull(Opportunity::find($createdOpportunity['id']), 'Opportunity with given id must be in DB');
        $this->assertModelData($opportunity, $createdOpportunity);
    }

    /**
     * @test read
     */
    public function testReadOpportunity()
    {
        $opportunity = $this->makeOpportunity();
        $dbOpportunity = $this->opportunityRepo->find($opportunity->id);
        $dbOpportunity = $dbOpportunity->toArray();
        $this->assertModelData($opportunity->toArray(), $dbOpportunity);
    }

    /**
     * @test update
     */
    public function testUpdateOpportunity()
    {
        $opportunity = $this->makeOpportunity();
        $fakeOpportunity = $this->fakeOpportunityData();
        $updatedOpportunity = $this->opportunityRepo->update($fakeOpportunity, $opportunity->id);
        $this->assertModelData($fakeOpportunity, $updatedOpportunity->toArray());
        $dbOpportunity = $this->opportunityRepo->find($opportunity->id);
        $this->assertModelData($fakeOpportunity, $dbOpportunity->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteOpportunity()
    {
        $opportunity = $this->makeOpportunity();
        $resp = $this->opportunityRepo->delete($opportunity->id);
        $this->assertTrue($resp);
        $this->assertNull(Opportunity::find($opportunity->id), 'Opportunity should not exist in DB');
    }
}
