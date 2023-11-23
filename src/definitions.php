<?php

namespace PHPMaker2024\jootidigitalhealthcare;

use Slim\Views\PhpRenderer;
use Slim\Csrf\Guard;
use Slim\HttpCache\CacheProvider;
use Slim\Flash\Messages;
use Psr\Container\ContainerInterface;
use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;
use Doctrine\DBAL\Logging\LoggerChain;
use Doctrine\DBAL\Logging\DebugStack;
use Doctrine\DBAL\Platforms;
use Doctrine\Common\Cache\Psr6\DoctrineProvider;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Mime\MimeTypes;
use FastRoute\RouteParser\Std;
use Illuminate\Encryption\Encrypter;
use HTMLPurifier_Config;
use HTMLPurifier;

// Connections and entity managers
$definitions = [];
$dbids = array_keys(Config("Databases"));
foreach ($dbids as $dbid) {
    $definitions["connection." . $dbid] = \DI\factory(function (string $dbid) {
        return ConnectDb(Db($dbid));
    })->parameter("dbid", $dbid);
    $definitions["entitymanager." . $dbid] = \DI\factory(function (ContainerInterface $c, string $dbid) {
        $cache = IsDevelopment()
            ? DoctrineProvider::wrap(new ArrayAdapter())
            : DoctrineProvider::wrap(new FilesystemAdapter(directory: Config("DOCTRINE.CACHE_DIR")));
        $config = Setup::createAttributeMetadataConfiguration(
            Config("DOCTRINE.METADATA_DIRS"),
            IsDevelopment(),
            null,
            $cache
        );
        $conn = $c->get("connection." . $dbid);
        return new EntityManager($conn, $config);
    })->parameter("dbid", $dbid);
}

return [
    "app.cache" => \DI\create(CacheProvider::class),
    "app.flash" => fn(ContainerInterface $c) => new Messages(),
    "app.view" => fn(ContainerInterface $c) => new PhpRenderer($GLOBALS["RELATIVE_PATH"] . "views/"),
    "email.view" => fn(ContainerInterface $c) => new PhpRenderer($GLOBALS["RELATIVE_PATH"] . "lang/"),
    "sms.view" => fn(ContainerInterface $c) => new PhpRenderer($GLOBALS["RELATIVE_PATH"] . "lang/"),
    "app.audit" => fn(ContainerInterface $c) => (new Logger("audit"))->pushHandler(new AuditTrailHandler($GLOBALS["RELATIVE_PATH"] . "logs/audit.log")), // For audit trail
    "app.logger" => fn(ContainerInterface $c) => (new Logger("log"))->pushHandler(new RotatingFileHandler($GLOBALS["RELATIVE_PATH"] . "logs/log.log")),
    "sql.logger" => function (ContainerInterface $c) {
        $loggers = [];
        if (Config("DEBUG")) {
            $loggers[] = $c->get("debug.stack");
        }
        return (count($loggers) > 0) ? new LoggerChain($loggers) : null;
    },
    "app.csrf" => fn(ContainerInterface $c) => new Guard($GLOBALS["ResponseFactory"], Config("CSRF_PREFIX")),
    "html.purifier.config" => fn(ContainerInterface $c) => HTMLPurifier_Config::createDefault(),
    "html.purifier" => fn(ContainerInterface $c) => new HTMLPurifier($c->get("html.purifier.config")),
    "debug.stack" => \DI\create(DebugStack::class),
    "debug.sql.logger" => \DI\create(DebugSqlLogger::class),
    "debug.timer" => \DI\create(Timer::class),
    "app.security" => \DI\create(AdvancedSecurity::class),
    "user.profile" => \DI\create(UserProfile::class),
    "app.session" => \DI\create(HttpSession::class),
    "mime.types" => \DI\create(MimeTypes::class),
    "app.language" => \DI\create(Language::class),
    PermissionMiddleware::class => \DI\create(PermissionMiddleware::class),
    ApiPermissionMiddleware::class => \DI\create(ApiPermissionMiddleware::class),
    JwtMiddleware::class => \DI\create(JwtMiddleware::class),
    Std::class => \DI\create(Std::class),
    Encrypter::class => fn(ContainerInterface $c) => new Encrypter(AesEncryptionKey(base64_decode(Config("AES_ENCRYPTION_KEY"))), Config("AES_ENCRYPTION_CIPHER")),

    // Tables
    "jdh_appointments" => \DI\create(JdhAppointments::class),
    "jdh_lab_test_categories" => \DI\create(JdhLabTestCategories::class),
    "jdh_lab_test_subcategories" => \DI\create(JdhLabTestSubcategories::class),
    "jdh_medicine_categories" => \DI\create(JdhMedicineCategories::class),
    "jdh_medicines" => \DI\create(JdhMedicines::class),
    "jdh_patient_cases" => \DI\create(JdhPatientCases::class),
    "jdh_patient_visits" => \DI\create(JdhPatientVisits::class),
    "jdh_patients" => \DI\create(JdhPatients::class),
    "jdh_prescriptions" => \DI\create(JdhPrescriptions::class),
    "jdh_service_category" => \DI\create(JdhServiceCategory::class),
    "jdh_service_subcategory" => \DI\create(JdhServiceSubcategory::class),
    "jdh_services" => \DI\create(JdhServices::class),
    "jdh_test_reports" => \DI\create(JdhTestReports::class),
    "jdh_test_requests" => \DI\create(JdhTestRequests::class),
    "jdh_users" => \DI\create(JdhUsers::class),
    "jdh_visit_types" => \DI\create(JdhVisitTypes::class),
    "jdh_vitals" => \DI\create(JdhVitals::class),
    "jdh_departments" => \DI\create(JdhDepartments::class),
    "jdh_roles" => \DI\create(JdhRoles::class),
    "jdh_audittrail" => \DI\create(JdhAudittrail::class),
    "jdh_exportlog" => \DI\create(JdhExportlog::class),
    "jdh_insurance" => \DI\create(JdhInsurance::class),
    "Patient_Appointments" => \DI\create(PatientAppointments::class),
    "patient_appointments" => \DI\create(PatientAppointments::class),
    "jdh_chief_complaints" => \DI\create(JdhChiefComplaints::class),
    "jdh_examination_findings" => \DI\create(JdhExaminationFindings::class),
    "jdh_status" => \DI\create(JdhStatus::class),
    "jdh_medicine_stock" => \DI\create(JdhMedicineStock::class),
    "Dashboard2" => \DI\create(Dashboard2::class),
    "dashboard2" => \DI\create(Dashboard2::class),
    "jdh_prescriptions_actions" => \DI\create(JdhPrescriptionsActions::class),
    "jdh_pharmacy_income" => \DI\create(JdhPharmacyIncome::class),
    "jdh_registration_income" => \DI\create(JdhRegistrationIncome::class),
    "jdh_doctor_charges" => \DI\create(JdhDoctorCharges::class),
    "jdh_consultation_income" => \DI\create(JdhConsultationIncome::class),
    "jdh_lab_income" => \DI\create(JdhLabIncome::class),
    "jdh_patient_queue" => \DI\create(JdhPatientQueue::class),
    "Patient_Queues" => \DI\create(PatientQueues::class),
    "patient_queues" => \DI\create(PatientQueues::class),
    "jdh_wards" => \DI\create(JdhWards::class),
    "jdh_branding" => \DI\create(JdhBranding::class),
    "subscriptions" => \DI\create(Subscriptions::class),
    "jdh_beds" => \DI\create(JdhBeds::class),
    "jdh_ipd_admission" => \DI\create(JdhIpdAdmission::class),
    "jdh_facility_units" => \DI\create(JdhFacilityUnits::class),
    "jdh_invoice" => \DI\create(JdhInvoice::class),
    "jdh_invoice_items" => \DI\create(JdhInvoiceItems::class),

    // User table
    "usertable" => \DI\get("jdh_users"),
] + $definitions;
