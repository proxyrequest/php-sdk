# Аудит PHP SDK

## Статус исправлений — 2026-09-07

Все перечисленные ниже SDK-находки исправлены. Каноническая публичная схема
перегенерирована: **81 операция, 129 схем**. Все три SDK используют побайтово
одинаковую копию; SHA-256 и коммит источника закреплены в `openapi/source.json`.
Сгенерировано **79 поддерживаемых операций / 17 ресурсов**: две отключённые
sessions-management операции исключены по согласованному решению, без удаления
sticky-параметров генерации прокси и без изменения маршрутов бэкенда.

| Находка | Исправление |
| --- | --- |
| PHP-01 | Общий parser выбирает OTPChallenge для 202; добавлен verifyOtp, включая async. |
| PHP-02 | Актуализированы шлюзы и разрешены будущие gateway-значения. |
| PHP-03 | MFA DTO принимают password/credential и OTP; setup передаёт body. |
| PHP-04 | Обновлены поля платежей/orders; неизвестные DTO-поля сохраняются и сериализуются обратно. |
| PHP-05 | Унифицированы sync/async ошибки HTTP/JSON/сети с полным контекстом и фактическим idempotency key. |
| PHP-06 | Язык по умолчанию работает с обоими транспортами, per-request значение имеет приоритет. |
| PHP-07 | Исправлены nullable/omitted поля и InvoiceRead interface с Invoice/InvoiceShort. |
| PHP-08 | Синхронизация проверяет IDs и реальные counts, генерация воспроизводима без жёсткого числа операций. |
| BE-01 | Исправлены pk-сигнатуры invoice PDF/pay-link и coupon redeems; добавлены router-регрессии. |
| BE-02 | Удалены публичный sessions-ресурс, его методы и отдельные сгенерированные модели/документы из SDK. |

Проверки SDK: PHPUnit (26 тестов), PHPStan, PHP CS Fixer и `scripts/check-generated.sh`.
Фикстуры форм User/Invoice получены из реальных сериализаторов бэкенда на
синтетических объектах; серверный тест проверяет их соответствие текущему коду.
Тесты SDK проверяют MFA, платежи, вариативные ответы и регрессионные сценарии.
Это локальная проверка, не подтверждение развёртывания в production.

Версии пакетов не изменялись; релизы, теги и публикации пакетов не создавались.
Примеры миграции и MFA: `docs/backend-compatibility.md` внутри репозитория SDK.

## Исходный аудит (до исправлений)

Ссылки на SDK закреплены на исходном коммите. Пути и номера строк бэкенда
сохранены как исторические ориентиры: его исходное рабочее состояние содержало
незакоммиченные изменения.

Далее сохранён исторический отчёт. Его выводы, счётчики, матрица и номера строк
относятся к исходному состоянию и не являются описанием обновлённой SDK.


SDK: `proxyrequest/php-sdk` 1.0.0, каталог `php`, HEAD `456aef797b75f9f1aff6d51a727f0c86674942c2`.

**Вывод:** старые HTTP-операции покрыты, но текущие MFA и платёжные контракты несовместимы. Есть также самостоятельные ошибки реализации: async-ветка иначе обрабатывает сетевые/JSON-ошибки, а настройка языка ведёт себя по-разному со стандартным и внедрённым HTTP-клиентом.

## Границы и методика

Аудит выполнен 2026-09-07 по рабочим файлам. Бэкенд: `/home/yuri/Projects/papaproxy/api`, HEAD `f10464717b19f98916b45cc25e7405610865957d`, с существующими незакоммиченными изменениями. Выводы относятся к этому рабочему состоянию, а не только к коммиту и не к проверенному production-развёртыванию.

Проверены публичная OpenAPI-схема (`api/openapi.yml`), состав публичного schema URLConf (`api/apps/routing/infrastructure/django/schema.py:35`), router, существенные serializers/viewsets, сгенерированные операции, клиентский транспорт, пагинация, ошибки, подписи webhook и процесс синхронизации схемы. Внутренние/admin API и входящие callback-маршруты платёжных провайдеров не считаются обязательными методами клиентской SDK.

Сохранённый публичный контракт содержит **81 операцию и 127 схем**. Независимая генерация публичной схемы в тестовом окружении также дала 81 операцию и 127 схем. Отдельно проверены оба значения `SITE_PACKAGE_BASED_AUTH`: формы ответов действительно зависят от настройки. Различия числовых ограничений при генерации под SQLite не объявлялись дефектами production-контракта.

Во всех SDK сохранена одна и та же старая схема: **80 операций и 124 схемы**. Сопоставление HTTP-методов, шаблонов путей и публичных обёрток не выявило пропущенных операций из этой старой схемы. Единственная отсутствующая операция относительно текущего публичного списка — `POST /login/otp`. Это номинальное покрытие методов, а не оценка фактической совместимости.

SHA-256 схем:

- текущая API: `423fc57ebe9406a9a1a80ee7acfd8e0827f6196b317af90b0c24f64172e16b03`;
- сохранённая SDK: `0ed69e781aa752ac8e9c9b1974cd82810adbf1fd99a461724bd73432740d8737`.

Поиск выполнен через knowledge graph с проверкой покрытия и чтением исходников. Частично разобранные TypeScript re-export строки проверены непосредственно. Проигрывались синтетические ответы и локальные вызовы serializers/router; обращений к рабочему API, создания пользователей/счетов и изменений реализаций SDK/бэкенда не выполнялось.

Приоритеты: **P1** — блокирует основной сценарий при указанных условиях; **P2** — ограничивает часть API, искажает данные или ухудшает диагностику/сопровождение. Порядок внутри приоритета отражает рекомендуемую последовательность исправлений.


## Находки в SDK

### PHP-01 · P1 · Ответ OTP 202 превращается в «успешную» модель с пустыми токенами

`authorization()->login()` и `loginWithGoogle()` знают только старый успешный `TokenPairResponse`. При HTTP 202 sync-код попадает в fallback для любого 2xx и десериализует challenge как токены. Async-ветка также использует единственный `returnType`.

Воспроизведён результат для обоих вариантов:

```text
class: ProxyRequest\Dto\TokenPairResponse
token: null
refresh: null
valid(): false
```

При этом исключение не выбрасывается, а `challenge`, `status` и `expires_in` теряются при преобразовании в DTO. Нет метода для `POST /login/otp`, который должен обменять challenge и код на настоящие токены.

Источники: [login sync](https://github.com/proxyrequest/php-sdk/blob/456aef797b75f9f1aff6d51a727f0c86674942c2/src/Resource/AuthorizationResource.php#L192), [login async](https://github.com/proxyrequest/php-sdk/blob/456aef797b75f9f1aff6d51a727f0c86674942c2/src/Resource/AuthorizationResource.php#L315), [ObjectSerializer](https://github.com/proxyrequest/php-sdk/blob/456aef797b75f9f1aff6d51a727f0c86674942c2/src/ObjectSerializer.php#L514), серверный OTP endpoint (`api/apps/core/authentication/api.py:57`).

Исправление: добавить challenge/verify DTO и метод завершения входа; различать 200 и 202 в обеих ветках. Не превращать успешный ответ неизвестной формы в частично заполненный `TokenPairResponse`.

### PHP-02 · P1 · Новые шлюзы отвергаются до запроса и при чтении invoice

В `InvoiceCreateRequestGatewayEnum` только `crypto`, `wallet`, `manual`, `stripe`; response enum тоже содержит старый набор. `ObjectSerializer` проверяет значения enum и при отправке, и при десериализации.

Локально воспроизведены:

```text
InvoiceCreateRequest(gateway=whitepay) -> jsonSerialize():
InvalidArgumentException: Invalid value for enum ...InvoiceCreateRequestGatewayEnum...

GET invoice with gateway=whitepay:
InvalidArgumentException: Invalid value for enum ...InvoiceGatewayEnum...
```

Сеттер gateway сам допускает строку, но последующая сериализация её отклоняет. Параметр генератора `enumUnknownDefaultCase: true` создаёт константу `unknown_default_open_api`, однако не преобразует в неё произвольный `whitepay`: фактическая проверка остаётся строгой.

Сервер принимает новые провайдеры, включая `whitepay`, `wayforpay`, `monobank`, `liqpay`, и обобщённый `credit_card`. Это блокирует создание через DTO, получение счёта и список, содержащий счёт нового провайдера. Если ответ уже созданного счёта не разобран, приложение не получает его ID из результата; исключение не является нормализованным `ApiException`.

Источники: [сериализация enum](https://github.com/proxyrequest/php-sdk/blob/456aef797b75f9f1aff6d51a727f0c86674942c2/src/ObjectSerializer.php#L81), [десериализация enum](https://github.com/proxyrequest/php-sdk/blob/456aef797b75f9f1aff6d51a727f0c86674942c2/src/ObjectSerializer.php#L494), [Invoice gateway type](https://github.com/proxyrequest/php-sdk/blob/456aef797b75f9f1aff6d51a727f0c86674942c2/src/Dto/Invoice.php#L59), [generator config](https://github.com/proxyrequest/php-sdk/blob/456aef797b75f9f1aff6d51a727f0c86674942c2/openapi/generator.yaml#L13), серверные gateway choices (`api/apps/billing/api/serializers.py:139`).

Исправление: обновить enum и сделать чтение неизвестных gateway расширяемым, сохраняя исходное значение. Для запросов согласовать валидацию с текущим сервером. Один только флаг `enumUnknownDefaultCase` не решает проблему в существующем ObjectSerializer.

### PHP-03 · P1 · Нельзя выполнить актуальную настройку/отключение MFA обычными DTO

`profile()->setupTwoFactor()` принимает язык и content type, но не тело запроса. Вызов посылает пустой POST. Сервер требует первичный фактор: пароль либо Google credential; для замены активного аутентификатора также текущий код.

`TwoFactorDisableRequest` содержит только `code`; попытка передать дополнительные ключи в конструктор DTO не добавляет сериализуемых полей. Поэтому типичный старый вызов отключения с одним кодом сервер отвергнет при включённой MFA.

Источники: [setupTwoFactor](https://github.com/proxyrequest/php-sdk/blob/456aef797b75f9f1aff6d51a727f0c86674942c2/src/Resource/ProfileResource.php#L2102), [формирование setup request](https://github.com/proxyrequest/php-sdk/blob/456aef797b75f9f1aff6d51a727f0c86674942c2/src/Resource/ProfileResource.php#L2329), [disableTwoFactor](https://github.com/proxyrequest/php-sdk/blob/456aef797b75f9f1aff6d51a727f0c86674942c2/src/Resource/ProfileResource.php#L1121), [TwoFactorDisableRequest](https://github.com/proxyrequest/php-sdk/blob/456aef797b75f9f1aff6d51a727f0c86674942c2/src/Dto/TwoFactorDisableRequest.php#L59), первичный фактор на сервере (`api/apps/core/authentication/service.py:192`).

Исправление: добавить DTO setup, расширить disable DTO, передавать body и в sync, и в async. До обновления доступен `Client::raw()` с явным JSON; для setup это обход отсутствующего аргумента, а не существующий типизированный сценарий. После изменения MFA документировать отзыв предыдущих JWT.

### PHP-04 · P2 · Новые поля платежей и данные orders теряются при преобразовании в DTO

`ObjectSerializer` перебирает только `openAPITypes()`; неизвестные поля ответа не сохраняются. В отличие от Python additional properties и JS runtime objects, недокументированные в старой DTO данные после вызова ресурса восстановить нельзя.

Проблемные поля:

| Модель/направление | Что отсутствует |
| --- | --- |
| Invoice request | `payment_currency` |
| Invoice response | `currency`, `payment_amount`, `payment_currency`, `provider_checkout_id`, `provider_payment_id`, `checkout_status`, `fx_*` |
| Settings response | `payment_gateways` с поддерживаемыми валютами/типами провайдеров |
| User при package-based auth | `orders` |

Проверка `new InvoiceCreateRequest(['gateway'=>'wallet','amount'=>500,'paymentCurrency'=>'UAH'])` дала JSON **только** `{"gateway":"wallet","amount":500}`. В ответе Invoice отсутствует getter нового payment amount, а неизвестные данные отбрасываются.

Источники: [InvoiceCreateRequest constructor](https://github.com/proxyrequest/php-sdk/blob/456aef797b75f9f1aff6d51a727f0c86674942c2/src/Dto/InvoiceCreateRequest.php#L323), [Invoice types](https://github.com/proxyrequest/php-sdk/blob/456aef797b75f9f1aff6d51a727f0c86674942c2/src/Dto/Invoice.php#L59), [SettingsResponse](https://github.com/proxyrequest/php-sdk/blob/456aef797b75f9f1aff6d51a727f0c86674942c2/src/Dto/SettingsResponse.php#L59), [User types](https://github.com/proxyrequest/php-sdk/blob/456aef797b75f9f1aff6d51a727f0c86674942c2/src/Dto/User.php#L59), [десериализация известных полей](https://github.com/proxyrequest/php-sdk/blob/456aef797b75f9f1aff6d51a727f0c86674942c2/src/ObjectSerializer.php#L520), новые серверные поля (`api/apps/billing/api/serializers.py:28`), динамические поля User (`api/apps/core/api/serializers/users.py:269`).

Исправление: обновить DTO, поддержать сохранение дополнительных полей или доступ к исходному payload успешного ответа. `WithResponse` сейчас даёт DTO/status/headers, а не исходное JSON-тело, поэтому само по себе не восстанавливает потерянные поля.

### PHP-05 · P2 · Async теряет нормальную обработку сетевых ошибок и принимает некорректный JSON

В rejection callback generated async-методов без проверки вызывается `$exception->getResponse()`. У Guzzle `ConnectException` такого метода нет. Синтетический сбой соединения показал:

```text
sync:  ProxyRequest\ApiException: [0] synthetic connection failure
async: Error: Call to undefined method GuzzleHttp\Exception\ConnectException::getResponse()
```

При HTTP 200 с HTML вместо JSON async использует `json_decode()` без `JSON_THROW_ON_ERROR`; Promise успешно завершается с **null**. Тот же ответ sync-метод превращает в `ApiException`.

Для HTTP-ошибки async callback также не передаёт idempotency key в конструктор `ApiException`, хотя sync-ветка извлекает его из запроса. Это нарушает одинаковый контракт обработки ошибок в двух способах вызова.

Источники: [async success/rejection callbacks](https://github.com/proxyrequest/php-sdk/blob/456aef797b75f9f1aff6d51a727f0c86674942c2/src/Resource/AuthorizationResource.php#L315), [sync exception handling](https://github.com/proxyrequest/php-sdk/blob/456aef797b75f9f1aff6d51a727f0c86674942c2/src/Resource/AuthorizationResource.php#L192), [sync JSON validation](https://github.com/proxyrequest/php-sdk/blob/456aef797b75f9f1aff6d51a727f0c86674942c2/src/Resource/AuthorizationResource.php#L1734), [аналогичная ветка invoice](https://github.com/proxyrequest/php-sdk/blob/456aef797b75f9f1aff6d51a727f0c86674942c2/src/Resource/InvoicesResource.php#L356).

Исправление: вынести разбор и нормализацию ошибок в общий код/шаблон, различать отсутствие HTTP-ответа и HTTP-ошибку, проверять JSON одинаково и сохранять key/status/headers/body. Проверить async connect timeout, отказ DNS/соединения, HTML 200 и 409 с повторными попытками.

### PHP-06 · P2 · withLanguage и per-request Accept-Language работают противоречиво

Стандартный клиент устанавливает middleware, который **безусловно** заменяет `Accept-Language` на язык builder. Поэтому явный аргумент конкретного метода игнорируется:

```text
builder.withLanguage('uk') + login(..., 'de') -> фактически uk
```

При `withHttpClient()` этот middleware вообще не создаётся, а `Client::resource()` не передаёт язык в generated resource. Если конкретный метод вызван без language, builder-настройка теряется:

```text
builder.withLanguage('uk').withHttpClient(mock) + login(...) -> заголовок отсутствует
```

Оба случая проверены на записанных Guzzle requests.

Источники: [build/createDefaultHttpClient](https://github.com/proxyrequest/php-sdk/blob/456aef797b75f9f1aff6d51a727f0c86674942c2/src/ClientBuilder.php#L127), [создание ресурса](https://github.com/proxyrequest/php-sdk/blob/456aef797b75f9f1aff6d51a727f0c86674942c2/src/Client.php#L239), [аргумент языка login](https://github.com/proxyrequest/php-sdk/blob/456aef797b75f9f1aff6d51a727f0c86674942c2/src/Resource/AuthorizationResource.php#L163).

Исправление: определять приоритет как «явное значение метода → значение клиента», применять его одинаково к стандартному и внедрённому HTTP-клиенту. Добавить тесты этих двух случаев.

### PHP-07 · P2 · DTO описывают неверную nullable/конфигурационную форму Invoice/User

Сервер допускает `null` в `Invoice.package/country/coupon`, но DTO объявляет их non-nullable и сообщает в `listInvalidProperties()`, что они обязательны. Десериализатор через `isset()` пропускает такие поля: немедленного падения, как у Python, обычно нет, но возвращается объект, не соответствующий собственным ограничениям и PHPDoc.

Кроме этого, `SITE_PACKAGE_BASED_AUTH=False` выбирает короткий Invoice без части полей полной модели; при True User содержит `orders` вместо плоских данных и proxy password. Это подтверждено выбором сериализаторов под обоими флагами. Потеря orders описана в PHP-04.

Источники: [Invoice validation](https://github.com/proxyrequest/php-sdk/blob/456aef797b75f9f1aff6d51a727f0c86674942c2/src/Dto/Invoice.php#L477), [setCoupon](https://github.com/proxyrequest/php-sdk/blob/456aef797b75f9f1aff6d51a727f0c86674942c2/src/Dto/Invoice.php#L734), [пропуск null в serializer](https://github.com/proxyrequest/php-sdk/blob/456aef797b75f9f1aff6d51a727f0c86674942c2/src/ObjectSerializer.php#L527), InvoiceShortSerializer (`api/apps/billing/api/serializers.py:101`), выбор формы Invoice (`api/apps/billing/api/viewsets.py:121`), форма User (`api/apps/core/api/serializers/users.py:269`).

Исправление: описать nullable и варианты моделей в серверном контракте, затем регенерировать DTO. Не считать permissive-десериализацию доказательством корректного контракта.

### PHP-08 · P2 · Обновление OpenAPI блокируется жёсткими счётчиками

`scripts/sync-openapi.php` принимает только 80 операций и 124 схемы. Запуск на текущем backend-контракте завершился до записи:

```text
Unexpected contract size: 81 operations and 127 schemas.
```

[Контрактные тесты](https://github.com/proxyrequest/php-sdk/blob/456aef797b75f9f1aff6d51a727f0c86674942c2/tests/Contract/OpenApiCoverageTest.php#L37) проверяют покрытие собственной старой схемы, а не соответствие текущему бэкенду. PHP manifest по SHA-256 корректен относительно этой старой копии, но не означает её актуальность.

Источники: [sync script](https://github.com/proxyrequest/php-sdk/blob/456aef797b75f9f1aff6d51a727f0c86674942c2/scripts/sync-openapi.php#L46), [source manifest](https://github.com/proxyrequest/php-sdk/blob/456aef797b75f9f1aff6d51a727f0c86674942c2/openapi/source.json#L1).

Исправление: убрать фиксированные размеры как условие успешной синхронизации, сохранять проверку назначения публичной схемы, сравнивать семантический diff с выбранным backend snapshot. Изменения общего response handling внести в генератор/шаблоны, чтобы они не исчезли при следующей генерации.

## Проблемы бэкенда, влияющие на эту SDK

### BE-01 · P1 · Три публичных detail-маршрута падают при передаче `pk`

| HTTP-маршрут | Обработчик |
| --- | --- |
| `GET /invoices/{id}/download/pdf` | `InvoicesViewSet.download_pdf(self, request)` |
| `GET /invoices/{id}/pay` | `InvoicesViewSet.pay_link(self, request)` |
| `GET /coupons/{id}/redeems` | `CouponsViewSet.redeems(self, request)` |

DRF router передаёт идентификатор как `pk`, но обработчики не принимают ни `pk`, ни `**kwargs`. Через настоящий `django.urls.resolve()` и вызов соответствующего view воспроизведены:

```text
TypeError: InvoicesViewSet.download_pdf() got an unexpected keyword argument 'pk'
TypeError: InvoicesViewSet.pay_link() got an unexpected keyword argument 'pk'
TypeError: CouponsViewSet.redeems() got an unexpected keyword argument 'pk'
```

При проверке были заменены только `initial()` и обработка исключения, чтобы изолировать диспетчеризацию от авторизации и БД. Это подтверждённая ошибка вызова обработчика, а не результат запроса к развёрнутому серверу. SDK формируют правильные HTTP-методы и пути; исправление требуется на стороне API.

Источники: InvoicesViewSet (`api/apps/billing/api/viewsets.py:197`), CouponsViewSet.redeems (`api/apps/marketing/api/viewsets.py:444`), регистрация router (`api/apps/routing/infrastructure/django/public.py:95`).

Исправление: принимать `pk=None` или `*args, **kwargs`; добавить HTTP-тесты всех трёх detail-action через router. После этого повторить интеграционные проверки SDK для платёжной ссылки, PDF и погашений купона.

### BE-02 · P2 · Управление sessions отключено, хотя SDK обещает успешные ответы

Авторизованные `GET /sessions` и `DELETE /sessions/{id}` безусловно вызывают `_unavailable()` и возвращают 403 с причиной `errors.proxy.session_ownership_unavailable`. Актуальная схема уже не содержит успешного ответа для этих операций; сохранённая схема SDK всё ещё содержит старые `SessionListResponse` / `SessionDeleteResponse`.

Это ограничение текущего API, а не неправильный ключ пользователя. Следует отметить методы как временно недоступные/deprecated и обновить документацию. Возвращать возможность управления сессиями нужно только после реализации проверки владельца на сервере.

Источник: SessionViewSet (`api/apps/core/api/viewsets.py:1622`).


## Минимальное локальное воспроизведение OTP

Из текущего каталога; используется только MockHandler:

```bash
php <<'PHP'
<?php
require 'php/vendor/autoload.php';
$mock = new GuzzleHttp\Handler\MockHandler([
    new GuzzleHttp\Psr7\Response(
        202,
        ['Content-Type' => 'application/json'],
        '{"status":"otp_required","challenge":"audit","expires_in":300}'
    ),
]);
$http = new GuzzleHttp\Client([
    'handler' => GuzzleHttp\HandlerStack::create($mock),
]);
$client = ProxyRequest\Client::builder()->withHttpClient($http)->build();
$result = $client->authorization()->login(
    new ProxyRequest\Dto\LoginRequest([
        'email' => 'audit@example.com',
        'password' => 'synthetic',
    ])
);
var_dump($result->getToken(), $result->getRefresh(), $result->valid());
PHP
```

Результат: `NULL, NULL, false`, хотя вызов завершился без исключения.

## Проверки и порядок исправлений

`php vendor/bin/phpunit --do-not-cache-result`: **20 тестов, 418 assertions**, все прошли; PHPUnit сообщил одну deprecation. Runtime: PHP 8.5.10, PHPUnit 13.3.1. Дополнительно выполнены описанные проверки login 202 sync/async, unknown gateway в запросе и ответе, потеря paymentCurrency, ошибка соединения, HTML 200, настройка языка.

Проверены все 80 generated HTTP-операций: метод и путь совпадают с сохранённой схемой. Есть sync/async-вызовы и sync-варианты `WithResponse`. Реализованы Static/Bearer, пагинация, idempotency, ETag/If-Match и проверка webhook по серверному HMAC-алгоритму (`api/apps/webhooks/management/commands/send_webhook_events.py:55`).

Порядок: исправить серверные detail-action; согласовать nullable/вариативные модели; обновить MFA и платежи; объединить sync/async error handling; исправить язык; обновить sync/генерацию и контрактные тесты. В платёжном сценарии проверять не только отправку запроса, но и сохранность ID, checkout state, валюты и данных ошибок после чтения ответа.

## Полная матрица методов

Указаны основные sync-методы; доступны соответствующие `Async`, `WithResponse` и `WithHttpInfo` варианты. Наличие метода не означает, что текущий backend-сценарий проходит без описанных ошибок.

| HTTP | Путь | Метод SDK |
| --- | --- | --- |
| GET | `/affiliates` | `affiliates()->list()` |
| GET | `/affiliates/rewards` | `affiliates()->listRewards()` |
| GET | `/affiliates/rewards/overall` | `affiliates()->getRewardsOverall()` |
| GET | `/analytics/{id}/transactions` | `analytics()->getTransactions()` |
| GET | `/analytics/connections` | `analytics()->getConnections()` |
| GET | `/analytics/domains` | `analytics()->listDomains()` |
| GET | `/analytics/feed` | `analytics()->listFeed()` |
| GET | `/analytics/logs` | `analytics()->listLogs()` |
| GET | `/analytics/overall` | `analytics()->getOverall()` |
| GET | `/api-keys` | `apiKeys()->list()` |
| POST | `/api-keys` | `apiKeys()->create()` |
| DELETE | `/api-keys/{id}` | `apiKeys()->delete()` |
| GET | `/coupons` | `coupons()->list()` |
| POST | `/coupons` | `coupons()->create()` |
| GET | `/coupons/{id}` | `coupons()->get()` |
| PUT | `/coupons/{id}` | `coupons()->replace()` |
| PATCH | `/coupons/{id}` | `coupons()->update()` |
| DELETE | `/coupons/{id}` | `coupons()->delete()` |
| GET | `/coupons/{id}/redeems` | `coupons()->listRedeems()` |
| POST | `/coupons/calculate-price` | `coupons()->calculatePrice()` |
| GET | `/integrations/telegram/connection` | `telegram()->getConnection()` |
| PATCH | `/integrations/telegram/connection` | `telegram()->updateConnection()` |
| DELETE | `/integrations/telegram/connection` | `telegram()->deleteConnection()` |
| POST | `/integrations/telegram/link` | `telegram()->createLink()` |
| GET | `/invoices` | `invoices()->list()` |
| POST | `/invoices` | `invoices()->create()` |
| GET | `/invoices/{id}` | `invoices()->get()` |
| DELETE | `/invoices/{id}` | `invoices()->delete()` |
| GET | `/invoices/{id}/download/pdf` | `invoices()->downloadPdf()` |
| GET | `/invoices/{id}/pay` | `invoices()->getPaymentLink()` |
| GET | `/locations/asn` | `locations()->listAsns()` |
| GET | `/locations/cities` | `locations()->listCities()` |
| GET | `/locations/cities/{id}` | `locations()->getCity()` |
| GET | `/locations/continents` | `locations()->listContinents()` |
| GET | `/locations/continents/{id}` | `locations()->getContinent()` |
| GET | `/locations/countries` | `locations()->listCountries()` |
| GET | `/locations/countries/{id}` | `locations()->getCountry()` |
| GET | `/locations/isps` | `locations()->listIsps()` |
| GET | `/locations/regions` | `locations()->listRegions()` |
| GET | `/locations/regions/{id}` | `locations()->getRegion()` |
| POST | `/login` | `authorization()->login()` |
| POST | `/login/google` | `authorization()->loginWithGoogle()` |
| POST | `/login/otp` | **Отсутствует — PHP-01** |
| GET | `/news` | `news()->list()` |
| GET | `/orders` | `orders()->list()` |
| GET | `/orders/{id}` | `orders()->get()` |
| PATCH | `/orders/{id}` | `orders()->updateAutoRenewal()` |
| DELETE | `/orders/{id}` | `orders()->delete()` |
| GET | `/packages` | `packages()->list()` |
| GET | `/packages/commissions` | `packages()->listCommissions()` |
| GET | `/profile` | `profile()->get()` |
| PATCH | `/profile` | `profile()->update()` |
| DELETE | `/profile` | `profile()->delete()` |
| POST | `/profile/2fa/confirm` | `profile()->confirmTwoFactor()` |
| POST | `/profile/2fa/disable` | `profile()->disableTwoFactor()` |
| POST | `/profile/2fa/setup` | `profile()->setupTwoFactor()` |
| GET | `/profile/2fa/status` | `profile()->getTwoFactorStatus()` |
| POST | `/profile/change-password` | `profile()->changePassword()` |
| POST | `/proxies/generate` | `proxies()->generate()` |
| POST | `/recover-password` | `authorization()->recoverPassword()` |
| POST | `/refresh` | `authorization()->refresh()` |
| POST | `/reset-password` | `orders()->resetPassword()` |
| GET | `/rewards` | `rewards()->list()` |
| POST | `/rewards/claim` | `rewards()->claim()` |
| GET | `/sessions` | `sessions()->list()` |
| DELETE | `/sessions/{id}` | `sessions()->delete()` |
| GET | `/settings` | `settings()->get()` |
| POST | `/signup` | `authorization()->signup()` |
| GET | `/users` | `users()->list()` |
| POST | `/users` | `users()->create()` |
| GET | `/users/{id}` | `users()->get()` |
| PATCH | `/users/{id}` | `users()->update()` |
| DELETE | `/users/{id}` | `users()->delete()` |
| POST | `/users/{id}/data/add` | `users()->addData()` |
| POST | `/users/{id}/data/subtract` | `users()->subtractData()` |
| GET | `/users/{id}/orders` | `users()->listOrders()` |
| POST | `/users/{id}/password` | `users()->resetPassword()` |
| GET | `/webhooks` | `webhooks()->list()` |
| POST | `/webhooks` | `webhooks()->create()` |
| GET | `/webhooks/{id}` | `webhooks()->get()` |
| DELETE | `/webhooks/{id}` | `webhooks()->delete()` |
