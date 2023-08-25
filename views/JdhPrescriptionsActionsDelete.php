<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$JdhPrescriptionsActionsDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_prescriptions_actions: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fjdh_prescriptions_actionsdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_prescriptions_actionsdelete")
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
<form name="fjdh_prescriptions_actionsdelete" id="fjdh_prescriptions_actionsdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jdh_prescriptions_actions">
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
<?php if ($Page->medicine_id->Visible) { // medicine_id ?>
        <th class="<?= $Page->medicine_id->headerCellClass() ?>"><span id="elh_jdh_prescriptions_actions_medicine_id" class="jdh_prescriptions_actions_medicine_id"><?= $Page->medicine_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
        <th class="<?= $Page->patient_id->headerCellClass() ?>"><span id="elh_jdh_prescriptions_actions_patient_id" class="jdh_prescriptions_actions_patient_id"><?= $Page->patient_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->units_given->Visible) { // units_given ?>
        <th class="<?= $Page->units_given->headerCellClass() ?>"><span id="elh_jdh_prescriptions_actions_units_given" class="jdh_prescriptions_actions_units_given"><?= $Page->units_given->caption() ?></span></th>
<?php } ?>
<?php if ($Page->submission_date->Visible) { // submission_date ?>
        <th class="<?= $Page->submission_date->headerCellClass() ?>"><span id="elh_jdh_prescriptions_actions_submission_date" class="jdh_prescriptions_actions_submission_date"><?= $Page->submission_date->caption() ?></span></th>
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
<?php if ($Page->medicine_id->Visible) { // medicine_id ?>
        <td<?= $Page->medicine_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_prescriptions_actions_medicine_id" class="el_jdh_prescriptions_actions_medicine_id">
<span<?= $Page->medicine_id->viewAttributes() ?>>
<?= $Page->medicine_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
        <td<?= $Page->patient_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_prescriptions_actions_patient_id" class="el_jdh_prescriptions_actions_patient_id">
<span<?= $Page->patient_id->viewAttributes() ?>>
<?= $Page->patient_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->units_given->Visible) { // units_given ?>
        <td<?= $Page->units_given->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_prescriptions_actions_units_given" class="el_jdh_prescriptions_actions_units_given">
<span<?= $Page->units_given->viewAttributes() ?>>
<?= $Page->units_given->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->submission_date->Visible) { // submission_date ?>
        <td<?= $Page->submission_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_prescriptions_actions_submission_date" class="el_jdh_prescriptions_actions_submission_date">
<span<?= $Page->submission_date->viewAttributes() ?>>
<?= $Page->submission_date->getViewValue() ?></span>
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
