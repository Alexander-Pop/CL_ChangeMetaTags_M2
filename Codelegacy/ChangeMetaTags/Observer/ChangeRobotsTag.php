<?php
/* Glory to Ukraine! Glory to the heros! */
namespace Codelegacy\ChangeMetaTags\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\App\ActionFlag;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\App\Response\RedirectInterface;
use Magento\Framework\View\Page\Config;
use Magento\Framework\Event\Observer;

class ChangeRobotsTag implements ObserverInterface
{

    /**
     * @var \Magento\Framework\App\ActionFlag
     */
    protected $_actionFlag;

    /**
     * @var \Magento\Framework\Message\ManagerInterface
     */
    protected $messageManager;

    /**
     * @var \Magento\Framework\App\Response\RedirectInterface
     */
    protected $redirect;

    private $_pageConfig;

    /**
     * @param \Magento\Framework\App\ActionFlag $actionFlag
     * @param \Magento\Framework\Message\ManagerInterface $messageManager
     * @param \Magento\Framework\App\Response\RedirectInterface $redirect
     */
    public function __construct(
        ActionFlag $actionFlag,
        ManagerInterface $messageManager,
        RedirectInterface $redirect,
		Config $pageConfig		
    ) {
        $this->_actionFlag    = $actionFlag;
        $this->messageManager = $messageManager;
        $this->redirect       = $redirect;
		$this->_pageConfig    = $pageConfig; 
    }

    /**
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
		/** @var \Magento\Framework\App\Action\Action $controller */
		$full_action_name = $observer->getFullActionName();
		$layout           = $observer->getEvent()->getLayout();

		if($full_action_name == 'catalog_category_view'){
			//print_r($layout->getBlock('head')->getRobots());
			$this->_pageConfig->setRobots('NOINDEX,NOFOLLOW');
		}
    }

}
