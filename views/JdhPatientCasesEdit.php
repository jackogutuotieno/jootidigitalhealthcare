<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$JdhPatientCasesEdit = &$Page;
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
<form name="fjdh_patient_casesedit" id="fjdh_patient_casesedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_patient_cases: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fjdh_patient_casesedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_patient_casesedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["case_id", [fields.case_id.visible && fields.case_id.required ? ew.Validators.required(fields.case_id.caption) : null], fields.case_id.isInvalid],
            ["patient_id", [fields.patient_id.visible && fields.patient_id.required ? ew.Validators.required(fields.patient_id.caption) : null], fields.patient_id.isInvalid],
            ["history", [fields.history.visible && fields.history.required ? ew.Validators.required(fields.history.caption) : null], fields.history.isInvalid],
            ["random_blood_sugar", [fields.random_blood_sugar.visible && fields.random_blood_sugar.required ? ew.Validators.required(fields.random_blood_sugar.caption) : null], fields.random_blood_sugar.isInvalid],
            ["medical_history", [fields.medical_history.visible && fields.medical_history.required ? ew.Validators.required(fields.medical_history.caption) : null], fields.medical_history.isInvalid],
            ["family", [fields.family.visible && fields.family.required ? ew.Validators.required(fields.family.caption) : null], fields.family.isInvalid],
            ["socio_economic_history", [fields.socio_economic_history.visible && fields.socio_economic_history.required ? ew.Validators.required(fields.socio_economic_history.caption) : null], fields.socio_economic_history.isInvalid],
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
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jdh_patient_cases">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "jdh_patients") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="jdh_patients">
<input type="hidden" name="fk_patient_id" value="<?= HtmlEncode($Page->patient_id->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->case_id->Visible) { // case_id ?>
    <div id="r_case_id"<?= $Page->case_id->rowAttributes() ?>>
        <label id="elh_jdh_patient_cases_case_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->case_id->caption() ?><?= $Page->case_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->case_id->cellAttributes() ?>>
<span id="el_jdh_patient_cases_case_id">
<span<?= $Page->case_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->case_id->getDisplayValue($Page->case_id->EditValue))) ?>"></span>
<input type="hidden" data-table="jdh_patient_cases" data-field="x_case_id" data-hidden="1" name="x_case_id" id="x_case_id" value="<?= HtmlEncode($Page->case_id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
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
        data-select2-id="fjdh_patient_casesedit_x_patient_id"
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
loadjs.ready("fjdh_patient_casesedit", function() {
    var options = { name: "x_patient_id", selectId: "fjdh_patient_casesedit_x_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_patient_casesedit.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x_patient_id", form: "fjdh_patient_casesedit" };
    } else {
        options.ajax = { id: "x_patient_id", form: "fjdh_patient_casesedit", limit: ew.LOOKUP_PAGE_SIZE };
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
<?php if ($Page->random_blood_sugar->Visible) { // random_blood_sugar ?>
    <div id="r_random_blood_sugar"<?= $Page->random_blood_sugar->rowAttributes() ?>>
        <label id="elh_jdh_patient_cases_random_blood_sugar" for="x_random_blood_sugar" class="<?= $Page->LeftColumnClass ?>"><?= $Page->random_blood_sugar->caption() ?><?= $Page->random_blood_sugar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->random_blood_sugar->cellAttributes() ?>>
<span id="el_jdh_patient_cases_random_blood_sugar">
<textarea data-table="jdh_patient_cases" data-field="x_random_blood_sugar" name="x_random_blood_sugar" id="x_random_blood_sugar" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->random_blood_sugar->getPlaceHolder()) ?>"<?= $Page->random_blood_sugar->editAttributes() ?> aria-describedby="x_random_blood_sugar_help"><?= $Page->random_blood_sugar->EditValue ?></textarea>
<?= $Page->random_blood_sugar->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->random_blood_sugar->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->medical_history->Visible) { // medical_history ?>
    <div id="r_medical_history"<?= $Page->medical_history->rowAttributes() ?>>
        <label id="elh_jdh_patient_cases_medical_history" for="x_medical_history" class="<?= $Page->LeftColumnClass ?>"><?= $Page->medical_history->caption() ?><?= $Page->medical_history->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->medical_history->cellAttributes() ?>>
<span id="el_jdh_patient_cases_medical_history">
<textarea data-table="jdh_patient_cases" data-field="x_medical_history" name="x_medical_history" id="x_medical_history" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->medical_history->getPlaceHolder()) ?>"<?= $Page->medical_history->editAttributes() ?> aria-describedby="x_medical_history_help"><?= $Page->medical_history->EditValue ?></textarea>
<?= $Page->medical_history->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->medical_history->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->family->Visible) { // family ?>
    <div id="r_family"<?= $Page->family->rowAttributes() ?>>
        <label id="elh_jdh_patient_cases_family" for="x_family" class="<?= $Page->LeftColumnClass ?>"><?= $Page->family->caption() ?><?= $Page->family->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->family->cellAttributes() ?>>
<span id="el_jdh_patient_cases_family">
<textarea data-table="jdh_patient_cases" data-field="x_family" name="x_family" id="x_family" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->family->getPlaceHolder()) ?>"<?= $Page->family->editAttributes() ?> aria-describedby="x_family_help"><?= $Page->family->EditValue ?></textarea>
<?= $Page->family->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->family->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->socio_economic_history->Visible) { // socio_economic_history ?>
    <div id="r_socio_economic_history"<?= $Page->socio_economic_history->rowAttributes() ?>>
        <label id="elh_jdh_patient_cases_socio_economic_history" for="x_socio_economic_history" class="<?= $Page->LeftColumnClass ?>"><?= $Page->socio_economic_history->caption() ?><?= $Page->socio_economic_history->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->socio_economic_history->cellAttributes() ?>>
<span id="el_jdh_patient_cases_socio_economic_history">
<textarea data-table="jdh_patient_cases" data-field="x_socio_economic_history" name="x_socio_economic_history" id="x_socio_economic_history" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->socio_economic_history->getPlaceHolder()) ?>"<?= $Page->socio_economic_history->editAttributes() ?> aria-describedby="x_socio_economic_history_help"><?= $Page->socio_economic_history->EditValue ?></textarea>
<?= $Page->socio_economic_history->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->socio_economic_history->getErrorMessage() ?></div>
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
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fjdh_patient_casesedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fjdh_patient_casesedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("jdh_patient_cases");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
