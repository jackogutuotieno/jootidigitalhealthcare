<?php

namespace PHPMaker2024\jootidigitalhealthcare;

// Page object
$JdhVisitTypesEdit = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="fjdh_visit_typesedit" id="fjdh_visit_typesedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_visit_types: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fjdh_visit_typesedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_visit_typesedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["visit_type_id", [fields.visit_type_id.visible && fields.visit_type_id.required ? ew.Validators.required(fields.visit_type_id.caption) : null], fields.visit_type_id.isInvalid],
            ["visit_type", [fields.visit_type.visible && fields.visit_type.required ? ew.Validators.required(fields.visit_type.caption) : null], fields.visit_type.isInvalid],
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
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jdh_visit_types">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->visit_type_id->Visible) { // visit_type_id ?>
    <div id="r_visit_type_id"<?= $Page->visit_type_id->rowAttributes() ?>>
        <label id="elh_jdh_visit_types_visit_type_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->visit_type_id->caption() ?><?= $Page->visit_type_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->visit_type_id->cellAttributes() ?>>
<span id="el_jdh_visit_types_visit_type_id">
<span<?= $Page->visit_type_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->visit_type_id->getDisplayValue($Page->visit_type_id->EditValue))) ?>"></span>
<input type="hidden" data-table="jdh_visit_types" data-field="x_visit_type_id" data-hidden="1" name="x_visit_type_id" id="x_visit_type_id" value="<?= HtmlEncode($Page->visit_type_id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->visit_type->Visible) { // visit_type ?>
    <div id="r_visit_type"<?= $Page->visit_type->rowAttributes() ?>>
        <label id="elh_jdh_visit_types_visit_type" for="x_visit_type" class="<?= $Page->LeftColumnClass ?>"><?= $Page->visit_type->caption() ?><?= $Page->visit_type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->visit_type->cellAttributes() ?>>
<span id="el_jdh_visit_types_visit_type">
<input type="<?= $Page->visit_type->getInputTextType() ?>" name="x_visit_type" id="x_visit_type" data-table="jdh_visit_types" data-field="x_visit_type" value="<?= $Page->visit_type->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->visit_type->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->visit_type->formatPattern()) ?>"<?= $Page->visit_type->editAttributes() ?> aria-describedby="x_visit_type_help">
<?= $Page->visit_type->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->visit_type->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->visit_description->Visible) { // visit_description ?>
    <div id="r_visit_description"<?= $Page->visit_description->rowAttributes() ?>>
        <label id="elh_jdh_visit_types_visit_description" class="<?= $Page->LeftColumnClass ?>"><?= $Page->visit_description->caption() ?><?= $Page->visit_description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->visit_description->cellAttributes() ?>>
<span id="el_jdh_visit_types_visit_description">
<?php $Page->visit_description->EditAttrs->appendClass("editor"); ?>
<textarea data-table="jdh_visit_types" data-field="x_visit_description" name="x_visit_description" id="x_visit_description" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->visit_description->getPlaceHolder()) ?>"<?= $Page->visit_description->editAttributes() ?> aria-describedby="x_visit_description_help"><?= $Page->visit_description->EditValue ?></textarea>
<?= $Page->visit_description->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->visit_description->getErrorMessage() ?></div>
<script>
loadjs.ready(["fjdh_visit_typesedit", "editor"], function() {
    ew.createEditor("fjdh_visit_typesedit", "x_visit_description", 35, 4, <?= $Page->visit_description->ReadOnly || false ? "true" : "false" ?>);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fjdh_visit_typesedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fjdh_visit_typesedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("jdh_visit_types");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
