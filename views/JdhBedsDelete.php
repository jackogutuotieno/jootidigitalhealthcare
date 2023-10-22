<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$JdhBedsDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_beds: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fjdh_bedsdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_bedsdelete")
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
<form name="fjdh_bedsdelete" id="fjdh_bedsdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jdh_beds">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_jdh_beds_id" class="jdh_beds_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->facility_id->Visible) { // facility_id ?>
        <th class="<?= $Page->facility_id->headerCellClass() ?>"><span id="elh_jdh_beds_facility_id" class="jdh_beds_facility_id"><?= $Page->facility_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ward_id->Visible) { // ward_id ?>
        <th class="<?= $Page->ward_id->headerCellClass() ?>"><span id="elh_jdh_beds_ward_id" class="jdh_beds_ward_id"><?= $Page->ward_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->bed_number->Visible) { // bed_number ?>
        <th class="<?= $Page->bed_number->headerCellClass() ?>"><span id="elh_jdh_beds_bed_number" class="jdh_beds_bed_number"><?= $Page->bed_number->caption() ?></span></th>
<?php } ?>
<?php if ($Page->assigned->Visible) { // assigned ?>
        <th class="<?= $Page->assigned->headerCellClass() ?>"><span id="elh_jdh_beds_assigned" class="jdh_beds_assigned"><?= $Page->assigned->caption() ?></span></th>
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
<?php if ($Page->id->Visible) { // id ?>
        <td<?= $Page->id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_beds_id" class="el_jdh_beds_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->facility_id->Visible) { // facility_id ?>
        <td<?= $Page->facility_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_beds_facility_id" class="el_jdh_beds_facility_id">
<span<?= $Page->facility_id->viewAttributes() ?>>
<?= $Page->facility_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ward_id->Visible) { // ward_id ?>
        <td<?= $Page->ward_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_beds_ward_id" class="el_jdh_beds_ward_id">
<span<?= $Page->ward_id->viewAttributes() ?>>
<?= $Page->ward_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->bed_number->Visible) { // bed_number ?>
        <td<?= $Page->bed_number->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_beds_bed_number" class="el_jdh_beds_bed_number">
<span<?= $Page->bed_number->viewAttributes() ?>>
<?= $Page->bed_number->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->assigned->Visible) { // assigned ?>
        <td<?= $Page->assigned->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_beds_assigned" class="el_jdh_beds_assigned">
<span<?= $Page->assigned->viewAttributes() ?>>
<div class="form-check d-inline-block">
    <input type="checkbox" id="x_assigned_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->assigned->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->assigned->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_assigned_<?= $Page->RowCount ?>"></label>
</div></span>
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
