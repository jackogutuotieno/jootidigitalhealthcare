<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$JdhPharmacyIncomeView = &$Page;
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
<form name="fjdh_pharmacy_incomeview" id="fjdh_pharmacy_incomeview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_pharmacy_income: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fjdh_pharmacy_incomeview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_pharmacy_incomeview")
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
<input type="hidden" name="t" value="jdh_pharmacy_income">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->patient_id->Visible) { // patient_id ?>
    <tr id="r_patient_id"<?= $Page->patient_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_pharmacy_income_patient_id"><?= $Page->patient_id->caption() ?></span></td>
        <td data-name="patient_id"<?= $Page->patient_id->cellAttributes() ?>>
<span id="el_jdh_pharmacy_income_patient_id">
<span<?= $Page->patient_id->viewAttributes() ?>>
<?= $Page->patient_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->patient_name->Visible) { // patient_name ?>
    <tr id="r_patient_name"<?= $Page->patient_name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_pharmacy_income_patient_name"><?= $Page->patient_name->caption() ?></span></td>
        <td data-name="patient_name"<?= $Page->patient_name->cellAttributes() ?>>
<span id="el_jdh_pharmacy_income_patient_name">
<span<?= $Page->patient_name->viewAttributes() ?>>
<?= $Page->patient_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
    <tr id="r_name"<?= $Page->name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_pharmacy_income_name"><?= $Page->name->caption() ?></span></td>
        <td data-name="name"<?= $Page->name->cellAttributes() ?>>
<span id="el_jdh_pharmacy_income_name">
<span<?= $Page->name->viewAttributes() ?>>
<?= $Page->name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->selling_price->Visible) { // selling_price ?>
    <tr id="r_selling_price"<?= $Page->selling_price->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_pharmacy_income_selling_price"><?= $Page->selling_price->caption() ?></span></td>
        <td data-name="selling_price"<?= $Page->selling_price->cellAttributes() ?>>
<span id="el_jdh_pharmacy_income_selling_price">
<span<?= $Page->selling_price->viewAttributes() ?>>
<?= $Page->selling_price->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->units_available->Visible) { // units_available ?>
    <tr id="r_units_available"<?= $Page->units_available->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_pharmacy_income_units_available"><?= $Page->units_available->caption() ?></span></td>
        <td data-name="units_available"<?= $Page->units_available->cellAttributes() ?>>
<span id="el_jdh_pharmacy_income_units_available">
<span<?= $Page->units_available->viewAttributes() ?>>
<?= $Page->units_available->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->units_given->Visible) { // units_given ?>
    <tr id="r_units_given"<?= $Page->units_given->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_pharmacy_income_units_given"><?= $Page->units_given->caption() ?></span></td>
        <td data-name="units_given"<?= $Page->units_given->cellAttributes() ?>>
<span id="el_jdh_pharmacy_income_units_given">
<span<?= $Page->units_given->viewAttributes() ?>>
<?= $Page->units_given->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->units_remaining->Visible) { // units_remaining ?>
    <tr id="r_units_remaining"<?= $Page->units_remaining->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_pharmacy_income_units_remaining"><?= $Page->units_remaining->caption() ?></span></td>
        <td data-name="units_remaining"<?= $Page->units_remaining->cellAttributes() ?>>
<span id="el_jdh_pharmacy_income_units_remaining">
<span<?= $Page->units_remaining->viewAttributes() ?>>
<?= $Page->units_remaining->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->submission_date->Visible) { // submission_date ?>
    <tr id="r_submission_date"<?= $Page->submission_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_pharmacy_income_submission_date"><?= $Page->submission_date->caption() ?></span></td>
        <td data-name="submission_date"<?= $Page->submission_date->cellAttributes() ?>>
<span id="el_jdh_pharmacy_income_submission_date">
<span<?= $Page->submission_date->viewAttributes() ?>>
<?= $Page->submission_date->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->line_total_cost->Visible) { // line_total_cost ?>
    <tr id="r_line_total_cost"<?= $Page->line_total_cost->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_pharmacy_income_line_total_cost"><?= $Page->line_total_cost->caption() ?></span></td>
        <td data-name="line_total_cost"<?= $Page->line_total_cost->cellAttributes() ?>>
<span id="el_jdh_pharmacy_income_line_total_cost">
<span<?= $Page->line_total_cost->viewAttributes() ?>>
<?= $Page->line_total_cost->getViewValue() ?></span>
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
