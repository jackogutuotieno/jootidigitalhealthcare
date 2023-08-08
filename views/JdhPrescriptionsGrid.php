<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Set up and run Grid object
$Grid = Container("JdhPrescriptionsGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fjdh_prescriptionsgrid;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { jdh_prescriptions: currentTable } });
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_prescriptionsgrid")
        .setPageId("grid")
        .setFormKeyCountName("<?= $Grid->FormKeyCountName ?>")

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

        // Check empty row
        .setEmptyRow(
            function (rowIndex) {
                let fobj = this.getForm(),
                    fields = [["patient_id",false],["prescription_title",false],["medicine_id",false],["tabs",false],["frequency",false],["prescription_time",false],["prescription_date",false]];
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
            "medicine_id": <?= $Grid->medicine_id->toClientList($Grid) ?>,
            "frequency": <?= $Grid->frequency->toClientList($Grid) ?>,
            "prescription_time": <?= $Grid->prescription_time->toClientList($Grid) ?>,
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
<div id="fjdh_prescriptionsgrid" class="ew-form ew-list-form">
<div id="gmp_jdh_prescriptions" class="card-body ew-grid-middle-panel <?= $Grid->TableContainerClass ?>" style="<?= $Grid->TableContainerStyle ?>">
<table id="tbl_jdh_prescriptionsgrid" class="<?= $Grid->TableClass ?>"><!-- .ew-table -->
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
<?php if ($Grid->prescription_id->Visible) { // prescription_id ?>
        <th data-name="prescription_id" class="<?= $Grid->prescription_id->headerCellClass() ?>"><div id="elh_jdh_prescriptions_prescription_id" class="jdh_prescriptions_prescription_id"><?= $Grid->renderFieldHeader($Grid->prescription_id) ?></div></th>
<?php } ?>
<?php if ($Grid->patient_id->Visible) { // patient_id ?>
        <th data-name="patient_id" class="<?= $Grid->patient_id->headerCellClass() ?>"><div id="elh_jdh_prescriptions_patient_id" class="jdh_prescriptions_patient_id"><?= $Grid->renderFieldHeader($Grid->patient_id) ?></div></th>
<?php } ?>
<?php if ($Grid->prescription_title->Visible) { // prescription_title ?>
        <th data-name="prescription_title" class="<?= $Grid->prescription_title->headerCellClass() ?>"><div id="elh_jdh_prescriptions_prescription_title" class="jdh_prescriptions_prescription_title"><?= $Grid->renderFieldHeader($Grid->prescription_title) ?></div></th>
<?php } ?>
<?php if ($Grid->medicine_id->Visible) { // medicine_id ?>
        <th data-name="medicine_id" class="<?= $Grid->medicine_id->headerCellClass() ?>"><div id="elh_jdh_prescriptions_medicine_id" class="jdh_prescriptions_medicine_id"><?= $Grid->renderFieldHeader($Grid->medicine_id) ?></div></th>
<?php } ?>
<?php if ($Grid->tabs->Visible) { // tabs ?>
        <th data-name="tabs" class="<?= $Grid->tabs->headerCellClass() ?>"><div id="elh_jdh_prescriptions_tabs" class="jdh_prescriptions_tabs"><?= $Grid->renderFieldHeader($Grid->tabs) ?></div></th>
<?php } ?>
<?php if ($Grid->frequency->Visible) { // frequency ?>
        <th data-name="frequency" class="<?= $Grid->frequency->headerCellClass() ?>"><div id="elh_jdh_prescriptions_frequency" class="jdh_prescriptions_frequency"><?= $Grid->renderFieldHeader($Grid->frequency) ?></div></th>
<?php } ?>
<?php if ($Grid->prescription_time->Visible) { // prescription_time ?>
        <th data-name="prescription_time" class="<?= $Grid->prescription_time->headerCellClass() ?>"><div id="elh_jdh_prescriptions_prescription_time" class="jdh_prescriptions_prescription_time"><?= $Grid->renderFieldHeader($Grid->prescription_time) ?></div></th>
<?php } ?>
<?php if ($Grid->prescription_date->Visible) { // prescription_date ?>
        <th data-name="prescription_date" class="<?= $Grid->prescription_date->headerCellClass() ?>"><div id="elh_jdh_prescriptions_prescription_date" class="jdh_prescriptions_prescription_date"><?= $Grid->renderFieldHeader($Grid->prescription_date) ?></div></th>
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
    <?php if ($Grid->prescription_id->Visible) { // prescription_id ?>
        <td data-name="prescription_id"<?= $Grid->prescription_id->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_prescriptions_prescription_id" class="el_jdh_prescriptions_prescription_id"></span>
<input type="hidden" data-table="jdh_prescriptions" data-field="x_prescription_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_prescription_id" id="o<?= $Grid->RowIndex ?>_prescription_id" value="<?= HtmlEncode($Grid->prescription_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_prescriptions_prescription_id" class="el_jdh_prescriptions_prescription_id">
<span<?= $Grid->prescription_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->prescription_id->getDisplayValue($Grid->prescription_id->EditValue))) ?>"></span>
<input type="hidden" data-table="jdh_prescriptions" data-field="x_prescription_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_prescription_id" id="x<?= $Grid->RowIndex ?>_prescription_id" value="<?= HtmlEncode($Grid->prescription_id->CurrentValue) ?>">
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_prescriptions_prescription_id" class="el_jdh_prescriptions_prescription_id">
<span<?= $Grid->prescription_id->viewAttributes() ?>>
<?= $Grid->prescription_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_prescriptions" data-field="x_prescription_id" data-hidden="1" name="fjdh_prescriptionsgrid$x<?= $Grid->RowIndex ?>_prescription_id" id="fjdh_prescriptionsgrid$x<?= $Grid->RowIndex ?>_prescription_id" value="<?= HtmlEncode($Grid->prescription_id->FormValue) ?>">
<input type="hidden" data-table="jdh_prescriptions" data-field="x_prescription_id" data-hidden="1" data-old name="fjdh_prescriptionsgrid$o<?= $Grid->RowIndex ?>_prescription_id" id="fjdh_prescriptionsgrid$o<?= $Grid->RowIndex ?>_prescription_id" value="<?= HtmlEncode($Grid->prescription_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="jdh_prescriptions" data-field="x_prescription_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_prescription_id" id="x<?= $Grid->RowIndex ?>_prescription_id" value="<?= HtmlEncode($Grid->prescription_id->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Grid->patient_id->Visible) { // patient_id ?>
        <td data-name="patient_id"<?= $Grid->patient_id->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($Grid->patient_id->getSessionValue() != "") { ?>
<span<?= $Grid->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->patient_id->getDisplayValue($Grid->patient_id->ViewValue) ?></span></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_patient_id" name="x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_jdh_prescriptions_patient_id" class="el_jdh_prescriptions_patient_id">
    <select
        id="x<?= $Grid->RowIndex ?>_patient_id"
        name="x<?= $Grid->RowIndex ?>_patient_id"
        class="form-select ew-select<?= $Grid->patient_id->isInvalidClass() ?>"
        data-select2-id="fjdh_prescriptionsgrid_x<?= $Grid->RowIndex ?>_patient_id"
        data-table="jdh_prescriptions"
        data-field="x_patient_id"
        data-value-separator="<?= $Grid->patient_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->patient_id->getPlaceHolder()) ?>"
        <?= $Grid->patient_id->editAttributes() ?>>
        <?= $Grid->patient_id->selectOptionListHtml("x{$Grid->RowIndex}_patient_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->patient_id->getErrorMessage() ?></div>
<?= $Grid->patient_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_patient_id") ?>
<script>
loadjs.ready("fjdh_prescriptionsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_patient_id", selectId: "fjdh_prescriptionsgrid_x<?= $Grid->RowIndex ?>_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_prescriptionsgrid.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fjdh_prescriptionsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fjdh_prescriptionsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_prescriptions.fields.patient_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<input type="hidden" data-table="jdh_prescriptions" data-field="x_patient_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_patient_id" id="o<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($Grid->patient_id->getSessionValue() != "") { ?>
<span<?= $Grid->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->patient_id->getDisplayValue($Grid->patient_id->ViewValue) ?></span></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_patient_id" name="x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_jdh_prescriptions_patient_id" class="el_jdh_prescriptions_patient_id">
    <select
        id="x<?= $Grid->RowIndex ?>_patient_id"
        name="x<?= $Grid->RowIndex ?>_patient_id"
        class="form-select ew-select<?= $Grid->patient_id->isInvalidClass() ?>"
        data-select2-id="fjdh_prescriptionsgrid_x<?= $Grid->RowIndex ?>_patient_id"
        data-table="jdh_prescriptions"
        data-field="x_patient_id"
        data-value-separator="<?= $Grid->patient_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->patient_id->getPlaceHolder()) ?>"
        <?= $Grid->patient_id->editAttributes() ?>>
        <?= $Grid->patient_id->selectOptionListHtml("x{$Grid->RowIndex}_patient_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->patient_id->getErrorMessage() ?></div>
<?= $Grid->patient_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_patient_id") ?>
<script>
loadjs.ready("fjdh_prescriptionsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_patient_id", selectId: "fjdh_prescriptionsgrid_x<?= $Grid->RowIndex ?>_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_prescriptionsgrid.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fjdh_prescriptionsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fjdh_prescriptionsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_prescriptions.fields.patient_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_prescriptions_patient_id" class="el_jdh_prescriptions_patient_id">
<span<?= $Grid->patient_id->viewAttributes() ?>>
<?= $Grid->patient_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_prescriptions" data-field="x_patient_id" data-hidden="1" name="fjdh_prescriptionsgrid$x<?= $Grid->RowIndex ?>_patient_id" id="fjdh_prescriptionsgrid$x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->FormValue) ?>">
<input type="hidden" data-table="jdh_prescriptions" data-field="x_patient_id" data-hidden="1" data-old name="fjdh_prescriptionsgrid$o<?= $Grid->RowIndex ?>_patient_id" id="fjdh_prescriptionsgrid$o<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->prescription_title->Visible) { // prescription_title ?>
        <td data-name="prescription_title"<?= $Grid->prescription_title->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_prescriptions_prescription_title" class="el_jdh_prescriptions_prescription_title">
<input type="<?= $Grid->prescription_title->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_prescription_title" id="x<?= $Grid->RowIndex ?>_prescription_title" data-table="jdh_prescriptions" data-field="x_prescription_title" value="<?= $Grid->prescription_title->EditValue ?>" size="30" maxlength="200" placeholder="<?= HtmlEncode($Grid->prescription_title->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->prescription_title->formatPattern()) ?>"<?= $Grid->prescription_title->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->prescription_title->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="jdh_prescriptions" data-field="x_prescription_title" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_prescription_title" id="o<?= $Grid->RowIndex ?>_prescription_title" value="<?= HtmlEncode($Grid->prescription_title->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_prescriptions_prescription_title" class="el_jdh_prescriptions_prescription_title">
<input type="<?= $Grid->prescription_title->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_prescription_title" id="x<?= $Grid->RowIndex ?>_prescription_title" data-table="jdh_prescriptions" data-field="x_prescription_title" value="<?= $Grid->prescription_title->EditValue ?>" size="30" maxlength="200" placeholder="<?= HtmlEncode($Grid->prescription_title->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->prescription_title->formatPattern()) ?>"<?= $Grid->prescription_title->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->prescription_title->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_prescriptions_prescription_title" class="el_jdh_prescriptions_prescription_title">
<span<?= $Grid->prescription_title->viewAttributes() ?>>
<?= $Grid->prescription_title->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_prescriptions" data-field="x_prescription_title" data-hidden="1" name="fjdh_prescriptionsgrid$x<?= $Grid->RowIndex ?>_prescription_title" id="fjdh_prescriptionsgrid$x<?= $Grid->RowIndex ?>_prescription_title" value="<?= HtmlEncode($Grid->prescription_title->FormValue) ?>">
<input type="hidden" data-table="jdh_prescriptions" data-field="x_prescription_title" data-hidden="1" data-old name="fjdh_prescriptionsgrid$o<?= $Grid->RowIndex ?>_prescription_title" id="fjdh_prescriptionsgrid$o<?= $Grid->RowIndex ?>_prescription_title" value="<?= HtmlEncode($Grid->prescription_title->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->medicine_id->Visible) { // medicine_id ?>
        <td data-name="medicine_id"<?= $Grid->medicine_id->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_prescriptions_medicine_id" class="el_jdh_prescriptions_medicine_id">
    <select
        id="x<?= $Grid->RowIndex ?>_medicine_id"
        name="x<?= $Grid->RowIndex ?>_medicine_id"
        class="form-select ew-select<?= $Grid->medicine_id->isInvalidClass() ?>"
        data-select2-id="fjdh_prescriptionsgrid_x<?= $Grid->RowIndex ?>_medicine_id"
        data-table="jdh_prescriptions"
        data-field="x_medicine_id"
        data-value-separator="<?= $Grid->medicine_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->medicine_id->getPlaceHolder()) ?>"
        <?= $Grid->medicine_id->editAttributes() ?>>
        <?= $Grid->medicine_id->selectOptionListHtml("x{$Grid->RowIndex}_medicine_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->medicine_id->getErrorMessage() ?></div>
<?= $Grid->medicine_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_medicine_id") ?>
<script>
loadjs.ready("fjdh_prescriptionsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_medicine_id", selectId: "fjdh_prescriptionsgrid_x<?= $Grid->RowIndex ?>_medicine_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_prescriptionsgrid.lists.medicine_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_medicine_id", form: "fjdh_prescriptionsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_medicine_id", form: "fjdh_prescriptionsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_prescriptions.fields.medicine_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<input type="hidden" data-table="jdh_prescriptions" data-field="x_medicine_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_medicine_id" id="o<?= $Grid->RowIndex ?>_medicine_id" value="<?= HtmlEncode($Grid->medicine_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_prescriptions_medicine_id" class="el_jdh_prescriptions_medicine_id">
    <select
        id="x<?= $Grid->RowIndex ?>_medicine_id"
        name="x<?= $Grid->RowIndex ?>_medicine_id"
        class="form-select ew-select<?= $Grid->medicine_id->isInvalidClass() ?>"
        data-select2-id="fjdh_prescriptionsgrid_x<?= $Grid->RowIndex ?>_medicine_id"
        data-table="jdh_prescriptions"
        data-field="x_medicine_id"
        data-value-separator="<?= $Grid->medicine_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->medicine_id->getPlaceHolder()) ?>"
        <?= $Grid->medicine_id->editAttributes() ?>>
        <?= $Grid->medicine_id->selectOptionListHtml("x{$Grid->RowIndex}_medicine_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->medicine_id->getErrorMessage() ?></div>
<?= $Grid->medicine_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_medicine_id") ?>
<script>
loadjs.ready("fjdh_prescriptionsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_medicine_id", selectId: "fjdh_prescriptionsgrid_x<?= $Grid->RowIndex ?>_medicine_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_prescriptionsgrid.lists.medicine_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_medicine_id", form: "fjdh_prescriptionsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_medicine_id", form: "fjdh_prescriptionsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_prescriptions.fields.medicine_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_prescriptions_medicine_id" class="el_jdh_prescriptions_medicine_id">
<span<?= $Grid->medicine_id->viewAttributes() ?>>
<?= $Grid->medicine_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_prescriptions" data-field="x_medicine_id" data-hidden="1" name="fjdh_prescriptionsgrid$x<?= $Grid->RowIndex ?>_medicine_id" id="fjdh_prescriptionsgrid$x<?= $Grid->RowIndex ?>_medicine_id" value="<?= HtmlEncode($Grid->medicine_id->FormValue) ?>">
<input type="hidden" data-table="jdh_prescriptions" data-field="x_medicine_id" data-hidden="1" data-old name="fjdh_prescriptionsgrid$o<?= $Grid->RowIndex ?>_medicine_id" id="fjdh_prescriptionsgrid$o<?= $Grid->RowIndex ?>_medicine_id" value="<?= HtmlEncode($Grid->medicine_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->tabs->Visible) { // tabs ?>
        <td data-name="tabs"<?= $Grid->tabs->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_prescriptions_tabs" class="el_jdh_prescriptions_tabs">
<input type="<?= $Grid->tabs->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_tabs" id="x<?= $Grid->RowIndex ?>_tabs" data-table="jdh_prescriptions" data-field="x_tabs" value="<?= $Grid->tabs->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->tabs->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->tabs->formatPattern()) ?>"<?= $Grid->tabs->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tabs->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="jdh_prescriptions" data-field="x_tabs" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_tabs" id="o<?= $Grid->RowIndex ?>_tabs" value="<?= HtmlEncode($Grid->tabs->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_prescriptions_tabs" class="el_jdh_prescriptions_tabs">
<input type="<?= $Grid->tabs->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_tabs" id="x<?= $Grid->RowIndex ?>_tabs" data-table="jdh_prescriptions" data-field="x_tabs" value="<?= $Grid->tabs->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->tabs->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->tabs->formatPattern()) ?>"<?= $Grid->tabs->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tabs->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_prescriptions_tabs" class="el_jdh_prescriptions_tabs">
<span<?= $Grid->tabs->viewAttributes() ?>>
<?= $Grid->tabs->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_prescriptions" data-field="x_tabs" data-hidden="1" name="fjdh_prescriptionsgrid$x<?= $Grid->RowIndex ?>_tabs" id="fjdh_prescriptionsgrid$x<?= $Grid->RowIndex ?>_tabs" value="<?= HtmlEncode($Grid->tabs->FormValue) ?>">
<input type="hidden" data-table="jdh_prescriptions" data-field="x_tabs" data-hidden="1" data-old name="fjdh_prescriptionsgrid$o<?= $Grid->RowIndex ?>_tabs" id="fjdh_prescriptionsgrid$o<?= $Grid->RowIndex ?>_tabs" value="<?= HtmlEncode($Grid->tabs->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->frequency->Visible) { // frequency ?>
        <td data-name="frequency"<?= $Grid->frequency->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_prescriptions_frequency" class="el_jdh_prescriptions_frequency">
    <select
        id="x<?= $Grid->RowIndex ?>_frequency"
        name="x<?= $Grid->RowIndex ?>_frequency"
        class="form-select ew-select<?= $Grid->frequency->isInvalidClass() ?>"
        data-select2-id="fjdh_prescriptionsgrid_x<?= $Grid->RowIndex ?>_frequency"
        data-table="jdh_prescriptions"
        data-field="x_frequency"
        data-value-separator="<?= $Grid->frequency->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->frequency->getPlaceHolder()) ?>"
        <?= $Grid->frequency->editAttributes() ?>>
        <?= $Grid->frequency->selectOptionListHtml("x{$Grid->RowIndex}_frequency") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->frequency->getErrorMessage() ?></div>
<script>
loadjs.ready("fjdh_prescriptionsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_frequency", selectId: "fjdh_prescriptionsgrid_x<?= $Grid->RowIndex ?>_frequency" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_prescriptionsgrid.lists.frequency?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_frequency", form: "fjdh_prescriptionsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_frequency", form: "fjdh_prescriptionsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_prescriptions.fields.frequency.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<input type="hidden" data-table="jdh_prescriptions" data-field="x_frequency" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_frequency" id="o<?= $Grid->RowIndex ?>_frequency" value="<?= HtmlEncode($Grid->frequency->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_prescriptions_frequency" class="el_jdh_prescriptions_frequency">
    <select
        id="x<?= $Grid->RowIndex ?>_frequency"
        name="x<?= $Grid->RowIndex ?>_frequency"
        class="form-select ew-select<?= $Grid->frequency->isInvalidClass() ?>"
        data-select2-id="fjdh_prescriptionsgrid_x<?= $Grid->RowIndex ?>_frequency"
        data-table="jdh_prescriptions"
        data-field="x_frequency"
        data-value-separator="<?= $Grid->frequency->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->frequency->getPlaceHolder()) ?>"
        <?= $Grid->frequency->editAttributes() ?>>
        <?= $Grid->frequency->selectOptionListHtml("x{$Grid->RowIndex}_frequency") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->frequency->getErrorMessage() ?></div>
<script>
loadjs.ready("fjdh_prescriptionsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_frequency", selectId: "fjdh_prescriptionsgrid_x<?= $Grid->RowIndex ?>_frequency" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_prescriptionsgrid.lists.frequency?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_frequency", form: "fjdh_prescriptionsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_frequency", form: "fjdh_prescriptionsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_prescriptions.fields.frequency.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_prescriptions_frequency" class="el_jdh_prescriptions_frequency">
<span<?= $Grid->frequency->viewAttributes() ?>>
<?= $Grid->frequency->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_prescriptions" data-field="x_frequency" data-hidden="1" name="fjdh_prescriptionsgrid$x<?= $Grid->RowIndex ?>_frequency" id="fjdh_prescriptionsgrid$x<?= $Grid->RowIndex ?>_frequency" value="<?= HtmlEncode($Grid->frequency->FormValue) ?>">
<input type="hidden" data-table="jdh_prescriptions" data-field="x_frequency" data-hidden="1" data-old name="fjdh_prescriptionsgrid$o<?= $Grid->RowIndex ?>_frequency" id="fjdh_prescriptionsgrid$o<?= $Grid->RowIndex ?>_frequency" value="<?= HtmlEncode($Grid->frequency->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->prescription_time->Visible) { // prescription_time ?>
        <td data-name="prescription_time"<?= $Grid->prescription_time->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_prescriptions_prescription_time" class="el_jdh_prescriptions_prescription_time">
    <select
        id="x<?= $Grid->RowIndex ?>_prescription_time"
        name="x<?= $Grid->RowIndex ?>_prescription_time"
        class="form-select ew-select<?= $Grid->prescription_time->isInvalidClass() ?>"
        data-select2-id="fjdh_prescriptionsgrid_x<?= $Grid->RowIndex ?>_prescription_time"
        data-table="jdh_prescriptions"
        data-field="x_prescription_time"
        data-value-separator="<?= $Grid->prescription_time->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->prescription_time->getPlaceHolder()) ?>"
        <?= $Grid->prescription_time->editAttributes() ?>>
        <?= $Grid->prescription_time->selectOptionListHtml("x{$Grid->RowIndex}_prescription_time") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->prescription_time->getErrorMessage() ?></div>
<script>
loadjs.ready("fjdh_prescriptionsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_prescription_time", selectId: "fjdh_prescriptionsgrid_x<?= $Grid->RowIndex ?>_prescription_time" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_prescriptionsgrid.lists.prescription_time?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_prescription_time", form: "fjdh_prescriptionsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_prescription_time", form: "fjdh_prescriptionsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_prescriptions.fields.prescription_time.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<input type="hidden" data-table="jdh_prescriptions" data-field="x_prescription_time" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_prescription_time" id="o<?= $Grid->RowIndex ?>_prescription_time" value="<?= HtmlEncode($Grid->prescription_time->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_prescriptions_prescription_time" class="el_jdh_prescriptions_prescription_time">
    <select
        id="x<?= $Grid->RowIndex ?>_prescription_time"
        name="x<?= $Grid->RowIndex ?>_prescription_time"
        class="form-select ew-select<?= $Grid->prescription_time->isInvalidClass() ?>"
        data-select2-id="fjdh_prescriptionsgrid_x<?= $Grid->RowIndex ?>_prescription_time"
        data-table="jdh_prescriptions"
        data-field="x_prescription_time"
        data-value-separator="<?= $Grid->prescription_time->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->prescription_time->getPlaceHolder()) ?>"
        <?= $Grid->prescription_time->editAttributes() ?>>
        <?= $Grid->prescription_time->selectOptionListHtml("x{$Grid->RowIndex}_prescription_time") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->prescription_time->getErrorMessage() ?></div>
<script>
loadjs.ready("fjdh_prescriptionsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_prescription_time", selectId: "fjdh_prescriptionsgrid_x<?= $Grid->RowIndex ?>_prescription_time" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_prescriptionsgrid.lists.prescription_time?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_prescription_time", form: "fjdh_prescriptionsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_prescription_time", form: "fjdh_prescriptionsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_prescriptions.fields.prescription_time.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_prescriptions_prescription_time" class="el_jdh_prescriptions_prescription_time">
<span<?= $Grid->prescription_time->viewAttributes() ?>>
<?= $Grid->prescription_time->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_prescriptions" data-field="x_prescription_time" data-hidden="1" name="fjdh_prescriptionsgrid$x<?= $Grid->RowIndex ?>_prescription_time" id="fjdh_prescriptionsgrid$x<?= $Grid->RowIndex ?>_prescription_time" value="<?= HtmlEncode($Grid->prescription_time->FormValue) ?>">
<input type="hidden" data-table="jdh_prescriptions" data-field="x_prescription_time" data-hidden="1" data-old name="fjdh_prescriptionsgrid$o<?= $Grid->RowIndex ?>_prescription_time" id="fjdh_prescriptionsgrid$o<?= $Grid->RowIndex ?>_prescription_time" value="<?= HtmlEncode($Grid->prescription_time->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->prescription_date->Visible) { // prescription_date ?>
        <td data-name="prescription_date"<?= $Grid->prescription_date->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_prescriptions_prescription_date" class="el_jdh_prescriptions_prescription_date">
<input type="<?= $Grid->prescription_date->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_prescription_date" id="x<?= $Grid->RowIndex ?>_prescription_date" data-table="jdh_prescriptions" data-field="x_prescription_date" value="<?= $Grid->prescription_date->EditValue ?>" placeholder="<?= HtmlEncode($Grid->prescription_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->prescription_date->formatPattern()) ?>"<?= $Grid->prescription_date->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->prescription_date->getErrorMessage() ?></div>
<?php if (!$Grid->prescription_date->ReadOnly && !$Grid->prescription_date->Disabled && !isset($Grid->prescription_date->EditAttrs["readonly"]) && !isset($Grid->prescription_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjdh_prescriptionsgrid", "datetimepicker"], function () {
    let format = "<?= DateFormat(0) ?>",
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
    ew.createDateTimePicker("fjdh_prescriptionsgrid", "x<?= $Grid->RowIndex ?>_prescription_date", jQuery.extend(true, {"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="jdh_prescriptions" data-field="x_prescription_date" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_prescription_date" id="o<?= $Grid->RowIndex ?>_prescription_date" value="<?= HtmlEncode($Grid->prescription_date->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_prescriptions_prescription_date" class="el_jdh_prescriptions_prescription_date">
<input type="<?= $Grid->prescription_date->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_prescription_date" id="x<?= $Grid->RowIndex ?>_prescription_date" data-table="jdh_prescriptions" data-field="x_prescription_date" value="<?= $Grid->prescription_date->EditValue ?>" placeholder="<?= HtmlEncode($Grid->prescription_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->prescription_date->formatPattern()) ?>"<?= $Grid->prescription_date->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->prescription_date->getErrorMessage() ?></div>
<?php if (!$Grid->prescription_date->ReadOnly && !$Grid->prescription_date->Disabled && !isset($Grid->prescription_date->EditAttrs["readonly"]) && !isset($Grid->prescription_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjdh_prescriptionsgrid", "datetimepicker"], function () {
    let format = "<?= DateFormat(0) ?>",
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
    ew.createDateTimePicker("fjdh_prescriptionsgrid", "x<?= $Grid->RowIndex ?>_prescription_date", jQuery.extend(true, {"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_prescriptions_prescription_date" class="el_jdh_prescriptions_prescription_date">
<span<?= $Grid->prescription_date->viewAttributes() ?>>
<?= $Grid->prescription_date->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_prescriptions" data-field="x_prescription_date" data-hidden="1" name="fjdh_prescriptionsgrid$x<?= $Grid->RowIndex ?>_prescription_date" id="fjdh_prescriptionsgrid$x<?= $Grid->RowIndex ?>_prescription_date" value="<?= HtmlEncode($Grid->prescription_date->FormValue) ?>">
<input type="hidden" data-table="jdh_prescriptions" data-field="x_prescription_date" data-hidden="1" data-old name="fjdh_prescriptionsgrid$o<?= $Grid->RowIndex ?>_prescription_date" id="fjdh_prescriptionsgrid$o<?= $Grid->RowIndex ?>_prescription_date" value="<?= HtmlEncode($Grid->prescription_date->OldValue) ?>">
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
loadjs.ready(["fjdh_prescriptionsgrid","load"], () => fjdh_prescriptionsgrid.updateLists(<?= $Grid->RowIndex ?><?= $Grid->RowIndex === '$rowindex$' ? ", true" : "" ?>));
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
<input type="hidden" name="detailpage" value="fjdh_prescriptionsgrid">
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
    ew.addEventHandlers("jdh_prescriptions");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
