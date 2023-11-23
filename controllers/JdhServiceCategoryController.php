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

class JdhServiceCategoryController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/jdhservicecategorylist[/{category_id}]", [PermissionMiddleware::class], "list.jdh_service_category")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhServiceCategoryList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/jdhservicecategoryadd[/{category_id}]", [PermissionMiddleware::class], "add.jdh_service_category")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhServiceCategoryAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/jdhservicecategoryview[/{category_id}]", [PermissionMiddleware::class], "view.jdh_service_category")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhServiceCategoryView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/jdhservicecategoryedit[/{category_id}]", [PermissionMiddleware::class], "edit.jdh_service_category")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhServiceCategoryEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/jdhservicecategorydelete[/{category_id}]", [PermissionMiddleware::class], "delete.jdh_service_category")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhServiceCategoryDelete");
    }
}
