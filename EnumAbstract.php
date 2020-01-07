<?php

/**
 * Class EnumAbstract
 * This class provides capabilities of using constants defined in child class as ENUM
 * The benefit is the class have fixed values which could be reused system-wide
 *      and may validate arrived values using same fixed constants by enum support.
 *
 * @example
 *      Previously you've done `if $parameter === const1 {...}`, `if $parameters === const {...}`, `if $parameter === const3 {...}`
 *      Now you could `if ClassWithConstants::isValidValue($parameter) {...}`
 *
 * *** NOTE: CHILD CLASS MUST HAVE CONSTANTS DEFINED !
 *
 * @author Valentin Ruskevych https://github.com/xbugster
 */
abstract class EnumAbstract
{
    /**
     * Find constant key by provided value
     * *** Utilizes isValidValue() internally, so no taste to use isValidValue() before calling this method.
     *      if NULL is returned, this means the provided value was apparently invalid.
     *
     * *** BEWARE, MAY CAUSE ISSUES WHEN USING MULTIPLE IDENTICAL(NON-UNIQUE) VALUES.
     *
     * @param $value
     * @return mixed|null
     */
    public static function getConstantNameByValue($value)
    {
        if(true === static::isValidValue($value)) {
            return static::getReversedConstants()[$value];
        }
        return null;
    }

    /**
     * Validates provided value against VALUES of defined constants
     * @param $value
     * @return bool
     */
    public static function isValidValue($value)
    {
        return false !== isset(self::getReversedConstants()[$value]);
    }

    /**
     * Validates provided value against NAMES of defined constants
     * @param $key
     * @return bool
     */
    public static function isValidKey($key)
    {
        return false !== isset(self::getConstants()[$key]);
    }

    /**
     * Get the list of constants defined in child class
     * @return array
     */
    protected static function getConstants()
    {
        try{
            return (new ReflectionClass(get_called_class()))->getConstants();
        } catch(ReflectionException $e) {
            return [];
        }
    }

    /**
     * Gets flipped list of constants
     * @return array|null
     */
    protected static function getReversedConstants()
    {
        return array_flip(self::getConstants());
    }
}
