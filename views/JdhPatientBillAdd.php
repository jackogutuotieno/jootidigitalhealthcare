<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$JdhPatientBillAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_patient_bill: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fjdh_patient_billadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_patient_billadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["patient_id", [fields.patient_id.visible && fields.patient_id.required ? ew.Validators.required(fields.patient_id.caption) : null], fields.patient_id.isInvalid],
            ["bill_description", [fields.bill_description.visible && fields.bill_description.required ? ew.Validators.required(fields.bill_description.caption) : null], fields.bill_description.isInvalid],
            ["bill_date", [fields.bill_date.visible && fields.bill_date.required ? ew.Validators.required(fields.bill_date.caption) : null, ew.Validators.datetime(fields.bill_date.clientFormatPattern)], fields.bill_date.isInvalid]
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
<form name="fjdh_patient_billadd" id="fjdh_patient_billadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jdh_patient_bill">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->patient_id->Visible) { // patient_id ?>
    <div id="r_patient_id"<?= $Page->patient_id->rowAttributes() ?>>
        <label id="elh_jdh_patient_bill_patient_id" for="x_patient_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->patient_id->caption() ?><?= $Page->patient_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->patient_id->cellAttributes() ?>>
<span id="el_jdh_patient_bill_patient_id">
    <select
        id="x_patient_id"
        name="x_patient_id"
        class="form-select ew-select<?= $Page->patient_id->isInvalidClass() ?>"
        data-select2-id="fjdh_patient_billadd_x_patient_id"
        data-table="jdh_patient_bill"
        data-field="x_patient_id"
        data-value-separator="<?= $Page->patient_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->patient_id->getPlaceHolder()) ?>"
        <?= $Page->patient_id->editAttributes() ?>>
        <?= $Page->patient_id->selectOptionListHtml("x_patient_id") ?>
    </select>
    <?= $Page->patient_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->patient_id->getErrorMessage() ?></div>
<?= $Page->patient_id->Lookup->getParamTag($Page, "p_x_patient_id") ?>
<script>
loadjs.ready("fjdh_patient_billadd", function() {
    var options = { name: "x_patient_id", selectId: "fjdh_patient_billadd_x_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_patient_billadd.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x_patient_id", form: "fjdh_patient_billadd" };
    } else {
        options.ajax = { id: "x_patient_id", form: "fjdh_patient_billadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_patient_bill.fields.patient_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->bill_description->Visible) { // bill_description ?>
    <div id="r_bill_description"<?= $Page->bill_description->rowAttributes() ?>>
        <label id="elh_jdh_patient_bill_bill_description" class="<?= $Page->LeftColumnClass ?>"><?= $Page->bill_description->caption() ?><?= $Page->bill_description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->bill_description->cellAttributes() ?>>
<span id="el_jdh_patient_bill_bill_description">
<?php $Page->bill_description->EditAttrs->appendClass("editor"); ?>
<textarea data-table="jdh_patient_bill" data-field="x_bill_description" name="x_bill_description" id="x_bill_description" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->bill_description->getPlaceHolder()) ?>"<?= $Page->bill_description->editAttributes() ?> aria-describedby="x_bill_description_help"><?= $Page->bill_description->EditValue ?></textarea>
<?= $Page->bill_description->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->bill_description->getErrorMessage() ?></div>
<script>
loadjs.ready(["fjdh_patient_billadd", "editor"], function() {
    ew.createEditor("fjdh_patient_billadd", "x_bill_description", 35, 4, <?= $Page->bill_description->ReadOnly || false ? "true" : "false" ?>);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->bill_date->Visible) { // bill_date ?>
    <div id="r_bill_date"<?= $Page->bill_date->rowAttributes() ?>>
        <label id="elh_jdh_patient_bill_bill_date" for="x_bill_date" class="<?= $Page->LeftColumnClass ?>"><?= $Page->bill_date->caption() ?><?= $Page->bill_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->bill_date->cellAttributes() ?>>
<span id="el_jdh_patient_bill_bill_date">
<input type="<?= $Page->bill_date->getInputTextType() ?>" name="x_bill_date" id="x_bill_date" data-table="jdh_patient_bill" data-field="x_bill_date" value="<?= $Page->bill_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->bill_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->bill_date->formatPattern()) ?>"<?= $Page->bill_date->editAttributes() ?> aria-describedby="x_bill_date_help">
<?= $Page->bill_date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->bill_date->getErrorMessage() ?></div>
<?php if (!$Page->bill_date->ReadOnly && !$Page->bill_date->Disabled && !isset($Page->bill_date->EditAttrs["readonly"]) && !isset($Page->bill_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjdh_patient_billadd", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fjdh_patient_billadd", "x_bill_date", jQuery.extend(true, {"useCurrent":false,"display":{"sideBySide":false}}, options));
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
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fjdh_patient_billadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fjdh_patient_billadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("jdh_patient_bill");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
