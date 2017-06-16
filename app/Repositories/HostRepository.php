<?php

namespace GdrScholars\Repositories;

use GdrScholars\Models\Host;
use InfyOm\Generator\Common\BaseRepository;

class HostRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'host_name',
        'host_org_type',
        'host_support',
        'host_website'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Host::class;
    }
}
