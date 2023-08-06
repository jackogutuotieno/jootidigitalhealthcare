<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$JdhTestCostsList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_test_costs: currentTable } });
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
<input type="hidden" name="t" value="jdh_test_costs">
<?php if ($Page->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<div id="gmp_jdh_test_costs" class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>" style="<?= $Page->TableContainerStyle ?>">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit() || $Page->isMultiEdit()) { ?>
<table id="tbl_jdh_test_costslist" class="<?= $Page->TableClass ?>"><!-- .ew-table -->
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
<?php if ($Page->test_id->Visible) { // test_id ?>
        <th data-name="test_id" class="<?= $Page->test_id->headerCellClass() ?>"><div id="elh_jdh_test_costs_test_id" class="jdh_test_costs_test_id"><?= $Page->renderFieldHeader($Page->test_id) ?></div></th>
<?php } ?>
<?php if ($Page->test_category_id->Visible) { // test_category_id ?>
        <th data-name="test_category_id" class="<?= $Page->test_category_id->headerCellClass() ?>"><div id="elh_jdh_test_costs_test_category_id" class="jdh_test_costs_test_category_id"><?= $Page->renderFieldHeader($Page->test_category_id) ?></div></th>
<?php } ?>
<?php if ($Page->test_subcategory_id->Visible) { // test_subcategory_id ?>
        <th data-name="test_subcategory_id" class="<?= $Page->test_subcategory_id->headerCellClass() ?>"><div id="elh_jdh_test_costs_test_subcategory_id" class="jdh_test_costs_test_subcategory_id"><?= $Page->renderFieldHeader($Page->test_subcategory_id) ?></div></th>
<?php } ?>
<?php if ($Page->test_cost->Visible) { // test_cost ?>
        <th data-name="test_cost" class="<?= $Page->test_cost->headerCellClass() ?>"><div id="elh_jdh_test_costs_test_cost" class="jdh_test_costs_test_cost"><?= $Page->renderFieldHeader($Page->test_cost) ?></div></th>
<?php } ?>
<?php if ($Page->date_submitted->Visible) { // date_submitted ?>
        <th data-name="date_submitted" class="<?= $Page->date_submitted->headerCellClass() ?>"><div id="elh_jdh_test_costs_date_submitted" class="jdh_test_costs_date_submitted"><?= $Page->renderFieldHeader($Page->date_submitted) ?></div></th>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
        <th data-name="date_updated" class="<?= $Page->date_updated->headerCellClass() ?>"><div id="elh_jdh_test_costs_date_updated" class="jdh_test_costs_date_updated"><?= $Page->renderFieldHeader($Page->date_updated) ?></div></th>
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
    <?php if ($Page->test_id->Visible) { // test_id ?>
        <td data-name="test_id"<?= $Page->test_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_test_costs_test_id" class="el_jdh_test_costs_test_id">
<span<?= $Page->test_id->viewAttributes() ?>>
<?= $Page->test_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->test_category_id->Visible) { // test_category_id ?>
        <td data-name="test_category_id"<?= $Page->test_category_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_test_costs_test_category_id" class="el_jdh_test_costs_test_category_id">
<span<?= $Page->test_category_id->viewAttributes() ?>>
<?= $Page->test_category_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->test_subcategory_id->Visible) { // test_subcategory_id ?>
        <td data-name="test_subcategory_id"<?= $Page->test_subcategory_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_test_costs_test_subcategory_id" class="el_jdh_test_costs_test_subcategory_id">
<span<?= $Page->test_subcategory_id->viewAttributes() ?>>
<?= $Page->test_subcategory_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->test_cost->Visible) { // test_cost ?>
        <td data-name="test_cost"<?= $Page->test_cost->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_test_costs_test_cost" class="el_jdh_test_costs_test_cost">
<span<?= $Page->test_cost->viewAttributes() ?>>
<?= $Page->test_cost->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->date_submitted->Visible) { // date_submitted ?>
        <td data-name="date_submitted"<?= $Page->date_submitted->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_test_costs_date_submitted" class="el_jdh_test_costs_date_submitted">
<span<?= $Page->date_submitted->viewAttributes() ?>>
<?= $Page->date_submitted->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->date_updated->Visible) { // date_updated ?>
        <td data-name="date_updated"<?= $Page->date_updated->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_test_costs_date_updated" class="el_jdh_test_costs_date_updated">
<span<?= $Page->date_updated->viewAttributes() ?>>
<?= $Page->date_updated->getViewValue() ?></span>
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
    ew.addEventHandlers("jdh_test_costs");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
