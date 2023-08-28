<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$BedsEdit = &$Page;
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
<form name="fbedsedit" id="fbedsedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { beds: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fbedsedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fbedsedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["bed_id", [fields.bed_id.visible && fields.bed_id.required ? ew.Validators.required(fields.bed_id.caption) : null], fields.bed_id.isInvalid],
            ["ward_id", [fields.ward_id.visible && fields.ward_id.required ? ew.Validators.required(fields.ward_id.caption) : null], fields.ward_id.isInvalid],
            ["room_id", [fields.room_id.visible && fields.room_id.required ? ew.Validators.required(fields.room_id.caption) : null], fields.room_id.isInvalid],
            ["bed_number", [fields.bed_number.visible && fields.bed_number.required ? ew.Validators.required(fields.bed_number.caption) : null, ew.Validators.integer], fields.bed_number.isInvalid],
            ["description", [fields.description.visible && fields.description.required ? ew.Validators.required(fields.description.caption) : null], fields.description.isInvalid],
            ["status_id", [fields.status_id.visible && fields.status_id.required ? ew.Validators.required(fields.status_id.caption) : null], fields.status_id.isInvalid]
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
            "ward_id": <?= $Page->ward_id->toClientList($Page) ?>,
            "room_id": <?= $Page->room_id->toClientList($Page) ?>,
            "status_id": <?= $Page->status_id->toClientList($Page) ?>,
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
<input type="hidden" name="t" value="beds">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->bed_id->Visible) { // bed_id ?>
    <div id="r_bed_id"<?= $Page->bed_id->rowAttributes() ?>>
        <label id="elh_beds_bed_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->bed_id->caption() ?><?= $Page->bed_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->bed_id->cellAttributes() ?>>
<span id="el_beds_bed_id">
<span<?= $Page->bed_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->bed_id->getDisplayValue($Page->bed_id->EditValue))) ?>"></span>
<input type="hidden" data-table="beds" data-field="x_bed_id" data-hidden="1" name="x_bed_id" id="x_bed_id" value="<?= HtmlEncode($Page->bed_id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ward_id->Visible) { // ward_id ?>
    <div id="r_ward_id"<?= $Page->ward_id->rowAttributes() ?>>
        <label id="elh_beds_ward_id" for="x_ward_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ward_id->caption() ?><?= $Page->ward_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->ward_id->cellAttributes() ?>>
<span id="el_beds_ward_id">
    <select
        id="x_ward_id"
        name="x_ward_id"
        class="form-select ew-select<?= $Page->ward_id->isInvalidClass() ?>"
        data-select2-id="fbedsedit_x_ward_id"
        data-table="beds"
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
<script>
loadjs.ready("fbedsedit", function() {
    var options = { name: "x_ward_id", selectId: "fbedsedit_x_ward_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fbedsedit.lists.ward_id?.lookupOptions.length) {
        options.data = { id: "x_ward_id", form: "fbedsedit" };
    } else {
        options.ajax = { id: "x_ward_id", form: "fbedsedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.beds.fields.ward_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->room_id->Visible) { // room_id ?>
    <div id="r_room_id"<?= $Page->room_id->rowAttributes() ?>>
        <label id="elh_beds_room_id" for="x_room_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->room_id->caption() ?><?= $Page->room_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->room_id->cellAttributes() ?>>
<span id="el_beds_room_id">
    <select
        id="x_room_id"
        name="x_room_id"
        class="form-select ew-select<?= $Page->room_id->isInvalidClass() ?>"
        data-select2-id="fbedsedit_x_room_id"
        data-table="beds"
        data-field="x_room_id"
        data-value-separator="<?= $Page->room_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->room_id->getPlaceHolder()) ?>"
        <?= $Page->room_id->editAttributes() ?>>
        <?= $Page->room_id->selectOptionListHtml("x_room_id") ?>
    </select>
    <?= $Page->room_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->room_id->getErrorMessage() ?></div>
<?= $Page->room_id->Lookup->getParamTag($Page, "p_x_room_id") ?>
<script>
loadjs.ready("fbedsedit", function() {
    var options = { name: "x_room_id", selectId: "fbedsedit_x_room_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fbedsedit.lists.room_id?.lookupOptions.length) {
        options.data = { id: "x_room_id", form: "fbedsedit" };
    } else {
        options.ajax = { id: "x_room_id", form: "fbedsedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.beds.fields.room_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->bed_number->Visible) { // bed_number ?>
    <div id="r_bed_number"<?= $Page->bed_number->rowAttributes() ?>>
        <label id="elh_beds_bed_number" for="x_bed_number" class="<?= $Page->LeftColumnClass ?>"><?= $Page->bed_number->caption() ?><?= $Page->bed_number->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->bed_number->cellAttributes() ?>>
<span id="el_beds_bed_number">
<input type="<?= $Page->bed_number->getInputTextType() ?>" name="x_bed_number" id="x_bed_number" data-table="beds" data-field="x_bed_number" value="<?= $Page->bed_number->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->bed_number->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->bed_number->formatPattern()) ?>"<?= $Page->bed_number->editAttributes() ?> aria-describedby="x_bed_number_help">
<?= $Page->bed_number->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->bed_number->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <div id="r_description"<?= $Page->description->rowAttributes() ?>>
        <label id="elh_beds_description" for="x_description" class="<?= $Page->LeftColumnClass ?>"><?= $Page->description->caption() ?><?= $Page->description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->description->cellAttributes() ?>>
<span id="el_beds_description">
<textarea data-table="beds" data-field="x_description" name="x_description" id="x_description" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->description->getPlaceHolder()) ?>"<?= $Page->description->editAttributes() ?> aria-describedby="x_description_help"><?= $Page->description->EditValue ?></textarea>
<?= $Page->description->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->description->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status_id->Visible) { // status_id ?>
    <div id="r_status_id"<?= $Page->status_id->rowAttributes() ?>>
        <label id="elh_beds_status_id" for="x_status_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status_id->caption() ?><?= $Page->status_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->status_id->cellAttributes() ?>>
<span id="el_beds_status_id">
    <select
        id="x_status_id"
        name="x_status_id"
        class="form-select ew-select<?= $Page->status_id->isInvalidClass() ?>"
        data-select2-id="fbedsedit_x_status_id"
        data-table="beds"
        data-field="x_status_id"
        data-value-separator="<?= $Page->status_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->status_id->getPlaceHolder()) ?>"
        <?= $Page->status_id->editAttributes() ?>>
        <?= $Page->status_id->selectOptionListHtml("x_status_id") ?>
    </select>
    <?= $Page->status_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->status_id->getErrorMessage() ?></div>
<script>
loadjs.ready("fbedsedit", function() {
    var options = { name: "x_status_id", selectId: "fbedsedit_x_status_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fbedsedit.lists.status_id?.lookupOptions.length) {
        options.data = { id: "x_status_id", form: "fbedsedit" };
    } else {
        options.ajax = { id: "x_status_id", form: "fbedsedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.beds.fields.status_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fbedsedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fbedsedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("beds");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
