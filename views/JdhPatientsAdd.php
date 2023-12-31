<?php

namespace PHPMaker2024\jootidigitalhealthcare;

// Page object
$JdhPatientsAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_patients: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fjdh_patientsadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_patientsadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["photo", [fields.photo.visible && fields.photo.required ? ew.Validators.fileRequired(fields.photo.caption) : null], fields.photo.isInvalid],
            ["patient_ip_number", [fields.patient_ip_number.visible && fields.patient_ip_number.required ? ew.Validators.required(fields.patient_ip_number.caption) : null], fields.patient_ip_number.isInvalid],
            ["patient_name", [fields.patient_name.visible && fields.patient_name.required ? ew.Validators.required(fields.patient_name.caption) : null], fields.patient_name.isInvalid],
            ["patient_dob_year", [fields.patient_dob_year.visible && fields.patient_dob_year.required ? ew.Validators.required(fields.patient_dob_year.caption) : null, ew.Validators.integer], fields.patient_dob_year.isInvalid],
            ["patient_gender", [fields.patient_gender.visible && fields.patient_gender.required ? ew.Validators.required(fields.patient_gender.caption) : null], fields.patient_gender.isInvalid],
            ["patient_phone", [fields.patient_phone.visible && fields.patient_phone.required ? ew.Validators.required(fields.patient_phone.caption) : null], fields.patient_phone.isInvalid],
            ["patient_kin_name", [fields.patient_kin_name.visible && fields.patient_kin_name.required ? ew.Validators.required(fields.patient_kin_name.caption) : null], fields.patient_kin_name.isInvalid],
            ["patient_kin_phone", [fields.patient_kin_phone.visible && fields.patient_kin_phone.required ? ew.Validators.required(fields.patient_kin_phone.caption) : null], fields.patient_kin_phone.isInvalid],
            ["service_id", [fields.service_id.visible && fields.service_id.required ? ew.Validators.required(fields.service_id.caption) : null], fields.service_id.isInvalid],
            ["is_inpatient", [fields.is_inpatient.visible && fields.is_inpatient.required ? ew.Validators.required(fields.is_inpatient.caption) : null], fields.is_inpatient.isInvalid],
            ["submitted_by_user_id", [fields.submitted_by_user_id.visible && fields.submitted_by_user_id.required ? ew.Validators.required(fields.submitted_by_user_id.caption) : null], fields.submitted_by_user_id.isInvalid]
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
            "service_id": <?= $Page->service_id->toClientList($Page) ?>,
            "is_inpatient": <?= $Page->is_inpatient->toClientList($Page) ?>,
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
<form name="fjdh_patientsadd" id="fjdh_patientsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jdh_patients">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
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
        data-size="16777215"
        data-accept-file-types="<?= $Page->photo->acceptFileTypes() ?>"
        data-max-file-size="<?= $Page->photo->UploadMaxFileSize ?>"
        data-max-number-of-files="null"
        data-disable-image-crop="<?= $Page->photo->ImageCropper ? 0 : 1 ?>"
        aria-describedby="x_photo_help"
        <?= ($Page->photo->ReadOnly || $Page->photo->Disabled) ? " disabled" : "" ?>
        <?= $Page->photo->editAttributes() ?>
    >
    <div class="text-body-secondary ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
    <?= $Page->photo->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->photo->getErrorMessage() ?></div>
</div>
<input type="hidden" name="fn_x_photo" id= "fn_x_photo" value="<?= $Page->photo->Upload->FileName ?>">
<input type="hidden" name="fa_x_photo" id= "fa_x_photo" value="0">
<table id="ft_x_photo" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->patient_ip_number->Visible) { // patient_ip_number ?>
    <div id="r_patient_ip_number"<?= $Page->patient_ip_number->rowAttributes() ?>>
        <label id="elh_jdh_patients_patient_ip_number" for="x_patient_ip_number" class="<?= $Page->LeftColumnClass ?>"><?= $Page->patient_ip_number->caption() ?><?= $Page->patient_ip_number->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->patient_ip_number->cellAttributes() ?>>
<span id="el_jdh_patients_patient_ip_number">
<input type="<?= $Page->patient_ip_number->getInputTextType() ?>" name="x_patient_ip_number" id="x_patient_ip_number" data-table="jdh_patients" data-field="x_patient_ip_number" value="<?= $Page->patient_ip_number->EditValue ?>" size="30" maxlength="13" placeholder="<?= HtmlEncode($Page->patient_ip_number->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->patient_ip_number->formatPattern()) ?>"<?= $Page->patient_ip_number->editAttributes() ?> aria-describedby="x_patient_ip_number_help">
<?= $Page->patient_ip_number->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->patient_ip_number->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->patient_name->Visible) { // patient_name ?>
    <div id="r_patient_name"<?= $Page->patient_name->rowAttributes() ?>>
        <label id="elh_jdh_patients_patient_name" for="x_patient_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->patient_name->caption() ?><?= $Page->patient_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->patient_name->cellAttributes() ?>>
<span id="el_jdh_patients_patient_name">
<input type="<?= $Page->patient_name->getInputTextType() ?>" name="x_patient_name" id="x_patient_name" data-table="jdh_patients" data-field="x_patient_name" value="<?= $Page->patient_name->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->patient_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->patient_name->formatPattern()) ?>"<?= $Page->patient_name->editAttributes() ?> aria-describedby="x_patient_name_help">
<?= $Page->patient_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->patient_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->patient_dob_year->Visible) { // patient_dob_year ?>
    <div id="r_patient_dob_year"<?= $Page->patient_dob_year->rowAttributes() ?>>
        <label id="elh_jdh_patients_patient_dob_year" for="x_patient_dob_year" class="<?= $Page->LeftColumnClass ?>"><?= $Page->patient_dob_year->caption() ?><?= $Page->patient_dob_year->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->patient_dob_year->cellAttributes() ?>>
<span id="el_jdh_patients_patient_dob_year">
<input type="<?= $Page->patient_dob_year->getInputTextType() ?>" name="x_patient_dob_year" id="x_patient_dob_year" data-table="jdh_patients" data-field="x_patient_dob_year" value="<?= $Page->patient_dob_year->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->patient_dob_year->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->patient_dob_year->formatPattern()) ?>"<?= $Page->patient_dob_year->editAttributes() ?> aria-describedby="x_patient_dob_year_help">
<?= $Page->patient_dob_year->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->patient_dob_year->getErrorMessage() ?></div>
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
        <?php if (!$Page->patient_gender->IsNativeSelect) { ?>
        data-select2-id="fjdh_patientsadd_x_patient_gender"
        <?php } ?>
        data-table="jdh_patients"
        data-field="x_patient_gender"
        data-value-separator="<?= $Page->patient_gender->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->patient_gender->getPlaceHolder()) ?>"
        <?= $Page->patient_gender->editAttributes() ?>>
        <?= $Page->patient_gender->selectOptionListHtml("x_patient_gender") ?>
    </select>
    <?= $Page->patient_gender->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->patient_gender->getErrorMessage() ?></div>
<?php if (!$Page->patient_gender->IsNativeSelect) { ?>
<script>
loadjs.ready("fjdh_patientsadd", function() {
    var options = { name: "x_patient_gender", selectId: "fjdh_patientsadd_x_patient_gender" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_patientsadd.lists.patient_gender?.lookupOptions.length) {
        options.data = { id: "x_patient_gender", form: "fjdh_patientsadd" };
    } else {
        options.ajax = { id: "x_patient_gender", form: "fjdh_patientsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_patients.fields.patient_gender.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
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
<?php if ($Page->service_id->Visible) { // service_id ?>
    <div id="r_service_id"<?= $Page->service_id->rowAttributes() ?>>
        <label id="elh_jdh_patients_service_id" for="x_service_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->service_id->caption() ?><?= $Page->service_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->service_id->cellAttributes() ?>>
<span id="el_jdh_patients_service_id">
    <select
        id="x_service_id"
        name="x_service_id"
        class="form-select ew-select<?= $Page->service_id->isInvalidClass() ?>"
        <?php if (!$Page->service_id->IsNativeSelect) { ?>
        data-select2-id="fjdh_patientsadd_x_service_id"
        <?php } ?>
        data-table="jdh_patients"
        data-field="x_service_id"
        data-value-separator="<?= $Page->service_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->service_id->getPlaceHolder()) ?>"
        <?= $Page->service_id->editAttributes() ?>>
        <?= $Page->service_id->selectOptionListHtml("x_service_id") ?>
    </select>
    <?= $Page->service_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->service_id->getErrorMessage() ?></div>
<?= $Page->service_id->Lookup->getParamTag($Page, "p_x_service_id") ?>
<?php if (!$Page->service_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fjdh_patientsadd", function() {
    var options = { name: "x_service_id", selectId: "fjdh_patientsadd_x_service_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_patientsadd.lists.service_id?.lookupOptions.length) {
        options.data = { id: "x_service_id", form: "fjdh_patientsadd" };
    } else {
        options.ajax = { id: "x_service_id", form: "fjdh_patientsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_patients.fields.service_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->is_inpatient->Visible) { // is_inpatient ?>
    <div id="r_is_inpatient"<?= $Page->is_inpatient->rowAttributes() ?>>
        <label id="elh_jdh_patients_is_inpatient" for="x_is_inpatient" class="<?= $Page->LeftColumnClass ?>"><?= $Page->is_inpatient->caption() ?><?= $Page->is_inpatient->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->is_inpatient->cellAttributes() ?>>
<span id="el_jdh_patients_is_inpatient">
    <select
        id="x_is_inpatient"
        name="x_is_inpatient"
        class="form-select ew-select<?= $Page->is_inpatient->isInvalidClass() ?>"
        <?php if (!$Page->is_inpatient->IsNativeSelect) { ?>
        data-select2-id="fjdh_patientsadd_x_is_inpatient"
        <?php } ?>
        data-table="jdh_patients"
        data-field="x_is_inpatient"
        data-value-separator="<?= $Page->is_inpatient->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->is_inpatient->getPlaceHolder()) ?>"
        <?= $Page->is_inpatient->editAttributes() ?>>
        <?= $Page->is_inpatient->selectOptionListHtml("x_is_inpatient") ?>
    </select>
    <?= $Page->is_inpatient->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->is_inpatient->getErrorMessage() ?></div>
<?php if (!$Page->is_inpatient->IsNativeSelect) { ?>
<script>
loadjs.ready("fjdh_patientsadd", function() {
    var options = { name: "x_is_inpatient", selectId: "fjdh_patientsadd_x_is_inpatient" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_patientsadd.lists.is_inpatient?.lookupOptions.length) {
        options.data = { id: "x_is_inpatient", form: "fjdh_patientsadd" };
    } else {
        options.ajax = { id: "x_is_inpatient", form: "fjdh_patientsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_patients.fields.is_inpatient.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<?php
    $Page->DetailPages->ValidKeys = explode(",", $Page->getCurrentDetailTable());
?>
<div class="ew-detail-pages"><!-- detail-pages -->
<div class="ew-nav<?= $Page->DetailPages->containerClasses() ?>" id="details_Page"><!-- tabs -->
    <ul class="<?= $Page->DetailPages->navClasses() ?>" role="tablist"><!-- .nav -->
<?php
    if (in_array("jdh_patient_visits", explode(",", $Page->getCurrentDetailTable())) && $jdh_patient_visits->DetailAdd) {
?>
        <li class="nav-item"><button class="<?= $Page->DetailPages->navLinkClasses("jdh_patient_visits") ?><?= $Page->DetailPages->activeClasses("jdh_patient_visits") ?>" data-bs-target="#tab_jdh_patient_visits" data-bs-toggle="tab" type="button" role="tab" aria-controls="tab_jdh_patient_visits" aria-selected="<?= JsonEncode($Page->DetailPages->isActive("jdh_patient_visits")) ?>"><?= $Language->tablePhrase("jdh_patient_visits", "TblCaption") ?></button></li>
<?php
    }
?>
<?php
    if (in_array("jdh_chief_complaints", explode(",", $Page->getCurrentDetailTable())) && $jdh_chief_complaints->DetailAdd) {
?>
        <li class="nav-item"><button class="<?= $Page->DetailPages->navLinkClasses("jdh_chief_complaints") ?><?= $Page->DetailPages->activeClasses("jdh_chief_complaints") ?>" data-bs-target="#tab_jdh_chief_complaints" data-bs-toggle="tab" type="button" role="tab" aria-controls="tab_jdh_chief_complaints" aria-selected="<?= JsonEncode($Page->DetailPages->isActive("jdh_chief_complaints")) ?>"><?= $Language->tablePhrase("jdh_chief_complaints", "TblCaption") ?></button></li>
<?php
    }
?>
<?php
    if (in_array("jdh_examination_findings", explode(",", $Page->getCurrentDetailTable())) && $jdh_examination_findings->DetailAdd) {
?>
        <li class="nav-item"><button class="<?= $Page->DetailPages->navLinkClasses("jdh_examination_findings") ?><?= $Page->DetailPages->activeClasses("jdh_examination_findings") ?>" data-bs-target="#tab_jdh_examination_findings" data-bs-toggle="tab" type="button" role="tab" aria-controls="tab_jdh_examination_findings" aria-selected="<?= JsonEncode($Page->DetailPages->isActive("jdh_examination_findings")) ?>"><?= $Language->tablePhrase("jdh_examination_findings", "TblCaption") ?></button></li>
<?php
    }
?>
<?php
    if (in_array("jdh_patient_cases", explode(",", $Page->getCurrentDetailTable())) && $jdh_patient_cases->DetailAdd) {
?>
        <li class="nav-item"><button class="<?= $Page->DetailPages->navLinkClasses("jdh_patient_cases") ?><?= $Page->DetailPages->activeClasses("jdh_patient_cases") ?>" data-bs-target="#tab_jdh_patient_cases" data-bs-toggle="tab" type="button" role="tab" aria-controls="tab_jdh_patient_cases" aria-selected="<?= JsonEncode($Page->DetailPages->isActive("jdh_patient_cases")) ?>"><?= $Language->tablePhrase("jdh_patient_cases", "TblCaption") ?></button></li>
<?php
    }
?>
<?php
    if (in_array("jdh_prescriptions", explode(",", $Page->getCurrentDetailTable())) && $jdh_prescriptions->DetailAdd) {
?>
        <li class="nav-item"><button class="<?= $Page->DetailPages->navLinkClasses("jdh_prescriptions") ?><?= $Page->DetailPages->activeClasses("jdh_prescriptions") ?>" data-bs-target="#tab_jdh_prescriptions" data-bs-toggle="tab" type="button" role="tab" aria-controls="tab_jdh_prescriptions" aria-selected="<?= JsonEncode($Page->DetailPages->isActive("jdh_prescriptions")) ?>"><?= $Language->tablePhrase("jdh_prescriptions", "TblCaption") ?></button></li>
<?php
    }
?>
<?php
    if (in_array("jdh_prescriptions_actions", explode(",", $Page->getCurrentDetailTable())) && $jdh_prescriptions_actions->DetailAdd) {
?>
        <li class="nav-item"><button class="<?= $Page->DetailPages->navLinkClasses("jdh_prescriptions_actions") ?><?= $Page->DetailPages->activeClasses("jdh_prescriptions_actions") ?>" data-bs-target="#tab_jdh_prescriptions_actions" data-bs-toggle="tab" type="button" role="tab" aria-controls="tab_jdh_prescriptions_actions" aria-selected="<?= JsonEncode($Page->DetailPages->isActive("jdh_prescriptions_actions")) ?>"><?= $Language->tablePhrase("jdh_prescriptions_actions", "TblCaption") ?></button></li>
<?php
    }
?>
<?php
    if (in_array("jdh_appointments", explode(",", $Page->getCurrentDetailTable())) && $jdh_appointments->DetailAdd) {
?>
        <li class="nav-item"><button class="<?= $Page->DetailPages->navLinkClasses("jdh_appointments") ?><?= $Page->DetailPages->activeClasses("jdh_appointments") ?>" data-bs-target="#tab_jdh_appointments" data-bs-toggle="tab" type="button" role="tab" aria-controls="tab_jdh_appointments" aria-selected="<?= JsonEncode($Page->DetailPages->isActive("jdh_appointments")) ?>"><?= $Language->tablePhrase("jdh_appointments", "TblCaption") ?></button></li>
<?php
    }
?>
<?php
    if (in_array("jdh_vitals", explode(",", $Page->getCurrentDetailTable())) && $jdh_vitals->DetailAdd) {
?>
        <li class="nav-item"><button class="<?= $Page->DetailPages->navLinkClasses("jdh_vitals") ?><?= $Page->DetailPages->activeClasses("jdh_vitals") ?>" data-bs-target="#tab_jdh_vitals" data-bs-toggle="tab" type="button" role="tab" aria-controls="tab_jdh_vitals" aria-selected="<?= JsonEncode($Page->DetailPages->isActive("jdh_vitals")) ?>"><?= $Language->tablePhrase("jdh_vitals", "TblCaption") ?></button></li>
<?php
    }
?>
<?php
    if (in_array("jdh_test_requests", explode(",", $Page->getCurrentDetailTable())) && $jdh_test_requests->DetailAdd) {
?>
        <li class="nav-item"><button class="<?= $Page->DetailPages->navLinkClasses("jdh_test_requests") ?><?= $Page->DetailPages->activeClasses("jdh_test_requests") ?>" data-bs-target="#tab_jdh_test_requests" data-bs-toggle="tab" type="button" role="tab" aria-controls="tab_jdh_test_requests" aria-selected="<?= JsonEncode($Page->DetailPages->isActive("jdh_test_requests")) ?>"><?= $Language->tablePhrase("jdh_test_requests", "TblCaption") ?></button></li>
<?php
    }
?>
<?php
    if (in_array("jdh_test_reports", explode(",", $Page->getCurrentDetailTable())) && $jdh_test_reports->DetailAdd) {
?>
        <li class="nav-item"><button class="<?= $Page->DetailPages->navLinkClasses("jdh_test_reports") ?><?= $Page->DetailPages->activeClasses("jdh_test_reports") ?>" data-bs-target="#tab_jdh_test_reports" data-bs-toggle="tab" type="button" role="tab" aria-controls="tab_jdh_test_reports" aria-selected="<?= JsonEncode($Page->DetailPages->isActive("jdh_test_reports")) ?>"><?= $Language->tablePhrase("jdh_test_reports", "TblCaption") ?></button></li>
<?php
    }
?>
    </ul><!-- /.nav -->
    <div class="<?= $Page->DetailPages->tabContentClasses() ?>"><!-- .tab-content -->
<?php
    if (in_array("jdh_patient_visits", explode(",", $Page->getCurrentDetailTable())) && $jdh_patient_visits->DetailAdd) {
?>
        <div class="<?= $Page->DetailPages->tabPaneClasses("jdh_patient_visits") ?><?= $Page->DetailPages->activeClasses("jdh_patient_visits") ?>" id="tab_jdh_patient_visits" role="tabpanel"><!-- page* -->
<?php include_once "JdhPatientVisitsGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
<?php
    if (in_array("jdh_chief_complaints", explode(",", $Page->getCurrentDetailTable())) && $jdh_chief_complaints->DetailAdd) {
?>
        <div class="<?= $Page->DetailPages->tabPaneClasses("jdh_chief_complaints") ?><?= $Page->DetailPages->activeClasses("jdh_chief_complaints") ?>" id="tab_jdh_chief_complaints" role="tabpanel"><!-- page* -->
<?php include_once "JdhChiefComplaintsGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
<?php
    if (in_array("jdh_examination_findings", explode(",", $Page->getCurrentDetailTable())) && $jdh_examination_findings->DetailAdd) {
?>
        <div class="<?= $Page->DetailPages->tabPaneClasses("jdh_examination_findings") ?><?= $Page->DetailPages->activeClasses("jdh_examination_findings") ?>" id="tab_jdh_examination_findings" role="tabpanel"><!-- page* -->
<?php include_once "JdhExaminationFindingsGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
<?php
    if (in_array("jdh_patient_cases", explode(",", $Page->getCurrentDetailTable())) && $jdh_patient_cases->DetailAdd) {
?>
        <div class="<?= $Page->DetailPages->tabPaneClasses("jdh_patient_cases") ?><?= $Page->DetailPages->activeClasses("jdh_patient_cases") ?>" id="tab_jdh_patient_cases" role="tabpanel"><!-- page* -->
<?php include_once "JdhPatientCasesGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
<?php
    if (in_array("jdh_prescriptions", explode(",", $Page->getCurrentDetailTable())) && $jdh_prescriptions->DetailAdd) {
?>
        <div class="<?= $Page->DetailPages->tabPaneClasses("jdh_prescriptions") ?><?= $Page->DetailPages->activeClasses("jdh_prescriptions") ?>" id="tab_jdh_prescriptions" role="tabpanel"><!-- page* -->
<?php include_once "JdhPrescriptionsGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
<?php
    if (in_array("jdh_prescriptions_actions", explode(",", $Page->getCurrentDetailTable())) && $jdh_prescriptions_actions->DetailAdd) {
?>
        <div class="<?= $Page->DetailPages->tabPaneClasses("jdh_prescriptions_actions") ?><?= $Page->DetailPages->activeClasses("jdh_prescriptions_actions") ?>" id="tab_jdh_prescriptions_actions" role="tabpanel"><!-- page* -->
<?php include_once "JdhPrescriptionsActionsGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
<?php
    if (in_array("jdh_appointments", explode(",", $Page->getCurrentDetailTable())) && $jdh_appointments->DetailAdd) {
?>
        <div class="<?= $Page->DetailPages->tabPaneClasses("jdh_appointments") ?><?= $Page->DetailPages->activeClasses("jdh_appointments") ?>" id="tab_jdh_appointments" role="tabpanel"><!-- page* -->
<?php include_once "JdhAppointmentsGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
<?php
    if (in_array("jdh_vitals", explode(",", $Page->getCurrentDetailTable())) && $jdh_vitals->DetailAdd) {
?>
        <div class="<?= $Page->DetailPages->tabPaneClasses("jdh_vitals") ?><?= $Page->DetailPages->activeClasses("jdh_vitals") ?>" id="tab_jdh_vitals" role="tabpanel"><!-- page* -->
<?php include_once "JdhVitalsGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
<?php
    if (in_array("jdh_test_requests", explode(",", $Page->getCurrentDetailTable())) && $jdh_test_requests->DetailAdd) {
?>
        <div class="<?= $Page->DetailPages->tabPaneClasses("jdh_test_requests") ?><?= $Page->DetailPages->activeClasses("jdh_test_requests") ?>" id="tab_jdh_test_requests" role="tabpanel"><!-- page* -->
<?php include_once "JdhTestRequestsGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
<?php
    if (in_array("jdh_test_reports", explode(",", $Page->getCurrentDetailTable())) && $jdh_test_reports->DetailAdd) {
?>
        <div class="<?= $Page->DetailPages->tabPaneClasses("jdh_test_reports") ?><?= $Page->DetailPages->activeClasses("jdh_test_reports") ?>" id="tab_jdh_test_reports" role="tabpanel"><!-- page* -->
<?php include_once "JdhTestReportsGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
    </div><!-- /.tab-content -->
</div><!-- /tabs -->
</div><!-- /detail-pages -->
<?php } ?>
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fjdh_patientsadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fjdh_patientsadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("jdh_patients");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
