<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$JdhPatientsEdit = &$Page;
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
<form name="fjdh_patientsedit" id="fjdh_patientsedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_patients: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fjdh_patientsedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_patientsedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["patient_id", [fields.patient_id.visible && fields.patient_id.required ? ew.Validators.required(fields.patient_id.caption) : null], fields.patient_id.isInvalid],
            ["photo", [fields.photo.visible && fields.photo.required ? ew.Validators.fileRequired(fields.photo.caption) : null], fields.photo.isInvalid],
            ["patient_national_id", [fields.patient_national_id.visible && fields.patient_national_id.required ? ew.Validators.required(fields.patient_national_id.caption) : null], fields.patient_national_id.isInvalid],
            ["patient_first_name", [fields.patient_first_name.visible && fields.patient_first_name.required ? ew.Validators.required(fields.patient_first_name.caption) : null], fields.patient_first_name.isInvalid],
            ["patient_last_name", [fields.patient_last_name.visible && fields.patient_last_name.required ? ew.Validators.required(fields.patient_last_name.caption) : null], fields.patient_last_name.isInvalid],
            ["patient_dob", [fields.patient_dob.visible && fields.patient_dob.required ? ew.Validators.required(fields.patient_dob.caption) : null, ew.Validators.datetime(fields.patient_dob.clientFormatPattern)], fields.patient_dob.isInvalid],
            ["patient_gender", [fields.patient_gender.visible && fields.patient_gender.required ? ew.Validators.required(fields.patient_gender.caption) : null], fields.patient_gender.isInvalid],
            ["patient_phone", [fields.patient_phone.visible && fields.patient_phone.required ? ew.Validators.required(fields.patient_phone.caption) : null], fields.patient_phone.isInvalid],
            ["patient_kin_name", [fields.patient_kin_name.visible && fields.patient_kin_name.required ? ew.Validators.required(fields.patient_kin_name.caption) : null], fields.patient_kin_name.isInvalid],
            ["patient_kin_phone", [fields.patient_kin_phone.visible && fields.patient_kin_phone.required ? ew.Validators.required(fields.patient_kin_phone.caption) : null], fields.patient_kin_phone.isInvalid]
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
            "patient_gender": <?= $Page->patient_gender->toClientList($Page) ?>,
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
<input type="hidden" name="t" value="jdh_patients">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->patient_id->Visible) { // patient_id ?>
    <div id="r_patient_id"<?= $Page->patient_id->rowAttributes() ?>>
        <label id="elh_jdh_patients_patient_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->patient_id->caption() ?><?= $Page->patient_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->patient_id->cellAttributes() ?>>
<span id="el_jdh_patients_patient_id">
<span<?= $Page->patient_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->patient_id->getDisplayValue($Page->patient_id->EditValue))) ?>"></span>
<input type="hidden" data-table="jdh_patients" data-field="x_patient_id" data-hidden="1" name="x_patient_id" id="x_patient_id" value="<?= HtmlEncode($Page->patient_id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->photo->Visible) { // photo ?>
    <div id="r_photo"<?= $Page->photo->rowAttributes() ?>>
        <label id="elh_jdh_patients_photo" class="<?= $Page->LeftColumnClass ?>"><?= $Page->photo->caption() ?><?= $Page->photo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->photo->cellAttributes() ?>>
<span id="el_jdh_patients_photo">
<div id="fd_x_photo" class="fileinput-button ew-file-drop-zone">
    <input
        type="file"
        id="x_photo"
        name="x_photo"
        class="form-control ew-file-input"
        title="<?= $Page->photo->title() ?>"
        lang="<?= CurrentLanguageID() ?>"
        data-table="jdh_patients"
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
<input type="hidden" name="fa_x_photo" id= "fa_x_photo" value="<?= (Post("fa_x_photo") == "0") ? "0" : "1" ?>">
<table id="ft_x_photo" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->patient_national_id->Visible) { // patient_national_id ?>
    <div id="r_patient_national_id"<?= $Page->patient_national_id->rowAttributes() ?>>
        <label id="elh_jdh_patients_patient_national_id" for="x_patient_national_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->patient_national_id->caption() ?><?= $Page->patient_national_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->patient_national_id->cellAttributes() ?>>
<span id="el_jdh_patients_patient_national_id">
<input type="<?= $Page->patient_national_id->getInputTextType() ?>" name="x_patient_national_id" id="x_patient_national_id" data-table="jdh_patients" data-field="x_patient_national_id" value="<?= $Page->patient_national_id->EditValue ?>" size="30" maxlength="13" placeholder="<?= HtmlEncode($Page->patient_national_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->patient_national_id->formatPattern()) ?>"<?= $Page->patient_national_id->editAttributes() ?> aria-describedby="x_patient_national_id_help">
<?= $Page->patient_national_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->patient_national_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->patient_first_name->Visible) { // patient_first_name ?>
    <div id="r_patient_first_name"<?= $Page->patient_first_name->rowAttributes() ?>>
        <label id="elh_jdh_patients_patient_first_name" for="x_patient_first_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->patient_first_name->caption() ?><?= $Page->patient_first_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->patient_first_name->cellAttributes() ?>>
<span id="el_jdh_patients_patient_first_name">
<input type="<?= $Page->patient_first_name->getInputTextType() ?>" name="x_patient_first_name" id="x_patient_first_name" data-table="jdh_patients" data-field="x_patient_first_name" value="<?= $Page->patient_first_name->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->patient_first_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->patient_first_name->formatPattern()) ?>"<?= $Page->patient_first_name->editAttributes() ?> aria-describedby="x_patient_first_name_help">
<?= $Page->patient_first_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->patient_first_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->patient_last_name->Visible) { // patient_last_name ?>
    <div id="r_patient_last_name"<?= $Page->patient_last_name->rowAttributes() ?>>
        <label id="elh_jdh_patients_patient_last_name" for="x_patient_last_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->patient_last_name->caption() ?><?= $Page->patient_last_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->patient_last_name->cellAttributes() ?>>
<span id="el_jdh_patients_patient_last_name">
<input type="<?= $Page->patient_last_name->getInputTextType() ?>" name="x_patient_last_name" id="x_patient_last_name" data-table="jdh_patients" data-field="x_patient_last_name" value="<?= $Page->patient_last_name->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->patient_last_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->patient_last_name->formatPattern()) ?>"<?= $Page->patient_last_name->editAttributes() ?> aria-describedby="x_patient_last_name_help">
<?= $Page->patient_last_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->patient_last_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->patient_dob->Visible) { // patient_dob ?>
    <div id="r_patient_dob"<?= $Page->patient_dob->rowAttributes() ?>>
        <label id="elh_jdh_patients_patient_dob" for="x_patient_dob" class="<?= $Page->LeftColumnClass ?>"><?= $Page->patient_dob->caption() ?><?= $Page->patient_dob->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->patient_dob->cellAttributes() ?>>
<span id="el_jdh_patients_patient_dob">
<input type="<?= $Page->patient_dob->getInputTextType() ?>" name="x_patient_dob" id="x_patient_dob" data-table="jdh_patients" data-field="x_patient_dob" value="<?= $Page->patient_dob->EditValue ?>" placeholder="<?= HtmlEncode($Page->patient_dob->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->patient_dob->formatPattern()) ?>"<?= $Page->patient_dob->editAttributes() ?> aria-describedby="x_patient_dob_help">
<?= $Page->patient_dob->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->patient_dob->getErrorMessage() ?></div>
<?php if (!$Page->patient_dob->ReadOnly && !$Page->patient_dob->Disabled && !isset($Page->patient_dob->EditAttrs["readonly"]) && !isset($Page->patient_dob->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjdh_patientsedit", "datetimepicker"], function () {
    let format = "<?= DateFormat(7) ?>",
        options = {
            localization: {
                locale: ew.LANGUAGE_ID + "-u-nu-" + ew.getNumberingSystem(),
                ...ew.language.phrase("datetimepicker")
            },
            display: {
                icons: {
                    previous: ew.IS_RTL ? "fa-solid fa-chevron-right" : "fa-solid fa-chevron-left",
                    next: ew.IS_RTL ? "fa-solid fa-chevron-left" : "fa-solid fa-chevron-right"
                },
                components: {
                    hours: !!format.match(/h/i),
                    minutes: !!format.match(/m/),
                    seconds: !!format.match(/s/i),
                    useTwentyfourHour: !!format.match(/H/)
                },
                theme: ew.isDark() ? "dark" : "auto"
            },
            meta: {
                format
            }
        };
    ew.createDateTimePicker("fjdh_patientsedit", "x_patient_dob", jQuery.extend(true, {"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->patient_gender->Visible) { // patient_gender ?>
    <div id="r_patient_gender"<?= $Page->patient_gender->rowAttributes() ?>>
        <label id="elh_jdh_patients_patient_gender" for="x_patient_gender" class="<?= $Page->LeftColumnClass ?>"><?= $Page->patient_gender->caption() ?><?= $Page->patient_gender->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->patient_gender->cellAttributes() ?>>
<span id="el_jdh_patients_patient_gender">
    <select
        id="x_patient_gender"
        name="x_patient_gender"
        class="form-select ew-select<?= $Page->patient_gender->isInvalidClass() ?>"
        data-select2-id="fjdh_patientsedit_x_patient_gender"
        data-table="jdh_patients"
        data-field="x_patient_gender"
        data-value-separator="<?= $Page->patient_gender->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->patient_gender->getPlaceHolder()) ?>"
        <?= $Page->patient_gender->editAttributes() ?>>
        <?= $Page->patient_gender->selectOptionListHtml("x_patient_gender") ?>
    </select>
    <?= $Page->patient_gender->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->patient_gender->getErrorMessage() ?></div>
<script>
loadjs.ready("fjdh_patientsedit", function() {
    var options = { name: "x_patient_gender", selectId: "fjdh_patientsedit_x_patient_gender" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_patientsedit.lists.patient_gender?.lookupOptions.length) {
        options.data = { id: "x_patient_gender", form: "fjdh_patientsedit" };
    } else {
        options.ajax = { id: "x_patient_gender", form: "fjdh_patientsedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_patients.fields.patient_gender.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->patient_phone->Visible) { // patient_phone ?>
    <div id="r_patient_phone"<?= $Page->patient_phone->rowAttributes() ?>>
        <label id="elh_jdh_patients_patient_phone" for="x_patient_phone" class="<?= $Page->LeftColumnClass ?>"><?= $Page->patient_phone->caption() ?><?= $Page->patient_phone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->patient_phone->cellAttributes() ?>>
<span id="el_jdh_patients_patient_phone">
<input type="<?= $Page->patient_phone->getInputTextType() ?>" name="x_patient_phone" id="x_patient_phone" data-table="jdh_patients" data-field="x_patient_phone" value="<?= $Page->patient_phone->EditValue ?>" size="30" maxlength="15" placeholder="<?= HtmlEncode($Page->patient_phone->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->patient_phone->formatPattern()) ?>"<?= $Page->patient_phone->editAttributes() ?> aria-describedby="x_patient_phone_help">
<?= $Page->patient_phone->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->patient_phone->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->patient_kin_name->Visible) { // patient_kin_name ?>
    <div id="r_patient_kin_name"<?= $Page->patient_kin_name->rowAttributes() ?>>
        <label id="elh_jdh_patients_patient_kin_name" for="x_patient_kin_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->patient_kin_name->caption() ?><?= $Page->patient_kin_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->patient_kin_name->cellAttributes() ?>>
<span id="el_jdh_patients_patient_kin_name">
<input type="<?= $Page->patient_kin_name->getInputTextType() ?>" name="x_patient_kin_name" id="x_patient_kin_name" data-table="jdh_patients" data-field="x_patient_kin_name" value="<?= $Page->patient_kin_name->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->patient_kin_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->patient_kin_name->formatPattern()) ?>"<?= $Page->patient_kin_name->editAttributes() ?> aria-describedby="x_patient_kin_name_help">
<?= $Page->patient_kin_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->patient_kin_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->patient_kin_phone->Visible) { // patient_kin_phone ?>
    <div id="r_patient_kin_phone"<?= $Page->patient_kin_phone->rowAttributes() ?>>
        <label id="elh_jdh_patients_patient_kin_phone" for="x_patient_kin_phone" class="<?= $Page->LeftColumnClass ?>"><?= $Page->patient_kin_phone->caption() ?><?= $Page->patient_kin_phone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->patient_kin_phone->cellAttributes() ?>>
<span id="el_jdh_patients_patient_kin_phone">
<input type="<?= $Page->patient_kin_phone->getInputTextType() ?>" name="x_patient_kin_phone" id="x_patient_kin_phone" data-table="jdh_patients" data-field="x_patient_kin_phone" value="<?= $Page->patient_kin_phone->EditValue ?>" size="30" maxlength="15" placeholder="<?= HtmlEncode($Page->patient_kin_phone->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->patient_kin_phone->formatPattern()) ?>"<?= $Page->patient_kin_phone->editAttributes() ?> aria-describedby="x_patient_kin_phone_help">
<?= $Page->patient_kin_phone->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->patient_kin_phone->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php
    if (in_array("jdh_appointments", explode(",", $Page->getCurrentDetailTable())) && $jdh_appointments->DetailEdit) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("jdh_appointments", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "JdhAppointmentsGrid.php" ?>
<?php } ?>
<?php
    if (in_array("jdh_patient_cases", explode(",", $Page->getCurrentDetailTable())) && $jdh_patient_cases->DetailEdit) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("jdh_patient_cases", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "JdhPatientCasesGrid.php" ?>
<?php } ?>
<?php
    if (in_array("jdh_vitals", explode(",", $Page->getCurrentDetailTable())) && $jdh_vitals->DetailEdit) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("jdh_vitals", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "JdhVitalsGrid.php" ?>
<?php } ?>
<?php
    if (in_array("jdh_test_requests", explode(",", $Page->getCurrentDetailTable())) && $jdh_test_requests->DetailEdit) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("jdh_test_requests", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "JdhTestRequestsGrid.php" ?>
<?php } ?>
<?php
    if (in_array("jdh_patient_visits", explode(",", $Page->getCurrentDetailTable())) && $jdh_patient_visits->DetailEdit) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("jdh_patient_visits", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "JdhPatientVisitsGrid.php" ?>
<?php } ?>
<?php
    if (in_array("jdh_chief_complaints", explode(",", $Page->getCurrentDetailTable())) && $jdh_chief_complaints->DetailEdit) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("jdh_chief_complaints", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "JdhChiefComplaintsGrid.php" ?>
<?php } ?>
<?php
    if (in_array("jdh_examination_findings", explode(",", $Page->getCurrentDetailTable())) && $jdh_examination_findings->DetailEdit) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("jdh_examination_findings", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "JdhExaminationFindingsGrid.php" ?>
<?php } ?>
<?php
    if (in_array("jdh_test_reports", explode(",", $Page->getCurrentDetailTable())) && $jdh_test_reports->DetailEdit) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("jdh_test_reports", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "JdhTestReportsGrid.php" ?>
<?php } ?>
<?php
    if (in_array("jdh_prescriptions", explode(",", $Page->getCurrentDetailTable())) && $jdh_prescriptions->DetailEdit) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("jdh_prescriptions", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "JdhPrescriptionsGrid.php" ?>
<?php } ?>
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fjdh_patientsedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fjdh_patientsedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("jdh_patients");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
