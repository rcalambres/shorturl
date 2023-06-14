_EJECUCIÓN_

**Get short URL from cURL**
curl -X POST 'http://localhost:8000/api/v1/short-urls' -d '{"url": "http://pepito.floro"}' -H "Authorization: Bearer {TOKEN}}"

**Get http code response from cURL**
curl --silent --output /dev/null --write-out "%{http_code}" -X POST 'http://localhost:8000/api/v1/short-urls' -d '{"url": "http://pepito.floro"}' -H "Authorization: Bearer {TOKEN}"

_TESTING_

php bin/phpunit
