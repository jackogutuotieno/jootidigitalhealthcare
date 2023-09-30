<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$PatientQueuesSummary = &$Page;
?>
<?php if (!$Page->isExport() && !$Page->DrillDown && !$DashboardReport) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { Patient_Queues: currentTable } });
var currentPageID = ew.PAGE_ID = "summary";
var currentForm;
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<a id="top"></a>
<!-- Content Container -->
<div id="ew-report" class="ew-report container-fluid">
<div class="btn-toolbar ew-toolbar">
<?php
if (!$Page->DrillDownInPanel) {
    $Page->ExportOptions->render("body");
    $Page->SearchOptions->render("body");
    $Page->FilterOptions->render("body");
}
?>
</div>
<?php if (!$Page->isExport() && !$Page->DrillDown && !$DashboardReport) { ?>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
<!-- Middle Container -->
<div id="ew-middle" class="<?= $Page->MiddleContentClass ?>">
<?php } ?>
<?php
if (!$DashboardReport) {
    // Set up chart drilldown
    $Page->PatientQueues->DrillDownInPanel = $Page->DrillDownInPanel;
    echo $Page->PatientQueues->render("ew-chart-top");
}
?>
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
<!-- Content Container -->
<div id="ew-content" class="<?= $Page->ContainerClass ?>">
<?php } ?>
<?php if ($Page->ShowReport) { ?>
<!-- Summary report (begin) -->
<main class="report-summary<?= ($Page->TotalGroups == 0) ? " ew-no-record" : "" ?>">
<?php
while ($Page->RecordCount < count($Page->DetailRecords) && $Page->RecordCount < $Page->DisplayGroups) {
?>
<?php
    // Show header
    if ($Page->ShowHeader) {
?>
<div class="<?= $Page->ReportContainerClass ?>">
<!-- Report grid (begin) -->
<div id="gmp_Patient_Queues" class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>">
<table class="<?= $Page->TableClass ?>">
<thead>
	<!-- Table header -->
    <tr class="ew-table-header">
<?php if ($Page->visit_id->Visible) { ?>
    <th data-name="visit_id" class="<?= $Page->visit_id->headerCellClass() ?>"><div class="Patient_Queues_visit_id"><?= $Page->renderFieldHeader($Page->visit_id) ?></div></th>
<?php } ?>
<?php if ($Page->patient_name->Visible) { ?>
    <th data-name="patient_name" class="<?= $Page->patient_name->headerCellClass() ?>"><div class="Patient_Queues_patient_name"><?= $Page->renderFieldHeader($Page->patient_name) ?></div></th>
<?php } ?>
<?php if ($Page->visit_type->Visible) { ?>
    <th data-name="visit_type" class="<?= $Page->visit_type->headerCellClass() ?>"><div class="Patient_Queues_visit_type"><?= $Page->renderFieldHeader($Page->visit_type) ?></div></th>
<?php } ?>
<?php if ($Page->visit_date->Visible) { ?>
    <th data-name="visit_date" class="<?= $Page->visit_date->headerCellClass() ?>"><div class="Patient_Queues_visit_date"><?= $Page->renderFieldHeader($Page->visit_date) ?></div></th>
<?php } ?>
    </tr>
</thead>
<tbody>
<?php
        if ($Page->TotalGroups == 0) {
            break; // Show header only
        }
        $Page->ShowHeader = false;
    } // End show header
?>
<?php
    $Page->loadRowValues($Page->DetailRecords[$Page->RecordCount]);
    $Page->RecordCount++;
    $Page->RecordIndex++;
?>
<?php
        // Render detail row
        $Page->resetAttributes();
        $Page->RowType = ROWTYPE_DETAIL;
        $Page->renderRow();
?>
    <tr<?= $Page->rowAttributes(); ?>>
<?php if ($Page->visit_id->Visible) { ?>
        <td data-field="visit_id"<?= $Page->visit_id->cellAttributes() ?>>
<span<?= $Page->visit_id->viewAttributes() ?>>
<?= $Page->visit_id->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->patient_name->Visible) { ?>
        <td data-field="patient_name"<?= $Page->patient_name->cellAttributes() ?>>
<span<?= $Page->patient_name->viewAttributes() ?>>
<?= $Page->patient_name->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->visit_type->Visible) { ?>
        <td data-field="visit_type"<?= $Page->visit_type->cellAttributes() ?>>
<span<?= $Page->visit_type->viewAttributes() ?>>
<?= $Page->visit_type->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->visit_date->Visible) { ?>
        <td data-field="visit_date"<?= $Page->visit_date->cellAttributes() ?>>
<span<?= $Page->visit_date->viewAttributes() ?>>
<?= $Page->visit_date->getViewValue() ?></span>
</td>
<?php } ?>
    </tr>
<?php
} // End while
?>
<?php if ($Page->TotalGroups > 0) { ?>
</tbody>
<tfoot>
</tfoot>
</table>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php if (!$Page->isExport() && !($Page->DrillDown && $Page->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<?= $Page->Pager->render() ?>
</div>
<?php } ?>
</div>
<!-- /.ew-grid -->
<?php } ?>
</main>
<!-- /.report-summary -->
<!-- Summary report (end) -->
<?php } ?>
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /#ew-content -->
<?php } ?>
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /#ew-middle -->
<?php } ?>
</div>
<!-- /.ew-report -->
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport() && !$Page->DrillDown && !$DashboardReport) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
