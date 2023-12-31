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
class JdhInsuranceAdd extends JdhInsurance
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Page object name
    public $PageObjName = "JdhInsuranceAdd";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // CSS class/style
    public $CurrentPageName = "jdhinsuranceadd";

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

    // Set field visibility
    public function setVisibility()
    {
        $this->insurance_id->Visible = false;
        $this->insurance_name->setVisibility();
        $this->insurance_contact_person->setVisibility();
        $this->insurance_contact_person_phone->setVisibility();
        $this->insurance_contact_person_email->setVisibility();
        $this->insurance_physical_address->setVisibility();
        $this->submission_date->Visible = false;
        $this->date_updated->Visible = false;
        $this->submitted_by_user_id->Visible = false;
    }

    // Constructor
    public function __construct()
    {
        parent::__construct();
        global $Language, $DashboardReport, $DebugTimer, $UserTable;
        $this->TableVar = 'jdh_insurance';
        $this->TableName = 'jdh_insurance';

        // Table CSS class
        $this->TableClass = "table table-striped table-bordered table-hover table-sm ew-desktop-table ew-add-table";

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("app.language");

        // Table object (jdh_insurance)
        if (!isset($GLOBALS["jdh_insurance"]) || $GLOBALS["jdh_insurance"]::class == PROJECT_NAMESPACE . "jdh_insurance") {
            $GLOBALS["jdh_insurance"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'jdh_insurance');
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
                $result = ["url" => GetUrl($url), "modal" => "1"];  // Assume return to modal for simplicity
                if (
                    SameString($pageName, GetPageName($this->getListUrl())) ||
                    SameString($pageName, GetPageName($this->getViewUrl())) ||
                    SameString($pageName, GetPageName(CurrentMasterTable()?->getViewUrl() ?? ""))
                ) { // List / View / Master View page
                    if (!SameString($pageName, GetPageName($this->getListUrl()))) { // Not List page
                        $result["caption"] = $this->getModalCaption($pageName);
                        $result["view"] = SameString($pageName, "jdhinsuranceview"); // If View page, no primary button
                    } else { // List page
                        $result["error"] = $this->getFailureMessage(); // List page should not be shown as modal => error
                        $this->clearFailureMessage();
                    }
                } else { // Other pages (add messages and then clear messages)
                    $result = array_merge($this->getMessages(), ["modal" => "1"]);
                    $this->clearMessages();
                }
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
        $this->setVisibility();

        // Set lookup cache
        if (!in_array($this->PageID, Config("LOOKUP_CACHE_PAGE_IDS"))) {
            $this->setUseLookupCache(false);
        }

        // Global Page Loading event (in userfn*.php)
        DispatchEvent(new PageLoadingEvent($this), PageLoadingEvent::NAME);

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
        } elseif (Post("action", "") !== "") {
            $this->CurrentAction = Post("action"); // Get form action
            $this->setKey(Post($this->OldKeyName));
            $postBack = true;
        } else {
            // Load key values from QueryString
            if (($keyValue = Get("insurance_id") ?? Route("insurance_id")) !== null) {
                $this->insurance_id->setQueryStringValue($keyValue);
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
                    $this->terminate("jdhinsurancelist"); // No matching record, return to list
                    return;
                }
                break;
            case "insert": // Add new record
                $this->SendEmail = true; // Send email on add success
                if ($this->addRow($rsold)) { // Add successful
                    if ($this->getSuccessMessage() == "" && Post("addopt") != "1") { // Skip success message for addopt (done in JavaScript)
                        $this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
                    }
                    $returnUrl = $this->getReturnUrl();
                    if (GetPageName($returnUrl) == "jdhinsurancelist") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "jdhinsuranceview") {
                        $returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
                    }

                    // Handle UseAjaxActions
                    if ($this->IsModal && $this->UseAjaxActions) {
                        $this->IsModal = false;
                        if (GetPageName($returnUrl) != "jdhinsurancelist") {
                            Container("app.flash")->addMessage("Return-Url", $returnUrl); // Save return URL
                            $returnUrl = "jdhinsurancelist"; // Return list page content
                        }
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
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;
        $validate = !Config("SERVER_VALIDATE");

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

        // Check field name 'insurance_id' first before field var 'x_insurance_id'
        $val = $CurrentForm->hasValue("insurance_id") ? $CurrentForm->getValue("insurance_id") : $CurrentForm->getValue("x_insurance_id");
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
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
            $res = $this->showOptionLink("add");
            if (!$res) {
                $userIdMsg = DeniedMessage();
                $this->setFailureMessage($userIdMsg);
            }
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
        if ($this->RowType == RowType::VIEW) {
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
        } elseif ($this->RowType == RowType::ADD) {
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

            // Add refer script

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
            if ($this->insurance_name->Visible && $this->insurance_name->Required) {
                if (!$this->insurance_name->IsDetailKey && EmptyValue($this->insurance_name->FormValue)) {
                    $this->insurance_name->addErrorMessage(str_replace("%s", $this->insurance_name->caption(), $this->insurance_name->RequiredErrorMessage));
                }
            }
            if ($this->insurance_contact_person->Visible && $this->insurance_contact_person->Required) {
                if (!$this->insurance_contact_person->IsDetailKey && EmptyValue($this->insurance_contact_person->FormValue)) {
                    $this->insurance_contact_person->addErrorMessage(str_replace("%s", $this->insurance_contact_person->caption(), $this->insurance_contact_person->RequiredErrorMessage));
                }
            }
            if ($this->insurance_contact_person_phone->Visible && $this->insurance_contact_person_phone->Required) {
                if (!$this->insurance_contact_person_phone->IsDetailKey && EmptyValue($this->insurance_contact_person_phone->FormValue)) {
                    $this->insurance_contact_person_phone->addErrorMessage(str_replace("%s", $this->insurance_contact_person_phone->caption(), $this->insurance_contact_person_phone->RequiredErrorMessage));
                }
            }
            if ($this->insurance_contact_person_email->Visible && $this->insurance_contact_person_email->Required) {
                if (!$this->insurance_contact_person_email->IsDetailKey && EmptyValue($this->insurance_contact_person_email->FormValue)) {
                    $this->insurance_contact_person_email->addErrorMessage(str_replace("%s", $this->insurance_contact_person_email->caption(), $this->insurance_contact_person_email->RequiredErrorMessage));
                }
            }
            if ($this->insurance_physical_address->Visible && $this->insurance_physical_address->Required) {
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
            $table = $this->TableVar;
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

        // insurance_name
        $this->insurance_name->setDbValueDef($rsnew, $this->insurance_name->CurrentValue, false);

        // insurance_contact_person
        $this->insurance_contact_person->setDbValueDef($rsnew, $this->insurance_contact_person->CurrentValue, false);

        // insurance_contact_person_phone
        $this->insurance_contact_person_phone->setDbValueDef($rsnew, $this->insurance_contact_person_phone->CurrentValue, false);

        // insurance_contact_person_email
        $this->insurance_contact_person_email->setDbValueDef($rsnew, $this->insurance_contact_person_email->CurrentValue, false);

        // insurance_physical_address
        $this->insurance_physical_address->setDbValueDef($rsnew, $this->insurance_physical_address->CurrentValue, false);

        // submitted_by_user_id
        if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin
            $rsnew['submitted_by_user_id'] = CurrentUserID();
        }
        return $rsnew;
    }

    /**
     * Restore add form from row
     * @param array $row Row
     */
    protected function restoreAddFormFromRow($row)
    {
        if (isset($row['insurance_name'])) { // insurance_name
            $this->insurance_name->setFormValue($row['insurance_name']);
        }
        if (isset($row['insurance_contact_person'])) { // insurance_contact_person
            $this->insurance_contact_person->setFormValue($row['insurance_contact_person']);
        }
        if (isset($row['insurance_contact_person_phone'])) { // insurance_contact_person_phone
            $this->insurance_contact_person_phone->setFormValue($row['insurance_contact_person_phone']);
        }
        if (isset($row['insurance_contact_person_email'])) { // insurance_contact_person_email
            $this->insurance_contact_person_email->setFormValue($row['insurance_contact_person_email']);
        }
        if (isset($row['insurance_physical_address'])) { // insurance_physical_address
            $this->insurance_physical_address->setFormValue($row['insurance_physical_address']);
        }
        if (isset($row['submitted_by_user_id'])) { // submitted_by_user_id
            $this->submitted_by_user_id->setFormValue($row['submitted_by_user_id']);
        }
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
