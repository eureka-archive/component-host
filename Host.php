<?php

/**
 * Copyright (c) 2010-2016 Romain Cottard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eureka\Component\Host;

/**
 * Host class.
 *
 * @author Romain Cottard
 * @version 2.1.0
 */
class Host
{

    /**
     * Current class instance.
     *
     * @var Host $instance
     */
    protected static $instance = null;

    /**
     * Config instance.
     *
     * @var \Eureka\Component\Config\Config $config
     */
    protected $config = null;

    /**
     * Namespace for config object.
     *
     * @var string $namespace
     */
    protected $namespace = '';

    /**
     * Base server uri.
     *
     * @var string $baseUri
     */
    protected $baseUri = '';

    /**
     * Host constructor.
     *
     * @return Host
     */
    protected function __construct()
    {
        $this->config = array();
    }

    /**
     * Singleton pattern method to get class instance
     *
     * @return Host
     */
    public function getInstance()
    {
        if (null === static::$instance) {
            $className = get_called_class();
            static::$instance = new $className();
        }

        return static::$instance;
    }

    /**
     * Get host data.
     *
     * @param    string $name
     * @return   mixed   Data information
     */
    public function get($name)
    {
        return $this->config->get($this->namespace . '.' . $name);
    }

    /**
     * Get uri
     *
     * @param    string $name
     * @param    string $baseUri
     * @return   string
     */
    public function uri($name, $baseUri = null)
    {

        if (empty($baseUri)) {
            $baseUri = $this->baseUri;
        }

        return $baseUri . $this->get($name);
    }

    /**
     * Set base uri
     *
     * @param  string $baseUri
     * @return Host
     */
    public function setBaseUri($baseUri)
    {
        $this->baseUri = $baseUri;

        return $this;
    }

    /**
     * Initialize host datas.
     *
     * @param    \Eureka\Component\Config\Config $config
     * @param   string $namespace Namespace for config
     * @return  Host
     */
    public function setConfig($config, $namespace = 'host')
    {
        $this->config    = $config;
        $this->namespace = $namespace;

        return $this;
    }

}