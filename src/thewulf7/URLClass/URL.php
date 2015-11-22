<?php
namespace thewulf7\URLClass;


/**
 * Class URL
 *
 * @package Thewulf7URLCLass
 */
class URL
{

    /**
     * Parsed url
     *
     * @var string
     */
    private $_url;

    /**
     * URL path
     *
     * @var string
     */
    private $_path;

    /**
     * URL host
     *
     * @var string
     */
    private $_host;

    /**
     * URL protocol
     * Default value = http
     *
     * @var string
     */
    private $_scheme = 'http';

    /**
     * URL port
     * Default value = 80
     *
     * @var int
     */
    private $_port = 80;

    /**
     * @var string
     */
    private $_user;

    /**
     * @var string
     */
    private $_pass;

    /**
     * @var string
     */
    private $_query;

    /**
     * @var string
     */
    private $_fragment;

    /**
     * Construct method of the class
     *
     * @param string $url URL to parse
     *
     * @throws \RuntimeException
     */
    public function __construct($url)
    {
        $this->_url = $url;
        $this->fromString();
    }

    /**
     * Echo the url
     *
     * @return string
     */
    public function __toString()
    {
        return $this->_url;
    }

    /**
     * Parse url
     *
     * @throws \RuntimeException
     */
    protected function fromString()
    {
        $urlArray = array_filter(parse_url($this->_url));

        if (count($urlArray) === 0)
        {
            throw new \RuntimeException('Wrong URL given');
        }

        if (!array_key_exists('host', $urlArray))
        {
            $urlArray['scheme'] = array_key_exists('HTTPS', $_SERVER) ? 'https' : 'http';
            $urlArray['port']   = array_key_exists('SERVER_PORT', $_SERVER) ? $_SERVER['SERVER_PORT'] : $this->_port;
            $urlArray['host']   = array_key_exists('HTTP_HOST', $_SERVER) ? $_SERVER['HTTP_HOST'] : null;
        }

        foreach ($urlArray as $key => $value)
        {
            $prop = '_' . $key;
            if (property_exists($this, $prop))
            {
                $this->$prop = $value;
            }
        }
    }

    /**
     * @return string
     */
    public function getFragment()
    {
        return $this->_fragment;
    }

    /**
     * @return string
     */
    public function getQuery()
    {
        return $this->_query;
    }

    /**
     * @return string
     */
    public function getPass()
    {
        return $this->_pass;
    }

    /**
     * @return string
     */
    public function getUser()
    {
        return $this->_user;
    }

    /**
     * @return int
     */
    public function getPort()
    {
        return $this->_port;
    }

    /**
     * @return string
     */
    public function getScheme()
    {
        return $this->_scheme;
    }

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->_host;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->_path;
    }
}