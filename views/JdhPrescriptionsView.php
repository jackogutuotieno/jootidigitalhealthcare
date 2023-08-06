<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$JdhPrescriptionsView = &$Page;
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
<form name="fjdh_prescriptionsview" id="fjdh_prescriptionsview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_prescriptions: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fjdh_prescriptionsview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_prescriptionsview")
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
<input type="hidden" name="t" value="jdh_prescriptions">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->prescription_id->Visible) { // prescription_id ?>
    <tr id="r_prescription_id"<?= $Page->prescription_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_prescriptions_prescription_id"><?= $Page->prescription_id->caption() ?></span></td>
        <td data-name="prescription_id"<?= $Page->prescription_id->cellAttributes() ?>>
<span id="el_jdh_prescriptions_prescription_id">
<span<?= $Page->prescription_id->viewAttributes() ?>>
<?= $Page->prescription_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
    <tr id="r_patient_id"<?= $Page->patient_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_prescriptions_patient_id"><?= $Page->patient_id->caption() ?></span></td>
        <td data-name="patient_id"<?= $Page->patient_id->cellAttributes() ?>>
<span id="el_jdh_prescriptions_patient_id">
<span<?= $Page->patient_id->viewAttributes() ?>>
<?= $Page->patient_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->prescription_title->Visible) { // prescription_title ?>
    <tr id="r_prescription_title"<?= $Page->prescription_title->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_prescriptions_prescription_title"><?= $Page->prescription_title->caption() ?></span></td>
        <td data-name="prescription_title"<?= $Page->prescription_title->cellAttributes() ?>>
<span id="el_jdh_prescriptions_prescription_title">
<span<?= $Page->prescription_title->viewAttributes() ?>>
<?= $Page->prescription_title->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->medicine_id->Visible) { // medicine_id ?>
    <tr id="r_medicine_id"<?= $Page->medicine_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_prescriptions_medicine_id"><?= $Page->medicine_id->caption() ?></span></td>
        <td data-name="medicine_id"<?= $Page->medicine_id->cellAttributes() ?>>
<span id="el_jdh_prescriptions_medicine_id">
<span<?= $Page->medicine_id->viewAttributes() ?>>
<?= $Page->medicine_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tabs->Visible) { // tabs ?>
    <tr id="r_tabs"<?= $Page->tabs->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_prescriptions_tabs"><?= $Page->tabs->caption() ?></span></td>
        <td data-name="tabs"<?= $Page->tabs->cellAttributes() ?>>
<span id="el_jdh_prescriptions_tabs">
<span<?= $Page->tabs->viewAttributes() ?>>
<?= $Page->tabs->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->frequency->Visible) { // frequency ?>
    <tr id="r_frequency"<?= $Page->frequency->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_prescriptions_frequency"><?= $Page->frequency->caption() ?></span></td>
        <td data-name="frequency"<?= $Page->frequency->cellAttributes() ?>>
<span id="el_jdh_prescriptions_frequency">
<span<?= $Page->frequency->viewAttributes() ?>>
<?= $Page->frequency->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->prescription_time->Visible) { // prescription_time ?>
    <tr id="r_prescription_time"<?= $Page->prescription_time->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_prescriptions_prescription_time"><?= $Page->prescription_time->caption() ?></span></td>
        <td data-name="prescription_time"<?= $Page->prescription_time->cellAttributes() ?>>
<span id="el_jdh_prescriptions_prescription_time">
<span<?= $Page->prescription_time->viewAttributes() ?>>
<?= $Page->prescription_time->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->prescription_date->Visible) { // prescription_date ?>
    <tr id="r_prescription_date"<?= $Page->prescription_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_prescriptions_prescription_date"><?= $Page->prescription_date->caption() ?></span></td>
        <td data-name="prescription_date"<?= $Page->prescription_date->cellAttributes() ?>>
<span id="el_jdh_prescriptions_prescription_date">
<span<?= $Page->prescription_date->viewAttributes() ?>>
<?= $Page->prescription_date->getViewValue() ?></span>
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
