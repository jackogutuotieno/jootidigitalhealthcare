<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$AppointmentsView = &$Page;
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
<form name="fAppointmentsview" id="fAppointmentsview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { Appointments: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fAppointmentsview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fAppointmentsview")
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
<input type="hidden" name="t" value="Appointments">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->appointment_id->Visible) { // appointment_id ?>
    <tr id="r_appointment_id"<?= $Page->appointment_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_Appointments_appointment_id"><?= $Page->appointment_id->caption() ?></span></td>
        <td data-name="appointment_id"<?= $Page->appointment_id->cellAttributes() ?>>
<span id="el_Appointments_appointment_id">
<span<?= $Page->appointment_id->viewAttributes() ?>>
<?= $Page->appointment_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
    <tr id="r_patient_id"<?= $Page->patient_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_Appointments_patient_id"><?= $Page->patient_id->caption() ?></span></td>
        <td data-name="patient_id"<?= $Page->patient_id->cellAttributes() ?>>
<span id="el_Appointments_patient_id">
<span<?= $Page->patient_id->viewAttributes() ?>>
<?= $Page->patient_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->appointment_title->Visible) { // appointment_title ?>
    <tr id="r_appointment_title"<?= $Page->appointment_title->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_Appointments_appointment_title"><?= $Page->appointment_title->caption() ?></span></td>
        <td data-name="appointment_title"<?= $Page->appointment_title->cellAttributes() ?>>
<span id="el_Appointments_appointment_title">
<span<?= $Page->appointment_title->viewAttributes() ?>>
<?= $Page->appointment_title->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->submission_date->Visible) { // submission_date ?>
    <tr id="r_submission_date"<?= $Page->submission_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_Appointments_submission_date"><?= $Page->submission_date->caption() ?></span></td>
        <td data-name="submission_date"<?= $Page->submission_date->cellAttributes() ?>>
<span id="el_Appointments_submission_date">
<span<?= $Page->submission_date->viewAttributes() ?>>
<?= $Page->submission_date->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->subbmitted_by_user_id->Visible) { // subbmitted_by_user_id ?>
    <tr id="r_subbmitted_by_user_id"<?= $Page->subbmitted_by_user_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_Appointments_subbmitted_by_user_id"><?= $Page->subbmitted_by_user_id->caption() ?></span></td>
        <td data-name="subbmitted_by_user_id"<?= $Page->subbmitted_by_user_id->cellAttributes() ?>>
<span id="el_Appointments_subbmitted_by_user_id">
<span<?= $Page->subbmitted_by_user_id->viewAttributes() ?>>
<?= $Page->subbmitted_by_user_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->appointment_end_date->Visible) { // appointment_end_date ?>
    <tr id="r_appointment_end_date"<?= $Page->appointment_end_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_Appointments_appointment_end_date"><?= $Page->appointment_end_date->caption() ?></span></td>
        <td data-name="appointment_end_date"<?= $Page->appointment_end_date->cellAttributes() ?>>
<span id="el_Appointments_appointment_end_date">
<span<?= $Page->appointment_end_date->viewAttributes() ?>>
<?= $Page->appointment_end_date->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->appointment_start_date->Visible) { // appointment_start_date ?>
    <tr id="r_appointment_start_date"<?= $Page->appointment_start_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_Appointments_appointment_start_date"><?= $Page->appointment_start_date->caption() ?></span></td>
        <td data-name="appointment_start_date"<?= $Page->appointment_start_date->cellAttributes() ?>>
<span id="el_Appointments_appointment_start_date">
<span<?= $Page->appointment_start_date->viewAttributes() ?>>
<?= $Page->appointment_start_date->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->appointment_description->Visible) { // appointment_description ?>
    <tr id="r_appointment_description"<?= $Page->appointment_description->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_Appointments_appointment_description"><?= $Page->appointment_description->caption() ?></span></td>
        <td data-name="appointment_description"<?= $Page->appointment_description->cellAttributes() ?>>
<span id="el_Appointments_appointment_description">
<span<?= $Page->appointment_description->viewAttributes() ?>>
<?= $Page->appointment_description->getViewValue() ?></span>
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
