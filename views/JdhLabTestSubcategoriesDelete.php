<?php

namespace PHPMaker2024\jootidigitalhealthcare;

// Page object
$JdhLabTestSubcategoriesDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_lab_test_subcategories: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fjdh_lab_test_subcategoriesdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_lab_test_subcategoriesdelete")
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
<form name="fjdh_lab_test_subcategoriesdelete" id="fjdh_lab_test_subcategoriesdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jdh_lab_test_subcategories">
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
<?php if ($Page->test_subcategory_id->Visible) { // test_subcategory_id ?>
        <th class="<?= $Page->test_subcategory_id->headerCellClass() ?>"><span id="elh_jdh_lab_test_subcategories_test_subcategory_id" class="jdh_lab_test_subcategories_test_subcategory_id"><?= $Page->test_subcategory_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->test_category_id->Visible) { // test_category_id ?>
        <th class="<?= $Page->test_category_id->headerCellClass() ?>"><span id="elh_jdh_lab_test_subcategories_test_category_id" class="jdh_lab_test_subcategories_test_category_id"><?= $Page->test_category_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->test_subcategory_name->Visible) { // test_subcategory_name ?>
        <th class="<?= $Page->test_subcategory_name->headerCellClass() ?>"><span id="elh_jdh_lab_test_subcategories_test_subcategory_name" class="jdh_lab_test_subcategories_test_subcategory_name"><?= $Page->test_subcategory_name->caption() ?></span></th>
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
<?php if ($Page->test_subcategory_id->Visible) { // test_subcategory_id ?>
        <td<?= $Page->test_subcategory_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->test_subcategory_id->viewAttributes() ?>>
<?= $Page->test_subcategory_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->test_category_id->Visible) { // test_category_id ?>
        <td<?= $Page->test_category_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->test_category_id->viewAttributes() ?>>
<?= $Page->test_category_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->test_subcategory_name->Visible) { // test_subcategory_name ?>
        <td<?= $Page->test_subcategory_name->cellAttributes() ?>>
<span id="">
<span<?= $Page->test_subcategory_name->viewAttributes() ?>>
<?= $Page->test_subcategory_name->getViewValue() ?></span>
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
