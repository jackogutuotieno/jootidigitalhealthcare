<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$SubscriptionsDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { subscriptions: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fsubscriptionsdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fsubscriptionsdelete")
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
<form name="fsubscriptionsdelete" id="fsubscriptionsdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="subscriptions">
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
<?php if ($Page->Id->Visible) { // Id ?>
        <th class="<?= $Page->Id->headerCellClass() ?>"><span id="elh_subscriptions_Id" class="subscriptions_Id"><?= $Page->Id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->User->Visible) { // User ?>
        <th class="<?= $Page->User->headerCellClass() ?>"><span id="elh_subscriptions_User" class="subscriptions_User"><?= $Page->User->caption() ?></span></th>
<?php } ?>
<?php if ($Page->PublicKey->Visible) { // PublicKey ?>
        <th class="<?= $Page->PublicKey->headerCellClass() ?>"><span id="elh_subscriptions_PublicKey" class="subscriptions_PublicKey"><?= $Page->PublicKey->caption() ?></span></th>
<?php } ?>
<?php if ($Page->AuthenticationToken->Visible) { // AuthenticationToken ?>
        <th class="<?= $Page->AuthenticationToken->headerCellClass() ?>"><span id="elh_subscriptions_AuthenticationToken" class="subscriptions_AuthenticationToken"><?= $Page->AuthenticationToken->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ContentEncoding->Visible) { // ContentEncoding ?>
        <th class="<?= $Page->ContentEncoding->headerCellClass() ?>"><span id="elh_subscriptions_ContentEncoding" class="subscriptions_ContentEncoding"><?= $Page->ContentEncoding->caption() ?></span></th>
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
<?php if ($Page->Id->Visible) { // Id ?>
        <td<?= $Page->Id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_subscriptions_Id" class="el_subscriptions_Id">
<span<?= $Page->Id->viewAttributes() ?>>
<?= $Page->Id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->User->Visible) { // User ?>
        <td<?= $Page->User->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_subscriptions_User" class="el_subscriptions_User">
<span<?= $Page->User->viewAttributes() ?>>
<?= $Page->User->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->PublicKey->Visible) { // PublicKey ?>
        <td<?= $Page->PublicKey->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_subscriptions_PublicKey" class="el_subscriptions_PublicKey">
<span<?= $Page->PublicKey->viewAttributes() ?>>
<?= $Page->PublicKey->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->AuthenticationToken->Visible) { // AuthenticationToken ?>
        <td<?= $Page->AuthenticationToken->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_subscriptions_AuthenticationToken" class="el_subscriptions_AuthenticationToken">
<span<?= $Page->AuthenticationToken->viewAttributes() ?>>
<?= $Page->AuthenticationToken->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ContentEncoding->Visible) { // ContentEncoding ?>
        <td<?= $Page->ContentEncoding->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_subscriptions_ContentEncoding" class="el_subscriptions_ContentEncoding">
<span<?= $Page->ContentEncoding->viewAttributes() ?>>
<?= $Page->ContentEncoding->getViewValue() ?></span>
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
