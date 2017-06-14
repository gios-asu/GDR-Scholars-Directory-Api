<?php

namespace GdrScholars\Http\Transformers;

use Flugg\Responder\Transformer;
use GdrScholars\Models\Opportunity;

class OpportunityTransformer extends Transformer
{
    /**
     * A list of all available relations.
     *
     * @var array
     */
    protected $relations = ['*'];

    /**
     * Transform the model data into a generic array.
     *
     * @param  Opportunity $opportunity
     * @return array
     */
    public function transform(Opportunity $opportunity):array
    {
        return [
            'id'                 => (int) $opportunity->id,
            'hostId'             => (int) $opportunity->host_id,
            'status'             => $opportunity->status,
            'title'              => $opportunity->title,
            'projectSummary'     => $opportunity->project_summary,
            'projectDescription' => $opportunity->project_description,
            'country'            => $opportunity->country,
            'discipline'         => $opportunity->discipline,
            'duration'           => $opportunity->duration,
            'numPositions'       => $opportunity->num_positions,
            'workEnvironment'    => $opportunity->work_environment,
            'benefits'           => $opportunity->benefits,
            'expectedOutcomes'   => $opportunity->expected_outcomes,
            'submittedAt'        => $opportunity->submitted_at,
            'createdAt'          => $opportunity->created_at->toDateTimeString(),
            'updatedAt'          => $opportunity->updated_at->toDateTimeString()
        ];
    }
}
