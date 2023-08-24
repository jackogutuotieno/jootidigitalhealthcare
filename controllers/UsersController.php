<?php

namespace PHPMaker2023\jootidigitalhealthcare;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * Users controller
 */
class UsersController extends ControllerBase
{
    // summary
    public function summary(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "UsersSummary");
    }

    // Users
    public function Users(Request $request, Response $response, array $args): Response
    {
        return $this->runChart($request, $response, $args, "UsersSummary", "Users");
    }
}
