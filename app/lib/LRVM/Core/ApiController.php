<?php

namespace LRVM\Core;

use Response;

abstract class ApiController extends \BaseController {

    /**
     * Return JSON with error message
     *
     * @param $msg
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function _fail($msg) {

        $response = ['success' => false, 'error'];
        return Response::json($response);

    }

    /**
     * Add success as a param and return as JSON
     *
     * @param $params (optional)
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function _succeed($params = []) {

        $params['success'] = true;
        return Response::json($params);

    }



}