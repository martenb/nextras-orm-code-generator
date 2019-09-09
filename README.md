# Nextras ORM code generator

## Installation
```yaml
composer require martenb/nextras-orm-code-generator:dev-master --dev
```

## Configuration

```yaml
extensions:
    ormGenerator: MartenB\Nextras\ORM\DI\Extension
```

## Optional configuration

```yaml
ormGenerator:
    directory: '%appDir%/Model/Orm'
    namespace: 'App\Model\Orm'
    entityExtends: 'App\Model\Orm\BaseEntity'
    repositoryExtends: 'App\Model\Orm\BaseRepository'
    mapperExtends: 'App\Model\Orm\BaseMapper'
```

## Usage

```yaml
php bin/console orm:generator Product Products
```

This command creates entity, repository and mapper in ```%directory%/Product```.

### Entity ```%directory%/Product/Product.php```

```php
<?php
namespace App\Model\Orm\Product;

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
namespace App\Model\Orm\Product;

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
namespace App\Model\Orm\Product;

class ProductsMapper extends BaseMapper
{
}
```
