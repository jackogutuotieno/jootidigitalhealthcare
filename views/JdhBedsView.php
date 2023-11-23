<?php

namespace PHPMaker2024\jootidigitalhealthcare;

// Page object
$JdhBedsView = &$Page;
?>
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
<form name="fjdh_bedsview" id="fjdh_bedsview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_beds: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fjdh_bedsview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_bedsview")
        .setPageId("view")
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
<?php } ?>
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jdh_beds">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_beds_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_jdh_beds_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->facility_id->Visible) { // facility_id ?>
    <tr id="r_facility_id"<?= $Page->facility_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_beds_facility_id"><?= $Page->facility_id->caption() ?></span></td>
        <td data-name="facility_id"<?= $Page->facility_id->cellAttributes() ?>>
<span id="el_jdh_beds_facility_id">
<span<?= $Page->facility_id->viewAttributes() ?>>
<?= $Page->facility_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ward_id->Visible) { // ward_id ?>
    <tr id="r_ward_id"<?= $Page->ward_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_beds_ward_id"><?= $Page->ward_id->caption() ?></span></td>
        <td data-name="ward_id"<?= $Page->ward_id->cellAttributes() ?>>
<span id="el_jdh_beds_ward_id">
<span<?= $Page->ward_id->viewAttributes() ?>>
<?= $Page->ward_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->bed_number->Visible) { // bed_number ?>
    <tr id="r_bed_number"<?= $Page->bed_number->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_beds_bed_number"><?= $Page->bed_number->caption() ?></span></td>
        <td data-name="bed_number"<?= $Page->bed_number->cellAttributes() ?>>
<span id="el_jdh_beds_bed_number">
<span<?= $Page->bed_number->viewAttributes() ?>>
<?= $Page->bed_number->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->assigned->Visible) { // assigned ?>
    <tr id="r_assigned"<?= $Page->assigned->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_beds_assigned"><?= $Page->assigned->caption() ?></span></td>
        <td data-name="assigned"<?= $Page->assigned->cellAttributes() ?>>
<span id="el_jdh_beds_assigned">
<span<?= $Page->assigned->viewAttributes() ?>>
<i class="fa-regular fa-square<?php if (ConvertToBool($Page->assigned->CurrentValue)) { ?>-check<?php } ?> ew-icon ew-boolean"></i>
</span>
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
