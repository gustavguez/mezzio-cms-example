<?php

namespace Gustavguez\MezzioCms\Domain\Render\Entity;

class RenderBlockEntity {

    protected $key;
    protected $renderer;
    protected $params;

    public function getKey() {
        return $this->key;
    }

    public function getRenderer() {
        return $this->renderer;
    }

    public function getParams() {
        return $this->params ? $this->params : [];
    }

    public function setKey($key) {
        $this->key = $key;
    }

    public function setRender($renderer) {
        $this->renderer = $renderer;
    }

    public function setParams($params) {
        $this->params = $params;
	}
	
	public function fromJSON($json){
		$this->key = isset($json['key']) ? $json['key'] : null;
		$this->renderer = isset($json['renderer']) ? $json['renderer'] : null;
		$this->params = isset($json['params']) ? $json['params'] : null;
	}

	public function __construct($json = null) {
		if(!empty($json)){
			$this->fromJSON($json);
		}
	}
	
}
