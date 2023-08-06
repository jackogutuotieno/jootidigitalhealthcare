<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Set up and run Grid object
$Grid = Container("JdhAppointmentsGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fjdh_appointmentsgrid;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { jdh_appointments: currentTable } });
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_appointmentsgrid")
        .setPageId("grid")
        .setFormKeyCountName("<?= $Grid->FormKeyCountName ?>")

        // Add fields
        .setFields([
            ["appointment_id", [fields.appointment_id.visible && fields.appointment_id.required ? ew.Validators.required(fields.appointment_id.caption) : null], fields.appointment_id.isInvalid],
            ["patient_id", [fields.patient_id.visible && fields.patient_id.required ? ew.Validators.required(fields.patient_id.caption) : null], fields.patient_id.isInvalid],
            ["appointment_title", [fields.appointment_title.visible && fields.appointment_title.required ? ew.Validators.required(fields.appointment_title.caption) : null], fields.appointment_title.isInvalid],
            ["appointment_start_date", [fields.appointment_start_date.visible && fields.appointment_start_date.required ? ew.Validators.required(fields.appointment_start_date.caption) : null, ew.Validators.datetime(fields.appointment_start_date.clientFormatPattern)], fields.appointment_start_date.isInvalid],
            ["appointment_end_date", [fields.appointment_end_date.visible && fields.appointment_end_date.required ? ew.Validators.required(fields.appointment_end_date.caption) : null, ew.Validators.datetime(fields.appointment_end_date.clientFormatPattern)], fields.appointment_end_date.isInvalid],
            ["submission_date", [fields.submission_date.visible && fields.submission_date.required ? ew.Validators.required(fields.submission_date.caption) : null, ew.Validators.datetime(fields.submission_date.clientFormatPattern)], fields.submission_date.isInvalid]
        ])

        // Check empty row
        .setEmptyRow(
            function (rowIndex) {
                let fobj = this.getForm(),
                    fields = [["patient_id",false],["appointment_title",false],["appointment_start_date",false],["appointment_end_date",false],["submission_date",false]];
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
<div id="fjdh_appointmentsgrid" class="ew-form ew-list-form">
<div id="gmp_jdh_appointments" class="card-body ew-grid-middle-panel <?= $Grid->TableContainerClass ?>" style="<?= $Grid->TableContainerStyle ?>">
<table id="tbl_jdh_appointmentsgrid" class="<?= $Grid->TableClass ?>"><!-- .ew-table -->
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
<?php if ($Grid->appointment_id->Visible) { // appointment_id ?>
        <th data-name="appointment_id" class="<?= $Grid->appointment_id->headerCellClass() ?>"><div id="elh_jdh_appointments_appointment_id" class="jdh_appointments_appointment_id"><?= $Grid->renderFieldHeader($Grid->appointment_id) ?></div></th>
<?php } ?>
<?php if ($Grid->patient_id->Visible) { // patient_id ?>
        <th data-name="patient_id" class="<?= $Grid->patient_id->headerCellClass() ?>"><div id="elh_jdh_appointments_patient_id" class="jdh_appointments_patient_id"><?= $Grid->renderFieldHeader($Grid->patient_id) ?></div></th>
<?php } ?>
<?php if ($Grid->appointment_title->Visible) { // appointment_title ?>
        <th data-name="appointment_title" class="<?= $Grid->appointment_title->headerCellClass() ?>"><div id="elh_jdh_appointments_appointment_title" class="jdh_appointments_appointment_title"><?= $Grid->renderFieldHeader($Grid->appointment_title) ?></div></th>
<?php } ?>
<?php if ($Grid->appointment_start_date->Visible) { // appointment_start_date ?>
        <th data-name="appointment_start_date" class="<?= $Grid->appointment_start_date->headerCellClass() ?>"><div id="elh_jdh_appointments_appointment_start_date" class="jdh_appointments_appointment_start_date"><?= $Grid->renderFieldHeader($Grid->appointment_start_date) ?></div></th>
<?php } ?>
<?php if ($Grid->appointment_end_date->Visible) { // appointment_end_date ?>
        <th data-name="appointment_end_date" class="<?= $Grid->appointment_end_date->headerCellClass() ?>"><div id="elh_jdh_appointments_appointment_end_date" class="jdh_appointments_appointment_end_date"><?= $Grid->renderFieldHeader($Grid->appointment_end_date) ?></div></th>
<?php } ?>
<?php if ($Grid->submission_date->Visible) { // submission_date ?>
        <th data-name="submission_date" class="<?= $Grid->submission_date->headerCellClass() ?>"><div id="elh_jdh_appointments_submission_date" class="jdh_appointments_submission_date"><?= $Grid->renderFieldHeader($Grid->submission_date) ?></div></th>
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
    <?php if ($Grid->appointment_id->Visible) { // appointment_id ?>
        <td data-name="appointment_id"<?= $Grid->appointment_id->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_appointments_appointment_id" class="el_jdh_appointments_appointment_id"></span>
<input type="hidden" data-table="jdh_appointments" data-field="x_appointment_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_appointment_id" id="o<?= $Grid->RowIndex ?>_appointment_id" value="<?= HtmlEncode($Grid->appointment_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_appointments_appointment_id" class="el_jdh_appointments_appointment_id">
<span<?= $Grid->appointment_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->appointment_id->getDisplayValue($Grid->appointment_id->EditValue))) ?>"></span>
<input type="hidden" data-table="jdh_appointments" data-field="x_appointment_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_appointment_id" id="x<?= $Grid->RowIndex ?>_appointment_id" value="<?= HtmlEncode($Grid->appointment_id->CurrentValue) ?>">
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_appointments_appointment_id" class="el_jdh_appointments_appointment_id">
<span<?= $Grid->appointment_id->viewAttributes() ?>>
<?= $Grid->appointment_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_appointments" data-field="x_appointment_id" data-hidden="1" name="fjdh_appointmentsgrid$x<?= $Grid->RowIndex ?>_appointment_id" id="fjdh_appointmentsgrid$x<?= $Grid->RowIndex ?>_appointment_id" value="<?= HtmlEncode($Grid->appointment_id->FormValue) ?>">
<input type="hidden" data-table="jdh_appointments" data-field="x_appointment_id" data-hidden="1" data-old name="fjdh_appointmentsgrid$o<?= $Grid->RowIndex ?>_appointment_id" id="fjdh_appointmentsgrid$o<?= $Grid->RowIndex ?>_appointment_id" value="<?= HtmlEncode($Grid->appointment_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="jdh_appointments" data-field="x_appointment_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_appointment_id" id="x<?= $Grid->RowIndex ?>_appointment_id" value="<?= HtmlEncode($Grid->appointment_id->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Grid->patient_id->Visible) { // patient_id ?>
        <td data-name="patient_id"<?= $Grid->patient_id->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($Grid->patient_id->getSessionValue() != "") { ?>
<span<?= $Grid->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->patient_id->getDisplayValue($Grid->patient_id->ViewValue) ?></span></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_patient_id" name="x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_jdh_appointments_patient_id" class="el_jdh_appointments_patient_id">
    <select
        id="x<?= $Grid->RowIndex ?>_patient_id"
        name="x<?= $Grid->RowIndex ?>_patient_id"
        class="form-select ew-select<?= $Grid->patient_id->isInvalidClass() ?>"
        data-select2-id="fjdh_appointmentsgrid_x<?= $Grid->RowIndex ?>_patient_id"
        data-table="jdh_appointments"
        data-field="x_patient_id"
        data-value-separator="<?= $Grid->patient_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->patient_id->getPlaceHolder()) ?>"
        <?= $Grid->patient_id->editAttributes() ?>>
        <?= $Grid->patient_id->selectOptionListHtml("x{$Grid->RowIndex}_patient_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->patient_id->getErrorMessage() ?></div>
<?= $Grid->patient_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_patient_id") ?>
<script>
loadjs.ready("fjdh_appointmentsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_patient_id", selectId: "fjdh_appointmentsgrid_x<?= $Grid->RowIndex ?>_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_appointmentsgrid.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fjdh_appointmentsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fjdh_appointmentsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_appointments.fields.patient_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<input type="hidden" data-table="jdh_appointments" data-field="x_patient_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_patient_id" id="o<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($Grid->patient_id->getSessionValue() != "") { ?>
<span<?= $Grid->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->patient_id->getDisplayValue($Grid->patient_id->ViewValue) ?></span></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_patient_id" name="x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_jdh_appointments_patient_id" class="el_jdh_appointments_patient_id">
    <select
        id="x<?= $Grid->RowIndex ?>_patient_id"
        name="x<?= $Grid->RowIndex ?>_patient_id"
        class="form-select ew-select<?= $Grid->patient_id->isInvalidClass() ?>"
        data-select2-id="fjdh_appointmentsgrid_x<?= $Grid->RowIndex ?>_patient_id"
        data-table="jdh_appointments"
        data-field="x_patient_id"
        data-value-separator="<?= $Grid->patient_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->patient_id->getPlaceHolder()) ?>"
        <?= $Grid->patient_id->editAttributes() ?>>
        <?= $Grid->patient_id->selectOptionListHtml("x{$Grid->RowIndex}_patient_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->patient_id->getErrorMessage() ?></div>
<?= $Grid->patient_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_patient_id") ?>
<script>
loadjs.ready("fjdh_appointmentsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_patient_id", selectId: "fjdh_appointmentsgrid_x<?= $Grid->RowIndex ?>_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_appointmentsgrid.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fjdh_appointmentsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fjdh_appointmentsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_appointments.fields.patient_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_appointments_patient_id" class="el_jdh_appointments_patient_id">
<span<?= $Grid->patient_id->viewAttributes() ?>>
<?= $Grid->patient_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_appointments" data-field="x_patient_id" data-hidden="1" name="fjdh_appointmentsgrid$x<?= $Grid->RowIndex ?>_patient_id" id="fjdh_appointmentsgrid$x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->FormValue) ?>">
<input type="hidden" data-table="jdh_appointments" data-field="x_patient_id" data-hidden="1" data-old name="fjdh_appointmentsgrid$o<?= $Grid->RowIndex ?>_patient_id" id="fjdh_appointmentsgrid$o<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->appointment_title->Visible) { // appointment_title ?>
        <td data-name="appointment_title"<?= $Grid->appointment_title->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_appointments_appointment_title" class="el_jdh_appointments_appointment_title">
<input type="<?= $Grid->appointment_title->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_appointment_title" id="x<?= $Grid->RowIndex ?>_appointment_title" data-table="jdh_appointments" data-field="x_appointment_title" value="<?= $Grid->appointment_title->EditValue ?>" size="30" maxlength="200" placeholder="<?= HtmlEncode($Grid->appointment_title->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->appointment_title->formatPattern()) ?>"<?= $Grid->appointment_title->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->appointment_title->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="jdh_appointments" data-field="x_appointment_title" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_appointment_title" id="o<?= $Grid->RowIndex ?>_appointment_title" value="<?= HtmlEncode($Grid->appointment_title->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_appointments_appointment_title" class="el_jdh_appointments_appointment_title">
<input type="<?= $Grid->appointment_title->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_appointment_title" id="x<?= $Grid->RowIndex ?>_appointment_title" data-table="jdh_appointments" data-field="x_appointment_title" value="<?= $Grid->appointment_title->EditValue ?>" size="30" maxlength="200" placeholder="<?= HtmlEncode($Grid->appointment_title->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->appointment_title->formatPattern()) ?>"<?= $Grid->appointment_title->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->appointment_title->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_appointments_appointment_title" class="el_jdh_appointments_appointment_title">
<span<?= $Grid->appointment_title->viewAttributes() ?>>
<?= $Grid->appointment_title->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_appointments" data-field="x_appointment_title" data-hidden="1" name="fjdh_appointmentsgrid$x<?= $Grid->RowIndex ?>_appointment_title" id="fjdh_appointmentsgrid$x<?= $Grid->RowIndex ?>_appointment_title" value="<?= HtmlEncode($Grid->appointment_title->FormValue) ?>">
<input type="hidden" data-table="jdh_appointments" data-field="x_appointment_title" data-hidden="1" data-old name="fjdh_appointmentsgrid$o<?= $Grid->RowIndex ?>_appointment_title" id="fjdh_appointmentsgrid$o<?= $Grid->RowIndex ?>_appointment_title" value="<?= HtmlEncode($Grid->appointment_title->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->appointment_start_date->Visible) { // appointment_start_date ?>
        <td data-name="appointment_start_date"<?= $Grid->appointment_start_date->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_appointments_appointment_start_date" class="el_jdh_appointments_appointment_start_date">
<input type="<?= $Grid->appointment_start_date->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_appointment_start_date" id="x<?= $Grid->RowIndex ?>_appointment_start_date" data-table="jdh_appointments" data-field="x_appointment_start_date" value="<?= $Grid->appointment_start_date->EditValue ?>" placeholder="<?= HtmlEncode($Grid->appointment_start_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->appointment_start_date->formatPattern()) ?>"<?= $Grid->appointment_start_date->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->appointment_start_date->getErrorMessage() ?></div>
<?php if (!$Grid->appointment_start_date->ReadOnly && !$Grid->appointment_start_date->Disabled && !isset($Grid->appointment_start_date->EditAttrs["readonly"]) && !isset($Grid->appointment_start_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjdh_appointmentsgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fjdh_appointmentsgrid", "x<?= $Grid->RowIndex ?>_appointment_start_date", jQuery.extend(true, {"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="jdh_appointments" data-field="x_appointment_start_date" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_appointment_start_date" id="o<?= $Grid->RowIndex ?>_appointment_start_date" value="<?= HtmlEncode($Grid->appointment_start_date->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_appointments_appointment_start_date" class="el_jdh_appointments_appointment_start_date">
<input type="<?= $Grid->appointment_start_date->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_appointment_start_date" id="x<?= $Grid->RowIndex ?>_appointment_start_date" data-table="jdh_appointments" data-field="x_appointment_start_date" value="<?= $Grid->appointment_start_date->EditValue ?>" placeholder="<?= HtmlEncode($Grid->appointment_start_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->appointment_start_date->formatPattern()) ?>"<?= $Grid->appointment_start_date->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->appointment_start_date->getErrorMessage() ?></div>
<?php if (!$Grid->appointment_start_date->ReadOnly && !$Grid->appointment_start_date->Disabled && !isset($Grid->appointment_start_date->EditAttrs["readonly"]) && !isset($Grid->appointment_start_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjdh_appointmentsgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fjdh_appointmentsgrid", "x<?= $Grid->RowIndex ?>_appointment_start_date", jQuery.extend(true, {"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_appointments_appointment_start_date" class="el_jdh_appointments_appointment_start_date">
<span<?= $Grid->appointment_start_date->viewAttributes() ?>>
<?= $Grid->appointment_start_date->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_appointments" data-field="x_appointment_start_date" data-hidden="1" name="fjdh_appointmentsgrid$x<?= $Grid->RowIndex ?>_appointment_start_date" id="fjdh_appointmentsgrid$x<?= $Grid->RowIndex ?>_appointment_start_date" value="<?= HtmlEncode($Grid->appointment_start_date->FormValue) ?>">
<input type="hidden" data-table="jdh_appointments" data-field="x_appointment_start_date" data-hidden="1" data-old name="fjdh_appointmentsgrid$o<?= $Grid->RowIndex ?>_appointment_start_date" id="fjdh_appointmentsgrid$o<?= $Grid->RowIndex ?>_appointment_start_date" value="<?= HtmlEncode($Grid->appointment_start_date->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->appointment_end_date->Visible) { // appointment_end_date ?>
        <td data-name="appointment_end_date"<?= $Grid->appointment_end_date->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_appointments_appointment_end_date" class="el_jdh_appointments_appointment_end_date">
<input type="<?= $Grid->appointment_end_date->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_appointment_end_date" id="x<?= $Grid->RowIndex ?>_appointment_end_date" data-table="jdh_appointments" data-field="x_appointment_end_date" value="<?= $Grid->appointment_end_date->EditValue ?>" placeholder="<?= HtmlEncode($Grid->appointment_end_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->appointment_end_date->formatPattern()) ?>"<?= $Grid->appointment_end_date->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->appointment_end_date->getErrorMessage() ?></div>
<?php if (!$Grid->appointment_end_date->ReadOnly && !$Grid->appointment_end_date->Disabled && !isset($Grid->appointment_end_date->EditAttrs["readonly"]) && !isset($Grid->appointment_end_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjdh_appointmentsgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fjdh_appointmentsgrid", "x<?= $Grid->RowIndex ?>_appointment_end_date", jQuery.extend(true, {"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="jdh_appointments" data-field="x_appointment_end_date" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_appointment_end_date" id="o<?= $Grid->RowIndex ?>_appointment_end_date" value="<?= HtmlEncode($Grid->appointment_end_date->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_appointments_appointment_end_date" class="el_jdh_appointments_appointment_end_date">
<input type="<?= $Grid->appointment_end_date->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_appointment_end_date" id="x<?= $Grid->RowIndex ?>_appointment_end_date" data-table="jdh_appointments" data-field="x_appointment_end_date" value="<?= $Grid->appointment_end_date->EditValue ?>" placeholder="<?= HtmlEncode($Grid->appointment_end_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->appointment_end_date->formatPattern()) ?>"<?= $Grid->appointment_end_date->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->appointment_end_date->getErrorMessage() ?></div>
<?php if (!$Grid->appointment_end_date->ReadOnly && !$Grid->appointment_end_date->Disabled && !isset($Grid->appointment_end_date->EditAttrs["readonly"]) && !isset($Grid->appointment_end_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjdh_appointmentsgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fjdh_appointmentsgrid", "x<?= $Grid->RowIndex ?>_appointment_end_date", jQuery.extend(true, {"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_appointments_appointment_end_date" class="el_jdh_appointments_appointment_end_date">
<span<?= $Grid->appointment_end_date->viewAttributes() ?>>
<?= $Grid->appointment_end_date->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_appointments" data-field="x_appointment_end_date" data-hidden="1" name="fjdh_appointmentsgrid$x<?= $Grid->RowIndex ?>_appointment_end_date" id="fjdh_appointmentsgrid$x<?= $Grid->RowIndex ?>_appointment_end_date" value="<?= HtmlEncode($Grid->appointment_end_date->FormValue) ?>">
<input type="hidden" data-table="jdh_appointments" data-field="x_appointment_end_date" data-hidden="1" data-old name="fjdh_appointmentsgrid$o<?= $Grid->RowIndex ?>_appointment_end_date" id="fjdh_appointmentsgrid$o<?= $Grid->RowIndex ?>_appointment_end_date" value="<?= HtmlEncode($Grid->appointment_end_date->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->submission_date->Visible) { // submission_date ?>
        <td data-name="submission_date"<?= $Grid->submission_date->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_appointments_submission_date" class="el_jdh_appointments_submission_date">
<input type="<?= $Grid->submission_date->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_submission_date" id="x<?= $Grid->RowIndex ?>_submission_date" data-table="jdh_appointments" data-field="x_submission_date" value="<?= $Grid->submission_date->EditValue ?>" placeholder="<?= HtmlEncode($Grid->submission_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->submission_date->formatPattern()) ?>"<?= $Grid->submission_date->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->submission_date->getErrorMessage() ?></div>
<?php if (!$Grid->submission_date->ReadOnly && !$Grid->submission_date->Disabled && !isset($Grid->submission_date->EditAttrs["readonly"]) && !isset($Grid->submission_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjdh_appointmentsgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fjdh_appointmentsgrid", "x<?= $Grid->RowIndex ?>_submission_date", jQuery.extend(true, {"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="jdh_appointments" data-field="x_submission_date" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_submission_date" id="o<?= $Grid->RowIndex ?>_submission_date" value="<?= HtmlEncode($Grid->submission_date->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_appointments_submission_date" class="el_jdh_appointments_submission_date">
<input type="<?= $Grid->submission_date->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_submission_date" id="x<?= $Grid->RowIndex ?>_submission_date" data-table="jdh_appointments" data-field="x_submission_date" value="<?= $Grid->submission_date->EditValue ?>" placeholder="<?= HtmlEncode($Grid->submission_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->submission_date->formatPattern()) ?>"<?= $Grid->submission_date->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->submission_date->getErrorMessage() ?></div>
<?php if (!$Grid->submission_date->ReadOnly && !$Grid->submission_date->Disabled && !isset($Grid->submission_date->EditAttrs["readonly"]) && !isset($Grid->submission_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjdh_appointmentsgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fjdh_appointmentsgrid", "x<?= $Grid->RowIndex ?>_submission_date", jQuery.extend(true, {"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_appointments_submission_date" class="el_jdh_appointments_submission_date">
<span<?= $Grid->submission_date->viewAttributes() ?>>
<?= $Grid->submission_date->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_appointments" data-field="x_submission_date" data-hidden="1" name="fjdh_appointmentsgrid$x<?= $Grid->RowIndex ?>_submission_date" id="fjdh_appointmentsgrid$x<?= $Grid->RowIndex ?>_submission_date" value="<?= HtmlEncode($Grid->submission_date->FormValue) ?>">
<input type="hidden" data-table="jdh_appointments" data-field="x_submission_date" data-hidden="1" data-old name="fjdh_appointmentsgrid$o<?= $Grid->RowIndex ?>_submission_date" id="fjdh_appointmentsgrid$o<?= $Grid->RowIndex ?>_submission_date" value="<?= HtmlEncode($Grid->submission_date->OldValue) ?>">
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
loadjs.ready(["fjdh_appointmentsgrid","load"], () => fjdh_appointmentsgrid.updateLists(<?= $Grid->RowIndex ?><?= $Grid->RowIndex === '$rowindex$' ? ", true" : "" ?>));
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
<input type="hidden" name="detailpage" value="fjdh_appointmentsgrid">
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
    ew.addEventHandlers("jdh_appointments");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
