<?php

namespace PHPMaker2023\jootidigitalhealthcare;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class JdhExaminationFindingsUpdate extends JdhExaminationFindings
{
    use MessagesTrait;

    // Page ID
    public $PageID = "update";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Page object name
    public $PageObjName = "JdhExaminationFindingsUpdate";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // CSS class/style
    public $CurrentPageName = "jdhexaminationfindingsupdate";

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
        $this->TableVar = 'jdh_examination_findings';
        $this->TableName = 'jdh_examination_findings';

        // Table CSS class
        $this->TableClass = "table table-striped table-bordered table-hover table-sm ew-desktop-table ew-update-table";

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("language");

        // Table object (jdh_examination_findings)
        if (!isset($GLOBALS["jdh_examination_findings"]) || get_class($GLOBALS["jdh_examination_findings"]) == PROJECT_NAMESPACE . "jdh_examination_findings") {
            $GLOBALS["jdh_examination_findings"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'jdh_examination_findings');
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
                    $result["view"] = $pageName == "jdhexaminationfindingsview"; // If View page, no primary button
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
            $key .= @$ar['id'];
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
            $this->id->Visible = false;
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
    public $FormClassName = "ew-form ew-update-form";
    public $IsModal = false;
    public $IsMobileOrModal = false;
    public $RecKeys;
    public $Disabled;
    public $UpdateCount = 0;

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
        $this->id->Visible = false;
        $this->patient_id->setVisibility();
        $this->general_exams->setVisibility();
        $this->systematic_exams->setVisibility();
        $this->submitted_by_user_id->setVisibility();
        $this->date_submitted->Visible = false;

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

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Try to load keys from list form
        $this->RecKeys = $this->getRecordKeys(); // Load record keys

        // Check if valid User ID
        $sql = $this->getSql($this->getFilterFromRecordKeys(false));
        $conn = $this->getConnection();
        $rows = $conn->fetchAllAssociative($sql);
        $res = true;
        foreach ($rows as $row) {
            $this->loadRowValues($row);
            if (!$this->showOptionLink("update")) {
                $userIdMsg = $Language->phrase("NoEditPermission");
                $this->setFailureMessage($userIdMsg);
                $res = false;
                break;
            }
        }
        if (!$res) {
            $this->terminate("jdhexaminationfindingslist"); // Return to list
            return;
        }
        if (Post("action") !== null && Post("action") !== "") {
            // Get action
            $this->CurrentAction = Post("action");
            $this->loadFormValues(); // Get form values

            // Validate form
            if (!$this->validateForm()) {
                $this->CurrentAction = "show"; // Form error, reset action
                if (!$this->hasInvalidFields()) { // No fields selected
                    $this->setFailureMessage($Language->phrase("NoFieldSelected"));
                }
            }
        } else {
            $this->loadMultiUpdateValues(); // Load initial values to form
        }
        if (count($this->RecKeys) <= 0) {
            $this->terminate("jdhexaminationfindingslist"); // No records selected, return to list
            return;
        }
        if ($this->isUpdate()) {
                if ($this->updateRows()) {
                    // Do not return Json for UseAjaxActions
                    if ($this->IsModal && $this->UseAjaxActions) {
                        $this->IsModal = false;
                    }
                    if ($this->getSuccessMessage() == "") {
                        $this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Set up update success message
                    }
                    $this->terminate($this->getReturnUrl()); // Return to caller
                    return;
                } elseif ($this->UseAjaxActions) { // Return JSON error message
                    WriteJson([ "success" => false, "error" => $this->getFailureMessage() ]);
                    $this->clearFailureMessage();
                    $this->terminate();
                    return;
                } else {
                    $this->restoreFormValues(); // Restore form values
                }
        }

        // Render row
        $this->RowType = ROWTYPE_EDIT; // Render edit
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

    // Load initial values to form if field values are identical in all selected records
    protected function loadMultiUpdateValues()
    {
        $this->CurrentFilter = $this->getFilterFromRecordKeys();

        // Load recordset
        if ($rs = $this->loadRecordset()) {
            $i = 1;
            while (!$rs->EOF) {
                if ($i == 1) {
                    $this->patient_id->setDbValue($rs->fields['patient_id']);
                    $this->general_exams->setDbValue($rs->fields['general_exams']);
                    $this->systematic_exams->setDbValue($rs->fields['systematic_exams']);
                    $this->submitted_by_user_id->setDbValue($rs->fields['submitted_by_user_id']);
                } else {
                    if (!CompareValue($this->patient_id->DbValue, $rs->fields['patient_id'])) {
                        $this->patient_id->CurrentValue = null;
                    }
                    if (!CompareValue($this->general_exams->DbValue, $rs->fields['general_exams'])) {
                        $this->general_exams->CurrentValue = null;
                    }
                    if (!CompareValue($this->systematic_exams->DbValue, $rs->fields['systematic_exams'])) {
                        $this->systematic_exams->CurrentValue = null;
                    }
                    if (!CompareValue($this->submitted_by_user_id->DbValue, $rs->fields['submitted_by_user_id'])) {
                        $this->submitted_by_user_id->CurrentValue = null;
                    }
                }
                $i++;
                $rs->moveNext();
            }
            $rs->close();
        }
    }

    // Set up key value
    protected function setupKeyValues($key)
    {
        $keyFld = $key;
        if (!is_numeric($keyFld)) {
            return false;
        }
        $this->id->OldValue = $keyFld;
        return true;
    }

    // Update all selected rows
    protected function updateRows()
    {
        global $Language;
        $conn = $this->getConnection();
        if ($this->UseTransaction) {
            $conn->beginTransaction();
        }
        if ($this->AuditTrailOnEdit) {
            $this->writeAuditTrailDummy($Language->phrase("BatchUpdateBegin")); // Batch update begin
        }

        // Get old records
        $this->CurrentFilter = $this->getFilterFromRecordKeys(false);
        $sql = $this->getCurrentSql();
        $rsold = $conn->fetchAllAssociative($sql);

        // Update all rows
        $successKeys = [];
        $failKeys = [];
        foreach ($this->RecKeys as $reckey) {
            if ($this->setupKeyValues($reckey)) {
                $thisKey = $reckey;
                $this->SendEmail = false; // Do not send email on update success
                $this->UpdateCount += 1; // Update record count for records being updated
                $rowUpdated = $this->editRow(); // Update this row
            } else {
                $rowUpdated = false;
            }
            if (!$rowUpdated) {
                if ($this->UseTransaction) { // Update failed
                    $successKeys = []; // Reset success keys
                    break;
                }
                $failKeys[] = $thisKey;
            } else {
                $successKeys[] = $thisKey;
            }
        }

        // Check if any rows updated
        if (count($successKeys) > 0) {
            if ($this->UseTransaction) { // Commit transaction
                $conn->commit();
            }

            // Set warning message if update some records failed
            if (count($failKeys) > 0) {
                $this->setWarningMessage(str_replace("%k", explode(", ", $failKeys), $Language->phrase("UpdateSomeRecordsFailed")));
            }

            // Get new records
            $rsnew = $conn->fetchAllAssociative($sql);
            if ($this->AuditTrailOnEdit) {
                $this->writeAuditTrailDummy($Language->phrase("BatchUpdateSuccess")); // Batch update success
            }
            $table = 'jdh_examination_findings';
            $subject = $table . " " . $Language->phrase("RecordUpdated");
            $action = $Language->phrase("ActionUpdatedMultiUpdate");
            $email = new Email();
            $email->load(Config("EMAIL_NOTIFY_TEMPLATE"));
            $email->replaceSender(Config("SENDER_EMAIL")); // Replace Sender
            $email->replaceRecipient(Config("RECIPIENT_EMAIL")); // Replace Recipient
            $email->replaceSubject($subject); // Replace Subject
            $email->replaceContent('<!--table-->', $table);
            $email->replaceContent('<!--key-->', implode(", ", $successKeys));
            $email->replaceContent('<!--action-->', $action);
            $args = ["rsold" => $rsold, "rsnew" => $rsnew];
            $emailSent = false;
            if ($this->emailSending($email, $args)) {
                $emailSent = $email->send();
            }

            // Send email failed
            if (!$emailSent) {
                $this->setFailureMessage($email->SendErrDescription);
            }
            return true;
        } else {
            if ($this->UseTransaction) { // Rollback transaction
                $conn->rollback();
            }
            if ($this->AuditTrailOnEdit) {
                $this->writeAuditTrailDummy($Language->phrase("BatchUpdateRollback")); // Batch update rollback
            }
            return false;
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

        // Check field name 'patient_id' first before field var 'x_patient_id'
        $val = $CurrentForm->hasValue("patient_id") ? $CurrentForm->getValue("patient_id") : $CurrentForm->getValue("x_patient_id");
        if (!$this->patient_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->patient_id->Visible = false; // Disable update for API request
            } else {
                $this->patient_id->setFormValue($val, true, $validate);
            }
        }
        $this->patient_id->MultiUpdate = $CurrentForm->getValue("u_patient_id");

        // Check field name 'general_exams' first before field var 'x_general_exams'
        $val = $CurrentForm->hasValue("general_exams") ? $CurrentForm->getValue("general_exams") : $CurrentForm->getValue("x_general_exams");
        if (!$this->general_exams->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->general_exams->Visible = false; // Disable update for API request
            } else {
                $this->general_exams->setFormValue($val);
            }
        }
        $this->general_exams->MultiUpdate = $CurrentForm->getValue("u_general_exams");

        // Check field name 'systematic_exams' first before field var 'x_systematic_exams'
        $val = $CurrentForm->hasValue("systematic_exams") ? $CurrentForm->getValue("systematic_exams") : $CurrentForm->getValue("x_systematic_exams");
        if (!$this->systematic_exams->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->systematic_exams->Visible = false; // Disable update for API request
            } else {
                $this->systematic_exams->setFormValue($val);
            }
        }
        $this->systematic_exams->MultiUpdate = $CurrentForm->getValue("u_systematic_exams");

        // Check field name 'submitted_by_user_id' first before field var 'x_submitted_by_user_id'
        $val = $CurrentForm->hasValue("submitted_by_user_id") ? $CurrentForm->getValue("submitted_by_user_id") : $CurrentForm->getValue("x_submitted_by_user_id");
        if (!$this->submitted_by_user_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->submitted_by_user_id->Visible = false; // Disable update for API request
            } else {
                $this->submitted_by_user_id->setFormValue($val);
            }
        }
        $this->submitted_by_user_id->MultiUpdate = $CurrentForm->getValue("u_submitted_by_user_id");

        // Check field name 'id' first before field var 'x_id'
        $val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
        if (!$this->id->IsDetailKey) {
            $this->id->setFormValue($val);
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->id->CurrentValue = $this->id->FormValue;
        $this->patient_id->CurrentValue = $this->patient_id->FormValue;
        $this->general_exams->CurrentValue = $this->general_exams->FormValue;
        $this->systematic_exams->CurrentValue = $this->systematic_exams->FormValue;
        $this->submitted_by_user_id->CurrentValue = $this->submitted_by_user_id->FormValue;
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
        $this->id->setDbValue($row['id']);
        $this->patient_id->setDbValue($row['patient_id']);
        $this->general_exams->setDbValue($row['general_exams']);
        $this->systematic_exams->setDbValue($row['systematic_exams']);
        $this->submitted_by_user_id->setDbValue($row['submitted_by_user_id']);
        $this->date_submitted->setDbValue($row['date_submitted']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id'] = $this->id->DefaultValue;
        $row['patient_id'] = $this->patient_id->DefaultValue;
        $row['general_exams'] = $this->general_exams->DefaultValue;
        $row['systematic_exams'] = $this->systematic_exams->DefaultValue;
        $row['submitted_by_user_id'] = $this->submitted_by_user_id->DefaultValue;
        $row['date_submitted'] = $this->date_submitted->DefaultValue;
        return $row;
    }

    // Render row values based on field settings
    public function renderRow()
    {
        global $Security, $Language, $CurrentLanguage;

        // Initialize URLs

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // id
        $this->id->RowCssClass = "row";

        // patient_id
        $this->patient_id->RowCssClass = "row";

        // general_exams
        $this->general_exams->RowCssClass = "row";

        // systematic_exams
        $this->systematic_exams->RowCssClass = "row";

        // submitted_by_user_id
        $this->submitted_by_user_id->RowCssClass = "row";

        // date_submitted
        $this->date_submitted->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;

            // patient_id
            $this->patient_id->ViewValue = $this->patient_id->CurrentValue;
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

            // general_exams
            $this->general_exams->ViewValue = $this->general_exams->CurrentValue;

            // systematic_exams
            $this->systematic_exams->ViewValue = $this->systematic_exams->CurrentValue;

            // submitted_by_user_id
            $this->submitted_by_user_id->ViewValue = $this->submitted_by_user_id->CurrentValue;
            $this->submitted_by_user_id->ViewValue = FormatNumber($this->submitted_by_user_id->ViewValue, $this->submitted_by_user_id->formatPattern());

            // date_submitted
            $this->date_submitted->ViewValue = $this->date_submitted->CurrentValue;
            $this->date_submitted->ViewValue = FormatDateTime($this->date_submitted->ViewValue, $this->date_submitted->formatPattern());

            // patient_id
            $this->patient_id->HrefValue = "";
            $this->patient_id->TooltipValue = "";

            // general_exams
            $this->general_exams->HrefValue = "";
            $this->general_exams->TooltipValue = "";

            // systematic_exams
            $this->systematic_exams->HrefValue = "";
            $this->systematic_exams->TooltipValue = "";

            // submitted_by_user_id
            $this->submitted_by_user_id->HrefValue = "";
            $this->submitted_by_user_id->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // patient_id
            $this->patient_id->setupEditAttributes();
            if ($this->patient_id->getSessionValue() != "") {
                $this->patient_id->CurrentValue = GetForeignKeyValue($this->patient_id->getSessionValue());
                $this->patient_id->ViewValue = $this->patient_id->CurrentValue;
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
                $this->patient_id->EditValue = HtmlEncode($this->patient_id->CurrentValue);
                $curVal = strval($this->patient_id->CurrentValue);
                if ($curVal != "") {
                    $this->patient_id->EditValue = $this->patient_id->lookupCacheOption($curVal);
                    if ($this->patient_id->EditValue === null) { // Lookup from database
                        $filterWrk = SearchFilter("`patient_id`", "=", $curVal, DATATYPE_NUMBER, "");
                        $sqlWrk = $this->patient_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                        $conn = Conn();
                        $config = $conn->getConfiguration();
                        $config->setResultCacheImpl($this->Cache);
                        $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                        $ari = count($rswrk);
                        if ($ari > 0) { // Lookup values found
                            $arwrk = $this->patient_id->Lookup->renderViewRow($rswrk[0]);
                            $this->patient_id->EditValue = $this->patient_id->displayValue($arwrk);
                        } else {
                            $this->patient_id->EditValue = HtmlEncode(FormatNumber($this->patient_id->CurrentValue, $this->patient_id->formatPattern()));
                        }
                    }
                } else {
                    $this->patient_id->EditValue = null;
                }
                $this->patient_id->PlaceHolder = RemoveHtml($this->patient_id->caption());
            }

            // general_exams
            $this->general_exams->setupEditAttributes();
            if (!$this->general_exams->Raw) {
                $this->general_exams->CurrentValue = HtmlDecode($this->general_exams->CurrentValue);
            }
            $this->general_exams->EditValue = HtmlEncode($this->general_exams->CurrentValue);
            $this->general_exams->PlaceHolder = RemoveHtml($this->general_exams->caption());

            // systematic_exams
            $this->systematic_exams->setupEditAttributes();
            if (!$this->systematic_exams->Raw) {
                $this->systematic_exams->CurrentValue = HtmlDecode($this->systematic_exams->CurrentValue);
            }
            $this->systematic_exams->EditValue = HtmlEncode($this->systematic_exams->CurrentValue);
            $this->systematic_exams->PlaceHolder = RemoveHtml($this->systematic_exams->caption());

            // submitted_by_user_id

            // Edit refer script

            // patient_id
            $this->patient_id->HrefValue = "";

            // general_exams
            $this->general_exams->HrefValue = "";

            // systematic_exams
            $this->systematic_exams->HrefValue = "";

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
        $updateCnt = 0;
        if ($this->patient_id->multiUpdateSelected()) {
            $updateCnt++;
        }
        if ($this->general_exams->multiUpdateSelected()) {
            $updateCnt++;
        }
        if ($this->systematic_exams->multiUpdateSelected()) {
            $updateCnt++;
        }
        if ($this->submitted_by_user_id->multiUpdateSelected()) {
            $updateCnt++;
        }
        if ($updateCnt == 0) {
            return false;
        }

        // Check if validation required
        if (!Config("SERVER_VALIDATE")) {
            return true;
        }
        $validateForm = true;
        if ($this->patient_id->Required) {
            if ($this->patient_id->MultiUpdate != "" && !$this->patient_id->IsDetailKey && EmptyValue($this->patient_id->FormValue)) {
                $this->patient_id->addErrorMessage(str_replace("%s", $this->patient_id->caption(), $this->patient_id->RequiredErrorMessage));
            }
        }
        if ($this->patient_id->MultiUpdate != "") {
            if (!CheckInteger($this->patient_id->FormValue)) {
                $this->patient_id->addErrorMessage($this->patient_id->getErrorMessage(false));
            }
        }
        if ($this->general_exams->Required) {
            if ($this->general_exams->MultiUpdate != "" && !$this->general_exams->IsDetailKey && EmptyValue($this->general_exams->FormValue)) {
                $this->general_exams->addErrorMessage(str_replace("%s", $this->general_exams->caption(), $this->general_exams->RequiredErrorMessage));
            }
        }
        if ($this->systematic_exams->Required) {
            if ($this->systematic_exams->MultiUpdate != "" && !$this->systematic_exams->IsDetailKey && EmptyValue($this->systematic_exams->FormValue)) {
                $this->systematic_exams->addErrorMessage(str_replace("%s", $this->systematic_exams->caption(), $this->systematic_exams->RequiredErrorMessage));
            }
        }
        if ($this->submitted_by_user_id->Required) {
            if ($this->submitted_by_user_id->MultiUpdate != "" && !$this->submitted_by_user_id->IsDetailKey && EmptyValue($this->submitted_by_user_id->FormValue)) {
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
        if ($this->patient_id->getSessionValue() != "") {
            $this->patient_id->ReadOnly = true;
        }
        $this->patient_id->setDbValueDef($rsnew, $this->patient_id->CurrentValue, 0, $this->patient_id->ReadOnly || $this->patient_id->MultiUpdate != "1");

        // general_exams
        $this->general_exams->setDbValueDef($rsnew, $this->general_exams->CurrentValue, "", $this->general_exams->ReadOnly || $this->general_exams->MultiUpdate != "1");

        // systematic_exams
        $this->systematic_exams->setDbValueDef($rsnew, $this->systematic_exams->CurrentValue, "", $this->systematic_exams->ReadOnly || $this->systematic_exams->MultiUpdate != "1");

        // submitted_by_user_id
        $this->submitted_by_user_id->CurrentValue = $this->submitted_by_user_id->getAutoUpdateValue(); // PHP
        $this->submitted_by_user_id->setDbValueDef($rsnew, $this->submitted_by_user_id->CurrentValue, 0);

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
        if ($editRow) {
            if ($this->SendEmail) {
                $this->sendEmailOnEdit($rsold, $rsnew);
            }
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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("jdhexaminationfindingslist"), "", $this->TableVar, true);
        $pageId = "update";
        $Breadcrumb->add("update", $pageId, $url);
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
