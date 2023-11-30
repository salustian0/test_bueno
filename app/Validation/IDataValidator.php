<?php

namespace App\Validation;

interface IDataValidator
{
    function getRules(int $id = null) : array;
    function getMessages() : array;
}
