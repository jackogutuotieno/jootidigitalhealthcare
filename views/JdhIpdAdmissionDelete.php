<?php

namespace PHPMaker2024\jootidigitalhealthcare;

// Page object
$JdhIpdAdmissionDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_ipd_admission: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fjdh_ipd_admissiondelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_ipd_admissiondelete")
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
<form name="fjdh_ipd_admissiondelete" id="fjdh_ipd_admissiondelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jdh_ipd_admission">
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
<?php if ($Page->id->Visible) { // id ?>
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_jdh_ipd_admission_id" class="jdh_ipd_admission_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->unit_id->Visible) { // unit_id ?>
        <th class="<?= $Page->unit_id->headerCellClass() ?>"><span id="elh_jdh_ipd_admission_unit_id" class="jdh_ipd_admission_unit_id"><?= $Page->unit_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ward_id->Visible) { // ward_id ?>
        <th class="<?= $Page->ward_id->headerCellClass() ?>"><span id="elh_jdh_ipd_admission_ward_id" class="jdh_ipd_admission_ward_id"><?= $Page->ward_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->bed_id->Visible) { // bed_id ?>
        <th class="<?= $Page->bed_id->headerCellClass() ?>"><span id="elh_jdh_ipd_admission_bed_id" class="jdh_ipd_admission_bed_id"><?= $Page->bed_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
        <th class="<?= $Page->patient_id->headerCellClass() ?>"><span id="elh_jdh_ipd_admission_patient_id" class="jdh_ipd_admission_patient_id"><?= $Page->patient_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_added->Visible) { // date_added ?>
        <th class="<?= $Page->date_added->headerCellClass() ?>"><span id="elh_jdh_ipd_admission_date_added" class="jdh_ipd_admission_date_added"><?= $Page->date_added->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
        <th class="<?= $Page->date_updated->headerCellClass() ?>"><span id="elh_jdh_ipd_admission_date_updated" class="jdh_ipd_admission_date_updated"><?= $Page->date_updated->caption() ?></span></th>
<?php } ?>
    </tr>
    </thead>
    <tbody>
<?php
$Page->RecordCount = 0;
$i = 0;
while ($Page->fetch()) {
    $Page->RecordCount++;
    $Page->RowCount++;

    // Set row properties
    $Page->resetAttributes();
    $Page->RowType = RowType::VIEW; // View

    // Get the field contents
    $Page->loadRowValues($Page->CurrentRow);

    // Render row
    $Page->renderRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php if ($Page->id->Visible) { // id ?>
        <td<?= $Page->id->cellAttributes() ?>>
<span id="">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->unit_id->Visible) { // unit_id ?>
        <td<?= $Page->unit_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->unit_id->viewAttributes() ?>>
<?= $Page->unit_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ward_id->Visible) { // ward_id ?>
        <td<?= $Page->ward_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->ward_id->viewAttributes() ?>>
<?= $Page->ward_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->bed_id->Visible) { // bed_id ?>
        <td<?= $Page->bed_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->bed_id->viewAttributes() ?>>
<?= $Page->bed_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
        <td<?= $Page->patient_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->patient_id->viewAttributes() ?>>
<?= $Page->patient_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->date_added->Visible) { // date_added ?>
        <td<?= $Page->date_added->cellAttributes() ?>>
<span id="">
<span<?= $Page->date_added->viewAttributes() ?>>
<?= $Page->date_added->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
        <td<?= $Page->date_updated->cellAttributes() ?>>
<span id="">
<span<?= $Page->date_updated->viewAttributes() ?>>
<?= $Page->date_updated->getViewValue() ?></span>
</span>
</td>
<?php } ?>
    </tr>
<?php
}
$Page->Recordset?->free();
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
