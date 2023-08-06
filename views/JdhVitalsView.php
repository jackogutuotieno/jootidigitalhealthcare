<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$JdhVitalsView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
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
<form name="fjdh_vitalsview" id="fjdh_vitalsview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_vitals: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fjdh_vitalsview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_vitalsview")
        .setPageId("view")
        .build();
    window[form.id] = form;
    currentForm = form;
    loadjs.done(form.id);
});
</script>
<?php } ?>
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jdh_vitals">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->vitals_id->Visible) { // vitals_id ?>
    <tr id="r_vitals_id"<?= $Page->vitals_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_vitals_vitals_id"><?= $Page->vitals_id->caption() ?></span></td>
        <td data-name="vitals_id"<?= $Page->vitals_id->cellAttributes() ?>>
<span id="el_jdh_vitals_vitals_id">
<span<?= $Page->vitals_id->viewAttributes() ?>>
<?= $Page->vitals_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
    <tr id="r_patient_id"<?= $Page->patient_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_vitals_patient_id"><?= $Page->patient_id->caption() ?></span></td>
        <td data-name="patient_id"<?= $Page->patient_id->cellAttributes() ?>>
<span id="el_jdh_vitals_patient_id">
<span<?= $Page->patient_id->viewAttributes() ?>>
<?= $Page->patient_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pressure->Visible) { // pressure ?>
    <tr id="r_pressure"<?= $Page->pressure->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_vitals_pressure"><?= $Page->pressure->caption() ?></span></td>
        <td data-name="pressure"<?= $Page->pressure->cellAttributes() ?>>
<span id="el_jdh_vitals_pressure">
<span<?= $Page->pressure->viewAttributes() ?>>
<?= $Page->pressure->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->height->Visible) { // height ?>
    <tr id="r_height"<?= $Page->height->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_vitals_height"><?= $Page->height->caption() ?></span></td>
        <td data-name="height"<?= $Page->height->cellAttributes() ?>>
<span id="el_jdh_vitals_height">
<span<?= $Page->height->viewAttributes() ?>>
<?= $Page->height->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->weight->Visible) { // weight ?>
    <tr id="r_weight"<?= $Page->weight->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_vitals_weight"><?= $Page->weight->caption() ?></span></td>
        <td data-name="weight"<?= $Page->weight->cellAttributes() ?>>
<span id="el_jdh_vitals_weight">
<span<?= $Page->weight->viewAttributes() ?>>
<?= $Page->weight->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->body_mass_index->Visible) { // body_mass_index ?>
    <tr id="r_body_mass_index"<?= $Page->body_mass_index->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_vitals_body_mass_index"><?= $Page->body_mass_index->caption() ?></span></td>
        <td data-name="body_mass_index"<?= $Page->body_mass_index->cellAttributes() ?>>
<span id="el_jdh_vitals_body_mass_index">
<span<?= $Page->body_mass_index->viewAttributes() ?>>
<?= $Page->body_mass_index->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pulse_rate->Visible) { // pulse_rate ?>
    <tr id="r_pulse_rate"<?= $Page->pulse_rate->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_vitals_pulse_rate"><?= $Page->pulse_rate->caption() ?></span></td>
        <td data-name="pulse_rate"<?= $Page->pulse_rate->cellAttributes() ?>>
<span id="el_jdh_vitals_pulse_rate">
<span<?= $Page->pulse_rate->viewAttributes() ?>>
<?= $Page->pulse_rate->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->respiratory_rate->Visible) { // respiratory_rate ?>
    <tr id="r_respiratory_rate"<?= $Page->respiratory_rate->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_vitals_respiratory_rate"><?= $Page->respiratory_rate->caption() ?></span></td>
        <td data-name="respiratory_rate"<?= $Page->respiratory_rate->cellAttributes() ?>>
<span id="el_jdh_vitals_respiratory_rate">
<span<?= $Page->respiratory_rate->viewAttributes() ?>>
<?= $Page->respiratory_rate->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->temperature->Visible) { // temperature ?>
    <tr id="r_temperature"<?= $Page->temperature->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_vitals_temperature"><?= $Page->temperature->caption() ?></span></td>
        <td data-name="temperature"<?= $Page->temperature->cellAttributes() ?>>
<span id="el_jdh_vitals_temperature">
<span<?= $Page->temperature->viewAttributes() ?>>
<?= $Page->temperature->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->random_blood_sugar->Visible) { // random_blood_sugar ?>
    <tr id="r_random_blood_sugar"<?= $Page->random_blood_sugar->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_vitals_random_blood_sugar"><?= $Page->random_blood_sugar->caption() ?></span></td>
        <td data-name="random_blood_sugar"<?= $Page->random_blood_sugar->cellAttributes() ?>>
<span id="el_jdh_vitals_random_blood_sugar">
<span<?= $Page->random_blood_sugar->viewAttributes() ?>>
<?= $Page->random_blood_sugar->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->submission_date->Visible) { // submission_date ?>
    <tr id="r_submission_date"<?= $Page->submission_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_vitals_submission_date"><?= $Page->submission_date->caption() ?></span></td>
        <td data-name="submission_date"<?= $Page->submission_date->cellAttributes() ?>>
<span id="el_jdh_vitals_submission_date">
<span<?= $Page->submission_date->viewAttributes() ?>>
<?= $Page->submission_date->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->submitted_by_user_id->Visible) { // submitted_by_user_id ?>
    <tr id="r_submitted_by_user_id"<?= $Page->submitted_by_user_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_vitals_submitted_by_user_id"><?= $Page->submitted_by_user_id->caption() ?></span></td>
        <td data-name="submitted_by_user_id"<?= $Page->submitted_by_user_id->cellAttributes() ?>>
<span id="el_jdh_vitals_submitted_by_user_id">
<span<?= $Page->submitted_by_user_id->viewAttributes() ?>>
<?= $Page->submitted_by_user_id->getViewValue() ?></span>
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
