Add CAS authentication to Symfony2
==================================

-  More informations about `CAS`_ (Central Authentication Service).
-  Unlike `SimpleCasBundle`_, it's based on the Symfony2 security component.
-  Proxy features are not yet available.

Install the Bundle
------------------

1. Create a `Sensio` directory (if not exists) in your `src/Bundle` directory.

2. Add the sources from github.com (GIT must be installed ;)

    .. code-block:: text

        // if your you're using git for your project
        git submodule add git@github.com:sensio/CasBundle.git src/Bundle/Sensio/CasBundle

        // or if your project is not under git control
        git clone git@github.com:sensio/CasBundle.git

3. Then add it to your AppKernel class::

        // in AppKernel::registerBundles()
        $bundles = array(
            // ...
            new Bundle\Sensio\CasBundle\CasBundle(),
            // ...
        );

Configuration
-------------

Deadly simple, here is an example:

.. configuration-block::

    .. code-block:: yaml

        cas.config:
            uri:     https://my.cas.server:443/ # URI of the cas server
            version: 2                          # version of the used CAS protocole
            cert:    /path/to/my/cert.pem       # ssl cert file path (if needed)
            request: curl                       # request adapter (curl, http or file)
            
    .. code-block:: xml

        <cas:config
            uri="https://my.cas.server:8080/"
            version="2"
            cert="/path/to/my/cert.pem "
            request="curl" />
            
    .. code-block:: php

        $container->loadFromExtension('cas', 'config', array(
            'uri'     => 'https://my.cas.server:443/',
            'version' => 2,
            'cert'    => '/path/to/my/cert.pem',
            'request' => 'curl',
        ));

In addition, the security component must be aware of the new factory and listeners included in the bundle.
In order to to it, just look at the following example in YAML:

.. configuration-block::

    .. code-block:: yaml

        security.config:
            templates:
                - "%kernel.root_dir%/../src/Bundle/Sensio/CasBundle/Resources/config/security_templates.xml"
                
    .. code-block:: xml

        <security:config>
            <template>%kernel.root_dir%/../src/Bundle/Sensio/CasBundle/Resources/config/security_templates.xml</template>
        </security:config>
            
    .. code-block:: php
        
        $container->loadFromExtension('security', 'config', array(
            'templates' => array(
                '%kernel.root_dir%/../src/Bundle/Sensio/CasBundle/Resources/config/security_templates.xml'
            )
        ));

Use the firewall
----------------

As usual, here is a simple example (with the template):

.. configuration-block::

    .. code-block:: yaml

        security.config:
            templates:
                - "%kernel.root_dir%/../src/Bundle/Sensio/CasBundle/Resources/config/security_templates.xml"
            providers:
                my_provider:
                    users:
                        username: { roles: ROLE_USER }
            firewalls:
                my_firewall:
                    pattern:    /path/to/protected/url
                    cas:        { provider: my_provider }

    .. code-block:: xml

        <security:config>
            <template>%kernel.root_dir%/../src/Bundle/Sensio/CasBundle/Resources/config/security_templates.xml</template>
            <provider name="my_provider">
                <user name="username" roles="ROLE_USER">
            </provider>
            <firewall name="my_firewall" pattern="/path/to/protected/url">
                <cas provider="my_provider" />
            </firewall>
        </security:config>

    .. code-block:: php

        $container->loadFromExtension('security', 'config', array(
            'templates' => array(
                '%kernel.root_dir%/../src/Bundle/Sensio/CasBundle/Resources/config/security_templates.xml'
            ),
            'providers' => array(
                'my_provider' => array(
                    'users' => array(
                        'username' => array('roles' => 'ROLE_USER')
                    )
                )
            ),
            'firewall'  => array(
                'my_firewall' => array(
                    'pattern' => '/path/to/protected/url',
                    'cas'     => array(
                        'provider' => 'my_provider'
                    )
                )
            )
        ));

.. _CAS:             http://www.jasig.org/cas
.. _SimpleCasBundle: https://github.com/jmikola/SimpleCASBundle
 