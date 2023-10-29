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
<?php if ($Page->patient_ip_number->Visible) { // patient_ip_number ?>
    <tr id="r_patient_ip_number"<?= $Page->patient_ip_number->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_patients_patient_ip_number"><?= $Page->patient_ip_number->caption() ?></span></td>
        <td data-name="patient_ip_number"<?= $Page->patient_ip_number->cellAttributes() ?>>
<span id="el_jdh_patients_patient_ip_number">
<span<?= $Page->patient_ip_number->viewAttributes() ?>>
<?= $Page->patient_ip_number->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->patient_name->Visible) { // patient_name ?>
    <tr id="r_patient_name"<?= $Page->patient_name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_patients_patient_name"><?= $Page->patient_name->caption() ?></span></td>
        <td data-name="patient_name"<?= $Page->patient_name->cellAttributes() ?>>
<span id="el_jdh_patients_patient_name">
<span<?= $Page->patient_name->viewAttributes() ?>>
<?= $Page->patient_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->patient_dob_year->Visible) { // patient_dob_year ?>
    <tr id="r_patient_dob_year"<?= $Page->patient_dob_year->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_patients_patient_dob_year"><?= $Page->patient_dob_year->caption() ?></span></td>
        <td data-name="patient_dob_year"<?= $Page->patient_dob_year->cellAttributes() ?>>
<span id="el_jdh_patients_patient_dob_year">
<span<?= $Page->patient_dob_year->viewAttributes() ?>>
<?= $Page->patient_dob_year->getViewValue() ?></span>
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
<?php if ($Page->time->Visible) { // time ?>
    <tr id="r_time"<?= $Page->time->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_patients_time"><?= $Page->time->caption() ?></span></td>
        <td data-name="time"<?= $Page->time->cellAttributes() ?>>
<span id="el_jdh_patients_time">
<span<?= $Page->time->viewAttributes() ?>>
<?= $Page->time->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->is_inpatient->Visible) { // is_inpatient ?>
    <tr id="r_is_inpatient"<?= $Page->is_inpatient->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_patients_is_inpatient"><?= $Page->is_inpatient->caption() ?></span></td>
        <td data-name="is_inpatient"<?= $Page->is_inpatient->cellAttributes() ?>>
<span id="el_jdh_patients_is_inpatient">
<span<?= $Page->is_inpatient->viewAttributes() ?>>
<?= $Page->is_inpatient->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<?php
    $Page->DetailPages->ValidKeys = explode(",", $Page->getCurrentDetailTable());
?>
<div class="ew-detail-pages"><!-- detail-pages -->
<div class="ew-nav<?= $Page->DetailPages->containerClasses() ?>" id="details_Page"><!-- tabs -->
    <ul class="<?= $Page->DetailPages->navClasses() ?>" role="tablist"><!-- .nav -->
<?php
    if (in_array("jdh_patient_visits", explode(",", $Page->getCurrentDetailTable())) && $jdh_patient_visits->DetailView) {
?>
        <li class="nav-item"><button class="<?= $Page->DetailPages->navLinkClasses("jdh_patient_visits") ?><?= $Page->DetailPages->activeClasses("jdh_patient_visits") ?>" data-bs-target="#tab_jdh_patient_visits" data-bs-toggle="tab" type="button" role="tab" aria-controls="tab_jdh_patient_visits" aria-selected="<?= JsonEncode($Page->DetailPages->isActive("jdh_patient_visits")) ?>"><?= $Language->tablePhrase("jdh_patient_visits", "TblCaption") ?></button></li>
<?php
    }
?>
<?php
    if (in_array("jdh_chief_complaints", explode(",", $Page->getCurrentDetailTable())) && $jdh_chief_complaints->DetailView) {
?>
        <li class="nav-item"><button class="<?= $Page->DetailPages->navLinkClasses("jdh_chief_complaints") ?><?= $Page->DetailPages->activeClasses("jdh_chief_complaints") ?>" data-bs-target="#tab_jdh_chief_complaints" data-bs-toggle="tab" type="button" role="tab" aria-controls="tab_jdh_chief_complaints" aria-selected="<?= JsonEncode($Page->DetailPages->isActive("jdh_chief_complaints")) ?>"><?= $Language->tablePhrase("jdh_chief_complaints", "TblCaption") ?></button></li>
<?php
    }
?>
<?php
    if (in_array("jdh_examination_findings", explode(",", $Page->getCurrentDetailTable())) && $jdh_examination_findings->DetailView) {
?>
        <li class="nav-item"><button class="<?= $Page->DetailPages->navLinkClasses("jdh_examination_findings") ?><?= $Page->DetailPages->activeClasses("jdh_examination_findings") ?>" data-bs-target="#tab_jdh_examination_findings" data-bs-toggle="tab" type="button" role="tab" aria-controls="tab_jdh_examination_findings" aria-selected="<?= JsonEncode($Page->DetailPages->isActive("jdh_examination_findings")) ?>"><?= $Language->tablePhrase("jdh_examination_findings", "TblCaption") ?></button></li>
<?php
    }
?>
<?php
    if (in_array("jdh_patient_cases", explode(",", $Page->getCurrentDetailTable())) && $jdh_patient_cases->DetailView) {
?>
        <li class="nav-item"><button class="<?= $Page->DetailPages->navLinkClasses("jdh_patient_cases") ?><?= $Page->DetailPages->activeClasses("jdh_patient_cases") ?>" data-bs-target="#tab_jdh_patient_cases" data-bs-toggle="tab" type="button" role="tab" aria-controls="tab_jdh_patient_cases" aria-selected="<?= JsonEncode($Page->DetailPages->isActive("jdh_patient_cases")) ?>"><?= $Language->tablePhrase("jdh_patient_cases", "TblCaption") ?></button></li>
<?php
    }
?>
<?php
    if (in_array("jdh_prescriptions", explode(",", $Page->getCurrentDetailTable())) && $jdh_prescriptions->DetailView) {
?>
        <li class="nav-item"><button class="<?= $Page->DetailPages->navLinkClasses("jdh_prescriptions") ?><?= $Page->DetailPages->activeClasses("jdh_prescriptions") ?>" data-bs-target="#tab_jdh_prescriptions" data-bs-toggle="tab" type="button" role="tab" aria-controls="tab_jdh_prescriptions" aria-selected="<?= JsonEncode($Page->DetailPages->isActive("jdh_prescriptions")) ?>"><?= $Language->tablePhrase("jdh_prescriptions", "TblCaption") ?></button></li>
<?php
    }
?>
<?php
    if (in_array("jdh_prescriptions_actions", explode(",", $Page->getCurrentDetailTable())) && $jdh_prescriptions_actions->DetailView) {
?>
        <li class="nav-item"><button class="<?= $Page->DetailPages->navLinkClasses("jdh_prescriptions_actions") ?><?= $Page->DetailPages->activeClasses("jdh_prescriptions_actions") ?>" data-bs-target="#tab_jdh_prescriptions_actions" data-bs-toggle="tab" type="button" role="tab" aria-controls="tab_jdh_prescriptions_actions" aria-selected="<?= JsonEncode($Page->DetailPages->isActive("jdh_prescriptions_actions")) ?>"><?= $Language->tablePhrase("jdh_prescriptions_actions", "TblCaption") ?></button></li>
<?php
    }
?>
<?php
    if (in_array("jdh_appointments", explode(",", $Page->getCurrentDetailTable())) && $jdh_appointments->DetailView) {
?>
        <li class="nav-item"><button class="<?= $Page->DetailPages->navLinkClasses("jdh_appointments") ?><?= $Page->DetailPages->activeClasses("jdh_appointments") ?>" data-bs-target="#tab_jdh_appointments" data-bs-toggle="tab" type="button" role="tab" aria-controls="tab_jdh_appointments" aria-selected="<?= JsonEncode($Page->DetailPages->isActive("jdh_appointments")) ?>"><?= $Language->tablePhrase("jdh_appointments", "TblCaption") ?></button></li>
<?php
    }
?>
<?php
    if (in_array("jdh_vitals", explode(",", $Page->getCurrentDetailTable())) && $jdh_vitals->DetailView) {
?>
        <li class="nav-item"><button class="<?= $Page->DetailPages->navLinkClasses("jdh_vitals") ?><?= $Page->DetailPages->activeClasses("jdh_vitals") ?>" data-bs-target="#tab_jdh_vitals" data-bs-toggle="tab" type="button" role="tab" aria-controls="tab_jdh_vitals" aria-selected="<?= JsonEncode($Page->DetailPages->isActive("jdh_vitals")) ?>"><?= $Language->tablePhrase("jdh_vitals", "TblCaption") ?></button></li>
<?php
    }
?>
    </ul><!-- /.nav -->
    <div class="<?= $Page->DetailPages->tabContentClasses() ?>"><!-- .tab-content -->
<?php
    if (in_array("jdh_patient_visits", explode(",", $Page->getCurrentDetailTable())) && $jdh_patient_visits->DetailView) {
?>
        <div class="<?= $Page->DetailPages->tabPaneClasses("jdh_patient_visits") ?><?= $Page->DetailPages->activeClasses("jdh_patient_visits") ?>" id="tab_jdh_patient_visits" role="tabpanel"><!-- page* -->
<?php include_once "JdhPatientVisitsGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
<?php
    if (in_array("jdh_chief_complaints", explode(",", $Page->getCurrentDetailTable())) && $jdh_chief_complaints->DetailView) {
?>
        <div class="<?= $Page->DetailPages->tabPaneClasses("jdh_chief_complaints") ?><?= $Page->DetailPages->activeClasses("jdh_chief_complaints") ?>" id="tab_jdh_chief_complaints" role="tabpanel"><!-- page* -->
<?php include_once "JdhChiefComplaintsGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
<?php
    if (in_array("jdh_examination_findings", explode(",", $Page->getCurrentDetailTable())) && $jdh_examination_findings->DetailView) {
?>
        <div class="<?= $Page->DetailPages->tabPaneClasses("jdh_examination_findings") ?><?= $Page->DetailPages->activeClasses("jdh_examination_findings") ?>" id="tab_jdh_examination_findings" role="tabpanel"><!-- page* -->
<?php include_once "JdhExaminationFindingsGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
<?php
    if (in_array("jdh_patient_cases", explode(",", $Page->getCurrentDetailTable())) && $jdh_patient_cases->DetailView) {
?>
        <div class="<?= $Page->DetailPages->tabPaneClasses("jdh_patient_cases") ?><?= $Page->DetailPages->activeClasses("jdh_patient_cases") ?>" id="tab_jdh_patient_cases" role="tabpanel"><!-- page* -->
<?php include_once "JdhPatientCasesGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
<?php
    if (in_array("jdh_prescriptions", explode(",", $Page->getCurrentDetailTable())) && $jdh_prescriptions->DetailView) {
?>
        <div class="<?= $Page->DetailPages->tabPaneClasses("jdh_prescriptions") ?><?= $Page->DetailPages->activeClasses("jdh_prescriptions") ?>" id="tab_jdh_prescriptions" role="tabpanel"><!-- page* -->
<?php include_once "JdhPrescriptionsGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
<?php
    if (in_array("jdh_prescriptions_actions", explode(",", $Page->getCurrentDetailTable())) && $jdh_prescriptions_actions->DetailView) {
?>
        <div class="<?= $Page->DetailPages->tabPaneClasses("jdh_prescriptions_actions") ?><?= $Page->DetailPages->activeClasses("jdh_prescriptions_actions") ?>" id="tab_jdh_prescriptions_actions" role="tabpanel"><!-- page* -->
<?php include_once "JdhPrescriptionsActionsGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
<?php
    if (in_array("jdh_appointments", explode(",", $Page->getCurrentDetailTable())) && $jdh_appointments->DetailView) {
?>
        <div class="<?= $Page->DetailPages->tabPaneClasses("jdh_appointments") ?><?= $Page->DetailPages->activeClasses("jdh_appointments") ?>" id="tab_jdh_appointments" role="tabpanel"><!-- page* -->
<?php include_once "JdhAppointmentsGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
<?php
    if (in_array("jdh_vitals", explode(",", $Page->getCurrentDetailTable())) && $jdh_vitals->DetailView) {
?>
        <div class="<?= $Page->DetailPages->tabPaneClasses("jdh_vitals") ?><?= $Page->DetailPages->activeClasses("jdh_vitals") ?>" id="tab_jdh_vitals" role="tabpanel"><!-- page* -->
<?php include_once "JdhVitalsGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
    </div><!-- /.tab-content -->
</div><!-- /tabs -->
</div><!-- /detail-pages -->
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
