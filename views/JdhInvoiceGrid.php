<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Set up and run Grid object
$Grid = Container("JdhInvoiceGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fjdh_invoicegrid;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { jdh_invoice: currentTable } });
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_invoicegrid")
        .setPageId("grid")
        .setFormKeyCountName("<?= $Grid->FormKeyCountName ?>")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["patient_id", [fields.patient_id.visible && fields.patient_id.required ? ew.Validators.required(fields.patient_id.caption) : null], fields.patient_id.isInvalid],
            ["invoice_title", [fields.invoice_title.visible && fields.invoice_title.required ? ew.Validators.required(fields.invoice_title.caption) : null], fields.invoice_title.isInvalid],
            ["invoice_date", [fields.invoice_date.visible && fields.invoice_date.required ? ew.Validators.required(fields.invoice_date.caption) : null, ew.Validators.datetime(fields.invoice_date.clientFormatPattern)], fields.invoice_date.isInvalid]
        ])

        // Check empty row
        .setEmptyRow(
            function (rowIndex) {
                let fobj = this.getForm(),
                    fields = [["patient_id",false],["invoice_title",false],["invoice_date",false]];
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
<div id="fjdh_invoicegrid" class="ew-form ew-list-form">
<div id="gmp_jdh_invoice" class="card-body ew-grid-middle-panel <?= $Grid->TableContainerClass ?>" style="<?= $Grid->TableContainerStyle ?>">
<table id="tbl_jdh_invoicegrid" class="<?= $Grid->TableClass ?>"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Grid->id->headerCellClass() ?>"><div id="elh_jdh_invoice_id" class="jdh_invoice_id"><?= $Grid->renderFieldHeader($Grid->id) ?></div></th>
<?php } ?>
<?php if ($Grid->patient_id->Visible) { // patient_id ?>
        <th data-name="patient_id" class="<?= $Grid->patient_id->headerCellClass() ?>"><div id="elh_jdh_invoice_patient_id" class="jdh_invoice_patient_id"><?= $Grid->renderFieldHeader($Grid->patient_id) ?></div></th>
<?php } ?>
<?php if ($Grid->invoice_title->Visible) { // invoice_title ?>
        <th data-name="invoice_title" class="<?= $Grid->invoice_title->headerCellClass() ?>"><div id="elh_jdh_invoice_invoice_title" class="jdh_invoice_invoice_title"><?= $Grid->renderFieldHeader($Grid->invoice_title) ?></div></th>
<?php } ?>
<?php if ($Grid->invoice_date->Visible) { // invoice_date ?>
        <th data-name="invoice_date" class="<?= $Grid->invoice_date->headerCellClass() ?>"><div id="elh_jdh_invoice_invoice_date" class="jdh_invoice_invoice_date"><?= $Grid->renderFieldHeader($Grid->invoice_date) ?></div></th>
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
<span id="el<?= $Grid->RowCount ?>_jdh_invoice_id" class="el_jdh_invoice_id"></span>
<input type="hidden" data-table="jdh_invoice" data-field="x_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_id" id="o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_invoice_id" class="el_jdh_invoice_id">
<span<?= $Grid->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->id->getDisplayValue($Grid->id->EditValue))) ?>"></span>
<input type="hidden" data-table="jdh_invoice" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->CurrentValue) ?>">
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_invoice_id" class="el_jdh_invoice_id">
<span<?= $Grid->id->viewAttributes() ?>>
<?= $Grid->id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_invoice" data-field="x_id" data-hidden="1" name="fjdh_invoicegrid$x<?= $Grid->RowIndex ?>_id" id="fjdh_invoicegrid$x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->FormValue) ?>">
<input type="hidden" data-table="jdh_invoice" data-field="x_id" data-hidden="1" data-old name="fjdh_invoicegrid$o<?= $Grid->RowIndex ?>_id" id="fjdh_invoicegrid$o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="jdh_invoice" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Grid->patient_id->Visible) { // patient_id ?>
        <td data-name="patient_id"<?= $Grid->patient_id->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($Grid->patient_id->getSessionValue() != "") { ?>
<span<?= $Grid->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->patient_id->getDisplayValue($Grid->patient_id->ViewValue) ?></span></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_patient_id" name="x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_jdh_invoice_patient_id" class="el_jdh_invoice_patient_id">
    <select
        id="x<?= $Grid->RowIndex ?>_patient_id"
        name="x<?= $Grid->RowIndex ?>_patient_id"
        class="form-select ew-select<?= $Grid->patient_id->isInvalidClass() ?>"
        data-select2-id="fjdh_invoicegrid_x<?= $Grid->RowIndex ?>_patient_id"
        data-table="jdh_invoice"
        data-field="x_patient_id"
        data-value-separator="<?= $Grid->patient_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->patient_id->getPlaceHolder()) ?>"
        <?= $Grid->patient_id->editAttributes() ?>>
        <?= $Grid->patient_id->selectOptionListHtml("x{$Grid->RowIndex}_patient_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->patient_id->getErrorMessage() ?></div>
<?= $Grid->patient_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_patient_id") ?>
<script>
loadjs.ready("fjdh_invoicegrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_patient_id", selectId: "fjdh_invoicegrid_x<?= $Grid->RowIndex ?>_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_invoicegrid.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fjdh_invoicegrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fjdh_invoicegrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_invoice.fields.patient_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<input type="hidden" data-table="jdh_invoice" data-field="x_patient_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_patient_id" id="o<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($Grid->patient_id->getSessionValue() != "") { ?>
<span<?= $Grid->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->patient_id->getDisplayValue($Grid->patient_id->ViewValue) ?></span></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_patient_id" name="x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_jdh_invoice_patient_id" class="el_jdh_invoice_patient_id">
    <select
        id="x<?= $Grid->RowIndex ?>_patient_id"
        name="x<?= $Grid->RowIndex ?>_patient_id"
        class="form-select ew-select<?= $Grid->patient_id->isInvalidClass() ?>"
        data-select2-id="fjdh_invoicegrid_x<?= $Grid->RowIndex ?>_patient_id"
        data-table="jdh_invoice"
        data-field="x_patient_id"
        data-value-separator="<?= $Grid->patient_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->patient_id->getPlaceHolder()) ?>"
        <?= $Grid->patient_id->editAttributes() ?>>
        <?= $Grid->patient_id->selectOptionListHtml("x{$Grid->RowIndex}_patient_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->patient_id->getErrorMessage() ?></div>
<?= $Grid->patient_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_patient_id") ?>
<script>
loadjs.ready("fjdh_invoicegrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_patient_id", selectId: "fjdh_invoicegrid_x<?= $Grid->RowIndex ?>_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_invoicegrid.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fjdh_invoicegrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fjdh_invoicegrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_invoice.fields.patient_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_invoice_patient_id" class="el_jdh_invoice_patient_id">
<span<?= $Grid->patient_id->viewAttributes() ?>>
<?= $Grid->patient_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_invoice" data-field="x_patient_id" data-hidden="1" name="fjdh_invoicegrid$x<?= $Grid->RowIndex ?>_patient_id" id="fjdh_invoicegrid$x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->FormValue) ?>">
<input type="hidden" data-table="jdh_invoice" data-field="x_patient_id" data-hidden="1" data-old name="fjdh_invoicegrid$o<?= $Grid->RowIndex ?>_patient_id" id="fjdh_invoicegrid$o<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->invoice_title->Visible) { // invoice_title ?>
        <td data-name="invoice_title"<?= $Grid->invoice_title->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_invoice_invoice_title" class="el_jdh_invoice_invoice_title">
<input type="<?= $Grid->invoice_title->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_invoice_title" id="x<?= $Grid->RowIndex ?>_invoice_title" data-table="jdh_invoice" data-field="x_invoice_title" value="<?= $Grid->invoice_title->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->invoice_title->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->invoice_title->formatPattern()) ?>"<?= $Grid->invoice_title->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->invoice_title->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="jdh_invoice" data-field="x_invoice_title" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_invoice_title" id="o<?= $Grid->RowIndex ?>_invoice_title" value="<?= HtmlEncode($Grid->invoice_title->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_invoice_invoice_title" class="el_jdh_invoice_invoice_title">
<input type="<?= $Grid->invoice_title->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_invoice_title" id="x<?= $Grid->RowIndex ?>_invoice_title" data-table="jdh_invoice" data-field="x_invoice_title" value="<?= $Grid->invoice_title->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->invoice_title->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->invoice_title->formatPattern()) ?>"<?= $Grid->invoice_title->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->invoice_title->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_invoice_invoice_title" class="el_jdh_invoice_invoice_title">
<span<?= $Grid->invoice_title->viewAttributes() ?>>
<?= $Grid->invoice_title->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_invoice" data-field="x_invoice_title" data-hidden="1" name="fjdh_invoicegrid$x<?= $Grid->RowIndex ?>_invoice_title" id="fjdh_invoicegrid$x<?= $Grid->RowIndex ?>_invoice_title" value="<?= HtmlEncode($Grid->invoice_title->FormValue) ?>">
<input type="hidden" data-table="jdh_invoice" data-field="x_invoice_title" data-hidden="1" data-old name="fjdh_invoicegrid$o<?= $Grid->RowIndex ?>_invoice_title" id="fjdh_invoicegrid$o<?= $Grid->RowIndex ?>_invoice_title" value="<?= HtmlEncode($Grid->invoice_title->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->invoice_date->Visible) { // invoice_date ?>
        <td data-name="invoice_date"<?= $Grid->invoice_date->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_invoice_invoice_date" class="el_jdh_invoice_invoice_date">
<input type="<?= $Grid->invoice_date->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_invoice_date" id="x<?= $Grid->RowIndex ?>_invoice_date" data-table="jdh_invoice" data-field="x_invoice_date" value="<?= $Grid->invoice_date->EditValue ?>" placeholder="<?= HtmlEncode($Grid->invoice_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->invoice_date->formatPattern()) ?>"<?= $Grid->invoice_date->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->invoice_date->getErrorMessage() ?></div>
<?php if (!$Grid->invoice_date->ReadOnly && !$Grid->invoice_date->Disabled && !isset($Grid->invoice_date->EditAttrs["readonly"]) && !isset($Grid->invoice_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjdh_invoicegrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fjdh_invoicegrid", "x<?= $Grid->RowIndex ?>_invoice_date", jQuery.extend(true, {"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="jdh_invoice" data-field="x_invoice_date" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_invoice_date" id="o<?= $Grid->RowIndex ?>_invoice_date" value="<?= HtmlEncode($Grid->invoice_date->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_invoice_invoice_date" class="el_jdh_invoice_invoice_date">
<input type="<?= $Grid->invoice_date->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_invoice_date" id="x<?= $Grid->RowIndex ?>_invoice_date" data-table="jdh_invoice" data-field="x_invoice_date" value="<?= $Grid->invoice_date->EditValue ?>" placeholder="<?= HtmlEncode($Grid->invoice_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->invoice_date->formatPattern()) ?>"<?= $Grid->invoice_date->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->invoice_date->getErrorMessage() ?></div>
<?php if (!$Grid->invoice_date->ReadOnly && !$Grid->invoice_date->Disabled && !isset($Grid->invoice_date->EditAttrs["readonly"]) && !isset($Grid->invoice_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjdh_invoicegrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fjdh_invoicegrid", "x<?= $Grid->RowIndex ?>_invoice_date", jQuery.extend(true, {"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_invoice_invoice_date" class="el_jdh_invoice_invoice_date">
<span<?= $Grid->invoice_date->viewAttributes() ?>>
<?= $Grid->invoice_date->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_invoice" data-field="x_invoice_date" data-hidden="1" name="fjdh_invoicegrid$x<?= $Grid->RowIndex ?>_invoice_date" id="fjdh_invoicegrid$x<?= $Grid->RowIndex ?>_invoice_date" value="<?= HtmlEncode($Grid->invoice_date->FormValue) ?>">
<input type="hidden" data-table="jdh_invoice" data-field="x_invoice_date" data-hidden="1" data-old name="fjdh_invoicegrid$o<?= $Grid->RowIndex ?>_invoice_date" id="fjdh_invoicegrid$o<?= $Grid->RowIndex ?>_invoice_date" value="<?= HtmlEncode($Grid->invoice_date->OldValue) ?>">
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
loadjs.ready(["fjdh_invoicegrid","load"], () => fjdh_invoicegrid.updateLists(<?= $Grid->RowIndex ?><?= $Grid->RowIndex === '$rowindex$' ? ", true" : "" ?>));
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
<input type="hidden" name="detailpage" value="fjdh_invoicegrid">
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
    ew.addEventHandlers("jdh_invoice");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
