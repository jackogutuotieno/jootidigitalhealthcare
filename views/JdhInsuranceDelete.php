<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$JdhInsuranceDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_insurance: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fjdh_insurancedelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_insurancedelete")
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
<form name="fjdh_insurancedelete" id="fjdh_insurancedelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jdh_insurance">
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
<?php if ($Page->insurance_id->Visible) { // insurance_id ?>
        <th class="<?= $Page->insurance_id->headerCellClass() ?>"><span id="elh_jdh_insurance_insurance_id" class="jdh_insurance_insurance_id"><?= $Page->insurance_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->insurance_name->Visible) { // insurance_name ?>
        <th class="<?= $Page->insurance_name->headerCellClass() ?>"><span id="elh_jdh_insurance_insurance_name" class="jdh_insurance_insurance_name"><?= $Page->insurance_name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->insurance_contact_person->Visible) { // insurance_contact_person ?>
        <th class="<?= $Page->insurance_contact_person->headerCellClass() ?>"><span id="elh_jdh_insurance_insurance_contact_person" class="jdh_insurance_insurance_contact_person"><?= $Page->insurance_contact_person->caption() ?></span></th>
<?php } ?>
<?php if ($Page->insurance_contact_person_phone->Visible) { // insurance_contact_person_phone ?>
        <th class="<?= $Page->insurance_contact_person_phone->headerCellClass() ?>"><span id="elh_jdh_insurance_insurance_contact_person_phone" class="jdh_insurance_insurance_contact_person_phone"><?= $Page->insurance_contact_person_phone->caption() ?></span></th>
<?php } ?>
<?php if ($Page->insurance_contact_person_email->Visible) { // insurance_contact_person_email ?>
        <th class="<?= $Page->insurance_contact_person_email->headerCellClass() ?>"><span id="elh_jdh_insurance_insurance_contact_person_email" class="jdh_insurance_insurance_contact_person_email"><?= $Page->insurance_contact_person_email->caption() ?></span></th>
<?php } ?>
<?php if ($Page->submission_date->Visible) { // submission_date ?>
        <th class="<?= $Page->submission_date->headerCellClass() ?>"><span id="elh_jdh_insurance_submission_date" class="jdh_insurance_submission_date"><?= $Page->submission_date->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
        <th class="<?= $Page->date_updated->headerCellClass() ?>"><span id="elh_jdh_insurance_date_updated" class="jdh_insurance_date_updated"><?= $Page->date_updated->caption() ?></span></th>
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
<?php if ($Page->insurance_id->Visible) { // insurance_id ?>
        <td<?= $Page->insurance_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_insurance_insurance_id" class="el_jdh_insurance_insurance_id">
<span<?= $Page->insurance_id->viewAttributes() ?>>
<?= $Page->insurance_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->insurance_name->Visible) { // insurance_name ?>
        <td<?= $Page->insurance_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_insurance_insurance_name" class="el_jdh_insurance_insurance_name">
<span<?= $Page->insurance_name->viewAttributes() ?>>
<?= $Page->insurance_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->insurance_contact_person->Visible) { // insurance_contact_person ?>
        <td<?= $Page->insurance_contact_person->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_insurance_insurance_contact_person" class="el_jdh_insurance_insurance_contact_person">
<span<?= $Page->insurance_contact_person->viewAttributes() ?>>
<?= $Page->insurance_contact_person->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->insurance_contact_person_phone->Visible) { // insurance_contact_person_phone ?>
        <td<?= $Page->insurance_contact_person_phone->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_insurance_insurance_contact_person_phone" class="el_jdh_insurance_insurance_contact_person_phone">
<span<?= $Page->insurance_contact_person_phone->viewAttributes() ?>>
<?= $Page->insurance_contact_person_phone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->insurance_contact_person_email->Visible) { // insurance_contact_person_email ?>
        <td<?= $Page->insurance_contact_person_email->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_insurance_insurance_contact_person_email" class="el_jdh_insurance_insurance_contact_person_email">
<span<?= $Page->insurance_contact_person_email->viewAttributes() ?>>
<?= $Page->insurance_contact_person_email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->submission_date->Visible) { // submission_date ?>
        <td<?= $Page->submission_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_insurance_submission_date" class="el_jdh_insurance_submission_date">
<span<?= $Page->submission_date->viewAttributes() ?>>
<?= $Page->submission_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
        <td<?= $Page->date_updated->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_insurance_date_updated" class="el_jdh_insurance_date_updated">
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
