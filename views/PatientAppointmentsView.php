<?php

namespace PHPMaker2024\jootidigitalhealthcare;

// Page object
$PatientAppointmentsView = &$Page;
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
<form name="fPatient_Appointmentsview" id="fPatient_Appointmentsview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { Patient_Appointments: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fPatient_Appointmentsview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fPatient_Appointmentsview")
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
<input type="hidden" name="t" value="Patient_Appointments">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->appointment_id->Visible) { // appointment_id ?>
    <tr id="r_appointment_id"<?= $Page->appointment_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_Patient_Appointments_appointment_id"><?= $Page->appointment_id->caption() ?></span></td>
        <td data-name="appointment_id"<?= $Page->appointment_id->cellAttributes() ?>>
<span id="el_Patient_Appointments_appointment_id">
<span<?= $Page->appointment_id->viewAttributes() ?>>
<?= $Page->appointment_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->appointment_title->Visible) { // appointment_title ?>
    <tr id="r_appointment_title"<?= $Page->appointment_title->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_Patient_Appointments_appointment_title"><?= $Page->appointment_title->caption() ?></span></td>
        <td data-name="appointment_title"<?= $Page->appointment_title->cellAttributes() ?>>
<span id="el_Patient_Appointments_appointment_title">
<span<?= $Page->appointment_title->viewAttributes() ?>>
<?= $Page->appointment_title->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->appointment_start_date->Visible) { // appointment_start_date ?>
    <tr id="r_appointment_start_date"<?= $Page->appointment_start_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_Patient_Appointments_appointment_start_date"><?= $Page->appointment_start_date->caption() ?></span></td>
        <td data-name="appointment_start_date"<?= $Page->appointment_start_date->cellAttributes() ?>>
<span id="el_Patient_Appointments_appointment_start_date">
<span<?= $Page->appointment_start_date->viewAttributes() ?>>
<?= $Page->appointment_start_date->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->appointment_end_date->Visible) { // appointment_end_date ?>
    <tr id="r_appointment_end_date"<?= $Page->appointment_end_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_Patient_Appointments_appointment_end_date"><?= $Page->appointment_end_date->caption() ?></span></td>
        <td data-name="appointment_end_date"<?= $Page->appointment_end_date->cellAttributes() ?>>
<span id="el_Patient_Appointments_appointment_end_date">
<span<?= $Page->appointment_end_date->viewAttributes() ?>>
<?= $Page->appointment_end_date->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->appointment_description->Visible) { // appointment_description ?>
    <tr id="r_appointment_description"<?= $Page->appointment_description->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_Patient_Appointments_appointment_description"><?= $Page->appointment_description->caption() ?></span></td>
        <td data-name="appointment_description"<?= $Page->appointment_description->cellAttributes() ?>>
<span id="el_Patient_Appointments_appointment_description">
<span<?= $Page->appointment_description->viewAttributes() ?>>
<?= $Page->appointment_description->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->appointment_all_day->Visible) { // appointment_all_day ?>
    <tr id="r_appointment_all_day"<?= $Page->appointment_all_day->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_Patient_Appointments_appointment_all_day"><?= $Page->appointment_all_day->caption() ?></span></td>
        <td data-name="appointment_all_day"<?= $Page->appointment_all_day->cellAttributes() ?>>
<span id="el_Patient_Appointments_appointment_all_day">
<span<?= $Page->appointment_all_day->viewAttributes() ?>>
<i class="fa-regular fa-square<?php if (ConvertToBool($Page->appointment_all_day->CurrentValue)) { ?>-check<?php } ?> ew-icon ew-boolean"></i>
</span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->user_id->Visible) { // user_id ?>
    <tr id="r_user_id"<?= $Page->user_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_Patient_Appointments_user_id"><?= $Page->user_id->caption() ?></span></td>
        <td data-name="user_id"<?= $Page->user_id->cellAttributes() ?>>
<span id="el_Patient_Appointments_user_id">
<span<?= $Page->user_id->viewAttributes() ?>>
<?= $Page->user_id->getViewValue() ?></span>
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
