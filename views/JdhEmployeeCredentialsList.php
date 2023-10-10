<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$JdhEmployeeCredentialsList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_employee_credentials: currentTable } });
var currentPageID = ew.PAGE_ID = "list";
var currentForm;
var <?= $Page->FormName ?>;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("<?= $Page->FormName ?>")
        .setPageId("list")
        .setSubmitWithFetch(<?= $Page->UseAjaxActions ? "true" : "false" ?>)
        .setFormKeyCountName("<?= $Page->FormKeyCountName ?>")
        .build();
    window[form.id] = form;
    currentForm = form;
    loadjs.done(form.id);
});
</script>
<script>
window.Tabulator || loadjs([
    ew.PATH_BASE + "js/tabulator.min.js?v=19.0.15",
    ew.PATH_BASE + "css/<?= CssFile("tabulator_bootstrap5.css") ?>?v=19.0.15"
], "import");
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($Page->TotalRecords > 0 && $Page->ExportOptions->visible()) { ?>
<?php $Page->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->ImportOptions->visible()) { ?>
<?php $Page->ImportOptions->render("body") ?>
<?php } ?>
</div>
<?php } ?>
<?php if (!$Page->isExport() || Config("EXPORT_MASTER_RECORD") && $Page->isExport("print")) { ?>
<?php
if ($Page->DbMasterFilter != "" && $Page->getCurrentMasterTable() == "jdh_users") {
    if ($Page->MasterRecordExists) {
        include_once "views/JdhUsersMaster.php";
    }
}
?>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="list<?= ($Page->TotalRecords == 0 && !$Page->isAdd()) ? " ew-no-record" : "" ?>">
<div id="ew-list">
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?= $Page->isAddOrEdit() ? " ew-grid-add-edit" : "" ?> <?= $Page->TableGridClass ?>">
<form name="<?= $Page->FormName ?>" id="<?= $Page->FormName ?>" class="ew-form ew-list-form" action="<?= $Page->PageAction ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jdh_employee_credentials">
<?php if ($Page->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<?php if ($Page->getCurrentMasterTable() == "jdh_users" && $Page->CurrentAction) { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="jdh_users">
<input type="hidden" name="fk_photo" value="<?= HtmlEncode($Page->user_id->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_jdh_employee_credentials" class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>" style="<?= $Page->TableContainerStyle ?>">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit() || $Page->isMultiEdit()) { ?>
<table id="tbl_jdh_employee_credentialslist" class="<?= $Page->TableClass ?>"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Page->RowType = ROWTYPE_HEADER;

// Render list options
$Page->renderListOptions();

// Render list options (header, left)
$Page->ListOptions->render("header", "left");
?>
<?php if ($Page->id->Visible) { // id ?>
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div id="elh_jdh_employee_credentials_id" class="jdh_employee_credentials_id"><?= $Page->renderFieldHeader($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->cv->Visible) { // cv ?>
        <th data-name="cv" class="<?= $Page->cv->headerCellClass() ?>"><div id="elh_jdh_employee_credentials_cv" class="jdh_employee_credentials_cv"><?= $Page->renderFieldHeader($Page->cv) ?></div></th>
<?php } ?>
<?php if ($Page->academic_certificates->Visible) { // academic_certificates ?>
        <th data-name="academic_certificates" class="<?= $Page->academic_certificates->headerCellClass() ?>"><div id="elh_jdh_employee_credentials_academic_certificates" class="jdh_employee_credentials_academic_certificates"><?= $Page->renderFieldHeader($Page->academic_certificates) ?></div></th>
<?php } ?>
<?php if ($Page->professional_certifications->Visible) { // professional_certifications ?>
        <th data-name="professional_certifications" class="<?= $Page->professional_certifications->headerCellClass() ?>"><div id="elh_jdh_employee_credentials_professional_certifications" class="jdh_employee_credentials_professional_certifications"><?= $Page->renderFieldHeader($Page->professional_certifications) ?></div></th>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
        <th data-name="date_created" class="<?= $Page->date_created->headerCellClass() ?>"><div id="elh_jdh_employee_credentials_date_created" class="jdh_employee_credentials_date_created"><?= $Page->renderFieldHeader($Page->date_created) ?></div></th>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
        <th data-name="date_updated" class="<?= $Page->date_updated->headerCellClass() ?>"><div id="elh_jdh_employee_credentials_date_updated" class="jdh_employee_credentials_date_updated"><?= $Page->renderFieldHeader($Page->date_updated) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Page->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody data-page="<?= $Page->getPageNumber() ?>">
<?php
$Page->setupGrid();
while ($Page->RecordCount < $Page->StopRecord) {
    $Page->RecordCount++;
    if ($Page->RecordCount >= $Page->StartRecord) {
        $Page->setupRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowCount);
?>
    <?php if ($Page->id->Visible) { // id ?>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_employee_credentials_id" class="el_jdh_employee_credentials_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->cv->Visible) { // cv ?>
        <td data-name="cv"<?= $Page->cv->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_employee_credentials_cv" class="el_jdh_employee_credentials_cv">
<span<?= $Page->cv->viewAttributes() ?>>
<?= GetFileViewTag($Page->cv, $Page->cv->getViewValue(), false) ?>
</span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->academic_certificates->Visible) { // academic_certificates ?>
        <td data-name="academic_certificates"<?= $Page->academic_certificates->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_employee_credentials_academic_certificates" class="el_jdh_employee_credentials_academic_certificates">
<span<?= $Page->academic_certificates->viewAttributes() ?>>
<?= GetFileViewTag($Page->academic_certificates, $Page->academic_certificates->getViewValue(), false) ?>
</span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->professional_certifications->Visible) { // professional_certifications ?>
        <td data-name="professional_certifications"<?= $Page->professional_certifications->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_employee_credentials_professional_certifications" class="el_jdh_employee_credentials_professional_certifications">
<span<?= $Page->professional_certifications->viewAttributes() ?>>
<?= GetFileViewTag($Page->professional_certifications, $Page->professional_certifications->getViewValue(), false) ?>
</span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->date_created->Visible) { // date_created ?>
        <td data-name="date_created"<?= $Page->date_created->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_employee_credentials_date_created" class="el_jdh_employee_credentials_date_created">
<span<?= $Page->date_created->viewAttributes() ?>>
<?= $Page->date_created->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->date_updated->Visible) { // date_updated ?>
        <td data-name="date_updated"<?= $Page->date_updated->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_employee_credentials_date_updated" class="el_jdh_employee_credentials_date_updated">
<span<?= $Page->date_updated->viewAttributes() ?>>
<?= $Page->date_updated->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowCount);
?>
    </tr>
<?php
    }
    if (!$Page->isGridAdd()) {
        $Page->Recordset->moveNext();
    }
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$Page->CurrentAction && !$Page->UseAjaxActions) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php
// Close recordset
if ($Page->Recordset) {
    $Page->Recordset->close();
}
?>
<?php if (!$Page->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Page->isGridAdd() && !($Page->isGridEdit() && $Page->ModalGridEdit) && !$Page->isMultiEdit()) { ?>
<?= $Page->Pager->render() ?>
<?php } ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body", "bottom") ?>
</div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } else { ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
<?php } ?>
</div>
</main>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("jdh_employee_credentials");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
