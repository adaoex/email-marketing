<?php

namespace EmailMarketing\Application\InputFilter\Validator;

use Zend\Validator\AbstractValidator;

class CPFValidator extends AbstractValidator
{

    const INVALID = 'cpfInvalido';

    protected $messageTemplates = array(
        self::INVALID => "O número de CPF '%value%' não é válido"
    );

    public function isValid($value)
    {
        $this->setValue($value);

        if (!$this->cpfValido($value)) {
            $this->error(self::INVALID);
            return false;
        }

        return true;
    }

    private function cpfValido($value)
    {
        $value_digits = preg_replace('/\D/', '', $value);
        $cpf = str_pad($value_digits, 11, '0', STR_PAD_LEFT);

        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        $soma = 0;
        for ($i = 0; $i < 9; $i ++) {
            $soma += (int) (substr($cpf, $i, 1)) * (10 - $i);
        }

        $resto = 11 - ($soma % 11);
        if ($resto == 10 || $resto == 11) {
            $resto = 0;
        }
        if ($resto != (int) (substr($cpf, 9, 1))) {
            return false;
        }

        $soma = 0;
        for ($i = 0; $i < 10; $i ++) {
            $soma += (int) (substr($cpf, $i, 1)) * (11 - $i);
        }

        $resto = 11 - ($soma % 11);
        if ($resto == 10 || $resto == 11) {
            $resto = 0;
        }
        if ($resto != (int) (substr($cpf, 10, 1))) {
            return false;
        }

        return true;
    }

}
