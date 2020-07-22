<?php

namespace Gustavguez\MezzioCms\Domain\Render\Entity;

class RenderBlockParamEntity {

	const TEMPLATE_VALUE_CHAR = ':';

    protected $key;
    protected $value;

    public function getKey() {
        return $this->key;
    }

    public function getValue() {
        return $this->value;
    }

    public function setKey($key) {
        $this->key = $key;
    }

    public function setValue($value) {
        $this->value = $value;
    }
	
	public function fromJSON($json){
		$this->key = isset($json['key']) ? $json['key'] : null;
		$this->value = isset($json['value']) ? $json['value'] : null;
	}

	public function __construct($json = null) {
		if(!empty($json)){
			$this->fromJSON($json);
		}
	}

	public function isTemplateValue(): bool {
		return strpos($this->value, self::TEMPLATE_VALUE_CHAR) !== false;
	}

	public function getTemplateName(): string {
		return str_replace(self::TEMPLATE_VALUE_CHAR, '', $this->value);
	}
	
}
