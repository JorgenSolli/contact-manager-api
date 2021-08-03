<?php

namespace EcoOnline\EcoPackage\v1\Http\Controllers;

use App\Http\Controllers\Controller;
use EcoOnline\EcoPackage\ContactManager;

/**
 * Class ApiSpecController
 * @package EcoOnline\ContactManager
 */
class ApiSpecController extends Controller
{
    /**
     * @var ContactManager
     */
    protected $contactManager;

    /**
     * ApiSpecController constructor.
     *
     * @param ContactManager $contactManager
     */
    public function __construct(ContactManager $contactManager)
    {
        $this->contactManager = $contactManager;
    }

    /**
     * Show the API specification
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function index()
    {
        return $this->contactManager->showApiSpec();
    }
}
