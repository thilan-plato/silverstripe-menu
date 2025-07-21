<?php

namespace gorriecoe\Menu\Compat;

use SilverStripe\Core\ClassInfo;
use SilverStripe\Core\Config\Config;

/**
 * Version compatibility helper for Silverstripe 4 and 5
 */
class VersionCompat
{
    /**
     * Check if we're running Silverstripe 5
     * @return bool
     */
    public static function isSilverstripe5(): bool
    {
        return class_exists('SilverStripe\Core\Manifest\ModuleManifest') 
            && method_exists('SilverStripe\Core\Manifest\ModuleManifest', 'getProject');
    }

    /**
     * Check if we're running Silverstripe 4
     * @return bool
     */
    public static function isSilverstripe4(): bool
    {
        return !self::isSilverstripe5();
    }

    /**
     * Get the appropriate GraphQL schema class name
     * @return string
     */
    public static function getGraphQLSchemaClass(): string
    {
        if (self::isSilverstripe5()) {
            return 'SilverStripe\GraphQL\Schema\Schema';
        }
        return 'SilverStripe\GraphQL\Controller';
    }

    /**
     * Get the appropriate configuration method for the current version
     * @param string $class
     * @param string $property
     * @return mixed
     */
    public static function getConfig($class, $property)
    {
        return Config::inst()->get($class, $property);
    }
} 