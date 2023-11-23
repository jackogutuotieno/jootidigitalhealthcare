<?php

namespace PHPMaker2024\jootidigitalhealthcare;

// Page object
$JdhWardsAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_wards: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fjdh_wardsadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_wardsadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["facility_id", [fields.facility_id.visible && fields.facility_id.required ? ew.Validators.required(fields.facility_id.caption) : null], fields.facility_id.isInvalid],
            ["ward_name", [fields.ward_name.visible && fields.ward_name.required ? ew.Validators.required(fields.ward_name.caption) : null], fields.ward_name.isInvalid],
            ["description", [fields.description.visible && fields.description.required ? ew.Validators.required(fields.description.caption) : null], fields.description.isInvalid]
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
<form name="fjdh_wardsadd" id="fjdh_wardsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jdh_wards">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->facility_id->Visible) { // facility_id ?>
    <div id="r_facility_id"<?= $Page->facility_id->rowAttributes() ?>>
        <label id="elh_jdh_wards_facility_id" for="x_facility_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->facility_id->caption() ?><?= $Page->facility_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->facility_id->cellAttributes() ?>>
<span id="el_jdh_wards_facility_id">
    <select
        id="x_facility_id"
        name="x_facility_id"
        class="form-select ew-select<?= $Page->facility_id->isInvalidClass() ?>"
        <?php if (!$Page->facility_id->IsNativeSelect) { ?>
        data-select2-id="fjdh_wardsadd_x_facility_id"
        <?php } ?>
        data-table="jdh_wards"
        data-field="x_facility_id"
        data-value-separator="<?= $Page->facility_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->facility_id->getPlaceHolder()) ?>"
        <?= $Page->facility_id->editAttributes() ?>>
        <?= $Page->facility_id->selectOptionListHtml("x_facility_id") ?>
    </select>
    <?= $Page->facility_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->facility_id->getErrorMessage() ?></div>
<?= $Page->facility_id->Lookup->getParamTag($Page, "p_x_facility_id") ?>
<?php if (!$Page->facility_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fjdh_wardsadd", function() {
    var options = { name: "x_facility_id", selectId: "fjdh_wardsadd_x_facility_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_wardsadd.lists.facility_id?.lookupOptions.length) {
        options.data = { id: "x_facility_id", form: "fjdh_wardsadd" };
    } else {
        options.ajax = { id: "x_facility_id", form: "fjdh_wardsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_wards.fields.facility_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ward_name->Visible) { // ward_name ?>
    <div id="r_ward_name"<?= $Page->ward_name->rowAttributes() ?>>
        <label id="elh_jdh_wards_ward_name" for="x_ward_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ward_name->caption() ?><?= $Page->ward_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->ward_name->cellAttributes() ?>>
<span id="el_jdh_wards_ward_name">
<input type="<?= $Page->ward_name->getInputTextType() ?>" name="x_ward_name" id="x_ward_name" data-table="jdh_wards" data-field="x_ward_name" value="<?= $Page->ward_name->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->ward_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->ward_name->formatPattern()) ?>"<?= $Page->ward_name->editAttributes() ?> aria-describedby="x_ward_name_help">
<?= $Page->ward_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ward_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <div id="r_description"<?= $Page->description->rowAttributes() ?>>
        <label id="elh_jdh_wards_description" for="x_description" class="<?= $Page->LeftColumnClass ?>"><?= $Page->description->caption() ?><?= $Page->description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->description->cellAttributes() ?>>
<span id="el_jdh_wards_description">
<textarea data-table="jdh_wards" data-field="x_description" name="x_description" id="x_description" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->description->getPlaceHolder()) ?>"<?= $Page->description->editAttributes() ?> aria-describedby="x_description_help"><?= $Page->description->EditValue ?></textarea>
<?= $Page->description->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->description->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fjdh_wardsadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fjdh_wardsadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("jdh_wards");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
