<?php

namespace App\Controllers;

class Controller
{
    public function response($data = [], $status = 400)
    {
        if (empty($data)) {
            if ($status == 200) {
                $data['message'] = 'Success!';
            } else if ($status == 201) {
                $data['message'] = 'Data saved successfully!';
            } else if ($status == 400) {
                $data['message'] = 'Validation error!';
            } else if ($status == 403) {
                $data['message'] = 'Not matched!';
            }
        }
        http_response_code($status);
        echo json_encode($data);
    }

    public function now()
    {
        return date("Y-m-d H:i:s");
    }
}