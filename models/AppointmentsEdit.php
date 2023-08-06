<?php

namespace PHPMaker2023\jootidigitalhealthcare;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class AppointmentsEdit extends Appointments
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Page object name
    public $PageObjName = "AppointmentsEdit";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // CSS class/style
    public $ReportContainerClass = "ew-grid";
    public $CurrentPageName = "appointmentsedit";

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
        parent::__construct();
        global $Language, $DashboardReport, $DebugTimer;
        $this->TableVar = 'Appointments';
        $this->TableName = 'Appointments';

        // Table CSS class
        $this->TableClass = "table table-striped table-bordered table-hover table-sm ew-desktop-table ew-edit-table";

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("language");

        // Table object (Appointments)
        if (!isset($GLOBALS["Appointments"]) || get_class($GLOBALS["Appointments"]) == PROJECT_NAMESPACE . "Appointments") {
            $GLOBALS["Appointments"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'Appointments');
        }

        // Start timer
        $DebugTimer = Container("timer");

        // Debug message
        LoadDebugMessage();

        // Open connection
        $GLOBALS["Conn"] ??= $this->getConnection();
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

        // Close connection if not in dashboard
        if (!$DashboardReport) {
            CloseConnections();
        }

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
                    $result["view"] = $pageName == "appointmentsview"; // If View page, no primary button
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
            $key .= @$ar['appointment_id'];
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
            $this->appointment_id->Visible = false;
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
        if ($lookup->LinkTable == $this->TableVar || property_exists($this, "ReportSourceTable") && $lookup->LinkTable == $this->ReportSourceTable) {
            $lookup->RenderViewFunc = "renderLookup"; // Set up view renderer
        }
        $lookup->RenderEditFunc = ""; // Set up edit renderer

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

        // Global Page Loading event (in userfn*.php)
        Page_Loading();

        // Page Load event
        if (method_exists($this, "pageLoad")) {
            $this->pageLoad();
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
            if (($keyValue = Get("appointment_id") ?? Key(0) ?? Route(2)) !== null) {
                $this->appointment_id->setQueryStringValue($keyValue);
                $this->appointment_id->setOldValue($this->appointment_id->QueryStringValue);
            } elseif (Post("appointment_id") !== null) {
                $this->appointment_id->setFormValue(Post("appointment_id"));
                $this->appointment_id->setOldValue($this->appointment_id->FormValue);
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
                if (($keyValue = Get("appointment_id") ?? Route("appointment_id")) !== null) {
                    $this->appointment_id->setQueryStringValue($keyValue);
                    $loadByQuery = true;
                } else {
                    $this->appointment_id->CurrentValue = null;
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
                        $this->terminate("appointmentslist"); // No matching record, return to list
                        return;
                    }
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "appointmentslist") {
                    $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                }
                $this->SendEmail = true; // Send email on update success
                if ($this->editRow()) {
                    // Do not return Json for UseAjaxActions
                    if ($this->IsModal && $this->UseAjaxActions) {
                        $this->IsModal = false;
                    }

                    // Handle UseAjaxActions with return page
                    if ($this->UseAjaxActions && GetPageName($returnUrl) != "appointmentslist") {
                        Container("flash")->addMessage("Return-Url", $returnUrl); // Save return URL
                        $returnUrl = "appointmentslist"; // Return list page content
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

        // Check field name 'appointment_id' first before field var 'x_appointment_id'
        $val = $CurrentForm->hasValue("appointment_id") ? $CurrentForm->getValue("appointment_id") : $CurrentForm->getValue("x_appointment_id");
        if (!$this->appointment_id->IsDetailKey) {
            $this->appointment_id->setFormValue($val);
        }

        // Check field name 'patient_id' first before field var 'x_patient_id'
        $val = $CurrentForm->hasValue("patient_id") ? $CurrentForm->getValue("patient_id") : $CurrentForm->getValue("x_patient_id");
        if (!$this->patient_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->patient_id->Visible = false; // Disable update for API request
            } else {
                $this->patient_id->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'appointment_title' first before field var 'x_appointment_title'
        $val = $CurrentForm->hasValue("appointment_title") ? $CurrentForm->getValue("appointment_title") : $CurrentForm->getValue("x_appointment_title");
        if (!$this->appointment_title->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->appointment_title->Visible = false; // Disable update for API request
            } else {
                $this->appointment_title->setFormValue($val);
            }
        }

        // Check field name 'submission_date' first before field var 'x_submission_date'
        $val = $CurrentForm->hasValue("submission_date") ? $CurrentForm->getValue("submission_date") : $CurrentForm->getValue("x_submission_date");
        if (!$this->submission_date->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->submission_date->Visible = false; // Disable update for API request
            } else {
                $this->submission_date->setFormValue($val, true, $validate);
            }
            $this->submission_date->CurrentValue = UnFormatDateTime($this->submission_date->CurrentValue, $this->submission_date->formatPattern());
        }

        // Check field name 'subbmitted_by_user_id' first before field var 'x_subbmitted_by_user_id'
        $val = $CurrentForm->hasValue("subbmitted_by_user_id") ? $CurrentForm->getValue("subbmitted_by_user_id") : $CurrentForm->getValue("x_subbmitted_by_user_id");
        if (!$this->subbmitted_by_user_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->subbmitted_by_user_id->Visible = false; // Disable update for API request
            } else {
                $this->subbmitted_by_user_id->setFormValue($val);
            }
        }

        // Check field name 'appointment_end_date' first before field var 'x_appointment_end_date'
        $val = $CurrentForm->hasValue("appointment_end_date") ? $CurrentForm->getValue("appointment_end_date") : $CurrentForm->getValue("x_appointment_end_date");
        if (!$this->appointment_end_date->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->appointment_end_date->Visible = false; // Disable update for API request
            } else {
                $this->appointment_end_date->setFormValue($val, true, $validate);
            }
            $this->appointment_end_date->CurrentValue = UnFormatDateTime($this->appointment_end_date->CurrentValue, $this->appointment_end_date->formatPattern());
        }

        // Check field name 'appointment_start_date' first before field var 'x_appointment_start_date'
        $val = $CurrentForm->hasValue("appointment_start_date") ? $CurrentForm->getValue("appointment_start_date") : $CurrentForm->getValue("x_appointment_start_date");
        if (!$this->appointment_start_date->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->appointment_start_date->Visible = false; // Disable update for API request
            } else {
                $this->appointment_start_date->setFormValue($val, true, $validate);
            }
            $this->appointment_start_date->CurrentValue = UnFormatDateTime($this->appointment_start_date->CurrentValue, $this->appointment_start_date->formatPattern());
        }

        // Check field name 'appointment_description' first before field var 'x_appointment_description'
        $val = $CurrentForm->hasValue("appointment_description") ? $CurrentForm->getValue("appointment_description") : $CurrentForm->getValue("x_appointment_description");
        if (!$this->appointment_description->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->appointment_description->Visible = false; // Disable update for API request
            } else {
                $this->appointment_description->setFormValue($val);
            }
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->appointment_id->CurrentValue = $this->appointment_id->FormValue;
        $this->patient_id->CurrentValue = $this->patient_id->FormValue;
        $this->appointment_title->CurrentValue = $this->appointment_title->FormValue;
        $this->submission_date->CurrentValue = $this->submission_date->FormValue;
        $this->submission_date->CurrentValue = UnFormatDateTime($this->submission_date->CurrentValue, $this->submission_date->formatPattern());
        $this->subbmitted_by_user_id->CurrentValue = $this->subbmitted_by_user_id->FormValue;
        $this->appointment_end_date->CurrentValue = $this->appointment_end_date->FormValue;
        $this->appointment_end_date->CurrentValue = UnFormatDateTime($this->appointment_end_date->CurrentValue, $this->appointment_end_date->formatPattern());
        $this->appointment_start_date->CurrentValue = $this->appointment_start_date->FormValue;
        $this->appointment_start_date->CurrentValue = UnFormatDateTime($this->appointment_start_date->CurrentValue, $this->appointment_start_date->formatPattern());
        $this->appointment_description->CurrentValue = $this->appointment_description->FormValue;
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
        $this->appointment_id->setDbValue($row['appointment_id']);
        $this->patient_id->setDbValue($row['patient_id']);
        $this->appointment_title->setDbValue($row['appointment_title']);
        $this->submission_date->setDbValue($row['submission_date']);
        $this->subbmitted_by_user_id->setDbValue($row['subbmitted_by_user_id']);
        $this->appointment_end_date->setDbValue($row['appointment_end_date']);
        $this->appointment_start_date->setDbValue($row['appointment_start_date']);
        $this->appointment_description->setDbValue($row['appointment_description']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['appointment_id'] = $this->appointment_id->DefaultValue;
        $row['patient_id'] = $this->patient_id->DefaultValue;
        $row['appointment_title'] = $this->appointment_title->DefaultValue;
        $row['submission_date'] = $this->submission_date->DefaultValue;
        $row['subbmitted_by_user_id'] = $this->subbmitted_by_user_id->DefaultValue;
        $row['appointment_end_date'] = $this->appointment_end_date->DefaultValue;
        $row['appointment_start_date'] = $this->appointment_start_date->DefaultValue;
        $row['appointment_description'] = $this->appointment_description->DefaultValue;
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

        // appointment_id
        $this->appointment_id->RowCssClass = "row";

        // patient_id
        $this->patient_id->RowCssClass = "row";

        // appointment_title
        $this->appointment_title->RowCssClass = "row";

        // submission_date
        $this->submission_date->RowCssClass = "row";

        // subbmitted_by_user_id
        $this->subbmitted_by_user_id->RowCssClass = "row";

        // appointment_end_date
        $this->appointment_end_date->RowCssClass = "row";

        // appointment_start_date
        $this->appointment_start_date->RowCssClass = "row";

        // appointment_description
        $this->appointment_description->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // appointment_id
            $this->appointment_id->ViewValue = $this->appointment_id->CurrentValue;

            // patient_id
            $this->patient_id->ViewValue = $this->patient_id->CurrentValue;
            $this->patient_id->ViewValue = FormatNumber($this->patient_id->ViewValue, $this->patient_id->formatPattern());

            // appointment_title
            $this->appointment_title->ViewValue = $this->appointment_title->CurrentValue;

            // submission_date
            $this->submission_date->ViewValue = $this->submission_date->CurrentValue;
            $this->submission_date->ViewValue = FormatDateTime($this->submission_date->ViewValue, $this->submission_date->formatPattern());

            // subbmitted_by_user_id
            $this->subbmitted_by_user_id->ViewValue = $this->subbmitted_by_user_id->CurrentValue;
            $this->subbmitted_by_user_id->ViewValue = FormatNumber($this->subbmitted_by_user_id->ViewValue, $this->subbmitted_by_user_id->formatPattern());

            // appointment_end_date
            $this->appointment_end_date->ViewValue = $this->appointment_end_date->CurrentValue;
            $this->appointment_end_date->ViewValue = FormatDateTime($this->appointment_end_date->ViewValue, $this->appointment_end_date->formatPattern());

            // appointment_start_date
            $this->appointment_start_date->ViewValue = $this->appointment_start_date->CurrentValue;
            $this->appointment_start_date->ViewValue = FormatDateTime($this->appointment_start_date->ViewValue, $this->appointment_start_date->formatPattern());

            // appointment_description
            $this->appointment_description->ViewValue = $this->appointment_description->CurrentValue;

            // appointment_id
            $this->appointment_id->HrefValue = "";

            // patient_id
            $this->patient_id->HrefValue = "";

            // appointment_title
            $this->appointment_title->HrefValue = "";

            // submission_date
            $this->submission_date->HrefValue = "";

            // subbmitted_by_user_id
            $this->subbmitted_by_user_id->HrefValue = "";

            // appointment_end_date
            $this->appointment_end_date->HrefValue = "";

            // appointment_start_date
            $this->appointment_start_date->HrefValue = "";

            // appointment_description
            $this->appointment_description->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // appointment_id
            $this->appointment_id->setupEditAttributes();
            $this->appointment_id->EditValue = $this->appointment_id->CurrentValue;

            // patient_id
            $this->patient_id->setupEditAttributes();
            $this->patient_id->EditValue = HtmlEncode($this->patient_id->CurrentValue);
            $this->patient_id->PlaceHolder = RemoveHtml($this->patient_id->caption());
            if (strval($this->patient_id->EditValue) != "" && is_numeric($this->patient_id->EditValue)) {
                $this->patient_id->EditValue = FormatNumber($this->patient_id->EditValue, null);
            }

            // appointment_title
            $this->appointment_title->setupEditAttributes();
            if (!$this->appointment_title->Raw) {
                $this->appointment_title->CurrentValue = HtmlDecode($this->appointment_title->CurrentValue);
            }
            $this->appointment_title->EditValue = HtmlEncode($this->appointment_title->CurrentValue);
            $this->appointment_title->PlaceHolder = RemoveHtml($this->appointment_title->caption());

            // submission_date
            $this->submission_date->setupEditAttributes();
            $this->submission_date->EditValue = HtmlEncode(FormatDateTime($this->submission_date->CurrentValue, $this->submission_date->formatPattern()));
            $this->submission_date->PlaceHolder = RemoveHtml($this->submission_date->caption());

            // subbmitted_by_user_id

            // appointment_end_date
            $this->appointment_end_date->setupEditAttributes();
            $this->appointment_end_date->EditValue = HtmlEncode(FormatDateTime($this->appointment_end_date->CurrentValue, $this->appointment_end_date->formatPattern()));
            $this->appointment_end_date->PlaceHolder = RemoveHtml($this->appointment_end_date->caption());

            // appointment_start_date
            $this->appointment_start_date->setupEditAttributes();
            $this->appointment_start_date->EditValue = HtmlEncode(FormatDateTime($this->appointment_start_date->CurrentValue, $this->appointment_start_date->formatPattern()));
            $this->appointment_start_date->PlaceHolder = RemoveHtml($this->appointment_start_date->caption());

            // appointment_description
            $this->appointment_description->setupEditAttributes();
            $this->appointment_description->EditValue = HtmlEncode($this->appointment_description->CurrentValue);
            $this->appointment_description->PlaceHolder = RemoveHtml($this->appointment_description->caption());

            // Edit refer script

            // appointment_id
            $this->appointment_id->HrefValue = "";

            // patient_id
            $this->patient_id->HrefValue = "";

            // appointment_title
            $this->appointment_title->HrefValue = "";

            // submission_date
            $this->submission_date->HrefValue = "";

            // subbmitted_by_user_id
            $this->subbmitted_by_user_id->HrefValue = "";

            // appointment_end_date
            $this->appointment_end_date->HrefValue = "";

            // appointment_start_date
            $this->appointment_start_date->HrefValue = "";

            // appointment_description
            $this->appointment_description->HrefValue = "";
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
        if ($this->appointment_id->Required) {
            if (!$this->appointment_id->IsDetailKey && EmptyValue($this->appointment_id->FormValue)) {
                $this->appointment_id->addErrorMessage(str_replace("%s", $this->appointment_id->caption(), $this->appointment_id->RequiredErrorMessage));
            }
        }
        if ($this->patient_id->Required) {
            if (!$this->patient_id->IsDetailKey && EmptyValue($this->patient_id->FormValue)) {
                $this->patient_id->addErrorMessage(str_replace("%s", $this->patient_id->caption(), $this->patient_id->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->patient_id->FormValue)) {
            $this->patient_id->addErrorMessage($this->patient_id->getErrorMessage(false));
        }
        if ($this->appointment_title->Required) {
            if (!$this->appointment_title->IsDetailKey && EmptyValue($this->appointment_title->FormValue)) {
                $this->appointment_title->addErrorMessage(str_replace("%s", $this->appointment_title->caption(), $this->appointment_title->RequiredErrorMessage));
            }
        }
        if ($this->submission_date->Required) {
            if (!$this->submission_date->IsDetailKey && EmptyValue($this->submission_date->FormValue)) {
                $this->submission_date->addErrorMessage(str_replace("%s", $this->submission_date->caption(), $this->submission_date->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->submission_date->FormValue, $this->submission_date->formatPattern())) {
            $this->submission_date->addErrorMessage($this->submission_date->getErrorMessage(false));
        }
        if ($this->subbmitted_by_user_id->Required) {
            if (!$this->subbmitted_by_user_id->IsDetailKey && EmptyValue($this->subbmitted_by_user_id->FormValue)) {
                $this->subbmitted_by_user_id->addErrorMessage(str_replace("%s", $this->subbmitted_by_user_id->caption(), $this->subbmitted_by_user_id->RequiredErrorMessage));
            }
        }
        if ($this->appointment_end_date->Required) {
            if (!$this->appointment_end_date->IsDetailKey && EmptyValue($this->appointment_end_date->FormValue)) {
                $this->appointment_end_date->addErrorMessage(str_replace("%s", $this->appointment_end_date->caption(), $this->appointment_end_date->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->appointment_end_date->FormValue, $this->appointment_end_date->formatPattern())) {
            $this->appointment_end_date->addErrorMessage($this->appointment_end_date->getErrorMessage(false));
        }
        if ($this->appointment_start_date->Required) {
            if (!$this->appointment_start_date->IsDetailKey && EmptyValue($this->appointment_start_date->FormValue)) {
                $this->appointment_start_date->addErrorMessage(str_replace("%s", $this->appointment_start_date->caption(), $this->appointment_start_date->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->appointment_start_date->FormValue, $this->appointment_start_date->formatPattern())) {
            $this->appointment_start_date->addErrorMessage($this->appointment_start_date->getErrorMessage(false));
        }
        if ($this->appointment_description->Required) {
            if (!$this->appointment_description->IsDetailKey && EmptyValue($this->appointment_description->FormValue)) {
                $this->appointment_description->addErrorMessage(str_replace("%s", $this->appointment_description->caption(), $this->appointment_description->RequiredErrorMessage));
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

        // patient_id
        $this->patient_id->setDbValueDef($rsnew, $this->patient_id->CurrentValue, 0, $this->patient_id->ReadOnly);

        // appointment_title
        $this->appointment_title->setDbValueDef($rsnew, $this->appointment_title->CurrentValue, "", $this->appointment_title->ReadOnly);

        // submission_date
        $this->submission_date->setDbValueDef($rsnew, UnFormatDateTime($this->submission_date->CurrentValue, $this->submission_date->formatPattern()), CurrentDate(), $this->submission_date->ReadOnly);

        // subbmitted_by_user_id
        $this->subbmitted_by_user_id->CurrentValue = $this->subbmitted_by_user_id->getAutoUpdateValue(); // PHP
        $this->subbmitted_by_user_id->setDbValueDef($rsnew, $this->subbmitted_by_user_id->CurrentValue, 0);

        // appointment_end_date
        $this->appointment_end_date->setDbValueDef($rsnew, UnFormatDateTime($this->appointment_end_date->CurrentValue, $this->appointment_end_date->formatPattern()), CurrentDate(), $this->appointment_end_date->ReadOnly);

        // appointment_start_date
        $this->appointment_start_date->setDbValueDef($rsnew, UnFormatDateTime($this->appointment_start_date->CurrentValue, $this->appointment_start_date->formatPattern()), CurrentDate(), $this->appointment_start_date->ReadOnly);

        // appointment_description
        $this->appointment_description->setDbValueDef($rsnew, $this->appointment_description->CurrentValue, "", $this->appointment_description->ReadOnly);

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
            $table = $this->UpdateTable;
            $row['id'] = $row['appointment_id']; // Get event id
            WriteJson(["success" => true, "action" => Config("API_EDIT_ACTION"), $table => $row]);
        }
        return $editRow;
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("appointmentslist"), "", $this->TableVar, true);
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
