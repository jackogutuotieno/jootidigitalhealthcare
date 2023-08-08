<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$JdhUsersAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_users: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fjdh_usersadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_usersadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["photo", [fields.photo.visible && fields.photo.required ? ew.Validators.fileRequired(fields.photo.caption) : null], fields.photo.isInvalid],
            ["first_name", [fields.first_name.visible && fields.first_name.required ? ew.Validators.required(fields.first_name.caption) : null], fields.first_name.isInvalid],
            ["last_name", [fields.last_name.visible && fields.last_name.required ? ew.Validators.required(fields.last_name.caption) : null], fields.last_name.isInvalid],
            ["national_id", [fields.national_id.visible && fields.national_id.required ? ew.Validators.required(fields.national_id.caption) : null], fields.national_id.isInvalid],
            ["email_address", [fields.email_address.visible && fields.email_address.required ? ew.Validators.required(fields.email_address.caption) : null, ew.Validators.email], fields.email_address.isInvalid],
            ["phone", [fields.phone.visible && fields.phone.required ? ew.Validators.required(fields.phone.caption) : null], fields.phone.isInvalid],
            ["department_id", [fields.department_id.visible && fields.department_id.required ? ew.Validators.required(fields.department_id.caption) : null], fields.department_id.isInvalid],
            ["_password", [fields._password.visible && fields._password.required ? ew.Validators.required(fields._password.caption) : null, ew.Validators.passwordStrength], fields._password.isInvalid],
            ["biography", [fields.biography.visible && fields.biography.required ? ew.Validators.required(fields.biography.caption) : null], fields.biography.isInvalid],
            ["role_id", [fields.role_id.visible && fields.role_id.required ? ew.Validators.required(fields.role_id.caption) : null], fields.role_id.isInvalid]
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
            "department_id": <?= $Page->department_id->toClientList($Page) ?>,
            "role_id": <?= $Page->role_id->toClientList($Page) ?>,
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
<form name="fjdh_usersadd" id="fjdh_usersadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jdh_users">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->photo->Visible) { // photo ?>
    <div id="r_photo"<?= $Page->photo->rowAttributes() ?>>
        <label id="elh_jdh_users_photo" class="<?= $Page->LeftColumnClass ?>"><?= $Page->photo->caption() ?><?= $Page->photo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->photo->cellAttributes() ?>>
<span id="el_jdh_users_photo">
<div id="fd_x_photo" class="fileinput-button ew-file-drop-zone">
    <input
        type="file"
        id="x_photo"
        name="x_photo"
        class="form-control ew-file-input"
        title="<?= $Page->photo->title() ?>"
        lang="<?= CurrentLanguageID() ?>"
        data-table="jdh_users"
        data-field="x_photo"
        data-size="0"
        data-accept-file-types="<?= $Page->photo->acceptFileTypes() ?>"
        data-max-file-size="<?= $Page->photo->UploadMaxFileSize ?>"
        data-max-number-of-files="null"
        data-disable-image-crop="<?= $Page->photo->ImageCropper ? 0 : 1 ?>"
        aria-describedby="x_photo_help"
        <?= ($Page->photo->ReadOnly || $Page->photo->Disabled) ? " disabled" : "" ?>
        <?= $Page->photo->editAttributes() ?>
    >
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<?= $Page->photo->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->photo->getErrorMessage() ?></div>
<input type="hidden" name="fn_x_photo" id= "fn_x_photo" value="<?= $Page->photo->Upload->FileName ?>">
<input type="hidden" name="fa_x_photo" id= "fa_x_photo" value="0">
<table id="ft_x_photo" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->first_name->Visible) { // first_name ?>
    <div id="r_first_name"<?= $Page->first_name->rowAttributes() ?>>
        <label id="elh_jdh_users_first_name" for="x_first_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->first_name->caption() ?><?= $Page->first_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->first_name->cellAttributes() ?>>
<span id="el_jdh_users_first_name">
<input type="<?= $Page->first_name->getInputTextType() ?>" name="x_first_name" id="x_first_name" data-table="jdh_users" data-field="x_first_name" value="<?= $Page->first_name->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->first_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->first_name->formatPattern()) ?>"<?= $Page->first_name->editAttributes() ?> aria-describedby="x_first_name_help">
<?= $Page->first_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->first_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->last_name->Visible) { // last_name ?>
    <div id="r_last_name"<?= $Page->last_name->rowAttributes() ?>>
        <label id="elh_jdh_users_last_name" for="x_last_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->last_name->caption() ?><?= $Page->last_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->last_name->cellAttributes() ?>>
<span id="el_jdh_users_last_name">
<input type="<?= $Page->last_name->getInputTextType() ?>" name="x_last_name" id="x_last_name" data-table="jdh_users" data-field="x_last_name" value="<?= $Page->last_name->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->last_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->last_name->formatPattern()) ?>"<?= $Page->last_name->editAttributes() ?> aria-describedby="x_last_name_help">
<?= $Page->last_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->last_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->national_id->Visible) { // national_id ?>
    <div id="r_national_id"<?= $Page->national_id->rowAttributes() ?>>
        <label id="elh_jdh_users_national_id" for="x_national_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->national_id->caption() ?><?= $Page->national_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->national_id->cellAttributes() ?>>
<span id="el_jdh_users_national_id">
<input type="<?= $Page->national_id->getInputTextType() ?>" name="x_national_id" id="x_national_id" data-table="jdh_users" data-field="x_national_id" value="<?= $Page->national_id->EditValue ?>" size="30" maxlength="14" placeholder="<?= HtmlEncode($Page->national_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->national_id->formatPattern()) ?>"<?= $Page->national_id->editAttributes() ?> aria-describedby="x_national_id_help">
<?= $Page->national_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->national_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->email_address->Visible) { // email_address ?>
    <div id="r_email_address"<?= $Page->email_address->rowAttributes() ?>>
        <label id="elh_jdh_users_email_address" for="x_email_address" class="<?= $Page->LeftColumnClass ?>"><?= $Page->email_address->caption() ?><?= $Page->email_address->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->email_address->cellAttributes() ?>>
<span id="el_jdh_users_email_address">
<input type="<?= $Page->email_address->getInputTextType() ?>" name="x_email_address" id="x_email_address" data-table="jdh_users" data-field="x_email_address" value="<?= $Page->email_address->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->email_address->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->email_address->formatPattern()) ?>"<?= $Page->email_address->editAttributes() ?> aria-describedby="x_email_address_help">
<?= $Page->email_address->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->email_address->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->phone->Visible) { // phone ?>
    <div id="r_phone"<?= $Page->phone->rowAttributes() ?>>
        <label id="elh_jdh_users_phone" for="x_phone" class="<?= $Page->LeftColumnClass ?>"><?= $Page->phone->caption() ?><?= $Page->phone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->phone->cellAttributes() ?>>
<span id="el_jdh_users_phone">
<input type="<?= $Page->phone->getInputTextType() ?>" name="x_phone" id="x_phone" data-table="jdh_users" data-field="x_phone" value="<?= $Page->phone->EditValue ?>" size="30" maxlength="15" placeholder="<?= HtmlEncode($Page->phone->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->phone->formatPattern()) ?>"<?= $Page->phone->editAttributes() ?> aria-describedby="x_phone_help">
<?= $Page->phone->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->phone->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->department_id->Visible) { // department_id ?>
    <div id="r_department_id"<?= $Page->department_id->rowAttributes() ?>>
        <label id="elh_jdh_users_department_id" for="x_department_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->department_id->caption() ?><?= $Page->department_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->department_id->cellAttributes() ?>>
<span id="el_jdh_users_department_id">
    <select
        id="x_department_id"
        name="x_department_id"
        class="form-select ew-select<?= $Page->department_id->isInvalidClass() ?>"
        data-select2-id="fjdh_usersadd_x_department_id"
        data-table="jdh_users"
        data-field="x_department_id"
        data-value-separator="<?= $Page->department_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->department_id->getPlaceHolder()) ?>"
        <?= $Page->department_id->editAttributes() ?>>
        <?= $Page->department_id->selectOptionListHtml("x_department_id") ?>
    </select>
    <?= $Page->department_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->department_id->getErrorMessage() ?></div>
<?= $Page->department_id->Lookup->getParamTag($Page, "p_x_department_id") ?>
<script>
loadjs.ready("fjdh_usersadd", function() {
    var options = { name: "x_department_id", selectId: "fjdh_usersadd_x_department_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_usersadd.lists.department_id?.lookupOptions.length) {
        options.data = { id: "x_department_id", form: "fjdh_usersadd" };
    } else {
        options.ajax = { id: "x_department_id", form: "fjdh_usersadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_users.fields.department_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_password->Visible) { // password ?>
    <div id="r__password"<?= $Page->_password->rowAttributes() ?>>
        <label id="elh_jdh_users__password" for="x__password" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_password->caption() ?><?= $Page->_password->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->_password->cellAttributes() ?>>
<span id="el_jdh_users__password">
<div class="input-group" id="ig__password">
    <input type="text" data-password-strength="pst__password" data-table="jdh_users" data-field="x__password" name="x__password" id="x__password" value="<?= $Page->_password->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->_password->getPlaceHolder()) ?>"<?= $Page->_password->editAttributes() ?> aria-describedby="x__password_help">
    <button type="button" class="btn btn-default ew-toggle-password rounded-end" data-ew-action="password"><i class="fa-solid fa-eye"></i></button>
</div>
<div class="progress ew-password-strength-bar form-text mt-1 d-none" id="pst__password">
    <div class="progress-bar" role="progressbar"></div>
</div>
<?= $Page->_password->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_password->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->biography->Visible) { // biography ?>
    <div id="r_biography"<?= $Page->biography->rowAttributes() ?>>
        <label id="elh_jdh_users_biography" for="x_biography" class="<?= $Page->LeftColumnClass ?>"><?= $Page->biography->caption() ?><?= $Page->biography->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->biography->cellAttributes() ?>>
<span id="el_jdh_users_biography">
<textarea data-table="jdh_users" data-field="x_biography" name="x_biography" id="x_biography" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->biography->getPlaceHolder()) ?>"<?= $Page->biography->editAttributes() ?> aria-describedby="x_biography_help"><?= $Page->biography->EditValue ?></textarea>
<?= $Page->biography->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->biography->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->role_id->Visible) { // role_id ?>
    <div id="r_role_id"<?= $Page->role_id->rowAttributes() ?>>
        <label id="elh_jdh_users_role_id" for="x_role_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->role_id->caption() ?><?= $Page->role_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->role_id->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<span id="el_jdh_users_role_id">
<span class="form-control-plaintext"><?= $Page->role_id->getDisplayValue($Page->role_id->EditValue) ?></span>
</span>
<?php } else { ?>
<span id="el_jdh_users_role_id">
    <select
        id="x_role_id"
        name="x_role_id"
        class="form-select ew-select<?= $Page->role_id->isInvalidClass() ?>"
        data-select2-id="fjdh_usersadd_x_role_id"
        data-table="jdh_users"
        data-field="x_role_id"
        data-value-separator="<?= $Page->role_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->role_id->getPlaceHolder()) ?>"
        <?= $Page->role_id->editAttributes() ?>>
        <?= $Page->role_id->selectOptionListHtml("x_role_id") ?>
    </select>
    <?= $Page->role_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->role_id->getErrorMessage() ?></div>
<script>
loadjs.ready("fjdh_usersadd", function() {
    var options = { name: "x_role_id", selectId: "fjdh_usersadd_x_role_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_usersadd.lists.role_id?.lookupOptions.length) {
        options.data = { id: "x_role_id", form: "fjdh_usersadd" };
    } else {
        options.ajax = { id: "x_role_id", form: "fjdh_usersadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_users.fields.role_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fjdh_usersadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fjdh_usersadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("jdh_users");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
