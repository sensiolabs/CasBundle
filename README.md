Adds the CAS authentication to Symfony 2
========================================

[More informations about CAS](http://www.jasig.org/cas).

Unlike [SimpleCasBundle](https://github.com/jmikola/SimpleCASBundle), it's based on the Symfony2 security component.


Install the Bundle
------------------


Just copy/paste the following command :

    git submodule add git@github.com:jfsimon/GMapBundle.git src/Bundle/Sensio
    
Then add it to your AppKernel class :

    new Bundle\Sensio\CasBundle\CasBundle(),
    

Configuration
-------------


Here is an example with the YAML format :

    cas.config:
        baseUri: https://my.cas.server:8080/
        version: 2
        certFile: /path/to/my/cert.pem
        requestsType: curl
        
        
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

