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

class JdhExaminationFindingsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/jdhexaminationfindingslist[/{id}]", [PermissionMiddleware::class], "list.jdh_examination_findings")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhExaminationFindingsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/jdhexaminationfindingsadd[/{id}]", [PermissionMiddleware::class], "add.jdh_examination_findings")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhExaminationFindingsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/jdhexaminationfindingsview[/{id}]", [PermissionMiddleware::class], "view.jdh_examination_findings")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhExaminationFindingsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/jdhexaminationfindingsedit[/{id}]", [PermissionMiddleware::class], "edit.jdh_examination_findings")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhExaminationFindingsEdit");
    }

    // update
    #[Map(["GET","POST","OPTIONS"], "/jdhexaminationfindingsupdate", [PermissionMiddleware::class], "update.jdh_examination_findings")]
    public function update(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhExaminationFindingsUpdate");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/jdhexaminationfindingsdelete[/{id}]", [PermissionMiddleware::class], "delete.jdh_examination_findings")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhExaminationFindingsDelete");
    }
}
