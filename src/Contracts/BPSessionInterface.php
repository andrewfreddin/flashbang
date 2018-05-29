<?php
namespace Bytepath\Flashbang\Contracts;

interface BPSessionInterface
{
    public function flash($key, $value);
}