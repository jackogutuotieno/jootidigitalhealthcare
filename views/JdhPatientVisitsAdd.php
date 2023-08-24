<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$JdhPatientVisitsAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_patient_visits: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fjdh_patient_visitsadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_patient_visitsadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["patient_id", [fields.patient_id.visible && fields.patient_id.required ? ew.Validators.required(fields.patient_id.caption) : null], fields.patient_id.isInvalid],
            ["visit_type_id", [fields.visit_type_id.visible && fields.visit_type_id.required ? ew.Validators.required(fields.visit_type_id.caption) : null], fields.visit_type_id.isInvalid],
            ["doctor_id", [fields.doctor_id.visible && fields.doctor_id.required ? ew.Validators.required(fields.doctor_id.caption) : null], fields.doctor_id.isInvalid],
            ["insurance_id", [fields.insurance_id.visible && fields.insurance_id.required ? ew.Validators.required(fields.insurance_id.caption) : null], fields.insurance_id.isInvalid],
            ["visit_description", [fields.visit_description.visible && fields.visit_description.required ? ew.Validators.required(fields.visit_description.caption) : null], fields.visit_description.isInvalid]
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
            "visit_type_id": <?= $Page->visit_type_id->toClientList($Page) ?>,
            "doctor_id": <?= $Page->doctor_id->toClientList($Page) ?>,
            "insurance_id": <?= $Page->insurance_id->toClientList($Page) ?>,
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
<form name="fjdh_patient_visitsadd" id="fjdh_patient_visitsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jdh_patient_visits">
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
        <label id="elh_jdh_patient_visits_patient_id" for="x_patient_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->patient_id->caption() ?><?= $Page->patient_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->patient_id->cellAttributes() ?>>
<?php if ($Page->patient_id->getSessionValue() != "") { ?>
<span<?= $Page->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->patient_id->getDisplayValue($Page->patient_id->ViewValue) ?></span></span>
<input type="hidden" id="x_patient_id" name="x_patient_id" value="<?= HtmlEncode($Page->patient_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_jdh_patient_visits_patient_id">
    <select
        id="x_patient_id"
        name="x_patient_id"
        class="form-select ew-select<?= $Page->patient_id->isInvalidClass() ?>"
        data-select2-id="fjdh_patient_visitsadd_x_patient_id"
        data-table="jdh_patient_visits"
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
loadjs.ready("fjdh_patient_visitsadd", function() {
    var options = { name: "x_patient_id", selectId: "fjdh_patient_visitsadd_x_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_patient_visitsadd.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x_patient_id", form: "fjdh_patient_visitsadd" };
    } else {
        options.ajax = { id: "x_patient_id", form: "fjdh_patient_visitsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_patient_visits.fields.patient_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->visit_type_id->Visible) { // visit_type_id ?>
    <div id="r_visit_type_id"<?= $Page->visit_type_id->rowAttributes() ?>>
        <label id="elh_jdh_patient_visits_visit_type_id" for="x_visit_type_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->visit_type_id->caption() ?><?= $Page->visit_type_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->visit_type_id->cellAttributes() ?>>
<span id="el_jdh_patient_visits_visit_type_id">
    <select
        id="x_visit_type_id"
        name="x_visit_type_id"
        class="form-select ew-select<?= $Page->visit_type_id->isInvalidClass() ?>"
        data-select2-id="fjdh_patient_visitsadd_x_visit_type_id"
        data-table="jdh_patient_visits"
        data-field="x_visit_type_id"
        data-value-separator="<?= $Page->visit_type_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->visit_type_id->getPlaceHolder()) ?>"
        <?= $Page->visit_type_id->editAttributes() ?>>
        <?= $Page->visit_type_id->selectOptionListHtml("x_visit_type_id") ?>
    </select>
    <?= $Page->visit_type_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->visit_type_id->getErrorMessage() ?></div>
<?= $Page->visit_type_id->Lookup->getParamTag($Page, "p_x_visit_type_id") ?>
<script>
loadjs.ready("fjdh_patient_visitsadd", function() {
    var options = { name: "x_visit_type_id", selectId: "fjdh_patient_visitsadd_x_visit_type_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_patient_visitsadd.lists.visit_type_id?.lookupOptions.length) {
        options.data = { id: "x_visit_type_id", form: "fjdh_patient_visitsadd" };
    } else {
        options.ajax = { id: "x_visit_type_id", form: "fjdh_patient_visitsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_patient_visits.fields.visit_type_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->doctor_id->Visible) { // doctor_id ?>
    <div id="r_doctor_id"<?= $Page->doctor_id->rowAttributes() ?>>
        <label id="elh_jdh_patient_visits_doctor_id" for="x_doctor_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->doctor_id->caption() ?><?= $Page->doctor_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->doctor_id->cellAttributes() ?>>
<span id="el_jdh_patient_visits_doctor_id">
    <select
        id="x_doctor_id"
        name="x_doctor_id"
        class="form-select ew-select<?= $Page->doctor_id->isInvalidClass() ?>"
        data-select2-id="fjdh_patient_visitsadd_x_doctor_id"
        data-table="jdh_patient_visits"
        data-field="x_doctor_id"
        data-value-separator="<?= $Page->doctor_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->doctor_id->getPlaceHolder()) ?>"
        <?= $Page->doctor_id->editAttributes() ?>>
        <?= $Page->doctor_id->selectOptionListHtml("x_doctor_id") ?>
    </select>
    <?= $Page->doctor_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->doctor_id->getErrorMessage() ?></div>
<?= $Page->doctor_id->Lookup->getParamTag($Page, "p_x_doctor_id") ?>
<script>
loadjs.ready("fjdh_patient_visitsadd", function() {
    var options = { name: "x_doctor_id", selectId: "fjdh_patient_visitsadd_x_doctor_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_patient_visitsadd.lists.doctor_id?.lookupOptions.length) {
        options.data = { id: "x_doctor_id", form: "fjdh_patient_visitsadd" };
    } else {
        options.ajax = { id: "x_doctor_id", form: "fjdh_patient_visitsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_patient_visits.fields.doctor_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->insurance_id->Visible) { // insurance_id ?>
    <div id="r_insurance_id"<?= $Page->insurance_id->rowAttributes() ?>>
        <label id="elh_jdh_patient_visits_insurance_id" for="x_insurance_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->insurance_id->caption() ?><?= $Page->insurance_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->insurance_id->cellAttributes() ?>>
<span id="el_jdh_patient_visits_insurance_id">
    <select
        id="x_insurance_id"
        name="x_insurance_id"
        class="form-select ew-select<?= $Page->insurance_id->isInvalidClass() ?>"
        data-select2-id="fjdh_patient_visitsadd_x_insurance_id"
        data-table="jdh_patient_visits"
        data-field="x_insurance_id"
        data-value-separator="<?= $Page->insurance_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->insurance_id->getPlaceHolder()) ?>"
        <?= $Page->insurance_id->editAttributes() ?>>
        <?= $Page->insurance_id->selectOptionListHtml("x_insurance_id") ?>
    </select>
    <?= $Page->insurance_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->insurance_id->getErrorMessage() ?></div>
<?= $Page->insurance_id->Lookup->getParamTag($Page, "p_x_insurance_id") ?>
<script>
loadjs.ready("fjdh_patient_visitsadd", function() {
    var options = { name: "x_insurance_id", selectId: "fjdh_patient_visitsadd_x_insurance_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_patient_visitsadd.lists.insurance_id?.lookupOptions.length) {
        options.data = { id: "x_insurance_id", form: "fjdh_patient_visitsadd" };
    } else {
        options.ajax = { id: "x_insurance_id", form: "fjdh_patient_visitsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_patient_visits.fields.insurance_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->visit_description->Visible) { // visit_description ?>
    <div id="r_visit_description"<?= $Page->visit_description->rowAttributes() ?>>
        <label id="elh_jdh_patient_visits_visit_description" for="x_visit_description" class="<?= $Page->LeftColumnClass ?>"><?= $Page->visit_description->caption() ?><?= $Page->visit_description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->visit_description->cellAttributes() ?>>
<span id="el_jdh_patient_visits_visit_description">
<textarea data-table="jdh_patient_visits" data-field="x_visit_description" name="x_visit_description" id="x_visit_description" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->visit_description->getPlaceHolder()) ?>"<?= $Page->visit_description->editAttributes() ?> aria-describedby="x_visit_description_help"><?= $Page->visit_description->EditValue ?></textarea>
<?= $Page->visit_description->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->visit_description->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fjdh_patient_visitsadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fjdh_patient_visitsadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("jdh_patient_visits");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
