<?php

namespace PHPMaker2023\jootidigitalhealthcare;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class JdhPatientsList extends JdhPatients
{
    use MessagesTrait;

    // Page ID
    public $PageID = "list";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Page object name
    public $PageObjName = "JdhPatientsList";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // Grid form hidden field names
    public $FormName = "fjdh_patientslist";
    public $FormActionName = "";
    public $FormBlankRowName = "";
    public $FormKeyCountName = "";

    // CSS class/style
    public $CurrentPageName = "jdhpatientslist";

    // Page URLs
    public $AddUrl;
    public $EditUrl;
    public $DeleteUrl;
    public $ViewUrl;
    public $CopyUrl;
    public $ListUrl;

    // Update URLs
    public $InlineAddUrl;
    public $InlineCopyUrl;
    public $InlineEditUrl;
    public $GridAddUrl;
    public $GridEditUrl;
    public $MultiEditUrl;
    public $MultiDeleteUrl;
    public $MultiUpdateUrl;

    // Audit Trail
    public $AuditTrailOnAdd = true;
    public $AuditTrailOnEdit = true;
    public $AuditTrailOnDelete = true;
    public $AuditTrailOnView = false;
    public $AuditTrailOnViewData = false;
    public $AuditTrailOnSearch = false;

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
        $this->FormActionName = Config("FORM_ROW_ACTION_NAME");
        $this->FormBlankRowName = Config("FORM_BLANK_ROW_NAME");
        $this->FormKeyCountName = Config("FORM_KEY_COUNT_NAME");
        $this->TableVar = 'jdh_patients';
        $this->TableName = 'jdh_patients';

        // Table CSS class
        $this->TableClass = "table table-bordered table-hover table-sm ew-table";

        // CSS class name as context
        $this->ContextClass = CheckClassName($this->TableVar);
        AppendClass($this->TableGridClass, $this->ContextClass);

        // Fixed header table
        if (!$this->UseCustomTemplate) {
            $this->setFixedHeaderTable(Config("USE_FIXED_HEADER_TABLE"), Config("FIXED_HEADER_TABLE_HEIGHT"));
        }

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("language");

        // Table object (jdh_patients)
        if (!isset($GLOBALS["jdh_patients"]) || get_class($GLOBALS["jdh_patients"]) == PROJECT_NAMESPACE . "jdh_patients") {
            $GLOBALS["jdh_patients"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl(false);

        // Initialize URLs
        $this->AddUrl = "jdhpatientsadd?" . Config("TABLE_SHOW_DETAIL") . "=";
        $this->InlineAddUrl = $pageUrl . "action=add";
        $this->GridAddUrl = $pageUrl . "action=gridadd";
        $this->GridEditUrl = $pageUrl . "action=gridedit";
        $this->MultiEditUrl = $pageUrl . "action=multiedit";
        $this->MultiDeleteUrl = "jdhpatientsdelete";
        $this->MultiUpdateUrl = "jdhpatientsupdate";

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

        // List options
        $this->ListOptions = new ListOptions(["Tag" => "td", "TableVar" => $this->TableVar]);

        // Export options
        $this->ExportOptions = new ListOptions(["TagClassName" => "ew-export-option"]);

        // Import options
        $this->ImportOptions = new ListOptions(["TagClassName" => "ew-import-option"]);

        // Other options
        if (!$this->OtherOptions) {
            $this->OtherOptions = new ListOptionsArray();
        }

        // Grid-Add/Edit
        $this->OtherOptions["addedit"] = new ListOptions([
            "TagClassName" => "ew-add-edit-option",
            "UseDropDownButton" => false,
            "DropDownButtonPhrase" => $Language->phrase("ButtonAddEdit"),
            "UseButtonGroup" => true
        ]);

        // Detail tables
        $this->OtherOptions["detail"] = new ListOptions(["TagClassName" => "ew-detail-option"]);
        // Actions
        $this->OtherOptions["action"] = new ListOptions(["TagClassName" => "ew-action-option"]);

        // Column visibility
        $this->OtherOptions["column"] = new ListOptions([
            "TableVar" => $this->TableVar,
            "TagClassName" => "ew-column-option",
            "ButtonGroupClass" => "ew-column-dropdown",
            "UseDropDownButton" => true,
            "DropDownButtonPhrase" => $Language->phrase("Columns"),
            "DropDownAutoClose" => "outside",
            "UseButtonGroup" => false
        ]);

        // Filter options
        $this->FilterOptions = new ListOptions(["TagClassName" => "ew-filter-option"]);

        // List actions
        $this->ListActions = new ListActions();
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
                        if ($fld->DataType == DATATYPE_MEMO && $fld->MemoMaxLength > 0) {
                            $val = TruncateMemo($val, $fld->MemoMaxLength, $fld->TruncateMemoRemoveHtml);
                        }
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
        if ($this->isAddOrEdit()) {
            $this->submitted_by_user_id->Visible = false;
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

    // Class variables
    public $ListOptions; // List options
    public $ExportOptions; // Export options
    public $SearchOptions; // Search options
    public $OtherOptions; // Other options
    public $FilterOptions; // Filter options
    public $ImportOptions; // Import options
    public $ListActions; // List actions
    public $SelectedCount = 0;
    public $SelectedIndex = 0;
    public $DisplayRecords = 20;
    public $StartRecord;
    public $StopRecord;
    public $TotalRecords = 0;
    public $RecordRange = 10;
    public $PageSizes = "10,20,50,-1"; // Page sizes (comma separated)
    public $DefaultSearchWhere = ""; // Default search WHERE clause
    public $SearchWhere = ""; // Search WHERE clause
    public $SearchPanelClass = "ew-search-panel collapse show"; // Search Panel class
    public $SearchColumnCount = 0; // For extended search
    public $SearchFieldsPerRow = 1; // For extended search
    public $RecordCount = 0; // Record count
    public $InlineRowCount = 0;
    public $StartRowCount = 1;
    public $RowCount = 0;
    public $Attrs = []; // Row attributes and cell attributes
    public $RowIndex = 0; // Row index
    public $KeyCount = 0; // Key count
    public $MultiColumnGridClass = "row-cols-md";
    public $MultiColumnEditClass = "col-12 w-100";
    public $MultiColumnCardClass = "card h-100 ew-card";
    public $MultiColumnListOptionsPosition = "bottom-start";
    public $DbMasterFilter = ""; // Master filter
    public $DbDetailFilter = ""; // Detail filter
    public $MasterRecordExists;
    public $MultiSelectKey;
    public $Command;
    public $UserAction; // User action
    public $RestoreSearch = false;
    public $HashValue; // Hash value
    public $DetailPages;
    public $TopContentClass = "ew-top";
    public $MiddleContentClass = "ew-middle";
    public $BottomContentClass = "ew-bottom";
    public $PageAction;
    public $RecKeys = [];
    public $IsModal = false;
    protected $FilterForModalActions = "";
    private $UseInfiniteScroll = false;

    /**
     * Load recordset from filter
     *
     * @return void
     */
    public function loadRecordsetFromFilter($filter)
    {
        // Set up list options
        $this->setupListOptions();

        // Search options
        $this->setupSearchOptions();

        // Load recordset
        $this->TotalRecords = $this->loadRecordCount($filter);
        $this->StartRecord = 1;
        $this->StopRecord = $this->DisplayRecords;
        $this->CurrentFilter = $filter;
        $this->Recordset = $this->loadRecordset();

        // Set up pager
        $this->Pager = new PrevNextPager($this, $this->StartRecord, $this->DisplayRecords, $this->TotalRecords, $this->PageSizes, $this->RecordRange, $this->AutoHidePager, $this->AutoHidePageSizeSelector);
    }

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $UserProfile, $Language, $Security, $CurrentForm, $DashboardReport;

        // Multi column button position
        $this->MultiColumnListOptionsPosition = Config("MULTI_COLUMN_LIST_OPTIONS_POSITION");

        // Is modal
        $this->IsModal = ConvertToBool(Param("modal"));

        // Use layout
        $this->UseLayout = $this->UseLayout && ConvertToBool(Param(Config("PAGE_LAYOUT"), true));

        // View
        $this->View = Get(Config("VIEW"));

        // Get export parameters
        $custom = "";
        if (Param("export") !== null) {
            $this->Export = Param("export");
            $custom = Param("custom", "");
        } else {
            $this->setExportReturnUrl(CurrentUrl());
        }
        $ExportType = $this->Export; // Get export parameter, used in header
        if ($ExportType != "") {
            global $SkipHeaderFooter;
            $SkipHeaderFooter = true;
        }
        $this->CurrentAction = Param("action"); // Set up current action

        // Get grid add count
        $gridaddcnt = Get(Config("TABLE_GRID_ADD_ROW_COUNT"), "");
        if (is_numeric($gridaddcnt) && $gridaddcnt > 0) {
            $this->GridAddRowCount = $gridaddcnt;
        }

        // Set up list options
        $this->setupListOptions();

        // Setup export options
        $this->setupExportOptions();

        // Setup import options
        $this->setupImportOptions();
        $this->patient_id->setVisibility();
        $this->photo->Visible = false;
        $this->patient_name->setVisibility();
        $this->patient_national_id->setVisibility();
        $this->patient_dob->setVisibility();
        $this->patient_age->setVisibility();
        $this->patient_gender->setVisibility();
        $this->patient_phone->setVisibility();
        $this->patient_kin_name->Visible = false;
        $this->patient_kin_phone->Visible = false;
        $this->service_id->setVisibility();
        $this->patient_registration_date->setVisibility();
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

        // Setup other options
        $this->setupOtherOptions();

        // Set up custom action (compatible with old version)
        foreach ($this->CustomActions as $name => $action) {
            $this->ListActions->add($name, $action);
        }

        // Set up lookup cache
        $this->setupLookupOptions($this->patient_gender);
        $this->setupLookupOptions($this->service_id);

        // Update form name to avoid conflict
        if ($this->IsModal) {
            $this->FormName = "fjdh_patientsgrid";
        }

        // Set up page action
        $this->PageAction = CurrentPageUrl(false);

        // Set up infinite scroll
        $this->UseInfiniteScroll = ConvertToBool(Param("infinitescroll"));

        // Search filters
        $srchAdvanced = ""; // Advanced search filter
        $srchBasic = ""; // Basic search filter
        $filter = ""; // Filter
        $query = ""; // Query builder

        // Get command
        $this->Command = strtolower(Get("cmd", ""));

        // Process list action first
        if ($this->processListAction()) { // Ajax request
            $this->terminate();
            return;
        }

        // Set up records per page
        $this->setupDisplayRecords();

        // Handle reset command
        $this->resetCmd();

        // Set up Breadcrumb
        if (!$this->isExport()) {
            $this->setupBreadcrumb();
        }

        // Process import
        if ($this->isImport()) {
            $this->import(Param(Config("API_FILE_TOKEN_NAME")), ConvertToBool(Param("rollback")));
            $this->terminate();
            return;
        }

        // Hide list options
        if ($this->isExport()) {
            $this->ListOptions->hideAllOptions(["sequence"]);
            $this->ListOptions->UseDropDownButton = false; // Disable drop down button
            $this->ListOptions->UseButtonGroup = false; // Disable button group
        } elseif ($this->isGridAdd() || $this->isGridEdit() || $this->isMultiEdit() || $this->isConfirm()) {
            $this->ListOptions->hideAllOptions();
            $this->ListOptions->UseDropDownButton = false; // Disable drop down button
            $this->ListOptions->UseButtonGroup = false; // Disable button group
        }

        // Hide options
        if ($this->isExport() || !(EmptyValue($this->CurrentAction) || $this->isSearch())) {
            $this->ExportOptions->hideAllOptions();
            $this->FilterOptions->hideAllOptions();
            $this->ImportOptions->hideAllOptions();
        }

        // Hide other options
        if ($this->isExport()) {
            $this->OtherOptions->hideAllOptions();
        }

        // Get default search criteria
        AddFilter($this->DefaultSearchWhere, $this->basicSearchWhere(true));

        // Get basic search values
        $this->loadBasicSearchValues();

        // Process filter list
        if ($this->processFilterList()) {
            $this->terminate();
            return;
        }

        // Restore search parms from Session if not searching / reset / export
        if (($this->isExport() || $this->Command != "search" && $this->Command != "reset" && $this->Command != "resetall") && $this->Command != "json" && $this->checkSearchParms()) {
            $this->restoreSearchParms();
        }

        // Call Recordset SearchValidated event
        $this->recordsetSearchValidated();

        // Set up sorting order
        $this->setupSortOrder();

        // Get basic search criteria
        if (!$this->hasInvalidFields()) {
            $srchBasic = $this->basicSearchWhere();
        }

        // Restore display records
        if ($this->Command != "json" && $this->getRecordsPerPage() != "") {
            $this->DisplayRecords = $this->getRecordsPerPage(); // Restore from Session
        } else {
            $this->DisplayRecords = 20; // Load default
            $this->setRecordsPerPage($this->DisplayRecords); // Save default to Session
        }

        // Load search default if no existing search criteria
        if (!$this->checkSearchParms()) {
            // Load basic search from default
            $this->BasicSearch->loadDefault();
            if ($this->BasicSearch->Keyword != "") {
                $srchBasic = $this->basicSearchWhere();
            }
        }

        // Build search criteria
        if ($query) {
            AddFilter($this->SearchWhere, $query);
        } else {
            AddFilter($this->SearchWhere, $srchAdvanced);
            AddFilter($this->SearchWhere, $srchBasic);
        }

        // Call Recordset_Searching event
        $this->recordsetSearching($this->SearchWhere);

        // Save search criteria
        if ($this->Command == "search" && !$this->RestoreSearch) {
            $this->setSearchWhere($this->SearchWhere); // Save to Session
            $this->StartRecord = 1; // Reset start record counter
            $this->setStartRecordNumber($this->StartRecord);
        } elseif ($this->Command != "json" && !$query) {
            $this->SearchWhere = $this->getSearchWhere();
        }

        // Build filter
        $filter = "";
        if (!$Security->canList()) {
            $filter = "(0=1)"; // Filter all records
        }
        AddFilter($filter, $this->DbDetailFilter);
        AddFilter($filter, $this->SearchWhere);

        // Set up filter
        if ($this->Command == "json") {
            $this->UseSessionForListSql = false; // Do not use session for ListSQL
            $this->CurrentFilter = $filter;
        } else {
            $this->setSessionWhere($filter);
            $this->CurrentFilter = "";
        }
        $this->Filter = $filter;
        if ($this->isGridAdd()) {
            $this->CurrentFilter = "0=1";
            $this->StartRecord = 1;
            $this->DisplayRecords = $this->GridAddRowCount;
            $this->TotalRecords = $this->DisplayRecords;
            $this->StopRecord = $this->DisplayRecords;
        } elseif (($this->isEdit() || $this->isCopy() || $this->isInlineInserted() || $this->isInlineUpdated()) && $this->UseInfiniteScroll) { // Get current record only
            $this->CurrentFilter = $this->isInlineUpdated() ? $this->getRecordFilter() : $this->getFilterFromRecordKeys();
            $this->TotalRecords = $this->listRecordCount();
            $this->StartRecord = 1;
            $this->StopRecord = $this->DisplayRecords;
            $this->Recordset = $this->loadRecordset();
        } elseif (
            $this->UseInfiniteScroll && $this->isGridInserted() ||
            $this->UseInfiniteScroll && ($this->isGridEdit() || $this->isGridUpdated()) ||
            $this->isMultiEdit() ||
            $this->UseInfiniteScroll && $this->isMultiUpdated()
        ) { // Get current records only
            $this->CurrentFilter = $this->FilterForModalActions; // Restore filter
            $this->TotalRecords = $this->listRecordCount();
            $this->StartRecord = 1;
            $this->StopRecord = $this->DisplayRecords;
            $this->Recordset = $this->loadRecordset();
        } else {
            $this->TotalRecords = $this->listRecordCount();
            $this->StartRecord = 1;
            if ($this->DisplayRecords <= 0 || ($this->isExport() && $this->ExportAll)) { // Display all records
                $this->DisplayRecords = $this->TotalRecords;
            }
            if (!($this->isExport() && $this->ExportAll)) { // Set up start record position
                $this->setupStartRecord();
            }
            $this->Recordset = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords);

            // Set no record found message
            if ((EmptyValue($this->CurrentAction) || $this->isSearch()) && $this->TotalRecords == 0) {
                if (!$Security->canList()) {
                    $this->setWarningMessage(DeniedMessage());
                }
                if ($this->SearchWhere == "0=101") {
                    $this->setWarningMessage($Language->phrase("EnterSearchCriteria"));
                } else {
                    $this->setWarningMessage($Language->phrase("NoRecord"));
                }
            }

            // Audit trail on search
            if ($this->AuditTrailOnSearch && $this->Command == "search" && !$this->RestoreSearch) {
                $searchParm = ServerVar("QUERY_STRING");
                $searchSql = $this->getSessionWhere();
                $this->writeAuditTrailOnSearch($searchParm, $searchSql);
            }
        }

        // Set up list action columns
        foreach ($this->ListActions->Items as $listaction) {
            if ($listaction->Allow) {
                if ($listaction->Select == ACTION_MULTIPLE) { // Show checkbox column if multiple action
                    $this->ListOptions["checkbox"]->Visible = true;
                } elseif ($listaction->Select == ACTION_SINGLE) { // Show list action column
                        $this->ListOptions["listactions"]->Visible = true; // Set visible if any list action is allowed
                }
            }
        }

        // Search options
        $this->setupSearchOptions();

        // Set up search panel class
        if ($this->SearchWhere != "") {
            if ($query) { // Hide search panel if using QueryBuilder
                RemoveClass($this->SearchPanelClass, "show");
            } else {
                AppendClass($this->SearchPanelClass, "show");
            }
        }

        // API list action
        if (IsApi()) {
            if (Route(0) == Config("API_LIST_ACTION")) {
                if (!$this->isExport()) {
                    $rows = $this->getRecordsFromRecordset($this->Recordset);
                    $this->Recordset->close();
                    WriteJson(["success" => true, "action" => Config("API_LIST_ACTION"), $this->TableVar => $rows, "totalRecordCount" => $this->TotalRecords]);
                    $this->terminate(true);
                }
                return;
            } elseif ($this->getFailureMessage() != "") {
                WriteJson(["error" => $this->getFailureMessage()]);
                $this->clearFailureMessage();
                $this->terminate(true);
                return;
            }
        }

        // Render other options
        $this->renderOtherOptions();

        // Set up pager
        $this->Pager = new PrevNextPager($this, $this->StartRecord, $this->DisplayRecords, $this->TotalRecords, $this->PageSizes, $this->RecordRange, $this->AutoHidePager, $this->AutoHidePageSizeSelector);

        // Set ReturnUrl in header if necessary
        if ($returnUrl = Container("flash")->getFirstMessage("Return-Url")) {
            AddHeader("Return-Url", GetUrl($returnUrl));
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

    // Get page number
    public function getPageNumber()
    {
        return ($this->DisplayRecords > 0 && $this->StartRecord > 0) ? ceil($this->StartRecord / $this->DisplayRecords) : 1;
    }

    // Set up number of records displayed per page
    protected function setupDisplayRecords()
    {
        $wrk = Get(Config("TABLE_REC_PER_PAGE"), "");
        if ($wrk != "") {
            if (is_numeric($wrk)) {
                $this->DisplayRecords = (int)$wrk;
            } else {
                if (SameText($wrk, "all")) { // Display all records
                    $this->DisplayRecords = -1;
                } else {
                    $this->DisplayRecords = 20; // Non-numeric, load default
                }
            }
            $this->setRecordsPerPage($this->DisplayRecords); // Save to Session
            // Reset start position
            $this->StartRecord = 1;
            $this->setStartRecordNumber($this->StartRecord);
        }
    }

    // Build filter for all keys
    protected function buildKeyFilter()
    {
        global $CurrentForm;
        $wrkFilter = "";

        // Update row index and get row key
        $rowindex = 1;
        $CurrentForm->Index = $rowindex;
        $thisKey = strval($CurrentForm->getValue($this->OldKeyName));
        while ($thisKey != "") {
            $this->setKey($thisKey);
            if ($this->OldKey != "") {
                $filter = $this->getRecordFilter();
                if ($wrkFilter != "") {
                    $wrkFilter .= " OR ";
                }
                $wrkFilter .= $filter;
            } else {
                $wrkFilter = "0=1";
                break;
            }

            // Update row index and get row key
            $rowindex++; // Next row
            $CurrentForm->Index = $rowindex;
            $thisKey = strval($CurrentForm->getValue($this->OldKeyName));
        }
        return $wrkFilter;
    }

    // Get list of filters
    public function getFilterList()
    {
        global $UserProfile;

        // Initialize
        $filterList = "";
        $savedFilterList = "";

        // Load server side filters
        if (Config("SEARCH_FILTER_OPTION") == "Server" && isset($UserProfile)) {
            $savedFilterList = $UserProfile->getSearchFilters(CurrentUserName(), "fjdh_patientssrch");
        }
        $filterList = Concat($filterList, $this->patient_id->AdvancedSearch->toJson(), ","); // Field patient_id
        $filterList = Concat($filterList, $this->patient_name->AdvancedSearch->toJson(), ","); // Field patient_name
        $filterList = Concat($filterList, $this->patient_national_id->AdvancedSearch->toJson(), ","); // Field patient_national_id
        $filterList = Concat($filterList, $this->patient_dob->AdvancedSearch->toJson(), ","); // Field patient_dob
        $filterList = Concat($filterList, $this->patient_age->AdvancedSearch->toJson(), ","); // Field patient_age
        $filterList = Concat($filterList, $this->patient_gender->AdvancedSearch->toJson(), ","); // Field patient_gender
        $filterList = Concat($filterList, $this->patient_phone->AdvancedSearch->toJson(), ","); // Field patient_phone
        $filterList = Concat($filterList, $this->patient_kin_name->AdvancedSearch->toJson(), ","); // Field patient_kin_name
        $filterList = Concat($filterList, $this->patient_kin_phone->AdvancedSearch->toJson(), ","); // Field patient_kin_phone
        $filterList = Concat($filterList, $this->service_id->AdvancedSearch->toJson(), ","); // Field service_id
        $filterList = Concat($filterList, $this->patient_registration_date->AdvancedSearch->toJson(), ","); // Field patient_registration_date
        $filterList = Concat($filterList, $this->submitted_by_user_id->AdvancedSearch->toJson(), ","); // Field submitted_by_user_id
        if ($this->BasicSearch->Keyword != "") {
            $wrk = "\"" . Config("TABLE_BASIC_SEARCH") . "\":\"" . JsEncode($this->BasicSearch->Keyword) . "\",\"" . Config("TABLE_BASIC_SEARCH_TYPE") . "\":\"" . JsEncode($this->BasicSearch->Type) . "\"";
            $filterList = Concat($filterList, $wrk, ",");
        }

        // Return filter list in JSON
        if ($filterList != "") {
            $filterList = "\"data\":{" . $filterList . "}";
        }
        if ($savedFilterList != "") {
            $filterList = Concat($filterList, "\"filters\":" . $savedFilterList, ",");
        }
        return ($filterList != "") ? "{" . $filterList . "}" : "null";
    }

    // Process filter list
    protected function processFilterList()
    {
        global $UserProfile;
        if (Post("ajax") == "savefilters") { // Save filter request (Ajax)
            $filters = Post("filters");
            $UserProfile->setSearchFilters(CurrentUserName(), "fjdh_patientssrch", $filters);
            WriteJson([["success" => true]]); // Success
            return true;
        } elseif (Post("cmd") == "resetfilter") {
            $this->restoreFilterList();
        }
        return false;
    }

    // Restore list of filters
    protected function restoreFilterList()
    {
        // Return if not reset filter
        if (Post("cmd") !== "resetfilter") {
            return false;
        }
        $filter = json_decode(Post("filter"), true);
        $this->Command = "search";

        // Field patient_id
        $this->patient_id->AdvancedSearch->SearchValue = @$filter["x_patient_id"];
        $this->patient_id->AdvancedSearch->SearchOperator = @$filter["z_patient_id"];
        $this->patient_id->AdvancedSearch->SearchCondition = @$filter["v_patient_id"];
        $this->patient_id->AdvancedSearch->SearchValue2 = @$filter["y_patient_id"];
        $this->patient_id->AdvancedSearch->SearchOperator2 = @$filter["w_patient_id"];
        $this->patient_id->AdvancedSearch->save();

        // Field patient_name
        $this->patient_name->AdvancedSearch->SearchValue = @$filter["x_patient_name"];
        $this->patient_name->AdvancedSearch->SearchOperator = @$filter["z_patient_name"];
        $this->patient_name->AdvancedSearch->SearchCondition = @$filter["v_patient_name"];
        $this->patient_name->AdvancedSearch->SearchValue2 = @$filter["y_patient_name"];
        $this->patient_name->AdvancedSearch->SearchOperator2 = @$filter["w_patient_name"];
        $this->patient_name->AdvancedSearch->save();

        // Field patient_national_id
        $this->patient_national_id->AdvancedSearch->SearchValue = @$filter["x_patient_national_id"];
        $this->patient_national_id->AdvancedSearch->SearchOperator = @$filter["z_patient_national_id"];
        $this->patient_national_id->AdvancedSearch->SearchCondition = @$filter["v_patient_national_id"];
        $this->patient_national_id->AdvancedSearch->SearchValue2 = @$filter["y_patient_national_id"];
        $this->patient_national_id->AdvancedSearch->SearchOperator2 = @$filter["w_patient_national_id"];
        $this->patient_national_id->AdvancedSearch->save();

        // Field patient_dob
        $this->patient_dob->AdvancedSearch->SearchValue = @$filter["x_patient_dob"];
        $this->patient_dob->AdvancedSearch->SearchOperator = @$filter["z_patient_dob"];
        $this->patient_dob->AdvancedSearch->SearchCondition = @$filter["v_patient_dob"];
        $this->patient_dob->AdvancedSearch->SearchValue2 = @$filter["y_patient_dob"];
        $this->patient_dob->AdvancedSearch->SearchOperator2 = @$filter["w_patient_dob"];
        $this->patient_dob->AdvancedSearch->save();

        // Field patient_age
        $this->patient_age->AdvancedSearch->SearchValue = @$filter["x_patient_age"];
        $this->patient_age->AdvancedSearch->SearchOperator = @$filter["z_patient_age"];
        $this->patient_age->AdvancedSearch->SearchCondition = @$filter["v_patient_age"];
        $this->patient_age->AdvancedSearch->SearchValue2 = @$filter["y_patient_age"];
        $this->patient_age->AdvancedSearch->SearchOperator2 = @$filter["w_patient_age"];
        $this->patient_age->AdvancedSearch->save();

        // Field patient_gender
        $this->patient_gender->AdvancedSearch->SearchValue = @$filter["x_patient_gender"];
        $this->patient_gender->AdvancedSearch->SearchOperator = @$filter["z_patient_gender"];
        $this->patient_gender->AdvancedSearch->SearchCondition = @$filter["v_patient_gender"];
        $this->patient_gender->AdvancedSearch->SearchValue2 = @$filter["y_patient_gender"];
        $this->patient_gender->AdvancedSearch->SearchOperator2 = @$filter["w_patient_gender"];
        $this->patient_gender->AdvancedSearch->save();

        // Field patient_phone
        $this->patient_phone->AdvancedSearch->SearchValue = @$filter["x_patient_phone"];
        $this->patient_phone->AdvancedSearch->SearchOperator = @$filter["z_patient_phone"];
        $this->patient_phone->AdvancedSearch->SearchCondition = @$filter["v_patient_phone"];
        $this->patient_phone->AdvancedSearch->SearchValue2 = @$filter["y_patient_phone"];
        $this->patient_phone->AdvancedSearch->SearchOperator2 = @$filter["w_patient_phone"];
        $this->patient_phone->AdvancedSearch->save();

        // Field patient_kin_name
        $this->patient_kin_name->AdvancedSearch->SearchValue = @$filter["x_patient_kin_name"];
        $this->patient_kin_name->AdvancedSearch->SearchOperator = @$filter["z_patient_kin_name"];
        $this->patient_kin_name->AdvancedSearch->SearchCondition = @$filter["v_patient_kin_name"];
        $this->patient_kin_name->AdvancedSearch->SearchValue2 = @$filter["y_patient_kin_name"];
        $this->patient_kin_name->AdvancedSearch->SearchOperator2 = @$filter["w_patient_kin_name"];
        $this->patient_kin_name->AdvancedSearch->save();

        // Field patient_kin_phone
        $this->patient_kin_phone->AdvancedSearch->SearchValue = @$filter["x_patient_kin_phone"];
        $this->patient_kin_phone->AdvancedSearch->SearchOperator = @$filter["z_patient_kin_phone"];
        $this->patient_kin_phone->AdvancedSearch->SearchCondition = @$filter["v_patient_kin_phone"];
        $this->patient_kin_phone->AdvancedSearch->SearchValue2 = @$filter["y_patient_kin_phone"];
        $this->patient_kin_phone->AdvancedSearch->SearchOperator2 = @$filter["w_patient_kin_phone"];
        $this->patient_kin_phone->AdvancedSearch->save();

        // Field service_id
        $this->service_id->AdvancedSearch->SearchValue = @$filter["x_service_id"];
        $this->service_id->AdvancedSearch->SearchOperator = @$filter["z_service_id"];
        $this->service_id->AdvancedSearch->SearchCondition = @$filter["v_service_id"];
        $this->service_id->AdvancedSearch->SearchValue2 = @$filter["y_service_id"];
        $this->service_id->AdvancedSearch->SearchOperator2 = @$filter["w_service_id"];
        $this->service_id->AdvancedSearch->save();

        // Field patient_registration_date
        $this->patient_registration_date->AdvancedSearch->SearchValue = @$filter["x_patient_registration_date"];
        $this->patient_registration_date->AdvancedSearch->SearchOperator = @$filter["z_patient_registration_date"];
        $this->patient_registration_date->AdvancedSearch->SearchCondition = @$filter["v_patient_registration_date"];
        $this->patient_registration_date->AdvancedSearch->SearchValue2 = @$filter["y_patient_registration_date"];
        $this->patient_registration_date->AdvancedSearch->SearchOperator2 = @$filter["w_patient_registration_date"];
        $this->patient_registration_date->AdvancedSearch->save();

        // Field submitted_by_user_id
        $this->submitted_by_user_id->AdvancedSearch->SearchValue = @$filter["x_submitted_by_user_id"];
        $this->submitted_by_user_id->AdvancedSearch->SearchOperator = @$filter["z_submitted_by_user_id"];
        $this->submitted_by_user_id->AdvancedSearch->SearchCondition = @$filter["v_submitted_by_user_id"];
        $this->submitted_by_user_id->AdvancedSearch->SearchValue2 = @$filter["y_submitted_by_user_id"];
        $this->submitted_by_user_id->AdvancedSearch->SearchOperator2 = @$filter["w_submitted_by_user_id"];
        $this->submitted_by_user_id->AdvancedSearch->save();
        $this->BasicSearch->setKeyword(@$filter[Config("TABLE_BASIC_SEARCH")]);
        $this->BasicSearch->setType(@$filter[Config("TABLE_BASIC_SEARCH_TYPE")]);
    }

    // Show list of filters
    public function showFilterList()
    {
        global $Language;

        // Initialize
        $filterList = "";
        $captionClass = $this->isExport("email") ? "ew-filter-caption-email" : "ew-filter-caption";
        $captionSuffix = $this->isExport("email") ? ": " : "";
        if ($this->BasicSearch->Keyword != "") {
            $filterList .= "<div><span class=\"" . $captionClass . "\">" . $Language->phrase("BasicSearchKeyword") . "</span>" . $captionSuffix . $this->BasicSearch->Keyword . "</div>";
        }

        // Show Filters
        if ($filterList != "") {
            $message = "<div id=\"ew-filter-list\" class=\"callout callout-info d-table\"><div id=\"ew-current-filters\">" .
                $Language->phrase("CurrentFilters") . "</div>" . $filterList . "</div>";
            $this->messageShowing($message, "");
            Write($message);
        } else { // Output empty tag
            Write("<div id=\"ew-filter-list\"></div>");
        }
    }

    // Return basic search WHERE clause based on search keyword and type
    public function basicSearchWhere($default = false)
    {
        global $Security;
        $searchStr = "";
        if (!$Security->canSearch()) {
            return "";
        }

        // Fields to search
        $searchFlds = [];
        $searchFlds[] = &$this->patient_name;
        $searchFlds[] = &$this->patient_national_id;
        $searchFlds[] = &$this->patient_gender;
        $searchFlds[] = &$this->patient_phone;
        $searchFlds[] = &$this->patient_kin_name;
        $searchKeyword = $default ? $this->BasicSearch->KeywordDefault : $this->BasicSearch->Keyword;
        $searchType = $default ? $this->BasicSearch->TypeDefault : $this->BasicSearch->Type;

        // Get search SQL
        if ($searchKeyword != "") {
            $ar = $this->BasicSearch->keywordList($default);
            $searchStr = GetQuickSearchFilter($searchFlds, $ar, $searchType, Config("BASIC_SEARCH_ANY_FIELDS"), $this->Dbid);
            if (!$default && in_array($this->Command, ["", "reset", "resetall"])) {
                $this->Command = "search";
            }
        }
        if (!$default && $this->Command == "search") {
            $this->BasicSearch->setKeyword($searchKeyword);
            $this->BasicSearch->setType($searchType);

            // Clear rules for QueryBuilder
            $this->setSessionRules("");
        }
        return $searchStr;
    }

    // Check if search parm exists
    protected function checkSearchParms()
    {
        // Check basic search
        if ($this->BasicSearch->issetSession()) {
            return true;
        }
        return false;
    }

    // Clear all search parameters
    protected function resetSearchParms()
    {
        // Clear search WHERE clause
        $this->SearchWhere = "";
        $this->setSearchWhere($this->SearchWhere);

        // Clear basic search parameters
        $this->resetBasicSearchParms();
    }

    // Load advanced search default values
    protected function loadAdvancedSearchDefault()
    {
        return false;
    }

    // Clear all basic search parameters
    protected function resetBasicSearchParms()
    {
        $this->BasicSearch->unsetSession();
    }

    // Restore all search parameters
    protected function restoreSearchParms()
    {
        $this->RestoreSearch = true;

        // Restore basic search values
        $this->BasicSearch->load();
    }

    // Set up sort parameters
    protected function setupSortOrder()
    {
        // Load default Sorting Order
        if ($this->Command != "json") {
            $defaultSort = ""; // Set up default sort
            if ($this->getSessionOrderBy() == "" && $defaultSort != "") {
                $this->setSessionOrderBy($defaultSort);
            }
        }

        // Check for "order" parameter
        if (Get("order") !== null) {
            $this->CurrentOrder = Get("order");
            $this->CurrentOrderType = Get("ordertype", "");
            $this->updateSort($this->patient_id); // patient_id
            $this->updateSort($this->patient_name); // patient_name
            $this->updateSort($this->patient_national_id); // patient_national_id
            $this->updateSort($this->patient_dob); // patient_dob
            $this->updateSort($this->patient_age); // patient_age
            $this->updateSort($this->patient_gender); // patient_gender
            $this->updateSort($this->patient_phone); // patient_phone
            $this->updateSort($this->service_id); // service_id
            $this->updateSort($this->patient_registration_date); // patient_registration_date
            $this->updateSort($this->submitted_by_user_id); // submitted_by_user_id
            $this->setStartRecordNumber(1); // Reset start position
        }

        // Update field sort
        $this->updateFieldSort();
    }

    // Reset command
    // - cmd=reset (Reset search parameters)
    // - cmd=resetall (Reset search and master/detail parameters)
    // - cmd=resetsort (Reset sort parameters)
    protected function resetCmd()
    {
        // Check if reset command
        if (StartsString("reset", $this->Command)) {
            // Reset search criteria
            if ($this->Command == "reset" || $this->Command == "resetall") {
                $this->resetSearchParms();
            }

            // Reset (clear) sorting order
            if ($this->Command == "resetsort") {
                $orderBy = "";
                $this->setSessionOrderBy($orderBy);
                $this->patient_id->setSort("");
                $this->patient_name->setSort("");
                $this->patient_national_id->setSort("");
                $this->patient_dob->setSort("");
                $this->patient_age->setSort("");
                $this->patient_gender->setSort("");
                $this->patient_phone->setSort("");
                $this->patient_kin_name->setSort("");
                $this->patient_kin_phone->setSort("");
                $this->service_id->setSort("");
                $this->patient_registration_date->setSort("");
                $this->submitted_by_user_id->setSort("");
            }

            // Reset start position
            $this->StartRecord = 1;
            $this->setStartRecordNumber($this->StartRecord);
        }
    }

    // Set up list options
    protected function setupListOptions()
    {
        global $Security, $Language;

        // Add group option item ("button")
        $item = &$this->ListOptions->addGroupOption();
        $item->Body = "";
        $item->OnLeft = false;
        $item->Visible = false;

        // "view"
        $item = &$this->ListOptions->add("view");
        $item->CssClass = "text-nowrap";
        $item->Visible = $Security->canView();
        $item->OnLeft = false;

        // "edit"
        $item = &$this->ListOptions->add("edit");
        $item->CssClass = "text-nowrap";
        $item->Visible = $Security->canEdit();
        $item->OnLeft = false;

        // "detail_jdh_appointments"
        $item = &$this->ListOptions->add("detail_jdh_appointments");
        $item->CssClass = "text-nowrap";
        $item->Visible = $Security->allowList(CurrentProjectID() . 'jdh_appointments');
        $item->OnLeft = false;
        $item->ShowInButtonGroup = false;

        // "detail_jdh_patient_cases"
        $item = &$this->ListOptions->add("detail_jdh_patient_cases");
        $item->CssClass = "text-nowrap";
        $item->Visible = $Security->allowList(CurrentProjectID() . 'jdh_patient_cases');
        $item->OnLeft = false;
        $item->ShowInButtonGroup = false;

        // "detail_jdh_vitals"
        $item = &$this->ListOptions->add("detail_jdh_vitals");
        $item->CssClass = "text-nowrap";
        $item->Visible = $Security->allowList(CurrentProjectID() . 'jdh_vitals');
        $item->OnLeft = false;
        $item->ShowInButtonGroup = false;

        // "detail_jdh_chief_complaints"
        $item = &$this->ListOptions->add("detail_jdh_chief_complaints");
        $item->CssClass = "text-nowrap";
        $item->Visible = $Security->allowList(CurrentProjectID() . 'jdh_chief_complaints');
        $item->OnLeft = false;
        $item->ShowInButtonGroup = false;

        // "detail_jdh_examination_findings"
        $item = &$this->ListOptions->add("detail_jdh_examination_findings");
        $item->CssClass = "text-nowrap";
        $item->Visible = $Security->allowList(CurrentProjectID() . 'jdh_examination_findings');
        $item->OnLeft = false;
        $item->ShowInButtonGroup = false;

        // "detail_jdh_prescriptions"
        $item = &$this->ListOptions->add("detail_jdh_prescriptions");
        $item->CssClass = "text-nowrap";
        $item->Visible = $Security->allowList(CurrentProjectID() . 'jdh_prescriptions');
        $item->OnLeft = false;
        $item->ShowInButtonGroup = false;

        // "detail_jdh_test_requests"
        $item = &$this->ListOptions->add("detail_jdh_test_requests");
        $item->CssClass = "text-nowrap";
        $item->Visible = $Security->allowList(CurrentProjectID() . 'jdh_test_requests');
        $item->OnLeft = false;
        $item->ShowInButtonGroup = false;

        // "detail_jdh_test_reports"
        $item = &$this->ListOptions->add("detail_jdh_test_reports");
        $item->CssClass = "text-nowrap";
        $item->Visible = $Security->allowList(CurrentProjectID() . 'jdh_test_reports');
        $item->OnLeft = false;
        $item->ShowInButtonGroup = false;

        // "detail_jdh_prescriptions_actions"
        $item = &$this->ListOptions->add("detail_jdh_prescriptions_actions");
        $item->CssClass = "text-nowrap";
        $item->Visible = $Security->allowList(CurrentProjectID() . 'jdh_prescriptions_actions');
        $item->OnLeft = false;
        $item->ShowInButtonGroup = false;

        // "detail_jdh_patient_visits"
        $item = &$this->ListOptions->add("detail_jdh_patient_visits");
        $item->CssClass = "text-nowrap";
        $item->Visible = $Security->allowList(CurrentProjectID() . 'jdh_patient_visits');
        $item->OnLeft = false;
        $item->ShowInButtonGroup = false;

        // Multiple details
        if ($this->ShowMultipleDetails) {
            $item = &$this->ListOptions->add("details");
            $item->CssClass = "text-nowrap";
            $item->Visible = $this->ShowMultipleDetails && $this->ListOptions->detailVisible();
            $item->OnLeft = false;
            $item->ShowInButtonGroup = false;
            $this->ListOptions->hideDetailItems();
        }

        // Set up detail pages
        $pages = new SubPages();
        $pages->add("jdh_appointments");
        $pages->add("jdh_patient_cases");
        $pages->add("jdh_vitals");
        $pages->add("jdh_chief_complaints");
        $pages->add("jdh_examination_findings");
        $pages->add("jdh_prescriptions");
        $pages->add("jdh_test_requests");
        $pages->add("jdh_test_reports");
        $pages->add("jdh_prescriptions_actions");
        $pages->add("jdh_patient_visits");
        $this->DetailPages = $pages;

        // List actions
        $item = &$this->ListOptions->add("listactions");
        $item->CssClass = "text-nowrap";
        $item->OnLeft = false;
        $item->Visible = false;
        $item->ShowInButtonGroup = false;
        $item->ShowInDropDown = false;

        // "checkbox"
        $item = &$this->ListOptions->add("checkbox");
        $item->Visible = $Security->canDelete();
        $item->OnLeft = false;
        $item->Header = "<div class=\"form-check\"><input type=\"checkbox\" name=\"key\" id=\"key\" class=\"form-check-input\" data-ew-action=\"select-all-keys\"></div>";
        if ($item->OnLeft) {
            $item->moveTo(0);
        }
        $item->ShowInDropDown = false;
        $item->ShowInButtonGroup = false;

        // Drop down button for ListOptions
        $this->ListOptions->UseDropDownButton = false;
        $this->ListOptions->DropDownButtonPhrase = $Language->phrase("ButtonListOptions");
        $this->ListOptions->UseButtonGroup = true;
        if ($this->ListOptions->UseButtonGroup && IsMobile()) {
            $this->ListOptions->UseDropDownButton = true;
        }

        //$this->ListOptions->ButtonClass = ""; // Class for button group

        // Call ListOptions_Load event
        $this->listOptionsLoad();
        $this->setupListOptionsExt();
        $item = $this->ListOptions[$this->ListOptions->GroupOptionName];
        $item->Visible = $this->ListOptions->groupOptionVisible();
    }

    // Set up list options (extensions)
    protected function setupListOptionsExt()
    {
            // Set up list options (to be implemented by extensions)
    }

    // Add "hash" parameter to URL
    public function urlAddHash($url, $hash)
    {
        return $this->UseAjaxActions ? $url : UrlAddQuery($url, "hash=" . $hash);
    }

    // Render list options
    public function renderListOptions()
    {
        global $Security, $Language, $CurrentForm, $UserProfile;
        $this->ListOptions->loadDefault();

        // Call ListOptions_Rendering event
        $this->listOptionsRendering();
        $pageUrl = $this->pageUrl(false);
        if ($this->CurrentMode == "view") {
            // "view"
            $opt = $this->ListOptions["view"];
            $viewcaption = HtmlTitle($Language->phrase("ViewLink"));
            if ($Security->canView() && $this->showOptionLink("view")) {
                if ($this->ModalView && !IsMobile()) {
                    $opt->Body = "<a class=\"ew-row-link ew-view\" title=\"" . $viewcaption . "\" data-table=\"jdh_patients\" data-caption=\"" . $viewcaption . "\" data-ew-action=\"modal\" data-action=\"view\" data-ajax=\"" . ($this->UseAjaxActions ? "true" : "false") . "\" data-url=\"" . HtmlEncode(GetUrl($this->ViewUrl)) . "\" data-btn=\"null\">" . $Language->phrase("ViewLink") . "</a>";
                } else {
                    $opt->Body = "<a class=\"ew-row-link ew-view\" title=\"" . $viewcaption . "\" data-caption=\"" . $viewcaption . "\" href=\"" . HtmlEncode(GetUrl($this->ViewUrl)) . "\">" . $Language->phrase("ViewLink") . "</a>";
                }
            } else {
                $opt->Body = "";
            }

            // "edit"
            $opt = $this->ListOptions["edit"];
            $editcaption = HtmlTitle($Language->phrase("EditLink"));
            if ($Security->canEdit() && $this->showOptionLink("edit")) {
                if ($this->ModalEdit && !IsMobile()) {
                    $opt->Body = "<a class=\"ew-row-link ew-edit\" title=\"" . $editcaption . "\" data-table=\"jdh_patients\" data-caption=\"" . $editcaption . "\" data-ew-action=\"modal\" data-action=\"edit\" data-ajax=\"" . ($this->UseAjaxActions ? "true" : "false") . "\" data-url=\"" . HtmlEncode(GetUrl($this->EditUrl)) . "\" data-btn=\"SaveBtn\">" . $Language->phrase("EditLink") . "</a>";
                } else {
                    $opt->Body = "<a class=\"ew-row-link ew-edit\" title=\"" . $editcaption . "\" data-caption=\"" . $editcaption . "\" href=\"" . HtmlEncode(GetUrl($this->EditUrl)) . "\">" . $Language->phrase("EditLink") . "</a>";
                }
            } else {
                $opt->Body = "";
            }
        } // End View mode

        // Set up list action buttons
        $opt = $this->ListOptions["listactions"];
        if ($opt && !$this->isExport() && !$this->CurrentAction) {
            $body = "";
            $links = [];
            foreach ($this->ListActions->Items as $listaction) {
                $action = $listaction->Action;
                $allowed = $listaction->Allow;
                if ($listaction->Select == ACTION_SINGLE && $allowed) {
                    $caption = $listaction->Caption;
                    $icon = ($listaction->Icon != "") ? "<i class=\"" . HtmlEncode(str_replace(" ew-icon", "", $listaction->Icon)) . "\" data-caption=\"" . HtmlTitle($caption) . "\"></i> " : "";
                    $link = "<li><button type=\"button\" class=\"dropdown-item ew-action ew-list-action\" data-caption=\"" . HtmlTitle($caption) . "\" data-ew-action=\"submit\" form=\"fjdh_patientslist\" data-key=\"" . $this->keyToJson(true) . "\"" . $listaction->toDataAttrs() . ">" . $icon . " " . $listaction->Caption . "</button></li>";
                    if ($link != "") {
                        $links[] = $link;
                        if ($body == "") { // Setup first button
                            $body = "<button type=\"button\" class=\"btn btn-default ew-action ew-list-action\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" data-ew-action=\"submit\" form=\"fjdh_patientslist\" data-key=\"" . $this->keyToJson(true) . "\"" . $listaction->toDataAttrs() . ">" . $icon . " " . $listaction->Caption . "</button>";
                        }
                    }
                }
            }
            if (count($links) > 1) { // More than one buttons, use dropdown
                $body = "<button type=\"button\" class=\"dropdown-toggle btn btn-default ew-actions\" title=\"" . HtmlTitle($Language->phrase("ListActionButton")) . "\" data-bs-toggle=\"dropdown\">" . $Language->phrase("ListActionButton") . "</button>";
                $content = "";
                foreach ($links as $link) {
                    $content .= "<li>" . $link . "</li>";
                }
                $body .= "<ul class=\"dropdown-menu" . ($opt->OnLeft ? "" : " dropdown-menu-right") . "\">" . $content . "</ul>";
                $body = "<div class=\"btn-group btn-group-sm\">" . $body . "</div>";
            }
            if (count($links) > 0) {
                $opt->Body = $body;
            }
        }
        $detailViewTblVar = "";
        $detailCopyTblVar = "";
        $detailEditTblVar = "";

        // "detail_jdh_appointments"
        $opt = $this->ListOptions["detail_jdh_appointments"];
        if ($Security->allowList(CurrentProjectID() . 'jdh_appointments') && $this->showOptionLink()) {
            $body = $Language->phrase("DetailLink") . $Language->TablePhrase("jdh_appointments", "TblCaption");
            if (!$this->ShowMultipleDetails) { // Skip loading record count if show multiple details
                $detailTbl = Container("jdh_appointments");
                $detailFilter = $detailTbl->getDetailFilter($this);
                $detailTbl->setCurrentMasterTable($this->TableVar);
                $detailFilter = $detailTbl->applyUserIDFilters($detailFilter);
                $detailTbl->Count = $detailTbl->loadRecordCount($detailFilter);
                $body .= "&nbsp;" . str_replace("%c", Container("jdh_appointments")->Count, $Language->phrase("DetailCount"));
            }
            $body = "<a class=\"btn btn-default ew-row-link ew-detail" . ($this->ListOptions->UseDropDownButton ? " dropdown-toggle" : "") . "\" data-action=\"list\" href=\"" . HtmlEncode("jdhappointmentslist?" . Config("TABLE_SHOW_MASTER") . "=jdh_patients&" . GetForeignKeyUrl("fk_patient_id", $this->patient_id->CurrentValue) . "") . "\">" . $body . "</a>";
            $links = "";
            $detailPage = Container("JdhAppointmentsGrid");
            if ($detailPage->DetailView && $Security->canView() && $this->showOptionLink("view") && $Security->allowView(CurrentProjectID() . 'jdh_patients')) {
                $caption = $Language->phrase("MasterDetailViewLink", null);
                $url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=jdh_appointments");
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a></li>";
                if ($detailViewTblVar != "") {
                    $detailViewTblVar .= ",";
                }
                $detailViewTblVar .= "jdh_appointments";
            }
            if ($detailPage->DetailEdit && $Security->canEdit() && $this->showOptionLink("edit") && $Security->allowEdit(CurrentProjectID() . 'jdh_patients')) {
                $caption = $Language->phrase("MasterDetailEditLink", null);
                $url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=jdh_appointments");
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a></li>";
                if ($detailEditTblVar != "") {
                    $detailEditTblVar .= ",";
                }
                $detailEditTblVar .= "jdh_appointments";
            }
            if ($links != "") {
                $body .= "<button type=\"button\" class=\"dropdown-toggle btn btn-default ew-detail\" data-bs-toggle=\"dropdown\"></button>";
                $body .= "<ul class=\"dropdown-menu\">" . $links . "</ul>";
            } else {
                $body = preg_replace('/\b\s+dropdown-toggle\b/', "", $body);
            }
            $body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
            $opt->Body = $body;
            if ($this->ShowMultipleDetails) {
                $opt->Visible = false;
            }
        }

        // "detail_jdh_patient_cases"
        $opt = $this->ListOptions["detail_jdh_patient_cases"];
        if ($Security->allowList(CurrentProjectID() . 'jdh_patient_cases') && $this->showOptionLink()) {
            $body = $Language->phrase("DetailLink") . $Language->TablePhrase("jdh_patient_cases", "TblCaption");
            if (!$this->ShowMultipleDetails) { // Skip loading record count if show multiple details
                $detailTbl = Container("jdh_patient_cases");
                $detailFilter = $detailTbl->getDetailFilter($this);
                $detailTbl->setCurrentMasterTable($this->TableVar);
                $detailFilter = $detailTbl->applyUserIDFilters($detailFilter);
                $detailTbl->Count = $detailTbl->loadRecordCount($detailFilter);
                $body .= "&nbsp;" . str_replace("%c", Container("jdh_patient_cases")->Count, $Language->phrase("DetailCount"));
            }
            $body = "<a class=\"btn btn-default ew-row-link ew-detail" . ($this->ListOptions->UseDropDownButton ? " dropdown-toggle" : "") . "\" data-action=\"list\" href=\"" . HtmlEncode("jdhpatientcaseslist?" . Config("TABLE_SHOW_MASTER") . "=jdh_patients&" . GetForeignKeyUrl("fk_patient_id", $this->patient_id->CurrentValue) . "") . "\">" . $body . "</a>";
            $links = "";
            $detailPage = Container("JdhPatientCasesGrid");
            if ($detailPage->DetailView && $Security->canView() && $this->showOptionLink("view") && $Security->allowView(CurrentProjectID() . 'jdh_patients')) {
                $caption = $Language->phrase("MasterDetailViewLink", null);
                $url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=jdh_patient_cases");
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a></li>";
                if ($detailViewTblVar != "") {
                    $detailViewTblVar .= ",";
                }
                $detailViewTblVar .= "jdh_patient_cases";
            }
            if ($detailPage->DetailEdit && $Security->canEdit() && $this->showOptionLink("edit") && $Security->allowEdit(CurrentProjectID() . 'jdh_patients')) {
                $caption = $Language->phrase("MasterDetailEditLink", null);
                $url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=jdh_patient_cases");
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a></li>";
                if ($detailEditTblVar != "") {
                    $detailEditTblVar .= ",";
                }
                $detailEditTblVar .= "jdh_patient_cases";
            }
            if ($links != "") {
                $body .= "<button type=\"button\" class=\"dropdown-toggle btn btn-default ew-detail\" data-bs-toggle=\"dropdown\"></button>";
                $body .= "<ul class=\"dropdown-menu\">" . $links . "</ul>";
            } else {
                $body = preg_replace('/\b\s+dropdown-toggle\b/', "", $body);
            }
            $body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
            $opt->Body = $body;
            if ($this->ShowMultipleDetails) {
                $opt->Visible = false;
            }
        }

        // "detail_jdh_vitals"
        $opt = $this->ListOptions["detail_jdh_vitals"];
        if ($Security->allowList(CurrentProjectID() . 'jdh_vitals') && $this->showOptionLink()) {
            $body = $Language->phrase("DetailLink") . $Language->TablePhrase("jdh_vitals", "TblCaption");
            if (!$this->ShowMultipleDetails) { // Skip loading record count if show multiple details
                $detailTbl = Container("jdh_vitals");
                $detailFilter = $detailTbl->getDetailFilter($this);
                $detailTbl->setCurrentMasterTable($this->TableVar);
                $detailFilter = $detailTbl->applyUserIDFilters($detailFilter);
                $detailTbl->Count = $detailTbl->loadRecordCount($detailFilter);
                $body .= "&nbsp;" . str_replace("%c", Container("jdh_vitals")->Count, $Language->phrase("DetailCount"));
            }
            $body = "<a class=\"btn btn-default ew-row-link ew-detail" . ($this->ListOptions->UseDropDownButton ? " dropdown-toggle" : "") . "\" data-action=\"list\" href=\"" . HtmlEncode("jdhvitalslist?" . Config("TABLE_SHOW_MASTER") . "=jdh_patients&" . GetForeignKeyUrl("fk_patient_id", $this->patient_id->CurrentValue) . "") . "\">" . $body . "</a>";
            $links = "";
            $detailPage = Container("JdhVitalsGrid");
            if ($detailPage->DetailView && $Security->canView() && $this->showOptionLink("view") && $Security->allowView(CurrentProjectID() . 'jdh_patients')) {
                $caption = $Language->phrase("MasterDetailViewLink", null);
                $url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=jdh_vitals");
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a></li>";
                if ($detailViewTblVar != "") {
                    $detailViewTblVar .= ",";
                }
                $detailViewTblVar .= "jdh_vitals";
            }
            if ($detailPage->DetailEdit && $Security->canEdit() && $this->showOptionLink("edit") && $Security->allowEdit(CurrentProjectID() . 'jdh_patients')) {
                $caption = $Language->phrase("MasterDetailEditLink", null);
                $url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=jdh_vitals");
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a></li>";
                if ($detailEditTblVar != "") {
                    $detailEditTblVar .= ",";
                }
                $detailEditTblVar .= "jdh_vitals";
            }
            if ($links != "") {
                $body .= "<button type=\"button\" class=\"dropdown-toggle btn btn-default ew-detail\" data-bs-toggle=\"dropdown\"></button>";
                $body .= "<ul class=\"dropdown-menu\">" . $links . "</ul>";
            } else {
                $body = preg_replace('/\b\s+dropdown-toggle\b/', "", $body);
            }
            $body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
            $opt->Body = $body;
            if ($this->ShowMultipleDetails) {
                $opt->Visible = false;
            }
        }

        // "detail_jdh_chief_complaints"
        $opt = $this->ListOptions["detail_jdh_chief_complaints"];
        if ($Security->allowList(CurrentProjectID() . 'jdh_chief_complaints') && $this->showOptionLink()) {
            $body = $Language->phrase("DetailLink") . $Language->TablePhrase("jdh_chief_complaints", "TblCaption");
            if (!$this->ShowMultipleDetails) { // Skip loading record count if show multiple details
                $detailTbl = Container("jdh_chief_complaints");
                $detailFilter = $detailTbl->getDetailFilter($this);
                $detailTbl->setCurrentMasterTable($this->TableVar);
                $detailFilter = $detailTbl->applyUserIDFilters($detailFilter);
                $detailTbl->Count = $detailTbl->loadRecordCount($detailFilter);
                $body .= "&nbsp;" . str_replace("%c", Container("jdh_chief_complaints")->Count, $Language->phrase("DetailCount"));
            }
            $body = "<a class=\"btn btn-default ew-row-link ew-detail" . ($this->ListOptions->UseDropDownButton ? " dropdown-toggle" : "") . "\" data-action=\"list\" href=\"" . HtmlEncode("jdhchiefcomplaintslist?" . Config("TABLE_SHOW_MASTER") . "=jdh_patients&" . GetForeignKeyUrl("fk_patient_id", $this->patient_id->CurrentValue) . "") . "\">" . $body . "</a>";
            $links = "";
            $detailPage = Container("JdhChiefComplaintsGrid");
            if ($detailPage->DetailView && $Security->canView() && $this->showOptionLink("view") && $Security->allowView(CurrentProjectID() . 'jdh_patients')) {
                $caption = $Language->phrase("MasterDetailViewLink", null);
                $url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=jdh_chief_complaints");
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a></li>";
                if ($detailViewTblVar != "") {
                    $detailViewTblVar .= ",";
                }
                $detailViewTblVar .= "jdh_chief_complaints";
            }
            if ($detailPage->DetailEdit && $Security->canEdit() && $this->showOptionLink("edit") && $Security->allowEdit(CurrentProjectID() . 'jdh_patients')) {
                $caption = $Language->phrase("MasterDetailEditLink", null);
                $url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=jdh_chief_complaints");
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a></li>";
                if ($detailEditTblVar != "") {
                    $detailEditTblVar .= ",";
                }
                $detailEditTblVar .= "jdh_chief_complaints";
            }
            if ($links != "") {
                $body .= "<button type=\"button\" class=\"dropdown-toggle btn btn-default ew-detail\" data-bs-toggle=\"dropdown\"></button>";
                $body .= "<ul class=\"dropdown-menu\">" . $links . "</ul>";
            } else {
                $body = preg_replace('/\b\s+dropdown-toggle\b/', "", $body);
            }
            $body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
            $opt->Body = $body;
            if ($this->ShowMultipleDetails) {
                $opt->Visible = false;
            }
        }

        // "detail_jdh_examination_findings"
        $opt = $this->ListOptions["detail_jdh_examination_findings"];
        if ($Security->allowList(CurrentProjectID() . 'jdh_examination_findings') && $this->showOptionLink()) {
            $body = $Language->phrase("DetailLink") . $Language->TablePhrase("jdh_examination_findings", "TblCaption");
            if (!$this->ShowMultipleDetails) { // Skip loading record count if show multiple details
                $detailTbl = Container("jdh_examination_findings");
                $detailFilter = $detailTbl->getDetailFilter($this);
                $detailTbl->setCurrentMasterTable($this->TableVar);
                $detailFilter = $detailTbl->applyUserIDFilters($detailFilter);
                $detailTbl->Count = $detailTbl->loadRecordCount($detailFilter);
                $body .= "&nbsp;" . str_replace("%c", Container("jdh_examination_findings")->Count, $Language->phrase("DetailCount"));
            }
            $body = "<a class=\"btn btn-default ew-row-link ew-detail" . ($this->ListOptions->UseDropDownButton ? " dropdown-toggle" : "") . "\" data-action=\"list\" href=\"" . HtmlEncode("jdhexaminationfindingslist?" . Config("TABLE_SHOW_MASTER") . "=jdh_patients&" . GetForeignKeyUrl("fk_patient_id", $this->patient_id->CurrentValue) . "") . "\">" . $body . "</a>";
            $links = "";
            $detailPage = Container("JdhExaminationFindingsGrid");
            if ($detailPage->DetailView && $Security->canView() && $this->showOptionLink("view") && $Security->allowView(CurrentProjectID() . 'jdh_patients')) {
                $caption = $Language->phrase("MasterDetailViewLink", null);
                $url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=jdh_examination_findings");
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a></li>";
                if ($detailViewTblVar != "") {
                    $detailViewTblVar .= ",";
                }
                $detailViewTblVar .= "jdh_examination_findings";
            }
            if ($detailPage->DetailEdit && $Security->canEdit() && $this->showOptionLink("edit") && $Security->allowEdit(CurrentProjectID() . 'jdh_patients')) {
                $caption = $Language->phrase("MasterDetailEditLink", null);
                $url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=jdh_examination_findings");
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a></li>";
                if ($detailEditTblVar != "") {
                    $detailEditTblVar .= ",";
                }
                $detailEditTblVar .= "jdh_examination_findings";
            }
            if ($links != "") {
                $body .= "<button type=\"button\" class=\"dropdown-toggle btn btn-default ew-detail\" data-bs-toggle=\"dropdown\"></button>";
                $body .= "<ul class=\"dropdown-menu\">" . $links . "</ul>";
            } else {
                $body = preg_replace('/\b\s+dropdown-toggle\b/', "", $body);
            }
            $body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
            $opt->Body = $body;
            if ($this->ShowMultipleDetails) {
                $opt->Visible = false;
            }
        }

        // "detail_jdh_prescriptions"
        $opt = $this->ListOptions["detail_jdh_prescriptions"];
        if ($Security->allowList(CurrentProjectID() . 'jdh_prescriptions') && $this->showOptionLink()) {
            $body = $Language->phrase("DetailLink") . $Language->TablePhrase("jdh_prescriptions", "TblCaption");
            if (!$this->ShowMultipleDetails) { // Skip loading record count if show multiple details
                $detailTbl = Container("jdh_prescriptions");
                $detailFilter = $detailTbl->getDetailFilter($this);
                $detailTbl->setCurrentMasterTable($this->TableVar);
                $detailFilter = $detailTbl->applyUserIDFilters($detailFilter);
                $detailTbl->Count = $detailTbl->loadRecordCount($detailFilter);
                $body .= "&nbsp;" . str_replace("%c", Container("jdh_prescriptions")->Count, $Language->phrase("DetailCount"));
            }
            $body = "<a class=\"btn btn-default ew-row-link ew-detail" . ($this->ListOptions->UseDropDownButton ? " dropdown-toggle" : "") . "\" data-action=\"list\" href=\"" . HtmlEncode("jdhprescriptionslist?" . Config("TABLE_SHOW_MASTER") . "=jdh_patients&" . GetForeignKeyUrl("fk_patient_id", $this->patient_id->CurrentValue) . "") . "\">" . $body . "</a>";
            $links = "";
            $detailPage = Container("JdhPrescriptionsGrid");
            if ($detailPage->DetailView && $Security->canView() && $this->showOptionLink("view") && $Security->allowView(CurrentProjectID() . 'jdh_patients')) {
                $caption = $Language->phrase("MasterDetailViewLink", null);
                $url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=jdh_prescriptions");
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a></li>";
                if ($detailViewTblVar != "") {
                    $detailViewTblVar .= ",";
                }
                $detailViewTblVar .= "jdh_prescriptions";
            }
            if ($detailPage->DetailEdit && $Security->canEdit() && $this->showOptionLink("edit") && $Security->allowEdit(CurrentProjectID() . 'jdh_patients')) {
                $caption = $Language->phrase("MasterDetailEditLink", null);
                $url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=jdh_prescriptions");
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a></li>";
                if ($detailEditTblVar != "") {
                    $detailEditTblVar .= ",";
                }
                $detailEditTblVar .= "jdh_prescriptions";
            }
            if ($links != "") {
                $body .= "<button type=\"button\" class=\"dropdown-toggle btn btn-default ew-detail\" data-bs-toggle=\"dropdown\"></button>";
                $body .= "<ul class=\"dropdown-menu\">" . $links . "</ul>";
            } else {
                $body = preg_replace('/\b\s+dropdown-toggle\b/', "", $body);
            }
            $body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
            $opt->Body = $body;
            if ($this->ShowMultipleDetails) {
                $opt->Visible = false;
            }
        }

        // "detail_jdh_test_requests"
        $opt = $this->ListOptions["detail_jdh_test_requests"];
        if ($Security->allowList(CurrentProjectID() . 'jdh_test_requests') && $this->showOptionLink()) {
            $body = $Language->phrase("DetailLink") . $Language->TablePhrase("jdh_test_requests", "TblCaption");
            if (!$this->ShowMultipleDetails) { // Skip loading record count if show multiple details
                $detailTbl = Container("jdh_test_requests");
                $detailFilter = $detailTbl->getDetailFilter($this);
                $detailTbl->setCurrentMasterTable($this->TableVar);
                $detailFilter = $detailTbl->applyUserIDFilters($detailFilter);
                $detailTbl->Count = $detailTbl->loadRecordCount($detailFilter);
                $body .= "&nbsp;" . str_replace("%c", Container("jdh_test_requests")->Count, $Language->phrase("DetailCount"));
            }
            $body = "<a class=\"btn btn-default ew-row-link ew-detail" . ($this->ListOptions->UseDropDownButton ? " dropdown-toggle" : "") . "\" data-action=\"list\" href=\"" . HtmlEncode("jdhtestrequestslist?" . Config("TABLE_SHOW_MASTER") . "=jdh_patients&" . GetForeignKeyUrl("fk_patient_id", $this->patient_id->CurrentValue) . "") . "\">" . $body . "</a>";
            $links = "";
            $detailPage = Container("JdhTestRequestsGrid");
            if ($detailPage->DetailView && $Security->canView() && $this->showOptionLink("view") && $Security->allowView(CurrentProjectID() . 'jdh_patients')) {
                $caption = $Language->phrase("MasterDetailViewLink", null);
                $url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=jdh_test_requests");
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a></li>";
                if ($detailViewTblVar != "") {
                    $detailViewTblVar .= ",";
                }
                $detailViewTblVar .= "jdh_test_requests";
            }
            if ($detailPage->DetailEdit && $Security->canEdit() && $this->showOptionLink("edit") && $Security->allowEdit(CurrentProjectID() . 'jdh_patients')) {
                $caption = $Language->phrase("MasterDetailEditLink", null);
                $url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=jdh_test_requests");
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a></li>";
                if ($detailEditTblVar != "") {
                    $detailEditTblVar .= ",";
                }
                $detailEditTblVar .= "jdh_test_requests";
            }
            if ($links != "") {
                $body .= "<button type=\"button\" class=\"dropdown-toggle btn btn-default ew-detail\" data-bs-toggle=\"dropdown\"></button>";
                $body .= "<ul class=\"dropdown-menu\">" . $links . "</ul>";
            } else {
                $body = preg_replace('/\b\s+dropdown-toggle\b/', "", $body);
            }
            $body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
            $opt->Body = $body;
            if ($this->ShowMultipleDetails) {
                $opt->Visible = false;
            }
        }

        // "detail_jdh_test_reports"
        $opt = $this->ListOptions["detail_jdh_test_reports"];
        if ($Security->allowList(CurrentProjectID() . 'jdh_test_reports') && $this->showOptionLink()) {
            $body = $Language->phrase("DetailLink") . $Language->TablePhrase("jdh_test_reports", "TblCaption");
            if (!$this->ShowMultipleDetails) { // Skip loading record count if show multiple details
                $detailTbl = Container("jdh_test_reports");
                $detailFilter = $detailTbl->getDetailFilter($this);
                $detailTbl->setCurrentMasterTable($this->TableVar);
                $detailFilter = $detailTbl->applyUserIDFilters($detailFilter);
                $detailTbl->Count = $detailTbl->loadRecordCount($detailFilter);
                $body .= "&nbsp;" . str_replace("%c", Container("jdh_test_reports")->Count, $Language->phrase("DetailCount"));
            }
            $body = "<a class=\"btn btn-default ew-row-link ew-detail" . ($this->ListOptions->UseDropDownButton ? " dropdown-toggle" : "") . "\" data-action=\"list\" href=\"" . HtmlEncode("jdhtestreportslist?" . Config("TABLE_SHOW_MASTER") . "=jdh_patients&" . GetForeignKeyUrl("fk_patient_id", $this->patient_id->CurrentValue) . "") . "\">" . $body . "</a>";
            $links = "";
            $detailPage = Container("JdhTestReportsGrid");
            if ($detailPage->DetailView && $Security->canView() && $this->showOptionLink("view") && $Security->allowView(CurrentProjectID() . 'jdh_patients')) {
                $caption = $Language->phrase("MasterDetailViewLink", null);
                $url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=jdh_test_reports");
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a></li>";
                if ($detailViewTblVar != "") {
                    $detailViewTblVar .= ",";
                }
                $detailViewTblVar .= "jdh_test_reports";
            }
            if ($detailPage->DetailEdit && $Security->canEdit() && $this->showOptionLink("edit") && $Security->allowEdit(CurrentProjectID() . 'jdh_patients')) {
                $caption = $Language->phrase("MasterDetailEditLink", null);
                $url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=jdh_test_reports");
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a></li>";
                if ($detailEditTblVar != "") {
                    $detailEditTblVar .= ",";
                }
                $detailEditTblVar .= "jdh_test_reports";
            }
            if ($links != "") {
                $body .= "<button type=\"button\" class=\"dropdown-toggle btn btn-default ew-detail\" data-bs-toggle=\"dropdown\"></button>";
                $body .= "<ul class=\"dropdown-menu\">" . $links . "</ul>";
            } else {
                $body = preg_replace('/\b\s+dropdown-toggle\b/', "", $body);
            }
            $body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
            $opt->Body = $body;
            if ($this->ShowMultipleDetails) {
                $opt->Visible = false;
            }
        }

        // "detail_jdh_prescriptions_actions"
        $opt = $this->ListOptions["detail_jdh_prescriptions_actions"];
        if ($Security->allowList(CurrentProjectID() . 'jdh_prescriptions_actions') && $this->showOptionLink()) {
            $body = $Language->phrase("DetailLink") . $Language->TablePhrase("jdh_prescriptions_actions", "TblCaption");
            if (!$this->ShowMultipleDetails) { // Skip loading record count if show multiple details
                $detailTbl = Container("jdh_prescriptions_actions");
                $detailFilter = $detailTbl->getDetailFilter($this);
                $detailTbl->setCurrentMasterTable($this->TableVar);
                $detailFilter = $detailTbl->applyUserIDFilters($detailFilter);
                $detailTbl->Count = $detailTbl->loadRecordCount($detailFilter);
                $body .= "&nbsp;" . str_replace("%c", Container("jdh_prescriptions_actions")->Count, $Language->phrase("DetailCount"));
            }
            $body = "<a class=\"btn btn-default ew-row-link ew-detail" . ($this->ListOptions->UseDropDownButton ? " dropdown-toggle" : "") . "\" data-action=\"list\" href=\"" . HtmlEncode("jdhprescriptionsactionslist?" . Config("TABLE_SHOW_MASTER") . "=jdh_patients&" . GetForeignKeyUrl("fk_patient_id", $this->patient_id->CurrentValue) . "") . "\">" . $body . "</a>";
            $links = "";
            $detailPage = Container("JdhPrescriptionsActionsGrid");
            if ($detailPage->DetailView && $Security->canView() && $this->showOptionLink("view") && $Security->allowView(CurrentProjectID() . 'jdh_patients')) {
                $caption = $Language->phrase("MasterDetailViewLink", null);
                $url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=jdh_prescriptions_actions");
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a></li>";
                if ($detailViewTblVar != "") {
                    $detailViewTblVar .= ",";
                }
                $detailViewTblVar .= "jdh_prescriptions_actions";
            }
            if ($detailPage->DetailEdit && $Security->canEdit() && $this->showOptionLink("edit") && $Security->allowEdit(CurrentProjectID() . 'jdh_patients')) {
                $caption = $Language->phrase("MasterDetailEditLink", null);
                $url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=jdh_prescriptions_actions");
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a></li>";
                if ($detailEditTblVar != "") {
                    $detailEditTblVar .= ",";
                }
                $detailEditTblVar .= "jdh_prescriptions_actions";
            }
            if ($links != "") {
                $body .= "<button type=\"button\" class=\"dropdown-toggle btn btn-default ew-detail\" data-bs-toggle=\"dropdown\"></button>";
                $body .= "<ul class=\"dropdown-menu\">" . $links . "</ul>";
            } else {
                $body = preg_replace('/\b\s+dropdown-toggle\b/', "", $body);
            }
            $body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
            $opt->Body = $body;
            if ($this->ShowMultipleDetails) {
                $opt->Visible = false;
            }
        }

        // "detail_jdh_patient_visits"
        $opt = $this->ListOptions["detail_jdh_patient_visits"];
        if ($Security->allowList(CurrentProjectID() . 'jdh_patient_visits') && $this->showOptionLink()) {
            $body = $Language->phrase("DetailLink") . $Language->TablePhrase("jdh_patient_visits", "TblCaption");
            if (!$this->ShowMultipleDetails) { // Skip loading record count if show multiple details
                $detailTbl = Container("jdh_patient_visits");
                $detailFilter = $detailTbl->getDetailFilter($this);
                $detailTbl->setCurrentMasterTable($this->TableVar);
                $detailFilter = $detailTbl->applyUserIDFilters($detailFilter);
                $detailTbl->Count = $detailTbl->loadRecordCount($detailFilter);
                $body .= "&nbsp;" . str_replace("%c", Container("jdh_patient_visits")->Count, $Language->phrase("DetailCount"));
            }
            $body = "<a class=\"btn btn-default ew-row-link ew-detail" . ($this->ListOptions->UseDropDownButton ? " dropdown-toggle" : "") . "\" data-action=\"list\" href=\"" . HtmlEncode("jdhpatientvisitslist?" . Config("TABLE_SHOW_MASTER") . "=jdh_patients&" . GetForeignKeyUrl("fk_patient_id", $this->patient_id->CurrentValue) . "") . "\">" . $body . "</a>";
            $links = "";
            $detailPage = Container("JdhPatientVisitsGrid");
            if ($detailPage->DetailView && $Security->canView() && $this->showOptionLink("view") && $Security->allowView(CurrentProjectID() . 'jdh_patients')) {
                $caption = $Language->phrase("MasterDetailViewLink", null);
                $url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=jdh_patient_visits");
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a></li>";
                if ($detailViewTblVar != "") {
                    $detailViewTblVar .= ",";
                }
                $detailViewTblVar .= "jdh_patient_visits";
            }
            if ($detailPage->DetailEdit && $Security->canEdit() && $this->showOptionLink("edit") && $Security->allowEdit(CurrentProjectID() . 'jdh_patients')) {
                $caption = $Language->phrase("MasterDetailEditLink", null);
                $url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=jdh_patient_visits");
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a></li>";
                if ($detailEditTblVar != "") {
                    $detailEditTblVar .= ",";
                }
                $detailEditTblVar .= "jdh_patient_visits";
            }
            if ($links != "") {
                $body .= "<button type=\"button\" class=\"dropdown-toggle btn btn-default ew-detail\" data-bs-toggle=\"dropdown\"></button>";
                $body .= "<ul class=\"dropdown-menu\">" . $links . "</ul>";
            } else {
                $body = preg_replace('/\b\s+dropdown-toggle\b/', "", $body);
            }
            $body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
            $opt->Body = $body;
            if ($this->ShowMultipleDetails) {
                $opt->Visible = false;
            }
        }
        if ($this->ShowMultipleDetails) {
            $body = "<div class=\"btn-group btn-group-sm ew-btn-group\">";
            $links = "";
            if ($detailViewTblVar != "") {
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlEncode($Language->phrase("MasterDetailViewLink", true)) . "\" href=\"" . HtmlEncode($this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=" . $detailViewTblVar)) . "\">" . $Language->phrase("MasterDetailViewLink", null) . "</a></li>";
            }
            if ($detailEditTblVar != "") {
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlEncode($Language->phrase("MasterDetailEditLink", true)) . "\" href=\"" . HtmlEncode($this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=" . $detailEditTblVar)) . "\">" . $Language->phrase("MasterDetailEditLink", null) . "</a></li>";
            }
            if ($detailCopyTblVar != "") {
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-copy\" data-action=\"add\" data-caption=\"" . HtmlEncode($Language->phrase("MasterDetailCopyLink", true)) . "\" href=\"" . HtmlEncode($this->GetCopyUrl(Config("TABLE_SHOW_DETAIL") . "=" . $detailCopyTblVar)) . "\">" . $Language->phrase("MasterDetailCopyLink", null) . "</a></li>";
            }
            if ($links != "") {
                $body .= "<button type=\"button\" class=\"dropdown-toggle btn btn-default ew-master-detail\" title=\"" . HtmlEncode($Language->phrase("MultipleMasterDetails", true)) . "\" data-bs-toggle=\"dropdown\">" . $Language->phrase("MultipleMasterDetails") . "</button>";
                $body .= "<ul class=\"dropdown-menu ew-dropdown-menu\">" . $links . "</ul>";
            }
            $body .= "</div>";
            // Multiple details
            $opt = $this->ListOptions["details"];
            $opt->Body = $body;
        }

        // "checkbox"
        $opt = $this->ListOptions["checkbox"];
        $opt->Body = "<div class=\"form-check\"><input type=\"checkbox\" id=\"key_m_" . $this->RowCount . "\" name=\"key_m[]\" class=\"form-check-input ew-multi-select\" value=\"" . HtmlEncode($this->patient_id->CurrentValue) . "\" data-ew-action=\"select-key\"></div>";
        $this->renderListOptionsExt();

        // Call ListOptions_Rendered event
        $this->listOptionsRendered();
    }

    // Render list options (extensions)
    protected function renderListOptionsExt()
    {
        // Render list options (to be implemented by extensions)
        global $Security, $Language;
    }

    // Set up other options
    protected function setupOtherOptions()
    {
        global $Language, $Security;
        $options = &$this->OtherOptions;
        $option = $options["addedit"];

        // Add
        $item = &$option->add("add");
        $addcaption = HtmlTitle($Language->phrase("AddLink"));
        if ($this->ModalAdd && !IsMobile()) {
            $item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-table=\"jdh_patients\" data-caption=\"" . $addcaption . "\" data-ew-action=\"modal\" data-action=\"add\" data-ajax=\"" . ($this->UseAjaxActions ? "true" : "false") . "\" data-url=\"" . HtmlEncode(GetUrl($this->AddUrl)) . "\" data-btn=\"AddBtn\">" . $Language->phrase("AddLink") . "</a>";
        } else {
            $item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode(GetUrl($this->AddUrl)) . "\">" . $Language->phrase("AddLink") . "</a>";
        }
        $item->Visible = $this->AddUrl != "" && $Security->canAdd();
        $option = $options["detail"];
        $detailTableLink = "";
                $item = &$option->add("detailadd_jdh_appointments");
                $url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=jdh_appointments");
                $detailPage = Container("JdhAppointmentsGrid");
                $caption = $Language->phrase("Add") . "&nbsp;" . $this->tableCaption() . "/" . $detailPage->tableCaption();
                $item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode(GetUrl($url)) . "\">" . $caption . "</a>";
                $item->Visible = ($detailPage->DetailAdd && $Security->allowAdd(CurrentProjectID() . 'jdh_patients') && $Security->canAdd());
                if ($item->Visible) {
                    if ($detailTableLink != "") {
                        $detailTableLink .= ",";
                    }
                    $detailTableLink .= "jdh_appointments";
                }
                $item = &$option->add("detailadd_jdh_patient_cases");
                $url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=jdh_patient_cases");
                $detailPage = Container("JdhPatientCasesGrid");
                $caption = $Language->phrase("Add") . "&nbsp;" . $this->tableCaption() . "/" . $detailPage->tableCaption();
                $item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode(GetUrl($url)) . "\">" . $caption . "</a>";
                $item->Visible = ($detailPage->DetailAdd && $Security->allowAdd(CurrentProjectID() . 'jdh_patients') && $Security->canAdd());
                if ($item->Visible) {
                    if ($detailTableLink != "") {
                        $detailTableLink .= ",";
                    }
                    $detailTableLink .= "jdh_patient_cases";
                }
                $item = &$option->add("detailadd_jdh_vitals");
                $url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=jdh_vitals");
                $detailPage = Container("JdhVitalsGrid");
                $caption = $Language->phrase("Add") . "&nbsp;" . $this->tableCaption() . "/" . $detailPage->tableCaption();
                $item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode(GetUrl($url)) . "\">" . $caption . "</a>";
                $item->Visible = ($detailPage->DetailAdd && $Security->allowAdd(CurrentProjectID() . 'jdh_patients') && $Security->canAdd());
                if ($item->Visible) {
                    if ($detailTableLink != "") {
                        $detailTableLink .= ",";
                    }
                    $detailTableLink .= "jdh_vitals";
                }
                $item = &$option->add("detailadd_jdh_chief_complaints");
                $url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=jdh_chief_complaints");
                $detailPage = Container("JdhChiefComplaintsGrid");
                $caption = $Language->phrase("Add") . "&nbsp;" . $this->tableCaption() . "/" . $detailPage->tableCaption();
                $item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode(GetUrl($url)) . "\">" . $caption . "</a>";
                $item->Visible = ($detailPage->DetailAdd && $Security->allowAdd(CurrentProjectID() . 'jdh_patients') && $Security->canAdd());
                if ($item->Visible) {
                    if ($detailTableLink != "") {
                        $detailTableLink .= ",";
                    }
                    $detailTableLink .= "jdh_chief_complaints";
                }
                $item = &$option->add("detailadd_jdh_examination_findings");
                $url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=jdh_examination_findings");
                $detailPage = Container("JdhExaminationFindingsGrid");
                $caption = $Language->phrase("Add") . "&nbsp;" . $this->tableCaption() . "/" . $detailPage->tableCaption();
                $item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode(GetUrl($url)) . "\">" . $caption . "</a>";
                $item->Visible = ($detailPage->DetailAdd && $Security->allowAdd(CurrentProjectID() . 'jdh_patients') && $Security->canAdd());
                if ($item->Visible) {
                    if ($detailTableLink != "") {
                        $detailTableLink .= ",";
                    }
                    $detailTableLink .= "jdh_examination_findings";
                }
                $item = &$option->add("detailadd_jdh_prescriptions");
                $url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=jdh_prescriptions");
                $detailPage = Container("JdhPrescriptionsGrid");
                $caption = $Language->phrase("Add") . "&nbsp;" . $this->tableCaption() . "/" . $detailPage->tableCaption();
                $item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode(GetUrl($url)) . "\">" . $caption . "</a>";
                $item->Visible = ($detailPage->DetailAdd && $Security->allowAdd(CurrentProjectID() . 'jdh_patients') && $Security->canAdd());
                if ($item->Visible) {
                    if ($detailTableLink != "") {
                        $detailTableLink .= ",";
                    }
                    $detailTableLink .= "jdh_prescriptions";
                }
                $item = &$option->add("detailadd_jdh_test_requests");
                $url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=jdh_test_requests");
                $detailPage = Container("JdhTestRequestsGrid");
                $caption = $Language->phrase("Add") . "&nbsp;" . $this->tableCaption() . "/" . $detailPage->tableCaption();
                $item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode(GetUrl($url)) . "\">" . $caption . "</a>";
                $item->Visible = ($detailPage->DetailAdd && $Security->allowAdd(CurrentProjectID() . 'jdh_patients') && $Security->canAdd());
                if ($item->Visible) {
                    if ($detailTableLink != "") {
                        $detailTableLink .= ",";
                    }
                    $detailTableLink .= "jdh_test_requests";
                }
                $item = &$option->add("detailadd_jdh_test_reports");
                $url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=jdh_test_reports");
                $detailPage = Container("JdhTestReportsGrid");
                $caption = $Language->phrase("Add") . "&nbsp;" . $this->tableCaption() . "/" . $detailPage->tableCaption();
                $item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode(GetUrl($url)) . "\">" . $caption . "</a>";
                $item->Visible = ($detailPage->DetailAdd && $Security->allowAdd(CurrentProjectID() . 'jdh_patients') && $Security->canAdd());
                if ($item->Visible) {
                    if ($detailTableLink != "") {
                        $detailTableLink .= ",";
                    }
                    $detailTableLink .= "jdh_test_reports";
                }
                $item = &$option->add("detailadd_jdh_prescriptions_actions");
                $url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=jdh_prescriptions_actions");
                $detailPage = Container("JdhPrescriptionsActionsGrid");
                $caption = $Language->phrase("Add") . "&nbsp;" . $this->tableCaption() . "/" . $detailPage->tableCaption();
                $item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode(GetUrl($url)) . "\">" . $caption . "</a>";
                $item->Visible = ($detailPage->DetailAdd && $Security->allowAdd(CurrentProjectID() . 'jdh_patients') && $Security->canAdd());
                if ($item->Visible) {
                    if ($detailTableLink != "") {
                        $detailTableLink .= ",";
                    }
                    $detailTableLink .= "jdh_prescriptions_actions";
                }
                $item = &$option->add("detailadd_jdh_patient_visits");
                $url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=jdh_patient_visits");
                $detailPage = Container("JdhPatientVisitsGrid");
                $caption = $Language->phrase("Add") . "&nbsp;" . $this->tableCaption() . "/" . $detailPage->tableCaption();
                $item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode(GetUrl($url)) . "\">" . $caption . "</a>";
                $item->Visible = ($detailPage->DetailAdd && $Security->allowAdd(CurrentProjectID() . 'jdh_patients') && $Security->canAdd());
                if ($item->Visible) {
                    if ($detailTableLink != "") {
                        $detailTableLink .= ",";
                    }
                    $detailTableLink .= "jdh_patient_visits";
                }

        // Add multiple details
        if ($this->ShowMultipleDetails) {
            $item = &$option->add("detailsadd");
            $url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=" . $detailTableLink);
            $caption = $Language->phrase("AddMasterDetailLink");
            $item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode(GetUrl($url)) . "\">" . $caption . "</a>";
            $item->Visible = $detailTableLink != "" && $Security->canAdd();
            // Hide single master/detail items
            $ar = explode(",", $detailTableLink);
            $cnt = count($ar);
            for ($i = 0; $i < $cnt; $i++) {
                if ($item = $option["detailadd_" . $ar[$i]]) {
                    $item->Visible = false;
                }
            }
        }
        $option = $options["action"];

        // Add multi delete
        $item = &$option->add("multidelete");
        $item->Body = "<button type=\"button\" class=\"ew-action ew-multi-delete\" title=\"" .
            HtmlTitle($Language->phrase("DeleteSelectedLink")) . "\" data-caption=\"" .
            HtmlTitle($Language->phrase("DeleteSelectedLink")) . "\" form=\"fjdh_patientslist\"" .
            " data-ew-action=\"" . ($this->UseAjaxActions ? "inline" : "submit") . "\"" .
            ($this->UseAjaxActions ? " data-action=\"delete\"" : "") .
            " data-url=\"" . GetUrl($this->MultiDeleteUrl) . "\"" .
            ($this->InlineDelete ? " data-msg=\"" . HtmlEncode($Language->phrase("DeleteConfirm")) . "\" data-data='{\"action\":\"delete\"}'" : " data-data='{\"action\":\"show\"}'") .
            ">" . $Language->phrase("DeleteSelectedLink") . "</button>";
        $item->Visible = $Security->canDelete();

        // Show column list for column visibility
        if ($this->UseColumnVisibility) {
            $option = $this->OtherOptions["column"];
            $item = &$option->addGroupOption();
            $item->Body = "";
            $item->Visible = $this->UseColumnVisibility;
            $option->add("patient_id", $this->createColumnOption("patient_id"));
            $option->add("patient_name", $this->createColumnOption("patient_name"));
            $option->add("patient_national_id", $this->createColumnOption("patient_national_id"));
            $option->add("patient_dob", $this->createColumnOption("patient_dob"));
            $option->add("patient_age", $this->createColumnOption("patient_age"));
            $option->add("patient_gender", $this->createColumnOption("patient_gender"));
            $option->add("patient_phone", $this->createColumnOption("patient_phone"));
            $option->add("service_id", $this->createColumnOption("service_id"));
            $option->add("patient_registration_date", $this->createColumnOption("patient_registration_date"));
            $option->add("submitted_by_user_id", $this->createColumnOption("submitted_by_user_id"));
        }

        // Set up options default
        foreach ($options as $name => $option) {
            if ($name != "column") { // Always use dropdown for column
                $option->UseDropDownButton = false;
                $option->UseButtonGroup = true;
            }
            //$option->ButtonClass = ""; // Class for button group
            $item = &$option->addGroupOption();
            $item->Body = "";
            $item->Visible = false;
        }
        $options["addedit"]->DropDownButtonPhrase = $Language->phrase("ButtonAddEdit");
        $options["detail"]->DropDownButtonPhrase = $Language->phrase("ButtonDetails");
        $options["action"]->DropDownButtonPhrase = $Language->phrase("ButtonActions");

        // Filter button
        $item = &$this->FilterOptions->add("savecurrentfilter");
        $item->Body = "<a class=\"ew-save-filter\" data-form=\"fjdh_patientssrch\" data-ew-action=\"none\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
        $item->Visible = true;
        $item = &$this->FilterOptions->add("deletefilter");
        $item->Body = "<a class=\"ew-delete-filter\" data-form=\"fjdh_patientssrch\" data-ew-action=\"none\">" . $Language->phrase("DeleteFilter") . "</a>";
        $item->Visible = true;
        $this->FilterOptions->UseDropDownButton = true;
        $this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton;
        $this->FilterOptions->DropDownButtonPhrase = $Language->phrase("Filters");

        // Add group option item
        $item = &$this->FilterOptions->addGroupOption();
        $item->Body = "";
        $item->Visible = false;
    }

    // Create new column option
    public function createColumnOption($name)
    {
        $field = $this->Fields[$name] ?? false;
        if ($field && $field->Visible) {
            $item = new ListOption($field->Name);
            $item->Body = '<button class="dropdown-item">' .
                '<div class="form-check ew-dropdown-checkbox">' .
                '<div class="form-check-input ew-dropdown-check-input" data-field="' . $field->Param . '"></div>' .
                '<label class="form-check-label ew-dropdown-check-label">' . $field->caption() . '</label></div></button>';
            return $item;
        }
        return null;
    }

    // Render other options
    public function renderOtherOptions()
    {
        global $Language, $Security;
        $options = &$this->OtherOptions;
        $option = $options["action"];
        // Set up list action buttons
        foreach ($this->ListActions->Items as $listaction) {
            if ($listaction->Select == ACTION_MULTIPLE) {
                $item = &$option->add("custom_" . $listaction->Action);
                $caption = $listaction->Caption;
                $icon = ($listaction->Icon != "") ? '<i class="' . HtmlEncode($listaction->Icon) . '" data-caption="' . HtmlEncode($caption) . '"></i>' . $caption : $caption;
                $item->Body = '<button type="button" class="btn btn-default ew-action ew-list-action" title="' . HtmlEncode($caption) . '" data-caption="' . HtmlEncode($caption) . '" data-ew-action="submit" form="fjdh_patientslist"' . $listaction->toDataAttrs() . '>' . $icon . '</button>';
                $item->Visible = $listaction->Allow;
            }
        }

        // Hide multi edit, grid edit and other options
        if ($this->TotalRecords <= 0) {
            $option = $options["addedit"];
            $item = $option["gridedit"];
            if ($item) {
                $item->Visible = false;
            }
            $option = $options["action"];
            $option->hideAllOptions();
        }
    }

    // Process list action
    protected function processListAction()
    {
        global $Language, $Security, $Response;
        $userlist = "";
        $user = "";
        $filter = $this->getFilterFromRecordKeys();
        $userAction = Post("action", "");
        if ($filter != "" && $userAction != "") {
            // Check permission first
            $actionCaption = $userAction;
            if (array_key_exists($userAction, $this->ListActions->Items)) {
                if (array_key_exists($userAction, $this->CustomActions)) {
                    $this->UserAction = $userAction;
                }
                $actionCaption = $this->ListActions[$userAction]->Caption;
                if (!$this->ListActions[$userAction]->Allow) {
                    $errmsg = str_replace('%s', $actionCaption, $Language->phrase("CustomActionNotAllowed"));
                    if (Post("ajax") == $userAction) { // Ajax
                        echo "<p class=\"text-danger\">" . $errmsg . "</p>";
                        return true;
                    } else {
                        $this->setFailureMessage($errmsg);
                        return false;
                    }
                }
            }
            $this->CurrentFilter = $filter;
            $sql = $this->getCurrentSql();
            $conn = $this->getConnection();
            $rs = LoadRecordset($sql, $conn);
            $this->ActionValue = Post("actionvalue");

            // Call row action event
            if ($rs) {
                if ($this->UseTransaction) {
                    $conn->beginTransaction();
                }
                $this->SelectedCount = $rs->recordCount();
                $this->SelectedIndex = 0;
                while (!$rs->EOF) {
                    $this->SelectedIndex++;
                    $row = $rs->fields;
                    $processed = $this->rowCustomAction($userAction, $row);
                    if (!$processed) {
                        break;
                    }
                    $rs->moveNext();
                }
                if ($processed) {
                    if ($this->UseTransaction) { // Commit transaction
                        $conn->commit();
                    }
                    if ($this->getSuccessMessage() == "" && !ob_get_length() && !$Response->getBody()->getSize()) { // No output
                        $this->setSuccessMessage(str_replace('%s', $actionCaption, $Language->phrase("CustomActionCompleted"))); // Set up success message
                    }
                } else {
                    if ($this->UseTransaction) { // Rollback transaction
                        $conn->rollback();
                    }

                    // Set up error message
                    if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                        // Use the message, do nothing
                    } elseif ($this->CancelMessage != "") {
                        $this->setFailureMessage($this->CancelMessage);
                        $this->CancelMessage = "";
                    } else {
                        $this->setFailureMessage(str_replace('%s', $actionCaption, $Language->phrase("CustomActionFailed")));
                    }
                }
            }
            if ($rs) {
                $rs->close();
            }
            if (Post("ajax") == $userAction) { // Ajax
                if ($this->getSuccessMessage() != "") {
                    echo "<p class=\"text-success\">" . $this->getSuccessMessage() . "</p>";
                    $this->clearSuccessMessage(); // Clear message
                }
                if ($this->getFailureMessage() != "") {
                    echo "<p class=\"text-danger\">" . $this->getFailureMessage() . "</p>";
                    $this->clearFailureMessage(); // Clear message
                }
                return true;
            }
        }
        return false; // Not ajax request
    }

    // Set up Grid
    public function setupGrid()
    {
        global $CurrentForm;
        if ($this->ExportAll && $this->isExport()) {
            $this->StopRecord = $this->TotalRecords;
        } else {
            // Set the last record to display
            if ($this->TotalRecords > $this->StartRecord + $this->DisplayRecords - 1) {
                $this->StopRecord = $this->StartRecord + $this->DisplayRecords - 1;
            } else {
                $this->StopRecord = $this->TotalRecords;
            }
        }
        $this->RecordCount = $this->StartRecord - 1;
        if ($this->Recordset && !$this->Recordset->EOF) {
            // Nothing to do
        } elseif ($this->isGridAdd() && !$this->AllowAddDeleteRow && $this->StopRecord == 0) { // Grid-Add with no records
            $this->StopRecord = $this->GridAddRowCount;
        } elseif ($this->isAdd() && $this->TotalRecords == 0) { // Inline-Add with no records
            $this->StopRecord = 1;
        }

        // Initialize aggregate
        $this->RowType = ROWTYPE_AGGREGATEINIT;
        $this->resetAttributes();
        $this->renderRow();
        if (($this->isGridAdd() || $this->isGridEdit())) { // Render template row first
            $this->RowIndex = '$rowindex$';
        }
    }

    // Set up Row
    public function setupRow()
    {
        global $CurrentForm;
        if (($this->isGridAdd() || $this->isGridEdit())) {
            if ($this->RowIndex === '$rowindex$') { // Render template row first
                $this->loadRowValues();

                // Set row properties
                $this->resetAttributes();
                $this->RowAttrs->merge(["data-rowindex" => $this->RowIndex, "id" => "r0_jdh_patients", "data-rowtype" => ROWTYPE_ADD]);
                $this->RowAttrs->appendClass("ew-template");
                // Render row
                $this->RowType = ROWTYPE_ADD;
                $this->renderRow();

                // Render list options
                $this->renderListOptions();

                // Reset record count for template row
                $this->RecordCount--;
                return;
            }
        }

        // Set up key count
        $this->KeyCount = $this->RowIndex;

        // Init row class and style
        $this->resetAttributes();
        $this->CssClass = "";
        if ($this->isCopy() && $this->InlineRowCount == 0 && !$this->loadRow()) { // Inline copy
            $this->CurrentAction = "add";
        }
        if ($this->isAdd() && $this->InlineRowCount == 0 || $this->isGridAdd()) {
            $this->loadRowValues(); // Load default values
            $this->OldKey = "";
            $this->setKey($this->OldKey);
        } elseif ($this->isInlineInserted() && $this->UseInfiniteScroll) {
            // Nothing to do, just use current values
        } elseif (!($this->isCopy() && $this->InlineRowCount == 0)) {
            $this->loadRowValues($this->Recordset); // Load row values
            if ($this->isGridEdit() || $this->isMultiEdit()) {
                $this->OldKey = $this->getKey(true); // Get from CurrentValue
                $this->setKey($this->OldKey);
            }
        }
        $this->RowType = ROWTYPE_VIEW; // Render view
        if (($this->isAdd() || $this->isCopy()) && $this->InlineRowCount == 0 || $this->isGridAdd()) { // Add
            $this->RowType = ROWTYPE_ADD; // Render add
        }

        // Inline Add/Copy row (row 0)
        if ($this->RowType == ROWTYPE_ADD && ($this->isAdd() || $this->isCopy())) {
            $this->InlineRowCount++;
            $this->RecordCount--; // Reset record count for inline add/copy row
            if ($this->TotalRecords == 0) { // Reset stop record if no records
                $this->StopRecord = 0;
            }
        } else {
            // Inline Edit row
            if ($this->RowType == ROWTYPE_EDIT && $this->isEdit()) {
                $this->InlineRowCount++;
            }
            $this->RowCount++; // Increment row count
        }

        // Set up row attributes
        $this->RowAttrs->merge([
            "data-rowindex" => $this->RowCount,
            "data-key" => $this->getKey(true),
            "id" => "r" . $this->RowCount . "_jdh_patients",
            "data-rowtype" => $this->RowType,
            "class" => ($this->RowCount % 2 != 1) ? "ew-table-alt-row" : "",
        ]);
        if ($this->isAdd() && $this->RowType == ROWTYPE_ADD || $this->isEdit() && $this->RowType == ROWTYPE_EDIT) { // Inline-Add/Edit row
            $this->RowAttrs->appendClass("table-active");
        }

        // Render row
        $this->renderRow();

        // Render list options
        $this->renderListOptions();
    }

    // Load basic search values
    protected function loadBasicSearchValues()
    {
        $this->BasicSearch->setKeyword(Get(Config("TABLE_BASIC_SEARCH"), ""), false);
        if ($this->BasicSearch->Keyword != "" && $this->Command == "") {
            $this->Command = "search";
        }
        $this->BasicSearch->setType(Get(Config("TABLE_BASIC_SEARCH_TYPE"), ""), false);
    }

    // Load recordset
    public function loadRecordset($offset = -1, $rowcnt = -1)
    {
        // Load List page SQL (QueryBuilder)
        $sql = $this->getListSql();

        // Load recordset
        if ($offset > -1) {
            $sql->setFirstResult($offset);
        }
        if ($rowcnt > 0) {
            $sql->setMaxResults($rowcnt);
        }
        $result = $sql->execute();
        $rs = new Recordset($result, $sql);

        // Call Recordset Selected event
        $this->recordsetSelected($rs);
        return $rs;
    }

    // Load records as associative array
    public function loadRows($offset = -1, $rowcnt = -1)
    {
        // Load List page SQL (QueryBuilder)
        $sql = $this->getListSql();

        // Load recordset
        if ($offset > -1) {
            $sql->setFirstResult($offset);
        }
        if ($rowcnt > 0) {
            $sql->setMaxResults($rowcnt);
        }
        $result = $sql->execute();
        return $result->fetchAllAssociative();
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
        $this->patient_name->setDbValue($row['patient_name']);
        $this->patient_national_id->setDbValue($row['patient_national_id']);
        $this->patient_dob->setDbValue($row['patient_dob']);
        $this->patient_age->setDbValue($row['patient_age']);
        $this->patient_gender->setDbValue($row['patient_gender']);
        $this->patient_phone->setDbValue($row['patient_phone']);
        $this->patient_kin_name->setDbValue($row['patient_kin_name']);
        $this->patient_kin_phone->setDbValue($row['patient_kin_phone']);
        $this->service_id->setDbValue($row['service_id']);
        $this->patient_registration_date->setDbValue($row['patient_registration_date']);
        $this->submitted_by_user_id->setDbValue($row['submitted_by_user_id']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['patient_id'] = $this->patient_id->DefaultValue;
        $row['photo'] = $this->photo->DefaultValue;
        $row['patient_name'] = $this->patient_name->DefaultValue;
        $row['patient_national_id'] = $this->patient_national_id->DefaultValue;
        $row['patient_dob'] = $this->patient_dob->DefaultValue;
        $row['patient_age'] = $this->patient_age->DefaultValue;
        $row['patient_gender'] = $this->patient_gender->DefaultValue;
        $row['patient_phone'] = $this->patient_phone->DefaultValue;
        $row['patient_kin_name'] = $this->patient_kin_name->DefaultValue;
        $row['patient_kin_phone'] = $this->patient_kin_phone->DefaultValue;
        $row['service_id'] = $this->service_id->DefaultValue;
        $row['patient_registration_date'] = $this->patient_registration_date->DefaultValue;
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
        $this->ViewUrl = $this->getViewUrl();
        $this->EditUrl = $this->getEditUrl();
        $this->InlineEditUrl = $this->getInlineEditUrl();
        $this->CopyUrl = $this->getCopyUrl();
        $this->InlineCopyUrl = $this->getInlineCopyUrl();
        $this->DeleteUrl = $this->getDeleteUrl();

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // patient_id

        // photo

        // patient_name

        // patient_national_id

        // patient_dob

        // patient_age

        // patient_gender

        // patient_phone

        // patient_kin_name

        // patient_kin_phone

        // service_id

        // patient_registration_date

        // submitted_by_user_id

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // patient_id
            $this->patient_id->ViewValue = $this->patient_id->CurrentValue;

            // patient_name
            $this->patient_name->ViewValue = $this->patient_name->CurrentValue;

            // patient_national_id
            $this->patient_national_id->ViewValue = $this->patient_national_id->CurrentValue;

            // patient_dob
            $this->patient_dob->ViewValue = $this->patient_dob->CurrentValue;
            $this->patient_dob->ViewValue = FormatDateTime($this->patient_dob->ViewValue, $this->patient_dob->formatPattern());

            // patient_age
            $this->patient_age->ViewValue = $this->patient_age->CurrentValue;
            $this->patient_age->ViewValue = FormatNumber($this->patient_age->ViewValue, $this->patient_age->formatPattern());

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

            // service_id
            $curVal = strval($this->service_id->CurrentValue);
            if ($curVal != "") {
                $this->service_id->ViewValue = $this->service_id->lookupCacheOption($curVal);
                if ($this->service_id->ViewValue === null) { // Lookup from database
                    $filterWrk = SearchFilter("`service_id`", "=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = $this->service_id->getSelectFilter($this); // PHP
                    $sqlWrk = $this->service_id->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->service_id->Lookup->renderViewRow($rswrk[0]);
                        $this->service_id->ViewValue = $this->service_id->displayValue($arwrk);
                    } else {
                        $this->service_id->ViewValue = FormatNumber($this->service_id->CurrentValue, $this->service_id->formatPattern());
                    }
                }
            } else {
                $this->service_id->ViewValue = null;
            }

            // patient_registration_date
            $this->patient_registration_date->ViewValue = $this->patient_registration_date->CurrentValue;
            $this->patient_registration_date->ViewValue = FormatDateTime($this->patient_registration_date->ViewValue, $this->patient_registration_date->formatPattern());

            // submitted_by_user_id
            $this->submitted_by_user_id->ViewValue = $this->submitted_by_user_id->CurrentValue;
            $this->submitted_by_user_id->ViewValue = FormatNumber($this->submitted_by_user_id->ViewValue, $this->submitted_by_user_id->formatPattern());

            // patient_id
            $this->patient_id->HrefValue = "";
            $this->patient_id->TooltipValue = "";

            // patient_name
            $this->patient_name->HrefValue = "";
            $this->patient_name->TooltipValue = "";
            if (!$this->isExport()) {
                $this->patient_name->ViewValue = $this->highlightValue($this->patient_name);
            }

            // patient_national_id
            $this->patient_national_id->HrefValue = "";
            $this->patient_national_id->TooltipValue = "";
            if (!$this->isExport()) {
                $this->patient_national_id->ViewValue = $this->highlightValue($this->patient_national_id);
            }

            // patient_dob
            $this->patient_dob->HrefValue = "";
            $this->patient_dob->TooltipValue = "";

            // patient_age
            $this->patient_age->HrefValue = "";
            $this->patient_age->TooltipValue = "";

            // patient_gender
            $this->patient_gender->HrefValue = "";
            $this->patient_gender->TooltipValue = "";

            // patient_phone
            $this->patient_phone->HrefValue = "";
            $this->patient_phone->TooltipValue = "";
            if (!$this->isExport()) {
                $this->patient_phone->ViewValue = $this->highlightValue($this->patient_phone);
            }

            // service_id
            $this->service_id->HrefValue = "";
            $this->service_id->TooltipValue = "";

            // patient_registration_date
            $this->patient_registration_date->HrefValue = "";
            $this->patient_registration_date->TooltipValue = "";

            // submitted_by_user_id
            $this->submitted_by_user_id->HrefValue = "";
            $this->submitted_by_user_id->TooltipValue = "";
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }
    }

    /**
     * Import file
     *
     * @param string $filetoken File token to locate the uploaded import file
     * @param bool $rollback Try import and then rollback
     * @return bool
     */
    public function import($filetoken, $rollback = false)
    {
        global $Security, $Language;
        if (!$Security->canImport()) {
            return false; // Import not allowed
        }

        // Check if valid token
        if (EmptyValue($filetoken)) {
            return false;
        }

        // Get uploaded files by token
        $files = GetUploadedFileNames($filetoken);
        $exts = explode(",", Config("IMPORT_FILE_ALLOWED_EXTENSIONS"));
        $result = [Config("API_FILE_TOKEN_NAME") => $filetoken, "files" => []];

        // Set header
        if (ob_get_length()) {
            ob_clean();
        }
        header("Cache-Control: no-store");
        header("Content-Type: text/event-stream");

        // Import records
        try {
            foreach ($files as $file) {
                $res = ["file" => basename($file)];
                $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

                // Ignore log file
                if ($ext == "txt") {
                    continue;
                }

                // Check file extension
                if (!in_array($ext, $exts)) {
                    $res = array_merge($res, ["error" => str_replace("%e", $ext, $Language->phrase("ImportInvalidFileExtension"))]);
                    SendEvent($res, "error");
                    return false;
                }

                // Set up options
                $options = [
                    "file" => $file,
                    "inputEncoding" => "", // For CSV only
                    "delimiter" => ",", // For CSV only
                    "enclosure" => "\"", // For CSV only
                    "escape" => "\\", // For CSV only
                    "activeSheet" => null, // For PhpSpreadsheet only
                    "readOnly" => true, // For PhpSpreadsheet only
                    "maxRows" => null, // For PhpSpreadsheet only
                    "headerRowNumber" => 0,
                    "headers" => []
                ];
                foreach ($_GET as $key => $value) {
                    if (!in_array($key, [Config("API_ACTION_NAME"), Config("API_FILE_TOKEN_NAME")])) {
                        $options[$key] = $value;
                    }
                }

                // Workflow builder
                $builder = fn($workflow) => $workflow;

                // Call Page Importing server event
                if (!$this->pageImporting($builder, $options)) {
                    SendEvent($res, "error");
                    return false;
                }

                // Set max execution time
                if (Config("IMPORT_MAX_EXECUTION_TIME") > 0) {
                    ini_set("max_execution_time", Config("IMPORT_MAX_EXECUTION_TIME"));
                }

                // Reader
                try {
                    if ($ext == "csv") {
                        $csv = file_get_contents($file);
                        if ($csv !== false) {
                            if (StartsString("\xEF\xBB\xBF", $csv)) { // UTF-8 BOM
                                $csv = substr($csv, 3);
                            } elseif ($options["inputEncoding"] != "" && !SameText($options["inputEncoding"], "UTF-8")) {
                                $csv = Convert($options["inputEncoding"], "UTF-8", $csv);
                            }
                            file_put_contents($file, $csv);
                        }
                        $reader = new \Port\Csv\CsvReader(new \SplFileObject($file), $options["delimiter"], $options["enclosure"], $options["escape"]);
                    } else {
                        $reader = new \Port\Spreadsheet\SpreadsheetReader(new \SplFileObject($file), $options["headerRowNumber"], $options["activeSheet"], $options["readOnly"], $options["maxRows"]);
                    }
                    if (is_array($options["headers"]) && count($options["headers"]) > 0) {
                        $reader->setColumnHeaders($options["headers"]);
                    } elseif (is_int($options["headerRowNumber"])) {
                        $reader->setHeaderRowNumber($options["headerRowNumber"]);
                    }
                } catch (\Exception $e) {
                    $res = array_merge($res, ["error" => $e->getMessage()]);
                    SendEvent($res, "error");
                    return false;
                }

                // Column headers
                $headers = $reader->getColumnHeaders();
                if (count($headers) == 0) { // Missing headers
                    $res["error"] = $Language->phrase("ImportNoHeaderRow");
                    SendEvent($res, "error");
                    return false;
                }

                // Counts
                $recordCnt = $reader->count();
                $cnt = 0;
                $successCnt = 0;
                $failCnt = 0;
                $res = array_merge($res, ["totalCount" => $recordCnt, "count" => $cnt, "successCount" => 0, "failCount" => 0]);

                // Writer
                $writer = new \Port\Writer\CallbackWriter(function ($row) use (&$res, &$cnt, &$successCnt, &$failCnt) {
                    try {
                        $success = $this->importRow($row, ++$cnt); // Import row
                        if ($success) {
                            $successCnt++;
                        } else {
                            $failCnt++;
                        }
                        $err = "";
                    } catch (\Port\Exception $e) { // Catch exception so the workflow continues
                        $failCnt++;
                        $err = $e->getMessage();
                        if ($failCnt > $this->ImportMaxFailures) {
                            throw $e; // Throw \Port\Exception to terminate the workflow
                        }
                    } finally {
                        $res = array_merge($res, [
                            "row" => $row, // Current row
                            "success" => $success, // For current row
                            "error" => $err, // For current row
                            "count" => $cnt,
                            "successCount" => $successCnt,
                            "failCount" => $failCnt
                        ]);
                        SendEvent($res);
                    }
                });

                // Connection
                $conn = $this->getConnection();

                // Begin transaction
                if ($this->ImportUseTransaction) {
                    $conn->beginTransaction();
                }

                // Workflow
                $workflow = new \Port\Steps\StepAggregator($reader);
                $workflow->setLogger(Logger());
                $workflow->setSkipItemOnFailure(false); // Stop on exception
                $workflow = $builder($workflow);
                try {
                    $info = @$workflow->addWriter($writer)->process();
                } finally {
                    // Rollback transaction
                    if ($this->ImportUseTransaction) {
                        if ($rollback || $failCnt > $this->ImportMaxFailures) {
                            $res["rollbacked"] = $conn->rollback();
                        } else {
                            $conn->commit();
                        }
                    }
                    unset($res["row"], $res["error"]); // Remove current row info
                    $res["success"] = $cnt > 0 && $failCnt <= $this->ImportMaxFailures; // Set success status of current file
                    SendEvent($res); // Current file imported
                    $result["files"][] = $res;

                    // Call Page Imported server event
                    $this->pageImported($info, $res);
                }
            }
        } finally {
            $result["failCount"] = array_reduce($result["files"], fn($carry, $item) => $carry + $item["failCount"], 0); // For client side
            $result["success"] = array_reduce($result["files"], fn($carry, $item) => $carry && $item["success"], true); // All files successful
            $result["rollbacked"] = array_reduce($result["files"], fn($carry, $item) => $carry && $item["success"] && ($item["rollbacked"] ?? false), true); // All file rollbacked successfully
            if ($result["success"] && !$result["rollbacked"]) {
                CleanUploadTempPaths($filetoken);
            }
            SendEvent($result, "complete"); // All files imported
            return $result["success"];
        }
    }

    /**
     * Import a row
     *
     * @param array $row Row to be imported
     * @param int $cnt Index of the row (1-based)
     * @return bool
     */
    protected function importRow(&$row, $cnt)
    {
        global $Language;

        // Call Row Import server event
        if (!$this->rowImport($row, $cnt)) {
            return false;
        }

        // Check field names and values
        foreach ($row as $name => $value) {
            $fld = $this->Fields[$name];
            if (!$fld) {
                throw new \Port\Exception\UnexpectedValueException(str_replace("%f", $name, $Language->phrase("ImportInvalidFieldName")));
            }
            if (!$this->checkValue($fld, $value)) {
                throw new \Port\Exception\UnexpectedValueException(str_replace(["%f", "%v"], [$name, $value], $Language->phrase("ImportInvalidFieldValue")));
            }
        }

        // Insert/Update to database
        $res = false;
        if (!$this->ImportInsertOnly && $oldrow = $this->load($row)) {
            if (!method_exists($this, "rowUpdating") || $this->rowUpdating($oldrow, $row)) {
                if ($res = $this->update($row, "", $oldrow)) {
                    if (method_exists($this, "rowUpdated")) {
                        $this->rowUpdated($oldrow, $row);
                    }
                }
            }
        } else {
            if (!method_exists($this, "rowInserting") || $this->rowInserting(null, $row)) {
                if ($res = $this->insert($row)) {
                    if (method_exists($this, "rowInserted")) {
                        $this->rowInserted(null, $row);
                    }
                }
            }
        }
        return $res;
    }

    /**
     * Check field value
     *
     * @param object $fld Field object
     * @param object $value
     * @return bool
     */
    protected function checkValue($fld, $value)
    {
        if ($fld->DataType == DATATYPE_NUMBER && !is_numeric($value)) {
            return false;
        } elseif ($fld->DataType == DATATYPE_DATE && !CheckDate($value, $fld->formatPattern())) {
            return false;
        }
        return true;
    }

    // Load row
    protected function load($row)
    {
        $filter = $this->getRecordFilter($row);
        if (!$filter) {
            return null;
        }
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        return $conn->fetchAssociative($sql);
    }

    // Get export HTML tag
    protected function getExportTag($type, $custom = false)
    {
        global $Language;
        if ($type == "print" || $custom) { // Printer friendly / custom export
            $pageUrl = $this->pageUrl(false);
            $exportUrl = GetUrl($pageUrl . "export=" . $type . ($custom ? "&amp;custom=1" : ""));
        } else { // Export API URL
            $exportUrl = GetApiUrl(Config("API_EXPORT_ACTION") . "/" . $type . "/" . $this->TableVar);
        }
        if (SameText($type, "excel")) {
            if ($custom) {
                return "<button type=\"button\" class=\"btn btn-default ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcel", true)) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcel", true)) . "\" form=\"fjdh_patientslist\" data-url=\"$exportUrl\" data-ew-action=\"export\" data-export=\"excel\" data-custom=\"true\" data-export-selected=\"false\">" . $Language->phrase("ExportToExcel") . "</button>";
            } else {
                return "<a href=\"$exportUrl\" class=\"btn btn-default ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcel", true)) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcel", true)) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
            }
        } elseif (SameText($type, "word")) {
            if ($custom) {
                return "<button type=\"button\" class=\"btn btn-default ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWord", true)) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWord", true)) . "\" form=\"fjdh_patientslist\" data-url=\"$exportUrl\" data-ew-action=\"export\" data-export=\"word\" data-custom=\"true\" data-export-selected=\"false\">" . $Language->phrase("ExportToWord") . "</button>";
            } else {
                return "<a href=\"$exportUrl\" class=\"btn btn-default ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWord", true)) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWord", true)) . "\">" . $Language->phrase("ExportToWord") . "</a>";
            }
        } elseif (SameText($type, "pdf")) {
            if ($custom) {
                return "<button type=\"button\" class=\"btn btn-default ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPdf", true)) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPdf", true)) . "\" form=\"fjdh_patientslist\" data-url=\"$exportUrl\" data-ew-action=\"export\" data-export=\"pdf\" data-custom=\"true\" data-export-selected=\"false\">" . $Language->phrase("ExportToPdf") . "</button>";
            } else {
                return "<a href=\"$exportUrl\" class=\"btn btn-default ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPdf", true)) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPdf", true)) . "\">" . $Language->phrase("ExportToPdf") . "</a>";
            }
        } elseif (SameText($type, "html")) {
            return "<a href=\"$exportUrl\" class=\"btn btn-default ew-export-link ew-html\" title=\"" . HtmlEncode($Language->phrase("ExportToHtml", true)) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToHtml", true)) . "\">" . $Language->phrase("ExportToHtml") . "</a>";
        } elseif (SameText($type, "xml")) {
            return "<a href=\"$exportUrl\" class=\"btn btn-default ew-export-link ew-xml\" title=\"" . HtmlEncode($Language->phrase("ExportToXml", true)) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToXml", true)) . "\">" . $Language->phrase("ExportToXml") . "</a>";
        } elseif (SameText($type, "csv")) {
            return "<a href=\"$exportUrl\" class=\"btn btn-default ew-export-link ew-csv\" title=\"" . HtmlEncode($Language->phrase("ExportToCsv", true)) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToCsv", true)) . "\">" . $Language->phrase("ExportToCsv") . "</a>";
        } elseif (SameText($type, "email")) {
            $url = $custom ? ' data-url="' . $exportUrl . '"' : '';
            return '<button type="button" class="btn btn-default ew-export-link ew-email" title="' . $Language->phrase("ExportToEmail", true) . '" data-caption="' . $Language->phrase("ExportToEmail", true) . '" form="fjdh_patientslist" data-ew-action="email" data-custom="false" data-hdr="' . $Language->phrase("ExportToEmail", true) . '" data-exported-selected="false"' . $url . '>' . $Language->phrase("ExportToEmail") . '</button>';
        } elseif (SameText($type, "print")) {
            return "<a href=\"$exportUrl\" class=\"btn btn-default ew-export-link ew-print\" title=\"" . HtmlEncode($Language->phrase("PrinterFriendly", true)) . "\" data-caption=\"" . HtmlEncode($Language->phrase("PrinterFriendly", true)) . "\">" . $Language->phrase("PrinterFriendly") . "</a>";
        }
    }

    // Set up export options
    protected function setupExportOptions()
    {
        global $Language, $Security;

        // Printer friendly
        $item = &$this->ExportOptions->add("print");
        $item->Body = $this->getExportTag("print");
        $item->Visible = true;

        // Export to Excel
        $item = &$this->ExportOptions->add("excel");
        $item->Body = $this->getExportTag("excel");
        $item->Visible = true;

        // Export to Word
        $item = &$this->ExportOptions->add("word");
        $item->Body = $this->getExportTag("word");
        $item->Visible = false;

        // Export to HTML
        $item = &$this->ExportOptions->add("html");
        $item->Body = $this->getExportTag("html");
        $item->Visible = true;

        // Export to XML
        $item = &$this->ExportOptions->add("xml");
        $item->Body = $this->getExportTag("xml");
        $item->Visible = false;

        // Export to CSV
        $item = &$this->ExportOptions->add("csv");
        $item->Body = $this->getExportTag("csv");
        $item->Visible = false;

        // Export to PDF
        $item = &$this->ExportOptions->add("pdf");
        $item->Body = $this->getExportTag("pdf");
        $item->Visible = false;

        // Export to Email
        $item = &$this->ExportOptions->add("email");
        $item->Body = $this->getExportTag("email");
        $item->Visible = true;

        // Drop down button for export
        $this->ExportOptions->UseButtonGroup = true;
        $this->ExportOptions->UseDropDownButton = true;
        if ($this->ExportOptions->UseButtonGroup && IsMobile()) {
            $this->ExportOptions->UseDropDownButton = true;
        }
        $this->ExportOptions->DropDownButtonPhrase = $Language->phrase("ButtonExport");

        // Add group option item
        $item = &$this->ExportOptions->addGroupOption();
        $item->Body = "";
        $item->Visible = false;
        if (!$Security->canExport()) { // Export not allowed
            $this->ExportOptions->hideAllOptions();
        }
    }

    // Set up search options
    protected function setupSearchOptions()
    {
        global $Language, $Security;
        $pageUrl = $this->pageUrl(false);
        $this->SearchOptions = new ListOptions(["TagClassName" => "ew-search-option"]);

        // Search button
        $item = &$this->SearchOptions->add("searchtoggle");
        $searchToggleClass = ($this->SearchWhere != "") ? " active" : " active";
        $item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-ew-action=\"search-toggle\" data-form=\"fjdh_patientssrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
        $item->Visible = true;

        // Show all button
        $item = &$this->SearchOptions->add("showall");
        if ($this->UseCustomTemplate || !$this->UseAjaxActions) {
            $item->Body = "<a class=\"btn btn-default ew-show-all\" role=\"button\" title=\"" . $Language->phrase("ShowAll") . "\" data-caption=\"" . $Language->phrase("ShowAll") . "\" href=\"" . $pageUrl . "cmd=reset\">" . $Language->phrase("ShowAllBtn") . "</a>";
        } else {
            $item->Body = "<a class=\"btn btn-default ew-show-all\" role=\"button\" title=\"" . $Language->phrase("ShowAll") . "\" data-caption=\"" . $Language->phrase("ShowAll") . "\" data-ew-action=\"refresh\" data-url=\"" . $pageUrl . "cmd=reset\">" . $Language->phrase("ShowAllBtn") . "</a>";
        }
        $item->Visible = ($this->SearchWhere != $this->DefaultSearchWhere && $this->SearchWhere != "0=101");

        // Search highlight button
        $item = &$this->SearchOptions->add("searchhighlight");
        $item->Body = "<a class=\"btn btn-default ew-highlight active\" role=\"button\" title=\"" . $Language->phrase("Highlight") . "\" data-caption=\"" . $Language->phrase("Highlight") . "\" data-ew-action=\"highlight\" data-form=\"fjdh_patientssrch\" data-name=\"" . $this->highlightName() . "\">" . $Language->phrase("HighlightBtn") . "</a>";
        $item->Visible = ($this->SearchWhere != "" && $this->TotalRecords > 0);

        // Button group for search
        $this->SearchOptions->UseDropDownButton = false;
        $this->SearchOptions->UseButtonGroup = true;
        $this->SearchOptions->DropDownButtonPhrase = $Language->phrase("ButtonSearch");

        // Add group option item
        $item = &$this->SearchOptions->addGroupOption();
        $item->Body = "";
        $item->Visible = false;

        // Hide search options
        if ($this->isExport() || $this->CurrentAction && $this->CurrentAction != "search") {
            $this->SearchOptions->hideAllOptions();
        }
        if (!$Security->canSearch()) {
            $this->SearchOptions->hideAllOptions();
            $this->FilterOptions->hideAllOptions();
        }
    }

    // Check if any search fields
    public function hasSearchFields()
    {
        return true;
    }

    // Render search options
    protected function renderSearchOptions()
    {
        if (!$this->hasSearchFields() && $this->SearchOptions["searchtoggle"]) {
            $this->SearchOptions["searchtoggle"]->Visible = false;
        }
    }

    // Set up import options
    protected function setupImportOptions()
    {
        global $Security, $Language;

        // Import
        $item = &$this->ImportOptions->add("import");
        $item->Body = "<a class=\"ew-import-link ew-import\" role=\"button\" title=\"" . $Language->phrase("Import", true) . "\" data-caption=\"" . $Language->phrase("Import", true) . "\" data-ew-action=\"import\" data-hdr=\"" . $Language->phrase("Import", true) . "\">" . $Language->phrase("Import") . "</a>";
        $item->Visible = $Security->canImport();
        $this->ImportOptions->UseButtonGroup = true;
        $this->ImportOptions->UseDropDownButton = false;
        $this->ImportOptions->DropDownButtonPhrase = $Language->phrase("Import");

        // Add group option item
        $item = &$this->ImportOptions->addGroupOption();
        $item->Body = "";
        $item->Visible = false;
    }

    /**
    * Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
    *
    * @param bool $return Return the data rather than output it
    * @return mixed
    */
    public function exportData($doc)
    {
        global $Language;
        $utf8 = SameText(Config("PROJECT_CHARSET"), "utf-8");

        // Load recordset
        $this->TotalRecords = $this->listRecordCount();
        $this->StartRecord = 1;

        // Export all
        if ($this->ExportAll) {
            if (Config("EXPORT_ALL_TIME_LIMIT") >= 0) {
                @set_time_limit(Config("EXPORT_ALL_TIME_LIMIT"));
            }
            $this->DisplayRecords = $this->TotalRecords;
            $this->StopRecord = $this->TotalRecords;
        } else { // Export one page only
            $this->setupStartRecord(); // Set up start record position
            // Set the last record to display
            if ($this->DisplayRecords <= 0) {
                $this->StopRecord = $this->TotalRecords;
            } else {
                $this->StopRecord = $this->StartRecord + $this->DisplayRecords - 1;
            }
        }
        $rs = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords <= 0 ? $this->TotalRecords : $this->DisplayRecords);
        if (!$rs || !$doc) {
            RemoveHeader("Content-Type"); // Remove header
            RemoveHeader("Content-Disposition");
            $this->showMessage();
            return;
        }
        $this->StartRecord = 1;
        $this->StopRecord = $this->DisplayRecords <= 0 ? $this->TotalRecords : $this->DisplayRecords;

        // Call Page Exporting server event
        $doc->ExportCustom = !$this->pageExporting($doc);

        // Page header
        $header = $this->PageHeader;
        $this->pageDataRendering($header);
        $doc->Text .= $header;
        $this->exportDocument($doc, $rs, $this->StartRecord, $this->StopRecord, "");

        // Close recordset
        $rs->close();

        // Page footer
        $footer = $this->PageFooter;
        $this->pageDataRendered($footer);
        $doc->Text .= $footer;

        // Export header and footer
        $doc->exportHeaderAndFooter();

        // Call Page Exported server event
        $this->pageExported($doc);
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

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
        $Breadcrumb->add("list", $this->TableVar, $url, "", $this->TableVar, true);
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
                case "x_service_id":
                    $lookupFilter = $fld->getSelectFilter(); // PHP
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

    // Set up starting record parameters
    public function setupStartRecord()
    {
        if ($this->DisplayRecords == 0) {
            return;
        }
        $pageNo = Get(Config("TABLE_PAGE_NUMBER"));
        $startRec = Get(Config("TABLE_START_REC"));
        $infiniteScroll = ConvertToBool(Param("infinitescroll"));
        if ($pageNo !== null) { // Check for "pageno" parameter first
            $pageNo = ParseInteger($pageNo);
            if (is_numeric($pageNo)) {
                $this->StartRecord = ($pageNo - 1) * $this->DisplayRecords + 1;
                if ($this->StartRecord <= 0) {
                    $this->StartRecord = 1;
                } elseif ($this->StartRecord >= (int)(($this->TotalRecords - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1) {
                    $this->StartRecord = (int)(($this->TotalRecords - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1;
                }
            }
        } elseif ($startRec !== null && is_numeric($startRec)) { // Check for "start" parameter
            $this->StartRecord = $startRec;
        } elseif (!$infiniteScroll) {
            $this->StartRecord = $this->getStartRecordNumber();
        }

        // Check if correct start record counter
        if (!is_numeric($this->StartRecord) || intval($this->StartRecord) <= 0) { // Avoid invalid start record counter
            $this->StartRecord = 1; // Reset start record counter
        } elseif ($this->StartRecord > $this->TotalRecords) { // Avoid starting record > total records
            $this->StartRecord = (int)(($this->TotalRecords - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1; // Point to last page first record
        } elseif (($this->StartRecord - 1) % $this->DisplayRecords != 0) {
            $this->StartRecord = (int)(($this->StartRecord - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1; // Point to page boundary
        }
        if (!$infiniteScroll) {
            $this->setStartRecordNumber($this->StartRecord);
        }
    }

    // Get page count
    public function pageCount() {
        return ceil($this->TotalRecords / $this->DisplayRecords);
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

    // ListOptions Load event
    public function listOptionsLoad()
    {
        // Example:
        //$opt = &$this->ListOptions->Add("new");
        //$opt->Header = "xxx";
        //$opt->OnLeft = true; // Link on left
        //$opt->MoveTo(0); // Move to first column
    }

    // ListOptions Rendering event
    public function listOptionsRendering()
    {
        //Container("DetailTableGrid")->DetailAdd = (...condition...); // Set to true or false conditionally
        //Container("DetailTableGrid")->DetailEdit = (...condition...); // Set to true or false conditionally
        //Container("DetailTableGrid")->DetailView = (...condition...); // Set to true or false conditionally
    }

    // ListOptions Rendered event
    public function listOptionsRendered()
    {
        // Example:
        //$this->ListOptions["new"]->Body = "xxx";
    }

    // Row Custom Action event
    public function rowCustomAction($action, $row)
    {
        // Return false to abort
        return true;
    }

    // Page Exporting event
    // $doc = export object
    public function pageExporting(&$doc)
    {
        //$doc->Text = "my header"; // Export header
        //return false; // Return false to skip default export and use Row_Export event
        return true; // Return true to use default export and skip Row_Export event
    }

    // Row Export event
    // $doc = export document object
    public function rowExport($doc, $rs)
    {
        //$doc->Text .= "my content"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
    }

    // Page Exported event
    // $doc = export document object
    public function pageExported($doc)
    {
        //$doc->Text .= "my footer"; // Export footer
        //Log($doc->Text);
    }

    // Page Importing event
    public function pageImporting(&$builder, &$options)
    {
        //var_dump($options); // Show all options for importing
        //$builder = fn($workflow) => $workflow->addStep($myStep);
        //return false; // Return false to skip import
        return true;
    }

    // Row Import event
    public function rowImport(&$row, $cnt)
    {
        //Log($cnt); // Import record count
        //var_dump($row); // Import row
        //return false; // Return false to skip import
        return true;
    }

    // Page Imported event
    public function pageImported($obj, $results)
    {
        //var_dump($obj); // Workflow result object
        //var_dump($results); // Import results
    }
}
