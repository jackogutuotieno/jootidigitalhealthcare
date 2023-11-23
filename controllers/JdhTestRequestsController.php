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

class JdhTestRequestsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/jdhtestrequestslist[/{request_id}]", [PermissionMiddleware::class], "list.jdh_test_requests")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhTestRequestsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/jdhtestrequestsadd[/{request_id}]", [PermissionMiddleware::class], "add.jdh_test_requests")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhTestRequestsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/jdhtestrequestsview[/{request_id}]", [PermissionMiddleware::class], "view.jdh_test_requests")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhTestRequestsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/jdhtestrequestsedit[/{request_id}]", [PermissionMiddleware::class], "edit.jdh_test_requests")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhTestRequestsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/jdhtestrequestsdelete[/{request_id}]", [PermissionMiddleware::class], "delete.jdh_test_requests")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhTestRequestsDelete");
    }
}
