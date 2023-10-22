<?php

namespace PHPMaker2023\jootidigitalhealthcare;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class JdhExportlogAdd extends JdhExportlog
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Page object name
    public $PageObjName = "JdhExportlogAdd";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // CSS class/style
    public $CurrentPageName = "jdhexportlogadd";

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
        $this->TableVar = 'jdh_exportlog';
        $this->TableName = 'jdh_exportlog';

        // Table CSS class
        $this->TableClass = "table table-striped table-bordered table-hover table-sm ew-desktop-table ew-add-table";

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("language");

        // Table object (jdh_exportlog)
        if (!isset($GLOBALS["jdh_exportlog"]) || get_class($GLOBALS["jdh_exportlog"]) == PROJECT_NAMESPACE . "jdh_exportlog") {
            $GLOBALS["jdh_exportlog"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'jdh_exportlog');
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
                    $result["view"] = $pageName == "jdhexportlogview"; // If View page, no primary button
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
            $key .= @$ar['FileId'];
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
        $this->FileId->setVisibility();
        $this->DateTime->setVisibility();
        $this->User->setVisibility();
        $this->_ExportType->setVisibility();
        $this->_Table->setVisibility();
        $this->KeyValue->setVisibility();
        $this->Filename->setVisibility();
        $this->__Request->setVisibility();

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
            if (($keyValue = Get("FileId") ?? Route("FileId")) !== null) {
                $this->FileId->setQueryStringValue($keyValue);
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
                    $this->terminate("jdhexportloglist"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "jdhexportloglist") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "jdhexportlogview") {
                        $returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
                    }

                    // Handle UseAjaxActions with return page
                    if ($this->UseAjaxActions && GetPageName($returnUrl) != "jdhexportloglist") {
                        Container("flash")->addMessage("Return-Url", $returnUrl); // Save return URL
                        $returnUrl = "jdhexportloglist"; // Return list page content
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

        // Check field name 'FileId' first before field var 'x_FileId'
        $val = $CurrentForm->hasValue("FileId") ? $CurrentForm->getValue("FileId") : $CurrentForm->getValue("x_FileId");
        if (!$this->FileId->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->FileId->Visible = false; // Disable update for API request
            } else {
                $this->FileId->setFormValue($val);
            }
        }

        // Check field name 'DateTime' first before field var 'x_DateTime'
        $val = $CurrentForm->hasValue("DateTime") ? $CurrentForm->getValue("DateTime") : $CurrentForm->getValue("x_DateTime");
        if (!$this->DateTime->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->DateTime->Visible = false; // Disable update for API request
            } else {
                $this->DateTime->setFormValue($val, true, $validate);
            }
            $this->DateTime->CurrentValue = UnFormatDateTime($this->DateTime->CurrentValue, $this->DateTime->formatPattern());
        }

        // Check field name 'User' first before field var 'x_User'
        $val = $CurrentForm->hasValue("User") ? $CurrentForm->getValue("User") : $CurrentForm->getValue("x_User");
        if (!$this->User->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->User->Visible = false; // Disable update for API request
            } else {
                $this->User->setFormValue($val);
            }
        }

        // Check field name 'ExportType' first before field var 'x__ExportType'
        $val = $CurrentForm->hasValue("ExportType") ? $CurrentForm->getValue("ExportType") : $CurrentForm->getValue("x__ExportType");
        if (!$this->_ExportType->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->_ExportType->Visible = false; // Disable update for API request
            } else {
                $this->_ExportType->setFormValue($val);
            }
        }

        // Check field name 'Table' first before field var 'x__Table'
        $val = $CurrentForm->hasValue("Table") ? $CurrentForm->getValue("Table") : $CurrentForm->getValue("x__Table");
        if (!$this->_Table->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->_Table->Visible = false; // Disable update for API request
            } else {
                $this->_Table->setFormValue($val);
            }
        }

        // Check field name 'KeyValue' first before field var 'x_KeyValue'
        $val = $CurrentForm->hasValue("KeyValue") ? $CurrentForm->getValue("KeyValue") : $CurrentForm->getValue("x_KeyValue");
        if (!$this->KeyValue->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->KeyValue->Visible = false; // Disable update for API request
            } else {
                $this->KeyValue->setFormValue($val);
            }
        }

        // Check field name 'Filename' first before field var 'x_Filename'
        $val = $CurrentForm->hasValue("Filename") ? $CurrentForm->getValue("Filename") : $CurrentForm->getValue("x_Filename");
        if (!$this->Filename->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Filename->Visible = false; // Disable update for API request
            } else {
                $this->Filename->setFormValue($val);
            }
        }

        // Check field name 'Request' first before field var 'x___Request'
        $val = $CurrentForm->hasValue("Request") ? $CurrentForm->getValue("Request") : $CurrentForm->getValue("x___Request");
        if (!$this->__Request->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->__Request->Visible = false; // Disable update for API request
            } else {
                $this->__Request->setFormValue($val);
            }
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->FileId->CurrentValue = $this->FileId->FormValue;
        $this->DateTime->CurrentValue = $this->DateTime->FormValue;
        $this->DateTime->CurrentValue = UnFormatDateTime($this->DateTime->CurrentValue, $this->DateTime->formatPattern());
        $this->User->CurrentValue = $this->User->FormValue;
        $this->_ExportType->CurrentValue = $this->_ExportType->FormValue;
        $this->_Table->CurrentValue = $this->_Table->FormValue;
        $this->KeyValue->CurrentValue = $this->KeyValue->FormValue;
        $this->Filename->CurrentValue = $this->Filename->FormValue;
        $this->__Request->CurrentValue = $this->__Request->FormValue;
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
        $this->FileId->setDbValue($row['FileId']);
        $this->DateTime->setDbValue($row['DateTime']);
        $this->User->setDbValue($row['User']);
        $this->_ExportType->setDbValue($row['ExportType']);
        $this->_Table->setDbValue($row['Table']);
        $this->KeyValue->setDbValue($row['KeyValue']);
        $this->Filename->setDbValue($row['Filename']);
        $this->__Request->setDbValue($row['Request']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['FileId'] = $this->FileId->DefaultValue;
        $row['DateTime'] = $this->DateTime->DefaultValue;
        $row['User'] = $this->User->DefaultValue;
        $row['ExportType'] = $this->_ExportType->DefaultValue;
        $row['Table'] = $this->_Table->DefaultValue;
        $row['KeyValue'] = $this->KeyValue->DefaultValue;
        $row['Filename'] = $this->Filename->DefaultValue;
        $row['Request'] = $this->__Request->DefaultValue;
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

        // FileId
        $this->FileId->RowCssClass = "row";

        // DateTime
        $this->DateTime->RowCssClass = "row";

        // User
        $this->User->RowCssClass = "row";

        // ExportType
        $this->_ExportType->RowCssClass = "row";

        // Table
        $this->_Table->RowCssClass = "row";

        // KeyValue
        $this->KeyValue->RowCssClass = "row";

        // Filename
        $this->Filename->RowCssClass = "row";

        // Request
        $this->__Request->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // FileId
            $this->FileId->ViewValue = $this->FileId->CurrentValue;

            // DateTime
            $this->DateTime->ViewValue = $this->DateTime->CurrentValue;
            $this->DateTime->ViewValue = FormatDateTime($this->DateTime->ViewValue, $this->DateTime->formatPattern());

            // User
            $this->User->ViewValue = $this->User->CurrentValue;

            // ExportType
            $this->_ExportType->ViewValue = $this->_ExportType->CurrentValue;

            // Table
            $this->_Table->ViewValue = $this->_Table->CurrentValue;

            // KeyValue
            $this->KeyValue->ViewValue = $this->KeyValue->CurrentValue;

            // Filename
            $this->Filename->ViewValue = $this->Filename->CurrentValue;

            // Request
            $this->__Request->ViewValue = $this->__Request->CurrentValue;

            // FileId
            $this->FileId->HrefValue = "";

            // DateTime
            $this->DateTime->HrefValue = "";

            // User
            $this->User->HrefValue = "";

            // ExportType
            $this->_ExportType->HrefValue = "";

            // Table
            $this->_Table->HrefValue = "";

            // KeyValue
            $this->KeyValue->HrefValue = "";

            // Filename
            $this->Filename->HrefValue = "";

            // Request
            $this->__Request->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // FileId
            $this->FileId->setupEditAttributes();
            if (!$this->FileId->Raw) {
                $this->FileId->CurrentValue = HtmlDecode($this->FileId->CurrentValue);
            }
            $this->FileId->EditValue = HtmlEncode($this->FileId->CurrentValue);
            $this->FileId->PlaceHolder = RemoveHtml($this->FileId->caption());

            // DateTime
            $this->DateTime->setupEditAttributes();
            $this->DateTime->EditValue = HtmlEncode(FormatDateTime($this->DateTime->CurrentValue, $this->DateTime->formatPattern()));
            $this->DateTime->PlaceHolder = RemoveHtml($this->DateTime->caption());

            // User
            $this->User->setupEditAttributes();
            if (!$this->User->Raw) {
                $this->User->CurrentValue = HtmlDecode($this->User->CurrentValue);
            }
            $this->User->EditValue = HtmlEncode($this->User->CurrentValue);
            $this->User->PlaceHolder = RemoveHtml($this->User->caption());

            // ExportType
            $this->_ExportType->setupEditAttributes();
            if (!$this->_ExportType->Raw) {
                $this->_ExportType->CurrentValue = HtmlDecode($this->_ExportType->CurrentValue);
            }
            $this->_ExportType->EditValue = HtmlEncode($this->_ExportType->CurrentValue);
            $this->_ExportType->PlaceHolder = RemoveHtml($this->_ExportType->caption());

            // Table
            $this->_Table->setupEditAttributes();
            if (!$this->_Table->Raw) {
                $this->_Table->CurrentValue = HtmlDecode($this->_Table->CurrentValue);
            }
            $this->_Table->EditValue = HtmlEncode($this->_Table->CurrentValue);
            $this->_Table->PlaceHolder = RemoveHtml($this->_Table->caption());

            // KeyValue
            $this->KeyValue->setupEditAttributes();
            if (!$this->KeyValue->Raw) {
                $this->KeyValue->CurrentValue = HtmlDecode($this->KeyValue->CurrentValue);
            }
            $this->KeyValue->EditValue = HtmlEncode($this->KeyValue->CurrentValue);
            $this->KeyValue->PlaceHolder = RemoveHtml($this->KeyValue->caption());

            // Filename
            $this->Filename->setupEditAttributes();
            if (!$this->Filename->Raw) {
                $this->Filename->CurrentValue = HtmlDecode($this->Filename->CurrentValue);
            }
            $this->Filename->EditValue = HtmlEncode($this->Filename->CurrentValue);
            $this->Filename->PlaceHolder = RemoveHtml($this->Filename->caption());

            // Request
            $this->__Request->setupEditAttributes();
            $this->__Request->EditValue = HtmlEncode($this->__Request->CurrentValue);
            $this->__Request->PlaceHolder = RemoveHtml($this->__Request->caption());

            // Add refer script

            // FileId
            $this->FileId->HrefValue = "";

            // DateTime
            $this->DateTime->HrefValue = "";

            // User
            $this->User->HrefValue = "";

            // ExportType
            $this->_ExportType->HrefValue = "";

            // Table
            $this->_Table->HrefValue = "";

            // KeyValue
            $this->KeyValue->HrefValue = "";

            // Filename
            $this->Filename->HrefValue = "";

            // Request
            $this->__Request->HrefValue = "";
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
        if ($this->FileId->Required) {
            if (!$this->FileId->IsDetailKey && EmptyValue($this->FileId->FormValue)) {
                $this->FileId->addErrorMessage(str_replace("%s", $this->FileId->caption(), $this->FileId->RequiredErrorMessage));
            }
        }
        if ($this->DateTime->Required) {
            if (!$this->DateTime->IsDetailKey && EmptyValue($this->DateTime->FormValue)) {
                $this->DateTime->addErrorMessage(str_replace("%s", $this->DateTime->caption(), $this->DateTime->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->DateTime->FormValue, $this->DateTime->formatPattern())) {
            $this->DateTime->addErrorMessage($this->DateTime->getErrorMessage(false));
        }
        if ($this->User->Required) {
            if (!$this->User->IsDetailKey && EmptyValue($this->User->FormValue)) {
                $this->User->addErrorMessage(str_replace("%s", $this->User->caption(), $this->User->RequiredErrorMessage));
            }
        }
        if ($this->_ExportType->Required) {
            if (!$this->_ExportType->IsDetailKey && EmptyValue($this->_ExportType->FormValue)) {
                $this->_ExportType->addErrorMessage(str_replace("%s", $this->_ExportType->caption(), $this->_ExportType->RequiredErrorMessage));
            }
        }
        if ($this->_Table->Required) {
            if (!$this->_Table->IsDetailKey && EmptyValue($this->_Table->FormValue)) {
                $this->_Table->addErrorMessage(str_replace("%s", $this->_Table->caption(), $this->_Table->RequiredErrorMessage));
            }
        }
        if ($this->KeyValue->Required) {
            if (!$this->KeyValue->IsDetailKey && EmptyValue($this->KeyValue->FormValue)) {
                $this->KeyValue->addErrorMessage(str_replace("%s", $this->KeyValue->caption(), $this->KeyValue->RequiredErrorMessage));
            }
        }
        if ($this->Filename->Required) {
            if (!$this->Filename->IsDetailKey && EmptyValue($this->Filename->FormValue)) {
                $this->Filename->addErrorMessage(str_replace("%s", $this->Filename->caption(), $this->Filename->RequiredErrorMessage));
            }
        }
        if ($this->__Request->Required) {
            if (!$this->__Request->IsDetailKey && EmptyValue($this->__Request->FormValue)) {
                $this->__Request->addErrorMessage(str_replace("%s", $this->__Request->caption(), $this->__Request->RequiredErrorMessage));
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

        // FileId
        $this->FileId->setDbValueDef($rsnew, $this->FileId->CurrentValue, "", false);

        // DateTime
        $this->DateTime->setDbValueDef($rsnew, UnFormatDateTime($this->DateTime->CurrentValue, $this->DateTime->formatPattern()), CurrentDate(), false);

        // User
        $this->User->setDbValueDef($rsnew, $this->User->CurrentValue, "", false);

        // ExportType
        $this->_ExportType->setDbValueDef($rsnew, $this->_ExportType->CurrentValue, "", false);

        // Table
        $this->_Table->setDbValueDef($rsnew, $this->_Table->CurrentValue, "", false);

        // KeyValue
        $this->KeyValue->setDbValueDef($rsnew, $this->KeyValue->CurrentValue, null, false);

        // Filename
        $this->Filename->setDbValueDef($rsnew, $this->Filename->CurrentValue, "", false);

        // Request
        $this->__Request->setDbValueDef($rsnew, $this->__Request->CurrentValue, "", false);

        // Update current values
        $this->setCurrentValues($rsnew);
        $conn = $this->getConnection();

        // Load db values from old row
        $this->loadDbValues($rsold);

        // Call Row Inserting event
        $insertRow = $this->rowInserting($rsold, $rsnew);

        // Check if key value entered
        if ($insertRow && $this->ValidateKey && strval($rsnew['FileId']) == "") {
            $this->setFailureMessage($Language->phrase("InvalidKeyValue"));
            $insertRow = false;
        }

        // Check for duplicate key
        if ($insertRow && $this->ValidateKey) {
            $filter = $this->getRecordFilter($rsnew);
            $rsChk = $this->loadRs($filter)->fetch();
            if ($rsChk !== false) {
                $keyErrMsg = str_replace("%f", $filter, $Language->phrase("DupKey"));
                $this->setFailureMessage($keyErrMsg);
                $insertRow = false;
            }
        }
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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("jdhexportloglist"), "", $this->TableVar, true);
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
