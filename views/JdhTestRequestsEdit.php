<?php

namespace PHPMaker2024\jootidigitalhealthcare;

// Page object
$JdhTestRequestsEdit = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="fjdh_test_requestsedit" id="fjdh_test_requestsedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_test_requests: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fjdh_test_requestsedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_test_requestsedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["request_id", [fields.request_id.visible && fields.request_id.required ? ew.Validators.required(fields.request_id.caption) : null], fields.request_id.isInvalid],
            ["patient_id", [fields.patient_id.visible && fields.patient_id.required ? ew.Validators.required(fields.patient_id.caption) : null], fields.patient_id.isInvalid],
            ["request_title", [fields.request_title.visible && fields.request_title.required ? ew.Validators.required(fields.request_title.caption) : null], fields.request_title.isInvalid],
            ["request_service_id", [fields.request_service_id.visible && fields.request_service_id.required ? ew.Validators.required(fields.request_service_id.caption) : null], fields.request_service_id.isInvalid],
            ["request_description", [fields.request_description.visible && fields.request_description.required ? ew.Validators.required(fields.request_description.caption) : null], fields.request_description.isInvalid],
            ["requested_by_user_id", [fields.requested_by_user_id.visible && fields.requested_by_user_id.required ? ew.Validators.required(fields.requested_by_user_id.caption) : null], fields.requested_by_user_id.isInvalid],
            ["status_id", [fields.status_id.visible && fields.status_id.required ? ew.Validators.required(fields.status_id.caption) : null], fields.status_id.isInvalid]
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
            "status_id": <?= $Page->status_id->toClientList($Page) ?>,
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
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jdh_test_requests">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "jdh_patients") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="jdh_patients">
<input type="hidden" name="fk_patient_id" value="<?= HtmlEncode($Page->patient_id->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->request_id->Visible) { // request_id ?>
    <div id="r_request_id"<?= $Page->request_id->rowAttributes() ?>>
        <label id="elh_jdh_test_requests_request_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->request_id->caption() ?><?= $Page->request_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->request_id->cellAttributes() ?>>
<span id="el_jdh_test_requests_request_id">
<span<?= $Page->request_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->request_id->getDisplayValue($Page->request_id->EditValue))) ?>"></span>
<input type="hidden" data-table="jdh_test_requests" data-field="x_request_id" data-hidden="1" name="x_request_id" id="x_request_id" value="<?= HtmlEncode($Page->request_id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
    <div id="r_patient_id"<?= $Page->patient_id->rowAttributes() ?>>
        <label id="elh_jdh_test_requests_patient_id" for="x_patient_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->patient_id->caption() ?><?= $Page->patient_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->patient_id->cellAttributes() ?>>
<span id="el_jdh_test_requests_patient_id">
<span<?= $Page->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->patient_id->getDisplayValue($Page->patient_id->EditValue) ?></span></span>
<input type="hidden" data-table="jdh_test_requests" data-field="x_patient_id" data-hidden="1" name="x_patient_id" id="x_patient_id" value="<?= HtmlEncode($Page->patient_id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->request_title->Visible) { // request_title ?>
    <div id="r_request_title"<?= $Page->request_title->rowAttributes() ?>>
        <label id="elh_jdh_test_requests_request_title" for="x_request_title" class="<?= $Page->LeftColumnClass ?>"><?= $Page->request_title->caption() ?><?= $Page->request_title->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->request_title->cellAttributes() ?>>
<span id="el_jdh_test_requests_request_title">
<span<?= $Page->request_title->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->request_title->getDisplayValue($Page->request_title->EditValue))) ?>"></span>
<input type="hidden" data-table="jdh_test_requests" data-field="x_request_title" data-hidden="1" name="x_request_title" id="x_request_title" value="<?= HtmlEncode($Page->request_title->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->request_service_id->Visible) { // request_service_id ?>
    <div id="r_request_service_id"<?= $Page->request_service_id->rowAttributes() ?>>
        <label id="elh_jdh_test_requests_request_service_id" for="x_request_service_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->request_service_id->caption() ?><?= $Page->request_service_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->request_service_id->cellAttributes() ?>>
<span id="el_jdh_test_requests_request_service_id">
<span<?= $Page->request_service_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->request_service_id->getDisplayValue($Page->request_service_id->EditValue) ?></span></span>
<input type="hidden" data-table="jdh_test_requests" data-field="x_request_service_id" data-hidden="1" name="x_request_service_id" id="x_request_service_id" value="<?= HtmlEncode($Page->request_service_id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->request_description->Visible) { // request_description ?>
    <div id="r_request_description"<?= $Page->request_description->rowAttributes() ?>>
        <label id="elh_jdh_test_requests_request_description" for="x_request_description" class="<?= $Page->LeftColumnClass ?>"><?= $Page->request_description->caption() ?><?= $Page->request_description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->request_description->cellAttributes() ?>>
<span id="el_jdh_test_requests_request_description">
<span<?= $Page->request_description->viewAttributes() ?>>
<?= $Page->request_description->EditValue ?></span>
<input type="hidden" data-table="jdh_test_requests" data-field="x_request_description" data-hidden="1" name="x_request_description" id="x_request_description" value="<?= HtmlEncode($Page->request_description->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status_id->Visible) { // status_id ?>
    <div id="r_status_id"<?= $Page->status_id->rowAttributes() ?>>
        <label id="elh_jdh_test_requests_status_id" for="x_status_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status_id->caption() ?><?= $Page->status_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->status_id->cellAttributes() ?>>
<span id="el_jdh_test_requests_status_id">
    <select
        id="x_status_id"
        name="x_status_id"
        class="form-select ew-select<?= $Page->status_id->isInvalidClass() ?>"
        <?php if (!$Page->status_id->IsNativeSelect) { ?>
        data-select2-id="fjdh_test_requestsedit_x_status_id"
        <?php } ?>
        data-table="jdh_test_requests"
        data-field="x_status_id"
        data-value-separator="<?= $Page->status_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->status_id->getPlaceHolder()) ?>"
        <?= $Page->status_id->editAttributes() ?>>
        <?= $Page->status_id->selectOptionListHtml("x_status_id") ?>
    </select>
    <?= $Page->status_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->status_id->getErrorMessage() ?></div>
<?php if (!$Page->status_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fjdh_test_requestsedit", function() {
    var options = { name: "x_status_id", selectId: "fjdh_test_requestsedit_x_status_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_test_requestsedit.lists.status_id?.lookupOptions.length) {
        options.data = { id: "x_status_id", form: "fjdh_test_requestsedit" };
    } else {
        options.ajax = { id: "x_status_id", form: "fjdh_test_requestsedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_test_requests.fields.status_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fjdh_test_requestsedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fjdh_test_requestsedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
<?php } ?>
    </div><!-- /buttons offset -->
<?= $Page->IsModal ? "</template>" : "</div>" ?><!-- /buttons .row -->
</form>
</main>
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
