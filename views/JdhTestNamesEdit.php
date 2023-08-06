<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$JdhTestNamesEdit = &$Page;
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
<form name="fjdh_test_namesedit" id="fjdh_test_namesedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_test_names: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fjdh_test_namesedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_test_namesedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["test_id", [fields.test_id.visible && fields.test_id.required ? ew.Validators.required(fields.test_id.caption) : null], fields.test_id.isInvalid],
            ["patient_id", [fields.patient_id.visible && fields.patient_id.required ? ew.Validators.required(fields.patient_id.caption) : null], fields.patient_id.isInvalid],
            ["test_name", [fields.test_name.visible && fields.test_name.required ? ew.Validators.required(fields.test_name.caption) : null], fields.test_name.isInvalid],
            ["test_category_id", [fields.test_category_id.visible && fields.test_category_id.required ? ew.Validators.required(fields.test_category_id.caption) : null, ew.Validators.integer], fields.test_category_id.isInvalid],
            ["test_subcategory_id", [fields.test_subcategory_id.visible && fields.test_subcategory_id.required ? ew.Validators.required(fields.test_subcategory_id.caption) : null], fields.test_subcategory_id.isInvalid],
            ["test_cost", [fields.test_cost.visible && fields.test_cost.required ? ew.Validators.required(fields.test_cost.caption) : null, ew.Validators.float], fields.test_cost.isInvalid],
            ["date_submitted", [fields.date_submitted.visible && fields.date_submitted.required ? ew.Validators.required(fields.date_submitted.caption) : null, ew.Validators.datetime(fields.date_submitted.clientFormatPattern)], fields.date_submitted.isInvalid],
            ["date_updated", [fields.date_updated.visible && fields.date_updated.required ? ew.Validators.required(fields.date_updated.caption) : null, ew.Validators.datetime(fields.date_updated.clientFormatPattern)], fields.date_updated.isInvalid]
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
            "test_category_id": <?= $Page->test_category_id->toClientList($Page) ?>,
            "test_subcategory_id": <?= $Page->test_subcategory_id->toClientList($Page) ?>,
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
<input type="hidden" name="t" value="jdh_test_names">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->test_id->Visible) { // test_id ?>
    <div id="r_test_id"<?= $Page->test_id->rowAttributes() ?>>
        <label id="elh_jdh_test_names_test_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->test_id->caption() ?><?= $Page->test_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->test_id->cellAttributes() ?>>
<span id="el_jdh_test_names_test_id">
<span<?= $Page->test_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->test_id->getDisplayValue($Page->test_id->EditValue))) ?>"></span>
<input type="hidden" data-table="jdh_test_names" data-field="x_test_id" data-hidden="1" name="x_test_id" id="x_test_id" value="<?= HtmlEncode($Page->test_id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
    <div id="r_patient_id"<?= $Page->patient_id->rowAttributes() ?>>
        <label id="elh_jdh_test_names_patient_id" for="x_patient_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->patient_id->caption() ?><?= $Page->patient_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->patient_id->cellAttributes() ?>>
<span id="el_jdh_test_names_patient_id">
    <select
        id="x_patient_id"
        name="x_patient_id"
        class="form-select ew-select<?= $Page->patient_id->isInvalidClass() ?>"
        data-select2-id="fjdh_test_namesedit_x_patient_id"
        data-table="jdh_test_names"
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
loadjs.ready("fjdh_test_namesedit", function() {
    var options = { name: "x_patient_id", selectId: "fjdh_test_namesedit_x_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_test_namesedit.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x_patient_id", form: "fjdh_test_namesedit" };
    } else {
        options.ajax = { id: "x_patient_id", form: "fjdh_test_namesedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_test_names.fields.patient_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->test_name->Visible) { // test_name ?>
    <div id="r_test_name"<?= $Page->test_name->rowAttributes() ?>>
        <label id="elh_jdh_test_names_test_name" for="x_test_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->test_name->caption() ?><?= $Page->test_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->test_name->cellAttributes() ?>>
<span id="el_jdh_test_names_test_name">
<input type="<?= $Page->test_name->getInputTextType() ?>" name="x_test_name" id="x_test_name" data-table="jdh_test_names" data-field="x_test_name" value="<?= $Page->test_name->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->test_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->test_name->formatPattern()) ?>"<?= $Page->test_name->editAttributes() ?> aria-describedby="x_test_name_help">
<?= $Page->test_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->test_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->test_category_id->Visible) { // test_category_id ?>
    <div id="r_test_category_id"<?= $Page->test_category_id->rowAttributes() ?>>
        <label id="elh_jdh_test_names_test_category_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->test_category_id->caption() ?><?= $Page->test_category_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->test_category_id->cellAttributes() ?>>
<span id="el_jdh_test_names_test_category_id">
<?php
if (IsRTL()) {
    $Page->test_category_id->EditAttrs["dir"] = "rtl";
}
?>
<span id="as_x_test_category_id" class="ew-auto-suggest">
    <input type="<?= $Page->test_category_id->getInputTextType() ?>" class="form-control" name="sv_x_test_category_id" id="sv_x_test_category_id" value="<?= RemoveHtml($Page->test_category_id->EditValue) ?>" autocomplete="off" size="30" placeholder="<?= HtmlEncode($Page->test_category_id->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Page->test_category_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->test_category_id->formatPattern()) ?>"<?= $Page->test_category_id->editAttributes() ?> aria-describedby="x_test_category_id_help">
</span>
<selection-list hidden class="form-control" data-table="jdh_test_names" data-field="x_test_category_id" data-input="sv_x_test_category_id" data-value-separator="<?= $Page->test_category_id->displayValueSeparatorAttribute() ?>" name="x_test_category_id" id="x_test_category_id" value="<?= HtmlEncode($Page->test_category_id->CurrentValue) ?>"></selection-list>
<?= $Page->test_category_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->test_category_id->getErrorMessage() ?></div>
<script>
loadjs.ready("fjdh_test_namesedit", function() {
    fjdh_test_namesedit.createAutoSuggest(Object.assign({"id":"x_test_category_id","forceSelect":false}, { lookupAllDisplayFields: <?= $Page->test_category_id->Lookup->LookupAllDisplayFields ? "true" : "false" ?> }, ew.vars.tables.jdh_test_names.fields.test_category_id.autoSuggestOptions));
});
</script>
<?= $Page->test_category_id->Lookup->getParamTag($Page, "p_x_test_category_id") ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->test_subcategory_id->Visible) { // test_subcategory_id ?>
    <div id="r_test_subcategory_id"<?= $Page->test_subcategory_id->rowAttributes() ?>>
        <label id="elh_jdh_test_names_test_subcategory_id" for="x_test_subcategory_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->test_subcategory_id->caption() ?><?= $Page->test_subcategory_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->test_subcategory_id->cellAttributes() ?>>
<span id="el_jdh_test_names_test_subcategory_id">
    <select
        id="x_test_subcategory_id"
        name="x_test_subcategory_id"
        class="form-select ew-select<?= $Page->test_subcategory_id->isInvalidClass() ?>"
        data-select2-id="fjdh_test_namesedit_x_test_subcategory_id"
        data-table="jdh_test_names"
        data-field="x_test_subcategory_id"
        data-value-separator="<?= $Page->test_subcategory_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->test_subcategory_id->getPlaceHolder()) ?>"
        <?= $Page->test_subcategory_id->editAttributes() ?>>
        <?= $Page->test_subcategory_id->selectOptionListHtml("x_test_subcategory_id") ?>
    </select>
    <?= $Page->test_subcategory_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->test_subcategory_id->getErrorMessage() ?></div>
<?= $Page->test_subcategory_id->Lookup->getParamTag($Page, "p_x_test_subcategory_id") ?>
<script>
loadjs.ready("fjdh_test_namesedit", function() {
    var options = { name: "x_test_subcategory_id", selectId: "fjdh_test_namesedit_x_test_subcategory_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_test_namesedit.lists.test_subcategory_id?.lookupOptions.length) {
        options.data = { id: "x_test_subcategory_id", form: "fjdh_test_namesedit" };
    } else {
        options.ajax = { id: "x_test_subcategory_id", form: "fjdh_test_namesedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_test_names.fields.test_subcategory_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->test_cost->Visible) { // test_cost ?>
    <div id="r_test_cost"<?= $Page->test_cost->rowAttributes() ?>>
        <label id="elh_jdh_test_names_test_cost" for="x_test_cost" class="<?= $Page->LeftColumnClass ?>"><?= $Page->test_cost->caption() ?><?= $Page->test_cost->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->test_cost->cellAttributes() ?>>
<span id="el_jdh_test_names_test_cost">
<input type="<?= $Page->test_cost->getInputTextType() ?>" name="x_test_cost" id="x_test_cost" data-table="jdh_test_names" data-field="x_test_cost" value="<?= $Page->test_cost->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->test_cost->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->test_cost->formatPattern()) ?>"<?= $Page->test_cost->editAttributes() ?> aria-describedby="x_test_cost_help">
<?= $Page->test_cost->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->test_cost->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->date_submitted->Visible) { // date_submitted ?>
    <div id="r_date_submitted"<?= $Page->date_submitted->rowAttributes() ?>>
        <label id="elh_jdh_test_names_date_submitted" for="x_date_submitted" class="<?= $Page->LeftColumnClass ?>"><?= $Page->date_submitted->caption() ?><?= $Page->date_submitted->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date_submitted->cellAttributes() ?>>
<span id="el_jdh_test_names_date_submitted">
<input type="<?= $Page->date_submitted->getInputTextType() ?>" name="x_date_submitted" id="x_date_submitted" data-table="jdh_test_names" data-field="x_date_submitted" value="<?= $Page->date_submitted->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_submitted->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->date_submitted->formatPattern()) ?>"<?= $Page->date_submitted->editAttributes() ?> aria-describedby="x_date_submitted_help">
<?= $Page->date_submitted->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date_submitted->getErrorMessage() ?></div>
<?php if (!$Page->date_submitted->ReadOnly && !$Page->date_submitted->Disabled && !isset($Page->date_submitted->EditAttrs["readonly"]) && !isset($Page->date_submitted->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjdh_test_namesedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fjdh_test_namesedit", "x_date_submitted", jQuery.extend(true, {"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
    <div id="r_date_updated"<?= $Page->date_updated->rowAttributes() ?>>
        <label id="elh_jdh_test_names_date_updated" for="x_date_updated" class="<?= $Page->LeftColumnClass ?>"><?= $Page->date_updated->caption() ?><?= $Page->date_updated->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date_updated->cellAttributes() ?>>
<span id="el_jdh_test_names_date_updated">
<input type="<?= $Page->date_updated->getInputTextType() ?>" name="x_date_updated" id="x_date_updated" data-table="jdh_test_names" data-field="x_date_updated" value="<?= $Page->date_updated->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_updated->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->date_updated->formatPattern()) ?>"<?= $Page->date_updated->editAttributes() ?> aria-describedby="x_date_updated_help">
<?= $Page->date_updated->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date_updated->getErrorMessage() ?></div>
<?php if (!$Page->date_updated->ReadOnly && !$Page->date_updated->Disabled && !isset($Page->date_updated->EditAttrs["readonly"]) && !isset($Page->date_updated->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjdh_test_namesedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fjdh_test_namesedit", "x_date_updated", jQuery.extend(true, {"useCurrent":false,"display":{"sideBySide":false}}, options));
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
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fjdh_test_namesedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fjdh_test_namesedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("jdh_test_names");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
