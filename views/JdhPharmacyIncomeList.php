<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$JdhPharmacyIncomeList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_pharmacy_income: currentTable } });
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
<form name="fjdh_pharmacy_incomesrch" id="fjdh_pharmacy_incomesrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>" novalidate autocomplete="on">
<div id="fjdh_pharmacy_incomesrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_pharmacy_income: currentTable } });
var currentForm;
var fjdh_pharmacy_incomesrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery,
        fields = currentTable.fields;

    // Form object for search
    let form = new ew.FormBuilder()
        .setId("fjdh_pharmacy_incomesrch")
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
<input type="hidden" name="t" value="jdh_pharmacy_income">
<div class="ew-extended-search container-fluid ps-2">
<!-- template for quick search in navbar -->
<script id="navbar-basic-search" type="text/html" class="ew-js-template" data-name="search" data-seq="10" data-data="menu" data-target="#ew-navbar-end" data-method="prependTo">
    <li class="nav-item navbar-basic-search">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fa-solid fa-magnifying-glass"></i>
        </a>
        <div class="navbar-search-block">
            <div class="ew-basic-search input-group input-group-sm">
                <input type="text" name="<?= Config("TABLE_BASIC_SEARCH") ?>" id="<?= Config("TABLE_BASIC_SEARCH") ?>" class="form-control form-control-navbar ew-basic-search-keyword" form="fjdh_pharmacy_incomesrch" value="<?= HtmlEncode($Page->BasicSearch->getKeyword()) ?>" placeholder="<?= HtmlEncode($Language->phrase("Search")) ?>" aria-label="<?= HtmlEncode($Language->phrase("Search")) ?>">
                <input type="hidden" name="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" class="form-control-navbar ew-basic-search-type" form="fjdh_pharmacy_incomesrch" value="<?= HtmlEncode($Page->BasicSearch->getType()) ?>">
                <button class="btn btn-navbar" form="fjdh_pharmacy_incomesrch" type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
                <button type="button" data-bs-toggle="dropdown" class="btn btn-navbar dropdown-toggle" aria-haspopup="true" aria-expanded="false">
                    <span id="searchtype"><?= $Page->BasicSearch->getTypeNameShort() ?></span>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fjdh_pharmacy_incomesrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                    <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fjdh_pharmacy_incomesrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                    <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fjdh_pharmacy_incomesrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                    <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fjdh_pharmacy_incomesrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
                </div>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        </div>
    </li>
</script>
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
<input type="hidden" name="t" value="jdh_pharmacy_income">
<?php if ($Page->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<div id="gmp_jdh_pharmacy_income" class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>" style="<?= $Page->TableContainerStyle ?>">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit() || $Page->isMultiEdit()) { ?>
<table id="tbl_jdh_pharmacy_incomelist" class="<?= $Page->TableClass ?>"><!-- .ew-table -->
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
<?php if ($Page->patient_id->Visible) { // patient_id ?>
        <th data-name="patient_id" class="<?= $Page->patient_id->headerCellClass() ?>"><div id="elh_jdh_pharmacy_income_patient_id" class="jdh_pharmacy_income_patient_id"><?= $Page->renderFieldHeader($Page->patient_id) ?></div></th>
<?php } ?>
<?php if ($Page->patient_name->Visible) { // patient_name ?>
        <th data-name="patient_name" class="<?= $Page->patient_name->headerCellClass() ?>"><div id="elh_jdh_pharmacy_income_patient_name" class="jdh_pharmacy_income_patient_name"><?= $Page->renderFieldHeader($Page->patient_name) ?></div></th>
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
        <th data-name="name" class="<?= $Page->name->headerCellClass() ?>"><div id="elh_jdh_pharmacy_income_name" class="jdh_pharmacy_income_name"><?= $Page->renderFieldHeader($Page->name) ?></div></th>
<?php } ?>
<?php if ($Page->selling_price->Visible) { // selling_price ?>
        <th data-name="selling_price" class="<?= $Page->selling_price->headerCellClass() ?>"><div id="elh_jdh_pharmacy_income_selling_price" class="jdh_pharmacy_income_selling_price"><?= $Page->renderFieldHeader($Page->selling_price) ?></div></th>
<?php } ?>
<?php if ($Page->units_given->Visible) { // units_given ?>
        <th data-name="units_given" class="<?= $Page->units_given->headerCellClass() ?>"><div id="elh_jdh_pharmacy_income_units_given" class="jdh_pharmacy_income_units_given"><?= $Page->renderFieldHeader($Page->units_given) ?></div></th>
<?php } ?>
<?php if ($Page->line_total_cost->Visible) { // line_total_cost ?>
        <th data-name="line_total_cost" class="<?= $Page->line_total_cost->headerCellClass() ?>"><div id="elh_jdh_pharmacy_income_line_total_cost" class="jdh_pharmacy_income_line_total_cost"><?= $Page->renderFieldHeader($Page->line_total_cost) ?></div></th>
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
    <?php if ($Page->patient_id->Visible) { // patient_id ?>
        <td data-name="patient_id"<?= $Page->patient_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_pharmacy_income_patient_id" class="el_jdh_pharmacy_income_patient_id">
<span<?= $Page->patient_id->viewAttributes() ?>>
<?= $Page->patient_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->patient_name->Visible) { // patient_name ?>
        <td data-name="patient_name"<?= $Page->patient_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_pharmacy_income_patient_name" class="el_jdh_pharmacy_income_patient_name">
<span<?= $Page->patient_name->viewAttributes() ?>>
<?= $Page->patient_name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->name->Visible) { // name ?>
        <td data-name="name"<?= $Page->name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_pharmacy_income_name" class="el_jdh_pharmacy_income_name">
<span<?= $Page->name->viewAttributes() ?>>
<?= $Page->name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->selling_price->Visible) { // selling_price ?>
        <td data-name="selling_price"<?= $Page->selling_price->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_pharmacy_income_selling_price" class="el_jdh_pharmacy_income_selling_price">
<span<?= $Page->selling_price->viewAttributes() ?>>
<?= $Page->selling_price->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->units_given->Visible) { // units_given ?>
        <td data-name="units_given"<?= $Page->units_given->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_pharmacy_income_units_given" class="el_jdh_pharmacy_income_units_given">
<span<?= $Page->units_given->viewAttributes() ?>>
<?= $Page->units_given->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->line_total_cost->Visible) { // line_total_cost ?>
        <td data-name="line_total_cost"<?= $Page->line_total_cost->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jdh_pharmacy_income_line_total_cost" class="el_jdh_pharmacy_income_line_total_cost">
<span<?= $Page->line_total_cost->viewAttributes() ?>>
<?= $Page->line_total_cost->getViewValue() ?></span>
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
<?php
// Render aggregate row
$Page->RowType = ROWTYPE_AGGREGATE;
$Page->resetAttributes();
$Page->renderRow();
?>
<?php if ($Page->TotalRecords > 0 && !$Page->isGridAdd() && !$Page->isGridEdit() && !$Page->isMultiEdit()) { ?>
<tfoot><!-- Table footer -->
    <tr class="ew-table-footer">
<?php
// Render list options
$Page->renderListOptions();

// Render list options (footer, left)
$Page->ListOptions->render("footer", "left");
?>
    <?php if ($Page->patient_id->Visible) { // patient_id ?>
        <td data-name="patient_id" class="<?= $Page->patient_id->footerCellClass() ?>"><span id="elf_jdh_pharmacy_income_patient_id" class="jdh_pharmacy_income_patient_id">
        </span></td>
    <?php } ?>
    <?php if ($Page->patient_name->Visible) { // patient_name ?>
        <td data-name="patient_name" class="<?= $Page->patient_name->footerCellClass() ?>"><span id="elf_jdh_pharmacy_income_patient_name" class="jdh_pharmacy_income_patient_name">
        </span></td>
    <?php } ?>
    <?php if ($Page->name->Visible) { // name ?>
        <td data-name="name" class="<?= $Page->name->footerCellClass() ?>"><span id="elf_jdh_pharmacy_income_name" class="jdh_pharmacy_income_name">
        </span></td>
    <?php } ?>
    <?php if ($Page->selling_price->Visible) { // selling_price ?>
        <td data-name="selling_price" class="<?= $Page->selling_price->footerCellClass() ?>"><span id="elf_jdh_pharmacy_income_selling_price" class="jdh_pharmacy_income_selling_price">
        </span></td>
    <?php } ?>
    <?php if ($Page->units_given->Visible) { // units_given ?>
        <td data-name="units_given" class="<?= $Page->units_given->footerCellClass() ?>"><span id="elf_jdh_pharmacy_income_units_given" class="jdh_pharmacy_income_units_given">
        </span></td>
    <?php } ?>
    <?php if ($Page->line_total_cost->Visible) { // line_total_cost ?>
        <td data-name="line_total_cost" class="<?= $Page->line_total_cost->footerCellClass() ?>"><span id="elf_jdh_pharmacy_income_line_total_cost" class="jdh_pharmacy_income_line_total_cost">
        <span class="ew-aggregate"><?= $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
        <?= $Page->line_total_cost->ViewValue ?></span>
        </span></td>
    <?php } ?>
<?php
// Render list options (footer, right)
$Page->ListOptions->render("footer", "right");
?>
    </tr>
</tfoot>
<?php } ?>
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
    ew.addEventHandlers("jdh_pharmacy_income");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
