# Silverstripe Menu Module

Adds multiple menus that are defined via yml and managed via the cms.

## Requirements

- Silverstripe 4.x or 5.x
- PHP 7.4+

## Installation

```bash
composer require gorriecoe/silverstripe-menu
```

## Configuration

### Silverstripe 4.x

The module will automatically use Silverstripe 4.x compatible configurations.

### Silverstripe 5.x

The module will automatically use Silverstripe 5.x compatible configurations.

### Menu Configuration

Define your menus in your `_config/menus.yml` file:

```yaml
gorriecoe\Menu\Models\MenuSet:
  sets:
    main:
      title: 'Main Menu'
      allow_children: true
    footer:
      title: 'Footer Menu'
      allow_children: false
    sidebar:
      title: 'Sidebar Menu'
      allow_children: true
```

### Page Integration

To automatically create menu links when pages are published, add this to your Page class:

```php
class Page extends SiteTree
{
    private static $owns_menu = [
        'main',
        'footer'
    ];
}
```

## Usage

### In Templates

```ss
<% loop $MenuSet('main') %>
    <li>
        <a href="{$LinkURL}">{$Title}</a>
        <% if $Children %>
            <ul>
                <% loop $Children %>
                    <li><a href="{$LinkURL}">{$Title}</a></li>
                <% end_loop %>
            </ul>
        <% end_if %>
    </li>
<% end_loop %>
```

### In PHP

```php
use gorriecoe\Menu\Models\MenuSet;

$menuSet = MenuSet::get_by_slug('main');
$links = $menuSet->Links();
```

## Features

- Multiple menu support
- Hierarchical menu structure
- CMS management interface
- Automatic menu link creation
- GraphQL API support
- Subsite support (if subsites module is installed)

## Compatibility

This module is compatible with:
- Silverstripe 4.x
- Silverstripe 5.x
- PHP 7.4+
- PHP 8.0+
- PHP 8.1+

## License

BSD-3-Clause
