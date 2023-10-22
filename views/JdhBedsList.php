<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$JdhBedsList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_beds: currentTable } });
var currentPageID = ew.PAGE_ID = "list";
var currentForm;
var <?= $Page->FormName ?>;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("<?= $Page->FormName ?>")
        .setPageId("list")
        .setSubmitWithFetch(<?= $Page->UseAjaxActions ? "true" : "false" ?>)
        .setFormKeyCountName("<?= $Page->FormKeyCountName ?>")
        .build();
    window[form.id] = form;
    currentForm = form;
    loadjs.done(form.id);
});
</script>
<script>
window.Tabulator || loadjs([
    ew.PATH_BASE + "js/tabulator.min.js?v=19.0.15",
    ew.PATH_BASE + "css/<?= CssFile("tabulator_bootstrap5.css") ?>?v=19.0.15"
], "import");
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($Page->TotalRecords > 0 && $Page->ExportOptions->visible()) { ?>
<?php $Page->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->ImportOptions->visible()) { ?>
<?php $Page->ImportOptions->render("body") ?>
<?php } ?>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="list<?= ($Page->TotalRecords == 0 && !$Page->isAdd()) ? " ew-no-record" : "" ?>">
<div id="ew-list">
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?= $Page->isAddOrEdit() ? " ew-grid-add-edit" : "" ?> <?= $Page->TableGridClass ?>">
<form name="<?= $Page->FormName ?>" id="<?= $Page->FormName ?>" class="ew-form ew-list-form" action="<?= $Page->PageAction ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jdh_beds">
<?php if ($Page->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<div id="gmp_jdh_beds" class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>" style="<?= $Page->TableContainerStyle ?>">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit() || $Page->isMultiEdit()) { ?>
<table id="tbl_jdh_bedslist" class="<?= $Page->TableClass ?>"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Page->RowType = ROWTYPE_HEADER;

// Render list options
$Page->renderListOptions();

// Render list options (header, left)
$Page->ListOptions->render("header", "left");
?>
<?php if ($Page->id->Visible) { // id ?>
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div id="elh_jdh_beds_id" class="jdh_beds_id"><?= $Page->renderFieldHeader($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->facility_id->Visible) { // facility_id ?>
        <th data-name="facility_id" class="<?= $Page->facility_id->headerCellClass() ?>"><div id="elh_jdh_beds_facility_id" class="jdh_beds_facility_id"><?= $Page->renderFieldHeader($Page->facility_id) ?></div></th>
<?php } ?>
<?php if ($Page->ward_id->Visible) { // ward_id ?>
        <th data-name="ward_id" class="<?= $Page->ward_id->headerCellClass() ?>"><div id="elh_jdh_beds_ward_id" class="jdh_beds_ward_id"><?= $Page->renderFieldHeader($Page->ward_id) ?></div></th>
<?php } ?>
<?php if ($Page->bed_number->Visible) { // bed_number ?>
        <th data-name="bed_number" class="<?= $Page->bed_number->headerCellClass() ?>"><div id="elh_jdh_beds_bed_number" class="jdh_beds_bed_number"><?= $Page->renderFieldHeader($Page->bed_number) ?></div></th>
<?php } ?>
<?php if ($Page->assigned->Visible) { // assigned ?>
        <th data-name="assigned" class="<?= $Page->assigned->headerCellClass() ?>"><div id="elh_jdh_beds_assigned" class="jdh_beds_assigned"><?= $Page->renderFieldHeader($Page->assigned) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Page->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody data-page="<?= $Page->getPageNumber() ?>">
<?php
$Page->setupGrid();
while ($Page->RecordCount < $Page->StopRecord) {
    $Page->RecordCount++;
    if ($Page->RecordCount >= $Page->StartRecord) {
        $Page->setupRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowCount);
?>
    <?php if ($Page->id->Visible) { // id ?>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_beds_id" class="el_jdh_beds_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->facility_id->Visible) { // facility_id ?>
        <td data-name="facility_id"<?= $Page->facility_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_beds_facility_id" class="el_jdh_beds_facility_id">
<span<?= $Page->facility_id->viewAttributes() ?>>
<?= $Page->facility_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ward_id->Visible) { // ward_id ?>
        <td data-name="ward_id"<?= $Page->ward_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_beds_ward_id" class="el_jdh_beds_ward_id">
<span<?= $Page->ward_id->viewAttributes() ?>>
<?= $Page->ward_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->bed_number->Visible) { // bed_number ?>
        <td data-name="bed_number"<?= $Page->bed_number->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_beds_bed_number" class="el_jdh_beds_bed_number">
<span<?= $Page->bed_number->viewAttributes() ?>>
<?= $Page->bed_number->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->assigned->Visible) { // assigned ?>
        <td data-name="assigned"<?= $Page->assigned->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_beds_assigned" class="el_jdh_beds_assigned">
<span<?= $Page->assigned->viewAttributes() ?>>
<div class="form-check d-inline-block">
    <input type="checkbox" id="x_assigned_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->assigned->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->assigned->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_assigned_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowCount);
?>
    </tr>
<?php
    }
    if (!$Page->isGridAdd()) {
        $Page->Recordset->moveNext();
    }
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$Page->CurrentAction && !$Page->UseAjaxActions) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php
// Close recordset
if ($Page->Recordset) {
    $Page->Recordset->close();
}
?>
<?php if (!$Page->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Page->isGridAdd() && !($Page->isGridEdit() && $Page->ModalGridEdit) && !$Page->isMultiEdit()) { ?>
<?= $Page->Pager->render() ?>
<?php } ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body", "bottom") ?>
</div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } else { ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
<?php } ?>
</div>
</main>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("jdh_beds");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
