<?php

namespace GdrScholars\Models;

use Eloquent as Model;
use Flugg\Responder\Contracts\Transformable;
use GdrScholars\Http\Transformers\OpportunityTransformer;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Opportunity",
 *      required={"status", "title", "country", "discipline", "duration", "num_positions"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="host_id",
 *          description="host_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="status",
 *          description="status",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="title",
 *          description="title",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="country",
 *          description="country",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="discipline",
 *          description="discipline",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="duration",
 *          description="duration",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="num_positions",
 *          description="num_positions",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="work_environment",
 *          description="work_environment",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="project_description",
 *          description="project_description",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="benefits",
 *          description="benefits",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="expected_outcomes",
 *          description="expected_outcomes",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="project_summary",
 *          description="project_summary",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="is_filled",
 *          description="is_filled",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="submitted_at",
 *          description="submitted_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class Opportunity extends Model implements Transformable
{
    use SoftDeletes;

    public $table = 'opportunities';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'host_id',
        'status',
        'title',
        'country',
        'discipline',
        'duration',
        'num_positions',
        'work_environment',
        'project_description',
        'benefits',
        'expected_outcomes',
        'project_summary',
        'is_filled'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'host_id' => 'integer',
        'status' => 'string',
        'title' => 'string',
        'country' => 'string',
        'discipline' => 'string',
        'duration' => 'string',
        'num_positions' => 'string',
        'work_environment' => 'string',
        'project_description' => 'string',
        'benefits' => 'string',
        'expected_outcomes' => 'string',
        'project_summary' => 'string',
        'is_filled' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'status' => 'required',
        'title' => 'required',
        'country' => 'required',
        'discipline' => 'required',
        'duration' => 'required',
        'num_positions' => 'required'
    ];

    /**
     * The transformer used to transform the model data.
     *
     * @return Transformer|callable|string|null
     */
    public static function transformer()
    {
        return OpportunityTransformer::class;
    }
}
