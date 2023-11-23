<?php

namespace PHPMaker2024\jootidigitalhealthcare;

// Page object
$JdhInvoiceItemsEdit = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="fjdh_invoice_itemsedit" id="fjdh_invoice_itemsedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_invoice_items: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fjdh_invoice_itemsedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_invoice_itemsedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["invoice_id", [fields.invoice_id.visible && fields.invoice_id.required ? ew.Validators.required(fields.invoice_id.caption) : null, ew.Validators.integer], fields.invoice_id.isInvalid],
            ["invoice_item", [fields.invoice_item.visible && fields.invoice_item.required ? ew.Validators.required(fields.invoice_item.caption) : null], fields.invoice_item.isInvalid],
            ["total_amount", [fields.total_amount.visible && fields.total_amount.required ? ew.Validators.required(fields.total_amount.caption) : null, ew.Validators.integer], fields.total_amount.isInvalid]
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
        })
        .build();
    window[form.id] = form;
    currentForm = form;
    loadjs.done(form.id);
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jdh_invoice_items">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "jdh_invoice") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="jdh_invoice">
<input type="hidden" name="fk_id" value="<?= HtmlEncode($Page->invoice_id->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_jdh_invoice_items_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_jdh_invoice_items_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="jdh_invoice_items" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->invoice_id->Visible) { // invoice_id ?>
    <div id="r_invoice_id"<?= $Page->invoice_id->rowAttributes() ?>>
        <label id="elh_jdh_invoice_items_invoice_id" for="x_invoice_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->invoice_id->caption() ?><?= $Page->invoice_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->invoice_id->cellAttributes() ?>>
<?php if ($Page->invoice_id->getSessionValue() != "") { ?>
<span<?= $Page->invoice_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->invoice_id->getDisplayValue($Page->invoice_id->ViewValue))) ?>"></span>
<input type="hidden" id="x_invoice_id" name="x_invoice_id" value="<?= HtmlEncode($Page->invoice_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_jdh_invoice_items_invoice_id">
<input type="<?= $Page->invoice_id->getInputTextType() ?>" name="x_invoice_id" id="x_invoice_id" data-table="jdh_invoice_items" data-field="x_invoice_id" value="<?= $Page->invoice_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->invoice_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->invoice_id->formatPattern()) ?>"<?= $Page->invoice_id->editAttributes() ?> aria-describedby="x_invoice_id_help">
<?= $Page->invoice_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->invoice_id->getErrorMessage() ?></div>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->invoice_item->Visible) { // invoice_item ?>
    <div id="r_invoice_item"<?= $Page->invoice_item->rowAttributes() ?>>
        <label id="elh_jdh_invoice_items_invoice_item" for="x_invoice_item" class="<?= $Page->LeftColumnClass ?>"><?= $Page->invoice_item->caption() ?><?= $Page->invoice_item->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->invoice_item->cellAttributes() ?>>
<span id="el_jdh_invoice_items_invoice_item">
<input type="<?= $Page->invoice_item->getInputTextType() ?>" name="x_invoice_item" id="x_invoice_item" data-table="jdh_invoice_items" data-field="x_invoice_item" value="<?= $Page->invoice_item->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->invoice_item->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->invoice_item->formatPattern()) ?>"<?= $Page->invoice_item->editAttributes() ?> aria-describedby="x_invoice_item_help">
<?= $Page->invoice_item->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->invoice_item->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->total_amount->Visible) { // total_amount ?>
    <div id="r_total_amount"<?= $Page->total_amount->rowAttributes() ?>>
        <label id="elh_jdh_invoice_items_total_amount" for="x_total_amount" class="<?= $Page->LeftColumnClass ?>"><?= $Page->total_amount->caption() ?><?= $Page->total_amount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->total_amount->cellAttributes() ?>>
<span id="el_jdh_invoice_items_total_amount">
<input type="<?= $Page->total_amount->getInputTextType() ?>" name="x_total_amount" id="x_total_amount" data-table="jdh_invoice_items" data-field="x_total_amount" value="<?= $Page->total_amount->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->total_amount->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->total_amount->formatPattern()) ?>"<?= $Page->total_amount->editAttributes() ?> aria-describedby="x_total_amount_help">
<?= $Page->total_amount->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->total_amount->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fjdh_invoice_itemsedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fjdh_invoice_itemsedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
<?php } ?>
    </div><!-- /buttons offset -->
<?= $Page->IsModal ? "</template>" : "</div>" ?><!-- /buttons .row -->
</form>
</main>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
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
