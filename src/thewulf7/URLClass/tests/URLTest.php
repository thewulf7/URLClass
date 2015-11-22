<?php
namespace thewulf7\URLClass\tests;


use thewulf7\URLClass\URL;

/**
 * Class URLTest
 *
 * @package thewulf7\URLClass\tests
 */
class URLTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Data provider
     *
     * @return array
     */
    public function getUrls()
    {
        return [
            [
                'http://www.gfk.com',
                'www.gfk.com',
                'http',
                null,
                null,
                null,
                80,
                null,
                null,
            ],
            [
                'https://apple.com:8081/iphone?model=7&year=2015#view',
                'apple.com',
                'https',
                '/iphone',
                'model=7&year=2015',
                'view',
                8081,
                null,
                null,
            ],
            [
                '/mydocument/openpage',
                null,
                'http',
                '/mydocument/openpage',
                null,
                null,
                80,
                null,
                null,
            ],
            [
                '/index.php/default/index?action=create#create',
                null,
                'http',
                '/index.php/default/index',
                'action=create',
                'create',
                80,
                null,
                null,
            ],
            [
                'https://user:passwd@localhost:8080/index.php/admin?auth=true#login',
                'localhost',
                'https',
                '/index.php/admin',
                'auth=true',
                'login',
                8080,
                'user',
                'passwd'
            ],
        ];
    }

    /**
     *  Should return url string when we try act with object as a string
     */
    public function testObjectAsString()
    {
        $url       = 'http://www.gfk.com/Industries/industrial-goods/Pages/default.aspx';
        $urlObject = new URL($url);

        self::assertEquals($url, (string)$urlObject);
    }


    /**
     * Should throws an exception on empty url
     *
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Wrong URL given
     */
    public function testExceptionOnEmptyURL()
    {
        $urlObject = new URL('');
    }

    /**
     * @dataProvider getUrls
     *
     * @param $url
     * @param $host
     *
     * @internal     param $urlArray
     */
    public function testGetHost($url, $host)
    {
        $urlObject = new URL($url);
        self::assertEquals($host, $urlObject->getHost());
    }

    /**
     * @dataProvider getUrls
     *
     * @param $url
     * @param $host
     * @param $scheme
     */
    public function testGetScheme($url, $host, $scheme)
    {
        $urlObject = new URL($url);
        self::assertEquals($scheme, $urlObject->getScheme());
    }

    /**
     * @dataProvider getUrls
     *
     * @param $url
     * @param $host
     * @param $scheme
     * @param $path
     */
    public function testGetPath($url, $host, $scheme, $path)
    {
        $urlObject = new URL($url);
        self::assertEquals($path, $urlObject->getPath());
    }

    /**
     * @dataProvider getUrls
     *
     * @param $url
     * @param $host
     * @param $scheme
     * @param $path
     * @param $query
     */
    public function testGetQuery($url, $host, $scheme, $path, $query)
    {
        $urlObject = new URL($url);
        self::assertEquals($query, $urlObject->getQuery());
    }

    /**
     * @dataProvider getUrls
     *
     * @param $url
     * @param $host
     * @param $scheme
     * @param $path
     * @param $query
     * @param $fragment
     */
    public function testGetFragment($url, $host, $scheme, $path, $query, $fragment)
    {
        $urlObject = new URL($url);
        self::assertEquals($fragment, $urlObject->getFragment());
    }

    /**
     * @dataProvider getUrls
     *
     * @param $url
     * @param $host
     * @param $scheme
     * @param $path
     * @param $query
     * @param $fragment
     * @param $port
     */
    public function testGetPort($url, $host, $scheme, $path, $query, $fragment, $port)
    {
        $urlObject = new URL($url);
        self::assertEquals($port, $urlObject->getPort());
    }

    /**
     * @dataProvider getUrls
     *
     * @param $url
     * @param $host
     * @param $scheme
     * @param $path
     * @param $query
     * @param $fragment
     * @param $port
     * @param $user
     */
    public function testGetUser($url, $host, $scheme, $path, $query, $fragment, $port, $user)
    {
        $urlObject = new URL($url);
        self::assertEquals($user, $urlObject->getUser());
    }

    /**
     * @dataProvider getUrls
     *
     * @param $url
     * @param $host
     * @param $scheme
     * @param $path
     * @param $query
     * @param $fragment
     * @param $port
     * @param $user
     * @param $pass
     */
    public function testGetPass($url, $host, $scheme, $path, $query, $fragment, $port, $user, $pass)
    {
        $urlObject = new URL($url);
        self::assertEquals($pass, $urlObject->getPass());
    }
}
