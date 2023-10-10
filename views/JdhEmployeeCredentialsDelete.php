<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$JdhEmployeeCredentialsDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_employee_credentials: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fjdh_employee_credentialsdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_employee_credentialsdelete")
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
<form name="fjdh_employee_credentialsdelete" id="fjdh_employee_credentialsdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jdh_employee_credentials">
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
<?php if ($Page->id->Visible) { // id ?>
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_jdh_employee_credentials_id" class="jdh_employee_credentials_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->cv->Visible) { // cv ?>
        <th class="<?= $Page->cv->headerCellClass() ?>"><span id="elh_jdh_employee_credentials_cv" class="jdh_employee_credentials_cv"><?= $Page->cv->caption() ?></span></th>
<?php } ?>
<?php if ($Page->academic_certificates->Visible) { // academic_certificates ?>
        <th class="<?= $Page->academic_certificates->headerCellClass() ?>"><span id="elh_jdh_employee_credentials_academic_certificates" class="jdh_employee_credentials_academic_certificates"><?= $Page->academic_certificates->caption() ?></span></th>
<?php } ?>
<?php if ($Page->professional_certifications->Visible) { // professional_certifications ?>
        <th class="<?= $Page->professional_certifications->headerCellClass() ?>"><span id="elh_jdh_employee_credentials_professional_certifications" class="jdh_employee_credentials_professional_certifications"><?= $Page->professional_certifications->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
        <th class="<?= $Page->date_created->headerCellClass() ?>"><span id="elh_jdh_employee_credentials_date_created" class="jdh_employee_credentials_date_created"><?= $Page->date_created->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
        <th class="<?= $Page->date_updated->headerCellClass() ?>"><span id="elh_jdh_employee_credentials_date_updated" class="jdh_employee_credentials_date_updated"><?= $Page->date_updated->caption() ?></span></th>
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
<?php if ($Page->id->Visible) { // id ?>
        <td<?= $Page->id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_employee_credentials_id" class="el_jdh_employee_credentials_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->cv->Visible) { // cv ?>
        <td<?= $Page->cv->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_employee_credentials_cv" class="el_jdh_employee_credentials_cv">
<span<?= $Page->cv->viewAttributes() ?>>
<?= GetFileViewTag($Page->cv, $Page->cv->getViewValue(), false) ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($Page->academic_certificates->Visible) { // academic_certificates ?>
        <td<?= $Page->academic_certificates->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_employee_credentials_academic_certificates" class="el_jdh_employee_credentials_academic_certificates">
<span<?= $Page->academic_certificates->viewAttributes() ?>>
<?= GetFileViewTag($Page->academic_certificates, $Page->academic_certificates->getViewValue(), false) ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($Page->professional_certifications->Visible) { // professional_certifications ?>
        <td<?= $Page->professional_certifications->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_employee_credentials_professional_certifications" class="el_jdh_employee_credentials_professional_certifications">
<span<?= $Page->professional_certifications->viewAttributes() ?>>
<?= GetFileViewTag($Page->professional_certifications, $Page->professional_certifications->getViewValue(), false) ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
        <td<?= $Page->date_created->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_employee_credentials_date_created" class="el_jdh_employee_credentials_date_created">
<span<?= $Page->date_created->viewAttributes() ?>>
<?= $Page->date_created->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
        <td<?= $Page->date_updated->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_employee_credentials_date_updated" class="el_jdh_employee_credentials_date_updated">
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
