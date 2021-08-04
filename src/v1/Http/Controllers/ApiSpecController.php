<?php

namespace EcoOnline\ContactManagerApi\v1\Http\Controllers;

use App\Http\Controllers\Controller;
use EcoOnline\ContactManagerApi\ContactManagerApi;

/**
 * Class ApiSpecController
 * @package EcoOnline\ContactManagerApi
 */
class ApiSpecController extends Controller
{
    /**
     * @var ContactManagerApi
     */
    protected $ContactManagerApi;

    /**
     * ApiSpecController constructor.
     *
     * @param ContactManagerApi $ContactManagerApi
     */
    public function __construct(ContactManagerApi $ContactManagerApi)
    {
        $this->ContactManagerApi = $ContactManagerApi;
    }

    /**
     * Show the API specification
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function index()
    {
        return $this->ContactManagerApi->showApiSpec();
    }
}
