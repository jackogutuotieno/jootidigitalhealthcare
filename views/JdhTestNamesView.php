<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$JdhTestNamesView = &$Page;
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
<form name="fjdh_test_namesview" id="fjdh_test_namesview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_test_names: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fjdh_test_namesview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_test_namesview")
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
<input type="hidden" name="t" value="jdh_test_names">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->test_id->Visible) { // test_id ?>
    <tr id="r_test_id"<?= $Page->test_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_test_names_test_id"><?= $Page->test_id->caption() ?></span></td>
        <td data-name="test_id"<?= $Page->test_id->cellAttributes() ?>>
<span id="el_jdh_test_names_test_id">
<span<?= $Page->test_id->viewAttributes() ?>>
<?= $Page->test_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
    <tr id="r_patient_id"<?= $Page->patient_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_test_names_patient_id"><?= $Page->patient_id->caption() ?></span></td>
        <td data-name="patient_id"<?= $Page->patient_id->cellAttributes() ?>>
<span id="el_jdh_test_names_patient_id">
<span<?= $Page->patient_id->viewAttributes() ?>>
<?= $Page->patient_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->test_name->Visible) { // test_name ?>
    <tr id="r_test_name"<?= $Page->test_name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_test_names_test_name"><?= $Page->test_name->caption() ?></span></td>
        <td data-name="test_name"<?= $Page->test_name->cellAttributes() ?>>
<span id="el_jdh_test_names_test_name">
<span<?= $Page->test_name->viewAttributes() ?>>
<?= $Page->test_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->test_category_id->Visible) { // test_category_id ?>
    <tr id="r_test_category_id"<?= $Page->test_category_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_test_names_test_category_id"><?= $Page->test_category_id->caption() ?></span></td>
        <td data-name="test_category_id"<?= $Page->test_category_id->cellAttributes() ?>>
<span id="el_jdh_test_names_test_category_id">
<span<?= $Page->test_category_id->viewAttributes() ?>>
<?= $Page->test_category_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->test_subcategory_id->Visible) { // test_subcategory_id ?>
    <tr id="r_test_subcategory_id"<?= $Page->test_subcategory_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_test_names_test_subcategory_id"><?= $Page->test_subcategory_id->caption() ?></span></td>
        <td data-name="test_subcategory_id"<?= $Page->test_subcategory_id->cellAttributes() ?>>
<span id="el_jdh_test_names_test_subcategory_id">
<span<?= $Page->test_subcategory_id->viewAttributes() ?>>
<?= $Page->test_subcategory_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->test_cost->Visible) { // test_cost ?>
    <tr id="r_test_cost"<?= $Page->test_cost->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_test_names_test_cost"><?= $Page->test_cost->caption() ?></span></td>
        <td data-name="test_cost"<?= $Page->test_cost->cellAttributes() ?>>
<span id="el_jdh_test_names_test_cost">
<span<?= $Page->test_cost->viewAttributes() ?>>
<?= $Page->test_cost->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date_submitted->Visible) { // date_submitted ?>
    <tr id="r_date_submitted"<?= $Page->date_submitted->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_test_names_date_submitted"><?= $Page->date_submitted->caption() ?></span></td>
        <td data-name="date_submitted"<?= $Page->date_submitted->cellAttributes() ?>>
<span id="el_jdh_test_names_date_submitted">
<span<?= $Page->date_submitted->viewAttributes() ?>>
<?= $Page->date_submitted->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
    <tr id="r_date_updated"<?= $Page->date_updated->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_test_names_date_updated"><?= $Page->date_updated->caption() ?></span></td>
        <td data-name="date_updated"<?= $Page->date_updated->cellAttributes() ?>>
<span id="el_jdh_test_names_date_updated">
<span<?= $Page->date_updated->viewAttributes() ?>>
<?= $Page->date_updated->getViewValue() ?></span>
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
