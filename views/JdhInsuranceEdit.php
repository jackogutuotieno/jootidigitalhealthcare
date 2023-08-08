<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$JdhInsuranceEdit = &$Page;
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
<form name="fjdh_insuranceedit" id="fjdh_insuranceedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_insurance: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fjdh_insuranceedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_insuranceedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["insurance_id", [fields.insurance_id.visible && fields.insurance_id.required ? ew.Validators.required(fields.insurance_id.caption) : null], fields.insurance_id.isInvalid],
            ["insurance_name", [fields.insurance_name.visible && fields.insurance_name.required ? ew.Validators.required(fields.insurance_name.caption) : null], fields.insurance_name.isInvalid],
            ["insurance_contact_person", [fields.insurance_contact_person.visible && fields.insurance_contact_person.required ? ew.Validators.required(fields.insurance_contact_person.caption) : null], fields.insurance_contact_person.isInvalid],
            ["insurance_contact_person_phone", [fields.insurance_contact_person_phone.visible && fields.insurance_contact_person_phone.required ? ew.Validators.required(fields.insurance_contact_person_phone.caption) : null], fields.insurance_contact_person_phone.isInvalid],
            ["insurance_contact_person_email", [fields.insurance_contact_person_email.visible && fields.insurance_contact_person_email.required ? ew.Validators.required(fields.insurance_contact_person_email.caption) : null], fields.insurance_contact_person_email.isInvalid],
            ["insurance_physical_address", [fields.insurance_physical_address.visible && fields.insurance_physical_address.required ? ew.Validators.required(fields.insurance_physical_address.caption) : null], fields.insurance_physical_address.isInvalid]
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
<input type="hidden" name="t" value="jdh_insurance">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->insurance_id->Visible) { // insurance_id ?>
    <div id="r_insurance_id"<?= $Page->insurance_id->rowAttributes() ?>>
        <label id="elh_jdh_insurance_insurance_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->insurance_id->caption() ?><?= $Page->insurance_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->insurance_id->cellAttributes() ?>>
<span id="el_jdh_insurance_insurance_id">
<span<?= $Page->insurance_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->insurance_id->getDisplayValue($Page->insurance_id->EditValue))) ?>"></span>
<input type="hidden" data-table="jdh_insurance" data-field="x_insurance_id" data-hidden="1" name="x_insurance_id" id="x_insurance_id" value="<?= HtmlEncode($Page->insurance_id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->insurance_name->Visible) { // insurance_name ?>
    <div id="r_insurance_name"<?= $Page->insurance_name->rowAttributes() ?>>
        <label id="elh_jdh_insurance_insurance_name" for="x_insurance_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->insurance_name->caption() ?><?= $Page->insurance_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->insurance_name->cellAttributes() ?>>
<span id="el_jdh_insurance_insurance_name">
<input type="<?= $Page->insurance_name->getInputTextType() ?>" name="x_insurance_name" id="x_insurance_name" data-table="jdh_insurance" data-field="x_insurance_name" value="<?= $Page->insurance_name->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->insurance_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->insurance_name->formatPattern()) ?>"<?= $Page->insurance_name->editAttributes() ?> aria-describedby="x_insurance_name_help">
<?= $Page->insurance_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->insurance_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->insurance_contact_person->Visible) { // insurance_contact_person ?>
    <div id="r_insurance_contact_person"<?= $Page->insurance_contact_person->rowAttributes() ?>>
        <label id="elh_jdh_insurance_insurance_contact_person" for="x_insurance_contact_person" class="<?= $Page->LeftColumnClass ?>"><?= $Page->insurance_contact_person->caption() ?><?= $Page->insurance_contact_person->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->insurance_contact_person->cellAttributes() ?>>
<span id="el_jdh_insurance_insurance_contact_person">
<input type="<?= $Page->insurance_contact_person->getInputTextType() ?>" name="x_insurance_contact_person" id="x_insurance_contact_person" data-table="jdh_insurance" data-field="x_insurance_contact_person" value="<?= $Page->insurance_contact_person->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->insurance_contact_person->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->insurance_contact_person->formatPattern()) ?>"<?= $Page->insurance_contact_person->editAttributes() ?> aria-describedby="x_insurance_contact_person_help">
<?= $Page->insurance_contact_person->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->insurance_contact_person->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->insurance_contact_person_phone->Visible) { // insurance_contact_person_phone ?>
    <div id="r_insurance_contact_person_phone"<?= $Page->insurance_contact_person_phone->rowAttributes() ?>>
        <label id="elh_jdh_insurance_insurance_contact_person_phone" for="x_insurance_contact_person_phone" class="<?= $Page->LeftColumnClass ?>"><?= $Page->insurance_contact_person_phone->caption() ?><?= $Page->insurance_contact_person_phone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->insurance_contact_person_phone->cellAttributes() ?>>
<span id="el_jdh_insurance_insurance_contact_person_phone">
<input type="<?= $Page->insurance_contact_person_phone->getInputTextType() ?>" name="x_insurance_contact_person_phone" id="x_insurance_contact_person_phone" data-table="jdh_insurance" data-field="x_insurance_contact_person_phone" value="<?= $Page->insurance_contact_person_phone->EditValue ?>" size="30" maxlength="13" placeholder="<?= HtmlEncode($Page->insurance_contact_person_phone->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->insurance_contact_person_phone->formatPattern()) ?>"<?= $Page->insurance_contact_person_phone->editAttributes() ?> aria-describedby="x_insurance_contact_person_phone_help">
<?= $Page->insurance_contact_person_phone->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->insurance_contact_person_phone->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->insurance_contact_person_email->Visible) { // insurance_contact_person_email ?>
    <div id="r_insurance_contact_person_email"<?= $Page->insurance_contact_person_email->rowAttributes() ?>>
        <label id="elh_jdh_insurance_insurance_contact_person_email" for="x_insurance_contact_person_email" class="<?= $Page->LeftColumnClass ?>"><?= $Page->insurance_contact_person_email->caption() ?><?= $Page->insurance_contact_person_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->insurance_contact_person_email->cellAttributes() ?>>
<span id="el_jdh_insurance_insurance_contact_person_email">
<input type="<?= $Page->insurance_contact_person_email->getInputTextType() ?>" name="x_insurance_contact_person_email" id="x_insurance_contact_person_email" data-table="jdh_insurance" data-field="x_insurance_contact_person_email" value="<?= $Page->insurance_contact_person_email->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->insurance_contact_person_email->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->insurance_contact_person_email->formatPattern()) ?>"<?= $Page->insurance_contact_person_email->editAttributes() ?> aria-describedby="x_insurance_contact_person_email_help">
<?= $Page->insurance_contact_person_email->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->insurance_contact_person_email->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->insurance_physical_address->Visible) { // insurance_physical_address ?>
    <div id="r_insurance_physical_address"<?= $Page->insurance_physical_address->rowAttributes() ?>>
        <label id="elh_jdh_insurance_insurance_physical_address" for="x_insurance_physical_address" class="<?= $Page->LeftColumnClass ?>"><?= $Page->insurance_physical_address->caption() ?><?= $Page->insurance_physical_address->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->insurance_physical_address->cellAttributes() ?>>
<span id="el_jdh_insurance_insurance_physical_address">
<textarea data-table="jdh_insurance" data-field="x_insurance_physical_address" name="x_insurance_physical_address" id="x_insurance_physical_address" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->insurance_physical_address->getPlaceHolder()) ?>"<?= $Page->insurance_physical_address->editAttributes() ?> aria-describedby="x_insurance_physical_address_help"><?= $Page->insurance_physical_address->EditValue ?></textarea>
<?= $Page->insurance_physical_address->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->insurance_physical_address->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fjdh_insuranceedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fjdh_insuranceedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("jdh_insurance");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
