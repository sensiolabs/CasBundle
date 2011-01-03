Adds the CAS authentication to Symfony 2
========================================

[More informations about CAS](http://www.jasig.org/cas).

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

Here is an example with the YAML format :

    cas.config:
        uri:      https://my.cas.server:8080/  # URI of the cas server
        version:  2                            # version of the used CAS protocole
        cert:     /path/to/my/cert.pem         # ssl cert file path (if needed)
        request:  curl                         # request adapter (curl, http or file)
        
        
Use the firewall
----------------

Here is an example with the YAML format :

    security.config:
        providers:
            my_provider:
                users:
                    username: { roles: ROLE_USER }
        firewalls:
            my_firewall:
                pattern:    /path/to/protected/url
                cas:        { provider: my_provider }

