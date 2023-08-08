<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$JdhMedicinesUpdate = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_medicines: currentTable } });
var currentPageID = ew.PAGE_ID = "update";
var currentForm;
var fjdh_medicinesupdate;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_medicinesupdate")
        .setPageId("update")

        // Add fields
        .setFields([
            ["category_id", [fields.category_id.visible && fields.category_id.required ? ew.Validators.required(fields.category_id.caption) : null], fields.category_id.isInvalid],
            ["name", [fields.name.visible && fields.name.required ? ew.Validators.required(fields.name.caption) : null], fields.name.isInvalid],
            ["selling_price", [fields.selling_price.visible && fields.selling_price.required ? ew.Validators.required(fields.selling_price.caption) : null, ew.Validators.float, ew.Validators.selected], fields.selling_price.isInvalid],
            ["buying_price", [fields.buying_price.visible && fields.buying_price.required ? ew.Validators.required(fields.buying_price.caption) : null, ew.Validators.float, ew.Validators.selected], fields.buying_price.isInvalid],
            ["description", [fields.description.visible && fields.description.required ? ew.Validators.required(fields.description.caption) : null], fields.description.isInvalid],
            ["expiry", [fields.expiry.visible && fields.expiry.required ? ew.Validators.required(fields.expiry.caption) : null, ew.Validators.datetime(fields.expiry.clientFormatPattern), ew.Validators.selected], fields.expiry.isInvalid],
            ["date_updated", [fields.date_updated.visible && fields.date_updated.required ? ew.Validators.required(fields.date_updated.caption) : null, ew.Validators.datetime(fields.date_updated.clientFormatPattern), ew.Validators.selected], fields.date_updated.isInvalid],
            ["submitted_by_user_id", [fields.submitted_by_user_id.visible && fields.submitted_by_user_id.required ? ew.Validators.required(fields.submitted_by_user_id.caption) : null, ew.Validators.integer, ew.Validators.selected], fields.submitted_by_user_id.isInvalid]
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
<form name="fjdh_medicinesupdate" id="fjdh_medicinesupdate" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jdh_medicines">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div id="tbl_jdh_medicinesupdate" class="ew-update-div"><!-- page -->
    <?php if (!$Page->isConfirm()) { // Confirm page ?>
    <div class="form-check">
        <input type="checkbox" class="form-check-input" name="u" id="u" data-ew-action="select-all"><label class="form-check-label" for="u"><?= $Language->phrase("SelectAll") ?></label>
    </div>
    <?php } ?>
<?php if ($Page->category_id->Visible && (!$Page->isConfirm() || $Page->category_id->multiUpdateSelected())) { // category_id ?>
    <div id="r_category_id"<?= $Page->category_id->rowAttributes() ?>>
        <label for="x_category_id" class="<?= $Page->LeftColumnClass ?>">
            <div class="form-check">
                <input type="checkbox" name="u_category_id" id="u_category_id" class="form-check-input ew-multi-select" value="1"<?= $Page->category_id->multiUpdateSelected() ? " checked" : "" ?>>
                <label class="form-check-label" for="u_category_id"><?= $Page->category_id->caption() ?></label>
            </div>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->category_id->cellAttributes() ?>>
                <span id="el_jdh_medicines_category_id">
                    <select
                        id="x_category_id"
                        name="x_category_id"
                        class="form-select ew-select<?= $Page->category_id->isInvalidClass() ?>"
                        data-select2-id="fjdh_medicinesupdate_x_category_id"
                        data-table="jdh_medicines"
                        data-field="x_category_id"
                        data-value-separator="<?= $Page->category_id->displayValueSeparatorAttribute() ?>"
                        data-placeholder="<?= HtmlEncode($Page->category_id->getPlaceHolder()) ?>"
                        <?= $Page->category_id->editAttributes() ?>>
                        <?= $Page->category_id->selectOptionListHtml("x_category_id") ?>
                    </select>
                    <?= $Page->category_id->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->category_id->getErrorMessage() ?></div>
                <?= $Page->category_id->Lookup->getParamTag($Page, "p_x_category_id") ?>
                <script>
                loadjs.ready("fjdh_medicinesupdate", function() {
                    var options = { name: "x_category_id", selectId: "fjdh_medicinesupdate_x_category_id" },
                        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
                    options.closeOnSelect = !options.multiple;
                    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
                    if (fjdh_medicinesupdate.lists.category_id?.lookupOptions.length) {
                        options.data = { id: "x_category_id", form: "fjdh_medicinesupdate" };
                    } else {
                        options.ajax = { id: "x_category_id", form: "fjdh_medicinesupdate", limit: ew.LOOKUP_PAGE_SIZE };
                    }
                    options.minimumResultsForSearch = Infinity;
                    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_medicines.fields.category_id.selectOptions);
                    ew.createSelect(options);
                });
                </script>
                </span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->name->Visible && (!$Page->isConfirm() || $Page->name->multiUpdateSelected())) { // name ?>
    <div id="r_name"<?= $Page->name->rowAttributes() ?>>
        <label for="x_name" class="<?= $Page->LeftColumnClass ?>">
            <div class="form-check">
                <input type="checkbox" name="u_name" id="u_name" class="form-check-input ew-multi-select" value="1"<?= $Page->name->multiUpdateSelected() ? " checked" : "" ?>>
                <label class="form-check-label" for="u_name"><?= $Page->name->caption() ?></label>
            </div>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->name->cellAttributes() ?>>
                <span id="el_jdh_medicines_name">
                <input type="<?= $Page->name->getInputTextType() ?>" name="x_name" id="x_name" data-table="jdh_medicines" data-field="x_name" value="<?= $Page->name->EditValue ?>" size="30" maxlength="191" placeholder="<?= HtmlEncode($Page->name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->name->formatPattern()) ?>"<?= $Page->name->editAttributes() ?> aria-describedby="x_name_help">
                <?= $Page->name->getCustomMessage() ?>
                <div class="invalid-feedback"><?= $Page->name->getErrorMessage() ?></div>
                </span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->selling_price->Visible && (!$Page->isConfirm() || $Page->selling_price->multiUpdateSelected())) { // selling_price ?>
    <div id="r_selling_price"<?= $Page->selling_price->rowAttributes() ?>>
        <label for="x_selling_price" class="<?= $Page->LeftColumnClass ?>">
            <div class="form-check">
                <input type="checkbox" name="u_selling_price" id="u_selling_price" class="form-check-input ew-multi-select" value="1"<?= $Page->selling_price->multiUpdateSelected() ? " checked" : "" ?>>
                <label class="form-check-label" for="u_selling_price"><?= $Page->selling_price->caption() ?></label>
            </div>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->selling_price->cellAttributes() ?>>
                <span id="el_jdh_medicines_selling_price">
                <input type="<?= $Page->selling_price->getInputTextType() ?>" name="x_selling_price" id="x_selling_price" data-table="jdh_medicines" data-field="x_selling_price" value="<?= $Page->selling_price->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->selling_price->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->selling_price->formatPattern()) ?>"<?= $Page->selling_price->editAttributes() ?> aria-describedby="x_selling_price_help">
                <?= $Page->selling_price->getCustomMessage() ?>
                <div class="invalid-feedback"><?= $Page->selling_price->getErrorMessage() ?></div>
                </span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->buying_price->Visible && (!$Page->isConfirm() || $Page->buying_price->multiUpdateSelected())) { // buying_price ?>
    <div id="r_buying_price"<?= $Page->buying_price->rowAttributes() ?>>
        <label for="x_buying_price" class="<?= $Page->LeftColumnClass ?>">
            <div class="form-check">
                <input type="checkbox" name="u_buying_price" id="u_buying_price" class="form-check-input ew-multi-select" value="1"<?= $Page->buying_price->multiUpdateSelected() ? " checked" : "" ?>>
                <label class="form-check-label" for="u_buying_price"><?= $Page->buying_price->caption() ?></label>
            </div>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->buying_price->cellAttributes() ?>>
                <span id="el_jdh_medicines_buying_price">
                <input type="<?= $Page->buying_price->getInputTextType() ?>" name="x_buying_price" id="x_buying_price" data-table="jdh_medicines" data-field="x_buying_price" value="<?= $Page->buying_price->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->buying_price->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->buying_price->formatPattern()) ?>"<?= $Page->buying_price->editAttributes() ?> aria-describedby="x_buying_price_help">
                <?= $Page->buying_price->getCustomMessage() ?>
                <div class="invalid-feedback"><?= $Page->buying_price->getErrorMessage() ?></div>
                </span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->description->Visible && (!$Page->isConfirm() || $Page->description->multiUpdateSelected())) { // description ?>
    <div id="r_description"<?= $Page->description->rowAttributes() ?>>
        <label for="x_description" class="<?= $Page->LeftColumnClass ?>">
            <div class="form-check">
                <input type="checkbox" name="u_description" id="u_description" class="form-check-input ew-multi-select" value="1"<?= $Page->description->multiUpdateSelected() ? " checked" : "" ?>>
                <label class="form-check-label" for="u_description"><?= $Page->description->caption() ?></label>
            </div>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->description->cellAttributes() ?>>
                <span id="el_jdh_medicines_description">
                <textarea data-table="jdh_medicines" data-field="x_description" name="x_description" id="x_description" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->description->getPlaceHolder()) ?>"<?= $Page->description->editAttributes() ?> aria-describedby="x_description_help"><?= $Page->description->EditValue ?></textarea>
                <?= $Page->description->getCustomMessage() ?>
                <div class="invalid-feedback"><?= $Page->description->getErrorMessage() ?></div>
                </span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->expiry->Visible && (!$Page->isConfirm() || $Page->expiry->multiUpdateSelected())) { // expiry ?>
    <div id="r_expiry"<?= $Page->expiry->rowAttributes() ?>>
        <label for="x_expiry" class="<?= $Page->LeftColumnClass ?>">
            <div class="form-check">
                <input type="checkbox" name="u_expiry" id="u_expiry" class="form-check-input ew-multi-select" value="1"<?= $Page->expiry->multiUpdateSelected() ? " checked" : "" ?>>
                <label class="form-check-label" for="u_expiry"><?= $Page->expiry->caption() ?></label>
            </div>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->expiry->cellAttributes() ?>>
                <span id="el_jdh_medicines_expiry">
                <input type="<?= $Page->expiry->getInputTextType() ?>" name="x_expiry" id="x_expiry" data-table="jdh_medicines" data-field="x_expiry" value="<?= $Page->expiry->EditValue ?>" placeholder="<?= HtmlEncode($Page->expiry->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->expiry->formatPattern()) ?>"<?= $Page->expiry->editAttributes() ?> aria-describedby="x_expiry_help">
                <?= $Page->expiry->getCustomMessage() ?>
                <div class="invalid-feedback"><?= $Page->expiry->getErrorMessage() ?></div>
                <?php if (!$Page->expiry->ReadOnly && !$Page->expiry->Disabled && !isset($Page->expiry->EditAttrs["readonly"]) && !isset($Page->expiry->EditAttrs["disabled"])) { ?>
                <script>
                loadjs.ready(["fjdh_medicinesupdate", "datetimepicker"], function () {
                    let format = "<?= DateFormat(7) ?>",
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
                    ew.createDateTimePicker("fjdh_medicinesupdate", "x_expiry", jQuery.extend(true, {"useCurrent":false,"display":{"sideBySide":false}}, options));
                });
                </script>
                <?php } ?>
                </span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->date_updated->Visible && (!$Page->isConfirm() || $Page->date_updated->multiUpdateSelected())) { // date_updated ?>
    <div id="r_date_updated"<?= $Page->date_updated->rowAttributes() ?>>
        <label for="x_date_updated" class="<?= $Page->LeftColumnClass ?>">
            <div class="form-check">
                <input type="checkbox" name="u_date_updated" id="u_date_updated" class="form-check-input ew-multi-select" value="1"<?= $Page->date_updated->multiUpdateSelected() ? " checked" : "" ?>>
                <label class="form-check-label" for="u_date_updated"><?= $Page->date_updated->caption() ?></label>
            </div>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->date_updated->cellAttributes() ?>>
                <span id="el_jdh_medicines_date_updated">
                <input type="<?= $Page->date_updated->getInputTextType() ?>" name="x_date_updated" id="x_date_updated" data-table="jdh_medicines" data-field="x_date_updated" value="<?= $Page->date_updated->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_updated->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->date_updated->formatPattern()) ?>"<?= $Page->date_updated->editAttributes() ?> aria-describedby="x_date_updated_help">
                <?= $Page->date_updated->getCustomMessage() ?>
                <div class="invalid-feedback"><?= $Page->date_updated->getErrorMessage() ?></div>
                <?php if (!$Page->date_updated->ReadOnly && !$Page->date_updated->Disabled && !isset($Page->date_updated->EditAttrs["readonly"]) && !isset($Page->date_updated->EditAttrs["disabled"])) { ?>
                <script>
                loadjs.ready(["fjdh_medicinesupdate", "datetimepicker"], function () {
                    let format = "<?= DateFormat(11) ?>",
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
                    ew.createDateTimePicker("fjdh_medicinesupdate", "x_date_updated", jQuery.extend(true, {"useCurrent":false,"display":{"sideBySide":false}}, options));
                });
                </script>
                <?php } ?>
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
                <span id="el_jdh_medicines_submitted_by_user_id">
                <input type="<?= $Page->submitted_by_user_id->getInputTextType() ?>" name="x_submitted_by_user_id" id="x_submitted_by_user_id" data-table="jdh_medicines" data-field="x_submitted_by_user_id" value="<?= $Page->submitted_by_user_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->submitted_by_user_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->submitted_by_user_id->formatPattern()) ?>"<?= $Page->submitted_by_user_id->editAttributes() ?> aria-describedby="x_submitted_by_user_id_help">
                <?= $Page->submitted_by_user_id->getCustomMessage() ?>
                <div class="invalid-feedback"><?= $Page->submitted_by_user_id->getErrorMessage() ?></div>
                </span>
            </div>
        </div>
    </div>
<?php } ?>
</div><!-- /page -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fjdh_medicinesupdate"><?= $Language->phrase("UpdateBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fjdh_medicinesupdate" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("jdh_medicines");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
