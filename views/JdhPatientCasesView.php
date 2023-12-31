<?php

namespace PHPMaker2024\jootidigitalhealthcare;

// Page object
$JdhPatientCasesView = &$Page;
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
<form name="fjdh_patient_casesview" id="fjdh_patient_casesview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_patient_cases: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fjdh_patient_casesview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_patient_casesview")
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
<input type="hidden" name="t" value="jdh_patient_cases">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->case_id->Visible) { // case_id ?>
    <tr id="r_case_id"<?= $Page->case_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_patient_cases_case_id"><?= $Page->case_id->caption() ?></span></td>
        <td data-name="case_id"<?= $Page->case_id->cellAttributes() ?>>
<span id="el_jdh_patient_cases_case_id">
<span<?= $Page->case_id->viewAttributes() ?>>
<?= $Page->case_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
    <tr id="r_patient_id"<?= $Page->patient_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_patient_cases_patient_id"><?= $Page->patient_id->caption() ?></span></td>
        <td data-name="patient_id"<?= $Page->patient_id->cellAttributes() ?>>
<span id="el_jdh_patient_cases_patient_id">
<span<?= $Page->patient_id->viewAttributes() ?>>
<?= $Page->patient_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->history->Visible) { // history ?>
    <tr id="r_history"<?= $Page->history->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_patient_cases_history"><?= $Page->history->caption() ?></span></td>
        <td data-name="history"<?= $Page->history->cellAttributes() ?>>
<span id="el_jdh_patient_cases_history">
<span<?= $Page->history->viewAttributes() ?>>
<?= $Page->history->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->random_blood_sugar->Visible) { // random_blood_sugar ?>
    <tr id="r_random_blood_sugar"<?= $Page->random_blood_sugar->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_patient_cases_random_blood_sugar"><?= $Page->random_blood_sugar->caption() ?></span></td>
        <td data-name="random_blood_sugar"<?= $Page->random_blood_sugar->cellAttributes() ?>>
<span id="el_jdh_patient_cases_random_blood_sugar">
<span<?= $Page->random_blood_sugar->viewAttributes() ?>>
<?= $Page->random_blood_sugar->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->medical_history->Visible) { // medical_history ?>
    <tr id="r_medical_history"<?= $Page->medical_history->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_patient_cases_medical_history"><?= $Page->medical_history->caption() ?></span></td>
        <td data-name="medical_history"<?= $Page->medical_history->cellAttributes() ?>>
<span id="el_jdh_patient_cases_medical_history">
<span<?= $Page->medical_history->viewAttributes() ?>>
<?= $Page->medical_history->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->family->Visible) { // family ?>
    <tr id="r_family"<?= $Page->family->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_patient_cases_family"><?= $Page->family->caption() ?></span></td>
        <td data-name="family"<?= $Page->family->cellAttributes() ?>>
<span id="el_jdh_patient_cases_family">
<span<?= $Page->family->viewAttributes() ?>>
<?= $Page->family->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->socio_economic_history->Visible) { // socio_economic_history ?>
    <tr id="r_socio_economic_history"<?= $Page->socio_economic_history->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_patient_cases_socio_economic_history"><?= $Page->socio_economic_history->caption() ?></span></td>
        <td data-name="socio_economic_history"<?= $Page->socio_economic_history->cellAttributes() ?>>
<span id="el_jdh_patient_cases_socio_economic_history">
<span<?= $Page->socio_economic_history->viewAttributes() ?>>
<?= $Page->socio_economic_history->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->notes->Visible) { // notes ?>
    <tr id="r_notes"<?= $Page->notes->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_patient_cases_notes"><?= $Page->notes->caption() ?></span></td>
        <td data-name="notes"<?= $Page->notes->cellAttributes() ?>>
<span id="el_jdh_patient_cases_notes">
<span<?= $Page->notes->viewAttributes() ?>>
<?= $Page->notes->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->submission_date->Visible) { // submission_date ?>
    <tr id="r_submission_date"<?= $Page->submission_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_patient_cases_submission_date"><?= $Page->submission_date->caption() ?></span></td>
        <td data-name="submission_date"<?= $Page->submission_date->cellAttributes() ?>>
<span id="el_jdh_patient_cases_submission_date">
<span<?= $Page->submission_date->viewAttributes() ?>>
<?= $Page->submission_date->getViewValue() ?></span>
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
