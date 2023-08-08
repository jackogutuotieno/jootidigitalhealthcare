<?php

namespace PHPMaker2023\jootidigitalhealthcare;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class JdhPatientsAdd extends JdhPatients
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Page object name
    public $PageObjName = "JdhPatientsAdd";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // CSS class/style
    public $CurrentPageName = "jdhpatientsadd";

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
        $this->TableVar = 'jdh_patients';
        $this->TableName = 'jdh_patients';

        // Table CSS class
        $this->TableClass = "table table-striped table-bordered table-hover table-sm ew-desktop-table ew-add-table";

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("language");

        // Table object (jdh_patients)
        if (!isset($GLOBALS["jdh_patients"]) || get_class($GLOBALS["jdh_patients"]) == PROJECT_NAMESPACE . "jdh_patients") {
            $GLOBALS["jdh_patients"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'jdh_patients');
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
                    $result["view"] = $pageName == "jdhpatientsview"; // If View page, no primary button
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
            $key .= @$ar['patient_id'];
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
            $this->patient_id->Visible = false;
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

        // Create form object
        $CurrentForm = new HttpForm();
        $this->CurrentAction = Param("action"); // Set up current action
        $this->patient_id->Visible = false;
        $this->photo->setVisibility();
        $this->patient_national_id->setVisibility();
        $this->patient_first_name->setVisibility();
        $this->patient_last_name->setVisibility();
        $this->patient_dob->setVisibility();
        $this->patient_gender->setVisibility();
        $this->patient_phone->setVisibility();
        $this->patient_kin_name->setVisibility();
        $this->patient_kin_phone->setVisibility();
        $this->patient_registration_date->Visible = false;

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
        $this->setupLookupOptions($this->patient_gender);

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
            if (($keyValue = Get("patient_id") ?? Route("patient_id")) !== null) {
                $this->patient_id->setQueryStringValue($keyValue);
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

        // Load form values
        if ($postBack) {
            $this->loadFormValues(); // Load form values
        }

        // Set up detail parameters
        $this->setupDetailParms();

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
                    $this->terminate("jdhpatientslist"); // No matching record, return to list
                    return;
                }

                // Set up detail parameters
                $this->setupDetailParms();
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
                    if ($this->getCurrentDetailTable() != "") { // Master/detail add
                        $returnUrl = $this->getDetailUrl();
                    } else {
                        $returnUrl = $this->getReturnUrl();
                    }
                    if (GetPageName($returnUrl) == "jdhpatientslist") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "jdhpatientsview") {
                        $returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
                    }

                    // Handle UseAjaxActions with return page
                    if ($this->UseAjaxActions && GetPageName($returnUrl) != "jdhpatientslist") {
                        Container("flash")->addMessage("Return-Url", $returnUrl); // Save return URL
                        $returnUrl = "jdhpatientslist"; // Return list page content
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

                    // Set up detail parameters
                    $this->setupDetailParms();
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
        $this->photo->Upload->Index = $CurrentForm->Index;
        $this->photo->Upload->uploadFile();
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

        // Check field name 'patient_national_id' first before field var 'x_patient_national_id'
        $val = $CurrentForm->hasValue("patient_national_id") ? $CurrentForm->getValue("patient_national_id") : $CurrentForm->getValue("x_patient_national_id");
        if (!$this->patient_national_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->patient_national_id->Visible = false; // Disable update for API request
            } else {
                $this->patient_national_id->setFormValue($val);
            }
        }

        // Check field name 'patient_first_name' first before field var 'x_patient_first_name'
        $val = $CurrentForm->hasValue("patient_first_name") ? $CurrentForm->getValue("patient_first_name") : $CurrentForm->getValue("x_patient_first_name");
        if (!$this->patient_first_name->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->patient_first_name->Visible = false; // Disable update for API request
            } else {
                $this->patient_first_name->setFormValue($val);
            }
        }

        // Check field name 'patient_last_name' first before field var 'x_patient_last_name'
        $val = $CurrentForm->hasValue("patient_last_name") ? $CurrentForm->getValue("patient_last_name") : $CurrentForm->getValue("x_patient_last_name");
        if (!$this->patient_last_name->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->patient_last_name->Visible = false; // Disable update for API request
            } else {
                $this->patient_last_name->setFormValue($val);
            }
        }

        // Check field name 'patient_dob' first before field var 'x_patient_dob'
        $val = $CurrentForm->hasValue("patient_dob") ? $CurrentForm->getValue("patient_dob") : $CurrentForm->getValue("x_patient_dob");
        if (!$this->patient_dob->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->patient_dob->Visible = false; // Disable update for API request
            } else {
                $this->patient_dob->setFormValue($val, true, $validate);
            }
            $this->patient_dob->CurrentValue = UnFormatDateTime($this->patient_dob->CurrentValue, $this->patient_dob->formatPattern());
        }

        // Check field name 'patient_gender' first before field var 'x_patient_gender'
        $val = $CurrentForm->hasValue("patient_gender") ? $CurrentForm->getValue("patient_gender") : $CurrentForm->getValue("x_patient_gender");
        if (!$this->patient_gender->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->patient_gender->Visible = false; // Disable update for API request
            } else {
                $this->patient_gender->setFormValue($val);
            }
        }

        // Check field name 'patient_phone' first before field var 'x_patient_phone'
        $val = $CurrentForm->hasValue("patient_phone") ? $CurrentForm->getValue("patient_phone") : $CurrentForm->getValue("x_patient_phone");
        if (!$this->patient_phone->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->patient_phone->Visible = false; // Disable update for API request
            } else {
                $this->patient_phone->setFormValue($val);
            }
        }

        // Check field name 'patient_kin_name' first before field var 'x_patient_kin_name'
        $val = $CurrentForm->hasValue("patient_kin_name") ? $CurrentForm->getValue("patient_kin_name") : $CurrentForm->getValue("x_patient_kin_name");
        if (!$this->patient_kin_name->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->patient_kin_name->Visible = false; // Disable update for API request
            } else {
                $this->patient_kin_name->setFormValue($val);
            }
        }

        // Check field name 'patient_kin_phone' first before field var 'x_patient_kin_phone'
        $val = $CurrentForm->hasValue("patient_kin_phone") ? $CurrentForm->getValue("patient_kin_phone") : $CurrentForm->getValue("x_patient_kin_phone");
        if (!$this->patient_kin_phone->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->patient_kin_phone->Visible = false; // Disable update for API request
            } else {
                $this->patient_kin_phone->setFormValue($val);
            }
        }

        // Check field name 'patient_id' first before field var 'x_patient_id'
        $val = $CurrentForm->hasValue("patient_id") ? $CurrentForm->getValue("patient_id") : $CurrentForm->getValue("x_patient_id");
        $this->getUploadFiles(); // Get upload files
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->patient_national_id->CurrentValue = $this->patient_national_id->FormValue;
        $this->patient_first_name->CurrentValue = $this->patient_first_name->FormValue;
        $this->patient_last_name->CurrentValue = $this->patient_last_name->FormValue;
        $this->patient_dob->CurrentValue = $this->patient_dob->FormValue;
        $this->patient_dob->CurrentValue = UnFormatDateTime($this->patient_dob->CurrentValue, $this->patient_dob->formatPattern());
        $this->patient_gender->CurrentValue = $this->patient_gender->FormValue;
        $this->patient_phone->CurrentValue = $this->patient_phone->FormValue;
        $this->patient_kin_name->CurrentValue = $this->patient_kin_name->FormValue;
        $this->patient_kin_phone->CurrentValue = $this->patient_kin_phone->FormValue;
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
        $this->patient_id->setDbValue($row['patient_id']);
        $this->photo->Upload->DbValue = $row['photo'];
        if (is_resource($this->photo->Upload->DbValue) && get_resource_type($this->photo->Upload->DbValue) == "stream") { // Byte array
            $this->photo->Upload->DbValue = stream_get_contents($this->photo->Upload->DbValue);
        }
        $this->patient_national_id->setDbValue($row['patient_national_id']);
        $this->patient_first_name->setDbValue($row['patient_first_name']);
        $this->patient_last_name->setDbValue($row['patient_last_name']);
        $this->patient_dob->setDbValue($row['patient_dob']);
        $this->patient_gender->setDbValue($row['patient_gender']);
        $this->patient_phone->setDbValue($row['patient_phone']);
        $this->patient_kin_name->setDbValue($row['patient_kin_name']);
        $this->patient_kin_phone->setDbValue($row['patient_kin_phone']);
        $this->patient_registration_date->setDbValue($row['patient_registration_date']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['patient_id'] = $this->patient_id->DefaultValue;
        $row['photo'] = $this->photo->DefaultValue;
        $row['patient_national_id'] = $this->patient_national_id->DefaultValue;
        $row['patient_first_name'] = $this->patient_first_name->DefaultValue;
        $row['patient_last_name'] = $this->patient_last_name->DefaultValue;
        $row['patient_dob'] = $this->patient_dob->DefaultValue;
        $row['patient_gender'] = $this->patient_gender->DefaultValue;
        $row['patient_phone'] = $this->patient_phone->DefaultValue;
        $row['patient_kin_name'] = $this->patient_kin_name->DefaultValue;
        $row['patient_kin_phone'] = $this->patient_kin_phone->DefaultValue;
        $row['patient_registration_date'] = $this->patient_registration_date->DefaultValue;
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

        // patient_id
        $this->patient_id->RowCssClass = "row";

        // photo
        $this->photo->RowCssClass = "row";

        // patient_national_id
        $this->patient_national_id->RowCssClass = "row";

        // patient_first_name
        $this->patient_first_name->RowCssClass = "row";

        // patient_last_name
        $this->patient_last_name->RowCssClass = "row";

        // patient_dob
        $this->patient_dob->RowCssClass = "row";

        // patient_gender
        $this->patient_gender->RowCssClass = "row";

        // patient_phone
        $this->patient_phone->RowCssClass = "row";

        // patient_kin_name
        $this->patient_kin_name->RowCssClass = "row";

        // patient_kin_phone
        $this->patient_kin_phone->RowCssClass = "row";

        // patient_registration_date
        $this->patient_registration_date->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // patient_id
            $this->patient_id->ViewValue = $this->patient_id->CurrentValue;

            // photo
            if (!EmptyValue($this->photo->Upload->DbValue)) {
                $this->photo->ImageWidth = 150;
                $this->photo->ImageHeight = 150;
                $this->photo->ImageAlt = $this->photo->alt();
                $this->photo->ImageCssClass = "ew-image";
                $this->photo->ViewValue = $this->patient_id->CurrentValue;
                $this->photo->IsBlobImage = IsImageFile(ContentExtension($this->photo->Upload->DbValue));
            } else {
                $this->photo->ViewValue = "";
            }

            // patient_national_id
            $this->patient_national_id->ViewValue = $this->patient_national_id->CurrentValue;

            // patient_first_name
            $this->patient_first_name->ViewValue = $this->patient_first_name->CurrentValue;

            // patient_last_name
            $this->patient_last_name->ViewValue = $this->patient_last_name->CurrentValue;

            // patient_dob
            $this->patient_dob->ViewValue = $this->patient_dob->CurrentValue;
            $this->patient_dob->ViewValue = FormatDateTime($this->patient_dob->ViewValue, $this->patient_dob->formatPattern());

            // patient_gender
            if (strval($this->patient_gender->CurrentValue) != "") {
                $this->patient_gender->ViewValue = $this->patient_gender->optionCaption($this->patient_gender->CurrentValue);
            } else {
                $this->patient_gender->ViewValue = null;
            }

            // patient_phone
            $this->patient_phone->ViewValue = $this->patient_phone->CurrentValue;

            // patient_kin_name
            $this->patient_kin_name->ViewValue = $this->patient_kin_name->CurrentValue;

            // patient_kin_phone
            $this->patient_kin_phone->ViewValue = $this->patient_kin_phone->CurrentValue;

            // patient_registration_date
            $this->patient_registration_date->ViewValue = $this->patient_registration_date->CurrentValue;
            $this->patient_registration_date->ViewValue = FormatDateTime($this->patient_registration_date->ViewValue, $this->patient_registration_date->formatPattern());

            // photo
            if (!empty($this->photo->Upload->DbValue)) {
                $this->photo->HrefValue = GetFileUploadUrl($this->photo, $this->patient_id->CurrentValue);
                $this->photo->LinkAttrs["target"] = "";
                if ($this->photo->IsBlobImage && empty($this->photo->LinkAttrs["target"])) {
                    $this->photo->LinkAttrs["target"] = "_blank";
                }
                if ($this->isExport()) {
                    $this->photo->HrefValue = FullUrl($this->photo->HrefValue, "href");
                }
            } else {
                $this->photo->HrefValue = "";
            }
            $this->photo->ExportHrefValue = GetFileUploadUrl($this->photo, $this->patient_id->CurrentValue);

            // patient_national_id
            $this->patient_national_id->HrefValue = "";

            // patient_first_name
            $this->patient_first_name->HrefValue = "";

            // patient_last_name
            $this->patient_last_name->HrefValue = "";

            // patient_dob
            $this->patient_dob->HrefValue = "";

            // patient_gender
            $this->patient_gender->HrefValue = "";

            // patient_phone
            $this->patient_phone->HrefValue = "";

            // patient_kin_name
            $this->patient_kin_name->HrefValue = "";

            // patient_kin_phone
            $this->patient_kin_phone->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // photo
            $this->photo->setupEditAttributes();
            if (!EmptyValue($this->photo->Upload->DbValue)) {
                $this->photo->ImageWidth = 150;
                $this->photo->ImageHeight = 150;
                $this->photo->ImageAlt = $this->photo->alt();
                $this->photo->ImageCssClass = "ew-image";
                $this->photo->EditValue = $this->patient_id->CurrentValue;
                $this->photo->IsBlobImage = IsImageFile(ContentExtension($this->photo->Upload->DbValue));
            } else {
                $this->photo->EditValue = "";
            }
            if ($this->isShow() || $this->isCopy()) {
                RenderUploadField($this->photo);
            }

            // patient_national_id
            $this->patient_national_id->setupEditAttributes();
            if (!$this->patient_national_id->Raw) {
                $this->patient_national_id->CurrentValue = HtmlDecode($this->patient_national_id->CurrentValue);
            }
            $this->patient_national_id->EditValue = HtmlEncode($this->patient_national_id->CurrentValue);
            $this->patient_national_id->PlaceHolder = RemoveHtml($this->patient_national_id->caption());

            // patient_first_name
            $this->patient_first_name->setupEditAttributes();
            if (!$this->patient_first_name->Raw) {
                $this->patient_first_name->CurrentValue = HtmlDecode($this->patient_first_name->CurrentValue);
            }
            $this->patient_first_name->EditValue = HtmlEncode($this->patient_first_name->CurrentValue);
            $this->patient_first_name->PlaceHolder = RemoveHtml($this->patient_first_name->caption());

            // patient_last_name
            $this->patient_last_name->setupEditAttributes();
            if (!$this->patient_last_name->Raw) {
                $this->patient_last_name->CurrentValue = HtmlDecode($this->patient_last_name->CurrentValue);
            }
            $this->patient_last_name->EditValue = HtmlEncode($this->patient_last_name->CurrentValue);
            $this->patient_last_name->PlaceHolder = RemoveHtml($this->patient_last_name->caption());

            // patient_dob
            $this->patient_dob->setupEditAttributes();
            $this->patient_dob->EditValue = HtmlEncode(FormatDateTime($this->patient_dob->CurrentValue, $this->patient_dob->formatPattern()));
            $this->patient_dob->PlaceHolder = RemoveHtml($this->patient_dob->caption());

            // patient_gender
            $this->patient_gender->setupEditAttributes();
            $this->patient_gender->EditValue = $this->patient_gender->options(true);
            $this->patient_gender->PlaceHolder = RemoveHtml($this->patient_gender->caption());

            // patient_phone
            $this->patient_phone->setupEditAttributes();
            if (!$this->patient_phone->Raw) {
                $this->patient_phone->CurrentValue = HtmlDecode($this->patient_phone->CurrentValue);
            }
            $this->patient_phone->EditValue = HtmlEncode($this->patient_phone->CurrentValue);
            $this->patient_phone->PlaceHolder = RemoveHtml($this->patient_phone->caption());

            // patient_kin_name
            $this->patient_kin_name->setupEditAttributes();
            if (!$this->patient_kin_name->Raw) {
                $this->patient_kin_name->CurrentValue = HtmlDecode($this->patient_kin_name->CurrentValue);
            }
            $this->patient_kin_name->EditValue = HtmlEncode($this->patient_kin_name->CurrentValue);
            $this->patient_kin_name->PlaceHolder = RemoveHtml($this->patient_kin_name->caption());

            // patient_kin_phone
            $this->patient_kin_phone->setupEditAttributes();
            if (!$this->patient_kin_phone->Raw) {
                $this->patient_kin_phone->CurrentValue = HtmlDecode($this->patient_kin_phone->CurrentValue);
            }
            $this->patient_kin_phone->EditValue = HtmlEncode($this->patient_kin_phone->CurrentValue);
            $this->patient_kin_phone->PlaceHolder = RemoveHtml($this->patient_kin_phone->caption());

            // Add refer script

            // photo
            if (!empty($this->photo->Upload->DbValue)) {
                $this->photo->HrefValue = GetFileUploadUrl($this->photo, $this->patient_id->CurrentValue);
                $this->photo->LinkAttrs["target"] = "";
                if ($this->photo->IsBlobImage && empty($this->photo->LinkAttrs["target"])) {
                    $this->photo->LinkAttrs["target"] = "_blank";
                }
                if ($this->isExport()) {
                    $this->photo->HrefValue = FullUrl($this->photo->HrefValue, "href");
                }
            } else {
                $this->photo->HrefValue = "";
            }
            $this->photo->ExportHrefValue = GetFileUploadUrl($this->photo, $this->patient_id->CurrentValue);

            // patient_national_id
            $this->patient_national_id->HrefValue = "";

            // patient_first_name
            $this->patient_first_name->HrefValue = "";

            // patient_last_name
            $this->patient_last_name->HrefValue = "";

            // patient_dob
            $this->patient_dob->HrefValue = "";

            // patient_gender
            $this->patient_gender->HrefValue = "";

            // patient_phone
            $this->patient_phone->HrefValue = "";

            // patient_kin_name
            $this->patient_kin_name->HrefValue = "";

            // patient_kin_phone
            $this->patient_kin_phone->HrefValue = "";
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
        if ($this->photo->Required) {
            if ($this->photo->Upload->FileName == "" && !$this->photo->Upload->KeepFile) {
                $this->photo->addErrorMessage(str_replace("%s", $this->photo->caption(), $this->photo->RequiredErrorMessage));
            }
        }
        if ($this->patient_national_id->Required) {
            if (!$this->patient_national_id->IsDetailKey && EmptyValue($this->patient_national_id->FormValue)) {
                $this->patient_national_id->addErrorMessage(str_replace("%s", $this->patient_national_id->caption(), $this->patient_national_id->RequiredErrorMessage));
            }
        }
        if ($this->patient_first_name->Required) {
            if (!$this->patient_first_name->IsDetailKey && EmptyValue($this->patient_first_name->FormValue)) {
                $this->patient_first_name->addErrorMessage(str_replace("%s", $this->patient_first_name->caption(), $this->patient_first_name->RequiredErrorMessage));
            }
        }
        if ($this->patient_last_name->Required) {
            if (!$this->patient_last_name->IsDetailKey && EmptyValue($this->patient_last_name->FormValue)) {
                $this->patient_last_name->addErrorMessage(str_replace("%s", $this->patient_last_name->caption(), $this->patient_last_name->RequiredErrorMessage));
            }
        }
        if ($this->patient_dob->Required) {
            if (!$this->patient_dob->IsDetailKey && EmptyValue($this->patient_dob->FormValue)) {
                $this->patient_dob->addErrorMessage(str_replace("%s", $this->patient_dob->caption(), $this->patient_dob->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->patient_dob->FormValue, $this->patient_dob->formatPattern())) {
            $this->patient_dob->addErrorMessage($this->patient_dob->getErrorMessage(false));
        }
        if ($this->patient_gender->Required) {
            if (!$this->patient_gender->IsDetailKey && EmptyValue($this->patient_gender->FormValue)) {
                $this->patient_gender->addErrorMessage(str_replace("%s", $this->patient_gender->caption(), $this->patient_gender->RequiredErrorMessage));
            }
        }
        if ($this->patient_phone->Required) {
            if (!$this->patient_phone->IsDetailKey && EmptyValue($this->patient_phone->FormValue)) {
                $this->patient_phone->addErrorMessage(str_replace("%s", $this->patient_phone->caption(), $this->patient_phone->RequiredErrorMessage));
            }
        }
        if ($this->patient_kin_name->Required) {
            if (!$this->patient_kin_name->IsDetailKey && EmptyValue($this->patient_kin_name->FormValue)) {
                $this->patient_kin_name->addErrorMessage(str_replace("%s", $this->patient_kin_name->caption(), $this->patient_kin_name->RequiredErrorMessage));
            }
        }
        if ($this->patient_kin_phone->Required) {
            if (!$this->patient_kin_phone->IsDetailKey && EmptyValue($this->patient_kin_phone->FormValue)) {
                $this->patient_kin_phone->addErrorMessage(str_replace("%s", $this->patient_kin_phone->caption(), $this->patient_kin_phone->RequiredErrorMessage));
            }
        }

        // Validate detail grid
        $detailTblVar = explode(",", $this->getCurrentDetailTable() ?? "");
        $detailPage = Container("JdhAppointmentsGrid");
        if (in_array("jdh_appointments", $detailTblVar) && $detailPage->DetailAdd) {
            $validateForm = $validateForm && $detailPage->validateGridForm();
        }
        $detailPage = Container("JdhPatientCasesGrid");
        if (in_array("jdh_patient_cases", $detailTblVar) && $detailPage->DetailAdd) {
            $validateForm = $validateForm && $detailPage->validateGridForm();
        }
        $detailPage = Container("JdhVitalsGrid");
        if (in_array("jdh_vitals", $detailTblVar) && $detailPage->DetailAdd) {
            $validateForm = $validateForm && $detailPage->validateGridForm();
        }
        $detailPage = Container("JdhTestRequestsGrid");
        if (in_array("jdh_test_requests", $detailTblVar) && $detailPage->DetailAdd) {
            $validateForm = $validateForm && $detailPage->validateGridForm();
        }
        $detailPage = Container("JdhPatientVisitsGrid");
        if (in_array("jdh_patient_visits", $detailTblVar) && $detailPage->DetailAdd) {
            $validateForm = $validateForm && $detailPage->validateGridForm();
        }
        $detailPage = Container("JdhChiefComplaintsGrid");
        if (in_array("jdh_chief_complaints", $detailTblVar) && $detailPage->DetailAdd) {
            $validateForm = $validateForm && $detailPage->validateGridForm();
        }
        $detailPage = Container("JdhExaminationFindingsGrid");
        if (in_array("jdh_examination_findings", $detailTblVar) && $detailPage->DetailAdd) {
            $validateForm = $validateForm && $detailPage->validateGridForm();
        }
        $detailPage = Container("JdhTestReportsGrid");
        if (in_array("jdh_test_reports", $detailTblVar) && $detailPage->DetailAdd) {
            $validateForm = $validateForm && $detailPage->validateGridForm();
        }
        $detailPage = Container("JdhPrescriptionsGrid");
        if (in_array("jdh_prescriptions", $detailTblVar) && $detailPage->DetailAdd) {
            $validateForm = $validateForm && $detailPage->validateGridForm();
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

        // photo
        if ($this->photo->Visible && !$this->photo->Upload->KeepFile) {
            if ($this->photo->Upload->Value === null) {
                $rsnew['photo'] = null;
            } else {
                $rsnew['photo'] = $this->photo->Upload->Value;
            }
        }

        // patient_national_id
        $this->patient_national_id->setDbValueDef($rsnew, $this->patient_national_id->CurrentValue, null, false);

        // patient_first_name
        $this->patient_first_name->setDbValueDef($rsnew, $this->patient_first_name->CurrentValue, "", false);

        // patient_last_name
        $this->patient_last_name->setDbValueDef($rsnew, $this->patient_last_name->CurrentValue, "", false);

        // patient_dob
        $this->patient_dob->setDbValueDef($rsnew, UnFormatDateTime($this->patient_dob->CurrentValue, $this->patient_dob->formatPattern()), CurrentDate(), false);

        // patient_gender
        $this->patient_gender->setDbValueDef($rsnew, $this->patient_gender->CurrentValue, "", false);

        // patient_phone
        $this->patient_phone->setDbValueDef($rsnew, $this->patient_phone->CurrentValue, "", false);

        // patient_kin_name
        $this->patient_kin_name->setDbValueDef($rsnew, $this->patient_kin_name->CurrentValue, null, false);

        // patient_kin_phone
        $this->patient_kin_phone->setDbValueDef($rsnew, $this->patient_kin_phone->CurrentValue, null, false);

        // Update current values
        $this->setCurrentValues($rsnew);
        $conn = $this->getConnection();

        // Begin transaction
        if ($this->getCurrentDetailTable() != "" && $this->UseTransaction) {
            $conn->beginTransaction();
        }

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

        // Add detail records
        if ($addRow) {
            $detailTblVar = explode(",", $this->getCurrentDetailTable() ?? "");
            $detailPage = Container("JdhAppointmentsGrid");
            if (in_array("jdh_appointments", $detailTblVar) && $detailPage->DetailAdd) {
                $detailPage->patient_id->setSessionValue($this->patient_id->CurrentValue); // Set master key
                $Security->loadCurrentUserLevel($this->ProjectID . "jdh_appointments"); // Load user level of detail table
                $addRow = $detailPage->gridInsert();
                $Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
                if (!$addRow) {
                $detailPage->patient_id->setSessionValue(""); // Clear master key if insert failed
                }
            }
            $detailPage = Container("JdhPatientCasesGrid");
            if (in_array("jdh_patient_cases", $detailTblVar) && $detailPage->DetailAdd) {
                $detailPage->patient_id->setSessionValue($this->patient_id->CurrentValue); // Set master key
                $Security->loadCurrentUserLevel($this->ProjectID . "jdh_patient_cases"); // Load user level of detail table
                $addRow = $detailPage->gridInsert();
                $Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
                if (!$addRow) {
                $detailPage->patient_id->setSessionValue(""); // Clear master key if insert failed
                }
            }
            $detailPage = Container("JdhVitalsGrid");
            if (in_array("jdh_vitals", $detailTblVar) && $detailPage->DetailAdd) {
                $detailPage->patient_id->setSessionValue($this->patient_id->CurrentValue); // Set master key
                $Security->loadCurrentUserLevel($this->ProjectID . "jdh_vitals"); // Load user level of detail table
                $addRow = $detailPage->gridInsert();
                $Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
                if (!$addRow) {
                $detailPage->patient_id->setSessionValue(""); // Clear master key if insert failed
                }
            }
            $detailPage = Container("JdhTestRequestsGrid");
            if (in_array("jdh_test_requests", $detailTblVar) && $detailPage->DetailAdd) {
                $detailPage->patient_id->setSessionValue($this->patient_id->CurrentValue); // Set master key
                $Security->loadCurrentUserLevel($this->ProjectID . "jdh_test_requests"); // Load user level of detail table
                $addRow = $detailPage->gridInsert();
                $Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
                if (!$addRow) {
                $detailPage->patient_id->setSessionValue(""); // Clear master key if insert failed
                }
            }
            $detailPage = Container("JdhPatientVisitsGrid");
            if (in_array("jdh_patient_visits", $detailTblVar) && $detailPage->DetailAdd) {
                $detailPage->patient_id->setSessionValue($this->patient_id->CurrentValue); // Set master key
                $Security->loadCurrentUserLevel($this->ProjectID . "jdh_patient_visits"); // Load user level of detail table
                $addRow = $detailPage->gridInsert();
                $Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
                if (!$addRow) {
                $detailPage->patient_id->setSessionValue(""); // Clear master key if insert failed
                }
            }
            $detailPage = Container("JdhChiefComplaintsGrid");
            if (in_array("jdh_chief_complaints", $detailTblVar) && $detailPage->DetailAdd) {
                $detailPage->patient_id->setSessionValue($this->patient_id->CurrentValue); // Set master key
                $Security->loadCurrentUserLevel($this->ProjectID . "jdh_chief_complaints"); // Load user level of detail table
                $addRow = $detailPage->gridInsert();
                $Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
                if (!$addRow) {
                $detailPage->patient_id->setSessionValue(""); // Clear master key if insert failed
                }
            }
            $detailPage = Container("JdhExaminationFindingsGrid");
            if (in_array("jdh_examination_findings", $detailTblVar) && $detailPage->DetailAdd) {
                $detailPage->patient_id->setSessionValue($this->patient_id->CurrentValue); // Set master key
                $Security->loadCurrentUserLevel($this->ProjectID . "jdh_examination_findings"); // Load user level of detail table
                $addRow = $detailPage->gridInsert();
                $Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
                if (!$addRow) {
                $detailPage->patient_id->setSessionValue(""); // Clear master key if insert failed
                }
            }
            $detailPage = Container("JdhTestReportsGrid");
            if (in_array("jdh_test_reports", $detailTblVar) && $detailPage->DetailAdd) {
                $detailPage->patient_id->setSessionValue($this->patient_id->CurrentValue); // Set master key
                $Security->loadCurrentUserLevel($this->ProjectID . "jdh_test_reports"); // Load user level of detail table
                $addRow = $detailPage->gridInsert();
                $Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
                if (!$addRow) {
                $detailPage->patient_id->setSessionValue(""); // Clear master key if insert failed
                }
            }
            $detailPage = Container("JdhPrescriptionsGrid");
            if (in_array("jdh_prescriptions", $detailTblVar) && $detailPage->DetailAdd) {
                $detailPage->patient_id->setSessionValue($this->patient_id->CurrentValue); // Set master key
                $Security->loadCurrentUserLevel($this->ProjectID . "jdh_prescriptions"); // Load user level of detail table
                $addRow = $detailPage->gridInsert();
                $Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
                if (!$addRow) {
                $detailPage->patient_id->setSessionValue(""); // Clear master key if insert failed
                }
            }
        }

        // Commit/Rollback transaction
        if ($this->getCurrentDetailTable() != "") {
            if ($addRow) {
                if ($this->UseTransaction) { // Commit transaction
                    $conn->commit();
                }
            } else {
                if ($this->UseTransaction) { // Rollback transaction
                    $conn->rollback();
                }
            }
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

    // Set up detail parms based on QueryString
    protected function setupDetailParms()
    {
        // Get the keys for master table
        $detailTblVar = Get(Config("TABLE_SHOW_DETAIL"));
        if ($detailTblVar !== null) {
            $this->setCurrentDetailTable($detailTblVar);
        } else {
            $detailTblVar = $this->getCurrentDetailTable();
        }
        if ($detailTblVar != "") {
            $detailTblVar = explode(",", $detailTblVar);
            if (in_array("jdh_appointments", $detailTblVar)) {
                $detailPageObj = Container("JdhAppointmentsGrid");
                if ($detailPageObj->DetailAdd) {
                    $detailPageObj->EventCancelled = $this->EventCancelled;
                    if ($this->CopyRecord) {
                        $detailPageObj->CurrentMode = "copy";
                    } else {
                        $detailPageObj->CurrentMode = "add";
                    }
                    $detailPageObj->CurrentAction = "gridadd";

                    // Save current master table to detail table
                    $detailPageObj->setCurrentMasterTable($this->TableVar);
                    $detailPageObj->setStartRecordNumber(1);
                    $detailPageObj->patient_id->IsDetailKey = true;
                    $detailPageObj->patient_id->CurrentValue = $this->patient_id->CurrentValue;
                    $detailPageObj->patient_id->setSessionValue($detailPageObj->patient_id->CurrentValue);
                }
            }
            if (in_array("jdh_patient_cases", $detailTblVar)) {
                $detailPageObj = Container("JdhPatientCasesGrid");
                if ($detailPageObj->DetailAdd) {
                    $detailPageObj->EventCancelled = $this->EventCancelled;
                    if ($this->CopyRecord) {
                        $detailPageObj->CurrentMode = "copy";
                    } else {
                        $detailPageObj->CurrentMode = "add";
                    }
                    $detailPageObj->CurrentAction = "gridadd";

                    // Save current master table to detail table
                    $detailPageObj->setCurrentMasterTable($this->TableVar);
                    $detailPageObj->setStartRecordNumber(1);
                    $detailPageObj->patient_id->IsDetailKey = true;
                    $detailPageObj->patient_id->CurrentValue = $this->patient_id->CurrentValue;
                    $detailPageObj->patient_id->setSessionValue($detailPageObj->patient_id->CurrentValue);
                }
            }
            if (in_array("jdh_vitals", $detailTblVar)) {
                $detailPageObj = Container("JdhVitalsGrid");
                if ($detailPageObj->DetailAdd) {
                    $detailPageObj->EventCancelled = $this->EventCancelled;
                    if ($this->CopyRecord) {
                        $detailPageObj->CurrentMode = "copy";
                    } else {
                        $detailPageObj->CurrentMode = "add";
                    }
                    $detailPageObj->CurrentAction = "gridadd";

                    // Save current master table to detail table
                    $detailPageObj->setCurrentMasterTable($this->TableVar);
                    $detailPageObj->setStartRecordNumber(1);
                    $detailPageObj->patient_id->IsDetailKey = true;
                    $detailPageObj->patient_id->CurrentValue = $this->patient_id->CurrentValue;
                    $detailPageObj->patient_id->setSessionValue($detailPageObj->patient_id->CurrentValue);
                }
            }
            if (in_array("jdh_test_requests", $detailTblVar)) {
                $detailPageObj = Container("JdhTestRequestsGrid");
                if ($detailPageObj->DetailAdd) {
                    $detailPageObj->EventCancelled = $this->EventCancelled;
                    if ($this->CopyRecord) {
                        $detailPageObj->CurrentMode = "copy";
                    } else {
                        $detailPageObj->CurrentMode = "add";
                    }
                    $detailPageObj->CurrentAction = "gridadd";

                    // Save current master table to detail table
                    $detailPageObj->setCurrentMasterTable($this->TableVar);
                    $detailPageObj->setStartRecordNumber(1);
                    $detailPageObj->patient_id->IsDetailKey = true;
                    $detailPageObj->patient_id->CurrentValue = $this->patient_id->CurrentValue;
                    $detailPageObj->patient_id->setSessionValue($detailPageObj->patient_id->CurrentValue);
                }
            }
            if (in_array("jdh_patient_visits", $detailTblVar)) {
                $detailPageObj = Container("JdhPatientVisitsGrid");
                if ($detailPageObj->DetailAdd) {
                    $detailPageObj->EventCancelled = $this->EventCancelled;
                    if ($this->CopyRecord) {
                        $detailPageObj->CurrentMode = "copy";
                    } else {
                        $detailPageObj->CurrentMode = "add";
                    }
                    $detailPageObj->CurrentAction = "gridadd";

                    // Save current master table to detail table
                    $detailPageObj->setCurrentMasterTable($this->TableVar);
                    $detailPageObj->setStartRecordNumber(1);
                    $detailPageObj->patient_id->IsDetailKey = true;
                    $detailPageObj->patient_id->CurrentValue = $this->patient_id->CurrentValue;
                    $detailPageObj->patient_id->setSessionValue($detailPageObj->patient_id->CurrentValue);
                }
            }
            if (in_array("jdh_chief_complaints", $detailTblVar)) {
                $detailPageObj = Container("JdhChiefComplaintsGrid");
                if ($detailPageObj->DetailAdd) {
                    $detailPageObj->EventCancelled = $this->EventCancelled;
                    if ($this->CopyRecord) {
                        $detailPageObj->CurrentMode = "copy";
                    } else {
                        $detailPageObj->CurrentMode = "add";
                    }
                    $detailPageObj->CurrentAction = "gridadd";

                    // Save current master table to detail table
                    $detailPageObj->setCurrentMasterTable($this->TableVar);
                    $detailPageObj->setStartRecordNumber(1);
                    $detailPageObj->patient_id->IsDetailKey = true;
                    $detailPageObj->patient_id->CurrentValue = $this->patient_id->CurrentValue;
                    $detailPageObj->patient_id->setSessionValue($detailPageObj->patient_id->CurrentValue);
                }
            }
            if (in_array("jdh_examination_findings", $detailTblVar)) {
                $detailPageObj = Container("JdhExaminationFindingsGrid");
                if ($detailPageObj->DetailAdd) {
                    $detailPageObj->EventCancelled = $this->EventCancelled;
                    if ($this->CopyRecord) {
                        $detailPageObj->CurrentMode = "copy";
                    } else {
                        $detailPageObj->CurrentMode = "add";
                    }
                    $detailPageObj->CurrentAction = "gridadd";

                    // Save current master table to detail table
                    $detailPageObj->setCurrentMasterTable($this->TableVar);
                    $detailPageObj->setStartRecordNumber(1);
                    $detailPageObj->patient_id->IsDetailKey = true;
                    $detailPageObj->patient_id->CurrentValue = $this->patient_id->CurrentValue;
                    $detailPageObj->patient_id->setSessionValue($detailPageObj->patient_id->CurrentValue);
                }
            }
            if (in_array("jdh_test_reports", $detailTblVar)) {
                $detailPageObj = Container("JdhTestReportsGrid");
                if ($detailPageObj->DetailAdd) {
                    $detailPageObj->EventCancelled = $this->EventCancelled;
                    if ($this->CopyRecord) {
                        $detailPageObj->CurrentMode = "copy";
                    } else {
                        $detailPageObj->CurrentMode = "add";
                    }
                    $detailPageObj->CurrentAction = "gridadd";

                    // Save current master table to detail table
                    $detailPageObj->setCurrentMasterTable($this->TableVar);
                    $detailPageObj->setStartRecordNumber(1);
                    $detailPageObj->patient_id->IsDetailKey = true;
                    $detailPageObj->patient_id->CurrentValue = $this->patient_id->CurrentValue;
                    $detailPageObj->patient_id->setSessionValue($detailPageObj->patient_id->CurrentValue);
                    $detailPageObj->request_id->setSessionValue(""); // Clear session key
                }
            }
            if (in_array("jdh_prescriptions", $detailTblVar)) {
                $detailPageObj = Container("JdhPrescriptionsGrid");
                if ($detailPageObj->DetailAdd) {
                    $detailPageObj->EventCancelled = $this->EventCancelled;
                    if ($this->CopyRecord) {
                        $detailPageObj->CurrentMode = "copy";
                    } else {
                        $detailPageObj->CurrentMode = "add";
                    }
                    $detailPageObj->CurrentAction = "gridadd";

                    // Save current master table to detail table
                    $detailPageObj->setCurrentMasterTable($this->TableVar);
                    $detailPageObj->setStartRecordNumber(1);
                    $detailPageObj->patient_id->IsDetailKey = true;
                    $detailPageObj->patient_id->CurrentValue = $this->patient_id->CurrentValue;
                    $detailPageObj->patient_id->setSessionValue($detailPageObj->patient_id->CurrentValue);
                }
            }
        }
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("jdhpatientslist"), "", $this->TableVar, true);
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
                case "x_patient_gender":
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
