<?php

namespace App\Controllers;

use App\Models\Medicine;

class MedicineController
{
    private static $instance;

    static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function response($data)
    {
        echo json_encode($data);
    }

    public function index()
    {
        $medicine = new Medicine();
        $medicines = $medicine->all();

        $this->response([
            'message' => 'Medicines retrieved successfully',
            'data' => $medicines
        ]);
    }
}