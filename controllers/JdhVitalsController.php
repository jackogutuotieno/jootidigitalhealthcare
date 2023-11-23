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

class JdhVitalsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/jdhvitalslist[/{vitals_id}]", [PermissionMiddleware::class], "list.jdh_vitals")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhVitalsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/jdhvitalsadd[/{vitals_id}]", [PermissionMiddleware::class], "add.jdh_vitals")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhVitalsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/jdhvitalsview[/{vitals_id}]", [PermissionMiddleware::class], "view.jdh_vitals")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhVitalsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/jdhvitalsedit[/{vitals_id}]", [PermissionMiddleware::class], "edit.jdh_vitals")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhVitalsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/jdhvitalsdelete[/{vitals_id}]", [PermissionMiddleware::class], "delete.jdh_vitals")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhVitalsDelete");
    }
}
