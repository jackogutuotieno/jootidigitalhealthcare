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

class JdhBedsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/jdhbedslist[/{id}]", [PermissionMiddleware::class], "list.jdh_beds")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhBedsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/jdhbedsadd[/{id}]", [PermissionMiddleware::class], "add.jdh_beds")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhBedsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/jdhbedsview[/{id}]", [PermissionMiddleware::class], "view.jdh_beds")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhBedsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/jdhbedsedit[/{id}]", [PermissionMiddleware::class], "edit.jdh_beds")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhBedsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/jdhbedsdelete[/{id}]", [PermissionMiddleware::class], "delete.jdh_beds")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhBedsDelete");
    }
}
