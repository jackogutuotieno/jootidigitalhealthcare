<?php

namespace PHPMaker2023\jootidigitalhealthcare;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * Patient_Queues controller
 */
class PatientQueuesController extends ControllerBase
{
    // summary
    public function summary(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientQueuesSummary");
    }

    // PatientQueues
    public function PatientQueues(Request $request, Response $response, array $args): Response
    {
        return $this->runChart($request, $response, $args, "PatientQueuesSummary", "PatientQueues");
    }
}
