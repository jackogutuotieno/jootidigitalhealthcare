<?php

namespace PHPMaker2023\jootidigitalhealthcare;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class Login2fa
{
    use MessagesTrait;

    // Page ID
    public $PageID = "login2fa";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName;

    // Table variable
    public $TableVar;

    // Page object name
    public $PageObjName = "Login2fa";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // CSS class/style
    public $CurrentPageName = "login2fa";

    // Page headings
    public $Heading = "";
    public $Subheading = "";
    public $PageHeader;
    public $PageFooter;

    // Page layout
    public $UseLayout = true;

    // Page terminated
    private $terminated = false;

    // Page heading
    public function pageHeading()
    {
        global $Language;
        if ($this->Heading != "") {
            return $this->Heading;
        }
        if (method_exists($this, "tableCaption")) {
            return $this->tableCaption();
        }
        return "";
    }

    // Page subheading
    public function pageSubheading()
    {
        global $Language;
        if ($this->Subheading != "") {
            return $this->Subheading;
        }
        return "";
    }

    // Page name
    public function pageName()
    {
        return CurrentPageName();
    }

    // Page URL
    public function pageUrl($withArgs = true)
    {
        $route = GetRoute();
        $args = RemoveXss($route->getArguments());
        if (!$withArgs) {
            foreach ($args as $key => &$val) {
                $val = "";
            }
            unset($val);
        }
        return rtrim(UrlFor($route->getName(), $args), "/") . "?";
    }

    // Show Page Header
    public function showPageHeader()
    {
        $header = $this->PageHeader;
        $this->pageDataRendering($header);
        if ($header != "") { // Header exists, display
            echo '<p id="ew-page-header">' . $header . '</p>';
        }
    }

    // Show Page Footer
    public function showPageFooter()
    {
        $footer = $this->PageFooter;
        $this->pageDataRendered($footer);
        if ($footer != "") { // Footer exists, display
            echo '<p id="ew-page-footer">' . $footer . '</p>';
        }
    }

    // Constructor
    public function __construct()
    {
        global $Language, $DashboardReport, $DebugTimer, $UserTable;

        // Table CSS class
        $this->TableClass = "table table-striped table-bordered table-hover table-sm ew-view-table";

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("language");

        // Start timer
        $DebugTimer = Container("timer");

        // Debug message
        LoadDebugMessage();

        // Open connection
        $GLOBALS["Conn"] ??= GetConnection();

        // User table object
        $UserTable = Container("usertable");
    }

    // Get content from stream
    public function getContents(): string
    {
        global $Response;
        return is_object($Response) ? $Response->getBody() : ob_get_clean();
    }

    // Is lookup
    public function isLookup()
    {
        return SameText(Route(0), Config("API_LOOKUP_ACTION"));
    }

    // Is AutoFill
    public function isAutoFill()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autofill");
    }

    // Is AutoSuggest
    public function isAutoSuggest()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autosuggest");
    }

    // Is modal lookup
    public function isModalLookup()
    {
        return $this->isLookup() && SameText(Post("ajax"), "modal");
    }

    // Is terminated
    public function isTerminated()
    {
        return $this->terminated;
    }

    /**
     * Terminate page
     *
     * @param string $url URL for direction
     * @return void
     */
    public function terminate($url = "")
    {
        if ($this->terminated) {
            return;
        }
        global $TempImages, $DashboardReport, $Response;

        // Page is terminated
        $this->terminated = true;

         // Page Unload event
        if (method_exists($this, "pageUnload")) {
            $this->pageUnload();
        }

        // Global Page Unloaded event (in userfn*.php)
        Page_Unloaded();
        if (!IsApi() && method_exists($this, "pageRedirecting")) {
            $this->pageRedirecting($url);
        }

        // Close connection
        CloseConnections();

        // Return for API
        if (IsApi()) {
            $res = $url === true;
            if (!$res) { // Show response for API
                $ar = array_merge($this->getMessages(), $url ? ["url" => GetUrl($url)] : []);
                WriteJson($ar);
            }
            $this->clearMessages(); // Clear messages for API request
            return;
        } else { // Check if response is JSON
            if (StartsString("application/json", $Response->getHeaderLine("Content-type")) && $Response->getBody()->getSize()) { // With JSON response
                $this->clearMessages();
                return;
            }
        }

        // Go to URL if specified
        if ($url != "") {
            if (!Config("DEBUG") && ob_get_length()) {
                ob_end_clean();
            }
            SaveDebugMessage();
            Redirect(GetUrl($url));
        }
        return; // Return to controller
    }

    // Properties
    public $AuthType;
    public $Account;
    public $SecurityCode;
    public $QrCodeUrl;
    public $SecretIsVerified;
    public $IsModal = false;

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $UserProfile, $Language, $Security, $CurrentForm, $Breadcrumb, $SkipHeaderFooter;
        $this->OffsetColumnClass = ""; // Override user table
        $this->AuthType = Config("TWO_FACTOR_AUTHENTICATION_TYPE");

        // Create Account field object (used by validation only)
        $this->Account = new DbField("jdh_users", "account", "account", "account", "", 202, 255, -1, false, "", false, false, false);
        if (SameText($this->AuthType, "email")) { // Set placeholder as email address
            $this->Account->EditAttrs["placeholder"] = $Language->phrase("EmailAddress");
            $this->Account->ErrorMessage = $Language->phrase("EnterOTPEmailAddress");
        } elseif(SameText($this->AuthType, "sms")) { // Set placeholder as mobile number
            $this->Account->EditAttrs["placeholder"] = $Language->phrase("MobileNumber");
            $this->Account->ErrorMessage = $Language->phrase("EnterOTPMobileNumber");
        }
        $this->Account->EditAttrs->appendClass("form-control ew-form-control");

        // Create SecurityCode field object (used by validation only)
        $this->SecurityCode = new DbField("jdh_users", "securitycode", "securitycode", "securitycode", "", 202, 255, -1, false, "", false, false, false);
        $this->SecurityCode->EditAttrs->appendClass("form-control ew-form-control");

        // Is modal
        $this->IsModal = ConvertToBool(Param("modal"));
        $this->UseLayout = $this->UseLayout && !$this->IsModal;

        // Use layout
        $this->UseLayout = $this->UseLayout && ConvertToBool(Param(Config("PAGE_LAYOUT"), true));

        // View
        $this->View = Get(Config("VIEW"));

        // Global Page Loading event (in userfn*.php)
        Page_Loading();

        // Page Load event
        if (method_exists($this, "pageLoad")) {
            $this->pageLoad();
        }
        $Breadcrumb = new Breadcrumb("index");
        $Breadcrumb->add("login2fa", "Login2FAPage", CurrentUrl(), "", "", true);
        $this->Heading = $Language->phrase("Login2FAPage");
        $this->SecurityCode->setFormValue(""); // Initialize

        // Show messages
        $flash = Container("flash");
        if ($failure = $flash->getFirstMessage("failure")) {
            $this->setFailureMessage($failure);
        }
        if ($success = $flash->getFirstMessage("success")) {
            $this->setSuccessMessage($success);
        }
        if ($warning = $flash->getFirstMessage("warning")) {
            $this->setWarningMessage(warning);
        }

        // Login
        if (IsLoggingIn2FA()) { // Two factor authentication from login page
            $usr = $_SESSION[SESSION_USER_PROFILE_USER_NAME];
            $authClass = TwoFactorAuthenticationClass();

            // Check if secret is verified
            $this->SecretIsVerified = $UserProfile->hasUserSecret($usr, true);
            if (SameText($this->AuthType, "email") || SameText($this->AuthType, "sms")) { // Get email address / mobile number
                $this->Account->CurrentValue = $authClass::getAccount($usr);
                $this->SecretIsVerified = $this->SecretIsVerified && !EmptyValue($this->Account->CurrentValue); // Make sure email address / mobile number not empty
            }

            // Verify security code
            if (Post($this->SecurityCode->FieldVar) !== null) {
                $securityCode = Post($this->SecurityCode->FieldVar);
                // Validate security code
                try {
                    if ($UserProfile->verify2FACode($usr, $securityCode)) { // Validated, return to login page
                        if (empty($_SESSION[SESSION_USER_PROFILE_PASSWORD])) {
                            $_SESSION[SESSION_STATUS] = ""; // Just return to login page
                        } else { // Login user
                            $_SESSION[SESSION_STATUS] = "loggingin";
                        }
                        WriteJson(["success" => true]);
                        $this->terminate();
                    } else {
                        $this->SecurityCode->addErrorMessage($Language->phrase("IncorrectSecurityCode")); // Incorrect security code
                    }
                } catch (\Throwable $e) {
                    WriteJson(["error" => ["description" => $e->getMessage()]]);
                    $this->terminate();
                }
            } elseif (!$this->SecretIsVerified) {
                if (SameText($this->AuthType, "google")) { // Get QrCode URL
                    $secret = $UserProfile->getUserSecret($usr);
                    $this->QrCodeUrl = $authClass::getQrCodeUrl($usr, $secret);
                }
            }
        } else { // Return to login page
            $this->terminate("login?modal=1");
        }

        // Set up error message
        if (EmptyValue($this->SecurityCode->ErrorMessage)) {
            $this->SecurityCode->ErrorMessage = $Language->phrase("EnterSecurityCode" . Config("TWO_FACTOR_AUTHENTICATION_TYPE"));
        }

        // Set LoginStatus / Page_Rendering / Page_Render
        if (!IsApi() && !$this->isTerminated()) {
            // Setup login status
            SetupLoginStatus();

            // Pass login status to client side
            SetClientVar("login", LoginStatus());

            // Global Page Rendering event (in userfn*.php)
            Page_Rendering();

            // Page Render event
            if (method_exists($this, "pageRender")) {
                $this->pageRender();
            }

            // Render search option
            if (method_exists($this, "renderSearchOptions")) {
                $this->renderSearchOptions();
            }
        }
    }

    // Validate form
    protected function validateForm()
    {
        global $Language;

        // Check if validation required
        if (!Config("SERVER_VALIDATE")) {
            return true;
        }
        $validateForm = true;
        if (EmptyValue($this->SecurityCode->CurrentValue)) {
            $this->SecurityCode->addErrorMessage($Language->phrase("EnterSecurityCode") . Config("TWO_FACTOR_AUTHENTICATION_TYPE"));
            $validateForm = false;
        }

        // Call Form Custom Validate event
        $formCustomError = "";
        $validateForm = $validateForm && $this->formCustomValidate($formCustomError);
        if ($formCustomError != "") {
            $this->setFailureMessage($formCustomError);
        }
        return $validateForm;
    }

    // Page Load event
    public function pageLoad()
    {
        //Log("Page Load");
    }

    // Page Unload event
    public function pageUnload()
    {
        //Log("Page Unload");
    }

    // Page Redirecting event
    public function pageRedirecting(&$url)
    {
        // Example:
        //$url = "your URL";
    }

    // Message Showing event
    // $type = ''|'success'|'failure'
    public function messageShowing(&$msg, $type)
    {
        // Example:
        //if ($type == 'success') $msg = "your success message";
    }

    // Page Render event
    public function pageRender()
    {
        //Log("Page Render");
    }

    // Page Data Rendering event
    public function pageDataRendering(&$header)
    {
        // Example:
        //$header = "your header";
    }

    // Page Data Rendered event
    public function pageDataRendered(&$footer)
    {
        // Example:
        //$footer = "your footer";
    }

    // Form Custom Validate event
    public function formCustomValidate(&$customError)
    {
        // Return error message in $customError
        return true;
    }
}
