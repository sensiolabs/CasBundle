Adds the CAS authentication to Symfony 2
========================================

[More informations about CAS (Central Authentication Service)](http://www.jasig.org/cas).

Unlike [SimpleCasBundle](https://github.com/jmikola/SimpleCASBundle), it's based on the Symfony2 security component.


Install the Bundle
------------------

Create a `Sensio` directory (if not exists) in your `src/Bundle` directory.

Use the following command if your project is under GIT control (from the root project directory) :

    git submodule add git@github.com:sensio/CasBundle.git src/Bundle/Sensio/CasBundle
    
If your project dont use GIT, just go into the `src/Bundle/Sensio` directory and clone the project :

    git clone git@github.com:sensio/CasBundle.git
    
Then add it to your AppKernel class :

    // in AppKernel::registerBundles()
    $bundles = array(
        ...
        new Bundle\Sensio\CasBundle\CasBundle(),
        ...
    );
    

Configuration
-------------

Deadly simple, here is an example with the YAML format :

    cas.config:
        uri:      https://my.cas.server:8080/  # URI of the cas server
        version:  2                            # version of the used CAS protocole
        cert:     /path/to/my/cert.pem         # ssl cert file path (if needed)
        request:  curl                         # request adapter (curl, http or file)
        
In addition, the security component must be aware of the new factory and listeners included in the bundle.
In order to to it, just look at the following example in YAML :

    security.config:
        template:
            - "%kernel.root_dir%/../src/Bundle/Sensio/CasBundle/Resources/config/security_templates.xml"
        
        
Use the firewall
----------------

As usual, here is a simple example with the YAML format (with the template) :

    security.config:
        template:
            - "%kernel.root_dir%/../src/Bundle/Sensio/CasBundle/Resources/config/security_templates.xml"
        providers:
            my_provider:
                users:
                    username: { roles: ROLE_USER }
        firewalls:
            my_firewall:
                pattern:    /path/to/protected/url
                cas:        { provider: my_provider }

