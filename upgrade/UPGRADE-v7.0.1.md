# [Upgrade from v7.0.0 to v7.0.1]

This guide contains instructions to upgrade from version v7.0.0 to v7.0.1.

**Before you start, don't forget to take a look at [general instructions](https://github.com/shopsys/shopsys/blob/7.3/UPGRADE.md) about upgrading.**
There you can find links to upgrade notes for other versions too.

## [shopsys/framework]

### Application
- escape the values of replacements passed as a sixth argument of the `MessageData`'s constructor to prevent HTML injection ([#1120](https://github.com/shopsys/shopsys/pull/1120))
    - all values passed to the `$variablesReplacementsForBody` argument in `MessageData::__construct()` should either be trusted (such as URLs generated by the `Router` or HTML content) or escaped via `htmlspecialchars($value, ENT_QUOTES)`
    - check the calls of `new MessageData(...)` in your project's repository and possible overwritten methods:
        - `\Shopsys\FrameworkBundle\Model\Customer\Mail\RegistrationMail::getVariablesReplacements()`
        - `\Shopsys\FrameworkBundle\Model\Customer\Mail\ResetPasswordMail::getBodyValuesIndexedByVariableName()`
        - `\Shopsys\FrameworkBundle\Model\Order\Mail\OrderMail::getVariablesReplacementsForBody()`
        - `\Shopsys\FrameworkBundle\Model\PersonalData\Mail\PersonalDataAccessMail::getBodyValuesIndexedByVariableName()`
        - `\Shopsys\FrameworkBundle\Model\PersonalData\Mail\PersonalDataExportMail::getBodyValuesIndexedByVariableName()`
    - if you haven't extended any of these methods and haven't called `new MessageData(...)` in your code, you should be protected by the upgrade alone
    - if you have customized e-mailing on your project (eg. by implementing Twig templates for mail content), you should check your code to avoid double escaping (eg. execute `htmlspecialchars_decode($value, ENT_QUOTES)` before passing the variables replacements to you implementation)

### Configuration
- do not update `symfony/monolog-bundle` to the version `3.4.0` and higher ([#1148](https://github.com/shopsys/shopsys/pull/1148)) or fix the bundle configuration, see [#1154](https://github.com/shopsys/shopsys/pull/1154)
    - in `app/config/packages/dev/monolog.yml`:
        ```diff
            monolog:
               handlers:
                   main:
                       # change "fingers_crossed" handler to "group" that works as a passthrough to "nested"
                       type: group
                       members: [ nested ]
        +              excluded_404s: false
        ```
    - in `app/config/packages/test/monolog.yml`:
        ```diff
            monolog:
                handlers:
                    main:
                        type: "null"
        +               excluded_404s: false
        ```

[shopsys/framework]: https://github.com/shopsys/framework
[Upgrade from v7.0.0 to v7.0.1]: https://github.com/shopsys/shopsys/compare/v7.0.0...v7.0.1
