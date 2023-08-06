<?php

namespace PHPMaker2023\jootidigitalhealthcare;

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

        // Add fields
        .setFields([
            ["vitals_id", [fields.vitals_id.visible && fields.vitals_id.required ? ew.Validators.required(fields.vitals_id.caption) : null], fields.vitals_id.isInvalid],
            ["patient_id", [fields.patient_id.visible && fields.patient_id.required ? ew.Validators.required(fields.patient_id.caption) : null], fields.patient_id.isInvalid],
            ["pressure", [fields.pressure.visible && fields.pressure.required ? ew.Validators.required(fields.pressure.caption) : null], fields.pressure.isInvalid],
            ["height", [fields.height.visible && fields.height.required ? ew.Validators.required(fields.height.caption) : null, ew.Validators.float], fields.height.isInvalid],
            ["weight", [fields.weight.visible && fields.weight.required ? ew.Validators.required(fields.weight.caption) : null, ew.Validators.integer], fields.weight.isInvalid],
            ["body_mass_index", [fields.body_mass_index.visible && fields.body_mass_index.required ? ew.Validators.required(fields.body_mass_index.caption) : null], fields.body_mass_index.isInvalid],
            ["pulse_rate", [fields.pulse_rate.visible && fields.pulse_rate.required ? ew.Validators.required(fields.pulse_rate.caption) : null, ew.Validators.integer], fields.pulse_rate.isInvalid],
            ["respiratory_rate", [fields.respiratory_rate.visible && fields.respiratory_rate.required ? ew.Validators.required(fields.respiratory_rate.caption) : null, ew.Validators.integer], fields.respiratory_rate.isInvalid],
            ["temperature", [fields.temperature.visible && fields.temperature.required ? ew.Validators.required(fields.temperature.caption) : null, ew.Validators.float], fields.temperature.isInvalid],
            ["random_blood_sugar", [fields.random_blood_sugar.visible && fields.random_blood_sugar.required ? ew.Validators.required(fields.random_blood_sugar.caption) : null], fields.random_blood_sugar.isInvalid],
            ["submission_date", [fields.submission_date.visible && fields.submission_date.required ? ew.Validators.required(fields.submission_date.caption) : null, ew.Validators.datetime(fields.submission_date.clientFormatPattern)], fields.submission_date.isInvalid]
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
<form name="fjdh_vitalssrch" id="fjdh_vitalssrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>" novalidate autocomplete="on">
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
<input type="hidden" name="t" value="jdh_vitals">
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fjdh_vitalssrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fjdh_vitalssrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fjdh_vitalssrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fjdh_vitalssrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<input type="hidden" name="t" value="jdh_vitals">
<?php if ($Page->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<?php if ($Page->getCurrentMasterTable() == "jdh_patients" && $Page->CurrentAction) { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="jdh_patients">
<input type="hidden" name="fk_patient_id" value="<?= HtmlEncode($Page->patient_id->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_jdh_vitals" class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>" style="<?= $Page->TableContainerStyle ?>">
<?php if ($Page->TotalRecords > 0 || $Page->isAdd() || $Page->isCopy() || $Page->isGridEdit() || $Page->isMultiEdit()) { ?>
<table id="tbl_jdh_vitalslist" class="<?= $Page->TableClass ?>"><!-- .ew-table -->
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
<?php if ($Page->vitals_id->Visible) { // vitals_id ?>
        <th data-name="vitals_id" class="<?= $Page->vitals_id->headerCellClass() ?>"><div id="elh_jdh_vitals_vitals_id" class="jdh_vitals_vitals_id"><?= $Page->renderFieldHeader($Page->vitals_id) ?></div></th>
<?php } ?>
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
<?php if ($Page->submission_date->Visible) { // submission_date ?>
        <th data-name="submission_date" class="<?= $Page->submission_date->headerCellClass() ?>"><div id="elh_jdh_vitals_submission_date" class="jdh_vitals_submission_date"><?= $Page->renderFieldHeader($Page->submission_date) ?></div></th>
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
    <?php if ($Page->vitals_id->Visible) { // vitals_id ?>
        <td data-name="vitals_id"<?= $Page->vitals_id->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_jdh_vitals_vitals_id" class="el_jdh_vitals_vitals_id"></span>
<input type="hidden" data-table="jdh_vitals" data-field="x_vitals_id" data-hidden="1" data-old name="o<?= $Page->RowIndex ?>_vitals_id" id="o<?= $Page->RowIndex ?>_vitals_id" value="<?= HtmlEncode($Page->vitals_id->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_jdh_vitals_vitals_id" class="el_jdh_vitals_vitals_id">
<span<?= $Page->vitals_id->viewAttributes() ?>>
<?= $Page->vitals_id->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->patient_id->Visible) { // patient_id ?>
        <td data-name="patient_id"<?= $Page->patient_id->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($Page->patient_id->getSessionValue() != "") { ?>
<span<?= $Page->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->patient_id->getDisplayValue($Page->patient_id->ViewValue) ?></span></span>
<input type="hidden" id="x<?= $Page->RowIndex ?>_patient_id" name="x<?= $Page->RowIndex ?>_patient_id" value="<?= HtmlEncode($Page->patient_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Page->RowCount ?>_jdh_vitals_patient_id" class="el_jdh_vitals_patient_id">
    <select
        id="x<?= $Page->RowIndex ?>_patient_id"
        name="x<?= $Page->RowIndex ?>_patient_id"
        class="form-select ew-select<?= $Page->patient_id->isInvalidClass() ?>"
        data-select2-id="<?= $Page->FormName ?>_x<?= $Page->RowIndex ?>_patient_id"
        data-table="jdh_vitals"
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
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_vitals.fields.patient_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<input type="hidden" data-table="jdh_vitals" data-field="x_patient_id" data-hidden="1" data-old name="o<?= $Page->RowIndex ?>_patient_id" id="o<?= $Page->RowIndex ?>_patient_id" value="<?= HtmlEncode($Page->patient_id->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_jdh_vitals_patient_id" class="el_jdh_vitals_patient_id">
<span<?= $Page->patient_id->viewAttributes() ?>>
<?= $Page->patient_id->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->pressure->Visible) { // pressure ?>
        <td data-name="pressure"<?= $Page->pressure->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_jdh_vitals_pressure" class="el_jdh_vitals_pressure">
<input type="<?= $Page->pressure->getInputTextType() ?>" name="x<?= $Page->RowIndex ?>_pressure" id="x<?= $Page->RowIndex ?>_pressure" data-table="jdh_vitals" data-field="x_pressure" value="<?= $Page->pressure->EditValue ?>" size="30" maxlength="30" placeholder="<?= HtmlEncode($Page->pressure->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->pressure->formatPattern()) ?>"<?= $Page->pressure->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->pressure->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="jdh_vitals" data-field="x_pressure" data-hidden="1" data-old name="o<?= $Page->RowIndex ?>_pressure" id="o<?= $Page->RowIndex ?>_pressure" value="<?= HtmlEncode($Page->pressure->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_jdh_vitals_pressure" class="el_jdh_vitals_pressure">
<span<?= $Page->pressure->viewAttributes() ?>>
<?= $Page->pressure->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->height->Visible) { // height ?>
        <td data-name="height"<?= $Page->height->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_jdh_vitals_height" class="el_jdh_vitals_height">
<input type="<?= $Page->height->getInputTextType() ?>" name="x<?= $Page->RowIndex ?>_height" id="x<?= $Page->RowIndex ?>_height" data-table="jdh_vitals" data-field="x_height" value="<?= $Page->height->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->height->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->height->formatPattern()) ?>"<?= $Page->height->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->height->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="jdh_vitals" data-field="x_height" data-hidden="1" data-old name="o<?= $Page->RowIndex ?>_height" id="o<?= $Page->RowIndex ?>_height" value="<?= HtmlEncode($Page->height->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_jdh_vitals_height" class="el_jdh_vitals_height">
<span<?= $Page->height->viewAttributes() ?>>
<?= $Page->height->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->weight->Visible) { // weight ?>
        <td data-name="weight"<?= $Page->weight->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_jdh_vitals_weight" class="el_jdh_vitals_weight">
<input type="<?= $Page->weight->getInputTextType() ?>" name="x<?= $Page->RowIndex ?>_weight" id="x<?= $Page->RowIndex ?>_weight" data-table="jdh_vitals" data-field="x_weight" value="<?= $Page->weight->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->weight->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->weight->formatPattern()) ?>"<?= $Page->weight->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->weight->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="jdh_vitals" data-field="x_weight" data-hidden="1" data-old name="o<?= $Page->RowIndex ?>_weight" id="o<?= $Page->RowIndex ?>_weight" value="<?= HtmlEncode($Page->weight->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_jdh_vitals_weight" class="el_jdh_vitals_weight">
<span<?= $Page->weight->viewAttributes() ?>>
<?= $Page->weight->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->body_mass_index->Visible) { // body_mass_index ?>
        <td data-name="body_mass_index"<?= $Page->body_mass_index->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_jdh_vitals_body_mass_index" class="el_jdh_vitals_body_mass_index">
<input type="<?= $Page->body_mass_index->getInputTextType() ?>" name="x<?= $Page->RowIndex ?>_body_mass_index" id="x<?= $Page->RowIndex ?>_body_mass_index" data-table="jdh_vitals" data-field="x_body_mass_index" value="<?= $Page->body_mass_index->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->body_mass_index->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->body_mass_index->formatPattern()) ?>"<?= $Page->body_mass_index->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->body_mass_index->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="jdh_vitals" data-field="x_body_mass_index" data-hidden="1" data-old name="o<?= $Page->RowIndex ?>_body_mass_index" id="o<?= $Page->RowIndex ?>_body_mass_index" value="<?= HtmlEncode($Page->body_mass_index->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_jdh_vitals_body_mass_index" class="el_jdh_vitals_body_mass_index">
<span<?= $Page->body_mass_index->viewAttributes() ?>>
<?= $Page->body_mass_index->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->pulse_rate->Visible) { // pulse_rate ?>
        <td data-name="pulse_rate"<?= $Page->pulse_rate->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_jdh_vitals_pulse_rate" class="el_jdh_vitals_pulse_rate">
<input type="<?= $Page->pulse_rate->getInputTextType() ?>" name="x<?= $Page->RowIndex ?>_pulse_rate" id="x<?= $Page->RowIndex ?>_pulse_rate" data-table="jdh_vitals" data-field="x_pulse_rate" value="<?= $Page->pulse_rate->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->pulse_rate->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->pulse_rate->formatPattern()) ?>"<?= $Page->pulse_rate->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->pulse_rate->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="jdh_vitals" data-field="x_pulse_rate" data-hidden="1" data-old name="o<?= $Page->RowIndex ?>_pulse_rate" id="o<?= $Page->RowIndex ?>_pulse_rate" value="<?= HtmlEncode($Page->pulse_rate->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_jdh_vitals_pulse_rate" class="el_jdh_vitals_pulse_rate">
<span<?= $Page->pulse_rate->viewAttributes() ?>>
<?= $Page->pulse_rate->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->respiratory_rate->Visible) { // respiratory_rate ?>
        <td data-name="respiratory_rate"<?= $Page->respiratory_rate->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_jdh_vitals_respiratory_rate" class="el_jdh_vitals_respiratory_rate">
<input type="<?= $Page->respiratory_rate->getInputTextType() ?>" name="x<?= $Page->RowIndex ?>_respiratory_rate" id="x<?= $Page->RowIndex ?>_respiratory_rate" data-table="jdh_vitals" data-field="x_respiratory_rate" value="<?= $Page->respiratory_rate->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->respiratory_rate->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->respiratory_rate->formatPattern()) ?>"<?= $Page->respiratory_rate->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->respiratory_rate->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="jdh_vitals" data-field="x_respiratory_rate" data-hidden="1" data-old name="o<?= $Page->RowIndex ?>_respiratory_rate" id="o<?= $Page->RowIndex ?>_respiratory_rate" value="<?= HtmlEncode($Page->respiratory_rate->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_jdh_vitals_respiratory_rate" class="el_jdh_vitals_respiratory_rate">
<span<?= $Page->respiratory_rate->viewAttributes() ?>>
<?= $Page->respiratory_rate->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->temperature->Visible) { // temperature ?>
        <td data-name="temperature"<?= $Page->temperature->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_jdh_vitals_temperature" class="el_jdh_vitals_temperature">
<input type="<?= $Page->temperature->getInputTextType() ?>" name="x<?= $Page->RowIndex ?>_temperature" id="x<?= $Page->RowIndex ?>_temperature" data-table="jdh_vitals" data-field="x_temperature" value="<?= $Page->temperature->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->temperature->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->temperature->formatPattern()) ?>"<?= $Page->temperature->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->temperature->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="jdh_vitals" data-field="x_temperature" data-hidden="1" data-old name="o<?= $Page->RowIndex ?>_temperature" id="o<?= $Page->RowIndex ?>_temperature" value="<?= HtmlEncode($Page->temperature->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_jdh_vitals_temperature" class="el_jdh_vitals_temperature">
<span<?= $Page->temperature->viewAttributes() ?>>
<?= $Page->temperature->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->random_blood_sugar->Visible) { // random_blood_sugar ?>
        <td data-name="random_blood_sugar"<?= $Page->random_blood_sugar->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_jdh_vitals_random_blood_sugar" class="el_jdh_vitals_random_blood_sugar">
<input type="<?= $Page->random_blood_sugar->getInputTextType() ?>" name="x<?= $Page->RowIndex ?>_random_blood_sugar" id="x<?= $Page->RowIndex ?>_random_blood_sugar" data-table="jdh_vitals" data-field="x_random_blood_sugar" value="<?= $Page->random_blood_sugar->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->random_blood_sugar->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->random_blood_sugar->formatPattern()) ?>"<?= $Page->random_blood_sugar->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->random_blood_sugar->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="jdh_vitals" data-field="x_random_blood_sugar" data-hidden="1" data-old name="o<?= $Page->RowIndex ?>_random_blood_sugar" id="o<?= $Page->RowIndex ?>_random_blood_sugar" value="<?= HtmlEncode($Page->random_blood_sugar->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_jdh_vitals_random_blood_sugar" class="el_jdh_vitals_random_blood_sugar">
<span<?= $Page->random_blood_sugar->viewAttributes() ?>>
<?= $Page->random_blood_sugar->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->submission_date->Visible) { // submission_date ?>
        <td data-name="submission_date"<?= $Page->submission_date->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_jdh_vitals_submission_date" class="el_jdh_vitals_submission_date">
<input type="<?= $Page->submission_date->getInputTextType() ?>" name="x<?= $Page->RowIndex ?>_submission_date" id="x<?= $Page->RowIndex ?>_submission_date" data-table="jdh_vitals" data-field="x_submission_date" value="<?= $Page->submission_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->submission_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->submission_date->formatPattern()) ?>"<?= $Page->submission_date->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->submission_date->getErrorMessage() ?></div>
<?php if (!$Page->submission_date->ReadOnly && !$Page->submission_date->Disabled && !isset($Page->submission_date->EditAttrs["readonly"]) && !isset($Page->submission_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["<?= $Page->FormName ?>", "datetimepicker"], function () {
    let format = "<?= DateFormat(1) ?>",
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
    ew.createDateTimePicker("<?= $Page->FormName ?>", "x<?= $Page->RowIndex ?>_submission_date", jQuery.extend(true, {"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="jdh_vitals" data-field="x_submission_date" data-hidden="1" data-old name="o<?= $Page->RowIndex ?>_submission_date" id="o<?= $Page->RowIndex ?>_submission_date" value="<?= HtmlEncode($Page->submission_date->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_jdh_vitals_submission_date" class="el_jdh_vitals_submission_date">
<span<?= $Page->submission_date->viewAttributes() ?>>
<?= $Page->submission_date->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowCount);
?>
    </tr>
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
    ew.addEventHandlers("jdh_vitals");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
