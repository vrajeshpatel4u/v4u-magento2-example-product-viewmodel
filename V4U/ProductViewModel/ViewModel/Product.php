<?php
declare(strict_types=1);

namespace V4U\ProductViewModel\ViewModel;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilderFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;

/**
 * Class Product
 *
 * @package V4U\ProductViewModel\ViewModel
 */
class Product implements ArgumentInterface
{
    const DEFAULT_PAGESIZE = 3;

    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * @var SearchCriteriaBuilderFactory
     */
    private $searchCriteriaBuilderFactory;

    /**
     * @var ScopeConfigInterface
     */

    /**
     * Product constructor.
     *
     * @param ProductRepositoryInterface $productRepository
     * @param SearchCriteriaBuilderFactory $searchCriteriaBuilderFactory
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        SearchCriteriaBuilderFactory $searchCriteriaBuilderFactory
    ) {

        $this->productRepository = $productRepository;
        $this->searchCriteriaBuilderFactory = $searchCriteriaBuilderFactory;
    }

    /**
     * @return ProductInterface[]
     */
    public function getProducts(): array
    {
        $searchCriteriaBuilder = $this->searchCriteriaBuilderFactory->create();


//        $searchCriteriaBuilder->setPageSize($this->getPageSize());
        $searchCriteria = $searchCriteriaBuilder->create();

        $searchResult = $this->productRepository->getList($searchCriteria);
        $products = $searchResult->getItems();

        return $products;
    }

}