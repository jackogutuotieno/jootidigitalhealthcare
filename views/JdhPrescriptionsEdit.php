<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$JdhPrescriptionsEdit = &$Page;
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
<form name="fjdh_prescriptionsedit" id="fjdh_prescriptionsedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_prescriptions: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fjdh_prescriptionsedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_prescriptionsedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["prescription_id", [fields.prescription_id.visible && fields.prescription_id.required ? ew.Validators.required(fields.prescription_id.caption) : null], fields.prescription_id.isInvalid],
            ["patient_id", [fields.patient_id.visible && fields.patient_id.required ? ew.Validators.required(fields.patient_id.caption) : null], fields.patient_id.isInvalid],
            ["prescription_title", [fields.prescription_title.visible && fields.prescription_title.required ? ew.Validators.required(fields.prescription_title.caption) : null], fields.prescription_title.isInvalid],
            ["medicine_id", [fields.medicine_id.visible && fields.medicine_id.required ? ew.Validators.required(fields.medicine_id.caption) : null], fields.medicine_id.isInvalid],
            ["tabs", [fields.tabs.visible && fields.tabs.required ? ew.Validators.required(fields.tabs.caption) : null], fields.tabs.isInvalid],
            ["frequency", [fields.frequency.visible && fields.frequency.required ? ew.Validators.required(fields.frequency.caption) : null], fields.frequency.isInvalid],
            ["prescription_time", [fields.prescription_time.visible && fields.prescription_time.required ? ew.Validators.required(fields.prescription_time.caption) : null], fields.prescription_time.isInvalid],
            ["prescription_date", [fields.prescription_date.visible && fields.prescription_date.required ? ew.Validators.required(fields.prescription_date.caption) : null, ew.Validators.datetime(fields.prescription_date.clientFormatPattern)], fields.prescription_date.isInvalid],
            ["submitted_by_user_id", [fields.submitted_by_user_id.visible && fields.submitted_by_user_id.required ? ew.Validators.required(fields.submitted_by_user_id.caption) : null, ew.Validators.integer], fields.submitted_by_user_id.isInvalid]
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
            "medicine_id": <?= $Page->medicine_id->toClientList($Page) ?>,
            "frequency": <?= $Page->frequency->toClientList($Page) ?>,
            "prescription_time": <?= $Page->prescription_time->toClientList($Page) ?>,
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
<input type="hidden" name="t" value="jdh_prescriptions">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->prescription_id->Visible) { // prescription_id ?>
    <div id="r_prescription_id"<?= $Page->prescription_id->rowAttributes() ?>>
        <label id="elh_jdh_prescriptions_prescription_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->prescription_id->caption() ?><?= $Page->prescription_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->prescription_id->cellAttributes() ?>>
<span id="el_jdh_prescriptions_prescription_id">
<span<?= $Page->prescription_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->prescription_id->getDisplayValue($Page->prescription_id->EditValue))) ?>"></span>
<input type="hidden" data-table="jdh_prescriptions" data-field="x_prescription_id" data-hidden="1" name="x_prescription_id" id="x_prescription_id" value="<?= HtmlEncode($Page->prescription_id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
    <div id="r_patient_id"<?= $Page->patient_id->rowAttributes() ?>>
        <label id="elh_jdh_prescriptions_patient_id" for="x_patient_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->patient_id->caption() ?><?= $Page->patient_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->patient_id->cellAttributes() ?>>
<span id="el_jdh_prescriptions_patient_id">
    <select
        id="x_patient_id"
        name="x_patient_id"
        class="form-select ew-select<?= $Page->patient_id->isInvalidClass() ?>"
        data-select2-id="fjdh_prescriptionsedit_x_patient_id"
        data-table="jdh_prescriptions"
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
loadjs.ready("fjdh_prescriptionsedit", function() {
    var options = { name: "x_patient_id", selectId: "fjdh_prescriptionsedit_x_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_prescriptionsedit.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x_patient_id", form: "fjdh_prescriptionsedit" };
    } else {
        options.ajax = { id: "x_patient_id", form: "fjdh_prescriptionsedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_prescriptions.fields.patient_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->prescription_title->Visible) { // prescription_title ?>
    <div id="r_prescription_title"<?= $Page->prescription_title->rowAttributes() ?>>
        <label id="elh_jdh_prescriptions_prescription_title" for="x_prescription_title" class="<?= $Page->LeftColumnClass ?>"><?= $Page->prescription_title->caption() ?><?= $Page->prescription_title->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->prescription_title->cellAttributes() ?>>
<span id="el_jdh_prescriptions_prescription_title">
<input type="<?= $Page->prescription_title->getInputTextType() ?>" name="x_prescription_title" id="x_prescription_title" data-table="jdh_prescriptions" data-field="x_prescription_title" value="<?= $Page->prescription_title->EditValue ?>" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->prescription_title->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->prescription_title->formatPattern()) ?>"<?= $Page->prescription_title->editAttributes() ?> aria-describedby="x_prescription_title_help">
<?= $Page->prescription_title->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->prescription_title->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->medicine_id->Visible) { // medicine_id ?>
    <div id="r_medicine_id"<?= $Page->medicine_id->rowAttributes() ?>>
        <label id="elh_jdh_prescriptions_medicine_id" for="x_medicine_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->medicine_id->caption() ?><?= $Page->medicine_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->medicine_id->cellAttributes() ?>>
<span id="el_jdh_prescriptions_medicine_id">
    <select
        id="x_medicine_id"
        name="x_medicine_id"
        class="form-select ew-select<?= $Page->medicine_id->isInvalidClass() ?>"
        data-select2-id="fjdh_prescriptionsedit_x_medicine_id"
        data-table="jdh_prescriptions"
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
loadjs.ready("fjdh_prescriptionsedit", function() {
    var options = { name: "x_medicine_id", selectId: "fjdh_prescriptionsedit_x_medicine_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_prescriptionsedit.lists.medicine_id?.lookupOptions.length) {
        options.data = { id: "x_medicine_id", form: "fjdh_prescriptionsedit" };
    } else {
        options.ajax = { id: "x_medicine_id", form: "fjdh_prescriptionsedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_prescriptions.fields.medicine_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tabs->Visible) { // tabs ?>
    <div id="r_tabs"<?= $Page->tabs->rowAttributes() ?>>
        <label id="elh_jdh_prescriptions_tabs" for="x_tabs" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tabs->caption() ?><?= $Page->tabs->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tabs->cellAttributes() ?>>
<span id="el_jdh_prescriptions_tabs">
<input type="<?= $Page->tabs->getInputTextType() ?>" name="x_tabs" id="x_tabs" data-table="jdh_prescriptions" data-field="x_tabs" value="<?= $Page->tabs->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->tabs->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->tabs->formatPattern()) ?>"<?= $Page->tabs->editAttributes() ?> aria-describedby="x_tabs_help">
<?= $Page->tabs->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tabs->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->frequency->Visible) { // frequency ?>
    <div id="r_frequency"<?= $Page->frequency->rowAttributes() ?>>
        <label id="elh_jdh_prescriptions_frequency" class="<?= $Page->LeftColumnClass ?>"><?= $Page->frequency->caption() ?><?= $Page->frequency->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->frequency->cellAttributes() ?>>
<span id="el_jdh_prescriptions_frequency">
<?php
if (IsRTL()) {
    $Page->frequency->EditAttrs["dir"] = "rtl";
}
?>
<span id="as_x_frequency" class="ew-auto-suggest">
    <input type="<?= $Page->frequency->getInputTextType() ?>" class="form-control" name="sv_x_frequency" id="sv_x_frequency" value="<?= RemoveHtml($Page->frequency->EditValue) ?>" autocomplete="off" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->frequency->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Page->frequency->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->frequency->formatPattern()) ?>"<?= $Page->frequency->editAttributes() ?> aria-describedby="x_frequency_help">
</span>
<selection-list hidden class="form-control" data-table="jdh_prescriptions" data-field="x_frequency" data-input="sv_x_frequency" data-value-separator="<?= $Page->frequency->displayValueSeparatorAttribute() ?>" name="x_frequency" id="x_frequency" value="<?= HtmlEncode($Page->frequency->CurrentValue) ?>"></selection-list>
<?= $Page->frequency->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->frequency->getErrorMessage() ?></div>
<script>
loadjs.ready("fjdh_prescriptionsedit", function() {
    fjdh_prescriptionsedit.createAutoSuggest(Object.assign({"id":"x_frequency","forceSelect":false}, { lookupAllDisplayFields: <?= $Page->frequency->Lookup->LookupAllDisplayFields ? "true" : "false" ?> }, ew.vars.tables.jdh_prescriptions.fields.frequency.autoSuggestOptions));
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->prescription_time->Visible) { // prescription_time ?>
    <div id="r_prescription_time"<?= $Page->prescription_time->rowAttributes() ?>>
        <label id="elh_jdh_prescriptions_prescription_time" for="x_prescription_time" class="<?= $Page->LeftColumnClass ?>"><?= $Page->prescription_time->caption() ?><?= $Page->prescription_time->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->prescription_time->cellAttributes() ?>>
<span id="el_jdh_prescriptions_prescription_time">
    <select
        id="x_prescription_time"
        name="x_prescription_time"
        class="form-select ew-select<?= $Page->prescription_time->isInvalidClass() ?>"
        data-select2-id="fjdh_prescriptionsedit_x_prescription_time"
        data-table="jdh_prescriptions"
        data-field="x_prescription_time"
        data-value-separator="<?= $Page->prescription_time->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->prescription_time->getPlaceHolder()) ?>"
        <?= $Page->prescription_time->editAttributes() ?>>
        <?= $Page->prescription_time->selectOptionListHtml("x_prescription_time") ?>
    </select>
    <?= $Page->prescription_time->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->prescription_time->getErrorMessage() ?></div>
<script>
loadjs.ready("fjdh_prescriptionsedit", function() {
    var options = { name: "x_prescription_time", selectId: "fjdh_prescriptionsedit_x_prescription_time" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_prescriptionsedit.lists.prescription_time?.lookupOptions.length) {
        options.data = { id: "x_prescription_time", form: "fjdh_prescriptionsedit" };
    } else {
        options.ajax = { id: "x_prescription_time", form: "fjdh_prescriptionsedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_prescriptions.fields.prescription_time.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->prescription_date->Visible) { // prescription_date ?>
    <div id="r_prescription_date"<?= $Page->prescription_date->rowAttributes() ?>>
        <label id="elh_jdh_prescriptions_prescription_date" for="x_prescription_date" class="<?= $Page->LeftColumnClass ?>"><?= $Page->prescription_date->caption() ?><?= $Page->prescription_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->prescription_date->cellAttributes() ?>>
<span id="el_jdh_prescriptions_prescription_date">
<input type="<?= $Page->prescription_date->getInputTextType() ?>" name="x_prescription_date" id="x_prescription_date" data-table="jdh_prescriptions" data-field="x_prescription_date" value="<?= $Page->prescription_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->prescription_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->prescription_date->formatPattern()) ?>"<?= $Page->prescription_date->editAttributes() ?> aria-describedby="x_prescription_date_help">
<?= $Page->prescription_date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->prescription_date->getErrorMessage() ?></div>
<?php if (!$Page->prescription_date->ReadOnly && !$Page->prescription_date->Disabled && !isset($Page->prescription_date->EditAttrs["readonly"]) && !isset($Page->prescription_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjdh_prescriptionsedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fjdh_prescriptionsedit", "x_prescription_date", jQuery.extend(true, {"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->submitted_by_user_id->Visible) { // submitted_by_user_id ?>
    <div id="r_submitted_by_user_id"<?= $Page->submitted_by_user_id->rowAttributes() ?>>
        <label id="elh_jdh_prescriptions_submitted_by_user_id" for="x_submitted_by_user_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->submitted_by_user_id->caption() ?><?= $Page->submitted_by_user_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->submitted_by_user_id->cellAttributes() ?>>
<span id="el_jdh_prescriptions_submitted_by_user_id">
<input type="<?= $Page->submitted_by_user_id->getInputTextType() ?>" name="x_submitted_by_user_id" id="x_submitted_by_user_id" data-table="jdh_prescriptions" data-field="x_submitted_by_user_id" value="<?= $Page->submitted_by_user_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->submitted_by_user_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->submitted_by_user_id->formatPattern()) ?>"<?= $Page->submitted_by_user_id->editAttributes() ?> aria-describedby="x_submitted_by_user_id_help">
<?= $Page->submitted_by_user_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->submitted_by_user_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fjdh_prescriptionsedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fjdh_prescriptionsedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("jdh_prescriptions");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
