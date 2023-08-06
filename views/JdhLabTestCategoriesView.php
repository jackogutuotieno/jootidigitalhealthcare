<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$JdhLabTestCategoriesView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
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
<form name="fjdh_lab_test_categoriesview" id="fjdh_lab_test_categoriesview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_lab_test_categories: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fjdh_lab_test_categoriesview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_lab_test_categoriesview")
        .setPageId("view")
        .build();
    window[form.id] = form;
    currentForm = form;
    loadjs.done(form.id);
});
</script>
<?php } ?>
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jdh_lab_test_categories">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->test_category_id->Visible) { // test_category_id ?>
    <tr id="r_test_category_id"<?= $Page->test_category_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_lab_test_categories_test_category_id"><?= $Page->test_category_id->caption() ?></span></td>
        <td data-name="test_category_id"<?= $Page->test_category_id->cellAttributes() ?>>
<span id="el_jdh_lab_test_categories_test_category_id">
<span<?= $Page->test_category_id->viewAttributes() ?>>
<?= $Page->test_category_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->test_category_name->Visible) { // test_category_name ?>
    <tr id="r_test_category_name"<?= $Page->test_category_name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_lab_test_categories_test_category_name"><?= $Page->test_category_name->caption() ?></span></td>
        <td data-name="test_category_name"<?= $Page->test_category_name->cellAttributes() ?>>
<span id="el_jdh_lab_test_categories_test_category_name">
<span<?= $Page->test_category_name->viewAttributes() ?>>
<?= $Page->test_category_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->test_category_description->Visible) { // test_category_description ?>
    <tr id="r_test_category_description"<?= $Page->test_category_description->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_lab_test_categories_test_category_description"><?= $Page->test_category_description->caption() ?></span></td>
        <td data-name="test_category_description"<?= $Page->test_category_description->cellAttributes() ?>>
<span id="el_jdh_lab_test_categories_test_category_description">
<span<?= $Page->test_category_description->viewAttributes() ?>>
<?= $Page->test_category_description->getViewValue() ?></span>
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
