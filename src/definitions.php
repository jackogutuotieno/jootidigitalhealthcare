<?php

namespace PHPMaker2023\jootidigitalhealthcare;

use Slim\Views\PhpRenderer;
use Slim\Csrf\Guard;
use Slim\HttpCache\CacheProvider;
use Slim\Flash\Messages;
use Psr\Container\ContainerInterface;
use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;
use Doctrine\DBAL\Logging\LoggerChain;
use Doctrine\DBAL\Logging\DebugStack;

return [
    "cache" => \DI\create(CacheProvider::class),
    "flash" => fn(ContainerInterface $c) => new Messages(),
    "view" => fn(ContainerInterface $c) => new PhpRenderer($GLOBALS["RELATIVE_PATH"] . "views/"),
    "audit" => fn(ContainerInterface $c) => (new Logger("audit"))->pushHandler(new AuditTrailHandler("audit.log")), // For audit trail
    "log" => fn(ContainerInterface $c) => (new Logger("log"))->pushHandler(new RotatingFileHandler($GLOBALS["RELATIVE_PATH"] . "log.log")),
    "sqllogger" => function (ContainerInterface $c) {
        $loggers = [];
        if (Config("DEBUG")) {
            $loggers[] = $c->get("debugstack");
        }
        return (count($loggers) > 0) ? new LoggerChain($loggers) : null;
    },
    "csrf" => fn(ContainerInterface $c) => new Guard($GLOBALS["ResponseFactory"], Config("CSRF_PREFIX")),
    "debugstack" => \DI\create(DebugStack::class),
    "debugsqllogger" => \DI\create(DebugSqlLogger::class),
    "security" => \DI\create(AdvancedSecurity::class),
    "profile" => \DI\create(UserProfile::class),
    "language" => \DI\create(Language::class),
    "timer" => \DI\create(Timer::class),
    "session" => \DI\create(HttpSession::class),

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
    "jdh_notifications" => \DI\create(JdhNotifications::class),
    "jdh_exportlog" => \DI\create(JdhExportlog::class),
    "jdh_insurance" => \DI\create(JdhInsurance::class),
    "Patient_Appointments" => \DI\create(PatientAppointments::class),
    "jdh_chief_complaints" => \DI\create(JdhChiefComplaints::class),
    "jdh_examination_findings" => \DI\create(JdhExaminationFindings::class),
    "jdh_status" => \DI\create(JdhStatus::class),
    "jdh_medicine_stock" => \DI\create(JdhMedicineStock::class),
    "Dashboard2" => \DI\create(Dashboard2::class),
    "jdh_prescriptions_actions" => \DI\create(JdhPrescriptionsActions::class),
    "jdh_pharmacy_income" => \DI\create(JdhPharmacyIncome::class),
    "jdh_registration_income" => \DI\create(JdhRegistrationIncome::class),
    "jdh_doctor_charges" => \DI\create(JdhDoctorCharges::class),
    "jdh_consultation_income" => \DI\create(JdhConsultationIncome::class),
    "jdh_lab_income" => \DI\create(JdhLabIncome::class),
    "jdh_patient_queue" => \DI\create(JdhPatientQueue::class),
    "Patient_Queues" => \DI\create(PatientQueues::class),
    "jdh_rooms" => \DI\create(JdhRooms::class),
    "jdh_wards" => \DI\create(JdhWards::class),
    "beds" => \DI\create(Beds::class),
    "jdh_beds_assignment" => \DI\create(JdhBedsAssignment::class),
    "jdh_branding" => \DI\create(JdhBranding::class),
    "jdh_patients_insuarance" => \DI\create(JdhPatientsInsuarance::class),

    // User table
    "usertable" => \DI\get("jdh_users"),
];
