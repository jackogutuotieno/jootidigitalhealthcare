<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$JdhTestRequestsView = &$Page;
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
<form name="fjdh_test_requestsview" id="fjdh_test_requestsview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_test_requests: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fjdh_test_requestsview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_test_requestsview")
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
<input type="hidden" name="t" value="jdh_test_requests">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->request_id->Visible) { // request_id ?>
    <tr id="r_request_id"<?= $Page->request_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_test_requests_request_id"><?= $Page->request_id->caption() ?></span></td>
        <td data-name="request_id"<?= $Page->request_id->cellAttributes() ?>>
<span id="el_jdh_test_requests_request_id">
<span<?= $Page->request_id->viewAttributes() ?>>
<?= $Page->request_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
    <tr id="r_patient_id"<?= $Page->patient_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_test_requests_patient_id"><?= $Page->patient_id->caption() ?></span></td>
        <td data-name="patient_id"<?= $Page->patient_id->cellAttributes() ?>>
<span id="el_jdh_test_requests_patient_id">
<span<?= $Page->patient_id->viewAttributes() ?>>
<?= $Page->patient_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->request_title->Visible) { // request_title ?>
    <tr id="r_request_title"<?= $Page->request_title->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_test_requests_request_title"><?= $Page->request_title->caption() ?></span></td>
        <td data-name="request_title"<?= $Page->request_title->cellAttributes() ?>>
<span id="el_jdh_test_requests_request_title">
<span<?= $Page->request_title->viewAttributes() ?>>
<?= $Page->request_title->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->request_service_id->Visible) { // request_service_id ?>
    <tr id="r_request_service_id"<?= $Page->request_service_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_test_requests_request_service_id"><?= $Page->request_service_id->caption() ?></span></td>
        <td data-name="request_service_id"<?= $Page->request_service_id->cellAttributes() ?>>
<span id="el_jdh_test_requests_request_service_id">
<span<?= $Page->request_service_id->viewAttributes() ?>>
<?= $Page->request_service_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->request_description->Visible) { // request_description ?>
    <tr id="r_request_description"<?= $Page->request_description->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_test_requests_request_description"><?= $Page->request_description->caption() ?></span></td>
        <td data-name="request_description"<?= $Page->request_description->cellAttributes() ?>>
<span id="el_jdh_test_requests_request_description">
<span<?= $Page->request_description->viewAttributes() ?>>
<?= $Page->request_description->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->request_date->Visible) { // request_date ?>
    <tr id="r_request_date"<?= $Page->request_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_test_requests_request_date"><?= $Page->request_date->caption() ?></span></td>
        <td data-name="request_date"<?= $Page->request_date->cellAttributes() ?>>
<span id="el_jdh_test_requests_request_date">
<span<?= $Page->request_date->viewAttributes() ?>>
<?= $Page->request_date->getViewValue() ?></span>
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
