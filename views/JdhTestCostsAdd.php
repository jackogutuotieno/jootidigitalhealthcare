<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$JdhTestCostsAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_test_costs: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fjdh_test_costsadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_test_costsadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["test_category_id", [fields.test_category_id.visible && fields.test_category_id.required ? ew.Validators.required(fields.test_category_id.caption) : null], fields.test_category_id.isInvalid],
            ["test_subcategory_id", [fields.test_subcategory_id.visible && fields.test_subcategory_id.required ? ew.Validators.required(fields.test_subcategory_id.caption) : null], fields.test_subcategory_id.isInvalid],
            ["test_cost", [fields.test_cost.visible && fields.test_cost.required ? ew.Validators.required(fields.test_cost.caption) : null, ew.Validators.float], fields.test_cost.isInvalid]
        ])

        // Form_CustomValidate
        .setCustomValidate(
            function (fobj) { // DO NOT CHANGE THIS LINE! (except for adding "async" keyword)!
                    // Your custom validation code here, return false if invalid.
                    return true;
                }
        )

        // Use JavaScript validation or not
        .setValidateRequired(ew.CLIENT_VALIDATE)

        // Dynamic selection lists
        .setLists({
            "test_category_id": <?= $Page->test_category_id->toClientList($Page) ?>,
            "test_subcategory_id": <?= $Page->test_subcategory_id->toClientList($Page) ?>,
        })
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
<form name="fjdh_test_costsadd" id="fjdh_test_costsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jdh_test_costs">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->test_category_id->Visible) { // test_category_id ?>
    <div id="r_test_category_id"<?= $Page->test_category_id->rowAttributes() ?>>
        <label id="elh_jdh_test_costs_test_category_id" for="x_test_category_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->test_category_id->caption() ?><?= $Page->test_category_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->test_category_id->cellAttributes() ?>>
<span id="el_jdh_test_costs_test_category_id">
    <select
        id="x_test_category_id"
        name="x_test_category_id"
        class="form-select ew-select<?= $Page->test_category_id->isInvalidClass() ?>"
        data-select2-id="fjdh_test_costsadd_x_test_category_id"
        data-table="jdh_test_costs"
        data-field="x_test_category_id"
        data-value-separator="<?= $Page->test_category_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->test_category_id->getPlaceHolder()) ?>"
        data-ew-action="update-options"
        <?= $Page->test_category_id->editAttributes() ?>>
        <?= $Page->test_category_id->selectOptionListHtml("x_test_category_id") ?>
    </select>
    <?= $Page->test_category_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->test_category_id->getErrorMessage() ?></div>
<?= $Page->test_category_id->Lookup->getParamTag($Page, "p_x_test_category_id") ?>
<script>
loadjs.ready("fjdh_test_costsadd", function() {
    var options = { name: "x_test_category_id", selectId: "fjdh_test_costsadd_x_test_category_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_test_costsadd.lists.test_category_id?.lookupOptions.length) {
        options.data = { id: "x_test_category_id", form: "fjdh_test_costsadd" };
    } else {
        options.ajax = { id: "x_test_category_id", form: "fjdh_test_costsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_test_costs.fields.test_category_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->test_subcategory_id->Visible) { // test_subcategory_id ?>
    <div id="r_test_subcategory_id"<?= $Page->test_subcategory_id->rowAttributes() ?>>
        <label id="elh_jdh_test_costs_test_subcategory_id" for="x_test_subcategory_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->test_subcategory_id->caption() ?><?= $Page->test_subcategory_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->test_subcategory_id->cellAttributes() ?>>
<span id="el_jdh_test_costs_test_subcategory_id">
    <select
        id="x_test_subcategory_id"
        name="x_test_subcategory_id"
        class="form-select ew-select<?= $Page->test_subcategory_id->isInvalidClass() ?>"
        data-select2-id="fjdh_test_costsadd_x_test_subcategory_id"
        data-table="jdh_test_costs"
        data-field="x_test_subcategory_id"
        data-value-separator="<?= $Page->test_subcategory_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->test_subcategory_id->getPlaceHolder()) ?>"
        <?= $Page->test_subcategory_id->editAttributes() ?>>
        <?= $Page->test_subcategory_id->selectOptionListHtml("x_test_subcategory_id") ?>
    </select>
    <?= $Page->test_subcategory_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->test_subcategory_id->getErrorMessage() ?></div>
<?= $Page->test_subcategory_id->Lookup->getParamTag($Page, "p_x_test_subcategory_id") ?>
<script>
loadjs.ready("fjdh_test_costsadd", function() {
    var options = { name: "x_test_subcategory_id", selectId: "fjdh_test_costsadd_x_test_subcategory_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_test_costsadd.lists.test_subcategory_id?.lookupOptions.length) {
        options.data = { id: "x_test_subcategory_id", form: "fjdh_test_costsadd" };
    } else {
        options.ajax = { id: "x_test_subcategory_id", form: "fjdh_test_costsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_test_costs.fields.test_subcategory_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->test_cost->Visible) { // test_cost ?>
    <div id="r_test_cost"<?= $Page->test_cost->rowAttributes() ?>>
        <label id="elh_jdh_test_costs_test_cost" for="x_test_cost" class="<?= $Page->LeftColumnClass ?>"><?= $Page->test_cost->caption() ?><?= $Page->test_cost->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->test_cost->cellAttributes() ?>>
<span id="el_jdh_test_costs_test_cost">
<input type="<?= $Page->test_cost->getInputTextType() ?>" name="x_test_cost" id="x_test_cost" data-table="jdh_test_costs" data-field="x_test_cost" value="<?= $Page->test_cost->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->test_cost->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->test_cost->formatPattern()) ?>"<?= $Page->test_cost->editAttributes() ?> aria-describedby="x_test_cost_help">
<?= $Page->test_cost->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->test_cost->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fjdh_test_costsadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fjdh_test_costsadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
<?php } ?>
    </div><!-- /buttons offset -->
<?= $Page->IsModal ? "</template>" : "</div>" ?><!-- /buttons .row -->
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("jdh_test_costs");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
