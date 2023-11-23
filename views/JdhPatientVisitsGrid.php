<?php

namespace PHPMaker2024\jootidigitalhealthcare;

// Set up and run Grid object
$Grid = Container("JdhPatientVisitsGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fjdh_patient_visitsgrid;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { jdh_patient_visits: currentTable } });
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_patient_visitsgrid")
        .setPageId("grid")
        .setFormKeyCountName("<?= $Grid->FormKeyCountName ?>")

        // Add fields
        .setFields([
            ["patient_id", [fields.patient_id.visible && fields.patient_id.required ? ew.Validators.required(fields.patient_id.caption) : null], fields.patient_id.isInvalid],
            ["visit_type_id", [fields.visit_type_id.visible && fields.visit_type_id.required ? ew.Validators.required(fields.visit_type_id.caption) : null], fields.visit_type_id.isInvalid],
            ["user_id", [fields.user_id.visible && fields.user_id.required ? ew.Validators.required(fields.user_id.caption) : null], fields.user_id.isInvalid],
            ["insurance_id", [fields.insurance_id.visible && fields.insurance_id.required ? ew.Validators.required(fields.insurance_id.caption) : null], fields.insurance_id.isInvalid],
            ["visit_date", [fields.visit_date.visible && fields.visit_date.required ? ew.Validators.required(fields.visit_date.caption) : null, ew.Validators.datetime(fields.visit_date.clientFormatPattern)], fields.visit_date.isInvalid]
        ])

        // Check empty row
        .setEmptyRow(
            function (rowIndex) {
                let fobj = this.getForm(),
                    fields = [["patient_id",false],["visit_type_id",false],["user_id",false],["insurance_id",false],["visit_date",false]];
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
            "visit_type_id": <?= $Grid->visit_type_id->toClientList($Grid) ?>,
            "user_id": <?= $Grid->user_id->toClientList($Grid) ?>,
            "insurance_id": <?= $Grid->insurance_id->toClientList($Grid) ?>,
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
<div id="fjdh_patient_visitsgrid" class="ew-form ew-list-form">
<div id="gmp_jdh_patient_visits" class="card-body ew-grid-middle-panel <?= $Grid->TableContainerClass ?>" style="<?= $Grid->TableContainerStyle ?>">
<table id="tbl_jdh_patient_visitsgrid" class="<?= $Grid->TableClass ?>"><!-- .ew-table -->
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
        <th data-name="patient_id" class="<?= $Grid->patient_id->headerCellClass() ?>"><div id="elh_jdh_patient_visits_patient_id" class="jdh_patient_visits_patient_id"><?= $Grid->renderFieldHeader($Grid->patient_id) ?></div></th>
<?php } ?>
<?php if ($Grid->visit_type_id->Visible) { // visit_type_id ?>
        <th data-name="visit_type_id" class="<?= $Grid->visit_type_id->headerCellClass() ?>"><div id="elh_jdh_patient_visits_visit_type_id" class="jdh_patient_visits_visit_type_id"><?= $Grid->renderFieldHeader($Grid->visit_type_id) ?></div></th>
<?php } ?>
<?php if ($Grid->user_id->Visible) { // user_id ?>
        <th data-name="user_id" class="<?= $Grid->user_id->headerCellClass() ?>"><div id="elh_jdh_patient_visits_user_id" class="jdh_patient_visits_user_id"><?= $Grid->renderFieldHeader($Grid->user_id) ?></div></th>
<?php } ?>
<?php if ($Grid->insurance_id->Visible) { // insurance_id ?>
        <th data-name="insurance_id" class="<?= $Grid->insurance_id->headerCellClass() ?>"><div id="elh_jdh_patient_visits_insurance_id" class="jdh_patient_visits_insurance_id"><?= $Grid->renderFieldHeader($Grid->insurance_id) ?></div></th>
<?php } ?>
<?php if ($Grid->visit_date->Visible) { // visit_date ?>
        <th data-name="visit_date" class="<?= $Grid->visit_date->headerCellClass() ?>"><div id="elh_jdh_patient_visits_visit_date" class="jdh_patient_visits_visit_date"><?= $Grid->renderFieldHeader($Grid->visit_date) ?></div></th>
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
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jdh_patient_visits_patient_id" class="el_jdh_patient_visits_patient_id">
    <select
        id="x<?= $Grid->RowIndex ?>_patient_id"
        name="x<?= $Grid->RowIndex ?>_patient_id"
        class="form-select ew-select<?= $Grid->patient_id->isInvalidClass() ?>"
        <?php if (!$Grid->patient_id->IsNativeSelect) { ?>
        data-select2-id="fjdh_patient_visitsgrid_x<?= $Grid->RowIndex ?>_patient_id"
        <?php } ?>
        data-table="jdh_patient_visits"
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
loadjs.ready("fjdh_patient_visitsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_patient_id", selectId: "fjdh_patient_visitsgrid_x<?= $Grid->RowIndex ?>_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_patient_visitsgrid.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fjdh_patient_visitsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fjdh_patient_visitsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_patient_visits.fields.patient_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<input type="hidden" data-table="jdh_patient_visits" data-field="x_patient_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_patient_id" id="o<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<?php if ($Grid->patient_id->getSessionValue() != "") { ?>
<span<?= $Grid->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->patient_id->getDisplayValue($Grid->patient_id->ViewValue) ?></span></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_patient_id" name="x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jdh_patient_visits_patient_id" class="el_jdh_patient_visits_patient_id">
    <select
        id="x<?= $Grid->RowIndex ?>_patient_id"
        name="x<?= $Grid->RowIndex ?>_patient_id"
        class="form-select ew-select<?= $Grid->patient_id->isInvalidClass() ?>"
        <?php if (!$Grid->patient_id->IsNativeSelect) { ?>
        data-select2-id="fjdh_patient_visitsgrid_x<?= $Grid->RowIndex ?>_patient_id"
        <?php } ?>
        data-table="jdh_patient_visits"
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
loadjs.ready("fjdh_patient_visitsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_patient_id", selectId: "fjdh_patient_visitsgrid_x<?= $Grid->RowIndex ?>_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_patient_visitsgrid.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fjdh_patient_visitsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fjdh_patient_visitsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_patient_visits.fields.patient_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jdh_patient_visits_patient_id" class="el_jdh_patient_visits_patient_id">
<span<?= $Grid->patient_id->viewAttributes() ?>>
<?= $Grid->patient_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_patient_visits" data-field="x_patient_id" data-hidden="1" name="fjdh_patient_visitsgrid$x<?= $Grid->RowIndex ?>_patient_id" id="fjdh_patient_visitsgrid$x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->FormValue) ?>">
<input type="hidden" data-table="jdh_patient_visits" data-field="x_patient_id" data-hidden="1" data-old name="fjdh_patient_visitsgrid$o<?= $Grid->RowIndex ?>_patient_id" id="fjdh_patient_visitsgrid$o<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->visit_type_id->Visible) { // visit_type_id ?>
        <td data-name="visit_type_id"<?= $Grid->visit_type_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jdh_patient_visits_visit_type_id" class="el_jdh_patient_visits_visit_type_id">
    <select
        id="x<?= $Grid->RowIndex ?>_visit_type_id"
        name="x<?= $Grid->RowIndex ?>_visit_type_id"
        class="form-select ew-select<?= $Grid->visit_type_id->isInvalidClass() ?>"
        <?php if (!$Grid->visit_type_id->IsNativeSelect) { ?>
        data-select2-id="fjdh_patient_visitsgrid_x<?= $Grid->RowIndex ?>_visit_type_id"
        <?php } ?>
        data-table="jdh_patient_visits"
        data-field="x_visit_type_id"
        data-value-separator="<?= $Grid->visit_type_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->visit_type_id->getPlaceHolder()) ?>"
        <?= $Grid->visit_type_id->editAttributes() ?>>
        <?= $Grid->visit_type_id->selectOptionListHtml("x{$Grid->RowIndex}_visit_type_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->visit_type_id->getErrorMessage() ?></div>
<?= $Grid->visit_type_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_visit_type_id") ?>
<?php if (!$Grid->visit_type_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fjdh_patient_visitsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_visit_type_id", selectId: "fjdh_patient_visitsgrid_x<?= $Grid->RowIndex ?>_visit_type_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_patient_visitsgrid.lists.visit_type_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_visit_type_id", form: "fjdh_patient_visitsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_visit_type_id", form: "fjdh_patient_visitsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_patient_visits.fields.visit_type_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="jdh_patient_visits" data-field="x_visit_type_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_visit_type_id" id="o<?= $Grid->RowIndex ?>_visit_type_id" value="<?= HtmlEncode($Grid->visit_type_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jdh_patient_visits_visit_type_id" class="el_jdh_patient_visits_visit_type_id">
    <select
        id="x<?= $Grid->RowIndex ?>_visit_type_id"
        name="x<?= $Grid->RowIndex ?>_visit_type_id"
        class="form-select ew-select<?= $Grid->visit_type_id->isInvalidClass() ?>"
        <?php if (!$Grid->visit_type_id->IsNativeSelect) { ?>
        data-select2-id="fjdh_patient_visitsgrid_x<?= $Grid->RowIndex ?>_visit_type_id"
        <?php } ?>
        data-table="jdh_patient_visits"
        data-field="x_visit_type_id"
        data-value-separator="<?= $Grid->visit_type_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->visit_type_id->getPlaceHolder()) ?>"
        <?= $Grid->visit_type_id->editAttributes() ?>>
        <?= $Grid->visit_type_id->selectOptionListHtml("x{$Grid->RowIndex}_visit_type_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->visit_type_id->getErrorMessage() ?></div>
<?= $Grid->visit_type_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_visit_type_id") ?>
<?php if (!$Grid->visit_type_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fjdh_patient_visitsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_visit_type_id", selectId: "fjdh_patient_visitsgrid_x<?= $Grid->RowIndex ?>_visit_type_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_patient_visitsgrid.lists.visit_type_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_visit_type_id", form: "fjdh_patient_visitsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_visit_type_id", form: "fjdh_patient_visitsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_patient_visits.fields.visit_type_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jdh_patient_visits_visit_type_id" class="el_jdh_patient_visits_visit_type_id">
<span<?= $Grid->visit_type_id->viewAttributes() ?>>
<?= $Grid->visit_type_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_patient_visits" data-field="x_visit_type_id" data-hidden="1" name="fjdh_patient_visitsgrid$x<?= $Grid->RowIndex ?>_visit_type_id" id="fjdh_patient_visitsgrid$x<?= $Grid->RowIndex ?>_visit_type_id" value="<?= HtmlEncode($Grid->visit_type_id->FormValue) ?>">
<input type="hidden" data-table="jdh_patient_visits" data-field="x_visit_type_id" data-hidden="1" data-old name="fjdh_patient_visitsgrid$o<?= $Grid->RowIndex ?>_visit_type_id" id="fjdh_patient_visitsgrid$o<?= $Grid->RowIndex ?>_visit_type_id" value="<?= HtmlEncode($Grid->visit_type_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->user_id->Visible) { // user_id ?>
        <td data-name="user_id"<?= $Grid->user_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jdh_patient_visits_user_id" class="el_jdh_patient_visits_user_id">
    <select
        id="x<?= $Grid->RowIndex ?>_user_id"
        name="x<?= $Grid->RowIndex ?>_user_id"
        class="form-select ew-select<?= $Grid->user_id->isInvalidClass() ?>"
        <?php if (!$Grid->user_id->IsNativeSelect) { ?>
        data-select2-id="fjdh_patient_visitsgrid_x<?= $Grid->RowIndex ?>_user_id"
        <?php } ?>
        data-table="jdh_patient_visits"
        data-field="x_user_id"
        data-value-separator="<?= $Grid->user_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->user_id->getPlaceHolder()) ?>"
        <?= $Grid->user_id->editAttributes() ?>>
        <?= $Grid->user_id->selectOptionListHtml("x{$Grid->RowIndex}_user_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->user_id->getErrorMessage() ?></div>
<?= $Grid->user_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_user_id") ?>
<?php if (!$Grid->user_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fjdh_patient_visitsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_user_id", selectId: "fjdh_patient_visitsgrid_x<?= $Grid->RowIndex ?>_user_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_patient_visitsgrid.lists.user_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_user_id", form: "fjdh_patient_visitsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_user_id", form: "fjdh_patient_visitsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_patient_visits.fields.user_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="jdh_patient_visits" data-field="x_user_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_user_id" id="o<?= $Grid->RowIndex ?>_user_id" value="<?= HtmlEncode($Grid->user_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jdh_patient_visits_user_id" class="el_jdh_patient_visits_user_id">
    <select
        id="x<?= $Grid->RowIndex ?>_user_id"
        name="x<?= $Grid->RowIndex ?>_user_id"
        class="form-select ew-select<?= $Grid->user_id->isInvalidClass() ?>"
        <?php if (!$Grid->user_id->IsNativeSelect) { ?>
        data-select2-id="fjdh_patient_visitsgrid_x<?= $Grid->RowIndex ?>_user_id"
        <?php } ?>
        data-table="jdh_patient_visits"
        data-field="x_user_id"
        data-value-separator="<?= $Grid->user_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->user_id->getPlaceHolder()) ?>"
        <?= $Grid->user_id->editAttributes() ?>>
        <?= $Grid->user_id->selectOptionListHtml("x{$Grid->RowIndex}_user_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->user_id->getErrorMessage() ?></div>
<?= $Grid->user_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_user_id") ?>
<?php if (!$Grid->user_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fjdh_patient_visitsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_user_id", selectId: "fjdh_patient_visitsgrid_x<?= $Grid->RowIndex ?>_user_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_patient_visitsgrid.lists.user_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_user_id", form: "fjdh_patient_visitsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_user_id", form: "fjdh_patient_visitsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_patient_visits.fields.user_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jdh_patient_visits_user_id" class="el_jdh_patient_visits_user_id">
<span<?= $Grid->user_id->viewAttributes() ?>>
<?= $Grid->user_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_patient_visits" data-field="x_user_id" data-hidden="1" name="fjdh_patient_visitsgrid$x<?= $Grid->RowIndex ?>_user_id" id="fjdh_patient_visitsgrid$x<?= $Grid->RowIndex ?>_user_id" value="<?= HtmlEncode($Grid->user_id->FormValue) ?>">
<input type="hidden" data-table="jdh_patient_visits" data-field="x_user_id" data-hidden="1" data-old name="fjdh_patient_visitsgrid$o<?= $Grid->RowIndex ?>_user_id" id="fjdh_patient_visitsgrid$o<?= $Grid->RowIndex ?>_user_id" value="<?= HtmlEncode($Grid->user_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->insurance_id->Visible) { // insurance_id ?>
        <td data-name="insurance_id"<?= $Grid->insurance_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jdh_patient_visits_insurance_id" class="el_jdh_patient_visits_insurance_id">
    <select
        id="x<?= $Grid->RowIndex ?>_insurance_id"
        name="x<?= $Grid->RowIndex ?>_insurance_id"
        class="form-select ew-select<?= $Grid->insurance_id->isInvalidClass() ?>"
        <?php if (!$Grid->insurance_id->IsNativeSelect) { ?>
        data-select2-id="fjdh_patient_visitsgrid_x<?= $Grid->RowIndex ?>_insurance_id"
        <?php } ?>
        data-table="jdh_patient_visits"
        data-field="x_insurance_id"
        data-value-separator="<?= $Grid->insurance_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->insurance_id->getPlaceHolder()) ?>"
        <?= $Grid->insurance_id->editAttributes() ?>>
        <?= $Grid->insurance_id->selectOptionListHtml("x{$Grid->RowIndex}_insurance_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->insurance_id->getErrorMessage() ?></div>
<?= $Grid->insurance_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_insurance_id") ?>
<?php if (!$Grid->insurance_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fjdh_patient_visitsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_insurance_id", selectId: "fjdh_patient_visitsgrid_x<?= $Grid->RowIndex ?>_insurance_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_patient_visitsgrid.lists.insurance_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_insurance_id", form: "fjdh_patient_visitsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_insurance_id", form: "fjdh_patient_visitsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_patient_visits.fields.insurance_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="jdh_patient_visits" data-field="x_insurance_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_insurance_id" id="o<?= $Grid->RowIndex ?>_insurance_id" value="<?= HtmlEncode($Grid->insurance_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jdh_patient_visits_insurance_id" class="el_jdh_patient_visits_insurance_id">
    <select
        id="x<?= $Grid->RowIndex ?>_insurance_id"
        name="x<?= $Grid->RowIndex ?>_insurance_id"
        class="form-select ew-select<?= $Grid->insurance_id->isInvalidClass() ?>"
        <?php if (!$Grid->insurance_id->IsNativeSelect) { ?>
        data-select2-id="fjdh_patient_visitsgrid_x<?= $Grid->RowIndex ?>_insurance_id"
        <?php } ?>
        data-table="jdh_patient_visits"
        data-field="x_insurance_id"
        data-value-separator="<?= $Grid->insurance_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->insurance_id->getPlaceHolder()) ?>"
        <?= $Grid->insurance_id->editAttributes() ?>>
        <?= $Grid->insurance_id->selectOptionListHtml("x{$Grid->RowIndex}_insurance_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->insurance_id->getErrorMessage() ?></div>
<?= $Grid->insurance_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_insurance_id") ?>
<?php if (!$Grid->insurance_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fjdh_patient_visitsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_insurance_id", selectId: "fjdh_patient_visitsgrid_x<?= $Grid->RowIndex ?>_insurance_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_patient_visitsgrid.lists.insurance_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_insurance_id", form: "fjdh_patient_visitsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_insurance_id", form: "fjdh_patient_visitsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_patient_visits.fields.insurance_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jdh_patient_visits_insurance_id" class="el_jdh_patient_visits_insurance_id">
<span<?= $Grid->insurance_id->viewAttributes() ?>>
<?= $Grid->insurance_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_patient_visits" data-field="x_insurance_id" data-hidden="1" name="fjdh_patient_visitsgrid$x<?= $Grid->RowIndex ?>_insurance_id" id="fjdh_patient_visitsgrid$x<?= $Grid->RowIndex ?>_insurance_id" value="<?= HtmlEncode($Grid->insurance_id->FormValue) ?>">
<input type="hidden" data-table="jdh_patient_visits" data-field="x_insurance_id" data-hidden="1" data-old name="fjdh_patient_visitsgrid$o<?= $Grid->RowIndex ?>_insurance_id" id="fjdh_patient_visitsgrid$o<?= $Grid->RowIndex ?>_insurance_id" value="<?= HtmlEncode($Grid->insurance_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->visit_date->Visible) { // visit_date ?>
        <td data-name="visit_date"<?= $Grid->visit_date->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jdh_patient_visits_visit_date" class="el_jdh_patient_visits_visit_date">
<input type="<?= $Grid->visit_date->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_visit_date" id="x<?= $Grid->RowIndex ?>_visit_date" data-table="jdh_patient_visits" data-field="x_visit_date" value="<?= $Grid->visit_date->EditValue ?>" placeholder="<?= HtmlEncode($Grid->visit_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->visit_date->formatPattern()) ?>"<?= $Grid->visit_date->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->visit_date->getErrorMessage() ?></div>
<?php if (!$Grid->visit_date->ReadOnly && !$Grid->visit_date->Disabled && !isset($Grid->visit_date->EditAttrs["readonly"]) && !isset($Grid->visit_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjdh_patient_visitsgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fjdh_patient_visitsgrid", "x<?= $Grid->RowIndex ?>_visit_date", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="jdh_patient_visits" data-field="x_visit_date" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_visit_date" id="o<?= $Grid->RowIndex ?>_visit_date" value="<?= HtmlEncode($Grid->visit_date->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jdh_patient_visits_visit_date" class="el_jdh_patient_visits_visit_date">
<input type="<?= $Grid->visit_date->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_visit_date" id="x<?= $Grid->RowIndex ?>_visit_date" data-table="jdh_patient_visits" data-field="x_visit_date" value="<?= $Grid->visit_date->EditValue ?>" placeholder="<?= HtmlEncode($Grid->visit_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->visit_date->formatPattern()) ?>"<?= $Grid->visit_date->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->visit_date->getErrorMessage() ?></div>
<?php if (!$Grid->visit_date->ReadOnly && !$Grid->visit_date->Disabled && !isset($Grid->visit_date->EditAttrs["readonly"]) && !isset($Grid->visit_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjdh_patient_visitsgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fjdh_patient_visitsgrid", "x<?= $Grid->RowIndex ?>_visit_date", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_jdh_patient_visits_visit_date" class="el_jdh_patient_visits_visit_date">
<span<?= $Grid->visit_date->viewAttributes() ?>>
<?= $Grid->visit_date->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_patient_visits" data-field="x_visit_date" data-hidden="1" name="fjdh_patient_visitsgrid$x<?= $Grid->RowIndex ?>_visit_date" id="fjdh_patient_visitsgrid$x<?= $Grid->RowIndex ?>_visit_date" value="<?= HtmlEncode($Grid->visit_date->FormValue) ?>">
<input type="hidden" data-table="jdh_patient_visits" data-field="x_visit_date" data-hidden="1" data-old name="fjdh_patient_visitsgrid$o<?= $Grid->RowIndex ?>_visit_date" id="fjdh_patient_visitsgrid$o<?= $Grid->RowIndex ?>_visit_date" value="<?= HtmlEncode($Grid->visit_date->OldValue) ?>">
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
loadjs.ready(["fjdh_patient_visitsgrid","load"], () => fjdh_patient_visitsgrid.updateLists(<?= $Grid->RowIndex ?><?= $Grid->isAdd() || $Grid->isEdit() || $Grid->isCopy() || $Grid->RowIndex === '$rowindex$' ? ", true" : "" ?>));
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
<input type="hidden" name="detailpage" value="fjdh_patient_visitsgrid">
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
    ew.addEventHandlers("jdh_patient_visits");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
