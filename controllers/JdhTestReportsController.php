<?php

namespace PHPMaker2024\jootidigitalhealthcare;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use PHPMaker2024\jootidigitalhealthcare\Attributes\Delete;
use PHPMaker2024\jootidigitalhealthcare\Attributes\Get;
use PHPMaker2024\jootidigitalhealthcare\Attributes\Map;
use PHPMaker2024\jootidigitalhealthcare\Attributes\Options;
use PHPMaker2024\jootidigitalhealthcare\Attributes\Patch;
use PHPMaker2024\jootidigitalhealthcare\Attributes\Post;
use PHPMaker2024\jootidigitalhealthcare\Attributes\Put;

class JdhTestReportsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/jdhtestreportslist[/{report_id}]", [PermissionMiddleware::class], "list.jdh_test_reports")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhTestReportsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/jdhtestreportsadd[/{report_id}]", [PermissionMiddleware::class], "add.jdh_test_reports")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhTestReportsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/jdhtestreportsview[/{report_id}]", [PermissionMiddleware::class], "view.jdh_test_reports")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhTestReportsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/jdhtestreportsedit[/{report_id}]", [PermissionMiddleware::class], "edit.jdh_test_reports")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhTestReportsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/jdhtestreportsdelete[/{report_id}]", [PermissionMiddleware::class], "delete.jdh_test_reports")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhTestReportsDelete");
    }
}
