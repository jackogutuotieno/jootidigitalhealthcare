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

class SubscriptionsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/subscriptionslist[/{Id}]", [PermissionMiddleware::class], "list.subscriptions")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "SubscriptionsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/subscriptionsadd[/{Id}]", [PermissionMiddleware::class], "add.subscriptions")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "SubscriptionsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/subscriptionsview[/{Id}]", [PermissionMiddleware::class], "view.subscriptions")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "SubscriptionsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/subscriptionsedit[/{Id}]", [PermissionMiddleware::class], "edit.subscriptions")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "SubscriptionsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/subscriptionsdelete[/{Id}]", [PermissionMiddleware::class], "delete.subscriptions")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "SubscriptionsDelete");
    }
}
