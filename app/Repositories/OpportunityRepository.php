<?php

namespace GdrScholars\Repositories;

use GdrScholars\Models\Opportunity;
use InfyOm\Generator\Common\BaseRepository;

class OpportunityRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'status',
        'title',
        'country',
        'discipline',
        'duration',
        'num_positions'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Opportunity::class;
    }
}
