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

    public function index()
    {
        $medicine = new Medicine();
        $medicines = $medicine->all();

        $this->response([
            'message' => 'Medicines retrieved successfully',
            'data' => $medicines
        ]);
    }

    public function response($data = [], $status = 200)
    {
        if ($status == 200) {
            $data['message'] = 'Success!';
        } else if ($status == 201) {
            $data['message'] = 'Data saved successfully!';
        } else if ($status == 400) {
            $data['message'] = 'Validation error!';
        }
        http_response_code($status);
        echo json_encode($data);
    }

    public function store()
    {
        $medicine = new Medicine();

        $medicine->save([
            'name' => $_POST['name'],
            'price' => $_POST['price'],
            'quantity' => $_POST['quantity']
        ]);

        $this->response([], 201);
    }

    public function destroy($id)
    {
        $medicine = new Medicine();

        $medicine->delete($id);

        $this->response([
            'message' => 'Successfully deleted!'
        ], 200);
    }
}