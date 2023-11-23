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

class JdhInvoiceController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/jdhinvoicelist[/{id}]", [PermissionMiddleware::class], "list.jdh_invoice")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhInvoiceList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/jdhinvoiceadd[/{id}]", [PermissionMiddleware::class], "add.jdh_invoice")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhInvoiceAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/jdhinvoiceview[/{id}]", [PermissionMiddleware::class], "view.jdh_invoice")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhInvoiceView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/jdhinvoiceedit[/{id}]", [PermissionMiddleware::class], "edit.jdh_invoice")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhInvoiceEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/jdhinvoicedelete[/{id}]", [PermissionMiddleware::class], "delete.jdh_invoice")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhInvoiceDelete");
    }
}
