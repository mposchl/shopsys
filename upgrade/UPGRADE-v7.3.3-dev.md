# [Upgrade from v7.3.2 to v7.3.3-dev](https://github.com/shopsys/shopsys/compare/v7.3.2...7.3)

This guide contains instructions to upgrade from version v7.3.2 to v7.3.3-dev.

**Before you start, don't forget to take a look at [general instructions](https://github.com/shopsys/shopsys/blob/7.3/UPGRADE.md) about upgrading.**
There you can find links to upgrade notes for other versions too.

## [shopsys/framework]

### Application
- use Environment from DIC parameter in ErrorController ([#1389](https://github.com/shopsys/shopsys/pull/1389))
    - change your `services.yml` to inject `%kernel.environment%` to your `Shopsys\ShopBundle\Controller\Front\ErrorController`
        ```diff
        +   Shopsys\ShopBundle\Controller\Front\ErrorController:
        +       arguments:
        +           $environment: '%kernel.environment%'
        ```
    - change `Shopsys\ShopBundle\Controller\Front\ErrorController` to use injected environment instead of `Environment::getEnvironment(false)`
        ```diff
        +   /**
        +    * @var string
        +    */
        +   private $environment;

            /**
             * @param \Shopsys\FrameworkBundle\Component\Error\ExceptionController $exceptionController
             * @param \Shopsys\FrameworkBundle\Component\Error\ExceptionListener $exceptionListener
             * @param \Shopsys\FrameworkBundle\Component\Error\ErrorPagesFacade $errorPagesFacade
             * @param \Shopsys\FrameworkBundle\Component\Domain\Domain $domain
        +    * @param string $environment
             */
            public function __construct(
                ExceptionController $exceptionController,
                ExceptionListener $exceptionListener,
                ErrorPagesFacade $errorPagesFacade,
        -       Domain $domain
        +       Domain $domain,
        +       string $environment
            ) {
                $this->exceptionController = $exceptionController;
                $this->exceptionListener = $exceptionListener;
                $this->errorPagesFacade = $errorPagesFacade;
                $this->domain = $domain;
        +       $this->environment = $environment;
            }

            //...

            private function createUnableToResolveDomainResponse(Request $request): Response
                {
                    $url = $request->getSchemeAndHttpHost() . $request->getBasePath();
                    $content = sprintf("You are trying to access an unknown domain '%s'.", $url);

        -           if (EnvironmentType::TEST === Environment::getEnvironment(false)) {    
        +           if ($this->environment === EnvironmentType::TEST) {
        ```
- remove unused usages of property `ProductData::$price` in following tests ([#1459](https://github.com/shopsys/shopsys/pull/1459))
    - `tests/ShopBundle/Functional/Model/Cart/CartItemTest.php`
    - `tests/ShopBundle/Functional/Model/Cart/CartTest.php`
    - `tests/ShopBundle/Functional/Model/Cart/Watcher/CartWatcherTest.php`

- exception `CartIsEmptyException` has been marked as deprecated and will be removed in 9.0 ([#1494](https://github.com/shopsys/shopsys/pull/1494))
- update your `OrderCest` so it is more reliable ([#1551](https://github.com/shopsys/shopsys/pull/1551))
    ```diff
        $orderPage->selectTransport(self::TRANSPORT_CZECH_POST_POSITION);
    +   $me->waitForAjax();
        $orderPage->assertPaymentIsNotSelected('Cash on delivery');
    ```
- fix npm audit [#1668](https://github.com/shopsys/shopsys/pull/1668)
    - update your `docker/php-fpm/Dockerfile`
      ```diff
        RUN apt-get update && \
          apt-get install -y \
          libpng-dev \
          libjpeg-dev \
          libfreetype6-dev \
          libzip-dev \
          libicu-dev \
          libpq-dev \
      +   fontforge \
          autoconf && \
          apt-get clean
      ```
      !!! note 
      - If you don't use a docker, you have to install `fontforge` manually: `http://designwithfontforge.com/en-US/Installing_Fontforge.html`
      
    - update your `package.json`
      ```diff
      - "grunt-spritesmith": "^6.6.2",
      - "grunt-webfont": "^1.7.2",
      + "grunt-spritesmith": "^6.8.0",
      + "grunt-webfont": "https://github.com/shopsys/grunt-webfont.git#fix-npm-audit",
      ```
    - update your `src/Shopsys/ShopBundle/Resources/views/Grunt/gruntfile.js.twig` (you have to do this in two places (webfont: admin and webfont: frontend))
      ```diff
        types: 'eot,woff,ttf,svg',
      - engine: 'node',
        stylesheet: 'less',
        relativeFontPath: '../fonts',
      - fontHeight: '512',
      - descent: '0',
      + fontHeight: 512,
      + descent: 0,
      + normalize: true,
        destHtml: 'docs/generated',
      ```
    !!! note
    Since new version of grunt webfont - '.svg' will not get `vertical-align: middle;` css definition.
    On some projects you can see svg icons aligned to top.
    You can fix by adding vertical-align for .svg class to your CSS definitions.
    For example: `svg-fix.less` 
    ```less
      .svg {
          vertical-align: middle;
      }
    ```
