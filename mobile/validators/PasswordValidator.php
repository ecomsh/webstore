<?php

namespace mobile\validators;

use common\validators\PasswordBaseValidator;

class PasswordValidator extends PasswordBaseValidator
{
    public function __construct() {
        parent::__construct();
        $this->message = "密码由8-20位字母、数字和符号至少两种以上字符组成";
    }
}

?>