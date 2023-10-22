<?php

namespace PHPMaker2023\jootidigitalhealthcare;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class JdhVitalsAdd extends JdhVitals
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Page object name
    public $PageObjName = "JdhVitalsAdd";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // CSS class/style
    public $CurrentPageName = "jdhvitalsadd";

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
        if ($this->TableName) {
            return $Language->phrase($this->PageID);
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
        parent::__construct();
        global $Language, $DashboardReport, $DebugTimer, $UserTable;
        $this->TableVar = 'jdh_vitals';
        $this->TableName = 'jdh_vitals';

        // Table CSS class
        $this->TableClass = "table table-striped table-bordered table-hover table-sm ew-desktop-table ew-add-table";

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("language");

        // Table object (jdh_vitals)
        if (!isset($GLOBALS["jdh_vitals"]) || get_class($GLOBALS["jdh_vitals"]) == PROJECT_NAMESPACE . "jdh_vitals") {
            $GLOBALS["jdh_vitals"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'jdh_vitals');
        }

        // Start timer
        $DebugTimer = Container("timer");

        // Debug message
        LoadDebugMessage();

        // Open connection
        $GLOBALS["Conn"] ??= $this->getConnection();

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

            // Handle modal response (Assume return to modal for simplicity)
            if ($this->IsModal) { // Show as modal
                $result = ["url" => GetUrl($url), "modal" => "1"];
                $pageName = GetPageName($url);
                if ($pageName != $this->getListUrl()) { // Not List page => View page
                    $result["caption"] = $this->getModalCaption($pageName);
                    $result["view"] = $pageName == "jdhvitalsview"; // If View page, no primary button
                } else { // List page
                    // $result["list"] = $this->PageID == "search"; // Refresh List page if current page is Search page
                    $result["error"] = $this->getFailureMessage(); // List page should not be shown as modal => error
                    $this->clearFailureMessage();
                }
                WriteJson($result);
            } else {
                SaveDebugMessage();
                Redirect(GetUrl($url));
            }
        }
        return; // Return to controller
    }

    // Get records from recordset
    protected function getRecordsFromRecordset($rs, $current = false)
    {
        $rows = [];
        if (is_object($rs)) { // Recordset
            while ($rs && !$rs->EOF) {
                $this->loadRowValues($rs); // Set up DbValue/CurrentValue
                $row = $this->getRecordFromArray($rs->fields);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
                $rs->moveNext();
            }
        } elseif (is_array($rs)) {
            foreach ($rs as $ar) {
                $row = $this->getRecordFromArray($ar);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
            }
        }
        return $rows;
    }

    // Get record from array
    protected function getRecordFromArray($ar)
    {
        $row = [];
        if (is_array($ar)) {
            foreach ($ar as $fldname => $val) {
                if (array_key_exists($fldname, $this->Fields) && ($this->Fields[$fldname]->Visible || $this->Fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
                    $fld = &$this->Fields[$fldname];
                    if ($fld->HtmlTag == "FILE") { // Upload field
                        if (EmptyValue($val)) {
                            $row[$fldname] = null;
                        } else {
                            if ($fld->DataType == DATATYPE_BLOB) {
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . $fld->Param . "/" . rawurlencode($this->getRecordKeyValue($ar))));
                                $row[$fldname] = ["type" => ContentType($val), "url" => $url, "name" => $fld->Param . ContentExtension($val)];
                            } elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $val)));
                                $row[$fldname] = ["type" => MimeContentType($val), "url" => $url, "name" => $val];
                            } else { // Multiple files
                                $files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
                                $ar = [];
                                foreach ($files as $file) {
                                    $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                        "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $file)));
                                    if (!EmptyValue($file)) {
                                        $ar[] = ["type" => MimeContentType($file), "url" => $url, "name" => $file];
                                    }
                                }
                                $row[$fldname] = $ar;
                            }
                        }
                    } else {
                        $row[$fldname] = $val;
                    }
                }
            }
        }
        return $row;
    }

    // Get record key value from array
    protected function getRecordKeyValue($ar)
    {
        $key = "";
        if (is_array($ar)) {
            $key .= @$ar['vitals_id'];
        }
        return $key;
    }

    /**
     * Hide fields for add/edit
     *
     * @return void
     */
    protected function hideFieldsForAddEdit()
    {
        if ($this->isAdd() || $this->isCopy() || $this->isGridAdd()) {
            $this->vitals_id->Visible = false;
        }
    }

    // Lookup data
    public function lookup($ar = null)
    {
        global $Language, $Security;

        // Get lookup object
        $fieldName = $ar["field"] ?? Post("field");
        $lookup = $this->Fields[$fieldName]->Lookup;
        $name = $ar["name"] ?? Post("name");
        $isQuery = ContainsString($name, "query_builder_rule");
        if ($isQuery) {
            $lookup->FilterFields = []; // Skip parent fields if any
        }

        // Get lookup parameters
        $lookupType = $ar["ajax"] ?? Post("ajax", "unknown");
        $pageSize = -1;
        $offset = -1;
        $searchValue = "";
        if (SameText($lookupType, "modal") || SameText($lookupType, "filter")) {
            $searchValue = $ar["q"] ?? Param("q") ?? $ar["sv"] ?? Post("sv", "");
            $pageSize = $ar["n"] ?? Param("n") ?? $ar["recperpage"] ?? Post("recperpage", 10);
        } elseif (SameText($lookupType, "autosuggest")) {
            $searchValue = $ar["q"] ?? Param("q", "");
            $pageSize = $ar["n"] ?? Param("n", -1);
            $pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
            if ($pageSize <= 0) {
                $pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
            }
        }
        $start = $ar["start"] ?? Param("start", -1);
        $start = is_numeric($start) ? (int)$start : -1;
        $page = $ar["page"] ?? Param("page", -1);
        $page = is_numeric($page) ? (int)$page : -1;
        $offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
        $userSelect = Decrypt($ar["s"] ?? Post("s", ""));
        $userFilter = Decrypt($ar["f"] ?? Post("f", ""));
        $userOrderBy = Decrypt($ar["o"] ?? Post("o", ""));
        $keys = $ar["keys"] ?? Post("keys");
        $lookup->LookupType = $lookupType; // Lookup type
        $lookup->FilterValues = []; // Clear filter values first
        if ($keys !== null) { // Selected records from modal
            if (is_array($keys)) {
                $keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
            }
            $lookup->FilterFields = []; // Skip parent fields if any
            $lookup->FilterValues[] = $keys; // Lookup values
            $pageSize = -1; // Show all records
        } else { // Lookup values
            $lookup->FilterValues[] = $ar["v0"] ?? $ar["lookupValue"] ?? Post("v0", Post("lookupValue", ""));
        }
        $cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
        for ($i = 1; $i <= $cnt; $i++) {
            $lookup->FilterValues[] = $ar["v" . $i] ?? Post("v" . $i, "");
        }
        $lookup->SearchValue = $searchValue;
        $lookup->PageSize = $pageSize;
        $lookup->Offset = $offset;
        if ($userSelect != "") {
            $lookup->UserSelect = $userSelect;
        }
        if ($userFilter != "") {
            $lookup->UserFilter = $userFilter;
        }
        if ($userOrderBy != "") {
            $lookup->UserOrderBy = $userOrderBy;
        }
        return $lookup->toJson($this, !is_array($ar)); // Use settings from current page
    }
    public $FormClassName = "ew-form ew-add-form";
    public $IsModal = false;
    public $IsMobileOrModal = false;
    public $DbMasterFilter = "";
    public $DbDetailFilter = "";
    public $StartRecord;
    public $Priv = 0;
    public $CopyRecord;

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $UserProfile, $Language, $Security, $CurrentForm, $SkipHeaderFooter;

        // Is modal
        $this->IsModal = ConvertToBool(Param("modal"));
        $this->UseLayout = $this->UseLayout && !$this->IsModal;

        // Use layout
        $this->UseLayout = $this->UseLayout && ConvertToBool(Param(Config("PAGE_LAYOUT"), true));

        // View
        $this->View = Get(Config("VIEW"));

        // Update last accessed time
        if (!IsSysAdmin() && !$UserProfile->isValidUser(CurrentUserName(), session_id())) {
            Write($Language->phrase("UserProfileCorrupted"));
            $this->terminate();
            return;
        }

        // Create form object
        $CurrentForm = new HttpForm();
        $this->CurrentAction = Param("action"); // Set up current action
        $this->vitals_id->Visible = false;
        $this->patient_id->setVisibility();
        $this->pressure->setVisibility();
        $this->height->setVisibility();
        $this->weight->setVisibility();
        $this->body_mass_index->Visible = false;
        $this->pulse_rate->setVisibility();
        $this->respiratory_rate->setVisibility();
        $this->temperature->setVisibility();
        $this->random_blood_sugar->setVisibility();
        $this->spo_2->setVisibility();
        $this->submission_date->Visible = false;
        $this->submitted_by_user_id->setVisibility();
        $this->patient_status->Visible = false;

        // Set lookup cache
        if (!in_array($this->PageID, Config("LOOKUP_CACHE_PAGE_IDS"))) {
            $this->setUseLookupCache(false);
        }

        // Global Page Loading event (in userfn*.php)
        Page_Loading();

        // Page Load event
        if (method_exists($this, "pageLoad")) {
            $this->pageLoad();
        }

        // Hide fields for add/edit
        if (!$this->UseAjaxActions) {
            $this->hideFieldsForAddEdit();
        }
        // Use inline delete
        if ($this->UseAjaxActions) {
            $this->InlineDelete = true;
        }

        // Set up lookup cache
        $this->setupLookupOptions($this->patient_id);

        // Load default values for add
        $this->loadDefaultValues();

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;
        $postBack = false;

        // Set up current action
        if (IsApi()) {
            $this->CurrentAction = "insert"; // Add record directly
            $postBack = true;
        } elseif (Post("action") !== null) {
            $this->CurrentAction = Post("action"); // Get form action
            $this->setKey(Post($this->OldKeyName));
            $postBack = true;
        } else {
            // Load key values from QueryString
            if (($keyValue = Get("vitals_id") ?? Route("vitals_id")) !== null) {
                $this->vitals_id->setQueryStringValue($keyValue);
            }
            $this->OldKey = $this->getKey(true); // Get from CurrentValue
            $this->CopyRecord = !EmptyValue($this->OldKey);
            if ($this->CopyRecord) {
                $this->CurrentAction = "copy"; // Copy record
            } else {
                $this->CurrentAction = "show"; // Display blank record
            }
        }

        // Load old record or default values
        $rsold = $this->loadOldRecord();

        // Set up master/detail parameters
        // NOTE: Must be after loadOldRecord to prevent master key values being overwritten
        $this->setupMasterParms();

        // Load form values
        if ($postBack) {
            $this->loadFormValues(); // Load form values
        }

        // Validate form if post back
        if ($postBack) {
            if (!$this->validateForm()) {
                $this->EventCancelled = true; // Event cancelled
                $this->restoreFormValues(); // Restore form values
                if (IsApi()) {
                    $this->terminate();
                    return;
                } else {
                    $this->CurrentAction = "show"; // Form error, reset action
                }
            }
        }

        // Perform current action
        switch ($this->CurrentAction) {
            case "copy": // Copy an existing record
                if (!$rsold) { // Record not loaded
                    if ($this->getFailureMessage() == "") {
                        $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
                    }
                    $this->terminate("jdhvitalslist"); // No matching record, return to list
                    return;
                }
                break;
            case "insert": // Add new record
                $this->SendEmail = true; // Send email on add success
                if ($this->addRow($rsold)) {
                    // Do not return Json for UseAjaxActions
                    if ($this->IsModal && $this->UseAjaxActions) {
                        $this->IsModal = false;
                    }
                    if ($this->getSuccessMessage() == "" && Post("addopt") != "1") { // Skip success message for addopt (done in JavaScript)
                        $this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
                    }
                    $returnUrl = $this->getReturnUrl();
                    if (GetPageName($returnUrl) == "jdhvitalslist") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "jdhvitalsview") {
                        $returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
                    }

                    // Handle UseAjaxActions with return page
                    if ($this->UseAjaxActions && GetPageName($returnUrl) != "jdhvitalslist") {
                        Container("flash")->addMessage("Return-Url", $returnUrl); // Save return URL
                        $returnUrl = "jdhvitalslist"; // Return list page content
                    }
                    if (IsJsonResponse()) { // Return to caller
                        $this->terminate(true);
                        return;
                    } else {
                        $this->terminate($returnUrl);
                        return;
                    }
                } elseif (IsApi()) { // API request, return
                    $this->terminate();
                    return;
                } elseif ($this->UseAjaxActions) { // Return JSON error message
                    WriteJson([ "success" => false, "error" => $this->getFailureMessage() ]);
                    $this->clearFailureMessage();
                    $this->terminate();
                    return;
                } else {
                    $this->EventCancelled = true; // Event cancelled
                    $this->restoreFormValues(); // Add failed, restore form values
                }
        }

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Render row based on row type
        $this->RowType = ROWTYPE_ADD; // Render add type

        // Render row
        $this->resetAttributes();
        $this->renderRow();

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

    // Get upload files
    protected function getUploadFiles()
    {
        global $CurrentForm, $Language;
    }

    // Load default values
    protected function loadDefaultValues()
    {
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;
        $validate = !Config("SERVER_VALIDATE");

        // Check field name 'patient_id' first before field var 'x_patient_id'
        $val = $CurrentForm->hasValue("patient_id") ? $CurrentForm->getValue("patient_id") : $CurrentForm->getValue("x_patient_id");
        if (!$this->patient_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->patient_id->Visible = false; // Disable update for API request
            } else {
                $this->patient_id->setFormValue($val);
            }
        }

        // Check field name 'pressure' first before field var 'x_pressure'
        $val = $CurrentForm->hasValue("pressure") ? $CurrentForm->getValue("pressure") : $CurrentForm->getValue("x_pressure");
        if (!$this->pressure->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->pressure->Visible = false; // Disable update for API request
            } else {
                $this->pressure->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'height' first before field var 'x_height'
        $val = $CurrentForm->hasValue("height") ? $CurrentForm->getValue("height") : $CurrentForm->getValue("x_height");
        if (!$this->height->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->height->Visible = false; // Disable update for API request
            } else {
                $this->height->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'weight' first before field var 'x_weight'
        $val = $CurrentForm->hasValue("weight") ? $CurrentForm->getValue("weight") : $CurrentForm->getValue("x_weight");
        if (!$this->weight->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->weight->Visible = false; // Disable update for API request
            } else {
                $this->weight->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'pulse_rate' first before field var 'x_pulse_rate'
        $val = $CurrentForm->hasValue("pulse_rate") ? $CurrentForm->getValue("pulse_rate") : $CurrentForm->getValue("x_pulse_rate");
        if (!$this->pulse_rate->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->pulse_rate->Visible = false; // Disable update for API request
            } else {
                $this->pulse_rate->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'respiratory_rate' first before field var 'x_respiratory_rate'
        $val = $CurrentForm->hasValue("respiratory_rate") ? $CurrentForm->getValue("respiratory_rate") : $CurrentForm->getValue("x_respiratory_rate");
        if (!$this->respiratory_rate->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->respiratory_rate->Visible = false; // Disable update for API request
            } else {
                $this->respiratory_rate->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'temperature' first before field var 'x_temperature'
        $val = $CurrentForm->hasValue("temperature") ? $CurrentForm->getValue("temperature") : $CurrentForm->getValue("x_temperature");
        if (!$this->temperature->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->temperature->Visible = false; // Disable update for API request
            } else {
                $this->temperature->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'random_blood_sugar' first before field var 'x_random_blood_sugar'
        $val = $CurrentForm->hasValue("random_blood_sugar") ? $CurrentForm->getValue("random_blood_sugar") : $CurrentForm->getValue("x_random_blood_sugar");
        if (!$this->random_blood_sugar->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->random_blood_sugar->Visible = false; // Disable update for API request
            } else {
                $this->random_blood_sugar->setFormValue($val);
            }
        }

        // Check field name 'spo_2' first before field var 'x_spo_2'
        $val = $CurrentForm->hasValue("spo_2") ? $CurrentForm->getValue("spo_2") : $CurrentForm->getValue("x_spo_2");
        if (!$this->spo_2->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->spo_2->Visible = false; // Disable update for API request
            } else {
                $this->spo_2->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'submitted_by_user_id' first before field var 'x_submitted_by_user_id'
        $val = $CurrentForm->hasValue("submitted_by_user_id") ? $CurrentForm->getValue("submitted_by_user_id") : $CurrentForm->getValue("x_submitted_by_user_id");
        if (!$this->submitted_by_user_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->submitted_by_user_id->Visible = false; // Disable update for API request
            } else {
                $this->submitted_by_user_id->setFormValue($val);
            }
        }

        // Check field name 'vitals_id' first before field var 'x_vitals_id'
        $val = $CurrentForm->hasValue("vitals_id") ? $CurrentForm->getValue("vitals_id") : $CurrentForm->getValue("x_vitals_id");
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->patient_id->CurrentValue = $this->patient_id->FormValue;
        $this->pressure->CurrentValue = $this->pressure->FormValue;
        $this->height->CurrentValue = $this->height->FormValue;
        $this->weight->CurrentValue = $this->weight->FormValue;
        $this->pulse_rate->CurrentValue = $this->pulse_rate->FormValue;
        $this->respiratory_rate->CurrentValue = $this->respiratory_rate->FormValue;
        $this->temperature->CurrentValue = $this->temperature->FormValue;
        $this->random_blood_sugar->CurrentValue = $this->random_blood_sugar->FormValue;
        $this->spo_2->CurrentValue = $this->spo_2->FormValue;
        $this->submitted_by_user_id->CurrentValue = $this->submitted_by_user_id->FormValue;
    }

    /**
     * Load row based on key values
     *
     * @return void
     */
    public function loadRow()
    {
        global $Security, $Language;
        $filter = $this->getRecordFilter();

        // Call Row Selecting event
        $this->rowSelecting($filter);

        // Load SQL based on filter
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $res = false;
        $row = $conn->fetchAssociative($sql);
        if ($row) {
            $res = true;
            $this->loadRowValues($row); // Load row values
        }

        // Check if valid User ID
        if ($res) {
            $res = $this->showOptionLink("add");
            if (!$res) {
                $userIdMsg = DeniedMessage();
                $this->setFailureMessage($userIdMsg);
            }
        }
        return $res;
    }

    /**
     * Load row values from recordset or record
     *
     * @param Recordset|array $rs Record
     * @return void
     */
    public function loadRowValues($rs = null)
    {
        if (is_array($rs)) {
            $row = $rs;
        } elseif ($rs && property_exists($rs, "fields")) { // Recordset
            $row = $rs->fields;
        } else {
            $row = $this->newRow();
        }
        if (!$row) {
            return;
        }

        // Call Row Selected event
        $this->rowSelected($row);
        $this->vitals_id->setDbValue($row['vitals_id']);
        $this->patient_id->setDbValue($row['patient_id']);
        $this->pressure->setDbValue($row['pressure']);
        $this->height->setDbValue($row['height']);
        $this->weight->setDbValue($row['weight']);
        $this->body_mass_index->setDbValue($row['body_mass_index']);
        $this->pulse_rate->setDbValue($row['pulse_rate']);
        $this->respiratory_rate->setDbValue($row['respiratory_rate']);
        $this->temperature->setDbValue($row['temperature']);
        $this->random_blood_sugar->setDbValue($row['random_blood_sugar']);
        $this->spo_2->setDbValue($row['spo_2']);
        $this->submission_date->setDbValue($row['submission_date']);
        $this->submitted_by_user_id->setDbValue($row['submitted_by_user_id']);
        $this->patient_status->setDbValue($row['patient_status']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['vitals_id'] = $this->vitals_id->DefaultValue;
        $row['patient_id'] = $this->patient_id->DefaultValue;
        $row['pressure'] = $this->pressure->DefaultValue;
        $row['height'] = $this->height->DefaultValue;
        $row['weight'] = $this->weight->DefaultValue;
        $row['body_mass_index'] = $this->body_mass_index->DefaultValue;
        $row['pulse_rate'] = $this->pulse_rate->DefaultValue;
        $row['respiratory_rate'] = $this->respiratory_rate->DefaultValue;
        $row['temperature'] = $this->temperature->DefaultValue;
        $row['random_blood_sugar'] = $this->random_blood_sugar->DefaultValue;
        $row['spo_2'] = $this->spo_2->DefaultValue;
        $row['submission_date'] = $this->submission_date->DefaultValue;
        $row['submitted_by_user_id'] = $this->submitted_by_user_id->DefaultValue;
        $row['patient_status'] = $this->patient_status->DefaultValue;
        return $row;
    }

    // Load old record
    protected function loadOldRecord()
    {
        // Load old record
        if ($this->OldKey != "") {
            $this->setKey($this->OldKey);
            $this->CurrentFilter = $this->getRecordFilter();
            $sql = $this->getCurrentSql();
            $conn = $this->getConnection();
            $rs = LoadRecordset($sql, $conn);
            if ($rs && ($row = $rs->fields)) {
                $this->loadRowValues($row); // Load row values
                return $row;
            }
        }
        $this->loadRowValues(); // Load default row values
        return null;
    }

    // Render row values based on field settings
    public function renderRow()
    {
        global $Security, $Language, $CurrentLanguage;

        // Initialize URLs

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // vitals_id
        $this->vitals_id->RowCssClass = "row";

        // patient_id
        $this->patient_id->RowCssClass = "row";

        // pressure
        $this->pressure->RowCssClass = "row";

        // height
        $this->height->RowCssClass = "row";

        // weight
        $this->weight->RowCssClass = "row";

        // body_mass_index
        $this->body_mass_index->RowCssClass = "row";

        // pulse_rate
        $this->pulse_rate->RowCssClass = "row";

        // respiratory_rate
        $this->respiratory_rate->RowCssClass = "row";

        // temperature
        $this->temperature->RowCssClass = "row";

        // random_blood_sugar
        $this->random_blood_sugar->RowCssClass = "row";

        // spo_2
        $this->spo_2->RowCssClass = "row";

        // submission_date
        $this->submission_date->RowCssClass = "row";

        // submitted_by_user_id
        $this->submitted_by_user_id->RowCssClass = "row";

        // patient_status
        $this->patient_status->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // vitals_id
            $this->vitals_id->ViewValue = $this->vitals_id->CurrentValue;

            // patient_id
            $curVal = strval($this->patient_id->CurrentValue);
            if ($curVal != "") {
                $this->patient_id->ViewValue = $this->patient_id->lookupCacheOption($curVal);
                if ($this->patient_id->ViewValue === null) { // Lookup from database
                    $filterWrk = SearchFilter("`patient_id`", "=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->patient_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->patient_id->Lookup->renderViewRow($rswrk[0]);
                        $this->patient_id->ViewValue = $this->patient_id->displayValue($arwrk);
                    } else {
                        $this->patient_id->ViewValue = FormatNumber($this->patient_id->CurrentValue, $this->patient_id->formatPattern());
                    }
                }
            } else {
                $this->patient_id->ViewValue = null;
            }

            // pressure
            $this->pressure->ViewValue = $this->pressure->CurrentValue;
            $this->pressure->ViewValue = FormatNumber($this->pressure->ViewValue, $this->pressure->formatPattern());

            // height
            $this->height->ViewValue = $this->height->CurrentValue;
            $this->height->ViewValue = FormatNumber($this->height->ViewValue, $this->height->formatPattern());

            // weight
            $this->weight->ViewValue = $this->weight->CurrentValue;
            $this->weight->ViewValue = FormatNumber($this->weight->ViewValue, $this->weight->formatPattern());

            // body_mass_index
            $this->body_mass_index->ViewValue = $this->body_mass_index->CurrentValue;
            $this->body_mass_index->ViewValue = FormatNumber($this->body_mass_index->ViewValue, $this->body_mass_index->formatPattern());

            // pulse_rate
            $this->pulse_rate->ViewValue = $this->pulse_rate->CurrentValue;
            $this->pulse_rate->ViewValue = FormatNumber($this->pulse_rate->ViewValue, $this->pulse_rate->formatPattern());

            // respiratory_rate
            $this->respiratory_rate->ViewValue = $this->respiratory_rate->CurrentValue;
            $this->respiratory_rate->ViewValue = FormatNumber($this->respiratory_rate->ViewValue, $this->respiratory_rate->formatPattern());

            // temperature
            $this->temperature->ViewValue = $this->temperature->CurrentValue;
            $this->temperature->ViewValue = FormatNumber($this->temperature->ViewValue, $this->temperature->formatPattern());

            // random_blood_sugar
            $this->random_blood_sugar->ViewValue = $this->random_blood_sugar->CurrentValue;

            // spo_2
            $this->spo_2->ViewValue = $this->spo_2->CurrentValue;
            $this->spo_2->ViewValue = FormatNumber($this->spo_2->ViewValue, $this->spo_2->formatPattern());

            // submission_date
            $this->submission_date->ViewValue = $this->submission_date->CurrentValue;
            $this->submission_date->ViewValue = FormatDateTime($this->submission_date->ViewValue, $this->submission_date->formatPattern());

            // submitted_by_user_id
            $this->submitted_by_user_id->ViewValue = $this->submitted_by_user_id->CurrentValue;
            $this->submitted_by_user_id->ViewValue = FormatNumber($this->submitted_by_user_id->ViewValue, $this->submitted_by_user_id->formatPattern());

            // patient_id
            $this->patient_id->HrefValue = "";

            // pressure
            $this->pressure->HrefValue = "";

            // height
            $this->height->HrefValue = "";

            // weight
            $this->weight->HrefValue = "";

            // pulse_rate
            $this->pulse_rate->HrefValue = "";

            // respiratory_rate
            $this->respiratory_rate->HrefValue = "";

            // temperature
            $this->temperature->HrefValue = "";

            // random_blood_sugar
            $this->random_blood_sugar->HrefValue = "";

            // spo_2
            $this->spo_2->HrefValue = "";

            // submitted_by_user_id
            $this->submitted_by_user_id->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // patient_id
            $this->patient_id->setupEditAttributes();
            if ($this->patient_id->getSessionValue() != "") {
                $this->patient_id->CurrentValue = GetForeignKeyValue($this->patient_id->getSessionValue());
                $curVal = strval($this->patient_id->CurrentValue);
                if ($curVal != "") {
                    $this->patient_id->ViewValue = $this->patient_id->lookupCacheOption($curVal);
                    if ($this->patient_id->ViewValue === null) { // Lookup from database
                        $filterWrk = SearchFilter("`patient_id`", "=", $curVal, DATATYPE_NUMBER, "");
                        $sqlWrk = $this->patient_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                        $conn = Conn();
                        $config = $conn->getConfiguration();
                        $config->setResultCacheImpl($this->Cache);
                        $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                        $ari = count($rswrk);
                        if ($ari > 0) { // Lookup values found
                            $arwrk = $this->patient_id->Lookup->renderViewRow($rswrk[0]);
                            $this->patient_id->ViewValue = $this->patient_id->displayValue($arwrk);
                        } else {
                            $this->patient_id->ViewValue = FormatNumber($this->patient_id->CurrentValue, $this->patient_id->formatPattern());
                        }
                    }
                } else {
                    $this->patient_id->ViewValue = null;
                }
            } else {
                $curVal = trim(strval($this->patient_id->CurrentValue));
                if ($curVal != "") {
                    $this->patient_id->ViewValue = $this->patient_id->lookupCacheOption($curVal);
                } else {
                    $this->patient_id->ViewValue = $this->patient_id->Lookup !== null && is_array($this->patient_id->lookupOptions()) ? $curVal : null;
                }
                if ($this->patient_id->ViewValue !== null) { // Load from cache
                    $this->patient_id->EditValue = array_values($this->patient_id->lookupOptions());
                } else { // Lookup from database
                    if ($curVal == "") {
                        $filterWrk = "0=1";
                    } else {
                        $filterWrk = SearchFilter("`patient_id`", "=", $this->patient_id->CurrentValue, DATATYPE_NUMBER, "");
                    }
                    $sqlWrk = $this->patient_id->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    $arwrk = $rswrk;
                    $this->patient_id->EditValue = $arwrk;
                }
                $this->patient_id->PlaceHolder = RemoveHtml($this->patient_id->caption());
            }

            // pressure
            $this->pressure->setupEditAttributes();
            $this->pressure->EditValue = HtmlEncode($this->pressure->CurrentValue);
            $this->pressure->PlaceHolder = RemoveHtml($this->pressure->caption());
            if (strval($this->pressure->EditValue) != "" && is_numeric($this->pressure->EditValue)) {
                $this->pressure->EditValue = FormatNumber($this->pressure->EditValue, null);
            }

            // height
            $this->height->setupEditAttributes();
            $this->height->EditValue = HtmlEncode($this->height->CurrentValue);
            $this->height->PlaceHolder = RemoveHtml($this->height->caption());
            if (strval($this->height->EditValue) != "" && is_numeric($this->height->EditValue)) {
                $this->height->EditValue = FormatNumber($this->height->EditValue, null);
            }

            // weight
            $this->weight->setupEditAttributes();
            $this->weight->EditValue = HtmlEncode($this->weight->CurrentValue);
            $this->weight->PlaceHolder = RemoveHtml($this->weight->caption());
            if (strval($this->weight->EditValue) != "" && is_numeric($this->weight->EditValue)) {
                $this->weight->EditValue = FormatNumber($this->weight->EditValue, null);
            }

            // pulse_rate
            $this->pulse_rate->setupEditAttributes();
            $this->pulse_rate->EditValue = HtmlEncode($this->pulse_rate->CurrentValue);
            $this->pulse_rate->PlaceHolder = RemoveHtml($this->pulse_rate->caption());
            if (strval($this->pulse_rate->EditValue) != "" && is_numeric($this->pulse_rate->EditValue)) {
                $this->pulse_rate->EditValue = FormatNumber($this->pulse_rate->EditValue, null);
            }

            // respiratory_rate
            $this->respiratory_rate->setupEditAttributes();
            $this->respiratory_rate->EditValue = HtmlEncode($this->respiratory_rate->CurrentValue);
            $this->respiratory_rate->PlaceHolder = RemoveHtml($this->respiratory_rate->caption());
            if (strval($this->respiratory_rate->EditValue) != "" && is_numeric($this->respiratory_rate->EditValue)) {
                $this->respiratory_rate->EditValue = FormatNumber($this->respiratory_rate->EditValue, null);
            }

            // temperature
            $this->temperature->setupEditAttributes();
            $this->temperature->EditValue = HtmlEncode($this->temperature->CurrentValue);
            $this->temperature->PlaceHolder = RemoveHtml($this->temperature->caption());
            if (strval($this->temperature->EditValue) != "" && is_numeric($this->temperature->EditValue)) {
                $this->temperature->EditValue = FormatNumber($this->temperature->EditValue, null);
            }

            // random_blood_sugar
            $this->random_blood_sugar->setupEditAttributes();
            if (!$this->random_blood_sugar->Raw) {
                $this->random_blood_sugar->CurrentValue = HtmlDecode($this->random_blood_sugar->CurrentValue);
            }
            $this->random_blood_sugar->EditValue = HtmlEncode($this->random_blood_sugar->CurrentValue);
            $this->random_blood_sugar->PlaceHolder = RemoveHtml($this->random_blood_sugar->caption());

            // spo_2
            $this->spo_2->setupEditAttributes();
            $this->spo_2->EditValue = HtmlEncode($this->spo_2->CurrentValue);
            $this->spo_2->PlaceHolder = RemoveHtml($this->spo_2->caption());
            if (strval($this->spo_2->EditValue) != "" && is_numeric($this->spo_2->EditValue)) {
                $this->spo_2->EditValue = FormatNumber($this->spo_2->EditValue, null);
            }

            // submitted_by_user_id

            // Add refer script

            // patient_id
            $this->patient_id->HrefValue = "";

            // pressure
            $this->pressure->HrefValue = "";

            // height
            $this->height->HrefValue = "";

            // weight
            $this->weight->HrefValue = "";

            // pulse_rate
            $this->pulse_rate->HrefValue = "";

            // respiratory_rate
            $this->respiratory_rate->HrefValue = "";

            // temperature
            $this->temperature->HrefValue = "";

            // random_blood_sugar
            $this->random_blood_sugar->HrefValue = "";

            // spo_2
            $this->spo_2->HrefValue = "";

            // submitted_by_user_id
            $this->submitted_by_user_id->HrefValue = "";
        }
        if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) { // Add/Edit/Search row
            $this->setupFieldTitles();
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }
    }

    // Validate form
    protected function validateForm()
    {
        global $Language, $Security;

        // Check if validation required
        if (!Config("SERVER_VALIDATE")) {
            return true;
        }
        $validateForm = true;
        if ($this->patient_id->Required) {
            if (!$this->patient_id->IsDetailKey && EmptyValue($this->patient_id->FormValue)) {
                $this->patient_id->addErrorMessage(str_replace("%s", $this->patient_id->caption(), $this->patient_id->RequiredErrorMessage));
            }
        }
        if ($this->pressure->Required) {
            if (!$this->pressure->IsDetailKey && EmptyValue($this->pressure->FormValue)) {
                $this->pressure->addErrorMessage(str_replace("%s", $this->pressure->caption(), $this->pressure->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->pressure->FormValue)) {
            $this->pressure->addErrorMessage($this->pressure->getErrorMessage(false));
        }
        if ($this->height->Required) {
            if (!$this->height->IsDetailKey && EmptyValue($this->height->FormValue)) {
                $this->height->addErrorMessage(str_replace("%s", $this->height->caption(), $this->height->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->height->FormValue)) {
            $this->height->addErrorMessage($this->height->getErrorMessage(false));
        }
        if ($this->weight->Required) {
            if (!$this->weight->IsDetailKey && EmptyValue($this->weight->FormValue)) {
                $this->weight->addErrorMessage(str_replace("%s", $this->weight->caption(), $this->weight->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->weight->FormValue)) {
            $this->weight->addErrorMessage($this->weight->getErrorMessage(false));
        }
        if ($this->pulse_rate->Required) {
            if (!$this->pulse_rate->IsDetailKey && EmptyValue($this->pulse_rate->FormValue)) {
                $this->pulse_rate->addErrorMessage(str_replace("%s", $this->pulse_rate->caption(), $this->pulse_rate->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->pulse_rate->FormValue)) {
            $this->pulse_rate->addErrorMessage($this->pulse_rate->getErrorMessage(false));
        }
        if ($this->respiratory_rate->Required) {
            if (!$this->respiratory_rate->IsDetailKey && EmptyValue($this->respiratory_rate->FormValue)) {
                $this->respiratory_rate->addErrorMessage(str_replace("%s", $this->respiratory_rate->caption(), $this->respiratory_rate->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->respiratory_rate->FormValue)) {
            $this->respiratory_rate->addErrorMessage($this->respiratory_rate->getErrorMessage(false));
        }
        if ($this->temperature->Required) {
            if (!$this->temperature->IsDetailKey && EmptyValue($this->temperature->FormValue)) {
                $this->temperature->addErrorMessage(str_replace("%s", $this->temperature->caption(), $this->temperature->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->temperature->FormValue)) {
            $this->temperature->addErrorMessage($this->temperature->getErrorMessage(false));
        }
        if ($this->random_blood_sugar->Required) {
            if (!$this->random_blood_sugar->IsDetailKey && EmptyValue($this->random_blood_sugar->FormValue)) {
                $this->random_blood_sugar->addErrorMessage(str_replace("%s", $this->random_blood_sugar->caption(), $this->random_blood_sugar->RequiredErrorMessage));
            }
        }
        if ($this->spo_2->Required) {
            if (!$this->spo_2->IsDetailKey && EmptyValue($this->spo_2->FormValue)) {
                $this->spo_2->addErrorMessage(str_replace("%s", $this->spo_2->caption(), $this->spo_2->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->spo_2->FormValue)) {
            $this->spo_2->addErrorMessage($this->spo_2->getErrorMessage(false));
        }
        if ($this->submitted_by_user_id->Required) {
            if (!$this->submitted_by_user_id->IsDetailKey && EmptyValue($this->submitted_by_user_id->FormValue)) {
                $this->submitted_by_user_id->addErrorMessage(str_replace("%s", $this->submitted_by_user_id->caption(), $this->submitted_by_user_id->RequiredErrorMessage));
            }
        }

        // Return validate result
        $validateForm = $validateForm && !$this->hasInvalidFields();

        // Call Form_CustomValidate event
        $formCustomError = "";
        $validateForm = $validateForm && $this->formCustomValidate($formCustomError);
        if ($formCustomError != "") {
            $this->setFailureMessage($formCustomError);
        }
        return $validateForm;
    }

    // Add record
    protected function addRow($rsold = null)
    {
        global $Language, $Security;

        // Set new row
        $rsnew = [];

        // patient_id
        $this->patient_id->setDbValueDef($rsnew, $this->patient_id->CurrentValue, null, false);

        // pressure
        $this->pressure->setDbValueDef($rsnew, $this->pressure->CurrentValue, 0, false);

        // height
        $this->height->setDbValueDef($rsnew, $this->height->CurrentValue, 0, false);

        // weight
        $this->weight->setDbValueDef($rsnew, $this->weight->CurrentValue, 0, false);

        // pulse_rate
        $this->pulse_rate->setDbValueDef($rsnew, $this->pulse_rate->CurrentValue, 0, false);

        // respiratory_rate
        $this->respiratory_rate->setDbValueDef($rsnew, $this->respiratory_rate->CurrentValue, 0, false);

        // temperature
        $this->temperature->setDbValueDef($rsnew, $this->temperature->CurrentValue, 0, false);

        // random_blood_sugar
        $this->random_blood_sugar->setDbValueDef($rsnew, $this->random_blood_sugar->CurrentValue, "", false);

        // spo_2
        $this->spo_2->setDbValueDef($rsnew, $this->spo_2->CurrentValue, 0, false);

        // submitted_by_user_id
        $this->submitted_by_user_id->CurrentValue = $this->submitted_by_user_id->getAutoUpdateValue(); // PHP
        $this->submitted_by_user_id->setDbValueDef($rsnew, $this->submitted_by_user_id->CurrentValue, 0);

        // Update current values
        $this->setCurrentValues($rsnew);

        // Check if valid key values for master user
        if ($Security->currentUserID() != "" && !$Security->isAdmin()) { // Non system admin
            $detailKeys = [];
            $detailKeys["patient_id"] = $this->patient_id->CurrentValue;
            $masterTable = Container("jdh_patients");
            $masterFilter = $this->getMasterFilter($masterTable, $detailKeys);
            if (!EmptyValue($masterFilter)) {
                $validMasterKey = true;
                if ($rsmaster = $masterTable->loadRs($masterFilter)->fetchAssociative()) {
                    $validMasterKey = $Security->isValidUserID($rsmaster['submitted_by_user_id']);
                } elseif ($this->getCurrentMasterTable() == "jdh_patients") {
                    $validMasterKey = false;
                }
                if (!$validMasterKey) {
                    $masterUserIdMsg = str_replace("%c", CurrentUserID(), $Language->phrase("UnAuthorizedMasterUserID"));
                    $masterUserIdMsg = str_replace("%f", $masterFilter, $masterUserIdMsg);
                    $this->setFailureMessage($masterUserIdMsg);
                    return false;
                }
            }
        }
        $conn = $this->getConnection();

        // Load db values from old row
        $this->loadDbValues($rsold);

        // Call Row Inserting event
        $insertRow = $this->rowInserting($rsold, $rsnew);
        if ($insertRow) {
            $addRow = $this->insert($rsnew);
            if ($addRow) {
            } elseif (!EmptyValue($this->DbErrorMessage)) { // Show database error
                $this->setFailureMessage($this->DbErrorMessage);
            }
        } else {
            if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                // Use the message, do nothing
            } elseif ($this->CancelMessage != "") {
                $this->setFailureMessage($this->CancelMessage);
                $this->CancelMessage = "";
            } else {
                $this->setFailureMessage($Language->phrase("InsertCancelled"));
            }
            $addRow = false;
        }
        if ($addRow) {
            // Call Row Inserted event
            $this->rowInserted($rsold, $rsnew);
        }

        // Write JSON response
        if (IsJsonResponse() && $addRow) {
            $row = $this->getRecordsFromRecordset([$rsnew], true);
            $table = $this->TableVar;
            WriteJson(["success" => true, "action" => Config("API_ADD_ACTION"), $table => $row]);
        }
        return $addRow;
    }

    // Show link optionally based on User ID
    protected function showOptionLink($id = "")
    {
        global $Security;
        if ($Security->isLoggedIn() && !$Security->isAdmin() && !$this->userIDAllow($id)) {
            return $Security->isValidUserID($this->submitted_by_user_id->CurrentValue);
        }
        return true;
    }

    // Set up master/detail based on QueryString
    protected function setupMasterParms()
    {
        $validMaster = false;
        // Get the keys for master table
        if (($master = Get(Config("TABLE_SHOW_MASTER"), Get(Config("TABLE_MASTER")))) !== null) {
            $masterTblVar = $master;
            if ($masterTblVar == "") {
                $validMaster = true;
                $this->DbMasterFilter = "";
                $this->DbDetailFilter = "";
            }
            if ($masterTblVar == "jdh_patients") {
                $validMaster = true;
                $masterTbl = Container("jdh_patients");
                if (($parm = Get("fk_patient_id", Get("patient_id"))) !== null) {
                    $masterTbl->patient_id->setQueryStringValue($parm);
                    $this->patient_id->QueryStringValue = $masterTbl->patient_id->QueryStringValue; // DO NOT change, master/detail key data type can be different
                    $this->patient_id->setSessionValue($this->patient_id->QueryStringValue);
                    if (!is_numeric($masterTbl->patient_id->QueryStringValue)) {
                        $validMaster = false;
                    }
                } else {
                    $validMaster = false;
                }
            }
        } elseif (($master = Post(Config("TABLE_SHOW_MASTER"), Post(Config("TABLE_MASTER")))) !== null) {
            $masterTblVar = $master;
            if ($masterTblVar == "") {
                    $validMaster = true;
                    $this->DbMasterFilter = "";
                    $this->DbDetailFilter = "";
            }
            if ($masterTblVar == "jdh_patients") {
                $validMaster = true;
                $masterTbl = Container("jdh_patients");
                if (($parm = Post("fk_patient_id", Post("patient_id"))) !== null) {
                    $masterTbl->patient_id->setFormValue($parm);
                    $this->patient_id->setFormValue($masterTbl->patient_id->FormValue);
                    $this->patient_id->setSessionValue($this->patient_id->FormValue);
                    if (!is_numeric($masterTbl->patient_id->FormValue)) {
                        $validMaster = false;
                    }
                } else {
                    $validMaster = false;
                }
            }
        }
        if ($validMaster) {
            // Save current master table
            $this->setCurrentMasterTable($masterTblVar);

            // Reset start record counter (new master key)
            if (!$this->isAddOrEdit()) {
                $this->StartRecord = 1;
                $this->setStartRecordNumber($this->StartRecord);
            }

            // Clear previous master key from Session
            if ($masterTblVar != "jdh_patients") {
                if ($this->patient_id->CurrentValue == "") {
                    $this->patient_id->setSessionValue("");
                }
            }
        }
        $this->DbMasterFilter = $this->getMasterFilterFromSession(); // Get master filter from session
        $this->DbDetailFilter = $this->getDetailFilterFromSession(); // Get detail filter from session
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("jdhvitalslist"), "", $this->TableVar, true);
        $pageId = ($this->isCopy()) ? "Copy" : "Add";
        $Breadcrumb->add("add", $pageId, $url);
    }

    // Setup lookup options
    public function setupLookupOptions($fld)
    {
        if ($fld->Lookup !== null && $fld->Lookup->Options === null) {
            // Get default connection and filter
            $conn = $this->getConnection();
            $lookupFilter = "";

            // No need to check any more
            $fld->Lookup->Options = [];

            // Set up lookup SQL and connection
            switch ($fld->FieldVar) {
                case "x_patient_id":
                    break;
                default:
                    $lookupFilter = "";
                    break;
            }

            // Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
            $sql = $fld->Lookup->getSql(false, "", $lookupFilter, $this);

            // Set up lookup cache
            if (!$fld->hasLookupOptions() && $fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0) {
                $totalCnt = $this->getRecordCount($sql, $conn);
                if ($totalCnt > $fld->LookupCacheCount) { // Total count > cache count, do not cache
                    return;
                }
                $rows = $conn->executeQuery($sql)->fetchAll();
                $ar = [];
                foreach ($rows as $row) {
                    $row = $fld->Lookup->renderViewRow($row, Container($fld->Lookup->LinkTable));
                    $key = $row["lf"];
                    if (IsFloatType($fld->Type)) { // Handle float field
                        $key = (float)$key;
                    }
                    $ar[strval($key)] = $row;
                }
                $fld->Lookup->Options = $ar;
            }
        }
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
    // $type = ''|'success'|'failure'|'warning'
    public function messageShowing(&$msg, $type)
    {
        if ($type == 'success') {
            //$msg = "your success message";
        } elseif ($type == 'failure') {
            //$msg = "your failure message";
        } elseif ($type == 'warning') {
            //$msg = "your warning message";
        } else {
            //$msg = "your message";
        }
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

    // Page Breaking event
    public function pageBreaking(&$break, &$content)
    {
        // Example:
        //$break = false; // Skip page break, or
        //$content = "<div style=\"break-after:page;\"></div>"; // Modify page break content
    }

    // Form Custom Validate event
    public function formCustomValidate(&$customError)
    {
        // Return error message in $customError
        return true;
    }
}
