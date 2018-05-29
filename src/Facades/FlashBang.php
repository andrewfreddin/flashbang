<?php
namespace Bytepath\FlashBang\Facades;

use Bytepath\FlashBang\Flasher;
use Illuminate\Support\Facades\Facade;

class FlashBang extends Facade
{
    protected static function getFacadeAccessor() { return Flasher::class; }
}