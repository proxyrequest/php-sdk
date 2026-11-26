<?php

declare(strict_types=1);

use Symfony\Component\Yaml\Yaml;

require \dirname(__DIR__) . '/vendor/autoload.php';

$document = Yaml::parseFile(\dirname(__DIR__) . '/openapi/openapi.yaml', Yaml::PARSE_OBJECT_FOR_MAP);
$document->components->schemas->FeedRecord->properties->id = (object) [
    'type' => 'string',
    'description' => 'Exact decimal UInt64 identifier, normalized from the API JSON number.',
];
foreach ($document->paths as $item) {
    if (($item->get->operationId ?? null) === 'analytics_logs_retrieve') {
        $item->get->parameters[] = (object) [
            'in' => 'query', 'name' => 'hostname', 'schema' => (object) ['type' => 'string'],
            'deprecated' => true, 'description' => 'Compatibility parameter; ignored by the server.',
        ];
        usort($item->get->parameters, static fn(object $a, object $b): int => ('header' === $a->in) <=> ('header' === $b->in) ?: strcmp($a->name, $b->name));
    }
}
$compatibility = json_decode((string) file_get_contents(\dirname(__DIR__) . '/openapi/compatibility.json'), false, 512, JSON_THROW_ON_ERROR);
foreach ($compatibility->schemas as $name => $legacy) {
    $schemas = $document->components->schemas;
    if (!isset($schemas->{$name}) || 'InvoiceRead' === $name) {
        $schemas->{$name} = $legacy;
        continue;
    }
    $current = $schemas->{$name};
    $current->properties = (object) array_merge((array) ($legacy->properties ?? []), (array) ($current->properties ?? []));
    $current->required = array_values(array_intersect($current->required ?? [], $legacy->required ?? []));
}
$schemas = $document->components->schemas;
foreach ($compatibility->optionalProperties ?? [] as $name => $properties) {
    $schema = $schemas->{$name};
    $schema->required = array_values(array_diff($schema->required ?? [], $properties));
}
if (isset($schemas->PasswordResetInputRequest, $schemas->ProxyPasswordResetRequestRequest)) {
    // Preserve the original order-id model and name the account reset DTO separately.
    $schemas->AccountPasswordResetRequest = $schemas->ResetPasswordRequest;
    $schemas->ResetPasswordRequest = clone $schemas->ProxyPasswordResetRequestRequest;
    foreach ($schemas->PasswordResetInputRequest->oneOf as $variant) {
        if ('#/components/schemas/ResetPasswordRequest' === $variant->{'$ref'}) {
            $variant->{'$ref'} = '#/components/schemas/AccountPasswordResetRequest';
        }
    }
    $operation = $document->paths->{'/reset-password'}->post;
    $operation->requestBody->required = true;
    foreach ($operation->requestBody->content as $variant) {
        $variant->schema->{'$ref'} = '#/components/schemas/ResetPasswordRequest';
    }
}
$excluded = ['sessions_destroy', 'sessions_list'];
$methods = ['get', 'post', 'put', 'patch', 'delete', 'head', 'options', 'trace'];
$seen = [];
$legacyMfaModels = [
    'login_otp_create' => ['VerifyOTPRequest', 'TokenPairResponse'],
    'profile_2fa_confirm_create' => ['TwoFactorConfirmRequest', 'EnabledResponse'],
    'profile_2fa_disable_create' => ['TwoFactorDisableRequest', 'EnabledResponse'],
    'profile_2fa_setup_create' => ['TwoFactorSetupRequestRequest', 'TwoFactorSetupResponse'],
    'profile_2fa_status_retrieve' => [null, 'EnabledResponse'],
];
foreach ($document->paths as $path => $item) {
    foreach ($methods as $method) {
        if (!isset($item->{$method})) {
            continue;
        }
        $id = $item->{$method}->operationId ?? null;
        if (!$id || isset($seen[$id])) {
            throw new RuntimeException('Missing or duplicate operationId: ' . (string) $id);
        }
        $seen[$id] = true;
        if (($item->{$method}->tags ?? []) === ['MFA']) {
            $item->{$method}->tags = ['login_otp_create' === $id ? 'Authorization' : 'Profile'];
        }
        if (isset($legacyMfaModels[$id])) {
            [$requestModel, $responseModel] = $legacyMfaModels[$id];
            if (null !== $requestModel) {
                $item->{$method}->requestBody->required = true;
                foreach ($item->{$method}->requestBody->content as $variant) {
                    $variant->schema->{'$ref'} = '#/components/schemas/' . $requestModel;
                }
            }
            $item->{$method}->responses->{'200'}->content->{'application/json'}->schema->{'$ref'} = '#/components/schemas/' . $responseModel;
        }
        if (\in_array($id, $excluded, true)) {
            unset($item->{$method});
            continue;
        }
        $item->{$method}->parameters[] = (object) [
            'name' => 'X-Impersonate-User',
            'in' => 'header',
            'required' => false,
            'description' => 'Act as this reseller for this request only. Requires a superuser Static API key.',
            'schema' => (object) ['type' => 'string', 'format' => 'uuid'],
        ];
    }
    if ([] === array_intersect($methods, array_keys(get_object_vars($item)))) {
        unset($document->paths->{$path});
    }
}
unset($item);
$document->tags = array_values(array_filter($document->tags, static fn(object $tag): bool => 'Sessions' !== $tag->name));
foreach (array_keys(get_object_vars($document->components->schemas)) as $name) {
    if (preg_match('/^Sessions?(List|Delete|Destroy)/', $name)) {
        unset($document->components->schemas->{$name});
    }
}
file_put_contents($argv[1], json_encode($document, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT));
