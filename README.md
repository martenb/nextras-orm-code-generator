# Nextras ORM code generator

## Installation
```yaml
composer require martenb/nextras-orm-code-generator:dev-master --dev
```

## Configuration

```yaml
extensions:
    ormGenerator: martenb\Nextras\ORM\DI\Extension
```

## Optional configuration

```yaml
ormGenerator:
    directory: '%appDir%/model/orm'
    namespace: 'App\Model'
    entityExtends: 'App\Model\BaseEntity'
    repositoryExtends: 'App\Model\BaseRepository'
    mapperExtends: 'App\Model\BaseMapper'
```

## Usage

```yaml
php bin/console orm:generator Product Products
```

This command creates entity, repository and mapper in ```%directory%/Product```.

### Entity ```%directory%/Product/Product.php```

```php
<?php
namespace App\Model;

/**
 * @property int $id {primary}
 */
class Product extends BaseEntity
{
}
```

### Repository ```%directory%/Product/ProductsRepository.php```

```php
<?php
namespace App\Model;

class ProductsRepository extends BaseRepository
{
	public static function getEntityClassNames(): array
	{
		return [Product::class];
	}
}
```

### Maper ```%directory%/Product/ProductsMapper.php```

```php
<?php
namespace App\Model;

class ProductsMapper extends BaseMapper
{
}
```
