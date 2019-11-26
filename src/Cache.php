<?php

namespace fize\cache;

/**
 * 缓存类
 */
class Cache
{
    /**
     * @var CacheHandler
     */
    private static $handler;

    /**
     * 常规调用请请初始化
     * @param string $handler 使用的实际接口名称
     * @param array $config 配置项
     */
    public function __construct($handler, array $config = [])
    {
        self::$handler = self::getInstance($handler, $config);
    }

    /**
     * 获取一个缓存
     * @param string $name 缓存名
     * @param mixed $default 默认值
     * @return mixed
     */
    public static function get($name, $default = null)
    {
        return self::$handler->get($name, $default);
    }

    /**
     * 查看指定缓存是否存在
     * @param string $name 缓存名
     * @return bool
     */
    public static function has($name)
    {
        return self::$handler->has($name);
    }

    /**
     * 设置一个缓存
     * @param string $name 缓存名
     * @param mixed $value 缓存值
     * @param int $expire 有效时间，以秒为单位,0表示永久有效
     */
    public static function set($name, $value, $expire = null)
    {
        self::$handler->set($name, $value, $expire);
    }

    /**
     * 删除一个缓存
     * @param string $name 缓存名
     */
    public static function remove($name)
    {
        self::$handler->remove($name);
    }

    /**
     * 清空缓存
     */
    public static function clear()
    {
        self::$handler->clear();
    }

    /**
     * 取得实例
     * @param string $handler 使用的实际接口名称
     * @param array $config 配置项
     * @return CacheHandler
     */
    public static function getInstance($handler, array $config = [])
    {
        $class = '\\' . __NAMESPACE__ . '\\handler\\' . $handler;
        return new $class($config);
    }
}
