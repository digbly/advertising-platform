<?php

namespace Tests\Unit;

use Illuminate\Validation\ValidationException;
use InvalidArgumentException;
use Modules\Core\SettingConfig;
use Modules\Core\SettingConfigBuilder;
use Modules\Core\SettingRegistry;
use Tests\TestCase;

class SettingRegistryTest extends TestCase
{
    private SettingRegistry $registry;

    protected function setUp(): void
    {
        parent::setUp();
        $this->registry = new SettingRegistry;
    }

    public function test_register_and_get_setting(): void
    {
        $this->registry->register('site_name', function (SettingConfigBuilder $builder) {
            $builder->label('Site Name')
                ->rules(['required', 'string', 'max:255'])
                ->default('My Site')
                ->description('The site name.')
                ->group('general');
        });

        $config = $this->registry->get('site_name');

        $this->assertInstanceOf(SettingConfig::class, $config);
        $this->assertSame('site_name', $config->getKey());
        $this->assertSame('Site Name', $config->getLabel());
        $this->assertSame(['required', 'string', 'max:255'], $config->getRules());
        $this->assertSame('My Site', $config->getDefault());
        $this->assertSame('The site name.', $config->getDescription());
        $this->assertSame('general', $config->getGroup());
    }

    public function test_register_duplicate_key_throws_exception(): void
    {
        $this->registry->register('site_name', function (SettingConfigBuilder $builder) {
            $builder->rules(['required']);
        });

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Setting [site_name] is already registered.');

        $this->registry->register('site_name', function (SettingConfigBuilder $builder) {
            $builder->rules(['required']);
        });
    }

    public function test_get_nonexistent_key_throws_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Setting [nonexistent] is not registered.');

        $this->registry->get('nonexistent');
    }

    public function test_has_returns_correct_boolean(): void
    {
        $this->registry->register('site_name', function (SettingConfigBuilder $builder) {
            $builder->rules(['required']);
        });

        $this->assertTrue($this->registry->has('site_name'));
        $this->assertFalse($this->registry->has('nonexistent'));
    }

    public function test_all_returns_all_registered_settings(): void
    {
        $this->registry->register('site_name', function (SettingConfigBuilder $builder) {
            $builder->rules(['required']);
        });
        $this->registry->register('site_url', function (SettingConfigBuilder $builder) {
            $builder->rules(['required', 'url']);
        });

        $all = $this->registry->all();

        $this->assertCount(2, $all);
        $this->assertArrayHasKey('site_name', $all);
        $this->assertArrayHasKey('site_url', $all);
    }

    public function test_rules_returns_validation_rules(): void
    {
        $this->registry->register('site_name', function (SettingConfigBuilder $builder) {
            $builder->rules(['required', 'string', 'max:255']);
        });

        $rules = $this->registry->rules('site_name');

        $this->assertSame(['required', 'string', 'max:255'], $rules);
    }

    public function test_validate_passes_with_valid_value(): void
    {
        $this->registry->register('site_name', function (SettingConfigBuilder $builder) {
            $builder->rules(['required', 'string', 'max:255']);
        });

        $this->registry->validate('site_name', 'My Site');

        $this->assertTrue(true);
    }

    public function test_validate_throws_on_invalid_value(): void
    {
        $this->registry->register('site_name', function (SettingConfigBuilder $builder) {
            $builder->rules(['required', 'string', 'max:255']);
        });

        $this->expectException(ValidationException::class);

        $this->registry->validate('site_name', '');
    }

    public function test_validate_nullable_passes_with_null(): void
    {
        $this->registry->register('site_description', function (SettingConfigBuilder $builder) {
            $builder->rules(['nullable', 'string', 'max:500']);
        });

        $this->registry->validate('site_description', null);

        $this->assertTrue(true);
    }

    public function test_get_by_group_filters_correctly(): void
    {
        $this->registry->register('site_name', function (SettingConfigBuilder $builder) {
            $builder->rules(['required'])->group('general');
        });
        $this->registry->register('site_url', function (SettingConfigBuilder $builder) {
            $builder->rules(['required', 'url'])->group('general');
        });
        $this->registry->register('smtp_host', function (SettingConfigBuilder $builder) {
            $builder->rules(['required'])->group('mail');
        });

        $general = $this->registry->getByGroup('general');

        $this->assertCount(2, $general);
        $this->assertArrayHasKey('site_name', $general);
        $this->assertArrayHasKey('site_url', $general);

        $mail = $this->registry->getByGroup('mail');

        $this->assertCount(1, $mail);
        $this->assertArrayHasKey('smtp_host', $mail);
    }

    public function test_forget_removes_setting(): void
    {
        $this->registry->register('site_name', function (SettingConfigBuilder $builder) {
            $builder->rules(['required']);
        });

        $this->assertTrue($this->registry->has('site_name'));

        $this->registry->forget('site_name');

        $this->assertFalse($this->registry->has('site_name'));
    }

    public function test_register_without_rules_throws(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('must have at least one validation rule.');

        $this->registry->register('site_name', function (SettingConfigBuilder $builder) {
            $builder->label('Site Name');
        });
    }

    public function test_helper_function(): void
    {
        app()->singleton(SettingRegistry::class, function () {
            return new SettingRegistry;
        });

        $registry = setting();

        $this->assertInstanceOf(SettingRegistry::class, $registry);
    }
}
