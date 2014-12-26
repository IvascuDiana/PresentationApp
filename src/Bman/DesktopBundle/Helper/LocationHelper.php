<?php
namespace Bman\DesktopBundle\Helper;

use Symfony\Component\Security\Acl\Exception\Exception;

class LocationHelper {

    private $stringHelper;

    public function __construct(StringHelper $stringHelper) {
        $this->stringHelper = $stringHelper;
    }

    public function getLocationByIp($ip) {

        try {
            $payload = file_get_contents('http://ip-api.com/' . $ip);
        } catch(Exception $e) {
            return "en";
        }

        $country = $this->stringHelper->get_string_between($payload, '<th>Country code:</th><td><span>', '</span>');
        $locale_country = strtolower($country);

        return $locale_country;
    }
} 