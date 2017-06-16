<?php

namespace GdrScholars\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Host",
 *      required={"respondent_name", "respondent_email", "host_name", "host_org_type", "host_support", "host_website"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="response_id",
 *          description="response_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="response_number",
 *          description="response_number",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="respondent_name",
 *          description="respondent_name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="respondent_email",
 *          description="respondent_email",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="host_name",
 *          description="host_name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="host_org_type",
 *          description="host_org_type",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="host_support",
 *          description="host_support",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="host_website",
 *          description="host_website",
 *          type="string"
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
class Host extends Model
{
    use SoftDeletes;

    public $table = 'hosts';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'response_id',
        'response_number',
        'respondent_name',
        'respondent_email',
        'host_name',
        'host_org_type',
        'host_support',
        'host_website'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'response_id' => 'integer',
        'response_number' => 'integer',
        'respondent_name' => 'string',
        'respondent_email' => 'string',
        'host_name' => 'string',
        'host_org_type' => 'string',
        'host_support' => 'string',
        'host_website' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'respondent_name' => 'required',
        'respondent_email' => 'required',
        'host_name' => 'required',
        'host_org_type' => 'required',
        'host_support' => 'required',
        'host_website' => 'required'
    ];

    /*
     * Get the Opportunity listing this Host sponsors
     */
    public function opportunity()
    {
        return $this->hasOne('GdrScholars\Models\Opportunity');
    }
}
