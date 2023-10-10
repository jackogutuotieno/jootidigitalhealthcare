<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$PatientAppointmentsDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { Patient_Appointments: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fPatient_Appointmentsdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fPatient_Appointmentsdelete")
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
<form name="fPatient_Appointmentsdelete" id="fPatient_Appointmentsdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="Patient_Appointments">
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
<?php if ($Page->appointment_id->Visible) { // appointment_id ?>
        <th class="<?= $Page->appointment_id->headerCellClass() ?>"><span id="elh_Patient_Appointments_appointment_id" class="Patient_Appointments_appointment_id"><?= $Page->appointment_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
        <th class="<?= $Page->patient_id->headerCellClass() ?>"><span id="elh_Patient_Appointments_patient_id" class="Patient_Appointments_patient_id"><?= $Page->patient_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->appointment_title->Visible) { // appointment_title ?>
        <th class="<?= $Page->appointment_title->headerCellClass() ?>"><span id="elh_Patient_Appointments_appointment_title" class="Patient_Appointments_appointment_title"><?= $Page->appointment_title->caption() ?></span></th>
<?php } ?>
<?php if ($Page->appointment_start_date->Visible) { // appointment_start_date ?>
        <th class="<?= $Page->appointment_start_date->headerCellClass() ?>"><span id="elh_Patient_Appointments_appointment_start_date" class="Patient_Appointments_appointment_start_date"><?= $Page->appointment_start_date->caption() ?></span></th>
<?php } ?>
<?php if ($Page->appointment_end_date->Visible) { // appointment_end_date ?>
        <th class="<?= $Page->appointment_end_date->headerCellClass() ?>"><span id="elh_Patient_Appointments_appointment_end_date" class="Patient_Appointments_appointment_end_date"><?= $Page->appointment_end_date->caption() ?></span></th>
<?php } ?>
<?php if ($Page->subbmitted_by_user_id->Visible) { // subbmitted_by_user_id ?>
        <th class="<?= $Page->subbmitted_by_user_id->headerCellClass() ?>"><span id="elh_Patient_Appointments_subbmitted_by_user_id" class="Patient_Appointments_subbmitted_by_user_id"><?= $Page->subbmitted_by_user_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->appointment_all_day->Visible) { // appointment_all_day ?>
        <th class="<?= $Page->appointment_all_day->headerCellClass() ?>"><span id="elh_Patient_Appointments_appointment_all_day" class="Patient_Appointments_appointment_all_day"><?= $Page->appointment_all_day->caption() ?></span></th>
<?php } ?>
<?php if ($Page->user_id->Visible) { // user_id ?>
        <th class="<?= $Page->user_id->headerCellClass() ?>"><span id="elh_Patient_Appointments_user_id" class="Patient_Appointments_user_id"><?= $Page->user_id->caption() ?></span></th>
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
<?php if ($Page->appointment_id->Visible) { // appointment_id ?>
        <td<?= $Page->appointment_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Patient_Appointments_appointment_id" class="el_Patient_Appointments_appointment_id">
<span<?= $Page->appointment_id->viewAttributes() ?>>
<?= $Page->appointment_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
        <td<?= $Page->patient_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Patient_Appointments_patient_id" class="el_Patient_Appointments_patient_id">
<span<?= $Page->patient_id->viewAttributes() ?>>
<?= $Page->patient_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->appointment_title->Visible) { // appointment_title ?>
        <td<?= $Page->appointment_title->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Patient_Appointments_appointment_title" class="el_Patient_Appointments_appointment_title">
<span<?= $Page->appointment_title->viewAttributes() ?>>
<?= $Page->appointment_title->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->appointment_start_date->Visible) { // appointment_start_date ?>
        <td<?= $Page->appointment_start_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Patient_Appointments_appointment_start_date" class="el_Patient_Appointments_appointment_start_date">
<span<?= $Page->appointment_start_date->viewAttributes() ?>>
<?= $Page->appointment_start_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->appointment_end_date->Visible) { // appointment_end_date ?>
        <td<?= $Page->appointment_end_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Patient_Appointments_appointment_end_date" class="el_Patient_Appointments_appointment_end_date">
<span<?= $Page->appointment_end_date->viewAttributes() ?>>
<?= $Page->appointment_end_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->subbmitted_by_user_id->Visible) { // subbmitted_by_user_id ?>
        <td<?= $Page->subbmitted_by_user_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Patient_Appointments_subbmitted_by_user_id" class="el_Patient_Appointments_subbmitted_by_user_id">
<span<?= $Page->subbmitted_by_user_id->viewAttributes() ?>>
<?= $Page->subbmitted_by_user_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->appointment_all_day->Visible) { // appointment_all_day ?>
        <td<?= $Page->appointment_all_day->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Patient_Appointments_appointment_all_day" class="el_Patient_Appointments_appointment_all_day">
<span<?= $Page->appointment_all_day->viewAttributes() ?>>
<div class="form-check d-inline-block">
    <input type="checkbox" id="x_appointment_all_day_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->appointment_all_day->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->appointment_all_day->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_appointment_all_day_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
<?php } ?>
<?php if ($Page->user_id->Visible) { // user_id ?>
        <td<?= $Page->user_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Patient_Appointments_user_id" class="el_Patient_Appointments_user_id">
<span<?= $Page->user_id->viewAttributes() ?>>
<?= $Page->user_id->getViewValue() ?></span>
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
