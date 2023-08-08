<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$JdhTestReportsAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_test_reports: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fjdh_test_reportsadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_test_reportsadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["request_id", [fields.request_id.visible && fields.request_id.required ? ew.Validators.required(fields.request_id.caption) : null, ew.Validators.integer], fields.request_id.isInvalid],
            ["patient_id", [fields.patient_id.visible && fields.patient_id.required ? ew.Validators.required(fields.patient_id.caption) : null], fields.patient_id.isInvalid],
            ["report_findings", [fields.report_findings.visible && fields.report_findings.required ? ew.Validators.required(fields.report_findings.caption) : null], fields.report_findings.isInvalid],
            ["report_attachment", [fields.report_attachment.visible && fields.report_attachment.required ? ew.Validators.fileRequired(fields.report_attachment.caption) : null], fields.report_attachment.isInvalid],
            ["report_submittedby_user_id", [fields.report_submittedby_user_id.visible && fields.report_submittedby_user_id.required ? ew.Validators.required(fields.report_submittedby_user_id.caption) : null, ew.Validators.integer], fields.report_submittedby_user_id.isInvalid],
            ["report_date", [fields.report_date.visible && fields.report_date.required ? ew.Validators.required(fields.report_date.caption) : null, ew.Validators.datetime(fields.report_date.clientFormatPattern)], fields.report_date.isInvalid]
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
<form name="fjdh_test_reportsadd" id="fjdh_test_reportsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jdh_test_reports">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "jdh_test_requests") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="jdh_test_requests">
<input type="hidden" name="fk_request_id" value="<?= HtmlEncode($Page->request_id->getSessionValue()) ?>">
<?php } ?>
<?php if ($Page->getCurrentMasterTable() == "jdh_patients") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="jdh_patients">
<input type="hidden" name="fk_patient_id" value="<?= HtmlEncode($Page->patient_id->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->request_id->Visible) { // request_id ?>
    <div id="r_request_id"<?= $Page->request_id->rowAttributes() ?>>
        <label id="elh_jdh_test_reports_request_id" for="x_request_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->request_id->caption() ?><?= $Page->request_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->request_id->cellAttributes() ?>>
<?php if ($Page->request_id->getSessionValue() != "") { ?>
<span<?= $Page->request_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->request_id->getDisplayValue($Page->request_id->ViewValue))) ?>"></span>
<input type="hidden" id="x_request_id" name="x_request_id" value="<?= HtmlEncode($Page->request_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_jdh_test_reports_request_id">
<input type="<?= $Page->request_id->getInputTextType() ?>" name="x_request_id" id="x_request_id" data-table="jdh_test_reports" data-field="x_request_id" value="<?= $Page->request_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->request_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->request_id->formatPattern()) ?>"<?= $Page->request_id->editAttributes() ?> aria-describedby="x_request_id_help">
<?= $Page->request_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->request_id->getErrorMessage() ?></div>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
    <div id="r_patient_id"<?= $Page->patient_id->rowAttributes() ?>>
        <label id="elh_jdh_test_reports_patient_id" for="x_patient_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->patient_id->caption() ?><?= $Page->patient_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->patient_id->cellAttributes() ?>>
<?php if ($Page->patient_id->getSessionValue() != "") { ?>
<span<?= $Page->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->patient_id->getDisplayValue($Page->patient_id->ViewValue) ?></span></span>
<input type="hidden" id="x_patient_id" name="x_patient_id" value="<?= HtmlEncode($Page->patient_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_jdh_test_reports_patient_id">
    <select
        id="x_patient_id"
        name="x_patient_id"
        class="form-select ew-select<?= $Page->patient_id->isInvalidClass() ?>"
        data-select2-id="fjdh_test_reportsadd_x_patient_id"
        data-table="jdh_test_reports"
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
loadjs.ready("fjdh_test_reportsadd", function() {
    var options = { name: "x_patient_id", selectId: "fjdh_test_reportsadd_x_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_test_reportsadd.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x_patient_id", form: "fjdh_test_reportsadd" };
    } else {
        options.ajax = { id: "x_patient_id", form: "fjdh_test_reportsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_test_reports.fields.patient_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->report_findings->Visible) { // report_findings ?>
    <div id="r_report_findings"<?= $Page->report_findings->rowAttributes() ?>>
        <label id="elh_jdh_test_reports_report_findings" class="<?= $Page->LeftColumnClass ?>"><?= $Page->report_findings->caption() ?><?= $Page->report_findings->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->report_findings->cellAttributes() ?>>
<span id="el_jdh_test_reports_report_findings">
<?php $Page->report_findings->EditAttrs->appendClass("editor"); ?>
<textarea data-table="jdh_test_reports" data-field="x_report_findings" name="x_report_findings" id="x_report_findings" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->report_findings->getPlaceHolder()) ?>"<?= $Page->report_findings->editAttributes() ?> aria-describedby="x_report_findings_help"><?= $Page->report_findings->EditValue ?></textarea>
<?= $Page->report_findings->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->report_findings->getErrorMessage() ?></div>
<script>
loadjs.ready(["fjdh_test_reportsadd", "editor"], function() {
    ew.createEditor("fjdh_test_reportsadd", "x_report_findings", 35, 4, <?= $Page->report_findings->ReadOnly || false ? "true" : "false" ?>);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->report_attachment->Visible) { // report_attachment ?>
    <div id="r_report_attachment"<?= $Page->report_attachment->rowAttributes() ?>>
        <label id="elh_jdh_test_reports_report_attachment" class="<?= $Page->LeftColumnClass ?>"><?= $Page->report_attachment->caption() ?><?= $Page->report_attachment->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->report_attachment->cellAttributes() ?>>
<span id="el_jdh_test_reports_report_attachment">
<div id="fd_x_report_attachment" class="fileinput-button ew-file-drop-zone">
    <input
        type="file"
        id="x_report_attachment"
        name="x_report_attachment"
        class="form-control ew-file-input"
        title="<?= $Page->report_attachment->title() ?>"
        lang="<?= CurrentLanguageID() ?>"
        data-table="jdh_test_reports"
        data-field="x_report_attachment"
        data-size="0"
        data-accept-file-types="<?= $Page->report_attachment->acceptFileTypes() ?>"
        data-max-file-size="<?= $Page->report_attachment->UploadMaxFileSize ?>"
        data-max-number-of-files="null"
        data-disable-image-crop="<?= $Page->report_attachment->ImageCropper ? 0 : 1 ?>"
        aria-describedby="x_report_attachment_help"
        <?= ($Page->report_attachment->ReadOnly || $Page->report_attachment->Disabled) ? " disabled" : "" ?>
        <?= $Page->report_attachment->editAttributes() ?>
    >
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<?= $Page->report_attachment->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->report_attachment->getErrorMessage() ?></div>
<input type="hidden" name="fn_x_report_attachment" id= "fn_x_report_attachment" value="<?= $Page->report_attachment->Upload->FileName ?>">
<input type="hidden" name="fa_x_report_attachment" id= "fa_x_report_attachment" value="0">
<table id="ft_x_report_attachment" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->report_submittedby_user_id->Visible) { // report_submittedby_user_id ?>
    <div id="r_report_submittedby_user_id"<?= $Page->report_submittedby_user_id->rowAttributes() ?>>
        <label id="elh_jdh_test_reports_report_submittedby_user_id" for="x_report_submittedby_user_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->report_submittedby_user_id->caption() ?><?= $Page->report_submittedby_user_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->report_submittedby_user_id->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn() && !$Page->userIDAllow("add")) { // Non system admin ?>
<span<?= $Page->report_submittedby_user_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->report_submittedby_user_id->getDisplayValue($Page->report_submittedby_user_id->EditValue))) ?>"></span>
<input type="hidden" data-table="jdh_test_reports" data-field="x_report_submittedby_user_id" data-hidden="1" name="x_report_submittedby_user_id" id="x_report_submittedby_user_id" value="<?= HtmlEncode($Page->report_submittedby_user_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el_jdh_test_reports_report_submittedby_user_id">
<input type="<?= $Page->report_submittedby_user_id->getInputTextType() ?>" name="x_report_submittedby_user_id" id="x_report_submittedby_user_id" data-table="jdh_test_reports" data-field="x_report_submittedby_user_id" value="<?= $Page->report_submittedby_user_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->report_submittedby_user_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->report_submittedby_user_id->formatPattern()) ?>"<?= $Page->report_submittedby_user_id->editAttributes() ?> aria-describedby="x_report_submittedby_user_id_help">
<?= $Page->report_submittedby_user_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->report_submittedby_user_id->getErrorMessage() ?></div>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->report_date->Visible) { // report_date ?>
    <div id="r_report_date"<?= $Page->report_date->rowAttributes() ?>>
        <label id="elh_jdh_test_reports_report_date" for="x_report_date" class="<?= $Page->LeftColumnClass ?>"><?= $Page->report_date->caption() ?><?= $Page->report_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->report_date->cellAttributes() ?>>
<span id="el_jdh_test_reports_report_date">
<input type="<?= $Page->report_date->getInputTextType() ?>" name="x_report_date" id="x_report_date" data-table="jdh_test_reports" data-field="x_report_date" value="<?= $Page->report_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->report_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->report_date->formatPattern()) ?>"<?= $Page->report_date->editAttributes() ?> aria-describedby="x_report_date_help">
<?= $Page->report_date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->report_date->getErrorMessage() ?></div>
<?php if (!$Page->report_date->ReadOnly && !$Page->report_date->Disabled && !isset($Page->report_date->EditAttrs["readonly"]) && !isset($Page->report_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjdh_test_reportsadd", "datetimepicker"], function () {
    let format = "<?= DateFormat(0) ?>",
        options = {
            localization: {
                locale: ew.LANGUAGE_ID + "-u-nu-" + ew.getNumberingSystem(),
                ...ew.language.phrase("datetimepicker")
            },
            display: {
                icons: {
                    previous: ew.IS_RTL ? "fa-solid fa-chevron-right" : "fa-solid fa-chevron-left",
                    next: ew.IS_RTL ? "fa-solid fa-chevron-left" : "fa-solid fa-chevron-right"
                },
                components: {
                    hours: !!format.match(/h/i),
                    minutes: !!format.match(/m/),
                    seconds: !!format.match(/s/i),
                    useTwentyfourHour: !!format.match(/H/)
                },
                theme: ew.isDark() ? "dark" : "auto"
            },
            meta: {
                format
            }
        };
    ew.createDateTimePicker("fjdh_test_reportsadd", "x_report_date", jQuery.extend(true, {"useCurrent":false,"display":{"sideBySide":false}}, options));
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
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fjdh_test_reportsadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fjdh_test_reportsadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("jdh_test_reports");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
