<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$JdhMedicineStockAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_medicine_stock: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fjdh_medicine_stockadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_medicine_stockadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["medicine_id", [fields.medicine_id.visible && fields.medicine_id.required ? ew.Validators.required(fields.medicine_id.caption) : null], fields.medicine_id.isInvalid],
            ["units_available", [fields.units_available.visible && fields.units_available.required ? ew.Validators.required(fields.units_available.caption) : null, ew.Validators.integer], fields.units_available.isInvalid]
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
<form name="fjdh_medicine_stockadd" id="fjdh_medicine_stockadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jdh_medicine_stock">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->medicine_id->Visible) { // medicine_id ?>
    <div id="r_medicine_id"<?= $Page->medicine_id->rowAttributes() ?>>
        <label id="elh_jdh_medicine_stock_medicine_id" for="x_medicine_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->medicine_id->caption() ?><?= $Page->medicine_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->medicine_id->cellAttributes() ?>>
<span id="el_jdh_medicine_stock_medicine_id">
    <select
        id="x_medicine_id"
        name="x_medicine_id"
        class="form-select ew-select<?= $Page->medicine_id->isInvalidClass() ?>"
        data-select2-id="fjdh_medicine_stockadd_x_medicine_id"
        data-table="jdh_medicine_stock"
        data-field="x_medicine_id"
        data-value-separator="<?= $Page->medicine_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->medicine_id->getPlaceHolder()) ?>"
        <?= $Page->medicine_id->editAttributes() ?>>
        <?= $Page->medicine_id->selectOptionListHtml("x_medicine_id") ?>
    </select>
    <?= $Page->medicine_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->medicine_id->getErrorMessage() ?></div>
<?= $Page->medicine_id->Lookup->getParamTag($Page, "p_x_medicine_id") ?>
<script>
loadjs.ready("fjdh_medicine_stockadd", function() {
    var options = { name: "x_medicine_id", selectId: "fjdh_medicine_stockadd_x_medicine_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_medicine_stockadd.lists.medicine_id?.lookupOptions.length) {
        options.data = { id: "x_medicine_id", form: "fjdh_medicine_stockadd" };
    } else {
        options.ajax = { id: "x_medicine_id", form: "fjdh_medicine_stockadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_medicine_stock.fields.medicine_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->units_available->Visible) { // units_available ?>
    <div id="r_units_available"<?= $Page->units_available->rowAttributes() ?>>
        <label id="elh_jdh_medicine_stock_units_available" for="x_units_available" class="<?= $Page->LeftColumnClass ?>"><?= $Page->units_available->caption() ?><?= $Page->units_available->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->units_available->cellAttributes() ?>>
<span id="el_jdh_medicine_stock_units_available">
<input type="<?= $Page->units_available->getInputTextType() ?>" name="x_units_available" id="x_units_available" data-table="jdh_medicine_stock" data-field="x_units_available" value="<?= $Page->units_available->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->units_available->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->units_available->formatPattern()) ?>"<?= $Page->units_available->editAttributes() ?> aria-describedby="x_units_available_help">
<?= $Page->units_available->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->units_available->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fjdh_medicine_stockadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fjdh_medicine_stockadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("jdh_medicine_stock");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
