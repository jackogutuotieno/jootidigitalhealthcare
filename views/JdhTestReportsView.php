<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$JdhTestReportsView = &$Page;
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
<form name="fjdh_test_reportsview" id="fjdh_test_reportsview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_test_reports: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fjdh_test_reportsview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_test_reportsview")
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
<input type="hidden" name="t" value="jdh_test_reports">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->report_id->Visible) { // report_id ?>
    <tr id="r_report_id"<?= $Page->report_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_test_reports_report_id"><?= $Page->report_id->caption() ?></span></td>
        <td data-name="report_id"<?= $Page->report_id->cellAttributes() ?>>
<span id="el_jdh_test_reports_report_id">
<span<?= $Page->report_id->viewAttributes() ?>>
<?= $Page->report_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->request_id->Visible) { // request_id ?>
    <tr id="r_request_id"<?= $Page->request_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_test_reports_request_id"><?= $Page->request_id->caption() ?></span></td>
        <td data-name="request_id"<?= $Page->request_id->cellAttributes() ?>>
<span id="el_jdh_test_reports_request_id">
<span<?= $Page->request_id->viewAttributes() ?>>
<?= $Page->request_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
    <tr id="r_patient_id"<?= $Page->patient_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_test_reports_patient_id"><?= $Page->patient_id->caption() ?></span></td>
        <td data-name="patient_id"<?= $Page->patient_id->cellAttributes() ?>>
<span id="el_jdh_test_reports_patient_id">
<span<?= $Page->patient_id->viewAttributes() ?>>
<?= $Page->patient_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->report_findings->Visible) { // report_findings ?>
    <tr id="r_report_findings"<?= $Page->report_findings->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_test_reports_report_findings"><?= $Page->report_findings->caption() ?></span></td>
        <td data-name="report_findings"<?= $Page->report_findings->cellAttributes() ?>>
<span id="el_jdh_test_reports_report_findings">
<span<?= $Page->report_findings->viewAttributes() ?>>
<?= $Page->report_findings->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->report_attachment->Visible) { // report_attachment ?>
    <tr id="r_report_attachment"<?= $Page->report_attachment->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_test_reports_report_attachment"><?= $Page->report_attachment->caption() ?></span></td>
        <td data-name="report_attachment"<?= $Page->report_attachment->cellAttributes() ?>>
<span id="el_jdh_test_reports_report_attachment">
<span<?= $Page->report_attachment->viewAttributes() ?>>
<?= GetFileViewTag($Page->report_attachment, $Page->report_attachment->getViewValue(), false) ?>
</span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->report_date->Visible) { // report_date ?>
    <tr id="r_report_date"<?= $Page->report_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_test_reports_report_date"><?= $Page->report_date->caption() ?></span></td>
        <td data-name="report_date"<?= $Page->report_date->cellAttributes() ?>>
<span id="el_jdh_test_reports_report_date">
<span<?= $Page->report_date->viewAttributes() ?>>
<?= $Page->report_date->getViewValue() ?></span>
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
