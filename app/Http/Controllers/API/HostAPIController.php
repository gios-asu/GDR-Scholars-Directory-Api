<?php

namespace GdrScholars\Http\Controllers\API;

use GdrScholars\Http\Controllers\AppBaseController;
use GdrScholars\Mail\SubmitApplication;
use GdrScholars\Models\Host;
use GdrScholars\Repositories\HostRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class HostController
 * @package GdrScholars\Http\Controllers\API
 */

class HostAPIController extends AppBaseController
{
    /** @var  HostRepository */
    private $hostRepository;

    public function __construct(HostRepository $hostRepo)
    {
        $this->hostRepository = $hostRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/hosts",
     *      summary="Get a listing of the Hosts.",
     *      tags={"Host"},
     *      description="Get all Hosts",
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
     *                  @SWG\Items(ref="#/definitions/Host")
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
        $this->hostRepository->pushCriteria(new RequestCriteria($request));
        $this->hostRepository->pushCriteria(new LimitOffsetCriteria($request));
        $hosts = $this->hostRepository->all();

        return $this->sendResponse($hosts->toArray(), 'Hosts retrieved successfully');
    }

    /**
     * @param CreateHostAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/hosts",
     *      summary="Store a newly created Host in storage",
     *      tags={"Host"},
     *      description="Store Host",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Host that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Host")
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
     *                  ref="#/definitions/Host"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateHostAPIRequest $request)
    {
        $input = $request->all();

        $hosts = $this->hostRepository->create($input);

        return $this->sendResponse($hosts->toArray(), 'Host saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/hosts/{id}",
     *      summary="Display the specified Host",
     *      tags={"Host"},
     *      description="Get Host",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Host",
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
     *                  ref="#/definitions/Host"
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
        /** @var Host $host */
        $host = $this->hostRepository->findWithoutFail($id);

        if (empty($host)) {
            return $this->sendError('Host not found');
        }

        return $this->sendResponse($host->toArray(), 'Host retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateHostAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/hosts/{id}",
     *      summary="Update the specified Host in storage",
     *      tags={"Host"},
     *      description="Update Host",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Host",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Host that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Host")
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
     *                  ref="#/definitions/Host"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateHostAPIRequest $request)
    {
        $input = $request->all();

        /** @var Host $host */
        $host = $this->hostRepository->findWithoutFail($id);

        if (empty($host)) {
            return $this->sendError('Host not found');
        }

        $host = $this->hostRepository->update($input, $id);

        return $this->sendResponse($host->toArray(), 'Host updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/hosts/{id}",
     *      summary="Remove the specified Host from storage",
     *      tags={"Host"},
     *      description="Delete Host",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Host",
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
        /** @var Host $host */
        $host = $this->hostRepository->findWithoutFail($id);

        if (empty($host)) {
            return $this->sendError('Host not found');
        }

        $host->delete();

        return $this->sendResponse($id, 'Host deleted successfully');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/hosts/{id}/apply",
     *      summary="Submit application to Host Sponsor",
     *      tags={"Host"},
     *      description="Submit Application",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Host Sponsor",
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
     *                  ref="#/definitions/Host"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function submitApplication($id, Request $request) {

        /** @var Host $host */
        $host = $this->hostRepository->findWithoutFail($id);

        if (empty($host)) {
            return $this->sendError('Unable to submit application. Host not found');
        }

        $opportunityTitle = $host->opportunity->title;

        // store fileUpload input in S3 bucket, using auto-generated filename (time-based)
        // $filePath = $request->file('fileUpload')->store('gdr-scholars-directory', 's3');

        // insert uploaded file path and opportunity title into Request object
        // $request->request->add(['filePath' => $filePath]);
        $request->request->add(['opportunityTitle' => $opportunityTitle]);

        // Mail::to($host->respondent_email)
        //     ->send(new SubmitApplication($request->all()));

        return $this->sendResponse(null, 'Application submitted successfully');
    }
}
