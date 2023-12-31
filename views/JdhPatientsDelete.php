<?php

namespace PHPMaker2024\jootidigitalhealthcare;

// Page object
$JdhPatientsDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_patients: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fjdh_patientsdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_patientsdelete")
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
<form name="fjdh_patientsdelete" id="fjdh_patientsdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jdh_patients">
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
        <th class="<?= $Page->patient_id->headerCellClass() ?>"><span id="elh_jdh_patients_patient_id" class="jdh_patients_patient_id"><?= $Page->patient_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->patient_ip_number->Visible) { // patient_ip_number ?>
        <th class="<?= $Page->patient_ip_number->headerCellClass() ?>"><span id="elh_jdh_patients_patient_ip_number" class="jdh_patients_patient_ip_number"><?= $Page->patient_ip_number->caption() ?></span></th>
<?php } ?>
<?php if ($Page->patient_name->Visible) { // patient_name ?>
        <th class="<?= $Page->patient_name->headerCellClass() ?>"><span id="elh_jdh_patients_patient_name" class="jdh_patients_patient_name"><?= $Page->patient_name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->patient_dob_year->Visible) { // patient_dob_year ?>
        <th class="<?= $Page->patient_dob_year->headerCellClass() ?>"><span id="elh_jdh_patients_patient_dob_year" class="jdh_patients_patient_dob_year"><?= $Page->patient_dob_year->caption() ?></span></th>
<?php } ?>
<?php if ($Page->patient_age->Visible) { // patient_age ?>
        <th class="<?= $Page->patient_age->headerCellClass() ?>"><span id="elh_jdh_patients_patient_age" class="jdh_patients_patient_age"><?= $Page->patient_age->caption() ?></span></th>
<?php } ?>
<?php if ($Page->patient_gender->Visible) { // patient_gender ?>
        <th class="<?= $Page->patient_gender->headerCellClass() ?>"><span id="elh_jdh_patients_patient_gender" class="jdh_patients_patient_gender"><?= $Page->patient_gender->caption() ?></span></th>
<?php } ?>
<?php if ($Page->patient_phone->Visible) { // patient_phone ?>
        <th class="<?= $Page->patient_phone->headerCellClass() ?>"><span id="elh_jdh_patients_patient_phone" class="jdh_patients_patient_phone"><?= $Page->patient_phone->caption() ?></span></th>
<?php } ?>
<?php if ($Page->patient_registration_date->Visible) { // patient_registration_date ?>
        <th class="<?= $Page->patient_registration_date->headerCellClass() ?>"><span id="elh_jdh_patients_patient_registration_date" class="jdh_patients_patient_registration_date"><?= $Page->patient_registration_date->caption() ?></span></th>
<?php } ?>
<?php if ($Page->time->Visible) { // time ?>
        <th class="<?= $Page->time->headerCellClass() ?>"><span id="elh_jdh_patients_time" class="jdh_patients_time"><?= $Page->time->caption() ?></span></th>
<?php } ?>
<?php if ($Page->is_inpatient->Visible) { // is_inpatient ?>
        <th class="<?= $Page->is_inpatient->headerCellClass() ?>"><span id="elh_jdh_patients_is_inpatient" class="jdh_patients_is_inpatient"><?= $Page->is_inpatient->caption() ?></span></th>
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
<?php if ($Page->patient_ip_number->Visible) { // patient_ip_number ?>
        <td<?= $Page->patient_ip_number->cellAttributes() ?>>
<span id="">
<span<?= $Page->patient_ip_number->viewAttributes() ?>>
<?= $Page->patient_ip_number->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->patient_name->Visible) { // patient_name ?>
        <td<?= $Page->patient_name->cellAttributes() ?>>
<span id="">
<span<?= $Page->patient_name->viewAttributes() ?>>
<?= $Page->patient_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->patient_dob_year->Visible) { // patient_dob_year ?>
        <td<?= $Page->patient_dob_year->cellAttributes() ?>>
<span id="">
<span<?= $Page->patient_dob_year->viewAttributes() ?>>
<?= $Page->patient_dob_year->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->patient_age->Visible) { // patient_age ?>
        <td<?= $Page->patient_age->cellAttributes() ?>>
<span id="">
<span<?= $Page->patient_age->viewAttributes() ?>>
<?= $Page->patient_age->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->patient_gender->Visible) { // patient_gender ?>
        <td<?= $Page->patient_gender->cellAttributes() ?>>
<span id="">
<span<?= $Page->patient_gender->viewAttributes() ?>>
<?= $Page->patient_gender->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->patient_phone->Visible) { // patient_phone ?>
        <td<?= $Page->patient_phone->cellAttributes() ?>>
<span id="">
<span<?= $Page->patient_phone->viewAttributes() ?>>
<?php if (!EmptyString($Page->patient_phone->getViewValue()) && $Page->patient_phone->linkAttributes() != "") { ?>
<a<?= $Page->patient_phone->linkAttributes() ?>><?= $Page->patient_phone->getViewValue() ?></a>
<?php } else { ?>
<?= $Page->patient_phone->getViewValue() ?>
<?php } ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($Page->patient_registration_date->Visible) { // patient_registration_date ?>
        <td<?= $Page->patient_registration_date->cellAttributes() ?>>
<span id="">
<span<?= $Page->patient_registration_date->viewAttributes() ?>>
<?= $Page->patient_registration_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->time->Visible) { // time ?>
        <td<?= $Page->time->cellAttributes() ?>>
<span id="">
<span<?= $Page->time->viewAttributes() ?>>
<?= $Page->time->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->is_inpatient->Visible) { // is_inpatient ?>
        <td<?= $Page->is_inpatient->cellAttributes() ?>>
<span id="">
<span<?= $Page->is_inpatient->viewAttributes() ?>>
<?= $Page->is_inpatient->getViewValue() ?></span>
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
