<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$PatientAppointmentsEdit = &$Page;
?>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="fPatient_Appointmentsedit" id="fPatient_Appointmentsedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { Patient_Appointments: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fPatient_Appointmentsedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fPatient_Appointmentsedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["appointment_id", [fields.appointment_id.visible && fields.appointment_id.required ? ew.Validators.required(fields.appointment_id.caption) : null], fields.appointment_id.isInvalid],
            ["patient_id", [fields.patient_id.visible && fields.patient_id.required ? ew.Validators.required(fields.patient_id.caption) : null], fields.patient_id.isInvalid],
            ["appointment_title", [fields.appointment_title.visible && fields.appointment_title.required ? ew.Validators.required(fields.appointment_title.caption) : null], fields.appointment_title.isInvalid],
            ["appointment_start_date", [fields.appointment_start_date.visible && fields.appointment_start_date.required ? ew.Validators.required(fields.appointment_start_date.caption) : null, ew.Validators.datetime(fields.appointment_start_date.clientFormatPattern)], fields.appointment_start_date.isInvalid],
            ["appointment_end_date", [fields.appointment_end_date.visible && fields.appointment_end_date.required ? ew.Validators.required(fields.appointment_end_date.caption) : null, ew.Validators.datetime(fields.appointment_end_date.clientFormatPattern), ew.Validators.minDate(() => fPatient_Appointmentsedit.getFieldElement("appointment_start_date"))], fields.appointment_end_date.isInvalid],
            ["appointment_description", [fields.appointment_description.visible && fields.appointment_description.required ? ew.Validators.required(fields.appointment_description.caption) : null], fields.appointment_description.isInvalid],
            ["subbmitted_by_user_id", [fields.subbmitted_by_user_id.visible && fields.subbmitted_by_user_id.required ? ew.Validators.required(fields.subbmitted_by_user_id.caption) : null], fields.subbmitted_by_user_id.isInvalid],
            ["appointment_all_day", [fields.appointment_all_day.visible && fields.appointment_all_day.required ? ew.Validators.required(fields.appointment_all_day.caption) : null], fields.appointment_all_day.isInvalid]
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
            "appointment_all_day": <?= $Page->appointment_all_day->toClientList($Page) ?>,
        })
        .build();
    window[form.id] = form;
    currentForm = form;
    loadjs.done(form.id);
});
</script>
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="Patient_Appointments">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->appointment_id->Visible) { // appointment_id ?>
    <div id="r_appointment_id"<?= $Page->appointment_id->rowAttributes() ?>>
        <label id="elh_Patient_Appointments_appointment_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->appointment_id->caption() ?><?= $Page->appointment_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->appointment_id->cellAttributes() ?>>
<span id="el_Patient_Appointments_appointment_id">
<span<?= $Page->appointment_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->appointment_id->getDisplayValue($Page->appointment_id->EditValue))) ?>"></span>
<input type="hidden" data-table="Patient_Appointments" data-field="x_appointment_id" data-hidden="1" name="x_appointment_id" id="x_appointment_id" value="<?= HtmlEncode($Page->appointment_id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
    <div id="r_patient_id"<?= $Page->patient_id->rowAttributes() ?>>
        <label id="elh_Patient_Appointments_patient_id" for="x_patient_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->patient_id->caption() ?><?= $Page->patient_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->patient_id->cellAttributes() ?>>
<span id="el_Patient_Appointments_patient_id">
    <select
        id="x_patient_id"
        name="x_patient_id"
        class="form-select ew-select<?= $Page->patient_id->isInvalidClass() ?>"
        data-select2-id="fPatient_Appointmentsedit_x_patient_id"
        data-table="Patient_Appointments"
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
loadjs.ready("fPatient_Appointmentsedit", function() {
    var options = { name: "x_patient_id", selectId: "fPatient_Appointmentsedit_x_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fPatient_Appointmentsedit.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x_patient_id", form: "fPatient_Appointmentsedit" };
    } else {
        options.ajax = { id: "x_patient_id", form: "fPatient_Appointmentsedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.Patient_Appointments.fields.patient_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->appointment_title->Visible) { // appointment_title ?>
    <div id="r_appointment_title"<?= $Page->appointment_title->rowAttributes() ?>>
        <label id="elh_Patient_Appointments_appointment_title" for="x_appointment_title" class="<?= $Page->LeftColumnClass ?>"><?= $Page->appointment_title->caption() ?><?= $Page->appointment_title->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->appointment_title->cellAttributes() ?>>
<span id="el_Patient_Appointments_appointment_title">
<input type="<?= $Page->appointment_title->getInputTextType() ?>" name="x_appointment_title" id="x_appointment_title" data-table="Patient_Appointments" data-field="x_appointment_title" value="<?= $Page->appointment_title->EditValue ?>" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->appointment_title->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->appointment_title->formatPattern()) ?>"<?= $Page->appointment_title->editAttributes() ?> aria-describedby="x_appointment_title_help">
<?= $Page->appointment_title->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->appointment_title->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->appointment_start_date->Visible) { // appointment_start_date ?>
    <div id="r_appointment_start_date"<?= $Page->appointment_start_date->rowAttributes() ?>>
        <label id="elh_Patient_Appointments_appointment_start_date" for="x_appointment_start_date" class="<?= $Page->LeftColumnClass ?>"><?= $Page->appointment_start_date->caption() ?><?= $Page->appointment_start_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->appointment_start_date->cellAttributes() ?>>
<span id="el_Patient_Appointments_appointment_start_date">
<input type="<?= $Page->appointment_start_date->getInputTextType() ?>" name="x_appointment_start_date" id="x_appointment_start_date" data-table="Patient_Appointments" data-field="x_appointment_start_date" value="<?= $Page->appointment_start_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->appointment_start_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->appointment_start_date->formatPattern()) ?>"<?= $Page->appointment_start_date->editAttributes() ?> aria-describedby="x_appointment_start_date_help">
<?= $Page->appointment_start_date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->appointment_start_date->getErrorMessage() ?></div>
<?php if (!$Page->appointment_start_date->ReadOnly && !$Page->appointment_start_date->Disabled && !isset($Page->appointment_start_date->EditAttrs["readonly"]) && !isset($Page->appointment_start_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fPatient_Appointmentsedit", "datetimepicker"], function () {
    let format = "<?= DateFormat(1) ?>",
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
    ew.createDateTimePicker("fPatient_Appointmentsedit", "x_appointment_start_date", jQuery.extend(true, {"useCurrent":false,"display":{"sideBySide":true}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->appointment_end_date->Visible) { // appointment_end_date ?>
    <div id="r_appointment_end_date"<?= $Page->appointment_end_date->rowAttributes() ?>>
        <label id="elh_Patient_Appointments_appointment_end_date" for="x_appointment_end_date" class="<?= $Page->LeftColumnClass ?>"><?= $Page->appointment_end_date->caption() ?><?= $Page->appointment_end_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->appointment_end_date->cellAttributes() ?>>
<span id="el_Patient_Appointments_appointment_end_date">
<input type="<?= $Page->appointment_end_date->getInputTextType() ?>" name="x_appointment_end_date" id="x_appointment_end_date" data-table="Patient_Appointments" data-field="x_appointment_end_date" value="<?= $Page->appointment_end_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->appointment_end_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->appointment_end_date->formatPattern()) ?>"<?= $Page->appointment_end_date->editAttributes() ?> aria-describedby="x_appointment_end_date_help">
<?= $Page->appointment_end_date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->appointment_end_date->getErrorMessage() ?></div>
<?php if (!$Page->appointment_end_date->ReadOnly && !$Page->appointment_end_date->Disabled && !isset($Page->appointment_end_date->EditAttrs["readonly"]) && !isset($Page->appointment_end_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fPatient_Appointmentsedit", "datetimepicker"], function () {
    let format = "<?= DateFormat(1) ?>",
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
    ew.createDateTimePicker("fPatient_Appointmentsedit", "x_appointment_end_date", jQuery.extend(true, {"useCurrent":false,"display":{"sideBySide":true}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->appointment_description->Visible) { // appointment_description ?>
    <div id="r_appointment_description"<?= $Page->appointment_description->rowAttributes() ?>>
        <label id="elh_Patient_Appointments_appointment_description" class="<?= $Page->LeftColumnClass ?>"><?= $Page->appointment_description->caption() ?><?= $Page->appointment_description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->appointment_description->cellAttributes() ?>>
<span id="el_Patient_Appointments_appointment_description">
<?php $Page->appointment_description->EditAttrs->appendClass("editor"); ?>
<textarea data-table="Patient_Appointments" data-field="x_appointment_description" name="x_appointment_description" id="x_appointment_description" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->appointment_description->getPlaceHolder()) ?>"<?= $Page->appointment_description->editAttributes() ?> aria-describedby="x_appointment_description_help"><?= $Page->appointment_description->EditValue ?></textarea>
<?= $Page->appointment_description->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->appointment_description->getErrorMessage() ?></div>
<script>
loadjs.ready(["fPatient_Appointmentsedit", "editor"], function() {
    ew.createEditor("fPatient_Appointmentsedit", "x_appointment_description", 35, 4, <?= $Page->appointment_description->ReadOnly || false ? "true" : "false" ?>);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->appointment_all_day->Visible) { // appointment_all_day ?>
    <div id="r_appointment_all_day"<?= $Page->appointment_all_day->rowAttributes() ?>>
        <label id="elh_Patient_Appointments_appointment_all_day" class="<?= $Page->LeftColumnClass ?>"><?= $Page->appointment_all_day->caption() ?><?= $Page->appointment_all_day->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->appointment_all_day->cellAttributes() ?>>
<span id="el_Patient_Appointments_appointment_all_day">
<div class="form-check d-inline-block">
    <input type="checkbox" class="form-check-input<?= $Page->appointment_all_day->isInvalidClass() ?>" data-table="Patient_Appointments" data-field="x_appointment_all_day" data-boolean name="x_appointment_all_day" id="x_appointment_all_day" value="1"<?= ConvertToBool($Page->appointment_all_day->CurrentValue) ? " checked" : "" ?><?= $Page->appointment_all_day->editAttributes() ?> aria-describedby="x_appointment_all_day_help">
    <div class="invalid-feedback"><?= $Page->appointment_all_day->getErrorMessage() ?></div>
</div>
<?= $Page->appointment_all_day->getCustomMessage() ?>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fPatient_Appointmentsedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fPatient_Appointmentsedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("Patient_Appointments");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
