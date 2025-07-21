# Migration Guide

## Upgrading from Silverstripe 3.x to 4.x/5.x

This guide helps you migrate from older versions of the silverstripe-menu module to the new version that supports both Silverstripe 4.x and 5.x.

## Breaking Changes

### 1. Template Syntax

**Old (SS3):**
```ss
<% if LinkURL %>
    <a href="{$LinkURL}">{$Title}</a>
    <% if Children %>
        <% loop Children %>
            {$Me}
        <% end_loop %>
    <% end_if %>
<% end_if %>
```

**New (SS4/5):**
```ss
<% if $LinkURL %>
    <a href="{$LinkURL}">{$Title}</a>
    <% if $Children %>
        <% loop $Children %>
            {$Me}
        <% end_loop %>
    <% end_if %>
<% end_if %>
```

### 2. Configuration

**Old (SS3):**
```yaml
MenuSet:
  sets:
    main: 'Main Menu'
    footer: 'Footer Menu'
```

**New (SS4/5):**
```yaml
gorriecoe\Menu\Models\MenuSet:
  sets:
    main:
      title: 'Main Menu'
      allow_children: true
    footer:
      title: 'Footer Menu'
      allow_children: false
```

### 3. PHP Code

**Old (SS3):**
```php
$menuSet = MenuSet::get()->filter('Slug', 'main')->first();
```

**New (SS4/5):**
```php
use gorriecoe\Menu\Models\MenuSet;

$menuSet = MenuSet::get_by_slug('main');
```

## Installation

1. Update your `composer.json`:
```json
{
    "require": {
        "gorriecoe/silverstripe-menu": "^2.0"
    }
}
```

2. Run composer update:
```bash
composer update
```

3. Run database migration:
```bash
vendor/bin/sake dev/build flush=1
```

## Configuration Files

The module now uses separate configuration files for different Silverstripe versions:

- `_config/config.yml` - Common configuration
- `_config/silverstripe4.yml` - SS4 specific configuration
- `_config/silverstripe5.yml` - SS5 specific configuration

## Template Updates

If you have custom templates, update them to use the new syntax:

1. Add `$` before variable names in conditions
2. Add `$` before variable names in loops
3. Ensure proper namespace usage in PHP code

## Testing

After migration, test the following:

1. Menu creation and editing in the CMS
2. Menu rendering in templates
3. GraphQL API (if used)
4. Subsite functionality (if applicable)

## Support

If you encounter issues during migration, please:

1. Check the [README.md](README.md) for current usage instructions
2. Review the configuration examples in `_config/menus.yml`
3. Ensure all dependencies are compatible with your Silverstripe version 