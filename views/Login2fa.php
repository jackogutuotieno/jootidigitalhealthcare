<?php namespace PHPMaker2023\jootidigitalhealthcare; ?>
<?php

namespace PHPMaker2023\jootidigitalhealthcare;

// Page object
$Login2fa = &$Page;
?>
<script>
loadjs.ready("head", function () {
    // Write your client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<div class="ew-login-box">
    <div class="login-logo"></div>
    <div class="card ew-login-card">
        <div class="card-body">
<?php
$Page->showMessage();
?>
<script>
// Script inside .card-body
var flogin2fa;
loadjs.ready(["wrapper", "head"], function() {
    let $ = jQuery,
        fieldName = "<?= $Page->SecurityCode->FieldVar ?>";
    let form = new ew.FormBuilder()
        .setId("flogin2fa")

        // Add fields
        .addFields([
            [fieldName, ew.Validators.required(ew.language.phrase("SecurityCode")), <?= $Page->SecurityCode->IsInvalid ? "true" : "false" ?>]
        ])

        // Validate
        .setValidate(
            async function() {
                if (!this.validateRequired)
                    return true; // Ignore validation
                let $ = jQuery,
                    fobj = this.getForm();

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
            function (fobj) { // DO NOT CHANGE THIS LINE! (except for adding "async" keyword)
                    // Your custom validation code here, return false if invalid.
                    return true;
                }
        )

        // Use JavaScript validation
        .setValidateRequired(ew.CLIENT_VALIDATE)
        .build();

    // Submit
    loadjs.ready(["load", form.id], function () {
        let $form = form.$element,
            $card = $(".ew-login-card").removeData("lte.cardrefresh");
        $card.CardRefresh({
            source: ew.sanitize(ew.setLayout(form.element.action, false)),
            loadOnInit: false,
            loadInContent: false,
            sourceSelector: ".card-body",
            overlayTemplate: ew.overlayTemplate(),
            ajaxSettings: {
                method: form.element.method
            },
            onLoadStart: function() {
                this.prop("_settings").params = this.prop("_element").find("form").serialize();
            },
            onLoadDone: function(result) {
                if ($.isObject(result)) {
                    if (result?.error?.description) {
                        ew.alert(result.error.description);
                    } else if (result?.url) {
                        window.location = ew.sanitize(result.url);
                    } else if (result?.success) {
                        ew.setValid(form.element[fieldName]);
                        this.prop("_element").one("overlay.removed.lte.cardrefresh", function() {
                            $(this).data("lte.cardrefresh")._addOverlay();
                        });
                        window.location = ew.sanitize(ew.vars.login.login.url); // Return to login page
                    }
                } else {
                    $card.find(".card-body").html($(result).find(".card-body").html());
                    ew.initPage($.Event({ target: $card[0] }));
                }
            }
        });
        $form.off("beforesubmit").on("beforesubmit", function(e) {
            e.preventDefault();
            $card.CardRefresh("load");
        });
        $("#" + fieldName).on("keyup paste", function(e) {
            let value = e.originalEvent.clipboardData?.getData("text") || e.target.value;
            if (value.length == ew.TWO_FACTOR_AUTHENTICATION_PASS_CODE_LENGTH)
                $form.trigger("submit");
        });
    });
    window[form.id] = form;
    loadjs.done(form.id);
});
</script>
<form name="flogin2fa" id="flogin2fa" class="ew-form ew-login-form ew-2fa-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
    <?php if (Config("CHECK_TOKEN")) { ?>
    <input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
    <input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
    <?php } ?>
<?php if ($Page->SecretIsVerified) { ?>
    <p class="login-box-msg"><?= $Language->phrase("EnterSecurityCode" . Config("TWO_FACTOR_AUTHENTICATION_TYPE")) ?></p>
<?php } else { ?>
<?php if (SameText($Page->AuthType, "google")) { // Google Authenticator ?>
    <img class="mx-auto d-block mb-3" src="<?= $Page->QrCodeUrl ?>">
    <p class="login-box-msg"><?= $Language->phrase("Scan2FAQrCode") ?></p>
<?php } elseif (SameText($Page->AuthType, "email") || SameText($Page->AuthType, "sms")) { // Email / SMS Authenticator ?>
    <div class="row gx-0">
        <input type="text" name="<?= $Page->Account->FieldVar ?>" id="<?= $Page->Account->FieldVar ?>" value="<?= $Page->Account->CurrentValue ?>"<?= $Page->Account->editAttributes() ?>>
        <div class="invalid-feedback"><?= $Page->Account->getErrorMessage() ?></div>
        <div class="valid-feedback"><?= $Language->phrase("SendOTPSuccess") ?></div>
    </div>
    <div class="d-grid mb-3">
        <button class="btn btn-primary ew-btn" name="btn-send-otp" id="btn-send-otp" type="button" data-ew-action="send-otp" data-account="account"><?= $Language->phrase("SendOTP") ?></button>
    </div>
<?php } ?>
<?php } ?>
    <div class="row gx-0">
        <input type="text" name="<?= $Page->SecurityCode->FieldVar ?>" id="<?= $Page->SecurityCode->FieldVar ?>" value="" placeholder="<?= HtmlEncode($Language->phrase("SecurityCode", true)) ?>"<?= $Page->SecurityCode->editAttributes() ?>>
        <div class="invalid-feedback"><?= $Page->SecurityCode->getErrorMessage() ?></div>
        <div class="valid-feedback"><?= $Language->phrase("SecurityCodeVerified") ?></div>
    </div>
    <div class="d-grid mb-3">
        <button class="btn btn-primary ew-btn disabled enable-on-init" name="btn-submit" id="btn-submit" type="submit" formaction="<?= CurrentPageUrl(false) ?>"><?= $Language->phrase("Verify") ?></button>
    </div>
<?php if ($Page->SecretIsVerified && (SameText($Page->AuthType, "email") || SameText($Page->AuthType, "sms"))) { // Add send OTP button ?>
    <div class="d-grid mb-3">
        <button class="btn btn-primary ew-btn" name="btn-send-otp" id="btn-send-otp" type="button" data-ew-action="send-otp"><?= $Language->phrase("SendOTP") ?></button>
    </div>
<?php } ?>
</form>
        </div><!-- ./card-body -->
    </div><!-- ./card -->
</div><!-- ./ew-login-box -->
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your startup script here, no need to add script tags.
});
</script>
