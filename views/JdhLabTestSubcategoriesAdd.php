<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$JdhLabTestSubcategoriesAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_lab_test_subcategories: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fjdh_lab_test_subcategoriesadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_lab_test_subcategoriesadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["test_category_id", [fields.test_category_id.visible && fields.test_category_id.required ? ew.Validators.required(fields.test_category_id.caption) : null], fields.test_category_id.isInvalid],
            ["test_subcategory_name", [fields.test_subcategory_name.visible && fields.test_subcategory_name.required ? ew.Validators.required(fields.test_subcategory_name.caption) : null], fields.test_subcategory_name.isInvalid],
            ["description", [fields.description.visible && fields.description.required ? ew.Validators.required(fields.description.caption) : null], fields.description.isInvalid]
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
<form name="fjdh_lab_test_subcategoriesadd" id="fjdh_lab_test_subcategoriesadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jdh_lab_test_subcategories">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->test_category_id->Visible) { // test_category_id ?>
    <div id="r_test_category_id"<?= $Page->test_category_id->rowAttributes() ?>>
        <label id="elh_jdh_lab_test_subcategories_test_category_id" for="x_test_category_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->test_category_id->caption() ?><?= $Page->test_category_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->test_category_id->cellAttributes() ?>>
<span id="el_jdh_lab_test_subcategories_test_category_id">
    <select
        id="x_test_category_id"
        name="x_test_category_id"
        class="form-select ew-select<?= $Page->test_category_id->isInvalidClass() ?>"
        data-select2-id="fjdh_lab_test_subcategoriesadd_x_test_category_id"
        data-table="jdh_lab_test_subcategories"
        data-field="x_test_category_id"
        data-value-separator="<?= $Page->test_category_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->test_category_id->getPlaceHolder()) ?>"
        <?= $Page->test_category_id->editAttributes() ?>>
        <?= $Page->test_category_id->selectOptionListHtml("x_test_category_id") ?>
    </select>
    <?= $Page->test_category_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->test_category_id->getErrorMessage() ?></div>
<?= $Page->test_category_id->Lookup->getParamTag($Page, "p_x_test_category_id") ?>
<script>
loadjs.ready("fjdh_lab_test_subcategoriesadd", function() {
    var options = { name: "x_test_category_id", selectId: "fjdh_lab_test_subcategoriesadd_x_test_category_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_lab_test_subcategoriesadd.lists.test_category_id?.lookupOptions.length) {
        options.data = { id: "x_test_category_id", form: "fjdh_lab_test_subcategoriesadd" };
    } else {
        options.ajax = { id: "x_test_category_id", form: "fjdh_lab_test_subcategoriesadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_lab_test_subcategories.fields.test_category_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->test_subcategory_name->Visible) { // test_subcategory_name ?>
    <div id="r_test_subcategory_name"<?= $Page->test_subcategory_name->rowAttributes() ?>>
        <label id="elh_jdh_lab_test_subcategories_test_subcategory_name" for="x_test_subcategory_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->test_subcategory_name->caption() ?><?= $Page->test_subcategory_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->test_subcategory_name->cellAttributes() ?>>
<span id="el_jdh_lab_test_subcategories_test_subcategory_name">
<input type="<?= $Page->test_subcategory_name->getInputTextType() ?>" name="x_test_subcategory_name" id="x_test_subcategory_name" data-table="jdh_lab_test_subcategories" data-field="x_test_subcategory_name" value="<?= $Page->test_subcategory_name->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->test_subcategory_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->test_subcategory_name->formatPattern()) ?>"<?= $Page->test_subcategory_name->editAttributes() ?> aria-describedby="x_test_subcategory_name_help">
<?= $Page->test_subcategory_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->test_subcategory_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <div id="r_description"<?= $Page->description->rowAttributes() ?>>
        <label id="elh_jdh_lab_test_subcategories_description" class="<?= $Page->LeftColumnClass ?>"><?= $Page->description->caption() ?><?= $Page->description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->description->cellAttributes() ?>>
<span id="el_jdh_lab_test_subcategories_description">
<?php $Page->description->EditAttrs->appendClass("editor"); ?>
<textarea data-table="jdh_lab_test_subcategories" data-field="x_description" name="x_description" id="x_description" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->description->getPlaceHolder()) ?>"<?= $Page->description->editAttributes() ?> aria-describedby="x_description_help"><?= $Page->description->EditValue ?></textarea>
<?= $Page->description->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->description->getErrorMessage() ?></div>
<script>
loadjs.ready(["fjdh_lab_test_subcategoriesadd", "editor"], function() {
    ew.createEditor("fjdh_lab_test_subcategoriesadd", "x_description", 35, 4, <?= $Page->description->ReadOnly || false ? "true" : "false" ?>);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fjdh_lab_test_subcategoriesadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fjdh_lab_test_subcategoriesadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("jdh_lab_test_subcategories");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
