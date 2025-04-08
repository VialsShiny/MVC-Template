<?php

namespace App;

class Validator
{
    public function validate($data, $model)
    {
        if (!class_exists($model)) {
            http_response_code(500);
            include './src/views/errors/page500.php';
            exit();
        }

        $instance = new $model();
        foreach ($data as $key => $value) {
            $setter = 'set' . ucfirst(str_replace('_', '', ucwords($key, '_')));
            if (method_exists($instance, $setter)) {
                $instance->$setter($value);
            }
        }
        return $instance;
    }
}