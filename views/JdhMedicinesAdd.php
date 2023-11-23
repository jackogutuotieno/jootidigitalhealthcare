<?php

namespace PHPMaker2024\jootidigitalhealthcare;

// Page object
$JdhMedicinesAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_medicines: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fjdh_medicinesadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_medicinesadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["category_id", [fields.category_id.visible && fields.category_id.required ? ew.Validators.required(fields.category_id.caption) : null], fields.category_id.isInvalid],
            ["name", [fields.name.visible && fields.name.required ? ew.Validators.required(fields.name.caption) : null], fields.name.isInvalid],
            ["selling_price", [fields.selling_price.visible && fields.selling_price.required ? ew.Validators.required(fields.selling_price.caption) : null, ew.Validators.float], fields.selling_price.isInvalid],
            ["buying_price", [fields.buying_price.visible && fields.buying_price.required ? ew.Validators.required(fields.buying_price.caption) : null, ew.Validators.float], fields.buying_price.isInvalid],
            ["description", [fields.description.visible && fields.description.required ? ew.Validators.required(fields.description.caption) : null], fields.description.isInvalid],
            ["expiry", [fields.expiry.visible && fields.expiry.required ? ew.Validators.required(fields.expiry.caption) : null, ew.Validators.datetime(fields.expiry.clientFormatPattern)], fields.expiry.isInvalid]
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
            "category_id": <?= $Page->category_id->toClientList($Page) ?>,
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
<form name="fjdh_medicinesadd" id="fjdh_medicinesadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jdh_medicines">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->category_id->Visible) { // category_id ?>
    <div id="r_category_id"<?= $Page->category_id->rowAttributes() ?>>
        <label id="elh_jdh_medicines_category_id" for="x_category_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->category_id->caption() ?><?= $Page->category_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->category_id->cellAttributes() ?>>
<span id="el_jdh_medicines_category_id">
    <select
        id="x_category_id"
        name="x_category_id"
        class="form-select ew-select<?= $Page->category_id->isInvalidClass() ?>"
        <?php if (!$Page->category_id->IsNativeSelect) { ?>
        data-select2-id="fjdh_medicinesadd_x_category_id"
        <?php } ?>
        data-table="jdh_medicines"
        data-field="x_category_id"
        data-value-separator="<?= $Page->category_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->category_id->getPlaceHolder()) ?>"
        <?= $Page->category_id->editAttributes() ?>>
        <?= $Page->category_id->selectOptionListHtml("x_category_id") ?>
    </select>
    <?= $Page->category_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->category_id->getErrorMessage() ?></div>
<?= $Page->category_id->Lookup->getParamTag($Page, "p_x_category_id") ?>
<?php if (!$Page->category_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fjdh_medicinesadd", function() {
    var options = { name: "x_category_id", selectId: "fjdh_medicinesadd_x_category_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_medicinesadd.lists.category_id?.lookupOptions.length) {
        options.data = { id: "x_category_id", form: "fjdh_medicinesadd" };
    } else {
        options.ajax = { id: "x_category_id", form: "fjdh_medicinesadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_medicines.fields.category_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
    <div id="r_name"<?= $Page->name->rowAttributes() ?>>
        <label id="elh_jdh_medicines_name" for="x_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->name->caption() ?><?= $Page->name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->name->cellAttributes() ?>>
<span id="el_jdh_medicines_name">
<input type="<?= $Page->name->getInputTextType() ?>" name="x_name" id="x_name" data-table="jdh_medicines" data-field="x_name" value="<?= $Page->name->EditValue ?>" size="30" maxlength="191" placeholder="<?= HtmlEncode($Page->name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->name->formatPattern()) ?>"<?= $Page->name->editAttributes() ?> aria-describedby="x_name_help">
<?= $Page->name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->selling_price->Visible) { // selling_price ?>
    <div id="r_selling_price"<?= $Page->selling_price->rowAttributes() ?>>
        <label id="elh_jdh_medicines_selling_price" for="x_selling_price" class="<?= $Page->LeftColumnClass ?>"><?= $Page->selling_price->caption() ?><?= $Page->selling_price->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->selling_price->cellAttributes() ?>>
<span id="el_jdh_medicines_selling_price">
<input type="<?= $Page->selling_price->getInputTextType() ?>" name="x_selling_price" id="x_selling_price" data-table="jdh_medicines" data-field="x_selling_price" value="<?= $Page->selling_price->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->selling_price->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->selling_price->formatPattern()) ?>"<?= $Page->selling_price->editAttributes() ?> aria-describedby="x_selling_price_help">
<?= $Page->selling_price->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->selling_price->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->buying_price->Visible) { // buying_price ?>
    <div id="r_buying_price"<?= $Page->buying_price->rowAttributes() ?>>
        <label id="elh_jdh_medicines_buying_price" for="x_buying_price" class="<?= $Page->LeftColumnClass ?>"><?= $Page->buying_price->caption() ?><?= $Page->buying_price->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->buying_price->cellAttributes() ?>>
<span id="el_jdh_medicines_buying_price">
<input type="<?= $Page->buying_price->getInputTextType() ?>" name="x_buying_price" id="x_buying_price" data-table="jdh_medicines" data-field="x_buying_price" value="<?= $Page->buying_price->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->buying_price->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->buying_price->formatPattern()) ?>"<?= $Page->buying_price->editAttributes() ?> aria-describedby="x_buying_price_help">
<?= $Page->buying_price->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->buying_price->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <div id="r_description"<?= $Page->description->rowAttributes() ?>>
        <label id="elh_jdh_medicines_description" for="x_description" class="<?= $Page->LeftColumnClass ?>"><?= $Page->description->caption() ?><?= $Page->description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->description->cellAttributes() ?>>
<span id="el_jdh_medicines_description">
<textarea data-table="jdh_medicines" data-field="x_description" name="x_description" id="x_description" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->description->getPlaceHolder()) ?>"<?= $Page->description->editAttributes() ?> aria-describedby="x_description_help"><?= $Page->description->EditValue ?></textarea>
<?= $Page->description->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->description->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->expiry->Visible) { // expiry ?>
    <div id="r_expiry"<?= $Page->expiry->rowAttributes() ?>>
        <label id="elh_jdh_medicines_expiry" for="x_expiry" class="<?= $Page->LeftColumnClass ?>"><?= $Page->expiry->caption() ?><?= $Page->expiry->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->expiry->cellAttributes() ?>>
<span id="el_jdh_medicines_expiry">
<input type="<?= $Page->expiry->getInputTextType() ?>" name="x_expiry" id="x_expiry" data-table="jdh_medicines" data-field="x_expiry" value="<?= $Page->expiry->EditValue ?>" placeholder="<?= HtmlEncode($Page->expiry->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->expiry->formatPattern()) ?>"<?= $Page->expiry->editAttributes() ?> aria-describedby="x_expiry_help">
<?= $Page->expiry->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->expiry->getErrorMessage() ?></div>
<?php if (!$Page->expiry->ReadOnly && !$Page->expiry->Disabled && !isset($Page->expiry->EditAttrs["readonly"]) && !isset($Page->expiry->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjdh_medicinesadd", "datetimepicker"], function () {
    let format = "<?= DateFormat(7) ?>",
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
    ew.createDateTimePicker("fjdh_medicinesadd", "x_expiry", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fjdh_medicinesadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fjdh_medicinesadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("jdh_medicines");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
