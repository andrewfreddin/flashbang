<?php
namespace Bytepath\FlashBang;

use \Illuminate\Session\SessionManager as LaravelSessionManager;
use Bytepath\FlashBang\Contracts\BPSessionInterface;

class BPSessionManager extends LaravelSessionManager implements BPSessionInterface
{
    public function flash($key, $value)
    {
        return $this->__call("flash", func_get_args());
    }
}