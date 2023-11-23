<?php

namespace PHPMaker2024\jootidigitalhealthcare;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Container\ContainerInterface;
use Slim\Routing\RouteCollectorProxy;
use Slim\App;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Closure;

/**
 * Page class
 */
class PatientAppointmentsAdd extends PatientAppointments
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Page object name
    public $PageObjName = "PatientAppointmentsAdd";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // CSS class/style
    public $ReportContainerClass = "ew-grid";
    public $CurrentPageName = "patientappointmentsadd";

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
            echo '<div id="ew-page-header">' . $header . '</div>';
        }
    }

    // Show Page Footer
    public function showPageFooter()
    {
        $footer = $this->PageFooter;
        $this->pageDataRendered($footer);
        if ($footer != "") { // Footer exists, display
            echo '<div id="ew-page-footer">' . $footer . '</div>';
        }
    }

    // Constructor
    public function __construct()
    {
        parent::__construct();
        global $Language, $DashboardReport, $DebugTimer, $UserTable;
        $this->TableVar = 'Patient_Appointments';
        $this->TableName = 'Patient Appointments';

        // Table CSS class
        $this->TableClass = "table table-striped table-bordered table-hover table-sm ew-desktop-table ew-add-table";

        // Start/End fields
        $this->Fields['appointment_start_date']->DateTimeFormat = 1;
        $this->Fields['appointment_end_date']->DateTimeFormat = 1;

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("app.language");

        // Table object (Patient_Appointments)
        if (!isset($GLOBALS["Patient_Appointments"]) || $GLOBALS["Patient_Appointments"]::class == PROJECT_NAMESPACE . "Patient_Appointments") {
            $GLOBALS["Patient_Appointments"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'Patient Appointments');
        }

        // Start timer
        $DebugTimer = Container("debug.timer");

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
        return $Response?->getBody() ?? ob_get_clean();
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
        DispatchEvent(new PageUnloadedEvent($this), PageUnloadedEvent::NAME);
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
            if (WithJsonResponse()) { // With JSON response
                $this->clearMessages();
                return;
            }
        }

        // Go to URL if specified
        if ($url != "") {
            if (!Config("DEBUG") && ob_get_length()) {
                ob_end_clean();
            }

            // Handle modal response
            if ($this->IsModal) { // Show as modal
                $pageName = GetPageName($url);
                $result = ["url" => GetUrl($url)]; // Reload calendar without modal
                WriteJson($result);
            } else {
                SaveDebugMessage();
                Redirect(GetUrl($url));
            }
        }
        return; // Return to controller
    }

    // Get records from result set
    protected function getRecordsFromRecordset($rs, $current = false)
    {
        $rows = [];
        if (is_object($rs)) { // Result set
            while ($row = $rs->fetch()) {
                $this->loadRowValues($row); // Set up DbValue/CurrentValue
                $row = $this->getRecordFromArray($row);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
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
                            if ($fld->DataType == DataType::BLOB) {
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
    public function lookup(array $req = [], bool $response = true)
    {
        global $Language, $Security;

        // Get lookup object
        $fieldName = $req["field"] ?? null;
        if (!$fieldName) {
            return [];
        }
        $fld = $this->Fields[$fieldName];
        $lookup = $fld->Lookup;
        $name = $req["name"] ?? "";
        if (ContainsString($name, "query_builder_rule")) {
            $lookup->FilterFields = []; // Skip parent fields if any
        }
        if ($fld instanceof ReportField) {
            $lookup->RenderViewFunc = "renderLookup"; // Set up view renderer
        }
        $lookup->RenderEditFunc = ""; // Set up edit renderer

        // Get lookup parameters
        $lookupType = $req["ajax"] ?? "unknown";
        $pageSize = -1;
        $offset = -1;
        $searchValue = "";
        if (SameText($lookupType, "modal") || SameText($lookupType, "filter")) {
            $searchValue = $req["q"] ?? $req["sv"] ?? "";
            $pageSize = $req["n"] ?? $req["recperpage"] ?? 10;
        } elseif (SameText($lookupType, "autosuggest")) {
            $searchValue = $req["q"] ?? "";
            $pageSize = $req["n"] ?? -1;
            $pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
            if ($pageSize <= 0) {
                $pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
            }
        }
        $start = $req["start"] ?? -1;
        $start = is_numeric($start) ? (int)$start : -1;
        $page = $req["page"] ?? -1;
        $page = is_numeric($page) ? (int)$page : -1;
        $offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
        $userSelect = Decrypt($req["s"] ?? "");
        $userFilter = Decrypt($req["f"] ?? "");
        $userOrderBy = Decrypt($req["o"] ?? "");
        $keys = $req["keys"] ?? null;
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
            $lookup->FilterValues[] = $req["v0"] ?? $req["lookupValue"] ?? "";
        }
        $cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
        for ($i = 1; $i <= $cnt; $i++) {
            $lookup->FilterValues[] = $req["v" . $i] ?? "";
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
        return $lookup->toJson($this, $response); // Use settings from current page
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
        global $ExportType, $Language, $Security, $CurrentForm, $SkipHeaderFooter;

        // Is modal
        $this->IsModal = ConvertToBool(Param("modal"));
        $this->UseLayout = $this->UseLayout && !$this->IsModal;

        // Use layout
        $this->UseLayout = $this->UseLayout && ConvertToBool(Param(Config("PAGE_LAYOUT"), true));

        // View
        $this->View = Get(Config("VIEW"));

        // Load user profile
        if (IsLoggedIn()) {
            Profile()->setUserName(CurrentUserName())->loadFromStorage();
        }

        // Create form object
        $CurrentForm = new HttpForm();
        $this->CurrentAction = Param("action"); // Set up current action

        // Global Page Loading event (in userfn*.php)
        DispatchEvent(new PageLoadingEvent($this), PageLoadingEvent::NAME);

        // Page Load event
        if (method_exists($this, "pageLoad")) {
            $this->pageLoad();
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
        } elseif (Post("action", "") !== "") {
            $this->CurrentAction = Post("action"); // Get form action
            $this->setKey(Post($this->OldKeyName));
            $postBack = true;
        } else {
            // Load key values from QueryString
            if (($keyValue = Get("appointment_id") ?? Route("appointment_id")) !== null) {
                $this->appointment_id->setQueryStringValue($keyValue);
            }
            $this->OldKey = $this->getKey(true); // Get from CurrentValue
            $this->CopyRecord = !EmptyValue($this->OldKey);
            if ($this->CopyRecord) {
                $this->CurrentAction = "copy"; // Copy record
                $this->setKey($this->OldKey); // Set up record key
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
                    $this->terminate("patientappointmentslist"); // No matching record, return to list
                    return;
                }
                break;
            case "insert": // Add new record
                $this->SendEmail = true; // Send email on add success
                if ($this->addRow($rsold)) { // Add successful
                    if ($this->getSuccessMessage() == "" && Post("addopt") != "1") { // Skip success message for addopt (done in JavaScript)
                        $this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
                    }
                    $returnUrl = "patientappointments";
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
                } elseif ($this->IsModal && $this->UseAjaxActions) { // Return JSON error message
                    WriteJson(["success" => false, "validation" => $this->getValidationErrors(), "error" => $this->getFailureMessage()]);
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
        $this->RowType = RowType::ADD; // Render add type

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
            DispatchEvent(new PageRenderingEvent($this), PageRenderingEvent::NAME);

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
        $this->appointment_start_date->DefaultValue = Param("appointment_start_date");
        if ($this->appointment_start_date->DefaultValue !== null) {
            $this->appointment_start_date->OldValue = $this->appointment_start_date->DefaultValue;
        }
        $this->appointment_end_date->DefaultValue = Param("appointment_end_date");
        if ($this->appointment_end_date->DefaultValue !== null) {
            $this->appointment_end_date->OldValue = $this->appointment_end_date->DefaultValue;
        }
        $this->appointment_all_day->DefaultValue = Param("appointment_all_day");
        if ($this->appointment_all_day->DefaultValue !== null) {
            $this->appointment_all_day->OldValue = $this->appointment_all_day->DefaultValue;
        }
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

        // Check field name 'appointment_description' first before field var 'x_appointment_description'
        $val = $CurrentForm->hasValue("appointment_description") ? $CurrentForm->getValue("appointment_description") : $CurrentForm->getValue("x_appointment_description");
        if (!$this->appointment_description->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->appointment_description->Visible = false; // Disable update for API request
            } else {
                $this->appointment_description->setFormValue($val);
            }
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

        // Check field name 'appointment_all_day' first before field var 'x_appointment_all_day'
        $val = $CurrentForm->hasValue("appointment_all_day") ? $CurrentForm->getValue("appointment_all_day") : $CurrentForm->getValue("x_appointment_all_day");
        if (!$this->appointment_all_day->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->appointment_all_day->Visible = false; // Disable update for API request
            } else {
                $this->appointment_all_day->setFormValue($val);
            }
        }

        // Check field name 'user_id' first before field var 'x_user_id'
        $val = $CurrentForm->hasValue("user_id") ? $CurrentForm->getValue("user_id") : $CurrentForm->getValue("x_user_id");
        if (!$this->user_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->user_id->Visible = false; // Disable update for API request
            } else {
                $this->user_id->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'appointment_id' first before field var 'x_appointment_id'
        $val = $CurrentForm->hasValue("appointment_id") ? $CurrentForm->getValue("appointment_id") : $CurrentForm->getValue("x_appointment_id");
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->patient_id->CurrentValue = $this->patient_id->FormValue;
        $this->appointment_title->CurrentValue = $this->appointment_title->FormValue;
        $this->appointment_start_date->CurrentValue = $this->appointment_start_date->FormValue;
        $this->appointment_start_date->CurrentValue = UnFormatDateTime($this->appointment_start_date->CurrentValue, $this->appointment_start_date->formatPattern());
        $this->appointment_end_date->CurrentValue = $this->appointment_end_date->FormValue;
        $this->appointment_end_date->CurrentValue = UnFormatDateTime($this->appointment_end_date->CurrentValue, $this->appointment_end_date->formatPattern());
        $this->appointment_description->CurrentValue = $this->appointment_description->FormValue;
        $this->subbmitted_by_user_id->CurrentValue = $this->subbmitted_by_user_id->FormValue;
        $this->appointment_all_day->CurrentValue = $this->appointment_all_day->FormValue;
        $this->user_id->CurrentValue = $this->user_id->FormValue;
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
     * Load row values from result set or record
     *
     * @param array $row Record
     * @return void
     */
    public function loadRowValues($row = null)
    {
        $row = is_array($row) ? $row : $this->newRow();

        // Call Row Selected event
        $this->rowSelected($row);
        $this->appointment_id->setDbValue($row['appointment_id']);
        $this->patient_id->setDbValue($row['patient_id']);
        $this->appointment_title->setDbValue($row['appointment_title']);
        $this->appointment_start_date->setDbValue($row['appointment_start_date']);
        $this->appointment_end_date->setDbValue($row['appointment_end_date']);
        $this->appointment_description->setDbValue($row['appointment_description']);
        $this->submission_date->setDbValue($row['submission_date']);
        $this->subbmitted_by_user_id->setDbValue($row['subbmitted_by_user_id']);
        $this->appointment_all_day->setDbValue($row['appointment_all_day']);
        $this->user_id->setDbValue($row['user_id']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['appointment_id'] = $this->appointment_id->DefaultValue;
        $row['patient_id'] = $this->patient_id->DefaultValue;
        $row['appointment_title'] = $this->appointment_title->DefaultValue;
        $row['appointment_start_date'] = $this->appointment_start_date->DefaultValue;
        $row['appointment_end_date'] = $this->appointment_end_date->DefaultValue;
        $row['appointment_description'] = $this->appointment_description->DefaultValue;
        $row['submission_date'] = $this->submission_date->DefaultValue;
        $row['subbmitted_by_user_id'] = $this->subbmitted_by_user_id->DefaultValue;
        $row['appointment_all_day'] = $this->appointment_all_day->DefaultValue;
        $row['user_id'] = $this->user_id->DefaultValue;
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
            $rs = ExecuteQuery($sql, $conn);
            if ($row = $rs->fetch()) {
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

        // appointment_start_date
        $this->appointment_start_date->RowCssClass = "row";

        // appointment_end_date
        $this->appointment_end_date->RowCssClass = "row";

        // appointment_description
        $this->appointment_description->RowCssClass = "row";

        // submission_date
        $this->submission_date->RowCssClass = "row";

        // subbmitted_by_user_id
        $this->subbmitted_by_user_id->RowCssClass = "row";

        // appointment_all_day
        $this->appointment_all_day->RowCssClass = "row";

        // user_id
        $this->user_id->RowCssClass = "row";

        // View row
        if ($this->RowType == RowType::VIEW) {
            // appointment_id
            $this->appointment_id->ViewValue = $this->appointment_id->CurrentValue;

            // patient_id
            $this->patient_id->ViewValue = $this->patient_id->CurrentValue;
            $this->patient_id->ViewValue = FormatNumber($this->patient_id->ViewValue, $this->patient_id->formatPattern());

            // appointment_title
            $this->appointment_title->ViewValue = $this->appointment_title->CurrentValue;

            // appointment_start_date
            $this->appointment_start_date->ViewValue = $this->appointment_start_date->CurrentValue;
            $this->appointment_start_date->ViewValue = FormatDateTime($this->appointment_start_date->ViewValue, $this->appointment_start_date->formatPattern());

            // appointment_end_date
            $this->appointment_end_date->ViewValue = $this->appointment_end_date->CurrentValue;
            $this->appointment_end_date->ViewValue = FormatDateTime($this->appointment_end_date->ViewValue, $this->appointment_end_date->formatPattern());

            // appointment_description
            $this->appointment_description->ViewValue = $this->appointment_description->CurrentValue;

            // submission_date
            $this->submission_date->ViewValue = $this->submission_date->CurrentValue;
            $this->submission_date->ViewValue = FormatDateTime($this->submission_date->ViewValue, $this->submission_date->formatPattern());

            // subbmitted_by_user_id
            $this->subbmitted_by_user_id->ViewValue = $this->subbmitted_by_user_id->CurrentValue;
            $this->subbmitted_by_user_id->ViewValue = FormatNumber($this->subbmitted_by_user_id->ViewValue, $this->subbmitted_by_user_id->formatPattern());

            // appointment_all_day
            if (ConvertToBool($this->appointment_all_day->CurrentValue)) {
                $this->appointment_all_day->ViewValue = $this->appointment_all_day->tagCaption(1) != "" ? $this->appointment_all_day->tagCaption(1) : "Yes";
            } else {
                $this->appointment_all_day->ViewValue = $this->appointment_all_day->tagCaption(2) != "" ? $this->appointment_all_day->tagCaption(2) : "No";
            }

            // user_id
            $this->user_id->ViewValue = $this->user_id->CurrentValue;
            $this->user_id->ViewValue = FormatNumber($this->user_id->ViewValue, $this->user_id->formatPattern());

            // patient_id
            $this->patient_id->HrefValue = "";

            // appointment_title
            $this->appointment_title->HrefValue = "";

            // appointment_start_date
            $this->appointment_start_date->HrefValue = "";

            // appointment_end_date
            $this->appointment_end_date->HrefValue = "";

            // appointment_description
            $this->appointment_description->HrefValue = "";

            // subbmitted_by_user_id
            $this->subbmitted_by_user_id->HrefValue = "";

            // appointment_all_day
            $this->appointment_all_day->HrefValue = "";

            // user_id
            $this->user_id->HrefValue = "";
        } elseif ($this->RowType == RowType::ADD) {
            // patient_id
            $this->patient_id->setupEditAttributes();
            $this->patient_id->EditValue = $this->patient_id->CurrentValue;
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

            // appointment_start_date
            $this->appointment_start_date->setupEditAttributes();
            $this->appointment_start_date->EditValue = HtmlEncode(FormatDateTime($this->appointment_start_date->CurrentValue, $this->appointment_start_date->formatPattern()));
            $this->appointment_start_date->PlaceHolder = RemoveHtml($this->appointment_start_date->caption());

            // appointment_end_date
            $this->appointment_end_date->setupEditAttributes();
            $this->appointment_end_date->EditValue = HtmlEncode(FormatDateTime($this->appointment_end_date->CurrentValue, $this->appointment_end_date->formatPattern()));
            $this->appointment_end_date->PlaceHolder = RemoveHtml($this->appointment_end_date->caption());

            // appointment_description
            $this->appointment_description->setupEditAttributes();
            $this->appointment_description->EditValue = HtmlEncode($this->appointment_description->CurrentValue);
            $this->appointment_description->PlaceHolder = RemoveHtml($this->appointment_description->caption());

            // subbmitted_by_user_id

            // appointment_all_day
            $this->appointment_all_day->EditValue = $this->appointment_all_day->options(false);
            $this->appointment_all_day->PlaceHolder = RemoveHtml($this->appointment_all_day->caption());

            // user_id
            $this->user_id->setupEditAttributes();
            $this->user_id->EditValue = $this->user_id->CurrentValue;
            $this->user_id->PlaceHolder = RemoveHtml($this->user_id->caption());
            if (strval($this->user_id->EditValue) != "" && is_numeric($this->user_id->EditValue)) {
                $this->user_id->EditValue = FormatNumber($this->user_id->EditValue, null);
            }

            // Add refer script

            // patient_id
            $this->patient_id->HrefValue = "";

            // appointment_title
            $this->appointment_title->HrefValue = "";

            // appointment_start_date
            $this->appointment_start_date->HrefValue = "";

            // appointment_end_date
            $this->appointment_end_date->HrefValue = "";

            // appointment_description
            $this->appointment_description->HrefValue = "";

            // subbmitted_by_user_id
            $this->subbmitted_by_user_id->HrefValue = "";

            // appointment_all_day
            $this->appointment_all_day->HrefValue = "";

            // user_id
            $this->user_id->HrefValue = "";
        }
        if ($this->RowType == RowType::ADD || $this->RowType == RowType::EDIT || $this->RowType == RowType::SEARCH) { // Add/Edit/Search row
            $this->setupFieldTitles();
        }

        // Call Row Rendered event
        if ($this->RowType != RowType::AGGREGATEINIT) {
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
            if ($this->patient_id->Visible && $this->patient_id->Required) {
                if (!$this->patient_id->IsDetailKey && EmptyValue($this->patient_id->FormValue)) {
                    $this->patient_id->addErrorMessage(str_replace("%s", $this->patient_id->caption(), $this->patient_id->RequiredErrorMessage));
                }
            }
            if (!CheckInteger($this->patient_id->FormValue)) {
                $this->patient_id->addErrorMessage($this->patient_id->getErrorMessage(false));
            }
            if ($this->appointment_title->Visible && $this->appointment_title->Required) {
                if (!$this->appointment_title->IsDetailKey && EmptyValue($this->appointment_title->FormValue)) {
                    $this->appointment_title->addErrorMessage(str_replace("%s", $this->appointment_title->caption(), $this->appointment_title->RequiredErrorMessage));
                }
            }
            if ($this->appointment_start_date->Visible && $this->appointment_start_date->Required) {
                if (!$this->appointment_start_date->IsDetailKey && EmptyValue($this->appointment_start_date->FormValue)) {
                    $this->appointment_start_date->addErrorMessage(str_replace("%s", $this->appointment_start_date->caption(), $this->appointment_start_date->RequiredErrorMessage));
                }
            }
            if (!CheckDate($this->appointment_start_date->FormValue, $this->appointment_start_date->formatPattern())) {
                $this->appointment_start_date->addErrorMessage($this->appointment_start_date->getErrorMessage(false));
            }
            if ($this->appointment_end_date->Visible && $this->appointment_end_date->Required) {
                if (!$this->appointment_end_date->IsDetailKey && EmptyValue($this->appointment_end_date->FormValue)) {
                    $this->appointment_end_date->addErrorMessage(str_replace("%s", $this->appointment_end_date->caption(), $this->appointment_end_date->RequiredErrorMessage));
                }
            }
            if (!CheckDate($this->appointment_end_date->FormValue, $this->appointment_end_date->formatPattern())) {
                $this->appointment_end_date->addErrorMessage($this->appointment_end_date->getErrorMessage(false));
            }
            if ($this->appointment_description->Visible && $this->appointment_description->Required) {
                if (!$this->appointment_description->IsDetailKey && EmptyValue($this->appointment_description->FormValue)) {
                    $this->appointment_description->addErrorMessage(str_replace("%s", $this->appointment_description->caption(), $this->appointment_description->RequiredErrorMessage));
                }
            }
            if ($this->subbmitted_by_user_id->Visible && $this->subbmitted_by_user_id->Required) {
                if (!$this->subbmitted_by_user_id->IsDetailKey && EmptyValue($this->subbmitted_by_user_id->FormValue)) {
                    $this->subbmitted_by_user_id->addErrorMessage(str_replace("%s", $this->subbmitted_by_user_id->caption(), $this->subbmitted_by_user_id->RequiredErrorMessage));
                }
            }
            if ($this->appointment_all_day->Visible && $this->appointment_all_day->Required) {
                if ($this->appointment_all_day->FormValue == "") {
                    $this->appointment_all_day->addErrorMessage(str_replace("%s", $this->appointment_all_day->caption(), $this->appointment_all_day->RequiredErrorMessage));
                }
            }
            if ($this->user_id->Visible && $this->user_id->Required) {
                if (!$this->user_id->IsDetailKey && EmptyValue($this->user_id->FormValue)) {
                    $this->user_id->addErrorMessage(str_replace("%s", $this->user_id->caption(), $this->user_id->RequiredErrorMessage));
                }
            }
            if (!CheckInteger($this->user_id->FormValue)) {
                $this->user_id->addErrorMessage($this->user_id->getErrorMessage(false));
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

        // Get new row
        $rsnew = $this->getAddRow();

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
            $table = $this->UpdateTable;
            // Set up permissions for new event
            $row["_view"] = $Security->canView();
            $row["_edit"] = $Security->canEdit();
            $row["_copy"] = $Security->canAdd();
            $row["_delete"] = $Security->canDelete();
            WriteJson(["success" => true, "action" => Config("API_ADD_ACTION"), $table => $row]);
        }
        return $addRow;
    }

    /**
     * Get add row
     *
     * @return array
     */
    protected function getAddRow()
    {
        global $Security;
        $rsnew = [];

        // patient_id
        $this->patient_id->setDbValueDef($rsnew, $this->patient_id->CurrentValue, false);

        // appointment_title
        $this->appointment_title->setDbValueDef($rsnew, $this->appointment_title->CurrentValue, false);

        // appointment_start_date
        $this->appointment_start_date->setDbValueDef($rsnew, UnFormatDateTime($this->appointment_start_date->CurrentValue, $this->appointment_start_date->formatPattern()), false);

        // appointment_end_date
        $this->appointment_end_date->setDbValueDef($rsnew, UnFormatDateTime($this->appointment_end_date->CurrentValue, $this->appointment_end_date->formatPattern()), false);

        // appointment_description
        $this->appointment_description->setDbValueDef($rsnew, $this->appointment_description->CurrentValue, false);

        // subbmitted_by_user_id
        $this->subbmitted_by_user_id->CurrentValue = $this->subbmitted_by_user_id->getAutoUpdateValue(); // PHP
        $this->subbmitted_by_user_id->setDbValueDef($rsnew, $this->subbmitted_by_user_id->CurrentValue);

        // appointment_all_day
        $tmpBool = $this->appointment_all_day->CurrentValue;
        if ($tmpBool != "1" && $tmpBool != "0") {
            $tmpBool = !empty($tmpBool) ? "1" : "0";
        }
        $this->appointment_all_day->setDbValueDef($rsnew, $tmpBool, false);

        // user_id
        $this->user_id->setDbValueDef($rsnew, $this->user_id->CurrentValue, false);
        return $rsnew;
    }

    /**
     * Restore add form from row
     * @param array $row Row
     */
    protected function restoreAddFormFromRow($row)
    {
        if (isset($row['patient_id'])) { // patient_id
            $this->patient_id->setFormValue($row['patient_id']);
        }
        if (isset($row['appointment_title'])) { // appointment_title
            $this->appointment_title->setFormValue($row['appointment_title']);
        }
        if (isset($row['appointment_start_date'])) { // appointment_start_date
            $this->appointment_start_date->setFormValue($row['appointment_start_date']);
        }
        if (isset($row['appointment_end_date'])) { // appointment_end_date
            $this->appointment_end_date->setFormValue($row['appointment_end_date']);
        }
        if (isset($row['appointment_description'])) { // appointment_description
            $this->appointment_description->setFormValue($row['appointment_description']);
        }
        if (isset($row['subbmitted_by_user_id'])) { // subbmitted_by_user_id
            $this->subbmitted_by_user_id->setFormValue($row['subbmitted_by_user_id']);
        }
        if (isset($row['appointment_all_day'])) { // appointment_all_day
            $this->appointment_all_day->setFormValue($row['appointment_all_day']);
        }
        if (isset($row['user_id'])) { // user_id
            $this->user_id->setFormValue($row['user_id']);
        }
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("patientappointmentslist"), "", $this->TableVar, true);
        $pageId = ($this->isCopy()) ? "Copy" : "Add";
        $Breadcrumb->add("add", $pageId, $url);
    }

    // Setup lookup options
    public function setupLookupOptions($fld)
    {
        if ($fld->Lookup && $fld->Lookup->Options === null) {
            // Get default connection and filter
            $conn = $this->getConnection();
            $lookupFilter = "";

            // No need to check any more
            $fld->Lookup->Options = [];

            // Set up lookup SQL and connection
            switch ($fld->FieldVar) {
                case "x_appointment_all_day":
                    break;
                default:
                    $lookupFilter = "";
                    break;
            }

            // Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
            $sql = $fld->Lookup->getSql(false, "", $lookupFilter, $this);

            // Set up lookup cache
            if (!$fld->hasLookupOptions() && $fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0 && count($fld->Lookup->FilterFields) == 0) {
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
        if ($type == "success") {
            //$msg = "your success message";
        } elseif ($type == "failure") {
            //$msg = "your failure message";
        } elseif ($type == "warning") {
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
