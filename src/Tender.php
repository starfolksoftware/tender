<?php

namespace Tender;

use Illuminate\Database\Eloquent\Model;
use Tender\Contracts\CreatesCurrencies;
use Tender\Contracts\DeletesCurrencies;
use Tender\Contracts\UpdatesCurrencies;

final class Tender
{
    /**
     * Indicates if Tender routes will be registered.
     */
    public static bool $registersRoutes = true;

    /**
     * Indicates if Tender migrations should be ran.
     */
    public static bool $runsMigrations = true;

    /**
     * The currency model that should be used by Tender.
     */
    public static string $currencyModel = 'App\\Models\\Currency';

    /**
     * Indicates if Tender should support teams.
     */
    public static bool $supportsTeams = false;

    /**
     * The team model that should be used by Tender.
     */
    public static string $teamModel;

    /**
     * Get the name of the currency model used by the application.
     */
    public static function teamModel(): string
    {
        return self::$teamModel;
    }

    /**
     * Specify the team model that should be used by Tender.
     */
    public static function useTeamModel(string $model): static
    {
        self::$teamModel = $model;

        return new self();
    }

    /**
     * Get a new instance of the team model.
     */
    public static function newTeamModel(): Model
    {
        $model = static::teamModel();

        return new $model();
    }

    /**
     * Find a team instance by the given ID.
     */
    public static function findTeamByIdOrFail($id): Model
    {
        return static::newTeamModel()->whereId($id)->firstOrFail();
    }

    /**
     * Get the name of the currency model used by the application.
     */
    public static function currencyModel(): string
    {
        return static::$currencyModel;
    }

    /**
     * Get a new instance of the currency model.
     */
    public static function newCurrencyModel(): Model
    {
        $model = static::currencyModel();

        return new $model();
    }

    /**
     * Specify the currency model that should be used by Tender.
     */
    public static function useCurrencyModel(string $model): static
    {
        static::$currencyModel = $model;

        return new static();
    }

    /**
     * Register a class / callback that should be used to create Currencies.
     */
    public static function createCurrenciesUsing(string $class): void
    {
        app()->singleton(CreatesCurrencies::class, $class);
    }

    /**
     * Register a class / callback that should be used to update Currencies.
     */
    public static function updateCurrenciesUsing(string $class): void
    {
        app()->singleton(UpdatesCurrencies::class, $class);
    }

    /**
     * Register a class / callback that should be used to delete Currencies.
     */
    public static function deleteCurrenciesUsing(string $class): void
    {
        app()->singleton(DeletesCurrencies::class, $class);
    }

    /**
     * Configure Tender to not register its routes.
     */
    public static function ignoreRoutes(): static
    {
        static::$registersRoutes = false;

        return new static();
    }

    /**
     * Configure Tender to not run its migrations.
     */
    public static function ignoreMigrations(): static
    {
        static::$runsMigrations = false;

        return new static();
    }

    /**
     * Configure Tender to support multiple teams.
     */
    public static function supportsTeams(bool $value = true): static
    {
        static::$supportsTeams = $value;

        return new static();
    }

    /**
     * Get a completion redirect path for a specific feature.
     */
    public static function redirects(string $redirect, ?string $default = null): string
    {
        return config('tender.redirects.'.$redirect) ?? $default ?? '/';
    }
}
