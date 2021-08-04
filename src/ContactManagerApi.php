<?php

namespace EcoOnline\ContactManagerApi;

/**
 * Class ContactManagerApi
 * @package EcoOnline\ContactManagerApi
 */
class ContactManagerApi
{
    /**
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function showApiSpec()
    {
        $filename = __DIR__ . 'v1//apispec/swagger.yaml';

        if (is_file($filename) && $filecontent = file_get_contents($filename)) {
            return response($filecontent)->header('Content-Type', 'application/json');
        }

        return response()->json('No spec found.', 404);
    }
}