<?php

namespace PHPMaker2024\jootidigitalhealthcare;

// Page object
$JdhPrescriptionsList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_prescriptions: currentTable } });
var currentPageID = ew.PAGE_ID = "list";
var currentForm;
var <?= $Page->FormName ?>;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("<?= $Page->FormName ?>")
        .setPageId("list")
        .setSubmitWithFetch(<?= $Page->UseAjaxActions ? "true" : "false" ?>)
        .setFormKeyCountName("<?= $Page->FormKeyCountName ?>")
        .build();
    window[form.id] = form;
    currentForm = form;
    loadjs.done(form.id);
});
</script>
<script>
window.Tabulator || loadjs([
    ew.PATH_BASE + "js/tabulator.min.js?v=24.4.0",
    ew.PATH_BASE + "css/<?= CssFile("tabulator_bootstrap5.css", false) ?>?v=24.4.0"
], "import");
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($Page->TotalRecords > 0 && $Page->ExportOptions->visible()) { ?>
<?php $Page->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->ImportOptions->visible()) { ?>
<?php $Page->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->SearchOptions->visible()) { ?>
<?php $Page->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($Page->FilterOptions->visible()) { ?>
<?php $Page->FilterOptions->render("body") ?>
<?php } ?>
</div>
<?php } ?>
<?php if (!$Page->isExport() || Config("EXPORT_MASTER_RECORD") && $Page->isExport("print")) { ?>
<?php
if ($Page->DbMasterFilter != "" && $Page->getCurrentMasterTable() == "jdh_patients") {
    if ($Page->MasterRecordExists) {
        include_once "views/JdhPatientsMaster.php";
    }
}
?>
<?php } ?>
<?php if (!$Page->IsModal) { ?>
<form name="fjdh_prescriptionssrch" id="fjdh_prescriptionssrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>" novalidate autocomplete="off">
<div id="fjdh_prescriptionssrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_prescriptions: currentTable } });
var currentForm;
var fjdh_prescriptionssrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery,
        fields = currentTable.fields;

    // Form object for search
    let form = new ew.FormBuilder()
        .setId("fjdh_prescriptionssrch")
        .setPageId("list")
<?php if ($Page->UseAjaxActions) { ?>
        .setSubmitWithFetch(true)
<?php } ?>

        // Dynamic selection lists
        .setLists({
        })

        // Filters
        .setFilterList(<?= $Page->getFilterList() ?>)
        .build();
    window[form.id] = form;
    currentSearchForm = form;
    loadjs.done(form.id);
});
</script>
<input type="hidden" name="cmd" value="search">
<?php if ($Security->canSearch()) { ?>
<?php if (!$Page->isExport() && !($Page->CurrentAction && $Page->CurrentAction != "search") && $Page->hasSearchFields()) { ?>
<div class="ew-extended-search container-fluid ps-2">
<!-- template for quick search in navbar -->
<script id="navbar-basic-search" type="text/html" class="ew-js-template" data-name="search" data-seq="10" data-data="menu" data-target="#ew-navbar-end" data-method="prependTo">
    <li class="nav-item navbar-basic-search">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fa-solid fa-magnifying-glass"></i>
        </a>
        <div class="navbar-search-block">
            <div class="ew-basic-search input-group input-group-sm">
                <input type="text" name="<?= Config("TABLE_BASIC_SEARCH") ?>" id="<?= Config("TABLE_BASIC_SEARCH") ?>" class="form-control form-control-navbar ew-basic-search-keyword" form="fjdh_prescriptionssrch" value="<?= HtmlEncode($Page->BasicSearch->getKeyword()) ?>" placeholder="<?= HtmlEncode($Language->phrase("Search")) ?>" aria-label="<?= HtmlEncode($Language->phrase("Search")) ?>">
                <input type="hidden" name="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" class="form-control-navbar ew-basic-search-type" form="fjdh_prescriptionssrch" value="<?= HtmlEncode($Page->BasicSearch->getType()) ?>">
                <button class="btn btn-navbar" form="fjdh_prescriptionssrch" type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
                <button type="button" data-bs-toggle="dropdown" class="btn btn-navbar dropdown-toggle" aria-haspopup="true" aria-expanded="false">
                    <span id="searchtype"><?= $Page->BasicSearch->getTypeNameShort() ?></span>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fjdh_prescriptionssrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                    <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fjdh_prescriptionssrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                    <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fjdh_prescriptionssrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                    <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fjdh_prescriptionssrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
                </div>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        </div>
    </li>
</script>
</div><!-- /.ew-extended-search -->
<?php } ?>
<?php } ?>
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="list<?= ($Page->TotalRecords == 0 && !$Page->isAdd()) ? " ew-no-record" : "" ?>">
<div id="ew-header-options">
<?php $Page->HeaderOptions?->render("body") ?>
</div>
<div id="ew-list">
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?= $Page->isAddOrEdit() ? " ew-grid-add-edit" : "" ?> <?= $Page->TableGridClass ?>">
<form name="<?= $Page->FormName ?>" id="<?= $Page->FormName ?>" class="ew-form ew-list-form" action="<?= $Page->PageAction ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jdh_prescriptions">
<?php if ($Page->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<?php if ($Page->getCurrentMasterTable() == "jdh_patients" && $Page->CurrentAction) { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="jdh_patients">
<input type="hidden" name="fk_patient_id" value="<?= HtmlEncode($Page->patient_id->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_jdh_prescriptions" class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>" style="<?= $Page->TableContainerStyle ?>">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit() || $Page->isMultiEdit()) { ?>
<table id="tbl_jdh_prescriptionslist" class="<?= $Page->TableClass ?>"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Page->RowType = RowType::HEADER;

// Render list options
$Page->renderListOptions();

// Render list options (header, left)
$Page->ListOptions->render("header", "left");
?>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
        <th data-name="patient_id" class="<?= $Page->patient_id->headerCellClass() ?>"><div id="elh_jdh_prescriptions_patient_id" class="jdh_prescriptions_patient_id"><?= $Page->renderFieldHeader($Page->patient_id) ?></div></th>
<?php } ?>
<?php if ($Page->prescription_title->Visible) { // prescription_title ?>
        <th data-name="prescription_title" class="<?= $Page->prescription_title->headerCellClass() ?>"><div id="elh_jdh_prescriptions_prescription_title" class="jdh_prescriptions_prescription_title"><?= $Page->renderFieldHeader($Page->prescription_title) ?></div></th>
<?php } ?>
<?php if ($Page->medicine_id->Visible) { // medicine_id ?>
        <th data-name="medicine_id" class="<?= $Page->medicine_id->headerCellClass() ?>"><div id="elh_jdh_prescriptions_medicine_id" class="jdh_prescriptions_medicine_id"><?= $Page->renderFieldHeader($Page->medicine_id) ?></div></th>
<?php } ?>
<?php if ($Page->tabs->Visible) { // tabs ?>
        <th data-name="tabs" class="<?= $Page->tabs->headerCellClass() ?>"><div id="elh_jdh_prescriptions_tabs" class="jdh_prescriptions_tabs"><?= $Page->renderFieldHeader($Page->tabs) ?></div></th>
<?php } ?>
<?php if ($Page->frequency->Visible) { // frequency ?>
        <th data-name="frequency" class="<?= $Page->frequency->headerCellClass() ?>"><div id="elh_jdh_prescriptions_frequency" class="jdh_prescriptions_frequency"><?= $Page->renderFieldHeader($Page->frequency) ?></div></th>
<?php } ?>
<?php if ($Page->prescription_days->Visible) { // prescription_days ?>
        <th data-name="prescription_days" class="<?= $Page->prescription_days->headerCellClass() ?>"><div id="elh_jdh_prescriptions_prescription_days" class="jdh_prescriptions_prescription_days"><?= $Page->renderFieldHeader($Page->prescription_days) ?></div></th>
<?php } ?>
<?php if ($Page->prescription_time->Visible) { // prescription_time ?>
        <th data-name="prescription_time" class="<?= $Page->prescription_time->headerCellClass() ?>"><div id="elh_jdh_prescriptions_prescription_time" class="jdh_prescriptions_prescription_time"><?= $Page->renderFieldHeader($Page->prescription_time) ?></div></th>
<?php } ?>
<?php if ($Page->prescription_date->Visible) { // prescription_date ?>
        <th data-name="prescription_date" class="<?= $Page->prescription_date->headerCellClass() ?>"><div id="elh_jdh_prescriptions_prescription_date" class="jdh_prescriptions_prescription_date"><?= $Page->renderFieldHeader($Page->prescription_date) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Page->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody data-page="<?= $Page->getPageNumber() ?>">
<?php
$Page->setupGrid();
while ($Page->RecordCount < $Page->StopRecord || $Page->RowIndex === '$rowindex$') {
    if (
        $Page->CurrentRow !== false &&
        $Page->RowIndex !== '$rowindex$' &&
        (!$Page->isGridAdd() || $Page->CurrentMode == "copy") &&
        (!(($Page->isCopy() || $Page->isAdd()) && $Page->RowIndex == 0))
    ) {
        $Page->fetch();
    }
    $Page->RecordCount++;
    if ($Page->RecordCount >= $Page->StartRecord) {
        $Page->setupRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowCount);
?>
    <?php if ($Page->patient_id->Visible) { // patient_id ?>
        <td data-name="patient_id"<?= $Page->patient_id->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_jdh_prescriptions_patient_id" class="el_jdh_prescriptions_patient_id">
<span<?= $Page->patient_id->viewAttributes() ?>>
<?= $Page->patient_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->prescription_title->Visible) { // prescription_title ?>
        <td data-name="prescription_title"<?= $Page->prescription_title->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_jdh_prescriptions_prescription_title" class="el_jdh_prescriptions_prescription_title">
<span<?= $Page->prescription_title->viewAttributes() ?>>
<?= $Page->prescription_title->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->medicine_id->Visible) { // medicine_id ?>
        <td data-name="medicine_id"<?= $Page->medicine_id->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_jdh_prescriptions_medicine_id" class="el_jdh_prescriptions_medicine_id">
<span<?= $Page->medicine_id->viewAttributes() ?>>
<?= $Page->medicine_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tabs->Visible) { // tabs ?>
        <td data-name="tabs"<?= $Page->tabs->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_jdh_prescriptions_tabs" class="el_jdh_prescriptions_tabs">
<span<?= $Page->tabs->viewAttributes() ?>>
<?= $Page->tabs->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->frequency->Visible) { // frequency ?>
        <td data-name="frequency"<?= $Page->frequency->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_jdh_prescriptions_frequency" class="el_jdh_prescriptions_frequency">
<span<?= $Page->frequency->viewAttributes() ?>>
<?= $Page->frequency->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->prescription_days->Visible) { // prescription_days ?>
        <td data-name="prescription_days"<?= $Page->prescription_days->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_jdh_prescriptions_prescription_days" class="el_jdh_prescriptions_prescription_days">
<span<?= $Page->prescription_days->viewAttributes() ?>>
<?= $Page->prescription_days->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->prescription_time->Visible) { // prescription_time ?>
        <td data-name="prescription_time"<?= $Page->prescription_time->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_jdh_prescriptions_prescription_time" class="el_jdh_prescriptions_prescription_time">
<span<?= $Page->prescription_time->viewAttributes() ?>>
<?= $Page->prescription_time->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->prescription_date->Visible) { // prescription_date ?>
        <td data-name="prescription_date"<?= $Page->prescription_date->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_jdh_prescriptions_prescription_date" class="el_jdh_prescriptions_prescription_date">
<span<?= $Page->prescription_date->viewAttributes() ?>>
<?= $Page->prescription_date->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowCount);
?>
    </tr>
<?php
    }

    // Reset for template row
    if ($Page->RowIndex === '$rowindex$') {
        $Page->RowIndex = 0;
    }
    // Reset inline add/copy row
    if (($Page->isCopy() || $Page->isAdd()) && $Page->RowIndex == 0) {
        $Page->RowIndex = 1;
    }
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$Page->CurrentAction && !$Page->UseAjaxActions) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php
// Close result set
$Page->Recordset?->free();
?>
<?php if (!$Page->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Page->isGridAdd() && !($Page->isGridEdit() && $Page->ModalGridEdit) && !$Page->isMultiEdit()) { ?>
<?= $Page->Pager->render() ?>
<?php } ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body", "bottom") ?>
</div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } else { ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
<?php } ?>
</div>
<div id="ew-footer-options">
<?php $Page->FooterOptions?->render("body") ?>
</div>
</main>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("jdh_prescriptions");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
