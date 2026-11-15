<?php
namespace ElegenceIO\Support;
use Dotenv\Dotenv;
use ElegenceIO\Support\Structure\Files;
use Exception;

class Env
{
    private array $env = [];
    private static ?object $instance = null;

    public  function __construct(string $basepath)
    {
        if(Files::has($basepath."/.env"))
        {
            $env = Dotenv::createImmutable($basepath);
            $this->env = $env->safeload();
        }
    }


    public function render(array ...$args):mixed
    {
        return $this;
    }


    public  function renderEnvVariable(string $key,mixed $default)
    {
        if(!isset($this->env[$key]) || empty($this->env[$key]))
        {
            return $default;
        }

        return $_ENV[$key];
    }

}