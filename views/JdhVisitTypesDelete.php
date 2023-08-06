<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$JdhVisitTypesDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_visit_types: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fjdh_visit_typesdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_visit_typesdelete")
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
<form name="fjdh_visit_typesdelete" id="fjdh_visit_typesdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jdh_visit_types">
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
<?php if ($Page->visit_type_id->Visible) { // visit_type_id ?>
        <th class="<?= $Page->visit_type_id->headerCellClass() ?>"><span id="elh_jdh_visit_types_visit_type_id" class="jdh_visit_types_visit_type_id"><?= $Page->visit_type_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->visit_type->Visible) { // visit_type ?>
        <th class="<?= $Page->visit_type->headerCellClass() ?>"><span id="elh_jdh_visit_types_visit_type" class="jdh_visit_types_visit_type"><?= $Page->visit_type->caption() ?></span></th>
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
<?php if ($Page->visit_type_id->Visible) { // visit_type_id ?>
        <td<?= $Page->visit_type_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_visit_types_visit_type_id" class="el_jdh_visit_types_visit_type_id">
<span<?= $Page->visit_type_id->viewAttributes() ?>>
<?= $Page->visit_type_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->visit_type->Visible) { // visit_type ?>
        <td<?= $Page->visit_type->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_visit_types_visit_type" class="el_jdh_visit_types_visit_type">
<span<?= $Page->visit_type->viewAttributes() ?>>
<?= $Page->visit_type->getViewValue() ?></span>
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
