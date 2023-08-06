<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$JdhPatientBillView = &$Page;
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
<form name="fjdh_patient_billview" id="fjdh_patient_billview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_patient_bill: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fjdh_patient_billview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_patient_billview")
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
<input type="hidden" name="t" value="jdh_patient_bill">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->bill_id->Visible) { // bill_id ?>
    <tr id="r_bill_id"<?= $Page->bill_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_patient_bill_bill_id"><?= $Page->bill_id->caption() ?></span></td>
        <td data-name="bill_id"<?= $Page->bill_id->cellAttributes() ?>>
<span id="el_jdh_patient_bill_bill_id">
<span<?= $Page->bill_id->viewAttributes() ?>>
<?= $Page->bill_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
    <tr id="r_patient_id"<?= $Page->patient_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_patient_bill_patient_id"><?= $Page->patient_id->caption() ?></span></td>
        <td data-name="patient_id"<?= $Page->patient_id->cellAttributes() ?>>
<span id="el_jdh_patient_bill_patient_id">
<span<?= $Page->patient_id->viewAttributes() ?>>
<?= $Page->patient_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->bill_description->Visible) { // bill_description ?>
    <tr id="r_bill_description"<?= $Page->bill_description->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_patient_bill_bill_description"><?= $Page->bill_description->caption() ?></span></td>
        <td data-name="bill_description"<?= $Page->bill_description->cellAttributes() ?>>
<span id="el_jdh_patient_bill_bill_description">
<span<?= $Page->bill_description->viewAttributes() ?>>
<?= $Page->bill_description->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->bill_date->Visible) { // bill_date ?>
    <tr id="r_bill_date"<?= $Page->bill_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_patient_bill_bill_date"><?= $Page->bill_date->caption() ?></span></td>
        <td data-name="bill_date"<?= $Page->bill_date->cellAttributes() ?>>
<span id="el_jdh_patient_bill_bill_date">
<span<?= $Page->bill_date->viewAttributes() ?>>
<?= $Page->bill_date->getViewValue() ?></span>
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
