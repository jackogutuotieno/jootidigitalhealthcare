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

class JdhServiceSubcategoryController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/jdhservicesubcategorylist[/{subcategory_id}]", [PermissionMiddleware::class], "list.jdh_service_subcategory")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhServiceSubcategoryList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/jdhservicesubcategoryadd[/{subcategory_id}]", [PermissionMiddleware::class], "add.jdh_service_subcategory")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhServiceSubcategoryAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/jdhservicesubcategoryview[/{subcategory_id}]", [PermissionMiddleware::class], "view.jdh_service_subcategory")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhServiceSubcategoryView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/jdhservicesubcategoryedit[/{subcategory_id}]", [PermissionMiddleware::class], "edit.jdh_service_subcategory")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhServiceSubcategoryEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/jdhservicesubcategorydelete[/{subcategory_id}]", [PermissionMiddleware::class], "delete.jdh_service_subcategory")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhServiceSubcategoryDelete");
    }
}
