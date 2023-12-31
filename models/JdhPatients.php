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
 * Table class for jdh_patients
 */
class JdhPatients extends DbTable
{
    protected $SqlFrom = "";
    protected $SqlSelect = null;
    protected $SqlSelectList = null;
    protected $SqlWhere = "";
    protected $SqlGroupBy = "";
    protected $SqlHaving = "";
    protected $SqlOrderBy = "";
    public $DbErrorMessage = "";
    public $UseSessionForListSql = true;

    // Column CSS classes
    public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
    public $RightColumnClass = "col-sm-10";
    public $OffsetColumnClass = "col-sm-10 offset-sm-2";
    public $TableLeftColumnClass = "w-col-2";

    // Audit trail
    public $AuditTrailOnAdd = true;
    public $AuditTrailOnEdit = true;
    public $AuditTrailOnDelete = true;
    public $AuditTrailOnView = false;
    public $AuditTrailOnViewData = false;
    public $AuditTrailOnSearch = false;

    // Ajax / Modal
    public $UseAjaxActions = false;
    public $ModalSearch = false;
    public $ModalView = false;
    public $ModalAdd = false;
    public $ModalEdit = false;
    public $ModalUpdate = false;
    public $InlineDelete = false;
    public $ModalGridAdd = false;
    public $ModalGridEdit = false;
    public $ModalMultiEdit = false;

    // Fields
    public $patient_id;
    public $photo;
    public $patient_ip_number;
    public $patient_name;
    public $patient_dob_year;
    public $patient_age;
    public $patient_gender;
    public $patient_phone;
    public $patient_kin_name;
    public $patient_kin_phone;
    public $service_id;
    public $patient_registration_date;
    public $time;
    public $is_inpatient;
    public $submitted_by_user_id;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        parent::__construct();
        global $Language, $CurrentLanguage, $CurrentLocale;

        // Language object
        $Language = Container("app.language");
        $this->TableVar = "jdh_patients";
        $this->TableName = 'jdh_patients';
        $this->TableType = "TABLE";
        $this->ImportUseTransaction = $this->supportsTransaction() && Config("IMPORT_USE_TRANSACTION");
        $this->UseTransaction = $this->supportsTransaction() && Config("USE_TRANSACTION");

        // Update Table
        $this->UpdateTable = "jdh_patients";
        $this->Dbid = 'DB';
        $this->ExportAll = true;
        $this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)

        // PDF
        $this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
        $this->ExportPageSize = "a4"; // Page size (PDF only)

        // PhpSpreadsheet
        $this->ExportExcelPageOrientation = null; // Page orientation (PhpSpreadsheet only)
        $this->ExportExcelPageSize = null; // Page size (PhpSpreadsheet only)

        // PHPWord
        $this->ExportWordPageOrientation = ""; // Page orientation (PHPWord only)
        $this->ExportWordPageSize = ""; // Page orientation (PHPWord only)
        $this->ExportWordColumnWidth = null; // Cell width (PHPWord only)
        $this->DetailAdd = false; // Allow detail add
        $this->DetailEdit = false; // Allow detail edit
        $this->DetailView = false; // Allow detail view
        $this->ShowMultipleDetails = true; // Show multiple details
        $this->GridAddRowCount = 5;
        $this->AllowAddDeleteRow = true; // Allow add/delete row
        $this->UseAjaxActions = $this->UseAjaxActions || Config("USE_AJAX_ACTIONS");
        $this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
        $this->BasicSearch = new BasicSearch($this);
        $this->BasicSearch->TypeDefault = "OR";

        // patient_id
        $this->patient_id = new DbField(
            $this, // Table
            'x_patient_id', // Variable name
            'patient_id', // Name
            '`patient_id`', // Expression
            '`patient_id`', // Basic search expression
            20, // Type
            20, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`patient_id`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'NO' // Edit Tag
        );
        $this->patient_id->InputTextType = "text";
        $this->patient_id->Raw = true;
        $this->patient_id->IsAutoIncrement = true; // Autoincrement field
        $this->patient_id->IsPrimaryKey = true; // Primary key field
        $this->patient_id->IsForeignKey = true; // Foreign key field
        $this->patient_id->Nullable = false; // NOT NULL field
        $this->patient_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->patient_id->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['patient_id'] = &$this->patient_id;

        // photo
        $this->photo = new DbField(
            $this, // Table
            'x_photo', // Variable name
            'photo', // Name
            '`photo`', // Expression
            '`photo`', // Basic search expression
            205, // Type
            16777215, // Size
            -1, // Date/Time format
            true, // Is upload field
            '`photo`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'IMAGE', // View Tag
            'FILE' // Edit Tag
        );
        $this->photo->InputTextType = "text";
        $this->photo->Raw = true;
        $this->photo->Sortable = false; // Allow sort
        $this->photo->SearchOperators = ["=", "<>", "IS NULL", "IS NOT NULL"];
        $this->Fields['photo'] = &$this->photo;

        // patient_ip_number
        $this->patient_ip_number = new DbField(
            $this, // Table
            'x_patient_ip_number', // Variable name
            'patient_ip_number', // Name
            '`patient_ip_number`', // Expression
            '`patient_ip_number`', // Basic search expression
            129, // Type
            13, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`patient_ip_number`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->patient_ip_number->InputTextType = "text";
        $this->patient_ip_number->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['patient_ip_number'] = &$this->patient_ip_number;

        // patient_name
        $this->patient_name = new DbField(
            $this, // Table
            'x_patient_name', // Variable name
            'patient_name', // Name
            '`patient_name`', // Expression
            '`patient_name`', // Basic search expression
            200, // Type
            50, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`patient_name`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->patient_name->InputTextType = "text";
        $this->patient_name->Nullable = false; // NOT NULL field
        $this->patient_name->Required = true; // Required field
        $this->patient_name->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY"];
        $this->Fields['patient_name'] = &$this->patient_name;

        // patient_dob_year
        $this->patient_dob_year = new DbField(
            $this, // Table
            'x_patient_dob_year', // Variable name
            'patient_dob_year', // Name
            '`patient_dob_year`', // Expression
            '`patient_dob_year`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`patient_dob_year`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->patient_dob_year->InputTextType = "text";
        $this->patient_dob_year->Raw = true;
        $this->patient_dob_year->Nullable = false; // NOT NULL field
        $this->patient_dob_year->Required = true; // Required field
        $this->patient_dob_year->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->patient_dob_year->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['patient_dob_year'] = &$this->patient_dob_year;

        // patient_age
        $this->patient_age = new DbField(
            $this, // Table
            'x_patient_age', // Variable name
            'patient_age', // Name
            '(SELECT YEAR(CURRENT_DATE())) - patient_dob_year', // Expression
            '(SELECT YEAR(CURRENT_DATE())) - patient_dob_year', // Basic search expression
            20, // Type
            12, // Size
            -1, // Date/Time format
            false, // Is upload field
            '(SELECT YEAR(CURRENT_DATE())) - patient_dob_year', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'HIDDEN' // Edit Tag
        );
        $this->patient_age->InputTextType = "text";
        $this->patient_age->Raw = true;
        $this->patient_age->IsCustom = true; // Custom field
        $this->patient_age->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->patient_age->SearchOperators = ["=", "<>", "IS NULL", "IS NOT NULL"];
        $this->Fields['patient_age'] = &$this->patient_age;

        // patient_gender
        $this->patient_gender = new DbField(
            $this, // Table
            'x_patient_gender', // Variable name
            'patient_gender', // Name
            '`patient_gender`', // Expression
            '`patient_gender`', // Basic search expression
            200, // Type
            10, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`patient_gender`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'SELECT' // Edit Tag
        );
        $this->patient_gender->InputTextType = "text";
        $this->patient_gender->Nullable = false; // NOT NULL field
        $this->patient_gender->Required = true; // Required field
        $this->patient_gender->setSelectMultiple(false); // Select one
        $this->patient_gender->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->patient_gender->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->patient_gender->Lookup = new Lookup($this->patient_gender, 'jdh_patients', false, '', ["","","",""], '', '', [], [], [], [], [], [], false, '', '', "");
        $this->patient_gender->OptionCount = 2;
        $this->patient_gender->SearchOperators = ["=", "<>"];
        $this->Fields['patient_gender'] = &$this->patient_gender;

        // patient_phone
        $this->patient_phone = new DbField(
            $this, // Table
            'x_patient_phone', // Variable name
            'patient_phone', // Name
            '`patient_phone`', // Expression
            '`patient_phone`', // Basic search expression
            129, // Type
            15, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`patient_phone`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->patient_phone->addMethod("getLinkPrefix", fn() => "tel:");
        $this->patient_phone->InputTextType = "text";
        $this->patient_phone->Nullable = false; // NOT NULL field
        $this->patient_phone->Required = true; // Required field
        $this->patient_phone->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY"];
        $this->Fields['patient_phone'] = &$this->patient_phone;

        // patient_kin_name
        $this->patient_kin_name = new DbField(
            $this, // Table
            'x_patient_kin_name', // Variable name
            'patient_kin_name', // Name
            '`patient_kin_name`', // Expression
            '`patient_kin_name`', // Basic search expression
            200, // Type
            100, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`patient_kin_name`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->patient_kin_name->InputTextType = "text";
        $this->patient_kin_name->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['patient_kin_name'] = &$this->patient_kin_name;

        // patient_kin_phone
        $this->patient_kin_phone = new DbField(
            $this, // Table
            'x_patient_kin_phone', // Variable name
            'patient_kin_phone', // Name
            '`patient_kin_phone`', // Expression
            '`patient_kin_phone`', // Basic search expression
            129, // Type
            15, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`patient_kin_phone`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->patient_kin_phone->InputTextType = "text";
        $this->patient_kin_phone->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['patient_kin_phone'] = &$this->patient_kin_phone;

        // service_id
        $this->service_id = new DbField(
            $this, // Table
            'x_service_id', // Variable name
            'service_id', // Name
            '`service_id`', // Expression
            '`service_id`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`service_id`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'SELECT' // Edit Tag
        );
        $this->service_id->addMethod("getSelectFilter", fn() => "`service_id`=1");
        $this->service_id->InputTextType = "text";
        $this->service_id->Raw = true;
        $this->service_id->Nullable = false; // NOT NULL field
        $this->service_id->Required = true; // Required field
        $this->service_id->setSelectMultiple(false); // Select one
        $this->service_id->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->service_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->service_id->Lookup = new Lookup($this->service_id, 'jdh_services', false, 'service_id', ["service_cost","","",""], '', '', [], [], [], [], [], [], false, '', '', "`service_cost`");
        $this->service_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->service_id->SearchOperators = ["=", "<>", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['service_id'] = &$this->service_id;

        // patient_registration_date
        $this->patient_registration_date = new DbField(
            $this, // Table
            'x_patient_registration_date', // Variable name
            'patient_registration_date', // Name
            '`patient_registration_date`', // Expression
            CastDateFieldForLike("`patient_registration_date`", 7, "DB"), // Basic search expression
            135, // Type
            19, // Size
            7, // Date/Time format
            false, // Is upload field
            '`patient_registration_date`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->patient_registration_date->InputTextType = "text";
        $this->patient_registration_date->Raw = true;
        $this->patient_registration_date->Nullable = false; // NOT NULL field
        $this->patient_registration_date->Required = true; // Required field
        $this->patient_registration_date->DefaultErrorMessage = str_replace("%s", DateFormat(7), $Language->phrase("IncorrectDate"));
        $this->patient_registration_date->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['patient_registration_date'] = &$this->patient_registration_date;

        // time
        $this->time = new DbField(
            $this, // Table
            'x_time', // Variable name
            'time', // Name
            'TIME(patient_registration_date)', // Expression
            CastDateFieldForLike("TIME(patient_registration_date)", 4, "DB"), // Basic search expression
            134, // Type
            10, // Size
            4, // Date/Time format
            false, // Is upload field
            'TIME(patient_registration_date)', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->time->InputTextType = "text";
        $this->time->Raw = true;
        $this->time->IsCustom = true; // Custom field
        $this->time->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->time->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['time'] = &$this->time;

        // is_inpatient
        $this->is_inpatient = new DbField(
            $this, // Table
            'x_is_inpatient', // Variable name
            'is_inpatient', // Name
            '`is_inpatient`', // Expression
            '`is_inpatient`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`is_inpatient`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'SELECT' // Edit Tag
        );
        $this->is_inpatient->InputTextType = "text";
        $this->is_inpatient->Raw = true;
        $this->is_inpatient->Nullable = false; // NOT NULL field
        $this->is_inpatient->Required = true; // Required field
        $this->is_inpatient->setSelectMultiple(false); // Select one
        $this->is_inpatient->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->is_inpatient->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->is_inpatient->Lookup = new Lookup($this->is_inpatient, 'jdh_patients', false, '', ["","","",""], '', '', [], [], [], [], [], [], false, '', '', "");
        $this->is_inpatient->OptionCount = 2;
        $this->is_inpatient->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->is_inpatient->SearchOperators = ["=", "<>", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['is_inpatient'] = &$this->is_inpatient;

        // submitted_by_user_id
        $this->submitted_by_user_id = new DbField(
            $this, // Table
            'x_submitted_by_user_id', // Variable name
            'submitted_by_user_id', // Name
            '`submitted_by_user_id`', // Expression
            '`submitted_by_user_id`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`submitted_by_user_id`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->submitted_by_user_id->addMethod("getAutoUpdateValue", fn() => CurrentUserID());
        $this->submitted_by_user_id->InputTextType = "text";
        $this->submitted_by_user_id->Raw = true;
        $this->submitted_by_user_id->Nullable = false; // NOT NULL field
        $this->submitted_by_user_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->submitted_by_user_id->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['submitted_by_user_id'] = &$this->submitted_by_user_id;

        // Add Doctrine Cache
        $this->Cache = new \Symfony\Component\Cache\Adapter\ArrayAdapter();
        $this->CacheProfile = new \Doctrine\DBAL\Cache\QueryCacheProfile(0, $this->TableVar);

        // Call Table Load event
        $this->tableLoad();
    }

    // Field Visibility
    public function getFieldVisibility($fldParm)
    {
        global $Security;
        return $this->$fldParm->Visible; // Returns original value
    }

    // Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
    public function setLeftColumnClass($class)
    {
        if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
            $this->LeftColumnClass = $class . " col-form-label ew-label";
            $this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
            $this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
            $this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
        }
    }

    // Single column sort
    public function updateSort(&$fld)
    {
        if ($this->CurrentOrder == $fld->Name) {
            $sortField = $fld->Expression;
            $lastSort = $fld->getSort();
            if (in_array($this->CurrentOrderType, ["ASC", "DESC", "NO"])) {
                $curSort = $this->CurrentOrderType;
            } else {
                $curSort = $lastSort;
            }
            $orderBy = in_array($curSort, ["ASC", "DESC"]) ? $sortField . " " . $curSort : "";
            $this->setSessionOrderBy($orderBy); // Save to Session
        }
    }

    // Update field sort
    public function updateFieldSort()
    {
        $orderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
        $flds = GetSortFields($orderBy);
        foreach ($this->Fields as $field) {
            $fldSort = "";
            foreach ($flds as $fld) {
                if ($fld[0] == $field->Expression || $fld[0] == $field->VirtualExpression) {
                    $fldSort = $fld[1];
                }
            }
            $field->setSort($fldSort);
        }
    }

    // Current detail table name
    public function getCurrentDetailTable()
    {
        return Session(PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_DETAIL_TABLE")) ?? "";
    }

    public function setCurrentDetailTable($v)
    {
        $_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_DETAIL_TABLE")] = $v;
    }

    // Get detail url
    public function getDetailUrl()
    {
        // Detail url
        $detailUrl = "";
        if ($this->getCurrentDetailTable() == "jdh_patient_visits") {
            $detailUrl = Container("jdh_patient_visits")->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
            $detailUrl .= "&" . GetForeignKeyUrl("fk_patient_id", $this->patient_id->CurrentValue);
        }
        if ($this->getCurrentDetailTable() == "jdh_chief_complaints") {
            $detailUrl = Container("jdh_chief_complaints")->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
            $detailUrl .= "&" . GetForeignKeyUrl("fk_patient_id", $this->patient_id->CurrentValue);
        }
        if ($this->getCurrentDetailTable() == "jdh_examination_findings") {
            $detailUrl = Container("jdh_examination_findings")->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
            $detailUrl .= "&" . GetForeignKeyUrl("fk_patient_id", $this->patient_id->CurrentValue);
        }
        if ($this->getCurrentDetailTable() == "jdh_patient_cases") {
            $detailUrl = Container("jdh_patient_cases")->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
            $detailUrl .= "&" . GetForeignKeyUrl("fk_patient_id", $this->patient_id->CurrentValue);
        }
        if ($this->getCurrentDetailTable() == "jdh_prescriptions") {
            $detailUrl = Container("jdh_prescriptions")->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
            $detailUrl .= "&" . GetForeignKeyUrl("fk_patient_id", $this->patient_id->CurrentValue);
        }
        if ($this->getCurrentDetailTable() == "jdh_prescriptions_actions") {
            $detailUrl = Container("jdh_prescriptions_actions")->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
            $detailUrl .= "&" . GetForeignKeyUrl("fk_patient_id", $this->patient_id->CurrentValue);
        }
        if ($this->getCurrentDetailTable() == "jdh_appointments") {
            $detailUrl = Container("jdh_appointments")->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
            $detailUrl .= "&" . GetForeignKeyUrl("fk_patient_id", $this->patient_id->CurrentValue);
        }
        if ($this->getCurrentDetailTable() == "jdh_vitals") {
            $detailUrl = Container("jdh_vitals")->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
            $detailUrl .= "&" . GetForeignKeyUrl("fk_patient_id", $this->patient_id->CurrentValue);
        }
        if ($this->getCurrentDetailTable() == "jdh_test_requests") {
            $detailUrl = Container("jdh_test_requests")->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
            $detailUrl .= "&" . GetForeignKeyUrl("fk_patient_id", $this->patient_id->CurrentValue);
        }
        if ($this->getCurrentDetailTable() == "jdh_test_reports") {
            $detailUrl = Container("jdh_test_reports")->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
            $detailUrl .= "&" . GetForeignKeyUrl("fk_patient_id", $this->patient_id->CurrentValue);
        }
        if ($detailUrl == "") {
            $detailUrl = "jdhpatientslist";
        }
        return $detailUrl;
    }

    // Render X Axis for chart
    public function renderChartXAxis($chartVar, $chartRow)
    {
        return $chartRow;
    }

    // Get FROM clause
    public function getSqlFrom()
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "jdh_patients";
    }

    // Get FROM clause (for backward compatibility)
    public function sqlFrom()
    {
        return $this->getSqlFrom();
    }

    // Set FROM clause
    public function setSqlFrom($v)
    {
        $this->SqlFrom = $v;
    }

    // Get SELECT clause
    public function getSqlSelect() // Select
    {
        return $this->SqlSelect ?? $this->getQueryBuilder()->select($this->sqlSelectFields());
    }

    // Get list of fields
    private function sqlSelectFields()
    {
        return "*, (SELECT YEAR(CURRENT_DATE())) - patient_dob_year AS `patient_age`, TIME(patient_registration_date) AS `time`";
    }

    // Get SELECT clause (for backward compatibility)
    public function sqlSelect()
    {
        return $this->getSqlSelect();
    }

    // Set SELECT clause
    public function setSqlSelect($v)
    {
        $this->SqlSelect = $v;
    }

    // Get WHERE clause
    public function getSqlWhere()
    {
        $where = ($this->SqlWhere != "") ? $this->SqlWhere : "";
        $this->DefaultFilter = "";
        AddFilter($where, $this->DefaultFilter);
        return $where;
    }

    // Get WHERE clause (for backward compatibility)
    public function sqlWhere()
    {
        return $this->getSqlWhere();
    }

    // Set WHERE clause
    public function setSqlWhere($v)
    {
        $this->SqlWhere = $v;
    }

    // Get GROUP BY clause
    public function getSqlGroupBy()
    {
        return $this->SqlGroupBy != "" ? $this->SqlGroupBy : "";
    }

    // Get GROUP BY clause (for backward compatibility)
    public function sqlGroupBy()
    {
        return $this->getSqlGroupBy();
    }

    // set GROUP BY clause
    public function setSqlGroupBy($v)
    {
        $this->SqlGroupBy = $v;
    }

    // Get HAVING clause
    public function getSqlHaving() // Having
    {
        return ($this->SqlHaving != "") ? $this->SqlHaving : "";
    }

    // Get HAVING clause (for backward compatibility)
    public function sqlHaving()
    {
        return $this->getSqlHaving();
    }

    // Set HAVING clause
    public function setSqlHaving($v)
    {
        $this->SqlHaving = $v;
    }

    // Get ORDER BY clause
    public function getSqlOrderBy()
    {
        return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "";
    }

    // Get ORDER BY clause (for backward compatibility)
    public function sqlOrderBy()
    {
        return $this->getSqlOrderBy();
    }

    // set ORDER BY clause
    public function setSqlOrderBy($v)
    {
        $this->SqlOrderBy = $v;
    }

    // Apply User ID filters
    public function applyUserIDFilters($filter, $id = "")
    {
        global $Security;
        // Add User ID filter
        if ($Security->currentUserID() != "" && !$Security->isAdmin()) { // Non system admin
            $filter = $this->addUserIDFilter($filter, $id);
        }
        return $filter;
    }

    // Check if User ID security allows view all
    public function userIDAllow($id = "")
    {
        $allow = $this->UserIDAllowSecurity;
        switch ($id) {
            case "add":
            case "copy":
            case "gridadd":
            case "register":
            case "addopt":
                return ($allow & Allow::ADD->value) == Allow::ADD->value;
            case "edit":
            case "gridedit":
            case "update":
            case "changepassword":
            case "resetpassword":
                return ($allow & Allow::EDIT->value) == Allow::EDIT->value;
            case "delete":
                return ($allow & Allow::DELETE->value) == Allow::DELETE->value;
            case "view":
                return ($allow & Allow::VIEW->value) == Allow::VIEW->value;
            case "search":
                return ($allow & Allow::SEARCH->value) == Allow::SEARCH->value;
            case "lookup":
                return ($allow & Allow::LOOKUP->value) == Allow::LOOKUP->value;
            default:
                return ($allow & Allow::LIST->value) == Allow::LIST->value;
        }
    }

    /**
     * Get record count
     *
     * @param string|QueryBuilder $sql SQL or QueryBuilder
     * @param mixed $c Connection
     * @return int
     */
    public function getRecordCount($sql, $c = null)
    {
        $cnt = -1;
        $sqlwrk = $sql instanceof QueryBuilder // Query builder
            ? (clone $sql)->resetQueryPart("orderBy")->getSQL()
            : $sql;
        $pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';
        // Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
        if (
            in_array($this->TableType, ["TABLE", "VIEW", "LINKTABLE"]) &&
            preg_match($pattern, $sqlwrk) &&
            !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sqlwrk) &&
            !preg_match('/^\s*SELECT\s+DISTINCT\s+/i', $sqlwrk) &&
            !preg_match('/\s+ORDER\s+BY\s+/i', $sqlwrk)
        ) {
            $sqlcnt = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sqlwrk);
        } else {
            $sqlcnt = "SELECT COUNT(*) FROM (" . $sqlwrk . ") COUNT_TABLE";
        }
        $conn = $c ?? $this->getConnection();
        $cnt = $conn->fetchOne($sqlcnt);
        if ($cnt !== false) {
            return (int)$cnt;
        }
        // Unable to get count by SELECT COUNT(*), execute the SQL to get record count directly
        $result = $conn->executeQuery($sqlwrk);
        $cnt = $result->rowCount();
        if ($cnt == 0) { // Unable to get record count, count directly
            while ($result->fetch()) {
                $cnt++;
            }
        }
        return $cnt;
    }

    // Get SQL
    public function getSql($where, $orderBy = "")
    {
        return $this->getSqlAsQueryBuilder($where, $orderBy)->getSQL();
    }

    // Get QueryBuilder
    public function getSqlAsQueryBuilder($where, $orderBy = "")
    {
        return $this->buildSelectSql(
            $this->getSqlSelect(),
            $this->getSqlFrom(),
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $where,
            $orderBy
        );
    }

    // Table SQL
    public function getCurrentSql()
    {
        $filter = $this->CurrentFilter;
        $filter = $this->applyUserIDFilters($filter);
        $sort = $this->getSessionOrderBy();
        return $this->getSql($filter, $sort);
    }

    /**
     * Table SQL with List page filter
     *
     * @return QueryBuilder
     */
    public function getListSql()
    {
        $filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $select = $this->getSqlSelect();
        $from = $this->getSqlFrom();
        $sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
        $this->Sort = $sort;
        return $this->buildSelectSql(
            $select,
            $from,
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $filter,
            $sort
        );
    }

    // Get ORDER BY clause
    public function getOrderBy()
    {
        $orderBy = $this->getSqlOrderBy();
        $sort = $this->getSessionOrderBy();
        if ($orderBy != "" && $sort != "") {
            $orderBy .= ", " . $sort;
        } elseif ($sort != "") {
            $orderBy = $sort;
        }
        return $orderBy;
    }

    // Get record count based on filter (for detail record count in master table pages)
    public function loadRecordCount($filter)
    {
        $origFilter = $this->CurrentFilter;
        $this->CurrentFilter = $filter;
        $this->recordsetSelecting($this->CurrentFilter);
        $isCustomView = $this->TableType == "CUSTOMVIEW";
        $select = $isCustomView ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $isCustomView ? $this->getSqlGroupBy() : "";
        $having = $isCustomView ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
        $cnt = $this->getRecordCount($sql);
        $this->CurrentFilter = $origFilter;
        return $cnt;
    }

    // Get record count (for current List page)
    public function listRecordCount()
    {
        $filter = $this->getSessionWhere();
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $isCustomView = $this->TableType == "CUSTOMVIEW";
        $select = $isCustomView ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $isCustomView ? $this->getSqlGroupBy() : "";
        $having = $isCustomView ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
        $cnt = $this->getRecordCount($sql);
        return $cnt;
    }

    /**
     * INSERT statement
     *
     * @param mixed $rs
     * @return QueryBuilder
     */
    public function insertSql(&$rs)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->insert($this->UpdateTable);
        $platform = $this->getConnection()->getDatabasePlatform();
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom) {
                continue;
            }
            $field = $this->Fields[$name];
            $parm = $queryBuilder->createPositionalParameter($value, $field->getParameterType());
            $parm = $field->CustomDataType?->convertToDatabaseValueSQL($parm, $platform) ?? $parm; // Convert database SQL
            $queryBuilder->setValue($field->Expression, $parm);
        }
        return $queryBuilder;
    }

    // Insert
    public function insert(&$rs)
    {
        $conn = $this->getConnection();
        try {
            $queryBuilder = $this->insertSql($rs);
            $result = $queryBuilder->executeStatement();
            $this->DbErrorMessage = "";
        } catch (\Exception $e) {
            $result = false;
            $this->DbErrorMessage = $e->getMessage();
        }
        if ($result) {
            $this->patient_id->setDbValue($conn->lastInsertId());
            $rs['patient_id'] = $this->patient_id->DbValue;
            if ($this->AuditTrailOnAdd) {
                $this->writeAuditTrailOnAdd($rs);
            }
        }
        return $result;
    }

    /**
     * UPDATE statement
     *
     * @param array $rs Data to be updated
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    public function updateSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->update($this->UpdateTable);
        $platform = $this->getConnection()->getDatabasePlatform();
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom || $this->Fields[$name]->IsAutoIncrement) {
                continue;
            }
            $field = $this->Fields[$name];
            $parm = $queryBuilder->createPositionalParameter($value, $field->getParameterType());
            $parm = $field->CustomDataType?->convertToDatabaseValueSQL($parm, $platform) ?? $parm; // Convert database SQL
            $queryBuilder->set($field->Expression, $parm);
        }
        $filter = $curfilter ? $this->CurrentFilter : "";
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        AddFilter($filter, $where);
        if ($filter != "") {
            $queryBuilder->where($filter);
        }
        return $queryBuilder;
    }

    // Update
    public function update(&$rs, $where = "", $rsold = null, $curfilter = true)
    {
        // If no field is updated, execute may return 0. Treat as success
        try {
            $success = $this->updateSql($rs, $where, $curfilter)->executeStatement();
            $success = $success > 0 ? $success : true;
            $this->DbErrorMessage = "";
        } catch (\Exception $e) {
            $success = false;
            $this->DbErrorMessage = $e->getMessage();
        }

        // Return auto increment field
        if ($success) {
            if (!isset($rs['patient_id']) && !EmptyValue($this->patient_id->CurrentValue)) {
                $rs['patient_id'] = $this->patient_id->CurrentValue;
            }
        }
        if ($success && $this->AuditTrailOnEdit && $rsold) {
            $rsaudit = $rs;
            $fldname = 'patient_id';
            if (!array_key_exists($fldname, $rsaudit)) {
                $rsaudit[$fldname] = $rsold[$fldname];
            }
            $this->writeAuditTrailOnEdit($rsold, $rsaudit);
        }
        return $success;
    }

    /**
     * DELETE statement
     *
     * @param array $rs Key values
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    public function deleteSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->delete($this->UpdateTable);
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        if ($rs) {
            if (array_key_exists('patient_id', $rs)) {
                AddFilter($where, QuotedName('patient_id', $this->Dbid) . '=' . QuotedValue($rs['patient_id'], $this->patient_id->DataType, $this->Dbid));
            }
        }
        $filter = $curfilter ? $this->CurrentFilter : "";
        AddFilter($filter, $where);
        return $queryBuilder->where($filter != "" ? $filter : "0=1");
    }

    // Delete
    public function delete(&$rs, $where = "", $curfilter = false)
    {
        $success = true;
        if ($success) {
            try {
                $success = $this->deleteSql($rs, $where, $curfilter)->executeStatement();
                $this->DbErrorMessage = "";
            } catch (\Exception $e) {
                $success = false;
                $this->DbErrorMessage = $e->getMessage();
            }
        }
        if ($success && $this->AuditTrailOnDelete) {
            $this->writeAuditTrailOnDelete($rs);
        }
        return $success;
    }

    // Load DbValue from result set or array
    protected function loadDbValues($row)
    {
        if (!is_array($row)) {
            return;
        }
        $this->patient_id->DbValue = $row['patient_id'];
        $this->photo->Upload->DbValue = $row['photo'];
        $this->patient_ip_number->DbValue = $row['patient_ip_number'];
        $this->patient_name->DbValue = $row['patient_name'];
        $this->patient_dob_year->DbValue = $row['patient_dob_year'];
        $this->patient_age->DbValue = $row['patient_age'];
        $this->patient_gender->DbValue = $row['patient_gender'];
        $this->patient_phone->DbValue = $row['patient_phone'];
        $this->patient_kin_name->DbValue = $row['patient_kin_name'];
        $this->patient_kin_phone->DbValue = $row['patient_kin_phone'];
        $this->service_id->DbValue = $row['service_id'];
        $this->patient_registration_date->DbValue = $row['patient_registration_date'];
        $this->time->DbValue = $row['time'];
        $this->is_inpatient->DbValue = $row['is_inpatient'];
        $this->submitted_by_user_id->DbValue = $row['submitted_by_user_id'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`patient_id` = @patient_id@";
    }

    // Get Key
    public function getKey($current = false, $keySeparator = null)
    {
        $keys = [];
        $val = $current ? $this->patient_id->CurrentValue : $this->patient_id->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
        $keySeparator ??= Config("COMPOSITE_KEY_SEPARATOR");
        return implode($keySeparator, $keys);
    }

    // Set Key
    public function setKey($key, $current = false, $keySeparator = null)
    {
        $keySeparator ??= Config("COMPOSITE_KEY_SEPARATOR");
        $this->OldKey = strval($key);
        $keys = explode($keySeparator, $this->OldKey);
        if (count($keys) == 1) {
            if ($current) {
                $this->patient_id->CurrentValue = $keys[0];
            } else {
                $this->patient_id->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null, $current = false)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('patient_id', $row) ? $row['patient_id'] : null;
        } else {
            $val = !EmptyValue($this->patient_id->OldValue) && !$current ? $this->patient_id->OldValue : $this->patient_id->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@patient_id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
        }
        return $keyFilter;
    }

    // Return page URL
    public function getReturnUrl()
    {
        $referUrl = ReferUrl();
        $referPageName = ReferPageName();
        $name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");
        // Get referer URL automatically
        if ($referUrl != "" && $referPageName != CurrentPageName() && $referPageName != "login") { // Referer not same page or login page
            $_SESSION[$name] = $referUrl; // Save to Session
        }
        return $_SESSION[$name] ?? GetUrl("jdhpatientslist");
    }

    // Set return page URL
    public function setReturnUrl($v)
    {
        $_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
    }

    // Get modal caption
    public function getModalCaption($pageName)
    {
        global $Language;
        return match ($pageName) {
            "jdhpatientsview" => $Language->phrase("View"),
            "jdhpatientsedit" => $Language->phrase("Edit"),
            "jdhpatientsadd" => $Language->phrase("Add"),
            default => ""
        };
    }

    // Default route URL
    public function getDefaultRouteUrl()
    {
        return "jdhpatientslist";
    }

    // API page name
    public function getApiPageName($action)
    {
        return match (strtolower($action)) {
            Config("API_VIEW_ACTION") => "JdhPatientsView",
            Config("API_ADD_ACTION") => "JdhPatientsAdd",
            Config("API_EDIT_ACTION") => "JdhPatientsEdit",
            Config("API_DELETE_ACTION") => "JdhPatientsDelete",
            Config("API_LIST_ACTION") => "JdhPatientsList",
            default => ""
        };
    }

    // Current URL
    public function getCurrentUrl($parm = "")
    {
        $url = CurrentPageUrl(false);
        if ($parm != "") {
            $url = $this->keyUrl($url, $parm);
        } else {
            $url = $this->keyUrl($url, Config("TABLE_SHOW_DETAIL") . "=");
        }
        return $this->addMasterUrl($url);
    }

    // List URL
    public function getListUrl()
    {
        return "jdhpatientslist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("jdhpatientsview", $parm);
        } else {
            $url = $this->keyUrl("jdhpatientsview", Config("TABLE_SHOW_DETAIL") . "=");
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "jdhpatientsadd?" . $parm;
        } else {
            $url = "jdhpatientsadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("jdhpatientsedit", $parm);
        } else {
            $url = $this->keyUrl("jdhpatientsedit", Config("TABLE_SHOW_DETAIL") . "=");
        }
        return $this->addMasterUrl($url);
    }

    // Inline edit URL
    public function getInlineEditUrl()
    {
        $url = $this->keyUrl("jdhpatientslist", "action=edit");
        return $this->addMasterUrl($url);
    }

    // Copy URL
    public function getCopyUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("jdhpatientsadd", $parm);
        } else {
            $url = $this->keyUrl("jdhpatientsadd", Config("TABLE_SHOW_DETAIL") . "=");
        }
        return $this->addMasterUrl($url);
    }

    // Inline copy URL
    public function getInlineCopyUrl()
    {
        $url = $this->keyUrl("jdhpatientslist", "action=copy");
        return $this->addMasterUrl($url);
    }

    // Delete URL
    public function getDeleteUrl($parm = "")
    {
        if ($this->UseAjaxActions && ConvertToBool(Param("infinitescroll")) && CurrentPageID() == "list") {
            return $this->keyUrl(GetApiUrl(Config("API_DELETE_ACTION") . "/" . $this->TableVar));
        } else {
            return $this->keyUrl("jdhpatientsdelete", $parm);
        }
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "\"patient_id\":" . VarToJson($this->patient_id->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->patient_id->CurrentValue !== null) {
            $url .= "/" . $this->encodeKeyValue($this->patient_id->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
        if ($parm != "") {
            $url .= "?" . $parm;
        }
        return $url;
    }

    // Render sort
    public function renderFieldHeader($fld)
    {
        global $Security, $Language;
        $sortUrl = "";
        $attrs = "";
        if ($this->PageID != "grid" && $fld->Sortable) {
            $sortUrl = $this->sortUrl($fld);
            $attrs = ' role="button" data-ew-action="sort" data-ajax="' . ($this->UseAjaxActions ? "true" : "false") . '" data-sort-url="' . $sortUrl . '" data-sort-type="1"';
            if ($this->ContextClass) { // Add context
                $attrs .= ' data-context="' . HtmlEncode($this->ContextClass) . '"';
            }
        }
        $html = '<div class="ew-table-header-caption"' . $attrs . '>' . $fld->caption() . '</div>';
        if ($sortUrl) {
            $html .= '<div class="ew-table-header-sort">' . $fld->getSortIcon() . '</div>';
        }
        if ($this->PageID != "grid" && !$this->isExport() && $fld->UseFilter && $Security->canSearch()) {
            $html .= '<div class="ew-filter-dropdown-btn" data-ew-action="filter" data-table="' . $fld->TableVar . '" data-field="' . $fld->FieldVar .
                '"><div class="ew-table-header-filter" role="button" aria-haspopup="true">' . $Language->phrase("Filter") .
                (is_array($fld->EditValue) ? str_replace("%c", count($fld->EditValue), $Language->phrase("FilterCount")) : '') .
                '</div></div>';
        }
        $html = '<div class="ew-table-header-btn">' . $html . '</div>';
        if ($this->UseCustomTemplate) {
            $scriptId = str_replace("{id}", $fld->TableVar . "_" . $fld->Param, "tpc_{id}");
            $html = '<template id="' . $scriptId . '">' . $html . '</template>';
        }
        return $html;
    }

    // Sort URL
    public function sortUrl($fld)
    {
        global $DashboardReport;
        if (
            $this->CurrentAction || $this->isExport() ||
            in_array($fld->Type, [128, 204, 205])
        ) { // Unsortable data type
                return "";
        } elseif ($fld->Sortable) {
            $urlParm = "order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->getNextSort();
            if ($DashboardReport) {
                $urlParm .= "&amp;" . Config("PAGE_DASHBOARD") . "=" . $DashboardReport;
            }
            return $this->addMasterUrl($this->CurrentPageName . "?" . $urlParm);
        } else {
            return "";
        }
    }

    // Get record keys from Post/Get/Session
    public function getRecordKeys()
    {
        $arKeys = [];
        $arKey = [];
        if (Param("key_m") !== null) {
            $arKeys = Param("key_m");
            $cnt = count($arKeys);
        } else {
            $isApi = IsApi();
            $keyValues = $isApi
                ? (Route(0) == "export"
                    ? array_map(fn ($i) => Route($i + 3), range(0, 0))  // Export API
                    : array_map(fn ($i) => Route($i + 2), range(0, 0))) // Other API
                : []; // Non-API
            if (($keyValue = Param("patient_id") ?? Route("patient_id")) !== null) {
                $arKeys[] = $keyValue;
            } elseif ($isApi && (($keyValue = Key(0) ?? $keyValues[0] ?? null) !== null)) {
                $arKeys[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }
        }
        // Check keys
        $ar = [];
        if (is_array($arKeys)) {
            foreach ($arKeys as $key) {
                if (!is_numeric($key)) {
                    continue;
                }
                $ar[] = $key;
            }
        }
        return $ar;
    }

    // Get filter from records
    public function getFilterFromRecords($rows)
    {
        $keyFilter = "";
        foreach ($rows as $row) {
            if ($keyFilter != "") {
                $keyFilter .= " OR ";
            }
            $keyFilter .= "(" . $this->getRecordFilter($row) . ")";
        }
        return $keyFilter;
    }

    // Get filter from record keys
    public function getFilterFromRecordKeys($setCurrent = true)
    {
        $arKeys = $this->getRecordKeys();
        $keyFilter = "";
        foreach ($arKeys as $key) {
            if ($keyFilter != "") {
                $keyFilter .= " OR ";
            }
            if ($setCurrent) {
                $this->patient_id->CurrentValue = $key;
            } else {
                $this->patient_id->OldValue = $key;
            }
            $keyFilter .= "(" . $this->getRecordFilter() . ")";
        }
        return $keyFilter;
    }

    // Load result set based on filter/sort
    public function loadRs($filter, $sort = "")
    {
        $sql = $this->getSql($filter, $sort); // Set up filter (WHERE Clause) / sort (ORDER BY Clause)
        $conn = $this->getConnection();
        return $conn->executeQuery($sql);
    }

    // Load row values from record
    public function loadListRowValues(&$rs)
    {
        if (is_array($rs)) {
            $row = $rs;
        } elseif ($rs && property_exists($rs, "fields")) { // Recordset
            $row = $rs->fields;
        } else {
            return;
        }
        $this->patient_id->setDbValue($row['patient_id']);
        $this->photo->Upload->DbValue = $row['photo'];
        $this->patient_ip_number->setDbValue($row['patient_ip_number']);
        $this->patient_name->setDbValue($row['patient_name']);
        $this->patient_dob_year->setDbValue($row['patient_dob_year']);
        $this->patient_age->setDbValue($row['patient_age']);
        $this->patient_gender->setDbValue($row['patient_gender']);
        $this->patient_phone->setDbValue($row['patient_phone']);
        $this->patient_kin_name->setDbValue($row['patient_kin_name']);
        $this->patient_kin_phone->setDbValue($row['patient_kin_phone']);
        $this->service_id->setDbValue($row['service_id']);
        $this->patient_registration_date->setDbValue($row['patient_registration_date']);
        $this->time->setDbValue($row['time']);
        $this->is_inpatient->setDbValue($row['is_inpatient']);
        $this->submitted_by_user_id->setDbValue($row['submitted_by_user_id']);
    }

    // Render list content
    public function renderListContent($filter)
    {
        global $Response;
        $listPage = "JdhPatientsList";
        $listClass = PROJECT_NAMESPACE . $listPage;
        $page = new $listClass();
        $page->loadRecordsetFromFilter($filter);
        $view = Container("app.view");
        $template = $listPage . ".php"; // View
        $GLOBALS["Title"] ??= $page->Title; // Title
        try {
            $Response = $view->render($Response, $template, $GLOBALS);
        } finally {
            $page->terminate(); // Terminate page and clean up
        }
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // patient_id

        // photo

        // patient_ip_number

        // patient_name

        // patient_dob_year

        // patient_age

        // patient_gender

        // patient_phone

        // patient_kin_name

        // patient_kin_phone

        // service_id

        // patient_registration_date

        // time

        // is_inpatient

        // submitted_by_user_id

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

        // patient_ip_number
        $this->patient_ip_number->ViewValue = $this->patient_ip_number->CurrentValue;

        // patient_name
        $this->patient_name->ViewValue = $this->patient_name->CurrentValue;

        // patient_dob_year
        $this->patient_dob_year->ViewValue = $this->patient_dob_year->CurrentValue;

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
                $filterWrk = SearchFilter($this->service_id->Lookup->getTable()->Fields["service_id"]->searchExpression(), "=", $curVal, $this->service_id->Lookup->getTable()->Fields["service_id"]->searchDataType(), "");
                $lookupFilter = $this->service_id->getSelectFilter($this); // PHP
                $sqlWrk = $this->service_id->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCache($this->Cache);
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

        // time
        $this->time->ViewValue = $this->time->CurrentValue;
        $this->time->ViewValue = FormatDateTime($this->time->ViewValue, $this->time->formatPattern());

        // is_inpatient
        if (strval($this->is_inpatient->CurrentValue) != "") {
            $this->is_inpatient->ViewValue = $this->is_inpatient->optionCaption($this->is_inpatient->CurrentValue);
        } else {
            $this->is_inpatient->ViewValue = null;
        }

        // submitted_by_user_id
        $this->submitted_by_user_id->ViewValue = $this->submitted_by_user_id->CurrentValue;
        $this->submitted_by_user_id->ViewValue = FormatNumber($this->submitted_by_user_id->ViewValue, $this->submitted_by_user_id->formatPattern());

        // patient_id
        $this->patient_id->HrefValue = "";
        $this->patient_id->TooltipValue = "";

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
        $this->photo->TooltipValue = "";
        if ($this->photo->UseColorbox) {
            if (EmptyValue($this->photo->TooltipValue)) {
                $this->photo->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
            }
            $this->photo->LinkAttrs["data-rel"] = "jdh_patients_x_photo";
            $this->photo->LinkAttrs->appendClass("ew-lightbox");
        }

        // patient_ip_number
        $this->patient_ip_number->HrefValue = "";
        $this->patient_ip_number->TooltipValue = "";

        // patient_name
        $this->patient_name->HrefValue = "";
        $this->patient_name->TooltipValue = "";

        // patient_dob_year
        $this->patient_dob_year->HrefValue = "";
        $this->patient_dob_year->TooltipValue = "";

        // patient_age
        $this->patient_age->HrefValue = "";
        $this->patient_age->TooltipValue = "";

        // patient_gender
        $this->patient_gender->HrefValue = "";
        $this->patient_gender->TooltipValue = "";

        // patient_phone
        if (!EmptyValue($this->patient_phone->CurrentValue)) {
            $this->patient_phone->HrefValue = $this->patient_phone->getLinkPrefix() . $this->patient_phone->CurrentValue; // Add prefix/suffix
            $this->patient_phone->LinkAttrs["target"] = ""; // Add target
            if ($this->isExport()) {
                $this->patient_phone->HrefValue = FullUrl($this->patient_phone->HrefValue, "href");
            }
        } else {
            $this->patient_phone->HrefValue = "";
        }
        $this->patient_phone->TooltipValue = "";

        // patient_kin_name
        $this->patient_kin_name->HrefValue = "";
        $this->patient_kin_name->TooltipValue = "";

        // patient_kin_phone
        $this->patient_kin_phone->HrefValue = "";
        $this->patient_kin_phone->TooltipValue = "";

        // service_id
        $this->service_id->HrefValue = "";
        $this->service_id->TooltipValue = "";

        // patient_registration_date
        $this->patient_registration_date->HrefValue = "";
        $this->patient_registration_date->TooltipValue = "";

        // time
        $this->time->HrefValue = "";
        $this->time->TooltipValue = "";

        // is_inpatient
        $this->is_inpatient->HrefValue = "";
        $this->is_inpatient->TooltipValue = "";

        // submitted_by_user_id
        $this->submitted_by_user_id->HrefValue = "";
        $this->submitted_by_user_id->TooltipValue = "";

        // Call Row Rendered event
        $this->rowRendered();

        // Save data for Custom Template
        $this->Rows[] = $this->customTemplateFieldValues();
    }

    // Render edit row values
    public function renderEditRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // patient_id
        $this->patient_id->setupEditAttributes();
        $this->patient_id->EditValue = $this->patient_id->CurrentValue;

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

        // patient_ip_number
        $this->patient_ip_number->setupEditAttributes();
        if (!$this->patient_ip_number->Raw) {
            $this->patient_ip_number->CurrentValue = HtmlDecode($this->patient_ip_number->CurrentValue);
        }
        $this->patient_ip_number->EditValue = $this->patient_ip_number->CurrentValue;
        $this->patient_ip_number->PlaceHolder = RemoveHtml($this->patient_ip_number->caption());

        // patient_name
        $this->patient_name->setupEditAttributes();
        if (!$this->patient_name->Raw) {
            $this->patient_name->CurrentValue = HtmlDecode($this->patient_name->CurrentValue);
        }
        $this->patient_name->EditValue = $this->patient_name->CurrentValue;
        $this->patient_name->PlaceHolder = RemoveHtml($this->patient_name->caption());

        // patient_dob_year
        $this->patient_dob_year->setupEditAttributes();
        $this->patient_dob_year->EditValue = $this->patient_dob_year->CurrentValue;
        $this->patient_dob_year->PlaceHolder = RemoveHtml($this->patient_dob_year->caption());
        if (strval($this->patient_dob_year->EditValue) != "" && is_numeric($this->patient_dob_year->EditValue)) {
            $this->patient_dob_year->EditValue = $this->patient_dob_year->EditValue;
        }

        // patient_age
        $this->patient_age->setupEditAttributes();
        $this->patient_age->CurrentValue = FormatNumber($this->patient_age->CurrentValue, $this->patient_age->formatPattern());
        if (strval($this->patient_age->EditValue) != "" && is_numeric($this->patient_age->EditValue)) {
            $this->patient_age->EditValue = FormatNumber($this->patient_age->EditValue, null);
        }

        // patient_gender
        $this->patient_gender->setupEditAttributes();
        $this->patient_gender->EditValue = $this->patient_gender->options(true);
        $this->patient_gender->PlaceHolder = RemoveHtml($this->patient_gender->caption());

        // patient_phone
        $this->patient_phone->setupEditAttributes();
        if (!$this->patient_phone->Raw) {
            $this->patient_phone->CurrentValue = HtmlDecode($this->patient_phone->CurrentValue);
        }
        $this->patient_phone->EditValue = $this->patient_phone->CurrentValue;
        $this->patient_phone->PlaceHolder = RemoveHtml($this->patient_phone->caption());

        // patient_kin_name
        $this->patient_kin_name->setupEditAttributes();
        if (!$this->patient_kin_name->Raw) {
            $this->patient_kin_name->CurrentValue = HtmlDecode($this->patient_kin_name->CurrentValue);
        }
        $this->patient_kin_name->EditValue = $this->patient_kin_name->CurrentValue;
        $this->patient_kin_name->PlaceHolder = RemoveHtml($this->patient_kin_name->caption());

        // patient_kin_phone
        $this->patient_kin_phone->setupEditAttributes();
        if (!$this->patient_kin_phone->Raw) {
            $this->patient_kin_phone->CurrentValue = HtmlDecode($this->patient_kin_phone->CurrentValue);
        }
        $this->patient_kin_phone->EditValue = $this->patient_kin_phone->CurrentValue;
        $this->patient_kin_phone->PlaceHolder = RemoveHtml($this->patient_kin_phone->caption());

        // service_id
        $this->service_id->setupEditAttributes();
        $curVal = strval($this->service_id->CurrentValue);
        if ($curVal != "") {
            $this->service_id->EditValue = $this->service_id->lookupCacheOption($curVal);
            if ($this->service_id->EditValue === null) { // Lookup from database
                $filterWrk = SearchFilter($this->service_id->Lookup->getTable()->Fields["service_id"]->searchExpression(), "=", $curVal, $this->service_id->Lookup->getTable()->Fields["service_id"]->searchDataType(), "");
                $lookupFilter = $this->service_id->getSelectFilter($this); // PHP
                $sqlWrk = $this->service_id->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCache($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->service_id->Lookup->renderViewRow($rswrk[0]);
                    $this->service_id->EditValue = $this->service_id->displayValue($arwrk);
                } else {
                    $this->service_id->EditValue = FormatNumber($this->service_id->CurrentValue, $this->service_id->formatPattern());
                }
            }
        } else {
            $this->service_id->EditValue = null;
        }

        // patient_registration_date
        $this->patient_registration_date->setupEditAttributes();
        $this->patient_registration_date->EditValue = FormatDateTime($this->patient_registration_date->CurrentValue, $this->patient_registration_date->formatPattern());
        $this->patient_registration_date->PlaceHolder = RemoveHtml($this->patient_registration_date->caption());

        // time
        $this->time->setupEditAttributes();
        $this->time->EditValue = FormatDateTime($this->time->CurrentValue, $this->time->formatPattern());
        $this->time->PlaceHolder = RemoveHtml($this->time->caption());

        // is_inpatient
        $this->is_inpatient->setupEditAttributes();
        $this->is_inpatient->EditValue = $this->is_inpatient->options(true);
        $this->is_inpatient->PlaceHolder = RemoveHtml($this->is_inpatient->caption());

        // submitted_by_user_id

        // Call Row Rendered event
        $this->rowRendered();
    }

    // Aggregate list row values
    public function aggregateListRowValues()
    {
    }

    // Aggregate list row (for rendering)
    public function aggregateListRow()
    {
        // Call Row Rendered event
        $this->rowRendered();
    }

    // Export data in HTML/CSV/Word/Excel/Email/PDF format
    public function exportDocument($doc, $result, $startRec = 1, $stopRec = 1, $exportPageType = "")
    {
        if (!$result || !$doc) {
            return;
        }
        if (!$doc->ExportCustom) {
            // Write header
            $doc->exportTableHeader();
            if ($doc->Horizontal) { // Horizontal format, write header
                $doc->beginExportRow();
                if ($exportPageType == "view") {
                    $doc->exportCaption($this->patient_ip_number);
                    $doc->exportCaption($this->patient_name);
                    $doc->exportCaption($this->patient_age);
                } else {
                    $doc->exportCaption($this->patient_id);
                    $doc->exportCaption($this->patient_ip_number);
                    $doc->exportCaption($this->patient_name);
                    $doc->exportCaption($this->patient_dob_year);
                    $doc->exportCaption($this->patient_age);
                    $doc->exportCaption($this->patient_gender);
                    $doc->exportCaption($this->patient_phone);
                    $doc->exportCaption($this->patient_kin_name);
                    $doc->exportCaption($this->patient_kin_phone);
                    $doc->exportCaption($this->service_id);
                    $doc->exportCaption($this->patient_registration_date);
                    $doc->exportCaption($this->time);
                    $doc->exportCaption($this->is_inpatient);
                    $doc->exportCaption($this->submitted_by_user_id);
                }
                $doc->endExportRow();
            }
        }
        $recCnt = $startRec - 1;
        $stopRec = $stopRec > 0 ? $stopRec : PHP_INT_MAX;
        while (($row = $result->fetch()) && $recCnt < $stopRec) {
            $recCnt++;
            if ($recCnt >= $startRec) {
                $rowCnt = $recCnt - $startRec + 1;

                // Page break
                if ($this->ExportPageBreakCount > 0) {
                    if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0) {
                        $doc->exportPageBreak();
                    }
                }
                $this->loadListRowValues($row);

                // Render row
                $this->RowType = RowType::VIEW; // Render view
                $this->resetAttributes();
                $this->renderListRow();
                if (!$doc->ExportCustom) {
                    $doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
                    if ($exportPageType == "view") {
                        $doc->exportField($this->patient_ip_number);
                        $doc->exportField($this->patient_name);
                        $doc->exportField($this->patient_age);
                    } else {
                        $doc->exportField($this->patient_id);
                        $doc->exportField($this->patient_ip_number);
                        $doc->exportField($this->patient_name);
                        $doc->exportField($this->patient_dob_year);
                        $doc->exportField($this->patient_age);
                        $doc->exportField($this->patient_gender);
                        $doc->exportField($this->patient_phone);
                        $doc->exportField($this->patient_kin_name);
                        $doc->exportField($this->patient_kin_phone);
                        $doc->exportField($this->service_id);
                        $doc->exportField($this->patient_registration_date);
                        $doc->exportField($this->time);
                        $doc->exportField($this->is_inpatient);
                        $doc->exportField($this->submitted_by_user_id);
                    }
                    $doc->endExportRow($rowCnt);
                }
            }

            // Call Row Export server event
            if ($doc->ExportCustom) {
                $this->rowExport($doc, $row);
            }
        }
        if (!$doc->ExportCustom) {
            $doc->exportTableFooter();
        }
    }

    // Add User ID filter
    public function addUserIDFilter($filter = "", $id = "")
    {
        global $Security;
        $filterWrk = "";
        if ($id == "") {
            $id = CurrentPageID() == "list" ? $this->CurrentAction : CurrentPageID();
        }
        if (!$this->userIDAllow($id) && !$Security->isAdmin()) {
            $filterWrk = $Security->userIdList();
            if ($filterWrk != "") {
                $filterWrk = '`submitted_by_user_id` IN (' . $filterWrk . ')';
            }
        }

        // Call User ID Filtering event
        $this->userIdFiltering($filterWrk);
        AddFilter($filter, $filterWrk);
        return $filter;
    }

    // User ID subquery
    public function getUserIDSubquery(&$fld, &$masterfld)
    {
        global $UserTable;
        $wrk = "";
        $sql = "SELECT " . $masterfld->Expression . " FROM jdh_patients";
        $filter = $this->addUserIDFilter("");
        if ($filter != "") {
            $sql .= " WHERE " . $filter;
        }

        // List all values
        $conn = Conn($UserTable->Dbid);
        $config = $conn->getConfiguration();
        $config->setResultCache($this->Cache);
        if ($rs = $conn->executeCacheQuery($sql, [], [], $this->CacheProfile)->fetchAllNumeric()) {
            foreach ($rs as $row) {
                if ($wrk != "") {
                    $wrk .= ",";
                }
                $wrk .= QuotedValue($row[0], $masterfld->DataType, Config("USER_TABLE_DBID"));
            }
        }
        if ($wrk != "") {
            $wrk = $fld->Expression . " IN (" . $wrk . ")";
        } else { // No User ID value found
            $wrk = "0=1";
        }
        return $wrk;
    }

    // Get file data
    public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0, $plugins = [])
    {
        global $DownloadFileName;
        $width = ($width > 0) ? $width : Config("THUMBNAIL_DEFAULT_WIDTH");
        $height = ($height > 0) ? $height : Config("THUMBNAIL_DEFAULT_HEIGHT");

        // Set up field name / file name field / file type field
        $fldName = "";
        $fileNameFld = "";
        $fileTypeFld = "";
        if ($fldparm == 'photo') {
            $fldName = "photo";
        } else {
            return false; // Incorrect field
        }

        // Set up key values
        $ar = explode(Config("COMPOSITE_KEY_SEPARATOR"), $key);
        if (count($ar) == 1) {
            $this->patient_id->CurrentValue = $ar[0];
        } else {
            return false; // Incorrect key
        }

        // Set up filter (WHERE Clause)
        $filter = $this->getRecordFilter();
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $dbtype = GetConnectionType($this->Dbid);
        if ($row = $conn->fetchAssociative($sql)) {
            $val = $row[$fldName];
            if (!EmptyValue($val)) {
                $fld = $this->Fields[$fldName];

                // Binary data
                if ($fld->DataType == DataType::BLOB) {
                    if ($dbtype != "MYSQL") {
                        if (is_resource($val) && get_resource_type($val) == "stream") { // Byte array
                            $val = stream_get_contents($val);
                        }
                    }
                    if ($resize) {
                        ResizeBinary($val, $width, $height, $plugins);
                    }

                    // Write file type
                    if ($fileTypeFld != "" && !EmptyValue($row[$fileTypeFld])) {
                        AddHeader("Content-type", $row[$fileTypeFld]);
                    } else {
                        AddHeader("Content-type", ContentType($val));
                    }

                    // Write file name
                    $downloadPdf = !Config("EMBED_PDF") && Config("DOWNLOAD_PDF_FILE");
                    if ($fileNameFld != "" && !EmptyValue($row[$fileNameFld])) {
                        $fileName = $row[$fileNameFld];
                        $pathinfo = pathinfo($fileName);
                        $ext = strtolower($pathinfo["extension"] ?? "");
                        $isPdf = SameText($ext, "pdf");
                        if ($downloadPdf || !$isPdf) { // Skip header if not download PDF
                            AddHeader("Content-Disposition", "attachment; filename=\"" . $fileName . "\"");
                        }
                    } else {
                        $ext = ContentExtension($val);
                        $isPdf = SameText($ext, ".pdf");
                        if ($isPdf && $downloadPdf) { // Add header if download PDF
                            AddHeader("Content-Disposition", "attachment" . ($DownloadFileName ? "; filename=\"" . $DownloadFileName . "\"" : ""));
                        }
                    }

                    // Write file data
                    if (
                        StartsString("PK", $val) &&
                        ContainsString($val, "[Content_Types].xml") &&
                        ContainsString($val, "_rels") &&
                        ContainsString($val, "docProps")
                    ) { // Fix Office 2007 documents
                        if (!EndsString("\0\0\0", $val)) { // Not ends with 3 or 4 \0
                            $val .= "\0\0\0\0";
                        }
                    }

                    // Clear any debug message
                    if (ob_get_length()) {
                        ob_end_clean();
                    }

                    // Write binary data
                    Write($val);

                // Upload to folder
                } else {
                    if ($fld->UploadMultiple) {
                        $files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
                    } else {
                        $files = [$val];
                    }
                    $data = [];
                    $ar = [];
                    if ($fld->hasMethod("getUploadPath")) { // Check field level upload path
                        $fld->UploadPath = $fld->getUploadPath();
                    }
                    foreach ($files as $file) {
                        if (!EmptyValue($file)) {
                            if (Config("ENCRYPT_FILE_PATH")) {
                                $ar[$file] = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $this->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $file)));
                            } else {
                                $ar[$file] = FullUrl($fld->hrefPath() . $file);
                            }
                        }
                    }
                    $data[$fld->Param] = $ar;
                    WriteJson($data);
                }
            }
            return true;
        }
        return false;
    }

    // Write audit trail start/end for grid update
    public function writeAuditTrailDummy($typ)
    {
        WriteAuditLog(CurrentUserIdentifier(), $typ, 'jdh_patients');
    }

    // Write audit trail (add page)
    public function writeAuditTrailOnAdd(&$rs)
    {
        global $Language;
        if (!$this->AuditTrailOnAdd) {
            return;
        }

        // Get key value
        $key = "";
        if ($key != "") {
            $key .= Config("COMPOSITE_KEY_SEPARATOR");
        }
        $key .= $rs['patient_id'];

        // Write audit trail
        $usr = CurrentUserIdentifier();
        foreach (array_keys($rs) as $fldname) {
            if (array_key_exists($fldname, $this->Fields) && $this->Fields[$fldname]->DataType != DataType::BLOB) { // Ignore BLOB fields
                if ($this->Fields[$fldname]->HtmlTag == "PASSWORD") { // Password Field
                    $newvalue = $Language->phrase("PasswordMask");
                } elseif ($this->Fields[$fldname]->DataType == DataType::MEMO) { // Memo Field
                    $newvalue = Config("AUDIT_TRAIL_TO_DATABASE") ? $rs[$fldname] : "[MEMO]";
                } elseif ($this->Fields[$fldname]->DataType == DataType::XML) { // XML Field
                    $newvalue = "[XML]";
                } else {
                    $newvalue = $rs[$fldname];
                }
                WriteAuditLog($usr, "A", 'jdh_patients', $fldname, $key, "", $newvalue);
            }
        }
    }

    // Write audit trail (edit page)
    public function writeAuditTrailOnEdit(&$rsold, &$rsnew)
    {
        global $Language;
        if (!$this->AuditTrailOnEdit) {
            return;
        }

        // Get key value
        $key = "";
        if ($key != "") {
            $key .= Config("COMPOSITE_KEY_SEPARATOR");
        }
        $key .= $rsold['patient_id'];

        // Write audit trail
        $usr = CurrentUserIdentifier();
        foreach (array_keys($rsnew) as $fldname) {
            if (array_key_exists($fldname, $this->Fields) && array_key_exists($fldname, $rsold) && $this->Fields[$fldname]->DataType != DataType::BLOB) { // Ignore BLOB fields
                if ($this->Fields[$fldname]->DataType == DataType::DATE) { // DateTime field
                    $modified = (FormatDateTime($rsold[$fldname], 0) != FormatDateTime($rsnew[$fldname], 0));
                } else {
                    $modified = !CompareValue($rsold[$fldname], $rsnew[$fldname]);
                }
                if ($modified) {
                    if ($this->Fields[$fldname]->HtmlTag == "PASSWORD") { // Password Field
                        $oldvalue = $Language->phrase("PasswordMask");
                        $newvalue = $Language->phrase("PasswordMask");
                    } elseif ($this->Fields[$fldname]->DataType == DataType::MEMO) { // Memo field
                        $oldvalue = Config("AUDIT_TRAIL_TO_DATABASE") ? $rsold[$fldname] : "[MEMO]";
                        $newvalue = Config("AUDIT_TRAIL_TO_DATABASE") ? $rsnew[$fldname] : "[MEMO]";
                    } elseif ($this->Fields[$fldname]->DataType == DataType::XML) { // XML field
                        $oldvalue = "[XML]";
                        $newvalue = "[XML]";
                    } else {
                        $oldvalue = $rsold[$fldname];
                        $newvalue = $rsnew[$fldname];
                    }
                    WriteAuditLog($usr, "U", 'jdh_patients', $fldname, $key, $oldvalue, $newvalue);
                }
            }
        }
    }

    // Write audit trail (delete page)
    public function writeAuditTrailOnDelete(&$rs)
    {
        global $Language;
        if (!$this->AuditTrailOnDelete) {
            return;
        }

        // Get key value
        $key = "";
        if ($key != "") {
            $key .= Config("COMPOSITE_KEY_SEPARATOR");
        }
        $key .= $rs['patient_id'];

        // Write audit trail
        $usr = CurrentUserIdentifier();
        foreach (array_keys($rs) as $fldname) {
            if (array_key_exists($fldname, $this->Fields) && $this->Fields[$fldname]->DataType != DataType::BLOB) { // Ignore BLOB fields
                if ($this->Fields[$fldname]->HtmlTag == "PASSWORD") { // Password Field
                    $oldvalue = $Language->phrase("PasswordMask");
                } elseif ($this->Fields[$fldname]->DataType == DataType::MEMO) { // Memo field
                    $oldvalue = Config("AUDIT_TRAIL_TO_DATABASE") ? $rs[$fldname] : "[MEMO]";
                } elseif ($this->Fields[$fldname]->DataType == DataType::XML) { // XML field
                    $oldvalue = "[XML]";
                } else {
                    $oldvalue = $rs[$fldname];
                }
                WriteAuditLog($usr, "D", 'jdh_patients', $fldname, $key, $oldvalue);
            }
        }
    }

    // Send email after add success
    public function sendEmailOnAdd(&$rs)
    {
        global $Language;
        $table = 'jdh_patients';
        $subject = $table . " " . $Language->phrase("RecordInserted");
        $action = $Language->phrase("ActionInserted");

        // Get key value
        $key = "";
        if ($key != "") {
            $key .= Config("COMPOSITE_KEY_SEPARATOR");
        }
        $key .= $rs['patient_id'];
        $email = new Email();
        $email->load(Config("EMAIL_NOTIFY_TEMPLATE"), data: [
            "From" => Config("SENDER_EMAIL"), // Replace Sender
            "To" => Config("RECIPIENT_EMAIL"), // Replace Recipient
            "Subject" => $subject,  // Replace Subject
            "Table" => $table,
            "Key" => $key,
            "Action" => $action
        ]);
        $args = ["rsnew" => $rs];
        $emailSent = false;
        if ($this->emailSending($email, $args)) {
            $emailSent = $email->send();
        }

        // Send email failed
        if (!$emailSent) {
            $this->setFailureMessage($email->SendErrDescription);
        }
    }

    // Send email after update success
    public function sendEmailOnEdit(&$rsold, &$rsnew)
    {
        global $Language;
        $table = 'jdh_patients';
        $subject = $table . " ". $Language->phrase("RecordUpdated");
        $action = $Language->phrase("ActionUpdated");

        // Get key value
        $key = "";
        if ($key != "") {
            $key .= Config("COMPOSITE_KEY_SEPARATOR");
        }
        $key .= $rsold['patient_id'];
        $email = new Email();
        $email->load(Config("EMAIL_NOTIFY_TEMPLATE"), data: [
            "From" => Config("SENDER_EMAIL"), // Replace Sender
            "To" => Config("RECIPIENT_EMAIL"), // Replace Recipient
            "Subject" => $subject,  // Replace Subject
            "Table" => $table,
            "Key" => $key,
            "Action" => $action
        ]);
        $args = ["rsold" => $rsold, "rsnew" => $rsnew];
        $emailSent = false;
        if ($this->emailSending($email, $args)) {
            $emailSent = $email->send();
        }

        // Send email failed
        if (!$emailSent) {
            $this->setFailureMessage($email->SendErrDescription);
        }
    }

    // Table level events

    // Table Load event
    public function tableLoad()
    {
        // Enter your code here
    }

    // Recordset Selecting event
    public function recordsetSelecting(&$filter)
    {
        // Enter your code here
    }

    // Recordset Selected event
    public function recordsetSelected($rs)
    {
        //Log("Recordset Selected");
    }

    // Recordset Search Validated event
    public function recordsetSearchValidated()
    {
        // Example:
        //$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value
    }

    // Recordset Searching event
    public function recordsetSearching(&$filter)
    {
        // Enter your code here
    }

    // Row_Selecting event
    public function rowSelecting(&$filter)
    {
        // Enter your code here
    }

    // Row Selected event
    public function rowSelected(&$rs)
    {
        //Log("Row Selected");
    }

    // Row Inserting event
    public function rowInserting($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Inserted event
    public function rowInserted($rsold, $rsnew)
    {
        //Log("Row Inserted");
    }

    // Row Updating event
    public function rowUpdating($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Updated event
    public function rowUpdated($rsold, $rsnew)
    {
        //Log("Row Updated");
    }

    // Row Update Conflict event
    public function rowUpdateConflict($rsold, &$rsnew)
    {
        // Enter your code here
        // To ignore conflict, set return value to false
        return true;
    }

    // Grid Inserting event
    public function gridInserting()
    {
        // Enter your code here
        // To reject grid insert, set return value to false
        return true;
    }

    // Grid Inserted event
    public function gridInserted($rsnew)
    {
        //Log("Grid Inserted");
    }

    // Grid Updating event
    public function gridUpdating($rsold)
    {
        // Enter your code here
        // To reject grid update, set return value to false
        return true;
    }

    // Grid Updated event
    public function gridUpdated($rsold, $rsnew)
    {
        //Log("Grid Updated");
    }

    // Row Deleting event
    public function rowDeleting(&$rs)
    {
        // Enter your code here
        // To cancel, set return value to False
        return true;
    }

    // Row Deleted event
    public function rowDeleted($rs)
    {
        //Log("Row Deleted");
    }

    // Email Sending event
    public function emailSending($email, $args)
    {
        //var_dump($email, $args); exit();
        return true;
    }

    // Lookup Selecting event
    public function lookupSelecting($fld, &$filter)
    {
        //var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
        // Enter your code here
    }

    // Row Rendering event
    public function rowRendering()
    {
        // Enter your code here
    }

    // Row Rendered event
    public function rowRendered()
    {
         $id = $this->patient_id->ViewValue;
        if(CurrentUserLevel() == -1) {
            $this->patient_name->ViewValue = "<a href='jdhpatientsview/".$id."?showdetail=jdh_patient_visits,jdh_chief_complaints,jdh_examination_findings,jdh_patient_cases,jdh_prescriptions,jdh_prescriptions_actions,jdh_appointments,jdh_vitals,jdh_invoice,jdh_invoice_items' >". $this->patient_name->ViewValue ."</a>";
        } else if(CurrentUserLevel() == 1) {
            $this->patient_name->ViewValue = "<a href='jdhpatientsview/".$id."?showdetail=jdh_patient_visits,jdh_appointments' >". $this->patient_name->ViewValue ."</a>";
        } else if(CurrentUserLevel() == 9) {
            $this->patient_name->ViewValue = "<a href='jdhpatientsview/".$id."?showdetail=jdh_chief_complaints,jdh_patient_cases,jdh_prescriptions,jdh_vitals' >". $this->patient_name->ViewValue ."</a>";
        } else if(CurrentUserLevel() == 3) {
            $this->patient_name->ViewValue = "<a href='jdhpatientsview/".$id."?showdetail=jdh_test_requests,jdh_test_reports' >". $this->patient_name->ViewValue ."</a>";
        } else if(CurrentUserLevel() == 4) {
            $this->patient_name->ViewValue = "<a href='jdhpatientsview/".$id."?showdetail=jdh_prescriptions,jdh_prescriptions_actions' >". $this->patient_name->ViewValue ."</a>";
        }  else if(CurrentUserLevel() == 5) {
            $this->patient_name->ViewValue = "<a href='jdhpatientsview/".$id."?showdetail=jdh_invoice,jdh_invoice_items' >". $this->patient_name->ViewValue ."</a>";
        } else if(CurrentUserLevel() == 2) {
            $this->patient_name->ViewValue = "<a href='jdhpatientsview/".$id."?showdetail=jdh_chief_complaints,jdh_examination_findings,jdh_patient_cases,jdh_prescriptions,jdh_prescriptions_actions,jdh_appointments,jdh_vitals,jdh_test_requests,jdh_test_reports' >". $this->patient_name->ViewValue ."</a>";
        }
    }

    // User ID Filtering event
    public function userIdFiltering(&$filter)
    {
        // Enter your code here
    }
}
