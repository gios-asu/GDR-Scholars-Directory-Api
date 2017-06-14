<?php

use Faker\Factory as Faker;
use GdrScholars\Models\Opportunity;
use GdrScholars\Repositories\OpportunityRepository;

trait MakeOpportunityTrait
{
    /**
     * Create fake instance of Opportunity and save it in database
     *
     * @param array $opportunityFields
     * @return Opportunity
     */
    public function makeOpportunity($opportunityFields = [])
    {
        /** @var OpportunityRepository $opportunityRepo */
        $opportunityRepo = App::make(OpportunityRepository::class);
        $theme = $this->fakeOpportunityData($opportunityFields);
        return $opportunityRepo->create($theme);
    }

    /**
     * Get fake instance of Opportunity
     *
     * @param array $opportunityFields
     * @return Opportunity
     */
    public function fakeOpportunity($opportunityFields = [])
    {
        return new Opportunity($this->fakeOpportunityData($opportunityFields));
    }

    /**
     * Get fake data of Opportunity
     *
     * @param array $postFields
     * @return array
     */
    public function fakeOpportunityData($opportunityFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'host_id' => $fake->randomDigitNotNull,
            'status' => $fake->word,
            'title' => $fake->word,
            'country' => $fake->word,
            'discipline' => $fake->word,
            'duration' => $fake->word,
            'num_positions' => $fake->word,
            'work_environment' => $fake->text,
            'project_description' => $fake->text,
            'benefits' => $fake->text,
            'expected_outcomes' => $fake->text,
            'project_summary' => $fake->text,
            'is_filled' => $fake->randomDigitNotNull,
            'submitted_at' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $opportunityFields);
    }
}
