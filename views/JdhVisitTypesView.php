<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$JdhVisitTypesView = &$Page;
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
<form name="fjdh_visit_typesview" id="fjdh_visit_typesview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_visit_types: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fjdh_visit_typesview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_visit_typesview")
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
<input type="hidden" name="t" value="jdh_visit_types">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->visit_type_id->Visible) { // visit_type_id ?>
    <tr id="r_visit_type_id"<?= $Page->visit_type_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_visit_types_visit_type_id"><?= $Page->visit_type_id->caption() ?></span></td>
        <td data-name="visit_type_id"<?= $Page->visit_type_id->cellAttributes() ?>>
<span id="el_jdh_visit_types_visit_type_id">
<span<?= $Page->visit_type_id->viewAttributes() ?>>
<?= $Page->visit_type_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->visit_type->Visible) { // visit_type ?>
    <tr id="r_visit_type"<?= $Page->visit_type->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_visit_types_visit_type"><?= $Page->visit_type->caption() ?></span></td>
        <td data-name="visit_type"<?= $Page->visit_type->cellAttributes() ?>>
<span id="el_jdh_visit_types_visit_type">
<span<?= $Page->visit_type->viewAttributes() ?>>
<?= $Page->visit_type->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->visit_description->Visible) { // visit_description ?>
    <tr id="r_visit_description"<?= $Page->visit_description->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_visit_types_visit_description"><?= $Page->visit_description->caption() ?></span></td>
        <td data-name="visit_description"<?= $Page->visit_description->cellAttributes() ?>>
<span id="el_jdh_visit_types_visit_description">
<span<?= $Page->visit_description->viewAttributes() ?>>
<?= $Page->visit_description->getViewValue() ?></span>
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
