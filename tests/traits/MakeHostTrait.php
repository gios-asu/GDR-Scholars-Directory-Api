<?php

use Faker\Factory as Faker;
use GdrScholars\Models\Host;
use GdrScholars\Repositories\HostRepository;

trait MakeHostTrait
{
    /**
     * Create fake instance of Host and save it in database
     *
     * @param array $hostFields
     * @return Host
     */
    public function makeHost($hostFields = [])
    {
        /** @var HostRepository $hostRepo */
        $hostRepo = App::make(HostRepository::class);
        $theme = $this->fakeHostData($hostFields);
        return $hostRepo->create($theme);
    }

    /**
     * Get fake instance of Host
     *
     * @param array $hostFields
     * @return Host
     */
    public function fakeHost($hostFields = [])
    {
        return new Host($this->fakeHostData($hostFields));
    }

    /**
     * Get fake data of Host
     *
     * @param array $postFields
     * @return array
     */
    public function fakeHostData($hostFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'response_id' => $fake->randomDigitNotNull,
            'response_number' => $fake->randomDigitNotNull,
            'respondent_name' => $fake->word,
            'respondent_email' => $fake->word,
            'host_name' => $fake->word,
            'host_org_type' => $fake->word,
            'host_support' => $fake->word,
            'host_website' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $hostFields);
    }
}
