<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$JdhVitalsAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_vitals: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fjdh_vitalsadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_vitalsadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["patient_id", [fields.patient_id.visible && fields.patient_id.required ? ew.Validators.required(fields.patient_id.caption) : null], fields.patient_id.isInvalid],
            ["pressure", [fields.pressure.visible && fields.pressure.required ? ew.Validators.required(fields.pressure.caption) : null], fields.pressure.isInvalid],
            ["height", [fields.height.visible && fields.height.required ? ew.Validators.required(fields.height.caption) : null, ew.Validators.float], fields.height.isInvalid],
            ["weight", [fields.weight.visible && fields.weight.required ? ew.Validators.required(fields.weight.caption) : null, ew.Validators.integer], fields.weight.isInvalid],
            ["pulse_rate", [fields.pulse_rate.visible && fields.pulse_rate.required ? ew.Validators.required(fields.pulse_rate.caption) : null, ew.Validators.integer], fields.pulse_rate.isInvalid],
            ["respiratory_rate", [fields.respiratory_rate.visible && fields.respiratory_rate.required ? ew.Validators.required(fields.respiratory_rate.caption) : null, ew.Validators.integer], fields.respiratory_rate.isInvalid],
            ["temperature", [fields.temperature.visible && fields.temperature.required ? ew.Validators.required(fields.temperature.caption) : null, ew.Validators.float], fields.temperature.isInvalid],
            ["random_blood_sugar", [fields.random_blood_sugar.visible && fields.random_blood_sugar.required ? ew.Validators.required(fields.random_blood_sugar.caption) : null], fields.random_blood_sugar.isInvalid],
            ["submitted_by_user_id", [fields.submitted_by_user_id.visible && fields.submitted_by_user_id.required ? ew.Validators.required(fields.submitted_by_user_id.caption) : null], fields.submitted_by_user_id.isInvalid]
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
<form name="fjdh_vitalsadd" id="fjdh_vitalsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jdh_vitals">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "jdh_patients") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="jdh_patients">
<input type="hidden" name="fk_patient_id" value="<?= HtmlEncode($Page->patient_id->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->patient_id->Visible) { // patient_id ?>
    <div id="r_patient_id"<?= $Page->patient_id->rowAttributes() ?>>
        <label id="elh_jdh_vitals_patient_id" for="x_patient_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->patient_id->caption() ?><?= $Page->patient_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->patient_id->cellAttributes() ?>>
<?php if ($Page->patient_id->getSessionValue() != "") { ?>
<span<?= $Page->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->patient_id->getDisplayValue($Page->patient_id->ViewValue) ?></span></span>
<input type="hidden" id="x_patient_id" name="x_patient_id" value="<?= HtmlEncode($Page->patient_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_jdh_vitals_patient_id">
    <select
        id="x_patient_id"
        name="x_patient_id"
        class="form-select ew-select<?= $Page->patient_id->isInvalidClass() ?>"
        data-select2-id="fjdh_vitalsadd_x_patient_id"
        data-table="jdh_vitals"
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
loadjs.ready("fjdh_vitalsadd", function() {
    var options = { name: "x_patient_id", selectId: "fjdh_vitalsadd_x_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_vitalsadd.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x_patient_id", form: "fjdh_vitalsadd" };
    } else {
        options.ajax = { id: "x_patient_id", form: "fjdh_vitalsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_vitals.fields.patient_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->pressure->Visible) { // pressure ?>
    <div id="r_pressure"<?= $Page->pressure->rowAttributes() ?>>
        <label id="elh_jdh_vitals_pressure" for="x_pressure" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pressure->caption() ?><?= $Page->pressure->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->pressure->cellAttributes() ?>>
<span id="el_jdh_vitals_pressure">
<input type="<?= $Page->pressure->getInputTextType() ?>" name="x_pressure" id="x_pressure" data-table="jdh_vitals" data-field="x_pressure" value="<?= $Page->pressure->EditValue ?>" size="30" maxlength="30" placeholder="<?= HtmlEncode($Page->pressure->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->pressure->formatPattern()) ?>"<?= $Page->pressure->editAttributes() ?> aria-describedby="x_pressure_help">
<?= $Page->pressure->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->pressure->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->height->Visible) { // height ?>
    <div id="r_height"<?= $Page->height->rowAttributes() ?>>
        <label id="elh_jdh_vitals_height" for="x_height" class="<?= $Page->LeftColumnClass ?>"><?= $Page->height->caption() ?><?= $Page->height->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->height->cellAttributes() ?>>
<span id="el_jdh_vitals_height">
<input type="<?= $Page->height->getInputTextType() ?>" name="x_height" id="x_height" data-table="jdh_vitals" data-field="x_height" value="<?= $Page->height->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->height->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->height->formatPattern()) ?>"<?= $Page->height->editAttributes() ?> aria-describedby="x_height_help">
<?= $Page->height->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->height->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->weight->Visible) { // weight ?>
    <div id="r_weight"<?= $Page->weight->rowAttributes() ?>>
        <label id="elh_jdh_vitals_weight" for="x_weight" class="<?= $Page->LeftColumnClass ?>"><?= $Page->weight->caption() ?><?= $Page->weight->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->weight->cellAttributes() ?>>
<span id="el_jdh_vitals_weight">
<input type="<?= $Page->weight->getInputTextType() ?>" name="x_weight" id="x_weight" data-table="jdh_vitals" data-field="x_weight" value="<?= $Page->weight->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->weight->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->weight->formatPattern()) ?>"<?= $Page->weight->editAttributes() ?> aria-describedby="x_weight_help">
<?= $Page->weight->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->weight->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->pulse_rate->Visible) { // pulse_rate ?>
    <div id="r_pulse_rate"<?= $Page->pulse_rate->rowAttributes() ?>>
        <label id="elh_jdh_vitals_pulse_rate" for="x_pulse_rate" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pulse_rate->caption() ?><?= $Page->pulse_rate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->pulse_rate->cellAttributes() ?>>
<span id="el_jdh_vitals_pulse_rate">
<input type="<?= $Page->pulse_rate->getInputTextType() ?>" name="x_pulse_rate" id="x_pulse_rate" data-table="jdh_vitals" data-field="x_pulse_rate" value="<?= $Page->pulse_rate->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->pulse_rate->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->pulse_rate->formatPattern()) ?>"<?= $Page->pulse_rate->editAttributes() ?> aria-describedby="x_pulse_rate_help">
<?= $Page->pulse_rate->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->pulse_rate->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->respiratory_rate->Visible) { // respiratory_rate ?>
    <div id="r_respiratory_rate"<?= $Page->respiratory_rate->rowAttributes() ?>>
        <label id="elh_jdh_vitals_respiratory_rate" for="x_respiratory_rate" class="<?= $Page->LeftColumnClass ?>"><?= $Page->respiratory_rate->caption() ?><?= $Page->respiratory_rate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->respiratory_rate->cellAttributes() ?>>
<span id="el_jdh_vitals_respiratory_rate">
<input type="<?= $Page->respiratory_rate->getInputTextType() ?>" name="x_respiratory_rate" id="x_respiratory_rate" data-table="jdh_vitals" data-field="x_respiratory_rate" value="<?= $Page->respiratory_rate->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->respiratory_rate->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->respiratory_rate->formatPattern()) ?>"<?= $Page->respiratory_rate->editAttributes() ?> aria-describedby="x_respiratory_rate_help">
<?= $Page->respiratory_rate->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->respiratory_rate->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->temperature->Visible) { // temperature ?>
    <div id="r_temperature"<?= $Page->temperature->rowAttributes() ?>>
        <label id="elh_jdh_vitals_temperature" for="x_temperature" class="<?= $Page->LeftColumnClass ?>"><?= $Page->temperature->caption() ?><?= $Page->temperature->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->temperature->cellAttributes() ?>>
<span id="el_jdh_vitals_temperature">
<input type="<?= $Page->temperature->getInputTextType() ?>" name="x_temperature" id="x_temperature" data-table="jdh_vitals" data-field="x_temperature" value="<?= $Page->temperature->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->temperature->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->temperature->formatPattern()) ?>"<?= $Page->temperature->editAttributes() ?> aria-describedby="x_temperature_help">
<?= $Page->temperature->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->temperature->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->random_blood_sugar->Visible) { // random_blood_sugar ?>
    <div id="r_random_blood_sugar"<?= $Page->random_blood_sugar->rowAttributes() ?>>
        <label id="elh_jdh_vitals_random_blood_sugar" for="x_random_blood_sugar" class="<?= $Page->LeftColumnClass ?>"><?= $Page->random_blood_sugar->caption() ?><?= $Page->random_blood_sugar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->random_blood_sugar->cellAttributes() ?>>
<span id="el_jdh_vitals_random_blood_sugar">
<input type="<?= $Page->random_blood_sugar->getInputTextType() ?>" name="x_random_blood_sugar" id="x_random_blood_sugar" data-table="jdh_vitals" data-field="x_random_blood_sugar" value="<?= $Page->random_blood_sugar->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->random_blood_sugar->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->random_blood_sugar->formatPattern()) ?>"<?= $Page->random_blood_sugar->editAttributes() ?> aria-describedby="x_random_blood_sugar_help">
<?= $Page->random_blood_sugar->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->random_blood_sugar->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fjdh_vitalsadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fjdh_vitalsadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("jdh_vitals");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
