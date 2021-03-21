# Hi,

#### There is also a [readme page](index/index.html), there you can also find a link for [2nd](2ndChallenge/date-format.html) and [3rd](3rdChalenge/index.html) challenge. 

What i used in this 'project':
- Composer;
- Php Unit;
 - Redis.

How to run tests:

    cd 1stChalenge
    composer install
    php -S localhost:8080 simpleFakeApi.php | composer run test


What will this test do?
- Create a "Cache" class instance;
- Test redis connection (Ping);
- Save a test json to redis;
- Retrieve test json from redis;
- Flush all redis keys;
- Retrieve test json again, expecting it is not found;


- Make a post request to fake api;
- Make a get request to fake api.

