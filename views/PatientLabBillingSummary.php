<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$PatientLabBillingSummary = &$Page;
?>
<?php if (!$Page->isExport() && !$Page->DrillDown && !$DashboardReport) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { Patient_Lab_Billing: currentTable } });
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
<?php if ($Page->ShowCurrentFilter) { ?>
<?php $Page->showFilterList() ?>
<?php } ?>
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
<?php if ($Security->canSearch()) { ?>
<?php if (!$Page->isExport() && !($Page->CurrentAction && $Page->CurrentAction != "search") && $Page->hasSearchFields()) { ?>
<form name="fPatient_Lab_Billingsrch" id="fPatient_Lab_Billingsrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>" novalidate autocomplete="on">
<div id="fPatient_Lab_Billingsrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { Patient_Lab_Billing: currentTable } });
var currentPageID = ew.PAGE_ID = "summary";
var currentForm;
var fPatient_Lab_Billingsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery,
        fields = currentTable.fields;

    // Form object for search
    let form = new ew.FormBuilder()
        .setId("fPatient_Lab_Billingsrch")
        .setPageId("summary")
<?php if ($Page->UseAjaxActions) { ?>
        .setSubmitWithFetch(true)
<?php } ?>

        // Add fields
        .addFields([
            ["patient_id", [], fields.patient_id.isInvalid],
            ["patient_name", [], fields.patient_name.isInvalid],
            ["service_name", [], fields.service_name.isInvalid],
            ["service_cost", [], fields.service_cost.isInvalid],
            ["request_date", [], fields.request_date.isInvalid]
        ])
        // Validate form
        .setValidate(
            async function () {
                if (!this.validateRequired)
                    return true; // Ignore validation
                let fobj = this.getForm();

                // Validate fields
                if (!this.validateFields())
                    return false;

                // Call Form_CustomValidate event
                if (!(await this.customValidate?.(fobj) ?? true)) {
                    this.focus();
                    return false;
                }
                return true;
            }
        )

        // Form_CustomValidate
        .setCustomValidate(
            function (fobj) { // DO NOT CHANGE THIS LINE! (except for adding "async" keyword)!
                    // Your custom validation code here, return false if invalid.
                    return true;
                }
        )

        // Use JavaScript validation or not
        .setValidateRequired(ew.CLIENT_VALIDATE)

        // Dynamic selection lists
        .setLists({
            "patient_id": <?= $Page->patient_id->toClientList($Page) ?>,
        })

        // Filters
        .setFilterList(<?= $Page->getFilterList() ?>)
        .build();
    window[form.id] = form;
    loadjs.done(form.id);
});
</script>
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="Patient_Lab_Billing">
<div class="ew-extended-search container-fluid ps-2">
<div class="row mb-0<?= ($Page->SearchFieldsPerRow > 0) ? " row-cols-sm-" . $Page->SearchFieldsPerRow : "" ?>">
<?php
// Render search row
$Page->RowType = ROWTYPE_SEARCH;
$Page->resetAttributes();
$Page->renderRow();
?>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
<?php
if (!$Page->patient_id->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_patient_id" class="col-sm-auto d-sm-flex align-items-start mb-3 px-0 pe-sm-2<?= $Page->patient_id->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_patient_id"
            name="x_patient_id[]"
            class="form-control ew-select<?= $Page->patient_id->isInvalidClass() ?>"
            data-select2-id="fPatient_Lab_Billingsrch_x_patient_id"
            data-table="Patient_Lab_Billing"
            data-field="x_patient_id"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->patient_id->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->patient_id->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->patient_id->getPlaceHolder()) ?>"
            data-ew-action="update-options"
            <?= $Page->patient_id->editAttributes() ?>>
            <?= $Page->patient_id->selectOptionListHtml("x_patient_id", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->patient_id->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fPatient_Lab_Billingsrch", function() {
            var options = {
                name: "x_patient_id",
                selectId: "fPatient_Lab_Billingsrch_x_patient_id",
                ajax: { id: "x_patient_id", form: "fPatient_Lab_Billingsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.Patient_Lab_Billing.fields.patient_id.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->SearchColumnCount > 0) { ?>
   <div class="col-sm-auto mb-3">
       <button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?= $Language->phrase("SearchBtn") ?></button>
   </div>
<?php } ?>
</div><!-- /.row -->
</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
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
<div id="gmp_Patient_Lab_Billing" class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>">
<table class="<?= $Page->TableClass ?>">
<thead>
	<!-- Table header -->
    <tr class="ew-table-header">
<?php if ($Page->patient_id->Visible) { ?>
    <th data-name="patient_id" class="<?= $Page->patient_id->headerCellClass() ?>"><div class="Patient_Lab_Billing_patient_id"><?= $Page->renderFieldHeader($Page->patient_id) ?></div></th>
<?php } ?>
<?php if ($Page->patient_name->Visible) { ?>
    <th data-name="patient_name" class="<?= $Page->patient_name->headerCellClass() ?>"><div class="Patient_Lab_Billing_patient_name"><?= $Page->renderFieldHeader($Page->patient_name) ?></div></th>
<?php } ?>
<?php if ($Page->service_name->Visible) { ?>
    <th data-name="service_name" class="<?= $Page->service_name->headerCellClass() ?>"><div class="Patient_Lab_Billing_service_name"><?= $Page->renderFieldHeader($Page->service_name) ?></div></th>
<?php } ?>
<?php if ($Page->service_cost->Visible) { ?>
    <th data-name="service_cost" class="<?= $Page->service_cost->headerCellClass() ?>"><div class="Patient_Lab_Billing_service_cost"><?= $Page->renderFieldHeader($Page->service_cost) ?></div></th>
<?php } ?>
<?php if ($Page->request_date->Visible) { ?>
    <th data-name="request_date" class="<?= $Page->request_date->headerCellClass() ?>"><div class="Patient_Lab_Billing_request_date"><?= $Page->renderFieldHeader($Page->request_date) ?></div></th>
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
<?php if ($Page->service_name->Visible) { ?>
        <td data-field="service_name"<?= $Page->service_name->cellAttributes() ?>>
<span<?= $Page->service_name->viewAttributes() ?>>
<?= $Page->service_name->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->service_cost->Visible) { ?>
        <td data-field="service_cost"<?= $Page->service_cost->cellAttributes() ?>>
<span<?= $Page->service_cost->viewAttributes() ?>>
<?= $Page->service_cost->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->request_date->Visible) { ?>
        <td data-field="request_date"<?= $Page->request_date->cellAttributes() ?>>
<span<?= $Page->request_date->viewAttributes() ?>>
<?= $Page->request_date->getViewValue() ?></span>
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
    <tr<?= $Page->rowAttributes() ?>>
<?php if ($Page->GroupColumnCount > 0) { ?>
        <td colspan="<?= $Page->GroupColumnCount ?>" class="ew-rpt-grp-aggregate"></td>
<?php } ?>
<?php if ($Page->patient_id->Visible) { ?>
        <td data-field="patient_id"<?= $Page->patient_id->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Page->patient_name->Visible) { ?>
        <td data-field="patient_name"<?= $Page->patient_name->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Page->service_name->Visible) { ?>
        <td data-field="service_name"<?= $Page->service_name->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Page->service_cost->Visible) { ?>
        <td data-field="service_cost"<?= $Page->service_cost->cellAttributes() ?>><span class="ew-aggregate-caption"><?= $Language->phrase("RptSum") ?></span><span class="ew-aggregate-equal"><?= $Language->phrase("AggregateEqual") ?></span><span class="ew-aggregate-value"><span<?= $Page->service_cost->viewAttributes() ?>><?= $Page->service_cost->SumViewValue ?></span></span></td>
<?php } ?>
<?php if ($Page->request_date->Visible) { ?>
        <td data-field="request_date"<?= $Page->request_date->cellAttributes() ?>></td>
<?php } ?>
    </tr>
<?php } else { ?>
    <tr<?= $Page->rowAttributes() ?>><td colspan="<?= ($Page->GroupColumnCount + $Page->DetailColumnCount) ?>"><?= $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<?= FormatNumber($Page->TotalCount, Config("DEFAULT_NUMBER_FORMAT")) ?><?= $Language->phrase("RptDtlRec") ?>)</span></td></tr>
    <tr<?= $Page->rowAttributes() ?>>
<?php if ($Page->patient_id->Visible) { ?>
        <td data-field="patient_id"<?= $Page->patient_id->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Page->patient_name->Visible) { ?>
        <td data-field="patient_name"<?= $Page->patient_name->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Page->service_name->Visible) { ?>
        <td data-field="service_name"<?= $Page->service_name->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Page->service_cost->Visible) { ?>
        <td data-field="service_cost"<?= $Page->service_cost->cellAttributes() ?>><span class="ew-aggregate"><?= $Language->phrase("RptSum") ?></span><?= $Language->phrase("AggregateColon") ?>
<span<?= $Page->service_cost->viewAttributes() ?>>
<?= $Page->service_cost->SumViewValue ?></span>
</td>
<?php } ?>
<?php if ($Page->request_date->Visible) { ?>
        <td data-field="request_date"<?= $Page->request_date->cellAttributes() ?>></td>
<?php } ?>
    </tr>
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
