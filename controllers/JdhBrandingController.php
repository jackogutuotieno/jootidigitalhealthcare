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

class JdhBrandingController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/jdhbrandinglist[/{id}]", [PermissionMiddleware::class], "list.jdh_branding")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhBrandingList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/jdhbrandingadd[/{id}]", [PermissionMiddleware::class], "add.jdh_branding")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhBrandingAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/jdhbrandingview[/{id}]", [PermissionMiddleware::class], "view.jdh_branding")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhBrandingView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/jdhbrandingedit[/{id}]", [PermissionMiddleware::class], "edit.jdh_branding")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhBrandingEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/jdhbrandingdelete[/{id}]", [PermissionMiddleware::class], "delete.jdh_branding")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhBrandingDelete");
    }
}
