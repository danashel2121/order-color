<?php

namespace Nivys\OrderStatusColor\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Nivys\OrderStatusColor\Model\StatusColor;

class Status extends Column
{
    protected StatusColor $statusColor;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        StatusColor $statusColor,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);

        $this->statusColor = $statusColor;
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $item['status_color'] = $this->statusColor->getColor($item[$this->getData('name')]);
            }
        }

        return $dataSource;
    }
}