<?php

use App\Models\Host;
use App\Repositories\HostRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HostRepositoryTest extends TestCase
{
    use MakeHostTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var HostRepository
     */
    protected $hostRepo;

    public function setUp()
    {
        parent::setUp();
        $this->hostRepo = App::make(HostRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateHost()
    {
        $host = $this->fakeHostData();
        $createdHost = $this->hostRepo->create($host);
        $createdHost = $createdHost->toArray();
        $this->assertArrayHasKey('id', $createdHost);
        $this->assertNotNull($createdHost['id'], 'Created Host must have id specified');
        $this->assertNotNull(Host::find($createdHost['id']), 'Host with given id must be in DB');
        $this->assertModelData($host, $createdHost);
    }

    /**
     * @test read
     */
    public function testReadHost()
    {
        $host = $this->makeHost();
        $dbHost = $this->hostRepo->find($host->id);
        $dbHost = $dbHost->toArray();
        $this->assertModelData($host->toArray(), $dbHost);
    }

    /**
     * @test update
     */
    public function testUpdateHost()
    {
        $host = $this->makeHost();
        $fakeHost = $this->fakeHostData();
        $updatedHost = $this->hostRepo->update($fakeHost, $host->id);
        $this->assertModelData($fakeHost, $updatedHost->toArray());
        $dbHost = $this->hostRepo->find($host->id);
        $this->assertModelData($fakeHost, $dbHost->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteHost()
    {
        $host = $this->makeHost();
        $resp = $this->hostRepo->delete($host->id);
        $this->assertTrue($resp);
        $this->assertNull(Host::find($host->id), 'Host should not exist in DB');
    }
}
