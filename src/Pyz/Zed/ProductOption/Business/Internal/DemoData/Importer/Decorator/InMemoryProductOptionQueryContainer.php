<?php

namespace Pyz\Zed\ProductOption\Business\Internal\DemoData\Importer\Decorator;

use Orm\Zed\ProductOption\Persistence\SpyProductOptionTypeUsageExclusionQuery;
use Orm\Zed\ProductOption\Persistence\SpyProductOptionValueUsageConstraintQuery;
use Orm\Zed\ProductOption\Persistence\SpyProductOptionTypeQuery;
use Orm\Zed\ProductOption\Persistence\SpyProductOptionValueQuery;
use Orm\Zed\ProductOption\Persistence\SpyProductOptionTypeTranslationQuery;
use Orm\Zed\ProductOption\Persistence\SpyProductOptionValueTranslationQuery;
use Orm\Zed\ProductOption\Persistence\SpyProductOptionTypeUsageQuery;
use Orm\Zed\ProductOption\Persistence\SpyProductOptionValueUsageQuery;
use Orm\Zed\Product\Persistence\SpyProductAbstractQuery;
use Orm\Zed\Tax\Persistence\Base\SpyTaxSetQuery;
use Spryker\Zed\ProductOption\Persistence\ProductOptionQueryContainerInterface;

class InMemoryProductOptionQueryContainer implements ProductOptionQueryContainerInterface
{

    /**
     * @var bool
     */
    private static $disableCache = false;

    /**
     * @var mixed
     */
    private $lastResult;

    /**
     * @return mixed
     */
    public function findOne()
    {
        return $this->lastResult;
    }

    /**
     * @var ProductOptionQueryContainerInterface
     */
    private $queryContainer;

    /**
     * @param ProductOptionQueryContainerInterface $queryContainer
     */
    public function __construct(ProductOptionQueryContainerInterface $queryContainer)
    {
        $this->queryContainer = $queryContainer;
    }

    public static function disable()
    {
        static::$disableCache = true;
    }

    /**
     * @param string $importKeyProductOptionType
     *
     * @return SpyProductOptionTypeQuery
     */
    public function queryProductOptionTypeByImportKey($importKeyProductOptionType)
    {
        if (static::$disableCache === true) {
            return $this->queryContainer
                ->queryProductOptionTypeByImportKey($importKeyProductOptionType);
        }

        static $cache = [];

        $query = $this->queryContainer
            ->queryProductOptionTypeByImportKey($importKeyProductOptionType)
            ->setQueryKey('queryProductOptionTypeByImportKey');

        if (isset($cache[$importKeyProductOptionType]) === false) {
            $cache[$importKeyProductOptionType] = $query->findOne();
        }

        $this->lastResult = $cache[$importKeyProductOptionType];

        return $query;
    }

    /**
     * @param int $fkProductOptionType
     * @param int $fkLocale
     *
     * @return SpyProductOptionTypeTranslationQuery
     */
    public function queryProductOptionTypeTranslationByFks($fkProductOptionType, $fkLocale)
    {
        $query = $this->queryContainer->queryProductOptionTypeTranslationByFks($fkProductOptionType, $fkLocale);

        if (static::$disableCache === false) {
            $query->setQueryKey('queryProductOptionTypeTranslationByFks');
        }

        return $query;
    }

    /**
     * @param string $importKeyProductOptionValue
     * @param int $fkProductOptionType
     *
     * @return SpyProductOptionValueQuery
     */
    public function queryProductOptionValueByImportKeyAndFkProductOptionType($importKeyProductOptionValue, $fkProductOptionType)
    {
        $query = $this->queryContainer->queryProductOptionValueByImportKeyAndFkProductOptionType($importKeyProductOptionValue, $fkProductOptionType);

        if (static::$disableCache === false) {
            $query->setQueryKey('queryProductOptionValueByImportKeyAndFkProductOptionType');
        }

        return $query;
    }

    /**
     * @param string $importKeyProductOptionValue
     *
     * @return SpyProductOptionValueQuery
     */
    public function queryProductOptionValueByImportKey($importKeyProductOptionValue)
    {
        if (static::$disableCache === true) {
            return $this->queryContainer
                ->queryProductOptionValueByImportKey($importKeyProductOptionValue);
        }

        static $cache;

        $query = $this->queryContainer
            ->queryProductOptionValueByImportKey($importKeyProductOptionValue)
            ->setQueryKey('queryProductOptionValueByImportKey');

        if (isset($cache[$importKeyProductOptionValue]) === false) {
            $cache[$importKeyProductOptionValue] = $query->findOne();
        }

        $this->lastResult = $cache[$importKeyProductOptionValue];

        return $query;
    }

    /**
     * @param int $fkProductOptionValue
     * @param int $fkLocale
     *
     * @return SpyProductOptionValueTranslationQuery
     */
    public function queryProductOptionValueTranslationByFks($fkProductOptionValue, $fkLocale)
    {
        $query = $this->queryContainer->queryProductOptionValueTranslationByFks($fkProductOptionValue, $fkLocale);

        if (static::$disableCache === false) {
            $query->setQueryKey('queryProductOptionValueTranslationByFks');
        }

        return $query;
    }

    /**
     * @param int $idProductOptionTypeUsage
     *
     * @return SpyProductOptionTypeUsageQuery
     */
    public function queryProductOptionTypeUsageById($idProductOptionTypeUsage)
    {
        $query = $this->queryContainer->queryProductOptionTypeUsageById($idProductOptionTypeUsage);

        if (static::$disableCache === false) {
            $query->setQueryKey('queryProductOptionTypeUsageById');
        }

        return $query;
    }

    /**
     * @param int $fkProduct
     * @param int $fkProductOptionType
     *
     * @return SpyProductOptionTypeUsageQuery
     */
    public function queryProductOptionTypeUsageByFKs($fkProduct, $fkProductOptionType)
    {
        $query = $this->queryContainer->queryProductOptionTypeUsageByFKs($fkProduct, $fkProductOptionType);

        if (static::$disableCache === false) {
            $query->setQueryKey('queryProductOptionTypeUsageByFKs');
        }

        return $query;
    }

    /**
     * @param int $idProductOptionValueUsage
     *
     * @return SpyProductOptionValueUsageQuery
     */
    public function queryProductOptionValueUsageById($idProductOptionValueUsage)
    {
        $query = $this->queryContainer->queryProductOptionValueUsageById($idProductOptionValueUsage);

        if (static::$disableCache === false) {
            $query->setQueryKey('queryProductOptionValueUsageById');
        }

        return $query;
    }

    /**
     * @param int $fkProductOptionTypeUsage
     * @param int $fkProductOptionType
     *
     * @return SpyProductOptionValueUsageQuery
     */
    public function queryProductOptionValueUsageByFKs($fkProductOptionTypeUsage, $fkProductOptionType)
    {
        $query = $this->queryContainer->queryProductOptionValueUsageByFKs($fkProductOptionTypeUsage, $fkProductOptionType);

        if (static::$disableCache === false) {
            $query->setQueryKey('queryProductOptionValueUsageByFKs');
        }

        return $query;
    }

    /**
     * @param int $fkProductOptionTypeUsage
     * @param int $fkProductOptionType
     *
     * @return SpyProductOptionValueUsageQuery
     */
    public function queryProductOptionValueUsageIdByFKs($fkProductOptionTypeUsage, $fkProductOptionType)
    {
        $query = $this->queryContainer->queryProductOptionValueUsageIdByFKs($fkProductOptionTypeUsage, $fkProductOptionType);

        if (static::$disableCache === false) {
            $query->setQueryKey('queryProductOptionValueUsageIdByFKs');
        }

        return $query;
    }

    /**
     * @param int $fkProductOptionTypeUsageA
     * @param int $fkProductOptionTypeUsageB
     *
     * @return SpyProductOptionTypeUsageExclusionQuery
     */
    public function queryProductOptionTypeUsageExclusionByFks($fkProductOptionTypeUsageA, $fkProductOptionTypeUsageB)
    {
        $query = $this->queryContainer->queryProductOptionTypeUsageExclusionByFks($fkProductOptionTypeUsageA, $fkProductOptionTypeUsageB);

        if (static::$disableCache === false) {
            $query->setQueryKey('queryProductOptionTypeUsageExclusionByFks');
        }

        return $query;
    }

    /**
     * @param int $fkProductOptionValueUsageA
     * @param int $fkProductOptionValueUsageB
     *
     * @return SpyProductOptionValueUsageConstraintQuery
     */
    public function queryProductOptionValueUsageConstraintsByFks($fkProductOptionValueUsageA, $fkProductOptionValueUsageB)
    {
        $query = $this->queryContainer->queryProductOptionValueUsageConstraintsByFks($fkProductOptionValueUsageA, $fkProductOptionValueUsageB);

        if (static::$disableCache === false) {
            $query->setQueryKey('queryProductOptionValueUsageConstraintsByFks');
        }

        return $query;
    }

    /**
     * @param int $idProductOptionType
     *
     * @return SpyProductAbstractQuery
     */
    public function queryAssociatedProductAbstractIdsForProductOptionType($idProductOptionType)
    {
        return $this->queryContainer->queryAssociatedProductAbstractIdsForProductOptionType($idProductOptionType);
    }

    /**
     * @param int $idProductOptionValue
     *
     * @return SpyProductAbstractQuery
     */
    public function queryAssociatedProductAbstractIdsForProductOptionValue($idProductOptionValue)
    {
        return $this->queryContainer->queryAssociatedProductAbstractIdsForProductOptionValue($idProductOptionValue);
    }

    /**
     * @param int $idProductOptionTypeUsage
     *
     * @return SpyProductAbstractQuery
     */
    public function queryProductAbstractIdForProductOptionTypeUsage($idProductOptionTypeUsage)
    {
        if (static::$disableCache === true) {
            return $this->queryContainer->queryProductAbstractIdForProductOptionTypeUsage($idProductOptionTypeUsage);
        }

        static $cache;

        $query = $this->queryContainer
            ->queryProductAbstractIdForProductOptionTypeUsage($idProductOptionTypeUsage);

        if (isset($cache['id.' . $idProductOptionTypeUsage]) === false) {
            $cache['id.' . $idProductOptionTypeUsage] = $query->findOne();
        }

        $this->lastResult = $cache['id.' . $idProductOptionTypeUsage];

        return $query;
    }

    /**
     * @param int $idProduct
     * @param int $idLocale
     *
     * @return array
     */
    public function queryTypeUsagesForProductConcrete($idProduct, $idLocale)
    {
        return $this->queryContainer->queryTypeUsagesForProductConcrete($idProduct, $idLocale);
    }

    /**
     * @param int $idProductAttributeTypeUsage
     * @param int $idLocale
     *
     * @return array
     */
    public function queryValueUsagesForTypeUsage($idProductAttributeTypeUsage, $idLocale)
    {
        return $this->queryContainer->queryValueUsagesForTypeUsage($idProductAttributeTypeUsage, $idLocale);
    }

    /**
     * @param int $idProductAttributeTypeUsage
     *
     * @return array
     */
    public function queryTypeExclusionsForTypeUsage($idProductAttributeTypeUsage)
    {
        return $this->queryContainer->queryTypeExclusionsForTypeUsage($idProductAttributeTypeUsage);
    }

    /**
     * @param int $idValueUsage
     *
     * @return array
     */
    public function queryValueConstraintsForValueUsage($idValueUsage)
    {
        return $this->queryContainer->queryValueConstraintsForValueUsage($idValueUsage);
    }

    /**
     * @param int $idValueUsage
     * @param string $operator
     *
     * @return array
     */
    public function queryValueConstraintsForValueUsageByOperator($idValueUsage, $operator)
    {
        return $this->queryContainer->queryValueConstraintsForValueUsageByOperator($idValueUsage, $operator);
    }

    /**
     * @param int $idProduct
     *
     * @return array
     */
    public function queryConfigPresetsForProductConcrete($idProduct)
    {
        return $this->queryContainer->queryConfigPresetsForProductConcrete($idProduct);
    }

    /**
     * @param int $idConfigPreset
     *
     * @return array
     */
    public function queryValueUsagesForConfigPreset($idConfigPreset)
    {
        return $this->queryContainer->queryValueUsagesForConfigPreset($idConfigPreset);
    }

    /**
     * @param int $idProductAttributeTypeUsage
     *
     * @return string|null
     */
    public function queryEffectiveTaxRateForTypeUsage($idProductAttributeTypeUsage)
    {
        return $this->queryContainer->queryEffectiveTaxRateForTypeUsage($idProductAttributeTypeUsage);
    }

    /**
     * @param int $idProductOptionValue
     *
     * @return SpyProductOptionValueQuery
     */
    public function queryOptionValueById($idProductOptionValue)
    {
        return $this->queryContainer->queryOptionValueById($idProductOptionValue);
    }

    /**
     * @param int $idProductOptionValueUsage
     *
     * @return SpyTaxSetQuery
     */
    public function queryTaxSetForProductOptionValueUsage($idProductOptionValueUsage)
    {
        return $this->queryContainer->queryTaxSetForProductOptionValueUsage($idProductOptionValueUsage);
    }

    /**
     * @param int $idProductOptionValueUsage
     * @param int $idLocale
     *
     * @return SpyProductOptionValueUsageQuery
     */
    public function queryProductOptionValueUsageWithAssociatedAttributes($idProductOptionValueUsage, $idLocale)
    {
        return $this->queryProductOptionValueUsageWithAssociatedAttributes($idProductOptionValueUsage, $idLocale);
    }

}
