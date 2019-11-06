<?php

namespace fize\cache;

/**
 * 缓存类
 * @package fize\cache
 */
class Cache
{
    /**
     * @var CacheHandler
     */
    private static $handler;

    /**
     * 取得单例
     * @param string $driver 使用的实际接口名称
     * @param array $config 配置项
     * @return CacheHandler
     */
    public static function getInstance($driver, array $config = [])
    {
        if (empty(self::$handler)) {
            self::$handler = self::getNew($driver, $config);
        }
        return self::$handler;
    }

    /**
     * 新建实例
     * @param string $driver 使用的实际接口名称
     * @param array $config 配置项
     * @return CacheHandler
     */
    public static function getNew($driver, array $config = [])
    {
        $class = '\\' . __NAMESPACE__ . '\\handler\\' . $driver;
        return new $class($config);
    }
}
