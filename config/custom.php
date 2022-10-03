<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Custom Application Config
    |--------------------------------------------------------------------------
    | This value are application fonctions actvation values .
    */
    'active_scan' => env('ACTIVE_SCAN', false),
    'active_op_cash' => env('ACTIVE_OP_CASH', false),
    'module_service' => env('MODULE_SERVICE', false),
    'module_stock' => env('MODULE_STOCK', true),
    'module_main_cash' => env('MODULE_MAIN_CASH', true),
    'module_intrant' => env('MODULE_INTRANT', true),
    'module_reservation' => env('MODULE_RESERVATION', false),
    'module_wallet' => env('MODULE_WALLET', false),
    'src_save' => env('SRC_SAVE', true),
    'active_enter_mgnt' => env('ACTIVE_ENTER_MGNT', false),
    'module_sales_force' => env('MODULE_SALES_FORCE', true),


];
