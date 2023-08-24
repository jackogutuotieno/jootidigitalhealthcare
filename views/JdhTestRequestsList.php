<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$JdhTestRequestsList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_test_requests: currentTable } });
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
            ["request_id", [fields.request_id.visible && fields.request_id.required ? ew.Validators.required(fields.request_id.caption) : null], fields.request_id.isInvalid],
            ["patient_id", [fields.patient_id.visible && fields.patient_id.required ? ew.Validators.required(fields.patient_id.caption) : null], fields.patient_id.isInvalid],
            ["request_title", [fields.request_title.visible && fields.request_title.required ? ew.Validators.required(fields.request_title.caption) : null], fields.request_title.isInvalid],
            ["request_service_id", [fields.request_service_id.visible && fields.request_service_id.required ? ew.Validators.required(fields.request_service_id.caption) : null], fields.request_service_id.isInvalid],
            ["request_description", [fields.request_description.visible && fields.request_description.required ? ew.Validators.required(fields.request_description.caption) : null], fields.request_description.isInvalid],
            ["request_date", [fields.request_date.visible && fields.request_date.required ? ew.Validators.required(fields.request_date.caption) : null, ew.Validators.datetime(fields.request_date.clientFormatPattern)], fields.request_date.isInvalid],
            ["status_id", [fields.status_id.visible && fields.status_id.required ? ew.Validators.required(fields.status_id.caption) : null], fields.status_id.isInvalid]
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
            "request_service_id": <?= $Page->request_service_id->toClientList($Page) ?>,
            "status_id": <?= $Page->status_id->toClientList($Page) ?>,
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
<form name="fjdh_test_requestssrch" id="fjdh_test_requestssrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>" novalidate autocomplete="on">
<div id="fjdh_test_requestssrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_test_requests: currentTable } });
var currentForm;
var fjdh_test_requestssrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery,
        fields = currentTable.fields;

    // Form object for search
    let form = new ew.FormBuilder()
        .setId("fjdh_test_requestssrch")
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
<input type="hidden" name="t" value="jdh_test_requests">
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fjdh_test_requestssrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fjdh_test_requestssrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fjdh_test_requestssrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fjdh_test_requestssrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<input type="hidden" name="t" value="jdh_test_requests">
<?php if ($Page->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<?php if ($Page->getCurrentMasterTable() == "jdh_patients" && $Page->CurrentAction) { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="jdh_patients">
<input type="hidden" name="fk_patient_id" value="<?= HtmlEncode($Page->patient_id->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_jdh_test_requests" class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>" style="<?= $Page->TableContainerStyle ?>">
<?php if ($Page->TotalRecords > 0 || $Page->isAdd() || $Page->isCopy() || $Page->isGridEdit() || $Page->isMultiEdit()) { ?>
<table id="tbl_jdh_test_requestslist" class="<?= $Page->TableClass ?>"><!-- .ew-table -->
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
<?php if ($Page->request_id->Visible) { // request_id ?>
        <th data-name="request_id" class="<?= $Page->request_id->headerCellClass() ?>"><div id="elh_jdh_test_requests_request_id" class="jdh_test_requests_request_id"><?= $Page->renderFieldHeader($Page->request_id) ?></div></th>
<?php } ?>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
        <th data-name="patient_id" class="<?= $Page->patient_id->headerCellClass() ?>"><div id="elh_jdh_test_requests_patient_id" class="jdh_test_requests_patient_id"><?= $Page->renderFieldHeader($Page->patient_id) ?></div></th>
<?php } ?>
<?php if ($Page->request_title->Visible) { // request_title ?>
        <th data-name="request_title" class="<?= $Page->request_title->headerCellClass() ?>"><div id="elh_jdh_test_requests_request_title" class="jdh_test_requests_request_title"><?= $Page->renderFieldHeader($Page->request_title) ?></div></th>
<?php } ?>
<?php if ($Page->request_service_id->Visible) { // request_service_id ?>
        <th data-name="request_service_id" class="<?= $Page->request_service_id->headerCellClass() ?>"><div id="elh_jdh_test_requests_request_service_id" class="jdh_test_requests_request_service_id"><?= $Page->renderFieldHeader($Page->request_service_id) ?></div></th>
<?php } ?>
<?php if ($Page->request_description->Visible) { // request_description ?>
        <th data-name="request_description" class="<?= $Page->request_description->headerCellClass() ?>"><div id="elh_jdh_test_requests_request_description" class="jdh_test_requests_request_description"><?= $Page->renderFieldHeader($Page->request_description) ?></div></th>
<?php } ?>
<?php if ($Page->request_date->Visible) { // request_date ?>
        <th data-name="request_date" class="<?= $Page->request_date->headerCellClass() ?>"><div id="elh_jdh_test_requests_request_date" class="jdh_test_requests_request_date"><?= $Page->renderFieldHeader($Page->request_date) ?></div></th>
<?php } ?>
<?php if ($Page->status_id->Visible) { // status_id ?>
        <th data-name="status_id" class="<?= $Page->status_id->headerCellClass() ?>"><div id="elh_jdh_test_requests_status_id" class="jdh_test_requests_status_id"><?= $Page->renderFieldHeader($Page->status_id) ?></div></th>
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
    <?php if ($Page->request_id->Visible) { // request_id ?>
        <td data-name="request_id"<?= $Page->request_id->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_jdh_test_requests_request_id" class="el_jdh_test_requests_request_id"></span>
<input type="hidden" data-table="jdh_test_requests" data-field="x_request_id" data-hidden="1" data-old name="o<?= $Page->RowIndex ?>_request_id" id="o<?= $Page->RowIndex ?>_request_id" value="<?= HtmlEncode($Page->request_id->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_jdh_test_requests_request_id" class="el_jdh_test_requests_request_id">
<span<?= $Page->request_id->viewAttributes() ?>>
<?= $Page->request_id->getViewValue() ?></span>
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
<span id="el<?= $Page->RowCount ?>_jdh_test_requests_patient_id" class="el_jdh_test_requests_patient_id">
    <select
        id="x<?= $Page->RowIndex ?>_patient_id"
        name="x<?= $Page->RowIndex ?>_patient_id"
        class="form-select ew-select<?= $Page->patient_id->isInvalidClass() ?>"
        data-select2-id="<?= $Page->FormName ?>_x<?= $Page->RowIndex ?>_patient_id"
        data-table="jdh_test_requests"
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
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_test_requests.fields.patient_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<input type="hidden" data-table="jdh_test_requests" data-field="x_patient_id" data-hidden="1" data-old name="o<?= $Page->RowIndex ?>_patient_id" id="o<?= $Page->RowIndex ?>_patient_id" value="<?= HtmlEncode($Page->patient_id->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_jdh_test_requests_patient_id" class="el_jdh_test_requests_patient_id">
<span<?= $Page->patient_id->viewAttributes() ?>>
<?= $Page->patient_id->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->request_title->Visible) { // request_title ?>
        <td data-name="request_title"<?= $Page->request_title->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_jdh_test_requests_request_title" class="el_jdh_test_requests_request_title">
<input type="<?= $Page->request_title->getInputTextType() ?>" name="x<?= $Page->RowIndex ?>_request_title" id="x<?= $Page->RowIndex ?>_request_title" data-table="jdh_test_requests" data-field="x_request_title" value="<?= $Page->request_title->EditValue ?>" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->request_title->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->request_title->formatPattern()) ?>"<?= $Page->request_title->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->request_title->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="jdh_test_requests" data-field="x_request_title" data-hidden="1" data-old name="o<?= $Page->RowIndex ?>_request_title" id="o<?= $Page->RowIndex ?>_request_title" value="<?= HtmlEncode($Page->request_title->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_jdh_test_requests_request_title" class="el_jdh_test_requests_request_title">
<span<?= $Page->request_title->viewAttributes() ?>>
<?= $Page->request_title->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->request_service_id->Visible) { // request_service_id ?>
        <td data-name="request_service_id"<?= $Page->request_service_id->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_jdh_test_requests_request_service_id" class="el_jdh_test_requests_request_service_id">
    <select
        id="x<?= $Page->RowIndex ?>_request_service_id"
        name="x<?= $Page->RowIndex ?>_request_service_id"
        class="form-select ew-select<?= $Page->request_service_id->isInvalidClass() ?>"
        data-select2-id="<?= $Page->FormName ?>_x<?= $Page->RowIndex ?>_request_service_id"
        data-table="jdh_test_requests"
        data-field="x_request_service_id"
        data-value-separator="<?= $Page->request_service_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->request_service_id->getPlaceHolder()) ?>"
        <?= $Page->request_service_id->editAttributes() ?>>
        <?= $Page->request_service_id->selectOptionListHtml("x{$Page->RowIndex}_request_service_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->request_service_id->getErrorMessage() ?></div>
<?= $Page->request_service_id->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_request_service_id") ?>
<script>
loadjs.ready("<?= $Page->FormName ?>", function() {
    var options = { name: "x<?= $Page->RowIndex ?>_request_service_id", selectId: "<?= $Page->FormName ?>_x<?= $Page->RowIndex ?>_request_service_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (<?= $Page->FormName ?>.lists.request_service_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Page->RowIndex ?>_request_service_id", form: "<?= $Page->FormName ?>" };
    } else {
        options.ajax = { id: "x<?= $Page->RowIndex ?>_request_service_id", form: "<?= $Page->FormName ?>", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_test_requests.fields.request_service_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<input type="hidden" data-table="jdh_test_requests" data-field="x_request_service_id" data-hidden="1" data-old name="o<?= $Page->RowIndex ?>_request_service_id" id="o<?= $Page->RowIndex ?>_request_service_id" value="<?= HtmlEncode($Page->request_service_id->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_jdh_test_requests_request_service_id" class="el_jdh_test_requests_request_service_id">
<span<?= $Page->request_service_id->viewAttributes() ?>>
<?= $Page->request_service_id->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->request_description->Visible) { // request_description ?>
        <td data-name="request_description"<?= $Page->request_description->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_jdh_test_requests_request_description" class="el_jdh_test_requests_request_description">
<textarea data-table="jdh_test_requests" data-field="x_request_description" name="x<?= $Page->RowIndex ?>_request_description" id="x<?= $Page->RowIndex ?>_request_description" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->request_description->getPlaceHolder()) ?>"<?= $Page->request_description->editAttributes() ?>><?= $Page->request_description->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Page->request_description->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="jdh_test_requests" data-field="x_request_description" data-hidden="1" data-old name="o<?= $Page->RowIndex ?>_request_description" id="o<?= $Page->RowIndex ?>_request_description" value="<?= HtmlEncode($Page->request_description->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_jdh_test_requests_request_description" class="el_jdh_test_requests_request_description">
<span<?= $Page->request_description->viewAttributes() ?>>
<?= $Page->request_description->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->request_date->Visible) { // request_date ?>
        <td data-name="request_date"<?= $Page->request_date->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_jdh_test_requests_request_date" class="el_jdh_test_requests_request_date">
<input type="<?= $Page->request_date->getInputTextType() ?>" name="x<?= $Page->RowIndex ?>_request_date" id="x<?= $Page->RowIndex ?>_request_date" data-table="jdh_test_requests" data-field="x_request_date" value="<?= $Page->request_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->request_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->request_date->formatPattern()) ?>"<?= $Page->request_date->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->request_date->getErrorMessage() ?></div>
<?php if (!$Page->request_date->ReadOnly && !$Page->request_date->Disabled && !isset($Page->request_date->EditAttrs["readonly"]) && !isset($Page->request_date->EditAttrs["disabled"])) { ?>
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
    ew.createDateTimePicker("<?= $Page->FormName ?>", "x<?= $Page->RowIndex ?>_request_date", jQuery.extend(true, {"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="jdh_test_requests" data-field="x_request_date" data-hidden="1" data-old name="o<?= $Page->RowIndex ?>_request_date" id="o<?= $Page->RowIndex ?>_request_date" value="<?= HtmlEncode($Page->request_date->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_jdh_test_requests_request_date" class="el_jdh_test_requests_request_date">
<span<?= $Page->request_date->viewAttributes() ?>>
<?= $Page->request_date->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->status_id->Visible) { // status_id ?>
        <td data-name="status_id"<?= $Page->status_id->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_jdh_test_requests_status_id" class="el_jdh_test_requests_status_id">
    <select
        id="x<?= $Page->RowIndex ?>_status_id"
        name="x<?= $Page->RowIndex ?>_status_id"
        class="form-select ew-select<?= $Page->status_id->isInvalidClass() ?>"
        data-select2-id="<?= $Page->FormName ?>_x<?= $Page->RowIndex ?>_status_id"
        data-table="jdh_test_requests"
        data-field="x_status_id"
        data-value-separator="<?= $Page->status_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->status_id->getPlaceHolder()) ?>"
        <?= $Page->status_id->editAttributes() ?>>
        <?= $Page->status_id->selectOptionListHtml("x{$Page->RowIndex}_status_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->status_id->getErrorMessage() ?></div>
<script>
loadjs.ready("<?= $Page->FormName ?>", function() {
    var options = { name: "x<?= $Page->RowIndex ?>_status_id", selectId: "<?= $Page->FormName ?>_x<?= $Page->RowIndex ?>_status_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (<?= $Page->FormName ?>.lists.status_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Page->RowIndex ?>_status_id", form: "<?= $Page->FormName ?>" };
    } else {
        options.ajax = { id: "x<?= $Page->RowIndex ?>_status_id", form: "<?= $Page->FormName ?>", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_test_requests.fields.status_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<input type="hidden" data-table="jdh_test_requests" data-field="x_status_id" data-hidden="1" data-old name="o<?= $Page->RowIndex ?>_status_id" id="o<?= $Page->RowIndex ?>_status_id" value="<?= HtmlEncode($Page->status_id->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_jdh_test_requests_status_id" class="el_jdh_test_requests_status_id">
<span<?= $Page->status_id->viewAttributes() ?>>
<?= $Page->status_id->getViewValue() ?></span>
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
    ew.addEventHandlers("jdh_test_requests");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
