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

class JdhServicesController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/jdhserviceslist[/{service_id}]", [PermissionMiddleware::class], "list.jdh_services")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhServicesList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/jdhservicesadd[/{service_id}]", [PermissionMiddleware::class], "add.jdh_services")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhServicesAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/jdhservicesview[/{service_id}]", [PermissionMiddleware::class], "view.jdh_services")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhServicesView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/jdhservicesedit[/{service_id}]", [PermissionMiddleware::class], "edit.jdh_services")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhServicesEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/jdhservicesdelete[/{service_id}]", [PermissionMiddleware::class], "delete.jdh_services")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhServicesDelete");
    }
}
