<?php
namespace App\Network\Session;

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Network\Session\DatabaseSession;

class ComboSession extends DatabaseSession
{
    public $cacheKey;

    public function __construct()
    {
        $this->cacheKey = Configure::read('Session.handler.cache');
        parent::__construct();
    }

    // Чтение данных сессии.
    public function read($id)
    {
        $result = Cache::read($id, $this->cacheKey);
        if ($result) {
            return $result;
        }
        return parent::read($id);
    }

    // Запись данных в сессию.
    public function write($id, $data)
    {
        Cache::write($id, $data, $this->cacheKey);
        return parent::write($id, $data);
    }

    // Уничтожение сессии.
    public function destroy($id)
    {
        Cache::delete($id, $this->cacheKey);
        return parent::destroy($id);
    }

    // Удаление истёкших сессий.
    public function gc($expires = null)
    {
        return Cache::gc($this->cacheKey) && parent::gc($expires);
    }
}