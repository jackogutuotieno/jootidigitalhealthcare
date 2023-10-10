<?php

namespace PHPMaker2023\jootidigitalhealthcare;

use Slim\App;
use Slim\Routing\RouteCollectorProxy;
use Slim\Exception\HttpNotFoundException;

// Handle Routes
return function (App $app) {
    // jdh_appointments
    $app->map(["GET","POST","OPTIONS"], '/jdhappointmentslist[/{appointment_id}]', JdhAppointmentsController::class . ':list')->add(PermissionMiddleware::class)->setName('jdhappointmentslist-jdh_appointments-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/jdhappointmentsadd[/{appointment_id}]', JdhAppointmentsController::class . ':add')->add(PermissionMiddleware::class)->setName('jdhappointmentsadd-jdh_appointments-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/jdhappointmentsview[/{appointment_id}]', JdhAppointmentsController::class . ':view')->add(PermissionMiddleware::class)->setName('jdhappointmentsview-jdh_appointments-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/jdhappointmentsedit[/{appointment_id}]', JdhAppointmentsController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdhappointmentsedit-jdh_appointments-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/jdhappointmentsdelete[/{appointment_id}]', JdhAppointmentsController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdhappointmentsdelete-jdh_appointments-delete'); // delete
    $app->group(
        '/jdh_appointments',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{appointment_id}]', JdhAppointmentsController::class . ':list')->add(PermissionMiddleware::class)->setName('jdh_appointments/list-jdh_appointments-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{appointment_id}]', JdhAppointmentsController::class . ':add')->add(PermissionMiddleware::class)->setName('jdh_appointments/add-jdh_appointments-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{appointment_id}]', JdhAppointmentsController::class . ':view')->add(PermissionMiddleware::class)->setName('jdh_appointments/view-jdh_appointments-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{appointment_id}]', JdhAppointmentsController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdh_appointments/edit-jdh_appointments-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{appointment_id}]', JdhAppointmentsController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdh_appointments/delete-jdh_appointments-delete-2'); // delete
        }
    );

    // jdh_lab_test_categories
    $app->map(["GET","POST","OPTIONS"], '/jdhlabtestcategorieslist[/{test_category_id}]', JdhLabTestCategoriesController::class . ':list')->add(PermissionMiddleware::class)->setName('jdhlabtestcategorieslist-jdh_lab_test_categories-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/jdhlabtestcategoriesadd[/{test_category_id}]', JdhLabTestCategoriesController::class . ':add')->add(PermissionMiddleware::class)->setName('jdhlabtestcategoriesadd-jdh_lab_test_categories-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/jdhlabtestcategoriesview[/{test_category_id}]', JdhLabTestCategoriesController::class . ':view')->add(PermissionMiddleware::class)->setName('jdhlabtestcategoriesview-jdh_lab_test_categories-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/jdhlabtestcategoriesedit[/{test_category_id}]', JdhLabTestCategoriesController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdhlabtestcategoriesedit-jdh_lab_test_categories-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/jdhlabtestcategoriesdelete[/{test_category_id}]', JdhLabTestCategoriesController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdhlabtestcategoriesdelete-jdh_lab_test_categories-delete'); // delete
    $app->group(
        '/jdh_lab_test_categories',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{test_category_id}]', JdhLabTestCategoriesController::class . ':list')->add(PermissionMiddleware::class)->setName('jdh_lab_test_categories/list-jdh_lab_test_categories-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{test_category_id}]', JdhLabTestCategoriesController::class . ':add')->add(PermissionMiddleware::class)->setName('jdh_lab_test_categories/add-jdh_lab_test_categories-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{test_category_id}]', JdhLabTestCategoriesController::class . ':view')->add(PermissionMiddleware::class)->setName('jdh_lab_test_categories/view-jdh_lab_test_categories-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{test_category_id}]', JdhLabTestCategoriesController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdh_lab_test_categories/edit-jdh_lab_test_categories-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{test_category_id}]', JdhLabTestCategoriesController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdh_lab_test_categories/delete-jdh_lab_test_categories-delete-2'); // delete
        }
    );

    // jdh_lab_test_subcategories
    $app->map(["GET","POST","OPTIONS"], '/jdhlabtestsubcategorieslist[/{test_subcategory_id}]', JdhLabTestSubcategoriesController::class . ':list')->add(PermissionMiddleware::class)->setName('jdhlabtestsubcategorieslist-jdh_lab_test_subcategories-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/jdhlabtestsubcategoriesadd[/{test_subcategory_id}]', JdhLabTestSubcategoriesController::class . ':add')->add(PermissionMiddleware::class)->setName('jdhlabtestsubcategoriesadd-jdh_lab_test_subcategories-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/jdhlabtestsubcategoriesedit[/{test_subcategory_id}]', JdhLabTestSubcategoriesController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdhlabtestsubcategoriesedit-jdh_lab_test_subcategories-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/jdhlabtestsubcategoriesdelete[/{test_subcategory_id}]', JdhLabTestSubcategoriesController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdhlabtestsubcategoriesdelete-jdh_lab_test_subcategories-delete'); // delete
    $app->group(
        '/jdh_lab_test_subcategories',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{test_subcategory_id}]', JdhLabTestSubcategoriesController::class . ':list')->add(PermissionMiddleware::class)->setName('jdh_lab_test_subcategories/list-jdh_lab_test_subcategories-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{test_subcategory_id}]', JdhLabTestSubcategoriesController::class . ':add')->add(PermissionMiddleware::class)->setName('jdh_lab_test_subcategories/add-jdh_lab_test_subcategories-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{test_subcategory_id}]', JdhLabTestSubcategoriesController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdh_lab_test_subcategories/edit-jdh_lab_test_subcategories-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{test_subcategory_id}]', JdhLabTestSubcategoriesController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdh_lab_test_subcategories/delete-jdh_lab_test_subcategories-delete-2'); // delete
        }
    );

    // jdh_medicine_categories
    $app->map(["GET","POST","OPTIONS"], '/jdhmedicinecategorieslist[/{category_id}]', JdhMedicineCategoriesController::class . ':list')->add(PermissionMiddleware::class)->setName('jdhmedicinecategorieslist-jdh_medicine_categories-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/jdhmedicinecategoriesadd[/{category_id}]', JdhMedicineCategoriesController::class . ':add')->add(PermissionMiddleware::class)->setName('jdhmedicinecategoriesadd-jdh_medicine_categories-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/jdhmedicinecategoriesview[/{category_id}]', JdhMedicineCategoriesController::class . ':view')->add(PermissionMiddleware::class)->setName('jdhmedicinecategoriesview-jdh_medicine_categories-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/jdhmedicinecategoriesedit[/{category_id}]', JdhMedicineCategoriesController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdhmedicinecategoriesedit-jdh_medicine_categories-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/jdhmedicinecategoriesdelete[/{category_id}]', JdhMedicineCategoriesController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdhmedicinecategoriesdelete-jdh_medicine_categories-delete'); // delete
    $app->group(
        '/jdh_medicine_categories',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{category_id}]', JdhMedicineCategoriesController::class . ':list')->add(PermissionMiddleware::class)->setName('jdh_medicine_categories/list-jdh_medicine_categories-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{category_id}]', JdhMedicineCategoriesController::class . ':add')->add(PermissionMiddleware::class)->setName('jdh_medicine_categories/add-jdh_medicine_categories-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{category_id}]', JdhMedicineCategoriesController::class . ':view')->add(PermissionMiddleware::class)->setName('jdh_medicine_categories/view-jdh_medicine_categories-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{category_id}]', JdhMedicineCategoriesController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdh_medicine_categories/edit-jdh_medicine_categories-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{category_id}]', JdhMedicineCategoriesController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdh_medicine_categories/delete-jdh_medicine_categories-delete-2'); // delete
        }
    );

    // jdh_medicines
    $app->map(["GET","POST","OPTIONS"], '/jdhmedicineslist[/{id}]', JdhMedicinesController::class . ':list')->add(PermissionMiddleware::class)->setName('jdhmedicineslist-jdh_medicines-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/jdhmedicinesadd[/{id}]', JdhMedicinesController::class . ':add')->add(PermissionMiddleware::class)->setName('jdhmedicinesadd-jdh_medicines-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/jdhmedicinesview[/{id}]', JdhMedicinesController::class . ':view')->add(PermissionMiddleware::class)->setName('jdhmedicinesview-jdh_medicines-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/jdhmedicinesedit[/{id}]', JdhMedicinesController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdhmedicinesedit-jdh_medicines-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/jdhmedicinesdelete[/{id}]', JdhMedicinesController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdhmedicinesdelete-jdh_medicines-delete'); // delete
    $app->group(
        '/jdh_medicines',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{id}]', JdhMedicinesController::class . ':list')->add(PermissionMiddleware::class)->setName('jdh_medicines/list-jdh_medicines-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{id}]', JdhMedicinesController::class . ':add')->add(PermissionMiddleware::class)->setName('jdh_medicines/add-jdh_medicines-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{id}]', JdhMedicinesController::class . ':view')->add(PermissionMiddleware::class)->setName('jdh_medicines/view-jdh_medicines-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{id}]', JdhMedicinesController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdh_medicines/edit-jdh_medicines-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{id}]', JdhMedicinesController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdh_medicines/delete-jdh_medicines-delete-2'); // delete
        }
    );

    // jdh_patient_cases
    $app->map(["GET","POST","OPTIONS"], '/jdhpatientcaseslist[/{case_id}]', JdhPatientCasesController::class . ':list')->add(PermissionMiddleware::class)->setName('jdhpatientcaseslist-jdh_patient_cases-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/jdhpatientcasesadd[/{case_id}]', JdhPatientCasesController::class . ':add')->add(PermissionMiddleware::class)->setName('jdhpatientcasesadd-jdh_patient_cases-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/jdhpatientcasesview[/{case_id}]', JdhPatientCasesController::class . ':view')->add(PermissionMiddleware::class)->setName('jdhpatientcasesview-jdh_patient_cases-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/jdhpatientcasesedit[/{case_id}]', JdhPatientCasesController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdhpatientcasesedit-jdh_patient_cases-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/jdhpatientcasesdelete[/{case_id}]', JdhPatientCasesController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdhpatientcasesdelete-jdh_patient_cases-delete'); // delete
    $app->group(
        '/jdh_patient_cases',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{case_id}]', JdhPatientCasesController::class . ':list')->add(PermissionMiddleware::class)->setName('jdh_patient_cases/list-jdh_patient_cases-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{case_id}]', JdhPatientCasesController::class . ':add')->add(PermissionMiddleware::class)->setName('jdh_patient_cases/add-jdh_patient_cases-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{case_id}]', JdhPatientCasesController::class . ':view')->add(PermissionMiddleware::class)->setName('jdh_patient_cases/view-jdh_patient_cases-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{case_id}]', JdhPatientCasesController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdh_patient_cases/edit-jdh_patient_cases-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{case_id}]', JdhPatientCasesController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdh_patient_cases/delete-jdh_patient_cases-delete-2'); // delete
        }
    );

    // jdh_patient_visits
    $app->map(["GET","POST","OPTIONS"], '/jdhpatientvisitslist[/{visit_id}]', JdhPatientVisitsController::class . ':list')->add(PermissionMiddleware::class)->setName('jdhpatientvisitslist-jdh_patient_visits-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/jdhpatientvisitsadd[/{visit_id}]', JdhPatientVisitsController::class . ':add')->add(PermissionMiddleware::class)->setName('jdhpatientvisitsadd-jdh_patient_visits-add'); // add
    $app->group(
        '/jdh_patient_visits',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{visit_id}]', JdhPatientVisitsController::class . ':list')->add(PermissionMiddleware::class)->setName('jdh_patient_visits/list-jdh_patient_visits-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{visit_id}]', JdhPatientVisitsController::class . ':add')->add(PermissionMiddleware::class)->setName('jdh_patient_visits/add-jdh_patient_visits-add-2'); // add
        }
    );

    // jdh_patients
    $app->map(["GET","POST","OPTIONS"], '/jdhpatientslist[/{patient_id}]', JdhPatientsController::class . ':list')->add(PermissionMiddleware::class)->setName('jdhpatientslist-jdh_patients-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/jdhpatientsadd[/{patient_id}]', JdhPatientsController::class . ':add')->add(PermissionMiddleware::class)->setName('jdhpatientsadd-jdh_patients-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/jdhpatientsview[/{patient_id}]', JdhPatientsController::class . ':view')->add(PermissionMiddleware::class)->setName('jdhpatientsview-jdh_patients-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/jdhpatientsedit[/{patient_id}]', JdhPatientsController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdhpatientsedit-jdh_patients-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/jdhpatientsdelete[/{patient_id}]', JdhPatientsController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdhpatientsdelete-jdh_patients-delete'); // delete
    $app->map(["GET","POST","OPTIONS"], '/jdhpatientssearch', JdhPatientsController::class . ':search')->add(PermissionMiddleware::class)->setName('jdhpatientssearch-jdh_patients-search'); // search
    $app->group(
        '/jdh_patients',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{patient_id}]', JdhPatientsController::class . ':list')->add(PermissionMiddleware::class)->setName('jdh_patients/list-jdh_patients-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{patient_id}]', JdhPatientsController::class . ':add')->add(PermissionMiddleware::class)->setName('jdh_patients/add-jdh_patients-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{patient_id}]', JdhPatientsController::class . ':view')->add(PermissionMiddleware::class)->setName('jdh_patients/view-jdh_patients-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{patient_id}]', JdhPatientsController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdh_patients/edit-jdh_patients-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{patient_id}]', JdhPatientsController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdh_patients/delete-jdh_patients-delete-2'); // delete
            $group->map(["GET","POST","OPTIONS"], '/' . Config('SEARCH_ACTION') . '', JdhPatientsController::class . ':search')->add(PermissionMiddleware::class)->setName('jdh_patients/search-jdh_patients-search-2'); // search
        }
    );

    // jdh_prescriptions
    $app->map(["GET","POST","OPTIONS"], '/jdhprescriptionslist[/{prescription_id}]', JdhPrescriptionsController::class . ':list')->add(PermissionMiddleware::class)->setName('jdhprescriptionslist-jdh_prescriptions-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/jdhprescriptionsadd[/{prescription_id}]', JdhPrescriptionsController::class . ':add')->add(PermissionMiddleware::class)->setName('jdhprescriptionsadd-jdh_prescriptions-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/jdhprescriptionsview[/{prescription_id}]', JdhPrescriptionsController::class . ':view')->add(PermissionMiddleware::class)->setName('jdhprescriptionsview-jdh_prescriptions-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/jdhprescriptionsedit[/{prescription_id}]', JdhPrescriptionsController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdhprescriptionsedit-jdh_prescriptions-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/jdhprescriptionsdelete[/{prescription_id}]', JdhPrescriptionsController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdhprescriptionsdelete-jdh_prescriptions-delete'); // delete
    $app->group(
        '/jdh_prescriptions',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{prescription_id}]', JdhPrescriptionsController::class . ':list')->add(PermissionMiddleware::class)->setName('jdh_prescriptions/list-jdh_prescriptions-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{prescription_id}]', JdhPrescriptionsController::class . ':add')->add(PermissionMiddleware::class)->setName('jdh_prescriptions/add-jdh_prescriptions-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{prescription_id}]', JdhPrescriptionsController::class . ':view')->add(PermissionMiddleware::class)->setName('jdh_prescriptions/view-jdh_prescriptions-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{prescription_id}]', JdhPrescriptionsController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdh_prescriptions/edit-jdh_prescriptions-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{prescription_id}]', JdhPrescriptionsController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdh_prescriptions/delete-jdh_prescriptions-delete-2'); // delete
        }
    );

    // jdh_service_category
    $app->map(["GET","POST","OPTIONS"], '/jdhservicecategorylist[/{category_id}]', JdhServiceCategoryController::class . ':list')->add(PermissionMiddleware::class)->setName('jdhservicecategorylist-jdh_service_category-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/jdhservicecategoryadd[/{category_id}]', JdhServiceCategoryController::class . ':add')->add(PermissionMiddleware::class)->setName('jdhservicecategoryadd-jdh_service_category-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/jdhservicecategoryview[/{category_id}]', JdhServiceCategoryController::class . ':view')->add(PermissionMiddleware::class)->setName('jdhservicecategoryview-jdh_service_category-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/jdhservicecategoryedit[/{category_id}]', JdhServiceCategoryController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdhservicecategoryedit-jdh_service_category-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/jdhservicecategorydelete[/{category_id}]', JdhServiceCategoryController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdhservicecategorydelete-jdh_service_category-delete'); // delete
    $app->group(
        '/jdh_service_category',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{category_id}]', JdhServiceCategoryController::class . ':list')->add(PermissionMiddleware::class)->setName('jdh_service_category/list-jdh_service_category-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{category_id}]', JdhServiceCategoryController::class . ':add')->add(PermissionMiddleware::class)->setName('jdh_service_category/add-jdh_service_category-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{category_id}]', JdhServiceCategoryController::class . ':view')->add(PermissionMiddleware::class)->setName('jdh_service_category/view-jdh_service_category-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{category_id}]', JdhServiceCategoryController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdh_service_category/edit-jdh_service_category-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{category_id}]', JdhServiceCategoryController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdh_service_category/delete-jdh_service_category-delete-2'); // delete
        }
    );

    // jdh_service_subcategory
    $app->map(["GET","POST","OPTIONS"], '/jdhservicesubcategorylist[/{subcategory_id}]', JdhServiceSubcategoryController::class . ':list')->add(PermissionMiddleware::class)->setName('jdhservicesubcategorylist-jdh_service_subcategory-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/jdhservicesubcategoryadd[/{subcategory_id}]', JdhServiceSubcategoryController::class . ':add')->add(PermissionMiddleware::class)->setName('jdhservicesubcategoryadd-jdh_service_subcategory-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/jdhservicesubcategoryview[/{subcategory_id}]', JdhServiceSubcategoryController::class . ':view')->add(PermissionMiddleware::class)->setName('jdhservicesubcategoryview-jdh_service_subcategory-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/jdhservicesubcategoryedit[/{subcategory_id}]', JdhServiceSubcategoryController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdhservicesubcategoryedit-jdh_service_subcategory-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/jdhservicesubcategorydelete[/{subcategory_id}]', JdhServiceSubcategoryController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdhservicesubcategorydelete-jdh_service_subcategory-delete'); // delete
    $app->group(
        '/jdh_service_subcategory',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{subcategory_id}]', JdhServiceSubcategoryController::class . ':list')->add(PermissionMiddleware::class)->setName('jdh_service_subcategory/list-jdh_service_subcategory-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{subcategory_id}]', JdhServiceSubcategoryController::class . ':add')->add(PermissionMiddleware::class)->setName('jdh_service_subcategory/add-jdh_service_subcategory-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{subcategory_id}]', JdhServiceSubcategoryController::class . ':view')->add(PermissionMiddleware::class)->setName('jdh_service_subcategory/view-jdh_service_subcategory-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{subcategory_id}]', JdhServiceSubcategoryController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdh_service_subcategory/edit-jdh_service_subcategory-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{subcategory_id}]', JdhServiceSubcategoryController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdh_service_subcategory/delete-jdh_service_subcategory-delete-2'); // delete
        }
    );

    // jdh_services
    $app->map(["GET","POST","OPTIONS"], '/jdhserviceslist[/{service_id}]', JdhServicesController::class . ':list')->add(PermissionMiddleware::class)->setName('jdhserviceslist-jdh_services-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/jdhservicesadd[/{service_id}]', JdhServicesController::class . ':add')->add(PermissionMiddleware::class)->setName('jdhservicesadd-jdh_services-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/jdhservicesview[/{service_id}]', JdhServicesController::class . ':view')->add(PermissionMiddleware::class)->setName('jdhservicesview-jdh_services-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/jdhservicesedit[/{service_id}]', JdhServicesController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdhservicesedit-jdh_services-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/jdhservicesdelete[/{service_id}]', JdhServicesController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdhservicesdelete-jdh_services-delete'); // delete
    $app->group(
        '/jdh_services',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{service_id}]', JdhServicesController::class . ':list')->add(PermissionMiddleware::class)->setName('jdh_services/list-jdh_services-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{service_id}]', JdhServicesController::class . ':add')->add(PermissionMiddleware::class)->setName('jdh_services/add-jdh_services-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{service_id}]', JdhServicesController::class . ':view')->add(PermissionMiddleware::class)->setName('jdh_services/view-jdh_services-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{service_id}]', JdhServicesController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdh_services/edit-jdh_services-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{service_id}]', JdhServicesController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdh_services/delete-jdh_services-delete-2'); // delete
        }
    );

    // jdh_test_reports
    $app->map(["GET","POST","OPTIONS"], '/jdhtestreportslist[/{report_id}]', JdhTestReportsController::class . ':list')->add(PermissionMiddleware::class)->setName('jdhtestreportslist-jdh_test_reports-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/jdhtestreportsadd[/{report_id}]', JdhTestReportsController::class . ':add')->add(PermissionMiddleware::class)->setName('jdhtestreportsadd-jdh_test_reports-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/jdhtestreportsview[/{report_id}]', JdhTestReportsController::class . ':view')->add(PermissionMiddleware::class)->setName('jdhtestreportsview-jdh_test_reports-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/jdhtestreportsedit[/{report_id}]', JdhTestReportsController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdhtestreportsedit-jdh_test_reports-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/jdhtestreportsdelete[/{report_id}]', JdhTestReportsController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdhtestreportsdelete-jdh_test_reports-delete'); // delete
    $app->group(
        '/jdh_test_reports',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{report_id}]', JdhTestReportsController::class . ':list')->add(PermissionMiddleware::class)->setName('jdh_test_reports/list-jdh_test_reports-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{report_id}]', JdhTestReportsController::class . ':add')->add(PermissionMiddleware::class)->setName('jdh_test_reports/add-jdh_test_reports-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{report_id}]', JdhTestReportsController::class . ':view')->add(PermissionMiddleware::class)->setName('jdh_test_reports/view-jdh_test_reports-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{report_id}]', JdhTestReportsController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdh_test_reports/edit-jdh_test_reports-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{report_id}]', JdhTestReportsController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdh_test_reports/delete-jdh_test_reports-delete-2'); // delete
        }
    );

    // jdh_test_requests
    $app->map(["GET","POST","OPTIONS"], '/jdhtestrequestslist[/{request_id}]', JdhTestRequestsController::class . ':list')->add(PermissionMiddleware::class)->setName('jdhtestrequestslist-jdh_test_requests-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/jdhtestrequestsadd[/{request_id}]', JdhTestRequestsController::class . ':add')->add(PermissionMiddleware::class)->setName('jdhtestrequestsadd-jdh_test_requests-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/jdhtestrequestsview[/{request_id}]', JdhTestRequestsController::class . ':view')->add(PermissionMiddleware::class)->setName('jdhtestrequestsview-jdh_test_requests-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/jdhtestrequestsedit[/{request_id}]', JdhTestRequestsController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdhtestrequestsedit-jdh_test_requests-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/jdhtestrequestsdelete[/{request_id}]', JdhTestRequestsController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdhtestrequestsdelete-jdh_test_requests-delete'); // delete
    $app->group(
        '/jdh_test_requests',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{request_id}]', JdhTestRequestsController::class . ':list')->add(PermissionMiddleware::class)->setName('jdh_test_requests/list-jdh_test_requests-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{request_id}]', JdhTestRequestsController::class . ':add')->add(PermissionMiddleware::class)->setName('jdh_test_requests/add-jdh_test_requests-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{request_id}]', JdhTestRequestsController::class . ':view')->add(PermissionMiddleware::class)->setName('jdh_test_requests/view-jdh_test_requests-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{request_id}]', JdhTestRequestsController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdh_test_requests/edit-jdh_test_requests-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{request_id}]', JdhTestRequestsController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdh_test_requests/delete-jdh_test_requests-delete-2'); // delete
        }
    );

    // jdh_users
    $app->map(["GET","POST","OPTIONS"], '/jdhuserslist[/{user_id}]', JdhUsersController::class . ':list')->add(PermissionMiddleware::class)->setName('jdhuserslist-jdh_users-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/jdhusersadd[/{user_id}]', JdhUsersController::class . ':add')->add(PermissionMiddleware::class)->setName('jdhusersadd-jdh_users-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/jdhusersview[/{user_id}]', JdhUsersController::class . ':view')->add(PermissionMiddleware::class)->setName('jdhusersview-jdh_users-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/jdhusersedit[/{user_id}]', JdhUsersController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdhusersedit-jdh_users-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/jdhusersdelete[/{user_id}]', JdhUsersController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdhusersdelete-jdh_users-delete'); // delete
    $app->group(
        '/jdh_users',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{user_id}]', JdhUsersController::class . ':list')->add(PermissionMiddleware::class)->setName('jdh_users/list-jdh_users-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{user_id}]', JdhUsersController::class . ':add')->add(PermissionMiddleware::class)->setName('jdh_users/add-jdh_users-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{user_id}]', JdhUsersController::class . ':view')->add(PermissionMiddleware::class)->setName('jdh_users/view-jdh_users-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{user_id}]', JdhUsersController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdh_users/edit-jdh_users-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{user_id}]', JdhUsersController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdh_users/delete-jdh_users-delete-2'); // delete
        }
    );

    // jdh_visit_types
    $app->map(["GET","POST","OPTIONS"], '/jdhvisittypeslist[/{visit_type_id}]', JdhVisitTypesController::class . ':list')->add(PermissionMiddleware::class)->setName('jdhvisittypeslist-jdh_visit_types-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/jdhvisittypesadd[/{visit_type_id}]', JdhVisitTypesController::class . ':add')->add(PermissionMiddleware::class)->setName('jdhvisittypesadd-jdh_visit_types-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/jdhvisittypesview[/{visit_type_id}]', JdhVisitTypesController::class . ':view')->add(PermissionMiddleware::class)->setName('jdhvisittypesview-jdh_visit_types-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/jdhvisittypesedit[/{visit_type_id}]', JdhVisitTypesController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdhvisittypesedit-jdh_visit_types-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/jdhvisittypesdelete[/{visit_type_id}]', JdhVisitTypesController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdhvisittypesdelete-jdh_visit_types-delete'); // delete
    $app->group(
        '/jdh_visit_types',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{visit_type_id}]', JdhVisitTypesController::class . ':list')->add(PermissionMiddleware::class)->setName('jdh_visit_types/list-jdh_visit_types-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{visit_type_id}]', JdhVisitTypesController::class . ':add')->add(PermissionMiddleware::class)->setName('jdh_visit_types/add-jdh_visit_types-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{visit_type_id}]', JdhVisitTypesController::class . ':view')->add(PermissionMiddleware::class)->setName('jdh_visit_types/view-jdh_visit_types-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{visit_type_id}]', JdhVisitTypesController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdh_visit_types/edit-jdh_visit_types-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{visit_type_id}]', JdhVisitTypesController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdh_visit_types/delete-jdh_visit_types-delete-2'); // delete
        }
    );

    // jdh_vitals
    $app->map(["GET","POST","OPTIONS"], '/jdhvitalslist[/{vitals_id}]', JdhVitalsController::class . ':list')->add(PermissionMiddleware::class)->setName('jdhvitalslist-jdh_vitals-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/jdhvitalsadd[/{vitals_id}]', JdhVitalsController::class . ':add')->add(PermissionMiddleware::class)->setName('jdhvitalsadd-jdh_vitals-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/jdhvitalsview[/{vitals_id}]', JdhVitalsController::class . ':view')->add(PermissionMiddleware::class)->setName('jdhvitalsview-jdh_vitals-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/jdhvitalsedit[/{vitals_id}]', JdhVitalsController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdhvitalsedit-jdh_vitals-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/jdhvitalsdelete[/{vitals_id}]', JdhVitalsController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdhvitalsdelete-jdh_vitals-delete'); // delete
    $app->group(
        '/jdh_vitals',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{vitals_id}]', JdhVitalsController::class . ':list')->add(PermissionMiddleware::class)->setName('jdh_vitals/list-jdh_vitals-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{vitals_id}]', JdhVitalsController::class . ':add')->add(PermissionMiddleware::class)->setName('jdh_vitals/add-jdh_vitals-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{vitals_id}]', JdhVitalsController::class . ':view')->add(PermissionMiddleware::class)->setName('jdh_vitals/view-jdh_vitals-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{vitals_id}]', JdhVitalsController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdh_vitals/edit-jdh_vitals-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{vitals_id}]', JdhVitalsController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdh_vitals/delete-jdh_vitals-delete-2'); // delete
        }
    );

    // jdh_departments
    $app->map(["GET","POST","OPTIONS"], '/jdhdepartmentslist[/{department_id}]', JdhDepartmentsController::class . ':list')->add(PermissionMiddleware::class)->setName('jdhdepartmentslist-jdh_departments-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/jdhdepartmentsadd[/{department_id}]', JdhDepartmentsController::class . ':add')->add(PermissionMiddleware::class)->setName('jdhdepartmentsadd-jdh_departments-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/jdhdepartmentsedit[/{department_id}]', JdhDepartmentsController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdhdepartmentsedit-jdh_departments-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/jdhdepartmentsdelete[/{department_id}]', JdhDepartmentsController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdhdepartmentsdelete-jdh_departments-delete'); // delete
    $app->group(
        '/jdh_departments',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{department_id}]', JdhDepartmentsController::class . ':list')->add(PermissionMiddleware::class)->setName('jdh_departments/list-jdh_departments-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{department_id}]', JdhDepartmentsController::class . ':add')->add(PermissionMiddleware::class)->setName('jdh_departments/add-jdh_departments-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{department_id}]', JdhDepartmentsController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdh_departments/edit-jdh_departments-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{department_id}]', JdhDepartmentsController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdh_departments/delete-jdh_departments-delete-2'); // delete
        }
    );

    // jdh_roles
    $app->map(["GET","POST","OPTIONS"], '/jdhroleslist[/{role_id}]', JdhRolesController::class . ':list')->add(PermissionMiddleware::class)->setName('jdhroleslist-jdh_roles-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/jdhrolesadd[/{role_id}]', JdhRolesController::class . ':add')->add(PermissionMiddleware::class)->setName('jdhrolesadd-jdh_roles-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/jdhrolesview[/{role_id}]', JdhRolesController::class . ':view')->add(PermissionMiddleware::class)->setName('jdhrolesview-jdh_roles-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/jdhrolesedit[/{role_id}]', JdhRolesController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdhrolesedit-jdh_roles-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/jdhrolesdelete[/{role_id}]', JdhRolesController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdhrolesdelete-jdh_roles-delete'); // delete
    $app->group(
        '/jdh_roles',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{role_id}]', JdhRolesController::class . ':list')->add(PermissionMiddleware::class)->setName('jdh_roles/list-jdh_roles-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{role_id}]', JdhRolesController::class . ':add')->add(PermissionMiddleware::class)->setName('jdh_roles/add-jdh_roles-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{role_id}]', JdhRolesController::class . ':view')->add(PermissionMiddleware::class)->setName('jdh_roles/view-jdh_roles-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{role_id}]', JdhRolesController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdh_roles/edit-jdh_roles-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{role_id}]', JdhRolesController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdh_roles/delete-jdh_roles-delete-2'); // delete
        }
    );

    // jdh_audittrail
    $app->map(["GET","POST","OPTIONS"], '/jdhaudittraillist[/{Id}]', JdhAudittrailController::class . ':list')->add(PermissionMiddleware::class)->setName('jdhaudittraillist-jdh_audittrail-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/jdhaudittrailadd[/{Id}]', JdhAudittrailController::class . ':add')->add(PermissionMiddleware::class)->setName('jdhaudittrailadd-jdh_audittrail-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/jdhaudittrailview[/{Id}]', JdhAudittrailController::class . ':view')->add(PermissionMiddleware::class)->setName('jdhaudittrailview-jdh_audittrail-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/jdhaudittrailedit[/{Id}]', JdhAudittrailController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdhaudittrailedit-jdh_audittrail-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/jdhaudittraildelete[/{Id}]', JdhAudittrailController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdhaudittraildelete-jdh_audittrail-delete'); // delete
    $app->group(
        '/jdh_audittrail',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{Id}]', JdhAudittrailController::class . ':list')->add(PermissionMiddleware::class)->setName('jdh_audittrail/list-jdh_audittrail-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{Id}]', JdhAudittrailController::class . ':add')->add(PermissionMiddleware::class)->setName('jdh_audittrail/add-jdh_audittrail-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{Id}]', JdhAudittrailController::class . ':view')->add(PermissionMiddleware::class)->setName('jdh_audittrail/view-jdh_audittrail-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{Id}]', JdhAudittrailController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdh_audittrail/edit-jdh_audittrail-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{Id}]', JdhAudittrailController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdh_audittrail/delete-jdh_audittrail-delete-2'); // delete
        }
    );

    // jdh_exportlog
    $app->map(["GET","POST","OPTIONS"], '/jdhexportloglist[/{FileId:.*}]', JdhExportlogController::class . ':list')->add(PermissionMiddleware::class)->setName('jdhexportloglist-jdh_exportlog-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/jdhexportlogadd[/{FileId:.*}]', JdhExportlogController::class . ':add')->add(PermissionMiddleware::class)->setName('jdhexportlogadd-jdh_exportlog-add'); // add
    $app->group(
        '/jdh_exportlog',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{FileId:.*}]', JdhExportlogController::class . ':list')->add(PermissionMiddleware::class)->setName('jdh_exportlog/list-jdh_exportlog-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{FileId:.*}]', JdhExportlogController::class . ':add')->add(PermissionMiddleware::class)->setName('jdh_exportlog/add-jdh_exportlog-add-2'); // add
        }
    );

    // jdh_insurance
    $app->map(["GET","POST","OPTIONS"], '/jdhinsurancelist[/{insurance_id}]', JdhInsuranceController::class . ':list')->add(PermissionMiddleware::class)->setName('jdhinsurancelist-jdh_insurance-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/jdhinsuranceadd[/{insurance_id}]', JdhInsuranceController::class . ':add')->add(PermissionMiddleware::class)->setName('jdhinsuranceadd-jdh_insurance-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/jdhinsuranceview[/{insurance_id}]', JdhInsuranceController::class . ':view')->add(PermissionMiddleware::class)->setName('jdhinsuranceview-jdh_insurance-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/jdhinsuranceedit[/{insurance_id}]', JdhInsuranceController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdhinsuranceedit-jdh_insurance-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/jdhinsurancedelete[/{insurance_id}]', JdhInsuranceController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdhinsurancedelete-jdh_insurance-delete'); // delete
    $app->group(
        '/jdh_insurance',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{insurance_id}]', JdhInsuranceController::class . ':list')->add(PermissionMiddleware::class)->setName('jdh_insurance/list-jdh_insurance-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{insurance_id}]', JdhInsuranceController::class . ':add')->add(PermissionMiddleware::class)->setName('jdh_insurance/add-jdh_insurance-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{insurance_id}]', JdhInsuranceController::class . ':view')->add(PermissionMiddleware::class)->setName('jdh_insurance/view-jdh_insurance-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{insurance_id}]', JdhInsuranceController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdh_insurance/edit-jdh_insurance-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{insurance_id}]', JdhInsuranceController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdh_insurance/delete-jdh_insurance-delete-2'); // delete
        }
    );

    // Patient_Appointments
    $app->map(["GET", "POST", "OPTIONS"], '/patientappointments', PatientAppointmentsController::class . ':calendar')->add(PermissionMiddleware::class)->setName('patientappointments-Patient_Appointments-calendar'); // calendar
    $app->map(["GET","POST","OPTIONS"], '/patientappointmentsadd[/{appointment_id}]', PatientAppointmentsController::class . ':add')->add(PermissionMiddleware::class)->setName('patientappointmentsadd-Patient_Appointments-add'); // add
    $app->map(["GET","OPTIONS"], '/patientappointmentsview[/{appointment_id}]', PatientAppointmentsController::class . ':view')->add(PermissionMiddleware::class)->setName('patientappointmentsview-Patient_Appointments-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/patientappointmentsedit[/{appointment_id}]', PatientAppointmentsController::class . ':edit')->add(PermissionMiddleware::class)->setName('patientappointmentsedit-Patient_Appointments-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/patientappointmentsdelete[/{appointment_id}]', PatientAppointmentsController::class . ':delete')->add(PermissionMiddleware::class)->setName('patientappointmentsdelete-Patient_Appointments-delete'); // delete

    // jdh_chief_complaints
    $app->map(["GET","POST","OPTIONS"], '/jdhchiefcomplaintslist[/{id}]', JdhChiefComplaintsController::class . ':list')->add(PermissionMiddleware::class)->setName('jdhchiefcomplaintslist-jdh_chief_complaints-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/jdhchiefcomplaintsadd[/{id}]', JdhChiefComplaintsController::class . ':add')->add(PermissionMiddleware::class)->setName('jdhchiefcomplaintsadd-jdh_chief_complaints-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/jdhchiefcomplaintsview[/{id}]', JdhChiefComplaintsController::class . ':view')->add(PermissionMiddleware::class)->setName('jdhchiefcomplaintsview-jdh_chief_complaints-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/jdhchiefcomplaintsedit[/{id}]', JdhChiefComplaintsController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdhchiefcomplaintsedit-jdh_chief_complaints-edit'); // edit
    $app->group(
        '/jdh_chief_complaints',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{id}]', JdhChiefComplaintsController::class . ':list')->add(PermissionMiddleware::class)->setName('jdh_chief_complaints/list-jdh_chief_complaints-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{id}]', JdhChiefComplaintsController::class . ':add')->add(PermissionMiddleware::class)->setName('jdh_chief_complaints/add-jdh_chief_complaints-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{id}]', JdhChiefComplaintsController::class . ':view')->add(PermissionMiddleware::class)->setName('jdh_chief_complaints/view-jdh_chief_complaints-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{id}]', JdhChiefComplaintsController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdh_chief_complaints/edit-jdh_chief_complaints-edit-2'); // edit
        }
    );

    // jdh_examination_findings
    $app->map(["GET","POST","OPTIONS"], '/jdhexaminationfindingslist[/{id}]', JdhExaminationFindingsController::class . ':list')->add(PermissionMiddleware::class)->setName('jdhexaminationfindingslist-jdh_examination_findings-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/jdhexaminationfindingsadd[/{id}]', JdhExaminationFindingsController::class . ':add')->add(PermissionMiddleware::class)->setName('jdhexaminationfindingsadd-jdh_examination_findings-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/jdhexaminationfindingsview[/{id}]', JdhExaminationFindingsController::class . ':view')->add(PermissionMiddleware::class)->setName('jdhexaminationfindingsview-jdh_examination_findings-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/jdhexaminationfindingsedit[/{id}]', JdhExaminationFindingsController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdhexaminationfindingsedit-jdh_examination_findings-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/jdhexaminationfindingsupdate', JdhExaminationFindingsController::class . ':update')->add(PermissionMiddleware::class)->setName('jdhexaminationfindingsupdate-jdh_examination_findings-update'); // update
    $app->map(["GET","POST","OPTIONS"], '/jdhexaminationfindingsdelete[/{id}]', JdhExaminationFindingsController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdhexaminationfindingsdelete-jdh_examination_findings-delete'); // delete
    $app->group(
        '/jdh_examination_findings',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{id}]', JdhExaminationFindingsController::class . ':list')->add(PermissionMiddleware::class)->setName('jdh_examination_findings/list-jdh_examination_findings-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{id}]', JdhExaminationFindingsController::class . ':add')->add(PermissionMiddleware::class)->setName('jdh_examination_findings/add-jdh_examination_findings-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{id}]', JdhExaminationFindingsController::class . ':view')->add(PermissionMiddleware::class)->setName('jdh_examination_findings/view-jdh_examination_findings-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{id}]', JdhExaminationFindingsController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdh_examination_findings/edit-jdh_examination_findings-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('UPDATE_ACTION') . '', JdhExaminationFindingsController::class . ':update')->add(PermissionMiddleware::class)->setName('jdh_examination_findings/update-jdh_examination_findings-update-2'); // update
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{id}]', JdhExaminationFindingsController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdh_examination_findings/delete-jdh_examination_findings-delete-2'); // delete
        }
    );

    // jdh_status
    $app->map(["GET","POST","OPTIONS"], '/jdhstatuslist[/{status_id}]', JdhStatusController::class . ':list')->add(PermissionMiddleware::class)->setName('jdhstatuslist-jdh_status-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/jdhstatusadd[/{status_id}]', JdhStatusController::class . ':add')->add(PermissionMiddleware::class)->setName('jdhstatusadd-jdh_status-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/jdhstatusview[/{status_id}]', JdhStatusController::class . ':view')->add(PermissionMiddleware::class)->setName('jdhstatusview-jdh_status-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/jdhstatusedit[/{status_id}]', JdhStatusController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdhstatusedit-jdh_status-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/jdhstatusdelete[/{status_id}]', JdhStatusController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdhstatusdelete-jdh_status-delete'); // delete
    $app->group(
        '/jdh_status',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{status_id}]', JdhStatusController::class . ':list')->add(PermissionMiddleware::class)->setName('jdh_status/list-jdh_status-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{status_id}]', JdhStatusController::class . ':add')->add(PermissionMiddleware::class)->setName('jdh_status/add-jdh_status-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{status_id}]', JdhStatusController::class . ':view')->add(PermissionMiddleware::class)->setName('jdh_status/view-jdh_status-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{status_id}]', JdhStatusController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdh_status/edit-jdh_status-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{status_id}]', JdhStatusController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdh_status/delete-jdh_status-delete-2'); // delete
        }
    );

    // jdh_medicine_stock
    $app->map(["GET","POST","OPTIONS"], '/jdhmedicinestocklist[/{id}]', JdhMedicineStockController::class . ':list')->add(PermissionMiddleware::class)->setName('jdhmedicinestocklist-jdh_medicine_stock-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/jdhmedicinestockadd[/{id}]', JdhMedicineStockController::class . ':add')->add(PermissionMiddleware::class)->setName('jdhmedicinestockadd-jdh_medicine_stock-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/jdhmedicinestockview[/{id}]', JdhMedicineStockController::class . ':view')->add(PermissionMiddleware::class)->setName('jdhmedicinestockview-jdh_medicine_stock-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/jdhmedicinestockedit[/{id}]', JdhMedicineStockController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdhmedicinestockedit-jdh_medicine_stock-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/jdhmedicinestockdelete[/{id}]', JdhMedicineStockController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdhmedicinestockdelete-jdh_medicine_stock-delete'); // delete
    $app->group(
        '/jdh_medicine_stock',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{id}]', JdhMedicineStockController::class . ':list')->add(PermissionMiddleware::class)->setName('jdh_medicine_stock/list-jdh_medicine_stock-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{id}]', JdhMedicineStockController::class . ':add')->add(PermissionMiddleware::class)->setName('jdh_medicine_stock/add-jdh_medicine_stock-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{id}]', JdhMedicineStockController::class . ':view')->add(PermissionMiddleware::class)->setName('jdh_medicine_stock/view-jdh_medicine_stock-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{id}]', JdhMedicineStockController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdh_medicine_stock/edit-jdh_medicine_stock-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{id}]', JdhMedicineStockController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdh_medicine_stock/delete-jdh_medicine_stock-delete-2'); // delete
        }
    );

    // Dashboard2
    $app->map(["GET", "POST", "OPTIONS"], '/dashboard2', Dashboard2Controller::class . ':dashboard')->add(PermissionMiddleware::class)->setName('dashboard2-Dashboard2-dashboard'); // dashboard

    // jdh_prescriptions_actions
    $app->map(["GET","POST","OPTIONS"], '/jdhprescriptionsactionslist[/{id}]', JdhPrescriptionsActionsController::class . ':list')->add(PermissionMiddleware::class)->setName('jdhprescriptionsactionslist-jdh_prescriptions_actions-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/jdhprescriptionsactionsadd[/{id}]', JdhPrescriptionsActionsController::class . ':add')->add(PermissionMiddleware::class)->setName('jdhprescriptionsactionsadd-jdh_prescriptions_actions-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/jdhprescriptionsactionsview[/{id}]', JdhPrescriptionsActionsController::class . ':view')->add(PermissionMiddleware::class)->setName('jdhprescriptionsactionsview-jdh_prescriptions_actions-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/jdhprescriptionsactionsedit[/{id}]', JdhPrescriptionsActionsController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdhprescriptionsactionsedit-jdh_prescriptions_actions-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/jdhprescriptionsactionsdelete[/{id}]', JdhPrescriptionsActionsController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdhprescriptionsactionsdelete-jdh_prescriptions_actions-delete'); // delete
    $app->group(
        '/jdh_prescriptions_actions',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{id}]', JdhPrescriptionsActionsController::class . ':list')->add(PermissionMiddleware::class)->setName('jdh_prescriptions_actions/list-jdh_prescriptions_actions-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{id}]', JdhPrescriptionsActionsController::class . ':add')->add(PermissionMiddleware::class)->setName('jdh_prescriptions_actions/add-jdh_prescriptions_actions-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{id}]', JdhPrescriptionsActionsController::class . ':view')->add(PermissionMiddleware::class)->setName('jdh_prescriptions_actions/view-jdh_prescriptions_actions-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{id}]', JdhPrescriptionsActionsController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdh_prescriptions_actions/edit-jdh_prescriptions_actions-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{id}]', JdhPrescriptionsActionsController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdh_prescriptions_actions/delete-jdh_prescriptions_actions-delete-2'); // delete
        }
    );

    // jdh_pharmacy_income
    $app->map(["GET","POST","OPTIONS"], '/jdhpharmacyincomelist[/{patient_id}]', JdhPharmacyIncomeController::class . ':list')->add(PermissionMiddleware::class)->setName('jdhpharmacyincomelist-jdh_pharmacy_income-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/jdhpharmacyincomeview[/{patient_id}]', JdhPharmacyIncomeController::class . ':view')->add(PermissionMiddleware::class)->setName('jdhpharmacyincomeview-jdh_pharmacy_income-view'); // view
    $app->group(
        '/jdh_pharmacy_income',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{patient_id}]', JdhPharmacyIncomeController::class . ':list')->add(PermissionMiddleware::class)->setName('jdh_pharmacy_income/list-jdh_pharmacy_income-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{patient_id}]', JdhPharmacyIncomeController::class . ':view')->add(PermissionMiddleware::class)->setName('jdh_pharmacy_income/view-jdh_pharmacy_income-view-2'); // view
        }
    );

    // jdh_registration_income
    $app->map(["GET","POST","OPTIONS"], '/jdhregistrationincomelist[/{patient_id}]', JdhRegistrationIncomeController::class . ':list')->add(PermissionMiddleware::class)->setName('jdhregistrationincomelist-jdh_registration_income-list'); // list
    $app->group(
        '/jdh_registration_income',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{patient_id}]', JdhRegistrationIncomeController::class . ':list')->add(PermissionMiddleware::class)->setName('jdh_registration_income/list-jdh_registration_income-list-2'); // list
        }
    );

    // jdh_doctor_charges
    $app->map(["GET","POST","OPTIONS"], '/jdhdoctorchargeslist[/{id}]', JdhDoctorChargesController::class . ':list')->add(PermissionMiddleware::class)->setName('jdhdoctorchargeslist-jdh_doctor_charges-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/jdhdoctorchargesadd[/{id}]', JdhDoctorChargesController::class . ':add')->add(PermissionMiddleware::class)->setName('jdhdoctorchargesadd-jdh_doctor_charges-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/jdhdoctorchargesview[/{id}]', JdhDoctorChargesController::class . ':view')->add(PermissionMiddleware::class)->setName('jdhdoctorchargesview-jdh_doctor_charges-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/jdhdoctorchargesedit[/{id}]', JdhDoctorChargesController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdhdoctorchargesedit-jdh_doctor_charges-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/jdhdoctorchargesdelete[/{id}]', JdhDoctorChargesController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdhdoctorchargesdelete-jdh_doctor_charges-delete'); // delete
    $app->group(
        '/jdh_doctor_charges',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{id}]', JdhDoctorChargesController::class . ':list')->add(PermissionMiddleware::class)->setName('jdh_doctor_charges/list-jdh_doctor_charges-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{id}]', JdhDoctorChargesController::class . ':add')->add(PermissionMiddleware::class)->setName('jdh_doctor_charges/add-jdh_doctor_charges-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{id}]', JdhDoctorChargesController::class . ':view')->add(PermissionMiddleware::class)->setName('jdh_doctor_charges/view-jdh_doctor_charges-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{id}]', JdhDoctorChargesController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdh_doctor_charges/edit-jdh_doctor_charges-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{id}]', JdhDoctorChargesController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdh_doctor_charges/delete-jdh_doctor_charges-delete-2'); // delete
        }
    );

    // jdh_consultation_income
    $app->map(["GET","POST","OPTIONS"], '/jdhconsultationincomelist[/{user_id}]', JdhConsultationIncomeController::class . ':list')->add(PermissionMiddleware::class)->setName('jdhconsultationincomelist-jdh_consultation_income-list'); // list
    $app->group(
        '/jdh_consultation_income',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{user_id}]', JdhConsultationIncomeController::class . ':list')->add(PermissionMiddleware::class)->setName('jdh_consultation_income/list-jdh_consultation_income-list-2'); // list
        }
    );

    // jdh_lab_income
    $app->map(["GET","POST","OPTIONS"], '/jdhlabincomelist[/{patient_id}]', JdhLabIncomeController::class . ':list')->add(PermissionMiddleware::class)->setName('jdhlabincomelist-jdh_lab_income-list'); // list
    $app->group(
        '/jdh_lab_income',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{patient_id}]', JdhLabIncomeController::class . ':list')->add(PermissionMiddleware::class)->setName('jdh_lab_income/list-jdh_lab_income-list-2'); // list
        }
    );

    // jdh_patient_queue
    $app->map(["GET","POST","OPTIONS"], '/jdhpatientqueuelist[/{visit_id}]', JdhPatientQueueController::class . ':list')->add(PermissionMiddleware::class)->setName('jdhpatientqueuelist-jdh_patient_queue-list'); // list
    $app->group(
        '/jdh_patient_queue',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{visit_id}]', JdhPatientQueueController::class . ':list')->add(PermissionMiddleware::class)->setName('jdh_patient_queue/list-jdh_patient_queue-list-2'); // list
        }
    );

    // Patient_Queues
    $app->map(["GET", "POST", "OPTIONS"], '/patientqueues/PatientQueues', PatientQueuesController::class . ':PatientQueues')->add(PermissionMiddleware::class)->setName('patientqueues-Patient_Queues-summary-PatientQueues'); // PatientQueues
    $app->map(["GET", "POST", "OPTIONS"], '/patientqueues', PatientQueuesController::class . ':summary')->add(PermissionMiddleware::class)->setName('patientqueues-Patient_Queues-summary'); // summary

    // jdh_rooms
    $app->map(["GET","POST","OPTIONS"], '/jdhroomslist[/{room_id}]', JdhRoomsController::class . ':list')->add(PermissionMiddleware::class)->setName('jdhroomslist-jdh_rooms-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/jdhroomsadd[/{room_id}]', JdhRoomsController::class . ':add')->add(PermissionMiddleware::class)->setName('jdhroomsadd-jdh_rooms-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/jdhroomsview[/{room_id}]', JdhRoomsController::class . ':view')->add(PermissionMiddleware::class)->setName('jdhroomsview-jdh_rooms-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/jdhroomsedit[/{room_id}]', JdhRoomsController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdhroomsedit-jdh_rooms-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/jdhroomsdelete[/{room_id}]', JdhRoomsController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdhroomsdelete-jdh_rooms-delete'); // delete
    $app->group(
        '/jdh_rooms',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{room_id}]', JdhRoomsController::class . ':list')->add(PermissionMiddleware::class)->setName('jdh_rooms/list-jdh_rooms-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{room_id}]', JdhRoomsController::class . ':add')->add(PermissionMiddleware::class)->setName('jdh_rooms/add-jdh_rooms-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{room_id}]', JdhRoomsController::class . ':view')->add(PermissionMiddleware::class)->setName('jdh_rooms/view-jdh_rooms-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{room_id}]', JdhRoomsController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdh_rooms/edit-jdh_rooms-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{room_id}]', JdhRoomsController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdh_rooms/delete-jdh_rooms-delete-2'); // delete
        }
    );

    // jdh_wards
    $app->map(["GET","POST","OPTIONS"], '/jdhwardslist[/{ward_id}]', JdhWardsController::class . ':list')->add(PermissionMiddleware::class)->setName('jdhwardslist-jdh_wards-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/jdhwardsadd[/{ward_id}]', JdhWardsController::class . ':add')->add(PermissionMiddleware::class)->setName('jdhwardsadd-jdh_wards-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/jdhwardsview[/{ward_id}]', JdhWardsController::class . ':view')->add(PermissionMiddleware::class)->setName('jdhwardsview-jdh_wards-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/jdhwardsedit[/{ward_id}]', JdhWardsController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdhwardsedit-jdh_wards-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/jdhwardsdelete[/{ward_id}]', JdhWardsController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdhwardsdelete-jdh_wards-delete'); // delete
    $app->group(
        '/jdh_wards',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{ward_id}]', JdhWardsController::class . ':list')->add(PermissionMiddleware::class)->setName('jdh_wards/list-jdh_wards-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{ward_id}]', JdhWardsController::class . ':add')->add(PermissionMiddleware::class)->setName('jdh_wards/add-jdh_wards-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{ward_id}]', JdhWardsController::class . ':view')->add(PermissionMiddleware::class)->setName('jdh_wards/view-jdh_wards-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{ward_id}]', JdhWardsController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdh_wards/edit-jdh_wards-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{ward_id}]', JdhWardsController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdh_wards/delete-jdh_wards-delete-2'); // delete
        }
    );

    // beds
    $app->map(["GET","POST","OPTIONS"], '/bedslist[/{bed_id}]', BedsController::class . ':list')->add(PermissionMiddleware::class)->setName('bedslist-beds-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/bedsadd[/{bed_id}]', BedsController::class . ':add')->add(PermissionMiddleware::class)->setName('bedsadd-beds-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/bedsview[/{bed_id}]', BedsController::class . ':view')->add(PermissionMiddleware::class)->setName('bedsview-beds-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/bedsedit[/{bed_id}]', BedsController::class . ':edit')->add(PermissionMiddleware::class)->setName('bedsedit-beds-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/bedsdelete[/{bed_id}]', BedsController::class . ':delete')->add(PermissionMiddleware::class)->setName('bedsdelete-beds-delete'); // delete
    $app->group(
        '/beds',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{bed_id}]', BedsController::class . ':list')->add(PermissionMiddleware::class)->setName('beds/list-beds-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{bed_id}]', BedsController::class . ':add')->add(PermissionMiddleware::class)->setName('beds/add-beds-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{bed_id}]', BedsController::class . ':view')->add(PermissionMiddleware::class)->setName('beds/view-beds-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{bed_id}]', BedsController::class . ':edit')->add(PermissionMiddleware::class)->setName('beds/edit-beds-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{bed_id}]', BedsController::class . ':delete')->add(PermissionMiddleware::class)->setName('beds/delete-beds-delete-2'); // delete
        }
    );

    // jdh_beds_assignment
    $app->map(["GET","POST","OPTIONS"], '/jdhbedsassignmentlist[/{id}]', JdhBedsAssignmentController::class . ':list')->add(PermissionMiddleware::class)->setName('jdhbedsassignmentlist-jdh_beds_assignment-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/jdhbedsassignmentadd[/{id}]', JdhBedsAssignmentController::class . ':add')->add(PermissionMiddleware::class)->setName('jdhbedsassignmentadd-jdh_beds_assignment-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/jdhbedsassignmentview[/{id}]', JdhBedsAssignmentController::class . ':view')->add(PermissionMiddleware::class)->setName('jdhbedsassignmentview-jdh_beds_assignment-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/jdhbedsassignmentedit[/{id}]', JdhBedsAssignmentController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdhbedsassignmentedit-jdh_beds_assignment-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/jdhbedsassignmentdelete[/{id}]', JdhBedsAssignmentController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdhbedsassignmentdelete-jdh_beds_assignment-delete'); // delete
    $app->group(
        '/jdh_beds_assignment',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{id}]', JdhBedsAssignmentController::class . ':list')->add(PermissionMiddleware::class)->setName('jdh_beds_assignment/list-jdh_beds_assignment-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{id}]', JdhBedsAssignmentController::class . ':add')->add(PermissionMiddleware::class)->setName('jdh_beds_assignment/add-jdh_beds_assignment-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{id}]', JdhBedsAssignmentController::class . ':view')->add(PermissionMiddleware::class)->setName('jdh_beds_assignment/view-jdh_beds_assignment-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{id}]', JdhBedsAssignmentController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdh_beds_assignment/edit-jdh_beds_assignment-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{id}]', JdhBedsAssignmentController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdh_beds_assignment/delete-jdh_beds_assignment-delete-2'); // delete
        }
    );

    // jdh_branding
    $app->map(["GET","POST","OPTIONS"], '/jdhbrandinglist[/{id}]', JdhBrandingController::class . ':list')->add(PermissionMiddleware::class)->setName('jdhbrandinglist-jdh_branding-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/jdhbrandingadd[/{id}]', JdhBrandingController::class . ':add')->add(PermissionMiddleware::class)->setName('jdhbrandingadd-jdh_branding-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/jdhbrandingview[/{id}]', JdhBrandingController::class . ':view')->add(PermissionMiddleware::class)->setName('jdhbrandingview-jdh_branding-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/jdhbrandingedit[/{id}]', JdhBrandingController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdhbrandingedit-jdh_branding-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/jdhbrandingdelete[/{id}]', JdhBrandingController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdhbrandingdelete-jdh_branding-delete'); // delete
    $app->group(
        '/jdh_branding',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{id}]', JdhBrandingController::class . ':list')->add(PermissionMiddleware::class)->setName('jdh_branding/list-jdh_branding-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{id}]', JdhBrandingController::class . ':add')->add(PermissionMiddleware::class)->setName('jdh_branding/add-jdh_branding-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{id}]', JdhBrandingController::class . ':view')->add(PermissionMiddleware::class)->setName('jdh_branding/view-jdh_branding-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{id}]', JdhBrandingController::class . ':edit')->add(PermissionMiddleware::class)->setName('jdh_branding/edit-jdh_branding-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{id}]', JdhBrandingController::class . ':delete')->add(PermissionMiddleware::class)->setName('jdh_branding/delete-jdh_branding-delete-2'); // delete
        }
    );

    // jdh_patients_insuarance
    $app->map(["GET","POST","OPTIONS"], '/jdhpatientsinsuarancelist[/{patient_id}]', JdhPatientsInsuaranceController::class . ':list')->add(PermissionMiddleware::class)->setName('jdhpatientsinsuarancelist-jdh_patients_insuarance-list'); // list
    $app->group(
        '/jdh_patients_insuarance',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{patient_id}]', JdhPatientsInsuaranceController::class . ':list')->add(PermissionMiddleware::class)->setName('jdh_patients_insuarance/list-jdh_patients_insuarance-list-2'); // list
        }
    );

    // subscriptions
    $app->map(["GET","POST","OPTIONS"], '/subscriptionslist[/{Id}]', SubscriptionsController::class . ':list')->add(PermissionMiddleware::class)->setName('subscriptionslist-subscriptions-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/subscriptionsadd[/{Id}]', SubscriptionsController::class . ':add')->add(PermissionMiddleware::class)->setName('subscriptionsadd-subscriptions-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/subscriptionsview[/{Id}]', SubscriptionsController::class . ':view')->add(PermissionMiddleware::class)->setName('subscriptionsview-subscriptions-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/subscriptionsedit[/{Id}]', SubscriptionsController::class . ':edit')->add(PermissionMiddleware::class)->setName('subscriptionsedit-subscriptions-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/subscriptionsdelete[/{Id}]', SubscriptionsController::class . ':delete')->add(PermissionMiddleware::class)->setName('subscriptionsdelete-subscriptions-delete'); // delete
    $app->group(
        '/subscriptions',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{Id}]', SubscriptionsController::class . ':list')->add(PermissionMiddleware::class)->setName('subscriptions/list-subscriptions-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{Id}]', SubscriptionsController::class . ':add')->add(PermissionMiddleware::class)->setName('subscriptions/add-subscriptions-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{Id}]', SubscriptionsController::class . ':view')->add(PermissionMiddleware::class)->setName('subscriptions/view-subscriptions-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{Id}]', SubscriptionsController::class . ':edit')->add(PermissionMiddleware::class)->setName('subscriptions/edit-subscriptions-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{Id}]', SubscriptionsController::class . ':delete')->add(PermissionMiddleware::class)->setName('subscriptions/delete-subscriptions-delete-2'); // delete
        }
    );

    // personal_data
    $app->map(["GET","POST","OPTIONS"], '/personaldata', OthersController::class . ':personaldata')->add(PermissionMiddleware::class)->setName('personaldata');

    // login
    $app->map(["GET","POST","OPTIONS"], '/login[/{provider}]', OthersController::class . ':login')->add(PermissionMiddleware::class)->setName('login');

    // reset_password
    $app->map(["GET","POST","OPTIONS"], '/resetpassword', OthersController::class . ':resetpassword')->add(PermissionMiddleware::class)->setName('resetpassword');

    // change_password
    $app->map(["GET","POST","OPTIONS"], '/changepassword', OthersController::class . ':changepassword')->add(PermissionMiddleware::class)->setName('changepassword');

    // logout
    $app->map(["GET","POST","OPTIONS"], '/logout', OthersController::class . ':logout')->add(PermissionMiddleware::class)->setName('logout');

    // captcha
    $app->map(["GET","OPTIONS"], '/captcha[/{page}]', OthersController::class . ':captcha')->add(PermissionMiddleware::class)->setName('captcha');

    // barcode
    $app->map(["GET","OPTIONS"], '/barcode', OthersController::class . ':barcode')->add(PermissionMiddleware::class)->setName('barcode');

    // Swagger
    $app->get('/' . Config("SWAGGER_ACTION"), OthersController::class . ':swagger')->setName(Config("SWAGGER_ACTION")); // Swagger

    // Index
    $app->get('/[index]', OthersController::class . ':index')->add(PermissionMiddleware::class)->setName('index');

    // Route Action event
    if (function_exists(PROJECT_NAMESPACE . "Route_Action")) {
        if (Route_Action($app) === false) {
            return;
        }
    }

    /**
     * Catch-all route to serve a 404 Not Found page if none of the routes match
     * NOTE: Make sure this route is defined last.
     */
    $app->map(
        ['GET', 'POST', 'PUT', 'DELETE', 'PATCH'],
        '/{routes:.+}',
        function ($request, $response, $params) {
            throw new HttpNotFoundException($request, str_replace("%p", $params["routes"], Container("language")->phrase("PageNotFound")));
        }
    );
};
