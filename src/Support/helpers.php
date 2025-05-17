<?php

use AncientEgyptianMuseum\View\View;
use AncientEgyptianMuseum\Application;
use AncientEgyptianMuseum\Http\Request;
use AncientEgyptianMuseum\Support\Hash;
use AncientEgyptianMuseum\Http\Response;
use AncientEgyptianMuseum\Validation\Validator;
use Exception;

if (!function_exists('env')) {
    
    function env($key, $default = null)
    {
        if (isset($_ENV[$key])) {
            $value = $_ENV[$key];

            switch (strtolower($value)) {
                case 'true':
                case '(true)':
                    return true;
                case 'false':
                case '(false)':
                    return false;
                case 'null':
                case '(null)':
                    return null;
                case 'empty':
                case '(empty)':
                    return '';
            }

            return $value;
        }

        return $default;
    }
}

if (!function_exists('base_path')) {
   
    function base_path($path = '')
    {
        return dirname(__DIR__, 2) . ($path ? DIRECTORY_SEPARATOR . ltrim($path, DIRECTORY_SEPARATOR) : '');
    }
}

if (!function_exists('class_basename')) {
    
    function class_basename($class)
    {
        $class = is_object($class) ? get_class($class) : $class;

        return basename(str_replace('\\', '/', $class));
    }
}

if (!function_exists('db')) {
    
    function db()
    {
        return app()->db;
    }
}

if (!function_exists('view_path')) {
    
    function view_path($path = '')
    {
        return base_path('views' . ($path ? DIRECTORY_SEPARATOR . ltrim($path, DIRECTORY_SEPARATOR) : ''));
    }
}

if (!function_exists('config')) {
    
    function config($key = null, $default = null)
    {
        $config = app()->config;

        if (is_null($key)) {
            return $config;
        }

        if (is_array($key)) {
            return $config->set($key);
        }

        return $config->get($key, $default);
    }
}

if (!function_exists('config_path')) {
   
    function config_path($path = '')
    {
        return base_path('config' . ($path ? DIRECTORY_SEPARATOR . ltrim($path, DIRECTORY_SEPARATOR) : ''));
    }
}

if (!function_exists('value')) {
   
    function value($value, ...$args)
    {
        return $value instanceof Closure ? $value(...$args) : $value;
    }
}

if (!function_exists('public_path')) {
   
    function public_path($path = '')
    {
        return base_path('public' . ($path ? DIRECTORY_SEPARATOR . ltrim($path, DIRECTORY_SEPARATOR) : ''));
    }
}

if (!function_exists('view')) {
    
    function view($view, $params = [])
    {
        $viewContent = View::make($view, $params);

        if (headers_sent()) {
            echo $viewContent;
            return null;
        }

        return $viewContent;
    }
}

if (!function_exists('back')) {
    
    function back($status = 302)
    {
        return app()->response->back($status);
    }
}

if (!function_exists('app')) {
    
    function app($property = null)
    {
        static $instance = null;

        if (!$instance) {
            $instance = new Application();
        }

        if ($property !== null) {
            return $instance->$property ?? null;
        }

        return $instance;
    }
}

if (!function_exists('request')) {
   
    function request($key = null, $default = null)
    {
        $request = app()->request;

        if ($key === null) {
            return $request;
        }

        if (is_string($key)) {
            return $request->get($key, $default);
        }

        if (is_array($key)) {
            return $request->only($key);
        }

        return $request;
    }
}

if (!function_exists('validator')) {
  
    function validator(array $data = [], array $rules = [])
    {
        $validator = new Validator();

        if (!empty($data) && !empty($rules)) {
            return $validator->make($data, $rules);
        }

        return $validator;
    }
}

if (!function_exists('bcrypt')) {
    
    function bcrypt($data, array $options = [])
    {
        return Hash::make($data, $options);
    }
}

if (!function_exists('database_path')) {
   
    function database_path($path = '')
    {
        return base_path('database' . ($path ? DIRECTORY_SEPARATOR . ltrim($path, DIRECTORY_SEPARATOR) : ''));
    }
}

if (!function_exists('old')) {
   
    function old($key, $default = null)
    {
        $flashData = app()->session->hasFlash('old') ? app()->session->getFlash('old') : [];
        return $flashData[$key] ?? $default;
    }
}

if (!function_exists('asset')) {
    
    function asset($path)
    {
        $path = ltrim($path, '/');
        $basePath = rtrim(config('app.url', ''), '/');

        return "{$basePath}/{$path}";
    }
}

if (!function_exists('redirect')) {
    
    function redirect($url, $status = 302)
    {
        return app()->response->redirect($url, $status);
    }
}

if (!function_exists('session')) {
    
    function session($key = null, $default = null)
    {
        $session = app()->session;

        if (is_null($key)) {
            return $session;
        }

        if (is_array($key)) {
            foreach ($key as $k => $v) {
                $session->set($k, $v);
            }
            return true;
        }

        return $session->get($key, $default);
    }
}

if (!function_exists('storage_path')) {
    
    function storage_path($path = '')
    {
        return base_path('storage' . ($path ? DIRECTORY_SEPARATOR . ltrim($path, DIRECTORY_SEPARATOR) : ''));
    }
}

if (!function_exists('csrf_token')) {
    
    function csrf_token()
    {
        $token = app()->session->get('_token');

        if (!$token) {
            $token = bin2hex(random_bytes(32));
            app()->session->set('_token', $token);
        }

        return $token;
    }
}

if (!function_exists('csrf_field')) {
    
    function csrf_field()
    {
        return '<input type="hidden" name="_token" value="' . csrf_token() . '">';
    }
}

if (!function_exists('method_field')) {
    
    function method_field($method)
    {
        return '<input type="hidden" name="_method" value="' . $method . '">';
    }
}

if (!function_exists('url')) {
    
    function url($path = '')
    {
        $path = ltrim($path, '/');
        $basePath = rtrim(config('app.url', ''), '/');

        return $path ? "{$basePath}/{$path}" : $basePath;
    }
}

if (!function_exists('dd')) {
    
    function dd(...$vars)
    {
        foreach ($vars as $var) {
            echo '<pre>';
            var_dump($var);
            echo '</pre>';
        }

        exit(1);
    }
}

if (!function_exists('abort')) {
   
    function abort($code, $message = '')
    {
        app()->response->setStatusCode($code);

        if ($message) {
            echo $message;
        }

        exit(1);
    }
}

if (!function_exists('now')) {
    
    function now()
    {
        return new \DateTime();
    }
}

if (!function_exists('collect')) {
    
    function collect($items = [])
    {
        return (array) $items;
    }
}

if (!function_exists('route')) {
   
    function route($name, $parameters = [])
    {
        return app()->route->getUrlFromName($name, $parameters);
    }
}

if (!function_exists('cache')) {
   
    function cache($key = null, $default = null, $ttl = 3600)
    {
        static $cacheInstance = null;

        if ($cacheInstance === null) {
            
            $cacheProperty = 'cache';

            if (property_exists(app(), $cacheProperty)) {
                $cacheInstance = app()->$cacheProperty;
            } else {
              
                $cacheInstance = new class {
                    private $store = [];
                    private $expiration = [];

                    public function get($key, $default = null)
                    {
                        if (!isset($this->store[$key])) {
                            return $default;
                        }

                        if (isset($this->expiration[$key]) && $this->expiration[$key] < time()) {
                            $this->forget($key);
                            return $default;
                        }

                        return $this->store[$key];
                    }

                    public function set($key, $value, $ttl = null)
                    {
                        $this->store[$key] = $value;

                        if ($ttl !== null) {
                            $this->expiration[$key] = time() + $ttl;
                        }

                        return true;
                    }

                    public function has($key)
                    {
                        if (!isset($this->store[$key])) {
                            return false;
                        }

                        if (isset($this->expiration[$key]) && $this->expiration[$key] < time()) {
                            $this->forget($key);
                            return false;
                        }

                        return true;
                    }

                    public function forget($key)
                    {
                        unset($this->store[$key]);
                        unset($this->expiration[$key]);
                        return true;
                    }

                    public function flush()
                    {
                        $this->store = [];
                        $this->expiration = [];
                        return true;
                    }
                };
            }
        }

        if (is_null($key)) {
            return $cacheInstance;
        }

        if (is_array($key)) {
            foreach ($key as $k => $v) {
                $cacheInstance->set($k, $v, $ttl);
            }
            return true;
        }

        return $cacheInstance->get($key, $default);
    }
}
