# Form Request Customizer

This is package provide custom form request for laravel's projects. It also includes form data sanitization and api form request extension

## Installation

You can install the package via composer:

```bash
composer require mawuekom/laravel-request-customizer
```

## Usage

You can using like this ... 
<br>
For sanitizer, check on [Laravel Request Sanitizer](https://github.com/mawuva/laravel-request-sanitizer) for more informations 

```php
namespace App\Http\Requests;

use Mawuekom\RequestCustomizer\FormRequestCustomizer;

class CreateUserRequest extends FormRequestCustomizer
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'          => 'required|string|max:255',
            'first_name'    => 'required|string|max:255',
            'email'         => 'required|string|email|max:255|unique:users',
            'password'      => 'required|string|min:6|confirmed',
        ];
    }

    /**
     * Get sanitizers defined for form input
     *
     * @return array
     */
    public function sanitizers(): array
    {
        return [
            'name' => [
                Capitalize::class,
            ],
            'first_name' => [
                CapitalizeEachWords::class
            ]
        ];
    }
}
```

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email seddorephraim7@gmail.com instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
