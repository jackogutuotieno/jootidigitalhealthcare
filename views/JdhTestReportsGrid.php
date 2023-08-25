<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Set up and run Grid object
$Grid = Container("JdhTestReportsGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fjdh_test_reportsgrid;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { jdh_test_reports: currentTable } });
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_test_reportsgrid")
        .setPageId("grid")
        .setFormKeyCountName("<?= $Grid->FormKeyCountName ?>")

        // Add fields
        .setFields([
            ["request_id", [fields.request_id.visible && fields.request_id.required ? ew.Validators.required(fields.request_id.caption) : null, ew.Validators.integer], fields.request_id.isInvalid],
            ["patient_id", [fields.patient_id.visible && fields.patient_id.required ? ew.Validators.required(fields.patient_id.caption) : null], fields.patient_id.isInvalid],
            ["report_findings", [fields.report_findings.visible && fields.report_findings.required ? ew.Validators.required(fields.report_findings.caption) : null], fields.report_findings.isInvalid],
            ["report_attachment", [fields.report_attachment.visible && fields.report_attachment.required ? ew.Validators.fileRequired(fields.report_attachment.caption) : null], fields.report_attachment.isInvalid],
            ["report_date", [fields.report_date.visible && fields.report_date.required ? ew.Validators.required(fields.report_date.caption) : null, ew.Validators.datetime(fields.report_date.clientFormatPattern)], fields.report_date.isInvalid]
        ])

        // Check empty row
        .setEmptyRow(
            function (rowIndex) {
                let fobj = this.getForm(),
                    fields = [["request_id",false],["patient_id",false],["report_findings",false],["report_attachment",false],["report_date",false]];
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
            "patient_id": <?= $Grid->patient_id->toClientList($Grid) ?>,
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
<div id="fjdh_test_reportsgrid" class="ew-form ew-list-form">
<div id="gmp_jdh_test_reports" class="card-body ew-grid-middle-panel <?= $Grid->TableContainerClass ?>" style="<?= $Grid->TableContainerStyle ?>">
<table id="tbl_jdh_test_reportsgrid" class="<?= $Grid->TableClass ?>"><!-- .ew-table -->
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
<?php if ($Grid->request_id->Visible) { // request_id ?>
        <th data-name="request_id" class="<?= $Grid->request_id->headerCellClass() ?>"><div id="elh_jdh_test_reports_request_id" class="jdh_test_reports_request_id"><?= $Grid->renderFieldHeader($Grid->request_id) ?></div></th>
<?php } ?>
<?php if ($Grid->patient_id->Visible) { // patient_id ?>
        <th data-name="patient_id" class="<?= $Grid->patient_id->headerCellClass() ?>"><div id="elh_jdh_test_reports_patient_id" class="jdh_test_reports_patient_id"><?= $Grid->renderFieldHeader($Grid->patient_id) ?></div></th>
<?php } ?>
<?php if ($Grid->report_findings->Visible) { // report_findings ?>
        <th data-name="report_findings" class="<?= $Grid->report_findings->headerCellClass() ?>"><div id="elh_jdh_test_reports_report_findings" class="jdh_test_reports_report_findings"><?= $Grid->renderFieldHeader($Grid->report_findings) ?></div></th>
<?php } ?>
<?php if ($Grid->report_attachment->Visible) { // report_attachment ?>
        <th data-name="report_attachment" class="<?= $Grid->report_attachment->headerCellClass() ?>"><div id="elh_jdh_test_reports_report_attachment" class="jdh_test_reports_report_attachment"><?= $Grid->renderFieldHeader($Grid->report_attachment) ?></div></th>
<?php } ?>
<?php if ($Grid->report_date->Visible) { // report_date ?>
        <th data-name="report_date" class="<?= $Grid->report_date->headerCellClass() ?>"><div id="elh_jdh_test_reports_report_date" class="jdh_test_reports_report_date"><?= $Grid->renderFieldHeader($Grid->report_date) ?></div></th>
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
    <?php if ($Grid->request_id->Visible) { // request_id ?>
        <td data-name="request_id"<?= $Grid->request_id->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_test_reports_request_id" class="el_jdh_test_reports_request_id">
<input type="<?= $Grid->request_id->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_request_id" id="x<?= $Grid->RowIndex ?>_request_id" data-table="jdh_test_reports" data-field="x_request_id" value="<?= $Grid->request_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->request_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->request_id->formatPattern()) ?>"<?= $Grid->request_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->request_id->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="jdh_test_reports" data-field="x_request_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_request_id" id="o<?= $Grid->RowIndex ?>_request_id" value="<?= HtmlEncode($Grid->request_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_test_reports_request_id" class="el_jdh_test_reports_request_id">
<input type="<?= $Grid->request_id->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_request_id" id="x<?= $Grid->RowIndex ?>_request_id" data-table="jdh_test_reports" data-field="x_request_id" value="<?= $Grid->request_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->request_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->request_id->formatPattern()) ?>"<?= $Grid->request_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->request_id->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_test_reports_request_id" class="el_jdh_test_reports_request_id">
<span<?= $Grid->request_id->viewAttributes() ?>>
<?= $Grid->request_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_test_reports" data-field="x_request_id" data-hidden="1" name="fjdh_test_reportsgrid$x<?= $Grid->RowIndex ?>_request_id" id="fjdh_test_reportsgrid$x<?= $Grid->RowIndex ?>_request_id" value="<?= HtmlEncode($Grid->request_id->FormValue) ?>">
<input type="hidden" data-table="jdh_test_reports" data-field="x_request_id" data-hidden="1" data-old name="fjdh_test_reportsgrid$o<?= $Grid->RowIndex ?>_request_id" id="fjdh_test_reportsgrid$o<?= $Grid->RowIndex ?>_request_id" value="<?= HtmlEncode($Grid->request_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->patient_id->Visible) { // patient_id ?>
        <td data-name="patient_id"<?= $Grid->patient_id->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($Grid->patient_id->getSessionValue() != "") { ?>
<span<?= $Grid->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->patient_id->getDisplayValue($Grid->patient_id->ViewValue) ?></span></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_patient_id" name="x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_jdh_test_reports_patient_id" class="el_jdh_test_reports_patient_id">
    <select
        id="x<?= $Grid->RowIndex ?>_patient_id"
        name="x<?= $Grid->RowIndex ?>_patient_id"
        class="form-select ew-select<?= $Grid->patient_id->isInvalidClass() ?>"
        data-select2-id="fjdh_test_reportsgrid_x<?= $Grid->RowIndex ?>_patient_id"
        data-table="jdh_test_reports"
        data-field="x_patient_id"
        data-value-separator="<?= $Grid->patient_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->patient_id->getPlaceHolder()) ?>"
        <?= $Grid->patient_id->editAttributes() ?>>
        <?= $Grid->patient_id->selectOptionListHtml("x{$Grid->RowIndex}_patient_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->patient_id->getErrorMessage() ?></div>
<?= $Grid->patient_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_patient_id") ?>
<script>
loadjs.ready("fjdh_test_reportsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_patient_id", selectId: "fjdh_test_reportsgrid_x<?= $Grid->RowIndex ?>_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_test_reportsgrid.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fjdh_test_reportsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fjdh_test_reportsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_test_reports.fields.patient_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<input type="hidden" data-table="jdh_test_reports" data-field="x_patient_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_patient_id" id="o<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($Grid->patient_id->getSessionValue() != "") { ?>
<span<?= $Grid->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->patient_id->getDisplayValue($Grid->patient_id->ViewValue) ?></span></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_patient_id" name="x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_jdh_test_reports_patient_id" class="el_jdh_test_reports_patient_id">
    <select
        id="x<?= $Grid->RowIndex ?>_patient_id"
        name="x<?= $Grid->RowIndex ?>_patient_id"
        class="form-select ew-select<?= $Grid->patient_id->isInvalidClass() ?>"
        data-select2-id="fjdh_test_reportsgrid_x<?= $Grid->RowIndex ?>_patient_id"
        data-table="jdh_test_reports"
        data-field="x_patient_id"
        data-value-separator="<?= $Grid->patient_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->patient_id->getPlaceHolder()) ?>"
        <?= $Grid->patient_id->editAttributes() ?>>
        <?= $Grid->patient_id->selectOptionListHtml("x{$Grid->RowIndex}_patient_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->patient_id->getErrorMessage() ?></div>
<?= $Grid->patient_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_patient_id") ?>
<script>
loadjs.ready("fjdh_test_reportsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_patient_id", selectId: "fjdh_test_reportsgrid_x<?= $Grid->RowIndex ?>_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_test_reportsgrid.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fjdh_test_reportsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fjdh_test_reportsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_test_reports.fields.patient_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_test_reports_patient_id" class="el_jdh_test_reports_patient_id">
<span<?= $Grid->patient_id->viewAttributes() ?>>
<?= $Grid->patient_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_test_reports" data-field="x_patient_id" data-hidden="1" name="fjdh_test_reportsgrid$x<?= $Grid->RowIndex ?>_patient_id" id="fjdh_test_reportsgrid$x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->FormValue) ?>">
<input type="hidden" data-table="jdh_test_reports" data-field="x_patient_id" data-hidden="1" data-old name="fjdh_test_reportsgrid$o<?= $Grid->RowIndex ?>_patient_id" id="fjdh_test_reportsgrid$o<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->report_findings->Visible) { // report_findings ?>
        <td data-name="report_findings"<?= $Grid->report_findings->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_test_reports_report_findings" class="el_jdh_test_reports_report_findings">
<textarea data-table="jdh_test_reports" data-field="x_report_findings" name="x<?= $Grid->RowIndex ?>_report_findings" id="x<?= $Grid->RowIndex ?>_report_findings" cols="35" rows="4" placeholder="<?= HtmlEncode($Grid->report_findings->getPlaceHolder()) ?>"<?= $Grid->report_findings->editAttributes() ?>><?= $Grid->report_findings->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Grid->report_findings->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="jdh_test_reports" data-field="x_report_findings" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_report_findings" id="o<?= $Grid->RowIndex ?>_report_findings" value="<?= HtmlEncode($Grid->report_findings->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_test_reports_report_findings" class="el_jdh_test_reports_report_findings">
<textarea data-table="jdh_test_reports" data-field="x_report_findings" name="x<?= $Grid->RowIndex ?>_report_findings" id="x<?= $Grid->RowIndex ?>_report_findings" cols="35" rows="4" placeholder="<?= HtmlEncode($Grid->report_findings->getPlaceHolder()) ?>"<?= $Grid->report_findings->editAttributes() ?>><?= $Grid->report_findings->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Grid->report_findings->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_test_reports_report_findings" class="el_jdh_test_reports_report_findings">
<span<?= $Grid->report_findings->viewAttributes() ?>>
<?= $Grid->report_findings->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_test_reports" data-field="x_report_findings" data-hidden="1" name="fjdh_test_reportsgrid$x<?= $Grid->RowIndex ?>_report_findings" id="fjdh_test_reportsgrid$x<?= $Grid->RowIndex ?>_report_findings" value="<?= HtmlEncode($Grid->report_findings->FormValue) ?>">
<input type="hidden" data-table="jdh_test_reports" data-field="x_report_findings" data-hidden="1" data-old name="fjdh_test_reportsgrid$o<?= $Grid->RowIndex ?>_report_findings" id="fjdh_test_reportsgrid$o<?= $Grid->RowIndex ?>_report_findings" value="<?= HtmlEncode($Grid->report_findings->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->report_attachment->Visible) { // report_attachment ?>
        <td data-name="report_attachment"<?= $Grid->report_attachment->cellAttributes() ?>>
<?php if ($Grid->RowAction == "insert") { // Add record ?>
<?php if (!$Grid->isConfirm()) { ?>
<span id="el<?= $rowIndex ?>_jdh_test_reports_report_attachment" class="el_jdh_test_reports_report_attachment">
<div id="fd_x<?= $Grid->RowIndex ?>_report_attachment" class="fileinput-button ew-file-drop-zone">
    <input
        type="file"
        id="x<?= $Grid->RowIndex ?>_report_attachment"
        name="x<?= $Grid->RowIndex ?>_report_attachment"
        class="form-control ew-file-input"
        title="<?= $Grid->report_attachment->title() ?>"
        lang="<?= CurrentLanguageID() ?>"
        data-table="jdh_test_reports"
        data-field="x_report_attachment"
        data-size="0"
        data-accept-file-types="<?= $Grid->report_attachment->acceptFileTypes() ?>"
        data-max-file-size="<?= $Grid->report_attachment->UploadMaxFileSize ?>"
        data-max-number-of-files="null"
        data-disable-image-crop="<?= $Grid->report_attachment->ImageCropper ? 0 : 1 ?>"
        <?= ($Grid->report_attachment->ReadOnly || $Grid->report_attachment->Disabled) ? " disabled" : "" ?>
        <?= $Grid->report_attachment->editAttributes() ?>
    >
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<div class="invalid-feedback"><?= $Grid->report_attachment->getErrorMessage() ?></div>
<input type="hidden" name="fn_x<?= $Grid->RowIndex ?>_report_attachment" id= "fn_x<?= $Grid->RowIndex ?>_report_attachment" value="<?= $Grid->report_attachment->Upload->FileName ?>">
<input type="hidden" name="fa_x<?= $Grid->RowIndex ?>_report_attachment" id= "fa_x<?= $Grid->RowIndex ?>_report_attachment" value="0">
<table id="ft_x<?= $Grid->RowIndex ?>_report_attachment" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php } else { ?>
<span id="el<?= $rowIndex ?>_jdh_test_reports_report_attachment" class="el_jdh_test_reports_report_attachment">
<div id="fd_x<?= $Grid->RowIndex ?>_report_attachment">
    <input
        type="file"
        id="x<?= $Grid->RowIndex ?>_report_attachment"
        name="x<?= $Grid->RowIndex ?>_report_attachment"
        class="form-control ew-file-input d-none"
        title="<?= $Grid->report_attachment->title() ?>"
        lang="<?= CurrentLanguageID() ?>"
        data-table="jdh_test_reports"
        data-field="x_report_attachment"
        data-size="0"
        data-accept-file-types="<?= $Grid->report_attachment->acceptFileTypes() ?>"
        data-max-file-size="<?= $Grid->report_attachment->UploadMaxFileSize ?>"
        data-max-number-of-files="null"
        data-disable-image-crop="<?= $Grid->report_attachment->ImageCropper ? 0 : 1 ?>"
        <?= $Grid->report_attachment->editAttributes() ?>
    >
</div>
<div class="invalid-feedback"><?= $Grid->report_attachment->getErrorMessage() ?></div>
<input type="hidden" name="fn_x<?= $Grid->RowIndex ?>_report_attachment" id= "fn_x<?= $Grid->RowIndex ?>_report_attachment" value="<?= $Grid->report_attachment->Upload->FileName ?>">
<input type="hidden" name="fa_x<?= $Grid->RowIndex ?>_report_attachment" id= "fa_x<?= $Grid->RowIndex ?>_report_attachment" value="0">
<table id="ft_x<?= $Grid->RowIndex ?>_report_attachment" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php } ?>
<input type="hidden" data-table="jdh_test_reports" data-field="x_report_attachment" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_report_attachment" id="o<?= $Grid->RowIndex ?>_report_attachment" value="<?= HtmlEncode($Grid->report_attachment->OldValue) ?>">
<?php } elseif ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_test_reports_report_attachment" class="el_jdh_test_reports_report_attachment">
<span<?= $Grid->report_attachment->viewAttributes() ?>>
<?= GetFileViewTag($Grid->report_attachment, $Grid->report_attachment->getViewValue(), false) ?>
</span>
</span>
<?php } else  { // Edit record ?>
<?php if (!$Grid->isConfirm()) { ?>
<span id="el<?= $Grid->RowCount ?>_jdh_test_reports_report_attachment" class="el_jdh_test_reports_report_attachment">
<div id="fd_x<?= $Grid->RowIndex ?>_report_attachment">
    <input
        type="file"
        id="x<?= $Grid->RowIndex ?>_report_attachment"
        name="x<?= $Grid->RowIndex ?>_report_attachment"
        class="form-control ew-file-input d-none"
        title="<?= $Grid->report_attachment->title() ?>"
        lang="<?= CurrentLanguageID() ?>"
        data-table="jdh_test_reports"
        data-field="x_report_attachment"
        data-size="0"
        data-accept-file-types="<?= $Grid->report_attachment->acceptFileTypes() ?>"
        data-max-file-size="<?= $Grid->report_attachment->UploadMaxFileSize ?>"
        data-max-number-of-files="null"
        data-disable-image-crop="<?= $Grid->report_attachment->ImageCropper ? 0 : 1 ?>"
        <?= $Grid->report_attachment->editAttributes() ?>
    >
</div>
<div class="invalid-feedback"><?= $Grid->report_attachment->getErrorMessage() ?></div>
<input type="hidden" name="fn_x<?= $Grid->RowIndex ?>_report_attachment" id= "fn_x<?= $Grid->RowIndex ?>_report_attachment" value="<?= $Grid->report_attachment->Upload->FileName ?>">
<input type="hidden" name="fa_x<?= $Grid->RowIndex ?>_report_attachment" id= "fa_x<?= $Grid->RowIndex ?>_report_attachment" value="<?= (Post("fa_x<?= $Grid->RowIndex ?>_report_attachment") == "0") ? "0" : "1" ?>">
<table id="ft_x<?= $Grid->RowIndex ?>_report_attachment" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_jdh_test_reports_report_attachment" class="el_jdh_test_reports_report_attachment">
<div id="fd_x<?= $Grid->RowIndex ?>_report_attachment">
    <input
        type="file"
        id="x<?= $Grid->RowIndex ?>_report_attachment"
        name="x<?= $Grid->RowIndex ?>_report_attachment"
        class="form-control ew-file-input d-none"
        title="<?= $Grid->report_attachment->title() ?>"
        lang="<?= CurrentLanguageID() ?>"
        data-table="jdh_test_reports"
        data-field="x_report_attachment"
        data-size="0"
        data-accept-file-types="<?= $Grid->report_attachment->acceptFileTypes() ?>"
        data-max-file-size="<?= $Grid->report_attachment->UploadMaxFileSize ?>"
        data-max-number-of-files="null"
        data-disable-image-crop="<?= $Grid->report_attachment->ImageCropper ? 0 : 1 ?>"
        <?= $Grid->report_attachment->editAttributes() ?>
    >
</div>
<div class="invalid-feedback"><?= $Grid->report_attachment->getErrorMessage() ?></div>
<input type="hidden" name="fn_x<?= $Grid->RowIndex ?>_report_attachment" id= "fn_x<?= $Grid->RowIndex ?>_report_attachment" value="<?= $Grid->report_attachment->Upload->FileName ?>">
<input type="hidden" name="fa_x<?= $Grid->RowIndex ?>_report_attachment" id= "fa_x<?= $Grid->RowIndex ?>_report_attachment" value="<?= (Post("fa_x<?= $Grid->RowIndex ?>_report_attachment") == "0") ? "0" : "1" ?>">
<table id="ft_x<?= $Grid->RowIndex ?>_report_attachment" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->report_date->Visible) { // report_date ?>
        <td data-name="report_date"<?= $Grid->report_date->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_test_reports_report_date" class="el_jdh_test_reports_report_date">
<input type="<?= $Grid->report_date->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_report_date" id="x<?= $Grid->RowIndex ?>_report_date" data-table="jdh_test_reports" data-field="x_report_date" value="<?= $Grid->report_date->EditValue ?>" placeholder="<?= HtmlEncode($Grid->report_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->report_date->formatPattern()) ?>"<?= $Grid->report_date->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->report_date->getErrorMessage() ?></div>
<?php if (!$Grid->report_date->ReadOnly && !$Grid->report_date->Disabled && !isset($Grid->report_date->EditAttrs["readonly"]) && !isset($Grid->report_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjdh_test_reportsgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fjdh_test_reportsgrid", "x<?= $Grid->RowIndex ?>_report_date", jQuery.extend(true, {"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="jdh_test_reports" data-field="x_report_date" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_report_date" id="o<?= $Grid->RowIndex ?>_report_date" value="<?= HtmlEncode($Grid->report_date->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_test_reports_report_date" class="el_jdh_test_reports_report_date">
<input type="<?= $Grid->report_date->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_report_date" id="x<?= $Grid->RowIndex ?>_report_date" data-table="jdh_test_reports" data-field="x_report_date" value="<?= $Grid->report_date->EditValue ?>" placeholder="<?= HtmlEncode($Grid->report_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->report_date->formatPattern()) ?>"<?= $Grid->report_date->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->report_date->getErrorMessage() ?></div>
<?php if (!$Grid->report_date->ReadOnly && !$Grid->report_date->Disabled && !isset($Grid->report_date->EditAttrs["readonly"]) && !isset($Grid->report_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjdh_test_reportsgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fjdh_test_reportsgrid", "x<?= $Grid->RowIndex ?>_report_date", jQuery.extend(true, {"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_test_reports_report_date" class="el_jdh_test_reports_report_date">
<span<?= $Grid->report_date->viewAttributes() ?>>
<?= $Grid->report_date->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_test_reports" data-field="x_report_date" data-hidden="1" name="fjdh_test_reportsgrid$x<?= $Grid->RowIndex ?>_report_date" id="fjdh_test_reportsgrid$x<?= $Grid->RowIndex ?>_report_date" value="<?= HtmlEncode($Grid->report_date->FormValue) ?>">
<input type="hidden" data-table="jdh_test_reports" data-field="x_report_date" data-hidden="1" data-old name="fjdh_test_reportsgrid$o<?= $Grid->RowIndex ?>_report_date" id="fjdh_test_reportsgrid$o<?= $Grid->RowIndex ?>_report_date" value="<?= HtmlEncode($Grid->report_date->OldValue) ?>">
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
loadjs.ready(["fjdh_test_reportsgrid","load"], () => fjdh_test_reportsgrid.updateLists(<?= $Grid->RowIndex ?><?= $Grid->RowIndex === '$rowindex$' ? ", true" : "" ?>));
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
<input type="hidden" name="detailpage" value="fjdh_test_reportsgrid">
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
    ew.addEventHandlers("jdh_test_reports");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
