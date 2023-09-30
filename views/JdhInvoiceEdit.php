<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$JdhInvoiceEdit = &$Page;
?>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="fjdh_invoiceedit" id="fjdh_invoiceedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_invoice: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fjdh_invoiceedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_invoiceedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["invoice_id", [fields.invoice_id.visible && fields.invoice_id.required ? ew.Validators.required(fields.invoice_id.caption) : null], fields.invoice_id.isInvalid],
            ["patient_id", [fields.patient_id.visible && fields.patient_id.required ? ew.Validators.required(fields.patient_id.caption) : null], fields.patient_id.isInvalid],
            ["submitted_by_user_id", [fields.submitted_by_user_id.visible && fields.submitted_by_user_id.required ? ew.Validators.required(fields.submitted_by_user_id.caption) : null], fields.submitted_by_user_id.isInvalid],
            ["invoice_date", [fields.invoice_date.visible && fields.invoice_date.required ? ew.Validators.required(fields.invoice_date.caption) : null, ew.Validators.datetime(fields.invoice_date.clientFormatPattern)], fields.invoice_date.isInvalid]
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
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jdh_invoice">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->invoice_id->Visible) { // invoice_id ?>
    <div id="r_invoice_id"<?= $Page->invoice_id->rowAttributes() ?>>
        <label id="elh_jdh_invoice_invoice_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->invoice_id->caption() ?><?= $Page->invoice_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->invoice_id->cellAttributes() ?>>
<span id="el_jdh_invoice_invoice_id">
<span<?= $Page->invoice_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->invoice_id->getDisplayValue($Page->invoice_id->EditValue))) ?>"></span>
<input type="hidden" data-table="jdh_invoice" data-field="x_invoice_id" data-hidden="1" name="x_invoice_id" id="x_invoice_id" value="<?= HtmlEncode($Page->invoice_id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
    <div id="r_patient_id"<?= $Page->patient_id->rowAttributes() ?>>
        <label id="elh_jdh_invoice_patient_id" for="x_patient_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->patient_id->caption() ?><?= $Page->patient_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->patient_id->cellAttributes() ?>>
<span id="el_jdh_invoice_patient_id">
    <select
        id="x_patient_id"
        name="x_patient_id"
        class="form-select ew-select<?= $Page->patient_id->isInvalidClass() ?>"
        data-select2-id="fjdh_invoiceedit_x_patient_id"
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
<script>
loadjs.ready("fjdh_invoiceedit", function() {
    var options = { name: "x_patient_id", selectId: "fjdh_invoiceedit_x_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_invoiceedit.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x_patient_id", form: "fjdh_invoiceedit" };
    } else {
        options.ajax = { id: "x_patient_id", form: "fjdh_invoiceedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_invoice.fields.patient_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->invoice_date->Visible) { // invoice_date ?>
    <div id="r_invoice_date"<?= $Page->invoice_date->rowAttributes() ?>>
        <label id="elh_jdh_invoice_invoice_date" for="x_invoice_date" class="<?= $Page->LeftColumnClass ?>"><?= $Page->invoice_date->caption() ?><?= $Page->invoice_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->invoice_date->cellAttributes() ?>>
<span id="el_jdh_invoice_invoice_date">
<input type="<?= $Page->invoice_date->getInputTextType() ?>" name="x_invoice_date" id="x_invoice_date" data-table="jdh_invoice" data-field="x_invoice_date" value="<?= $Page->invoice_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->invoice_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->invoice_date->formatPattern()) ?>"<?= $Page->invoice_date->editAttributes() ?> aria-describedby="x_invoice_date_help">
<?= $Page->invoice_date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->invoice_date->getErrorMessage() ?></div>
<?php if (!$Page->invoice_date->ReadOnly && !$Page->invoice_date->Disabled && !isset($Page->invoice_date->EditAttrs["readonly"]) && !isset($Page->invoice_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjdh_invoiceedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fjdh_invoiceedit", "x_invoice_date", jQuery.extend(true, {"useCurrent":false,"display":{"sideBySide":false}}, options));
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
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fjdh_invoiceedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fjdh_invoiceedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("jdh_invoice");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
