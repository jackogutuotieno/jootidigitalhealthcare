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

class JdhMedicinesController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/jdhmedicineslist[/{id}]", [PermissionMiddleware::class], "list.jdh_medicines")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhMedicinesList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/jdhmedicinesadd[/{id}]", [PermissionMiddleware::class], "add.jdh_medicines")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhMedicinesAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/jdhmedicinesview[/{id}]", [PermissionMiddleware::class], "view.jdh_medicines")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhMedicinesView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/jdhmedicinesedit[/{id}]", [PermissionMiddleware::class], "edit.jdh_medicines")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhMedicinesEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/jdhmedicinesdelete[/{id}]", [PermissionMiddleware::class], "delete.jdh_medicines")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhMedicinesDelete");
    }
}
