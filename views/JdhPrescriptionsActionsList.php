<?php

namespace PHPMaker2024\jootidigitalhealthcare;

// Page object
$JdhPrescriptionsActionsList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_prescriptions_actions: currentTable } });
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
            ["medicine_id", [fields.medicine_id.visible && fields.medicine_id.required ? ew.Validators.required(fields.medicine_id.caption) : null], fields.medicine_id.isInvalid],
            ["patient_id", [fields.patient_id.visible && fields.patient_id.required ? ew.Validators.required(fields.patient_id.caption) : null], fields.patient_id.isInvalid],
            ["units_given", [fields.units_given.visible && fields.units_given.required ? ew.Validators.required(fields.units_given.caption) : null, ew.Validators.integer], fields.units_given.isInvalid],
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
            "medicine_id": <?= $Page->medicine_id->toClientList($Page) ?>,
            "patient_id": <?= $Page->patient_id->toClientList($Page) ?>,
        })
        .build();
    window[form.id] = form;
    currentForm = form;
    loadjs.done(form.id);
});
</script>
<script>
window.Tabulator || loadjs([
    ew.PATH_BASE + "js/tabulator.min.js?v=24.4.0",
    ew.PATH_BASE + "css/<?= CssFile("tabulator_bootstrap5.css", false) ?>?v=24.4.0"
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
<?php if (!$Page->IsModal) { ?>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="list<?= ($Page->TotalRecords == 0 && !$Page->isAdd()) ? " ew-no-record" : "" ?>">
<div id="ew-header-options">
<?php $Page->HeaderOptions?->render("body") ?>
</div>
<div id="ew-list">
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?= $Page->isAddOrEdit() ? " ew-grid-add-edit" : "" ?> <?= $Page->TableGridClass ?>">
<form name="<?= $Page->FormName ?>" id="<?= $Page->FormName ?>" class="ew-form ew-list-form" action="<?= $Page->PageAction ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jdh_prescriptions_actions">
<?php if ($Page->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<?php if ($Page->getCurrentMasterTable() == "jdh_patients" && $Page->CurrentAction) { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="jdh_patients">
<input type="hidden" name="fk_patient_id" value="<?= HtmlEncode($Page->patient_id->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_jdh_prescriptions_actions" class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>" style="<?= $Page->TableContainerStyle ?>">
<?php if ($Page->TotalRecords > 0 || $Page->isAdd() || $Page->isCopy() || $Page->isGridEdit() || $Page->isMultiEdit()) { ?>
<table id="tbl_jdh_prescriptions_actionslist" class="<?= $Page->TableClass ?>"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Page->RowType = RowType::HEADER;

// Render list options
$Page->renderListOptions();

// Render list options (header, left)
$Page->ListOptions->render("header", "left");
?>
<?php if ($Page->medicine_id->Visible) { // medicine_id ?>
        <th data-name="medicine_id" class="<?= $Page->medicine_id->headerCellClass() ?>"><div id="elh_jdh_prescriptions_actions_medicine_id" class="jdh_prescriptions_actions_medicine_id"><?= $Page->renderFieldHeader($Page->medicine_id) ?></div></th>
<?php } ?>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
        <th data-name="patient_id" class="<?= $Page->patient_id->headerCellClass() ?>"><div id="elh_jdh_prescriptions_actions_patient_id" class="jdh_prescriptions_actions_patient_id"><?= $Page->renderFieldHeader($Page->patient_id) ?></div></th>
<?php } ?>
<?php if ($Page->units_given->Visible) { // units_given ?>
        <th data-name="units_given" class="<?= $Page->units_given->headerCellClass() ?>"><div id="elh_jdh_prescriptions_actions_units_given" class="jdh_prescriptions_actions_units_given"><?= $Page->renderFieldHeader($Page->units_given) ?></div></th>
<?php } ?>
<?php if ($Page->submission_date->Visible) { // submission_date ?>
        <th data-name="submission_date" class="<?= $Page->submission_date->headerCellClass() ?>"><div id="elh_jdh_prescriptions_actions_submission_date" class="jdh_prescriptions_actions_submission_date"><?= $Page->renderFieldHeader($Page->submission_date) ?></div></th>
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
while ($Page->RecordCount < $Page->StopRecord || $Page->RowIndex === '$rowindex$') {
    if (
        $Page->CurrentRow !== false &&
        $Page->RowIndex !== '$rowindex$' &&
        (!$Page->isGridAdd() || $Page->CurrentMode == "copy") &&
        (!(($Page->isCopy() || $Page->isAdd()) && $Page->RowIndex == 0))
    ) {
        $Page->fetch();
    }
    $Page->RecordCount++;
    if ($Page->RecordCount >= $Page->StartRecord) {
        $Page->setupRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowCount);
?>
    <?php if ($Page->medicine_id->Visible) { // medicine_id ?>
        <td data-name="medicine_id"<?= $Page->medicine_id->cellAttributes() ?>>
<?php if ($Page->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_jdh_prescriptions_actions_medicine_id" class="el_jdh_prescriptions_actions_medicine_id">
    <select
        id="x<?= $Page->RowIndex ?>_medicine_id"
        name="x<?= $Page->RowIndex ?>_medicine_id"
        class="form-select ew-select<?= $Page->medicine_id->isInvalidClass() ?>"
        <?php if (!$Page->medicine_id->IsNativeSelect) { ?>
        data-select2-id="<?= $Page->FormName ?>_x<?= $Page->RowIndex ?>_medicine_id"
        <?php } ?>
        data-table="jdh_prescriptions_actions"
        data-field="x_medicine_id"
        data-value-separator="<?= $Page->medicine_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->medicine_id->getPlaceHolder()) ?>"
        <?= $Page->medicine_id->editAttributes() ?>>
        <?= $Page->medicine_id->selectOptionListHtml("x{$Page->RowIndex}_medicine_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->medicine_id->getErrorMessage() ?></div>
<?= $Page->medicine_id->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_medicine_id") ?>
<?php if (!$Page->medicine_id->IsNativeSelect) { ?>
<script>
loadjs.ready("<?= $Page->FormName ?>", function() {
    var options = { name: "x<?= $Page->RowIndex ?>_medicine_id", selectId: "<?= $Page->FormName ?>_x<?= $Page->RowIndex ?>_medicine_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (<?= $Page->FormName ?>.lists.medicine_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Page->RowIndex ?>_medicine_id", form: "<?= $Page->FormName ?>" };
    } else {
        options.ajax = { id: "x<?= $Page->RowIndex ?>_medicine_id", form: "<?= $Page->FormName ?>", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_prescriptions_actions.fields.medicine_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="jdh_prescriptions_actions" data-field="x_medicine_id" data-hidden="1" data-old name="o<?= $Page->RowIndex ?>_medicine_id" id="o<?= $Page->RowIndex ?>_medicine_id" value="<?= HtmlEncode($Page->medicine_id->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_jdh_prescriptions_actions_medicine_id" class="el_jdh_prescriptions_actions_medicine_id">
<span<?= $Page->medicine_id->viewAttributes() ?>>
<?= $Page->medicine_id->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->patient_id->Visible) { // patient_id ?>
        <td data-name="patient_id"<?= $Page->patient_id->cellAttributes() ?>>
<?php if ($Page->RowType == RowType::ADD) { // Add record ?>
<?php if ($Page->patient_id->getSessionValue() != "") { ?>
<span<?= $Page->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->patient_id->getDisplayValue($Page->patient_id->ViewValue) ?></span></span>
<input type="hidden" id="x<?= $Page->RowIndex ?>_patient_id" name="x<?= $Page->RowIndex ?>_patient_id" value="<?= HtmlEncode($Page->patient_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_jdh_prescriptions_actions_patient_id" class="el_jdh_prescriptions_actions_patient_id">
    <select
        id="x<?= $Page->RowIndex ?>_patient_id"
        name="x<?= $Page->RowIndex ?>_patient_id"
        class="form-select ew-select<?= $Page->patient_id->isInvalidClass() ?>"
        <?php if (!$Page->patient_id->IsNativeSelect) { ?>
        data-select2-id="<?= $Page->FormName ?>_x<?= $Page->RowIndex ?>_patient_id"
        <?php } ?>
        data-table="jdh_prescriptions_actions"
        data-field="x_patient_id"
        data-value-separator="<?= $Page->patient_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->patient_id->getPlaceHolder()) ?>"
        <?= $Page->patient_id->editAttributes() ?>>
        <?= $Page->patient_id->selectOptionListHtml("x{$Page->RowIndex}_patient_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->patient_id->getErrorMessage() ?></div>
<?= $Page->patient_id->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_patient_id") ?>
<?php if (!$Page->patient_id->IsNativeSelect) { ?>
<script>
loadjs.ready("<?= $Page->FormName ?>", function() {
    var options = { name: "x<?= $Page->RowIndex ?>_patient_id", selectId: "<?= $Page->FormName ?>_x<?= $Page->RowIndex ?>_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (<?= $Page->FormName ?>.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Page->RowIndex ?>_patient_id", form: "<?= $Page->FormName ?>" };
    } else {
        options.ajax = { id: "x<?= $Page->RowIndex ?>_patient_id", form: "<?= $Page->FormName ?>", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_prescriptions_actions.fields.patient_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<input type="hidden" data-table="jdh_prescriptions_actions" data-field="x_patient_id" data-hidden="1" data-old name="o<?= $Page->RowIndex ?>_patient_id" id="o<?= $Page->RowIndex ?>_patient_id" value="<?= HtmlEncode($Page->patient_id->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_jdh_prescriptions_actions_patient_id" class="el_jdh_prescriptions_actions_patient_id">
<span<?= $Page->patient_id->viewAttributes() ?>>
<?= $Page->patient_id->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->units_given->Visible) { // units_given ?>
        <td data-name="units_given"<?= $Page->units_given->cellAttributes() ?>>
<?php if ($Page->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_jdh_prescriptions_actions_units_given" class="el_jdh_prescriptions_actions_units_given">
<input type="<?= $Page->units_given->getInputTextType() ?>" name="x<?= $Page->RowIndex ?>_units_given" id="x<?= $Page->RowIndex ?>_units_given" data-table="jdh_prescriptions_actions" data-field="x_units_given" value="<?= $Page->units_given->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->units_given->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->units_given->formatPattern()) ?>"<?= $Page->units_given->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->units_given->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="jdh_prescriptions_actions" data-field="x_units_given" data-hidden="1" data-old name="o<?= $Page->RowIndex ?>_units_given" id="o<?= $Page->RowIndex ?>_units_given" value="<?= HtmlEncode($Page->units_given->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_jdh_prescriptions_actions_units_given" class="el_jdh_prescriptions_actions_units_given">
<span<?= $Page->units_given->viewAttributes() ?>>
<?= $Page->units_given->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->submission_date->Visible) { // submission_date ?>
        <td data-name="submission_date"<?= $Page->submission_date->cellAttributes() ?>>
<?php if ($Page->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_jdh_prescriptions_actions_submission_date" class="el_jdh_prescriptions_actions_submission_date">
<input type="<?= $Page->submission_date->getInputTextType() ?>" name="x<?= $Page->RowIndex ?>_submission_date" id="x<?= $Page->RowIndex ?>_submission_date" data-table="jdh_prescriptions_actions" data-field="x_submission_date" value="<?= $Page->submission_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->submission_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->submission_date->formatPattern()) ?>"<?= $Page->submission_date->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->submission_date->getErrorMessage() ?></div>
<?php if (!$Page->submission_date->ReadOnly && !$Page->submission_date->Disabled && !isset($Page->submission_date->EditAttrs["readonly"]) && !isset($Page->submission_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["<?= $Page->FormName ?>", "datetimepicker"], function () {
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
    ew.createDateTimePicker("<?= $Page->FormName ?>", "x<?= $Page->RowIndex ?>_submission_date", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="jdh_prescriptions_actions" data-field="x_submission_date" data-hidden="1" data-old name="o<?= $Page->RowIndex ?>_submission_date" id="o<?= $Page->RowIndex ?>_submission_date" value="<?= HtmlEncode($Page->submission_date->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_jdh_prescriptions_actions_submission_date" class="el_jdh_prescriptions_actions_submission_date">
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
<?php
    }

    // Reset for template row
    if ($Page->RowIndex === '$rowindex$') {
        $Page->RowIndex = 0;
    }
    // Reset inline add/copy row
    if (($Page->isCopy() || $Page->isAdd()) && $Page->RowIndex == 0) {
        $Page->RowIndex = 1;
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
// Close result set
$Page->Recordset?->free();
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
<div id="ew-footer-options">
<?php $Page->FooterOptions?->render("body") ?>
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
    ew.addEventHandlers("jdh_prescriptions_actions");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
