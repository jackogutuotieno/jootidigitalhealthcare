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

class JdhAudittrailController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/jdhaudittraillist[/{Id}]", [PermissionMiddleware::class], "list.jdh_audittrail")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhAudittrailList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/jdhaudittrailadd[/{Id}]", [PermissionMiddleware::class], "add.jdh_audittrail")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhAudittrailAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/jdhaudittrailview[/{Id}]", [PermissionMiddleware::class], "view.jdh_audittrail")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhAudittrailView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/jdhaudittrailedit[/{Id}]", [PermissionMiddleware::class], "edit.jdh_audittrail")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhAudittrailEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/jdhaudittraildelete[/{Id}]", [PermissionMiddleware::class], "delete.jdh_audittrail")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhAudittrailDelete");
    }
}
