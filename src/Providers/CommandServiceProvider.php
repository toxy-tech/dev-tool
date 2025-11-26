<?php

namespace ToxyTech\DevTool\Providers;

use ToxyTech\Base\Supports\ServiceProvider;
use ToxyTech\DevTool\Commands\LocaleCreateCommand;
use ToxyTech\DevTool\Commands\LocaleRemoveCommand;
use ToxyTech\DevTool\Commands\Make\ControllerMakeCommand;
use ToxyTech\DevTool\Commands\Make\FormMakeCommand;
use ToxyTech\DevTool\Commands\Make\ModelMakeCommand;
use ToxyTech\DevTool\Commands\Make\PanelSectionMakeCommand;
use ToxyTech\DevTool\Commands\Make\RequestMakeCommand;
use ToxyTech\DevTool\Commands\Make\RouteMakeCommand;
use ToxyTech\DevTool\Commands\Make\SettingControllerMakeCommand;
use ToxyTech\DevTool\Commands\Make\SettingFormMakeCommand;
use ToxyTech\DevTool\Commands\Make\SettingMakeCommand;
use ToxyTech\DevTool\Commands\Make\SettingRequestMakeCommand;
use ToxyTech\DevTool\Commands\Make\TableMakeCommand;
use ToxyTech\DevTool\Commands\PackageCreateCommand;
use ToxyTech\DevTool\Commands\PackageMakeCrudCommand;
use ToxyTech\DevTool\Commands\PackageRemoveCommand;
use ToxyTech\DevTool\Commands\PluginCreateCommand;
use ToxyTech\DevTool\Commands\PluginMakeCrudCommand;
use ToxyTech\DevTool\Commands\RebuildPermissionsCommand;
use ToxyTech\DevTool\Commands\TestSendMailCommand;
use ToxyTech\DevTool\Commands\ThemeCreateCommand;
use ToxyTech\DevTool\Commands\WidgetCreateCommand;
use ToxyTech\DevTool\Commands\WidgetRemoveCommand;
use ToxyTech\PluginManagement\Providers\PluginManagementServiceProvider;
use ToxyTech\Theme\Providers\ThemeServiceProvider;
use ToxyTech\Widget\Providers\WidgetServiceProvider;

class CommandServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            TableMakeCommand::class,
            ControllerMakeCommand::class,
            RouteMakeCommand::class,
            RequestMakeCommand::class,
            FormMakeCommand::class,
            ModelMakeCommand::class,
            PackageCreateCommand::class,
            PackageMakeCrudCommand::class,
            PackageRemoveCommand::class,
            TestSendMailCommand::class,
            RebuildPermissionsCommand::class,
            LocaleRemoveCommand::class,
            LocaleCreateCommand::class,
        ]);

        if (version_compare(get_core_version(), '7.0.0', '>=')) {
            $this->commands([
                PanelSectionMakeCommand::class,
                SettingControllerMakeCommand::class,
                SettingRequestMakeCommand::class,
                SettingFormMakeCommand::class,
                SettingMakeCommand::class,
            ]);
        }

        if (class_exists(PluginManagementServiceProvider::class)) {
            $this->commands([
                PluginCreateCommand::class,
                PluginMakeCrudCommand::class,
            ]);
        }

        if (class_exists(ThemeServiceProvider::class)) {
            $this->commands([
                ThemeCreateCommand::class,
            ]);
        }

        if (class_exists(WidgetServiceProvider::class)) {
            $this->commands([
                WidgetCreateCommand::class,
                WidgetRemoveCommand::class,
            ]);
        }
    }
}
