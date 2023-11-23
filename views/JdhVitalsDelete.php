<?php

namespace PHPMaker2024\jootidigitalhealthcare;

// Page object
$JdhVitalsDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_vitals: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fjdh_vitalsdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_vitalsdelete")
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
<form name="fjdh_vitalsdelete" id="fjdh_vitalsdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jdh_vitals">
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
<?php if ($Page->patient_id->Visible) { // patient_id ?>
        <th class="<?= $Page->patient_id->headerCellClass() ?>"><span id="elh_jdh_vitals_patient_id" class="jdh_vitals_patient_id"><?= $Page->patient_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->pressure->Visible) { // pressure ?>
        <th class="<?= $Page->pressure->headerCellClass() ?>"><span id="elh_jdh_vitals_pressure" class="jdh_vitals_pressure"><?= $Page->pressure->caption() ?></span></th>
<?php } ?>
<?php if ($Page->height->Visible) { // height ?>
        <th class="<?= $Page->height->headerCellClass() ?>"><span id="elh_jdh_vitals_height" class="jdh_vitals_height"><?= $Page->height->caption() ?></span></th>
<?php } ?>
<?php if ($Page->weight->Visible) { // weight ?>
        <th class="<?= $Page->weight->headerCellClass() ?>"><span id="elh_jdh_vitals_weight" class="jdh_vitals_weight"><?= $Page->weight->caption() ?></span></th>
<?php } ?>
<?php if ($Page->body_mass_index->Visible) { // body_mass_index ?>
        <th class="<?= $Page->body_mass_index->headerCellClass() ?>"><span id="elh_jdh_vitals_body_mass_index" class="jdh_vitals_body_mass_index"><?= $Page->body_mass_index->caption() ?></span></th>
<?php } ?>
<?php if ($Page->pulse_rate->Visible) { // pulse_rate ?>
        <th class="<?= $Page->pulse_rate->headerCellClass() ?>"><span id="elh_jdh_vitals_pulse_rate" class="jdh_vitals_pulse_rate"><?= $Page->pulse_rate->caption() ?></span></th>
<?php } ?>
<?php if ($Page->respiratory_rate->Visible) { // respiratory_rate ?>
        <th class="<?= $Page->respiratory_rate->headerCellClass() ?>"><span id="elh_jdh_vitals_respiratory_rate" class="jdh_vitals_respiratory_rate"><?= $Page->respiratory_rate->caption() ?></span></th>
<?php } ?>
<?php if ($Page->temperature->Visible) { // temperature ?>
        <th class="<?= $Page->temperature->headerCellClass() ?>"><span id="elh_jdh_vitals_temperature" class="jdh_vitals_temperature"><?= $Page->temperature->caption() ?></span></th>
<?php } ?>
<?php if ($Page->random_blood_sugar->Visible) { // random_blood_sugar ?>
        <th class="<?= $Page->random_blood_sugar->headerCellClass() ?>"><span id="elh_jdh_vitals_random_blood_sugar" class="jdh_vitals_random_blood_sugar"><?= $Page->random_blood_sugar->caption() ?></span></th>
<?php } ?>
<?php if ($Page->spo_2->Visible) { // spo_2 ?>
        <th class="<?= $Page->spo_2->headerCellClass() ?>"><span id="elh_jdh_vitals_spo_2" class="jdh_vitals_spo_2"><?= $Page->spo_2->caption() ?></span></th>
<?php } ?>
<?php if ($Page->submission_date->Visible) { // submission_date ?>
        <th class="<?= $Page->submission_date->headerCellClass() ?>"><span id="elh_jdh_vitals_submission_date" class="jdh_vitals_submission_date"><?= $Page->submission_date->caption() ?></span></th>
<?php } ?>
<?php if ($Page->patient_status->Visible) { // patient_status ?>
        <th class="<?= $Page->patient_status->headerCellClass() ?>"><span id="elh_jdh_vitals_patient_status" class="jdh_vitals_patient_status"><?= $Page->patient_status->caption() ?></span></th>
<?php } ?>
    </tr>
    </thead>
    <tbody>
<?php
$Page->RecordCount = 0;
$i = 0;
while ($Page->fetch()) {
    $Page->RecordCount++;
    $Page->RowCount++;

    // Set row properties
    $Page->resetAttributes();
    $Page->RowType = RowType::VIEW; // View

    // Get the field contents
    $Page->loadRowValues($Page->CurrentRow);

    // Render row
    $Page->renderRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
        <td<?= $Page->patient_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->patient_id->viewAttributes() ?>>
<?= $Page->patient_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->pressure->Visible) { // pressure ?>
        <td<?= $Page->pressure->cellAttributes() ?>>
<span id="">
<span<?= $Page->pressure->viewAttributes() ?>>
<?= $Page->pressure->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->height->Visible) { // height ?>
        <td<?= $Page->height->cellAttributes() ?>>
<span id="">
<span<?= $Page->height->viewAttributes() ?>>
<?= $Page->height->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->weight->Visible) { // weight ?>
        <td<?= $Page->weight->cellAttributes() ?>>
<span id="">
<span<?= $Page->weight->viewAttributes() ?>>
<?= $Page->weight->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->body_mass_index->Visible) { // body_mass_index ?>
        <td<?= $Page->body_mass_index->cellAttributes() ?>>
<span id="">
<span<?= $Page->body_mass_index->viewAttributes() ?>>
<?= $Page->body_mass_index->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->pulse_rate->Visible) { // pulse_rate ?>
        <td<?= $Page->pulse_rate->cellAttributes() ?>>
<span id="">
<span<?= $Page->pulse_rate->viewAttributes() ?>>
<?= $Page->pulse_rate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->respiratory_rate->Visible) { // respiratory_rate ?>
        <td<?= $Page->respiratory_rate->cellAttributes() ?>>
<span id="">
<span<?= $Page->respiratory_rate->viewAttributes() ?>>
<?= $Page->respiratory_rate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->temperature->Visible) { // temperature ?>
        <td<?= $Page->temperature->cellAttributes() ?>>
<span id="">
<span<?= $Page->temperature->viewAttributes() ?>>
<?= $Page->temperature->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->random_blood_sugar->Visible) { // random_blood_sugar ?>
        <td<?= $Page->random_blood_sugar->cellAttributes() ?>>
<span id="">
<span<?= $Page->random_blood_sugar->viewAttributes() ?>>
<?= $Page->random_blood_sugar->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->spo_2->Visible) { // spo_2 ?>
        <td<?= $Page->spo_2->cellAttributes() ?>>
<span id="">
<span<?= $Page->spo_2->viewAttributes() ?>>
<?= $Page->spo_2->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->submission_date->Visible) { // submission_date ?>
        <td<?= $Page->submission_date->cellAttributes() ?>>
<span id="">
<span<?= $Page->submission_date->viewAttributes() ?>>
<?= $Page->submission_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->patient_status->Visible) { // patient_status ?>
        <td<?= $Page->patient_status->cellAttributes() ?>>
<span id="">
<span<?= $Page->patient_status->viewAttributes() ?>>
<?= $Page->patient_status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
    </tr>
<?php
}
$Page->Recordset?->free();
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
