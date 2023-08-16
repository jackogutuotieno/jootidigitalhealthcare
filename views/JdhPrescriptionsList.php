<?php

namespace PHPMaker2023\jootidigitalhealthcare;

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

        // Add fields
        .setFields([
            ["prescription_id", [fields.prescription_id.visible && fields.prescription_id.required ? ew.Validators.required(fields.prescription_id.caption) : null], fields.prescription_id.isInvalid],
            ["patient_id", [fields.patient_id.visible && fields.patient_id.required ? ew.Validators.required(fields.patient_id.caption) : null], fields.patient_id.isInvalid],
            ["prescription_title", [fields.prescription_title.visible && fields.prescription_title.required ? ew.Validators.required(fields.prescription_title.caption) : null], fields.prescription_title.isInvalid],
            ["medicine_id", [fields.medicine_id.visible && fields.medicine_id.required ? ew.Validators.required(fields.medicine_id.caption) : null], fields.medicine_id.isInvalid],
            ["tabs", [fields.tabs.visible && fields.tabs.required ? ew.Validators.required(fields.tabs.caption) : null], fields.tabs.isInvalid],
            ["frequency", [fields.frequency.visible && fields.frequency.required ? ew.Validators.required(fields.frequency.caption) : null], fields.frequency.isInvalid],
            ["prescription_time", [fields.prescription_time.visible && fields.prescription_time.required ? ew.Validators.required(fields.prescription_time.caption) : null], fields.prescription_time.isInvalid],
            ["prescription_date", [fields.prescription_date.visible && fields.prescription_date.required ? ew.Validators.required(fields.prescription_date.caption) : null, ew.Validators.datetime(fields.prescription_date.clientFormatPattern)], fields.prescription_date.isInvalid]
        ])

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
            "medicine_id": <?= $Page->medicine_id->toClientList($Page) ?>,
            "frequency": <?= $Page->frequency->toClientList($Page) ?>,
            "prescription_time": <?= $Page->prescription_time->toClientList($Page) ?>,
        })
        .build();
    window[form.id] = form;
    currentForm = form;
    loadjs.done(form.id);
});
</script>
<script>
window.Tabulator || loadjs([
    ew.PATH_BASE + "js/tabulator.min.js?v=19.0.15",
    ew.PATH_BASE + "css/<?= CssFile("tabulator_bootstrap5.css") ?>?v=19.0.15"
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
<?php if ($Security->canSearch()) { ?>
<?php if (!$Page->isExport() && !($Page->CurrentAction && $Page->CurrentAction != "search") && $Page->hasSearchFields()) { ?>
<form name="fjdh_prescriptionssrch" id="fjdh_prescriptionssrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>" novalidate autocomplete="on">
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
<input type="hidden" name="t" value="jdh_prescriptions">
<div class="ew-extended-search container-fluid ps-2">
<div class="row mb-0">
    <div class="col-sm-auto px-0 pe-sm-2">
        <div class="ew-basic-search input-group">
            <input type="search" name="<?= Config("TABLE_BASIC_SEARCH") ?>" id="<?= Config("TABLE_BASIC_SEARCH") ?>" class="form-control ew-basic-search-keyword" value="<?= HtmlEncode($Page->BasicSearch->getKeyword()) ?>" placeholder="<?= HtmlEncode($Language->phrase("Search")) ?>" aria-label="<?= HtmlEncode($Language->phrase("Search")) ?>">
            <input type="hidden" name="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" class="ew-basic-search-type" value="<?= HtmlEncode($Page->BasicSearch->getType()) ?>">
            <button type="button" data-bs-toggle="dropdown" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false">
                <span id="searchtype"><?= $Page->BasicSearch->getTypeNameShort() ?></span>
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fjdh_prescriptionssrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fjdh_prescriptionssrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fjdh_prescriptionssrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fjdh_prescriptionssrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
            </div>
        </div>
    </div>
    <div class="col-sm-auto mb-3">
        <button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?= $Language->phrase("SearchBtn") ?></button>
    </div>
</div>
</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="list<?= ($Page->TotalRecords == 0 && !$Page->isAdd()) ? " ew-no-record" : "" ?>">
<div id="ew-list">
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?= $Page->isAddOrEdit() ? " ew-grid-add-edit" : "" ?> <?= $Page->TableGridClass ?>">
<form name="<?= $Page->FormName ?>" id="<?= $Page->FormName ?>" class="ew-form ew-list-form" action="<?= $Page->PageAction ?>" method="post" novalidate autocomplete="on">
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
<?php if ($Page->TotalRecords > 0 || $Page->isAdd() || $Page->isCopy() || $Page->isGridEdit() || $Page->isMultiEdit()) { ?>
<table id="tbl_jdh_prescriptionslist" class="<?= $Page->TableClass ?>"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Page->RowType = ROWTYPE_HEADER;

// Render list options
$Page->renderListOptions();

// Render list options (header, left)
$Page->ListOptions->render("header", "left");
?>
<?php if ($Page->prescription_id->Visible) { // prescription_id ?>
        <th data-name="prescription_id" class="<?= $Page->prescription_id->headerCellClass() ?>"><div id="elh_jdh_prescriptions_prescription_id" class="jdh_prescriptions_prescription_id"><?= $Page->renderFieldHeader($Page->prescription_id) ?></div></th>
<?php } ?>
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
while ($Page->RecordCount < $Page->StopRecord) {
    $Page->RecordCount++;
    if ($Page->RecordCount >= $Page->StartRecord) {
        $Page->setupRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowCount);
?>
    <?php if ($Page->prescription_id->Visible) { // prescription_id ?>
        <td data-name="prescription_id"<?= $Page->prescription_id->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_jdh_prescriptions_prescription_id" class="el_jdh_prescriptions_prescription_id"></span>
<input type="hidden" data-table="jdh_prescriptions" data-field="x_prescription_id" data-hidden="1" data-old name="o<?= $Page->RowIndex ?>_prescription_id" id="o<?= $Page->RowIndex ?>_prescription_id" value="<?= HtmlEncode($Page->prescription_id->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_jdh_prescriptions_prescription_id" class="el_jdh_prescriptions_prescription_id">
<span<?= $Page->prescription_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->prescription_id->getDisplayValue($Page->prescription_id->EditValue))) ?>"></span>
<input type="hidden" data-table="jdh_prescriptions" data-field="x_prescription_id" data-hidden="1" name="x<?= $Page->RowIndex ?>_prescription_id" id="x<?= $Page->RowIndex ?>_prescription_id" value="<?= HtmlEncode($Page->prescription_id->CurrentValue) ?>">
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_jdh_prescriptions_prescription_id" class="el_jdh_prescriptions_prescription_id">
<span<?= $Page->prescription_id->viewAttributes() ?>>
<?= $Page->prescription_id->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="jdh_prescriptions" data-field="x_prescription_id" data-hidden="1" name="x<?= $Page->RowIndex ?>_prescription_id" id="x<?= $Page->RowIndex ?>_prescription_id" value="<?= HtmlEncode($Page->prescription_id->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Page->patient_id->Visible) { // patient_id ?>
        <td data-name="patient_id"<?= $Page->patient_id->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($Page->patient_id->getSessionValue() != "") { ?>
<span<?= $Page->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->patient_id->getDisplayValue($Page->patient_id->ViewValue) ?></span></span>
<input type="hidden" id="x<?= $Page->RowIndex ?>_patient_id" name="x<?= $Page->RowIndex ?>_patient_id" value="<?= HtmlEncode($Page->patient_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Page->RowCount ?>_jdh_prescriptions_patient_id" class="el_jdh_prescriptions_patient_id">
    <select
        id="x<?= $Page->RowIndex ?>_patient_id"
        name="x<?= $Page->RowIndex ?>_patient_id"
        class="form-select ew-select<?= $Page->patient_id->isInvalidClass() ?>"
        data-select2-id="<?= $Page->FormName ?>_x<?= $Page->RowIndex ?>_patient_id"
        data-table="jdh_prescriptions"
        data-field="x_patient_id"
        data-value-separator="<?= $Page->patient_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->patient_id->getPlaceHolder()) ?>"
        <?= $Page->patient_id->editAttributes() ?>>
        <?= $Page->patient_id->selectOptionListHtml("x{$Page->RowIndex}_patient_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->patient_id->getErrorMessage() ?></div>
<?= $Page->patient_id->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_patient_id") ?>
<script>
loadjs.ready("<?= $Page->FormName ?>", function() {
    var options = { name: "x<?= $Page->RowIndex ?>_patient_id", selectId: "<?= $Page->FormName ?>_x<?= $Page->RowIndex ?>_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (<?= $Page->FormName ?>.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Page->RowIndex ?>_patient_id", form: "<?= $Page->FormName ?>" };
    } else {
        options.ajax = { id: "x<?= $Page->RowIndex ?>_patient_id", form: "<?= $Page->FormName ?>", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_prescriptions.fields.patient_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<input type="hidden" data-table="jdh_prescriptions" data-field="x_patient_id" data-hidden="1" data-old name="o<?= $Page->RowIndex ?>_patient_id" id="o<?= $Page->RowIndex ?>_patient_id" value="<?= HtmlEncode($Page->patient_id->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($Page->patient_id->getSessionValue() != "") { ?>
<span<?= $Page->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->patient_id->getDisplayValue($Page->patient_id->ViewValue) ?></span></span>
<input type="hidden" id="x<?= $Page->RowIndex ?>_patient_id" name="x<?= $Page->RowIndex ?>_patient_id" value="<?= HtmlEncode($Page->patient_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Page->RowCount ?>_jdh_prescriptions_patient_id" class="el_jdh_prescriptions_patient_id">
    <select
        id="x<?= $Page->RowIndex ?>_patient_id"
        name="x<?= $Page->RowIndex ?>_patient_id"
        class="form-select ew-select<?= $Page->patient_id->isInvalidClass() ?>"
        data-select2-id="<?= $Page->FormName ?>_x<?= $Page->RowIndex ?>_patient_id"
        data-table="jdh_prescriptions"
        data-field="x_patient_id"
        data-value-separator="<?= $Page->patient_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->patient_id->getPlaceHolder()) ?>"
        <?= $Page->patient_id->editAttributes() ?>>
        <?= $Page->patient_id->selectOptionListHtml("x{$Page->RowIndex}_patient_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->patient_id->getErrorMessage() ?></div>
<?= $Page->patient_id->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_patient_id") ?>
<script>
loadjs.ready("<?= $Page->FormName ?>", function() {
    var options = { name: "x<?= $Page->RowIndex ?>_patient_id", selectId: "<?= $Page->FormName ?>_x<?= $Page->RowIndex ?>_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (<?= $Page->FormName ?>.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Page->RowIndex ?>_patient_id", form: "<?= $Page->FormName ?>" };
    } else {
        options.ajax = { id: "x<?= $Page->RowIndex ?>_patient_id", form: "<?= $Page->FormName ?>", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_prescriptions.fields.patient_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_jdh_prescriptions_patient_id" class="el_jdh_prescriptions_patient_id">
<span<?= $Page->patient_id->viewAttributes() ?>>
<?= $Page->patient_id->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->prescription_title->Visible) { // prescription_title ?>
        <td data-name="prescription_title"<?= $Page->prescription_title->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_jdh_prescriptions_prescription_title" class="el_jdh_prescriptions_prescription_title">
<input type="<?= $Page->prescription_title->getInputTextType() ?>" name="x<?= $Page->RowIndex ?>_prescription_title" id="x<?= $Page->RowIndex ?>_prescription_title" data-table="jdh_prescriptions" data-field="x_prescription_title" value="<?= $Page->prescription_title->EditValue ?>" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->prescription_title->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->prescription_title->formatPattern()) ?>"<?= $Page->prescription_title->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->prescription_title->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="jdh_prescriptions" data-field="x_prescription_title" data-hidden="1" data-old name="o<?= $Page->RowIndex ?>_prescription_title" id="o<?= $Page->RowIndex ?>_prescription_title" value="<?= HtmlEncode($Page->prescription_title->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_jdh_prescriptions_prescription_title" class="el_jdh_prescriptions_prescription_title">
<input type="<?= $Page->prescription_title->getInputTextType() ?>" name="x<?= $Page->RowIndex ?>_prescription_title" id="x<?= $Page->RowIndex ?>_prescription_title" data-table="jdh_prescriptions" data-field="x_prescription_title" value="<?= $Page->prescription_title->EditValue ?>" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->prescription_title->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->prescription_title->formatPattern()) ?>"<?= $Page->prescription_title->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->prescription_title->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_jdh_prescriptions_prescription_title" class="el_jdh_prescriptions_prescription_title">
<span<?= $Page->prescription_title->viewAttributes() ?>>
<?= $Page->prescription_title->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->medicine_id->Visible) { // medicine_id ?>
        <td data-name="medicine_id"<?= $Page->medicine_id->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_jdh_prescriptions_medicine_id" class="el_jdh_prescriptions_medicine_id">
    <select
        id="x<?= $Page->RowIndex ?>_medicine_id"
        name="x<?= $Page->RowIndex ?>_medicine_id"
        class="form-select ew-select<?= $Page->medicine_id->isInvalidClass() ?>"
        data-select2-id="<?= $Page->FormName ?>_x<?= $Page->RowIndex ?>_medicine_id"
        data-table="jdh_prescriptions"
        data-field="x_medicine_id"
        data-value-separator="<?= $Page->medicine_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->medicine_id->getPlaceHolder()) ?>"
        <?= $Page->medicine_id->editAttributes() ?>>
        <?= $Page->medicine_id->selectOptionListHtml("x{$Page->RowIndex}_medicine_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->medicine_id->getErrorMessage() ?></div>
<?= $Page->medicine_id->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_medicine_id") ?>
<script>
loadjs.ready("<?= $Page->FormName ?>", function() {
    var options = { name: "x<?= $Page->RowIndex ?>_medicine_id", selectId: "<?= $Page->FormName ?>_x<?= $Page->RowIndex ?>_medicine_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (<?= $Page->FormName ?>.lists.medicine_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Page->RowIndex ?>_medicine_id", form: "<?= $Page->FormName ?>" };
    } else {
        options.ajax = { id: "x<?= $Page->RowIndex ?>_medicine_id", form: "<?= $Page->FormName ?>", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_prescriptions.fields.medicine_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<input type="hidden" data-table="jdh_prescriptions" data-field="x_medicine_id" data-hidden="1" data-old name="o<?= $Page->RowIndex ?>_medicine_id" id="o<?= $Page->RowIndex ?>_medicine_id" value="<?= HtmlEncode($Page->medicine_id->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_jdh_prescriptions_medicine_id" class="el_jdh_prescriptions_medicine_id">
    <select
        id="x<?= $Page->RowIndex ?>_medicine_id"
        name="x<?= $Page->RowIndex ?>_medicine_id"
        class="form-select ew-select<?= $Page->medicine_id->isInvalidClass() ?>"
        data-select2-id="<?= $Page->FormName ?>_x<?= $Page->RowIndex ?>_medicine_id"
        data-table="jdh_prescriptions"
        data-field="x_medicine_id"
        data-value-separator="<?= $Page->medicine_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->medicine_id->getPlaceHolder()) ?>"
        <?= $Page->medicine_id->editAttributes() ?>>
        <?= $Page->medicine_id->selectOptionListHtml("x{$Page->RowIndex}_medicine_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->medicine_id->getErrorMessage() ?></div>
<?= $Page->medicine_id->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_medicine_id") ?>
<script>
loadjs.ready("<?= $Page->FormName ?>", function() {
    var options = { name: "x<?= $Page->RowIndex ?>_medicine_id", selectId: "<?= $Page->FormName ?>_x<?= $Page->RowIndex ?>_medicine_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (<?= $Page->FormName ?>.lists.medicine_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Page->RowIndex ?>_medicine_id", form: "<?= $Page->FormName ?>" };
    } else {
        options.ajax = { id: "x<?= $Page->RowIndex ?>_medicine_id", form: "<?= $Page->FormName ?>", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_prescriptions.fields.medicine_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_jdh_prescriptions_medicine_id" class="el_jdh_prescriptions_medicine_id">
<span<?= $Page->medicine_id->viewAttributes() ?>>
<?= $Page->medicine_id->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->tabs->Visible) { // tabs ?>
        <td data-name="tabs"<?= $Page->tabs->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_jdh_prescriptions_tabs" class="el_jdh_prescriptions_tabs">
<input type="<?= $Page->tabs->getInputTextType() ?>" name="x<?= $Page->RowIndex ?>_tabs" id="x<?= $Page->RowIndex ?>_tabs" data-table="jdh_prescriptions" data-field="x_tabs" value="<?= $Page->tabs->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->tabs->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->tabs->formatPattern()) ?>"<?= $Page->tabs->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->tabs->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="jdh_prescriptions" data-field="x_tabs" data-hidden="1" data-old name="o<?= $Page->RowIndex ?>_tabs" id="o<?= $Page->RowIndex ?>_tabs" value="<?= HtmlEncode($Page->tabs->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_jdh_prescriptions_tabs" class="el_jdh_prescriptions_tabs">
<input type="<?= $Page->tabs->getInputTextType() ?>" name="x<?= $Page->RowIndex ?>_tabs" id="x<?= $Page->RowIndex ?>_tabs" data-table="jdh_prescriptions" data-field="x_tabs" value="<?= $Page->tabs->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->tabs->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->tabs->formatPattern()) ?>"<?= $Page->tabs->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->tabs->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_jdh_prescriptions_tabs" class="el_jdh_prescriptions_tabs">
<span<?= $Page->tabs->viewAttributes() ?>>
<?= $Page->tabs->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->frequency->Visible) { // frequency ?>
        <td data-name="frequency"<?= $Page->frequency->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_jdh_prescriptions_frequency" class="el_jdh_prescriptions_frequency">
    <select
        id="x<?= $Page->RowIndex ?>_frequency"
        name="x<?= $Page->RowIndex ?>_frequency"
        class="form-select ew-select<?= $Page->frequency->isInvalidClass() ?>"
        data-select2-id="<?= $Page->FormName ?>_x<?= $Page->RowIndex ?>_frequency"
        data-table="jdh_prescriptions"
        data-field="x_frequency"
        data-value-separator="<?= $Page->frequency->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->frequency->getPlaceHolder()) ?>"
        <?= $Page->frequency->editAttributes() ?>>
        <?= $Page->frequency->selectOptionListHtml("x{$Page->RowIndex}_frequency") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->frequency->getErrorMessage() ?></div>
<script>
loadjs.ready("<?= $Page->FormName ?>", function() {
    var options = { name: "x<?= $Page->RowIndex ?>_frequency", selectId: "<?= $Page->FormName ?>_x<?= $Page->RowIndex ?>_frequency" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (<?= $Page->FormName ?>.lists.frequency?.lookupOptions.length) {
        options.data = { id: "x<?= $Page->RowIndex ?>_frequency", form: "<?= $Page->FormName ?>" };
    } else {
        options.ajax = { id: "x<?= $Page->RowIndex ?>_frequency", form: "<?= $Page->FormName ?>", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_prescriptions.fields.frequency.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<input type="hidden" data-table="jdh_prescriptions" data-field="x_frequency" data-hidden="1" data-old name="o<?= $Page->RowIndex ?>_frequency" id="o<?= $Page->RowIndex ?>_frequency" value="<?= HtmlEncode($Page->frequency->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_jdh_prescriptions_frequency" class="el_jdh_prescriptions_frequency">
    <select
        id="x<?= $Page->RowIndex ?>_frequency"
        name="x<?= $Page->RowIndex ?>_frequency"
        class="form-select ew-select<?= $Page->frequency->isInvalidClass() ?>"
        data-select2-id="<?= $Page->FormName ?>_x<?= $Page->RowIndex ?>_frequency"
        data-table="jdh_prescriptions"
        data-field="x_frequency"
        data-value-separator="<?= $Page->frequency->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->frequency->getPlaceHolder()) ?>"
        <?= $Page->frequency->editAttributes() ?>>
        <?= $Page->frequency->selectOptionListHtml("x{$Page->RowIndex}_frequency") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->frequency->getErrorMessage() ?></div>
<script>
loadjs.ready("<?= $Page->FormName ?>", function() {
    var options = { name: "x<?= $Page->RowIndex ?>_frequency", selectId: "<?= $Page->FormName ?>_x<?= $Page->RowIndex ?>_frequency" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (<?= $Page->FormName ?>.lists.frequency?.lookupOptions.length) {
        options.data = { id: "x<?= $Page->RowIndex ?>_frequency", form: "<?= $Page->FormName ?>" };
    } else {
        options.ajax = { id: "x<?= $Page->RowIndex ?>_frequency", form: "<?= $Page->FormName ?>", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_prescriptions.fields.frequency.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_jdh_prescriptions_frequency" class="el_jdh_prescriptions_frequency">
<span<?= $Page->frequency->viewAttributes() ?>>
<?= $Page->frequency->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->prescription_time->Visible) { // prescription_time ?>
        <td data-name="prescription_time"<?= $Page->prescription_time->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_jdh_prescriptions_prescription_time" class="el_jdh_prescriptions_prescription_time">
    <select
        id="x<?= $Page->RowIndex ?>_prescription_time"
        name="x<?= $Page->RowIndex ?>_prescription_time"
        class="form-select ew-select<?= $Page->prescription_time->isInvalidClass() ?>"
        data-select2-id="<?= $Page->FormName ?>_x<?= $Page->RowIndex ?>_prescription_time"
        data-table="jdh_prescriptions"
        data-field="x_prescription_time"
        data-value-separator="<?= $Page->prescription_time->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->prescription_time->getPlaceHolder()) ?>"
        <?= $Page->prescription_time->editAttributes() ?>>
        <?= $Page->prescription_time->selectOptionListHtml("x{$Page->RowIndex}_prescription_time") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->prescription_time->getErrorMessage() ?></div>
<script>
loadjs.ready("<?= $Page->FormName ?>", function() {
    var options = { name: "x<?= $Page->RowIndex ?>_prescription_time", selectId: "<?= $Page->FormName ?>_x<?= $Page->RowIndex ?>_prescription_time" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (<?= $Page->FormName ?>.lists.prescription_time?.lookupOptions.length) {
        options.data = { id: "x<?= $Page->RowIndex ?>_prescription_time", form: "<?= $Page->FormName ?>" };
    } else {
        options.ajax = { id: "x<?= $Page->RowIndex ?>_prescription_time", form: "<?= $Page->FormName ?>", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_prescriptions.fields.prescription_time.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<input type="hidden" data-table="jdh_prescriptions" data-field="x_prescription_time" data-hidden="1" data-old name="o<?= $Page->RowIndex ?>_prescription_time" id="o<?= $Page->RowIndex ?>_prescription_time" value="<?= HtmlEncode($Page->prescription_time->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_jdh_prescriptions_prescription_time" class="el_jdh_prescriptions_prescription_time">
    <select
        id="x<?= $Page->RowIndex ?>_prescription_time"
        name="x<?= $Page->RowIndex ?>_prescription_time"
        class="form-select ew-select<?= $Page->prescription_time->isInvalidClass() ?>"
        data-select2-id="<?= $Page->FormName ?>_x<?= $Page->RowIndex ?>_prescription_time"
        data-table="jdh_prescriptions"
        data-field="x_prescription_time"
        data-value-separator="<?= $Page->prescription_time->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->prescription_time->getPlaceHolder()) ?>"
        <?= $Page->prescription_time->editAttributes() ?>>
        <?= $Page->prescription_time->selectOptionListHtml("x{$Page->RowIndex}_prescription_time") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->prescription_time->getErrorMessage() ?></div>
<script>
loadjs.ready("<?= $Page->FormName ?>", function() {
    var options = { name: "x<?= $Page->RowIndex ?>_prescription_time", selectId: "<?= $Page->FormName ?>_x<?= $Page->RowIndex ?>_prescription_time" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (<?= $Page->FormName ?>.lists.prescription_time?.lookupOptions.length) {
        options.data = { id: "x<?= $Page->RowIndex ?>_prescription_time", form: "<?= $Page->FormName ?>" };
    } else {
        options.ajax = { id: "x<?= $Page->RowIndex ?>_prescription_time", form: "<?= $Page->FormName ?>", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_prescriptions.fields.prescription_time.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_jdh_prescriptions_prescription_time" class="el_jdh_prescriptions_prescription_time">
<span<?= $Page->prescription_time->viewAttributes() ?>>
<?= $Page->prescription_time->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->prescription_date->Visible) { // prescription_date ?>
        <td data-name="prescription_date"<?= $Page->prescription_date->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_jdh_prescriptions_prescription_date" class="el_jdh_prescriptions_prescription_date">
<input type="<?= $Page->prescription_date->getInputTextType() ?>" name="x<?= $Page->RowIndex ?>_prescription_date" id="x<?= $Page->RowIndex ?>_prescription_date" data-table="jdh_prescriptions" data-field="x_prescription_date" value="<?= $Page->prescription_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->prescription_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->prescription_date->formatPattern()) ?>"<?= $Page->prescription_date->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->prescription_date->getErrorMessage() ?></div>
<?php if (!$Page->prescription_date->ReadOnly && !$Page->prescription_date->Disabled && !isset($Page->prescription_date->EditAttrs["readonly"]) && !isset($Page->prescription_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["<?= $Page->FormName ?>", "datetimepicker"], function () {
    let format = "<?= DateFormat(11) ?>",
        options = {
            localization: {
                locale: ew.LANGUAGE_ID + "-u-nu-" + ew.getNumberingSystem(),
                ...ew.language.phrase("datetimepicker")
            },
            display: {
                icons: {
                    previous: ew.IS_RTL ? "fa-solid fa-chevron-right" : "fa-solid fa-chevron-left",
                    next: ew.IS_RTL ? "fa-solid fa-chevron-left" : "fa-solid fa-chevron-right"
                },
                components: {
                    hours: !!format.match(/h/i),
                    minutes: !!format.match(/m/),
                    seconds: !!format.match(/s/i),
                    useTwentyfourHour: !!format.match(/H/)
                },
                theme: ew.isDark() ? "dark" : "auto"
            },
            meta: {
                format
            }
        };
    ew.createDateTimePicker("<?= $Page->FormName ?>", "x<?= $Page->RowIndex ?>_prescription_date", jQuery.extend(true, {"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="jdh_prescriptions" data-field="x_prescription_date" data-hidden="1" data-old name="o<?= $Page->RowIndex ?>_prescription_date" id="o<?= $Page->RowIndex ?>_prescription_date" value="<?= HtmlEncode($Page->prescription_date->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_jdh_prescriptions_prescription_date" class="el_jdh_prescriptions_prescription_date">
<input type="<?= $Page->prescription_date->getInputTextType() ?>" name="x<?= $Page->RowIndex ?>_prescription_date" id="x<?= $Page->RowIndex ?>_prescription_date" data-table="jdh_prescriptions" data-field="x_prescription_date" value="<?= $Page->prescription_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->prescription_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->prescription_date->formatPattern()) ?>"<?= $Page->prescription_date->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->prescription_date->getErrorMessage() ?></div>
<?php if (!$Page->prescription_date->ReadOnly && !$Page->prescription_date->Disabled && !isset($Page->prescription_date->EditAttrs["readonly"]) && !isset($Page->prescription_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["<?= $Page->FormName ?>", "datetimepicker"], function () {
    let format = "<?= DateFormat(11) ?>",
        options = {
            localization: {
                locale: ew.LANGUAGE_ID + "-u-nu-" + ew.getNumberingSystem(),
                ...ew.language.phrase("datetimepicker")
            },
            display: {
                icons: {
                    previous: ew.IS_RTL ? "fa-solid fa-chevron-right" : "fa-solid fa-chevron-left",
                    next: ew.IS_RTL ? "fa-solid fa-chevron-left" : "fa-solid fa-chevron-right"
                },
                components: {
                    hours: !!format.match(/h/i),
                    minutes: !!format.match(/m/),
                    seconds: !!format.match(/s/i),
                    useTwentyfourHour: !!format.match(/H/)
                },
                theme: ew.isDark() ? "dark" : "auto"
            },
            meta: {
                format
            }
        };
    ew.createDateTimePicker("<?= $Page->FormName ?>", "x<?= $Page->RowIndex ?>_prescription_date", jQuery.extend(true, {"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_jdh_prescriptions_prescription_date" class="el_jdh_prescriptions_prescription_date">
<span<?= $Page->prescription_date->viewAttributes() ?>>
<?= $Page->prescription_date->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowCount);
?>
    </tr>
<?php if ($Page->RowType == ROWTYPE_ADD || $Page->RowType == ROWTYPE_EDIT) { ?>
<script data-rowindex="<?= $Page->RowIndex ?>">
loadjs.ready(["<?= $Page->FormName ?>","load"], () => <?= $Page->FormName ?>.updateLists(<?= $Page->RowIndex ?><?= $Page->RowIndex === '$rowindex$' ? ", true" : "" ?>));
</script>
<?php } ?>
<?php
    }
    if (!$Page->isGridAdd()) {
        $Page->Recordset->moveNext();
    }
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if ($Page->isAdd() || $Page->isCopy()) { ?>
<input type="hidden" name="<?= $Page->FormKeyCountName ?>" id="<?= $Page->FormKeyCountName ?>" value="<?= $Page->KeyCount ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php } ?>
<?php if ($Page->isEdit()) { ?>
<input type="hidden" name="<?= $Page->FormKeyCountName ?>" id="<?= $Page->FormKeyCountName ?>" value="<?= $Page->KeyCount ?>">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$Page->CurrentAction && !$Page->UseAjaxActions) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php
// Close recordset
if ($Page->Recordset) {
    $Page->Recordset->close();
}
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
