<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$JdhInsuranceList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_insurance: currentTable } });
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
<?php if ($Page->SearchOptions->visible()) { ?>
<?php $Page->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($Page->FilterOptions->visible()) { ?>
<?php $Page->FilterOptions->render("body") ?>
<?php } ?>
</div>
<?php } ?>
<?php if ($Security->canSearch()) { ?>
<?php if (!$Page->isExport() && !($Page->CurrentAction && $Page->CurrentAction != "search") && $Page->hasSearchFields()) { ?>
<form name="fjdh_insurancesrch" id="fjdh_insurancesrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>" novalidate autocomplete="on">
<div id="fjdh_insurancesrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_insurance: currentTable } });
var currentForm;
var fjdh_insurancesrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery,
        fields = currentTable.fields;

    // Form object for search
    let form = new ew.FormBuilder()
        .setId("fjdh_insurancesrch")
        .setPageId("list")
<?php if ($Page->UseAjaxActions) { ?>
        .setSubmitWithFetch(true)
<?php } ?>

        // Dynamic selection lists
        .setLists({
        })

        // Filters
        .setFilterList(<?= $Page->getFilterList() ?>)
        .build();
    window[form.id] = form;
    currentSearchForm = form;
    loadjs.done(form.id);
});
</script>
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="jdh_insurance">
<div class="ew-extended-search container-fluid ps-2">
<div class="row mb-0">
    <div class="col-sm-auto px-0 pe-sm-2">
        <div class="ew-basic-search input-group">
            <input type="search" name="<?= Config("TABLE_BASIC_SEARCH") ?>" id="<?= Config("TABLE_BASIC_SEARCH") ?>" class="form-control ew-basic-search-keyword" value="<?= HtmlEncode($Page->BasicSearch->getKeyword()) ?>" placeholder="<?= HtmlEncode($Language->phrase("Search")) ?>" aria-label="<?= HtmlEncode($Language->phrase("Search")) ?>">
            <input type="hidden" name="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" class="ew-basic-search-type" value="<?= HtmlEncode($Page->BasicSearch->getType()) ?>">
            <button type="button" data-bs-toggle="dropdown" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false">
                <span id="searchtype"><?= $Page->BasicSearch->getTypeNameShort() ?></span>
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fjdh_insurancesrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fjdh_insurancesrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fjdh_insurancesrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fjdh_insurancesrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
            </div>
        </div>
    </div>
    <div class="col-sm-auto mb-3">
        <button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?= $Language->phrase("SearchBtn") ?></button>
    </div>
</div>
</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
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
<input type="hidden" name="t" value="jdh_insurance">
<?php if ($Page->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<div id="gmp_jdh_insurance" class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>" style="<?= $Page->TableContainerStyle ?>">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit() || $Page->isMultiEdit()) { ?>
<table id="tbl_jdh_insurancelist" class="<?= $Page->TableClass ?>"><!-- .ew-table -->
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
<?php if ($Page->insurance_id->Visible) { // insurance_id ?>
        <th data-name="insurance_id" class="<?= $Page->insurance_id->headerCellClass() ?>"><div id="elh_jdh_insurance_insurance_id" class="jdh_insurance_insurance_id"><?= $Page->renderFieldHeader($Page->insurance_id) ?></div></th>
<?php } ?>
<?php if ($Page->insurance_name->Visible) { // insurance_name ?>
        <th data-name="insurance_name" class="<?= $Page->insurance_name->headerCellClass() ?>"><div id="elh_jdh_insurance_insurance_name" class="jdh_insurance_insurance_name"><?= $Page->renderFieldHeader($Page->insurance_name) ?></div></th>
<?php } ?>
<?php if ($Page->insurance_contact_person->Visible) { // insurance_contact_person ?>
        <th data-name="insurance_contact_person" class="<?= $Page->insurance_contact_person->headerCellClass() ?>"><div id="elh_jdh_insurance_insurance_contact_person" class="jdh_insurance_insurance_contact_person"><?= $Page->renderFieldHeader($Page->insurance_contact_person) ?></div></th>
<?php } ?>
<?php if ($Page->insurance_contact_person_phone->Visible) { // insurance_contact_person_phone ?>
        <th data-name="insurance_contact_person_phone" class="<?= $Page->insurance_contact_person_phone->headerCellClass() ?>"><div id="elh_jdh_insurance_insurance_contact_person_phone" class="jdh_insurance_insurance_contact_person_phone"><?= $Page->renderFieldHeader($Page->insurance_contact_person_phone) ?></div></th>
<?php } ?>
<?php if ($Page->insurance_contact_person_email->Visible) { // insurance_contact_person_email ?>
        <th data-name="insurance_contact_person_email" class="<?= $Page->insurance_contact_person_email->headerCellClass() ?>"><div id="elh_jdh_insurance_insurance_contact_person_email" class="jdh_insurance_insurance_contact_person_email"><?= $Page->renderFieldHeader($Page->insurance_contact_person_email) ?></div></th>
<?php } ?>
<?php if ($Page->submission_date->Visible) { // submission_date ?>
        <th data-name="submission_date" class="<?= $Page->submission_date->headerCellClass() ?>"><div id="elh_jdh_insurance_submission_date" class="jdh_insurance_submission_date"><?= $Page->renderFieldHeader($Page->submission_date) ?></div></th>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
        <th data-name="date_updated" class="<?= $Page->date_updated->headerCellClass() ?>"><div id="elh_jdh_insurance_date_updated" class="jdh_insurance_date_updated"><?= $Page->renderFieldHeader($Page->date_updated) ?></div></th>
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
    <?php if ($Page->insurance_id->Visible) { // insurance_id ?>
        <td data-name="insurance_id"<?= $Page->insurance_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_insurance_insurance_id" class="el_jdh_insurance_insurance_id">
<span<?= $Page->insurance_id->viewAttributes() ?>>
<?= $Page->insurance_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->insurance_name->Visible) { // insurance_name ?>
        <td data-name="insurance_name"<?= $Page->insurance_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_insurance_insurance_name" class="el_jdh_insurance_insurance_name">
<span<?= $Page->insurance_name->viewAttributes() ?>>
<?= $Page->insurance_name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->insurance_contact_person->Visible) { // insurance_contact_person ?>
        <td data-name="insurance_contact_person"<?= $Page->insurance_contact_person->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_insurance_insurance_contact_person" class="el_jdh_insurance_insurance_contact_person">
<span<?= $Page->insurance_contact_person->viewAttributes() ?>>
<?= $Page->insurance_contact_person->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->insurance_contact_person_phone->Visible) { // insurance_contact_person_phone ?>
        <td data-name="insurance_contact_person_phone"<?= $Page->insurance_contact_person_phone->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_insurance_insurance_contact_person_phone" class="el_jdh_insurance_insurance_contact_person_phone">
<span<?= $Page->insurance_contact_person_phone->viewAttributes() ?>>
<?= $Page->insurance_contact_person_phone->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->insurance_contact_person_email->Visible) { // insurance_contact_person_email ?>
        <td data-name="insurance_contact_person_email"<?= $Page->insurance_contact_person_email->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_insurance_insurance_contact_person_email" class="el_jdh_insurance_insurance_contact_person_email">
<span<?= $Page->insurance_contact_person_email->viewAttributes() ?>>
<?= $Page->insurance_contact_person_email->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->submission_date->Visible) { // submission_date ?>
        <td data-name="submission_date"<?= $Page->submission_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_insurance_submission_date" class="el_jdh_insurance_submission_date">
<span<?= $Page->submission_date->viewAttributes() ?>>
<?= $Page->submission_date->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->date_updated->Visible) { // date_updated ?>
        <td data-name="date_updated"<?= $Page->date_updated->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_insurance_date_updated" class="el_jdh_insurance_date_updated">
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
    ew.addEventHandlers("jdh_insurance");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
