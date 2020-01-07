# Enum Support for PHP Classes

### Description (Short)
Say you have a predefined set of allowed values that you usually use in a system, 

first you want to keep them in one place, second have them accessible from any place, and third you want to validate using the predefined list.

I often observed how developers use something like `$_SERVER['REQUEST_METHOD] == 'get'` then elseif post elseif put and soooo on... then the list of ifs becomes equal to amount of values+1(default(often)).

Or you may have allowed actions for class say 'create', 'update', 'delete', etc.

This enum abstraction will allow you to encapsulate ALL available values in single class as class constant, use them system-wide without hard-coding values and VALIDATE using your predefined list of value.

#### What is ENUM support for PHP Classes?
Identical to database enum.

#### Which benefits does it posses ?
Allow you to utilize fixes values that you may use system wide, validate value or key using this list.

#### How does it works ?
Enum in our case works using constants defined in a class, which then pulled as array of key-value.

#### Which functionality is provided ?
We provide functionality `isValidValue($value)`, also `isValidKey($key)` in additional we have `getConstantNameByValue($value)`

#### Integration
No packaging, etc. Just copy the code, set up under necessary namespace and USE USE USE.

#### Examples
We will base on our ExampleEnum class provided in this repository for demonstration purpose.

Let's assume we received a request and we only allow get, post and put. We deny delete, options and others.

Our ExampleEnum have 3 defined constants which is REQUEST_GET, REQUEST_POST and REQUEST_PUT.

the usage will be as follows:

```php
$request_method = strtolower($_SERVER['REQUEST_METHOD']);
if( ExampleEnum::isValidValue($request_method) ) { 
    // Forward request to processing according to valid value ? 
}
```

Lets assume we have other scenario, when we have a value and we want to find the constant name to forward further so some other functionality can utilize it.
```php
$request_method = strtolower($_SERVER['REQUEST_METHOD']);
$const_name = ExampleEnum::getConstantNameByValue($value);
if( null !== $const_name ) {
    // send const name forward.
    // NOTE that getConstantNameByValue() performs isValidValue internally.
    // no taste to exec isValidValue() and then getConstantNameByValue()
    // just use getConstantNameByValue() and if it returns null - the value was invalid.
}
```

#### Feedback & Support
For anything you may need, feel free to pull request or send me a message.

#### Author
Valentin Ruskevych

https://github.com/xbugster
