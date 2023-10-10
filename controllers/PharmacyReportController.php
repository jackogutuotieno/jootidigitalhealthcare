<?php

namespace PHPMaker2023\jootidigitalhealthcare;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * Pharmacy_Report controller
 */
class PharmacyReportController extends ControllerBase
{
    // summary
    public function summary(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PharmacyReportSummary");
    }
}
