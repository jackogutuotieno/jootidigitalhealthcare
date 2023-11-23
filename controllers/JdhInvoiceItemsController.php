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

class JdhInvoiceItemsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/jdhinvoiceitemslist[/{id}]", [PermissionMiddleware::class], "list.jdh_invoice_items")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhInvoiceItemsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/jdhinvoiceitemsadd[/{id}]", [PermissionMiddleware::class], "add.jdh_invoice_items")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhInvoiceItemsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/jdhinvoiceitemsview[/{id}]", [PermissionMiddleware::class], "view.jdh_invoice_items")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhInvoiceItemsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/jdhinvoiceitemsedit[/{id}]", [PermissionMiddleware::class], "edit.jdh_invoice_items")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhInvoiceItemsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/jdhinvoiceitemsdelete[/{id}]", [PermissionMiddleware::class], "delete.jdh_invoice_items")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhInvoiceItemsDelete");
    }
}
