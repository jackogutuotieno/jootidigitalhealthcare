<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$JdhTestRequestsAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_test_requests: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fjdh_test_requestsadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_test_requestsadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["patient_id", [fields.patient_id.visible && fields.patient_id.required ? ew.Validators.required(fields.patient_id.caption) : null], fields.patient_id.isInvalid],
            ["request_title", [fields.request_title.visible && fields.request_title.required ? ew.Validators.required(fields.request_title.caption) : null], fields.request_title.isInvalid],
            ["request_category_id", [fields.request_category_id.visible && fields.request_category_id.required ? ew.Validators.required(fields.request_category_id.caption) : null], fields.request_category_id.isInvalid],
            ["request_subcategory_id", [fields.request_subcategory_id.visible && fields.request_subcategory_id.required ? ew.Validators.required(fields.request_subcategory_id.caption) : null], fields.request_subcategory_id.isInvalid],
            ["request_description", [fields.request_description.visible && fields.request_description.required ? ew.Validators.required(fields.request_description.caption) : null], fields.request_description.isInvalid],
            ["requested_by_user_id", [fields.requested_by_user_id.visible && fields.requested_by_user_id.required ? ew.Validators.required(fields.requested_by_user_id.caption) : null], fields.requested_by_user_id.isInvalid]
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
            "patient_id": <?= $Page->patient_id->toClientList($Page) ?>,
            "request_category_id": <?= $Page->request_category_id->toClientList($Page) ?>,
            "request_subcategory_id": <?= $Page->request_subcategory_id->toClientList($Page) ?>,
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
<form name="fjdh_test_requestsadd" id="fjdh_test_requestsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jdh_test_requests">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "jdh_patients") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="jdh_patients">
<input type="hidden" name="fk_patient_id" value="<?= HtmlEncode($Page->patient_id->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->patient_id->Visible) { // patient_id ?>
    <div id="r_patient_id"<?= $Page->patient_id->rowAttributes() ?>>
        <label id="elh_jdh_test_requests_patient_id" for="x_patient_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->patient_id->caption() ?><?= $Page->patient_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->patient_id->cellAttributes() ?>>
<?php if ($Page->patient_id->getSessionValue() != "") { ?>
<span<?= $Page->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->patient_id->getDisplayValue($Page->patient_id->ViewValue) ?></span></span>
<input type="hidden" id="x_patient_id" name="x_patient_id" value="<?= HtmlEncode($Page->patient_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_jdh_test_requests_patient_id">
    <select
        id="x_patient_id"
        name="x_patient_id"
        class="form-select ew-select<?= $Page->patient_id->isInvalidClass() ?>"
        data-select2-id="fjdh_test_requestsadd_x_patient_id"
        data-table="jdh_test_requests"
        data-field="x_patient_id"
        data-value-separator="<?= $Page->patient_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->patient_id->getPlaceHolder()) ?>"
        <?= $Page->patient_id->editAttributes() ?>>
        <?= $Page->patient_id->selectOptionListHtml("x_patient_id") ?>
    </select>
    <?= $Page->patient_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->patient_id->getErrorMessage() ?></div>
<?= $Page->patient_id->Lookup->getParamTag($Page, "p_x_patient_id") ?>
<script>
loadjs.ready("fjdh_test_requestsadd", function() {
    var options = { name: "x_patient_id", selectId: "fjdh_test_requestsadd_x_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_test_requestsadd.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x_patient_id", form: "fjdh_test_requestsadd" };
    } else {
        options.ajax = { id: "x_patient_id", form: "fjdh_test_requestsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_test_requests.fields.patient_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->request_title->Visible) { // request_title ?>
    <div id="r_request_title"<?= $Page->request_title->rowAttributes() ?>>
        <label id="elh_jdh_test_requests_request_title" for="x_request_title" class="<?= $Page->LeftColumnClass ?>"><?= $Page->request_title->caption() ?><?= $Page->request_title->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->request_title->cellAttributes() ?>>
<span id="el_jdh_test_requests_request_title">
<input type="<?= $Page->request_title->getInputTextType() ?>" name="x_request_title" id="x_request_title" data-table="jdh_test_requests" data-field="x_request_title" value="<?= $Page->request_title->EditValue ?>" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->request_title->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->request_title->formatPattern()) ?>"<?= $Page->request_title->editAttributes() ?> aria-describedby="x_request_title_help">
<?= $Page->request_title->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->request_title->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->request_category_id->Visible) { // request_category_id ?>
    <div id="r_request_category_id"<?= $Page->request_category_id->rowAttributes() ?>>
        <label id="elh_jdh_test_requests_request_category_id" for="x_request_category_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->request_category_id->caption() ?><?= $Page->request_category_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->request_category_id->cellAttributes() ?>>
<span id="el_jdh_test_requests_request_category_id">
    <select
        id="x_request_category_id"
        name="x_request_category_id"
        class="form-select ew-select<?= $Page->request_category_id->isInvalidClass() ?>"
        data-select2-id="fjdh_test_requestsadd_x_request_category_id"
        data-table="jdh_test_requests"
        data-field="x_request_category_id"
        data-value-separator="<?= $Page->request_category_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->request_category_id->getPlaceHolder()) ?>"
        data-ew-action="update-options"
        <?= $Page->request_category_id->editAttributes() ?>>
        <?= $Page->request_category_id->selectOptionListHtml("x_request_category_id") ?>
    </select>
    <?= $Page->request_category_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->request_category_id->getErrorMessage() ?></div>
<?= $Page->request_category_id->Lookup->getParamTag($Page, "p_x_request_category_id") ?>
<script>
loadjs.ready("fjdh_test_requestsadd", function() {
    var options = { name: "x_request_category_id", selectId: "fjdh_test_requestsadd_x_request_category_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_test_requestsadd.lists.request_category_id?.lookupOptions.length) {
        options.data = { id: "x_request_category_id", form: "fjdh_test_requestsadd" };
    } else {
        options.ajax = { id: "x_request_category_id", form: "fjdh_test_requestsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_test_requests.fields.request_category_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->request_subcategory_id->Visible) { // request_subcategory_id ?>
    <div id="r_request_subcategory_id"<?= $Page->request_subcategory_id->rowAttributes() ?>>
        <label id="elh_jdh_test_requests_request_subcategory_id" for="x_request_subcategory_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->request_subcategory_id->caption() ?><?= $Page->request_subcategory_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->request_subcategory_id->cellAttributes() ?>>
<span id="el_jdh_test_requests_request_subcategory_id">
    <select
        id="x_request_subcategory_id"
        name="x_request_subcategory_id"
        class="form-select ew-select<?= $Page->request_subcategory_id->isInvalidClass() ?>"
        data-select2-id="fjdh_test_requestsadd_x_request_subcategory_id"
        data-table="jdh_test_requests"
        data-field="x_request_subcategory_id"
        data-value-separator="<?= $Page->request_subcategory_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->request_subcategory_id->getPlaceHolder()) ?>"
        <?= $Page->request_subcategory_id->editAttributes() ?>>
        <?= $Page->request_subcategory_id->selectOptionListHtml("x_request_subcategory_id") ?>
    </select>
    <?= $Page->request_subcategory_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->request_subcategory_id->getErrorMessage() ?></div>
<?= $Page->request_subcategory_id->Lookup->getParamTag($Page, "p_x_request_subcategory_id") ?>
<script>
loadjs.ready("fjdh_test_requestsadd", function() {
    var options = { name: "x_request_subcategory_id", selectId: "fjdh_test_requestsadd_x_request_subcategory_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_test_requestsadd.lists.request_subcategory_id?.lookupOptions.length) {
        options.data = { id: "x_request_subcategory_id", form: "fjdh_test_requestsadd" };
    } else {
        options.ajax = { id: "x_request_subcategory_id", form: "fjdh_test_requestsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_test_requests.fields.request_subcategory_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->request_description->Visible) { // request_description ?>
    <div id="r_request_description"<?= $Page->request_description->rowAttributes() ?>>
        <label id="elh_jdh_test_requests_request_description" for="x_request_description" class="<?= $Page->LeftColumnClass ?>"><?= $Page->request_description->caption() ?><?= $Page->request_description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->request_description->cellAttributes() ?>>
<span id="el_jdh_test_requests_request_description">
<textarea data-table="jdh_test_requests" data-field="x_request_description" name="x_request_description" id="x_request_description" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->request_description->getPlaceHolder()) ?>"<?= $Page->request_description->editAttributes() ?> aria-describedby="x_request_description_help"><?= $Page->request_description->EditValue ?></textarea>
<?= $Page->request_description->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->request_description->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php
    if (in_array("jdh_test_reports", explode(",", $Page->getCurrentDetailTable())) && $jdh_test_reports->DetailAdd) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("jdh_test_reports", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "JdhTestReportsGrid.php" ?>
<?php } ?>
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fjdh_test_requestsadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fjdh_test_requestsadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("jdh_test_requests");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
