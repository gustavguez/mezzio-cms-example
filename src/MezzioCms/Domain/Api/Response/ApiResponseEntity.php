<?php

declare(strict_types=1);

namespace Gustavguez\MezzioCms\Domain\Api\Response;

use JsonSerializable;

class ApiResponseEntity implements JsonSerializable {

    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function getData(){
        return $this->data;
    }

    public function jsonSerialize()
    {
        return [
            'data' => $this->data
        ];
    }
}