<?php

namespace GdrScholars\Http\Controllers\API;

use GdrScholars\Http\Requests\API\CreateOpportunityAPIRequest;
use GdrScholars\Http\Requests\API\UpdateOpportunityAPIRequest;
use GdrScholars\Models\Opportunity;
use GdrScholars\Repositories\OpportunityRepository;
use Illuminate\Http\Request;
use GdrScholars\Http\Controllers\AppBaseController;
use GdrScholars\Http\Transformers\OpportunityTransformer;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Flugg\Responder\Traits\RespondsWithJson;

/**
 * Class OpportunityController
 * @package GdrScholars\Http\Controllers\API
 */

class OpportunityAPIController extends AppBaseController
{
    use RespondsWithJson;

    /** @var  OpportunityRepository */
    private $opportunityRepository;

    public function __construct(OpportunityRepository $opportunityRepo)
    {
        $this->opportunityRepository = $opportunityRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/opportunities",
     *      summary="Get a listing of the Opportunities.",
     *      tags={"Opportunity"},
     *      description="Get all Opportunities",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Opportunity")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $this->opportunityRepository->pushCriteria(new RequestCriteria($request));
        $this->opportunityRepository->pushCriteria(new LimitOffsetCriteria($request));
        $opportunities = $this->opportunityRepository->all();

        return $this->successResponse($opportunities);
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/opportunities/{id}",
     *      summary="Display the specified Opportunity",
     *      tags={"Opportunity"},
     *      description="Get Opportunity",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Opportunity",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Opportunity"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Opportunity $opportunity */
        $opportunity = $this->opportunityRepository->findWithoutFail($id);

        if (empty($opportunity)) {
            return $this->sendError('Opportunity not found');
        }

        return $this->successResponse($opportunity);
    }
}
