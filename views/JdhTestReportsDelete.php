<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$JdhTestReportsDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_test_reports: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fjdh_test_reportsdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_test_reportsdelete")
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
<form name="fjdh_test_reportsdelete" id="fjdh_test_reportsdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jdh_test_reports">
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
<?php if ($Page->report_id->Visible) { // report_id ?>
        <th class="<?= $Page->report_id->headerCellClass() ?>"><span id="elh_jdh_test_reports_report_id" class="jdh_test_reports_report_id"><?= $Page->report_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->request_id->Visible) { // request_id ?>
        <th class="<?= $Page->request_id->headerCellClass() ?>"><span id="elh_jdh_test_reports_request_id" class="jdh_test_reports_request_id"><?= $Page->request_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
        <th class="<?= $Page->patient_id->headerCellClass() ?>"><span id="elh_jdh_test_reports_patient_id" class="jdh_test_reports_patient_id"><?= $Page->patient_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->report_findings->Visible) { // report_findings ?>
        <th class="<?= $Page->report_findings->headerCellClass() ?>"><span id="elh_jdh_test_reports_report_findings" class="jdh_test_reports_report_findings"><?= $Page->report_findings->caption() ?></span></th>
<?php } ?>
<?php if ($Page->report_date->Visible) { // report_date ?>
        <th class="<?= $Page->report_date->headerCellClass() ?>"><span id="elh_jdh_test_reports_report_date" class="jdh_test_reports_report_date"><?= $Page->report_date->caption() ?></span></th>
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
<?php if ($Page->report_id->Visible) { // report_id ?>
        <td<?= $Page->report_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_test_reports_report_id" class="el_jdh_test_reports_report_id">
<span<?= $Page->report_id->viewAttributes() ?>><?= PhpBarcode::barcode('')->show('', '', 60) ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->request_id->Visible) { // request_id ?>
        <td<?= $Page->request_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_test_reports_request_id" class="el_jdh_test_reports_request_id">
<span<?= $Page->request_id->viewAttributes() ?>>
<?= $Page->request_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
        <td<?= $Page->patient_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_test_reports_patient_id" class="el_jdh_test_reports_patient_id">
<span<?= $Page->patient_id->viewAttributes() ?>>
<?= $Page->patient_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->report_findings->Visible) { // report_findings ?>
        <td<?= $Page->report_findings->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_test_reports_report_findings" class="el_jdh_test_reports_report_findings">
<span<?= $Page->report_findings->viewAttributes() ?>>
<?= $Page->report_findings->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->report_date->Visible) { // report_date ?>
        <td<?= $Page->report_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_test_reports_report_date" class="el_jdh_test_reports_report_date">
<span<?= $Page->report_date->viewAttributes() ?>>
<?= $Page->report_date->getViewValue() ?></span>
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
