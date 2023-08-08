<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$JdhServicesDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_services: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fjdh_servicesdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_servicesdelete")
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
<form name="fjdh_servicesdelete" id="fjdh_servicesdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jdh_services">
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
<?php if ($Page->category_id->Visible) { // category_id ?>
        <th class="<?= $Page->category_id->headerCellClass() ?>"><span id="elh_jdh_services_category_id" class="jdh_services_category_id"><?= $Page->category_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->subcategory_id->Visible) { // subcategory_id ?>
        <th class="<?= $Page->subcategory_id->headerCellClass() ?>"><span id="elh_jdh_services_subcategory_id" class="jdh_services_subcategory_id"><?= $Page->subcategory_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->service_name->Visible) { // service_name ?>
        <th class="<?= $Page->service_name->headerCellClass() ?>"><span id="elh_jdh_services_service_name" class="jdh_services_service_name"><?= $Page->service_name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->service_cost->Visible) { // service_cost ?>
        <th class="<?= $Page->service_cost->headerCellClass() ?>"><span id="elh_jdh_services_service_cost" class="jdh_services_service_cost"><?= $Page->service_cost->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
        <th class="<?= $Page->date_created->headerCellClass() ?>"><span id="elh_jdh_services_date_created" class="jdh_services_date_created"><?= $Page->date_created->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
        <th class="<?= $Page->date_updated->headerCellClass() ?>"><span id="elh_jdh_services_date_updated" class="jdh_services_date_updated"><?= $Page->date_updated->caption() ?></span></th>
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
<?php if ($Page->category_id->Visible) { // category_id ?>
        <td<?= $Page->category_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_services_category_id" class="el_jdh_services_category_id">
<span<?= $Page->category_id->viewAttributes() ?>>
<?= $Page->category_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->subcategory_id->Visible) { // subcategory_id ?>
        <td<?= $Page->subcategory_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_services_subcategory_id" class="el_jdh_services_subcategory_id">
<span<?= $Page->subcategory_id->viewAttributes() ?>>
<?= $Page->subcategory_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->service_name->Visible) { // service_name ?>
        <td<?= $Page->service_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_services_service_name" class="el_jdh_services_service_name">
<span<?= $Page->service_name->viewAttributes() ?>>
<?= $Page->service_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->service_cost->Visible) { // service_cost ?>
        <td<?= $Page->service_cost->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_services_service_cost" class="el_jdh_services_service_cost">
<span<?= $Page->service_cost->viewAttributes() ?>>
<?= $Page->service_cost->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
        <td<?= $Page->date_created->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_services_date_created" class="el_jdh_services_date_created">
<span<?= $Page->date_created->viewAttributes() ?>>
<?= $Page->date_created->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
        <td<?= $Page->date_updated->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_services_date_updated" class="el_jdh_services_date_updated">
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
