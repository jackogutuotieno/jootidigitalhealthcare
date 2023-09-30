<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$JdhInvoiceDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_invoice: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fjdh_invoicedelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_invoicedelete")
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
<form name="fjdh_invoicedelete" id="fjdh_invoicedelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jdh_invoice">
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
<?php if ($Page->invoice_id->Visible) { // invoice_id ?>
        <th class="<?= $Page->invoice_id->headerCellClass() ?>"><span id="elh_jdh_invoice_invoice_id" class="jdh_invoice_invoice_id"><?= $Page->invoice_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
        <th class="<?= $Page->patient_id->headerCellClass() ?>"><span id="elh_jdh_invoice_patient_id" class="jdh_invoice_patient_id"><?= $Page->patient_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->submitted_by_user_id->Visible) { // submitted_by_user_id ?>
        <th class="<?= $Page->submitted_by_user_id->headerCellClass() ?>"><span id="elh_jdh_invoice_submitted_by_user_id" class="jdh_invoice_submitted_by_user_id"><?= $Page->submitted_by_user_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->invoice_date->Visible) { // invoice_date ?>
        <th class="<?= $Page->invoice_date->headerCellClass() ?>"><span id="elh_jdh_invoice_invoice_date" class="jdh_invoice_invoice_date"><?= $Page->invoice_date->caption() ?></span></th>
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
<?php if ($Page->invoice_id->Visible) { // invoice_id ?>
        <td<?= $Page->invoice_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_invoice_invoice_id" class="el_jdh_invoice_invoice_id">
<span<?= $Page->invoice_id->viewAttributes() ?>>
<?= $Page->invoice_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
        <td<?= $Page->patient_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_invoice_patient_id" class="el_jdh_invoice_patient_id">
<span<?= $Page->patient_id->viewAttributes() ?>>
<?= $Page->patient_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->submitted_by_user_id->Visible) { // submitted_by_user_id ?>
        <td<?= $Page->submitted_by_user_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_invoice_submitted_by_user_id" class="el_jdh_invoice_submitted_by_user_id">
<span<?= $Page->submitted_by_user_id->viewAttributes() ?>>
<?= $Page->submitted_by_user_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->invoice_date->Visible) { // invoice_date ?>
        <td<?= $Page->invoice_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_invoice_invoice_date" class="el_jdh_invoice_invoice_date">
<span<?= $Page->invoice_date->viewAttributes() ?>>
<?= $Page->invoice_date->getViewValue() ?></span>
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
