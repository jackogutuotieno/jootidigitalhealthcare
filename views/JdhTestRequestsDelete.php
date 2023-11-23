<?php

namespace PHPMaker2024\jootidigitalhealthcare;

// Page object
$JdhTestRequestsDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_test_requests: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fjdh_test_requestsdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_test_requestsdelete")
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
<form name="fjdh_test_requestsdelete" id="fjdh_test_requestsdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jdh_test_requests">
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
<?php if ($Page->patient_id->Visible) { // patient_id ?>
        <th class="<?= $Page->patient_id->headerCellClass() ?>"><span id="elh_jdh_test_requests_patient_id" class="jdh_test_requests_patient_id"><?= $Page->patient_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->request_title->Visible) { // request_title ?>
        <th class="<?= $Page->request_title->headerCellClass() ?>"><span id="elh_jdh_test_requests_request_title" class="jdh_test_requests_request_title"><?= $Page->request_title->caption() ?></span></th>
<?php } ?>
<?php if ($Page->request_service_id->Visible) { // request_service_id ?>
        <th class="<?= $Page->request_service_id->headerCellClass() ?>"><span id="elh_jdh_test_requests_request_service_id" class="jdh_test_requests_request_service_id"><?= $Page->request_service_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->request_description->Visible) { // request_description ?>
        <th class="<?= $Page->request_description->headerCellClass() ?>"><span id="elh_jdh_test_requests_request_description" class="jdh_test_requests_request_description"><?= $Page->request_description->caption() ?></span></th>
<?php } ?>
<?php if ($Page->request_date->Visible) { // request_date ?>
        <th class="<?= $Page->request_date->headerCellClass() ?>"><span id="elh_jdh_test_requests_request_date" class="jdh_test_requests_request_date"><?= $Page->request_date->caption() ?></span></th>
<?php } ?>
<?php if ($Page->status_id->Visible) { // status_id ?>
        <th class="<?= $Page->status_id->headerCellClass() ?>"><span id="elh_jdh_test_requests_status_id" class="jdh_test_requests_status_id"><?= $Page->status_id->caption() ?></span></th>
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
<?php if ($Page->patient_id->Visible) { // patient_id ?>
        <td<?= $Page->patient_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->patient_id->viewAttributes() ?>>
<?= $Page->patient_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->request_title->Visible) { // request_title ?>
        <td<?= $Page->request_title->cellAttributes() ?>>
<span id="">
<span<?= $Page->request_title->viewAttributes() ?>>
<?= $Page->request_title->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->request_service_id->Visible) { // request_service_id ?>
        <td<?= $Page->request_service_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->request_service_id->viewAttributes() ?>>
<?= $Page->request_service_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->request_description->Visible) { // request_description ?>
        <td<?= $Page->request_description->cellAttributes() ?>>
<span id="">
<span<?= $Page->request_description->viewAttributes() ?>>
<?= $Page->request_description->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->request_date->Visible) { // request_date ?>
        <td<?= $Page->request_date->cellAttributes() ?>>
<span id="">
<span<?= $Page->request_date->viewAttributes() ?>>
<?= $Page->request_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->status_id->Visible) { // status_id ?>
        <td<?= $Page->status_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->status_id->viewAttributes() ?>>
<?= $Page->status_id->getViewValue() ?></span>
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
