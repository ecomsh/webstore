<?php

namespace common\helpers\hongbao;

class  SDKRuntimeException extends Exception {
	public function errorMessage()
	{
		return $this->getMessage();
	}

}