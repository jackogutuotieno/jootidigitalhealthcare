<?php

namespace PHPMaker2024\jootidigitalhealthcare;

// Page object
$JdhVitalsList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_vitals: currentTable } });
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
<form name="fjdh_vitalssrch" id="fjdh_vitalssrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>" novalidate autocomplete="off">
<div id="fjdh_vitalssrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_vitals: currentTable } });
var currentForm;
var fjdh_vitalssrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery,
        fields = currentTable.fields;

    // Form object for search
    let form = new ew.FormBuilder()
        .setId("fjdh_vitalssrch")
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
                <input type="text" name="<?= Config("TABLE_BASIC_SEARCH") ?>" id="<?= Config("TABLE_BASIC_SEARCH") ?>" class="form-control form-control-navbar ew-basic-search-keyword" form="fjdh_vitalssrch" value="<?= HtmlEncode($Page->BasicSearch->getKeyword()) ?>" placeholder="<?= HtmlEncode($Language->phrase("Search")) ?>" aria-label="<?= HtmlEncode($Language->phrase("Search")) ?>">
                <input type="hidden" name="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" class="form-control-navbar ew-basic-search-type" form="fjdh_vitalssrch" value="<?= HtmlEncode($Page->BasicSearch->getType()) ?>">
                <button class="btn btn-navbar" form="fjdh_vitalssrch" type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
                <button type="button" data-bs-toggle="dropdown" class="btn btn-navbar dropdown-toggle" aria-haspopup="true" aria-expanded="false">
                    <span id="searchtype"><?= $Page->BasicSearch->getTypeNameShort() ?></span>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fjdh_vitalssrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                    <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fjdh_vitalssrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                    <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fjdh_vitalssrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                    <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fjdh_vitalssrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<input type="hidden" name="t" value="jdh_vitals">
<?php if ($Page->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<?php if ($Page->getCurrentMasterTable() == "jdh_patients" && $Page->CurrentAction) { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="jdh_patients">
<input type="hidden" name="fk_patient_id" value="<?= HtmlEncode($Page->patient_id->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_jdh_vitals" class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>" style="<?= $Page->TableContainerStyle ?>">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit() || $Page->isMultiEdit()) { ?>
<table id="tbl_jdh_vitalslist" class="<?= $Page->TableClass ?>"><!-- .ew-table -->
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
        <th data-name="patient_id" class="<?= $Page->patient_id->headerCellClass() ?>"><div id="elh_jdh_vitals_patient_id" class="jdh_vitals_patient_id"><?= $Page->renderFieldHeader($Page->patient_id) ?></div></th>
<?php } ?>
<?php if ($Page->pressure->Visible) { // pressure ?>
        <th data-name="pressure" class="<?= $Page->pressure->headerCellClass() ?>"><div id="elh_jdh_vitals_pressure" class="jdh_vitals_pressure"><?= $Page->renderFieldHeader($Page->pressure) ?></div></th>
<?php } ?>
<?php if ($Page->height->Visible) { // height ?>
        <th data-name="height" class="<?= $Page->height->headerCellClass() ?>"><div id="elh_jdh_vitals_height" class="jdh_vitals_height"><?= $Page->renderFieldHeader($Page->height) ?></div></th>
<?php } ?>
<?php if ($Page->weight->Visible) { // weight ?>
        <th data-name="weight" class="<?= $Page->weight->headerCellClass() ?>"><div id="elh_jdh_vitals_weight" class="jdh_vitals_weight"><?= $Page->renderFieldHeader($Page->weight) ?></div></th>
<?php } ?>
<?php if ($Page->body_mass_index->Visible) { // body_mass_index ?>
        <th data-name="body_mass_index" class="<?= $Page->body_mass_index->headerCellClass() ?>"><div id="elh_jdh_vitals_body_mass_index" class="jdh_vitals_body_mass_index"><?= $Page->renderFieldHeader($Page->body_mass_index) ?></div></th>
<?php } ?>
<?php if ($Page->pulse_rate->Visible) { // pulse_rate ?>
        <th data-name="pulse_rate" class="<?= $Page->pulse_rate->headerCellClass() ?>"><div id="elh_jdh_vitals_pulse_rate" class="jdh_vitals_pulse_rate"><?= $Page->renderFieldHeader($Page->pulse_rate) ?></div></th>
<?php } ?>
<?php if ($Page->respiratory_rate->Visible) { // respiratory_rate ?>
        <th data-name="respiratory_rate" class="<?= $Page->respiratory_rate->headerCellClass() ?>"><div id="elh_jdh_vitals_respiratory_rate" class="jdh_vitals_respiratory_rate"><?= $Page->renderFieldHeader($Page->respiratory_rate) ?></div></th>
<?php } ?>
<?php if ($Page->temperature->Visible) { // temperature ?>
        <th data-name="temperature" class="<?= $Page->temperature->headerCellClass() ?>"><div id="elh_jdh_vitals_temperature" class="jdh_vitals_temperature"><?= $Page->renderFieldHeader($Page->temperature) ?></div></th>
<?php } ?>
<?php if ($Page->random_blood_sugar->Visible) { // random_blood_sugar ?>
        <th data-name="random_blood_sugar" class="<?= $Page->random_blood_sugar->headerCellClass() ?>"><div id="elh_jdh_vitals_random_blood_sugar" class="jdh_vitals_random_blood_sugar"><?= $Page->renderFieldHeader($Page->random_blood_sugar) ?></div></th>
<?php } ?>
<?php if ($Page->spo_2->Visible) { // spo_2 ?>
        <th data-name="spo_2" class="<?= $Page->spo_2->headerCellClass() ?>"><div id="elh_jdh_vitals_spo_2" class="jdh_vitals_spo_2"><?= $Page->renderFieldHeader($Page->spo_2) ?></div></th>
<?php } ?>
<?php if ($Page->submission_date->Visible) { // submission_date ?>
        <th data-name="submission_date" class="<?= $Page->submission_date->headerCellClass() ?>"><div id="elh_jdh_vitals_submission_date" class="jdh_vitals_submission_date"><?= $Page->renderFieldHeader($Page->submission_date) ?></div></th>
<?php } ?>
<?php if ($Page->patient_status->Visible) { // patient_status ?>
        <th data-name="patient_status" class="<?= $Page->patient_status->headerCellClass() ?>"><div id="elh_jdh_vitals_patient_status" class="jdh_vitals_patient_status"><?= $Page->renderFieldHeader($Page->patient_status) ?></div></th>
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
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_jdh_vitals_patient_id" class="el_jdh_vitals_patient_id">
<span<?= $Page->patient_id->viewAttributes() ?>>
<?= $Page->patient_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->pressure->Visible) { // pressure ?>
        <td data-name="pressure"<?= $Page->pressure->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_jdh_vitals_pressure" class="el_jdh_vitals_pressure">
<span<?= $Page->pressure->viewAttributes() ?>>
<?= $Page->pressure->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->height->Visible) { // height ?>
        <td data-name="height"<?= $Page->height->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_jdh_vitals_height" class="el_jdh_vitals_height">
<span<?= $Page->height->viewAttributes() ?>>
<?= $Page->height->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->weight->Visible) { // weight ?>
        <td data-name="weight"<?= $Page->weight->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_jdh_vitals_weight" class="el_jdh_vitals_weight">
<span<?= $Page->weight->viewAttributes() ?>>
<?= $Page->weight->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->body_mass_index->Visible) { // body_mass_index ?>
        <td data-name="body_mass_index"<?= $Page->body_mass_index->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_jdh_vitals_body_mass_index" class="el_jdh_vitals_body_mass_index">
<span<?= $Page->body_mass_index->viewAttributes() ?>>
<?= $Page->body_mass_index->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->pulse_rate->Visible) { // pulse_rate ?>
        <td data-name="pulse_rate"<?= $Page->pulse_rate->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_jdh_vitals_pulse_rate" class="el_jdh_vitals_pulse_rate">
<span<?= $Page->pulse_rate->viewAttributes() ?>>
<?= $Page->pulse_rate->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->respiratory_rate->Visible) { // respiratory_rate ?>
        <td data-name="respiratory_rate"<?= $Page->respiratory_rate->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_jdh_vitals_respiratory_rate" class="el_jdh_vitals_respiratory_rate">
<span<?= $Page->respiratory_rate->viewAttributes() ?>>
<?= $Page->respiratory_rate->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->temperature->Visible) { // temperature ?>
        <td data-name="temperature"<?= $Page->temperature->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_jdh_vitals_temperature" class="el_jdh_vitals_temperature">
<span<?= $Page->temperature->viewAttributes() ?>>
<?= $Page->temperature->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->random_blood_sugar->Visible) { // random_blood_sugar ?>
        <td data-name="random_blood_sugar"<?= $Page->random_blood_sugar->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_jdh_vitals_random_blood_sugar" class="el_jdh_vitals_random_blood_sugar">
<span<?= $Page->random_blood_sugar->viewAttributes() ?>>
<?= $Page->random_blood_sugar->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->spo_2->Visible) { // spo_2 ?>
        <td data-name="spo_2"<?= $Page->spo_2->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_jdh_vitals_spo_2" class="el_jdh_vitals_spo_2">
<span<?= $Page->spo_2->viewAttributes() ?>>
<?= $Page->spo_2->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->submission_date->Visible) { // submission_date ?>
        <td data-name="submission_date"<?= $Page->submission_date->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_jdh_vitals_submission_date" class="el_jdh_vitals_submission_date">
<span<?= $Page->submission_date->viewAttributes() ?>>
<?= $Page->submission_date->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->patient_status->Visible) { // patient_status ?>
        <td data-name="patient_status"<?= $Page->patient_status->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_jdh_vitals_patient_status" class="el_jdh_vitals_patient_status">
<span<?= $Page->patient_status->viewAttributes() ?>>
<?= $Page->patient_status->getViewValue() ?></span>
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
    ew.addEventHandlers("jdh_vitals");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
