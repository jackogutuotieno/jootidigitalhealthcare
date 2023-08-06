<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$JdhTestCostsDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_test_costs: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fjdh_test_costsdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_test_costsdelete")
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
<form name="fjdh_test_costsdelete" id="fjdh_test_costsdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jdh_test_costs">
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
<?php if ($Page->test_id->Visible) { // test_id ?>
        <th class="<?= $Page->test_id->headerCellClass() ?>"><span id="elh_jdh_test_costs_test_id" class="jdh_test_costs_test_id"><?= $Page->test_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->test_category_id->Visible) { // test_category_id ?>
        <th class="<?= $Page->test_category_id->headerCellClass() ?>"><span id="elh_jdh_test_costs_test_category_id" class="jdh_test_costs_test_category_id"><?= $Page->test_category_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->test_subcategory_id->Visible) { // test_subcategory_id ?>
        <th class="<?= $Page->test_subcategory_id->headerCellClass() ?>"><span id="elh_jdh_test_costs_test_subcategory_id" class="jdh_test_costs_test_subcategory_id"><?= $Page->test_subcategory_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->test_cost->Visible) { // test_cost ?>
        <th class="<?= $Page->test_cost->headerCellClass() ?>"><span id="elh_jdh_test_costs_test_cost" class="jdh_test_costs_test_cost"><?= $Page->test_cost->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_submitted->Visible) { // date_submitted ?>
        <th class="<?= $Page->date_submitted->headerCellClass() ?>"><span id="elh_jdh_test_costs_date_submitted" class="jdh_test_costs_date_submitted"><?= $Page->date_submitted->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
        <th class="<?= $Page->date_updated->headerCellClass() ?>"><span id="elh_jdh_test_costs_date_updated" class="jdh_test_costs_date_updated"><?= $Page->date_updated->caption() ?></span></th>
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
<?php if ($Page->test_id->Visible) { // test_id ?>
        <td<?= $Page->test_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_test_costs_test_id" class="el_jdh_test_costs_test_id">
<span<?= $Page->test_id->viewAttributes() ?>>
<?= $Page->test_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->test_category_id->Visible) { // test_category_id ?>
        <td<?= $Page->test_category_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_test_costs_test_category_id" class="el_jdh_test_costs_test_category_id">
<span<?= $Page->test_category_id->viewAttributes() ?>>
<?= $Page->test_category_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->test_subcategory_id->Visible) { // test_subcategory_id ?>
        <td<?= $Page->test_subcategory_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_test_costs_test_subcategory_id" class="el_jdh_test_costs_test_subcategory_id">
<span<?= $Page->test_subcategory_id->viewAttributes() ?>>
<?= $Page->test_subcategory_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->test_cost->Visible) { // test_cost ?>
        <td<?= $Page->test_cost->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_test_costs_test_cost" class="el_jdh_test_costs_test_cost">
<span<?= $Page->test_cost->viewAttributes() ?>>
<?= $Page->test_cost->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->date_submitted->Visible) { // date_submitted ?>
        <td<?= $Page->date_submitted->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_test_costs_date_submitted" class="el_jdh_test_costs_date_submitted">
<span<?= $Page->date_submitted->viewAttributes() ?>>
<?= $Page->date_submitted->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
        <td<?= $Page->date_updated->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_test_costs_date_updated" class="el_jdh_test_costs_date_updated">
<span<?= $Page->date_updated->viewAttributes() ?>>
<?= $Page->date_updated->getViewValue() ?></span>
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
