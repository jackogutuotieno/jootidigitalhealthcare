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

class JdhIpdAdmissionController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/jdhipdadmissionlist[/{id}]", [PermissionMiddleware::class], "list.jdh_ipd_admission")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhIpdAdmissionList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/jdhipdadmissionadd[/{id}]", [PermissionMiddleware::class], "add.jdh_ipd_admission")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhIpdAdmissionAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/jdhipdadmissionview[/{id}]", [PermissionMiddleware::class], "view.jdh_ipd_admission")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhIpdAdmissionView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/jdhipdadmissionedit[/{id}]", [PermissionMiddleware::class], "edit.jdh_ipd_admission")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhIpdAdmissionEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/jdhipdadmissiondelete[/{id}]", [PermissionMiddleware::class], "delete.jdh_ipd_admission")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhIpdAdmissionDelete");
    }
}
