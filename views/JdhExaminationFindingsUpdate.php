<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$JdhExaminationFindingsUpdate = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_examination_findings: currentTable } });
var currentPageID = ew.PAGE_ID = "update";
var currentForm;
var fjdh_examination_findingsupdate;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_examination_findingsupdate")
        .setPageId("update")

        // Add fields
        .setFields([
            ["patient_id", [fields.patient_id.visible && fields.patient_id.required ? ew.Validators.required(fields.patient_id.caption) : null, ew.Validators.integer, ew.Validators.selected], fields.patient_id.isInvalid],
            ["general_exams", [fields.general_exams.visible && fields.general_exams.required ? ew.Validators.required(fields.general_exams.caption) : null], fields.general_exams.isInvalid],
            ["systematic_exams", [fields.systematic_exams.visible && fields.systematic_exams.required ? ew.Validators.required(fields.systematic_exams.caption) : null], fields.systematic_exams.isInvalid],
            ["submitted_by_user_id", [fields.submitted_by_user_id.visible && fields.submitted_by_user_id.required ? ew.Validators.required(fields.submitted_by_user_id.caption) : null], fields.submitted_by_user_id.isInvalid]
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
<form name="fjdh_examination_findingsupdate" id="fjdh_examination_findingsupdate" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jdh_examination_findings">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div id="tbl_jdh_examination_findingsupdate" class="ew-update-div"><!-- page -->
    <?php if (!$Page->isConfirm()) { // Confirm page ?>
    <div class="form-check">
        <input type="checkbox" class="form-check-input" name="u" id="u" data-ew-action="select-all"><label class="form-check-label" for="u"><?= $Language->phrase("SelectAll") ?></label>
    </div>
    <?php } ?>
<?php if ($Page->patient_id->Visible && (!$Page->isConfirm() || $Page->patient_id->multiUpdateSelected())) { // patient_id ?>
    <div id="r_patient_id"<?= $Page->patient_id->rowAttributes() ?>>
        <label class="<?= $Page->LeftColumnClass ?>">
            <div class="form-check">
                <input type="checkbox" name="u_patient_id" id="u_patient_id" class="form-check-input ew-multi-select" value="1"<?= $Page->patient_id->multiUpdateSelected() ? " checked" : "" ?>>
                <label class="form-check-label" for="u_patient_id"><?= $Page->patient_id->caption() ?></label>
            </div>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->patient_id->cellAttributes() ?>>
                <?php if ($Page->patient_id->getSessionValue() != "") { ?>
                <span<?= $Page->patient_id->viewAttributes() ?>>
                <span class="form-control-plaintext"><?= $Page->patient_id->getDisplayValue($Page->patient_id->ViewValue) ?></span></span>
                <input type="hidden" id="x_patient_id" name="x_patient_id" value="<?= HtmlEncode($Page->patient_id->CurrentValue) ?>" data-hidden="1">
                <?php } else { ?>
                <span id="el_jdh_examination_findings_patient_id">
                <?php
                if (IsRTL()) {
                    $Page->patient_id->EditAttrs["dir"] = "rtl";
                }
                ?>
                <span id="as_x_patient_id" class="ew-auto-suggest">
                    <input type="<?= $Page->patient_id->getInputTextType() ?>" class="form-control" name="sv_x_patient_id" id="sv_x_patient_id" value="<?= RemoveHtml($Page->patient_id->EditValue) ?>" autocomplete="off" size="30" placeholder="<?= HtmlEncode($Page->patient_id->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Page->patient_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->patient_id->formatPattern()) ?>"<?= $Page->patient_id->editAttributes() ?> aria-describedby="x_patient_id_help">
                </span>
                <selection-list hidden class="form-control" data-table="jdh_examination_findings" data-field="x_patient_id" data-input="sv_x_patient_id" data-value-separator="<?= $Page->patient_id->displayValueSeparatorAttribute() ?>" name="x_patient_id" id="x_patient_id" value="<?= HtmlEncode($Page->patient_id->CurrentValue) ?>"></selection-list>
                <?= $Page->patient_id->getCustomMessage() ?>
                <div class="invalid-feedback"><?= $Page->patient_id->getErrorMessage() ?></div>
                <script>
                loadjs.ready("fjdh_examination_findingsupdate", function() {
                    fjdh_examination_findingsupdate.createAutoSuggest(Object.assign({"id":"x_patient_id","forceSelect":false}, { lookupAllDisplayFields: <?= $Page->patient_id->Lookup->LookupAllDisplayFields ? "true" : "false" ?> }, ew.vars.tables.jdh_examination_findings.fields.patient_id.autoSuggestOptions));
                });
                </script>
                <?= $Page->patient_id->Lookup->getParamTag($Page, "p_x_patient_id") ?>
                </span>
                <?php } ?>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->general_exams->Visible && (!$Page->isConfirm() || $Page->general_exams->multiUpdateSelected())) { // general_exams ?>
    <div id="r_general_exams"<?= $Page->general_exams->rowAttributes() ?>>
        <label for="x_general_exams" class="<?= $Page->LeftColumnClass ?>">
            <div class="form-check">
                <input type="checkbox" name="u_general_exams" id="u_general_exams" class="form-check-input ew-multi-select" value="1"<?= $Page->general_exams->multiUpdateSelected() ? " checked" : "" ?>>
                <label class="form-check-label" for="u_general_exams"><?= $Page->general_exams->caption() ?></label>
            </div>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->general_exams->cellAttributes() ?>>
                <span id="el_jdh_examination_findings_general_exams">
                <input type="<?= $Page->general_exams->getInputTextType() ?>" name="x_general_exams" id="x_general_exams" data-table="jdh_examination_findings" data-field="x_general_exams" value="<?= $Page->general_exams->EditValue ?>" maxlength="200" placeholder="<?= HtmlEncode($Page->general_exams->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->general_exams->formatPattern()) ?>"<?= $Page->general_exams->editAttributes() ?> aria-describedby="x_general_exams_help">
                <?= $Page->general_exams->getCustomMessage() ?>
                <div class="invalid-feedback"><?= $Page->general_exams->getErrorMessage() ?></div>
                </span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->systematic_exams->Visible && (!$Page->isConfirm() || $Page->systematic_exams->multiUpdateSelected())) { // systematic_exams ?>
    <div id="r_systematic_exams"<?= $Page->systematic_exams->rowAttributes() ?>>
        <label for="x_systematic_exams" class="<?= $Page->LeftColumnClass ?>">
            <div class="form-check">
                <input type="checkbox" name="u_systematic_exams" id="u_systematic_exams" class="form-check-input ew-multi-select" value="1"<?= $Page->systematic_exams->multiUpdateSelected() ? " checked" : "" ?>>
                <label class="form-check-label" for="u_systematic_exams"><?= $Page->systematic_exams->caption() ?></label>
            </div>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->systematic_exams->cellAttributes() ?>>
                <span id="el_jdh_examination_findings_systematic_exams">
                <input type="<?= $Page->systematic_exams->getInputTextType() ?>" name="x_systematic_exams" id="x_systematic_exams" data-table="jdh_examination_findings" data-field="x_systematic_exams" value="<?= $Page->systematic_exams->EditValue ?>" maxlength="200" placeholder="<?= HtmlEncode($Page->systematic_exams->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->systematic_exams->formatPattern()) ?>"<?= $Page->systematic_exams->editAttributes() ?> aria-describedby="x_systematic_exams_help">
                <?= $Page->systematic_exams->getCustomMessage() ?>
                <div class="invalid-feedback"><?= $Page->systematic_exams->getErrorMessage() ?></div>
                </span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->submitted_by_user_id->Visible && (!$Page->isConfirm() || $Page->submitted_by_user_id->multiUpdateSelected())) { // submitted_by_user_id ?>
    <div id="r_submitted_by_user_id"<?= $Page->submitted_by_user_id->rowAttributes() ?>>
        <label for="x_submitted_by_user_id" class="<?= $Page->LeftColumnClass ?>">
            <div class="form-check">
                <input type="checkbox" name="u_submitted_by_user_id" id="u_submitted_by_user_id" class="form-check-input ew-multi-select" value="1"<?= $Page->submitted_by_user_id->multiUpdateSelected() ? " checked" : "" ?>>
                <label class="form-check-label" for="u_submitted_by_user_id"><?= $Page->submitted_by_user_id->caption() ?></label>
            </div>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->submitted_by_user_id->cellAttributes() ?>>
            </div>
        </div>
    </div>
<?php } ?>
</div><!-- /page -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fjdh_examination_findingsupdate"><?= $Language->phrase("UpdateBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fjdh_examination_findingsupdate" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("jdh_examination_findings");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
