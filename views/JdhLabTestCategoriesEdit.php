<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$JdhLabTestCategoriesEdit = &$Page;
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
<form name="fjdh_lab_test_categoriesedit" id="fjdh_lab_test_categoriesedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_lab_test_categories: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fjdh_lab_test_categoriesedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_lab_test_categoriesedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["test_category_id", [fields.test_category_id.visible && fields.test_category_id.required ? ew.Validators.required(fields.test_category_id.caption) : null], fields.test_category_id.isInvalid],
            ["test_category_name", [fields.test_category_name.visible && fields.test_category_name.required ? ew.Validators.required(fields.test_category_name.caption) : null], fields.test_category_name.isInvalid],
            ["test_category_description", [fields.test_category_description.visible && fields.test_category_description.required ? ew.Validators.required(fields.test_category_description.caption) : null], fields.test_category_description.isInvalid]
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
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jdh_lab_test_categories">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->test_category_id->Visible) { // test_category_id ?>
    <div id="r_test_category_id"<?= $Page->test_category_id->rowAttributes() ?>>
        <label id="elh_jdh_lab_test_categories_test_category_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->test_category_id->caption() ?><?= $Page->test_category_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->test_category_id->cellAttributes() ?>>
<span id="el_jdh_lab_test_categories_test_category_id">
<span<?= $Page->test_category_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->test_category_id->getDisplayValue($Page->test_category_id->EditValue))) ?>"></span>
<input type="hidden" data-table="jdh_lab_test_categories" data-field="x_test_category_id" data-hidden="1" name="x_test_category_id" id="x_test_category_id" value="<?= HtmlEncode($Page->test_category_id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->test_category_name->Visible) { // test_category_name ?>
    <div id="r_test_category_name"<?= $Page->test_category_name->rowAttributes() ?>>
        <label id="elh_jdh_lab_test_categories_test_category_name" for="x_test_category_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->test_category_name->caption() ?><?= $Page->test_category_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->test_category_name->cellAttributes() ?>>
<span id="el_jdh_lab_test_categories_test_category_name">
<input type="<?= $Page->test_category_name->getInputTextType() ?>" name="x_test_category_name" id="x_test_category_name" data-table="jdh_lab_test_categories" data-field="x_test_category_name" value="<?= $Page->test_category_name->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->test_category_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->test_category_name->formatPattern()) ?>"<?= $Page->test_category_name->editAttributes() ?> aria-describedby="x_test_category_name_help">
<?= $Page->test_category_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->test_category_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->test_category_description->Visible) { // test_category_description ?>
    <div id="r_test_category_description"<?= $Page->test_category_description->rowAttributes() ?>>
        <label id="elh_jdh_lab_test_categories_test_category_description" class="<?= $Page->LeftColumnClass ?>"><?= $Page->test_category_description->caption() ?><?= $Page->test_category_description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->test_category_description->cellAttributes() ?>>
<span id="el_jdh_lab_test_categories_test_category_description">
<?php $Page->test_category_description->EditAttrs->appendClass("editor"); ?>
<textarea data-table="jdh_lab_test_categories" data-field="x_test_category_description" name="x_test_category_description" id="x_test_category_description" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->test_category_description->getPlaceHolder()) ?>"<?= $Page->test_category_description->editAttributes() ?> aria-describedby="x_test_category_description_help"><?= $Page->test_category_description->EditValue ?></textarea>
<?= $Page->test_category_description->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->test_category_description->getErrorMessage() ?></div>
<script>
loadjs.ready(["fjdh_lab_test_categoriesedit", "editor"], function() {
    ew.createEditor("fjdh_lab_test_categoriesedit", "x_test_category_description", 35, 4, <?= $Page->test_category_description->ReadOnly || false ? "true" : "false" ?>);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fjdh_lab_test_categoriesedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fjdh_lab_test_categoriesedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("jdh_lab_test_categories");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
