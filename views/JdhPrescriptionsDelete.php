<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$JdhPrescriptionsDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_prescriptions: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fjdh_prescriptionsdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_prescriptionsdelete")
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
<form name="fjdh_prescriptionsdelete" id="fjdh_prescriptionsdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jdh_prescriptions">
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
<?php if ($Page->prescription_id->Visible) { // prescription_id ?>
        <th class="<?= $Page->prescription_id->headerCellClass() ?>"><span id="elh_jdh_prescriptions_prescription_id" class="jdh_prescriptions_prescription_id"><?= $Page->prescription_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
        <th class="<?= $Page->patient_id->headerCellClass() ?>"><span id="elh_jdh_prescriptions_patient_id" class="jdh_prescriptions_patient_id"><?= $Page->patient_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->prescription_title->Visible) { // prescription_title ?>
        <th class="<?= $Page->prescription_title->headerCellClass() ?>"><span id="elh_jdh_prescriptions_prescription_title" class="jdh_prescriptions_prescription_title"><?= $Page->prescription_title->caption() ?></span></th>
<?php } ?>
<?php if ($Page->medicine_id->Visible) { // medicine_id ?>
        <th class="<?= $Page->medicine_id->headerCellClass() ?>"><span id="elh_jdh_prescriptions_medicine_id" class="jdh_prescriptions_medicine_id"><?= $Page->medicine_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tabs->Visible) { // tabs ?>
        <th class="<?= $Page->tabs->headerCellClass() ?>"><span id="elh_jdh_prescriptions_tabs" class="jdh_prescriptions_tabs"><?= $Page->tabs->caption() ?></span></th>
<?php } ?>
<?php if ($Page->frequency->Visible) { // frequency ?>
        <th class="<?= $Page->frequency->headerCellClass() ?>"><span id="elh_jdh_prescriptions_frequency" class="jdh_prescriptions_frequency"><?= $Page->frequency->caption() ?></span></th>
<?php } ?>
<?php if ($Page->prescription_time->Visible) { // prescription_time ?>
        <th class="<?= $Page->prescription_time->headerCellClass() ?>"><span id="elh_jdh_prescriptions_prescription_time" class="jdh_prescriptions_prescription_time"><?= $Page->prescription_time->caption() ?></span></th>
<?php } ?>
<?php if ($Page->prescription_date->Visible) { // prescription_date ?>
        <th class="<?= $Page->prescription_date->headerCellClass() ?>"><span id="elh_jdh_prescriptions_prescription_date" class="jdh_prescriptions_prescription_date"><?= $Page->prescription_date->caption() ?></span></th>
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
<?php if ($Page->prescription_id->Visible) { // prescription_id ?>
        <td<?= $Page->prescription_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_prescriptions_prescription_id" class="el_jdh_prescriptions_prescription_id">
<span<?= $Page->prescription_id->viewAttributes() ?>>
<?= $Page->prescription_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
        <td<?= $Page->patient_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_prescriptions_patient_id" class="el_jdh_prescriptions_patient_id">
<span<?= $Page->patient_id->viewAttributes() ?>>
<?= $Page->patient_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->prescription_title->Visible) { // prescription_title ?>
        <td<?= $Page->prescription_title->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_prescriptions_prescription_title" class="el_jdh_prescriptions_prescription_title">
<span<?= $Page->prescription_title->viewAttributes() ?>>
<?= $Page->prescription_title->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->medicine_id->Visible) { // medicine_id ?>
        <td<?= $Page->medicine_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_prescriptions_medicine_id" class="el_jdh_prescriptions_medicine_id">
<span<?= $Page->medicine_id->viewAttributes() ?>>
<?= $Page->medicine_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tabs->Visible) { // tabs ?>
        <td<?= $Page->tabs->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_prescriptions_tabs" class="el_jdh_prescriptions_tabs">
<span<?= $Page->tabs->viewAttributes() ?>>
<?= $Page->tabs->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->frequency->Visible) { // frequency ?>
        <td<?= $Page->frequency->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_prescriptions_frequency" class="el_jdh_prescriptions_frequency">
<span<?= $Page->frequency->viewAttributes() ?>>
<?= $Page->frequency->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->prescription_time->Visible) { // prescription_time ?>
        <td<?= $Page->prescription_time->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_prescriptions_prescription_time" class="el_jdh_prescriptions_prescription_time">
<span<?= $Page->prescription_time->viewAttributes() ?>>
<?= $Page->prescription_time->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->prescription_date->Visible) { // prescription_date ?>
        <td<?= $Page->prescription_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_prescriptions_prescription_date" class="el_jdh_prescriptions_prescription_date">
<span<?= $Page->prescription_date->viewAttributes() ?>>
<?= $Page->prescription_date->getViewValue() ?></span>
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
