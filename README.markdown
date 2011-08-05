# sfLDAP
sfLDAP is an abstraction layer for Kerberos-LDAP server authentication within Symfony and sfGuard. It plugs right into sfGuard and makes the integration with a Kerberos-LDAP server much easier. This can be easily modified to cover normal LDAP servers. sfLDAP can be easily extended to cover the creation, editing and removal of LDAP entries. 

## Authors
* [Carla Gouveia](https://github.com/carlagouveia) (author, maintainer)

## Todo
* Implement CRUD, not only authentication

## Installation
Install sfGuard plugin normally, then clone this repository into your project. After that, edit your app.yml:

```
all:
  sf_guard_plugin:
    check_password_callable: [sfLDAP, auth]
    
  ldap:
    host: '192.168.0.1'
    port: 389
    protocol: 3
    dn: 'cn=users,dc=example,dc=com'
```

This will allow sfGuard to call the sfLDAP authentication method instead of it's own. It also configures your LDAP server.
