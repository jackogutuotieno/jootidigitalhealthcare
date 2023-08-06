<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$JdhPatientCasesAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_patient_cases: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fjdh_patient_casesadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_patient_casesadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["patient_id", [fields.patient_id.visible && fields.patient_id.required ? ew.Validators.required(fields.patient_id.caption) : null], fields.patient_id.isInvalid],
            ["symtoms", [fields.symtoms.visible && fields.symtoms.required ? ew.Validators.required(fields.symtoms.caption) : null], fields.symtoms.isInvalid],
            ["fasting_blood_sugar", [fields.fasting_blood_sugar.visible && fields.fasting_blood_sugar.required ? ew.Validators.required(fields.fasting_blood_sugar.caption) : null], fields.fasting_blood_sugar.isInvalid],
            ["history", [fields.history.visible && fields.history.required ? ew.Validators.required(fields.history.caption) : null], fields.history.isInvalid],
            ["notes", [fields.notes.visible && fields.notes.required ? ew.Validators.required(fields.notes.caption) : null], fields.notes.isInvalid]
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
<form name="fjdh_patient_casesadd" id="fjdh_patient_casesadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jdh_patient_cases">
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
        <label id="elh_jdh_patient_cases_patient_id" for="x_patient_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->patient_id->caption() ?><?= $Page->patient_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->patient_id->cellAttributes() ?>>
<?php if ($Page->patient_id->getSessionValue() != "") { ?>
<span<?= $Page->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->patient_id->getDisplayValue($Page->patient_id->ViewValue) ?></span></span>
<input type="hidden" id="x_patient_id" name="x_patient_id" value="<?= HtmlEncode($Page->patient_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_jdh_patient_cases_patient_id">
    <select
        id="x_patient_id"
        name="x_patient_id"
        class="form-select ew-select<?= $Page->patient_id->isInvalidClass() ?>"
        data-select2-id="fjdh_patient_casesadd_x_patient_id"
        data-table="jdh_patient_cases"
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
loadjs.ready("fjdh_patient_casesadd", function() {
    var options = { name: "x_patient_id", selectId: "fjdh_patient_casesadd_x_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_patient_casesadd.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x_patient_id", form: "fjdh_patient_casesadd" };
    } else {
        options.ajax = { id: "x_patient_id", form: "fjdh_patient_casesadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_patient_cases.fields.patient_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->symtoms->Visible) { // symtoms ?>
    <div id="r_symtoms"<?= $Page->symtoms->rowAttributes() ?>>
        <label id="elh_jdh_patient_cases_symtoms" for="x_symtoms" class="<?= $Page->LeftColumnClass ?>"><?= $Page->symtoms->caption() ?><?= $Page->symtoms->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->symtoms->cellAttributes() ?>>
<span id="el_jdh_patient_cases_symtoms">
<textarea data-table="jdh_patient_cases" data-field="x_symtoms" name="x_symtoms" id="x_symtoms" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->symtoms->getPlaceHolder()) ?>"<?= $Page->symtoms->editAttributes() ?> aria-describedby="x_symtoms_help"><?= $Page->symtoms->EditValue ?></textarea>
<?= $Page->symtoms->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->symtoms->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->fasting_blood_sugar->Visible) { // fasting_blood_sugar ?>
    <div id="r_fasting_blood_sugar"<?= $Page->fasting_blood_sugar->rowAttributes() ?>>
        <label id="elh_jdh_patient_cases_fasting_blood_sugar" for="x_fasting_blood_sugar" class="<?= $Page->LeftColumnClass ?>"><?= $Page->fasting_blood_sugar->caption() ?><?= $Page->fasting_blood_sugar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->fasting_blood_sugar->cellAttributes() ?>>
<span id="el_jdh_patient_cases_fasting_blood_sugar">
<textarea data-table="jdh_patient_cases" data-field="x_fasting_blood_sugar" name="x_fasting_blood_sugar" id="x_fasting_blood_sugar" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->fasting_blood_sugar->getPlaceHolder()) ?>"<?= $Page->fasting_blood_sugar->editAttributes() ?> aria-describedby="x_fasting_blood_sugar_help"><?= $Page->fasting_blood_sugar->EditValue ?></textarea>
<?= $Page->fasting_blood_sugar->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->fasting_blood_sugar->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->history->Visible) { // history ?>
    <div id="r_history"<?= $Page->history->rowAttributes() ?>>
        <label id="elh_jdh_patient_cases_history" for="x_history" class="<?= $Page->LeftColumnClass ?>"><?= $Page->history->caption() ?><?= $Page->history->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->history->cellAttributes() ?>>
<span id="el_jdh_patient_cases_history">
<textarea data-table="jdh_patient_cases" data-field="x_history" name="x_history" id="x_history" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->history->getPlaceHolder()) ?>"<?= $Page->history->editAttributes() ?> aria-describedby="x_history_help"><?= $Page->history->EditValue ?></textarea>
<?= $Page->history->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->history->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->notes->Visible) { // notes ?>
    <div id="r_notes"<?= $Page->notes->rowAttributes() ?>>
        <label id="elh_jdh_patient_cases_notes" for="x_notes" class="<?= $Page->LeftColumnClass ?>"><?= $Page->notes->caption() ?><?= $Page->notes->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->notes->cellAttributes() ?>>
<span id="el_jdh_patient_cases_notes">
<textarea data-table="jdh_patient_cases" data-field="x_notes" name="x_notes" id="x_notes" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->notes->getPlaceHolder()) ?>"<?= $Page->notes->editAttributes() ?> aria-describedby="x_notes_help"><?= $Page->notes->EditValue ?></textarea>
<?= $Page->notes->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->notes->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fjdh_patient_casesadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fjdh_patient_casesadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("jdh_patient_cases");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
