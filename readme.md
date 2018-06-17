# HelloSign Laravel

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]
[![StyleCI][ico-styleci]][link-styleci]

This package acts as a wrapper, for the HelloSign PHP SDK, to inject the relevant credentials and allow you to use the package in the container. Some examples of usage have been provided below.

See the [HelloSign PHP SDK](https://github.com/hellosign/hellosign-php-sdk) for full details.

Take a look at [contributing.md](contributing.md) to see a to do list.

## Installation

Via Composer

``` bash
$ composer require industrious/hellosign-laravel
```

## Usage

Publish the config, and add the relevant API authentication details to your `.env` file.
```bash
php artisan vendor:publish --tag=laravel-hellosign
```

## Examples

```php
/**
 * @param  HelloSignLaravel\Client $client
 */
public function client(Client $client)
{
    $client = $client->getAccount();
    
    ...
```

```php
/**
 * @param  HelloSignLaravel\Classes\SignatureRequest $signature_request
 */
public function sign(SignatureRequest $signature_request)
{
    $request = $signature_request
        ->setTitle('Title')
        ->setSubject('Subject')
        ->setMessage('Message')
        ->addSigner('email@address.com', 'Client name');

    $file = storage_path('app/file.pdf');

    $request->addFile($file);

    $response = $request->send();
    
    ...
```

```php
/**
 * @param  HelloSignLaravel\Classes\SignatureRequest $signature_request
 */
public function templateSign(TemplateSignatureRequest $signature_request)
{
    $request = $signature_request
        ->setTemplateId(config('hellosign.templates.contract'))
        ->setTitle('Title')
        ->setSubject('Subject')
        ->setMessage('Message')
        ->setSigner('Client', 'email@address.com', 'Test User');

    $request->setCustomFieldValue('Name', 'Test User');

    $response = $request->send();

    ...
```

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email christian@industrious.agency instead of using the issue tracker.

## Credits

- [Christian Thomas][link-author]
- [All Contributors][link-contributors]

## License

MIT. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/industrious/hellosignlaravel.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/industrious/hellosignlaravel.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/industrious/hellosignlaravel/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/137594301/shield

[link-packagist]: https://packagist.org/packages/industrious/hellosignlaravel
[link-downloads]: https://packagist.org/packages/industrious/hellosignlaravel
[link-travis]: https://travis-ci.org/industrious/hellosignlaravel
[link-styleci]: https://github.styleci.io/repos/137594301/shield
[link-author]: https://github.com/industrious
[link-contributors]: ../../contributors
