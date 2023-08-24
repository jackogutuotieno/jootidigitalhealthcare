<?php

namespace PHPMaker2023\jootidigitalhealthcare;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * Patient_Lab_Billing controller
 */
class PatientLabBillingController extends ControllerBase
{
    // summary
    public function summary(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientLabBillingSummary");
    }
}
