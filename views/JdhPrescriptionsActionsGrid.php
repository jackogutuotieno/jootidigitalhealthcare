<?php

namespace PHPMaker2024\jootidigitalhealthcare;

// Set up and run Grid object
$Grid = Container("JdhPrescriptionsActionsGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fjdh_prescriptions_actionsgrid;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { jdh_prescriptions_actions: currentTable } });
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_prescriptions_actionsgrid")
        .setPageId("grid")
        .setFormKeyCountName("<?= $Grid->FormKeyCountName ?>")

        // Add fields
        .setFields([
            ["medicine_id", [fields.medicine_id.visible && fields.medicine_id.required ? ew.Validators.required(fields.medicine_id.caption) : null], fields.medicine_id.isInvalid],
            ["patient_id", [fields.patient_id.visible && fields.patient_id.required ? ew.Validators.required(fields.patient_id.caption) : null], fields.patient_id.isInvalid],
            ["units_given", [fields.units_given.visible && fields.units_given.required ? ew.Validators.required(fields.units_given.caption) : null, ew.Validators.integer], fields.units_given.isInvalid],
            ["submission_date", [fields.submission_date.visible && fields.submission_date.required ? ew.Validators.required(fields.submission_date.caption) : null, ew.Validators.datetime(fields.submission_date.clientFormatPattern)], fields.submission_date.isInvalid]
        ])

        // Check empty row
        .setEmptyRow(
            function (rowIndex) {
                let fobj = this.getForm(),
                    fields = [["medicine_id",false],["patient_id",false],["units_given",false],["submission_date",false]];
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
            "medicine_id": <?= $Grid->medicine_id->toClientList($Grid) ?>,
            "patient_id": <?= $Grid->patient_id->toClientList($Grid) ?>,
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
<div id="fjdh_prescriptions_actionsgrid" class="ew-form ew-list-form">
<div id="gmp_jdh_prescriptions_actions" class="card-body ew-grid-middle-panel <?= $Grid->TableContainerClass ?>" style="<?= $Grid->TableContainerStyle ?>">
<table id="tbl_jdh_prescriptions_actionsgrid" class="<?= $Grid->TableClass ?>"><!-- .ew-table -->
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
<?php if ($Grid->medicine_id->Visible) { // medicine_id ?>
        <th data-name="medicine_id" class="<?= $Grid->medicine_id->headerCellClass() ?>"><div id="elh_jdh_prescriptions_actions_medicine_id" class="jdh_prescriptions_actions_medicine_id"><?= $Grid->renderFieldHeader($Grid->medicine_id) ?></div></th>
<?php } ?>
<?php if ($Grid->patient_id->Visible) { // patient_id ?>
        <th data-name="patient_id" class="<?= $Grid->patient_id->headerCellClass() ?>"><div id="elh_jdh_prescriptions_actions_patient_id" class="jdh_prescriptions_actions_patient_id"><?= $Grid->renderFieldHeader($Grid->patient_id) ?></div></th>
<?php } ?>
<?php if ($Grid->units_given->Visible) { // units_given ?>
        <th data-name="units_given" class="<?= $Grid->units_given->headerCellClass() ?>"><div id="elh_jdh_prescriptions_actions_units_given" class="jdh_prescriptions_actions_units_given"><?= $Grid->renderFieldHeader($Grid->units_given) ?></div></th>
<?php } ?>
<?php if ($Grid->submission_date->Visible) { // submission_date ?>
        <th data-name="submission_date" class="<?= $Grid->submission_date->headerCellClass() ?>"><div id="elh_jdh_prescriptions_actions_submission_date" class="jdh_prescriptions_actions_submission_date"><?= $Grid->renderFieldHeader($Grid->submission_date) ?></div></th>
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
    <?php if ($Grid->medicine_id->Visible) { // medicine_id ?>
        <td data-name="medicine_id"<?= $Grid->medicine_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jdh_prescriptions_actions_medicine_id" class="el_jdh_prescriptions_actions_medicine_id">
    <select
        id="x<?= $Grid->RowIndex ?>_medicine_id"
        name="x<?= $Grid->RowIndex ?>_medicine_id"
        class="form-select ew-select<?= $Grid->medicine_id->isInvalidClass() ?>"
        <?php if (!$Grid->medicine_id->IsNativeSelect) { ?>
        data-select2-id="fjdh_prescriptions_actionsgrid_x<?= $Grid->RowIndex ?>_medicine_id"
        <?php } ?>
        data-table="jdh_prescriptions_actions"
        data-field="x_medicine_id"
        data-value-separator="<?= $Grid->medicine_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->medicine_id->getPlaceHolder()) ?>"
        <?= $Grid->medicine_id->editAttributes() ?>>
        <?= $Grid->medicine_id->selectOptionListHtml("x{$Grid->RowIndex}_medicine_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->medicine_id->getErrorMessage() ?></div>
<?= $Grid->medicine_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_medicine_id") ?>
<?php if (!$Grid->medicine_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fjdh_prescriptions_actionsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_medicine_id", selectId: "fjdh_prescriptions_actionsgrid_x<?= $Grid->RowIndex ?>_medicine_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_prescriptions_actionsgrid.lists.medicine_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_medicine_id", form: "fjdh_prescriptions_actionsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_medicine_id", form: "fjdh_prescriptions_actionsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_prescriptions_actions.fields.medicine_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="jdh_prescriptions_actions" data-field="x_medicine_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_medicine_id" id="o<?= $Grid->RowIndex ?>_medicine_id" value="<?= HtmlEncode($Grid->medicine_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jdh_prescriptions_actions_medicine_id" class="el_jdh_prescriptions_actions_medicine_id">
    <select
        id="x<?= $Grid->RowIndex ?>_medicine_id"
        name="x<?= $Grid->RowIndex ?>_medicine_id"
        class="form-select ew-select<?= $Grid->medicine_id->isInvalidClass() ?>"
        <?php if (!$Grid->medicine_id->IsNativeSelect) { ?>
        data-select2-id="fjdh_prescriptions_actionsgrid_x<?= $Grid->RowIndex ?>_medicine_id"
        <?php } ?>
        data-table="jdh_prescriptions_actions"
        data-field="x_medicine_id"
        data-value-separator="<?= $Grid->medicine_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->medicine_id->getPlaceHolder()) ?>"
        <?= $Grid->medicine_id->editAttributes() ?>>
        <?= $Grid->medicine_id->selectOptionListHtml("x{$Grid->RowIndex}_medicine_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->medicine_id->getErrorMessage() ?></div>
<?= $Grid->medicine_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_medicine_id") ?>
<?php if (!$Grid->medicine_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fjdh_prescriptions_actionsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_medicine_id", selectId: "fjdh_prescriptions_actionsgrid_x<?= $Grid->RowIndex ?>_medicine_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_prescriptions_actionsgrid.lists.medicine_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_medicine_id", form: "fjdh_prescriptions_actionsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_medicine_id", form: "fjdh_prescriptions_actionsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_prescriptions_actions.fields.medicine_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jdh_prescriptions_actions_medicine_id" class="el_jdh_prescriptions_actions_medicine_id">
<span<?= $Grid->medicine_id->viewAttributes() ?>>
<?= $Grid->medicine_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_prescriptions_actions" data-field="x_medicine_id" data-hidden="1" name="fjdh_prescriptions_actionsgrid$x<?= $Grid->RowIndex ?>_medicine_id" id="fjdh_prescriptions_actionsgrid$x<?= $Grid->RowIndex ?>_medicine_id" value="<?= HtmlEncode($Grid->medicine_id->FormValue) ?>">
<input type="hidden" data-table="jdh_prescriptions_actions" data-field="x_medicine_id" data-hidden="1" data-old name="fjdh_prescriptions_actionsgrid$o<?= $Grid->RowIndex ?>_medicine_id" id="fjdh_prescriptions_actionsgrid$o<?= $Grid->RowIndex ?>_medicine_id" value="<?= HtmlEncode($Grid->medicine_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->patient_id->Visible) { // patient_id ?>
        <td data-name="patient_id"<?= $Grid->patient_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<?php if ($Grid->patient_id->getSessionValue() != "") { ?>
<span<?= $Grid->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->patient_id->getDisplayValue($Grid->patient_id->ViewValue) ?></span></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_patient_id" name="x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jdh_prescriptions_actions_patient_id" class="el_jdh_prescriptions_actions_patient_id">
    <select
        id="x<?= $Grid->RowIndex ?>_patient_id"
        name="x<?= $Grid->RowIndex ?>_patient_id"
        class="form-select ew-select<?= $Grid->patient_id->isInvalidClass() ?>"
        <?php if (!$Grid->patient_id->IsNativeSelect) { ?>
        data-select2-id="fjdh_prescriptions_actionsgrid_x<?= $Grid->RowIndex ?>_patient_id"
        <?php } ?>
        data-table="jdh_prescriptions_actions"
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
loadjs.ready("fjdh_prescriptions_actionsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_patient_id", selectId: "fjdh_prescriptions_actionsgrid_x<?= $Grid->RowIndex ?>_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_prescriptions_actionsgrid.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fjdh_prescriptions_actionsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fjdh_prescriptions_actionsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_prescriptions_actions.fields.patient_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<input type="hidden" data-table="jdh_prescriptions_actions" data-field="x_patient_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_patient_id" id="o<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<?php if ($Grid->patient_id->getSessionValue() != "") { ?>
<span<?= $Grid->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->patient_id->getDisplayValue($Grid->patient_id->ViewValue) ?></span></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_patient_id" name="x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jdh_prescriptions_actions_patient_id" class="el_jdh_prescriptions_actions_patient_id">
    <select
        id="x<?= $Grid->RowIndex ?>_patient_id"
        name="x<?= $Grid->RowIndex ?>_patient_id"
        class="form-select ew-select<?= $Grid->patient_id->isInvalidClass() ?>"
        <?php if (!$Grid->patient_id->IsNativeSelect) { ?>
        data-select2-id="fjdh_prescriptions_actionsgrid_x<?= $Grid->RowIndex ?>_patient_id"
        <?php } ?>
        data-table="jdh_prescriptions_actions"
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
loadjs.ready("fjdh_prescriptions_actionsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_patient_id", selectId: "fjdh_prescriptions_actionsgrid_x<?= $Grid->RowIndex ?>_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_prescriptions_actionsgrid.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fjdh_prescriptions_actionsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fjdh_prescriptions_actionsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_prescriptions_actions.fields.patient_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jdh_prescriptions_actions_patient_id" class="el_jdh_prescriptions_actions_patient_id">
<span<?= $Grid->patient_id->viewAttributes() ?>>
<?= $Grid->patient_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_prescriptions_actions" data-field="x_patient_id" data-hidden="1" name="fjdh_prescriptions_actionsgrid$x<?= $Grid->RowIndex ?>_patient_id" id="fjdh_prescriptions_actionsgrid$x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->FormValue) ?>">
<input type="hidden" data-table="jdh_prescriptions_actions" data-field="x_patient_id" data-hidden="1" data-old name="fjdh_prescriptions_actionsgrid$o<?= $Grid->RowIndex ?>_patient_id" id="fjdh_prescriptions_actionsgrid$o<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->units_given->Visible) { // units_given ?>
        <td data-name="units_given"<?= $Grid->units_given->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jdh_prescriptions_actions_units_given" class="el_jdh_prescriptions_actions_units_given">
<input type="<?= $Grid->units_given->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_units_given" id="x<?= $Grid->RowIndex ?>_units_given" data-table="jdh_prescriptions_actions" data-field="x_units_given" value="<?= $Grid->units_given->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->units_given->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->units_given->formatPattern()) ?>"<?= $Grid->units_given->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->units_given->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="jdh_prescriptions_actions" data-field="x_units_given" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_units_given" id="o<?= $Grid->RowIndex ?>_units_given" value="<?= HtmlEncode($Grid->units_given->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jdh_prescriptions_actions_units_given" class="el_jdh_prescriptions_actions_units_given">
<input type="<?= $Grid->units_given->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_units_given" id="x<?= $Grid->RowIndex ?>_units_given" data-table="jdh_prescriptions_actions" data-field="x_units_given" value="<?= $Grid->units_given->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->units_given->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->units_given->formatPattern()) ?>"<?= $Grid->units_given->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->units_given->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jdh_prescriptions_actions_units_given" class="el_jdh_prescriptions_actions_units_given">
<span<?= $Grid->units_given->viewAttributes() ?>>
<?= $Grid->units_given->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_prescriptions_actions" data-field="x_units_given" data-hidden="1" name="fjdh_prescriptions_actionsgrid$x<?= $Grid->RowIndex ?>_units_given" id="fjdh_prescriptions_actionsgrid$x<?= $Grid->RowIndex ?>_units_given" value="<?= HtmlEncode($Grid->units_given->FormValue) ?>">
<input type="hidden" data-table="jdh_prescriptions_actions" data-field="x_units_given" data-hidden="1" data-old name="fjdh_prescriptions_actionsgrid$o<?= $Grid->RowIndex ?>_units_given" id="fjdh_prescriptions_actionsgrid$o<?= $Grid->RowIndex ?>_units_given" value="<?= HtmlEncode($Grid->units_given->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->submission_date->Visible) { // submission_date ?>
        <td data-name="submission_date"<?= $Grid->submission_date->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jdh_prescriptions_actions_submission_date" class="el_jdh_prescriptions_actions_submission_date">
<input type="<?= $Grid->submission_date->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_submission_date" id="x<?= $Grid->RowIndex ?>_submission_date" data-table="jdh_prescriptions_actions" data-field="x_submission_date" value="<?= $Grid->submission_date->EditValue ?>" placeholder="<?= HtmlEncode($Grid->submission_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->submission_date->formatPattern()) ?>"<?= $Grid->submission_date->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->submission_date->getErrorMessage() ?></div>
<?php if (!$Grid->submission_date->ReadOnly && !$Grid->submission_date->Disabled && !isset($Grid->submission_date->EditAttrs["readonly"]) && !isset($Grid->submission_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjdh_prescriptions_actionsgrid", "datetimepicker"], function () {
    let format = "<?= DateFormat(17) ?>",
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
    ew.createDateTimePicker("fjdh_prescriptions_actionsgrid", "x<?= $Grid->RowIndex ?>_submission_date", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="jdh_prescriptions_actions" data-field="x_submission_date" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_submission_date" id="o<?= $Grid->RowIndex ?>_submission_date" value="<?= HtmlEncode($Grid->submission_date->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jdh_prescriptions_actions_submission_date" class="el_jdh_prescriptions_actions_submission_date">
<input type="<?= $Grid->submission_date->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_submission_date" id="x<?= $Grid->RowIndex ?>_submission_date" data-table="jdh_prescriptions_actions" data-field="x_submission_date" value="<?= $Grid->submission_date->EditValue ?>" placeholder="<?= HtmlEncode($Grid->submission_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->submission_date->formatPattern()) ?>"<?= $Grid->submission_date->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->submission_date->getErrorMessage() ?></div>
<?php if (!$Grid->submission_date->ReadOnly && !$Grid->submission_date->Disabled && !isset($Grid->submission_date->EditAttrs["readonly"]) && !isset($Grid->submission_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjdh_prescriptions_actionsgrid", "datetimepicker"], function () {
    let format = "<?= DateFormat(17) ?>",
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
    ew.createDateTimePicker("fjdh_prescriptions_actionsgrid", "x<?= $Grid->RowIndex ?>_submission_date", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jdh_prescriptions_actions_submission_date" class="el_jdh_prescriptions_actions_submission_date">
<span<?= $Grid->submission_date->viewAttributes() ?>>
<?= $Grid->submission_date->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_prescriptions_actions" data-field="x_submission_date" data-hidden="1" name="fjdh_prescriptions_actionsgrid$x<?= $Grid->RowIndex ?>_submission_date" id="fjdh_prescriptions_actionsgrid$x<?= $Grid->RowIndex ?>_submission_date" value="<?= HtmlEncode($Grid->submission_date->FormValue) ?>">
<input type="hidden" data-table="jdh_prescriptions_actions" data-field="x_submission_date" data-hidden="1" data-old name="fjdh_prescriptions_actionsgrid$o<?= $Grid->RowIndex ?>_submission_date" id="fjdh_prescriptions_actionsgrid$o<?= $Grid->RowIndex ?>_submission_date" value="<?= HtmlEncode($Grid->submission_date->OldValue) ?>">
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
loadjs.ready(["fjdh_prescriptions_actionsgrid","load"], () => fjdh_prescriptions_actionsgrid.updateLists(<?= $Grid->RowIndex ?><?= $Grid->isAdd() || $Grid->isEdit() || $Grid->isCopy() || $Grid->RowIndex === '$rowindex$' ? ", true" : "" ?>));
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
<input type="hidden" name="detailpage" value="fjdh_prescriptions_actionsgrid">
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
    ew.addEventHandlers("jdh_prescriptions_actions");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
