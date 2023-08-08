<?php

namespace PHPMaker2023\jootidigitalhealthcare;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class JdhInsuranceEdit extends JdhInsurance
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Page object name
    public $PageObjName = "JdhInsuranceEdit";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // CSS class/style
    public $CurrentPageName = "jdhinsuranceedit";

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
        $this->TableVar = 'jdh_insurance';
        $this->TableName = 'jdh_insurance';

        // Table CSS class
        $this->TableClass = "table table-striped table-bordered table-hover table-sm ew-desktop-table ew-edit-table";

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("language");

        // Table object (jdh_insurance)
        if (!isset($GLOBALS["jdh_insurance"]) || get_class($GLOBALS["jdh_insurance"]) == PROJECT_NAMESPACE . "jdh_insurance") {
            $GLOBALS["jdh_insurance"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'jdh_insurance');
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
                    $result["view"] = $pageName == "jdhinsuranceview"; // If View page, no primary button
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
            $key .= @$ar['insurance_id'];
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
            $this->insurance_id->Visible = false;
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

    // Properties
    public $FormClassName = "ew-form ew-edit-form overlay-wrapper";
    public $IsModal = false;
    public $IsMobileOrModal = false;
    public $DbMasterFilter;
    public $DbDetailFilter;
    public $HashValue; // Hash Value
    public $DisplayRecords = 1;
    public $StartRecord;
    public $StopRecord;
    public $TotalRecords = 0;
    public $RecordRange = 10;
    public $RecordCount;

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
        $this->insurance_id->setVisibility();
        $this->insurance_name->setVisibility();
        $this->insurance_contact_person->setVisibility();
        $this->insurance_contact_person_phone->setVisibility();
        $this->insurance_contact_person_email->setVisibility();
        $this->insurance_physical_address->setVisibility();
        $this->submission_date->Visible = false;
        $this->date_updated->Visible = false;
        $this->submitted_by_user_id->Visible = false;

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

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;
        $loaded = false;
        $postBack = false;

        // Set up current action and primary key
        if (IsApi()) {
            // Load key values
            $loaded = true;
            if (($keyValue = Get("insurance_id") ?? Key(0) ?? Route(2)) !== null) {
                $this->insurance_id->setQueryStringValue($keyValue);
                $this->insurance_id->setOldValue($this->insurance_id->QueryStringValue);
            } elseif (Post("insurance_id") !== null) {
                $this->insurance_id->setFormValue(Post("insurance_id"));
                $this->insurance_id->setOldValue($this->insurance_id->FormValue);
            } else {
                $loaded = false; // Unable to load key
            }

            // Load record
            if ($loaded) {
                $loaded = $this->loadRow();
            }
            if (!$loaded) {
                $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
                $this->terminate();
                return;
            }
            $this->CurrentAction = "update"; // Update record directly
            $this->OldKey = $this->getKey(true); // Get from CurrentValue
            $postBack = true;
        } else {
            if (Post("action") !== null) {
                $this->CurrentAction = Post("action"); // Get action code
                if (!$this->isShow()) { // Not reload record, handle as postback
                    $postBack = true;
                }

                // Get key from Form
                $this->setKey(Post($this->OldKeyName), $this->isShow());
            } else {
                $this->CurrentAction = "show"; // Default action is display

                // Load key from QueryString
                $loadByQuery = false;
                if (($keyValue = Get("insurance_id") ?? Route("insurance_id")) !== null) {
                    $this->insurance_id->setQueryStringValue($keyValue);
                    $loadByQuery = true;
                } else {
                    $this->insurance_id->CurrentValue = null;
                }
            }

            // Load recordset
            if ($this->isShow()) {
                    // Load current record
                    $loaded = $this->loadRow();
                $this->OldKey = $loaded ? $this->getKey(true) : ""; // Get from CurrentValue
            }
        }

        // Process form if post back
        if ($postBack) {
            $this->loadFormValues(); // Get form values
        }

        // Validate form if post back
        if ($postBack) {
            if (!$this->validateForm()) {
                $this->EventCancelled = true; // Event cancelled
                $this->restoreFormValues();
                if (IsApi()) {
                    $this->terminate();
                    return;
                } else {
                    $this->CurrentAction = ""; // Form error, reset action
                }
            }
        }

        // Perform current action
        switch ($this->CurrentAction) {
            case "show": // Get a record to display
                    if (!$loaded) { // Load record based on key
                        if ($this->getFailureMessage() == "") {
                            $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
                        }
                        $this->terminate("jdhinsurancelist"); // No matching record, return to list
                        return;
                    }
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "jdhinsurancelist") {
                    $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                }
                $this->SendEmail = true; // Send email on update success
                if ($this->editRow()) {
                    // Do not return Json for UseAjaxActions
                    if ($this->IsModal && $this->UseAjaxActions) {
                        $this->IsModal = false;
                    }

                    // Handle UseAjaxActions with return page
                    if ($this->UseAjaxActions && GetPageName($returnUrl) != "jdhinsurancelist") {
                        Container("flash")->addMessage("Return-Url", $returnUrl); // Save return URL
                        $returnUrl = "jdhinsurancelist"; // Return list page content
                    }
                    if ($this->getSuccessMessage() == "") {
                        $this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Update success
                    }
                    if (IsJsonResponse()) {
                        $this->terminate(true);
                        return;
                    } else {
                        $this->terminate($returnUrl); // Return to caller
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
                } elseif ($this->getFailureMessage() == $Language->phrase("NoRecord")) {
                    $this->terminate($returnUrl); // Return to caller
                    return;
                } else {
                    $this->EventCancelled = true; // Event cancelled
                    $this->restoreFormValues(); // Restore form values if update failed
                }
        }

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Render the record
        $this->RowType = ROWTYPE_EDIT; // Render as Edit
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

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;
        $validate = !Config("SERVER_VALIDATE");

        // Check field name 'insurance_id' first before field var 'x_insurance_id'
        $val = $CurrentForm->hasValue("insurance_id") ? $CurrentForm->getValue("insurance_id") : $CurrentForm->getValue("x_insurance_id");
        if (!$this->insurance_id->IsDetailKey) {
            $this->insurance_id->setFormValue($val);
        }

        // Check field name 'insurance_name' first before field var 'x_insurance_name'
        $val = $CurrentForm->hasValue("insurance_name") ? $CurrentForm->getValue("insurance_name") : $CurrentForm->getValue("x_insurance_name");
        if (!$this->insurance_name->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->insurance_name->Visible = false; // Disable update for API request
            } else {
                $this->insurance_name->setFormValue($val);
            }
        }

        // Check field name 'insurance_contact_person' first before field var 'x_insurance_contact_person'
        $val = $CurrentForm->hasValue("insurance_contact_person") ? $CurrentForm->getValue("insurance_contact_person") : $CurrentForm->getValue("x_insurance_contact_person");
        if (!$this->insurance_contact_person->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->insurance_contact_person->Visible = false; // Disable update for API request
            } else {
                $this->insurance_contact_person->setFormValue($val);
            }
        }

        // Check field name 'insurance_contact_person_phone' first before field var 'x_insurance_contact_person_phone'
        $val = $CurrentForm->hasValue("insurance_contact_person_phone") ? $CurrentForm->getValue("insurance_contact_person_phone") : $CurrentForm->getValue("x_insurance_contact_person_phone");
        if (!$this->insurance_contact_person_phone->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->insurance_contact_person_phone->Visible = false; // Disable update for API request
            } else {
                $this->insurance_contact_person_phone->setFormValue($val);
            }
        }

        // Check field name 'insurance_contact_person_email' first before field var 'x_insurance_contact_person_email'
        $val = $CurrentForm->hasValue("insurance_contact_person_email") ? $CurrentForm->getValue("insurance_contact_person_email") : $CurrentForm->getValue("x_insurance_contact_person_email");
        if (!$this->insurance_contact_person_email->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->insurance_contact_person_email->Visible = false; // Disable update for API request
            } else {
                $this->insurance_contact_person_email->setFormValue($val);
            }
        }

        // Check field name 'insurance_physical_address' first before field var 'x_insurance_physical_address'
        $val = $CurrentForm->hasValue("insurance_physical_address") ? $CurrentForm->getValue("insurance_physical_address") : $CurrentForm->getValue("x_insurance_physical_address");
        if (!$this->insurance_physical_address->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->insurance_physical_address->Visible = false; // Disable update for API request
            } else {
                $this->insurance_physical_address->setFormValue($val);
            }
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->insurance_id->CurrentValue = $this->insurance_id->FormValue;
        $this->insurance_name->CurrentValue = $this->insurance_name->FormValue;
        $this->insurance_contact_person->CurrentValue = $this->insurance_contact_person->FormValue;
        $this->insurance_contact_person_phone->CurrentValue = $this->insurance_contact_person_phone->FormValue;
        $this->insurance_contact_person_email->CurrentValue = $this->insurance_contact_person_email->FormValue;
        $this->insurance_physical_address->CurrentValue = $this->insurance_physical_address->FormValue;
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
            $res = $this->showOptionLink("edit");
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
        $this->insurance_id->setDbValue($row['insurance_id']);
        $this->insurance_name->setDbValue($row['insurance_name']);
        $this->insurance_contact_person->setDbValue($row['insurance_contact_person']);
        $this->insurance_contact_person_phone->setDbValue($row['insurance_contact_person_phone']);
        $this->insurance_contact_person_email->setDbValue($row['insurance_contact_person_email']);
        $this->insurance_physical_address->setDbValue($row['insurance_physical_address']);
        $this->submission_date->setDbValue($row['submission_date']);
        $this->date_updated->setDbValue($row['date_updated']);
        $this->submitted_by_user_id->setDbValue($row['submitted_by_user_id']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['insurance_id'] = $this->insurance_id->DefaultValue;
        $row['insurance_name'] = $this->insurance_name->DefaultValue;
        $row['insurance_contact_person'] = $this->insurance_contact_person->DefaultValue;
        $row['insurance_contact_person_phone'] = $this->insurance_contact_person_phone->DefaultValue;
        $row['insurance_contact_person_email'] = $this->insurance_contact_person_email->DefaultValue;
        $row['insurance_physical_address'] = $this->insurance_physical_address->DefaultValue;
        $row['submission_date'] = $this->submission_date->DefaultValue;
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

        // insurance_id
        $this->insurance_id->RowCssClass = "row";

        // insurance_name
        $this->insurance_name->RowCssClass = "row";

        // insurance_contact_person
        $this->insurance_contact_person->RowCssClass = "row";

        // insurance_contact_person_phone
        $this->insurance_contact_person_phone->RowCssClass = "row";

        // insurance_contact_person_email
        $this->insurance_contact_person_email->RowCssClass = "row";

        // insurance_physical_address
        $this->insurance_physical_address->RowCssClass = "row";

        // submission_date
        $this->submission_date->RowCssClass = "row";

        // date_updated
        $this->date_updated->RowCssClass = "row";

        // submitted_by_user_id
        $this->submitted_by_user_id->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // insurance_id
            $this->insurance_id->ViewValue = $this->insurance_id->CurrentValue;

            // insurance_name
            $this->insurance_name->ViewValue = $this->insurance_name->CurrentValue;

            // insurance_contact_person
            $this->insurance_contact_person->ViewValue = $this->insurance_contact_person->CurrentValue;

            // insurance_contact_person_phone
            $this->insurance_contact_person_phone->ViewValue = $this->insurance_contact_person_phone->CurrentValue;

            // insurance_contact_person_email
            $this->insurance_contact_person_email->ViewValue = $this->insurance_contact_person_email->CurrentValue;

            // insurance_physical_address
            $this->insurance_physical_address->ViewValue = $this->insurance_physical_address->CurrentValue;

            // submission_date
            $this->submission_date->ViewValue = $this->submission_date->CurrentValue;
            $this->submission_date->ViewValue = FormatDateTime($this->submission_date->ViewValue, $this->submission_date->formatPattern());

            // date_updated
            $this->date_updated->ViewValue = $this->date_updated->CurrentValue;
            $this->date_updated->ViewValue = FormatDateTime($this->date_updated->ViewValue, $this->date_updated->formatPattern());

            // submitted_by_user_id
            $this->submitted_by_user_id->ViewValue = $this->submitted_by_user_id->CurrentValue;
            $this->submitted_by_user_id->ViewValue = FormatNumber($this->submitted_by_user_id->ViewValue, $this->submitted_by_user_id->formatPattern());

            // insurance_id
            $this->insurance_id->HrefValue = "";

            // insurance_name
            $this->insurance_name->HrefValue = "";

            // insurance_contact_person
            $this->insurance_contact_person->HrefValue = "";

            // insurance_contact_person_phone
            if (!EmptyValue($this->insurance_contact_person_phone->CurrentValue)) {
                $this->insurance_contact_person_phone->HrefValue = $this->insurance_contact_person_phone->getLinkPrefix() . $this->insurance_contact_person_phone->CurrentValue; // Add prefix/suffix
                $this->insurance_contact_person_phone->LinkAttrs["target"] = ""; // Add target
                if ($this->isExport()) {
                    $this->insurance_contact_person_phone->HrefValue = FullUrl($this->insurance_contact_person_phone->HrefValue, "href");
                }
            } else {
                $this->insurance_contact_person_phone->HrefValue = "";
            }

            // insurance_contact_person_email
            if (!EmptyValue($this->insurance_contact_person_email->CurrentValue)) {
                $this->insurance_contact_person_email->HrefValue = $this->insurance_contact_person_email->getLinkPrefix() . $this->insurance_contact_person_email->CurrentValue; // Add prefix/suffix
                $this->insurance_contact_person_email->LinkAttrs["target"] = ""; // Add target
                if ($this->isExport()) {
                    $this->insurance_contact_person_email->HrefValue = FullUrl($this->insurance_contact_person_email->HrefValue, "href");
                }
            } else {
                $this->insurance_contact_person_email->HrefValue = "";
            }

            // insurance_physical_address
            $this->insurance_physical_address->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // insurance_id
            $this->insurance_id->setupEditAttributes();
            $this->insurance_id->EditValue = $this->insurance_id->CurrentValue;

            // insurance_name
            $this->insurance_name->setupEditAttributes();
            if (!$this->insurance_name->Raw) {
                $this->insurance_name->CurrentValue = HtmlDecode($this->insurance_name->CurrentValue);
            }
            $this->insurance_name->EditValue = HtmlEncode($this->insurance_name->CurrentValue);
            $this->insurance_name->PlaceHolder = RemoveHtml($this->insurance_name->caption());

            // insurance_contact_person
            $this->insurance_contact_person->setupEditAttributes();
            if (!$this->insurance_contact_person->Raw) {
                $this->insurance_contact_person->CurrentValue = HtmlDecode($this->insurance_contact_person->CurrentValue);
            }
            $this->insurance_contact_person->EditValue = HtmlEncode($this->insurance_contact_person->CurrentValue);
            $this->insurance_contact_person->PlaceHolder = RemoveHtml($this->insurance_contact_person->caption());

            // insurance_contact_person_phone
            $this->insurance_contact_person_phone->setupEditAttributes();
            if (!$this->insurance_contact_person_phone->Raw) {
                $this->insurance_contact_person_phone->CurrentValue = HtmlDecode($this->insurance_contact_person_phone->CurrentValue);
            }
            $this->insurance_contact_person_phone->EditValue = HtmlEncode($this->insurance_contact_person_phone->CurrentValue);
            $this->insurance_contact_person_phone->PlaceHolder = RemoveHtml($this->insurance_contact_person_phone->caption());

            // insurance_contact_person_email
            $this->insurance_contact_person_email->setupEditAttributes();
            if (!$this->insurance_contact_person_email->Raw) {
                $this->insurance_contact_person_email->CurrentValue = HtmlDecode($this->insurance_contact_person_email->CurrentValue);
            }
            $this->insurance_contact_person_email->EditValue = HtmlEncode($this->insurance_contact_person_email->CurrentValue);
            $this->insurance_contact_person_email->PlaceHolder = RemoveHtml($this->insurance_contact_person_email->caption());

            // insurance_physical_address
            $this->insurance_physical_address->setupEditAttributes();
            $this->insurance_physical_address->EditValue = HtmlEncode($this->insurance_physical_address->CurrentValue);
            $this->insurance_physical_address->PlaceHolder = RemoveHtml($this->insurance_physical_address->caption());

            // Edit refer script

            // insurance_id
            $this->insurance_id->HrefValue = "";

            // insurance_name
            $this->insurance_name->HrefValue = "";

            // insurance_contact_person
            $this->insurance_contact_person->HrefValue = "";

            // insurance_contact_person_phone
            if (!EmptyValue($this->insurance_contact_person_phone->CurrentValue)) {
                $this->insurance_contact_person_phone->HrefValue = $this->insurance_contact_person_phone->getLinkPrefix() . $this->insurance_contact_person_phone->CurrentValue; // Add prefix/suffix
                $this->insurance_contact_person_phone->LinkAttrs["target"] = ""; // Add target
                if ($this->isExport()) {
                    $this->insurance_contact_person_phone->HrefValue = FullUrl($this->insurance_contact_person_phone->HrefValue, "href");
                }
            } else {
                $this->insurance_contact_person_phone->HrefValue = "";
            }

            // insurance_contact_person_email
            if (!EmptyValue($this->insurance_contact_person_email->CurrentValue)) {
                $this->insurance_contact_person_email->HrefValue = $this->insurance_contact_person_email->getLinkPrefix() . $this->insurance_contact_person_email->CurrentValue; // Add prefix/suffix
                $this->insurance_contact_person_email->LinkAttrs["target"] = ""; // Add target
                if ($this->isExport()) {
                    $this->insurance_contact_person_email->HrefValue = FullUrl($this->insurance_contact_person_email->HrefValue, "href");
                }
            } else {
                $this->insurance_contact_person_email->HrefValue = "";
            }

            // insurance_physical_address
            $this->insurance_physical_address->HrefValue = "";
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
        if ($this->insurance_id->Required) {
            if (!$this->insurance_id->IsDetailKey && EmptyValue($this->insurance_id->FormValue)) {
                $this->insurance_id->addErrorMessage(str_replace("%s", $this->insurance_id->caption(), $this->insurance_id->RequiredErrorMessage));
            }
        }
        if ($this->insurance_name->Required) {
            if (!$this->insurance_name->IsDetailKey && EmptyValue($this->insurance_name->FormValue)) {
                $this->insurance_name->addErrorMessage(str_replace("%s", $this->insurance_name->caption(), $this->insurance_name->RequiredErrorMessage));
            }
        }
        if ($this->insurance_contact_person->Required) {
            if (!$this->insurance_contact_person->IsDetailKey && EmptyValue($this->insurance_contact_person->FormValue)) {
                $this->insurance_contact_person->addErrorMessage(str_replace("%s", $this->insurance_contact_person->caption(), $this->insurance_contact_person->RequiredErrorMessage));
            }
        }
        if ($this->insurance_contact_person_phone->Required) {
            if (!$this->insurance_contact_person_phone->IsDetailKey && EmptyValue($this->insurance_contact_person_phone->FormValue)) {
                $this->insurance_contact_person_phone->addErrorMessage(str_replace("%s", $this->insurance_contact_person_phone->caption(), $this->insurance_contact_person_phone->RequiredErrorMessage));
            }
        }
        if ($this->insurance_contact_person_email->Required) {
            if (!$this->insurance_contact_person_email->IsDetailKey && EmptyValue($this->insurance_contact_person_email->FormValue)) {
                $this->insurance_contact_person_email->addErrorMessage(str_replace("%s", $this->insurance_contact_person_email->caption(), $this->insurance_contact_person_email->RequiredErrorMessage));
            }
        }
        if ($this->insurance_physical_address->Required) {
            if (!$this->insurance_physical_address->IsDetailKey && EmptyValue($this->insurance_physical_address->FormValue)) {
                $this->insurance_physical_address->addErrorMessage(str_replace("%s", $this->insurance_physical_address->caption(), $this->insurance_physical_address->RequiredErrorMessage));
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

    // Update record based on key values
    protected function editRow()
    {
        global $Security, $Language;
        $oldKeyFilter = $this->getRecordFilter();
        $filter = $this->applyUserIDFilters($oldKeyFilter);
        $conn = $this->getConnection();

        // Load old row
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $rsold = $conn->fetchAssociative($sql);
        if (!$rsold) {
            $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
            return false; // Update Failed
        } else {
            // Save old values
            $this->loadDbValues($rsold);
        }

        // Set new row
        $rsnew = [];

        // insurance_name
        $this->insurance_name->setDbValueDef($rsnew, $this->insurance_name->CurrentValue, "", $this->insurance_name->ReadOnly);

        // insurance_contact_person
        $this->insurance_contact_person->setDbValueDef($rsnew, $this->insurance_contact_person->CurrentValue, "", $this->insurance_contact_person->ReadOnly);

        // insurance_contact_person_phone
        $this->insurance_contact_person_phone->setDbValueDef($rsnew, $this->insurance_contact_person_phone->CurrentValue, "", $this->insurance_contact_person_phone->ReadOnly);

        // insurance_contact_person_email
        $this->insurance_contact_person_email->setDbValueDef($rsnew, $this->insurance_contact_person_email->CurrentValue, "", $this->insurance_contact_person_email->ReadOnly);

        // insurance_physical_address
        $this->insurance_physical_address->setDbValueDef($rsnew, $this->insurance_physical_address->CurrentValue, "", $this->insurance_physical_address->ReadOnly);

        // Update current values
        $this->setCurrentValues($rsnew);

        // Call Row Updating event
        $updateRow = $this->rowUpdating($rsold, $rsnew);
        if ($updateRow) {
            if (count($rsnew) > 0) {
                $this->CurrentFilter = $filter; // Set up current filter
                $editRow = $this->update($rsnew, "", $rsold);
                if (!$editRow && !EmptyValue($this->DbErrorMessage)) { // Show database error
                    $this->setFailureMessage($this->DbErrorMessage);
                }
            } else {
                $editRow = true; // No field to update
            }
            if ($editRow) {
            }
        } else {
            if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                // Use the message, do nothing
            } elseif ($this->CancelMessage != "") {
                $this->setFailureMessage($this->CancelMessage);
                $this->CancelMessage = "";
            } else {
                $this->setFailureMessage($Language->phrase("UpdateCancelled"));
            }
            $editRow = false;
        }

        // Call Row_Updated event
        if ($editRow) {
            $this->rowUpdated($rsold, $rsnew);
        }

        // Write JSON response
        if (IsJsonResponse() && $editRow) {
            $row = $this->getRecordsFromRecordset([$rsnew], true);
            $table = $this->TableVar;
            WriteJson(["success" => true, "action" => Config("API_EDIT_ACTION"), $table => $row]);
        }
        return $editRow;
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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("jdhinsurancelist"), "", $this->TableVar, true);
        $pageId = "edit";
        $Breadcrumb->add("edit", $pageId, $url);
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

    // Set up starting record parameters
    public function setupStartRecord()
    {
        if ($this->DisplayRecords == 0) {
            return;
        }
        $pageNo = Get(Config("TABLE_PAGE_NUMBER"));
        $startRec = Get(Config("TABLE_START_REC"));
        $infiniteScroll = false;
        $recordNo = $pageNo ?? $startRec; // Record number = page number or start record
        if ($recordNo !== null && is_numeric($recordNo)) {
            $this->StartRecord = $recordNo;
        } else {
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
}
