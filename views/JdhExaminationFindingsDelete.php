<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$JdhExaminationFindingsDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_examination_findings: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fjdh_examination_findingsdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_examination_findingsdelete")
        .setPageId("delete")
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
<form name="fjdh_examination_findingsdelete" id="fjdh_examination_findingsdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jdh_examination_findings">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid <?= $Page->TableGridClass ?>">
<div class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>" style="<?= $Page->TableContainerStyle ?>">
<table class="<?= $Page->TableClass ?>">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->id->Visible) { // id ?>
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_jdh_examination_findings_id" class="jdh_examination_findings_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
        <th class="<?= $Page->patient_id->headerCellClass() ?>"><span id="elh_jdh_examination_findings_patient_id" class="jdh_examination_findings_patient_id"><?= $Page->patient_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->general_exams->Visible) { // general_exams ?>
        <th class="<?= $Page->general_exams->headerCellClass() ?>"><span id="elh_jdh_examination_findings_general_exams" class="jdh_examination_findings_general_exams"><?= $Page->general_exams->caption() ?></span></th>
<?php } ?>
<?php if ($Page->systematic_exams->Visible) { // systematic_exams ?>
        <th class="<?= $Page->systematic_exams->headerCellClass() ?>"><span id="elh_jdh_examination_findings_systematic_exams" class="jdh_examination_findings_systematic_exams"><?= $Page->systematic_exams->caption() ?></span></th>
<?php } ?>
    </tr>
    </thead>
    <tbody>
<?php
$Page->RecordCount = 0;
$i = 0;
while (!$Page->Recordset->EOF) {
    $Page->RecordCount++;
    $Page->RowCount++;

    // Set row properties
    $Page->resetAttributes();
    $Page->RowType = ROWTYPE_VIEW; // View

    // Get the field contents
    $Page->loadRowValues($Page->Recordset);

    // Render row
    $Page->renderRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php if ($Page->id->Visible) { // id ?>
        <td<?= $Page->id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_examination_findings_id" class="el_jdh_examination_findings_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
        <td<?= $Page->patient_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_examination_findings_patient_id" class="el_jdh_examination_findings_patient_id">
<span<?= $Page->patient_id->viewAttributes() ?>>
<?= $Page->patient_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->general_exams->Visible) { // general_exams ?>
        <td<?= $Page->general_exams->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_examination_findings_general_exams" class="el_jdh_examination_findings_general_exams">
<span<?= $Page->general_exams->viewAttributes() ?>>
<?= $Page->general_exams->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->systematic_exams->Visible) { // systematic_exams ?>
        <td<?= $Page->systematic_exams->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_examination_findings_systematic_exams" class="el_jdh_examination_findings_systematic_exams">
<span<?= $Page->systematic_exams->viewAttributes() ?>>
<?= $Page->systematic_exams->getViewValue() ?></span>
</span>
</td>
<?php } ?>
    </tr>
<?php
    $Page->Recordset->moveNext();
}
$Page->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div class="ew-buttons ew-desktop-buttons">
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
