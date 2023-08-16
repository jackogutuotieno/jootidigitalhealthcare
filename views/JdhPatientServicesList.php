<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$JdhPatientServicesList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_patient_services: currentTable } });
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
            ["patient_service_id", [fields.patient_service_id.visible && fields.patient_service_id.required ? ew.Validators.required(fields.patient_service_id.caption) : null], fields.patient_service_id.isInvalid],
            ["patient_id", [fields.patient_id.visible && fields.patient_id.required ? ew.Validators.required(fields.patient_id.caption) : null, ew.Validators.integer], fields.patient_id.isInvalid],
            ["service_id", [fields.service_id.visible && fields.service_id.required ? ew.Validators.required(fields.service_id.caption) : null], fields.service_id.isInvalid],
            ["date_added", [fields.date_added.visible && fields.date_added.required ? ew.Validators.required(fields.date_added.caption) : null, ew.Validators.datetime(fields.date_added.clientFormatPattern)], fields.date_added.isInvalid]
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
            "service_id": <?= $Page->service_id->toClientList($Page) ?>,
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
</div>
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
<input type="hidden" name="t" value="jdh_patient_services">
<?php if ($Page->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<div id="gmp_jdh_patient_services" class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>" style="<?= $Page->TableContainerStyle ?>">
<?php if ($Page->TotalRecords > 0 || $Page->isAdd() || $Page->isCopy() || $Page->isGridEdit() || $Page->isMultiEdit()) { ?>
<table id="tbl_jdh_patient_serviceslist" class="<?= $Page->TableClass ?>"><!-- .ew-table -->
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
<?php if ($Page->patient_service_id->Visible) { // patient_service_id ?>
        <th data-name="patient_service_id" class="<?= $Page->patient_service_id->headerCellClass() ?>"><div id="elh_jdh_patient_services_patient_service_id" class="jdh_patient_services_patient_service_id"><?= $Page->renderFieldHeader($Page->patient_service_id) ?></div></th>
<?php } ?>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
        <th data-name="patient_id" class="<?= $Page->patient_id->headerCellClass() ?>"><div id="elh_jdh_patient_services_patient_id" class="jdh_patient_services_patient_id"><?= $Page->renderFieldHeader($Page->patient_id) ?></div></th>
<?php } ?>
<?php if ($Page->service_id->Visible) { // service_id ?>
        <th data-name="service_id" class="<?= $Page->service_id->headerCellClass() ?>"><div id="elh_jdh_patient_services_service_id" class="jdh_patient_services_service_id"><?= $Page->renderFieldHeader($Page->service_id) ?></div></th>
<?php } ?>
<?php if ($Page->date_added->Visible) { // date_added ?>
        <th data-name="date_added" class="<?= $Page->date_added->headerCellClass() ?>"><div id="elh_jdh_patient_services_date_added" class="jdh_patient_services_date_added"><?= $Page->renderFieldHeader($Page->date_added) ?></div></th>
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
    <?php if ($Page->patient_service_id->Visible) { // patient_service_id ?>
        <td data-name="patient_service_id"<?= $Page->patient_service_id->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_jdh_patient_services_patient_service_id" class="el_jdh_patient_services_patient_service_id"></span>
<input type="hidden" data-table="jdh_patient_services" data-field="x_patient_service_id" data-hidden="1" data-old name="o<?= $Page->RowIndex ?>_patient_service_id" id="o<?= $Page->RowIndex ?>_patient_service_id" value="<?= HtmlEncode($Page->patient_service_id->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_jdh_patient_services_patient_service_id" class="el_jdh_patient_services_patient_service_id">
<span<?= $Page->patient_service_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->patient_service_id->getDisplayValue($Page->patient_service_id->EditValue))) ?>"></span>
<input type="hidden" data-table="jdh_patient_services" data-field="x_patient_service_id" data-hidden="1" name="x<?= $Page->RowIndex ?>_patient_service_id" id="x<?= $Page->RowIndex ?>_patient_service_id" value="<?= HtmlEncode($Page->patient_service_id->CurrentValue) ?>">
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_jdh_patient_services_patient_service_id" class="el_jdh_patient_services_patient_service_id">
<span<?= $Page->patient_service_id->viewAttributes() ?>>
<?= $Page->patient_service_id->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="jdh_patient_services" data-field="x_patient_service_id" data-hidden="1" name="x<?= $Page->RowIndex ?>_patient_service_id" id="x<?= $Page->RowIndex ?>_patient_service_id" value="<?= HtmlEncode($Page->patient_service_id->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Page->patient_id->Visible) { // patient_id ?>
        <td data-name="patient_id"<?= $Page->patient_id->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_jdh_patient_services_patient_id" class="el_jdh_patient_services_patient_id">
<input type="<?= $Page->patient_id->getInputTextType() ?>" name="x<?= $Page->RowIndex ?>_patient_id" id="x<?= $Page->RowIndex ?>_patient_id" data-table="jdh_patient_services" data-field="x_patient_id" value="<?= $Page->patient_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->patient_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->patient_id->formatPattern()) ?>"<?= $Page->patient_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->patient_id->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="jdh_patient_services" data-field="x_patient_id" data-hidden="1" data-old name="o<?= $Page->RowIndex ?>_patient_id" id="o<?= $Page->RowIndex ?>_patient_id" value="<?= HtmlEncode($Page->patient_id->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_jdh_patient_services_patient_id" class="el_jdh_patient_services_patient_id">
<input type="<?= $Page->patient_id->getInputTextType() ?>" name="x<?= $Page->RowIndex ?>_patient_id" id="x<?= $Page->RowIndex ?>_patient_id" data-table="jdh_patient_services" data-field="x_patient_id" value="<?= $Page->patient_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->patient_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->patient_id->formatPattern()) ?>"<?= $Page->patient_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->patient_id->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_jdh_patient_services_patient_id" class="el_jdh_patient_services_patient_id">
<span<?= $Page->patient_id->viewAttributes() ?>>
<?= $Page->patient_id->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->service_id->Visible) { // service_id ?>
        <td data-name="service_id"<?= $Page->service_id->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_jdh_patient_services_service_id" class="el_jdh_patient_services_service_id">
    <select
        id="x<?= $Page->RowIndex ?>_service_id"
        name="x<?= $Page->RowIndex ?>_service_id"
        class="form-select ew-select<?= $Page->service_id->isInvalidClass() ?>"
        data-select2-id="<?= $Page->FormName ?>_x<?= $Page->RowIndex ?>_service_id"
        data-table="jdh_patient_services"
        data-field="x_service_id"
        data-value-separator="<?= $Page->service_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->service_id->getPlaceHolder()) ?>"
        <?= $Page->service_id->editAttributes() ?>>
        <?= $Page->service_id->selectOptionListHtml("x{$Page->RowIndex}_service_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->service_id->getErrorMessage() ?></div>
<?= $Page->service_id->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_service_id") ?>
<script>
loadjs.ready("<?= $Page->FormName ?>", function() {
    var options = { name: "x<?= $Page->RowIndex ?>_service_id", selectId: "<?= $Page->FormName ?>_x<?= $Page->RowIndex ?>_service_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (<?= $Page->FormName ?>.lists.service_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Page->RowIndex ?>_service_id", form: "<?= $Page->FormName ?>" };
    } else {
        options.ajax = { id: "x<?= $Page->RowIndex ?>_service_id", form: "<?= $Page->FormName ?>", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_patient_services.fields.service_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<input type="hidden" data-table="jdh_patient_services" data-field="x_service_id" data-hidden="1" data-old name="o<?= $Page->RowIndex ?>_service_id" id="o<?= $Page->RowIndex ?>_service_id" value="<?= HtmlEncode($Page->service_id->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_jdh_patient_services_service_id" class="el_jdh_patient_services_service_id">
    <select
        id="x<?= $Page->RowIndex ?>_service_id"
        name="x<?= $Page->RowIndex ?>_service_id"
        class="form-select ew-select<?= $Page->service_id->isInvalidClass() ?>"
        data-select2-id="<?= $Page->FormName ?>_x<?= $Page->RowIndex ?>_service_id"
        data-table="jdh_patient_services"
        data-field="x_service_id"
        data-value-separator="<?= $Page->service_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->service_id->getPlaceHolder()) ?>"
        <?= $Page->service_id->editAttributes() ?>>
        <?= $Page->service_id->selectOptionListHtml("x{$Page->RowIndex}_service_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->service_id->getErrorMessage() ?></div>
<?= $Page->service_id->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_service_id") ?>
<script>
loadjs.ready("<?= $Page->FormName ?>", function() {
    var options = { name: "x<?= $Page->RowIndex ?>_service_id", selectId: "<?= $Page->FormName ?>_x<?= $Page->RowIndex ?>_service_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (<?= $Page->FormName ?>.lists.service_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Page->RowIndex ?>_service_id", form: "<?= $Page->FormName ?>" };
    } else {
        options.ajax = { id: "x<?= $Page->RowIndex ?>_service_id", form: "<?= $Page->FormName ?>", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_patient_services.fields.service_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_jdh_patient_services_service_id" class="el_jdh_patient_services_service_id">
<span<?= $Page->service_id->viewAttributes() ?>>
<?= $Page->service_id->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->date_added->Visible) { // date_added ?>
        <td data-name="date_added"<?= $Page->date_added->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_jdh_patient_services_date_added" class="el_jdh_patient_services_date_added">
<input type="<?= $Page->date_added->getInputTextType() ?>" name="x<?= $Page->RowIndex ?>_date_added" id="x<?= $Page->RowIndex ?>_date_added" data-table="jdh_patient_services" data-field="x_date_added" value="<?= $Page->date_added->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_added->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->date_added->formatPattern()) ?>"<?= $Page->date_added->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->date_added->getErrorMessage() ?></div>
<?php if (!$Page->date_added->ReadOnly && !$Page->date_added->Disabled && !isset($Page->date_added->EditAttrs["readonly"]) && !isset($Page->date_added->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["<?= $Page->FormName ?>", "datetimepicker"], function () {
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
    ew.createDateTimePicker("<?= $Page->FormName ?>", "x<?= $Page->RowIndex ?>_date_added", jQuery.extend(true, {"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="jdh_patient_services" data-field="x_date_added" data-hidden="1" data-old name="o<?= $Page->RowIndex ?>_date_added" id="o<?= $Page->RowIndex ?>_date_added" value="<?= HtmlEncode($Page->date_added->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_jdh_patient_services_date_added" class="el_jdh_patient_services_date_added">
<input type="<?= $Page->date_added->getInputTextType() ?>" name="x<?= $Page->RowIndex ?>_date_added" id="x<?= $Page->RowIndex ?>_date_added" data-table="jdh_patient_services" data-field="x_date_added" value="<?= $Page->date_added->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_added->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->date_added->formatPattern()) ?>"<?= $Page->date_added->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->date_added->getErrorMessage() ?></div>
<?php if (!$Page->date_added->ReadOnly && !$Page->date_added->Disabled && !isset($Page->date_added->EditAttrs["readonly"]) && !isset($Page->date_added->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["<?= $Page->FormName ?>", "datetimepicker"], function () {
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
    ew.createDateTimePicker("<?= $Page->FormName ?>", "x<?= $Page->RowIndex ?>_date_added", jQuery.extend(true, {"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_jdh_patient_services_date_added" class="el_jdh_patient_services_date_added">
<span<?= $Page->date_added->viewAttributes() ?>>
<?= $Page->date_added->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowCount);
?>
    </tr>
<?php if ($Page->RowType == ROWTYPE_ADD || $Page->RowType == ROWTYPE_EDIT) { ?>
<script data-rowindex="<?= $Page->RowIndex ?>">
loadjs.ready(["<?= $Page->FormName ?>","load"], () => <?= $Page->FormName ?>.updateLists(<?= $Page->RowIndex ?><?= $Page->RowIndex === '$rowindex$' ? ", true" : "" ?>));
</script>
<?php } ?>
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
<?php if ($Page->isEdit()) { ?>
<input type="hidden" name="<?= $Page->FormKeyCountName ?>" id="<?= $Page->FormKeyCountName ?>" value="<?= $Page->KeyCount ?>">
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
    ew.addEventHandlers("jdh_patient_services");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
