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

class JdhPrescriptionsActionsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/jdhprescriptionsactionslist[/{id}]", [PermissionMiddleware::class], "list.jdh_prescriptions_actions")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhPrescriptionsActionsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/jdhprescriptionsactionsadd[/{id}]", [PermissionMiddleware::class], "add.jdh_prescriptions_actions")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhPrescriptionsActionsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/jdhprescriptionsactionsview[/{id}]", [PermissionMiddleware::class], "view.jdh_prescriptions_actions")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhPrescriptionsActionsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/jdhprescriptionsactionsedit[/{id}]", [PermissionMiddleware::class], "edit.jdh_prescriptions_actions")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhPrescriptionsActionsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/jdhprescriptionsactionsdelete[/{id}]", [PermissionMiddleware::class], "delete.jdh_prescriptions_actions")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhPrescriptionsActionsDelete");
    }
}
