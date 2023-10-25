<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$JdhPatientsSearch = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_patients: currentTable } });
var currentPageID = ew.PAGE_ID = "search";
var currentForm;
var fjdh_patientssearch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery,
        fields = currentTable.fields;

    // Form object for search
    let form = new ew.FormBuilder()
        .setId("fjdh_patientssearch")
        .setPageId("search")
<?php if ($Page->IsModal && $Page->UseAjaxActions) { ?>
        .setSubmitWithFetch(true)
<?php } ?>

        // Add fields
        .addFields([
            ["patient_id", [ew.Validators.integer], fields.patient_id.isInvalid],
            ["patient_ip_number", [], fields.patient_ip_number.isInvalid],
            ["patient_name", [], fields.patient_name.isInvalid],
            ["patient_dob_year", [ew.Validators.integer], fields.patient_dob_year.isInvalid],
            ["patient_age", [], fields.patient_age.isInvalid],
            ["is_inpatient", [], fields.is_inpatient.isInvalid]
        ])
        // Validate form
        .setValidate(
            async function () {
                if (!this.validateRequired)
                    return true; // Ignore validation
                let fobj = this.getForm();

                // Validate fields
                if (!this.validateFields())
                    return false;

                // Call Form_CustomValidate event
                if (!(await this.customValidate?.(fobj) ?? true)) {
                    this.focus();
                    return false;
                }
                return true;
            }
        )

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
            "is_inpatient": <?= $Page->is_inpatient->toClientList($Page) ?>,
        })
        .build();
    window[form.id] = form;
<?php if ($Page->IsModal) { ?>
    currentAdvancedSearchForm = form;
<?php } else { ?>
    currentForm = form;
<?php } ?>
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
<form name="fjdh_patientssearch" id="fjdh_patientssearch" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jdh_patients">
<input type="hidden" name="action" id="action" value="search">
<?php if ($Page->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<div class="ew-search-div"><!-- page* -->
<?php if ($Page->patient_id->Visible) { // patient_id ?>
    <div id="r_patient_id" class="row"<?= $Page->patient_id->rowAttributes() ?>>
        <label for="x_patient_id" class="<?= $Page->LeftColumnClass ?>"><span id="elh_jdh_patients_patient_id"><?= $Page->patient_id->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_patient_id" id="z_patient_id" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->patient_id->cellAttributes() ?>>
                <div class="d-flex align-items-start">
                <span id="el_jdh_patients_patient_id" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->patient_id->getInputTextType() ?>" name="x_patient_id" id="x_patient_id" data-table="jdh_patients" data-field="x_patient_id" value="<?= $Page->patient_id->EditValue ?>" placeholder="<?= HtmlEncode($Page->patient_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->patient_id->formatPattern()) ?>"<?= $Page->patient_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->patient_id->getErrorMessage(false) ?></div>
</span>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->patient_ip_number->Visible) { // patient_ip_number ?>
    <div id="r_patient_ip_number" class="row"<?= $Page->patient_ip_number->rowAttributes() ?>>
        <label for="x_patient_ip_number" class="<?= $Page->LeftColumnClass ?>"><span id="elh_jdh_patients_patient_ip_number"><?= $Page->patient_ip_number->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_patient_ip_number" id="z_patient_ip_number" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->patient_ip_number->cellAttributes() ?>>
                <div class="d-flex align-items-start">
                <span id="el_jdh_patients_patient_ip_number" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->patient_ip_number->getInputTextType() ?>" name="x_patient_ip_number" id="x_patient_ip_number" data-table="jdh_patients" data-field="x_patient_ip_number" value="<?= $Page->patient_ip_number->EditValue ?>" size="30" maxlength="13" placeholder="<?= HtmlEncode($Page->patient_ip_number->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->patient_ip_number->formatPattern()) ?>"<?= $Page->patient_ip_number->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->patient_ip_number->getErrorMessage(false) ?></div>
</span>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->patient_name->Visible) { // patient_name ?>
    <div id="r_patient_name" class="row"<?= $Page->patient_name->rowAttributes() ?>>
        <label for="x_patient_name" class="<?= $Page->LeftColumnClass ?>"><span id="elh_jdh_patients_patient_name"><?= $Page->patient_name->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_patient_name" id="z_patient_name" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->patient_name->cellAttributes() ?>>
                <div class="d-flex align-items-start">
                <span id="el_jdh_patients_patient_name" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->patient_name->getInputTextType() ?>" name="x_patient_name" id="x_patient_name" data-table="jdh_patients" data-field="x_patient_name" value="<?= $Page->patient_name->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->patient_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->patient_name->formatPattern()) ?>"<?= $Page->patient_name->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->patient_name->getErrorMessage(false) ?></div>
</span>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->patient_dob_year->Visible) { // patient_dob_year ?>
    <div id="r_patient_dob_year" class="row"<?= $Page->patient_dob_year->rowAttributes() ?>>
        <label for="x_patient_dob_year" class="<?= $Page->LeftColumnClass ?>"><span id="elh_jdh_patients_patient_dob_year"><?= $Page->patient_dob_year->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_patient_dob_year" id="z_patient_dob_year" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->patient_dob_year->cellAttributes() ?>>
                <div class="d-flex align-items-start">
                <span id="el_jdh_patients_patient_dob_year" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->patient_dob_year->getInputTextType() ?>" name="x_patient_dob_year" id="x_patient_dob_year" data-table="jdh_patients" data-field="x_patient_dob_year" value="<?= $Page->patient_dob_year->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->patient_dob_year->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->patient_dob_year->formatPattern()) ?>"<?= $Page->patient_dob_year->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->patient_dob_year->getErrorMessage(false) ?></div>
</span>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->patient_age->Visible) { // patient_age ?>
    <div id="r_patient_age" class="row"<?= $Page->patient_age->rowAttributes() ?>>
        <label class="<?= $Page->LeftColumnClass ?>"><span id="elh_jdh_patients_patient_age"><?= $Page->patient_age->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_patient_age" id="z_patient_age" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->patient_age->cellAttributes() ?>>
                <div class="d-flex align-items-start">
                <span id="el_jdh_patients_patient_age" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->patient_age->getInputTextType() ?>" name="x_patient_age" id="x_patient_age" data-table="jdh_patients" data-field="x_patient_age" value="<?= $Page->patient_age->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->patient_age->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->patient_age->formatPattern()) ?>"<?= $Page->patient_age->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->patient_age->getErrorMessage(false) ?></div>
</span>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->is_inpatient->Visible) { // is_inpatient ?>
    <div id="r_is_inpatient" class="row"<?= $Page->is_inpatient->rowAttributes() ?>>
        <label for="x_is_inpatient" class="<?= $Page->LeftColumnClass ?>"><span id="elh_jdh_patients_is_inpatient"><?= $Page->is_inpatient->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_is_inpatient" id="z_is_inpatient" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->is_inpatient->cellAttributes() ?>>
                <div class="d-flex align-items-start">
                <span id="el_jdh_patients_is_inpatient" class="ew-search-field ew-search-field-single">
    <select
        id="x_is_inpatient"
        name="x_is_inpatient"
        class="form-select ew-select<?= $Page->is_inpatient->isInvalidClass() ?>"
        data-select2-id="fjdh_patientssearch_x_is_inpatient"
        data-table="jdh_patients"
        data-field="x_is_inpatient"
        data-value-separator="<?= $Page->is_inpatient->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->is_inpatient->getPlaceHolder()) ?>"
        <?= $Page->is_inpatient->editAttributes() ?>>
        <?= $Page->is_inpatient->selectOptionListHtml("x_is_inpatient") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->is_inpatient->getErrorMessage(false) ?></div>
<script>
loadjs.ready("fjdh_patientssearch", function() {
    var options = { name: "x_is_inpatient", selectId: "fjdh_patientssearch_x_is_inpatient" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_patientssearch.lists.is_inpatient?.lookupOptions.length) {
        options.data = { id: "x_is_inpatient", form: "fjdh_patientssearch" };
    } else {
        options.ajax = { id: "x_is_inpatient", form: "fjdh_patientssearch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_patients.fields.is_inpatient.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
        <button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fjdh_patientssearch"><?= $Language->phrase("Search") ?></button>
        <?php if ($Page->IsModal) { ?>
        <button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fjdh_patientssearch"><?= $Language->phrase("Cancel") ?></button>
        <?php } else { ?>
        <button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" form="fjdh_patientssearch" data-ew-action="reload"><?= $Language->phrase("Reset") ?></button>
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
    ew.addEventHandlers("jdh_patients");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
