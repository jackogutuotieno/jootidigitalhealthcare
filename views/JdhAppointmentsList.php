<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$JdhAppointmentsList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_appointments: currentTable } });
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
            ["appointment_id", [fields.appointment_id.visible && fields.appointment_id.required ? ew.Validators.required(fields.appointment_id.caption) : null], fields.appointment_id.isInvalid],
            ["patient_id", [fields.patient_id.visible && fields.patient_id.required ? ew.Validators.required(fields.patient_id.caption) : null, ew.Validators.integer], fields.patient_id.isInvalid],
            ["appointment_title", [fields.appointment_title.visible && fields.appointment_title.required ? ew.Validators.required(fields.appointment_title.caption) : null], fields.appointment_title.isInvalid],
            ["appointment_start_date", [fields.appointment_start_date.visible && fields.appointment_start_date.required ? ew.Validators.required(fields.appointment_start_date.caption) : null, ew.Validators.datetime(fields.appointment_start_date.clientFormatPattern)], fields.appointment_start_date.isInvalid],
            ["appointment_end_date", [fields.appointment_end_date.visible && fields.appointment_end_date.required ? ew.Validators.required(fields.appointment_end_date.caption) : null, ew.Validators.datetime(fields.appointment_end_date.clientFormatPattern)], fields.appointment_end_date.isInvalid],
            ["appointment_all_day", [fields.appointment_all_day.visible && fields.appointment_all_day.required ? ew.Validators.required(fields.appointment_all_day.caption) : null], fields.appointment_all_day.isInvalid],
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
            "appointment_all_day": <?= $Page->appointment_all_day->toClientList($Page) ?>,
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
<form name="fjdh_appointmentssrch" id="fjdh_appointmentssrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>" novalidate autocomplete="on">
<div id="fjdh_appointmentssrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_appointments: currentTable } });
var currentForm;
var fjdh_appointmentssrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery,
        fields = currentTable.fields;

    // Form object for search
    let form = new ew.FormBuilder()
        .setId("fjdh_appointmentssrch")
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
<input type="hidden" name="t" value="jdh_appointments">
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fjdh_appointmentssrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fjdh_appointmentssrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fjdh_appointmentssrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fjdh_appointmentssrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<input type="hidden" name="t" value="jdh_appointments">
<?php if ($Page->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<?php if ($Page->getCurrentMasterTable() == "jdh_patients" && $Page->CurrentAction) { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="jdh_patients">
<input type="hidden" name="fk_patient_id" value="<?= HtmlEncode($Page->patient_id->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_jdh_appointments" class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>" style="<?= $Page->TableContainerStyle ?>">
<?php if ($Page->TotalRecords > 0 || $Page->isAdd() || $Page->isCopy() || $Page->isGridEdit() || $Page->isMultiEdit()) { ?>
<table id="tbl_jdh_appointmentslist" class="<?= $Page->TableClass ?>"><!-- .ew-table -->
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
<?php if ($Page->appointment_id->Visible) { // appointment_id ?>
        <th data-name="appointment_id" class="<?= $Page->appointment_id->headerCellClass() ?>"><div id="elh_jdh_appointments_appointment_id" class="jdh_appointments_appointment_id"><?= $Page->renderFieldHeader($Page->appointment_id) ?></div></th>
<?php } ?>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
        <th data-name="patient_id" class="<?= $Page->patient_id->headerCellClass() ?>"><div id="elh_jdh_appointments_patient_id" class="jdh_appointments_patient_id"><?= $Page->renderFieldHeader($Page->patient_id) ?></div></th>
<?php } ?>
<?php if ($Page->appointment_title->Visible) { // appointment_title ?>
        <th data-name="appointment_title" class="<?= $Page->appointment_title->headerCellClass() ?>"><div id="elh_jdh_appointments_appointment_title" class="jdh_appointments_appointment_title"><?= $Page->renderFieldHeader($Page->appointment_title) ?></div></th>
<?php } ?>
<?php if ($Page->appointment_start_date->Visible) { // appointment_start_date ?>
        <th data-name="appointment_start_date" class="<?= $Page->appointment_start_date->headerCellClass() ?>"><div id="elh_jdh_appointments_appointment_start_date" class="jdh_appointments_appointment_start_date"><?= $Page->renderFieldHeader($Page->appointment_start_date) ?></div></th>
<?php } ?>
<?php if ($Page->appointment_end_date->Visible) { // appointment_end_date ?>
        <th data-name="appointment_end_date" class="<?= $Page->appointment_end_date->headerCellClass() ?>"><div id="elh_jdh_appointments_appointment_end_date" class="jdh_appointments_appointment_end_date"><?= $Page->renderFieldHeader($Page->appointment_end_date) ?></div></th>
<?php } ?>
<?php if ($Page->appointment_all_day->Visible) { // appointment_all_day ?>
        <th data-name="appointment_all_day" class="<?= $Page->appointment_all_day->headerCellClass() ?>"><div id="elh_jdh_appointments_appointment_all_day" class="jdh_appointments_appointment_all_day"><?= $Page->renderFieldHeader($Page->appointment_all_day) ?></div></th>
<?php } ?>
<?php if ($Page->submission_date->Visible) { // submission_date ?>
        <th data-name="submission_date" class="<?= $Page->submission_date->headerCellClass() ?>"><div id="elh_jdh_appointments_submission_date" class="jdh_appointments_submission_date"><?= $Page->renderFieldHeader($Page->submission_date) ?></div></th>
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
    <?php if ($Page->appointment_id->Visible) { // appointment_id ?>
        <td data-name="appointment_id"<?= $Page->appointment_id->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_jdh_appointments_appointment_id" class="el_jdh_appointments_appointment_id"></span>
<input type="hidden" data-table="jdh_appointments" data-field="x_appointment_id" data-hidden="1" data-old name="o<?= $Page->RowIndex ?>_appointment_id" id="o<?= $Page->RowIndex ?>_appointment_id" value="<?= HtmlEncode($Page->appointment_id->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_jdh_appointments_appointment_id" class="el_jdh_appointments_appointment_id">
<span<?= $Page->appointment_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->appointment_id->getDisplayValue($Page->appointment_id->EditValue))) ?>"></span>
<input type="hidden" data-table="jdh_appointments" data-field="x_appointment_id" data-hidden="1" name="x<?= $Page->RowIndex ?>_appointment_id" id="x<?= $Page->RowIndex ?>_appointment_id" value="<?= HtmlEncode($Page->appointment_id->CurrentValue) ?>">
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_jdh_appointments_appointment_id" class="el_jdh_appointments_appointment_id">
<span<?= $Page->appointment_id->viewAttributes() ?>>
<?= $Page->appointment_id->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="jdh_appointments" data-field="x_appointment_id" data-hidden="1" name="x<?= $Page->RowIndex ?>_appointment_id" id="x<?= $Page->RowIndex ?>_appointment_id" value="<?= HtmlEncode($Page->appointment_id->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Page->patient_id->Visible) { // patient_id ?>
        <td data-name="patient_id"<?= $Page->patient_id->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($Page->patient_id->getSessionValue() != "") { ?>
<span<?= $Page->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->patient_id->getDisplayValue($Page->patient_id->ViewValue) ?></span></span>
<input type="hidden" id="x<?= $Page->RowIndex ?>_patient_id" name="x<?= $Page->RowIndex ?>_patient_id" value="<?= HtmlEncode($Page->patient_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Page->RowCount ?>_jdh_appointments_patient_id" class="el_jdh_appointments_patient_id">
<?php
if (IsRTL()) {
    $Page->patient_id->EditAttrs["dir"] = "rtl";
}
?>
<span id="as_x<?= $Page->RowIndex ?>_patient_id" class="ew-auto-suggest">
    <input type="<?= $Page->patient_id->getInputTextType() ?>" class="form-control" name="sv_x<?= $Page->RowIndex ?>_patient_id" id="sv_x<?= $Page->RowIndex ?>_patient_id" value="<?= RemoveHtml($Page->patient_id->EditValue) ?>" autocomplete="off" size="30" placeholder="<?= HtmlEncode($Page->patient_id->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Page->patient_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->patient_id->formatPattern()) ?>"<?= $Page->patient_id->editAttributes() ?>>
</span>
<selection-list hidden class="form-control" data-table="jdh_appointments" data-field="x_patient_id" data-input="sv_x<?= $Page->RowIndex ?>_patient_id" data-value-separator="<?= $Page->patient_id->displayValueSeparatorAttribute() ?>" name="x<?= $Page->RowIndex ?>_patient_id" id="x<?= $Page->RowIndex ?>_patient_id" value="<?= HtmlEncode($Page->patient_id->CurrentValue) ?>"></selection-list>
<div class="invalid-feedback"><?= $Page->patient_id->getErrorMessage() ?></div>
<script>
loadjs.ready("<?= $Page->FormName ?>", function() {
    <?= $Page->FormName ?>.createAutoSuggest(Object.assign({"id":"x<?= $Page->RowIndex ?>_patient_id","forceSelect":false}, { lookupAllDisplayFields: <?= $Page->patient_id->Lookup->LookupAllDisplayFields ? "true" : "false" ?> }, ew.vars.tables.jdh_appointments.fields.patient_id.autoSuggestOptions));
});
</script>
<?= $Page->patient_id->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_patient_id") ?>
</span>
<?php } ?>
<input type="hidden" data-table="jdh_appointments" data-field="x_patient_id" data-hidden="1" data-old name="o<?= $Page->RowIndex ?>_patient_id" id="o<?= $Page->RowIndex ?>_patient_id" value="<?= HtmlEncode($Page->patient_id->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($Page->patient_id->getSessionValue() != "") { ?>
<span<?= $Page->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->patient_id->getDisplayValue($Page->patient_id->ViewValue) ?></span></span>
<input type="hidden" id="x<?= $Page->RowIndex ?>_patient_id" name="x<?= $Page->RowIndex ?>_patient_id" value="<?= HtmlEncode($Page->patient_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Page->RowCount ?>_jdh_appointments_patient_id" class="el_jdh_appointments_patient_id">
<?php
if (IsRTL()) {
    $Page->patient_id->EditAttrs["dir"] = "rtl";
}
?>
<span id="as_x<?= $Page->RowIndex ?>_patient_id" class="ew-auto-suggest">
    <input type="<?= $Page->patient_id->getInputTextType() ?>" class="form-control" name="sv_x<?= $Page->RowIndex ?>_patient_id" id="sv_x<?= $Page->RowIndex ?>_patient_id" value="<?= RemoveHtml($Page->patient_id->EditValue) ?>" autocomplete="off" size="30" placeholder="<?= HtmlEncode($Page->patient_id->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Page->patient_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->patient_id->formatPattern()) ?>"<?= $Page->patient_id->editAttributes() ?>>
</span>
<selection-list hidden class="form-control" data-table="jdh_appointments" data-field="x_patient_id" data-input="sv_x<?= $Page->RowIndex ?>_patient_id" data-value-separator="<?= $Page->patient_id->displayValueSeparatorAttribute() ?>" name="x<?= $Page->RowIndex ?>_patient_id" id="x<?= $Page->RowIndex ?>_patient_id" value="<?= HtmlEncode($Page->patient_id->CurrentValue) ?>"></selection-list>
<div class="invalid-feedback"><?= $Page->patient_id->getErrorMessage() ?></div>
<script>
loadjs.ready("<?= $Page->FormName ?>", function() {
    <?= $Page->FormName ?>.createAutoSuggest(Object.assign({"id":"x<?= $Page->RowIndex ?>_patient_id","forceSelect":false}, { lookupAllDisplayFields: <?= $Page->patient_id->Lookup->LookupAllDisplayFields ? "true" : "false" ?> }, ew.vars.tables.jdh_appointments.fields.patient_id.autoSuggestOptions));
});
</script>
<?= $Page->patient_id->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_patient_id") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_jdh_appointments_patient_id" class="el_jdh_appointments_patient_id">
<span<?= $Page->patient_id->viewAttributes() ?>>
<?= $Page->patient_id->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->appointment_title->Visible) { // appointment_title ?>
        <td data-name="appointment_title"<?= $Page->appointment_title->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_jdh_appointments_appointment_title" class="el_jdh_appointments_appointment_title">
<input type="<?= $Page->appointment_title->getInputTextType() ?>" name="x<?= $Page->RowIndex ?>_appointment_title" id="x<?= $Page->RowIndex ?>_appointment_title" data-table="jdh_appointments" data-field="x_appointment_title" value="<?= $Page->appointment_title->EditValue ?>" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->appointment_title->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->appointment_title->formatPattern()) ?>"<?= $Page->appointment_title->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->appointment_title->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="jdh_appointments" data-field="x_appointment_title" data-hidden="1" data-old name="o<?= $Page->RowIndex ?>_appointment_title" id="o<?= $Page->RowIndex ?>_appointment_title" value="<?= HtmlEncode($Page->appointment_title->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_jdh_appointments_appointment_title" class="el_jdh_appointments_appointment_title">
<input type="<?= $Page->appointment_title->getInputTextType() ?>" name="x<?= $Page->RowIndex ?>_appointment_title" id="x<?= $Page->RowIndex ?>_appointment_title" data-table="jdh_appointments" data-field="x_appointment_title" value="<?= $Page->appointment_title->EditValue ?>" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->appointment_title->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->appointment_title->formatPattern()) ?>"<?= $Page->appointment_title->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->appointment_title->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_jdh_appointments_appointment_title" class="el_jdh_appointments_appointment_title">
<span<?= $Page->appointment_title->viewAttributes() ?>>
<?= $Page->appointment_title->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->appointment_start_date->Visible) { // appointment_start_date ?>
        <td data-name="appointment_start_date"<?= $Page->appointment_start_date->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_jdh_appointments_appointment_start_date" class="el_jdh_appointments_appointment_start_date">
<input type="<?= $Page->appointment_start_date->getInputTextType() ?>" name="x<?= $Page->RowIndex ?>_appointment_start_date" id="x<?= $Page->RowIndex ?>_appointment_start_date" data-table="jdh_appointments" data-field="x_appointment_start_date" value="<?= $Page->appointment_start_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->appointment_start_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->appointment_start_date->formatPattern()) ?>"<?= $Page->appointment_start_date->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->appointment_start_date->getErrorMessage() ?></div>
<?php if (!$Page->appointment_start_date->ReadOnly && !$Page->appointment_start_date->Disabled && !isset($Page->appointment_start_date->EditAttrs["readonly"]) && !isset($Page->appointment_start_date->EditAttrs["disabled"])) { ?>
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
    ew.createDateTimePicker("<?= $Page->FormName ?>", "x<?= $Page->RowIndex ?>_appointment_start_date", jQuery.extend(true, {"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="jdh_appointments" data-field="x_appointment_start_date" data-hidden="1" data-old name="o<?= $Page->RowIndex ?>_appointment_start_date" id="o<?= $Page->RowIndex ?>_appointment_start_date" value="<?= HtmlEncode($Page->appointment_start_date->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_jdh_appointments_appointment_start_date" class="el_jdh_appointments_appointment_start_date">
<input type="<?= $Page->appointment_start_date->getInputTextType() ?>" name="x<?= $Page->RowIndex ?>_appointment_start_date" id="x<?= $Page->RowIndex ?>_appointment_start_date" data-table="jdh_appointments" data-field="x_appointment_start_date" value="<?= $Page->appointment_start_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->appointment_start_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->appointment_start_date->formatPattern()) ?>"<?= $Page->appointment_start_date->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->appointment_start_date->getErrorMessage() ?></div>
<?php if (!$Page->appointment_start_date->ReadOnly && !$Page->appointment_start_date->Disabled && !isset($Page->appointment_start_date->EditAttrs["readonly"]) && !isset($Page->appointment_start_date->EditAttrs["disabled"])) { ?>
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
    ew.createDateTimePicker("<?= $Page->FormName ?>", "x<?= $Page->RowIndex ?>_appointment_start_date", jQuery.extend(true, {"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_jdh_appointments_appointment_start_date" class="el_jdh_appointments_appointment_start_date">
<span<?= $Page->appointment_start_date->viewAttributes() ?>>
<?= $Page->appointment_start_date->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->appointment_end_date->Visible) { // appointment_end_date ?>
        <td data-name="appointment_end_date"<?= $Page->appointment_end_date->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_jdh_appointments_appointment_end_date" class="el_jdh_appointments_appointment_end_date">
<input type="<?= $Page->appointment_end_date->getInputTextType() ?>" name="x<?= $Page->RowIndex ?>_appointment_end_date" id="x<?= $Page->RowIndex ?>_appointment_end_date" data-table="jdh_appointments" data-field="x_appointment_end_date" value="<?= $Page->appointment_end_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->appointment_end_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->appointment_end_date->formatPattern()) ?>"<?= $Page->appointment_end_date->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->appointment_end_date->getErrorMessage() ?></div>
<?php if (!$Page->appointment_end_date->ReadOnly && !$Page->appointment_end_date->Disabled && !isset($Page->appointment_end_date->EditAttrs["readonly"]) && !isset($Page->appointment_end_date->EditAttrs["disabled"])) { ?>
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
    ew.createDateTimePicker("<?= $Page->FormName ?>", "x<?= $Page->RowIndex ?>_appointment_end_date", jQuery.extend(true, {"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="jdh_appointments" data-field="x_appointment_end_date" data-hidden="1" data-old name="o<?= $Page->RowIndex ?>_appointment_end_date" id="o<?= $Page->RowIndex ?>_appointment_end_date" value="<?= HtmlEncode($Page->appointment_end_date->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_jdh_appointments_appointment_end_date" class="el_jdh_appointments_appointment_end_date">
<input type="<?= $Page->appointment_end_date->getInputTextType() ?>" name="x<?= $Page->RowIndex ?>_appointment_end_date" id="x<?= $Page->RowIndex ?>_appointment_end_date" data-table="jdh_appointments" data-field="x_appointment_end_date" value="<?= $Page->appointment_end_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->appointment_end_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->appointment_end_date->formatPattern()) ?>"<?= $Page->appointment_end_date->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->appointment_end_date->getErrorMessage() ?></div>
<?php if (!$Page->appointment_end_date->ReadOnly && !$Page->appointment_end_date->Disabled && !isset($Page->appointment_end_date->EditAttrs["readonly"]) && !isset($Page->appointment_end_date->EditAttrs["disabled"])) { ?>
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
    ew.createDateTimePicker("<?= $Page->FormName ?>", "x<?= $Page->RowIndex ?>_appointment_end_date", jQuery.extend(true, {"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_jdh_appointments_appointment_end_date" class="el_jdh_appointments_appointment_end_date">
<span<?= $Page->appointment_end_date->viewAttributes() ?>>
<?= $Page->appointment_end_date->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->appointment_all_day->Visible) { // appointment_all_day ?>
        <td data-name="appointment_all_day"<?= $Page->appointment_all_day->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_jdh_appointments_appointment_all_day" class="el_jdh_appointments_appointment_all_day">
<div class="form-check d-inline-block">
    <input type="checkbox" class="form-check-input<?= $Page->appointment_all_day->isInvalidClass() ?>" data-table="jdh_appointments" data-field="x_appointment_all_day" data-boolean name="x<?= $Page->RowIndex ?>_appointment_all_day" id="x<?= $Page->RowIndex ?>_appointment_all_day" value="1"<?= ConvertToBool($Page->appointment_all_day->CurrentValue) ? " checked" : "" ?><?= $Page->appointment_all_day->editAttributes() ?>>
    <div class="invalid-feedback"><?= $Page->appointment_all_day->getErrorMessage() ?></div>
</div>
</span>
<input type="hidden" data-table="jdh_appointments" data-field="x_appointment_all_day" data-hidden="1" data-old name="o<?= $Page->RowIndex ?>_appointment_all_day" id="o<?= $Page->RowIndex ?>_appointment_all_day" value="<?= HtmlEncode($Page->appointment_all_day->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_jdh_appointments_appointment_all_day" class="el_jdh_appointments_appointment_all_day">
<div class="form-check d-inline-block">
    <input type="checkbox" class="form-check-input<?= $Page->appointment_all_day->isInvalidClass() ?>" data-table="jdh_appointments" data-field="x_appointment_all_day" data-boolean name="x<?= $Page->RowIndex ?>_appointment_all_day" id="x<?= $Page->RowIndex ?>_appointment_all_day" value="1"<?= ConvertToBool($Page->appointment_all_day->CurrentValue) ? " checked" : "" ?><?= $Page->appointment_all_day->editAttributes() ?>>
    <div class="invalid-feedback"><?= $Page->appointment_all_day->getErrorMessage() ?></div>
</div>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_jdh_appointments_appointment_all_day" class="el_jdh_appointments_appointment_all_day">
<span<?= $Page->appointment_all_day->viewAttributes() ?>>
<div class="form-check d-inline-block">
    <input type="checkbox" id="x_appointment_all_day_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->appointment_all_day->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->appointment_all_day->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_appointment_all_day_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->submission_date->Visible) { // submission_date ?>
        <td data-name="submission_date"<?= $Page->submission_date->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_jdh_appointments_submission_date" class="el_jdh_appointments_submission_date">
<input type="<?= $Page->submission_date->getInputTextType() ?>" name="x<?= $Page->RowIndex ?>_submission_date" id="x<?= $Page->RowIndex ?>_submission_date" data-table="jdh_appointments" data-field="x_submission_date" value="<?= $Page->submission_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->submission_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->submission_date->formatPattern()) ?>"<?= $Page->submission_date->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->submission_date->getErrorMessage() ?></div>
<?php if (!$Page->submission_date->ReadOnly && !$Page->submission_date->Disabled && !isset($Page->submission_date->EditAttrs["readonly"]) && !isset($Page->submission_date->EditAttrs["disabled"])) { ?>
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
    ew.createDateTimePicker("<?= $Page->FormName ?>", "x<?= $Page->RowIndex ?>_submission_date", jQuery.extend(true, {"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="jdh_appointments" data-field="x_submission_date" data-hidden="1" data-old name="o<?= $Page->RowIndex ?>_submission_date" id="o<?= $Page->RowIndex ?>_submission_date" value="<?= HtmlEncode($Page->submission_date->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_jdh_appointments_submission_date" class="el_jdh_appointments_submission_date">
<input type="<?= $Page->submission_date->getInputTextType() ?>" name="x<?= $Page->RowIndex ?>_submission_date" id="x<?= $Page->RowIndex ?>_submission_date" data-table="jdh_appointments" data-field="x_submission_date" value="<?= $Page->submission_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->submission_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->submission_date->formatPattern()) ?>"<?= $Page->submission_date->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->submission_date->getErrorMessage() ?></div>
<?php if (!$Page->submission_date->ReadOnly && !$Page->submission_date->Disabled && !isset($Page->submission_date->EditAttrs["readonly"]) && !isset($Page->submission_date->EditAttrs["disabled"])) { ?>
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
    ew.createDateTimePicker("<?= $Page->FormName ?>", "x<?= $Page->RowIndex ?>_submission_date", jQuery.extend(true, {"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_jdh_appointments_submission_date" class="el_jdh_appointments_submission_date">
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
    ew.addEventHandlers("jdh_appointments");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
