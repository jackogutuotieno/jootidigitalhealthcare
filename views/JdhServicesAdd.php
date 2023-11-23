<?php

namespace PHPMaker2024\jootidigitalhealthcare;

// Page object
$JdhServicesAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_services: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fjdh_servicesadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_servicesadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["category_id", [fields.category_id.visible && fields.category_id.required ? ew.Validators.required(fields.category_id.caption) : null], fields.category_id.isInvalid],
            ["subcategory_id", [fields.subcategory_id.visible && fields.subcategory_id.required ? ew.Validators.required(fields.subcategory_id.caption) : null], fields.subcategory_id.isInvalid],
            ["service_name", [fields.service_name.visible && fields.service_name.required ? ew.Validators.required(fields.service_name.caption) : null], fields.service_name.isInvalid],
            ["service_cost", [fields.service_cost.visible && fields.service_cost.required ? ew.Validators.required(fields.service_cost.caption) : null, ew.Validators.integer], fields.service_cost.isInvalid],
            ["service_description", [fields.service_description.visible && fields.service_description.required ? ew.Validators.required(fields.service_description.caption) : null], fields.service_description.isInvalid]
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
            "category_id": <?= $Page->category_id->toClientList($Page) ?>,
            "subcategory_id": <?= $Page->subcategory_id->toClientList($Page) ?>,
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
<form name="fjdh_servicesadd" id="fjdh_servicesadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jdh_services">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->category_id->Visible) { // category_id ?>
    <div id="r_category_id"<?= $Page->category_id->rowAttributes() ?>>
        <label id="elh_jdh_services_category_id" for="x_category_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->category_id->caption() ?><?= $Page->category_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->category_id->cellAttributes() ?>>
<span id="el_jdh_services_category_id">
    <select
        id="x_category_id"
        name="x_category_id"
        class="form-select ew-select<?= $Page->category_id->isInvalidClass() ?>"
        <?php if (!$Page->category_id->IsNativeSelect) { ?>
        data-select2-id="fjdh_servicesadd_x_category_id"
        <?php } ?>
        data-table="jdh_services"
        data-field="x_category_id"
        data-value-separator="<?= $Page->category_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->category_id->getPlaceHolder()) ?>"
        data-ew-action="update-options"
        <?= $Page->category_id->editAttributes() ?>>
        <?= $Page->category_id->selectOptionListHtml("x_category_id") ?>
    </select>
    <?= $Page->category_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->category_id->getErrorMessage() ?></div>
<?= $Page->category_id->Lookup->getParamTag($Page, "p_x_category_id") ?>
<?php if (!$Page->category_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fjdh_servicesadd", function() {
    var options = { name: "x_category_id", selectId: "fjdh_servicesadd_x_category_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_servicesadd.lists.category_id?.lookupOptions.length) {
        options.data = { id: "x_category_id", form: "fjdh_servicesadd" };
    } else {
        options.ajax = { id: "x_category_id", form: "fjdh_servicesadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_services.fields.category_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->subcategory_id->Visible) { // subcategory_id ?>
    <div id="r_subcategory_id"<?= $Page->subcategory_id->rowAttributes() ?>>
        <label id="elh_jdh_services_subcategory_id" for="x_subcategory_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->subcategory_id->caption() ?><?= $Page->subcategory_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->subcategory_id->cellAttributes() ?>>
<span id="el_jdh_services_subcategory_id">
    <select
        id="x_subcategory_id"
        name="x_subcategory_id"
        class="form-select ew-select<?= $Page->subcategory_id->isInvalidClass() ?>"
        <?php if (!$Page->subcategory_id->IsNativeSelect) { ?>
        data-select2-id="fjdh_servicesadd_x_subcategory_id"
        <?php } ?>
        data-table="jdh_services"
        data-field="x_subcategory_id"
        data-value-separator="<?= $Page->subcategory_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->subcategory_id->getPlaceHolder()) ?>"
        <?= $Page->subcategory_id->editAttributes() ?>>
        <?= $Page->subcategory_id->selectOptionListHtml("x_subcategory_id") ?>
    </select>
    <?= $Page->subcategory_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->subcategory_id->getErrorMessage() ?></div>
<?= $Page->subcategory_id->Lookup->getParamTag($Page, "p_x_subcategory_id") ?>
<?php if (!$Page->subcategory_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fjdh_servicesadd", function() {
    var options = { name: "x_subcategory_id", selectId: "fjdh_servicesadd_x_subcategory_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_servicesadd.lists.subcategory_id?.lookupOptions.length) {
        options.data = { id: "x_subcategory_id", form: "fjdh_servicesadd" };
    } else {
        options.ajax = { id: "x_subcategory_id", form: "fjdh_servicesadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_services.fields.subcategory_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->service_name->Visible) { // service_name ?>
    <div id="r_service_name"<?= $Page->service_name->rowAttributes() ?>>
        <label id="elh_jdh_services_service_name" for="x_service_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->service_name->caption() ?><?= $Page->service_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->service_name->cellAttributes() ?>>
<span id="el_jdh_services_service_name">
<input type="<?= $Page->service_name->getInputTextType() ?>" name="x_service_name" id="x_service_name" data-table="jdh_services" data-field="x_service_name" value="<?= $Page->service_name->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->service_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->service_name->formatPattern()) ?>"<?= $Page->service_name->editAttributes() ?> aria-describedby="x_service_name_help">
<?= $Page->service_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->service_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->service_cost->Visible) { // service_cost ?>
    <div id="r_service_cost"<?= $Page->service_cost->rowAttributes() ?>>
        <label id="elh_jdh_services_service_cost" for="x_service_cost" class="<?= $Page->LeftColumnClass ?>"><?= $Page->service_cost->caption() ?><?= $Page->service_cost->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->service_cost->cellAttributes() ?>>
<span id="el_jdh_services_service_cost">
<input type="<?= $Page->service_cost->getInputTextType() ?>" name="x_service_cost" id="x_service_cost" data-table="jdh_services" data-field="x_service_cost" value="<?= $Page->service_cost->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->service_cost->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->service_cost->formatPattern()) ?>"<?= $Page->service_cost->editAttributes() ?> aria-describedby="x_service_cost_help">
<?= $Page->service_cost->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->service_cost->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->service_description->Visible) { // service_description ?>
    <div id="r_service_description"<?= $Page->service_description->rowAttributes() ?>>
        <label id="elh_jdh_services_service_description" for="x_service_description" class="<?= $Page->LeftColumnClass ?>"><?= $Page->service_description->caption() ?><?= $Page->service_description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->service_description->cellAttributes() ?>>
<span id="el_jdh_services_service_description">
<textarea data-table="jdh_services" data-field="x_service_description" name="x_service_description" id="x_service_description" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->service_description->getPlaceHolder()) ?>"<?= $Page->service_description->editAttributes() ?> aria-describedby="x_service_description_help"><?= $Page->service_description->EditValue ?></textarea>
<?= $Page->service_description->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->service_description->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fjdh_servicesadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fjdh_servicesadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("jdh_services");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
