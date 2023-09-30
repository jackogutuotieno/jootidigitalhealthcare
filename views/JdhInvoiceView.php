<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$JdhInvoiceView = &$Page;
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
<form name="fjdh_invoiceview" id="fjdh_invoiceview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_invoice: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fjdh_invoiceview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_invoiceview")
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
<input type="hidden" name="t" value="jdh_invoice">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->invoice_id->Visible) { // invoice_id ?>
    <tr id="r_invoice_id"<?= $Page->invoice_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_invoice_invoice_id"><?= $Page->invoice_id->caption() ?></span></td>
        <td data-name="invoice_id"<?= $Page->invoice_id->cellAttributes() ?>>
<span id="el_jdh_invoice_invoice_id">
<span<?= $Page->invoice_id->viewAttributes() ?>>
<?= $Page->invoice_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
    <tr id="r_patient_id"<?= $Page->patient_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_invoice_patient_id"><?= $Page->patient_id->caption() ?></span></td>
        <td data-name="patient_id"<?= $Page->patient_id->cellAttributes() ?>>
<span id="el_jdh_invoice_patient_id">
<span<?= $Page->patient_id->viewAttributes() ?>>
<?= $Page->patient_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->submitted_by_user_id->Visible) { // submitted_by_user_id ?>
    <tr id="r_submitted_by_user_id"<?= $Page->submitted_by_user_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_invoice_submitted_by_user_id"><?= $Page->submitted_by_user_id->caption() ?></span></td>
        <td data-name="submitted_by_user_id"<?= $Page->submitted_by_user_id->cellAttributes() ?>>
<span id="el_jdh_invoice_submitted_by_user_id">
<span<?= $Page->submitted_by_user_id->viewAttributes() ?>>
<?= $Page->submitted_by_user_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->invoice_date->Visible) { // invoice_date ?>
    <tr id="r_invoice_date"<?= $Page->invoice_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_invoice_invoice_date"><?= $Page->invoice_date->caption() ?></span></td>
        <td data-name="invoice_date"<?= $Page->invoice_date->cellAttributes() ?>>
<span id="el_jdh_invoice_invoice_date">
<span<?= $Page->invoice_date->viewAttributes() ?>>
<?= $Page->invoice_date->getViewValue() ?></span>
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
