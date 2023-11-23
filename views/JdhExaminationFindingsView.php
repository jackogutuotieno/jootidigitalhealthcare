<?php

namespace PHPMaker2024\jootidigitalhealthcare;

// Page object
$JdhExaminationFindingsView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="view">
<form name="fjdh_examination_findingsview" id="fjdh_examination_findingsview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_examination_findings: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fjdh_examination_findingsview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_examination_findingsview")
        .setPageId("view")
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
<?php } ?>
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jdh_examination_findings">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_examination_findings_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_jdh_examination_findings_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
    <tr id="r_patient_id"<?= $Page->patient_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_examination_findings_patient_id"><?= $Page->patient_id->caption() ?></span></td>
        <td data-name="patient_id"<?= $Page->patient_id->cellAttributes() ?>>
<span id="el_jdh_examination_findings_patient_id">
<span<?= $Page->patient_id->viewAttributes() ?>>
<?= $Page->patient_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->general_exams->Visible) { // general_exams ?>
    <tr id="r_general_exams"<?= $Page->general_exams->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_examination_findings_general_exams"><?= $Page->general_exams->caption() ?></span></td>
        <td data-name="general_exams"<?= $Page->general_exams->cellAttributes() ?>>
<span id="el_jdh_examination_findings_general_exams">
<span<?= $Page->general_exams->viewAttributes() ?>>
<?= $Page->general_exams->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->systematic_exams->Visible) { // systematic_exams ?>
    <tr id="r_systematic_exams"<?= $Page->systematic_exams->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_examination_findings_systematic_exams"><?= $Page->systematic_exams->caption() ?></span></td>
        <td data-name="systematic_exams"<?= $Page->systematic_exams->cellAttributes() ?>>
<span id="el_jdh_examination_findings_systematic_exams">
<span<?= $Page->systematic_exams->viewAttributes() ?>>
<?= $Page->systematic_exams->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date_submitted->Visible) { // date_submitted ?>
    <tr id="r_date_submitted"<?= $Page->date_submitted->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_examination_findings_date_submitted"><?= $Page->date_submitted->caption() ?></span></td>
        <td data-name="date_submitted"<?= $Page->date_submitted->cellAttributes() ?>>
<span id="el_jdh_examination_findings_date_submitted">
<span<?= $Page->date_submitted->viewAttributes() ?>>
<?= $Page->date_submitted->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
</form>
</main>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
