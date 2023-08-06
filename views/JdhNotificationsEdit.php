<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$JdhNotificationsEdit = &$Page;
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
<form name="fjdh_notificationsedit" id="fjdh_notificationsedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_notifications: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fjdh_notificationsedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_notificationsedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["Id", [fields.Id.visible && fields.Id.required ? ew.Validators.required(fields.Id.caption) : null], fields.Id.isInvalid],
            ["User", [fields.User.visible && fields.User.required ? ew.Validators.required(fields.User.caption) : null], fields.User.isInvalid],
            ["Endpoint", [fields.Endpoint.visible && fields.Endpoint.required ? ew.Validators.required(fields.Endpoint.caption) : null], fields.Endpoint.isInvalid],
            ["PublicKey", [fields.PublicKey.visible && fields.PublicKey.required ? ew.Validators.required(fields.PublicKey.caption) : null], fields.PublicKey.isInvalid],
            ["AuthenticationToken", [fields.AuthenticationToken.visible && fields.AuthenticationToken.required ? ew.Validators.required(fields.AuthenticationToken.caption) : null], fields.AuthenticationToken.isInvalid],
            ["ContentEncoding", [fields.ContentEncoding.visible && fields.ContentEncoding.required ? ew.Validators.required(fields.ContentEncoding.caption) : null], fields.ContentEncoding.isInvalid]
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
<input type="hidden" name="t" value="jdh_notifications">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->Id->Visible) { // Id ?>
    <div id="r_Id"<?= $Page->Id->rowAttributes() ?>>
        <label id="elh_jdh_notifications_Id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Id->caption() ?><?= $Page->Id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->Id->cellAttributes() ?>>
<span id="el_jdh_notifications_Id">
<span<?= $Page->Id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->Id->getDisplayValue($Page->Id->EditValue))) ?>"></span>
<input type="hidden" data-table="jdh_notifications" data-field="x_Id" data-hidden="1" name="x_Id" id="x_Id" value="<?= HtmlEncode($Page->Id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->User->Visible) { // User ?>
    <div id="r_User"<?= $Page->User->rowAttributes() ?>>
        <label id="elh_jdh_notifications_User" for="x_User" class="<?= $Page->LeftColumnClass ?>"><?= $Page->User->caption() ?><?= $Page->User->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->User->cellAttributes() ?>>
<span id="el_jdh_notifications_User">
<input type="<?= $Page->User->getInputTextType() ?>" name="x_User" id="x_User" data-table="jdh_notifications" data-field="x_User" value="<?= $Page->User->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->User->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->User->formatPattern()) ?>"<?= $Page->User->editAttributes() ?> aria-describedby="x_User_help">
<?= $Page->User->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->User->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Endpoint->Visible) { // Endpoint ?>
    <div id="r_Endpoint"<?= $Page->Endpoint->rowAttributes() ?>>
        <label id="elh_jdh_notifications_Endpoint" for="x_Endpoint" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Endpoint->caption() ?><?= $Page->Endpoint->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->Endpoint->cellAttributes() ?>>
<span id="el_jdh_notifications_Endpoint">
<textarea data-table="jdh_notifications" data-field="x_Endpoint" name="x_Endpoint" id="x_Endpoint" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->Endpoint->getPlaceHolder()) ?>"<?= $Page->Endpoint->editAttributes() ?> aria-describedby="x_Endpoint_help"><?= $Page->Endpoint->EditValue ?></textarea>
<?= $Page->Endpoint->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Endpoint->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->PublicKey->Visible) { // PublicKey ?>
    <div id="r_PublicKey"<?= $Page->PublicKey->rowAttributes() ?>>
        <label id="elh_jdh_notifications_PublicKey" for="x_PublicKey" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PublicKey->caption() ?><?= $Page->PublicKey->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->PublicKey->cellAttributes() ?>>
<span id="el_jdh_notifications_PublicKey">
<input type="<?= $Page->PublicKey->getInputTextType() ?>" name="x_PublicKey" id="x_PublicKey" data-table="jdh_notifications" data-field="x_PublicKey" value="<?= $Page->PublicKey->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->PublicKey->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->PublicKey->formatPattern()) ?>"<?= $Page->PublicKey->editAttributes() ?> aria-describedby="x_PublicKey_help">
<?= $Page->PublicKey->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->PublicKey->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->AuthenticationToken->Visible) { // AuthenticationToken ?>
    <div id="r_AuthenticationToken"<?= $Page->AuthenticationToken->rowAttributes() ?>>
        <label id="elh_jdh_notifications_AuthenticationToken" for="x_AuthenticationToken" class="<?= $Page->LeftColumnClass ?>"><?= $Page->AuthenticationToken->caption() ?><?= $Page->AuthenticationToken->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->AuthenticationToken->cellAttributes() ?>>
<span id="el_jdh_notifications_AuthenticationToken">
<input type="<?= $Page->AuthenticationToken->getInputTextType() ?>" name="x_AuthenticationToken" id="x_AuthenticationToken" data-table="jdh_notifications" data-field="x_AuthenticationToken" value="<?= $Page->AuthenticationToken->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->AuthenticationToken->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->AuthenticationToken->formatPattern()) ?>"<?= $Page->AuthenticationToken->editAttributes() ?> aria-describedby="x_AuthenticationToken_help">
<?= $Page->AuthenticationToken->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->AuthenticationToken->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ContentEncoding->Visible) { // ContentEncoding ?>
    <div id="r_ContentEncoding"<?= $Page->ContentEncoding->rowAttributes() ?>>
        <label id="elh_jdh_notifications_ContentEncoding" for="x_ContentEncoding" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ContentEncoding->caption() ?><?= $Page->ContentEncoding->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->ContentEncoding->cellAttributes() ?>>
<span id="el_jdh_notifications_ContentEncoding">
<input type="<?= $Page->ContentEncoding->getInputTextType() ?>" name="x_ContentEncoding" id="x_ContentEncoding" data-table="jdh_notifications" data-field="x_ContentEncoding" value="<?= $Page->ContentEncoding->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->ContentEncoding->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->ContentEncoding->formatPattern()) ?>"<?= $Page->ContentEncoding->editAttributes() ?> aria-describedby="x_ContentEncoding_help">
<?= $Page->ContentEncoding->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ContentEncoding->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fjdh_notificationsedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fjdh_notificationsedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("jdh_notifications");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
