<?php

namespace PHPMaker2024\jootidigitalhealthcare;

// Page object
$JdhIpdAdmissionAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_ipd_admission: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fjdh_ipd_admissionadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_ipd_admissionadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["unit_id", [fields.unit_id.visible && fields.unit_id.required ? ew.Validators.required(fields.unit_id.caption) : null], fields.unit_id.isInvalid],
            ["ward_id", [fields.ward_id.visible && fields.ward_id.required ? ew.Validators.required(fields.ward_id.caption) : null], fields.ward_id.isInvalid],
            ["bed_id", [fields.bed_id.visible && fields.bed_id.required ? ew.Validators.required(fields.bed_id.caption) : null], fields.bed_id.isInvalid],
            ["patient_id", [fields.patient_id.visible && fields.patient_id.required ? ew.Validators.required(fields.patient_id.caption) : null], fields.patient_id.isInvalid]
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
            "unit_id": <?= $Page->unit_id->toClientList($Page) ?>,
            "ward_id": <?= $Page->ward_id->toClientList($Page) ?>,
            "bed_id": <?= $Page->bed_id->toClientList($Page) ?>,
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
<form name="fjdh_ipd_admissionadd" id="fjdh_ipd_admissionadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jdh_ipd_admission">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->unit_id->Visible) { // unit_id ?>
    <div id="r_unit_id"<?= $Page->unit_id->rowAttributes() ?>>
        <label id="elh_jdh_ipd_admission_unit_id" for="x_unit_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->unit_id->caption() ?><?= $Page->unit_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->unit_id->cellAttributes() ?>>
<span id="el_jdh_ipd_admission_unit_id">
    <select
        id="x_unit_id"
        name="x_unit_id"
        class="form-select ew-select<?= $Page->unit_id->isInvalidClass() ?>"
        <?php if (!$Page->unit_id->IsNativeSelect) { ?>
        data-select2-id="fjdh_ipd_admissionadd_x_unit_id"
        <?php } ?>
        data-table="jdh_ipd_admission"
        data-field="x_unit_id"
        data-value-separator="<?= $Page->unit_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->unit_id->getPlaceHolder()) ?>"
        data-ew-action="update-options"
        <?= $Page->unit_id->editAttributes() ?>>
        <?= $Page->unit_id->selectOptionListHtml("x_unit_id") ?>
    </select>
    <?= $Page->unit_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->unit_id->getErrorMessage() ?></div>
<?= $Page->unit_id->Lookup->getParamTag($Page, "p_x_unit_id") ?>
<?php if (!$Page->unit_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fjdh_ipd_admissionadd", function() {
    var options = { name: "x_unit_id", selectId: "fjdh_ipd_admissionadd_x_unit_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_ipd_admissionadd.lists.unit_id?.lookupOptions.length) {
        options.data = { id: "x_unit_id", form: "fjdh_ipd_admissionadd" };
    } else {
        options.ajax = { id: "x_unit_id", form: "fjdh_ipd_admissionadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_ipd_admission.fields.unit_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ward_id->Visible) { // ward_id ?>
    <div id="r_ward_id"<?= $Page->ward_id->rowAttributes() ?>>
        <label id="elh_jdh_ipd_admission_ward_id" for="x_ward_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ward_id->caption() ?><?= $Page->ward_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->ward_id->cellAttributes() ?>>
<span id="el_jdh_ipd_admission_ward_id">
    <select
        id="x_ward_id"
        name="x_ward_id"
        class="form-select ew-select<?= $Page->ward_id->isInvalidClass() ?>"
        <?php if (!$Page->ward_id->IsNativeSelect) { ?>
        data-select2-id="fjdh_ipd_admissionadd_x_ward_id"
        <?php } ?>
        data-table="jdh_ipd_admission"
        data-field="x_ward_id"
        data-value-separator="<?= $Page->ward_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->ward_id->getPlaceHolder()) ?>"
        data-ew-action="update-options"
        <?= $Page->ward_id->editAttributes() ?>>
        <?= $Page->ward_id->selectOptionListHtml("x_ward_id") ?>
    </select>
    <?= $Page->ward_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->ward_id->getErrorMessage() ?></div>
<?= $Page->ward_id->Lookup->getParamTag($Page, "p_x_ward_id") ?>
<?php if (!$Page->ward_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fjdh_ipd_admissionadd", function() {
    var options = { name: "x_ward_id", selectId: "fjdh_ipd_admissionadd_x_ward_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_ipd_admissionadd.lists.ward_id?.lookupOptions.length) {
        options.data = { id: "x_ward_id", form: "fjdh_ipd_admissionadd" };
    } else {
        options.ajax = { id: "x_ward_id", form: "fjdh_ipd_admissionadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_ipd_admission.fields.ward_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->bed_id->Visible) { // bed_id ?>
    <div id="r_bed_id"<?= $Page->bed_id->rowAttributes() ?>>
        <label id="elh_jdh_ipd_admission_bed_id" for="x_bed_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->bed_id->caption() ?><?= $Page->bed_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->bed_id->cellAttributes() ?>>
<span id="el_jdh_ipd_admission_bed_id">
    <select
        id="x_bed_id"
        name="x_bed_id"
        class="form-select ew-select<?= $Page->bed_id->isInvalidClass() ?>"
        <?php if (!$Page->bed_id->IsNativeSelect) { ?>
        data-select2-id="fjdh_ipd_admissionadd_x_bed_id"
        <?php } ?>
        data-table="jdh_ipd_admission"
        data-field="x_bed_id"
        data-value-separator="<?= $Page->bed_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->bed_id->getPlaceHolder()) ?>"
        <?= $Page->bed_id->editAttributes() ?>>
        <?= $Page->bed_id->selectOptionListHtml("x_bed_id") ?>
    </select>
    <?= $Page->bed_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->bed_id->getErrorMessage() ?></div>
<?= $Page->bed_id->Lookup->getParamTag($Page, "p_x_bed_id") ?>
<?php if (!$Page->bed_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fjdh_ipd_admissionadd", function() {
    var options = { name: "x_bed_id", selectId: "fjdh_ipd_admissionadd_x_bed_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_ipd_admissionadd.lists.bed_id?.lookupOptions.length) {
        options.data = { id: "x_bed_id", form: "fjdh_ipd_admissionadd" };
    } else {
        options.ajax = { id: "x_bed_id", form: "fjdh_ipd_admissionadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_ipd_admission.fields.bed_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
    <div id="r_patient_id"<?= $Page->patient_id->rowAttributes() ?>>
        <label id="elh_jdh_ipd_admission_patient_id" for="x_patient_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->patient_id->caption() ?><?= $Page->patient_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->patient_id->cellAttributes() ?>>
<span id="el_jdh_ipd_admission_patient_id">
    <select
        id="x_patient_id"
        name="x_patient_id"
        class="form-select ew-select<?= $Page->patient_id->isInvalidClass() ?>"
        <?php if (!$Page->patient_id->IsNativeSelect) { ?>
        data-select2-id="fjdh_ipd_admissionadd_x_patient_id"
        <?php } ?>
        data-table="jdh_ipd_admission"
        data-field="x_patient_id"
        data-value-separator="<?= $Page->patient_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->patient_id->getPlaceHolder()) ?>"
        <?= $Page->patient_id->editAttributes() ?>>
        <?= $Page->patient_id->selectOptionListHtml("x_patient_id") ?>
    </select>
    <?= $Page->patient_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->patient_id->getErrorMessage() ?></div>
<?= $Page->patient_id->Lookup->getParamTag($Page, "p_x_patient_id") ?>
<?php if (!$Page->patient_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fjdh_ipd_admissionadd", function() {
    var options = { name: "x_patient_id", selectId: "fjdh_ipd_admissionadd_x_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_ipd_admissionadd.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x_patient_id", form: "fjdh_ipd_admissionadd" };
    } else {
        options.ajax = { id: "x_patient_id", form: "fjdh_ipd_admissionadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_ipd_admission.fields.patient_id.selectOptions);
    ew.createSelect(options);
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
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fjdh_ipd_admissionadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fjdh_ipd_admissionadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("jdh_ipd_admission");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
