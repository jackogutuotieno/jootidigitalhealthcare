<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Set up and run Grid object
$Grid = Container("JdhEmployeeCredentialsGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fjdh_employee_credentialsgrid;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { jdh_employee_credentials: currentTable } });
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_employee_credentialsgrid")
        .setPageId("grid")
        .setFormKeyCountName("<?= $Grid->FormKeyCountName ?>")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["cv", [fields.cv.visible && fields.cv.required ? ew.Validators.fileRequired(fields.cv.caption) : null], fields.cv.isInvalid],
            ["academic_certificates", [fields.academic_certificates.visible && fields.academic_certificates.required ? ew.Validators.fileRequired(fields.academic_certificates.caption) : null], fields.academic_certificates.isInvalid],
            ["professional_certifications", [fields.professional_certifications.visible && fields.professional_certifications.required ? ew.Validators.fileRequired(fields.professional_certifications.caption) : null], fields.professional_certifications.isInvalid],
            ["date_created", [fields.date_created.visible && fields.date_created.required ? ew.Validators.required(fields.date_created.caption) : null, ew.Validators.datetime(fields.date_created.clientFormatPattern)], fields.date_created.isInvalid],
            ["date_updated", [fields.date_updated.visible && fields.date_updated.required ? ew.Validators.required(fields.date_updated.caption) : null, ew.Validators.datetime(fields.date_updated.clientFormatPattern)], fields.date_updated.isInvalid]
        ])

        // Check empty row
        .setEmptyRow(
            function (rowIndex) {
                let fobj = this.getForm(),
                    fields = [["cv",false],["academic_certificates",false],["professional_certifications",false],["date_created",false],["date_updated",false]];
                if (fields.some(field => ew.valueChanged(fobj, rowIndex, ...field)))
                    return false;
                return true;
            }
        )

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
    loadjs.done(form.id);
});
</script>
<?php } ?>
<main class="list<?= ($Grid->TotalRecords == 0 && !$Grid->isAdd()) ? " ew-no-record" : "" ?>">
<div id="ew-list">
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?= $Grid->isAddOrEdit() ? " ew-grid-add-edit" : "" ?> <?= $Grid->TableGridClass ?>">
<div id="fjdh_employee_credentialsgrid" class="ew-form ew-list-form">
<div id="gmp_jdh_employee_credentials" class="card-body ew-grid-middle-panel <?= $Grid->TableContainerClass ?>" style="<?= $Grid->TableContainerStyle ?>">
<table id="tbl_jdh_employee_credentialsgrid" class="<?= $Grid->TableClass ?>"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Grid->RowType = ROWTYPE_HEADER;

// Render list options
$Grid->renderListOptions();

// Render list options (header, left)
$Grid->ListOptions->render("header", "left");
?>
<?php if ($Grid->id->Visible) { // id ?>
        <th data-name="id" class="<?= $Grid->id->headerCellClass() ?>"><div id="elh_jdh_employee_credentials_id" class="jdh_employee_credentials_id"><?= $Grid->renderFieldHeader($Grid->id) ?></div></th>
<?php } ?>
<?php if ($Grid->cv->Visible) { // cv ?>
        <th data-name="cv" class="<?= $Grid->cv->headerCellClass() ?>"><div id="elh_jdh_employee_credentials_cv" class="jdh_employee_credentials_cv"><?= $Grid->renderFieldHeader($Grid->cv) ?></div></th>
<?php } ?>
<?php if ($Grid->academic_certificates->Visible) { // academic_certificates ?>
        <th data-name="academic_certificates" class="<?= $Grid->academic_certificates->headerCellClass() ?>"><div id="elh_jdh_employee_credentials_academic_certificates" class="jdh_employee_credentials_academic_certificates"><?= $Grid->renderFieldHeader($Grid->academic_certificates) ?></div></th>
<?php } ?>
<?php if ($Grid->professional_certifications->Visible) { // professional_certifications ?>
        <th data-name="professional_certifications" class="<?= $Grid->professional_certifications->headerCellClass() ?>"><div id="elh_jdh_employee_credentials_professional_certifications" class="jdh_employee_credentials_professional_certifications"><?= $Grid->renderFieldHeader($Grid->professional_certifications) ?></div></th>
<?php } ?>
<?php if ($Grid->date_created->Visible) { // date_created ?>
        <th data-name="date_created" class="<?= $Grid->date_created->headerCellClass() ?>"><div id="elh_jdh_employee_credentials_date_created" class="jdh_employee_credentials_date_created"><?= $Grid->renderFieldHeader($Grid->date_created) ?></div></th>
<?php } ?>
<?php if ($Grid->date_updated->Visible) { // date_updated ?>
        <th data-name="date_updated" class="<?= $Grid->date_updated->headerCellClass() ?>"><div id="elh_jdh_employee_credentials_date_updated" class="jdh_employee_credentials_date_updated"><?= $Grid->renderFieldHeader($Grid->date_updated) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Grid->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody data-page="<?= $Grid->getPageNumber() ?>">
<?php
$Grid->setupGrid();
while ($Grid->RecordCount < $Grid->StopRecord) {
    $Grid->RecordCount++;
    if ($Grid->RecordCount >= $Grid->StartRecord) {
        $Grid->setupRow();

        // Skip 1) delete row / empty row for confirm page, 2) hidden row
        if (
            $Grid->RowAction != "delete" &&
            $Grid->RowAction != "insertdelete" &&
            !($Grid->RowAction == "insert" && $Grid->isConfirm() && $Grid->emptyRow()) &&
            $Grid->RowAction != "hide"
        ) {
?>
    <tr <?= $Grid->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Grid->ListOptions->render("body", "left", $Grid->RowCount);
?>
    <?php if ($Grid->id->Visible) { // id ?>
        <td data-name="id"<?= $Grid->id->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_employee_credentials_id" class="el_jdh_employee_credentials_id"></span>
<input type="hidden" data-table="jdh_employee_credentials" data-field="x_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_id" id="o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_employee_credentials_id" class="el_jdh_employee_credentials_id">
<span<?= $Grid->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->id->getDisplayValue($Grid->id->EditValue))) ?>"></span>
<input type="hidden" data-table="jdh_employee_credentials" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->CurrentValue) ?>">
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_employee_credentials_id" class="el_jdh_employee_credentials_id">
<span<?= $Grid->id->viewAttributes() ?>>
<?= $Grid->id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_employee_credentials" data-field="x_id" data-hidden="1" name="fjdh_employee_credentialsgrid$x<?= $Grid->RowIndex ?>_id" id="fjdh_employee_credentialsgrid$x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->FormValue) ?>">
<input type="hidden" data-table="jdh_employee_credentials" data-field="x_id" data-hidden="1" data-old name="fjdh_employee_credentialsgrid$o<?= $Grid->RowIndex ?>_id" id="fjdh_employee_credentialsgrid$o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="jdh_employee_credentials" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Grid->cv->Visible) { // cv ?>
        <td data-name="cv"<?= $Grid->cv->cellAttributes() ?>>
<?php if ($Grid->RowAction == "insert") { // Add record ?>
<?php if (!$Grid->isConfirm()) { ?>
<span id="el<?= $rowIndex ?>_jdh_employee_credentials_cv" class="el_jdh_employee_credentials_cv">
<div id="fd_x<?= $Grid->RowIndex ?>_cv" class="fileinput-button ew-file-drop-zone">
    <input
        type="file"
        id="x<?= $Grid->RowIndex ?>_cv"
        name="x<?= $Grid->RowIndex ?>_cv"
        class="form-control ew-file-input"
        title="<?= $Grid->cv->title() ?>"
        lang="<?= CurrentLanguageID() ?>"
        data-table="jdh_employee_credentials"
        data-field="x_cv"
        data-size="0"
        data-accept-file-types="<?= $Grid->cv->acceptFileTypes() ?>"
        data-max-file-size="<?= $Grid->cv->UploadMaxFileSize ?>"
        data-max-number-of-files="null"
        data-disable-image-crop="<?= $Grid->cv->ImageCropper ? 0 : 1 ?>"
        <?= ($Grid->cv->ReadOnly || $Grid->cv->Disabled) ? " disabled" : "" ?>
        <?= $Grid->cv->editAttributes() ?>
    >
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<div class="invalid-feedback"><?= $Grid->cv->getErrorMessage() ?></div>
<input type="hidden" name="fn_x<?= $Grid->RowIndex ?>_cv" id= "fn_x<?= $Grid->RowIndex ?>_cv" value="<?= $Grid->cv->Upload->FileName ?>">
<input type="hidden" name="fa_x<?= $Grid->RowIndex ?>_cv" id= "fa_x<?= $Grid->RowIndex ?>_cv" value="0">
<table id="ft_x<?= $Grid->RowIndex ?>_cv" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php } else { ?>
<span id="el<?= $rowIndex ?>_jdh_employee_credentials_cv" class="el_jdh_employee_credentials_cv">
<div id="fd_x<?= $Grid->RowIndex ?>_cv">
    <input
        type="file"
        id="x<?= $Grid->RowIndex ?>_cv"
        name="x<?= $Grid->RowIndex ?>_cv"
        class="form-control ew-file-input d-none"
        title="<?= $Grid->cv->title() ?>"
        lang="<?= CurrentLanguageID() ?>"
        data-table="jdh_employee_credentials"
        data-field="x_cv"
        data-size="0"
        data-accept-file-types="<?= $Grid->cv->acceptFileTypes() ?>"
        data-max-file-size="<?= $Grid->cv->UploadMaxFileSize ?>"
        data-max-number-of-files="null"
        data-disable-image-crop="<?= $Grid->cv->ImageCropper ? 0 : 1 ?>"
        <?= $Grid->cv->editAttributes() ?>
    >
</div>
<div class="invalid-feedback"><?= $Grid->cv->getErrorMessage() ?></div>
<input type="hidden" name="fn_x<?= $Grid->RowIndex ?>_cv" id= "fn_x<?= $Grid->RowIndex ?>_cv" value="<?= $Grid->cv->Upload->FileName ?>">
<input type="hidden" name="fa_x<?= $Grid->RowIndex ?>_cv" id= "fa_x<?= $Grid->RowIndex ?>_cv" value="0">
<table id="ft_x<?= $Grid->RowIndex ?>_cv" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php } ?>
<input type="hidden" data-table="jdh_employee_credentials" data-field="x_cv" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_cv" id="o<?= $Grid->RowIndex ?>_cv" value="<?= HtmlEncode($Grid->cv->OldValue) ?>">
<?php } elseif ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_employee_credentials_cv" class="el_jdh_employee_credentials_cv">
<span<?= $Grid->cv->viewAttributes() ?>>
<?= GetFileViewTag($Grid->cv, $Grid->cv->getViewValue(), false) ?>
</span>
</span>
<?php } else  { // Edit record ?>
<?php if (!$Grid->isConfirm()) { ?>
<span id="el<?= $Grid->RowCount ?>_jdh_employee_credentials_cv" class="el_jdh_employee_credentials_cv">
<div id="fd_x<?= $Grid->RowIndex ?>_cv">
    <input
        type="file"
        id="x<?= $Grid->RowIndex ?>_cv"
        name="x<?= $Grid->RowIndex ?>_cv"
        class="form-control ew-file-input d-none"
        title="<?= $Grid->cv->title() ?>"
        lang="<?= CurrentLanguageID() ?>"
        data-table="jdh_employee_credentials"
        data-field="x_cv"
        data-size="0"
        data-accept-file-types="<?= $Grid->cv->acceptFileTypes() ?>"
        data-max-file-size="<?= $Grid->cv->UploadMaxFileSize ?>"
        data-max-number-of-files="null"
        data-disable-image-crop="<?= $Grid->cv->ImageCropper ? 0 : 1 ?>"
        <?= $Grid->cv->editAttributes() ?>
    >
</div>
<div class="invalid-feedback"><?= $Grid->cv->getErrorMessage() ?></div>
<input type="hidden" name="fn_x<?= $Grid->RowIndex ?>_cv" id= "fn_x<?= $Grid->RowIndex ?>_cv" value="<?= $Grid->cv->Upload->FileName ?>">
<input type="hidden" name="fa_x<?= $Grid->RowIndex ?>_cv" id= "fa_x<?= $Grid->RowIndex ?>_cv" value="<?= (Post("fa_x<?= $Grid->RowIndex ?>_cv") == "0") ? "0" : "1" ?>">
<table id="ft_x<?= $Grid->RowIndex ?>_cv" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_jdh_employee_credentials_cv" class="el_jdh_employee_credentials_cv">
<div id="fd_x<?= $Grid->RowIndex ?>_cv">
    <input
        type="file"
        id="x<?= $Grid->RowIndex ?>_cv"
        name="x<?= $Grid->RowIndex ?>_cv"
        class="form-control ew-file-input d-none"
        title="<?= $Grid->cv->title() ?>"
        lang="<?= CurrentLanguageID() ?>"
        data-table="jdh_employee_credentials"
        data-field="x_cv"
        data-size="0"
        data-accept-file-types="<?= $Grid->cv->acceptFileTypes() ?>"
        data-max-file-size="<?= $Grid->cv->UploadMaxFileSize ?>"
        data-max-number-of-files="null"
        data-disable-image-crop="<?= $Grid->cv->ImageCropper ? 0 : 1 ?>"
        <?= $Grid->cv->editAttributes() ?>
    >
</div>
<div class="invalid-feedback"><?= $Grid->cv->getErrorMessage() ?></div>
<input type="hidden" name="fn_x<?= $Grid->RowIndex ?>_cv" id= "fn_x<?= $Grid->RowIndex ?>_cv" value="<?= $Grid->cv->Upload->FileName ?>">
<input type="hidden" name="fa_x<?= $Grid->RowIndex ?>_cv" id= "fa_x<?= $Grid->RowIndex ?>_cv" value="<?= (Post("fa_x<?= $Grid->RowIndex ?>_cv") == "0") ? "0" : "1" ?>">
<table id="ft_x<?= $Grid->RowIndex ?>_cv" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->academic_certificates->Visible) { // academic_certificates ?>
        <td data-name="academic_certificates"<?= $Grid->academic_certificates->cellAttributes() ?>>
<?php if ($Grid->RowAction == "insert") { // Add record ?>
<?php if (!$Grid->isConfirm()) { ?>
<span id="el<?= $rowIndex ?>_jdh_employee_credentials_academic_certificates" class="el_jdh_employee_credentials_academic_certificates">
<div id="fd_x<?= $Grid->RowIndex ?>_academic_certificates" class="fileinput-button ew-file-drop-zone">
    <input
        type="file"
        id="x<?= $Grid->RowIndex ?>_academic_certificates"
        name="x<?= $Grid->RowIndex ?>_academic_certificates"
        class="form-control ew-file-input"
        title="<?= $Grid->academic_certificates->title() ?>"
        lang="<?= CurrentLanguageID() ?>"
        data-table="jdh_employee_credentials"
        data-field="x_academic_certificates"
        data-size="0"
        data-accept-file-types="<?= $Grid->academic_certificates->acceptFileTypes() ?>"
        data-max-file-size="<?= $Grid->academic_certificates->UploadMaxFileSize ?>"
        data-max-number-of-files="null"
        data-disable-image-crop="<?= $Grid->academic_certificates->ImageCropper ? 0 : 1 ?>"
        <?= ($Grid->academic_certificates->ReadOnly || $Grid->academic_certificates->Disabled) ? " disabled" : "" ?>
        <?= $Grid->academic_certificates->editAttributes() ?>
    >
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<div class="invalid-feedback"><?= $Grid->academic_certificates->getErrorMessage() ?></div>
<input type="hidden" name="fn_x<?= $Grid->RowIndex ?>_academic_certificates" id= "fn_x<?= $Grid->RowIndex ?>_academic_certificates" value="<?= $Grid->academic_certificates->Upload->FileName ?>">
<input type="hidden" name="fa_x<?= $Grid->RowIndex ?>_academic_certificates" id= "fa_x<?= $Grid->RowIndex ?>_academic_certificates" value="0">
<table id="ft_x<?= $Grid->RowIndex ?>_academic_certificates" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php } else { ?>
<span id="el<?= $rowIndex ?>_jdh_employee_credentials_academic_certificates" class="el_jdh_employee_credentials_academic_certificates">
<div id="fd_x<?= $Grid->RowIndex ?>_academic_certificates">
    <input
        type="file"
        id="x<?= $Grid->RowIndex ?>_academic_certificates"
        name="x<?= $Grid->RowIndex ?>_academic_certificates"
        class="form-control ew-file-input d-none"
        title="<?= $Grid->academic_certificates->title() ?>"
        lang="<?= CurrentLanguageID() ?>"
        data-table="jdh_employee_credentials"
        data-field="x_academic_certificates"
        data-size="0"
        data-accept-file-types="<?= $Grid->academic_certificates->acceptFileTypes() ?>"
        data-max-file-size="<?= $Grid->academic_certificates->UploadMaxFileSize ?>"
        data-max-number-of-files="null"
        data-disable-image-crop="<?= $Grid->academic_certificates->ImageCropper ? 0 : 1 ?>"
        <?= $Grid->academic_certificates->editAttributes() ?>
    >
</div>
<div class="invalid-feedback"><?= $Grid->academic_certificates->getErrorMessage() ?></div>
<input type="hidden" name="fn_x<?= $Grid->RowIndex ?>_academic_certificates" id= "fn_x<?= $Grid->RowIndex ?>_academic_certificates" value="<?= $Grid->academic_certificates->Upload->FileName ?>">
<input type="hidden" name="fa_x<?= $Grid->RowIndex ?>_academic_certificates" id= "fa_x<?= $Grid->RowIndex ?>_academic_certificates" value="0">
<table id="ft_x<?= $Grid->RowIndex ?>_academic_certificates" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php } ?>
<input type="hidden" data-table="jdh_employee_credentials" data-field="x_academic_certificates" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_academic_certificates" id="o<?= $Grid->RowIndex ?>_academic_certificates" value="<?= HtmlEncode($Grid->academic_certificates->OldValue) ?>">
<?php } elseif ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_employee_credentials_academic_certificates" class="el_jdh_employee_credentials_academic_certificates">
<span<?= $Grid->academic_certificates->viewAttributes() ?>>
<?= GetFileViewTag($Grid->academic_certificates, $Grid->academic_certificates->getViewValue(), false) ?>
</span>
</span>
<?php } else  { // Edit record ?>
<?php if (!$Grid->isConfirm()) { ?>
<span id="el<?= $Grid->RowCount ?>_jdh_employee_credentials_academic_certificates" class="el_jdh_employee_credentials_academic_certificates">
<div id="fd_x<?= $Grid->RowIndex ?>_academic_certificates">
    <input
        type="file"
        id="x<?= $Grid->RowIndex ?>_academic_certificates"
        name="x<?= $Grid->RowIndex ?>_academic_certificates"
        class="form-control ew-file-input d-none"
        title="<?= $Grid->academic_certificates->title() ?>"
        lang="<?= CurrentLanguageID() ?>"
        data-table="jdh_employee_credentials"
        data-field="x_academic_certificates"
        data-size="0"
        data-accept-file-types="<?= $Grid->academic_certificates->acceptFileTypes() ?>"
        data-max-file-size="<?= $Grid->academic_certificates->UploadMaxFileSize ?>"
        data-max-number-of-files="null"
        data-disable-image-crop="<?= $Grid->academic_certificates->ImageCropper ? 0 : 1 ?>"
        <?= $Grid->academic_certificates->editAttributes() ?>
    >
</div>
<div class="invalid-feedback"><?= $Grid->academic_certificates->getErrorMessage() ?></div>
<input type="hidden" name="fn_x<?= $Grid->RowIndex ?>_academic_certificates" id= "fn_x<?= $Grid->RowIndex ?>_academic_certificates" value="<?= $Grid->academic_certificates->Upload->FileName ?>">
<input type="hidden" name="fa_x<?= $Grid->RowIndex ?>_academic_certificates" id= "fa_x<?= $Grid->RowIndex ?>_academic_certificates" value="<?= (Post("fa_x<?= $Grid->RowIndex ?>_academic_certificates") == "0") ? "0" : "1" ?>">
<table id="ft_x<?= $Grid->RowIndex ?>_academic_certificates" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_jdh_employee_credentials_academic_certificates" class="el_jdh_employee_credentials_academic_certificates">
<div id="fd_x<?= $Grid->RowIndex ?>_academic_certificates">
    <input
        type="file"
        id="x<?= $Grid->RowIndex ?>_academic_certificates"
        name="x<?= $Grid->RowIndex ?>_academic_certificates"
        class="form-control ew-file-input d-none"
        title="<?= $Grid->academic_certificates->title() ?>"
        lang="<?= CurrentLanguageID() ?>"
        data-table="jdh_employee_credentials"
        data-field="x_academic_certificates"
        data-size="0"
        data-accept-file-types="<?= $Grid->academic_certificates->acceptFileTypes() ?>"
        data-max-file-size="<?= $Grid->academic_certificates->UploadMaxFileSize ?>"
        data-max-number-of-files="null"
        data-disable-image-crop="<?= $Grid->academic_certificates->ImageCropper ? 0 : 1 ?>"
        <?= $Grid->academic_certificates->editAttributes() ?>
    >
</div>
<div class="invalid-feedback"><?= $Grid->academic_certificates->getErrorMessage() ?></div>
<input type="hidden" name="fn_x<?= $Grid->RowIndex ?>_academic_certificates" id= "fn_x<?= $Grid->RowIndex ?>_academic_certificates" value="<?= $Grid->academic_certificates->Upload->FileName ?>">
<input type="hidden" name="fa_x<?= $Grid->RowIndex ?>_academic_certificates" id= "fa_x<?= $Grid->RowIndex ?>_academic_certificates" value="<?= (Post("fa_x<?= $Grid->RowIndex ?>_academic_certificates") == "0") ? "0" : "1" ?>">
<table id="ft_x<?= $Grid->RowIndex ?>_academic_certificates" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->professional_certifications->Visible) { // professional_certifications ?>
        <td data-name="professional_certifications"<?= $Grid->professional_certifications->cellAttributes() ?>>
<?php if ($Grid->RowAction == "insert") { // Add record ?>
<?php if (!$Grid->isConfirm()) { ?>
<span id="el<?= $rowIndex ?>_jdh_employee_credentials_professional_certifications" class="el_jdh_employee_credentials_professional_certifications">
<div id="fd_x<?= $Grid->RowIndex ?>_professional_certifications" class="fileinput-button ew-file-drop-zone">
    <input
        type="file"
        id="x<?= $Grid->RowIndex ?>_professional_certifications"
        name="x<?= $Grid->RowIndex ?>_professional_certifications"
        class="form-control ew-file-input"
        title="<?= $Grid->professional_certifications->title() ?>"
        lang="<?= CurrentLanguageID() ?>"
        data-table="jdh_employee_credentials"
        data-field="x_professional_certifications"
        data-size="0"
        data-accept-file-types="<?= $Grid->professional_certifications->acceptFileTypes() ?>"
        data-max-file-size="<?= $Grid->professional_certifications->UploadMaxFileSize ?>"
        data-max-number-of-files="null"
        data-disable-image-crop="<?= $Grid->professional_certifications->ImageCropper ? 0 : 1 ?>"
        <?= ($Grid->professional_certifications->ReadOnly || $Grid->professional_certifications->Disabled) ? " disabled" : "" ?>
        <?= $Grid->professional_certifications->editAttributes() ?>
    >
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<div class="invalid-feedback"><?= $Grid->professional_certifications->getErrorMessage() ?></div>
<input type="hidden" name="fn_x<?= $Grid->RowIndex ?>_professional_certifications" id= "fn_x<?= $Grid->RowIndex ?>_professional_certifications" value="<?= $Grid->professional_certifications->Upload->FileName ?>">
<input type="hidden" name="fa_x<?= $Grid->RowIndex ?>_professional_certifications" id= "fa_x<?= $Grid->RowIndex ?>_professional_certifications" value="0">
<table id="ft_x<?= $Grid->RowIndex ?>_professional_certifications" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php } else { ?>
<span id="el<?= $rowIndex ?>_jdh_employee_credentials_professional_certifications" class="el_jdh_employee_credentials_professional_certifications">
<div id="fd_x<?= $Grid->RowIndex ?>_professional_certifications">
    <input
        type="file"
        id="x<?= $Grid->RowIndex ?>_professional_certifications"
        name="x<?= $Grid->RowIndex ?>_professional_certifications"
        class="form-control ew-file-input d-none"
        title="<?= $Grid->professional_certifications->title() ?>"
        lang="<?= CurrentLanguageID() ?>"
        data-table="jdh_employee_credentials"
        data-field="x_professional_certifications"
        data-size="0"
        data-accept-file-types="<?= $Grid->professional_certifications->acceptFileTypes() ?>"
        data-max-file-size="<?= $Grid->professional_certifications->UploadMaxFileSize ?>"
        data-max-number-of-files="null"
        data-disable-image-crop="<?= $Grid->professional_certifications->ImageCropper ? 0 : 1 ?>"
        <?= $Grid->professional_certifications->editAttributes() ?>
    >
</div>
<div class="invalid-feedback"><?= $Grid->professional_certifications->getErrorMessage() ?></div>
<input type="hidden" name="fn_x<?= $Grid->RowIndex ?>_professional_certifications" id= "fn_x<?= $Grid->RowIndex ?>_professional_certifications" value="<?= $Grid->professional_certifications->Upload->FileName ?>">
<input type="hidden" name="fa_x<?= $Grid->RowIndex ?>_professional_certifications" id= "fa_x<?= $Grid->RowIndex ?>_professional_certifications" value="0">
<table id="ft_x<?= $Grid->RowIndex ?>_professional_certifications" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php } ?>
<input type="hidden" data-table="jdh_employee_credentials" data-field="x_professional_certifications" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_professional_certifications" id="o<?= $Grid->RowIndex ?>_professional_certifications" value="<?= HtmlEncode($Grid->professional_certifications->OldValue) ?>">
<?php } elseif ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_employee_credentials_professional_certifications" class="el_jdh_employee_credentials_professional_certifications">
<span<?= $Grid->professional_certifications->viewAttributes() ?>>
<?= GetFileViewTag($Grid->professional_certifications, $Grid->professional_certifications->getViewValue(), false) ?>
</span>
</span>
<?php } else  { // Edit record ?>
<?php if (!$Grid->isConfirm()) { ?>
<span id="el<?= $Grid->RowCount ?>_jdh_employee_credentials_professional_certifications" class="el_jdh_employee_credentials_professional_certifications">
<div id="fd_x<?= $Grid->RowIndex ?>_professional_certifications">
    <input
        type="file"
        id="x<?= $Grid->RowIndex ?>_professional_certifications"
        name="x<?= $Grid->RowIndex ?>_professional_certifications"
        class="form-control ew-file-input d-none"
        title="<?= $Grid->professional_certifications->title() ?>"
        lang="<?= CurrentLanguageID() ?>"
        data-table="jdh_employee_credentials"
        data-field="x_professional_certifications"
        data-size="0"
        data-accept-file-types="<?= $Grid->professional_certifications->acceptFileTypes() ?>"
        data-max-file-size="<?= $Grid->professional_certifications->UploadMaxFileSize ?>"
        data-max-number-of-files="null"
        data-disable-image-crop="<?= $Grid->professional_certifications->ImageCropper ? 0 : 1 ?>"
        <?= $Grid->professional_certifications->editAttributes() ?>
    >
</div>
<div class="invalid-feedback"><?= $Grid->professional_certifications->getErrorMessage() ?></div>
<input type="hidden" name="fn_x<?= $Grid->RowIndex ?>_professional_certifications" id= "fn_x<?= $Grid->RowIndex ?>_professional_certifications" value="<?= $Grid->professional_certifications->Upload->FileName ?>">
<input type="hidden" name="fa_x<?= $Grid->RowIndex ?>_professional_certifications" id= "fa_x<?= $Grid->RowIndex ?>_professional_certifications" value="<?= (Post("fa_x<?= $Grid->RowIndex ?>_professional_certifications") == "0") ? "0" : "1" ?>">
<table id="ft_x<?= $Grid->RowIndex ?>_professional_certifications" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_jdh_employee_credentials_professional_certifications" class="el_jdh_employee_credentials_professional_certifications">
<div id="fd_x<?= $Grid->RowIndex ?>_professional_certifications">
    <input
        type="file"
        id="x<?= $Grid->RowIndex ?>_professional_certifications"
        name="x<?= $Grid->RowIndex ?>_professional_certifications"
        class="form-control ew-file-input d-none"
        title="<?= $Grid->professional_certifications->title() ?>"
        lang="<?= CurrentLanguageID() ?>"
        data-table="jdh_employee_credentials"
        data-field="x_professional_certifications"
        data-size="0"
        data-accept-file-types="<?= $Grid->professional_certifications->acceptFileTypes() ?>"
        data-max-file-size="<?= $Grid->professional_certifications->UploadMaxFileSize ?>"
        data-max-number-of-files="null"
        data-disable-image-crop="<?= $Grid->professional_certifications->ImageCropper ? 0 : 1 ?>"
        <?= $Grid->professional_certifications->editAttributes() ?>
    >
</div>
<div class="invalid-feedback"><?= $Grid->professional_certifications->getErrorMessage() ?></div>
<input type="hidden" name="fn_x<?= $Grid->RowIndex ?>_professional_certifications" id= "fn_x<?= $Grid->RowIndex ?>_professional_certifications" value="<?= $Grid->professional_certifications->Upload->FileName ?>">
<input type="hidden" name="fa_x<?= $Grid->RowIndex ?>_professional_certifications" id= "fa_x<?= $Grid->RowIndex ?>_professional_certifications" value="<?= (Post("fa_x<?= $Grid->RowIndex ?>_professional_certifications") == "0") ? "0" : "1" ?>">
<table id="ft_x<?= $Grid->RowIndex ?>_professional_certifications" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->date_created->Visible) { // date_created ?>
        <td data-name="date_created"<?= $Grid->date_created->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_employee_credentials_date_created" class="el_jdh_employee_credentials_date_created">
<input type="<?= $Grid->date_created->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_created" id="x<?= $Grid->RowIndex ?>_date_created" data-table="jdh_employee_credentials" data-field="x_date_created" value="<?= $Grid->date_created->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_created->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_created->formatPattern()) ?>"<?= $Grid->date_created->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_created->getErrorMessage() ?></div>
<?php if (!$Grid->date_created->ReadOnly && !$Grid->date_created->Disabled && !isset($Grid->date_created->EditAttrs["readonly"]) && !isset($Grid->date_created->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjdh_employee_credentialsgrid", "datetimepicker"], function () {
    let format = "<?= DateFormat(11) ?>",
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
    ew.createDateTimePicker("fjdh_employee_credentialsgrid", "x<?= $Grid->RowIndex ?>_date_created", jQuery.extend(true, {"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="jdh_employee_credentials" data-field="x_date_created" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_date_created" id="o<?= $Grid->RowIndex ?>_date_created" value="<?= HtmlEncode($Grid->date_created->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_employee_credentials_date_created" class="el_jdh_employee_credentials_date_created">
<input type="<?= $Grid->date_created->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_created" id="x<?= $Grid->RowIndex ?>_date_created" data-table="jdh_employee_credentials" data-field="x_date_created" value="<?= $Grid->date_created->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_created->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_created->formatPattern()) ?>"<?= $Grid->date_created->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_created->getErrorMessage() ?></div>
<?php if (!$Grid->date_created->ReadOnly && !$Grid->date_created->Disabled && !isset($Grid->date_created->EditAttrs["readonly"]) && !isset($Grid->date_created->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjdh_employee_credentialsgrid", "datetimepicker"], function () {
    let format = "<?= DateFormat(11) ?>",
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
    ew.createDateTimePicker("fjdh_employee_credentialsgrid", "x<?= $Grid->RowIndex ?>_date_created", jQuery.extend(true, {"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_employee_credentials_date_created" class="el_jdh_employee_credentials_date_created">
<span<?= $Grid->date_created->viewAttributes() ?>>
<?= $Grid->date_created->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_employee_credentials" data-field="x_date_created" data-hidden="1" name="fjdh_employee_credentialsgrid$x<?= $Grid->RowIndex ?>_date_created" id="fjdh_employee_credentialsgrid$x<?= $Grid->RowIndex ?>_date_created" value="<?= HtmlEncode($Grid->date_created->FormValue) ?>">
<input type="hidden" data-table="jdh_employee_credentials" data-field="x_date_created" data-hidden="1" data-old name="fjdh_employee_credentialsgrid$o<?= $Grid->RowIndex ?>_date_created" id="fjdh_employee_credentialsgrid$o<?= $Grid->RowIndex ?>_date_created" value="<?= HtmlEncode($Grid->date_created->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->date_updated->Visible) { // date_updated ?>
        <td data-name="date_updated"<?= $Grid->date_updated->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_employee_credentials_date_updated" class="el_jdh_employee_credentials_date_updated">
<input type="<?= $Grid->date_updated->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_updated" id="x<?= $Grid->RowIndex ?>_date_updated" data-table="jdh_employee_credentials" data-field="x_date_updated" value="<?= $Grid->date_updated->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_updated->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_updated->formatPattern()) ?>"<?= $Grid->date_updated->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_updated->getErrorMessage() ?></div>
<?php if (!$Grid->date_updated->ReadOnly && !$Grid->date_updated->Disabled && !isset($Grid->date_updated->EditAttrs["readonly"]) && !isset($Grid->date_updated->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjdh_employee_credentialsgrid", "datetimepicker"], function () {
    let format = "<?= DateFormat(11) ?>",
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
    ew.createDateTimePicker("fjdh_employee_credentialsgrid", "x<?= $Grid->RowIndex ?>_date_updated", jQuery.extend(true, {"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="jdh_employee_credentials" data-field="x_date_updated" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_date_updated" id="o<?= $Grid->RowIndex ?>_date_updated" value="<?= HtmlEncode($Grid->date_updated->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_employee_credentials_date_updated" class="el_jdh_employee_credentials_date_updated">
<input type="<?= $Grid->date_updated->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_updated" id="x<?= $Grid->RowIndex ?>_date_updated" data-table="jdh_employee_credentials" data-field="x_date_updated" value="<?= $Grid->date_updated->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_updated->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_updated->formatPattern()) ?>"<?= $Grid->date_updated->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_updated->getErrorMessage() ?></div>
<?php if (!$Grid->date_updated->ReadOnly && !$Grid->date_updated->Disabled && !isset($Grid->date_updated->EditAttrs["readonly"]) && !isset($Grid->date_updated->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjdh_employee_credentialsgrid", "datetimepicker"], function () {
    let format = "<?= DateFormat(11) ?>",
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
    ew.createDateTimePicker("fjdh_employee_credentialsgrid", "x<?= $Grid->RowIndex ?>_date_updated", jQuery.extend(true, {"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_employee_credentials_date_updated" class="el_jdh_employee_credentials_date_updated">
<span<?= $Grid->date_updated->viewAttributes() ?>>
<?= $Grid->date_updated->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_employee_credentials" data-field="x_date_updated" data-hidden="1" name="fjdh_employee_credentialsgrid$x<?= $Grid->RowIndex ?>_date_updated" id="fjdh_employee_credentialsgrid$x<?= $Grid->RowIndex ?>_date_updated" value="<?= HtmlEncode($Grid->date_updated->FormValue) ?>">
<input type="hidden" data-table="jdh_employee_credentials" data-field="x_date_updated" data-hidden="1" data-old name="fjdh_employee_credentialsgrid$o<?= $Grid->RowIndex ?>_date_updated" id="fjdh_employee_credentialsgrid$o<?= $Grid->RowIndex ?>_date_updated" value="<?= HtmlEncode($Grid->date_updated->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowCount);
?>
    </tr>
<?php if ($Grid->RowType == ROWTYPE_ADD || $Grid->RowType == ROWTYPE_EDIT) { ?>
<script data-rowindex="<?= $Grid->RowIndex ?>">
loadjs.ready(["fjdh_employee_credentialsgrid","load"], () => fjdh_employee_credentialsgrid.updateLists(<?= $Grid->RowIndex ?><?= $Grid->RowIndex === '$rowindex$' ? ", true" : "" ?>));
</script>
<?php } ?>
<?php
    }
    } // End delete row checking
    if (
        $Grid->Recordset &&
        !$Grid->Recordset->EOF &&
        $Grid->RowIndex !== '$rowindex$' &&
        (!$Grid->isGridAdd() || $Grid->CurrentMode == "copy") &&
        (!(($Grid->isCopy() || $Grid->isAdd()) && $Grid->RowIndex == 0))
    ) {
        $Grid->Recordset->moveNext();
    }
    // Reset for template row
    if ($Grid->RowIndex === '$rowindex$') {
        $Grid->RowIndex = 0;
    }
    // Reset inline add/copy row
    if (($Grid->isCopy() || $Grid->isAdd()) && $Grid->RowIndex == 0) {
        $Grid->RowIndex = 1;
    }
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php if ($Grid->CurrentMode == "add" || $Grid->CurrentMode == "copy") { ?>
<input type="hidden" name="<?= $Grid->FormKeyCountName ?>" id="<?= $Grid->FormKeyCountName ?>" value="<?= $Grid->KeyCount ?>">
<?= $Grid->MultiSelectKey ?>
<?php } ?>
<?php if ($Grid->CurrentMode == "edit") { ?>
<input type="hidden" name="<?= $Grid->FormKeyCountName ?>" id="<?= $Grid->FormKeyCountName ?>" value="<?= $Grid->KeyCount ?>">
<?= $Grid->MultiSelectKey ?>
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if ($Grid->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fjdh_employee_credentialsgrid">
</div><!-- /.ew-list-form -->
<?php
// Close recordset
if ($Grid->Recordset) {
    $Grid->Recordset->close();
}
?>
<?php if ($Grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $Grid->OtherOptions->render("body", "bottom") ?>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } else { ?>
<div class="ew-list-other-options">
<?php $Grid->OtherOptions->render("body") ?>
</div>
<?php } ?>
</div>
</main>
<?php if (!$Grid->isExport()) { ?>
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
<?php } ?>
