<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Set up and run Grid object
$Grid = Container("JdhBedsAssignmentGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fjdh_beds_assignmentgrid;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { jdh_beds_assignment: currentTable } });
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_beds_assignmentgrid")
        .setPageId("grid")
        .setFormKeyCountName("<?= $Grid->FormKeyCountName ?>")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["patient_id", [fields.patient_id.visible && fields.patient_id.required ? ew.Validators.required(fields.patient_id.caption) : null], fields.patient_id.isInvalid],
            ["bed_id", [fields.bed_id.visible && fields.bed_id.required ? ew.Validators.required(fields.bed_id.caption) : null], fields.bed_id.isInvalid],
            ["date_submitted", [fields.date_submitted.visible && fields.date_submitted.required ? ew.Validators.required(fields.date_submitted.caption) : null, ew.Validators.datetime(fields.date_submitted.clientFormatPattern)], fields.date_submitted.isInvalid],
            ["submittedby_user_id", [fields.submittedby_user_id.visible && fields.submittedby_user_id.required ? ew.Validators.required(fields.submittedby_user_id.caption) : null], fields.submittedby_user_id.isInvalid]
        ])

        // Check empty row
        .setEmptyRow(
            function (rowIndex) {
                let fobj = this.getForm(),
                    fields = [["patient_id",false],["bed_id",false],["date_submitted",false]];
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
            "bed_id": <?= $Grid->bed_id->toClientList($Grid) ?>,
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
<div id="fjdh_beds_assignmentgrid" class="ew-form ew-list-form">
<div id="gmp_jdh_beds_assignment" class="card-body ew-grid-middle-panel <?= $Grid->TableContainerClass ?>" style="<?= $Grid->TableContainerStyle ?>">
<table id="tbl_jdh_beds_assignmentgrid" class="<?= $Grid->TableClass ?>"><!-- .ew-table -->
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
<?php if ($Grid->id->Visible) { // id ?>
        <th data-name="id" class="<?= $Grid->id->headerCellClass() ?>"><div id="elh_jdh_beds_assignment_id" class="jdh_beds_assignment_id"><?= $Grid->renderFieldHeader($Grid->id) ?></div></th>
<?php } ?>
<?php if ($Grid->patient_id->Visible) { // patient_id ?>
        <th data-name="patient_id" class="<?= $Grid->patient_id->headerCellClass() ?>"><div id="elh_jdh_beds_assignment_patient_id" class="jdh_beds_assignment_patient_id"><?= $Grid->renderFieldHeader($Grid->patient_id) ?></div></th>
<?php } ?>
<?php if ($Grid->bed_id->Visible) { // bed_id ?>
        <th data-name="bed_id" class="<?= $Grid->bed_id->headerCellClass() ?>"><div id="elh_jdh_beds_assignment_bed_id" class="jdh_beds_assignment_bed_id"><?= $Grid->renderFieldHeader($Grid->bed_id) ?></div></th>
<?php } ?>
<?php if ($Grid->date_submitted->Visible) { // date_submitted ?>
        <th data-name="date_submitted" class="<?= $Grid->date_submitted->headerCellClass() ?>"><div id="elh_jdh_beds_assignment_date_submitted" class="jdh_beds_assignment_date_submitted"><?= $Grid->renderFieldHeader($Grid->date_submitted) ?></div></th>
<?php } ?>
<?php if ($Grid->submittedby_user_id->Visible) { // submittedby_user_id ?>
        <th data-name="submittedby_user_id" class="<?= $Grid->submittedby_user_id->headerCellClass() ?>"><div id="elh_jdh_beds_assignment_submittedby_user_id" class="jdh_beds_assignment_submittedby_user_id"><?= $Grid->renderFieldHeader($Grid->submittedby_user_id) ?></div></th>
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
    <?php if ($Grid->id->Visible) { // id ?>
        <td data-name="id"<?= $Grid->id->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_beds_assignment_id" class="el_jdh_beds_assignment_id"></span>
<input type="hidden" data-table="jdh_beds_assignment" data-field="x_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_id" id="o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_beds_assignment_id" class="el_jdh_beds_assignment_id">
<span<?= $Grid->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->id->getDisplayValue($Grid->id->EditValue))) ?>"></span>
<input type="hidden" data-table="jdh_beds_assignment" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->CurrentValue) ?>">
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_beds_assignment_id" class="el_jdh_beds_assignment_id">
<span<?= $Grid->id->viewAttributes() ?>>
<?= $Grid->id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_beds_assignment" data-field="x_id" data-hidden="1" name="fjdh_beds_assignmentgrid$x<?= $Grid->RowIndex ?>_id" id="fjdh_beds_assignmentgrid$x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->FormValue) ?>">
<input type="hidden" data-table="jdh_beds_assignment" data-field="x_id" data-hidden="1" data-old name="fjdh_beds_assignmentgrid$o<?= $Grid->RowIndex ?>_id" id="fjdh_beds_assignmentgrid$o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="jdh_beds_assignment" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Grid->patient_id->Visible) { // patient_id ?>
        <td data-name="patient_id"<?= $Grid->patient_id->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($Grid->patient_id->getSessionValue() != "") { ?>
<span<?= $Grid->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->patient_id->getDisplayValue($Grid->patient_id->ViewValue) ?></span></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_patient_id" name="x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_jdh_beds_assignment_patient_id" class="el_jdh_beds_assignment_patient_id">
    <select
        id="x<?= $Grid->RowIndex ?>_patient_id"
        name="x<?= $Grid->RowIndex ?>_patient_id"
        class="form-select ew-select<?= $Grid->patient_id->isInvalidClass() ?>"
        data-select2-id="fjdh_beds_assignmentgrid_x<?= $Grid->RowIndex ?>_patient_id"
        data-table="jdh_beds_assignment"
        data-field="x_patient_id"
        data-value-separator="<?= $Grid->patient_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->patient_id->getPlaceHolder()) ?>"
        <?= $Grid->patient_id->editAttributes() ?>>
        <?= $Grid->patient_id->selectOptionListHtml("x{$Grid->RowIndex}_patient_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->patient_id->getErrorMessage() ?></div>
<?= $Grid->patient_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_patient_id") ?>
<script>
loadjs.ready("fjdh_beds_assignmentgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_patient_id", selectId: "fjdh_beds_assignmentgrid_x<?= $Grid->RowIndex ?>_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_beds_assignmentgrid.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fjdh_beds_assignmentgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fjdh_beds_assignmentgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_beds_assignment.fields.patient_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<input type="hidden" data-table="jdh_beds_assignment" data-field="x_patient_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_patient_id" id="o<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($Grid->patient_id->getSessionValue() != "") { ?>
<span<?= $Grid->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->patient_id->getDisplayValue($Grid->patient_id->ViewValue) ?></span></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_patient_id" name="x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_jdh_beds_assignment_patient_id" class="el_jdh_beds_assignment_patient_id">
    <select
        id="x<?= $Grid->RowIndex ?>_patient_id"
        name="x<?= $Grid->RowIndex ?>_patient_id"
        class="form-select ew-select<?= $Grid->patient_id->isInvalidClass() ?>"
        data-select2-id="fjdh_beds_assignmentgrid_x<?= $Grid->RowIndex ?>_patient_id"
        data-table="jdh_beds_assignment"
        data-field="x_patient_id"
        data-value-separator="<?= $Grid->patient_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->patient_id->getPlaceHolder()) ?>"
        <?= $Grid->patient_id->editAttributes() ?>>
        <?= $Grid->patient_id->selectOptionListHtml("x{$Grid->RowIndex}_patient_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->patient_id->getErrorMessage() ?></div>
<?= $Grid->patient_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_patient_id") ?>
<script>
loadjs.ready("fjdh_beds_assignmentgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_patient_id", selectId: "fjdh_beds_assignmentgrid_x<?= $Grid->RowIndex ?>_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_beds_assignmentgrid.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fjdh_beds_assignmentgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fjdh_beds_assignmentgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_beds_assignment.fields.patient_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_beds_assignment_patient_id" class="el_jdh_beds_assignment_patient_id">
<span<?= $Grid->patient_id->viewAttributes() ?>>
<?= $Grid->patient_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_beds_assignment" data-field="x_patient_id" data-hidden="1" name="fjdh_beds_assignmentgrid$x<?= $Grid->RowIndex ?>_patient_id" id="fjdh_beds_assignmentgrid$x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->FormValue) ?>">
<input type="hidden" data-table="jdh_beds_assignment" data-field="x_patient_id" data-hidden="1" data-old name="fjdh_beds_assignmentgrid$o<?= $Grid->RowIndex ?>_patient_id" id="fjdh_beds_assignmentgrid$o<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->bed_id->Visible) { // bed_id ?>
        <td data-name="bed_id"<?= $Grid->bed_id->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_beds_assignment_bed_id" class="el_jdh_beds_assignment_bed_id">
    <select
        id="x<?= $Grid->RowIndex ?>_bed_id"
        name="x<?= $Grid->RowIndex ?>_bed_id"
        class="form-select ew-select<?= $Grid->bed_id->isInvalidClass() ?>"
        data-select2-id="fjdh_beds_assignmentgrid_x<?= $Grid->RowIndex ?>_bed_id"
        data-table="jdh_beds_assignment"
        data-field="x_bed_id"
        data-value-separator="<?= $Grid->bed_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->bed_id->getPlaceHolder()) ?>"
        <?= $Grid->bed_id->editAttributes() ?>>
        <?= $Grid->bed_id->selectOptionListHtml("x{$Grid->RowIndex}_bed_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->bed_id->getErrorMessage() ?></div>
<?= $Grid->bed_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_bed_id") ?>
<script>
loadjs.ready("fjdh_beds_assignmentgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_bed_id", selectId: "fjdh_beds_assignmentgrid_x<?= $Grid->RowIndex ?>_bed_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_beds_assignmentgrid.lists.bed_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_bed_id", form: "fjdh_beds_assignmentgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_bed_id", form: "fjdh_beds_assignmentgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_beds_assignment.fields.bed_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<input type="hidden" data-table="jdh_beds_assignment" data-field="x_bed_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_bed_id" id="o<?= $Grid->RowIndex ?>_bed_id" value="<?= HtmlEncode($Grid->bed_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_beds_assignment_bed_id" class="el_jdh_beds_assignment_bed_id">
    <select
        id="x<?= $Grid->RowIndex ?>_bed_id"
        name="x<?= $Grid->RowIndex ?>_bed_id"
        class="form-select ew-select<?= $Grid->bed_id->isInvalidClass() ?>"
        data-select2-id="fjdh_beds_assignmentgrid_x<?= $Grid->RowIndex ?>_bed_id"
        data-table="jdh_beds_assignment"
        data-field="x_bed_id"
        data-value-separator="<?= $Grid->bed_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->bed_id->getPlaceHolder()) ?>"
        <?= $Grid->bed_id->editAttributes() ?>>
        <?= $Grid->bed_id->selectOptionListHtml("x{$Grid->RowIndex}_bed_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->bed_id->getErrorMessage() ?></div>
<?= $Grid->bed_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_bed_id") ?>
<script>
loadjs.ready("fjdh_beds_assignmentgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_bed_id", selectId: "fjdh_beds_assignmentgrid_x<?= $Grid->RowIndex ?>_bed_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_beds_assignmentgrid.lists.bed_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_bed_id", form: "fjdh_beds_assignmentgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_bed_id", form: "fjdh_beds_assignmentgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_beds_assignment.fields.bed_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_beds_assignment_bed_id" class="el_jdh_beds_assignment_bed_id">
<span<?= $Grid->bed_id->viewAttributes() ?>>
<?= $Grid->bed_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_beds_assignment" data-field="x_bed_id" data-hidden="1" name="fjdh_beds_assignmentgrid$x<?= $Grid->RowIndex ?>_bed_id" id="fjdh_beds_assignmentgrid$x<?= $Grid->RowIndex ?>_bed_id" value="<?= HtmlEncode($Grid->bed_id->FormValue) ?>">
<input type="hidden" data-table="jdh_beds_assignment" data-field="x_bed_id" data-hidden="1" data-old name="fjdh_beds_assignmentgrid$o<?= $Grid->RowIndex ?>_bed_id" id="fjdh_beds_assignmentgrid$o<?= $Grid->RowIndex ?>_bed_id" value="<?= HtmlEncode($Grid->bed_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->date_submitted->Visible) { // date_submitted ?>
        <td data-name="date_submitted"<?= $Grid->date_submitted->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_beds_assignment_date_submitted" class="el_jdh_beds_assignment_date_submitted">
<input type="<?= $Grid->date_submitted->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_submitted" id="x<?= $Grid->RowIndex ?>_date_submitted" data-table="jdh_beds_assignment" data-field="x_date_submitted" value="<?= $Grid->date_submitted->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_submitted->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_submitted->formatPattern()) ?>"<?= $Grid->date_submitted->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_submitted->getErrorMessage() ?></div>
<?php if (!$Grid->date_submitted->ReadOnly && !$Grid->date_submitted->Disabled && !isset($Grid->date_submitted->EditAttrs["readonly"]) && !isset($Grid->date_submitted->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjdh_beds_assignmentgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fjdh_beds_assignmentgrid", "x<?= $Grid->RowIndex ?>_date_submitted", jQuery.extend(true, {"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="jdh_beds_assignment" data-field="x_date_submitted" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_date_submitted" id="o<?= $Grid->RowIndex ?>_date_submitted" value="<?= HtmlEncode($Grid->date_submitted->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_beds_assignment_date_submitted" class="el_jdh_beds_assignment_date_submitted">
<input type="<?= $Grid->date_submitted->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_submitted" id="x<?= $Grid->RowIndex ?>_date_submitted" data-table="jdh_beds_assignment" data-field="x_date_submitted" value="<?= $Grid->date_submitted->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_submitted->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_submitted->formatPattern()) ?>"<?= $Grid->date_submitted->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_submitted->getErrorMessage() ?></div>
<?php if (!$Grid->date_submitted->ReadOnly && !$Grid->date_submitted->Disabled && !isset($Grid->date_submitted->EditAttrs["readonly"]) && !isset($Grid->date_submitted->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjdh_beds_assignmentgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fjdh_beds_assignmentgrid", "x<?= $Grid->RowIndex ?>_date_submitted", jQuery.extend(true, {"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_beds_assignment_date_submitted" class="el_jdh_beds_assignment_date_submitted">
<span<?= $Grid->date_submitted->viewAttributes() ?>>
<?= $Grid->date_submitted->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_beds_assignment" data-field="x_date_submitted" data-hidden="1" name="fjdh_beds_assignmentgrid$x<?= $Grid->RowIndex ?>_date_submitted" id="fjdh_beds_assignmentgrid$x<?= $Grid->RowIndex ?>_date_submitted" value="<?= HtmlEncode($Grid->date_submitted->FormValue) ?>">
<input type="hidden" data-table="jdh_beds_assignment" data-field="x_date_submitted" data-hidden="1" data-old name="fjdh_beds_assignmentgrid$o<?= $Grid->RowIndex ?>_date_submitted" id="fjdh_beds_assignmentgrid$o<?= $Grid->RowIndex ?>_date_submitted" value="<?= HtmlEncode($Grid->date_submitted->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->submittedby_user_id->Visible) { // submittedby_user_id ?>
        <td data-name="submittedby_user_id"<?= $Grid->submittedby_user_id->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="jdh_beds_assignment" data-field="x_submittedby_user_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_submittedby_user_id" id="o<?= $Grid->RowIndex ?>_submittedby_user_id" value="<?= HtmlEncode($Grid->submittedby_user_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_beds_assignment_submittedby_user_id" class="el_jdh_beds_assignment_submittedby_user_id">
<span<?= $Grid->submittedby_user_id->viewAttributes() ?>>
<?= $Grid->submittedby_user_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_beds_assignment" data-field="x_submittedby_user_id" data-hidden="1" name="fjdh_beds_assignmentgrid$x<?= $Grid->RowIndex ?>_submittedby_user_id" id="fjdh_beds_assignmentgrid$x<?= $Grid->RowIndex ?>_submittedby_user_id" value="<?= HtmlEncode($Grid->submittedby_user_id->FormValue) ?>">
<input type="hidden" data-table="jdh_beds_assignment" data-field="x_submittedby_user_id" data-hidden="1" data-old name="fjdh_beds_assignmentgrid$o<?= $Grid->RowIndex ?>_submittedby_user_id" id="fjdh_beds_assignmentgrid$o<?= $Grid->RowIndex ?>_submittedby_user_id" value="<?= HtmlEncode($Grid->submittedby_user_id->OldValue) ?>">
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
loadjs.ready(["fjdh_beds_assignmentgrid","load"], () => fjdh_beds_assignmentgrid.updateLists(<?= $Grid->RowIndex ?><?= $Grid->RowIndex === '$rowindex$' ? ", true" : "" ?>));
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
<input type="hidden" name="detailpage" value="fjdh_beds_assignmentgrid">
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
    ew.addEventHandlers("jdh_beds_assignment");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
