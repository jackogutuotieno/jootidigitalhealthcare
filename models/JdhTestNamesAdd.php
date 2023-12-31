<?php

namespace PHPMaker2023\jootidigitalhealthcare;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class JdhTestNamesAdd extends JdhTestNames
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Page object name
    public $PageObjName = "JdhTestNamesAdd";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // CSS class/style
    public $CurrentPageName = "jdhtestnamesadd";

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
        $this->TableVar = 'jdh_test_names';
        $this->TableName = 'jdh_test_names';

        // Table CSS class
        $this->TableClass = "table table-striped table-bordered table-hover table-sm ew-desktop-table ew-add-table";

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("language");

        // Table object (jdh_test_names)
        if (!isset($GLOBALS["jdh_test_names"]) || get_class($GLOBALS["jdh_test_names"]) == PROJECT_NAMESPACE . "jdh_test_names") {
            $GLOBALS["jdh_test_names"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'jdh_test_names');
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
                    $result["view"] = $pageName == "jdhtestnamesview"; // If View page, no primary button
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
            $key .= @$ar['test_id'];
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
            $this->test_id->Visible = false;
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
        $this->test_id->Visible = false;
        $this->patient_id->setVisibility();
        $this->test_name->setVisibility();
        $this->test_category_id->setVisibility();
        $this->test_subcategory_id->setVisibility();
        $this->test_cost->setVisibility();
        $this->date_submitted->setVisibility();
        $this->date_updated->setVisibility();
        $this->submitted_by_user_id->setVisibility();

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
        $this->setupLookupOptions($this->test_category_id);
        $this->setupLookupOptions($this->test_subcategory_id);

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
            if (($keyValue = Get("test_id") ?? Route("test_id")) !== null) {
                $this->test_id->setQueryStringValue($keyValue);
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
                    $this->terminate("jdhtestnameslist"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "jdhtestnameslist") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "jdhtestnamesview") {
                        $returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
                    }

                    // Handle UseAjaxActions with return page
                    if ($this->UseAjaxActions && GetPageName($returnUrl) != "jdhtestnameslist") {
                        Container("flash")->addMessage("Return-Url", $returnUrl); // Save return URL
                        $returnUrl = "jdhtestnameslist"; // Return list page content
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

        // Check field name 'test_name' first before field var 'x_test_name'
        $val = $CurrentForm->hasValue("test_name") ? $CurrentForm->getValue("test_name") : $CurrentForm->getValue("x_test_name");
        if (!$this->test_name->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->test_name->Visible = false; // Disable update for API request
            } else {
                $this->test_name->setFormValue($val);
            }
        }

        // Check field name 'test_category_id' first before field var 'x_test_category_id'
        $val = $CurrentForm->hasValue("test_category_id") ? $CurrentForm->getValue("test_category_id") : $CurrentForm->getValue("x_test_category_id");
        if (!$this->test_category_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->test_category_id->Visible = false; // Disable update for API request
            } else {
                $this->test_category_id->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'test_subcategory_id' first before field var 'x_test_subcategory_id'
        $val = $CurrentForm->hasValue("test_subcategory_id") ? $CurrentForm->getValue("test_subcategory_id") : $CurrentForm->getValue("x_test_subcategory_id");
        if (!$this->test_subcategory_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->test_subcategory_id->Visible = false; // Disable update for API request
            } else {
                $this->test_subcategory_id->setFormValue($val);
            }
        }

        // Check field name 'test_cost' first before field var 'x_test_cost'
        $val = $CurrentForm->hasValue("test_cost") ? $CurrentForm->getValue("test_cost") : $CurrentForm->getValue("x_test_cost");
        if (!$this->test_cost->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->test_cost->Visible = false; // Disable update for API request
            } else {
                $this->test_cost->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'date_submitted' first before field var 'x_date_submitted'
        $val = $CurrentForm->hasValue("date_submitted") ? $CurrentForm->getValue("date_submitted") : $CurrentForm->getValue("x_date_submitted");
        if (!$this->date_submitted->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->date_submitted->Visible = false; // Disable update for API request
            } else {
                $this->date_submitted->setFormValue($val, true, $validate);
            }
            $this->date_submitted->CurrentValue = UnFormatDateTime($this->date_submitted->CurrentValue, $this->date_submitted->formatPattern());
        }

        // Check field name 'date_updated' first before field var 'x_date_updated'
        $val = $CurrentForm->hasValue("date_updated") ? $CurrentForm->getValue("date_updated") : $CurrentForm->getValue("x_date_updated");
        if (!$this->date_updated->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->date_updated->Visible = false; // Disable update for API request
            } else {
                $this->date_updated->setFormValue($val, true, $validate);
            }
            $this->date_updated->CurrentValue = UnFormatDateTime($this->date_updated->CurrentValue, $this->date_updated->formatPattern());
        }

        // Check field name 'submitted_by_user_id' first before field var 'x_submitted_by_user_id'
        $val = $CurrentForm->hasValue("submitted_by_user_id") ? $CurrentForm->getValue("submitted_by_user_id") : $CurrentForm->getValue("x_submitted_by_user_id");
        if (!$this->submitted_by_user_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->submitted_by_user_id->Visible = false; // Disable update for API request
            } else {
                $this->submitted_by_user_id->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'test_id' first before field var 'x_test_id'
        $val = $CurrentForm->hasValue("test_id") ? $CurrentForm->getValue("test_id") : $CurrentForm->getValue("x_test_id");
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->patient_id->CurrentValue = $this->patient_id->FormValue;
        $this->test_name->CurrentValue = $this->test_name->FormValue;
        $this->test_category_id->CurrentValue = $this->test_category_id->FormValue;
        $this->test_subcategory_id->CurrentValue = $this->test_subcategory_id->FormValue;
        $this->test_cost->CurrentValue = $this->test_cost->FormValue;
        $this->date_submitted->CurrentValue = $this->date_submitted->FormValue;
        $this->date_submitted->CurrentValue = UnFormatDateTime($this->date_submitted->CurrentValue, $this->date_submitted->formatPattern());
        $this->date_updated->CurrentValue = $this->date_updated->FormValue;
        $this->date_updated->CurrentValue = UnFormatDateTime($this->date_updated->CurrentValue, $this->date_updated->formatPattern());
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
        $this->test_id->setDbValue($row['test_id']);
        $this->patient_id->setDbValue($row['patient_id']);
        $this->test_name->setDbValue($row['test_name']);
        $this->test_category_id->setDbValue($row['test_category_id']);
        $this->test_subcategory_id->setDbValue($row['test_subcategory_id']);
        $this->test_cost->setDbValue($row['test_cost']);
        $this->date_submitted->setDbValue($row['date_submitted']);
        $this->date_updated->setDbValue($row['date_updated']);
        $this->submitted_by_user_id->setDbValue($row['submitted_by_user_id']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['test_id'] = $this->test_id->DefaultValue;
        $row['patient_id'] = $this->patient_id->DefaultValue;
        $row['test_name'] = $this->test_name->DefaultValue;
        $row['test_category_id'] = $this->test_category_id->DefaultValue;
        $row['test_subcategory_id'] = $this->test_subcategory_id->DefaultValue;
        $row['test_cost'] = $this->test_cost->DefaultValue;
        $row['date_submitted'] = $this->date_submitted->DefaultValue;
        $row['date_updated'] = $this->date_updated->DefaultValue;
        $row['submitted_by_user_id'] = $this->submitted_by_user_id->DefaultValue;
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

        // test_id
        $this->test_id->RowCssClass = "row";

        // patient_id
        $this->patient_id->RowCssClass = "row";

        // test_name
        $this->test_name->RowCssClass = "row";

        // test_category_id
        $this->test_category_id->RowCssClass = "row";

        // test_subcategory_id
        $this->test_subcategory_id->RowCssClass = "row";

        // test_cost
        $this->test_cost->RowCssClass = "row";

        // date_submitted
        $this->date_submitted->RowCssClass = "row";

        // date_updated
        $this->date_updated->RowCssClass = "row";

        // submitted_by_user_id
        $this->submitted_by_user_id->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // test_id
            $this->test_id->ViewValue = $this->test_id->CurrentValue;

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

            // test_name
            $this->test_name->ViewValue = $this->test_name->CurrentValue;

            // test_category_id
            $this->test_category_id->ViewValue = $this->test_category_id->CurrentValue;
            $curVal = strval($this->test_category_id->CurrentValue);
            if ($curVal != "") {
                $this->test_category_id->ViewValue = $this->test_category_id->lookupCacheOption($curVal);
                if ($this->test_category_id->ViewValue === null) { // Lookup from database
                    $filterWrk = SearchFilter("`category_id`", "=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->test_category_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->test_category_id->Lookup->renderViewRow($rswrk[0]);
                        $this->test_category_id->ViewValue = $this->test_category_id->displayValue($arwrk);
                    } else {
                        $this->test_category_id->ViewValue = FormatNumber($this->test_category_id->CurrentValue, $this->test_category_id->formatPattern());
                    }
                }
            } else {
                $this->test_category_id->ViewValue = null;
            }

            // test_subcategory_id
            $curVal = strval($this->test_subcategory_id->CurrentValue);
            if ($curVal != "") {
                $this->test_subcategory_id->ViewValue = $this->test_subcategory_id->lookupCacheOption($curVal);
                if ($this->test_subcategory_id->ViewValue === null) { // Lookup from database
                    $filterWrk = SearchFilter("`test_subcategory_id`", "=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->test_subcategory_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->test_subcategory_id->Lookup->renderViewRow($rswrk[0]);
                        $this->test_subcategory_id->ViewValue = $this->test_subcategory_id->displayValue($arwrk);
                    } else {
                        $this->test_subcategory_id->ViewValue = FormatNumber($this->test_subcategory_id->CurrentValue, $this->test_subcategory_id->formatPattern());
                    }
                }
            } else {
                $this->test_subcategory_id->ViewValue = null;
            }

            // test_cost
            $this->test_cost->ViewValue = $this->test_cost->CurrentValue;
            $this->test_cost->ViewValue = FormatNumber($this->test_cost->ViewValue, $this->test_cost->formatPattern());

            // date_submitted
            $this->date_submitted->ViewValue = $this->date_submitted->CurrentValue;
            $this->date_submitted->ViewValue = FormatDateTime($this->date_submitted->ViewValue, $this->date_submitted->formatPattern());

            // date_updated
            $this->date_updated->ViewValue = $this->date_updated->CurrentValue;
            $this->date_updated->ViewValue = FormatDateTime($this->date_updated->ViewValue, $this->date_updated->formatPattern());

            // submitted_by_user_id
            $this->submitted_by_user_id->ViewValue = $this->submitted_by_user_id->CurrentValue;
            $this->submitted_by_user_id->ViewValue = FormatNumber($this->submitted_by_user_id->ViewValue, $this->submitted_by_user_id->formatPattern());

            // patient_id
            $this->patient_id->HrefValue = "";

            // test_name
            $this->test_name->HrefValue = "";

            // test_category_id
            $this->test_category_id->HrefValue = "";

            // test_subcategory_id
            $this->test_subcategory_id->HrefValue = "";

            // test_cost
            $this->test_cost->HrefValue = "";

            // date_submitted
            $this->date_submitted->HrefValue = "";

            // date_updated
            $this->date_updated->HrefValue = "";

            // submitted_by_user_id
            $this->submitted_by_user_id->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // patient_id
            $this->patient_id->setupEditAttributes();
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

            // test_name
            $this->test_name->setupEditAttributes();
            if (!$this->test_name->Raw) {
                $this->test_name->CurrentValue = HtmlDecode($this->test_name->CurrentValue);
            }
            $this->test_name->EditValue = HtmlEncode($this->test_name->CurrentValue);
            $this->test_name->PlaceHolder = RemoveHtml($this->test_name->caption());

            // test_category_id
            $this->test_category_id->setupEditAttributes();
            $this->test_category_id->EditValue = HtmlEncode($this->test_category_id->CurrentValue);
            $curVal = strval($this->test_category_id->CurrentValue);
            if ($curVal != "") {
                $this->test_category_id->EditValue = $this->test_category_id->lookupCacheOption($curVal);
                if ($this->test_category_id->EditValue === null) { // Lookup from database
                    $filterWrk = SearchFilter("`category_id`", "=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->test_category_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->test_category_id->Lookup->renderViewRow($rswrk[0]);
                        $this->test_category_id->EditValue = $this->test_category_id->displayValue($arwrk);
                    } else {
                        $this->test_category_id->EditValue = HtmlEncode(FormatNumber($this->test_category_id->CurrentValue, $this->test_category_id->formatPattern()));
                    }
                }
            } else {
                $this->test_category_id->EditValue = null;
            }
            $this->test_category_id->PlaceHolder = RemoveHtml($this->test_category_id->caption());

            // test_subcategory_id
            $this->test_subcategory_id->setupEditAttributes();
            $curVal = trim(strval($this->test_subcategory_id->CurrentValue));
            if ($curVal != "") {
                $this->test_subcategory_id->ViewValue = $this->test_subcategory_id->lookupCacheOption($curVal);
            } else {
                $this->test_subcategory_id->ViewValue = $this->test_subcategory_id->Lookup !== null && is_array($this->test_subcategory_id->lookupOptions()) ? $curVal : null;
            }
            if ($this->test_subcategory_id->ViewValue !== null) { // Load from cache
                $this->test_subcategory_id->EditValue = array_values($this->test_subcategory_id->lookupOptions());
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = SearchFilter("`test_subcategory_id`", "=", $this->test_subcategory_id->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->test_subcategory_id->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->test_subcategory_id->EditValue = $arwrk;
            }
            $this->test_subcategory_id->PlaceHolder = RemoveHtml($this->test_subcategory_id->caption());

            // test_cost
            $this->test_cost->setupEditAttributes();
            $this->test_cost->EditValue = HtmlEncode($this->test_cost->CurrentValue);
            $this->test_cost->PlaceHolder = RemoveHtml($this->test_cost->caption());
            if (strval($this->test_cost->EditValue) != "" && is_numeric($this->test_cost->EditValue)) {
                $this->test_cost->EditValue = FormatNumber($this->test_cost->EditValue, null);
            }

            // date_submitted
            $this->date_submitted->setupEditAttributes();
            $this->date_submitted->EditValue = HtmlEncode(FormatDateTime($this->date_submitted->CurrentValue, $this->date_submitted->formatPattern()));
            $this->date_submitted->PlaceHolder = RemoveHtml($this->date_submitted->caption());

            // date_updated
            $this->date_updated->setupEditAttributes();
            $this->date_updated->EditValue = HtmlEncode(FormatDateTime($this->date_updated->CurrentValue, $this->date_updated->formatPattern()));
            $this->date_updated->PlaceHolder = RemoveHtml($this->date_updated->caption());

            // submitted_by_user_id
            $this->submitted_by_user_id->setupEditAttributes();
            $this->submitted_by_user_id->EditValue = HtmlEncode($this->submitted_by_user_id->CurrentValue);
            $this->submitted_by_user_id->PlaceHolder = RemoveHtml($this->submitted_by_user_id->caption());
            if (strval($this->submitted_by_user_id->EditValue) != "" && is_numeric($this->submitted_by_user_id->EditValue)) {
                $this->submitted_by_user_id->EditValue = FormatNumber($this->submitted_by_user_id->EditValue, null);
            }

            // Add refer script

            // patient_id
            $this->patient_id->HrefValue = "";

            // test_name
            $this->test_name->HrefValue = "";

            // test_category_id
            $this->test_category_id->HrefValue = "";

            // test_subcategory_id
            $this->test_subcategory_id->HrefValue = "";

            // test_cost
            $this->test_cost->HrefValue = "";

            // date_submitted
            $this->date_submitted->HrefValue = "";

            // date_updated
            $this->date_updated->HrefValue = "";

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
        if ($this->test_name->Required) {
            if (!$this->test_name->IsDetailKey && EmptyValue($this->test_name->FormValue)) {
                $this->test_name->addErrorMessage(str_replace("%s", $this->test_name->caption(), $this->test_name->RequiredErrorMessage));
            }
        }
        if ($this->test_category_id->Required) {
            if (!$this->test_category_id->IsDetailKey && EmptyValue($this->test_category_id->FormValue)) {
                $this->test_category_id->addErrorMessage(str_replace("%s", $this->test_category_id->caption(), $this->test_category_id->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->test_category_id->FormValue)) {
            $this->test_category_id->addErrorMessage($this->test_category_id->getErrorMessage(false));
        }
        if ($this->test_subcategory_id->Required) {
            if (!$this->test_subcategory_id->IsDetailKey && EmptyValue($this->test_subcategory_id->FormValue)) {
                $this->test_subcategory_id->addErrorMessage(str_replace("%s", $this->test_subcategory_id->caption(), $this->test_subcategory_id->RequiredErrorMessage));
            }
        }
        if ($this->test_cost->Required) {
            if (!$this->test_cost->IsDetailKey && EmptyValue($this->test_cost->FormValue)) {
                $this->test_cost->addErrorMessage(str_replace("%s", $this->test_cost->caption(), $this->test_cost->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->test_cost->FormValue)) {
            $this->test_cost->addErrorMessage($this->test_cost->getErrorMessage(false));
        }
        if ($this->date_submitted->Required) {
            if (!$this->date_submitted->IsDetailKey && EmptyValue($this->date_submitted->FormValue)) {
                $this->date_submitted->addErrorMessage(str_replace("%s", $this->date_submitted->caption(), $this->date_submitted->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->date_submitted->FormValue, $this->date_submitted->formatPattern())) {
            $this->date_submitted->addErrorMessage($this->date_submitted->getErrorMessage(false));
        }
        if ($this->date_updated->Required) {
            if (!$this->date_updated->IsDetailKey && EmptyValue($this->date_updated->FormValue)) {
                $this->date_updated->addErrorMessage(str_replace("%s", $this->date_updated->caption(), $this->date_updated->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->date_updated->FormValue, $this->date_updated->formatPattern())) {
            $this->date_updated->addErrorMessage($this->date_updated->getErrorMessage(false));
        }
        if ($this->submitted_by_user_id->Required) {
            if (!$this->submitted_by_user_id->IsDetailKey && EmptyValue($this->submitted_by_user_id->FormValue)) {
                $this->submitted_by_user_id->addErrorMessage(str_replace("%s", $this->submitted_by_user_id->caption(), $this->submitted_by_user_id->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->submitted_by_user_id->FormValue)) {
            $this->submitted_by_user_id->addErrorMessage($this->submitted_by_user_id->getErrorMessage(false));
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
        $this->patient_id->setDbValueDef($rsnew, $this->patient_id->CurrentValue, 0, false);

        // test_name
        $this->test_name->setDbValueDef($rsnew, $this->test_name->CurrentValue, "", false);

        // test_category_id
        $this->test_category_id->setDbValueDef($rsnew, $this->test_category_id->CurrentValue, 0, false);

        // test_subcategory_id
        $this->test_subcategory_id->setDbValueDef($rsnew, $this->test_subcategory_id->CurrentValue, 0, false);

        // test_cost
        $this->test_cost->setDbValueDef($rsnew, $this->test_cost->CurrentValue, 0, false);

        // date_submitted
        $this->date_submitted->setDbValueDef($rsnew, UnFormatDateTime($this->date_submitted->CurrentValue, $this->date_submitted->formatPattern()), CurrentDate(), false);

        // date_updated
        $this->date_updated->setDbValueDef($rsnew, UnFormatDateTime($this->date_updated->CurrentValue, $this->date_updated->formatPattern()), CurrentDate(), false);

        // submitted_by_user_id
        $this->submitted_by_user_id->setDbValueDef($rsnew, $this->submitted_by_user_id->CurrentValue, 0, false);

        // Update current values
        $this->setCurrentValues($rsnew);
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

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("jdhtestnameslist"), "", $this->TableVar, true);
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
                case "x_test_category_id":
                    break;
                case "x_test_subcategory_id":
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
