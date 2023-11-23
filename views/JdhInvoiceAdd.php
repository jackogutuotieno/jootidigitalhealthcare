<?php

namespace PHPMaker2024\jootidigitalhealthcare;

// Page object
$JdhInvoiceAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_invoice: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fjdh_invoiceadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_invoiceadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["patient_id", [fields.patient_id.visible && fields.patient_id.required ? ew.Validators.required(fields.patient_id.caption) : null], fields.patient_id.isInvalid],
            ["invoice_title", [fields.invoice_title.visible && fields.invoice_title.required ? ew.Validators.required(fields.invoice_title.caption) : null], fields.invoice_title.isInvalid],
            ["invoice_description", [fields.invoice_description.visible && fields.invoice_description.required ? ew.Validators.required(fields.invoice_description.caption) : null], fields.invoice_description.isInvalid]
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
            "patient_id": <?= $Page->patient_id->toClientList($Page) ?>,
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
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fjdh_invoiceadd" id="fjdh_invoiceadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jdh_invoice">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->patient_id->Visible) { // patient_id ?>
    <div id="r_patient_id"<?= $Page->patient_id->rowAttributes() ?>>
        <label id="elh_jdh_invoice_patient_id" for="x_patient_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->patient_id->caption() ?><?= $Page->patient_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->patient_id->cellAttributes() ?>>
<span id="el_jdh_invoice_patient_id">
    <select
        id="x_patient_id"
        name="x_patient_id"
        class="form-select ew-select<?= $Page->patient_id->isInvalidClass() ?>"
        <?php if (!$Page->patient_id->IsNativeSelect) { ?>
        data-select2-id="fjdh_invoiceadd_x_patient_id"
        <?php } ?>
        data-table="jdh_invoice"
        data-field="x_patient_id"
        data-value-separator="<?= $Page->patient_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->patient_id->getPlaceHolder()) ?>"
        <?= $Page->patient_id->editAttributes() ?>>
        <?= $Page->patient_id->selectOptionListHtml("x_patient_id") ?>
    </select>
    <?= $Page->patient_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->patient_id->getErrorMessage() ?></div>
<?= $Page->patient_id->Lookup->getParamTag($Page, "p_x_patient_id") ?>
<?php if (!$Page->patient_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fjdh_invoiceadd", function() {
    var options = { name: "x_patient_id", selectId: "fjdh_invoiceadd_x_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_invoiceadd.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x_patient_id", form: "fjdh_invoiceadd" };
    } else {
        options.ajax = { id: "x_patient_id", form: "fjdh_invoiceadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_invoice.fields.patient_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->invoice_title->Visible) { // invoice_title ?>
    <div id="r_invoice_title"<?= $Page->invoice_title->rowAttributes() ?>>
        <label id="elh_jdh_invoice_invoice_title" for="x_invoice_title" class="<?= $Page->LeftColumnClass ?>"><?= $Page->invoice_title->caption() ?><?= $Page->invoice_title->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->invoice_title->cellAttributes() ?>>
<span id="el_jdh_invoice_invoice_title">
<input type="<?= $Page->invoice_title->getInputTextType() ?>" name="x_invoice_title" id="x_invoice_title" data-table="jdh_invoice" data-field="x_invoice_title" value="<?= $Page->invoice_title->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->invoice_title->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->invoice_title->formatPattern()) ?>"<?= $Page->invoice_title->editAttributes() ?> aria-describedby="x_invoice_title_help">
<?= $Page->invoice_title->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->invoice_title->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->invoice_description->Visible) { // invoice_description ?>
    <div id="r_invoice_description"<?= $Page->invoice_description->rowAttributes() ?>>
        <label id="elh_jdh_invoice_invoice_description" for="x_invoice_description" class="<?= $Page->LeftColumnClass ?>"><?= $Page->invoice_description->caption() ?><?= $Page->invoice_description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->invoice_description->cellAttributes() ?>>
<span id="el_jdh_invoice_invoice_description">
<textarea data-table="jdh_invoice" data-field="x_invoice_description" name="x_invoice_description" id="x_invoice_description" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->invoice_description->getPlaceHolder()) ?>"<?= $Page->invoice_description->editAttributes() ?> aria-describedby="x_invoice_description_help"><?= $Page->invoice_description->EditValue ?></textarea>
<?= $Page->invoice_description->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->invoice_description->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php
    if (in_array("jdh_invoice_items", explode(",", $Page->getCurrentDetailTable())) && $jdh_invoice_items->DetailAdd) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("jdh_invoice_items", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "JdhInvoiceItemsGrid.php" ?>
<?php } ?>
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fjdh_invoiceadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fjdh_invoiceadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
<?php } ?>
    </div><!-- /buttons offset -->
<?= $Page->IsModal ? "</template>" : "</div>" ?><!-- /buttons .row -->
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
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
