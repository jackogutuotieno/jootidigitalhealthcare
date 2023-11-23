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

class JdhChiefComplaintsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/jdhchiefcomplaintslist[/{id}]", [PermissionMiddleware::class], "list.jdh_chief_complaints")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhChiefComplaintsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/jdhchiefcomplaintsadd[/{id}]", [PermissionMiddleware::class], "add.jdh_chief_complaints")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhChiefComplaintsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/jdhchiefcomplaintsview[/{id}]", [PermissionMiddleware::class], "view.jdh_chief_complaints")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhChiefComplaintsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/jdhchiefcomplaintsedit[/{id}]", [PermissionMiddleware::class], "edit.jdh_chief_complaints")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhChiefComplaintsEdit");
    }
}
