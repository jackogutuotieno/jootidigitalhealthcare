<?php

namespace PHPMaker2024\jootidigitalhealthcare;

// Page object
$JdhRolesEdit = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="fjdh_rolesedit" id="fjdh_rolesedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_roles: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fjdh_rolesedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_rolesedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["role_id", [fields.role_id.visible && fields.role_id.required ? ew.Validators.required(fields.role_id.caption) : null], fields.role_id.isInvalid],
            ["role_name", [fields.role_name.visible && fields.role_name.required ? ew.Validators.required(fields.role_name.caption) : null], fields.role_name.isInvalid],
            ["role_description", [fields.role_description.visible && fields.role_description.required ? ew.Validators.required(fields.role_description.caption) : null], fields.role_description.isInvalid]
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
<input type="hidden" name="t" value="jdh_roles">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->role_id->Visible) { // role_id ?>
    <div id="r_role_id"<?= $Page->role_id->rowAttributes() ?>>
        <label id="elh_jdh_roles_role_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->role_id->caption() ?><?= $Page->role_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->role_id->cellAttributes() ?>>
<span id="el_jdh_roles_role_id">
<span<?= $Page->role_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->role_id->getDisplayValue($Page->role_id->EditValue))) ?>"></span>
<input type="hidden" data-table="jdh_roles" data-field="x_role_id" data-hidden="1" name="x_role_id" id="x_role_id" value="<?= HtmlEncode($Page->role_id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->role_name->Visible) { // role_name ?>
    <div id="r_role_name"<?= $Page->role_name->rowAttributes() ?>>
        <label id="elh_jdh_roles_role_name" for="x_role_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->role_name->caption() ?><?= $Page->role_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->role_name->cellAttributes() ?>>
<span id="el_jdh_roles_role_name">
<input type="<?= $Page->role_name->getInputTextType() ?>" name="x_role_name" id="x_role_name" data-table="jdh_roles" data-field="x_role_name" value="<?= $Page->role_name->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->role_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->role_name->formatPattern()) ?>"<?= $Page->role_name->editAttributes() ?> aria-describedby="x_role_name_help">
<?= $Page->role_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->role_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->role_description->Visible) { // role_description ?>
    <div id="r_role_description"<?= $Page->role_description->rowAttributes() ?>>
        <label id="elh_jdh_roles_role_description" class="<?= $Page->LeftColumnClass ?>"><?= $Page->role_description->caption() ?><?= $Page->role_description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->role_description->cellAttributes() ?>>
<span id="el_jdh_roles_role_description">
<?php $Page->role_description->EditAttrs->appendClass("editor"); ?>
<textarea data-table="jdh_roles" data-field="x_role_description" name="x_role_description" id="x_role_description" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->role_description->getPlaceHolder()) ?>"<?= $Page->role_description->editAttributes() ?> aria-describedby="x_role_description_help"><?= $Page->role_description->EditValue ?></textarea>
<?= $Page->role_description->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->role_description->getErrorMessage() ?></div>
<script>
loadjs.ready(["fjdh_rolesedit", "editor"], function() {
    ew.createEditor("fjdh_rolesedit", "x_role_description", 35, 4, <?= $Page->role_description->ReadOnly || false ? "true" : "false" ?>);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fjdh_rolesedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fjdh_rolesedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("jdh_roles");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
