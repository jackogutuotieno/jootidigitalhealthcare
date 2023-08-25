<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Set up and run Grid object
$Grid = Container("JdhVitalsGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fjdh_vitalsgrid;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { jdh_vitals: currentTable } });
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_vitalsgrid")
        .setPageId("grid")
        .setFormKeyCountName("<?= $Grid->FormKeyCountName ?>")

        // Add fields
        .setFields([
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

        // Check empty row
        .setEmptyRow(
            function (rowIndex) {
                let fobj = this.getForm(),
                    fields = [["patient_id",false],["pressure",false],["height",false],["weight",false],["body_mass_index",false],["pulse_rate",false],["respiratory_rate",false],["temperature",false],["random_blood_sugar",false],["submission_date",false]];
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
        })
        .build();
    window[form.id] = form;
    loadjs.done(form.id);
});
</script>
<?php } ?>
<main class="list<?= ($Grid->TotalRecords == 0 && !$Grid->isAdd()) ? " ew-no-record" : "" ?>">
<div id="ew-list">
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?= $Grid->isAddOrEdit() ? " ew-grid-add-edit" : "" ?> <?= $Grid->TableGridClass ?>">
<div id="fjdh_vitalsgrid" class="ew-form ew-list-form">
<div id="gmp_jdh_vitals" class="card-body ew-grid-middle-panel <?= $Grid->TableContainerClass ?>" style="<?= $Grid->TableContainerStyle ?>">
<table id="tbl_jdh_vitalsgrid" class="<?= $Grid->TableClass ?>"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Grid->RowType = ROWTYPE_HEADER;

// Render list options
$Grid->renderListOptions();

// Render list options (header, left)
$Grid->ListOptions->render("header", "left");
?>
<?php if ($Grid->patient_id->Visible) { // patient_id ?>
        <th data-name="patient_id" class="<?= $Grid->patient_id->headerCellClass() ?>"><div id="elh_jdh_vitals_patient_id" class="jdh_vitals_patient_id"><?= $Grid->renderFieldHeader($Grid->patient_id) ?></div></th>
<?php } ?>
<?php if ($Grid->pressure->Visible) { // pressure ?>
        <th data-name="pressure" class="<?= $Grid->pressure->headerCellClass() ?>"><div id="elh_jdh_vitals_pressure" class="jdh_vitals_pressure"><?= $Grid->renderFieldHeader($Grid->pressure) ?></div></th>
<?php } ?>
<?php if ($Grid->height->Visible) { // height ?>
        <th data-name="height" class="<?= $Grid->height->headerCellClass() ?>"><div id="elh_jdh_vitals_height" class="jdh_vitals_height"><?= $Grid->renderFieldHeader($Grid->height) ?></div></th>
<?php } ?>
<?php if ($Grid->weight->Visible) { // weight ?>
        <th data-name="weight" class="<?= $Grid->weight->headerCellClass() ?>"><div id="elh_jdh_vitals_weight" class="jdh_vitals_weight"><?= $Grid->renderFieldHeader($Grid->weight) ?></div></th>
<?php } ?>
<?php if ($Grid->body_mass_index->Visible) { // body_mass_index ?>
        <th data-name="body_mass_index" class="<?= $Grid->body_mass_index->headerCellClass() ?>"><div id="elh_jdh_vitals_body_mass_index" class="jdh_vitals_body_mass_index"><?= $Grid->renderFieldHeader($Grid->body_mass_index) ?></div></th>
<?php } ?>
<?php if ($Grid->pulse_rate->Visible) { // pulse_rate ?>
        <th data-name="pulse_rate" class="<?= $Grid->pulse_rate->headerCellClass() ?>"><div id="elh_jdh_vitals_pulse_rate" class="jdh_vitals_pulse_rate"><?= $Grid->renderFieldHeader($Grid->pulse_rate) ?></div></th>
<?php } ?>
<?php if ($Grid->respiratory_rate->Visible) { // respiratory_rate ?>
        <th data-name="respiratory_rate" class="<?= $Grid->respiratory_rate->headerCellClass() ?>"><div id="elh_jdh_vitals_respiratory_rate" class="jdh_vitals_respiratory_rate"><?= $Grid->renderFieldHeader($Grid->respiratory_rate) ?></div></th>
<?php } ?>
<?php if ($Grid->temperature->Visible) { // temperature ?>
        <th data-name="temperature" class="<?= $Grid->temperature->headerCellClass() ?>"><div id="elh_jdh_vitals_temperature" class="jdh_vitals_temperature"><?= $Grid->renderFieldHeader($Grid->temperature) ?></div></th>
<?php } ?>
<?php if ($Grid->random_blood_sugar->Visible) { // random_blood_sugar ?>
        <th data-name="random_blood_sugar" class="<?= $Grid->random_blood_sugar->headerCellClass() ?>"><div id="elh_jdh_vitals_random_blood_sugar" class="jdh_vitals_random_blood_sugar"><?= $Grid->renderFieldHeader($Grid->random_blood_sugar) ?></div></th>
<?php } ?>
<?php if ($Grid->submission_date->Visible) { // submission_date ?>
        <th data-name="submission_date" class="<?= $Grid->submission_date->headerCellClass() ?>"><div id="elh_jdh_vitals_submission_date" class="jdh_vitals_submission_date"><?= $Grid->renderFieldHeader($Grid->submission_date) ?></div></th>
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
while ($Grid->RecordCount < $Grid->StopRecord) {
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
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($Grid->patient_id->getSessionValue() != "") { ?>
<span<?= $Grid->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->patient_id->getDisplayValue($Grid->patient_id->ViewValue) ?></span></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_patient_id" name="x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_jdh_vitals_patient_id" class="el_jdh_vitals_patient_id">
    <select
        id="x<?= $Grid->RowIndex ?>_patient_id"
        name="x<?= $Grid->RowIndex ?>_patient_id"
        class="form-select ew-select<?= $Grid->patient_id->isInvalidClass() ?>"
        data-select2-id="fjdh_vitalsgrid_x<?= $Grid->RowIndex ?>_patient_id"
        data-table="jdh_vitals"
        data-field="x_patient_id"
        data-value-separator="<?= $Grid->patient_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->patient_id->getPlaceHolder()) ?>"
        <?= $Grid->patient_id->editAttributes() ?>>
        <?= $Grid->patient_id->selectOptionListHtml("x{$Grid->RowIndex}_patient_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->patient_id->getErrorMessage() ?></div>
<?= $Grid->patient_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_patient_id") ?>
<script>
loadjs.ready("fjdh_vitalsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_patient_id", selectId: "fjdh_vitalsgrid_x<?= $Grid->RowIndex ?>_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_vitalsgrid.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fjdh_vitalsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fjdh_vitalsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_vitals.fields.patient_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<input type="hidden" data-table="jdh_vitals" data-field="x_patient_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_patient_id" id="o<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($Grid->patient_id->getSessionValue() != "") { ?>
<span<?= $Grid->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->patient_id->getDisplayValue($Grid->patient_id->ViewValue) ?></span></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_patient_id" name="x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_jdh_vitals_patient_id" class="el_jdh_vitals_patient_id">
    <select
        id="x<?= $Grid->RowIndex ?>_patient_id"
        name="x<?= $Grid->RowIndex ?>_patient_id"
        class="form-select ew-select<?= $Grid->patient_id->isInvalidClass() ?>"
        data-select2-id="fjdh_vitalsgrid_x<?= $Grid->RowIndex ?>_patient_id"
        data-table="jdh_vitals"
        data-field="x_patient_id"
        data-value-separator="<?= $Grid->patient_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->patient_id->getPlaceHolder()) ?>"
        <?= $Grid->patient_id->editAttributes() ?>>
        <?= $Grid->patient_id->selectOptionListHtml("x{$Grid->RowIndex}_patient_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->patient_id->getErrorMessage() ?></div>
<?= $Grid->patient_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_patient_id") ?>
<script>
loadjs.ready("fjdh_vitalsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_patient_id", selectId: "fjdh_vitalsgrid_x<?= $Grid->RowIndex ?>_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_vitalsgrid.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fjdh_vitalsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fjdh_vitalsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_vitals.fields.patient_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_vitals_patient_id" class="el_jdh_vitals_patient_id">
<span<?= $Grid->patient_id->viewAttributes() ?>>
<?= $Grid->patient_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_vitals" data-field="x_patient_id" data-hidden="1" name="fjdh_vitalsgrid$x<?= $Grid->RowIndex ?>_patient_id" id="fjdh_vitalsgrid$x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->FormValue) ?>">
<input type="hidden" data-table="jdh_vitals" data-field="x_patient_id" data-hidden="1" data-old name="fjdh_vitalsgrid$o<?= $Grid->RowIndex ?>_patient_id" id="fjdh_vitalsgrid$o<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->pressure->Visible) { // pressure ?>
        <td data-name="pressure"<?= $Grid->pressure->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_vitals_pressure" class="el_jdh_vitals_pressure">
<input type="<?= $Grid->pressure->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_pressure" id="x<?= $Grid->RowIndex ?>_pressure" data-table="jdh_vitals" data-field="x_pressure" value="<?= $Grid->pressure->EditValue ?>" size="30" maxlength="30" placeholder="<?= HtmlEncode($Grid->pressure->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->pressure->formatPattern()) ?>"<?= $Grid->pressure->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->pressure->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="jdh_vitals" data-field="x_pressure" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_pressure" id="o<?= $Grid->RowIndex ?>_pressure" value="<?= HtmlEncode($Grid->pressure->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_vitals_pressure" class="el_jdh_vitals_pressure">
<input type="<?= $Grid->pressure->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_pressure" id="x<?= $Grid->RowIndex ?>_pressure" data-table="jdh_vitals" data-field="x_pressure" value="<?= $Grid->pressure->EditValue ?>" size="30" maxlength="30" placeholder="<?= HtmlEncode($Grid->pressure->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->pressure->formatPattern()) ?>"<?= $Grid->pressure->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->pressure->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_vitals_pressure" class="el_jdh_vitals_pressure">
<span<?= $Grid->pressure->viewAttributes() ?>>
<?= $Grid->pressure->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_vitals" data-field="x_pressure" data-hidden="1" name="fjdh_vitalsgrid$x<?= $Grid->RowIndex ?>_pressure" id="fjdh_vitalsgrid$x<?= $Grid->RowIndex ?>_pressure" value="<?= HtmlEncode($Grid->pressure->FormValue) ?>">
<input type="hidden" data-table="jdh_vitals" data-field="x_pressure" data-hidden="1" data-old name="fjdh_vitalsgrid$o<?= $Grid->RowIndex ?>_pressure" id="fjdh_vitalsgrid$o<?= $Grid->RowIndex ?>_pressure" value="<?= HtmlEncode($Grid->pressure->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->height->Visible) { // height ?>
        <td data-name="height"<?= $Grid->height->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_vitals_height" class="el_jdh_vitals_height">
<input type="<?= $Grid->height->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_height" id="x<?= $Grid->RowIndex ?>_height" data-table="jdh_vitals" data-field="x_height" value="<?= $Grid->height->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->height->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->height->formatPattern()) ?>"<?= $Grid->height->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->height->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="jdh_vitals" data-field="x_height" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_height" id="o<?= $Grid->RowIndex ?>_height" value="<?= HtmlEncode($Grid->height->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_vitals_height" class="el_jdh_vitals_height">
<input type="<?= $Grid->height->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_height" id="x<?= $Grid->RowIndex ?>_height" data-table="jdh_vitals" data-field="x_height" value="<?= $Grid->height->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->height->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->height->formatPattern()) ?>"<?= $Grid->height->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->height->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_vitals_height" class="el_jdh_vitals_height">
<span<?= $Grid->height->viewAttributes() ?>>
<?= $Grid->height->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_vitals" data-field="x_height" data-hidden="1" name="fjdh_vitalsgrid$x<?= $Grid->RowIndex ?>_height" id="fjdh_vitalsgrid$x<?= $Grid->RowIndex ?>_height" value="<?= HtmlEncode($Grid->height->FormValue) ?>">
<input type="hidden" data-table="jdh_vitals" data-field="x_height" data-hidden="1" data-old name="fjdh_vitalsgrid$o<?= $Grid->RowIndex ?>_height" id="fjdh_vitalsgrid$o<?= $Grid->RowIndex ?>_height" value="<?= HtmlEncode($Grid->height->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->weight->Visible) { // weight ?>
        <td data-name="weight"<?= $Grid->weight->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_vitals_weight" class="el_jdh_vitals_weight">
<input type="<?= $Grid->weight->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_weight" id="x<?= $Grid->RowIndex ?>_weight" data-table="jdh_vitals" data-field="x_weight" value="<?= $Grid->weight->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->weight->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->weight->formatPattern()) ?>"<?= $Grid->weight->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->weight->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="jdh_vitals" data-field="x_weight" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_weight" id="o<?= $Grid->RowIndex ?>_weight" value="<?= HtmlEncode($Grid->weight->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_vitals_weight" class="el_jdh_vitals_weight">
<input type="<?= $Grid->weight->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_weight" id="x<?= $Grid->RowIndex ?>_weight" data-table="jdh_vitals" data-field="x_weight" value="<?= $Grid->weight->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->weight->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->weight->formatPattern()) ?>"<?= $Grid->weight->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->weight->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_vitals_weight" class="el_jdh_vitals_weight">
<span<?= $Grid->weight->viewAttributes() ?>>
<?= $Grid->weight->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_vitals" data-field="x_weight" data-hidden="1" name="fjdh_vitalsgrid$x<?= $Grid->RowIndex ?>_weight" id="fjdh_vitalsgrid$x<?= $Grid->RowIndex ?>_weight" value="<?= HtmlEncode($Grid->weight->FormValue) ?>">
<input type="hidden" data-table="jdh_vitals" data-field="x_weight" data-hidden="1" data-old name="fjdh_vitalsgrid$o<?= $Grid->RowIndex ?>_weight" id="fjdh_vitalsgrid$o<?= $Grid->RowIndex ?>_weight" value="<?= HtmlEncode($Grid->weight->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->body_mass_index->Visible) { // body_mass_index ?>
        <td data-name="body_mass_index"<?= $Grid->body_mass_index->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_vitals_body_mass_index" class="el_jdh_vitals_body_mass_index">
<input type="<?= $Grid->body_mass_index->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_body_mass_index" id="x<?= $Grid->RowIndex ?>_body_mass_index" data-table="jdh_vitals" data-field="x_body_mass_index" value="<?= $Grid->body_mass_index->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->body_mass_index->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->body_mass_index->formatPattern()) ?>"<?= $Grid->body_mass_index->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->body_mass_index->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="jdh_vitals" data-field="x_body_mass_index" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_body_mass_index" id="o<?= $Grid->RowIndex ?>_body_mass_index" value="<?= HtmlEncode($Grid->body_mass_index->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_vitals_body_mass_index" class="el_jdh_vitals_body_mass_index">
<span<?= $Grid->body_mass_index->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->body_mass_index->getDisplayValue($Grid->body_mass_index->EditValue))) ?>"></span>
<input type="hidden" data-table="jdh_vitals" data-field="x_body_mass_index" data-hidden="1" name="x<?= $Grid->RowIndex ?>_body_mass_index" id="x<?= $Grid->RowIndex ?>_body_mass_index" value="<?= HtmlEncode($Grid->body_mass_index->CurrentValue) ?>">
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_vitals_body_mass_index" class="el_jdh_vitals_body_mass_index">
<span<?= $Grid->body_mass_index->viewAttributes() ?>>
<?= $Grid->body_mass_index->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_vitals" data-field="x_body_mass_index" data-hidden="1" name="fjdh_vitalsgrid$x<?= $Grid->RowIndex ?>_body_mass_index" id="fjdh_vitalsgrid$x<?= $Grid->RowIndex ?>_body_mass_index" value="<?= HtmlEncode($Grid->body_mass_index->FormValue) ?>">
<input type="hidden" data-table="jdh_vitals" data-field="x_body_mass_index" data-hidden="1" data-old name="fjdh_vitalsgrid$o<?= $Grid->RowIndex ?>_body_mass_index" id="fjdh_vitalsgrid$o<?= $Grid->RowIndex ?>_body_mass_index" value="<?= HtmlEncode($Grid->body_mass_index->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->pulse_rate->Visible) { // pulse_rate ?>
        <td data-name="pulse_rate"<?= $Grid->pulse_rate->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_vitals_pulse_rate" class="el_jdh_vitals_pulse_rate">
<input type="<?= $Grid->pulse_rate->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_pulse_rate" id="x<?= $Grid->RowIndex ?>_pulse_rate" data-table="jdh_vitals" data-field="x_pulse_rate" value="<?= $Grid->pulse_rate->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->pulse_rate->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->pulse_rate->formatPattern()) ?>"<?= $Grid->pulse_rate->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->pulse_rate->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="jdh_vitals" data-field="x_pulse_rate" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_pulse_rate" id="o<?= $Grid->RowIndex ?>_pulse_rate" value="<?= HtmlEncode($Grid->pulse_rate->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_vitals_pulse_rate" class="el_jdh_vitals_pulse_rate">
<input type="<?= $Grid->pulse_rate->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_pulse_rate" id="x<?= $Grid->RowIndex ?>_pulse_rate" data-table="jdh_vitals" data-field="x_pulse_rate" value="<?= $Grid->pulse_rate->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->pulse_rate->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->pulse_rate->formatPattern()) ?>"<?= $Grid->pulse_rate->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->pulse_rate->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_vitals_pulse_rate" class="el_jdh_vitals_pulse_rate">
<span<?= $Grid->pulse_rate->viewAttributes() ?>>
<?= $Grid->pulse_rate->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_vitals" data-field="x_pulse_rate" data-hidden="1" name="fjdh_vitalsgrid$x<?= $Grid->RowIndex ?>_pulse_rate" id="fjdh_vitalsgrid$x<?= $Grid->RowIndex ?>_pulse_rate" value="<?= HtmlEncode($Grid->pulse_rate->FormValue) ?>">
<input type="hidden" data-table="jdh_vitals" data-field="x_pulse_rate" data-hidden="1" data-old name="fjdh_vitalsgrid$o<?= $Grid->RowIndex ?>_pulse_rate" id="fjdh_vitalsgrid$o<?= $Grid->RowIndex ?>_pulse_rate" value="<?= HtmlEncode($Grid->pulse_rate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->respiratory_rate->Visible) { // respiratory_rate ?>
        <td data-name="respiratory_rate"<?= $Grid->respiratory_rate->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_vitals_respiratory_rate" class="el_jdh_vitals_respiratory_rate">
<input type="<?= $Grid->respiratory_rate->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_respiratory_rate" id="x<?= $Grid->RowIndex ?>_respiratory_rate" data-table="jdh_vitals" data-field="x_respiratory_rate" value="<?= $Grid->respiratory_rate->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->respiratory_rate->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->respiratory_rate->formatPattern()) ?>"<?= $Grid->respiratory_rate->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->respiratory_rate->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="jdh_vitals" data-field="x_respiratory_rate" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_respiratory_rate" id="o<?= $Grid->RowIndex ?>_respiratory_rate" value="<?= HtmlEncode($Grid->respiratory_rate->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_vitals_respiratory_rate" class="el_jdh_vitals_respiratory_rate">
<input type="<?= $Grid->respiratory_rate->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_respiratory_rate" id="x<?= $Grid->RowIndex ?>_respiratory_rate" data-table="jdh_vitals" data-field="x_respiratory_rate" value="<?= $Grid->respiratory_rate->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->respiratory_rate->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->respiratory_rate->formatPattern()) ?>"<?= $Grid->respiratory_rate->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->respiratory_rate->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_vitals_respiratory_rate" class="el_jdh_vitals_respiratory_rate">
<span<?= $Grid->respiratory_rate->viewAttributes() ?>>
<?= $Grid->respiratory_rate->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_vitals" data-field="x_respiratory_rate" data-hidden="1" name="fjdh_vitalsgrid$x<?= $Grid->RowIndex ?>_respiratory_rate" id="fjdh_vitalsgrid$x<?= $Grid->RowIndex ?>_respiratory_rate" value="<?= HtmlEncode($Grid->respiratory_rate->FormValue) ?>">
<input type="hidden" data-table="jdh_vitals" data-field="x_respiratory_rate" data-hidden="1" data-old name="fjdh_vitalsgrid$o<?= $Grid->RowIndex ?>_respiratory_rate" id="fjdh_vitalsgrid$o<?= $Grid->RowIndex ?>_respiratory_rate" value="<?= HtmlEncode($Grid->respiratory_rate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->temperature->Visible) { // temperature ?>
        <td data-name="temperature"<?= $Grid->temperature->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_vitals_temperature" class="el_jdh_vitals_temperature">
<input type="<?= $Grid->temperature->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_temperature" id="x<?= $Grid->RowIndex ?>_temperature" data-table="jdh_vitals" data-field="x_temperature" value="<?= $Grid->temperature->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->temperature->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->temperature->formatPattern()) ?>"<?= $Grid->temperature->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->temperature->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="jdh_vitals" data-field="x_temperature" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_temperature" id="o<?= $Grid->RowIndex ?>_temperature" value="<?= HtmlEncode($Grid->temperature->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_vitals_temperature" class="el_jdh_vitals_temperature">
<input type="<?= $Grid->temperature->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_temperature" id="x<?= $Grid->RowIndex ?>_temperature" data-table="jdh_vitals" data-field="x_temperature" value="<?= $Grid->temperature->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->temperature->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->temperature->formatPattern()) ?>"<?= $Grid->temperature->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->temperature->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_vitals_temperature" class="el_jdh_vitals_temperature">
<span<?= $Grid->temperature->viewAttributes() ?>>
<?= $Grid->temperature->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_vitals" data-field="x_temperature" data-hidden="1" name="fjdh_vitalsgrid$x<?= $Grid->RowIndex ?>_temperature" id="fjdh_vitalsgrid$x<?= $Grid->RowIndex ?>_temperature" value="<?= HtmlEncode($Grid->temperature->FormValue) ?>">
<input type="hidden" data-table="jdh_vitals" data-field="x_temperature" data-hidden="1" data-old name="fjdh_vitalsgrid$o<?= $Grid->RowIndex ?>_temperature" id="fjdh_vitalsgrid$o<?= $Grid->RowIndex ?>_temperature" value="<?= HtmlEncode($Grid->temperature->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->random_blood_sugar->Visible) { // random_blood_sugar ?>
        <td data-name="random_blood_sugar"<?= $Grid->random_blood_sugar->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_vitals_random_blood_sugar" class="el_jdh_vitals_random_blood_sugar">
<input type="<?= $Grid->random_blood_sugar->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_random_blood_sugar" id="x<?= $Grid->RowIndex ?>_random_blood_sugar" data-table="jdh_vitals" data-field="x_random_blood_sugar" value="<?= $Grid->random_blood_sugar->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->random_blood_sugar->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->random_blood_sugar->formatPattern()) ?>"<?= $Grid->random_blood_sugar->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->random_blood_sugar->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="jdh_vitals" data-field="x_random_blood_sugar" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_random_blood_sugar" id="o<?= $Grid->RowIndex ?>_random_blood_sugar" value="<?= HtmlEncode($Grid->random_blood_sugar->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_vitals_random_blood_sugar" class="el_jdh_vitals_random_blood_sugar">
<input type="<?= $Grid->random_blood_sugar->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_random_blood_sugar" id="x<?= $Grid->RowIndex ?>_random_blood_sugar" data-table="jdh_vitals" data-field="x_random_blood_sugar" value="<?= $Grid->random_blood_sugar->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->random_blood_sugar->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->random_blood_sugar->formatPattern()) ?>"<?= $Grid->random_blood_sugar->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->random_blood_sugar->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_vitals_random_blood_sugar" class="el_jdh_vitals_random_blood_sugar">
<span<?= $Grid->random_blood_sugar->viewAttributes() ?>>
<?= $Grid->random_blood_sugar->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_vitals" data-field="x_random_blood_sugar" data-hidden="1" name="fjdh_vitalsgrid$x<?= $Grid->RowIndex ?>_random_blood_sugar" id="fjdh_vitalsgrid$x<?= $Grid->RowIndex ?>_random_blood_sugar" value="<?= HtmlEncode($Grid->random_blood_sugar->FormValue) ?>">
<input type="hidden" data-table="jdh_vitals" data-field="x_random_blood_sugar" data-hidden="1" data-old name="fjdh_vitalsgrid$o<?= $Grid->RowIndex ?>_random_blood_sugar" id="fjdh_vitalsgrid$o<?= $Grid->RowIndex ?>_random_blood_sugar" value="<?= HtmlEncode($Grid->random_blood_sugar->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->submission_date->Visible) { // submission_date ?>
        <td data-name="submission_date"<?= $Grid->submission_date->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_vitals_submission_date" class="el_jdh_vitals_submission_date">
<input type="<?= $Grid->submission_date->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_submission_date" id="x<?= $Grid->RowIndex ?>_submission_date" data-table="jdh_vitals" data-field="x_submission_date" value="<?= $Grid->submission_date->EditValue ?>" placeholder="<?= HtmlEncode($Grid->submission_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->submission_date->formatPattern()) ?>"<?= $Grid->submission_date->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->submission_date->getErrorMessage() ?></div>
<?php if (!$Grid->submission_date->ReadOnly && !$Grid->submission_date->Disabled && !isset($Grid->submission_date->EditAttrs["readonly"]) && !isset($Grid->submission_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjdh_vitalsgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fjdh_vitalsgrid", "x<?= $Grid->RowIndex ?>_submission_date", jQuery.extend(true, {"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="jdh_vitals" data-field="x_submission_date" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_submission_date" id="o<?= $Grid->RowIndex ?>_submission_date" value="<?= HtmlEncode($Grid->submission_date->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_vitals_submission_date" class="el_jdh_vitals_submission_date">
<input type="<?= $Grid->submission_date->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_submission_date" id="x<?= $Grid->RowIndex ?>_submission_date" data-table="jdh_vitals" data-field="x_submission_date" value="<?= $Grid->submission_date->EditValue ?>" placeholder="<?= HtmlEncode($Grid->submission_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->submission_date->formatPattern()) ?>"<?= $Grid->submission_date->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->submission_date->getErrorMessage() ?></div>
<?php if (!$Grid->submission_date->ReadOnly && !$Grid->submission_date->Disabled && !isset($Grid->submission_date->EditAttrs["readonly"]) && !isset($Grid->submission_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjdh_vitalsgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fjdh_vitalsgrid", "x<?= $Grid->RowIndex ?>_submission_date", jQuery.extend(true, {"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_vitals_submission_date" class="el_jdh_vitals_submission_date">
<span<?= $Grid->submission_date->viewAttributes() ?>>
<?= $Grid->submission_date->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_vitals" data-field="x_submission_date" data-hidden="1" name="fjdh_vitalsgrid$x<?= $Grid->RowIndex ?>_submission_date" id="fjdh_vitalsgrid$x<?= $Grid->RowIndex ?>_submission_date" value="<?= HtmlEncode($Grid->submission_date->FormValue) ?>">
<input type="hidden" data-table="jdh_vitals" data-field="x_submission_date" data-hidden="1" data-old name="fjdh_vitalsgrid$o<?= $Grid->RowIndex ?>_submission_date" id="fjdh_vitalsgrid$o<?= $Grid->RowIndex ?>_submission_date" value="<?= HtmlEncode($Grid->submission_date->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowCount);
?>
    </tr>
<?php if ($Grid->RowType == ROWTYPE_ADD || $Grid->RowType == ROWTYPE_EDIT) { ?>
<script data-rowindex="<?= $Grid->RowIndex ?>">
loadjs.ready(["fjdh_vitalsgrid","load"], () => fjdh_vitalsgrid.updateLists(<?= $Grid->RowIndex ?><?= $Grid->RowIndex === '$rowindex$' ? ", true" : "" ?>));
</script>
<?php } ?>
<?php
    }
    } // End delete row checking
    if (
        $Grid->Recordset &&
        !$Grid->Recordset->EOF &&
        $Grid->RowIndex !== '$rowindex$' &&
        (!$Grid->isGridAdd() || $Grid->CurrentMode == "copy") &&
        (!(($Grid->isCopy() || $Grid->isAdd()) && $Grid->RowIndex == 0))
    ) {
        $Grid->Recordset->moveNext();
    }
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
<input type="hidden" name="detailpage" value="fjdh_vitalsgrid">
</div><!-- /.ew-list-form -->
<?php
// Close recordset
if ($Grid->Recordset) {
    $Grid->Recordset->close();
}
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
</main>
<?php if (!$Grid->isExport()) { ?>
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
