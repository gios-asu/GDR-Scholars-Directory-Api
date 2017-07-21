<?php

namespace GdrScholars\Http\Controllers\API\V1;

use GdrScholars\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Response;
use Flugg\Responder\Traits\RespondsWithJson;

/**
 * Class UploadAPIController
 * @package GdrScholars\Http\Controllers\API\V1
 */
class UploadAPIController extends AppBaseController
{
    use RespondsWithJson;

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/uploads/submit",
     *      summary="Upload file to server",
     *      tags={"Uploads"},
     *      description="Upload file to server",
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
    public function create(Request $request) {

        // store file in S3 bucket, using auto-generated filename (time-based)
        if (!empty($request->file('fileUpload'))) {
            $file = $request->file('fileUpload')->store('gdr-scholars-directory', 's3');
            $filePath = Storage::disk('s3')->url($file);
            // insert uploaded filename and full file path into Request object
            $request->request->add(['file' => $file]);
            $request->request->add(['filePath' => $filePath]);

            return $this->sendResponse($request->all(), 'File uploaded successfully');

        } else {
            return $this->errorResponse('invalid_file', 500, 'Invalid or missing file in submission.');
        }
    }

    public function delete( Request $request ) {
        $deleteFile = $request->input( 'fileName' );
        if ( Storage::disk( 's3' )->exists( $deleteFile ) ) {
            Storage::delete( $deleteFile );

            if ( Storage::disk( 's3' )->exists( $deleteFile ) ) {
                return $this->errorResponse('file_deletion_error', 500, 'Unable to delete requested file.');
            }
        } else {
            return $this->errorResponse('file_not_found', 500, 'Requested file does not exist.');
        }

        return $this->successResponse(null, 'File deleted successfully');
    }
}
