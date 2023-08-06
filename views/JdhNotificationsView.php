<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$JdhNotificationsView = &$Page;
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
<form name="fjdh_notificationsview" id="fjdh_notificationsview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_notifications: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fjdh_notificationsview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_notificationsview")
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
<input type="hidden" name="t" value="jdh_notifications">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->Id->Visible) { // Id ?>
    <tr id="r_Id"<?= $Page->Id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_notifications_Id"><?= $Page->Id->caption() ?></span></td>
        <td data-name="Id"<?= $Page->Id->cellAttributes() ?>>
<span id="el_jdh_notifications_Id">
<span<?= $Page->Id->viewAttributes() ?>>
<?= $Page->Id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->User->Visible) { // User ?>
    <tr id="r_User"<?= $Page->User->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_notifications_User"><?= $Page->User->caption() ?></span></td>
        <td data-name="User"<?= $Page->User->cellAttributes() ?>>
<span id="el_jdh_notifications_User">
<span<?= $Page->User->viewAttributes() ?>>
<?= $Page->User->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Endpoint->Visible) { // Endpoint ?>
    <tr id="r_Endpoint"<?= $Page->Endpoint->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_notifications_Endpoint"><?= $Page->Endpoint->caption() ?></span></td>
        <td data-name="Endpoint"<?= $Page->Endpoint->cellAttributes() ?>>
<span id="el_jdh_notifications_Endpoint">
<span<?= $Page->Endpoint->viewAttributes() ?>>
<?= $Page->Endpoint->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->PublicKey->Visible) { // PublicKey ?>
    <tr id="r_PublicKey"<?= $Page->PublicKey->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_notifications_PublicKey"><?= $Page->PublicKey->caption() ?></span></td>
        <td data-name="PublicKey"<?= $Page->PublicKey->cellAttributes() ?>>
<span id="el_jdh_notifications_PublicKey">
<span<?= $Page->PublicKey->viewAttributes() ?>>
<?= $Page->PublicKey->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->AuthenticationToken->Visible) { // AuthenticationToken ?>
    <tr id="r_AuthenticationToken"<?= $Page->AuthenticationToken->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_notifications_AuthenticationToken"><?= $Page->AuthenticationToken->caption() ?></span></td>
        <td data-name="AuthenticationToken"<?= $Page->AuthenticationToken->cellAttributes() ?>>
<span id="el_jdh_notifications_AuthenticationToken">
<span<?= $Page->AuthenticationToken->viewAttributes() ?>>
<?= $Page->AuthenticationToken->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ContentEncoding->Visible) { // ContentEncoding ?>
    <tr id="r_ContentEncoding"<?= $Page->ContentEncoding->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jdh_notifications_ContentEncoding"><?= $Page->ContentEncoding->caption() ?></span></td>
        <td data-name="ContentEncoding"<?= $Page->ContentEncoding->cellAttributes() ?>>
<span id="el_jdh_notifications_ContentEncoding">
<span<?= $Page->ContentEncoding->viewAttributes() ?>>
<?= $Page->ContentEncoding->getViewValue() ?></span>
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
