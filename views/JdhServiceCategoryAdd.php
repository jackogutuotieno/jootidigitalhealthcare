<?php

namespace PHPMaker2024\jootidigitalhealthcare;

// Page object
$JdhServiceCategoryAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_service_category: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fjdh_service_categoryadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_service_categoryadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["category_name", [fields.category_name.visible && fields.category_name.required ? ew.Validators.required(fields.category_name.caption) : null], fields.category_name.isInvalid],
            ["category_description", [fields.category_description.visible && fields.category_description.required ? ew.Validators.required(fields.category_description.caption) : null], fields.category_description.isInvalid]
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
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fjdh_service_categoryadd" id="fjdh_service_categoryadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jdh_service_category">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->category_name->Visible) { // category_name ?>
    <div id="r_category_name"<?= $Page->category_name->rowAttributes() ?>>
        <label id="elh_jdh_service_category_category_name" for="x_category_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->category_name->caption() ?><?= $Page->category_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->category_name->cellAttributes() ?>>
<span id="el_jdh_service_category_category_name">
<input type="<?= $Page->category_name->getInputTextType() ?>" name="x_category_name" id="x_category_name" data-table="jdh_service_category" data-field="x_category_name" value="<?= $Page->category_name->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->category_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->category_name->formatPattern()) ?>"<?= $Page->category_name->editAttributes() ?> aria-describedby="x_category_name_help">
<?= $Page->category_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->category_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->category_description->Visible) { // category_description ?>
    <div id="r_category_description"<?= $Page->category_description->rowAttributes() ?>>
        <label id="elh_jdh_service_category_category_description" for="x_category_description" class="<?= $Page->LeftColumnClass ?>"><?= $Page->category_description->caption() ?><?= $Page->category_description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->category_description->cellAttributes() ?>>
<span id="el_jdh_service_category_category_description">
<textarea data-table="jdh_service_category" data-field="x_category_description" name="x_category_description" id="x_category_description" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->category_description->getPlaceHolder()) ?>"<?= $Page->category_description->editAttributes() ?> aria-describedby="x_category_description_help"><?= $Page->category_description->EditValue ?></textarea>
<?= $Page->category_description->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->category_description->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fjdh_service_categoryadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fjdh_service_categoryadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("jdh_service_category");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
