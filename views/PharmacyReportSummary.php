<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$PharmacyReportSummary = &$Page;
?>
<?php if (!$Page->isExport() && !$Page->DrillDown && !$DashboardReport) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { Pharmacy_Report: currentTable } });
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
<div id="gmp_Pharmacy_Report" class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>">
<table class="<?= $Page->TableClass ?>">
<thead>
	<!-- Table header -->
    <tr class="ew-table-header">
<?php if ($Page->patient_id->Visible) { ?>
    <th data-name="patient_id" class="<?= $Page->patient_id->headerCellClass() ?>"><div class="Pharmacy_Report_patient_id"><?= $Page->renderFieldHeader($Page->patient_id) ?></div></th>
<?php } ?>
<?php if ($Page->patient_name->Visible) { ?>
    <th data-name="patient_name" class="<?= $Page->patient_name->headerCellClass() ?>"><div class="Pharmacy_Report_patient_name"><?= $Page->renderFieldHeader($Page->patient_name) ?></div></th>
<?php } ?>
<?php if ($Page->name->Visible) { ?>
    <th data-name="name" class="<?= $Page->name->headerCellClass() ?>"><div class="Pharmacy_Report_name"><?= $Page->renderFieldHeader($Page->name) ?></div></th>
<?php } ?>
<?php if ($Page->selling_price->Visible) { ?>
    <th data-name="selling_price" class="<?= $Page->selling_price->headerCellClass() ?>"><div class="Pharmacy_Report_selling_price"><?= $Page->renderFieldHeader($Page->selling_price) ?></div></th>
<?php } ?>
<?php if ($Page->units_available->Visible) { ?>
    <th data-name="units_available" class="<?= $Page->units_available->headerCellClass() ?>"><div class="Pharmacy_Report_units_available"><?= $Page->renderFieldHeader($Page->units_available) ?></div></th>
<?php } ?>
<?php if ($Page->units_given->Visible) { ?>
    <th data-name="units_given" class="<?= $Page->units_given->headerCellClass() ?>"><div class="Pharmacy_Report_units_given"><?= $Page->renderFieldHeader($Page->units_given) ?></div></th>
<?php } ?>
<?php if ($Page->units_remaining->Visible) { ?>
    <th data-name="units_remaining" class="<?= $Page->units_remaining->headerCellClass() ?>"><div class="Pharmacy_Report_units_remaining"><?= $Page->renderFieldHeader($Page->units_remaining) ?></div></th>
<?php } ?>
<?php if ($Page->submission_date->Visible) { ?>
    <th data-name="submission_date" class="<?= $Page->submission_date->headerCellClass() ?>"><div class="Pharmacy_Report_submission_date"><?= $Page->renderFieldHeader($Page->submission_date) ?></div></th>
<?php } ?>
<?php if ($Page->line_total_cost->Visible) { ?>
    <th data-name="line_total_cost" class="<?= $Page->line_total_cost->headerCellClass() ?>"><div class="Pharmacy_Report_line_total_cost"><?= $Page->renderFieldHeader($Page->line_total_cost) ?></div></th>
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
<?php if ($Page->patient_id->Visible) { ?>
        <td data-field="patient_id"<?= $Page->patient_id->cellAttributes() ?>>
<span<?= $Page->patient_id->viewAttributes() ?>>
<?= $Page->patient_id->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->patient_name->Visible) { ?>
        <td data-field="patient_name"<?= $Page->patient_name->cellAttributes() ?>>
<span<?= $Page->patient_name->viewAttributes() ?>>
<?= $Page->patient_name->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->name->Visible) { ?>
        <td data-field="name"<?= $Page->name->cellAttributes() ?>>
<span<?= $Page->name->viewAttributes() ?>>
<?= $Page->name->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->selling_price->Visible) { ?>
        <td data-field="selling_price"<?= $Page->selling_price->cellAttributes() ?>>
<span<?= $Page->selling_price->viewAttributes() ?>>
<?= $Page->selling_price->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->units_available->Visible) { ?>
        <td data-field="units_available"<?= $Page->units_available->cellAttributes() ?>>
<span<?= $Page->units_available->viewAttributes() ?>>
<?= $Page->units_available->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->units_given->Visible) { ?>
        <td data-field="units_given"<?= $Page->units_given->cellAttributes() ?>>
<span<?= $Page->units_given->viewAttributes() ?>>
<?= $Page->units_given->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->units_remaining->Visible) { ?>
        <td data-field="units_remaining"<?= $Page->units_remaining->cellAttributes() ?>>
<span<?= $Page->units_remaining->viewAttributes() ?>>
<?= $Page->units_remaining->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->submission_date->Visible) { ?>
        <td data-field="submission_date"<?= $Page->submission_date->cellAttributes() ?>>
<span<?= $Page->submission_date->viewAttributes() ?>>
<?= $Page->submission_date->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->line_total_cost->Visible) { ?>
        <td data-field="line_total_cost"<?= $Page->line_total_cost->cellAttributes() ?>>
<span<?= $Page->line_total_cost->viewAttributes() ?>>
<?= $Page->line_total_cost->getViewValue() ?></span>
</td>
<?php } ?>
    </tr>
<?php
} // End while
?>
<?php if ($Page->TotalGroups > 0) { ?>
</tbody>
<tfoot>
<?php
    $Page->resetAttributes();
    $Page->RowType = ROWTYPE_TOTAL;
    $Page->RowTotalType = ROWTOTAL_GRAND;
    $Page->RowTotalSubType = ROWTOTAL_FOOTER;
    $Page->RowAttrs["class"] = "ew-rpt-grand-summary";
    $Page->renderRow();
?>
<?php if ($Page->ShowCompactSummaryFooter) { ?>
    <tr<?= $Page->rowAttributes() ?>><td colspan="<?= ($Page->GroupColumnCount + $Page->DetailColumnCount) ?>"><?= $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<span class="ew-aggregate-caption"><?= $Language->phrase("RptCnt") ?></span><span class="ew-aggregate-equal"><?= $Language->phrase("AggregateEqual") ?></span><span class="ew-aggregate-value"><?= FormatNumber($Page->TotalCount, Config("DEFAULT_NUMBER_FORMAT")) ?></span>)</span></td></tr>
<?php } else { ?>
    <tr<?= $Page->rowAttributes() ?>><td colspan="<?= ($Page->GroupColumnCount + $Page->DetailColumnCount) ?>"><?= $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<?= FormatNumber($Page->TotalCount, Config("DEFAULT_NUMBER_FORMAT")) ?><?= $Language->phrase("RptDtlRec") ?>)</span></td></tr>
<?php } ?>
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
