<?php

namespace PHPMaker2024\jootidigitalhealthcare;

// Set up and run Grid object
$Grid = Container("JdhTestRequestsGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fjdh_test_requestsgrid;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { jdh_test_requests: currentTable } });
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_test_requestsgrid")
        .setPageId("grid")
        .setFormKeyCountName("<?= $Grid->FormKeyCountName ?>")

        // Add fields
        .setFields([
            ["patient_id", [fields.patient_id.visible && fields.patient_id.required ? ew.Validators.required(fields.patient_id.caption) : null], fields.patient_id.isInvalid],
            ["request_title", [fields.request_title.visible && fields.request_title.required ? ew.Validators.required(fields.request_title.caption) : null], fields.request_title.isInvalid],
            ["request_service_id", [fields.request_service_id.visible && fields.request_service_id.required ? ew.Validators.required(fields.request_service_id.caption) : null], fields.request_service_id.isInvalid],
            ["request_description", [fields.request_description.visible && fields.request_description.required ? ew.Validators.required(fields.request_description.caption) : null], fields.request_description.isInvalid],
            ["request_date", [fields.request_date.visible && fields.request_date.required ? ew.Validators.required(fields.request_date.caption) : null], fields.request_date.isInvalid],
            ["status_id", [fields.status_id.visible && fields.status_id.required ? ew.Validators.required(fields.status_id.caption) : null], fields.status_id.isInvalid]
        ])

        // Check empty row
        .setEmptyRow(
            function (rowIndex) {
                let fobj = this.getForm(),
                    fields = [["patient_id",false],["request_title",false],["request_service_id",false],["request_description",false],["request_date",false],["status_id",false]];
                if (fields.some(field => ew.valueChanged(fobj, rowIndex, ...field)))
                    return false;
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
            "patient_id": <?= $Grid->patient_id->toClientList($Grid) ?>,
            "request_service_id": <?= $Grid->request_service_id->toClientList($Grid) ?>,
            "status_id": <?= $Grid->status_id->toClientList($Grid) ?>,
        })
        .build();
    window[form.id] = form;
    loadjs.done(form.id);
});
</script>
<?php } ?>
<main class="list">
<div id="ew-header-options">
<?php $Grid->HeaderOptions?->render("body") ?>
</div>
<div id="ew-list">
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?= $Grid->isAddOrEdit() ? " ew-grid-add-edit" : "" ?> <?= $Grid->TableGridClass ?>">
<div id="fjdh_test_requestsgrid" class="ew-form ew-list-form">
<div id="gmp_jdh_test_requests" class="card-body ew-grid-middle-panel <?= $Grid->TableContainerClass ?>" style="<?= $Grid->TableContainerStyle ?>">
<table id="tbl_jdh_test_requestsgrid" class="<?= $Grid->TableClass ?>"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Grid->RowType = RowType::HEADER;

// Render list options
$Grid->renderListOptions();

// Render list options (header, left)
$Grid->ListOptions->render("header", "left");
?>
<?php if ($Grid->patient_id->Visible) { // patient_id ?>
        <th data-name="patient_id" class="<?= $Grid->patient_id->headerCellClass() ?>"><div id="elh_jdh_test_requests_patient_id" class="jdh_test_requests_patient_id"><?= $Grid->renderFieldHeader($Grid->patient_id) ?></div></th>
<?php } ?>
<?php if ($Grid->request_title->Visible) { // request_title ?>
        <th data-name="request_title" class="<?= $Grid->request_title->headerCellClass() ?>"><div id="elh_jdh_test_requests_request_title" class="jdh_test_requests_request_title"><?= $Grid->renderFieldHeader($Grid->request_title) ?></div></th>
<?php } ?>
<?php if ($Grid->request_service_id->Visible) { // request_service_id ?>
        <th data-name="request_service_id" class="<?= $Grid->request_service_id->headerCellClass() ?>"><div id="elh_jdh_test_requests_request_service_id" class="jdh_test_requests_request_service_id"><?= $Grid->renderFieldHeader($Grid->request_service_id) ?></div></th>
<?php } ?>
<?php if ($Grid->request_description->Visible) { // request_description ?>
        <th data-name="request_description" class="<?= $Grid->request_description->headerCellClass() ?>"><div id="elh_jdh_test_requests_request_description" class="jdh_test_requests_request_description"><?= $Grid->renderFieldHeader($Grid->request_description) ?></div></th>
<?php } ?>
<?php if ($Grid->request_date->Visible) { // request_date ?>
        <th data-name="request_date" class="<?= $Grid->request_date->headerCellClass() ?>"><div id="elh_jdh_test_requests_request_date" class="jdh_test_requests_request_date"><?= $Grid->renderFieldHeader($Grid->request_date) ?></div></th>
<?php } ?>
<?php if ($Grid->status_id->Visible) { // status_id ?>
        <th data-name="status_id" class="<?= $Grid->status_id->headerCellClass() ?>"><div id="elh_jdh_test_requests_status_id" class="jdh_test_requests_status_id"><?= $Grid->renderFieldHeader($Grid->status_id) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Grid->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody data-page="<?= $Grid->getPageNumber() ?>">
<?php
$Grid->setupGrid();
while ($Grid->RecordCount < $Grid->StopRecord || $Grid->RowIndex === '$rowindex$') {
    if (
        $Grid->CurrentRow !== false &&
        $Grid->RowIndex !== '$rowindex$' &&
        (!$Grid->isGridAdd() || $Grid->CurrentMode == "copy") &&
        (!(($Grid->isCopy() || $Grid->isAdd()) && $Grid->RowIndex == 0))
    ) {
        $Grid->fetch();
    }
    $Grid->RecordCount++;
    if ($Grid->RecordCount >= $Grid->StartRecord) {
        $Grid->setupRow();

        // Skip 1) delete row / empty row for confirm page, 2) hidden row
        if (
            $Grid->RowAction != "delete" &&
            $Grid->RowAction != "insertdelete" &&
            !($Grid->RowAction == "insert" && $Grid->isConfirm() && $Grid->emptyRow()) &&
            $Grid->RowAction != "hide"
        ) {
?>
    <tr <?= $Grid->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Grid->ListOptions->render("body", "left", $Grid->RowCount);
?>
    <?php if ($Grid->patient_id->Visible) { // patient_id ?>
        <td data-name="patient_id"<?= $Grid->patient_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<?php if ($Grid->patient_id->getSessionValue() != "") { ?>
<span<?= $Grid->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->patient_id->getDisplayValue($Grid->patient_id->ViewValue) ?></span></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_patient_id" name="x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jdh_test_requests_patient_id" class="el_jdh_test_requests_patient_id">
    <select
        id="x<?= $Grid->RowIndex ?>_patient_id"
        name="x<?= $Grid->RowIndex ?>_patient_id"
        class="form-select ew-select<?= $Grid->patient_id->isInvalidClass() ?>"
        <?php if (!$Grid->patient_id->IsNativeSelect) { ?>
        data-select2-id="fjdh_test_requestsgrid_x<?= $Grid->RowIndex ?>_patient_id"
        <?php } ?>
        data-table="jdh_test_requests"
        data-field="x_patient_id"
        data-value-separator="<?= $Grid->patient_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->patient_id->getPlaceHolder()) ?>"
        <?= $Grid->patient_id->editAttributes() ?>>
        <?= $Grid->patient_id->selectOptionListHtml("x{$Grid->RowIndex}_patient_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->patient_id->getErrorMessage() ?></div>
<?= $Grid->patient_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_patient_id") ?>
<?php if (!$Grid->patient_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fjdh_test_requestsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_patient_id", selectId: "fjdh_test_requestsgrid_x<?= $Grid->RowIndex ?>_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_test_requestsgrid.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fjdh_test_requestsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fjdh_test_requestsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_test_requests.fields.patient_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<input type="hidden" data-table="jdh_test_requests" data-field="x_patient_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_patient_id" id="o<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jdh_test_requests_patient_id" class="el_jdh_test_requests_patient_id">
<span<?= $Grid->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->patient_id->getDisplayValue($Grid->patient_id->EditValue) ?></span></span>
<input type="hidden" data-table="jdh_test_requests" data-field="x_patient_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_patient_id" id="x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->CurrentValue) ?>">
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jdh_test_requests_patient_id" class="el_jdh_test_requests_patient_id">
<span<?= $Grid->patient_id->viewAttributes() ?>>
<?= $Grid->patient_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_test_requests" data-field="x_patient_id" data-hidden="1" name="fjdh_test_requestsgrid$x<?= $Grid->RowIndex ?>_patient_id" id="fjdh_test_requestsgrid$x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->FormValue) ?>">
<input type="hidden" data-table="jdh_test_requests" data-field="x_patient_id" data-hidden="1" data-old name="fjdh_test_requestsgrid$o<?= $Grid->RowIndex ?>_patient_id" id="fjdh_test_requestsgrid$o<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->request_title->Visible) { // request_title ?>
        <td data-name="request_title"<?= $Grid->request_title->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jdh_test_requests_request_title" class="el_jdh_test_requests_request_title">
<input type="<?= $Grid->request_title->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_request_title" id="x<?= $Grid->RowIndex ?>_request_title" data-table="jdh_test_requests" data-field="x_request_title" value="<?= $Grid->request_title->EditValue ?>" size="30" maxlength="200" placeholder="<?= HtmlEncode($Grid->request_title->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->request_title->formatPattern()) ?>"<?= $Grid->request_title->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->request_title->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="jdh_test_requests" data-field="x_request_title" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_request_title" id="o<?= $Grid->RowIndex ?>_request_title" value="<?= HtmlEncode($Grid->request_title->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jdh_test_requests_request_title" class="el_jdh_test_requests_request_title">
<span<?= $Grid->request_title->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->request_title->getDisplayValue($Grid->request_title->EditValue))) ?>"></span>
<input type="hidden" data-table="jdh_test_requests" data-field="x_request_title" data-hidden="1" name="x<?= $Grid->RowIndex ?>_request_title" id="x<?= $Grid->RowIndex ?>_request_title" value="<?= HtmlEncode($Grid->request_title->CurrentValue) ?>">
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jdh_test_requests_request_title" class="el_jdh_test_requests_request_title">
<span<?= $Grid->request_title->viewAttributes() ?>>
<?= $Grid->request_title->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_test_requests" data-field="x_request_title" data-hidden="1" name="fjdh_test_requestsgrid$x<?= $Grid->RowIndex ?>_request_title" id="fjdh_test_requestsgrid$x<?= $Grid->RowIndex ?>_request_title" value="<?= HtmlEncode($Grid->request_title->FormValue) ?>">
<input type="hidden" data-table="jdh_test_requests" data-field="x_request_title" data-hidden="1" data-old name="fjdh_test_requestsgrid$o<?= $Grid->RowIndex ?>_request_title" id="fjdh_test_requestsgrid$o<?= $Grid->RowIndex ?>_request_title" value="<?= HtmlEncode($Grid->request_title->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->request_service_id->Visible) { // request_service_id ?>
        <td data-name="request_service_id"<?= $Grid->request_service_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jdh_test_requests_request_service_id" class="el_jdh_test_requests_request_service_id">
    <select
        id="x<?= $Grid->RowIndex ?>_request_service_id"
        name="x<?= $Grid->RowIndex ?>_request_service_id"
        class="form-select ew-select<?= $Grid->request_service_id->isInvalidClass() ?>"
        <?php if (!$Grid->request_service_id->IsNativeSelect) { ?>
        data-select2-id="fjdh_test_requestsgrid_x<?= $Grid->RowIndex ?>_request_service_id"
        <?php } ?>
        data-table="jdh_test_requests"
        data-field="x_request_service_id"
        data-value-separator="<?= $Grid->request_service_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->request_service_id->getPlaceHolder()) ?>"
        <?= $Grid->request_service_id->editAttributes() ?>>
        <?= $Grid->request_service_id->selectOptionListHtml("x{$Grid->RowIndex}_request_service_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->request_service_id->getErrorMessage() ?></div>
<?= $Grid->request_service_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_request_service_id") ?>
<?php if (!$Grid->request_service_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fjdh_test_requestsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_request_service_id", selectId: "fjdh_test_requestsgrid_x<?= $Grid->RowIndex ?>_request_service_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_test_requestsgrid.lists.request_service_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_request_service_id", form: "fjdh_test_requestsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_request_service_id", form: "fjdh_test_requestsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_test_requests.fields.request_service_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="jdh_test_requests" data-field="x_request_service_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_request_service_id" id="o<?= $Grid->RowIndex ?>_request_service_id" value="<?= HtmlEncode($Grid->request_service_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jdh_test_requests_request_service_id" class="el_jdh_test_requests_request_service_id">
<span<?= $Grid->request_service_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->request_service_id->getDisplayValue($Grid->request_service_id->EditValue) ?></span></span>
<input type="hidden" data-table="jdh_test_requests" data-field="x_request_service_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_request_service_id" id="x<?= $Grid->RowIndex ?>_request_service_id" value="<?= HtmlEncode($Grid->request_service_id->CurrentValue) ?>">
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jdh_test_requests_request_service_id" class="el_jdh_test_requests_request_service_id">
<span<?= $Grid->request_service_id->viewAttributes() ?>>
<?= $Grid->request_service_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_test_requests" data-field="x_request_service_id" data-hidden="1" name="fjdh_test_requestsgrid$x<?= $Grid->RowIndex ?>_request_service_id" id="fjdh_test_requestsgrid$x<?= $Grid->RowIndex ?>_request_service_id" value="<?= HtmlEncode($Grid->request_service_id->FormValue) ?>">
<input type="hidden" data-table="jdh_test_requests" data-field="x_request_service_id" data-hidden="1" data-old name="fjdh_test_requestsgrid$o<?= $Grid->RowIndex ?>_request_service_id" id="fjdh_test_requestsgrid$o<?= $Grid->RowIndex ?>_request_service_id" value="<?= HtmlEncode($Grid->request_service_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->request_description->Visible) { // request_description ?>
        <td data-name="request_description"<?= $Grid->request_description->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jdh_test_requests_request_description" class="el_jdh_test_requests_request_description">
<textarea data-table="jdh_test_requests" data-field="x_request_description" name="x<?= $Grid->RowIndex ?>_request_description" id="x<?= $Grid->RowIndex ?>_request_description" cols="35" rows="4" placeholder="<?= HtmlEncode($Grid->request_description->getPlaceHolder()) ?>"<?= $Grid->request_description->editAttributes() ?>><?= $Grid->request_description->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Grid->request_description->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="jdh_test_requests" data-field="x_request_description" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_request_description" id="o<?= $Grid->RowIndex ?>_request_description" value="<?= HtmlEncode($Grid->request_description->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jdh_test_requests_request_description" class="el_jdh_test_requests_request_description">
<span<?= $Grid->request_description->viewAttributes() ?>>
<?= $Grid->request_description->EditValue ?></span>
<input type="hidden" data-table="jdh_test_requests" data-field="x_request_description" data-hidden="1" name="x<?= $Grid->RowIndex ?>_request_description" id="x<?= $Grid->RowIndex ?>_request_description" value="<?= HtmlEncode($Grid->request_description->CurrentValue) ?>">
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jdh_test_requests_request_description" class="el_jdh_test_requests_request_description">
<span<?= $Grid->request_description->viewAttributes() ?>>
<?= $Grid->request_description->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_test_requests" data-field="x_request_description" data-hidden="1" name="fjdh_test_requestsgrid$x<?= $Grid->RowIndex ?>_request_description" id="fjdh_test_requestsgrid$x<?= $Grid->RowIndex ?>_request_description" value="<?= HtmlEncode($Grid->request_description->FormValue) ?>">
<input type="hidden" data-table="jdh_test_requests" data-field="x_request_description" data-hidden="1" data-old name="fjdh_test_requestsgrid$o<?= $Grid->RowIndex ?>_request_description" id="fjdh_test_requestsgrid$o<?= $Grid->RowIndex ?>_request_description" value="<?= HtmlEncode($Grid->request_description->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->request_date->Visible) { // request_date ?>
        <td data-name="request_date"<?= $Grid->request_date->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jdh_test_requests_request_date" class="el_jdh_test_requests_request_date">
<input type="<?= $Grid->request_date->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_request_date" id="x<?= $Grid->RowIndex ?>_request_date" data-table="jdh_test_requests" data-field="x_request_date" value="<?= $Grid->request_date->EditValue ?>" placeholder="<?= HtmlEncode($Grid->request_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->request_date->formatPattern()) ?>"<?= $Grid->request_date->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->request_date->getErrorMessage() ?></div>
<?php if (!$Grid->request_date->ReadOnly && !$Grid->request_date->Disabled && !isset($Grid->request_date->EditAttrs["readonly"]) && !isset($Grid->request_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjdh_test_requestsgrid", "datetimepicker"], function () {
    let format = "<?= DateFormat(11) ?>",
        options = {
            localization: {
                locale: ew.LANGUAGE_ID + "-u-nu-" + ew.getNumberingSystem(),
                hourCycle: format.match(/H/) ? "h24" : "h12",
                format,
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
                    seconds: !!format.match(/s/i)
                },
                theme: ew.getPreferredTheme()
            }
        };
    ew.createDateTimePicker("fjdh_test_requestsgrid", "x<?= $Grid->RowIndex ?>_request_date", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="jdh_test_requests" data-field="x_request_date" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_request_date" id="o<?= $Grid->RowIndex ?>_request_date" value="<?= HtmlEncode($Grid->request_date->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jdh_test_requests_request_date" class="el_jdh_test_requests_request_date">
<span<?= $Grid->request_date->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->request_date->getDisplayValue($Grid->request_date->EditValue))) ?>"></span>
<input type="hidden" data-table="jdh_test_requests" data-field="x_request_date" data-hidden="1" name="x<?= $Grid->RowIndex ?>_request_date" id="x<?= $Grid->RowIndex ?>_request_date" value="<?= HtmlEncode($Grid->request_date->CurrentValue) ?>">
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jdh_test_requests_request_date" class="el_jdh_test_requests_request_date">
<span<?= $Grid->request_date->viewAttributes() ?>>
<?= $Grid->request_date->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_test_requests" data-field="x_request_date" data-hidden="1" name="fjdh_test_requestsgrid$x<?= $Grid->RowIndex ?>_request_date" id="fjdh_test_requestsgrid$x<?= $Grid->RowIndex ?>_request_date" value="<?= HtmlEncode($Grid->request_date->FormValue) ?>">
<input type="hidden" data-table="jdh_test_requests" data-field="x_request_date" data-hidden="1" data-old name="fjdh_test_requestsgrid$o<?= $Grid->RowIndex ?>_request_date" id="fjdh_test_requestsgrid$o<?= $Grid->RowIndex ?>_request_date" value="<?= HtmlEncode($Grid->request_date->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->status_id->Visible) { // status_id ?>
        <td data-name="status_id"<?= $Grid->status_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jdh_test_requests_status_id" class="el_jdh_test_requests_status_id">
    <select
        id="x<?= $Grid->RowIndex ?>_status_id"
        name="x<?= $Grid->RowIndex ?>_status_id"
        class="form-select ew-select<?= $Grid->status_id->isInvalidClass() ?>"
        <?php if (!$Grid->status_id->IsNativeSelect) { ?>
        data-select2-id="fjdh_test_requestsgrid_x<?= $Grid->RowIndex ?>_status_id"
        <?php } ?>
        data-table="jdh_test_requests"
        data-field="x_status_id"
        data-value-separator="<?= $Grid->status_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->status_id->getPlaceHolder()) ?>"
        <?= $Grid->status_id->editAttributes() ?>>
        <?= $Grid->status_id->selectOptionListHtml("x{$Grid->RowIndex}_status_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->status_id->getErrorMessage() ?></div>
<?php if (!$Grid->status_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fjdh_test_requestsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_status_id", selectId: "fjdh_test_requestsgrid_x<?= $Grid->RowIndex ?>_status_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_test_requestsgrid.lists.status_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_status_id", form: "fjdh_test_requestsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_status_id", form: "fjdh_test_requestsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_test_requests.fields.status_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="jdh_test_requests" data-field="x_status_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_status_id" id="o<?= $Grid->RowIndex ?>_status_id" value="<?= HtmlEncode($Grid->status_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jdh_test_requests_status_id" class="el_jdh_test_requests_status_id">
    <select
        id="x<?= $Grid->RowIndex ?>_status_id"
        name="x<?= $Grid->RowIndex ?>_status_id"
        class="form-select ew-select<?= $Grid->status_id->isInvalidClass() ?>"
        <?php if (!$Grid->status_id->IsNativeSelect) { ?>
        data-select2-id="fjdh_test_requestsgrid_x<?= $Grid->RowIndex ?>_status_id"
        <?php } ?>
        data-table="jdh_test_requests"
        data-field="x_status_id"
        data-value-separator="<?= $Grid->status_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->status_id->getPlaceHolder()) ?>"
        <?= $Grid->status_id->editAttributes() ?>>
        <?= $Grid->status_id->selectOptionListHtml("x{$Grid->RowIndex}_status_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->status_id->getErrorMessage() ?></div>
<?php if (!$Grid->status_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fjdh_test_requestsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_status_id", selectId: "fjdh_test_requestsgrid_x<?= $Grid->RowIndex ?>_status_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_test_requestsgrid.lists.status_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_status_id", form: "fjdh_test_requestsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_status_id", form: "fjdh_test_requestsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_test_requests.fields.status_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jdh_test_requests_status_id" class="el_jdh_test_requests_status_id">
<span<?= $Grid->status_id->viewAttributes() ?>>
<?= $Grid->status_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_test_requests" data-field="x_status_id" data-hidden="1" name="fjdh_test_requestsgrid$x<?= $Grid->RowIndex ?>_status_id" id="fjdh_test_requestsgrid$x<?= $Grid->RowIndex ?>_status_id" value="<?= HtmlEncode($Grid->status_id->FormValue) ?>">
<input type="hidden" data-table="jdh_test_requests" data-field="x_status_id" data-hidden="1" data-old name="fjdh_test_requestsgrid$o<?= $Grid->RowIndex ?>_status_id" id="fjdh_test_requestsgrid$o<?= $Grid->RowIndex ?>_status_id" value="<?= HtmlEncode($Grid->status_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowCount);
?>
    </tr>
<?php if ($Grid->RowType == RowType::ADD || $Grid->RowType == RowType::EDIT) { ?>
<script data-rowindex="<?= $Grid->RowIndex ?>">
loadjs.ready(["fjdh_test_requestsgrid","load"], () => fjdh_test_requestsgrid.updateLists(<?= $Grid->RowIndex ?><?= $Grid->isAdd() || $Grid->isEdit() || $Grid->isCopy() || $Grid->RowIndex === '$rowindex$' ? ", true" : "" ?>));
</script>
<?php } ?>
<?php
    }
    } // End delete row checking

    // Reset for template row
    if ($Grid->RowIndex === '$rowindex$') {
        $Grid->RowIndex = 0;
    }
    // Reset inline add/copy row
    if (($Grid->isCopy() || $Grid->isAdd()) && $Grid->RowIndex == 0) {
        $Grid->RowIndex = 1;
    }
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php if ($Grid->CurrentMode == "add" || $Grid->CurrentMode == "copy") { ?>
<input type="hidden" name="<?= $Grid->FormKeyCountName ?>" id="<?= $Grid->FormKeyCountName ?>" value="<?= $Grid->KeyCount ?>">
<?= $Grid->MultiSelectKey ?>
<?php } ?>
<?php if ($Grid->CurrentMode == "edit") { ?>
<input type="hidden" name="<?= $Grid->FormKeyCountName ?>" id="<?= $Grid->FormKeyCountName ?>" value="<?= $Grid->KeyCount ?>">
<?= $Grid->MultiSelectKey ?>
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if ($Grid->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fjdh_test_requestsgrid">
</div><!-- /.ew-list-form -->
<?php
// Close result set
$Grid->Recordset?->free();
?>
<?php if ($Grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $Grid->OtherOptions->render("body", "bottom") ?>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } else { ?>
<div class="ew-list-other-options">
<?php $Grid->OtherOptions->render("body") ?>
</div>
<?php } ?>
</div>
<div id="ew-footer-options">
<?php $Grid->FooterOptions?->render("body") ?>
</div>
</main>
<?php if (!$Grid->isExport()) { ?>
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
