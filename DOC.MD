# Becwork Utils Library
A utility library for handling cookies, JSON data, sessions, site information, and security in PHP. This documentation provides detailed information about the available classes and their methods.

## Installation
1. Use [Composer](http://getcomposer.org) to install becwork-utils:
```bash
composer require lukasbecvar/becwork-utils
```

## Table of Contents
- [Classes](#classes)
  - [CookieUtil](#cookieutil)
    - [setCookie](#setcookie)
    - [getCookie](#getcookie)
    - [deleteCookie](#deletecookie)
  - [FilesystemUtil](#filesystemutil)
     - [getFilesList](#getfileslist)
     - [isFileExecutable](#isfileexecutable)
     - [getFileContent](#getfilecontent)
  - [JsonUtil](#jsonutil)
    - [getJson](#getjson)
    - [fetchData](#fetchdata)
    - [decodeJson](#decodejson)
  - [SecurityUtil](#securityutil)
    - [escapeString](#escapestring)
    - [generateHash](#generatehash)
    - [verifyPassword](#verifypassword)
    - [encryptAes](#encryptaes)
    - [decryptAes](#decryptaes)
  - [ServerUtil](#serverutil)
    - [getServerName](#getservername)
    - [getServerSoftware](#getserversoftware)
    - [getHostUptime](#gethostuptime)
    - [getCpuUsage](#getcpuusage)
    - [getRamUsage](#getramusage)
    - [getRamUsagePercentage](#getramusagepercentage)
    - [getDiskUsage](#getdiskusage)
    - [getDriveUsagePercentage](#getdriveusagepercentage)
    - [getWebUsername](#getwebusername)
    - [isSystemLinux](#issystemlinux)
    - [isWebUserSudo](#iswebusersudo)
    - [getSystemInfo](#getsysteminfo)
    - [isServiceInstalled](#isserviceinstalled)
    - [getNotInstalledRequirements](#getnotinstalledsoftware)
    - [getProcessList](#getprocesslist)
    - [getDiagnosticData](#getdiagnosticdata)
  - [SessionUtil](#sessionutil)
    - [startSession](#startsession)
    - [destroySession](#destroysession)
    - [setSession](#setsession)
    - [getSession](#getsession)
    - [deleteSession](#deletesession)
  - [SiteUtil](#siteutil)
    - [getSiteUrl](#getsiteurl)
    - [getUri](#geturi)
    - [isSsl](#isssl)
  - [VisitorInfoUtil](#visitorinfoutil)
    - [getIP](#getip)
    - [getUserAgent](#getuseragent)
    - [getBrowserShortify](#getbrowsershortify)
    - [getOs](#getos)

## Classes

### CookieUtil
The `CookieUtil` class provides methods for working with cookies.

#### setCookie
- **Description**: Sets a cookie with the specified parameters.
- **Parameters**:
  - `name`: The name of the cookie.
  - `value`: The value of the cookie.
  - `expire`: The expiration time of the cookie in seconds (default: 0).
  - `path`: The path of the cookie (default: '/').
  - `domain`: The domain of the cookie.
  - `secure`: Whether the cookie is secure (default: false).
  - `httpOnly`: Whether the cookie is HTTP only (default: false).

#### getCookie
- **Description**: Retrieves the value of a cookie by its name.
- **Parameters**:
  - `name`: The name of the cookie.
- **Returns**: The value of the cookie or `null` if not found.

#### deleteCookie
- **Description**: Deletes a cookie by setting its expiration time to the past.
- **Parameters**:
  - `name`: The name of the cookie.

## FilesystemUtil
The `FilesystemUtil` class provides methods for working with the filesystem.

#### getFilesList
- **Description**: Returns a list of files and directories in the specified path.
- **Parameters**:
  - `path`: The path to list files and directories.
- **Returns**: An array of arrays containing information about the files and directories.

#### isFileExecutable
- **Description**: Checks if the file is executable.
- **Parameters**:
  - `path`: The path to the file.
- **Returns**: `true` if the file is executable, `false` otherwise.

#### getFileContent
- **Description**: Returns the contents of a file.
- **Parameters**:
  - `path`: The path to the file.
- **Returns**: The file content or `null` if the file does not exist.

### JsonUtil
The `JsonUtil` class provides functions for retrieving and decoding JSON data from a file or URL.

#### getJson
- **Description**: Retrieves JSON data from a file or URL.
- **Parameters**:
  - `target`: The file path or URL.
  - `method`: The HTTP method to use (default: 'GET').
  - `userAgent`: The user agent to use (default: 'becwork-utils').
  - `timeout`: The timeout in seconds (default: 5).
- **Returns**: The decoded JSON data.

#### fetchData
- **Description**: Fetches data from a file or URL.
- **Parameters**:
  - `target`: The file path or URL.
  - `context`: The request context.
- **Returns**: The data retrieved from the file or URL.

#### decodeJson
- **Description**: Decodes JSON data.
- **Parameters**:
  - `data`: The JSON data to decode.
  - `target`: The file path or URL.
- **Returns**: The decoded JSON data.

### SecurityUtil
The `SecurityUtil` class provides utility functions for handling security-related operations.

#### escapeString
- **Description**: Escapes a string for safe output.
- **Parameters**:
  - `string`: The string to escape.
- **Returns**: The escaped string.

#### generateHash
- **Description**: Generates a hash for a given password.
- **Parameters**:
  - `password`: The password to hash.
  - `options`: The options for password hashing (default: an empty array).
- **Returns**: The hashed password.

#### verifyPassword
- **Description**: Verifies a password against a given Argon2 hash.
- **Parameters**:
  - `password`: The password to verify.
  - `hash`: The hash to verify against.
- **Returns**: `true` if the password is valid, `false` otherwise.

#### encryptAes
- **Description**: Encrypts a string using AES encryption.
- **Parameters**:
  - `plainText`: The plain text to encrypt.
  - `key`: The key to use for encryption.
  - `method`: The encryption method (default: 'AES-128-CBC').
- **Returns**: The base64-encoded encrypted string.

#### decryptAes
- **Description**: Decrypts an AES-encrypted string.
- **Parameters**:
  - `encryptedData`: The base64-encoded encrypted string.
  - `key`: The key to use for decryption.
  - `method`: The encryption method (default: 'AES-128-CBC').
- **Returns**: The decrypted string or `null` on error.

### ServerUtil
The `ServerUtil` class provides methods for getting server information.

#### getServerName
- **Description**: Gets the server name.
- **Returns**: The server name.

#### getServerSoftware
- **Description**: Gets the server software.
- **Returns**: The server software.

#### getHostUptime
- **Description**: Gets the host uptime.
- **Returns**: The formatted host uptime.

#### getCpuUsage
- **Description**: Gets the CPU usage percentage.
- **Returns**: The CPU usage percentage.

#### getRamUsage
- **Description**: Gets the RAM usage information.
- **Returns**: An array containing RAM usage information.

#### getRamUsagePercentage
- **Description**: Gets the RAM usage percentage.
- **Returns**: The RAM usage percentage.

#### getDiskUsage
- **Description**: Gets the disk usage.
- **Returns**: The disk usage or `null` on error.

#### getDriveUsagePercentage
- **Description**: Gets the drive usage percentage.
- **Returns**: The drive usage percentage or `null` on error.

#### getWebUsername
- **Description**: Gets the web username.
- **Returns**: The web username or `null` on error.

#### isSystemLinux
- **Description**: Checks if the system is running Linux.
- **Returns**: `true` if the system is running Linux, `false` otherwise.

#### isWebUserSudo
- **Description**: Checks if the web user has sudo privileges.
- **Returns**: `true` if the web user has sudo privileges, `false` otherwise.

#### getSystemInfo
- **Description**: Gets information about installed software packages and the Linux distribution.
- **Returns**: An array containing information about installed software packages and the Linux distribution.

#### isServiceInstalled
- **Description**: Checks if a service is or is php extension installed.
- **Parameters**:
  - `serviceName`: The name of the service.
- **Returns**: `true` if the service is installed, `false` otherwise.

#### getNotInstalledRequirements
- **Description**: Gets a list of required applications that are not installed.
- **Parameters**:
  - `appList`: List of required applications.
- **Returns**: An array of applications that are not installed.

#### getProcessList
- **Description**: Gets a list of running processes.
- **Returns**: An array of running processes.

#### getDiagnosticData
- **Description**: Gets diagnostic data.
- **Returns**: An array containing diagnostic data.

### SessionUtil
The `SessionUtil` class provides methods for working with sessions.

#### startSession
- **Description**: Starts a session if it is not already started and headers are not sent.
- **Returns**: `void`.

#### destroySession
- **Description**: Destroys the current session and starts a new one.
- **Returns**: `void`.

#### setSession
- **Description**: Sets a session value.
- **Parameters**:
  - `name`: The name of the session.
  - `value`: The value of the session.
- **Returns**: `void`.

#### getSession
- **Description**: Retrieves a session value by its name.
- **Parameters**:
  - `name`: The name of the session.
- **Returns**: The value of the session or `null` if not found.

#### deleteSession
- **Description**: Deletes a session value.
- **Parameters**:
  - `name`: The name of the session.
- **Returns**: `void`.

### SiteUtil
The `SiteUtil` class provides functions for retrieving site URL and URI.

#### getSiteUrl
- **Description**: Gets the site URL.
- **Returns**: The site URL.

#### getUri
- **Description**: Gets the site URI.
- **Returns**: The site URI.

#### isSsl
- **Description**: Checks if the site is using HTTPS.
- **Returns**: `true` if the site is using HTTPS, `false` otherwise.

### VisitorInfoUtil
The `VisitorInfoUtil` class provides methods to get information about visitors.

#### getIP
- **Description**: Gets the client's IP address.
- **Returns**: The client's IP address or `null` if not found.

#### getUserAgent
- **Description**: Gets the user agent string of the client.
- **Returns**: The user agent string or 'Unknown' if not available.

#### getBrowserShortify
- **Description**: Gets a short version of the browser name based on the user agent string.
- **Parameters**:
  - `userAgent`: The user agent string.
- **Returns**: The short browser name.

#### getOs
- **Description**: Gets the operating system based on the user agent string.
- **Parameters**:
  - `userAgent`: The user agent string (default: 'self').
- **Returns**: The operating system or 'Unknown OS' if not identified.
