<?php
/**
 * PHPMaker 2023 user level settings
 */
namespace PHPMaker2023\jootidigitalhealthcare;

// User level info
$USER_LEVELS = [["-2","Anonymous"],
    ["0","Default"],
    ["1","Receptionist"],
    ["2","Doctor"],
    ["3","Nurse"],
    ["4","Lab Technician"],
    ["5","Pharmacist"],
    ["6","Accountant"],
    ["7","Stores"]];
// User level priv info
$USER_LEVEL_PRIVS = [["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_appointments","-2","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_appointments","0","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_appointments","1","2029"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_appointments","2","872"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_appointments","3","872"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_appointments","4","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_appointments","5","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_appointments","6","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_appointments","7","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_lab_test_categories","-2","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_lab_test_categories","0","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_lab_test_categories","1","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_lab_test_categories","2","872"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_lab_test_categories","3","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_lab_test_categories","4","2029"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_lab_test_categories","5","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_lab_test_categories","6","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_lab_test_categories","7","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_lab_test_subcategories","-2","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_lab_test_subcategories","0","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_lab_test_subcategories","1","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_lab_test_subcategories","2","872"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_lab_test_subcategories","3","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_lab_test_subcategories","4","2029"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_lab_test_subcategories","5","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_lab_test_subcategories","6","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_lab_test_subcategories","7","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_medicine_categories","-2","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_medicine_categories","0","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_medicine_categories","1","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_medicine_categories","2","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_medicine_categories","3","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_medicine_categories","4","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_medicine_categories","5","2029"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_medicine_categories","6","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_medicine_categories","7","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_medicines","-2","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_medicines","0","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_medicines","1","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_medicines","2","320"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_medicines","3","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_medicines","4","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_medicines","5","2029"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_medicines","6","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_medicines","7","360"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_patient_cases","-2","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_patient_cases","0","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_patient_cases","1","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_patient_cases","2","2029"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_patient_cases","3","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_patient_cases","4","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_patient_cases","5","320"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_patient_cases","6","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_patient_cases","7","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_patient_visits","-2","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_patient_visits","0","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_patient_visits","1","2029"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_patient_visits","2","360"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_patient_visits","3","872"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_patient_visits","4","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_patient_visits","5","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_patient_visits","6","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_patient_visits","7","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_patients","-2","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_patients","0","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_patients","1","2029"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_patients","2","872"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_patients","3","872"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_patients","4","872"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_patients","5","360"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_patients","6","360"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_patients","7","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_prescriptions","-2","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_prescriptions","0","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_prescriptions","1","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_prescriptions","2","877"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_prescriptions","3","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_prescriptions","4","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_prescriptions","5","1896"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_prescriptions","6","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_prescriptions","7","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_service_category","-2","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_service_category","0","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_service_category","1","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_service_category","2","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_service_category","3","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_service_category","4","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_service_category","5","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_service_category","6","2029"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_service_category","7","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_service_subcategory","-2","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_service_subcategory","0","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_service_subcategory","1","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_service_subcategory","2","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_service_subcategory","3","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_service_subcategory","4","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_service_subcategory","5","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_service_subcategory","6","2029"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_service_subcategory","7","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_services","-2","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_services","0","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_services","1","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_services","2","360"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_services","3","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_services","4","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_services","5","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_services","6","2029"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_services","7","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_test_reports","-2","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_test_reports","0","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_test_reports","1","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_test_reports","2","1384"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_test_reports","3","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_test_reports","4","2029"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_test_reports","5","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_test_reports","6","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_test_reports","7","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_test_requests","-2","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_test_requests","0","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_test_requests","1","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_test_requests","2","2025"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_test_requests","3","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_test_requests","4","1900"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_test_requests","5","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_test_requests","6","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_test_requests","7","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_users","-2","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_users","0","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_users","1","320"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_users","2","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_users","3","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_users","4","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_users","5","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_users","6","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_users","7","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_visit_types","-2","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_visit_types","0","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_visit_types","1","2029"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_visit_types","2","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_visit_types","3","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_visit_types","4","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_visit_types","5","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_visit_types","6","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_visit_types","7","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_vitals","-2","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_vitals","0","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_vitals","1","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_vitals","2","872"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_vitals","3","2029"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_vitals","4","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_vitals","5","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_vitals","6","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_vitals","7","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_departments","-2","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_departments","0","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_departments","1","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_departments","2","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_departments","3","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_departments","4","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_departments","5","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_departments","6","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_departments","7","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_roles","-2","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_roles","0","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_roles","1","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_roles","2","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_roles","3","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_roles","4","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_roles","5","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_roles","6","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_roles","7","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_audittrail","-2","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_audittrail","0","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_audittrail","1","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_audittrail","2","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_audittrail","3","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_audittrail","4","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_audittrail","5","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_audittrail","6","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_audittrail","7","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_notifications","-2","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_notifications","0","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_notifications","1","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_notifications","2","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_notifications","3","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_notifications","4","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_notifications","5","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_notifications","6","520"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_notifications","7","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_exportlog","-2","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_exportlog","0","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_exportlog","1","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_exportlog","2","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_exportlog","3","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_exportlog","4","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_exportlog","5","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_exportlog","6","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_exportlog","7","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_insurance","-2","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_insurance","0","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_insurance","1","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_insurance","2","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_insurance","3","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_insurance","4","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_insurance","5","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_insurance","6","2029"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_insurance","7","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}Patient Appointments","-2","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}Patient Appointments","0","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}Patient Appointments","1","72"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}Patient Appointments","2","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}Patient Appointments","3","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}Patient Appointments","4","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}Patient Appointments","5","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}Patient Appointments","6","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}Patient Appointments","7","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_chief_complaints","-2","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_chief_complaints","0","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_chief_complaints","1","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_chief_complaints","2","876"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_chief_complaints","3","2029"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_chief_complaints","4","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_chief_complaints","5","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_chief_complaints","6","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_chief_complaints","7","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_examination_findings","-2","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_examination_findings","0","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_examination_findings","1","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_examination_findings","2","2029"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_examination_findings","3","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_examination_findings","4","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_examination_findings","5","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_examination_findings","6","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_examination_findings","7","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_status","-2","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_status","0","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_status","1","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_status","2","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_status","3","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_status","4","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_status","5","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_status","6","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_status","7","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_lab_billing","-2","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_lab_billing","0","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_lab_billing","1","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_lab_billing","2","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_lab_billing","3","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_lab_billing","4","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_lab_billing","5","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_lab_billing","6","360"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_lab_billing","7","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_medicine_stock","-2","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_medicine_stock","0","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_medicine_stock","1","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_medicine_stock","2","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_medicine_stock","3","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_medicine_stock","4","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_medicine_stock","5","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_medicine_stock","6","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_medicine_stock","7","2029"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}Dashboard","-2","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}Dashboard","0","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}Dashboard","1","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}Dashboard","2","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}Dashboard","3","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}Dashboard","4","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}Dashboard","5","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}Dashboard","6","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}Dashboard","7","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}Latest Appointments","-2","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}Latest Appointments","0","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}Latest Appointments","1","2029"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}Latest Appointments","2","872"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}Latest Appointments","3","872"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}Latest Appointments","4","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}Latest Appointments","5","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}Latest Appointments","6","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}Latest Appointments","7","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_prescriptions_actions","-2","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_prescriptions_actions","0","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_prescriptions_actions","1","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_prescriptions_actions","2","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_prescriptions_actions","3","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_prescriptions_actions","4","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_prescriptions_actions","5","2029"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_prescriptions_actions","6","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_prescriptions_actions","7","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_pharmacy_income","-2","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_pharmacy_income","0","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_pharmacy_income","1","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_pharmacy_income","2","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_pharmacy_income","3","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_pharmacy_income","4","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_pharmacy_income","5","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_pharmacy_income","6","0"],
    ["{EDB02539-D193-4081-B8F6-DEFFEAE24230}jdh_pharmacy_income","7","0"]];
// User level table info
$USER_LEVEL_TABLES = [["jdh_appointments","jdh_appointments","Appointments",true,"{EDB02539-D193-4081-B8F6-DEFFEAE24230}","jdhappointmentslist"],
    ["jdh_lab_test_categories","jdh_lab_test_categories","Lab Test Categories",true,"{EDB02539-D193-4081-B8F6-DEFFEAE24230}","jdhlabtestcategorieslist"],
    ["jdh_lab_test_subcategories","jdh_lab_test_subcategories","Lab Test Subcategories",true,"{EDB02539-D193-4081-B8F6-DEFFEAE24230}","jdhlabtestsubcategorieslist"],
    ["jdh_medicine_categories","jdh_medicine_categories","Medicine Categories",true,"{EDB02539-D193-4081-B8F6-DEFFEAE24230}","jdhmedicinecategorieslist"],
    ["jdh_medicines","jdh_medicines","Medicines",true,"{EDB02539-D193-4081-B8F6-DEFFEAE24230}","jdhmedicineslist"],
    ["jdh_patient_cases","jdh_patient_cases","Cases",true,"{EDB02539-D193-4081-B8F6-DEFFEAE24230}","jdhpatientcaseslist"],
    ["jdh_patient_visits","jdh_patient_visits","Visits",true,"{EDB02539-D193-4081-B8F6-DEFFEAE24230}","jdhpatientvisitslist"],
    ["jdh_patients","jdh_patients","Patients",true,"{EDB02539-D193-4081-B8F6-DEFFEAE24230}","jdhpatientslist"],
    ["jdh_prescriptions","jdh_prescriptions","Prescriptions",true,"{EDB02539-D193-4081-B8F6-DEFFEAE24230}","jdhprescriptionslist"],
    ["jdh_service_category","jdh_service_category","Service Category",true,"{EDB02539-D193-4081-B8F6-DEFFEAE24230}","jdhservicecategorylist"],
    ["jdh_service_subcategory","jdh_service_subcategory","Service Subcategory",true,"{EDB02539-D193-4081-B8F6-DEFFEAE24230}","jdhservicesubcategorylist"],
    ["jdh_services","jdh_services","Services Costs",true,"{EDB02539-D193-4081-B8F6-DEFFEAE24230}","jdhserviceslist"],
    ["jdh_test_reports","jdh_test_reports","Test Reports",true,"{EDB02539-D193-4081-B8F6-DEFFEAE24230}","jdhtestreportslist"],
    ["jdh_test_requests","jdh_test_requests","Test Requests",true,"{EDB02539-D193-4081-B8F6-DEFFEAE24230}","jdhtestrequestslist"],
    ["jdh_users","jdh_users","Users",true,"{EDB02539-D193-4081-B8F6-DEFFEAE24230}","jdhuserslist"],
    ["jdh_visit_types","jdh_visit_types","Visit Types",true,"{EDB02539-D193-4081-B8F6-DEFFEAE24230}","jdhvisittypeslist"],
    ["jdh_vitals","jdh_vitals","Vitals",true,"{EDB02539-D193-4081-B8F6-DEFFEAE24230}","jdhvitalslist"],
    ["jdh_departments","jdh_departments","Departments",true,"{EDB02539-D193-4081-B8F6-DEFFEAE24230}","jdhdepartmentslist"],
    ["jdh_roles","jdh_roles","Roles",true,"{EDB02539-D193-4081-B8F6-DEFFEAE24230}","jdhroleslist"],
    ["jdh_audittrail","jdh_audittrail","System Logs",true,"{EDB02539-D193-4081-B8F6-DEFFEAE24230}","jdhaudittraillist"],
    ["jdh_notifications","jdh_notifications","Notifications",true,"{EDB02539-D193-4081-B8F6-DEFFEAE24230}","jdhnotificationslist"],
    ["jdh_exportlog","jdh_exportlog","Export Logs",true,"{EDB02539-D193-4081-B8F6-DEFFEAE24230}","jdhexportloglist"],
    ["jdh_insurance","jdh_insurance","Insurance",true,"{EDB02539-D193-4081-B8F6-DEFFEAE24230}","jdhinsurancelist"],
    ["Patient Appointments","Patient_Appointments","Appointments",true,"{EDB02539-D193-4081-B8F6-DEFFEAE24230}","patientappointments"],
    ["jdh_chief_complaints","jdh_chief_complaints","Chief Complaints",true,"{EDB02539-D193-4081-B8F6-DEFFEAE24230}","jdhchiefcomplaintslist"],
    ["jdh_examination_findings","jdh_examination_findings"," Findings",true,"{EDB02539-D193-4081-B8F6-DEFFEAE24230}","jdhexaminationfindingslist"],
    ["jdh_status","jdh_status","jdh status",true,"{EDB02539-D193-4081-B8F6-DEFFEAE24230}","jdhstatuslist"],
    ["jdh_lab_billing","jdh_lab_billing","Laboratory Billing",true,"{EDB02539-D193-4081-B8F6-DEFFEAE24230}","jdhlabbillinglist"],
    ["jdh_medicine_stock","jdh_medicine_stock","Medicine Stock",true,"{EDB02539-D193-4081-B8F6-DEFFEAE24230}","jdhmedicinestocklist"],
    ["Dashboard","Dashboard2","Dashboard",true,"{EDB02539-D193-4081-B8F6-DEFFEAE24230}","dashboard2"],
    ["Latest Appointments","Latest_Appointments","Latest Appointments",true,"{EDB02539-D193-4081-B8F6-DEFFEAE24230}","latestappointments"],
    ["jdh_prescriptions_actions","jdh_prescriptions_actions","Patients Prescriptions",true,"{EDB02539-D193-4081-B8F6-DEFFEAE24230}","jdhprescriptionsactionslist"],
    ["jdh_pharmacy_income","jdh_pharmacy_income","Pharmacy Income",true,"{EDB02539-D193-4081-B8F6-DEFFEAE24230}","jdhpharmacyincomelist"]];
