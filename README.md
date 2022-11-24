## Test program to upload a file to Box.
### Settings and run program.
- run `composer install`
- copy `./config/box.php.sample` to `./config/box.php`
- make sure your app has a scope to `Write all files and folders stored in Box`.
    - If not, make the scope checked and save the app configuration.
- copy access token to clip board from the app's configuration screen.
- edit `./config/box.php` with copied access token.
- run `php test.php` to copy `./data/test.txt` to Box root folder.
### Relevant Blog article.

### Alternatively it's ok of bellow multipart block
```php
        'multipart' => [
            [
                'name' => 'attributes',
                'contents' => json_encode([
                    'name' => 'my_test.txt',
                    'parent' => ['id' => 0],
                ]),
            ],
            [
                'name' => 'file',
                'contents' => \GuzzleHttp\Psr7\Utils::tryFopen('./data/test.txt', 'rb'),
            ],
        ],
```

### I wrote a blog article about this repository.

[https://unknownspace.hatenablog.com/entry/box-api-upload-using-guzzlehttp](https://unknownspace.hatenablog.com/entry/box-api-upload-using-guzzlehttp)
