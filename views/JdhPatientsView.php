<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$JdhPatientsView = &$Page;
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
<form name="fjdh_patientsview" id="fjdh_patientsview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_patients: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fjdh_patientsview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_patientsview")
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
<input type="hidden" name="t" value="jdh_patients">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->patient_id->Visible) { // patient_id ?>
    <tr id="r_patient_id"<?= $Page->patient_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_patients_patient_id"><?= $Page->patient_id->caption() ?></span></td>
        <td data-name="patient_id"<?= $Page->patient_id->cellAttributes() ?>>
<span id="el_jdh_patients_patient_id">
<span<?= $Page->patient_id->viewAttributes() ?>>
<?= $Page->patient_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->photo->Visible) { // photo ?>
    <tr id="r_photo"<?= $Page->photo->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_patients_photo"><?= $Page->photo->caption() ?></span></td>
        <td data-name="photo"<?= $Page->photo->cellAttributes() ?>>
<span id="el_jdh_patients_photo">
<span>
<?= GetFileViewTag($Page->photo, $Page->photo->getViewValue(), false) ?>
</span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->patient_national_id->Visible) { // patient_national_id ?>
    <tr id="r_patient_national_id"<?= $Page->patient_national_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_patients_patient_national_id"><?= $Page->patient_national_id->caption() ?></span></td>
        <td data-name="patient_national_id"<?= $Page->patient_national_id->cellAttributes() ?>>
<span id="el_jdh_patients_patient_national_id">
<span<?= $Page->patient_national_id->viewAttributes() ?>>
<?= $Page->patient_national_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->patient_first_name->Visible) { // patient_first_name ?>
    <tr id="r_patient_first_name"<?= $Page->patient_first_name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_patients_patient_first_name"><?= $Page->patient_first_name->caption() ?></span></td>
        <td data-name="patient_first_name"<?= $Page->patient_first_name->cellAttributes() ?>>
<span id="el_jdh_patients_patient_first_name">
<span<?= $Page->patient_first_name->viewAttributes() ?>>
<?= $Page->patient_first_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->patient_last_name->Visible) { // patient_last_name ?>
    <tr id="r_patient_last_name"<?= $Page->patient_last_name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_patients_patient_last_name"><?= $Page->patient_last_name->caption() ?></span></td>
        <td data-name="patient_last_name"<?= $Page->patient_last_name->cellAttributes() ?>>
<span id="el_jdh_patients_patient_last_name">
<span<?= $Page->patient_last_name->viewAttributes() ?>>
<?= $Page->patient_last_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->patient_dob->Visible) { // patient_dob ?>
    <tr id="r_patient_dob"<?= $Page->patient_dob->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_patients_patient_dob"><?= $Page->patient_dob->caption() ?></span></td>
        <td data-name="patient_dob"<?= $Page->patient_dob->cellAttributes() ?>>
<span id="el_jdh_patients_patient_dob">
<span<?= $Page->patient_dob->viewAttributes() ?>>
<?= $Page->patient_dob->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->patient_age->Visible) { // patient_age ?>
    <tr id="r_patient_age"<?= $Page->patient_age->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_patients_patient_age"><?= $Page->patient_age->caption() ?></span></td>
        <td data-name="patient_age"<?= $Page->patient_age->cellAttributes() ?>>
<span id="el_jdh_patients_patient_age">
<span<?= $Page->patient_age->viewAttributes() ?>>
<?= $Page->patient_age->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->patient_gender->Visible) { // patient_gender ?>
    <tr id="r_patient_gender"<?= $Page->patient_gender->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_patients_patient_gender"><?= $Page->patient_gender->caption() ?></span></td>
        <td data-name="patient_gender"<?= $Page->patient_gender->cellAttributes() ?>>
<span id="el_jdh_patients_patient_gender">
<span<?= $Page->patient_gender->viewAttributes() ?>>
<?= $Page->patient_gender->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->patient_phone->Visible) { // patient_phone ?>
    <tr id="r_patient_phone"<?= $Page->patient_phone->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_patients_patient_phone"><?= $Page->patient_phone->caption() ?></span></td>
        <td data-name="patient_phone"<?= $Page->patient_phone->cellAttributes() ?>>
<span id="el_jdh_patients_patient_phone">
<span<?= $Page->patient_phone->viewAttributes() ?>>
<?= $Page->patient_phone->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->patient_kin_name->Visible) { // patient_kin_name ?>
    <tr id="r_patient_kin_name"<?= $Page->patient_kin_name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_patients_patient_kin_name"><?= $Page->patient_kin_name->caption() ?></span></td>
        <td data-name="patient_kin_name"<?= $Page->patient_kin_name->cellAttributes() ?>>
<span id="el_jdh_patients_patient_kin_name">
<span<?= $Page->patient_kin_name->viewAttributes() ?>>
<?= $Page->patient_kin_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->patient_kin_phone->Visible) { // patient_kin_phone ?>
    <tr id="r_patient_kin_phone"<?= $Page->patient_kin_phone->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_patients_patient_kin_phone"><?= $Page->patient_kin_phone->caption() ?></span></td>
        <td data-name="patient_kin_phone"<?= $Page->patient_kin_phone->cellAttributes() ?>>
<span id="el_jdh_patients_patient_kin_phone">
<span<?= $Page->patient_kin_phone->viewAttributes() ?>>
<?= $Page->patient_kin_phone->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->patient_registration_date->Visible) { // patient_registration_date ?>
    <tr id="r_patient_registration_date"<?= $Page->patient_registration_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_patients_patient_registration_date"><?= $Page->patient_registration_date->caption() ?></span></td>
        <td data-name="patient_registration_date"<?= $Page->patient_registration_date->cellAttributes() ?>>
<span id="el_jdh_patients_patient_registration_date">
<span<?= $Page->patient_registration_date->viewAttributes() ?>>
<?= $Page->patient_registration_date->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
<?php
    if (in_array("jdh_appointments", explode(",", $Page->getCurrentDetailTable())) && $jdh_appointments->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("jdh_appointments", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "JdhAppointmentsGrid.php" ?>
<?php } ?>
<?php
    if (in_array("jdh_patient_cases", explode(",", $Page->getCurrentDetailTable())) && $jdh_patient_cases->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("jdh_patient_cases", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "JdhPatientCasesGrid.php" ?>
<?php } ?>
<?php
    if (in_array("jdh_vitals", explode(",", $Page->getCurrentDetailTable())) && $jdh_vitals->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("jdh_vitals", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "JdhVitalsGrid.php" ?>
<?php } ?>
<?php
    if (in_array("jdh_patient_visits", explode(",", $Page->getCurrentDetailTable())) && $jdh_patient_visits->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("jdh_patient_visits", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "JdhPatientVisitsGrid.php" ?>
<?php } ?>
<?php
    if (in_array("jdh_chief_complaints", explode(",", $Page->getCurrentDetailTable())) && $jdh_chief_complaints->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("jdh_chief_complaints", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "JdhChiefComplaintsGrid.php" ?>
<?php } ?>
<?php
    if (in_array("jdh_examination_findings", explode(",", $Page->getCurrentDetailTable())) && $jdh_examination_findings->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("jdh_examination_findings", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "JdhExaminationFindingsGrid.php" ?>
<?php } ?>
<?php
    if (in_array("jdh_prescriptions", explode(",", $Page->getCurrentDetailTable())) && $jdh_prescriptions->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("jdh_prescriptions", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "JdhPrescriptionsGrid.php" ?>
<?php } ?>
<?php
    if (in_array("jdh_test_requests", explode(",", $Page->getCurrentDetailTable())) && $jdh_test_requests->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("jdh_test_requests", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "JdhTestRequestsGrid.php" ?>
<?php } ?>
<?php
    if (in_array("jdh_test_reports", explode(",", $Page->getCurrentDetailTable())) && $jdh_test_reports->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("jdh_test_reports", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "JdhTestReportsGrid.php" ?>
<?php } ?>
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
