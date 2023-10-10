<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$JdhEmployeeCredentialsEdit = &$Page;
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
<form name="fjdh_employee_credentialsedit" id="fjdh_employee_credentialsedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_employee_credentials: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fjdh_employee_credentialsedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_employee_credentialsedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["cv", [fields.cv.visible && fields.cv.required ? ew.Validators.fileRequired(fields.cv.caption) : null], fields.cv.isInvalid],
            ["academic_certificates", [fields.academic_certificates.visible && fields.academic_certificates.required ? ew.Validators.fileRequired(fields.academic_certificates.caption) : null], fields.academic_certificates.isInvalid],
            ["professional_certifications", [fields.professional_certifications.visible && fields.professional_certifications.required ? ew.Validators.fileRequired(fields.professional_certifications.caption) : null], fields.professional_certifications.isInvalid]
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
<input type="hidden" name="t" value="jdh_employee_credentials">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "jdh_users") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="jdh_users">
<input type="hidden" name="fk_photo" value="<?= HtmlEncode($Page->user_id->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_jdh_employee_credentials_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_jdh_employee_credentials_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="jdh_employee_credentials" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->cv->Visible) { // cv ?>
    <div id="r_cv"<?= $Page->cv->rowAttributes() ?>>
        <label id="elh_jdh_employee_credentials_cv" class="<?= $Page->LeftColumnClass ?>"><?= $Page->cv->caption() ?><?= $Page->cv->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->cv->cellAttributes() ?>>
<span id="el_jdh_employee_credentials_cv">
<div id="fd_x_cv" class="fileinput-button ew-file-drop-zone">
    <input
        type="file"
        id="x_cv"
        name="x_cv"
        class="form-control ew-file-input"
        title="<?= $Page->cv->title() ?>"
        lang="<?= CurrentLanguageID() ?>"
        data-table="jdh_employee_credentials"
        data-field="x_cv"
        data-size="0"
        data-accept-file-types="<?= $Page->cv->acceptFileTypes() ?>"
        data-max-file-size="<?= $Page->cv->UploadMaxFileSize ?>"
        data-max-number-of-files="null"
        data-disable-image-crop="<?= $Page->cv->ImageCropper ? 0 : 1 ?>"
        aria-describedby="x_cv_help"
        <?= ($Page->cv->ReadOnly || $Page->cv->Disabled) ? " disabled" : "" ?>
        <?= $Page->cv->editAttributes() ?>
    >
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<?= $Page->cv->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->cv->getErrorMessage() ?></div>
<input type="hidden" name="fn_x_cv" id= "fn_x_cv" value="<?= $Page->cv->Upload->FileName ?>">
<input type="hidden" name="fa_x_cv" id= "fa_x_cv" value="<?= (Post("fa_x_cv") == "0") ? "0" : "1" ?>">
<table id="ft_x_cv" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->academic_certificates->Visible) { // academic_certificates ?>
    <div id="r_academic_certificates"<?= $Page->academic_certificates->rowAttributes() ?>>
        <label id="elh_jdh_employee_credentials_academic_certificates" class="<?= $Page->LeftColumnClass ?>"><?= $Page->academic_certificates->caption() ?><?= $Page->academic_certificates->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->academic_certificates->cellAttributes() ?>>
<span id="el_jdh_employee_credentials_academic_certificates">
<div id="fd_x_academic_certificates" class="fileinput-button ew-file-drop-zone">
    <input
        type="file"
        id="x_academic_certificates"
        name="x_academic_certificates"
        class="form-control ew-file-input"
        title="<?= $Page->academic_certificates->title() ?>"
        lang="<?= CurrentLanguageID() ?>"
        data-table="jdh_employee_credentials"
        data-field="x_academic_certificates"
        data-size="0"
        data-accept-file-types="<?= $Page->academic_certificates->acceptFileTypes() ?>"
        data-max-file-size="<?= $Page->academic_certificates->UploadMaxFileSize ?>"
        data-max-number-of-files="null"
        data-disable-image-crop="<?= $Page->academic_certificates->ImageCropper ? 0 : 1 ?>"
        aria-describedby="x_academic_certificates_help"
        <?= ($Page->academic_certificates->ReadOnly || $Page->academic_certificates->Disabled) ? " disabled" : "" ?>
        <?= $Page->academic_certificates->editAttributes() ?>
    >
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<?= $Page->academic_certificates->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->academic_certificates->getErrorMessage() ?></div>
<input type="hidden" name="fn_x_academic_certificates" id= "fn_x_academic_certificates" value="<?= $Page->academic_certificates->Upload->FileName ?>">
<input type="hidden" name="fa_x_academic_certificates" id= "fa_x_academic_certificates" value="<?= (Post("fa_x_academic_certificates") == "0") ? "0" : "1" ?>">
<table id="ft_x_academic_certificates" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->professional_certifications->Visible) { // professional_certifications ?>
    <div id="r_professional_certifications"<?= $Page->professional_certifications->rowAttributes() ?>>
        <label id="elh_jdh_employee_credentials_professional_certifications" class="<?= $Page->LeftColumnClass ?>"><?= $Page->professional_certifications->caption() ?><?= $Page->professional_certifications->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->professional_certifications->cellAttributes() ?>>
<span id="el_jdh_employee_credentials_professional_certifications">
<div id="fd_x_professional_certifications" class="fileinput-button ew-file-drop-zone">
    <input
        type="file"
        id="x_professional_certifications"
        name="x_professional_certifications"
        class="form-control ew-file-input"
        title="<?= $Page->professional_certifications->title() ?>"
        lang="<?= CurrentLanguageID() ?>"
        data-table="jdh_employee_credentials"
        data-field="x_professional_certifications"
        data-size="0"
        data-accept-file-types="<?= $Page->professional_certifications->acceptFileTypes() ?>"
        data-max-file-size="<?= $Page->professional_certifications->UploadMaxFileSize ?>"
        data-max-number-of-files="null"
        data-disable-image-crop="<?= $Page->professional_certifications->ImageCropper ? 0 : 1 ?>"
        aria-describedby="x_professional_certifications_help"
        <?= ($Page->professional_certifications->ReadOnly || $Page->professional_certifications->Disabled) ? " disabled" : "" ?>
        <?= $Page->professional_certifications->editAttributes() ?>
    >
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<?= $Page->professional_certifications->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->professional_certifications->getErrorMessage() ?></div>
<input type="hidden" name="fn_x_professional_certifications" id= "fn_x_professional_certifications" value="<?= $Page->professional_certifications->Upload->FileName ?>">
<input type="hidden" name="fa_x_professional_certifications" id= "fa_x_professional_certifications" value="<?= (Post("fa_x_professional_certifications") == "0") ? "0" : "1" ?>">
<table id="ft_x_professional_certifications" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fjdh_employee_credentialsedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fjdh_employee_credentialsedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("jdh_employee_credentials");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
