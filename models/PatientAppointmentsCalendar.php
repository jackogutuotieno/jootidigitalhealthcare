<?php

namespace PHPMaker2023\jootidigitalhealthcare;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class PatientAppointmentsCalendar extends PatientAppointments
{
    use MessagesTrait;

    // Page ID
    public $PageID = "calendar";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Page object name
    public $PageObjName = "PatientAppointmentsCalendar";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // CSS class/style
    public $ReportContainerClass = "ew-grid";
    public $CurrentPageName = "patientappointments";

    // Page URLs
    public $AddUrl;
    public $EditUrl;
    public $DeleteUrl;
    public $ViewUrl;

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
        global $Language, $DashboardReport, $DebugTimer, $UserTable;
        $this->TableVar = 'Patient_Appointments';
        $this->TableName = 'Patient Appointments';

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("language");

        // Table object (Patient_Appointments)
        if (!isset($GLOBALS["Patient_Appointments"]) || get_class($GLOBALS["Patient_Appointments"]) == PROJECT_NAMESPACE . "Patient_Appointments") {
            $GLOBALS["Patient_Appointments"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'Patient Appointments');
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
            SaveDebugMessage();
            Redirect(GetUrl($url));
        }
        return; // Return to controller
    }

    /**
     * Full calendar event object fields (see https://fullcalendar.io/docs/event-object)
     *
     * @var array
     */
    public $EventFields = [
        "id" => "appointment_id",
        "groupId" => "",
        "allDay" => "",
        "start" => "appointment_start_date",
        "end" => "appointment_end_date",
        "startStr" => null,
        "endStr" => null,
        "title" => "appointment_title",
        "url" => "",
        "classNames" => "",
        "editable" => null,
        "startEditable" => null,
        "durationEditable" => null,
        "resourceEditable" => null,
        "display" => "",
        "overlap" => null,
        "constraint" => null,
        "backgroundColor" => "",
        "borderColor" => null,
        "textColor" => null,
        "extendedProps" => null,
        "source" => null,
        "description" => "appointment_description",
    ];

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $UserProfile, $Language, $Security, $CurrentForm;

        // Use layout
        $this->UseLayout = $this->UseLayout && ConvertToBool(Param(Config("PAGE_LAYOUT"), true));

        // View
        $this->View = Get(Config("VIEW"));
        $this->CurrentAction = Param("action"); // Set up current action

        // Global Page Loading event (in userfn*.php)
        Page_Loading();

        // Page Load event
        if (method_exists($this, "pageLoad")) {
            $this->pageLoad();
        }

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Set up View/Add/Edit/Delete URL
        $this->ViewUrl = $Security->canView() ? "patientappointmentsview" : "";
        $this->AddUrl = $Security->canAdd() ? "patientappointmentsadd" : "";
        $this->EditUrl = $Security->canEdit() ? "patientappointmentsedit" : "";
        $this->DeleteUrl = $Security->canDelete() ? "patientappointmentsdelete" : "";

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

    // Get event field name
    public function getEventFieldName($id)
    {
        return $this->EventFields[$id] ?? "";
    }

    /**
     * Get events
     *
     * Note: Use ISO8601 string for date fields so FullCalendar can parse (see https://fullcalendar.io/docs/date-parsing)
     * No UTC offset specified, parsing will depend on the default time zone 'local' (see https://fullcalendar.io/docs/timeZone)
     * @return array
     */
    public function getEvents()
    {
        // Call Page Selecting event
        $this->pageSelecting($this->Filter);
        $sql = $this->buildSelectSql($this->getSqlSelect(), $this->getSqlFrom(), $this->getSqlWhere(), "", "", "", $this->Filter, "");
        $result = $sql->execute();
        $events = $result->fetchAllAssociative();
        $this->Fields['appointment_start_date']->FormatPattern = "yyyy-MM-dd'T'HH:mm:ss";
        $this->Fields['appointment_end_date']->FormatPattern = "yyyy-MM-dd'T'HH:mm:ss";
        return array_map(function ($event) {
            $this->loadRowValues($event);
            $this->resetAttributes();
            $this->RowType = ROWTYPE_VIEW;
            $this->renderRow();
            return $this->getEvent();
        }, $events);
    }

    /**
     * Load row values from record
     *
     * @param array $row Record
     * @return void
     */
    protected function loadRowValues($row)
    {
        $this->appointment_id->setDbValue($row['appointment_id']);
        $this->patient_id->setDbValue($row['patient_id']);
        $this->appointment_title->setDbValue($row['appointment_title']);
        $this->appointment_start_date->setDbValue($row['appointment_start_date']);
        $this->appointment_end_date->setDbValue($row['appointment_end_date']);
        $this->subbmitted_by_user_id->setDbValue($row['subbmitted_by_user_id']);
    }

    /**
     * Render row
     *
     * @return void
     */
    public function renderRow()
    {
        global $Security, $Language;
        $conn = $this->getConnection();

        // Call Row_Rendering event
        $this->rowRendering();

        // appointment_id

        // patient_id

        // appointment_title

        // appointment_start_date

        // appointment_end_date

        // subbmitted_by_user_id
        if ($this->RowType == ROWTYPE_VIEW) {
            // appointment_id
            $this->appointment_id->ViewValue = $this->appointment_id->CurrentValue;

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

            // appointment_title
            $this->appointment_title->ViewValue = $this->appointment_title->CurrentValue;

            // appointment_start_date
            $this->appointment_start_date->ViewValue = $this->appointment_start_date->CurrentValue;
            $this->appointment_start_date->ViewValue = FormatDateTime($this->appointment_start_date->ViewValue, $this->appointment_start_date->formatPattern());

            // appointment_end_date
            $this->appointment_end_date->ViewValue = $this->appointment_end_date->CurrentValue;
            $this->appointment_end_date->ViewValue = FormatDateTime($this->appointment_end_date->ViewValue, $this->appointment_end_date->formatPattern());

            // subbmitted_by_user_id
            $this->subbmitted_by_user_id->ViewValue = $this->subbmitted_by_user_id->CurrentValue;
            $this->subbmitted_by_user_id->ViewValue = FormatNumber($this->subbmitted_by_user_id->ViewValue, $this->subbmitted_by_user_id->formatPattern());

            // appointment_id
            $this->appointment_id->HrefValue = "";
            $this->appointment_id->TooltipValue = "";

            // patient_id
            $this->patient_id->HrefValue = "";
            $this->patient_id->TooltipValue = "";

            // appointment_title
            $this->appointment_title->HrefValue = "";
            $this->appointment_title->TooltipValue = "";

            // appointment_start_date
            $this->appointment_start_date->HrefValue = "";
            $this->appointment_start_date->TooltipValue = "";

            // appointment_end_date
            $this->appointment_end_date->HrefValue = "";
            $this->appointment_end_date->TooltipValue = "";

            // subbmitted_by_user_id
            $this->subbmitted_by_user_id->HrefValue = "";
            $this->subbmitted_by_user_id->TooltipValue = "";
        }

        // Call Row_Rendered event
        $this->rowRendered();
    }

    /**
     * Get event
     *
     * @return array Output data
     */
    protected function getEvent()
    {
        $eventListFields = ["appointment_id","patient_id","appointment_title","appointment_start_date","appointment_end_date","subbmitted_by_user_id"];
        $event = [];
        foreach ($this->Fields as $fld) {
            if ($fld->DataType == DATATYPE_BLOB || !in_array($fld->Name, $eventListFields)) { // Skip blob fields / non list fields
                continue;
            }
            $name = array_search($fld->Name, $this->EventFields) ?: $fld->Name;
            $value = $fld->isBoolean()
                ? ConvertToBool($fld->CurrentValue)
                : (is_null($fld->CurrentValue) ? "" : $fld->getViewValue());
            $event[$name] = $value;
        }
        return $event;
    }

    /**
     * Get calendar options As JSON
     *
     * @return string
     */
    public function getCalendarOptions() {
        return ArrayToJson([
            "fullCalendarOptions" => [
                "selectable" => true,
                "direction" => IsRTL() ? "rtl" : "ltr",
                "locale" => CurrentLanguageID(),
                "events" => $this->getEvents()
            ],
            "updateTable" => $this->UpdateTable,
            "viewUrl" => $this->ViewUrl,
            "editUrl" => $this->EditUrl,
            "deleteUrl" => $this->DeleteUrl,
            "addUrl" => $this->AddUrl,
            "eventFields" => $this->EventFields
        ]);
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
        $Breadcrumb->add("calendar", $this->TableVar, $url, "", $this->TableVar, true);
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

    // Set up other options
    protected function setupOtherOptions()
    {
        global $Language, $Security;

        // Filter button
        $item = &$this->FilterOptions->add("savecurrentfilter");
        $item->Body = "<a class=\"ew-save-filter\" data-form=\"fPatient_Appointmentssrch\" data-ew-action=\"none\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
        $item->Visible = false;
        $item = &$this->FilterOptions->add("deletefilter");
        $item->Body = "<a class=\"ew-delete-filter\" data-form=\"fPatient_Appointmentssrch\" data-ew-action=\"none\">" . $Language->phrase("DeleteFilter") . "</a>";
        $item->Visible = false;
        $this->FilterOptions->UseDropDownButton = true;
        $this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton;
        $this->FilterOptions->DropDownButtonPhrase = $Language->phrase("Filters");

        // Add group option item
        $item = &$this->FilterOptions->addGroupOption();
        $item->Body = "";
        $item->Visible = false;
    }

    // Set up starting group
    protected function setupStartGroup()
    {
        // Exit if no groups
        if ($this->DisplayGroups == 0) {
            return;
        }
        $startGrp = Param(Config("TABLE_START_GROUP"));
        $pageNo = Param(Config("TABLE_PAGE_NUMBER"));

        // Check for a 'start' parameter
        if ($startGrp !== null) {
            $this->StartGroup = $startGrp;
            $this->setStartGroup($this->StartGroup);
        } elseif ($pageNo !== null) {
            $pageNo = ParseInteger($pageNo);
            if (is_numeric($pageNo)) {
                $this->StartGroup = ($pageNo - 1) * $this->DisplayGroups + 1;
                if ($this->StartGroup <= 0) {
                    $this->StartGroup = 1;
                } elseif ($this->StartGroup >= intval(($this->TotalGroups - 1) / $this->DisplayGroups) * $this->DisplayGroups + 1) {
                    $this->StartGroup = intval(($this->TotalGroups - 1) / $this->DisplayGroups) * $this->DisplayGroups + 1;
                }
                $this->setStartGroup($this->StartGroup);
            } else {
                $this->StartGroup = $this->getStartGroup();
            }
        } else {
            $this->StartGroup = $this->getStartGroup();
        }

        // Check if correct start group counter
        if (!is_numeric($this->StartGroup) || intval($this->StartGroup) <= 0) { // Avoid invalid start group counter
            $this->StartGroup = 1; // Reset start group counter
            $this->setStartGroup($this->StartGroup);
        } elseif (intval($this->StartGroup) > intval($this->TotalGroups)) { // Avoid starting group > total groups
            $this->StartGroup = intval(($this->TotalGroups - 1) / $this->DisplayGroups) * $this->DisplayGroups + 1; // Point to last page first group
            $this->setStartGroup($this->StartGroup);
        } elseif (($this->StartGroup - 1) % $this->DisplayGroups != 0) {
            $this->StartGroup = intval(($this->StartGroup - 1) / $this->DisplayGroups) * $this->DisplayGroups + 1; // Point to page boundary
            $this->setStartGroup($this->StartGroup);
        }
    }

    // Reset pager
    protected function resetPager()
    {
        // Reset start position (reset command)
        $this->StartGroup = 1;
        $this->setStartGroup($this->StartGroup);
    }

    // Set up number of groups displayed per page
    protected function setupDisplayGroups()
    {
        if (Param(Config("TABLE_GROUP_PER_PAGE")) !== null) {
            $wrk = Param(Config("TABLE_GROUP_PER_PAGE"));
            if (is_numeric($wrk)) {
                $this->DisplayGroups = intval($wrk);
            } else {
                if (strtoupper($wrk) == "ALL") { // Display all groups
                    $this->DisplayGroups = -1;
                } else {
                    $this->DisplayGroups = 3; // Non-numeric, load default
                }
            }
            $this->setGroupPerPage($this->DisplayGroups); // Save to session

            // Reset start position (reset command)
            $this->StartGroup = 1;
            $this->setStartGroup($this->StartGroup);
        } else {
            if ($this->getGroupPerPage() != "") {
                $this->DisplayGroups = $this->getGroupPerPage(); // Restore from session
            } else {
                $this->DisplayGroups = 3; // Load default
            }
        }
    }

    // Get sort parameters based on sort links clicked
    protected function getSort()
    {
        if ($this->DrillDown) {
            return "";
        }
        $resetSort = Param("cmd") === "resetsort";
        $orderBy = Param("order", "");
        $orderType = Param("ordertype", "");

        // Check for a resetsort command
        if ($resetSort) {
            $this->setOrderBy("");
            $this->setStartGroup(1);
            $this->appointment_id->setSort("");
            $this->patient_id->setSort("");
            $this->appointment_title->setSort("");
            $this->appointment_start_date->setSort("");
            $this->appointment_end_date->setSort("");
            $this->subbmitted_by_user_id->setSort("");

        // Check for an Order parameter
        } elseif ($orderBy != "") {
            $this->CurrentOrder = $orderBy;
            $this->CurrentOrderType = $orderType;
            $this->updateSort($this->appointment_id); // appointment_id
            $this->updateSort($this->patient_id); // patient_id
            $this->updateSort($this->appointment_title); // appointment_title
            $this->updateSort($this->appointment_start_date); // appointment_start_date
            $this->updateSort($this->appointment_end_date); // appointment_end_date
            $this->updateSort($this->subbmitted_by_user_id); // subbmitted_by_user_id
            $sortSql = $this->sortSql();
            $this->setOrderBy($sortSql);
            $this->setStartGroup(1);
        }
        return $this->getOrderBy();
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

    // Page Selecting event
    public function pageSelecting(&$filter)
    {
        // Enter your code here
    }
}
