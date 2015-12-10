<?php

namespace Pyz\Yves\Application;

use Pyz\Yves\Customer\Plugin\Provider\SecurityServiceProvider as ProviderSecurityServiceProvider;
use Pyz\Yves\Customer\Plugin\UserProvider;
use Pyz\Yves\Catalog\Plugin\Router\SearchRouter;
use Pyz\Yves\Collector\Plugin\Router\StorageRouter;
use Pyz\Yves\CategoryExporter\Plugin\Provider\CategoryExporterServiceProvider;
use Pyz\Yves\Customer\Plugin\Provider\CustomerServiceProvider;
use Pyz\Yves\Glossary\Plugin\Provider\TranslationServiceProvider;
use SprykerEngine\Yves\Application\Plugin\ServiceProvider\ExceptionServiceProvider;
use Pyz\Yves\Application\Plugin\Provider\YvesSecurityServiceProvider;
use Pyz\Yves\Session\Plugin\Provider\SessionServiceProvider as ProviderSessionServiceProvider;
use Pyz\Yves\Application\Plugin\Provider\ApplicationServiceProvider;
use Pyz\Shared\Application\Business\Routing\SilexRouter;
use Pyz\Yves\Application\Plugin\Provider\ApplicationControllerProvider;
use Pyz\Yves\Cart\Plugin\Provider\CartControllerProvider;
use Pyz\Yves\Checkout\Plugin\Provider\CheckoutControllerProvider;
use Pyz\Yves\Customer\Plugin\Provider\CustomerControllerProvider;
use Pyz\Yves\System\Plugin\Provider\SystemControllerProvider;
use Pyz\Yves\Twig\Plugin\Provider\TwigServiceProvider;
use Pyz\Yves\Wishlist\Plugin\Provider\WishlistControllerProvider;
use Silex\Provider\FormServiceProvider;
use Silex\Provider\HttpFragmentServiceProvider;
use Silex\Provider\RememberMeServiceProvider;
use Silex\Provider\SecurityServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\WebProfilerServiceProvider;
use Silex\ServiceProviderInterface;
use SprykerEngine\Shared\Config;
use SprykerEngine\Shared\Application\Communication\Application;
use SprykerEngine\Yves\Application\Application as YvesApplication;
use SprykerEngine\Yves\Application\Plugin\ControllerProviderInterface;
use SprykerEngine\Yves\Application\Plugin\ServiceProvider\CookieServiceProvider;
use SprykerEngine\Yves\Application\Plugin\ServiceProvider\MonologServiceProvider;
use SprykerEngine\Yves\Application\Plugin\ServiceProvider\YvesLoggingServiceProvider;
use SprykerFeature\Client\Lumberjack\Service\EventJournalClient;
use SprykerFeature\Shared\Application\ApplicationConfig;
use SprykerFeature\Shared\Application\Communication\Plugin\ServiceProvider\RoutingServiceProvider;
use SprykerFeature\Shared\Application\Communication\Plugin\ServiceProvider\UrlGeneratorServiceProvider;
use SprykerFeature\Shared\NewRelic\Api;
use SprykerFeature\Shared\Yves\YvesConfig;
use Symfony\Component\Routing\RouterInterface;

class YvesBootstrap
{

    /**
     * @var YvesApplication
     */
    protected $application;

    public function __construct()
    {
        $this->application = new YvesApplication();
    }

    /**
     * @return Application
     */
    public function boot()
    {
        $this->registerServiceProviders();

        $this->registerRouters();

        $this->registerControllerProviders();

        return $this->application;
    }

    /**
     * @return ServiceProviderInterface[]
     */
    protected function registerServiceProviders()
    {
        $this->application->register(new TwigServiceProvider());
        $this->application->register(new ApplicationServiceProvider());
        $this->application->register(new SessionServiceProvider());
        $this->application->register(new ProviderSessionServiceProvider());
        $this->application->register(new SecurityServiceProvider());
        $this->application->register($this->createSecurityServiceProviderExtension());
        $this->application->register(new YvesSecurityServiceProvider());
        $this->application->register(new ExceptionServiceProvider());
        $this->application->register(new YvesLoggingServiceProvider(new EventJournalClient(), new Api()));
        $this->application->register(new MonologServiceProvider());
        $this->application->register(new CookieServiceProvider());
        $this->application->register(new UrlGeneratorServiceProvider());
        $this->application->register(new ServiceControllerServiceProvider());
        $this->application->register(new RememberMeServiceProvider());
        $this->application->register(new RoutingServiceProvider());
        $this->application->register(new TranslationServiceProvider());
        $this->application->register(new ValidatorServiceProvider());
        $this->application->register(new FormServiceProvider());
        $this->application->register(new HttpFragmentServiceProvider());
        $this->application->register(new CustomerServiceProvider());
        $this->application->register(new CategoryExporterServiceProvider());

        if (Config::get(ApplicationConfig::ENABLE_WEB_PROFILER, false)) {
            $this->application->register(new WebProfilerServiceProvider());
        }
    }

    /**
     * @return RouterInterface[]
     */
    protected function registerRouters()
    {
        $this->application->addRouter((new StorageRouter())->setSsl(false));
        $this->application->addRouter((new SearchRouter())->setSsl(false));
        $this->application->addRouter(new SilexRouter($this->application));
    }

    /**
     * @return ControllerProviderInterface[]
     */
    protected function registerControllerProviders()
    {
        $ssl = Config::get(YvesConfig::YVES_SSL_ENABLED);

        $controllerProviders = [
            new ApplicationControllerProvider(false),
            new CheckoutControllerProvider($ssl),
            new CustomerControllerProvider($ssl),
            new CartControllerProvider($ssl),
            new WishlistControllerProvider($ssl),
            new SystemControllerProvider($ssl),
        ];

        foreach ($controllerProviders as $controllerProvider) {
            $this->application->mount($controllerProvider->getUrlPrefix(), $controllerProvider);
        }
    }

    /**
     * @return SecurityServiceProvider
     */
    private function createSecurityServiceProviderExtension()
    {
        $userProvider = new UserProvider();

        $securityServiceProvider = new ProviderSecurityServiceProvider();
        $securityServiceProvider->setUserProvider($userProvider);

        return $securityServiceProvider;
    }

}