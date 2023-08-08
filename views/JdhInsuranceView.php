<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$JdhInsuranceView = &$Page;
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
<form name="fjdh_insuranceview" id="fjdh_insuranceview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_insurance: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fjdh_insuranceview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_insuranceview")
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
<input type="hidden" name="t" value="jdh_insurance">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->insurance_id->Visible) { // insurance_id ?>
    <tr id="r_insurance_id"<?= $Page->insurance_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_insurance_insurance_id"><?= $Page->insurance_id->caption() ?></span></td>
        <td data-name="insurance_id"<?= $Page->insurance_id->cellAttributes() ?>>
<span id="el_jdh_insurance_insurance_id">
<span<?= $Page->insurance_id->viewAttributes() ?>>
<?= $Page->insurance_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->insurance_name->Visible) { // insurance_name ?>
    <tr id="r_insurance_name"<?= $Page->insurance_name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_insurance_insurance_name"><?= $Page->insurance_name->caption() ?></span></td>
        <td data-name="insurance_name"<?= $Page->insurance_name->cellAttributes() ?>>
<span id="el_jdh_insurance_insurance_name">
<span<?= $Page->insurance_name->viewAttributes() ?>>
<?= $Page->insurance_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->insurance_contact_person->Visible) { // insurance_contact_person ?>
    <tr id="r_insurance_contact_person"<?= $Page->insurance_contact_person->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_insurance_insurance_contact_person"><?= $Page->insurance_contact_person->caption() ?></span></td>
        <td data-name="insurance_contact_person"<?= $Page->insurance_contact_person->cellAttributes() ?>>
<span id="el_jdh_insurance_insurance_contact_person">
<span<?= $Page->insurance_contact_person->viewAttributes() ?>>
<?= $Page->insurance_contact_person->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->insurance_contact_person_phone->Visible) { // insurance_contact_person_phone ?>
    <tr id="r_insurance_contact_person_phone"<?= $Page->insurance_contact_person_phone->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_insurance_insurance_contact_person_phone"><?= $Page->insurance_contact_person_phone->caption() ?></span></td>
        <td data-name="insurance_contact_person_phone"<?= $Page->insurance_contact_person_phone->cellAttributes() ?>>
<span id="el_jdh_insurance_insurance_contact_person_phone">
<span<?= $Page->insurance_contact_person_phone->viewAttributes() ?>>
<?php if (!EmptyString($Page->insurance_contact_person_phone->getViewValue()) && $Page->insurance_contact_person_phone->linkAttributes() != "") { ?>
<a<?= $Page->insurance_contact_person_phone->linkAttributes() ?>><?= $Page->insurance_contact_person_phone->getViewValue() ?></a>
<?php } else { ?>
<?= $Page->insurance_contact_person_phone->getViewValue() ?>
<?php } ?>
</span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->insurance_contact_person_email->Visible) { // insurance_contact_person_email ?>
    <tr id="r_insurance_contact_person_email"<?= $Page->insurance_contact_person_email->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_insurance_insurance_contact_person_email"><?= $Page->insurance_contact_person_email->caption() ?></span></td>
        <td data-name="insurance_contact_person_email"<?= $Page->insurance_contact_person_email->cellAttributes() ?>>
<span id="el_jdh_insurance_insurance_contact_person_email">
<span<?= $Page->insurance_contact_person_email->viewAttributes() ?>>
<?php if (!EmptyString($Page->insurance_contact_person_email->getViewValue()) && $Page->insurance_contact_person_email->linkAttributes() != "") { ?>
<a<?= $Page->insurance_contact_person_email->linkAttributes() ?>><?= $Page->insurance_contact_person_email->getViewValue() ?></a>
<?php } else { ?>
<?= $Page->insurance_contact_person_email->getViewValue() ?>
<?php } ?>
</span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->insurance_physical_address->Visible) { // insurance_physical_address ?>
    <tr id="r_insurance_physical_address"<?= $Page->insurance_physical_address->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_insurance_insurance_physical_address"><?= $Page->insurance_physical_address->caption() ?></span></td>
        <td data-name="insurance_physical_address"<?= $Page->insurance_physical_address->cellAttributes() ?>>
<span id="el_jdh_insurance_insurance_physical_address">
<span<?= $Page->insurance_physical_address->viewAttributes() ?>>
<?= $Page->insurance_physical_address->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->submission_date->Visible) { // submission_date ?>
    <tr id="r_submission_date"<?= $Page->submission_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_insurance_submission_date"><?= $Page->submission_date->caption() ?></span></td>
        <td data-name="submission_date"<?= $Page->submission_date->cellAttributes() ?>>
<span id="el_jdh_insurance_submission_date">
<span<?= $Page->submission_date->viewAttributes() ?>>
<?= $Page->submission_date->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
    <tr id="r_date_updated"<?= $Page->date_updated->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_insurance_date_updated"><?= $Page->date_updated->caption() ?></span></td>
        <td data-name="date_updated"<?= $Page->date_updated->cellAttributes() ?>>
<span id="el_jdh_insurance_date_updated">
<span<?= $Page->date_updated->viewAttributes() ?>>
<?= $Page->date_updated->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->submitted_by_user_id->Visible) { // submitted_by_user_id ?>
    <tr id="r_submitted_by_user_id"<?= $Page->submitted_by_user_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_insurance_submitted_by_user_id"><?= $Page->submitted_by_user_id->caption() ?></span></td>
        <td data-name="submitted_by_user_id"<?= $Page->submitted_by_user_id->cellAttributes() ?>>
<span id="el_jdh_insurance_submitted_by_user_id">
<span<?= $Page->submitted_by_user_id->viewAttributes() ?>>
<?= $Page->submitted_by_user_id->getViewValue() ?></span>
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
