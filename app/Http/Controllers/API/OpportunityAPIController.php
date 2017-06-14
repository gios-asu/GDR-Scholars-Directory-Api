<?php

namespace GdrScholars\Http\Controllers\API;

use GdrScholars\Http\Requests\API\CreateOpportunityAPIRequest;
use GdrScholars\Http\Requests\API\UpdateOpportunityAPIRequest;
use GdrScholars\Models\Opportunity;
use GdrScholars\Repositories\OpportunityRepository;
use Illuminate\Http\Request;
use GdrScholars\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class OpportunityController
 * @package GdrScholars\Http\Controllers\API
 */

class OpportunityAPIController extends AppBaseController
{
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

        return $this->sendResponse($opportunities->toArray(), 'Opportunities retrieved successfully');
    }

    /**
     * @param CreateOpportunityAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/opportunities",
     *      summary="Store a newly created Opportunity in storage",
     *      tags={"Opportunity"},
     *      description="Store Opportunity",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Opportunity that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Opportunity")
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
    public function store(CreateOpportunityAPIRequest $request)
    {
        $input = $request->all();

        $opportunities = $this->opportunityRepository->create($input);

        return $this->sendResponse($opportunities->toArray(), 'Opportunity saved successfully');
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

        return $this->sendResponse($opportunity->toArray(), 'Opportunity retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateOpportunityAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/opportunities/{id}",
     *      summary="Update the specified Opportunity in storage",
     *      tags={"Opportunity"},
     *      description="Update Opportunity",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Opportunity",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Opportunity that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Opportunity")
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
    public function update($id, UpdateOpportunityAPIRequest $request)
    {
        $input = $request->all();

        /** @var Opportunity $opportunity */
        $opportunity = $this->opportunityRepository->findWithoutFail($id);

        if (empty($opportunity)) {
            return $this->sendError('Opportunity not found');
        }

        $opportunity = $this->opportunityRepository->update($input, $id);

        return $this->sendResponse($opportunity->toArray(), 'Opportunity updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/opportunities/{id}",
     *      summary="Remove the specified Opportunity from storage",
     *      tags={"Opportunity"},
     *      description="Delete Opportunity",
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
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var Opportunity $opportunity */
        $opportunity = $this->opportunityRepository->findWithoutFail($id);

        if (empty($opportunity)) {
            return $this->sendError('Opportunity not found');
        }

        $opportunity->delete();

        return $this->sendResponse($id, 'Opportunity deleted successfully');
    }
}
