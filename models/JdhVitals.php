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
 * Table class for jdh_vitals
 */
class JdhVitals extends DbTable
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
    public $vitals_id;
    public $patient_id;
    public $pressure;
    public $height;
    public $weight;
    public $body_mass_index;
    public $pulse_rate;
    public $respiratory_rate;
    public $temperature;
    public $random_blood_sugar;
    public $spo_2;
    public $submission_date;
    public $submitted_by_user_id;
    public $patient_status;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        parent::__construct();
        global $Language, $CurrentLanguage, $CurrentLocale;

        // Language object
        $Language = Container("app.language");
        $this->TableVar = "jdh_vitals";
        $this->TableName = 'jdh_vitals';
        $this->TableType = "TABLE";
        $this->ImportUseTransaction = $this->supportsTransaction() && Config("IMPORT_USE_TRANSACTION");
        $this->UseTransaction = $this->supportsTransaction() && Config("USE_TRANSACTION");

        // Update Table
        $this->UpdateTable = "jdh_vitals";
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
        $this->DetailView = true; // Allow detail view
        $this->ShowMultipleDetails = false; // Show multiple details
        $this->GridAddRowCount = 5;
        $this->AllowAddDeleteRow = true; // Allow add/delete row
        $this->UseAjaxActions = $this->UseAjaxActions || Config("USE_AJAX_ACTIONS");
        $this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
        $this->BasicSearch = new BasicSearch($this);

        // vitals_id
        $this->vitals_id = new DbField(
            $this, // Table
            'x_vitals_id', // Variable name
            'vitals_id', // Name
            '`vitals_id`', // Expression
            '`vitals_id`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`vitals_id`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'NO' // Edit Tag
        );
        $this->vitals_id->InputTextType = "text";
        $this->vitals_id->Raw = true;
        $this->vitals_id->IsAutoIncrement = true; // Autoincrement field
        $this->vitals_id->IsPrimaryKey = true; // Primary key field
        $this->vitals_id->Nullable = false; // NOT NULL field
        $this->vitals_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->vitals_id->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['vitals_id'] = &$this->vitals_id;

        // patient_id
        $this->patient_id = new DbField(
            $this, // Table
            'x_patient_id', // Variable name
            'patient_id', // Name
            '`patient_id`', // Expression
            '`patient_id`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`patient_id`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'SELECT' // Edit Tag
        );
        $this->patient_id->InputTextType = "text";
        $this->patient_id->Raw = true;
        $this->patient_id->IsForeignKey = true; // Foreign key field
        $this->patient_id->setSelectMultiple(false); // Select one
        $this->patient_id->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->patient_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->patient_id->Lookup = new Lookup($this->patient_id, 'jdh_patients', false, 'patient_id', ["patient_name","","",""], '', '', [], [], [], [], [], [], false, '', '', "`patient_name`");
        $this->patient_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->patient_id->SearchOperators = ["=", "<>", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['patient_id'] = &$this->patient_id;

        // pressure
        $this->pressure = new DbField(
            $this, // Table
            'x_pressure', // Variable name
            'pressure', // Name
            '`pressure`', // Expression
            '`pressure`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`pressure`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->pressure->InputTextType = "text";
        $this->pressure->Raw = true;
        $this->pressure->Nullable = false; // NOT NULL field
        $this->pressure->Required = true; // Required field
        $this->pressure->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->pressure->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['pressure'] = &$this->pressure;

        // height
        $this->height = new DbField(
            $this, // Table
            'x_height', // Variable name
            'height', // Name
            '`height`', // Expression
            '`height`', // Basic search expression
            4, // Type
            12, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`height`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->height->InputTextType = "text";
        $this->height->Raw = true;
        $this->height->Nullable = false; // NOT NULL field
        $this->height->Required = true; // Required field
        $this->height->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->height->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['height'] = &$this->height;

        // weight
        $this->weight = new DbField(
            $this, // Table
            'x_weight', // Variable name
            'weight', // Name
            '`weight`', // Expression
            '`weight`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`weight`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->weight->InputTextType = "text";
        $this->weight->Raw = true;
        $this->weight->Nullable = false; // NOT NULL field
        $this->weight->Required = true; // Required field
        $this->weight->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->weight->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['weight'] = &$this->weight;

        // body_mass_index
        $this->body_mass_index = new DbField(
            $this, // Table
            'x_body_mass_index', // Variable name
            'body_mass_index', // Name
            'weight/(height*height)', // Expression
            'weight/(height*height)', // Basic search expression
            131, // Type
            14, // Size
            -1, // Date/Time format
            false, // Is upload field
            'weight/(height*height)', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->body_mass_index->InputTextType = "text";
        $this->body_mass_index->Raw = true;
        $this->body_mass_index->IsCustom = true; // Custom field
        $this->body_mass_index->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->body_mass_index->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['body_mass_index'] = &$this->body_mass_index;

        // pulse_rate
        $this->pulse_rate = new DbField(
            $this, // Table
            'x_pulse_rate', // Variable name
            'pulse_rate', // Name
            '`pulse_rate`', // Expression
            '`pulse_rate`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`pulse_rate`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->pulse_rate->InputTextType = "text";
        $this->pulse_rate->Raw = true;
        $this->pulse_rate->Nullable = false; // NOT NULL field
        $this->pulse_rate->Required = true; // Required field
        $this->pulse_rate->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->pulse_rate->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['pulse_rate'] = &$this->pulse_rate;

        // respiratory_rate
        $this->respiratory_rate = new DbField(
            $this, // Table
            'x_respiratory_rate', // Variable name
            'respiratory_rate', // Name
            '`respiratory_rate`', // Expression
            '`respiratory_rate`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`respiratory_rate`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->respiratory_rate->InputTextType = "text";
        $this->respiratory_rate->Raw = true;
        $this->respiratory_rate->Nullable = false; // NOT NULL field
        $this->respiratory_rate->Required = true; // Required field
        $this->respiratory_rate->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->respiratory_rate->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['respiratory_rate'] = &$this->respiratory_rate;

        // temperature
        $this->temperature = new DbField(
            $this, // Table
            'x_temperature', // Variable name
            'temperature', // Name
            '`temperature`', // Expression
            '`temperature`', // Basic search expression
            4, // Type
            12, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`temperature`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->temperature->InputTextType = "text";
        $this->temperature->Raw = true;
        $this->temperature->Nullable = false; // NOT NULL field
        $this->temperature->Required = true; // Required field
        $this->temperature->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->temperature->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['temperature'] = &$this->temperature;

        // random_blood_sugar
        $this->random_blood_sugar = new DbField(
            $this, // Table
            'x_random_blood_sugar', // Variable name
            'random_blood_sugar', // Name
            '`random_blood_sugar`', // Expression
            '`random_blood_sugar`', // Basic search expression
            200, // Type
            100, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`random_blood_sugar`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->random_blood_sugar->InputTextType = "text";
        $this->random_blood_sugar->Nullable = false; // NOT NULL field
        $this->random_blood_sugar->Required = true; // Required field
        $this->random_blood_sugar->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY"];
        $this->Fields['random_blood_sugar'] = &$this->random_blood_sugar;

        // spo_2
        $this->spo_2 = new DbField(
            $this, // Table
            'x_spo_2', // Variable name
            'spo_2', // Name
            '`spo_2`', // Expression
            '`spo_2`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`spo_2`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->spo_2->InputTextType = "text";
        $this->spo_2->Raw = true;
        $this->spo_2->Nullable = false; // NOT NULL field
        $this->spo_2->Required = true; // Required field
        $this->spo_2->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->spo_2->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['spo_2'] = &$this->spo_2;

        // submission_date
        $this->submission_date = new DbField(
            $this, // Table
            'x_submission_date', // Variable name
            'submission_date', // Name
            '`submission_date`', // Expression
            CastDateFieldForLike("`submission_date`", 11, "DB"), // Basic search expression
            135, // Type
            19, // Size
            11, // Date/Time format
            false, // Is upload field
            '`submission_date`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->submission_date->InputTextType = "text";
        $this->submission_date->Raw = true;
        $this->submission_date->Nullable = false; // NOT NULL field
        $this->submission_date->Required = true; // Required field
        $this->submission_date->DefaultErrorMessage = str_replace("%s", DateFormat(11), $Language->phrase("IncorrectDate"));
        $this->submission_date->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['submission_date'] = &$this->submission_date;

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

        // patient_status
        $this->patient_status = new DbField(
            $this, // Table
            'x_patient_status', // Variable name
            'patient_status', // Name
            '\'\'', // Expression
            '\'\'', // Basic search expression
            201, // Type
            65530, // Size
            -1, // Date/Time format
            false, // Is upload field
            '\'\'', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXTAREA' // Edit Tag
        );
        $this->patient_status->InputTextType = "text";
        $this->patient_status->IsCustom = true; // Custom field
        $this->patient_status->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['patient_status'] = &$this->patient_status;

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

    // Current master table name
    public function getCurrentMasterTable()
    {
        return Session(PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_MASTER_TABLE"));
    }

    public function setCurrentMasterTable($v)
    {
        $_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_MASTER_TABLE")] = $v;
    }

    // Get master WHERE clause from session values
    public function getMasterFilterFromSession()
    {
        // Master filter
        $masterFilter = "";
        if ($this->getCurrentMasterTable() == "jdh_patients") {
            $masterTable = Container("jdh_patients");
            if ($this->patient_id->getSessionValue() != "") {
                $masterFilter .= "" . GetKeyFilter($masterTable->patient_id, $this->patient_id->getSessionValue(), $masterTable->patient_id->DataType, $masterTable->Dbid);
            } else {
                return "";
            }
        }
        return $masterFilter;
    }

    // Get detail WHERE clause from session values
    public function getDetailFilterFromSession()
    {
        // Detail filter
        $detailFilter = "";
        if ($this->getCurrentMasterTable() == "jdh_patients") {
            $masterTable = Container("jdh_patients");
            if ($this->patient_id->getSessionValue() != "") {
                $detailFilter .= "" . GetKeyFilter($this->patient_id, $this->patient_id->getSessionValue(), $masterTable->patient_id->DataType, $this->Dbid);
            } else {
                return "";
            }
        }
        return $detailFilter;
    }

    /**
     * Get master filter
     *
     * @param object $masterTable Master Table
     * @param array $keys Detail Keys
     * @return mixed NULL is returned if all keys are empty, Empty string is returned if some keys are empty and is required
     */
    public function getMasterFilter($masterTable, $keys)
    {
        $validKeys = true;
        switch ($masterTable->TableVar) {
            case "jdh_patients":
                $key = $keys["patient_id"] ?? "";
                if (EmptyValue($key)) {
                    if ($masterTable->patient_id->Required) { // Required field and empty value
                        return ""; // Return empty filter
                    }
                    $validKeys = false;
                } elseif (!$validKeys) { // Already has empty key
                    return ""; // Return empty filter
                }
                if ($validKeys) {
                    return GetKeyFilter($masterTable->patient_id, $keys["patient_id"], $this->patient_id->DataType, $this->Dbid);
                }
                break;
        }
        return null; // All null values and no required fields
    }

    // Get detail filter
    public function getDetailFilter($masterTable)
    {
        switch ($masterTable->TableVar) {
            case "jdh_patients":
                return GetKeyFilter($this->patient_id, $masterTable->patient_id->DbValue, $masterTable->patient_id->DataType, $masterTable->Dbid);
        }
        return "";
    }

    // Render X Axis for chart
    public function renderChartXAxis($chartVar, $chartRow)
    {
        return $chartRow;
    }

    // Get FROM clause
    public function getSqlFrom()
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "jdh_vitals";
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
        return "*, weight/(height*height) AS `body_mass_index`, '' AS `patient_status`";
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
            $this->vitals_id->setDbValue($conn->lastInsertId());
            $rs['vitals_id'] = $this->vitals_id->DbValue;
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
            if (!isset($rs['vitals_id']) && !EmptyValue($this->vitals_id->CurrentValue)) {
                $rs['vitals_id'] = $this->vitals_id->CurrentValue;
            }
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
            if (array_key_exists('vitals_id', $rs)) {
                AddFilter($where, QuotedName('vitals_id', $this->Dbid) . '=' . QuotedValue($rs['vitals_id'], $this->vitals_id->DataType, $this->Dbid));
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
        return $success;
    }

    // Load DbValue from result set or array
    protected function loadDbValues($row)
    {
        if (!is_array($row)) {
            return;
        }
        $this->vitals_id->DbValue = $row['vitals_id'];
        $this->patient_id->DbValue = $row['patient_id'];
        $this->pressure->DbValue = $row['pressure'];
        $this->height->DbValue = $row['height'];
        $this->weight->DbValue = $row['weight'];
        $this->body_mass_index->DbValue = $row['body_mass_index'];
        $this->pulse_rate->DbValue = $row['pulse_rate'];
        $this->respiratory_rate->DbValue = $row['respiratory_rate'];
        $this->temperature->DbValue = $row['temperature'];
        $this->random_blood_sugar->DbValue = $row['random_blood_sugar'];
        $this->spo_2->DbValue = $row['spo_2'];
        $this->submission_date->DbValue = $row['submission_date'];
        $this->submitted_by_user_id->DbValue = $row['submitted_by_user_id'];
        $this->patient_status->DbValue = $row['patient_status'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`vitals_id` = @vitals_id@";
    }

    // Get Key
    public function getKey($current = false, $keySeparator = null)
    {
        $keys = [];
        $val = $current ? $this->vitals_id->CurrentValue : $this->vitals_id->OldValue;
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
                $this->vitals_id->CurrentValue = $keys[0];
            } else {
                $this->vitals_id->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null, $current = false)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('vitals_id', $row) ? $row['vitals_id'] : null;
        } else {
            $val = !EmptyValue($this->vitals_id->OldValue) && !$current ? $this->vitals_id->OldValue : $this->vitals_id->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@vitals_id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("jdhvitalslist");
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
            "jdhvitalsview" => $Language->phrase("View"),
            "jdhvitalsedit" => $Language->phrase("Edit"),
            "jdhvitalsadd" => $Language->phrase("Add"),
            default => ""
        };
    }

    // Default route URL
    public function getDefaultRouteUrl()
    {
        return "jdhvitalslist";
    }

    // API page name
    public function getApiPageName($action)
    {
        return match (strtolower($action)) {
            Config("API_VIEW_ACTION") => "JdhVitalsView",
            Config("API_ADD_ACTION") => "JdhVitalsAdd",
            Config("API_EDIT_ACTION") => "JdhVitalsEdit",
            Config("API_DELETE_ACTION") => "JdhVitalsDelete",
            Config("API_LIST_ACTION") => "JdhVitalsList",
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
        return "jdhvitalslist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("jdhvitalsview", $parm);
        } else {
            $url = $this->keyUrl("jdhvitalsview", Config("TABLE_SHOW_DETAIL") . "=");
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "jdhvitalsadd?" . $parm;
        } else {
            $url = "jdhvitalsadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("jdhvitalsedit", $parm);
        return $this->addMasterUrl($url);
    }

    // Inline edit URL
    public function getInlineEditUrl()
    {
        $url = $this->keyUrl("jdhvitalslist", "action=edit");
        return $this->addMasterUrl($url);
    }

    // Copy URL
    public function getCopyUrl($parm = "")
    {
        $url = $this->keyUrl("jdhvitalsadd", $parm);
        return $this->addMasterUrl($url);
    }

    // Inline copy URL
    public function getInlineCopyUrl()
    {
        $url = $this->keyUrl("jdhvitalslist", "action=copy");
        return $this->addMasterUrl($url);
    }

    // Delete URL
    public function getDeleteUrl($parm = "")
    {
        if ($this->UseAjaxActions && ConvertToBool(Param("infinitescroll")) && CurrentPageID() == "list") {
            return $this->keyUrl(GetApiUrl(Config("API_DELETE_ACTION") . "/" . $this->TableVar));
        } else {
            return $this->keyUrl("jdhvitalsdelete", $parm);
        }
    }

    // Add master url
    public function addMasterUrl($url)
    {
        if ($this->getCurrentMasterTable() == "jdh_patients" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
            $url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
            $url .= "&" . GetForeignKeyUrl("fk_patient_id", $this->patient_id->getSessionValue()); // Use Session Value
        }
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "\"vitals_id\":" . VarToJson($this->vitals_id->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->vitals_id->CurrentValue !== null) {
            $url .= "/" . $this->encodeKeyValue($this->vitals_id->CurrentValue);
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
            if (($keyValue = Param("vitals_id") ?? Route("vitals_id")) !== null) {
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
                $this->vitals_id->CurrentValue = $key;
            } else {
                $this->vitals_id->OldValue = $key;
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
        $this->vitals_id->setDbValue($row['vitals_id']);
        $this->patient_id->setDbValue($row['patient_id']);
        $this->pressure->setDbValue($row['pressure']);
        $this->height->setDbValue($row['height']);
        $this->weight->setDbValue($row['weight']);
        $this->body_mass_index->setDbValue($row['body_mass_index']);
        $this->pulse_rate->setDbValue($row['pulse_rate']);
        $this->respiratory_rate->setDbValue($row['respiratory_rate']);
        $this->temperature->setDbValue($row['temperature']);
        $this->random_blood_sugar->setDbValue($row['random_blood_sugar']);
        $this->spo_2->setDbValue($row['spo_2']);
        $this->submission_date->setDbValue($row['submission_date']);
        $this->submitted_by_user_id->setDbValue($row['submitted_by_user_id']);
        $this->patient_status->setDbValue($row['patient_status']);
    }

    // Render list content
    public function renderListContent($filter)
    {
        global $Response;
        $listPage = "JdhVitalsList";
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

        // vitals_id

        // patient_id

        // pressure

        // height

        // weight

        // body_mass_index

        // pulse_rate

        // respiratory_rate

        // temperature

        // random_blood_sugar

        // spo_2

        // submission_date

        // submitted_by_user_id

        // patient_status

        // vitals_id
        $this->vitals_id->ViewValue = $this->vitals_id->CurrentValue;

        // patient_id
        $curVal = strval($this->patient_id->CurrentValue);
        if ($curVal != "") {
            $this->patient_id->ViewValue = $this->patient_id->lookupCacheOption($curVal);
            if ($this->patient_id->ViewValue === null) { // Lookup from database
                $filterWrk = SearchFilter($this->patient_id->Lookup->getTable()->Fields["patient_id"]->searchExpression(), "=", $curVal, $this->patient_id->Lookup->getTable()->Fields["patient_id"]->searchDataType(), "");
                $sqlWrk = $this->patient_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCache($this->Cache);
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

        // pressure
        $this->pressure->ViewValue = $this->pressure->CurrentValue;
        $this->pressure->ViewValue = FormatNumber($this->pressure->ViewValue, $this->pressure->formatPattern());

        // height
        $this->height->ViewValue = $this->height->CurrentValue;
        $this->height->ViewValue = FormatNumber($this->height->ViewValue, $this->height->formatPattern());

        // weight
        $this->weight->ViewValue = $this->weight->CurrentValue;
        $this->weight->ViewValue = FormatNumber($this->weight->ViewValue, $this->weight->formatPattern());

        // body_mass_index
        $this->body_mass_index->ViewValue = $this->body_mass_index->CurrentValue;
        $this->body_mass_index->ViewValue = FormatNumber($this->body_mass_index->ViewValue, $this->body_mass_index->formatPattern());

        // pulse_rate
        $this->pulse_rate->ViewValue = $this->pulse_rate->CurrentValue;
        $this->pulse_rate->ViewValue = FormatNumber($this->pulse_rate->ViewValue, $this->pulse_rate->formatPattern());

        // respiratory_rate
        $this->respiratory_rate->ViewValue = $this->respiratory_rate->CurrentValue;
        $this->respiratory_rate->ViewValue = FormatNumber($this->respiratory_rate->ViewValue, $this->respiratory_rate->formatPattern());

        // temperature
        $this->temperature->ViewValue = $this->temperature->CurrentValue;
        $this->temperature->ViewValue = FormatNumber($this->temperature->ViewValue, $this->temperature->formatPattern());

        // random_blood_sugar
        $this->random_blood_sugar->ViewValue = $this->random_blood_sugar->CurrentValue;

        // spo_2
        $this->spo_2->ViewValue = $this->spo_2->CurrentValue;
        $this->spo_2->ViewValue = FormatNumber($this->spo_2->ViewValue, $this->spo_2->formatPattern());

        // submission_date
        $this->submission_date->ViewValue = $this->submission_date->CurrentValue;
        $this->submission_date->ViewValue = FormatDateTime($this->submission_date->ViewValue, $this->submission_date->formatPattern());

        // submitted_by_user_id
        $this->submitted_by_user_id->ViewValue = $this->submitted_by_user_id->CurrentValue;
        $this->submitted_by_user_id->ViewValue = FormatNumber($this->submitted_by_user_id->ViewValue, $this->submitted_by_user_id->formatPattern());

        // patient_status
        $this->patient_status->ViewValue = $this->patient_status->CurrentValue;

        // vitals_id
        $this->vitals_id->HrefValue = "";
        $this->vitals_id->TooltipValue = "";

        // patient_id
        $this->patient_id->HrefValue = "";
        $this->patient_id->TooltipValue = "";

        // pressure
        $this->pressure->HrefValue = "";
        $this->pressure->TooltipValue = "";

        // height
        $this->height->HrefValue = "";
        $this->height->TooltipValue = "";

        // weight
        $this->weight->HrefValue = "";
        $this->weight->TooltipValue = "";

        // body_mass_index
        $this->body_mass_index->HrefValue = "";
        $this->body_mass_index->TooltipValue = "";

        // pulse_rate
        $this->pulse_rate->HrefValue = "";
        $this->pulse_rate->TooltipValue = "";

        // respiratory_rate
        $this->respiratory_rate->HrefValue = "";
        $this->respiratory_rate->TooltipValue = "";

        // temperature
        $this->temperature->HrefValue = "";
        $this->temperature->TooltipValue = "";

        // random_blood_sugar
        $this->random_blood_sugar->HrefValue = "";
        $this->random_blood_sugar->TooltipValue = "";

        // spo_2
        $this->spo_2->HrefValue = "";
        $this->spo_2->TooltipValue = "";

        // submission_date
        $this->submission_date->HrefValue = "";
        $this->submission_date->TooltipValue = "";

        // submitted_by_user_id
        $this->submitted_by_user_id->HrefValue = "";
        $this->submitted_by_user_id->TooltipValue = "";

        // patient_status
        $this->patient_status->HrefValue = "";
        $this->patient_status->TooltipValue = "";

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

        // vitals_id
        $this->vitals_id->setupEditAttributes();
        $this->vitals_id->EditValue = $this->vitals_id->CurrentValue;

        // patient_id
        $this->patient_id->setupEditAttributes();
        if ($this->patient_id->getSessionValue() != "") {
            $this->patient_id->CurrentValue = GetForeignKeyValue($this->patient_id->getSessionValue());
            $curVal = strval($this->patient_id->CurrentValue);
            if ($curVal != "") {
                $this->patient_id->ViewValue = $this->patient_id->lookupCacheOption($curVal);
                if ($this->patient_id->ViewValue === null) { // Lookup from database
                    $filterWrk = SearchFilter($this->patient_id->Lookup->getTable()->Fields["patient_id"]->searchExpression(), "=", $curVal, $this->patient_id->Lookup->getTable()->Fields["patient_id"]->searchDataType(), "");
                    $sqlWrk = $this->patient_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCache($this->Cache);
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
            $this->patient_id->PlaceHolder = RemoveHtml($this->patient_id->caption());
        }

        // pressure
        $this->pressure->setupEditAttributes();
        $this->pressure->EditValue = $this->pressure->CurrentValue;
        $this->pressure->PlaceHolder = RemoveHtml($this->pressure->caption());
        if (strval($this->pressure->EditValue) != "" && is_numeric($this->pressure->EditValue)) {
            $this->pressure->EditValue = FormatNumber($this->pressure->EditValue, null);
        }

        // height
        $this->height->setupEditAttributes();
        $this->height->EditValue = $this->height->CurrentValue;
        $this->height->PlaceHolder = RemoveHtml($this->height->caption());
        if (strval($this->height->EditValue) != "" && is_numeric($this->height->EditValue)) {
            $this->height->EditValue = FormatNumber($this->height->EditValue, null);
        }

        // weight
        $this->weight->setupEditAttributes();
        $this->weight->EditValue = $this->weight->CurrentValue;
        $this->weight->PlaceHolder = RemoveHtml($this->weight->caption());
        if (strval($this->weight->EditValue) != "" && is_numeric($this->weight->EditValue)) {
            $this->weight->EditValue = FormatNumber($this->weight->EditValue, null);
        }

        // body_mass_index
        $this->body_mass_index->setupEditAttributes();
        $this->body_mass_index->EditValue = $this->body_mass_index->CurrentValue;
        $this->body_mass_index->EditValue = FormatNumber($this->body_mass_index->EditValue, $this->body_mass_index->formatPattern());

        // pulse_rate
        $this->pulse_rate->setupEditAttributes();
        $this->pulse_rate->EditValue = $this->pulse_rate->CurrentValue;
        $this->pulse_rate->PlaceHolder = RemoveHtml($this->pulse_rate->caption());
        if (strval($this->pulse_rate->EditValue) != "" && is_numeric($this->pulse_rate->EditValue)) {
            $this->pulse_rate->EditValue = FormatNumber($this->pulse_rate->EditValue, null);
        }

        // respiratory_rate
        $this->respiratory_rate->setupEditAttributes();
        $this->respiratory_rate->EditValue = $this->respiratory_rate->CurrentValue;
        $this->respiratory_rate->PlaceHolder = RemoveHtml($this->respiratory_rate->caption());
        if (strval($this->respiratory_rate->EditValue) != "" && is_numeric($this->respiratory_rate->EditValue)) {
            $this->respiratory_rate->EditValue = FormatNumber($this->respiratory_rate->EditValue, null);
        }

        // temperature
        $this->temperature->setupEditAttributes();
        $this->temperature->EditValue = $this->temperature->CurrentValue;
        $this->temperature->PlaceHolder = RemoveHtml($this->temperature->caption());
        if (strval($this->temperature->EditValue) != "" && is_numeric($this->temperature->EditValue)) {
            $this->temperature->EditValue = FormatNumber($this->temperature->EditValue, null);
        }

        // random_blood_sugar
        $this->random_blood_sugar->setupEditAttributes();
        if (!$this->random_blood_sugar->Raw) {
            $this->random_blood_sugar->CurrentValue = HtmlDecode($this->random_blood_sugar->CurrentValue);
        }
        $this->random_blood_sugar->EditValue = $this->random_blood_sugar->CurrentValue;
        $this->random_blood_sugar->PlaceHolder = RemoveHtml($this->random_blood_sugar->caption());

        // spo_2
        $this->spo_2->setupEditAttributes();
        $this->spo_2->EditValue = $this->spo_2->CurrentValue;
        $this->spo_2->PlaceHolder = RemoveHtml($this->spo_2->caption());
        if (strval($this->spo_2->EditValue) != "" && is_numeric($this->spo_2->EditValue)) {
            $this->spo_2->EditValue = FormatNumber($this->spo_2->EditValue, null);
        }

        // submission_date
        $this->submission_date->setupEditAttributes();
        $this->submission_date->EditValue = FormatDateTime($this->submission_date->CurrentValue, $this->submission_date->formatPattern());
        $this->submission_date->PlaceHolder = RemoveHtml($this->submission_date->caption());

        // submitted_by_user_id

        // patient_status
        $this->patient_status->setupEditAttributes();
        $this->patient_status->EditValue = $this->patient_status->CurrentValue;
        $this->patient_status->PlaceHolder = RemoveHtml($this->patient_status->caption());

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
                    $doc->exportCaption($this->vitals_id);
                    $doc->exportCaption($this->patient_id);
                    $doc->exportCaption($this->pressure);
                    $doc->exportCaption($this->height);
                    $doc->exportCaption($this->weight);
                    $doc->exportCaption($this->body_mass_index);
                    $doc->exportCaption($this->pulse_rate);
                    $doc->exportCaption($this->respiratory_rate);
                    $doc->exportCaption($this->temperature);
                    $doc->exportCaption($this->random_blood_sugar);
                    $doc->exportCaption($this->spo_2);
                    $doc->exportCaption($this->submission_date);
                } else {
                    $doc->exportCaption($this->vitals_id);
                    $doc->exportCaption($this->patient_id);
                    $doc->exportCaption($this->pressure);
                    $doc->exportCaption($this->height);
                    $doc->exportCaption($this->weight);
                    $doc->exportCaption($this->body_mass_index);
                    $doc->exportCaption($this->pulse_rate);
                    $doc->exportCaption($this->respiratory_rate);
                    $doc->exportCaption($this->temperature);
                    $doc->exportCaption($this->random_blood_sugar);
                    $doc->exportCaption($this->spo_2);
                    $doc->exportCaption($this->submission_date);
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
                        $doc->exportField($this->vitals_id);
                        $doc->exportField($this->patient_id);
                        $doc->exportField($this->pressure);
                        $doc->exportField($this->height);
                        $doc->exportField($this->weight);
                        $doc->exportField($this->body_mass_index);
                        $doc->exportField($this->pulse_rate);
                        $doc->exportField($this->respiratory_rate);
                        $doc->exportField($this->temperature);
                        $doc->exportField($this->random_blood_sugar);
                        $doc->exportField($this->spo_2);
                        $doc->exportField($this->submission_date);
                    } else {
                        $doc->exportField($this->vitals_id);
                        $doc->exportField($this->patient_id);
                        $doc->exportField($this->pressure);
                        $doc->exportField($this->height);
                        $doc->exportField($this->weight);
                        $doc->exportField($this->body_mass_index);
                        $doc->exportField($this->pulse_rate);
                        $doc->exportField($this->respiratory_rate);
                        $doc->exportField($this->temperature);
                        $doc->exportField($this->random_blood_sugar);
                        $doc->exportField($this->spo_2);
                        $doc->exportField($this->submission_date);
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
        $sql = "SELECT " . $masterfld->Expression . " FROM jdh_vitals";
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

    // Add master User ID filter
    public function addMasterUserIDFilter($filter, $currentMasterTable)
    {
        $filterWrk = $filter;
        if ($currentMasterTable == "jdh_patients") {
            $filterWrk = Container("jdh_patients")->addUserIDFilter($filterWrk);
        }
        return $filterWrk;
    }

    // Add detail User ID filter
    public function addDetailUserIDFilter($filter, $currentMasterTable)
    {
        $filterWrk = $filter;
        if ($currentMasterTable == "jdh_patients") {
            $mastertable = Container("jdh_patients");
            if (!$mastertable->userIDAllow()) {
                $subqueryWrk = $mastertable->getUserIDSubquery($this->patient_id, $mastertable->patient_id);
                AddFilter($filterWrk, $subqueryWrk);
            }
        }
        return $filterWrk;
    }

    // Get file data
    public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0, $plugins = [])
    {
        global $DownloadFileName;

        // No binary fields
        return false;
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
        if (($this->temperature->CurrentValue < 36) || ($this->temperature->CurrentValue > 39)) {
            $this->patient_status->CellAttrs["style"] = "background-color: green; padding-top: 20px; color: white; min-width: 300px";
            $status = "Move to low acuity or waiting area";
            $this->patient_status->ViewValue = $status;
        } else if (($this->respiratory_rate->CurrentValue < 10) || ($this->respiratory_rate->CurrentValue > 30)) {
             $this->patient_status->CellAttrs["style"] = "background-color: green; padding-top: 20px; color: white; min-width: 300px";
            $status = "Move to low acuity or waiting area";
            $this->patient_status->ViewValue = $status;
        } else if (($this->pulse_rate->CurrentValue < 60) || ($this->pulse_rate->CurrentValue > 130)) {
             $this->patient_status->CellAttrs["style"] = "background-color: green; padding-top: 20px; color: white; min-width: 300px";
            $status = "Move to low acuity or waiting area";
            $this->patient_status->ViewValue = $status;
        } else if ($this->spo_2->CurrentValue < 92) {
             $this->patient_status->CellAttrs["style"] = "background-color: green; padding-top: 20px; color: white; min-width: 300px";
            $status = "Move to low acuity or waiting area";
            $this->patient_status->ViewValue = $status;
        } 
        if (($this->pressure->CurrentValue >= 160)) {
             $this->patient_status->CellAttrs["style"] = "background-color: red !important; padding-top: 20px; color: white; min-width: 300px";
            $status = "Move to high acuity resuscitation area immediately";
            $this->patient_status->ViewValue = $status;
        }
    }

    // User ID Filtering event
    public function userIdFiltering(&$filter)
    {
        // Enter your code here
    }
}
