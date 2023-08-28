<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$JdhRoomsAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jdh_rooms: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fjdh_roomsadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjdh_roomsadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["ward_id", [fields.ward_id.visible && fields.ward_id.required ? ew.Validators.required(fields.ward_id.caption) : null], fields.ward_id.isInvalid],
            ["room_number", [fields.room_number.visible && fields.room_number.required ? ew.Validators.required(fields.room_number.caption) : null, ew.Validators.integer], fields.room_number.isInvalid],
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
            "ward_id": <?= $Page->ward_id->toClientList($Page) ?>,
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
<form name="fjdh_roomsadd" id="fjdh_roomsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jdh_rooms">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->ward_id->Visible) { // ward_id ?>
    <div id="r_ward_id"<?= $Page->ward_id->rowAttributes() ?>>
        <label id="elh_jdh_rooms_ward_id" for="x_ward_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ward_id->caption() ?><?= $Page->ward_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->ward_id->cellAttributes() ?>>
<span id="el_jdh_rooms_ward_id">
    <select
        id="x_ward_id"
        name="x_ward_id"
        class="form-select ew-select<?= $Page->ward_id->isInvalidClass() ?>"
        data-select2-id="fjdh_roomsadd_x_ward_id"
        data-table="jdh_rooms"
        data-field="x_ward_id"
        data-value-separator="<?= $Page->ward_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->ward_id->getPlaceHolder()) ?>"
        <?= $Page->ward_id->editAttributes() ?>>
        <?= $Page->ward_id->selectOptionListHtml("x_ward_id") ?>
    </select>
    <?= $Page->ward_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->ward_id->getErrorMessage() ?></div>
<?= $Page->ward_id->Lookup->getParamTag($Page, "p_x_ward_id") ?>
<script>
loadjs.ready("fjdh_roomsadd", function() {
    var options = { name: "x_ward_id", selectId: "fjdh_roomsadd_x_ward_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjdh_roomsadd.lists.ward_id?.lookupOptions.length) {
        options.data = { id: "x_ward_id", form: "fjdh_roomsadd" };
    } else {
        options.ajax = { id: "x_ward_id", form: "fjdh_roomsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.jdh_rooms.fields.ward_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->room_number->Visible) { // room_number ?>
    <div id="r_room_number"<?= $Page->room_number->rowAttributes() ?>>
        <label id="elh_jdh_rooms_room_number" for="x_room_number" class="<?= $Page->LeftColumnClass ?>"><?= $Page->room_number->caption() ?><?= $Page->room_number->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->room_number->cellAttributes() ?>>
<span id="el_jdh_rooms_room_number">
<input type="<?= $Page->room_number->getInputTextType() ?>" name="x_room_number" id="x_room_number" data-table="jdh_rooms" data-field="x_room_number" value="<?= $Page->room_number->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->room_number->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->room_number->formatPattern()) ?>"<?= $Page->room_number->editAttributes() ?> aria-describedby="x_room_number_help">
<?= $Page->room_number->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->room_number->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <div id="r_description"<?= $Page->description->rowAttributes() ?>>
        <label id="elh_jdh_rooms_description" for="x_description" class="<?= $Page->LeftColumnClass ?>"><?= $Page->description->caption() ?><?= $Page->description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->description->cellAttributes() ?>>
<span id="el_jdh_rooms_description">
<textarea data-table="jdh_rooms" data-field="x_description" name="x_description" id="x_description" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->description->getPlaceHolder()) ?>"<?= $Page->description->editAttributes() ?> aria-describedby="x_description_help"><?= $Page->description->EditValue ?></textarea>
<?= $Page->description->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->description->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fjdh_roomsadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fjdh_roomsadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("jdh_rooms");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
