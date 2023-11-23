<?php

namespace PHPMaker2024\jootidigitalhealthcare;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use PHPMaker2024\jootidigitalhealthcare\Attributes\Delete;
use PHPMaker2024\jootidigitalhealthcare\Attributes\Get;
use PHPMaker2024\jootidigitalhealthcare\Attributes\Map;
use PHPMaker2024\jootidigitalhealthcare\Attributes\Options;
use PHPMaker2024\jootidigitalhealthcare\Attributes\Patch;
use PHPMaker2024\jootidigitalhealthcare\Attributes\Post;
use PHPMaker2024\jootidigitalhealthcare\Attributes\Put;

/**
 * Patient_Queues controller
 */
class PatientQueuesController extends ControllerBase
{
    // summary
    #[Map(["GET", "POST", "OPTIONS"], "/patientqueues", [PermissionMiddleware::class], "summary.Patient_Queues")]
    public function summary(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientQueuesSummary");
    }

    // PatientQueues (chart)
    #[Map(["GET", "POST", "OPTIONS"], "/patientqueues/PatientQueues", [PermissionMiddleware::class], "summary.Patient_Queues.PatientQueues")]
    public function PatientQueues(Request $request, Response $response, array $args): Response
    {
        return $this->runChart($request, $response, $args, "PatientQueuesSummary", "PatientQueues");
    }
}
