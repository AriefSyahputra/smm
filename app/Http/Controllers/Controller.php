<?php

namespace App\Http\Controllers;

use App\Traits\Response;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    use Response;

    public function single_message($message)
    {
        return [array($message)];
    }

    /** Response Code */
    protected const HTTP_OK             = 200;
    protected const HTTP_BAD_REQUEST    = 400;
    protected const HTTP_NOT_FOUND      = 404;
    protected const HTTP_SERVER_ERROR   = 500;

    /** Response Message */
    protected const SUBMIT_OK     = 'Data has been submitted';
    protected const UPDATE_OK     = 'Data has been submitted';
}
