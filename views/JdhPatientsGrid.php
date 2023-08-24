<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Set up and run Grid object
$Grid = Container("JdhPatientsGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fjdh_patientsgrid;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { jdh_patients: currentTable } });
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_patientsgrid")
        .setPageId("grid")
        .setFormKeyCountName("<?= $Grid->FormKeyCountName ?>")

        // Add fields
        .setFields([
            ["patient_id", [fields.patient_id.visible && fields.patient_id.required ? ew.Validators.required(fields.patient_id.caption) : null], fields.patient_id.isInvalid],
            ["patient_name", [fields.patient_name.visible && fields.patient_name.required ? ew.Validators.required(fields.patient_name.caption) : null], fields.patient_name.isInvalid],
            ["patient_national_id", [fields.patient_national_id.visible && fields.patient_national_id.required ? ew.Validators.required(fields.patient_national_id.caption) : null], fields.patient_national_id.isInvalid],
            ["patient_dob", [fields.patient_dob.visible && fields.patient_dob.required ? ew.Validators.required(fields.patient_dob.caption) : null, ew.Validators.datetime(fields.patient_dob.clientFormatPattern)], fields.patient_dob.isInvalid],
            ["patient_age", [fields.patient_age.visible && fields.patient_age.required ? ew.Validators.required(fields.patient_age.caption) : null], fields.patient_age.isInvalid],
            ["patient_gender", [fields.patient_gender.visible && fields.patient_gender.required ? ew.Validators.required(fields.patient_gender.caption) : null], fields.patient_gender.isInvalid],
            ["patient_phone", [fields.patient_phone.visible && fields.patient_phone.required ? ew.Validators.required(fields.patient_phone.caption) : null], fields.patient_phone.isInvalid],
            ["patient_registration_date", [fields.patient_registration_date.visible && fields.patient_registration_date.required ? ew.Validators.required(fields.patient_registration_date.caption) : null, ew.Validators.datetime(fields.patient_registration_date.clientFormatPattern)], fields.patient_registration_date.isInvalid]
        ])

        // Check empty row
        .setEmptyRow(
            function (rowIndex) {
                let fobj = this.getForm(),
                    fields = [["patient_name",false],["patient_national_id",false],["patient_dob",false],["patient_age",false],["patient_gender",false],["patient_phone",false],["patient_registration_date",false]];
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
            "patient_gender": <?= $Grid->patient_gender->toClientList($Grid) ?>,
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
<div id="fjdh_patientsgrid" class="ew-form ew-list-form">
<div id="gmp_jdh_patients" class="card-body ew-grid-middle-panel <?= $Grid->TableContainerClass ?>" style="<?= $Grid->TableContainerStyle ?>">
<table id="tbl_jdh_patientsgrid" class="<?= $Grid->TableClass ?>"><!-- .ew-table -->
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
        <th data-name="patient_id" class="<?= $Grid->patient_id->headerCellClass() ?>"><div id="elh_jdh_patients_patient_id" class="jdh_patients_patient_id"><?= $Grid->renderFieldHeader($Grid->patient_id) ?></div></th>
<?php } ?>
<?php if ($Grid->patient_name->Visible) { // patient_name ?>
        <th data-name="patient_name" class="<?= $Grid->patient_name->headerCellClass() ?>"><div id="elh_jdh_patients_patient_name" class="jdh_patients_patient_name"><?= $Grid->renderFieldHeader($Grid->patient_name) ?></div></th>
<?php } ?>
<?php if ($Grid->patient_national_id->Visible) { // patient_national_id ?>
        <th data-name="patient_national_id" class="<?= $Grid->patient_national_id->headerCellClass() ?>"><div id="elh_jdh_patients_patient_national_id" class="jdh_patients_patient_national_id"><?= $Grid->renderFieldHeader($Grid->patient_national_id) ?></div></th>
<?php } ?>
<?php if ($Grid->patient_dob->Visible) { // patient_dob ?>
        <th data-name="patient_dob" class="<?= $Grid->patient_dob->headerCellClass() ?>"><div id="elh_jdh_patients_patient_dob" class="jdh_patients_patient_dob"><?= $Grid->renderFieldHeader($Grid->patient_dob) ?></div></th>
<?php } ?>
<?php if ($Grid->patient_age->Visible) { // patient_age ?>
        <th data-name="patient_age" class="<?= $Grid->patient_age->headerCellClass() ?>"><div id="elh_jdh_patients_patient_age" class="jdh_patients_patient_age"><?= $Grid->renderFieldHeader($Grid->patient_age) ?></div></th>
<?php } ?>
<?php if ($Grid->patient_gender->Visible) { // patient_gender ?>
        <th data-name="patient_gender" class="<?= $Grid->patient_gender->headerCellClass() ?>"><div id="elh_jdh_patients_patient_gender" class="jdh_patients_patient_gender"><?= $Grid->renderFieldHeader($Grid->patient_gender) ?></div></th>
<?php } ?>
<?php if ($Grid->patient_phone->Visible) { // patient_phone ?>
        <th data-name="patient_phone" class="<?= $Grid->patient_phone->headerCellClass() ?>"><div id="elh_jdh_patients_patient_phone" class="jdh_patients_patient_phone"><?= $Grid->renderFieldHeader($Grid->patient_phone) ?></div></th>
<?php } ?>
<?php if ($Grid->patient_registration_date->Visible) { // patient_registration_date ?>
        <th data-name="patient_registration_date" class="<?= $Grid->patient_registration_date->headerCellClass() ?>"><div id="elh_jdh_patients_patient_registration_date" class="jdh_patients_patient_registration_date"><?= $Grid->renderFieldHeader($Grid->patient_registration_date) ?></div></th>
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
<span id="el<?= $Grid->RowCount ?>_jdh_patients_patient_id" class="el_jdh_patients_patient_id"></span>
<input type="hidden" data-table="jdh_patients" data-field="x_patient_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_patient_id" id="o<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_patients_patient_id" class="el_jdh_patients_patient_id">
<span<?= $Grid->patient_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->patient_id->getDisplayValue($Grid->patient_id->EditValue))) ?>"></span>
<input type="hidden" data-table="jdh_patients" data-field="x_patient_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_patient_id" id="x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->CurrentValue) ?>">
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_patients_patient_id" class="el_jdh_patients_patient_id">
<span<?= $Grid->patient_id->viewAttributes() ?>>
<?= $Grid->patient_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_patients" data-field="x_patient_id" data-hidden="1" name="fjdh_patientsgrid$x<?= $Grid->RowIndex ?>_patient_id" id="fjdh_patientsgrid$x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->FormValue) ?>">
<input type="hidden" data-table="jdh_patients" data-field="x_patient_id" data-hidden="1" data-old name="fjdh_patientsgrid$o<?= $Grid->RowIndex ?>_patient_id" id="fjdh_patientsgrid$o<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="jdh_patients" data-field="x_patient_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_patient_id" id="x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Grid->patient_name->Visible) { // patient_name ?>
        <td data-name="patient_name"<?= $Grid->patient_name->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_patients_patient_name" class="el_jdh_patients_patient_name">
<input type="<?= $Grid->patient_name->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_patient_name" id="x<?= $Grid->RowIndex ?>_patient_name" data-table="jdh_patients" data-field="x_patient_name" value="<?= $Grid->patient_name->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->patient_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->patient_name->formatPattern()) ?>"<?= $Grid->patient_name->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->patient_name->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="jdh_patients" data-field="x_patient_name" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_patient_name" id="o<?= $Grid->RowIndex ?>_patient_name" value="<?= HtmlEncode($Grid->patient_name->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_patients_patient_name" class="el_jdh_patients_patient_name">
<input type="<?= $Grid->patient_name->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_patient_name" id="x<?= $Grid->RowIndex ?>_patient_name" data-table="jdh_patients" data-field="x_patient_name" value="<?= $Grid->patient_name->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->patient_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->patient_name->formatPattern()) ?>"<?= $Grid->patient_name->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->patient_name->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_patients_patient_name" class="el_jdh_patients_patient_name">
<span<?= $Grid->patient_name->viewAttributes() ?>>
<?= $Grid->patient_name->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_patients" data-field="x_patient_name" data-hidden="1" name="fjdh_patientsgrid$x<?= $Grid->RowIndex ?>_patient_name" id="fjdh_patientsgrid$x<?= $Grid->RowIndex ?>_patient_name" value="<?= HtmlEncode($Grid->patient_name->FormValue) ?>">
<input type="hidden" data-table="jdh_patients" data-field="x_patient_name" data-hidden="1" data-old name="fjdh_patientsgrid$o<?= $Grid->RowIndex ?>_patient_name" id="fjdh_patientsgrid$o<?= $Grid->RowIndex ?>_patient_name" value="<?= HtmlEncode($Grid->patient_name->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->patient_national_id->Visible) { // patient_national_id ?>
        <td data-name="patient_national_id"<?= $Grid->patient_national_id->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_patients_patient_national_id" class="el_jdh_patients_patient_national_id">
<input type="<?= $Grid->patient_national_id->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_patient_national_id" id="x<?= $Grid->RowIndex ?>_patient_national_id" data-table="jdh_patients" data-field="x_patient_national_id" value="<?= $Grid->patient_national_id->EditValue ?>" size="30" maxlength="13" placeholder="<?= HtmlEncode($Grid->patient_national_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->patient_national_id->formatPattern()) ?>"<?= $Grid->patient_national_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->patient_national_id->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="jdh_patients" data-field="x_patient_national_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_patient_national_id" id="o<?= $Grid->RowIndex ?>_patient_national_id" value="<?= HtmlEncode($Grid->patient_national_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_patients_patient_national_id" class="el_jdh_patients_patient_national_id">
<input type="<?= $Grid->patient_national_id->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_patient_national_id" id="x<?= $Grid->RowIndex ?>_patient_national_id" data-table="jdh_patients" data-field="x_patient_national_id" value="<?= $Grid->patient_national_id->EditValue ?>" size="30" maxlength="13" placeholder="<?= HtmlEncode($Grid->patient_national_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->patient_national_id->formatPattern()) ?>"<?= $Grid->patient_national_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->patient_national_id->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_patients_patient_national_id" class="el_jdh_patients_patient_national_id">
<span<?= $Grid->patient_national_id->viewAttributes() ?>>
<?= $Grid->patient_national_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_patients" data-field="x_patient_national_id" data-hidden="1" name="fjdh_patientsgrid$x<?= $Grid->RowIndex ?>_patient_national_id" id="fjdh_patientsgrid$x<?= $Grid->RowIndex ?>_patient_national_id" value="<?= HtmlEncode($Grid->patient_national_id->FormValue) ?>">
<input type="hidden" data-table="jdh_patients" data-field="x_patient_national_id" data-hidden="1" data-old name="fjdh_patientsgrid$o<?= $Grid->RowIndex ?>_patient_national_id" id="fjdh_patientsgrid$o<?= $Grid->RowIndex ?>_patient_national_id" value="<?= HtmlEncode($Grid->patient_national_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->patient_dob->Visible) { // patient_dob ?>
        <td data-name="patient_dob"<?= $Grid->patient_dob->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_patients_patient_dob" class="el_jdh_patients_patient_dob">
<input type="<?= $Grid->patient_dob->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_patient_dob" id="x<?= $Grid->RowIndex ?>_patient_dob" data-table="jdh_patients" data-field="x_patient_dob" value="<?= $Grid->patient_dob->EditValue ?>" placeholder="<?= HtmlEncode($Grid->patient_dob->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->patient_dob->formatPattern()) ?>"<?= $Grid->patient_dob->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->patient_dob->getErrorMessage() ?></div>
<?php if (!$Grid->patient_dob->ReadOnly && !$Grid->patient_dob->Disabled && !isset($Grid->patient_dob->EditAttrs["readonly"]) && !isset($Grid->patient_dob->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjdh_patientsgrid", "datetimepicker"], function () {
    let format = "<?= DateFormat(7) ?>",
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
    ew.createDateTimePicker("fjdh_patientsgrid", "x<?= $Grid->RowIndex ?>_patient_dob", jQuery.extend(true, {"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="jdh_patients" data-field="x_patient_dob" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_patient_dob" id="o<?= $Grid->RowIndex ?>_patient_dob" value="<?= HtmlEncode($Grid->patient_dob->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_patients_patient_dob" class="el_jdh_patients_patient_dob">
<input type="<?= $Grid->patient_dob->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_patient_dob" id="x<?= $Grid->RowIndex ?>_patient_dob" data-table="jdh_patients" data-field="x_patient_dob" value="<?= $Grid->patient_dob->EditValue ?>" placeholder="<?= HtmlEncode($Grid->patient_dob->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->patient_dob->formatPattern()) ?>"<?= $Grid->patient_dob->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->patient_dob->getErrorMessage() ?></div>
<?php if (!$Grid->patient_dob->ReadOnly && !$Grid->patient_dob->Disabled && !isset($Grid->patient_dob->EditAttrs["readonly"]) && !isset($Grid->patient_dob->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjdh_patientsgrid", "datetimepicker"], function () {
    let format = "<?= DateFormat(7) ?>",
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
    ew.createDateTimePicker("fjdh_patientsgrid", "x<?= $Grid->RowIndex ?>_patient_dob", jQuery.extend(true, {"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_patients_patient_dob" class="el_jdh_patients_patient_dob">
<span<?= $Grid->patient_dob->viewAttributes() ?>>
<?= $Grid->patient_dob->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_patients" data-field="x_patient_dob" data-hidden="1" name="fjdh_patientsgrid$x<?= $Grid->RowIndex ?>_patient_dob" id="fjdh_patientsgrid$x<?= $Grid->RowIndex ?>_patient_dob" value="<?= HtmlEncode($Grid->patient_dob->FormValue) ?>">
<input type="hidden" data-table="jdh_patients" data-field="x_patient_dob" data-hidden="1" data-old name="fjdh_patientsgrid$o<?= $Grid->RowIndex ?>_patient_dob" id="fjdh_patientsgrid$o<?= $Grid->RowIndex ?>_patient_dob" value="<?= HtmlEncode($Grid->patient_dob->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->patient_age->Visible) { // patient_age ?>
        <td data-name="patient_age"<?= $Grid->patient_age->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_patients_patient_age" class="el_jdh_patients_patient_age">
<input type="<?= $Grid->patient_age->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_patient_age" id="x<?= $Grid->RowIndex ?>_patient_age" data-table="jdh_patients" data-field="x_patient_age" value="<?= $Grid->patient_age->EditValue ?>" size="10" placeholder="<?= HtmlEncode($Grid->patient_age->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->patient_age->formatPattern()) ?>"<?= $Grid->patient_age->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->patient_age->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="jdh_patients" data-field="x_patient_age" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_patient_age" id="o<?= $Grid->RowIndex ?>_patient_age" value="<?= HtmlEncode($Grid->patient_age->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_patients_patient_age" class="el_jdh_patients_patient_age">
<span<?= $Grid->patient_age->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->patient_age->getDisplayValue($Grid->patient_age->EditValue))) ?>"></span>
<input type="hidden" data-table="jdh_patients" data-field="x_patient_age" data-hidden="1" name="x<?= $Grid->RowIndex ?>_patient_age" id="x<?= $Grid->RowIndex ?>_patient_age" value="<?= HtmlEncode($Grid->patient_age->CurrentValue) ?>">
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_patients_patient_age" class="el_jdh_patients_patient_age">
<span<?= $Grid->patient_age->viewAttributes() ?>>
<?= $Grid->patient_age->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_patients" data-field="x_patient_age" data-hidden="1" name="fjdh_patientsgrid$x<?= $Grid->RowIndex ?>_patient_age" id="fjdh_patientsgrid$x<?= $Grid->RowIndex ?>_patient_age" value="<?= HtmlEncode($Grid->patient_age->FormValue) ?>">
<input type="hidden" data-table="jdh_patients" data-field="x_patient_age" data-hidden="1" data-old name="fjdh_patientsgrid$o<?= $Grid->RowIndex ?>_patient_age" id="fjdh_patientsgrid$o<?= $Grid->RowIndex ?>_patient_age" value="<?= HtmlEncode($Grid->patient_age->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->patient_gender->Visible) { // patient_gender ?>
        <td data-name="patient_gender"<?= $Grid->patient_gender->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_patients_patient_gender" class="el_jdh_patients_patient_gender">
    <select
        id="x<?= $Grid->RowIndex ?>_patient_gender"
        name="x<?= $Grid->RowIndex ?>_patient_gender"
        class="form-select ew-select<?= $Grid->patient_gender->isInvalidClass() ?>"
        data-select2-id="fjdh_patientsgrid_x<?= $Grid->RowIndex ?>_patient_gender"
        data-table="jdh_patients"
        data-field="x_patient_gender"
        data-value-separator="<?= $Grid->patient_gender->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->patient_gender->getPlaceHolder()) ?>"
        <?= $Grid->patient_gender->editAttributes() ?>>
        <?= $Grid->patient_gender->selectOptionListHtml("x{$Grid->RowIndex}_patient_gender") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->patient_gender->getErrorMessage() ?></div>
<script>
loadjs.ready("fjdh_patientsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_patient_gender", selectId: "fjdh_patientsgrid_x<?= $Grid->RowIndex ?>_patient_gender" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_patientsgrid.lists.patient_gender?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_patient_gender", form: "fjdh_patientsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_patient_gender", form: "fjdh_patientsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_patients.fields.patient_gender.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<input type="hidden" data-table="jdh_patients" data-field="x_patient_gender" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_patient_gender" id="o<?= $Grid->RowIndex ?>_patient_gender" value="<?= HtmlEncode($Grid->patient_gender->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_patients_patient_gender" class="el_jdh_patients_patient_gender">
    <select
        id="x<?= $Grid->RowIndex ?>_patient_gender"
        name="x<?= $Grid->RowIndex ?>_patient_gender"
        class="form-select ew-select<?= $Grid->patient_gender->isInvalidClass() ?>"
        data-select2-id="fjdh_patientsgrid_x<?= $Grid->RowIndex ?>_patient_gender"
        data-table="jdh_patients"
        data-field="x_patient_gender"
        data-value-separator="<?= $Grid->patient_gender->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->patient_gender->getPlaceHolder()) ?>"
        <?= $Grid->patient_gender->editAttributes() ?>>
        <?= $Grid->patient_gender->selectOptionListHtml("x{$Grid->RowIndex}_patient_gender") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->patient_gender->getErrorMessage() ?></div>
<script>
loadjs.ready("fjdh_patientsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_patient_gender", selectId: "fjdh_patientsgrid_x<?= $Grid->RowIndex ?>_patient_gender" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_patientsgrid.lists.patient_gender?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_patient_gender", form: "fjdh_patientsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_patient_gender", form: "fjdh_patientsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_patients.fields.patient_gender.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_patients_patient_gender" class="el_jdh_patients_patient_gender">
<span<?= $Grid->patient_gender->viewAttributes() ?>>
<?= $Grid->patient_gender->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_patients" data-field="x_patient_gender" data-hidden="1" name="fjdh_patientsgrid$x<?= $Grid->RowIndex ?>_patient_gender" id="fjdh_patientsgrid$x<?= $Grid->RowIndex ?>_patient_gender" value="<?= HtmlEncode($Grid->patient_gender->FormValue) ?>">
<input type="hidden" data-table="jdh_patients" data-field="x_patient_gender" data-hidden="1" data-old name="fjdh_patientsgrid$o<?= $Grid->RowIndex ?>_patient_gender" id="fjdh_patientsgrid$o<?= $Grid->RowIndex ?>_patient_gender" value="<?= HtmlEncode($Grid->patient_gender->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->patient_phone->Visible) { // patient_phone ?>
        <td data-name="patient_phone"<?= $Grid->patient_phone->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_patients_patient_phone" class="el_jdh_patients_patient_phone">
<input type="<?= $Grid->patient_phone->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_patient_phone" id="x<?= $Grid->RowIndex ?>_patient_phone" data-table="jdh_patients" data-field="x_patient_phone" value="<?= $Grid->patient_phone->EditValue ?>" size="30" maxlength="15" placeholder="<?= HtmlEncode($Grid->patient_phone->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->patient_phone->formatPattern()) ?>"<?= $Grid->patient_phone->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->patient_phone->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="jdh_patients" data-field="x_patient_phone" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_patient_phone" id="o<?= $Grid->RowIndex ?>_patient_phone" value="<?= HtmlEncode($Grid->patient_phone->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_patients_patient_phone" class="el_jdh_patients_patient_phone">
<input type="<?= $Grid->patient_phone->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_patient_phone" id="x<?= $Grid->RowIndex ?>_patient_phone" data-table="jdh_patients" data-field="x_patient_phone" value="<?= $Grid->patient_phone->EditValue ?>" size="30" maxlength="15" placeholder="<?= HtmlEncode($Grid->patient_phone->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->patient_phone->formatPattern()) ?>"<?= $Grid->patient_phone->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->patient_phone->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_patients_patient_phone" class="el_jdh_patients_patient_phone">
<span<?= $Grid->patient_phone->viewAttributes() ?>>
<?= $Grid->patient_phone->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_patients" data-field="x_patient_phone" data-hidden="1" name="fjdh_patientsgrid$x<?= $Grid->RowIndex ?>_patient_phone" id="fjdh_patientsgrid$x<?= $Grid->RowIndex ?>_patient_phone" value="<?= HtmlEncode($Grid->patient_phone->FormValue) ?>">
<input type="hidden" data-table="jdh_patients" data-field="x_patient_phone" data-hidden="1" data-old name="fjdh_patientsgrid$o<?= $Grid->RowIndex ?>_patient_phone" id="fjdh_patientsgrid$o<?= $Grid->RowIndex ?>_patient_phone" value="<?= HtmlEncode($Grid->patient_phone->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->patient_registration_date->Visible) { // patient_registration_date ?>
        <td data-name="patient_registration_date"<?= $Grid->patient_registration_date->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_patients_patient_registration_date" class="el_jdh_patients_patient_registration_date">
<input type="<?= $Grid->patient_registration_date->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_patient_registration_date" id="x<?= $Grid->RowIndex ?>_patient_registration_date" data-table="jdh_patients" data-field="x_patient_registration_date" value="<?= $Grid->patient_registration_date->EditValue ?>" placeholder="<?= HtmlEncode($Grid->patient_registration_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->patient_registration_date->formatPattern()) ?>"<?= $Grid->patient_registration_date->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->patient_registration_date->getErrorMessage() ?></div>
<?php if (!$Grid->patient_registration_date->ReadOnly && !$Grid->patient_registration_date->Disabled && !isset($Grid->patient_registration_date->EditAttrs["readonly"]) && !isset($Grid->patient_registration_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjdh_patientsgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fjdh_patientsgrid", "x<?= $Grid->RowIndex ?>_patient_registration_date", jQuery.extend(true, {"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="jdh_patients" data-field="x_patient_registration_date" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_patient_registration_date" id="o<?= $Grid->RowIndex ?>_patient_registration_date" value="<?= HtmlEncode($Grid->patient_registration_date->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_patients_patient_registration_date" class="el_jdh_patients_patient_registration_date">
<input type="<?= $Grid->patient_registration_date->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_patient_registration_date" id="x<?= $Grid->RowIndex ?>_patient_registration_date" data-table="jdh_patients" data-field="x_patient_registration_date" value="<?= $Grid->patient_registration_date->EditValue ?>" placeholder="<?= HtmlEncode($Grid->patient_registration_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->patient_registration_date->formatPattern()) ?>"<?= $Grid->patient_registration_date->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->patient_registration_date->getErrorMessage() ?></div>
<?php if (!$Grid->patient_registration_date->ReadOnly && !$Grid->patient_registration_date->Disabled && !isset($Grid->patient_registration_date->EditAttrs["readonly"]) && !isset($Grid->patient_registration_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjdh_patientsgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fjdh_patientsgrid", "x<?= $Grid->RowIndex ?>_patient_registration_date", jQuery.extend(true, {"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_patients_patient_registration_date" class="el_jdh_patients_patient_registration_date">
<span<?= $Grid->patient_registration_date->viewAttributes() ?>>
<?= $Grid->patient_registration_date->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_patients" data-field="x_patient_registration_date" data-hidden="1" name="fjdh_patientsgrid$x<?= $Grid->RowIndex ?>_patient_registration_date" id="fjdh_patientsgrid$x<?= $Grid->RowIndex ?>_patient_registration_date" value="<?= HtmlEncode($Grid->patient_registration_date->FormValue) ?>">
<input type="hidden" data-table="jdh_patients" data-field="x_patient_registration_date" data-hidden="1" data-old name="fjdh_patientsgrid$o<?= $Grid->RowIndex ?>_patient_registration_date" id="fjdh_patientsgrid$o<?= $Grid->RowIndex ?>_patient_registration_date" value="<?= HtmlEncode($Grid->patient_registration_date->OldValue) ?>">
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
loadjs.ready(["fjdh_patientsgrid","load"], () => fjdh_patientsgrid.updateLists(<?= $Grid->RowIndex ?><?= $Grid->RowIndex === '$rowindex$' ? ", true" : "" ?>));
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
<input type="hidden" name="detailpage" value="fjdh_patientsgrid">
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
    ew.addEventHandlers("jdh_patients");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
