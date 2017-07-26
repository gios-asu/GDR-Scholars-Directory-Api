<?php

namespace GdrScholars\Http\Controllers\API\V1;

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
    public function submitApplication(Request $request) {

        /** @var Host $host */
        $host = $this->hostRepository->findWithoutFail($request->input('hostId'));

        if (empty($host)) {
            return $this->sendError('Unable to submit application. Host not found');
        }

        $opportunityTitle = $host->opportunity->title;
        $request->request->add(['opportunityTitle' => $opportunityTitle]);

        Mail::to($host->respondent_email)
            ->send(new SubmitApplication($request->all()));

        return $this->sendResponse($request->all(), 'Application submitted successfully');
    }
}
