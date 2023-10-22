<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$JdhBedsAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_beds: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fjdh_bedsadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_bedsadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["facility_id", [fields.facility_id.visible && fields.facility_id.required ? ew.Validators.required(fields.facility_id.caption) : null], fields.facility_id.isInvalid],
            ["ward_id", [fields.ward_id.visible && fields.ward_id.required ? ew.Validators.required(fields.ward_id.caption) : null], fields.ward_id.isInvalid],
            ["bed_number", [fields.bed_number.visible && fields.bed_number.required ? ew.Validators.required(fields.bed_number.caption) : null, ew.Validators.integer], fields.bed_number.isInvalid],
            ["assigned", [fields.assigned.visible && fields.assigned.required ? ew.Validators.required(fields.assigned.caption) : null], fields.assigned.isInvalid]
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
            "facility_id": <?= $Page->facility_id->toClientList($Page) ?>,
            "ward_id": <?= $Page->ward_id->toClientList($Page) ?>,
            "assigned": <?= $Page->assigned->toClientList($Page) ?>,
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
<form name="fjdh_bedsadd" id="fjdh_bedsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jdh_beds">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->facility_id->Visible) { // facility_id ?>
    <div id="r_facility_id"<?= $Page->facility_id->rowAttributes() ?>>
        <label id="elh_jdh_beds_facility_id" for="x_facility_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->facility_id->caption() ?><?= $Page->facility_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->facility_id->cellAttributes() ?>>
<span id="el_jdh_beds_facility_id">
    <select
        id="x_facility_id"
        name="x_facility_id"
        class="form-select ew-select<?= $Page->facility_id->isInvalidClass() ?>"
        data-select2-id="fjdh_bedsadd_x_facility_id"
        data-table="jdh_beds"
        data-field="x_facility_id"
        data-value-separator="<?= $Page->facility_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->facility_id->getPlaceHolder()) ?>"
        data-ew-action="update-options"
        <?= $Page->facility_id->editAttributes() ?>>
        <?= $Page->facility_id->selectOptionListHtml("x_facility_id") ?>
    </select>
    <?= $Page->facility_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->facility_id->getErrorMessage() ?></div>
<?= $Page->facility_id->Lookup->getParamTag($Page, "p_x_facility_id") ?>
<script>
loadjs.ready("fjdh_bedsadd", function() {
    var options = { name: "x_facility_id", selectId: "fjdh_bedsadd_x_facility_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_bedsadd.lists.facility_id?.lookupOptions.length) {
        options.data = { id: "x_facility_id", form: "fjdh_bedsadd" };
    } else {
        options.ajax = { id: "x_facility_id", form: "fjdh_bedsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_beds.fields.facility_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ward_id->Visible) { // ward_id ?>
    <div id="r_ward_id"<?= $Page->ward_id->rowAttributes() ?>>
        <label id="elh_jdh_beds_ward_id" for="x_ward_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ward_id->caption() ?><?= $Page->ward_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->ward_id->cellAttributes() ?>>
<span id="el_jdh_beds_ward_id">
    <select
        id="x_ward_id"
        name="x_ward_id"
        class="form-select ew-select<?= $Page->ward_id->isInvalidClass() ?>"
        data-select2-id="fjdh_bedsadd_x_ward_id"
        data-table="jdh_beds"
        data-field="x_ward_id"
        data-value-separator="<?= $Page->ward_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->ward_id->getPlaceHolder()) ?>"
        <?= $Page->ward_id->editAttributes() ?>>
        <?= $Page->ward_id->selectOptionListHtml("x_ward_id") ?>
    </select>
    <?= $Page->ward_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->ward_id->getErrorMessage() ?></div>
<?= $Page->ward_id->Lookup->getParamTag($Page, "p_x_ward_id") ?>
<script>
loadjs.ready("fjdh_bedsadd", function() {
    var options = { name: "x_ward_id", selectId: "fjdh_bedsadd_x_ward_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_bedsadd.lists.ward_id?.lookupOptions.length) {
        options.data = { id: "x_ward_id", form: "fjdh_bedsadd" };
    } else {
        options.ajax = { id: "x_ward_id", form: "fjdh_bedsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_beds.fields.ward_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->bed_number->Visible) { // bed_number ?>
    <div id="r_bed_number"<?= $Page->bed_number->rowAttributes() ?>>
        <label id="elh_jdh_beds_bed_number" for="x_bed_number" class="<?= $Page->LeftColumnClass ?>"><?= $Page->bed_number->caption() ?><?= $Page->bed_number->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->bed_number->cellAttributes() ?>>
<span id="el_jdh_beds_bed_number">
<input type="<?= $Page->bed_number->getInputTextType() ?>" name="x_bed_number" id="x_bed_number" data-table="jdh_beds" data-field="x_bed_number" value="<?= $Page->bed_number->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->bed_number->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->bed_number->formatPattern()) ?>"<?= $Page->bed_number->editAttributes() ?> aria-describedby="x_bed_number_help">
<?= $Page->bed_number->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->bed_number->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->assigned->Visible) { // assigned ?>
    <div id="r_assigned"<?= $Page->assigned->rowAttributes() ?>>
        <label id="elh_jdh_beds_assigned" class="<?= $Page->LeftColumnClass ?>"><?= $Page->assigned->caption() ?><?= $Page->assigned->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->assigned->cellAttributes() ?>>
<span id="el_jdh_beds_assigned">
<div class="form-check d-inline-block">
    <input type="checkbox" class="form-check-input<?= $Page->assigned->isInvalidClass() ?>" data-table="jdh_beds" data-field="x_assigned" data-boolean name="x_assigned" id="x_assigned" value="1"<?= ConvertToBool($Page->assigned->CurrentValue) ? " checked" : "" ?><?= $Page->assigned->editAttributes() ?> aria-describedby="x_assigned_help">
    <div class="invalid-feedback"><?= $Page->assigned->getErrorMessage() ?></div>
</div>
<?= $Page->assigned->getCustomMessage() ?>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fjdh_bedsadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fjdh_bedsadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("jdh_beds");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
