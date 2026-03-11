<script type="text/javascript" src="https://njyha-zcmp.maillist-manage.eu/js/optin.min.js"
    onload="setupSF('sf3zc726c0ed850fd730a13cbf0db3c8387963faaf5ebdc9cc192d8795297c0a1e8b','ZCFORMVIEW',false,'acc',false,'2')">
</script>
<script type="text/javascript">
function runOnFormSubmit_sf3zc726c0ed850fd730a13cbf0db3c8387963faaf5ebdc9cc192d8795297c0a1e8b(th) {
    // Called by Zoho on form submit
};

// Watch for style changes on inputs to show/hide error messages
document.addEventListener('DOMContentLoaded', function() {
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.type === 'attributes' && mutation.attributeName === 'style') {
                const input = mutation.target;
                const field = input.closest('.zoho-form__field');
                if (field) {
                    const errorMsg = field.querySelector('.zoho-form__field-error');
                    if (errorMsg) {
                        // Check if input style contains red (error border)
                        const style = input.getAttribute('style') || '';
                        const hasError = style.toLowerCase().includes('red');
                        errorMsg.style.display = hasError ? 'block' : 'none';
                    }
                }
            }
        });
    });

    // Observe all form inputs for style changes
    document.querySelectorAll('.zoho-form input').forEach(function(input) {
        observer.observe(input, { attributes: true, attributeFilter: ['style'] });
    });
});
</script>

<div id="sf3zc726c0ed850fd730a13cbf0db3c8387963faaf5ebdc9cc192d8795297c0a1e8b" data-type="signupform" class="zoho-form">
    <div id="customForm">
        <input type="hidden" id="recapTheme" value="2">
        <input type="hidden" id="isRecapIntegDone" value="false">
        <input type="hidden" id="signupFormMode" value="copyCode">
        <input type="hidden" id="signupFormType" value="QuickForm_Vertical">
        <input type="hidden" id="recapModeTheme" value="">

        <div name="SIGNUP_PAGE" id="SIGNUP_PAGE" class="font-sans text-base zoho-form__page" style="">
            <div name="" changeid="" changename="" class="mx-auto">
                <div id="imgBlock" name="LOGO_DIV" logo="true" class="w-full mx-auto" style=""></div>
            </div>
        <div id="signupMainDiv" name="SIGNUPFORM" changeid="SIGNUPFORM" changename="SIGNUPFORM" class="w-full mx-auto zoho-form__main" style="">
            <!-- Success Message -->
            <div class="relative">
                <div id="Zc_SignupSuccess" style="display:none;" class="p-1 my-2 break-words border bg-success border-success zoho-form__success">
                    <span class="text-success" id="signupSuccessMsg">Thank you for Signing Up</span>
                </div>
            </div>

            <!-- Form -->
            <form method="POST" class="mb-5" id="zcampaignOptinForm" action="https://njyha-zcmp.maillist-manage.eu/weboptin.zc" target="_zcSignup">
                <div id="SIGNUP_BODY_ALL" name="SIGNUP_BODY_ALL" class="border-none">
                    <h1 id="SIGNUP_HEADING" name="SIGNUP_HEADING" changeid="SIGNUP_MSG" changetype="SIGNUP_HEADER" class="zoho-form__heading"></h1>

                    <div id="SIGNUP_BODY" name="SIGNUP_BODY" class="p-0 text-left zoho-form__body">
                        <div id="SIGNUP_DESCRIPTION" changeid="SIGNUP_MSG" changetype="SIGNUP_DESCRIPTION" class="leading-relaxed zoho-form__description"></div>

                        <div id="errorMsgDiv" style="display:none;" class="p-2 my-2 mt-5 border rounded zoho-form__error bg-error-light text-error border-error-light">
                            Bitte korrigieren Sie die nachstehenden markierten Felder.
                        </div>

                        <!-- Form Fields -->
                        <div class="zoho-form__fields">
                            <!-- Email Field -->
                            <div class="zoho-form__field">
                                <div name="SIGNUP_FORM_LABEL" class="zoho-form__label">
                                    E-Mail <span name="SIGNUP_REQUIRED" class="zoho-form__required">*</span>
                                </div>
                                <div class="rounded-lg zoho-form__input-wrap zcinputbox">
                                    <input type="email" name="CONTACT_EMAIL" id="CONTACT_EMAIL" changeitem="SIGNUP_FORM_FIELD" class="box-border" maxlength="100" required>
                                    <span class="hidden" id="dt_CONTACT_EMAIL">1,true,6,Kontakt-E-Mail,2</span>
                                </div>
                                <span class="zoho-form__field-error" id="CONTACT_EMAIL_error">Bitte geben Sie eine gültige E-Mail-Adresse ein.</span>
                            </div>

                            <!-- Username Field -->
                            <div class="zoho-form__field">
                                <div name="SIGNUP_FORM_LABEL" class="zoho-form__label">
                                    Benutzername <span name="SIGNUP_REQUIRED" class="zoho-form__required">*</span>
                                </div>
                                <div class="rounded-lg zoho-form__input-wrap zcinputbox">
                                    <input type="text" name="FIRSTNAME" id="FIRSTNAME" changeitem="SIGNUP_FORM_FIELD" class="box-border" maxlength="50" required>
                                    <span class="hidden" id="dt_FIRSTNAME">1,true,1,Vorname,2</span>
                                </div>
                                <span class="zoho-form__field-error" id="FIRSTNAME_error">Bitte geben Sie Ihren Benutzernamen ein.</span>
                            </div>

                            <!-- Captcha -->
                            <div id="captchaOld" name="captchaContainer" class="py-2 zoho-form__captcha recaptcha">
                                <div id="captchaParent" class="flex flex-wrap gap-2 p-2 mb-2 border rounded-lg border-neutral-400 bg-secondary-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         class="cursor-pointer zoho-form__captcha-refresh"
                                         onclick="loadCaptcha('https://campaigns.zoho.eu/campaigns/CaptchaVerify.zc?mode=generate',this,'#sf3zc726c0ed850fd730a13cbf0db3c8387963faaf5ebdc9cc192d8795297c0a1e8b');"
                                         id="relCaptcha">
                                        <path fill="currentColor" d="M12 20q-3.35 0-5.675-2.325T4 12t2.325-5.675T12 4q1.725 0 3.3.712T18 6.75V4h2v7h-7V9h4.2q-.8-1.4-2.187-2.2T12 6Q9.5 6 7.75 7.75T6 12t1.75 4.25T12 18q1.925 0 3.475-1.1T17.65 14h2.1q-.7 2.65-2.85 4.325T12 20"/>
                                    </svg>
                                    <div id="captchaDiv" captcha="true" name="" class="box-border flex-1 p-5 bg-white border border-neutral-300 zoho-form__captcha-image"></div>
                                    <input type="text" placeholder="Captcha" id="captchaText" name="captchaText" changeitem="SIGNUP_FORM_FIELD" class="box-border" maxlength="100">
                                    <span class="zoho-form__required" id="capRequired"></span>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-between">

                        <!-- Submit Button -->
                        <div class="p-2 text-center zoho-form__submit">
                            <input type="button" action="Save" id="zcWebOptin" name="SIGNUP_SUBMIT_BUTTON" changetype="SIGNUP_SUBMIT_BUTTON_TEXT" class="cursor-pointer btn" value="Jetzt anmelden">
                        </div>
                        <div id="REQUIRED_FIELD_TEXT" changetype="REQUIRED_FIELD_TEXT" name="SIGNUP_REQUIRED" class="text-sm zoho-form__required-text">*Pflichtfelder</div>
                        </div>
                    </div>

                    <!-- Hidden Fields -->
                    <input type="hidden" id="secretid" value="6LdNeDUUAAAAAG5l7cJfv1AA5OKLslkrOa_xXxLs">
                    <input type="hidden" id="fieldBorder" value="rgb(255, 255, 255)">
                    <input type="hidden" name="zc_trackCode" id="zc_trackCode" value="ZCFORMVIEW">
                    <input type="hidden" name="viewFrom" id="viewFrom" value="URL_ACTION">
                    <input type="hidden" id="submitType" name="submitType" value="optinCustomView">
                    <input type="hidden" id="lD" name="lD" value="11725ed2aa3463f1">
                    <input type="hidden" name="emailReportId" id="emailReportId" value="">
                    <input type="hidden" name="zx" id="cmpZuid" value="14adb11792">
                    <input type="hidden" name="zcvers" value="2.0">
                    <input type="hidden" name="oldListIds" id="allCheckedListIds" value="">
                    <input type="hidden" id="mode" name="mode" value="OptinCreateView">
                    <input type="hidden" id="zcld" name="zcld" value="11725ed2aa3463f1">
                    <input type="hidden" id="zctd" name="zctd" value="11725ed2aa346407">
                    <input type="hidden" id="document_domain" value="campaigns.zoho.eu">
                    <input type="hidden" id="zc_Url" value="njyha-zcmp.maillist-manage.eu">
                    <input type="hidden" id="new_optin_response_in" value="0">
                    <input type="hidden" id="duplicate_optin_response_in" value="0">
                    <input type="hidden" id="zc_formIx" name="zc_formIx" value="3zc726c0ed850fd730a13cbf0db3c8387963faaf5ebdc9cc192d8795297c0a1e8b">
                </div>
            </form>

            <!-- Privacy Notes -->
            <div id="privacyNotes" class="zoho-form__privacy">
                <p class="text-sm !leading-tight">Indem ich meine E-Mail-Adresse eintrage, erkläre ich mich damit einverstanden, dass Wikimedia mich aufgrund meiner Einwilligung (Art. 6 Abs. 1 lit. a) DSGVO) per E-Mail bis zum Ende des Wiki-Wegweisers kontaktiert und die hierzu erforderlichen Datenverarbeitungen vornimmt. Ich kann meine Einwilligung jederzeit mit Wirkung für die Zukunft gegenüber Wikimedia widerrufen. Nähere Informationen zur Datenverarbeitung bei Wikimedia und zu meinen Rechten finde ich unter wikimedia.de/datenschutz.</p>
            </div>
        </div>
    </div>

        <input type="hidden" id="isCaptchaNeeded" value="true">
        <input type="hidden" id="superAdminCap" value="0">
        <img src="https://njyha-zcmp.maillist-manage.eu/images/spacer.gif" id="refImage" onload="referenceSetter(this)" class="hidden">
    </div>
</div>

<!-- Overlay and Success Popup -->
<div id="zcOptinOverLay" oncontextmenu="return false" style="display:none;" class="fixed inset-0 z-50 w-full h-screen text-center bg-black bg-opacity-50 zoho-form__overlay"></div>
<div id="zcOptinSuccessPopup" style="display:none;" class="fixed top-20 left-1/4 w-[800px] h-[40%] bg-white border border-neutral-300 shadow-xl p-8 z-[9999] zoho-form__popup">
    <span id="closeSuccess" class="absolute -top-4 -right-4 z-[99999] cursor-pointer zoho-form__popup-close">
        <img src="https://njyha-zcmp.maillist-manage.eu/images/videoclose.png" alt="Close">
    </span>
    <div id="zcOptinSuccessPanel"></div>
</div>
