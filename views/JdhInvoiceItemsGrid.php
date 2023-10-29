<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Set up and run Grid object
$Grid = Container("JdhInvoiceItemsGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fjdh_invoice_itemsgrid;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { jdh_invoice_items: currentTable } });
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_invoice_itemsgrid")
        .setPageId("grid")
        .setFormKeyCountName("<?= $Grid->FormKeyCountName ?>")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["invoice_item", [fields.invoice_item.visible && fields.invoice_item.required ? ew.Validators.required(fields.invoice_item.caption) : null], fields.invoice_item.isInvalid],
            ["total_amount", [fields.total_amount.visible && fields.total_amount.required ? ew.Validators.required(fields.total_amount.caption) : null, ew.Validators.integer], fields.total_amount.isInvalid],
            ["submission_date", [fields.submission_date.visible && fields.submission_date.required ? ew.Validators.required(fields.submission_date.caption) : null, ew.Validators.datetime(fields.submission_date.clientFormatPattern)], fields.submission_date.isInvalid]
        ])

        // Check empty row
        .setEmptyRow(
            function (rowIndex) {
                let fobj = this.getForm(),
                    fields = [["invoice_item",false],["total_amount",false],["submission_date",false]];
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
<div id="fjdh_invoice_itemsgrid" class="ew-form ew-list-form">
<div id="gmp_jdh_invoice_items" class="card-body ew-grid-middle-panel <?= $Grid->TableContainerClass ?>" style="<?= $Grid->TableContainerStyle ?>">
<table id="tbl_jdh_invoice_itemsgrid" class="<?= $Grid->TableClass ?>"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Grid->id->headerCellClass() ?>"><div id="elh_jdh_invoice_items_id" class="jdh_invoice_items_id"><?= $Grid->renderFieldHeader($Grid->id) ?></div></th>
<?php } ?>
<?php if ($Grid->invoice_item->Visible) { // invoice_item ?>
        <th data-name="invoice_item" class="<?= $Grid->invoice_item->headerCellClass() ?>"><div id="elh_jdh_invoice_items_invoice_item" class="jdh_invoice_items_invoice_item"><?= $Grid->renderFieldHeader($Grid->invoice_item) ?></div></th>
<?php } ?>
<?php if ($Grid->total_amount->Visible) { // total_amount ?>
        <th data-name="total_amount" class="<?= $Grid->total_amount->headerCellClass() ?>"><div id="elh_jdh_invoice_items_total_amount" class="jdh_invoice_items_total_amount"><?= $Grid->renderFieldHeader($Grid->total_amount) ?></div></th>
<?php } ?>
<?php if ($Grid->submission_date->Visible) { // submission_date ?>
        <th data-name="submission_date" class="<?= $Grid->submission_date->headerCellClass() ?>"><div id="elh_jdh_invoice_items_submission_date" class="jdh_invoice_items_submission_date"><?= $Grid->renderFieldHeader($Grid->submission_date) ?></div></th>
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
<span id="el<?= $Grid->RowCount ?>_jdh_invoice_items_id" class="el_jdh_invoice_items_id"></span>
<input type="hidden" data-table="jdh_invoice_items" data-field="x_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_id" id="o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_invoice_items_id" class="el_jdh_invoice_items_id">
<span<?= $Grid->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->id->getDisplayValue($Grid->id->EditValue))) ?>"></span>
<input type="hidden" data-table="jdh_invoice_items" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->CurrentValue) ?>">
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_invoice_items_id" class="el_jdh_invoice_items_id">
<span<?= $Grid->id->viewAttributes() ?>>
<?= $Grid->id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_invoice_items" data-field="x_id" data-hidden="1" name="fjdh_invoice_itemsgrid$x<?= $Grid->RowIndex ?>_id" id="fjdh_invoice_itemsgrid$x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->FormValue) ?>">
<input type="hidden" data-table="jdh_invoice_items" data-field="x_id" data-hidden="1" data-old name="fjdh_invoice_itemsgrid$o<?= $Grid->RowIndex ?>_id" id="fjdh_invoice_itemsgrid$o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="jdh_invoice_items" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Grid->invoice_item->Visible) { // invoice_item ?>
        <td data-name="invoice_item"<?= $Grid->invoice_item->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_invoice_items_invoice_item" class="el_jdh_invoice_items_invoice_item">
<input type="<?= $Grid->invoice_item->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_invoice_item" id="x<?= $Grid->RowIndex ?>_invoice_item" data-table="jdh_invoice_items" data-field="x_invoice_item" value="<?= $Grid->invoice_item->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->invoice_item->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->invoice_item->formatPattern()) ?>"<?= $Grid->invoice_item->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->invoice_item->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="jdh_invoice_items" data-field="x_invoice_item" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_invoice_item" id="o<?= $Grid->RowIndex ?>_invoice_item" value="<?= HtmlEncode($Grid->invoice_item->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_invoice_items_invoice_item" class="el_jdh_invoice_items_invoice_item">
<input type="<?= $Grid->invoice_item->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_invoice_item" id="x<?= $Grid->RowIndex ?>_invoice_item" data-table="jdh_invoice_items" data-field="x_invoice_item" value="<?= $Grid->invoice_item->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->invoice_item->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->invoice_item->formatPattern()) ?>"<?= $Grid->invoice_item->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->invoice_item->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_invoice_items_invoice_item" class="el_jdh_invoice_items_invoice_item">
<span<?= $Grid->invoice_item->viewAttributes() ?>>
<?= $Grid->invoice_item->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_invoice_items" data-field="x_invoice_item" data-hidden="1" name="fjdh_invoice_itemsgrid$x<?= $Grid->RowIndex ?>_invoice_item" id="fjdh_invoice_itemsgrid$x<?= $Grid->RowIndex ?>_invoice_item" value="<?= HtmlEncode($Grid->invoice_item->FormValue) ?>">
<input type="hidden" data-table="jdh_invoice_items" data-field="x_invoice_item" data-hidden="1" data-old name="fjdh_invoice_itemsgrid$o<?= $Grid->RowIndex ?>_invoice_item" id="fjdh_invoice_itemsgrid$o<?= $Grid->RowIndex ?>_invoice_item" value="<?= HtmlEncode($Grid->invoice_item->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->total_amount->Visible) { // total_amount ?>
        <td data-name="total_amount"<?= $Grid->total_amount->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_invoice_items_total_amount" class="el_jdh_invoice_items_total_amount">
<input type="<?= $Grid->total_amount->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_total_amount" id="x<?= $Grid->RowIndex ?>_total_amount" data-table="jdh_invoice_items" data-field="x_total_amount" value="<?= $Grid->total_amount->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->total_amount->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->total_amount->formatPattern()) ?>"<?= $Grid->total_amount->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->total_amount->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="jdh_invoice_items" data-field="x_total_amount" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_total_amount" id="o<?= $Grid->RowIndex ?>_total_amount" value="<?= HtmlEncode($Grid->total_amount->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_invoice_items_total_amount" class="el_jdh_invoice_items_total_amount">
<input type="<?= $Grid->total_amount->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_total_amount" id="x<?= $Grid->RowIndex ?>_total_amount" data-table="jdh_invoice_items" data-field="x_total_amount" value="<?= $Grid->total_amount->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->total_amount->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->total_amount->formatPattern()) ?>"<?= $Grid->total_amount->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->total_amount->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_invoice_items_total_amount" class="el_jdh_invoice_items_total_amount">
<span<?= $Grid->total_amount->viewAttributes() ?>>
<?= $Grid->total_amount->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_invoice_items" data-field="x_total_amount" data-hidden="1" name="fjdh_invoice_itemsgrid$x<?= $Grid->RowIndex ?>_total_amount" id="fjdh_invoice_itemsgrid$x<?= $Grid->RowIndex ?>_total_amount" value="<?= HtmlEncode($Grid->total_amount->FormValue) ?>">
<input type="hidden" data-table="jdh_invoice_items" data-field="x_total_amount" data-hidden="1" data-old name="fjdh_invoice_itemsgrid$o<?= $Grid->RowIndex ?>_total_amount" id="fjdh_invoice_itemsgrid$o<?= $Grid->RowIndex ?>_total_amount" value="<?= HtmlEncode($Grid->total_amount->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->submission_date->Visible) { // submission_date ?>
        <td data-name="submission_date"<?= $Grid->submission_date->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_invoice_items_submission_date" class="el_jdh_invoice_items_submission_date">
<input type="<?= $Grid->submission_date->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_submission_date" id="x<?= $Grid->RowIndex ?>_submission_date" data-table="jdh_invoice_items" data-field="x_submission_date" value="<?= $Grid->submission_date->EditValue ?>" placeholder="<?= HtmlEncode($Grid->submission_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->submission_date->formatPattern()) ?>"<?= $Grid->submission_date->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->submission_date->getErrorMessage() ?></div>
<?php if (!$Grid->submission_date->ReadOnly && !$Grid->submission_date->Disabled && !isset($Grid->submission_date->EditAttrs["readonly"]) && !isset($Grid->submission_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjdh_invoice_itemsgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fjdh_invoice_itemsgrid", "x<?= $Grid->RowIndex ?>_submission_date", jQuery.extend(true, {"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="jdh_invoice_items" data-field="x_submission_date" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_submission_date" id="o<?= $Grid->RowIndex ?>_submission_date" value="<?= HtmlEncode($Grid->submission_date->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_invoice_items_submission_date" class="el_jdh_invoice_items_submission_date">
<input type="<?= $Grid->submission_date->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_submission_date" id="x<?= $Grid->RowIndex ?>_submission_date" data-table="jdh_invoice_items" data-field="x_submission_date" value="<?= $Grid->submission_date->EditValue ?>" placeholder="<?= HtmlEncode($Grid->submission_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->submission_date->formatPattern()) ?>"<?= $Grid->submission_date->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->submission_date->getErrorMessage() ?></div>
<?php if (!$Grid->submission_date->ReadOnly && !$Grid->submission_date->Disabled && !isset($Grid->submission_date->EditAttrs["readonly"]) && !isset($Grid->submission_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjdh_invoice_itemsgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fjdh_invoice_itemsgrid", "x<?= $Grid->RowIndex ?>_submission_date", jQuery.extend(true, {"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_invoice_items_submission_date" class="el_jdh_invoice_items_submission_date">
<span<?= $Grid->submission_date->viewAttributes() ?>>
<?= $Grid->submission_date->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_invoice_items" data-field="x_submission_date" data-hidden="1" name="fjdh_invoice_itemsgrid$x<?= $Grid->RowIndex ?>_submission_date" id="fjdh_invoice_itemsgrid$x<?= $Grid->RowIndex ?>_submission_date" value="<?= HtmlEncode($Grid->submission_date->FormValue) ?>">
<input type="hidden" data-table="jdh_invoice_items" data-field="x_submission_date" data-hidden="1" data-old name="fjdh_invoice_itemsgrid$o<?= $Grid->RowIndex ?>_submission_date" id="fjdh_invoice_itemsgrid$o<?= $Grid->RowIndex ?>_submission_date" value="<?= HtmlEncode($Grid->submission_date->OldValue) ?>">
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
loadjs.ready(["fjdh_invoice_itemsgrid","load"], () => fjdh_invoice_itemsgrid.updateLists(<?= $Grid->RowIndex ?><?= $Grid->RowIndex === '$rowindex$' ? ", true" : "" ?>));
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
<?php
// Render aggregate row
$Grid->RowType = ROWTYPE_AGGREGATE;
$Grid->resetAttributes();
$Grid->renderRow();
?>
<?php if ($Grid->TotalRecords > 0 && $Grid->CurrentMode == "view") { ?>
<tfoot><!-- Table footer -->
    <tr class="ew-table-footer">
<?php
// Render list options
$Grid->renderListOptions();

// Render list options (footer, left)
$Grid->ListOptions->render("footer", "left");
?>
    <?php if ($Grid->id->Visible) { // id ?>
        <td data-name="id" class="<?= $Grid->id->footerCellClass() ?>"><span id="elf_jdh_invoice_items_id" class="jdh_invoice_items_id">
        </span></td>
    <?php } ?>
    <?php if ($Grid->invoice_item->Visible) { // invoice_item ?>
        <td data-name="invoice_item" class="<?= $Grid->invoice_item->footerCellClass() ?>"><span id="elf_jdh_invoice_items_invoice_item" class="jdh_invoice_items_invoice_item">
        </span></td>
    <?php } ?>
    <?php if ($Grid->total_amount->Visible) { // total_amount ?>
        <td data-name="total_amount" class="<?= $Grid->total_amount->footerCellClass() ?>"><span id="elf_jdh_invoice_items_total_amount" class="jdh_invoice_items_total_amount">
        <span class="ew-aggregate"><?= $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
        <?= $Grid->total_amount->ViewValue ?></span>
        </span></td>
    <?php } ?>
    <?php if ($Grid->submission_date->Visible) { // submission_date ?>
        <td data-name="submission_date" class="<?= $Grid->submission_date->footerCellClass() ?>"><span id="elf_jdh_invoice_items_submission_date" class="jdh_invoice_items_submission_date">
        </span></td>
    <?php } ?>
<?php
// Render list options (footer, right)
$Grid->ListOptions->render("footer", "right");
?>
    </tr>
</tfoot>
<?php } ?>
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
<input type="hidden" name="detailpage" value="fjdh_invoice_itemsgrid">
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
    ew.addEventHandlers("jdh_invoice_items");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
