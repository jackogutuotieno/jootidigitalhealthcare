<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Set up and run Grid object
$Grid = Container("JdhExaminationFindingsGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fjdh_examination_findingsgrid;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { jdh_examination_findings: currentTable } });
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_examination_findingsgrid")
        .setPageId("grid")
        .setFormKeyCountName("<?= $Grid->FormKeyCountName ?>")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["patient_id", [fields.patient_id.visible && fields.patient_id.required ? ew.Validators.required(fields.patient_id.caption) : null, ew.Validators.integer], fields.patient_id.isInvalid],
            ["general_exams", [fields.general_exams.visible && fields.general_exams.required ? ew.Validators.required(fields.general_exams.caption) : null], fields.general_exams.isInvalid],
            ["systematic_exams", [fields.systematic_exams.visible && fields.systematic_exams.required ? ew.Validators.required(fields.systematic_exams.caption) : null], fields.systematic_exams.isInvalid]
        ])

        // Check empty row
        .setEmptyRow(
            function (rowIndex) {
                let fobj = this.getForm(),
                    fields = [["patient_id",false],["general_exams",false],["systematic_exams",false]];
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
<div id="fjdh_examination_findingsgrid" class="ew-form ew-list-form">
<div id="gmp_jdh_examination_findings" class="card-body ew-grid-middle-panel <?= $Grid->TableContainerClass ?>" style="<?= $Grid->TableContainerStyle ?>">
<table id="tbl_jdh_examination_findingsgrid" class="<?= $Grid->TableClass ?>"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Grid->id->headerCellClass() ?>"><div id="elh_jdh_examination_findings_id" class="jdh_examination_findings_id"><?= $Grid->renderFieldHeader($Grid->id) ?></div></th>
<?php } ?>
<?php if ($Grid->patient_id->Visible) { // patient_id ?>
        <th data-name="patient_id" class="<?= $Grid->patient_id->headerCellClass() ?>"><div id="elh_jdh_examination_findings_patient_id" class="jdh_examination_findings_patient_id"><?= $Grid->renderFieldHeader($Grid->patient_id) ?></div></th>
<?php } ?>
<?php if ($Grid->general_exams->Visible) { // general_exams ?>
        <th data-name="general_exams" class="<?= $Grid->general_exams->headerCellClass() ?>"><div id="elh_jdh_examination_findings_general_exams" class="jdh_examination_findings_general_exams"><?= $Grid->renderFieldHeader($Grid->general_exams) ?></div></th>
<?php } ?>
<?php if ($Grid->systematic_exams->Visible) { // systematic_exams ?>
        <th data-name="systematic_exams" class="<?= $Grid->systematic_exams->headerCellClass() ?>"><div id="elh_jdh_examination_findings_systematic_exams" class="jdh_examination_findings_systematic_exams"><?= $Grid->renderFieldHeader($Grid->systematic_exams) ?></div></th>
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
<span id="el<?= $Grid->RowCount ?>_jdh_examination_findings_id" class="el_jdh_examination_findings_id"></span>
<input type="hidden" data-table="jdh_examination_findings" data-field="x_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_id" id="o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_examination_findings_id" class="el_jdh_examination_findings_id">
<span<?= $Grid->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->id->getDisplayValue($Grid->id->EditValue))) ?>"></span>
<input type="hidden" data-table="jdh_examination_findings" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->CurrentValue) ?>">
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_examination_findings_id" class="el_jdh_examination_findings_id">
<span<?= $Grid->id->viewAttributes() ?>>
<?= $Grid->id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_examination_findings" data-field="x_id" data-hidden="1" name="fjdh_examination_findingsgrid$x<?= $Grid->RowIndex ?>_id" id="fjdh_examination_findingsgrid$x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->FormValue) ?>">
<input type="hidden" data-table="jdh_examination_findings" data-field="x_id" data-hidden="1" data-old name="fjdh_examination_findingsgrid$o<?= $Grid->RowIndex ?>_id" id="fjdh_examination_findingsgrid$o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="jdh_examination_findings" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Grid->patient_id->Visible) { // patient_id ?>
        <td data-name="patient_id"<?= $Grid->patient_id->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($Grid->patient_id->getSessionValue() != "") { ?>
<span<?= $Grid->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->patient_id->getDisplayValue($Grid->patient_id->ViewValue) ?></span></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_patient_id" name="x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_jdh_examination_findings_patient_id" class="el_jdh_examination_findings_patient_id">
<?php
if (IsRTL()) {
    $Grid->patient_id->EditAttrs["dir"] = "rtl";
}
?>
<span id="as_x<?= $Grid->RowIndex ?>_patient_id" class="ew-auto-suggest">
    <input type="<?= $Grid->patient_id->getInputTextType() ?>" class="form-control" name="sv_x<?= $Grid->RowIndex ?>_patient_id" id="sv_x<?= $Grid->RowIndex ?>_patient_id" value="<?= RemoveHtml($Grid->patient_id->EditValue) ?>" autocomplete="off" size="30" placeholder="<?= HtmlEncode($Grid->patient_id->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Grid->patient_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->patient_id->formatPattern()) ?>"<?= $Grid->patient_id->editAttributes() ?>>
</span>
<selection-list hidden class="form-control" data-table="jdh_examination_findings" data-field="x_patient_id" data-input="sv_x<?= $Grid->RowIndex ?>_patient_id" data-value-separator="<?= $Grid->patient_id->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_patient_id" id="x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->CurrentValue) ?>"></selection-list>
<div class="invalid-feedback"><?= $Grid->patient_id->getErrorMessage() ?></div>
<script>
loadjs.ready("fjdh_examination_findingsgrid", function() {
    fjdh_examination_findingsgrid.createAutoSuggest(Object.assign({"id":"x<?= $Grid->RowIndex ?>_patient_id","forceSelect":false}, { lookupAllDisplayFields: <?= $Grid->patient_id->Lookup->LookupAllDisplayFields ? "true" : "false" ?> }, ew.vars.tables.jdh_examination_findings.fields.patient_id.autoSuggestOptions));
});
</script>
<?= $Grid->patient_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_patient_id") ?>
</span>
<?php } ?>
<input type="hidden" data-table="jdh_examination_findings" data-field="x_patient_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_patient_id" id="o<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($Grid->patient_id->getSessionValue() != "") { ?>
<span<?= $Grid->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->patient_id->getDisplayValue($Grid->patient_id->ViewValue) ?></span></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_patient_id" name="x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_jdh_examination_findings_patient_id" class="el_jdh_examination_findings_patient_id">
<?php
if (IsRTL()) {
    $Grid->patient_id->EditAttrs["dir"] = "rtl";
}
?>
<span id="as_x<?= $Grid->RowIndex ?>_patient_id" class="ew-auto-suggest">
    <input type="<?= $Grid->patient_id->getInputTextType() ?>" class="form-control" name="sv_x<?= $Grid->RowIndex ?>_patient_id" id="sv_x<?= $Grid->RowIndex ?>_patient_id" value="<?= RemoveHtml($Grid->patient_id->EditValue) ?>" autocomplete="off" size="30" placeholder="<?= HtmlEncode($Grid->patient_id->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Grid->patient_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->patient_id->formatPattern()) ?>"<?= $Grid->patient_id->editAttributes() ?>>
</span>
<selection-list hidden class="form-control" data-table="jdh_examination_findings" data-field="x_patient_id" data-input="sv_x<?= $Grid->RowIndex ?>_patient_id" data-value-separator="<?= $Grid->patient_id->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_patient_id" id="x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->CurrentValue) ?>"></selection-list>
<div class="invalid-feedback"><?= $Grid->patient_id->getErrorMessage() ?></div>
<script>
loadjs.ready("fjdh_examination_findingsgrid", function() {
    fjdh_examination_findingsgrid.createAutoSuggest(Object.assign({"id":"x<?= $Grid->RowIndex ?>_patient_id","forceSelect":false}, { lookupAllDisplayFields: <?= $Grid->patient_id->Lookup->LookupAllDisplayFields ? "true" : "false" ?> }, ew.vars.tables.jdh_examination_findings.fields.patient_id.autoSuggestOptions));
});
</script>
<?= $Grid->patient_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_patient_id") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_examination_findings_patient_id" class="el_jdh_examination_findings_patient_id">
<span<?= $Grid->patient_id->viewAttributes() ?>>
<?= $Grid->patient_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_examination_findings" data-field="x_patient_id" data-hidden="1" name="fjdh_examination_findingsgrid$x<?= $Grid->RowIndex ?>_patient_id" id="fjdh_examination_findingsgrid$x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->FormValue) ?>">
<input type="hidden" data-table="jdh_examination_findings" data-field="x_patient_id" data-hidden="1" data-old name="fjdh_examination_findingsgrid$o<?= $Grid->RowIndex ?>_patient_id" id="fjdh_examination_findingsgrid$o<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->general_exams->Visible) { // general_exams ?>
        <td data-name="general_exams"<?= $Grid->general_exams->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_examination_findings_general_exams" class="el_jdh_examination_findings_general_exams">
<input type="<?= $Grid->general_exams->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_general_exams" id="x<?= $Grid->RowIndex ?>_general_exams" data-table="jdh_examination_findings" data-field="x_general_exams" value="<?= $Grid->general_exams->EditValue ?>" maxlength="200" placeholder="<?= HtmlEncode($Grid->general_exams->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->general_exams->formatPattern()) ?>"<?= $Grid->general_exams->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->general_exams->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="jdh_examination_findings" data-field="x_general_exams" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_general_exams" id="o<?= $Grid->RowIndex ?>_general_exams" value="<?= HtmlEncode($Grid->general_exams->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_examination_findings_general_exams" class="el_jdh_examination_findings_general_exams">
<input type="<?= $Grid->general_exams->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_general_exams" id="x<?= $Grid->RowIndex ?>_general_exams" data-table="jdh_examination_findings" data-field="x_general_exams" value="<?= $Grid->general_exams->EditValue ?>" maxlength="200" placeholder="<?= HtmlEncode($Grid->general_exams->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->general_exams->formatPattern()) ?>"<?= $Grid->general_exams->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->general_exams->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_examination_findings_general_exams" class="el_jdh_examination_findings_general_exams">
<span<?= $Grid->general_exams->viewAttributes() ?>>
<?= $Grid->general_exams->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_examination_findings" data-field="x_general_exams" data-hidden="1" name="fjdh_examination_findingsgrid$x<?= $Grid->RowIndex ?>_general_exams" id="fjdh_examination_findingsgrid$x<?= $Grid->RowIndex ?>_general_exams" value="<?= HtmlEncode($Grid->general_exams->FormValue) ?>">
<input type="hidden" data-table="jdh_examination_findings" data-field="x_general_exams" data-hidden="1" data-old name="fjdh_examination_findingsgrid$o<?= $Grid->RowIndex ?>_general_exams" id="fjdh_examination_findingsgrid$o<?= $Grid->RowIndex ?>_general_exams" value="<?= HtmlEncode($Grid->general_exams->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->systematic_exams->Visible) { // systematic_exams ?>
        <td data-name="systematic_exams"<?= $Grid->systematic_exams->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_examination_findings_systematic_exams" class="el_jdh_examination_findings_systematic_exams">
<input type="<?= $Grid->systematic_exams->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_systematic_exams" id="x<?= $Grid->RowIndex ?>_systematic_exams" data-table="jdh_examination_findings" data-field="x_systematic_exams" value="<?= $Grid->systematic_exams->EditValue ?>" maxlength="200" placeholder="<?= HtmlEncode($Grid->systematic_exams->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->systematic_exams->formatPattern()) ?>"<?= $Grid->systematic_exams->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->systematic_exams->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="jdh_examination_findings" data-field="x_systematic_exams" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_systematic_exams" id="o<?= $Grid->RowIndex ?>_systematic_exams" value="<?= HtmlEncode($Grid->systematic_exams->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_examination_findings_systematic_exams" class="el_jdh_examination_findings_systematic_exams">
<input type="<?= $Grid->systematic_exams->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_systematic_exams" id="x<?= $Grid->RowIndex ?>_systematic_exams" data-table="jdh_examination_findings" data-field="x_systematic_exams" value="<?= $Grid->systematic_exams->EditValue ?>" maxlength="200" placeholder="<?= HtmlEncode($Grid->systematic_exams->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->systematic_exams->formatPattern()) ?>"<?= $Grid->systematic_exams->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->systematic_exams->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_jdh_examination_findings_systematic_exams" class="el_jdh_examination_findings_systematic_exams">
<span<?= $Grid->systematic_exams->viewAttributes() ?>>
<?= $Grid->systematic_exams->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="jdh_examination_findings" data-field="x_systematic_exams" data-hidden="1" name="fjdh_examination_findingsgrid$x<?= $Grid->RowIndex ?>_systematic_exams" id="fjdh_examination_findingsgrid$x<?= $Grid->RowIndex ?>_systematic_exams" value="<?= HtmlEncode($Grid->systematic_exams->FormValue) ?>">
<input type="hidden" data-table="jdh_examination_findings" data-field="x_systematic_exams" data-hidden="1" data-old name="fjdh_examination_findingsgrid$o<?= $Grid->RowIndex ?>_systematic_exams" id="fjdh_examination_findingsgrid$o<?= $Grid->RowIndex ?>_systematic_exams" value="<?= HtmlEncode($Grid->systematic_exams->OldValue) ?>">
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
loadjs.ready(["fjdh_examination_findingsgrid","load"], () => fjdh_examination_findingsgrid.updateLists(<?= $Grid->RowIndex ?><?= $Grid->RowIndex === '$rowindex$' ? ", true" : "" ?>));
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
<input type="hidden" name="detailpage" value="fjdh_examination_findingsgrid">
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
    ew.addEventHandlers("jdh_examination_findings");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
