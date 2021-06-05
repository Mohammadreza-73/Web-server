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
Start server just like this:
```php
$ sudo php server 8000
```
And access it with your browser:
```php
http: localhost:8000/some-uri/?projcet=web-server
```
**Note:** You can use any port you want.