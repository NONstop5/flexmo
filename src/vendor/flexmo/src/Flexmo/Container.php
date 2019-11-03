<?php


namespace Flexmo;


use App\Configs\AppConfig;
use Exception;
use Psr\Container\ContainerInterface;
use ReflectionClass;
use ReflectionException;

class Container implements ContainerInterface
{
    private $container = [];

    public function __construct(AppConfig $appConfig)
    {
        $this->set('appConfig', $appConfig->getAppConfig());
    }

    /**
     * Сохраняет значение в контейнер
     *
     * @param $containerKey
     * @param array $parameters
     */
    public function set($containerKey, $parameters = [])
    {
        if (empty($parameters)) {
            $parameters = $containerKey;
        }

        $this->container[$containerKey] = $parameters;
    }

    /**
     * Finds an entry of the container by its identifier and returns it.
     *
     * @param string $containerKey Identifier of the entry to look for.
     * @param array $parameters
     * @return mixed Entry.
     * @throws Exception
     */
    public function get($containerKey, array $parameters = [])
    {
        if (!isset($this->container[$containerKey])) {
            $this->set($containerKey, $parameters);
        }

        return class_exists($containerKey) ?
            $this->getInstance($this->container[$containerKey]) :
            $this->container[$containerKey];
    }

    /**
     * Returns true if the container can return an entry for the given identifier.
     * Returns false otherwise.
     * `has($id)` returning true does not mean that `get($id)` will not throw an exception.
     * It does however mean that `get($id)` will not throw a `NotFoundExceptionInterface`.
     *
     * @param string $className Identifier of the entry to look for.
     * @return bool
     */
    public function has($className)
    {
        return array_key_exists($className, $this->container);
    }

    /**
     * Возвращает экземпляр переданного класса
     *
     * @param $className
     * @return object
     * @throws ReflectionException*@throws Exception
     * @throws Exception
     */
    private function getInstance($className)
    {
        $reflector = new ReflectionClass($className);

        if (!$reflector->isInstantiable()) {
            throw new Exception("Класс {$className} не может создавать экземпляры!");
        }

        $constructMethod = $reflector->getConstructor();

        if (is_null($constructMethod)) {
            return $reflector->newInstance();
        }

        $constructParams = $constructMethod->getParameters();
        $classDependencies = $this->getAllDependencies($constructParams);

        return $reflector->newInstanceArgs($classDependencies);
    }

    /**
     * Возвращает все зависимости конструктора
     *
     * @param $constructParams
     * @return array
     * @throws Exception
     */
    private function getAllDependencies($constructParams)
    {
        $dependencies = [];
        foreach ($constructParams as $parameter) {
            $dependency = $parameter->getClass();
            if ($dependency === null) {
                if ($parameter->isDefaultValueAvailable()) {
                    $dependencies[] = $parameter->getDefaultValue();
                } else {
                    throw new Exception("Не удалось разрешить зависимость класса: {$parameter->name}");
                }
            } else {
                $dependencies[] = $this->get($dependency->name);
            }
        }
        return $dependencies;
    }
}
