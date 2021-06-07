# Simple PHP Web Server
This is a simple project to understand how web servers work.
PHP is a scripting language that simply is not really designed for such tasks.

## Basics
### How does a webserver basically work?
1. The server listens for incoming connections.
2. A client connects to the server.
3. The server accepts the connection and handles the input.
4. The server responds to client.

## Usage
Install dependencies in your directory
```bash
composer install
```

Start server just like this:
```bash
$ sudo php server 8000
```
And access it with your browser:
```.http
http: localhost:8000/some-uri/?projcet=web-server
```
**Note:** You can use any port you want.

Output:
```code
WebServer\Request Object
(
    [method:WebServer\Request:private] => GET
    [uri:WebServer\Request:private] => /some-uri?project=web-server
    [headers:WebServer\Request:private] => Array
        (
            [Host] => localhost:8000
            [User-Agent] => Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:87.0) Gecko/20100102 Firefox/87.0
            [Accept] => text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8
            [Accept-Language] => en-US,en;q=0.5
            [Accept-Encoding] => gzip, deflate
            [Connection] => keep-alive
            [Upgrade-Insecure-Requests] => 1
        )

    [params:WebServer\Request:private] => Array
        (
            [project] => web-server
        )

    [buffer_max_size] => 4096
)
```