<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('payment.currency_locale', 'en');
    }
    public function down(): void
    {
        $this->migrator->delete('payment.currency_locale');
    }
};
